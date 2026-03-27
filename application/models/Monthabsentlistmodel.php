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

		$query = $this->db->query('
			SELECT em.name_as_aadhaar, em.member_id, em.UAN, em.dob, em.employee_type, cm.contractor_name
			FROM employee_master em 
			LEFT JOIN contractor_master cm ON cm.contractor_id = em.contractor
			WHERE em.status = "1" 
			AND substr(em.member_id_org, 1, 15) = "'.$_SESSION['company_id'].'" 
			AND (
				em.emp_id IN (SELECT employee_id FROM office_staff_entry WHERE no_of_days_worked = "0" AND month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'"))
				OR em.emp_id IN (SELECT employee_id FROM packers_entry WHERE no_of_worked_days = "0" AND month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'"))
				OR em.emp_id IN (SELECT employee_id FROM bidi_roller_entry WHERE no_of_days = "0" AND month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'"))
			)
			ORDER BY em.member_id ASC
		');

		foreach($query->result() as $employee) {
			$row = $employee->name_as_aadhaar."####".$employee->member_id."####".$employee->UAN."####".$employee->dob."####".$employee->employee_type."####".$employee->contractor_name;
			array_push($result, $row);
		}
		
		return $result;	
    }



}	
?>