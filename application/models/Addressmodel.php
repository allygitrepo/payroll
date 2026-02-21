<?php
class Addressmodel extends CI_Model{
	
    function address_view(){
        $hasil=$this->db->get('address_master');
        return $hasil->result();
    }
 	
    function address_save(){
	
        $data = array(
                'address'  => strtoupper($this->input->post('address')), 
                'post_office'  => strtoupper($this->input->post('postoffice')), 
                'district'  => strtoupper($this->input->post('district')), 
                'pincode' => $this->input->post('pincode'), 
            );
        $result=$this->db->insert('address_master',$data);
        return $result;
    }
	
	function address_update(){

		$id			=$this->input->post('id');
        $address	=strtoupper($this->input->post('address'));
        $postoffice	=strtoupper($this->input->post('postoffice'));
        $district	=strtoupper($this->input->post('district'));
        $pincode	=$this->input->post('pincode');
 
        $this->db->set('address', $address);
        $this->db->set('post_office', $postoffice);
        $this->db->set('district', $district);
        $this->db->set('pincode', $pincode);
        $this->db->where('id', $id);
        $result=$this->db->update('address_master');
        return $result;
    }
	
    function address_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('address_master');
        return $result;
    }
	
	    function address_detail(){
		
		$id			=$this->input->post('id');
        $get=$this->db->get_where('address_master',['id' => $id]);
        return $get->result();
    }

}
?>