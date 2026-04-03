<?php
class Employeeimportmodel extends CI_Model
{
	private static $cached_website = null;
	private static $cached_contractors = [];
	private $existing_employees = [];
	private $existing_kyc = [];


	public function employee_import_file($result)
	{
		// Fetch website if not cached
		if (self::$cached_website === null) {
			$this->db->select('website');
			$this->db->from('company_master');
			if (isset($_SESSION['company_id'])) {
				$this->db->where('estb_id', $_SESSION['company_id']);
			}
			$query = $this->db->get();
			self::$cached_website = ($query->num_rows() > 0) ? $query->row()->website : "";
		}
		
		// If calling row-by-row, আমরা pre-fetching করতে পারবো না (no $sheetData context).
		// তবে আমরা process_single_employee ব্যবহার করতে পারি ।
		// Note: This matches the old behavior but won't be as fast as the bulk method.
		return $this->process_single_employee($result, self::$cached_website);
	}


	public function bulk_employee_import($sheetData)
	{
		if (empty($sheetData)) return "No data to import";

		$this->db->trans_start();

		// 1. Pre-fetch Constants
		if (self::$cached_website === null) {
			$this->db->select('website');
			$this->db->from('company_master');
			if (isset($_SESSION['company_id'])) {
				$this->db->where('estb_id', $_SESSION['company_id']);
			}
			$query = $this->db->get();
			self::$cached_website = ($query->num_rows() > 0) ? $query->row()->website : "";
		}
		$website = self::$cached_website;

		// 2. Identify all UANs and Aadhaar numbers for bulk lookup
		$all_uans = [];
		$all_aadhaars = [];
		$rowCount = count($sheetData);
		
		for ($i = 1; $i < $rowCount; $i++) {
			$row = $sheetData[$i];
			if (empty($row) || (trim($row[0]) == "" && trim($row[14]) == "")) continue;
			
			$uan = trim($row[0]);
			$aadhaar = trim($row[14]);
			
			if ($uan != "" && $uan != "NOT AVAILABLE") $all_uans[] = $uan;
			if ($aadhaar != "" && $aadhaar != "NOT AVAILABLE") $all_aadhaars[] = $aadhaar;
		}

		// 3. Bulk Fetch Employees
		$this->existing_employees = [];
		if (!empty($all_uans)) {
			$this->db->where_in('UAN', $all_uans);
			$res = $this->db->get('employee_master')->result_array();
			foreach ($res as $emp) {
				$this->existing_employees['uan_' . $emp['UAN']] = $emp;
			}
		}
		if (!empty($all_aadhaars)) {
			$this->db->where_in('aadhaar_no', $all_aadhaars);
			$res = $this->db->get('employee_master')->result_array();
			foreach ($res as $emp) {
				$this->existing_employees['aadhaar_' . $emp['aadhaar_no']] = $emp;
			}
		}

		// 4. Bulk Fetch KYC for identified employees
		$emp_ids = array_unique(array_column($this->existing_employees, 'emp_id'));
		$this->existing_kyc = [];
		if (!empty($emp_ids)) {
			$this->db->where_in('emp_id', $emp_ids);
			$res = $this->db->get('kyc_master')->result_array();
			foreach ($res as $kyc) {
				$this->existing_kyc[$kyc['emp_id']][$kyc['doc_type']] = $kyc;
			}
		}

		$log_details = "";

		// 5. Process each row
		for ($i = 1; $i < $rowCount; $i++) {
			$row = $sheetData[$i];
			if ((trim($row[0]) == "") && (trim($row[1]) == "") && (trim($row[2]) == "") && (trim($row[3]) == "") && (trim($row[4]) == "") && (trim($row[5]) == "") && (trim($row[6]) == "") && (trim($row[7]) == "") && (trim($row[8]) == "") && (trim($row[9]) == "") && (trim($row[10]) == "") && (trim($row[11]) == "") && (trim($row[12]) == "") && (trim($row[13]) == "") && (trim($row[14]) == "") && (trim($row[15]) == "") && (trim($row[16]) == "") && (trim($row[17]) == "") && (trim($row[18]) == "") && (trim($row[19]) == "")) {
				continue;
			}

			// Use the existing logic but with cached data to avoid SELECTs
			$result = array_slice($row, 0, 20);
			$status = $this->process_single_employee($result, $website);
			$log_details .= "----" . ($status ? "Success" : "Failed");
		}

		$this->db->trans_complete();
		return $log_details;
	}

