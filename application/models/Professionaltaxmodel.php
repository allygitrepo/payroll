<?php
class Professionaltaxmodel extends CI_Model{
	
 	    function professionaltax_show(){
        $getdata=$this->db->get('professional_tax');
        return $getdata->result();
    }

	function professionaltax_save(){
                $from  = $this->input->post('from'); 
                $to = $this->input->post('to'); 

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
					
//	$this->db->where(' from >= "'.$from.'" and to >= "'.$to.'"  ');
//	$this->db->where(' "'.$from_date.'"   BETWEEN from_date and to_date ');
//	$this->db->or_where('    "'.$to_date.'"   BETWEEN from_date and to_date ');
//	$this->db->or_where('    from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
//	$this->db->or_where(' to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
//		$this->db->from('professional_tax');
//		$check = $this->db->count_all_results();
		
	$query = 'select `from_date` from professional_tax where ("'.$from_date.'" BETWEEN from_date and to_date or "'.$to_date.'" BETWEEN from_date and to_date or from_date BETWEEN "'.$from_date.'" and "'.$to_date.'" or to_date BETWEEN "'.$from_date.'" and "'.$to_date.'") and ( "'.$from.'" BETWEEN `from` and `to` or "'.$to.'" BETWEEN `from` and `to` or `from` BETWEEN  "'.$from.'" and "'.$to.'" or `to` BETWEEN  "'.$from.'" and  "'.$to.'")';		
	$check = $this->db->query($query);
//$check = $this->db->count_all_results();
   $check= $check->result();
   
	if(count($check) > 0){
	$result = 0;
	}
	else{
        $data = array(
                'from_date'  => $from_date, 
                'to_date'  => $to_date, 
                'from'  => $this->input->post('from'), 
                'to' => $this->input->post('to'), 
                'tax_rate'  => $this->input->post('taxrate'), 
            );
		$result=$this->db->insert('professional_tax',$data);
		}
	return $result;
   
	}
		function professionaltax_update(){

		$id = $this->input->post('id');

		                $from = $this->input->post('from'); 
                $to = $this->input->post('to'); 

				
		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
	$query = 'select `from_date` from professional_tax where ( `id` != "'.$id.'" ) and ("'.$from_date.'" BETWEEN from_date and to_date or "'.$to_date.'" BETWEEN from_date and to_date or from_date BETWEEN "'.$from_date.'" and "'.$to_date.'" or to_date BETWEEN "'.$from_date.'" and "'.$to_date.'") and ( "'.$from.'" BETWEEN `from` and `to` or "'.$to.'" BETWEEN `from` and `to` or `from` BETWEEN  "'.$from.'" and "'.$to.'" or `to` BETWEEN  "'.$from.'" and  "'.$to.'")';		
	$check = $this->db->query($query);
//$check = $this->db->count_all_results();
   $check= $check->result();
		
		if(count($check) > 0){
		$result = 0;
		}
		else{
                $taxrate = $this->input->post('taxrate'); 
           
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('from', $from);
        $this->db->set('to', $to);
        $this->db->set('tax_rate', $taxrate);
        $this->db->where('id', $id);
        $result=$this->db->update('professional_tax');
		}
	return $result;
   
	}
	
