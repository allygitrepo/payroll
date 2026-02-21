<?php
class Officesalarysheetmodel extends CI_Model{
	
 	
	
	
 	    function show_officesalarysheet(){
			
			$month_year = $this->input->post('month_year');
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
			
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
		}
		$n = count($list);
		$month_day = $n;

			

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
		
		
			$result = array();
			$query5 = $this->db->query('select em.emp_id,em.gender,em.name_as_aadhaar,em.member_id,em.UAN,oe.no_of_days_worked,oe.addition_if_any,os.salary,pt.tax_rate from employee_master em inner join office_staff_entry oe on oe.employee_id=em.emp_id inner join office_staff_salary os on os.id=oe.office_staff_salary_id inner join professional_tax pt on pt.id=oe.pt_id where oe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');
				foreach($query5->result() as $oldentry)
				{
					
										$emp_id = $oldentry->emp_id;
										$gender = $oldentry->gender;

					
		$query2 = $this->db->query('select week_day from calender_master where holiday_type="WEEKLY" and year="'.$year.'"  ');
		$week_day = $query2->row()->week_day;		   
		
							if($week_day=="Monday")	    {$day = 1; }
							if($week_day=="Tuesday")   { $day = 2; }
							if($week_day=="Wednesday") { $day = 3; }
							if($week_day=="Thursday")  { $day = 4; }
							if($week_day=="Friday")    { $day = 5; }
							if($week_day=="Saturday")  { $day = 6; }
							if($week_day=="Sunday")    { $day = 0; }
		
		
				 $startTime = strtotime($lmfd);
				 $endTime =  strtotime($lmld);
				
				$time = $startTime;
				$count = 0;
				
/*				while(date('w', $time) != $day) { // 0 (for Sunday) through 6 (for Saturday)
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
		$leave_with_pay = $week_holiday_count+$hcount;

		   
$salary = "";
		$query3 = $this->db->query('select salary,id from office_staff_salary where employee_id="'.$emp_id.'" and "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$salary = $query3->row()->salary;		   
		$salary_id = $query3->row()->id;		   
		   
		   
		 $query4 = $this->db->query('select `tax_rate`,`id` from professional_tax where "'.$salary.'" between `from` and `to`  LIMIT 1 ');
		 $tax_rate = $query4->row()->tax_rate;		   
		 $tax_id = $query4->row()->id;		   
		 
		 
		if($gender=="MALE"){
		$query5 = $this->db->query('select employer_share,ac1eemale,ac10,ac1er,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac1eemf = $query5->row()->ac1eemale;		   			
		$ac10 = $query5->row()->ac10;		   			
		$ac1er = $query5->row()->ac1er;		   			
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}
		else{
		$query5 = $this->db->query('select employer_share,ac1eefemale,ac10,ac1er,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac1eemf = $query5->row()->ac1eefemale;		   						
		$ac10 = $query5->row()->ac10;		   						
		$ac1er = $query5->row()->ac1er;		   						
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}
		

					
					
					$name_as_aadhaar = $oldentry->name_as_aadhaar;
					$UAN = $oldentry->UAN;
					$member_id = $oldentry->member_id;
					$no_of_days_worked = $oldentry->no_of_days_worked;
					$addition_if_any = $oldentry->addition_if_any;
					$basic_salary = $oldentry->salary;
					$tax_rate1 = $oldentry->tax_rate;
					
					$leave_without_pay1 = ($leave_without_pay)-($no_of_days_worked); 

					$perdaysalary1 = ($basic_salary)/($leave_without_pay);
			
					$cut_salary = $perdaysalary1 * $leave_without_pay1;
	
					$totalmonthsalary = (($basic_salary)+($addition_if_any))-round($cut_salary);
					
					$pf = (($totalmonthsalary)*10)/100;
					
					$pt = $tax_rate1;	
					
					if($totalmonthsalary!=0){
									$net_wages = $totalmonthsalary-(($pf)+($pt));	
					}
					else{
									$net_wages = 0;	
					}
					
					if($totalmonthsalary > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $totalmonthsalary;
					}
					
					$eps = ($eps_total*$ac10)/100;
					$a= ($totalmonthsalary * $employer_share)/100;
					$epf = $a-$eps;

					$row = $name_as_aadhaar.'####'.$UAN.'####'.$member_id;		   
					$row .= '####'.$month_year;	   
					$row .= '####'.round($basic_salary);	   
					$row .= '####'.$no_of_days_worked;	   
					$row .= '####'.$leave_with_pay;	   
					$row .= '####'.$leave_without_pay1;	   
					$row .= '####'.round($addition_if_any);	   
					$row .= '####'.$totalmonthsalary;	   
					$row .= '####'.round($pt);	   
					$row .= '####'.round($pf);	   
					$row .= '####'.round($net_wages);	   
					$row .= '####'.round($epf);	   
					$row .= '####'.round($eps);	   
					$row .= '####'.$company_name;
					$row .= '####'.$address;
					$row .= '####'.$post_office;
					$row .= '####'.$district;
					$row .= '####'.$pincode;	
					
					array_push($result,$row);
		   
	
									
				}
			
	
			
		return $result;	

   }	
}	
?>