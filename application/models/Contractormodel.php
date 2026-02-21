<?php
class Contractormodel extends CI_Model{


	    function contractor_save(){
        $data = array(
                'ccode'  => strtoupper($this->input->post('ccode')), 
      'contractor_name'  => strtoupper($this->input->post('name')), 
   'contractor_address'  => strtoupper($this->input->post('address')), 
               'pf_code' => strtoupper($this->input->post('pfcode')), 
                  'doj'  => strtoupper($this->input->post('doj')), 
                  'pan'  => strtoupper($this->input->post('pan')), 
               'aadhar'  => strtoupper($this->input->post('adhar')), 
               'gst_no'  => strtoupper($this->input->post('gstno')), 
               'bank_ac' => strtoupper($this->input->post('bankac')), 
            'bank_name'  => strtoupper($this->input->post('bankname')), 
                 'ifsc'  => strtoupper($this->input->post('ifsc')), 
            );
        $result=$this->db->insert('contractor_master',$data);
        return $result;
    }
	
function contractor_update(){

				$id		=$this->input->post('id');
				$data = array(
                'ccode'  => strtoupper($this->input->post('ccode')), 
      'contractor_name'  => strtoupper($this->input->post('name')), 
   'contractor_address'  => strtoupper($this->input->post('address')), 
               'pf_code' => strtoupper($this->input->post('pfcode')), 
                  'doj'  => strtoupper($this->input->post('doj')), 
                  'pan'  => strtoupper($this->input->post('pan')), 
               'aadhar'  => strtoupper($this->input->post('adhar')), 
               'gst_no'  => strtoupper($this->input->post('gstno')), 
               'bank_ac' => strtoupper($this->input->post('bankac')), 
            'bank_name'  => strtoupper($this->input->post('bankname')), 
                 'ifsc'  => strtoupper($this->input->post('ifsc')), 
                );
				
        $this->db->set($data);
		$this->db->where('contractor_id', $id);
		
        $result=$this->db->update('contractor_master');
        return $result;
    }
		
    function contractor_delete(){
        $id =$this->input->post('id');
        $this->db->where('contractor_id', $id);
        $result=$this->db->delete('contractor_master');
        return $result;
    }

    function contractor_view(){
	
					$this->db->select('*');    
					$this->db->from('contractor_master');
					$this->db->join('address_master', 'contractor_master.contractor_address = address_master.id');
					$query = $this->db->get();
        return $query->result();
    }
	
	    function only_contractor_view(){
	
					$this->db->select('*');    
					$this->db->from('contractor_master');
//					$this->db->join('address_master', 'contractor_master.contractor_address = address_master.id');
					$query = $this->db->get();
        return $query->result();
    }
	 function ccode_name_check(){	
	  $ccode =$this->input->post('ccode');
	  $name =$this->input->post('name');
	  
			$this->db->where('ccode',strtoupper($ccode));
			$this->db->where('contractor_name',strtoupper($name));
			$query = $this->db->get('contractor_master');
			if ($query->num_rows() > 0){
				return 1;
			}
			else{
				return 0;
			}
	}
}
?>