	    function professionaltax_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('professional_tax');
        return $result;
    }
	
	/*    function professionaltax_report_show1(){
				$month_year = "";
			
			$month_year = $this->input->post('month_year');
		if($month_year=="")
		{
				$date = date('Y-m-d');
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $date1[0];
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
			
		}
		else{
				$date = $month_year."-01-01";
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $month_year;	   
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
		}
	

			
		$result = array();
		$query = $this->db->query('select * from professional_tax where ( from_date between "'.$first.'" and "'.$last.'" ) or ( to_date between "'.$first.'" and "'.$last.'")' );
for($i=1;$i<=12;$i++){
		foreach($query->result() as $kyc)
		{
		   $from_date = $kyc->from_date;
		   $to_date = $kyc->to_date;
		   $from = $kyc->from;
		   $to = $kyc->to;
		   $tax_rate = $kyc->tax_rate;
		   $tax_id = $kyc->id;
		   
	
		   
		$query1 = $this->db->query('select count(*) as cnt from office_staff_salary where ( salary between "'.$from.'" and "'.$to.'" ) and ( from_date between "'.$from_date.'" and "'.$to_date.'" ) and  ( to_date between "'.$from_date.'" and "'.$to_date.'") ');
		$count1=$query1->row()->cnt;
 
 if($from_date > $first){	$start = new DateTime($from_date);	}
else{ 	$start = new DateTime($first);	 } 

 if($to_date < $last){	$end = new DateTime($to_date);	}
else{ 	$end = new DateTime($last);	 } 

			$start->modify('first day of this month');
//			$end      = new DateTime($to_date);
			$end->modify('first day of next month');
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);
			$monty_all = "";
			$tax_amount = 0;
			$tax_amount = ($tax_rate)*($count1);
			
	if($i==1  ){$month_name="April";}			
elseif($i==2  ){$month_name="May";}
elseif($i==3  ){$month_name="June";}
elseif($i==4 ){$month_name="July";}
elseif($i==5 ){$month_name="August";}
elseif($i==6 ){$month_name="September";}
elseif($i==7 ){$month_name="October";}
elseif($i==8 ){$month_name="November";}
elseif($i==9 ){$month_name="December";}
elseif($i==10){$month_name="January";}
elseif($i==11){$month_name="February";}
elseif($i==12){$month_name="March";}

	
			foreach ($period as $dt){
					if(($dt->format("F"))==$month_name){
						
				
						
						
						$row =  $dt->format("F").'####'.$from.'####'.$to.'####'.$tax_rate.'####'.$year.'####'.$count1.'####'.round($tax_amount);
						array_push($result,$row);					
					}					
				}
		}
}	
			return $result;	
   }	
 */  
   function professionaltax_report_show(){
				$month_year = "";
			
			$month_year = $this->input->post('month_year');
		if($month_year=="")
		{
				$date = date('Y-m-d');
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $date1[0];
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
			
		}
		else{
				$date = $month_year."-01-01";
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $month_year;	   
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
		}
	

			
		$result = array();

	$start    = (new DateTime($first));
	$end      = (new DateTime($last));
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);

	$month_head = '';
	
	


		foreach ($period as $dt) {
			
		$query = $this->db->query('select * from professional_tax where ( from_date between "'.$first.'" and "'.$last.'" ) or ( to_date between "'.$first.'" and "'.$last.'")' );
		foreach($query->result() as $kyc)
		{
		   $from_date = $kyc->from_date;
		   $to_date = $kyc->to_date;
		   $from = $kyc->from;
		   $to = $kyc->to;
		   $tax_rate = $kyc->tax_rate;
		   $tax_id = $kyc->id;
			
			
			
			$head = $dt->format("F");
			
			$entrymonth = $dt->format("m/Y");
			$check_date = $dt->format("Y-m-15");
		   
			$query1 = $this->db->query('select oe.gross_wages from office_staff_entry oe inner join employee_master em on em.emp_id=oe.employee_id where oe.month_year="'.$entrymonth.'" and ( oe.gross_wages between "'.$from.'" and "'.$to.'" )   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   ');						   
			foreach($query1->result() as $officestaff)
			{
				$office_total = $officestaff->gross_wages;
				$office_tax = $tax_rate;
			}
			$query2 = $this->db->query('select oe.gross_wages from packers_entry oe inner join employee_master em on em.emp_id=oe.employee_id   where oe.month_year="'.$entrymonth.'" and ( oe.gross_wages between "'.$from.'" and "'.$to.'" ) and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  ');						   
			foreach($query2->result() as $packers)
			{
				$packers_total = $packers->gross_wages;
				$packers_tax = $tax_rate;
			}
			
			$count1 = $query1->num_rows();
			$count2 = $query2->num_rows();
			$count = $count1+$count2; 
			$tax_amount = $count*$tax_rate;
			
			$row =  $head.'####'.$from.'####'.$to.'####'.$tax_rate.'####'.$year.'####'.$count.'####'.$tax_amount;
			array_push($result,$row);			   
		} 
			
			
		
		}
			return $result;	
   }	
}	
?>