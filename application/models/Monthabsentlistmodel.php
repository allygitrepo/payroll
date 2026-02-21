<?php
class Monthabsentlistmodel extends CI_Model{
	
 	    function monthabsentlist_show(){

		$month1 = date('m/Y', strtotime('-1 month'));
		$month2 = date('m/Y', strtotime('-2 month'));
		$month3 = date('m/Y', strtotime('-3 month'));
		$result = array();
		$row = "";

					$contractor_name = "";			
					$pf_code = "";			

		$query = $this->db->query('select em.member_id,em.UAN,em.dob,em.name_as_aadhaar,em.employee_type,em.contractor,em.emp_id from employee_master em where em.status="1"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');			
		foreach($query->result() as $employee)
		{
		   $emp_id = $employee->emp_id;	
		   
		   $dob = $employee->dob;			
		   $member_id = $employee->member_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $uan = $employee->UAN;			
		   $employee_type = $employee->employee_type;			
		   $contractor = $employee->contractor;			
		   
		   if($employee_type=="OFFICE STAFF"){
					$query1 = $this->db->query('select count(gross_wages) as entrycount from office_staff_entry where employee_id="'.$emp_id.'" and   no_of_days_worked="0" and  month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'")    ');						   

//				$query1 = $this->db->query('select count(gross_wages) as entrycount from office_staff_entry where employee_id="'.$emp_id.'" and  month_year="'.$month1.'"   and  no_of_days_worked="0" ');						   
					}
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select count(gross_wages) as entrycount  from packers_entry where employee_id="'.$emp_id.'"  and no_of_worked_days="0"   and  month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'") ');

//				$query1 = $this->db->query('select count(gross_wages) as entrycount  from packers_entry where employee_id="'.$emp_id.'" and month_year="'.$month1.'"  and no_of_worked_days="0" ');

				
				}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select count(gross_wages) as entrycount  from bidi_roller_entry where employee_id="'.$emp_id.'"   and no_of_days="0"   and  month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'")');

//				$query1 = $this->db->query('select count(gross_wages) as entrycount  from bidi_roller_entry where employee_id="'.$emp_id.'" and month_year="'.$month1.'"  and no_of_days="0" ');

				$query2 = $this->db->query('select pf_code,contractor_name  from contractor_master where contractor_id="'.$contractor.'" ');

				foreach($query2->result() as $bidi)
					{
					$contractor_name = $bidi->contractor_name;			
					$pf_code = $bidi->pf_code;			
					}	
			}
			else{
			}		
					if(isset($query1)){
							foreach($query1->result() as $entrystaff)
					{
						
						
						$entrycount = $entrystaff->entrycount;		
						if($entrycount>0){
								$row = $name_as_aadhaar.'####'.$member_id.'####'.$uan.'####'.$dob."####".$employee_type."####".$contractor_name;
								array_push($result,$row);
						}
		
					}
			
				}
				
			
		}
		
		return $result;	
    }



}	
?>