	private function process_single_employee($result, $website)
	{
		$UAN = trim($result[0]);
		$ip_number = trim($result[1]);
		$pmid = trim($result[2]);
		$previus_member_id = trim(substr($pmid, -7));
		$emptype = strtoupper(trim($result[4]));
		
		$contractor_id = "";
		if ($emptype == "BIDI MAKER") {
			$ccode = $result[3];
			if (isset(self::$cached_contractors[$ccode])) {
				$contractor_id = self::$cached_contractors[$ccode];
			} else {
				$query = $this->db->query('select contractor_id from contractor_master where ccode="' . $ccode . '" ');
				$contractor_row = $query->row();
				$contractor_id = $contractor_row ? $contractor_row->contractor_id : "";
				self::$cached_contractors[$ccode] = $contractor_id;
			}
		}

		$employee_name = strtoupper(trim($result[5]));
		$emp_name1 = explode(".", $employee_name);
		$emp_name = isset($emp_name1[1]) ? trim($emp_name1[1]) : trim($employee_name);

		$dob1 = ($result[7] != "") ? date('Y-m-d', strtotime($result[7])) : "";
		$doj1 = ($result[8] != "") ? date('Y-m-d', strtotime($result[8])) : "";

		$gender = strtoupper(trim($result[6]));
		$father_husband = strtoupper(trim($result[9]));
		$relation = strtoupper(trim($result[10]));
		$status = strtoupper(trim($result[11]));
		$mobile = trim($result[12]);
		$bank_accno = trim($result[16]);
		$pan = trim($result[15]);
		$aadhaar_no = trim($result[14]);
		$nationality = strtoupper(trim($result[17]));
		$pmrpy = strtoupper(trim($result[18]));
		$ifsc = strtoupper(trim($result[19]));

		$email = (($aadhaar_no != "") && ($aadhaar_no != "NOT AVAILABLE")) ? $aadhaar_no . "@" . $website : "";

		// Lookup from cache instead of DB
		$existing_emp = null;
		if ($UAN != "" && $UAN != "NOT AVAILABLE" && isset($this->existing_employees['uan_' . $UAN])) {
			$existing_emp = $this->existing_employees['uan_' . $UAN];
		} elseif ($aadhaar_no != "" && $aadhaar_no != "NOT AVAILABLE" && isset($this->existing_employees['aadhaar_' . $aadhaar_no])) {
			$existing_emp = $this->existing_employees['aadhaar_' . $aadhaar_no];
		}

		if ($existing_emp) {
			// Update logic
			$emp_id = $existing_emp['emp_id'];
			$update_data = [
				'status' => '1'
			];
			if ($UAN != "" && $UAN != "NOT AVAILABLE") $update_data['UAN'] = $UAN;
			if ($previus_member_id != "" && $previus_member_id != "NOT AVAILABLE") $update_data['member_id'] = $previus_member_id;
			if ($dob1 != "" && $dob1 != "NOT AVAILABLE") $update_data['dob'] = $dob1;
			if ($doj1 != "" && $doj1 != "NOT AVAILABLE") $update_data['doj'] = $doj1;
			if ($gender != "" && $gender != "NOT AVAILABLE") $update_data['gender'] = $gender;
			if ($father_husband != "" && $father_husband != "NOT AVAILABLE") $update_data['father_husband'] = $father_husband;
			if ($relation != "" && $relation != "NOT AVAILABLE") $update_data['relation'] = $relation;
			if ($mobile != "" && $mobile != "NOT AVAILABLE") $update_data['mobile'] = $mobile;
			if ($aadhaar_no != "" && $aadhaar_no != "NOT AVAILABLE") {
				$update_data['email'] = $email;
				$update_data['aadhaar_no'] = $aadhaar_no;
			}
			if ($status != "" && $status != "NOT AVAILABLE") $update_data['marital_status'] = $status;
			if ($emp_name != "" && $emp_name != "NOT AVAILABLE") $update_data['name_as_aadhaar'] = $emp_name;
			if ($pmid != "" && $pmid != "NOT AVAILABLE") {
				$update_data['member_id_org'] = 'WBDGP0034083000' . $pmid;
			}
			if ($contractor_id != "" && $contractor_id != "NOT AVAILABLE") $update_data['contractor'] = $contractor_id;
			if ($emptype != "" && $emptype != "NOT AVAILABLE") $update_data['employee_type'] = $emptype;
			if ($nationality != "" && $nationality != "NOT AVAILABLE") $update_data['nationality'] = $nationality;
			if ($pmrpy != "" && $pmrpy != "NOT AVAILABLE") $update_data['pmrpy'] = $pmrpy;
			if ($ip_number != "" && $ip_number != "NOT AVAILABLE") $update_data['ip_number'] = $ip_number;

			$this->db->where('emp_id', $emp_id);
			$getdata = $this->db->update('employee_master', $update_data);
		} else {
			// Insert logic
			$data = array(
				'UAN' => $UAN,
				'member_id' => $previus_member_id,
				'dob' => $dob1,
				'doj' => $doj1,
				'gender' => $gender,
				'father_husband' => $father_husband,
				'relation' => $relation,
				'mobile' => $mobile,
				'email' => $email,
				'marital_status' => $status,
				'aadhaar_no' => $aadhaar_no,
				'name_as_aadhaar' => $emp_name,
				'member_id_org' => 'WBDGP0034083000' . $pmid,
				'contractor' => $contractor_id,
				'employee_type' => $emptype,
				'status' => '1',
				'nationality' => $nationality,
				'pmrpy' => $pmrpy,
				'ip_number' => $ip_number
			);
			$getdata = $this->db->insert('employee_master', $data);
			$emp_id = $this->db->insert_id();
		}

		if ($getdata) {
			$this->process_kyc($emp_id, $pan, $bank_accno, $ifsc, $aadhaar_no, $emp_name);
		}

		return $getdata;
	}

