<?php
class Bidirollewagesmodel extends CI_Model{
	
 	    function bidirollewages_show(){
        $getdata=$this->db->get('bidiroller_wages');
        return $getdata->result();
    }

	function bidirollewages_save(){

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
			$date1 = $to_date;				
//echo "<script>alert('".$to_date."');</script>";		
		
	$this->db->where(' "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where(' to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('bidiroller_wages');
		$check = $this->db->count_all_results();
		

	if($check > 0){
	$result = 0;
	}
	else{
        $data = array(
                'from_date'  => $from_date, 
                'to_date'  => $to_date, 
                'rate1'  => $this->input->post('rate1'), 
                'bonus1' => $this->input->post('bonus1'), 
                'rate2'  => $this->input->post('rate2'), 
                'bonus2'  => $this->input->post('bonus2'), 
            );
		$result=$this->db->insert('bidiroller_wages',$data);
		}
	return $result;
   
	}
		function bidirollewages_update(){

		$id = $this->input->post('id');

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
	$this->db->where(' id !="'.$id.'" AND "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' id !="'.$id.'" AND  "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' id !="'.$id.'" AND  from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where(' id !="'.$id.'" AND  to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('bidiroller_wages');
		$check = $this->db->count_all_results();
		
		if($check > 0){
		$result = 0;
		}
		else{
                $rate1 = $this->input->post('rate1'); 
                $bonus1 = $this->input->post('bonus1'); 
                $rate2 = $this->input->post('rate2'); 
                $bonus2 = $this->input->post('bonus2'); 
           
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('rate1', $rate1);
        $this->db->set('bonus1', $bonus1);
        $this->db->set('rate2', $rate2);
        $this->db->set('bonus2', $bonus2);
        $this->db->where('id', $id);
        $result=$this->db->update('bidiroller_wages');
		}
	return $result;
   
	}
	
	    function bidirollewages_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('bidiroller_wages');
        return $result;
    }

	    function bidi_roller_entry_show(){
			
		$month_year = $this->input->post('month_year');
		$contractor = $this->input->post('contractor');
//		$month_year = "11/1999";
//		$contractor = "";
		
//		if(($contractor_id==null)||($contractor_id=="")){ $contractor = $contractor_code; }
		

		if($month_year=="")
		{
						$list = array();

			$month_check = 0;
			
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
			
			$month_check = 1;
			
			
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
//	select em.member_id,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI MAKER" and em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm where rm.leaving_date between "2018-06-01" and "2018-06-31") ) order by em.member_id ASC

		$count = $this->db->query('select count(be.bidi_roller_entry_id) as countn from bidi_roller_entry be inner join employee_master em  where be.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" ');
		$entry_count = $count->row()->countn;	
		$result = array();

		$date_doj = $year."-".$month."-01";

		if(($contractor==null)||($contractor=="")){
		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI MAKER" and  substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj<=LAST_DAY("'.$date_doj.'")  order by em.member_id ASC');			
//		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI MAKER" and em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm inner join employee_master ep on ep.member_id=rm.member_id where em.employee_type="BIDI MAKER" and rm.leaving_date between "'.$lmfd.'" and "'.$lmld.'") ) and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" order by em.member_id ASC');			
		}
		else{
		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI MAKER" and  em.contractor="'.$contractor.'" and   substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj<=LAST_DAY("'.$date_doj.'")  order by em.member_id ASC');			
//		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI MAKER" and  em.contractor="'.$contractor.'" and  em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm inner join employee_master ep on ep.member_id=rm.member_id where em.employee_type="BIDI MAKER" and rm.leaving_date between "'.$lmfd.'" and "'.$lmld.'") ) and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" order by em.member_id ASC');			
		}
		foreach($query->result() as $kyc)
		{
		   $status = $kyc->status;
		   $member_id = $kyc->member_id;
		   $emp_id = $kyc->emp_id;
		   $name = $kyc->name_as_aadhaar;
		   $uan = $kyc->UAN;
		   $gender = $kyc->gender;
$rdate = 0;		   
		if($status==0){
		//	$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and (month(leaving_date)<="'.$month.'") and year(leaving_date)<="'.$year.'"   ');


$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and (month(leaving_date)<="'.$month.'" or month(leaving_date)>="'.$month.'") and year(leaving_date)<="'.$year.'"   ');
			if($query6->num_rows() > 0){
			$leaving_date = $query6->row()->leaving_date;		   			
		//	$lmld = $leaving_date;
			
			if($leaving_date<$lmfd){
					$rdate = 1;
				}

			if($month_check == 0)
			{
				
							$list = array();

				
			$datestring='first day of last month';
			$dt=date_create($datestring);
			$lmfd =  $dt->format('Y-m-d'); 
			
					$lmld =  $leaving_date;
					
					$date1 = explode("-",$lmld);		
		
					$dn = $date1[2];	   
					$month = $date1[1];	   
					$year = $date1[0];	   
					$month_year = $month."/".$year;
					
				for($d=1; $d<=$dn; $d++)
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

					$lmld =  $leaving_date;
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
						if($month_check==0)
						{
							
										$list = array();

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
				
			}	
		  $week_day = '';
		  $week_holiday_count = 0;
				$query2 = $this->db->query('select week_day  from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
				foreach($query2->result() as $weekholiday)
				{
					$week_day = $weekholiday->week_day;		   			
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
				}
					
							
//				$week_day = $query2->row()->week_day;		   
				
				
					
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
		
					$ncp_days1 = $remaining_days; 

					$total_no_of_days = $n; 
		
	$ac1eemf = 0;	
	$ac1eemale = 0;	
	$ac10 = 0;	

		if($gender=="MALE"){
			
		$query5 = $this->db->query('select ac1eemale,ac10 from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');

			foreach($query5->result() as $challan_setup){
	
			$ac1eemf = $challan_setup->ac1eemale;		   			
			$ac1eemale = $challan_setup->ac1eemale;		   			
			$ac10 = $challan_setup->ac10;		   			
				
			}

		}
		else{
			
		$query5 = $this->db->query('select ac1eemale,ac1eefemale,ac10 from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');

			foreach($query5->result() as $challan_setup){
	
			$ac1eemf = $challan_setup->ac1eefemale;		   			
			$ac1eemale = $challan_setup->ac1eemale;		   			
			$ac10 = $challan_setup->ac10;		   			
				
			}

		}	
		   $br_id = 0;
		   $rate1 = 0;
		   $rate2 = 0; 	
		   $bonus1 =0;		   
		   $bonus2 =0;		   
		$query2 = $this->db->query('select id,rate1,rate2,bonus1,bonus2 from bidiroller_wages where "'.$lmfd.'" between from_date and to_date ORDER BY from_date,to_date  DESC LIMIT 1  ');
		foreach($query2->result() as $bidiroller)
		{
		   $br_id = $bidiroller->id;
		   $rate1 = $bidiroller->rate1;
		   $rate2 = $bidiroller->rate2;
		   $bonus1 = $bidiroller->bonus1;
		   $bonus2 = $bidiroller->bonus2;		   
		}
					$unit_days1 =0;
					$unit_days2 =0;
					$no_of_days= 0;
					$leave_with_pay=0;
//					$bidiroller_wages_id=0;
		$wages = "";
		$bonus = "";
					
			$total = "";
			$pf = "";
			$net_wages = "";
		
		if($entry_count>0){


$query5 = $this->db->query('select be.*,bw.rate1,bw.rate2 from bidi_roller_entry be inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id where be.employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');
			foreach($query5->result() as $oldentry)
			{
				
				
					$rate1 = $oldentry->rate1;
					$rate2 = $oldentry->rate2;
					$unit_days1 = $oldentry->unit_1_days;
					$unit_days2 = $oldentry->unit_2_days;
					$no_of_days= $oldentry->no_of_days;
					
					$leave_with_pay= $oldentry->leave_with_pay;					
	//				$bidiroller_wages_id= $oldentry->bidiroller_wages_id;
	if(($unit_days1==0)&&($unit_days2==0)&&($no_of_days==0)&&($leave_with_pay==0)&&($oldentry->gross_wages==0))	
	{}
	else{
		$wages1 = ($unit_days1*$rate1)+($unit_days2*$rate2);
		
		$wages2 = (($wages1/$no_of_days)*$leave_with_pay);
		$wages = $wages1+$wages2;
		$bonus = ($unit_days1*$bonus1)+($unit_days2*$bonus2);
		$total = $wages+$bonus;
		if($total != 0){
					$pf = (($wages)*($ac1eemf))/100;
					$net_wages = $total-$pf;	
		}
	
	}
			}
		}	
		
$today_date = date('Y-m-d');		

$challan_date = $this->db->query('select count(wage_month) as countdate from challan_date_entry where wage_month="'.$month_year.'" and return_date>="'.$today_date.'" ');
		$count_challan_date = $challan_date->row()->countdate;	
	
		
	$row = $emp_id.'####'.$name.'####'.$uan.'####'.$month_year.'####'.$remaining_days;//.'####'.$rate2.'####'.$rate3.'####'.$rate4.'####'.$month_year.'####'.$pw_id.'####'.$ac1eemf.'####'.$ac10.'####'.$leave_without_pay.'####'.$worked_days.'####'.$unit1.'####'.$unit2.'####'.$unit3.'####'.$unit4.'####'.$addition.'####'.round($wages).'####'.round($weekly_leave).'####'.round($total).'####'.round($pf).'####'.round($pt).'####'.round($net_wages);		   
	$row .= '####'.$br_id;	   
	$row .= '####'.$rate1;	   
	$row .= '####'.$rate2;	   
	$row .= '####'.$bonus1;	   
	$row .= '####'.$bonus2;	   
	$row .= '####'.$ac1eemf;	   
	$row .= '####'.$ac10;	   
	$row .= '####'.round($wages);	   
	$row .= '####'.round($bonus);	   
	$row .= '####'.round($total);	   
	$row .= '####'.round($pf);	   
	$row .= '####'.round($net_wages);	   
	$row .= '####'.round($unit_days1);	   
	$row .= '####'.round($unit_days2);	   
	$row .= '####'.round($no_of_days);	   
	$row .= '####'.round($leave_with_pay);	   
	$row .= '####'.$member_id;
	$row .= '####'.$ac1eemale;
	$row .= '####'.$ncp_days1;
	$row .= '####'.$status;
	$row .= '####'.$entry_count;
	$row .= '####'.$count_challan_date;
	$row .= '####'.$total_no_of_days;
	
		if($rdate==0){
					array_push($result,$row);					
				}
		}  
			return $result;	
    }
		function save_bidiroller_entry(){
			
			
       $wages = $this->input->post('wages'); 
       $total = $this->input->post('total'); 
       $ac1eemf = $this->input->post('pf_rate'); 
       $ac10 = $this->input->post('ac10'); 
       $ac1eemale = $this->input->post('ac1male'); 
       $status = $this->input->post('status1'); 
       $remaining_days = $this->input->post('ncp_days'); 
	   $worked_days =  $this->input->post('worked_days'); 
	   $member_id   =  $this->input->post('member_id'); 
       $total_no_of_days  = $this->input->post('total_no_of_days'); 
       $month_year  = $this->input->post('month_year'); 

	   $gross_wages = $wages;
		
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

		if($month_year=="05/2018"){			
			$ncp_days = $remaining_days-$worked_days;			
		}
		else{
			$ncp_days = $total_no_of_days-$worked_days;
		}
			
		
		$refund_of_advances = 0;
        $data = array(
				'UAN'  => $this->input->post('uan'), 
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
                'unit_1_days'  => $this->input->post('unit_days1'), 
                'unit_2_days'  => $this->input->post('unit_days2'), 
                'no_of_days'  => $this->input->post('worked_days'), 
                'leave_with_pay'  => $this->input->post('leave_with_pay'), 
                'bidiroller_wages_id'  => $this->input->post('br_id'), 
                'net_wages'  => $this->input->post('net_wages'), 
                'month_year'  => $this->input->post('month_year'), 
            );
		$result=$this->db->insert('bidi_roller_entry',$data);
	return $result;
	}
	
	function bidiroller_entry_delete(){
			   $month_year = $this->input->post('month_year'); 
                $employee_id  = $this->input->post('emp_id'); 
	        $this->db->where('month_year',$month_year);
	        $this->db->where('employee_id',$employee_id);
        $result=$this->db->delete('bidi_roller_entry');
        return $result;
	}

	
}	
?>