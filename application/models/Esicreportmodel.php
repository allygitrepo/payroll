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
			// Calculate last day of the selected month
			$date_parts = explode("/",$month_year);
			$month = $date_parts[0];
			$year = $date_parts[1];
			$lmld = date('d/m/Y', strtotime("last day of $year-$month"));
			
			log_message('debug', 'ESIC Report - Using selected month: ' . $month_year);
		}

		$result = array();
		$row = "";
		
		// Fetch all employees
		$query = $this->db->query('select em.member_id,em.ip_number,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" order by em.member_id ASC');						
		
		log_message('debug', 'ESIC Report - Total employees found: ' . $query->num_rows());
		
		foreach($query->result() as $employee)
		{
		   $member_id = $employee->member_id;			
		   $emp_id = $employee->emp_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $ip_number = $employee->ip_number;			
		   $employee_type = $employee->employee_type;			

		   // Fetch wage data based on employee type
		   if($employee_type=="OFFICE STAFF"){
				$query1 = $this->db->query('select * from office_staff_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');						   
		   }
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select * from packers_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');			
			}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select * from bidi_roller_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');			
			}
			
			if(isset($query1)){
				foreach($query1->result() as $entry)
				{
					// Get number of days worked based on employee type
					if($employee_type=="OFFICE STAFF"){
						$no_days_working = $entry->no_of_days_worked;									   						   
					}
					elseif($employee_type=="BIDI PACKER"){
						$no_days_working = $entry->no_of_worked_days;									   						   
					}
					elseif($employee_type=="BIDI MAKER"){
						$no_days_working = $entry->no_of_days;									   						   
					}
					
					$gross_wages = $entry->gross_wages;			
					$reason_code = "";  // Keep blank as per requirement
					
					// Format: IP Number####IP Name####No of Days####Total Wages####Reason Code####Last Working Day####Month Year
					$row = $ip_number.'####'.$name_as_aadhaar.'####'.$no_days_working.'####'.$gross_wages.'####'.$reason_code.'####'.$lmld.'####'.$month_year;
				}
				
				// Only add if there's data
				if($query1->num_rows()>0){
					if($no_days_working == 0){}
					else{	
						array_push($result,$row);
					}		
				}	
			}
		}
		
		log_message('debug', 'ESIC Report - Total records returned: ' . count($result));
		
		return $result;	
    }

}
?>
