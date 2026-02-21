<?php
	
class Notescontroller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Notesmodel');
    }
	
	function save_notes(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Notesmodel->notes_save();			
			}
		else{
	  $data=$this->Notesmodel->notes_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_notes(){
	    $data=$this->Notesmodel->notes_show();			
        echo json_encode($data);	
	}
	
	function dashboard_show_notes(){
	    $data=$this->Notesmodel->notes_show_dashboard();			
        echo json_encode($data);	
	}
	
	
	

	function delete_notes(){
	    $data=$this->Notesmodel->notes_delete();			
        echo json_encode($data);	
	}






//challan date---------------


	function save_challan_date(){
	
		$id	=$this->input->post('id');
		
		if($id=="save"){
	    $data=$this->Notesmodel->challan_date_save();			
			}
		else{
	  $data=$this->Notesmodel->challan_date_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_challan_date(){
	    $data=$this->Notesmodel->challan_date_show();			
        echo json_encode($data);	
	}
	
	function delete_challan_date(){
	    $data=$this->Notesmodel->challan_date_delete();			
        echo json_encode($data);	
	}
	
	function delet_emonthentry(){
	    $data=$this->Notesmodel->emonthentry_delet();			
        echo json_encode($data);	
	}


	function dashboard_show_last_month(){
	    $data=$this->Notesmodel->show_last_month_dashboard();			
        echo json_encode($data);	
	}




	function challan_return_status(){
	    $data=$this->Notesmodel->challan_return_status_dashboard();			
        echo json_encode($data);	
	}


	
}	
?>