	private function process_kyc($emp_id, $pan, $bank_accno, $ifsc, $aadhaar_no, $emp_name)
	{
		$date = date("Y/m/d");
		$kycs = isset($this->existing_kyc[$emp_id]) ? $this->existing_kyc[$emp_id] : [];

		// PAN
		if ($pan != "NOT AVAILABLE" && $pan != "") {
			if (isset($kycs['PAN'])) {
				$this->db->set('doc_num', $pan);
				$this->db->where(['emp_id' => $emp_id, 'doc_type' => 'PAN']);
				$this->db->update('kyc_master');
			} else {
				$this->db->insert('kyc_master', ['emp_id' => $emp_id, 'doc_type' => 'PAN', 'doc_num' => $pan, 'date' => $date]);
			}
		}

		// BANK
		if (($bank_accno != "NOT AVAILABLE" && $bank_accno != "") || ($ifsc != "NOT AVAILABLE" && $ifsc != "")) {
			if (isset($kycs['BANK'])) {
				if ($bank_accno != "NOT AVAILABLE" && $bank_accno != "") $this->db->set('doc_num', $bank_accno);
				if ($ifsc != "NOT AVAILABLE" && $ifsc != "") $this->db->set('ifsc', $ifsc);
				$this->db->where(['emp_id' => $emp_id, 'doc_type' => 'BANK']);
				$this->db->update('kyc_master');
			} else {
				$bank_data = ['emp_id' => $emp_id, 'doc_type' => 'BANK', 'date' => $date];
				if ($bank_accno != "NOT AVAILABLE" && $bank_accno != "") $bank_data['doc_num'] = $bank_accno;
				if ($ifsc != "NOT AVAILABLE" && $ifsc != "") $bank_data['ifsc'] = $ifsc;
				$this->db->insert('kyc_master', $bank_data);
			}
		}

		// AADHAAR
		if ($aadhaar_no != "NOT AVAILABLE" && $aadhaar_no != "") {
			if (isset($kycs['AADHAAR CARD'])) {
				$this->db->set('doc_num', $aadhaar_no);
				if ($emp_name != "" && $emp_name != "NOT AVAILABLE") $this->db->set('doc_name', $emp_name);
				$this->db->where(['emp_id' => $emp_id, 'doc_type' => 'AADHAAR CARD']);
				$this->db->update('kyc_master');
			} else {
				$this->db->insert('kyc_master', ['emp_id' => $emp_id, 'doc_type' => 'AADHAAR CARD', 'doc_num' => $aadhaar_no, 'doc_name' => $emp_name, 'date' => $date]);
			}
		}
	}


	public function gratuity_import_file($result)
	{
		$getdata = "";
		$colum1 = $result[0];
		$colum2 = $result[1];
		$colum3 = $result[2];
		$colum4 = $result[3];

		$gratuity_data = array(
			'member_id' => $colum1,
			'name' => $colum2,
			'year' => $colum3,
			'totaldays' => $colum4,
		);
		$this->db->insert('gratuity_master', $gratuity_data);

		return $getdata;
	}


}
?>