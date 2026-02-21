<?php
class Pmrpyreportmodel extends CI_Model{
	
	    function show_pmrpyreport(){
			
		$month_year = $this->input->post('month_year');
//		$month_year = '05/2018';
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
							
							
							$timestamp = strtotime($year.'-'.$month.'-15');
							$search_date = date('Y-m-d',$timestamp);
							
						}
						else{
							$date1 = explode("/",$month_year);		
							$month = $date1[0];	   
							$year = $date1[1];	   
							$timestamp = strtotime($year.'-'.$month.'-15');
							$search_date = date('Y-m-d',$timestamp);

						}
						

		$result = array();
		$row = "";

		$query = $this->db->query('select em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where em.pmrpy="YES" and year(em.doj)="'.$year.'" and month(em.doj)="'.$month.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');			
		foreach($query->result() as $employee)
		{
		   $member_id = $employee->member_id;			
		   $emp_id = $employee->emp_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $uan = $employee->UAN;			
		   $employee_type = $employee->employee_type;			
			$gross_wages = 0;
			$adhar_no = "";
			
			$gross_wages = 0;
		   if($employee_type=="OFFICE STAFF"){
				$query1 = $this->db->query('select os.salary from office_staff_salary os  where os.employee_id="'.$emp_id.'" and ( "'.$search_date.'" between os.from_date and os.to_date ) ');						   
				foreach($query1->result() as $officestaff)
				{
					$gross_wages = $officestaff->salary;			
				}	
		   }
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select pw.rate1 from  packing_wages pw where   ( "'.$search_date.'" between pw.from_date and pw.to_date )  ');						   
				foreach($query1->result() as $officestaff)
				{
					$gross_wages = $officestaff->rate1;			
				}	
			}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select bw.rate1 from  bidiroller_wages bw where ( "'.$search_date.'" between bw.from_date and bw.to_date )   ');						   
				foreach($query1->result() as $officestaff)
				{
					$gross_wages = $officestaff->rate1;			
				}	
			}
			
			
				$query2 = $this->db->query('select doc_num from kyc_master where emp_id="'.$emp_id.'" and doc_type="AADHAAR CARD" ');						   
				foreach($query2->result() as $kyc)
				{
					$adhar_no = $kyc->doc_num;			
				}	
			
//			if($query1->num_rows()>0){
		$row = $name_as_aadhaar.'####'.$member_id.'####'.$uan.'####'.$adhar_no.'####'.round($gross_wages).'####'.$month_year;
					
					array_push($result,$row);
//			}
	
		}
		return $result;	
    }

			

}
?>