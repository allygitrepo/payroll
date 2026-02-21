<?php
	
class Professionaltax extends CI_Controller{
	  
    function __construct(){
        parent::__construct();
       $this->load->model('Professionaltaxmodel');
    }
	
	function save_professionaltax(){
		     
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Professionaltaxmodel->professionaltax_save();
			}
		else{
	  $data=$this->Professionaltaxmodel->professionaltax_update();	
			}
        echo json_encode($data);	
	}
	
	function show_professionaltax(){
	    $data=$this->Professionaltaxmodel->professionaltax_show();			
        echo json_encode($data);	
	}
	function delete_professionaltax(){
	    $data=$this->Professionaltaxmodel->professionaltax_delete();			
        echo json_encode($data);	
	}
	function show_professionaltax_report(){
	    $data=$this->Professionaltaxmodel->professionaltax_report_show();			
        echo json_encode($data);	
	}
	
}	
?>