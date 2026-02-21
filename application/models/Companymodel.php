<?php
class Companymodel extends CI_Model{


	    function company_save(){
		$date = date("Y/m/d");
		
        $data = array(
                'estb_id'  => strtoupper($this->input->post('estb_id')), 
                'name'  =>    strtoupper($this->input->post('esta_name')), 
                'type'  =>    strtoupper($this->input->post('estaType')), 
             'epfo_office' => strtoupper($this->input->post('underEpfo')), 
                 'lin_no'  => strtoupper($this->input->post('linNo')), 
             'address_id'  => strtoupper($this->input->post('address')), 
                    'pan'  => strtoupper($this->input->post('pan')), 
                    'tan'  => strtoupper($this->input->post('tan')), 
                   'p_tax' => strtoupper($this->input->post('pTax')), 
               'email_id'  => strtoupper($this->input->post('primaryEmail')), 
                  'phone'  => strtoupper($this->input->post('phone')), 
                  'website'  => strtoupper($this->input->post('website')), 
           'created_date'  => strtoupper($date), 
            );
//			strtoupper($data);
        $result=$this->db->insert('company_master',$data);
        return $result;
    }
	
function company_update(){

					$id		=strtoupper($this->input->post('id'));
                 $estb_id  = strtoupper($this->input->post('estb_id')); 
                    $name  = strtoupper($this->input->post('esta_name'));
                    $type  = strtoupper($this->input->post('estaType')); 
              $epfo_office = strtoupper($this->input->post('underEpfo')); 
                  $lin_no  = strtoupper($this->input->post('linNo')); 
              $address_id  = strtoupper($this->input->post('address')); 
                       $pan= strtoupper($this->input->post('pan')); 
                     $tan  = strtoupper($this->input->post('tan')); 
                    $p_tax = strtoupper($this->input->post('pTax')); 
                $email_id  = strtoupper($this->input->post('primaryEmail')); 
                   $phone  = strtoupper($this->input->post('phone')); 
                   $website  = strtoupper($this->input->post('website')); 
                
              $this->db->set('estb_id', $estb_id);
        $this->db->set('name', $name);
        $this->db->set('type', $type);
        $this->db->set('epfo_office', $epfo_office);
        $this->db->set('lin_no', $lin_no);
        $this->db->set('address_id', $address_id);
        $this->db->set('pan', $pan);
        $this->db->set('tan', $tan);
        $this->db->set('p_tax', $p_tax);
        $this->db->set('email_id', $email_id);
        $this->db->set('phone', $phone);
        $this->db->set('website', $website);
        $this->db->where('company_id', $id);
		
        $result=$this->db->update('company_master');
        return $result;
    }
		
    function company_delete(){
        $id =$this->input->post('id');
        $this->db->where('company_id', $id);
        $result=$this->db->delete('company_master');
        return $result;
    }

    function company_view(){
	
					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
//					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$query = $this->db->get();
	
        return $query->result();
    }
    function company_view_login(){
					$this->db->select(['name','estb_id']);    
					$this->db->from('company_master');
					$query = $this->db->get();
	
        return $query->result();
    }
}
?>