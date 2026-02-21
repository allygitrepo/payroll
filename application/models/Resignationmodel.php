<?php
class Resignationmodel extends CI_Model{
	
   function employee_search(){
		$id = $this->input->post('member_id');
	   
	   $this->db->select(['UAN','name_as_aadhaar','father_husband']);    
					$this->db->from('employee_master');
					$this->db->where('member_id',$id) ;
					$this->db->where('status','1');
					$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);
					$getdata=$this->db->get();	
	     return $getdata->result();
    }	
	
 	    function resignation_show(){
	   $this->db->select(['employee_master.UAN','employee_master.name_as_aadhaar','employee_master.father_husband','resignation_master.*']);    
					$this->db->from('resignation_master');
					$this->db->join('employee_master', 'resignation_master.member_id = employee_master.member_id');
					$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);
					$getdata=$this->db->get();	
	     return $getdata->result();
    }


	function resignation_save(){
		$leaving_date = $this->input->post('leaving_date');
		$member_id = $this->input->post('member_id');
		$reason = $this->input->post('reason');
		$leaving_date = date("Y-m-d", strtotime($leaving_date));
		
		
        $this->db->set('status','0');
        $this->db->where('member_id', $member_id);
        $this->db->update('employee_master');

		
		
        $data = array(
                'member_id'  => $member_id, 
				'leaving_date'  => $leaving_date, 
                'reason'  => $reason, 
            );
		$result=$this->db->insert('resignation_master',$data);
	return $result;
   
	}
	
		function resignation_update(){

		$id = $this->input->post('id');
		$leaving_date = $this->input->post('leaving_date');
		$member_id = $this->input->post('member_id');
		$reason = $this->input->post('reason');
		$leaving_date = date("Y-m-d", strtotime($leaving_date));
		 
        $this->db->set('member_id', $member_id);
        $this->db->set('leaving_date', $leaving_date);
        $this->db->set('reason', $reason);
        $this->db->where('resignation_id', $id);
        $result=$this->db->update('resignation_master');
		
		return $result;
   
	}
	
	    function resignation_delete(){
        $id =$this->input->post('id');
		
	   $this->db->select(['member_id']);    
					$this->db->from('resignation_master');
					$this->db->where('resignation_id', $id);
					$getdata=$this->db->get();	
	     $getdata->result();
		 foreach($getdata->result() as $employee){
			 $member_id = $employee->member_id;
		 }
		if(isset($member_id)){
		 $this->db->set('status','1');
        $this->db->where('member_id', $member_id);
        $this->db->update('employee_master');
		}	
		 

		
        $this->db->where('resignation_id', $id);
        $result=$this->db->delete('resignation_master');
        return $result;
    }


}	
?>