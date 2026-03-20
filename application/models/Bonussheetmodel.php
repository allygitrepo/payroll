<?php
class Bonussheetmodel extends CI_Model{
	
    function bonussheet_show(){
	$month_year1 = $this->input->post('month_year1');
	$month_year2 = $this->input->post('month_year2');
	$employee_type = $this->input->post('employee_type');
	$contractors = $this->input->post('contractor');
//	$employee_type = "OFFICE STAFF";
//	$employee_type = "BIDI PACKER";
//	$month_year1 = "04/2018";
//	$month_year2 = "07/2018";	
	$month1 = explode("/",$month_year1);
	$month2 = explode("/",$month_year2);	
//	echo $month_year1;
//	echo $month_year2;
		$result = array();
		
						$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$query = $this->db->get();

					if($query->num_rows()>0){
					$company_name = $query->row()->name;	
					$address = $query->row()->address;	
					$post_office = $query->row()->post_office;	
					$district = $query->row()->district;	
					$pincode = $query->row()->pincode;	
						
					}
					else{
						$company_name = "";
						$address = "";
						$post_office = "";
						$district = "";
						$pincode = "";	
					}
		
		$date1 = $month1[1].'-'.$month1[0].'-01';
		$date2 = $month2[1].'-'.$month2[0].'-15';
		$date3 = $month2[1].'-'.$month2[0].'-31';
	$start    = (new DateTime($date1));
	$end      = (new DateTime($date2));
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);

	$month_head = '';
		foreach ($period as $dt) {
			$head = $dt->format("M/Y");
			$head1 = $dt->format("M");
			$head2 = $dt->format("Y");
			
			$month_head .= $head1.' '.$head2.'####';
			
			$lastmonth = $dt->format("m/Y");
		}
		   if($employee_type=="OFFICE STAFF"){
			$row = $month_head.'Total####Bonus####Additional Bonus####Total Payment';
		   }
		   elseif($employee_type=="BIDI MAKER"){
			$row = $month_head.'Total';			   
		   }
		   else{
			$row = $month_head.'Total####Bonus####Total Payment';			   
		   }
			array_push($result,$row);
	
		$row = ""; 
						$gmonth_total =	0;
						$grand_alltotal = 0;	
						$grand_standard_bonus =	0;
						$grand_additional_bonus = 0;
						$grand_total_payment = 0;
				$row1 = "TOTAL : ";
	//$query = $this->db->query('select em.UAN,em.member_id,em.name_as_aadhaar,em.emp_id from employee_master em where em.employee_type="'.$employee_type.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');			
	//$query = $this->db->query('select em.UAN,em.member_id,em.name_as_aadhaar,em.emp_id from employee_master em where em.employee_type="'.$employee_type.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj between "'.$date1.'" and "'.$date3.'" and  em.member_id NOT IN(select member_id from resignation_master) order by em.member_id ASC');			
	$this->db->select('em.UAN, em.member_id, em.name_as_aadhaar, em.emp_id');
	$this->db->from('employee_master em');
	$this->db->where('em.employee_type', $employee_type);
	$this->db->where("substr(em.member_id_org, 1, 15) =", $_SESSION['company_id']);
	$this->db->where("em.doj <=", $date3);
	$this->db->where("(em.member_id NOT IN (select member_id from resignation_master) OR em.member_id IN (select member_id from resignation_master where leaving_date >= '$date1'))", NULL, FALSE);

	if (!empty($contractors)) {
		if (is_array($contractors)) {
			if (!in_array('all', $contractors)) {
				$this->db->where_in('em.contractor', $contractors);
			}
		} else {
			if ($contractors !== 'all') {
				$this->db->where('em.contractor', $contractors);
			}
		}
	}

	$this->db->order_by('em.member_id', 'ASC');
	$query = $this->db->get();
	$employees = $query->result();

	// BATCH DATA FETCHING
	$all_emp_ids = array();
	foreach ($employees as $e) {
		$all_emp_ids[] = $e->emp_id;
	}

