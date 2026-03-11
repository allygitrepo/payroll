<?php
	
class Officestaffsalary extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Officestaffsalarymodel');
    }
	
	function save_officestaffsalary(){
		$id	=$this->input->post('id');
		if($id=="add"){
	    $data=$this->Officestaffsalarymodel->officestaffsalary_save();			
			}
		else{
	  $data=$this->Officestaffsalarymodel->officestaffsalary_update();			
			}
        echo json_encode($data);	
	}
	
	function show_officestaffsalary(){
	    $data=$this->Officestaffsalarymodel->officestaffsalary_show();			
        echo json_encode($data);	
	}
	function delete_officestaffsalary(){
	    $data=$this->Officestaffsalarymodel->officestaffsalary_delete();			
        echo json_encode($data);	
	}
	function show_office_staff(){
	    $data=$this->Officestaffsalarymodel->officestaff_show();			
        echo json_encode($data);	
	}
	
	function show_office_staff_month(){
		log_message('debug', 'Request - show_office_staff_month: ' . json_encode($this->input->post()));
	    $data=$this->Officestaffsalarymodel->officestaff_show_month();			
		log_message('debug', 'Response - show_office_staff_month: ' . json_encode($data));
        echo json_encode($data);	
	}
	
	function save_office_staff_entry(){
					   $save_update = $this->input->post('save_update'); 
		log_message('debug', 'Request - save_office_staff_entry: ' . json_encode($this->input->post()));

		if($save_update=="0")
		{
	    $data=$this->Officestaffsalarymodel->office_staff_entry_save();						
		}	
		else{
	    $this->Officestaffsalarymodel->office_staff_entry_delete();									
	    $data=$this->Officestaffsalarymodel->office_staff_entry_save();						
		}
		log_message('debug', 'Response - save_office_staff_entry: ' . json_encode($data));
        echo json_encode($data);	
	}
	
}	
?>