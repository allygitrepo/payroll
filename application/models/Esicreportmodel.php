<?php
class Esicreportmodel extends CI_Model{
	
	    function show_esicreport(){
			
		$month_year = $this->input->post('month_year');
		
		// Log the received month_year
		log_message('debug', 'ESIC Report - Month Year received: ' . $month_year);
		
		// If no month_year provided, use last month
		if($month_year=="")
		{
			$datestring='first day of last month';
			$dt=date_create($datestring);
			$lmfd =  $dt->format('Y-m-d'); 
			
			$datestring='last day of last month';
			$dt=date_create($datestring);
			$lmld =  $dt->format('Y-m-d'); 
			
			$date1 = explode("-",$lmfd);		
			
			$month = $date1[1];	   
			$year = $date1[0];	   
			$month_year = $month."/".$year;
			
			log_message('debug', 'ESIC Report - Using default last month: ' . $month_year);
		}
		else
		{
			// Parse the selected month/year
			$date_parts = explode("/",$month_year);
			$month = $date_parts[0];
			$year = $date_parts[1];
			
			log_message('debug', 'ESIC Report - Using selected month: ' . $month_year);
		}
		
		// Calculate last day of PREVIOUS month (one month before the selected month)
		$prev_month_timestamp = strtotime("$year-$month-01 -1 month");
		$lmld = date('d/m/Y', strtotime("last day of", $prev_month_timestamp));
		
		log_message('debug', 'ESIC Report - Last working day (previous month last date): ' . $lmld);

		$result = array();
		
		// Fetch all employees for this company
		$company_id = $_SESSION['company_id'];
		$employees_query = $this->db->query("SELECT em.member_id, em.ip_number, em.name_as_aadhaar, em.emp_id, em.employee_type FROM employee_master em WHERE substr(`member_id_org`,1,15) = ? ORDER BY em.member_id ASC", array($company_id));
		
		if ($employees_query->num_rows() == 0) {
			return $result;
		}

		$employees = $employees_query->result();
		log_message('debug', 'ESIC Report - Total employees found: ' . count($employees));
		
		// Batch fetch data from all 3 entry tables (Limited to this company)
		$office_entries = array();
		$packer_entries = array();
		$bidi_entries = array();

		$q1 = $this->db->query("SELECT t.employee_id, t.no_of_days_worked, t.gross_wages FROM office_staff_entry t 
								JOIN employee_master em ON em.emp_id = t.employee_id 
								WHERE t.month_year = ? AND substr(em.member_id_org,1,15) = ?", array($month_year, $company_id));
		foreach($q1->result() as $row) {
			$office_entries[$row->employee_id] = $row;
		}

		$q2 = $this->db->query("SELECT t.employee_id, t.no_of_worked_days, t.gross_wages FROM packers_entry t 
								JOIN employee_master em ON em.emp_id = t.employee_id 
								WHERE t.month_year = ? AND substr(em.member_id_org,1,15) = ?", array($month_year, $company_id));
		foreach($q2->result() as $row) {
			$packer_entries[$row->employee_id] = $row;
		}

		$q3 = $this->db->query("SELECT t.employee_id, t.no_of_days, t.gross_wages FROM bidi_roller_entry t 
								JOIN employee_master em ON em.emp_id = t.employee_id 
								WHERE t.month_year = ? AND substr(em.member_id_org,1,15) = ?", array($month_year, $company_id));
		foreach($q3->result() as $row) {
			$bidi_entries[$row->employee_id] = $row;
		}
		
		foreach($employees as $employee)
		{
		   $emp_id = $employee->emp_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $ip_number = $employee->ip_number;			
		   $employee_type = $employee->employee_type;			

		   $entry = null;
		   $no_days_working = 0;
		   $gross_wages = 0;

		   // Look up in pre-fetched data
		   if($employee_type=="OFFICE STAFF" && isset($office_entries[$emp_id])){
				$entry = $office_entries[$emp_id];
				$no_days_working = $entry->no_of_days_worked;
		   }
		   elseif($employee_type=="BIDI PACKER" && isset($packer_entries[$emp_id])){
				$entry = $packer_entries[$emp_id];
				$no_days_working = $entry->no_of_worked_days;
			}
		   elseif($employee_type=="BIDI MAKER" && isset($bidi_entries[$emp_id])){
				$entry = $bidi_entries[$emp_id];
				$no_days_working = $entry->no_of_days;
			}
			
			if($entry){
				$gross_wages = $entry->gross_wages;			
				// Reason code: 11 if no_days_working = 0, else 0
				$reason_code = ($no_days_working == 0) ? "11" : "0";  
				// Format: IP Number####IP Name####No of Days####Total Wages####Reason Code####Last Working Day####Month Year
				$row_str = $ip_number.'####'.$name_as_aadhaar.'####'.$no_days_working.'####'.$gross_wages.'####'.$reason_code.'####'.$lmld.'####'.$month_year;
				array_push($result, $row_str);
			}
		}
		
		log_message('debug', 'ESIC Report - Total records returned: ' . count($result));
		
		return $result;	
    }

}
?>