	$entry_lookup = array();
	if (!empty($all_emp_ids)) {
		if ($employee_type == "OFFICE STAFF") {
			$this->db->select('oe.employee_id, oe.month_year, oe.gross_wages, os.standard_bonus, os.additional_bonus');
			$this->db->from('office_staff_entry oe');
			$this->db->join('office_staff_salary os', 'os.id = oe.office_staff_salary_id');
			$this->db->where_in('oe.employee_id', $all_emp_ids);
			$entry_query = $this->db->get();
			foreach ($entry_query->result() as $row_data) {
				$entry_lookup[$row_data->employee_id][$row_data->month_year] = $row_data;
			}
		} elseif ($employee_type == "BIDI PACKER") {
			$this->db->select('pe.employee_id, pe.month_year, pe.gross_wages, pw.bonus');
			$this->db->from('packers_entry pe');
			$this->db->join('packing_wages pw', 'pw.id = pe.packing_wages_id');
			$this->db->where_in('pe.employee_id', $all_emp_ids);
			$entry_query = $this->db->get();
			foreach ($entry_query->result() as $row_data) {
				$entry_lookup[$row_data->employee_id][$row_data->month_year] = $row_data;
			}
		} elseif ($employee_type == "BIDI MAKER") {
			// Pre-fetch all bidiroller wages to ensure duration-based lookup accuracy
			$wages_query = $this->db->get('bidiroller_wages');
			$wages_master = $wages_query->result();

			$this->db->select('be.*');
			$this->db->from('bidi_roller_entry be');
			$this->db->where_in('be.employee_id', $all_emp_ids);
			$entry_query = $this->db->get();
			foreach ($entry_query->result() as $row_data) {
				// Match wages by month duration
				$dt_obj = DateTime::createFromFormat('d/m/Y', '01/'.$row_data->month_year);
				$matched_wages = null;
				if($dt_obj){
					$entry_date = $dt_obj->format('Y-m-d');
					foreach($wages_master as $wm){
						if($entry_date >= $wm->from_date && $entry_date <= $wm->to_date){
							$matched_wages = $wm;
							break;
						}
					}
				}
				
				if($matched_wages){
					$row_data->hra_bonus1 = $matched_wages->hra_bonus1;
					$row_data->hra_bonus2 = $matched_wages->hra_bonus2;
				} else {
					$row_data->hra_bonus1 = 0;
					$row_data->hra_bonus2 = 0;
				}
				$entry_lookup[$row_data->employee_id][$row_data->month_year] = $row_data;
			}
		}
	}

	foreach ($employees as $employee_msater) {
		$name = $employee_msater->name_as_aadhaar;
		$emp_id = $employee_msater->emp_id;
		$uan = $employee_msater->UAN;
		$member_id = $employee_msater->member_id;

				$row = $name.'####'.$member_id.'####'.$uan;

						$sb_rate =	0;
						$alltotal = 0;
						$standard_bonus = 0;
						$additional_bonus = 0;
						$debug_info = array();
		foreach ($period as $dt) {
			$entry_month = $dt->format("m/Y");
			$total = 0;
			$entry_data = isset($entry_lookup[$emp_id][$entry_month]) ? $entry_lookup[$emp_id][$entry_month] : null;

			if ($entry_data) {
				if ($employee_type == "OFFICE STAFF") {
					$total = $entry_data->gross_wages;
					$sb_rate = $entry_data->standard_bonus;
					$ab_rate = $entry_data->additional_bonus;
					$alltotal = $alltotal + $total;
					$standard_bonus = ($alltotal * $sb_rate) / 100;
					$additional_bonus = ($alltotal * $ab_rate) / 100;
				} elseif ($employee_type == "BIDI PACKER") {
					$total = $entry_data->gross_wages;
					$sb_rate = $entry_data->bonus;
					$alltotal = $alltotal + $total;
					$standard_bonus = ($alltotal * $sb_rate) / 100;
					$additional_bonus = 0;
				} elseif ($employee_type == "BIDI MAKER") {
					// Formula: No of unit work1*hra_bonus1 + no of unit work2*hra_bonus2 
					$total = ($entry_data->unit_1_days * $entry_data->hra_bonus1) + ($entry_data->unit_2_days * $entry_data->hra_bonus2);

					$alltotal = $alltotal + $total;
					$standard_bonus = $alltotal;
					$additional_bonus = 0;
					
					// Collect debug info
					$debug_info[] = $entry_month . ':' . $entry_data->hra_bonus1 . ':' . $entry_data->hra_bonus2 . ':' . $entry_data->unit_1_days . ':' . $entry_data->unit_2_days . ':' . $total;
				}
			}
			$row .= '####' . $total;
		}

	
		   if($employee_type=="OFFICE STAFF"){
				$total_payment = round($standard_bonus)+round($additional_bonus);
				$row .= '####'.$alltotal.'####'.round($standard_bonus).'####'.round($additional_bonus);
				$row .= '####'.$total_payment;
		   }
		   elseif($employee_type=="BIDI MAKER"){
				// For Bidi Maker, we only show Total (which is now sum of bonuses)
				$row .= '####'.$alltotal;
				// Append debug info at the very end with a special prefix
				$row .= '####[DEBUG]'.implode('|', $debug_info);
		   }
		   else{
				$total_payment = round($standard_bonus);
				$row .= '####'.$alltotal.'####'.round($standard_bonus);
				$row .= '####'.$total_payment;
		   }	
		
		
//						$grand_alltotal = $alltotal+$grand_alltotal;	
//						$grand_standard_bonus =	$standard_bonus+$grand_standard_bonus;
//						$grand_additional_bonus =	$additional_bonus+$grand_additional_bonus;
//						$grand_total_payment =	$total_payment+$grand_total_payment;
		
	//		if($query1->num_rows() > 0){
					array_push($result,$row);
		//		}
		
			}
//		$row1 .= '####'.$grand_alltotal.'####'.round($grand_standard_bonus).'####'.round($grand_additional_bonus);
//		$row1 .= '####'.$grand_total_payment;
//					array_push($result,$row1);

	$row = $company_name;
	$row .= '####'.$address;
	$row .= '####'.$post_office;
	$row .= '####'.$district;
	$row .= '####'.$pincode;	
					array_push($result,$row);

return $result;
    }

}
?>