<?php
class Ecrreportmodel extends CI_Model{
	
	    function show_ecrreport(){
			
		$month_year = $this->input->post('month_year');
		$pmrpy = $this->input->post('pmrpy');
//		$month_year = '06/2018';
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
						}

		$result = array();
		$row = "";
		if($pmrpy=="ALL"){
		$query = $this->db->query('select em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where    substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');						
		}
		else{
		$query = $this->db->query('select em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where  pmrpy="'.$pmrpy.'" and  substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');						
		}
		foreach($query->result() as $employee)
		{
		   $member_id = $employee->member_id;			
		   $emp_id = $employee->emp_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $uan = $employee->UAN;			
		   $employee_type = $employee->employee_type;			

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
			foreach($query1->result() as $officestaff)
				{
					
					   if($employee_type=="OFFICE STAFF"){
							$no_days_working = $officestaff->no_of_days_worked;									   						   
					   }
					   elseif($employee_type=="BIDI PACKER"){
							$no_days_working = $officestaff->no_of_worked_days;									   						   
						}
					   elseif($employee_type=="BIDI MAKER"){
							$no_days_working = $officestaff->no_of_days;									   						   
						}
					
					
					$gross_wages = $officestaff->gross_wages;			
					$epf_wages = $officestaff->epf_wages;			
					$eps_wages = $officestaff->eps_wages;			
					$edli_wages = $officestaff->edli_wages;			
					$epf_contri_remitted = $officestaff->epf_contri_remitted;			
					$eps_contri_remitted = $officestaff->eps_contri_remitted;			
					$epf_eps_diff_remitted = $officestaff->epf_eps_diff_remitted;			
					$ncp_days = $officestaff->ncp_days;			
					$refund_of_advances = $officestaff->refund_of_advances;			
		$row = $name_as_aadhaar.'####'.$member_id.'####'.$uan.'####'.$gross_wages."####".$epf_wages."####".$eps_wages."####".$edli_wages."####".$epf_contri_remitted."####".$eps_contri_remitted."####".$epf_eps_diff_remitted."####".$ncp_days.'####'.$refund_of_advances.'####'.$month_year;
	
				}
				
							if($query1->num_rows()>0){
					if($no_days_working == 0 && ( $ncp_days==1 || $ncp_days ==0)){}
						else{	
							array_push($result,$row);
						}		
			}	
			}

			
		}
		
		return $result;	
    }

			

}
?>