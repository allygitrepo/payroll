<?php
class Packingwagesmodel extends CI_Model{
	
 	    function packingwages_show(){
        $getdata=$this->db->get('packing_wages');
        return $getdata->result();
    }

	function packingwages_save(){

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
					
	$this->db->where(' "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where(' from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where(' to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('packing_wages');
		$check = $this->db->count_all_results();
		

	if($check > 0){
	$result = 0;
	}
	else{
        $data = array(
                'from_date'  => $from_date, 
                'to_date'  => $to_date, 
                'rate1'  => $this->input->post('rate1'), 
                'rate2' => $this->input->post('rate2'), 
                'rate3'  => $this->input->post('rate3'), 
                'rate4'  => $this->input->post('rate4'), 
                'bonus' => $this->input->post('bonus'), 
            );
		$result=$this->db->insert('packing_wages',$data);
		}
	return $result;
   
	}
		function packingwages_update(){

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
		
		if($check > 0){
		$result = 0;
		}
		else{
                $rate1 = $this->input->post('rate1'); 
                $rate2 = $this->input->post('rate2'); 
                $rate3 = $this->input->post('rate3'); 
                $rate4 = $this->input->post('rate4'); 
                $bonus = $this->input->post('bonus'); 
           
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('rate1', $rate1);
        $this->db->set('rate2', $rate2);
        $this->db->set('rate3', $rate3);
        $this->db->set('rate4', $rate4);
        $this->db->set('bonus', $bonus);
        $this->db->where('id', $id);
        $result=$this->db->update('packing_wages');
		}
	return $result;
   
	}
	
	    function packingwages_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('packing_wages');
        return $result;
    }
	
	
	
	
 	    function show_packers_entry(){
			
			$month_year = $this->input->post('month_year');
//				$month_year = '01/2017';
//					$month_year = '';
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

	
		$count = $this->db->query('select count(pe.packers_entry_id) as countn from packers_entry pe inner join employee_master em on em.emp_id=pe.employee_id where pe.month_year="'.$month_year.'" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" ');
		$entry_count = $count->row()->countn;	
			
		$result = array();
				$date_doj = $year."-".$month."-01";

		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI PACKER" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" and em.doj<=LAST_DAY("'.$date_doj.'") order by em.member_id ASC');			
//		$query = $this->db->query('select em.member_id,em.status,em.gender,em.emp_id,em.name_as_aadhaar,em.UAN from employee_master em where em.employee_type="BIDI PACKER" and em.status="1" or (em.member_id IN (select rm.member_id from resignation_master rm inner join employee_master ep on ep.member_id=rm.member_id where em.employee_type="BIDI PACKER" and rm.leaving_date between "'.$lmfd.'" and "'.$lmld.'") ) and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" order by em.member_id ASC');			

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

    		$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and (month(leaving_date)<="'.$month.'" or month(leaving_date)>="'.$month.'") and year(leaving_date)<="'.$year.'"    ');

		
			if($query6->num_rows() > 0){
			$leaving_date = $query6->row()->leaving_date;		   			
			$lmld = $leaving_date;
			if($leaving_date<$lmfd){
					$rdate = 1;

				}
			
			if($rdate==0){

			if($month_check==0)
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
			$list = array();

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
		$query2 = $this->db->query('select week_day,count(week_day) as weekcount from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
		$weekcount = $query2->row()->weekcount;		 
		if($weekcount>0){
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
		}
		else{
				$week_holiday_count = 0;			
		}
		
		
			
		
						$total_no_of_days = $n;

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
//		echo $leave_without_pay;
		$ac1eemf = 0;
		$ac1eemale = 0;
		$ac10 = 0;
		$esic_wages = 0;
		$employee_share = 0;
		if($gender=="MALE"){
		$query5 = $this->db->query('select ac1eemale,ac10,esic_wages,employee_share from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
			foreach($query5->result() as $acentry)
			{
			$ac1eemf = $acentry->ac1eemale;
			$ac1eemale = $acentry->ac1eemale;
			$ac10 = $acentry->ac10;
			$esic_wages = $acentry->esic_wages;
			$employee_share = $acentry->employee_share;
			}  
		}
		else{
		$query5 = $this->db->query('select ac1eemale,ac1eefemale,ac10,esic_wages,employee_share from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
			foreach($query5->result() as $acentry)
			{
			$ac1eemf = $acentry->ac1eemale;
			$ac1eemale = $acentry->ac1eefemale;
			$ac10 = $acentry->ac10;
			$esic_wages = $acentry->esic_wages;
			$employee_share = $acentry->employee_share;
			}  
		}	
		   $pw_id =0;
		   $rate1 =0;
		   $rate2 =0; 	
		   $rate3 =0;		   
		   $rate4 =0;		   
	 $query2 = $this->db->query('select id,rate1,rate2,rate3,rate4 from packing_wages where "'.$lmfd.'" between from_date and to_date ORDER BY from_date,to_date  DESC LIMIT 1  ');
		foreach($query2->result() as $packers)
		{
		   $pw_id = $packers->id;
		   $rate1 = $packers->rate1;
		   $rate2 = $packers->rate2;
		   $rate3 = $packers->rate3;
		   $rate4 = $packers->rate4;		   
		}   
		   

		$unit1 = 0;
		   $unit2 = 0;
		   $unit3 = 0;
		   $unit4 = 0;		
		   
		   $addition = 0;		   
		   $worked_days = 0;	
		   $tax_rate = 0;	
		   $wages = 0;
		   $weekly_leave = 0;
		   $total = 0;
		   $pf = 0;
			$pt = 0;
		   $esic = 0;
		   $net_wages = 0;
		
		if($entry_count>0){

			
$query5 = $this->db->query('select pe.unit_1,pe.unit_2,pe.unit_3,pe.unit_4,pe.additional_paid_wages,pe.no_of_worked_days,pt.tax_rate from packers_entry pe inner join packing_wages pw on pw.id=pe.packing_wages_id inner join professional_tax pt on pt.id=pe.pt_id where pe.employee_id="'.$emp_id.'" and pe.month_year="'.$month_year.'" ');
			foreach($query5->result() as $oldentry)
			{

			$unit1 = $oldentry->unit_1;
		   $unit2 = $oldentry->unit_2;
		   $unit3 = $oldentry->unit_3;
		   $unit4 = $oldentry->unit_4;		
		   
		   
		   $addition = $oldentry->additional_paid_wages;		   
		   $worked_days = $oldentry->no_of_worked_days;	

		   $tax_rate = $oldentry->tax_rate;	
		   
		   $wages = ($unit1*$rate1)+($unit2*$rate2)+($unit3*$rate3)+($unit4*$rate4);

		   $weekly_leave = ($wages)/6;

		   $total = $wages + $weekly_leave + $addition;
			$pf = ($total*10)/100;

				   if($total != 0){
					$pt = $tax_rate;
					
					// Calculate ESIC
					if($total <= $esic_wages && $esic_wages > 0 && $employee_share > 0){
						$esic = round(($total * $employee_share) / 100);
					} else {
						$esic = 0;
					}
					
					$net_wages = ($total)-($pt+$pf+$esic);
					   
				   }

			}
		
		}	
$today_date = date('Y-m-d');		

$challan_date = $this->db->query('select count(wage_month) as countdate from challan_date_entry where wage_month="'.$month_year.'" and return_date>="'.$today_date.'" ');
		$count_challan_date = $challan_date->row()->countdate;	
	
   		$salary = $this->input->post('salary');
   		 $query4 = $this->db->query('select `tax_rate`,`id` from professional_tax where "'.round($total).'" between `from` and `to`  LIMIT 1 ');
		 $tax_id = $query4->row()->id;		   

	
	
	$row = $emp_id.'####'.$name.'####'.$uan.'####'.$rate1.'####'.$rate2.'####'.$rate3.'####'.$rate4.'####'.$month_year.'####'.$pw_id.'####'.$ac1eemf.'####'.$ac10.'####'.$leave_without_pay.'####'.$worked_days.'####'.$unit1.'####'.$unit2.'####'.$unit3.'####'.$unit4.'####'.$addition.'####'.round($wages).'####'.round($weekly_leave).'####'.round($total).'####'.round($pf).'####'.round($pt).'####'.round($net_wages).'####'.$member_id.'####'.$ac1eemale.'####'.$ncp_days1.'####'.$entry_count;		   
	$row .= '####'.$count_challan_date;
	$row .= '####'.$total_no_of_days;
	$row .= '####'.$tax_id;
	$row .= '####'.round($esic);

	
		if($rdate==0){
					array_push($result,$row);					
				}
		   
//			}  
		}
			return $result;	

   }	
   function ptax_get_taxrate(){
	   
   		$salary = $this->input->post('salary');
   		 $query4 = $this->db->query('select `tax_rate`,`id` from professional_tax where "'.$salary.'" between `from` and `to`  LIMIT 1 ');
		 $tax_rate = $query4->row()->tax_rate;		   
		 $tax_id = $query4->row()->id;		   
		 
		 // Get ESIC calculation
		 $esic = 0;
		 $query5 = $this->db->query('select esic_wages, employee_share from challan_setup ORDER BY from_date DESC LIMIT 1');
		 if($query5->num_rows() > 0){
			 $esic_wages = $query5->row()->esic_wages;
			 $employee_share = $query5->row()->employee_share;
			 
			 if($salary <= $esic_wages && $esic_wages > 0 && $employee_share > 0){
				 $esic = round(($salary * $employee_share) / 100);
			 }
		 }
		 
		return $tax_rate.'####'.$tax_id.'####'.$esic;	

   }


	function save_packers_entry(){
		
       $total = $this->input->post('total'); 
       $ac1eemf = $this->input->post('ac1eemf'); 
       $ac1eemale = $this->input->post('ac1eemale'); 
       $ac10 = $this->input->post('ac10'); 
		$remaining_days =  $this->input->post('ncp_days');
		$worked_days = $this->input->post('worked_days');		
		$net_wages = $this->input->post('net_wages');		
    $month_year  = $this->input->post('month_year'); 
    $total_no_of_days  = $this->input->post('total_no_of_days'); 

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
		
			if($month_year=="05/2018")
			{
					$ncp_days = $remaining_days-$worked_days;	
			}
			else{
					$ncp_days = $total_no_of_days-$worked_days;					
			}	
			
		
		$refund_of_advances = 0;

				
        $data = array(
                'employee_id'  => $this->input->post('emp_id'), 
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
                'no_of_worked_days'  => $this->input->post('worked_days'), 
                'unit_1'  => $this->input->post('unit1'), 
                'unit_2'  => $this->input->post('unit2'), 
                'unit_3'  => $this->input->post('unit3'), 
                'unit_4'  => $this->input->post('unit4'), 
                'additional_paid_wages'  => $this->input->post('addition'), 
                'month_year'  => $this->input->post('month_year'), 
                'pt_id'  => $this->input->post('pt_id'), 
                'packing_wages_id'  => $this->input->post('pw_id'), 
                'net_wages'  => $net_wages, 
            );
		$result=$this->db->insert('packers_entry',$data);
	return $result;
	}
	function delete_packers_entry(){
			   $month_year = $this->input->post('month_year'); 
               $employee_id  = $this->input->post('emp_id'); 
	        $this->db->where('month_year',$month_year);
	        $this->db->where('employee_id',$employee_id);
        $result=$this->db->delete('packers_entry');
        return $result;
	}
}	
?>