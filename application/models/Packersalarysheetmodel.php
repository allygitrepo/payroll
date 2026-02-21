<?php
class Packersalarysheetmodel extends CI_Model{
	
 	
	
	
   	    function show_packersalarysheet(){
			
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


		
//$query5 = $this->db->query('select em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN,pe.unit_1,pe.unit_2,pe.unit_3,pe.unit_4,pe.additional_paid_wages,pe.no_of_worked_days,pt.tax_rate from packers_entry pe  inner join employee_master em on em.emp_id=pe.employee_id inner join  packing_wages pw on pw.id=pe.packing_wages_id inner join professional_tax pt on pt.id=pe.pt_id where  pe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');
	$query5 = $this->db->query('select em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN,pe.unit_1,pe.unit_2,pe.unit_3,pe.unit_4,pe.additional_paid_wages,pe.no_of_worked_days,pe.pt_id from packers_entry pe  inner join employee_master em on em.emp_id=pe.employee_id inner join  packing_wages pw on pw.id=pe.packing_wages_id  where  pe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');
			foreach($query5->result() as $oldentry)
			{
				
		   $member_id 	= $oldentry->member_id;
		   $emp_id 		= $oldentry->emp_id;
		   $name 		= $oldentry->name_as_aadhaar;
		   $uan 		= $oldentry->UAN;
		   $gender 		= $oldentry->gender;
		   $pt_id 		= $oldentry->pt_id;
		   
		   $tax_rate = 0;
   		$querytax = $this->db->query('select tax_rate from professional_tax where id="'.$pt_id.'" ');
			foreach($querytax->result() as $ptax)
			{
		   $tax_rate 	= $ptax->tax_rate;
			}
		   
		   
	$week_day = "";
		$query2 = $this->db->query('select week_day from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
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
				
				while(date('w', $time) != $day) { // 0 (for Sunday) through 6 (for Saturday)
					$time += 86400;
				}
				
				while($time < $endTime){
					$count++;
					$time += 7 * 86400;
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
//		echo $leave_without_pay;

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


 	
		   
		   
	 $query2 = $this->db->query('select id,rate1,rate2,rate3,rate4 from packing_wages where "'.$lmfd.'" between from_date and to_date ORDER BY from_date,to_date  DESC LIMIT 1  ');
		foreach($query2->result() as $packers)
		{
		   $pw_id = $packers->id;
		   $rate1 = $packers->rate1;
		   $rate2 = $packers->rate2;
		   $rate3 = $packers->rate3;
		   $rate4 = $packers->rate4;		   
				

			$unit1 = $oldentry->unit_1;
			$unit2 = $oldentry->unit_2;
			$unit3 = $oldentry->unit_3;
			$unit4 = $oldentry->unit_4;		
		   
		   $addition = $oldentry->additional_paid_wages;		   
		   $worked_days = $oldentry->no_of_worked_days;	

//		   $tax_rate = $oldentry->tax_rate;	
		   
		   $wages = ($unit1*$rate1)+($unit2*$rate2)+($unit3*$rate3)+($unit4*$rate4);
		   
		   $total1 = $unit1*$rate1;
		   $total2 = $unit2*$rate2;
		   $total3 = $unit3*$rate3;
		   $total4 = $unit4*$rate4;

		   $weekly_leave = ($wages)/6;

		   $total = $wages + $weekly_leave + $addition;
		   
			$pf = ($total*10)/100;

			$pt = $tax_rate;
			
			$net_wages = ($total)-($pt+$pf);

		}
//					$a= ($total * $ac1er)/100;
//					$epf = $pf-$a;
					
					if($total > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $total;
					}
					
					$eps = ($eps_total*$ac10)/100;

		
					$a= ($total * $employer_share)/100;
					$epf = $a-$eps;
	

	$row = $name.'####'.$uan.'####'.$member_id;
//	.'####'.$rate1.'####'.$rate2.'####'.$rate3.'####'.$rate4.'####'.$month_year.'####'.$pw_id.'####'.$ac1eemf.'####'.$ac10.'####'.$leave_without_pay.'####'.$worked_days.'####'.$unit1.'####'.$unit2.'####'.$unit3.'####'.$unit4.'####'.$addition.'####'.round($wages).'####'.round($weekly_leave).'####'.round($total).'####'.round($pf).'####'.round($pt).'####'.round($net_wages).'####'.$member_id;		   
	$row .= '####'.$month_year;	   
	$row .= '####'.$worked_days;	   
	$row .= '####'.$unit1;	   
	$row .= '####'.$unit2;	   
	$row .= '####'.$unit3;	   
	$row .= '####'.$unit4;	   
	$row .= '####'.round($total1);	   
	$row .= '####'.round($total2);	   
	$row .= '####'.round($total3);	   
	$row .= '####'.round($total4);	   
	$row .= '####'.round($addition);	   
	$row .= '####'.round($weekly_leave);	   
	$row .= '####'.round($total);	   
	$row .= '####'.round($pt);	   
	$row .= '####'.round($pf);	   
	$row .= '####'.round($net_wages);	   
	$row .= '####'.round($epf);	   
	$row .= '####'.round($eps);	   
	$row .= '####'.round($rate1);	   
	$row .= '####'.round($rate2);	   
	$row .= '####'.round($rate3);	   
	$row .= '####'.round($rate4);	   
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