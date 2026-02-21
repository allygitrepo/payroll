<?php
	
class Calendercontroller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Calendermodel');
    }
	
	function save_calender(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Calendermodel->calender_save();			
			}
		else{
	  $data=$this->Calendermodel->calender_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_calender(){
	    $data=$this->Calendermodel->calender_show();			
        echo json_encode($data);	
	}
	function delete_calender(){
	    $data=$this->Calendermodel->calender_delete();			
        echo json_encode($data);	
	}
	
}	
?>