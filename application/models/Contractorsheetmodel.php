<?php
class Contractorsheetmodel extends CI_Model{
	

	    function show_contractorsalarysheet(){
			
		$month_year = $this->input->post('month_year');
		$contractor = $this->input->post('contractor');
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

if($contractor=="all" || (is_array($contractor) && in_array("all", $contractor))){
$query5 = $this->db->query('select cm.contractor_name, em.contractor as contractor_id_raw, em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN,em.ABRY,be.*,bw.rate1,bw.rate2 from bidi_roller_entry be inner join employee_master em on em.emp_id=be.employee_id inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id inner join contractor_master cm on cm.contractor_id = em.contractor where  month_year="'.$month_year.'" and em.status="1" and em.employee_type="BIDI MAKER" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');	
}
else{
    if(is_array($contractor)){
        $contractor_list = '"' . implode('","', $contractor) . '"';
        $query5 = $this->db->query('select cm.contractor_name, em.contractor as contractor_id_raw, em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN,em.ABRY,be.*,bw.rate1,bw.rate2 from bidi_roller_entry be inner join employee_master em on em.emp_id=be.employee_id inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id inner join contractor_master cm on cm.contractor_id = em.contractor where  month_year="'.$month_year.'" and em.status="1" and em.employee_type="BIDI MAKER" and em.contractor IN ('.$contractor_list.') and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');
    } else {
        $query5 = $this->db->query('select cm.contractor_name, em.contractor as contractor_id_raw, em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN,em.ABRY,be.*,bw.rate1,bw.rate2 from bidi_roller_entry be inner join employee_master em on em.emp_id=be.employee_id inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id inner join contractor_master cm on cm.contractor_id = em.contractor where  month_year="'.$month_year.'" and em.status="1" and em.employee_type="BIDI MAKER" and em.contractor="'.$contractor.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC ');	
    }
}
			foreach($query5->result() as $oldentry)
			{
				
		   $member_id 	= $oldentry->member_id;
		   $emp_id 		= $oldentry->emp_id;
		   $name 		= $oldentry->name_as_aadhaar;
		   $uan 		= $oldentry->UAN;
		   $gender 		= $oldentry->gender;
		   $no_of_days	= $oldentry->no_of_days;
		   $abry	= $oldentry->ABRY;
		   $contractor_name_row = $oldentry->contractor_name;
		   $contractor_id_row = $oldentry->contractor_id_raw;
		   
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
		$remaining_days =$n-($week_holiday_count+$hcount);
		
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
		   
		$query2 = $this->db->query('select id,rate1,rate2,bonus1,bonus2 from bidiroller_wages where "'.$lmfd.'" between from_date and to_date ORDER BY from_date,to_date  DESC LIMIT 1  ');
		foreach($query2->result() as $bidiroller)
		{
		   $br_id = $bidiroller->id;
		   $rate1 = $bidiroller->rate1;
		   $rate2 = $bidiroller->rate2;
		   $bonus1 = $bidiroller->bonus1;
		   $bonus2 = $bidiroller->bonus2;		   

		}
					$rate1 = $oldentry->rate1;
					$rate2 = $oldentry->rate2;
					$unit_days1 = $oldentry->unit_1_days;
					$unit_days2 = $oldentry->unit_2_days;
					$no_of_days= $oldentry->no_of_days;
					
					$leave_with_pay= $oldentry->leave_with_pay;					
	//				$bidiroller_wages_id= $oldentry->bidiroller_wages_id;
	
		$wages1 = ($unit_days1*$rate1)+($unit_days2*$rate2);
		if($no_of_days==0){
		$wages2 = 0;			
		}
		else{
					$wages2 = (($wages1/$no_of_days)*$leave_with_pay);
		}
		$wages = $wages1+$wages2;
		$bonus = ($unit_days1*$bonus1)+($unit_days2*$bonus2);
		$total = $wages+$bonus;
		
		
		$pf = (($wages)*($ac1eemf))/100;
		
		if($abry == 1){
			$net_wages = $total;
		}else{
			$net_wages = $total-$pf;
		}
			

		$qty=($unit_days1)+($unit_days2);		

//					$a= ($wages * $ac1er)/100;
//					$epf = $pf-$a;
					
					if($wages > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $wages;
					}
					
					$eps = ($eps_total*$ac10)/100;

//					$a= ($total * $employer_share)/100;
					$a= ($wages * $employer_share)/100;
					$epf = $a-$eps;

		
	$row = $name.'####'.$member_id.'####'.$uan.'####'.$month_year;
	$row .= '####'.$qty;	   
	$row .= '####'.$no_of_days;	   
	$row .= '####'.round($wages);	   
	$row .= '####'.round($bonus);	   
	$row .= '####'.round($total);	   
	$row .= '####'.round($pf);	   
	$row .= '####'.round($epf);	   
	$row .= '####'.round($eps);	   
	$row .= '####'.round($net_wages);	 
	$row .= '####'.$company_name;
	$row .= '####'.$address;
	$row .= '####'.$post_office;
	$row .= '####'.$district;
	$row .= '####'.$pincode;	
	$row .= '####'.$abry;	
	$row .= '####'.$contractor_name_row;	
	$row .= '####'.$contractor_id_row;	
	array_push($result,$row);
		   
		}  
			return $result;	
    }

	
}	
?>
