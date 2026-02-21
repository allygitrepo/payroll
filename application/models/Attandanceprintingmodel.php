<?php
class Attandanceprintingmodel extends CI_Model{
	
    
	    function attendance_sheet_print(){

	
		$contractor1 = $this->input->post('contractor1');
		
					$contractor_name = "";
//					$contractor1 = "all";
		$result = array();			
		if($contractor1=="all"){

				$this->db->select(['contractor_master.contractor_name','contractor_master.contractor_id']);    
					$this->db->from('contractor_master');
					$getcontractor=$this->db->get();
		foreach($getcontractor->result() as $contractor_Data)
		{
					$contractor = $contractor_Data->contractor_id;
					$contractor_name = $contractor_Data->contractor_name;
			
		$this->db->select(['employee_master.contractor','employee_master.emp_id','employee_master.name_as_aadhaar','employee_master.status','employee_master.member_id']);    
					$this->db->from('employee_master');
					$this->db->where('employee_master.employee_type','BIDI MAKER');
					$this->db->order_by("employee_master.member_id", "asc");
					$this->db->where('employee_master.contractor',$contractor);						
					$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);

					$getdata=$this->db->get();
		foreach($getdata->result() as $table_Data)
		{
					$emp_id = $table_Data->emp_id;
					$member_id = $table_Data->member_id;
					$contractor = $table_Data->contractor;
		//			$contractor_name = $table_Data->contractor_name;
					$name_as_aadhaar = $table_Data->name_as_aadhaar;
					$status = $table_Data->status;
		

					
					
		$month_year = $this->input->post('month_year');
//			$month_year = "05-2018";
		$date1 = explode("-",$month_year);		

		$list=array();
		$month = $date1[0];
		$year = $date1[1];
				$holidayDate = "";
				
					$count_resign = 0;	
					
	   if($status==0){
		   $date_leave = $year."-".$month."-01";
			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and leaving_date <"'.$date_leave.'"    ');
			$count_resign = $query6->num_rows();
		}	
		
				
				
				
$query2 = $this->db->query('select week_day from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
	$week_day = $query2->row()->week_day;		   

/*
							if($week_day=="Monday")	    {$day = 1; }
							if($week_day=="Tuesday")   { $day = 2; }
							if($week_day=="Wednesday") { $day = 3; }
							if($week_day=="Thursday")  { $day = 4; }
							if($week_day=="Friday")    { $day = 5; }
							if($week_day=="Saturday")  { $day = 6; }
							if($week_day=="Sunday")    { $day = 0; }
*/		
		
//				 $startTime = strtotime($from);
//				 $endTime =  strtotime($to);
						
				
  		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
				$findday=date('Y-m-d', $time);
			$timestamp = strtotime($findday);
			$day1 = date('l', $timestamp);
			
			if($week_day==$day1){
				$holidayDate .= "*".$findday;			
			}
		}
		$n = count($list);
		$from = $list[0];
		$to = $list[$n-1];
		
			
				
		$query1 = $this->db->query('select holiday_date from calender_master where holiday_type!="WEEKLY" and holiday_date between "'.$from.'" and "'.$to.'" ');
		foreach($query1->result() as $h_date)
		{			
					$hdate = $h_date->holiday_date;
					$holidayDate .= "*".$hdate;
		}
					$row = $emp_id.'####'.$contractor_name.'####'.$name_as_aadhaar.'####'.$holidayDate.'####'.$n;
					
					if($count_resign==0){
						array_push($result,$row);
					}	

		}			
		
		
			
		}
		
		}
		else{

		$this->db->select(['employee_master.contractor','employee_master.emp_id','employee_master.name_as_aadhaar','contractor_master.contractor_name','employee_master.status','employee_master.member_id']);    
					$this->db->from('employee_master');
					$this->db->join('contractor_master','contractor_master.contractor_id = employee_master.contractor');
					$this->db->where('employee_master.employee_type','BIDI MAKER');
					$this->db->order_by("employee_master.member_id", "asc");
					if(($contractor1!="")||($contractor1!=null)){
					$this->db->where('employee_master.contractor',$contractor1);						
					$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);
					}
					$getdata=$this->db->get();
		foreach($getdata->result() as $table_Data)
		{
			
					$emp_id = $table_Data->emp_id;
					$member_id = $table_Data->member_id;
					$contractor = $table_Data->contractor;
					$contractor_name = $table_Data->contractor_name;
					$name_as_aadhaar = $table_Data->name_as_aadhaar;
					$status = $table_Data->status;
					
					
		$month_year = $this->input->post('month_year');
//			$month_year = "06-2018";
		$date1 = explode("-",$month_year);		

		$list=array();
		$month = $date1[0];
		$year = $date1[1];
				$holidayDate = "";
				
		$count_resign = 0;	
					
	   if($status==0){
		   
		   $date_leave = $year."-".$month."-01";

			$query6 = $this->db->query('select leaving_date from resignation_master where member_id="'.$member_id .'"  and leaving_date <"'.$date_leave.'"    ');
			$count_resign = $query6->num_rows();	
		}	
		
		
				
$query2 = $this->db->query('select week_day from calender_master where holiday_type="WEEKLY" and year="'.$year.'" ');
	$week_day = $query2->row()->week_day;		   

/*
							if($week_day=="Monday")	    {$day = 1; }
							if($week_day=="Tuesday")   { $day = 2; }
							if($week_day=="Wednesday") { $day = 3; }
							if($week_day=="Thursday")  { $day = 4; }
							if($week_day=="Friday")    { $day = 5; }
							if($week_day=="Saturday")  { $day = 6; }
							if($week_day=="Sunday")    { $day = 0; }
*/		
		
//				 $startTime = strtotime($from);
//				 $endTime =  strtotime($to);
						
				
  		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
				$findday=date('Y-m-d', $time);
			$timestamp = strtotime($findday);
			$day1 = date('l', $timestamp);
			
			if($week_day==$day1){
				$holidayDate .= "*".$findday;			
			}
		}
		$n = count($list);
		$from = $list[0];
		$to = $list[$n-1];
		
			
				
		$query1 = $this->db->query('select holiday_date from calender_master where holiday_type!="WEEKLY" and holiday_date between "'.$from.'" and "'.$to.'" ');
		foreach($query1->result() as $h_date)
		{			
					$hdate = $h_date->holiday_date;
					$holidayDate .= "*".$hdate;
		}
					$row = $emp_id.'####'.$contractor_name.'####'.$name_as_aadhaar.'####'.$holidayDate.'####'.$n;
					
							if($count_resign==0){
						array_push($result,$row);
					}	

					
		}			
		
		
		}


        return $result;
    }
	
    function get_calender_data(){
		$month_year = $this->input->post('month_year');
//		        return $month_year;


		$date1 = explode("-",$month_year);		

		$list=array();
		$month = $date1[0];
		$year = $date1[1];
  		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
		}
		$n = count($list);
		$from = $list[0];
		$to = $list[$n-1];
		
		$query = $this->db->query('select * from calender_master where ( holiday_type="WEEKLY" and year="'.$year.'" ) or ( holiday_type != "WEEKLY" and holiday_date between "'.$from.'" and "'.$to.'" )');  
		
        return $query->result();
   }
	
}
?>