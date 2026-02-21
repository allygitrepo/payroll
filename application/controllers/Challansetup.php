<?php
	
class Challansetup extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Challansetupmodel');
    }
	
	function save_challansetup(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Challansetupmodel->challansetup_save();			
			}
		else{
	  $data=$this->Challansetupmodel->challansetup_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_challansetup(){
	    $data=$this->Challansetupmodel->challansetup_show();			
        echo json_encode($data);	
	}
	function delete_challansetup(){
	    $data=$this->Challansetupmodel->challansetup_delete();			
        echo json_encode($data);	
	}
}	
?>