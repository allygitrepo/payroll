<?php
class notesmodel extends CI_Model{
	
 	    function notes_show(){
        $getdata=$this->db->get('notes_master');
        return $getdata->result();
    }


	function notes_save(){

		$from_date = $this->input->post('note_date');
		$note_date = date("Y-m-d", strtotime($from_date));

					
        $data = array(
                'note_date'  => $note_date, 
                'note'  => strtoupper($this->input->post('note')), 
            );
		$result=$this->db->insert('notes_master',$data);
	return $result;
   
	}
		function notes_update(){

		$id = $this->input->post('id');
$from_date = $this->input->post('note_date');
		$note_date = date("Y-m-d", strtotime($from_date));

		        $note = strtoupper($this->input->post('note')); 
           
        $this->db->set('note_date', $note_date);
        $this->db->set('note', $note);
        $this->db->where('id', $id);
        $result=$this->db->update('notes_master');
		
	return $result;
   
	}
	
	    function notes_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('notes_master');
        return $result;
    }

	function challan_date_save(){
		
		
		
		$ddate = $this->input->post('ddate1');
		$cdate = $this->input->post('cdate1');
		$rdate = $this->input->post('rdate');
		
//		$ddate = date("Y-m-d", strtotime($ddate1));
//		$cdate = date("Y-m-d", strtotime($cdate1));
		                                 
//		$rdate = date("Y-m-d", strtotime($rdate1));
        $data = array(
					'ttrn'			=>$this->input->post('ttrn1'), 
					'crn_no'		=>$this->input->post('crnno1'), 
					'wage_month'	=>$this->input->post('wagemonth1'),
					'due_date'		=>$ddate,
					'challan_date'	=>$cdate, 
					'ac1ee'			=>$this->input->post('ac1'), 
					'ac1er'			=>$this->input->post('ac1er'), 
					'ac2'			=>$this->input->post('ac2'),
					'ac10'			=>$this->input->post('ac10'), 
					'ac21'			=>$this->input->post('ac21'),
					'ac22'			=>$this->input->post('ac22'),
					'total_amount'	=>$this->input->post('tamount'),
					'return_date'	=>$rdate,
            );
		$result=$this->db->insert('challan_date_entry',$data);
	return $result;
   
	}
		function challan_date_update(){

		$id = $this->input->post('id');
		$ddate = $this->input->post('ddate1');
		$cdate = $this->input->post('cdate1');
		$rdate = $this->input->post('rdate');

//		$ddate = date("Y-m-d", strtotime($ddate1));
//		$cdate = date("Y-m-d", strtotime($cdate1));
		                                 
//		$rdate = date("Y-m-d", strtotime($rdate1));
		
					$ttrn			= $this->input->post('ttrn1'); 
					$crn_no			= $this->input->post('crnno1'); 
					$wage_month		= $this->input->post('wagemonth1');
					$due_date		= $ddate;
					$challan_date	= $cdate; 
					$ac1ee			= $this->input->post('ac1'); 
					$ac1er			= $this->input->post('ac1er'); 
					$ac2			= $this->input->post('ac2');
					$ac10			= $this->input->post('ac10'); 
					$ac21			= $this->input->post('ac21');
					$ac22			= $this->input->post('ac22');
					$total_amount	= $this->input->post('tamount');
					$return_date	= $rdate;
           
        $this->db->set('ttrn', $ttrn);
        $this->db->set('crn_no', $crn_no);
        $this->db->set('wage_month', $wage_month);
        $this->db->set('due_date', $due_date);
        $this->db->set('challan_date', $challan_date);
        $this->db->set('ac1ee', $ac1ee);
        $this->db->set('ac1er', $ac1er);
        $this->db->set('ac2', $ac2);
        $this->db->set('ac10', $ac10);
        $this->db->set('ac21', $ac21);
        $this->db->set('ac22', $ac22);
        $this->db->set('total_amount', $total_amount);
        $this->db->set('return_date', $return_date);
        $this->db->where('challan_date_id', $id);
        $result=$this->db->update('challan_date_entry');
		
	
	return $result;
  
	}
	
	
	
   function challan_date_show(){
        $getdata=$this->db->get('challan_date_entry');
        return $getdata->result();
    }
	
	
		    function challan_date_delete(){
        $id =$this->input->post('id');
        $this->db->where('challan_date_id', $id);
        $result=$this->db->delete('challan_date_entry');
        return $result;
    }

		    function emonthentry_delet(){
				
        $month_year1 =$this->input->post('month_year1');
        $employee_type =$this->input->post('employee_type');
		
		if($employee_type=="OFFICE STAFF")
		{
        $this->db->where('month_year',$month_year1);
        $result=$this->db->delete('office_staff_entry');			
		}	
		elseif($employee_type=="BIDI MAKER")
		{
        $this->db->where('month_year',$month_year1);
        $result=$this->db->delete('bidi_roller_entry');						
		}
		elseif($employee_type=="BIDI PACKER")
		{
        $this->db->where('month_year',$month_year1);
        $result=$this->db->delete('packers_entry');						
		}

        return $result;
    }
	
	
	 	    function notes_show_dashboard(){
			$tdate = date('Y-m-d', strtotime('+1 month'));
			$fdate = date('Y-m-d');
  $getdata = $this->db->query('SELECT * FROM notes_master where note_date between  "'.$fdate.'" and "'.$tdate.'"    ');
        return $getdata->result();
    }


	
		    function show_last_month_dashboard(){
			$result = array();

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

	
				$query1 = $this->db->query('select sum(gross_wages) as total,count(net_wages) as emp from office_staff_entry where month_year="'.$month_year.'" ');						   
				$query2 = $this->db->query('select sum(gross_wages) as total,count(net_wages) as emp from packers_entry where  month_year="'.$month_year.'" ');			
$br_emp = 0;
$total_amount = 0;
		$query3 = $this->db->query('select be.gross_wages,bw.bonus1,bw.bonus2,be.unit_1_days,be.unit_2_days from bidi_roller_entry be inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id where  be.month_year="'.$month_year.'" ');			
//		$query2 = $this->db->query('select bonus1,bonus2 from bidiroller_wages where "'.$lmfd.'" between from_date and to_date ORDER BY from_date,to_date  DESC LIMIT 1  ');
		foreach($query3->result() as $bidiroller)
		{
		   $wages = $bidiroller->gross_wages;
		   $bonus1 = $bidiroller->bonus1;
		   $bonus2 = $bidiroller->bonus2;		   
		   $unit_1_days = $bidiroller->unit_1_days;		   
		   $unit_2_days = $bidiroller->unit_2_days;		
			   
			$bonus = ($unit_1_days*$bonus1)+($unit_2_days*$bonus2);
			$total = $wages+$bonus;
			$total_amount = $total_amount + $total;
			$br_emp = $br_emp+1;
		   
		}

		$br_netwages = $total_amount;

				$os_netwages = $query1->row()->total;
				if($os_netwages==""){ $os_netwages=0; }
				$ps_netwages = $query2->row()->total;
				if($ps_netwages==""){ $ps_netwages=0; }

				$os_emp = $query1->row()->emp;
				$ps_emp = $query2->row()->emp;
				
				
				
			$timestamp = strtotime('01-'.$month.'-'.$year);
			$last_month = date('M-Y', $timestamp); 

		array_push($result,$last_month,$os_netwages,$os_emp,$ps_netwages,$ps_emp,$br_netwages,$br_emp);	

		return $result;	
    }


	

		    function challan_return_status_dashboard(){
				
			$result = array();

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

		$challan_date ="";
		$return_date = "";
	
	$query1 = $this->db->query('select challan_date,return_date from challan_date_entry where wage_month="'.$month_year.'" ');
	foreach($query1->result() as $challandate){
		$challan_date = $challandate->challan_date;
		$return_date = $challandate->return_date;
	}	
if($challan_date==""){ $cdate="-";
 $challan = "Pending"; 
 }
elseif($challan_date=="0000-00-00"){ 
$cdate="-";
 $challan = "Pending"; 
 	}				
 				
else{
	$cdate=$challan_date;
	$challan = "Filed"; 

 	}	

if($return_date==""){

$rdate="-";
 $return = "Pending"; 
 }
elseif($return_date=="0000-00-00"){ 
$rdate="-";
 $return = "Pending"; 
 	}				
 					
else{
	$rdate=$return_date;
	$return = "Filed"; 

 	}	


	
			$timestamp = strtotime('01-'.$month.'-'.$year);
			$last_month = date('M-Y', $timestamp); 

		array_push($result,$last_month,$challan,$cdate,$return,$rdate);	
		return $result;	
    
	}


	
	
}	
?>