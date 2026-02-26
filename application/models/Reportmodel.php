<?php
class Reportmodel extends CI_Model{
	
 	    function yearsold_list_show(){
//		$date = date(Y-m-d);
$this->db->from('employee_master');
$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);
$this->db->where('status','1');
$this->db->order_by("dob", "asc");
        $getdata=$this->db->get();
		
        $getdata->result();
	$result1 = array();	
	foreach($getdata->result() as $get_emp)
   {
       $dob = $get_emp->dob;
       $member_id = $get_emp->member_id;
       $employee_type = $get_emp->employee_type;
	   if($employee_type=="BIDI MAKER"){
		   
       $contractor_id = $get_emp->contractor;
		   $getkyc= $this->db->query('SELECT contractor_name FROM contractor_master where contractor_id="'.$contractor_id.'"  ');
		if($getkyc->num_rows()>0){
		$contractor_name =	$getkyc->row()->contractor_name;			
		}
	   else{
		   	$contractor_name =	"";			
	   }
		
			
	   }
	   else{
		   	$contractor_name =	"";
			
	   }
		$date = date("Y/m/d");

		$from = new DateTime($dob);
		$to   = new DateTime($date);
		$age = $from->diff($to)->y;
	$pfcode = "";
		if($age>=57)
		{
		$row = $age."####".$get_emp->name_as_aadhaar."####".$member_id."####".$get_emp->UAN."####".$dob."####".$get_emp->employee_type."####".$contractor_name."####";
		array_push($result1,$row);
		}
   }
		return $result1;
		
    }

	    function gratuitycalculation_default(){
		$result1 = array();
		$result2 = array();
		
		// Set default values - current year and date
		$year = date('Y');
		$year5 = $year-1;
		$year4 = $year5-1;
		$year3 = $year4-1;
		$year2 = $year3-1;
		$year1 = $year2-1;
		
		$result2['year1'] = $year1;
		$result2['year2'] = $year2;
		$result2['year3'] = $year3;
		$result2['year4'] = $year4;
		$result2['year5'] = $year5;
		
		array_push($result1,$result2);
		
		$date = date('d/m/Y');
		
		// Get latest 7 employees with 5+ years of service
		$query = $this->db->query('select em.doj,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type 
			from employee_master em 
			where substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" 
			and TIMESTAMPDIFF(YEAR, em.doj, CURDATE()) >= 5
			and status="1"
			order by em.doj ASC LIMIT 7');
		
		foreach($query->result() as $employee)
		{
			$member_id = $employee->member_id;		
			$member_id_old = ltrim($member_id, '0');
			$emp_id = $employee->emp_id;			
			$result2['name_as_aadhaar'] = $employee->name_as_aadhaar;			
			$doj = $employee->doj;			
			$timestamp = strtotime($doj);
			$result2['doj']= date('d/m/Y',$timestamp);

			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"');
			if($query6->num_rows() > 0){
				$dor = $query6->row()->leaving_date;		   			
				$timestamp = strtotime($dor);
				$dor= date('d/m/Y',$timestamp);
			}
			else{
				$dor = $date;		   							
			}	
			$result2['dor']= $dor;
			
			$date_1 = $doj;
			$date_2 = $dor;

			$date2 = explode('/',$date_2);
			$date22= $date2[2]."-".$date2[1]."-".$date2[0];

			$date11=date_create($date_1);
			$date22=date_create($date22);
			$diff=date_diff($date11,$date22);
			
			$diff_years = $diff->format("%y");
			$result2['total_years']=$diff_years;
			
			$employee_type = $employee->employee_type;	
			
			for($j=0;$j<5;$j++){
				
				if($j==0){ $check_year = $year1; }	
				if($j==1){ $check_year = $year2; }
				if($j==2){ $check_year = $year3; }
				if($j==3){ $check_year = $year4; }
				if($j==4){ $check_year = $year5; }
				
				$total_days1 = 0;
				$total_days2 = 0;
				$salary = 0;
				
				$month1 = date('m/Y', strtotime('-1 month'));
				$month2 = date('m/Y', strtotime('-2 month'));
				$month3 = date('m/Y', strtotime('-3 month'));
				$month4 = date('m/Y', strtotime('-4 month'));
				$month5 = date('m/Y', strtotime('-5 month'));
				
				if($check_year<2018){
					$query2 = $this->db->query('select sum(totaldays) as totaldays from gratuity_master where member_id="'.$member_id_old.'" and  year="'.$check_year.'"');						   			
					$total_days1 = $query2->row()->totaldays;		   			
				}
				
				if($employee_type=="OFFICE STAFF"){  
					$query1 = $this->db->query('select sum(no_of_days_worked) as total_days from office_staff_entry where employee_id="'.$emp_id.'" and  month_year like "%/'.$check_year.'"');						   
					$lmfd = date("Y-m-d");					
					$query3 = $this->db->query('select `salary`,id  from office_staff_salary where `employee_id`="'.$emp_id.'"  and ("'.$lmfd.'" between `from_date` and `to_date` ) ORDER BY `from_date`,`to_date`  DESC LIMIT 1 ');
					if($query3->num_rows()>0){
						$salary = $query3->row()->salary;		   						
					}
				}
				elseif($employee_type=="BIDI PACKER"){
					$query1 = $this->db->query('select sum(no_of_worked_days) as total_days from packers_entry where employee_id="'.$emp_id.'"  and  month_year like "%/'.$check_year.'"');			
					$query3 = $this->db->query('select sum(gross_wages) as total_salary from packers_entry where employee_id="'.$emp_id.'"  and month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'","'.$month4.'","'.$month5.'")');
					if($query3->num_rows()>0){
						$salary1 = $query3->row()->total_salary;		   					
						$salary = round($salary1/6);		
					}
				}
				elseif($employee_type=="BIDI MAKER"){
					$query1 = $this->db->query('select sum(no_of_days) as total_days from bidi_roller_entry where employee_id="'.$emp_id.'"  and  month_year like "%/'.$check_year.'"');			
					$query3 = $this->db->query('select sum(gross_wages) as total_salary from bidi_roller_entry where employee_id="'.$emp_id.'"  and month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'","'.$month4.'","'.$month5.'")');
					if($query3->num_rows()>0){
						$salary1 = $query3->row()->total_salary;		   						
						$salary = round($salary1/6);		
					}
				}
				
				if(isset($query1)){
					foreach($query1->result() as $officestaff)
					{
						$total_days2 = $officestaff->total_days;					
					}
				}
				
				$result2['gtotal_days'.$j] = $total_days1+$total_days2;		
			}
			$result2['salary'] = $salary;	
			array_push($result1,$result2);
		}
		
		return $result1;
	}

	    function gratuitycalculation_show(){
		$result1 = array();
		$result2 = array();
			
			
//	$year = 2018;	
			
		$year =	$this->input->post('year');
		$year5 = $year-1;
		$year4 = $year5-1;
		$year3 = $year4-1;
		$year2 = $year3-1;
		$year1 = $year2-1;
		
		$result2['year1'] = $year1;
		$result2['year2'] = $year2;
		$result2['year3'] = $year3;
		$result2['year4'] = $year4;
		$result2['year5'] = $year5;
		
					array_push($result1,$result2);
		
		
		
			$date =	$this->input->post('date');
			$emptype =	$this->input->post('emptype');
			$contractor =	$this->input->post('contractor');
		
//	$date = "27/06/2018";	
//	$contractor = "";	
//	$emptype = "OFFICE STAFF";	
			
		
	   if(($emptype=="BIDI MAKER")&&($contractor != "all")){
			$query = $this->db->query('select em.doj,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where employee_type="'.$emptype.'" and contractor="'.$contractor.'" and  substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');			
		}
		else{
			$query = $this->db->query('select em.doj,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where employee_type="'.$emptype.'" and  substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');						
		}
	
		foreach($query->result() as $employee)
		{
						$member_id = $employee->member_id;		
						$member_id_old = ltrim($member_id, '0');
						
						$emp_id = $employee->emp_id;			
		   $result2['name_as_aadhaar'] = $employee->name_as_aadhaar;			
		   $doj = $employee->doj;			
		   			$timestamp = strtotime($doj);
		   $result2['doj']= date('d/m/Y',$timestamp);

			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"   ');
			if($query6->num_rows() > 0){
				$dor = $query6->row()->leaving_date;		   			
		   			$timestamp = strtotime($dor);
					$dor= date('d/m/Y',$timestamp);
			}
			else{
				$dor = $date;		   							
			}	
		   $result2['dor']= $dor;
		   
						$date_1 = $doj;
						$date_2 = $dor;

					$date2 = explode('/',$date_2);
					$date22= $date2[2]."-".$date2[1]."-".$date2[0];

					$date11=date_create($date_1);
					$date22=date_create($date22);
					$diff=date_diff($date11,$date22);
//echo $diff->format("%y");
						
						$diff_years = $diff->format("%y");
						$result2['total_years']=$diff_years;
		   
					$uan = $employee->UAN;			
					$employee_type = $employee->employee_type;	
					
			for($j=0;$j<5;$j++){
				
			if($j==0){ $check_year = $year1; }	
            if($j==1){ $check_year = $year2; }
            if($j==2){ $check_year = $year3; }
			if($j==3){ $check_year = $year4; }
            if($j==4){ $check_year = $year5; }
			
			
			
			$total_days1 = 0;
			$total_days2 = 0;
			$salary = 0;
			
			
			$month1 = date('m/Y', strtotime('-1 month'));
			$month2 = date('m/Y', strtotime('-2 month'));
			$month3 = date('m/Y', strtotime('-3 month'));
			$month4 = date('m/Y', strtotime('-4 month'));
			$month5 = date('m/Y', strtotime('-5 month'));
			$month6 = date('m/Y', strtotime('-6 month'));
			
			
			if($check_year<2018){
				
				$query2 = $this->db->query('select sum(totaldays) as totaldays from gratuity_master where member_id="'.$member_id_old.'" and  year="'.$check_year.'"  ');						   			
				$total_days1 = $query2->row()->totaldays;		   			
			}
			
			
			
			
			
			
			
			
			
			if($employee_type=="OFFICE STAFF"){  
				$query1 = $this->db->query('select sum(no_of_days_worked) as total_days from office_staff_entry where employee_id="'.$emp_id.'" and  month_year like "%/'.$check_year.'"  ');						   

				$lmfd = date("Y-m-d");					
				
				$query3 = $this->db->query('select `salary`,id  from office_staff_salary where `employee_id`="'.$emp_id.'"  and ("'.$lmfd.'" between `from_date` and `to_date` ) ORDER BY `from_date`,`to_date`  DESC LIMIT 1 ');

					if($query3->num_rows()>0){
							$salary = $query3->row()->salary;		   						
					}

			}
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select sum(no_of_worked_days) as total_days from packers_entry where employee_id="'.$emp_id.'"  and  month_year like "%/'.$check_year.'"   ');			

			$query3 = $this->db->query('select sum(gross_wages) as total_salary from packers_entry where employee_id="'.$emp_id.'"  and month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'","'.$month4.'","'.$month5.'")   ');
					if($query3->num_rows()>0){
							$salary1 = $query3->row()->total_salary;		   					
							$salary = round($salary1/6);		
					}
				}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select sum(no_of_days) as total_days from bidi_roller_entry where employee_id="'.$emp_id.'"  and  month_year like "%/'.$check_year.'"   ');			

				$query3 = $this->db->query('select sum(gross_wages) as total_salary from bidi_roller_entry where employee_id="'.$emp_id.'"  and month_year IN ("'.$month1.'","'.$month2.'","'.$month3.'","'.$month4.'","'.$month5.'")   ');
					if($query3->num_rows()>0){
							$salary1 = $query3->row()->total_salary;		   						
							$salary = round($salary1/6);		
					}





				}
			if(isset($query1)){
			foreach($query1->result() as $officestaff)
				{
//					$gross_wages = $officestaff->gross_wages;			
					$total_days2 = $officestaff->total_days;					
				}
			}
			


			$result2['gtotal_days'.$j] = $total_days1+$total_days2;		
//			echo $total_days1."-".$total_days2."<br>";
			
//							if($query1->num_rows()>0){}	
			}
			$result2['salary'] = $salary;	



	
					array_push($result1,$result2);
		}
		

		return $result1;
    }



}	
?>