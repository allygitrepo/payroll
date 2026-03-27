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

							$month = date('m', strtotime('first day of last month'));
							$year = date('Y', strtotime('first day of last month'));
							$month_year = $month."/".$year;

	
				$query1 = $this->db->query('SELECT SUM(gross_wages) as total, COUNT(*) as emp FROM office_staff_entry WHERE month_year="'.$month_year.'"');						   
				$query2 = $this->db->query('SELECT SUM(gross_wages) as total, COUNT(*) as emp FROM packers_entry WHERE month_year="'.$month_year.'"');			
				$query3 = $this->db->query('
					SELECT COUNT(*) as emp, SUM(be.gross_wages + (be.unit_1_days * bw.bonus1) + (be.unit_2_days * bw.bonus2)) as total 
					FROM bidi_roller_entry be 
					INNER JOIN bidiroller_wages bw ON bw.id = be.bidiroller_wages_id 
					WHERE be.month_year = "'.$month_year.'"
				');			

				$os_netwages = isset($query1->row()->total) ? $query1->row()->total : 0;
				$os_emp = isset($query1->row()->emp) ? $query1->row()->emp : 0;
				
				$ps_netwages = isset($query2->row()->total) ? $query2->row()->total : 0;
				$ps_emp = isset($query2->row()->emp) ? $query2->row()->emp : 0;

				$br_netwages = isset($query3->row()->total) ? $query3->row()->total : 0;
				$br_emp = isset($query3->row()->emp) ? $query3->row()->emp : 0;
				
				
				
			$timestamp = strtotime('01-'.$month.'-'.$year);
			$last_month = date('M-Y', $timestamp); 

		array_push($result,$last_month,$os_netwages,$os_emp,$ps_netwages,$ps_emp,$br_netwages,$br_emp);	

		return $result;	
    }


	

		    function challan_return_status_dashboard(){
				
			$result = array();

							$month = date('m', strtotime('first day of last month'));
							$year = date('Y', strtotime('first day of last month'));
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