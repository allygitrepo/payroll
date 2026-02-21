<?php
class Officestaffsalarymodel extends CI_Model{
	
	function officestaffsalary_show(){
		
					$this->db->select('office_staff_salary.*,employee_master.name_as_aadhaar');    
					$this->db->from('office_staff_salary');
					$this->db->join('employee_master', 'office_staff_salary.employee_id = employee_master.emp_id');
					$this->db->where(substr(`employee_master.member_id_org`,1,15), $_SESSION['company_id']);
					$query = $this->db->get();
	        return $query->result();
    }

	function officestaffsalary_save(){

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));

		$employee_id  = $this->input->post('empname');

	$this->db->where('employee_id="'.$employee_id.'" and "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('office_staff_salary');
		$check = $this->db->count_all_results();
		

	if($check > 0){
	$result = 0;
	}
	else{
        $data = array(
                'from_date'  => $from_date, 
                'to_date'  => $to_date, 
                'employee_id'  => $this->input->post('empname'), 
                'salary' => $this->input->post('salary'), 
                'standard_bonus'  => $this->input->post('standardbonus'), 
                'additional_bonus'  => $this->input->post('additionalbonus'), 
            );
		$result=$this->db->insert('office_staff_salary',$data);
		}
	return $result;
   
	}
		function officestaffsalary_update(){

		$id = $this->input->post('id');

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
	$this->db->where(' id !="'.$id.'" AND "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' id !="'.$id.'" AND  "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' id !="'.$id.'" AND  from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where(' id !="'.$id.'" AND  to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('packing_wages');
		$check = $this->db->count_all_results();
		
/*		if($check > 0){
		$result = 0;
		}
		else{
*/                $empname = $this->input->post('empname'); 
                $salary = $this->input->post('salary'); 
                $standardbonus = $this->input->post('standardbonus'); 
                $additionalbonus = $this->input->post('additionalbonus');
           
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('employee_id', $empname);
        $this->db->set('standard_bonus', $standardbonus);
        $this->db->set('additional_bonus', $additionalbonus);
        $this->db->where('id', $id);
        $result=$this->db->update('office_staff_salary');
//		}
	return $result;
   
	}
	
	    function officestaffsalary_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('office_staff_salary');
        return $result;
    }

	
 	    function officestaff_show(){
			
					$datestring='first day of last month';
					$dt=date_create($datestring);
					$lmfd =  $dt->format('Y-m-d'); 

					$datestring='last day of last month';
					$dt=date_create($datestring);
					$lmld =  $dt->format('Y-m-d'); 

					$date1 = explode("-",$lmfd);		

					$month = $date1[1];
					$year = $date1[0];

					$month_year = $month.'/'.$year;
					//		$date1 = explode("-",$month_year);		

							$list=array();
							
							for($d=1; $d<=31; $d++)
							{
								$time=mktime(12, 0, 0, $month, $d, $year);          
								if (date('m', $time)==$month)       
									$list[]=date('Y-m-d', $time);
							}
							$n = count($list);
							$month_day = $n;
  

		
		

		$count = $this->db->query('select count(oe.id) as countn from office_staff_entry oe inner join employee_master em on em.emp_id=oe.employee_id where oe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   ');
		$entry_count = $count->row()->countn;	

			
		$result = array();

 
		$date_doj = $year."-".$month."-01";

		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="OFFICE STAFF" and  substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" and em.doj<=LAST_DAY("'.$date_doj.'") order by em.member_id ASC');					

//		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="OFFICE STAFF" and em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm inner join employee_master ep on ep.member_id=rm.member_id where em.employee_type="OFFICE STAFF" and rm.leaving_date between "'.$lmfd.'" and "'.$lmld.'") ) and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');					

//		$query = $this->db->query('select emp_id,member_id,name_as_aadhaar,UAN,gender from employee_master where employee_type="OFFICE STAFF" and status="1" order by member_id ASC ');
//		echo $query->num_rows();
		foreach($query->result() as $kyc)
		{
		   $status = $kyc->status;
		   $emp_id = $kyc->emp_id;
		   $member_id = $kyc->member_id;
		   $name = $kyc->name_as_aadhaar;
		   $uan = $kyc->UAN;
		   $gender = $kyc->gender;
		   $rdate = 0;
		 
		   if($status==0){
			   			
			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'" and (month(leaving_date)<="'.$month.'" or month(leaving_date)>="'.$month.'") and year(leaving_date)<="'.$year.'"  ');
			if($query6->num_rows() > 0){
				
				$leaving_date = $query6->row()->leaving_date;		   			
            
				if($leaving_date<$lmfd){
					$rdate = 1;
					 
				}
				else{
					$lmld = $leaving_date;					
				}
				
						$datestring='first day of last month';
						$dt=date_create($datestring);
						$lmfd =  $dt->format('Y-m-d'); 
						
						
						$date1 = explode("-",$lmfd);		
						$date11 = explode("-",$lmld);
						$dn = $date11[2];		
						
						$month = $date1[1];
						$year = $date1[0];
						
						$month_year = $month.'/'.$year;
								$list=array();
								
								for($d=1; $d<=$dn; $d++)
								{
									$time=mktime(12, 0, 0, $month, $d, $year);          
									if (date('m', $time)==$month)       
										$list[]=date('Y-m-d', $time);
								}
								$n = count($list);
								$month_day = $n;
			

				
			}
			

			
			

		   }
		  		else{
				   						$list=array();
						
						$date11 = explode("/",$month_year);	
						$month = $date11[0];
						$year = $date11[1];
						
						for($d=1; $d<=31; $d++)
						{
							$time=mktime(12, 0, 0, $month, $d, $year);          
							if (date('m', $time)==$month)       
								$list[]=date('Y-m-d', $time);
						}
						$n = count($list);
						$month_day = $n;
				
						$lmfd = $list[0];		
						$lmld = $list[$n-1];	

		}	


		  $week_day = 0;
		  $day=0;

		$query2 = $this->db->query('select week_day from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
		$week_day = $query2->row()->week_day;		   
		
							if($week_day=="Sunday")    { $day = 0; }
							if($week_day=="Monday")	    {$day = 1; }
							if($week_day=="Tuesday")   { $day = 2; }
							if($week_day=="Wednesday") { $day = 3; }
							if($week_day=="Thursday")  { $day = 4; }
							if($week_day=="Friday")    { $day = 5; }
							if($week_day=="Saturday")  { $day = 6; }
		
		
				 $startTime = strtotime($lmfd);
				 $endTime =  strtotime($lmld);
				
/*				$time = $startTime;
				$count = 0;
				
				while(date('w', $time) != $day) { // 0 (for Sunday) through 6 (for Saturday)
					$time += 86400;
				}
				
				while($time < $endTime) {
					$count++;
					$time += 7 * 86400;
				}
*/
  				  $iter = 24*60*60; // whole day in seconds
					$count = 0; // keep a count of Sats & Suns

					for($i = $startTime; $i <= $endTime; $i=$i+$iter)
					{
						if(Date('w',$i) == $day)
						{
							$count++;
						}
					}
				$week_holiday_count = $count;
		$hcount = 0;
		$query1 = $this->db->query('select holiday_date from calender_master where holiday_type!="WEEKLY" and holiday_date between "'.$lmfd.'" and "'.$lmld.'" ');
		foreach($query1->result() as $h_date)
		{
			
					$hdate = $h_date->holiday_date;
			//Convert the date string into a unix timestamp.
			$unixTimestamp = strtotime($hdate);
			
			//Get the day of the week using PHP's date function.
			$dayOfWeek = date("l", $unixTimestamp);
			
			if($week_day!=$dayOfWeek){
						$hcount = $hcount+1;	
			}
						
		}
		$leave_without_pay =$n-($week_holiday_count+$hcount);
		$ncp_days1 =$n-($week_holiday_count+$hcount);
		$leave_with_pay = $week_holiday_count+$hcount;

		   
		$query3 = $this->db->query('select salary,id,count(id) as countsalary from office_staff_salary where employee_id="'.$emp_id.'" and "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$countsalary = $query3->row()->countsalary;
		if($countsalary>0){
		$salary = $query3->row()->salary;		   
		$salary_id = $query3->row()->id;		   
		}
		else{
//			$salary = 0;
//			$salary_id = 0;
		return "salary";	

		}
		  $query4 = $this->db->query('select `tax_rate`,`id`,count(`id`) as counttax from professional_tax where "'.$salary.'" between `from` and `to`  LIMIT 1 ');
		 $counttax = $query4->row()->counttax;
		if($counttax>0){		 
		 $tax_rate = $query4->row()->tax_rate;		   
		 $tax_id = $query4->row()->id;		   
		}
		else{
			$tax_rate = 0;		   
			$tax_id = 0;		   
			}
		  
		   
		 
		 
		if($gender=="MALE"){
		$query5 	= $this->db->query('select ac1eemale,ac10 from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac1eemf 	= $query5->row()->ac1eemale;		   			
		$ac1eemale 	= $query5->row()->ac1eemale;		   			
		$ac10 		= $query5->row()->ac10;		   			
		}
		else{
		$query5 	= $this->db->query('select ac1eemale,ac1eefemale,ac10 from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac1eemf 	= $query5->row()->ac1eefemale;		   						
		$ac1eemale 	= $query5->row()->ac1eemale;		   			
		$ac10 		= $query5->row()->ac10;		   						
		}
		
$no_of_days_worked = 0;
$addition_if_any = 0;
$basic_salary = 0;
$leave_without_pay1 = 0;
$totalmonthsalary = 0;
$pf = 0;
$pt = 0;
$net_wages = 0;
		
		if($entry_count>0){
$query5 = $this->db->query('select oe.no_of_days_worked,oe.addition_if_any,os.salary,pt.tax_rate from office_staff_entry oe inner join office_staff_salary os on os.id=oe.office_staff_salary_id inner join professional_tax pt on pt.id=oe.pt_id where oe.employee_id="'.$emp_id.'" and oe.month_year="'.$month_year.'" ');
			foreach($query5->result() as $oldentry)
			{
				$no_of_days_worked = $oldentry->no_of_days_worked;
				$addition_if_any = $oldentry->addition_if_any;
				$basic_salary = $oldentry->salary;
				$tax_rate1 = $oldentry->tax_rate;
				
				$leave_without_pay1 = ($leave_without_pay)-($no_of_days_worked); 
//				$total_days = $month_day-
				$perdaysalary1 = round(($basic_salary)/($leave_without_pay));
		
				$cut_salary = $perdaysalary1 * $leave_without_pay1;

				$totalmonthsalary = (($basic_salary)+($addition_if_any))-round($cut_salary);
				
				$pf = (($totalmonthsalary)*10)/100;
				
if($totalmonthsalary!=0){
					$pt = $tax_rate1;	
							$net_wages = $totalmonthsalary-(round($pf)+($pt));
}
			}
		
		}	
$today_date = date('Y-m-d');		

$challan_date = $this->db->query('select count(wage_month) as countdate from challan_date_entry where wage_month="'.$month_year.'" and return_date>="'.$today_date.'" ');
$count_challan_date = $challan_date->row()->countdate;	
		$count_challan_date = $challan_date->row()->countdate;	
		if($no_of_days_worked==0){
			$totalmonthsalary = 0;
			$pf = 0;
			$pt = 0;
			$net_wages = 0;
		}
		$row = $emp_id.'####'.$name.'####'.$uan.'####'.$leave_with_pay.'####'.$leave_without_pay.'####'.$salary.'####'.$tax_rate.'####'.$month.'/'.$year.'####'.$salary_id.'####'.$tax_id.'####'.$ac1eemf.'####'.$ac10.'####'.$no_of_days_worked.'####'.$leave_without_pay1.'####'.$addition_if_any.'####'.round($basic_salary).'####'.$totalmonthsalary.'####'.round($pf).'####'.round($pt).'####'.round($net_wages).'####'.$member_id.'####'.$ncp_days1.'####'.$ac1eemale.'####'.$entry_count.'####'.$count_challan_date; 
				if($rdate==0){
					array_push($result,$row);					
				}
		   
		} 
		
	return $result;	

   }	

  function officestaff_show_month(){
	   $month_year = $this->input->post('month_year'); 
	   
//		   $month_year = "07/2018"; 
//   $month_year = "06/2018"; 
	   
	   						$list=array();
						
						$date11 = explode("/",$month_year);	
						$month = $date11[0];
						$year = $date11[1];
						
						for($d=1; $d<=31; $d++)
						{
							$time=mktime(12, 0, 0, $month, $d, $year);          
							if (date('m', $time)==$month)       
								$list[]=date('Y-m-d', $time);
						}
						$n = count($list);
						$month_day = $n;
				
						$lmfd = $list[0];		
						$lmld = $list[$n-1];	
		$count = $this->db->query('select count(oe.id) as countn from office_staff_entry oe inner join employee_master em on em.emp_id=oe.employee_id where oe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   ');
		$entry_count = $count->row()->countn;	

		$date_doj = $year."-".$month."-01";
			$result = array();
		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="OFFICE STAFF"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj<=LAST_DAY("'.$date_doj.'")   order by em.member_id ASC');					
//		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="OFFICE STAFF" and em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm inner join employee_master ep on ep.member_id=rm.member_id where em.employee_type="OFFICE STAFF" and rm.leaving_date between "'.$lmfd.'" and "'.$lmld.'") )    and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');					
//		$query = $this->db->query('select emp_id,member_id,name_as_aadhaar,UAN,gender from employee_master where employee_type="OFFICE STAFF" and status="1" order by member_id ASC ');
		foreach($query->result() as $kyc)
		{
			

		   $emp_id = $kyc->emp_id;
		   $status = $kyc->status;
		   $member_id = $kyc->member_id;
		   $name = $kyc->name_as_aadhaar;
		   $uan = $kyc->UAN;
		$gender = $kyc->gender;
   		$list=array();
		
		
			$rdate=0;   
			
		   if($status==0){
			   			
			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and (month(leaving_date)<="'.$month.'" or month(leaving_date)>="'.$month.'") and year(leaving_date)<="'.$year.'"   ');

			if($query6->num_rows() > 0){

			$leaving_date = $query6->row()->leaving_date;		   			

			
			if($leaving_date<$lmfd){
					$rdate = 1;
				}
				else{
				$lmld = $leaving_date;					
				
				
					$list=array();

					$date1 = explode("-",$lmld);		
		
					$dn = $date1[2];	   

				$date11 = explode("/",$month_year);	
				$month = $date11[0];
				$year = $date11[1];
				
				for($d=1; $d<=$dn; $d++)
				{
					$time=mktime(12, 0, 0, $month, $d, $year);          
					if (date('m', $time)==$month)       
						$list[]=date('Y-m-d', $time);
				}
				$n = count($list);
				$month_day = $n;
		
				$lmfd = $list[0];		
				$lmld = $list[$n-1];	

				
				
				
				}
				
			
			
		   }
	
	
		   
		}	
		else{
				   						$list=array();
						
						$date11 = explode("/",$month_year);	
						$month = $date11[0];
						$year = $date11[1];
						
						for($d=1; $d<=31; $d++)
						{
							$time=mktime(12, 0, 0, $month, $d, $year);          
							if (date('m', $time)==$month)       
								$list[]=date('Y-m-d', $time);
						}
						$n = count($list);
						$month_day = $n;
				
						$lmfd = $list[0];		
						$lmld = $list[$n-1];	

		}	

			


		
		

		
		
		$week_day = "";
		$query2 = $this->db->query('select week_day,count(week_day) as weekcount from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
		$weekcount = $query2->row()->weekcount;		 
		if($weekcount>0){
		$week_day = $query2->row()->week_day;		   
		
							if($week_day=="Monday")	   { $day = 1; }
							if($week_day=="Tuesday")   { $day = 2; }
							if($week_day=="Wednesday") { $day = 3; }
							if($week_day=="Thursday")  { $day = 4; }
							if($week_day=="Friday")    { $day = 5; }
							if($week_day=="Saturday")  { $day = 6; }
							if($week_day=="Sunday")    { $day = 0; }
		
		
				 $startTime = strtotime($lmfd);
				 $endTime =  strtotime($lmld);
				

  				  $iter = 24*60*60; // whole day in seconds
					$count = 0; // keep a count of Sats & Suns

					for($i = $startTime; $i <= $endTime; $i=$i+$iter)
					{
						if(Date('w',$i) == $day)
						{
							$count++;
						}
					}
				
				$week_holiday_count = $count;
		}
		else{
				$week_holiday_count = 0;			
		}
		$hcount = 0;
		$query1 = $this->db->query('select holiday_date from calender_master where holiday_type!="WEEKLY" and holiday_date between "'.$lmfd.'" and "'.$lmld.'" ');
		foreach($query1->result() as $h_date)
		{
		
		
					$hdate = $h_date->holiday_date;
			//Convert the date string into a unix timestamp.
			$unixTimestamp = strtotime($hdate);
			
			//Get the day of the week using PHP's date function.
			$dayOfWeek = date("l", $unixTimestamp);
			
			if($week_day!=$dayOfWeek){
						$hcount = $hcount+1;	
			}
						
		}
		
		$leave_without_pay =$n-($week_holiday_count+$hcount);
		$ncp_days1 =$n-($week_holiday_count+$hcount);
		$leave_with_pay = ($week_holiday_count) + ($hcount);

		$query3 = $this->db->query('select `salary`,id,count(id) countsalary   from office_staff_salary where `employee_id`="'.$emp_id.'"  and ("'.$lmfd.'" between `from_date` and `to_date` ) ORDER BY `from_date`,`to_date`  DESC LIMIT 1 ');
		$countsalary = $query3->row()->countsalary;
		if($countsalary>0){
		$salary = $query3->row()->salary;		   
		$salary_id = $query3->row()->id;		   
		}
		else{
			$salary = 0;
			$salary_id = 0;
		return "salary";	

		}
		  $query4 = $this->db->query('select `tax_rate`,`id`,count(`id`) as counttax from professional_tax where "'.$salary.'" between `from` and `to`  LIMIT 1 ');
		 $counttax = $query4->row()->counttax;
		if($counttax>0){		 
		 $tax_rate = $query4->row()->tax_rate;		   
		 $tax_id = $query4->row()->id;		   
		}
		else{
			$tax_rate = 0;		   
			$tax_id = 0;		   
			}



				$ac1eemf 	= 0;		   			
				$ac1eemale 	= 0;		   			
				$ac10 		= 0;   							
		if($gender=="MALE"){
			
		$query5 = $this->db->query('select ac1eemale,ac10,count(ac10) as account from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$account = $query5->row()->account;
			if($account>0){
				$ac1eemf = $query5->row()->ac1eemale;		   			
				$ac1eemale = $query5->row()->ac1eemale;		   			
				$ac10 = $query5->row()->ac10;		   							
			}
		}
		else{
		$query5 = $this->db->query('select ac1eemale,ac1eefemale,ac10,count(ac10) as account from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$account = $query5->row()->account;
			if($account>0){
				$ac1eemf = $query5->row()->ac1eefemale;		   			
				$ac1eemale = $query5->row()->ac1eemale;		   			
				$ac10 = $query5->row()->ac10;		   							
			}
		}	

 	
$no_of_days_worked = 0;
$addition_if_any = 0;
$basic_salary = 0;
$leave_without_pay1 = 0;
$totalmonthsalary = 0;
$pf = 0;
$pt = 0;
$net_wages = 0;
		
		if($entry_count>0){
$query5 = $this->db->query('select oe.no_of_days_worked,oe.addition_if_any,os.salary,pt.tax_rate from office_staff_entry oe inner join office_staff_salary os on os.id=oe.office_staff_salary_id inner join professional_tax pt on pt.id=oe.pt_id where oe.employee_id="'.$emp_id.'" and oe.month_year="'.$month_year.'" ');
			foreach($query5->result() as $oldentry)
			{
				$no_of_days_worked = $oldentry->no_of_days_worked;

				$addition_if_any = $oldentry->addition_if_any;

				$basic_salary = $oldentry->salary;
				

				$tax_rate1 = $oldentry->tax_rate;
				
				$leave_without_pay1 = ($leave_without_pay)-($no_of_days_worked); 
//				$total_days = $month_day-
				$perdaysalary1 = round(($basic_salary)/($leave_without_pay));
		
				$cut_salary = $perdaysalary1 * $leave_without_pay1;

				$totalmonthsalary = (($basic_salary)+($addition_if_any))-round($cut_salary);
				
				
				
				
				

				
				
				$pf = (($totalmonthsalary)*10)/100;
				
				
							if($totalmonthsalary!=0){
							
							$pt = $tax_rate1;	

							$net_wages = $totalmonthsalary-(round($pf)+($pt));
											
							}

				
								
			}
		
		}
		
$today_date = date('Y-m-d');		
$challan_date = $this->db->query('select count(wage_month) as countdate from challan_date_entry where wage_month="'.$month_year.'" and return_date>="'.$today_date.'" ');
$count_challan_date = $challan_date->row()->countdate;	

		if($no_of_days_worked==0){
			$totalmonthsalary = 0;
			$pf = 0;
			$pt = 0;
			$net_wages = 0;
		}

	$row = $emp_id.'####'.$name.'####'.$uan.'####'.$leave_with_pay.'####'.$leave_without_pay.'####'.$salary.'####'.$tax_rate.'####'.$salary_id.'####'.$tax_id.'####'.$ac1eemf.'####'.$ac10.'####'.$no_of_days_worked.'####'.$leave_without_pay1.'####'.$addition_if_any.'####'.round($basic_salary).'####'.$totalmonthsalary.'####'.round($pf).'####'.round($pt).'####'.round($net_wages).'####'.$member_id.'####'.$ncp_days1.'####'.$ac1eemale.'####'.$entry_count.'####'.$count_challan_date;
				if($rdate==0){
					array_push($result,$row);			
			}
		}
			return $result;	
	

   }	

	function office_staff_entry_save(){

		$worked_days =  $this->input->post('worked_days'); 
       $remainig_days = $this->input->post('remainig_days'); 
       $ac1eemale = $this->input->post('ac1eemale'); 

       $total = $this->input->post('total'); 
       $ac1eemf = $this->input->post('ac1eemf'); 
       $ac10 = $this->input->post('ac10'); 
	$net_wages = $this->input->post('net_wages'); 

	   $gross_wages = $total;
		
		$epf_wages = $gross_wages;
		
		if($epf_wages > 14999)
		{
			$eps_wages = 15000;
		}
		else{
			$eps_wages = $epf_wages;			
		}
		
		if($epf_wages > 14999)
		{
			$edli_wages = 15000;
		}
		else{
			$edli_wages = $epf_wages;			
		}
		$epf_contri_remitted = round(($epf_wages)*($ac1eemf)/100); 
		
		$eps_contri_remitted = round(($eps_wages)*($ac10)/100); 
		
		$epf_eps_diff_remitted = round((($epf_wages*$ac1eemale)/100))-($eps_contri_remitted); 

		
			$ncp_days = $remainig_days-$worked_days;
			

		
		$refund_of_advances = 0;

				
        $data = array(
                'uan'  => $this->input->post('uan'), 
                'member_name'  => $this->input->post('member_name'), 
				'gross_wages' => $gross_wages,
				'epf_wages' => $epf_wages,
				'eps_wages' =>	$eps_wages,
				'edli_wages' =>	$edli_wages,
				'epf_contri_remitted' => $epf_contri_remitted,
				'eps_contri_remitted' => $eps_contri_remitted,
				'epf_eps_diff_remitted' => $epf_eps_diff_remitted,
				'ncp_days' => $ncp_days,
				'refund_of_advances' => $refund_of_advances,					
                'employee_id'  => $this->input->post('emp_id'), 
                'no_of_days_worked'  => $this->input->post('worked_days'), 
                'month_year'  => $this->input->post('month_year'), 
                'addition_if_any'  => $this->input->post('addition'), 
                'pt_id'  => $this->input->post('pt_id'), 
                'office_staff_salary_id'  => $this->input->post('salary_id'), 
                'net_wages'  => $net_wages, 
            );
		$result=$this->db->insert('office_staff_entry',$data);
	return $result;
	}
	
	function office_staff_entry_delete(){
			   $month_year = $this->input->post('month_year'); 
                $employee_id  = $this->input->post('emp_id'); 
	        $this->db->where('month_year',$month_year);
	        $this->db->where('employee_id',$employee_id);
        $result=$this->db->delete('office_staff_entry');
        return $result;
	}

}	
?>