<?php
class Challansetupmodel extends CI_Model{
	
 	    function challansetup_show(){
        $getdata=$this->db->get('challan_setup');
        return $getdata->result();
    }

	function challansetup_save(){

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
        $data = array(
                'from_date'  => $from_date, 
                'to_date'  => $to_date, 
                'salarylimit'  => $this->input->post('salarylimit'), 
                'edliwages'  => $this->input->post('edliwages'), 
                'ac1eemale' => $this->input->post('ac1eemale'), 
                'ac1eefemale'  => $this->input->post('ac1eefemale'), 
                'ac1er'  => $this->input->post('ac1er'), 
                'ac2' => $this->input->post('ac2'), 
                'ac10'  => $this->input->post('ac10'), 
                'ac21' => $this->input->post('ac21'), 
                'ac22'  => $this->input->post('ac22'), 
                'ac2min'  => $this->input->post('ac2min'), 
                'ac22min' => $this->input->post('ac22min'), 
                'pmrpy' => $this->input->post('pmrpy'), 
                'esic_wages' => $this->input->post('esic_wages'), 
                'employee_share' => $this->input->post('employee_share'), 
                'employer_share' => $this->input->post('employer_share'), 
            );
		$result=$this->db->insert('challan_setup',$data);
		
	return $result;
   
	}
		function challansetup_update(){

		$id = $this->input->post('id');

		$from_date = $this->input->post('startdate');
		$from_date = date("Y-m-d", strtotime($from_date));

		$to_date = $this->input->post('enddate');
		$to_date = date("Y-m-d", strtotime($to_date));
		
               $salarylimit  = $this->input->post('salarylimit'); 
                $edliwages  = $this->input->post('edliwages'); 
               $ac1eemale = $this->input->post('ac1eemale'); 
               $ac1eefemale  = $this->input->post('ac1eefemale'); 
               $ac1er  = $this->input->post('ac1er'); 
               $ac2 = $this->input->post('ac2'); 
               $ac10  = $this->input->post('ac10'); 
               $ac21 = $this->input->post('ac21'); 
               $ac22  = $this->input->post('ac22'); 
               $ac2min  = $this->input->post('ac2min'); 
               $ac22min = $this->input->post('ac22min'); 
               $pmrpy = $this->input->post('pmrpy'); 
               $esic_wages = $this->input->post('esic_wages'); 
               $employee_share = $this->input->post('employee_share'); 
               $employer_share = $this->input->post('employer_share'); 
            
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('salarylimit', $salarylimit);
        $this->db->set('edliwages', $edliwages);
        $this->db->set('ac1eemale', $ac1eemale);
        $this->db->set('ac1eefemale', $ac1eefemale);
        $this->db->set('ac1er', $ac1er);
        $this->db->set('ac2', $ac2);
        $this->db->set('ac10', $ac10);
        $this->db->set('ac21', $ac21);
        $this->db->set('ac22', $ac22);
        $this->db->set('ac2min', $ac2min);
        $this->db->set('ac22min', $ac22min);
        $this->db->set('pmrpy', $pmrpy);
        $this->db->set('esic_wages', $esic_wages);
        $this->db->set('employee_share', $employee_share);
        $this->db->set('employer_share', $employer_share);
        $this->db->where('challan_id', $id);
        $result=$this->db->update('challan_setup');

		return $result;
   
	}
	
	    function challansetup_delete(){
        $id =$this->input->post('id');
        $this->db->where('challan_id', $id);
        $result=$this->db->delete('challan_setup');
        return $result;
    }
	
	
	
	



}	
?>