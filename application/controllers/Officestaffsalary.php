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
		
	    $data=$this->Officestaffsalarymodel->officestaff_show_month();			
        echo json_encode($data);	
	}
	
	function save_office_staff_entry(){
					   $save_update = $this->input->post('save_update'); 

		if($save_update=="0")
		{
	    $data=$this->Officestaffsalarymodel->office_staff_entry_save();						
		}	
		else{
	    $this->Officestaffsalarymodel->office_staff_entry_delete();									
	    $data=$this->Officestaffsalarymodel->office_staff_entry_save();						
		}
        echo json_encode($data);	
	}
	
}	
?>