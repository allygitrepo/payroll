<?php
	
class Resignation extends CI_Controller{
	  
    function __construct(){
        parent::__construct();
       $this->load->model('Resignationmodel');
    }
	function search_employee(){
	    $data=$this->Resignationmodel->employee_search();			
        echo json_encode($data);	
	}

		
	function save_resignation(){
		     
		$id	=$this->input->post('id');
		if($id=="add"){
	    $data=$this->Resignationmodel->resignation_save();
			}
		else{
				$data=$this->Resignationmodel->resignation_update();	
			}
        echo json_encode($data);	
	}
	
	function show_resignation(){
	    $data=$this->Resignationmodel->resignation_show();			
        echo json_encode($data);	
	}
	function delete_resignation(){
	    $data=$this->Resignationmodel->resignation_delete();			
        echo json_encode($data);	
	}
	
}	
?>