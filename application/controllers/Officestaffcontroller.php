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
	function delete_notes(){
	    $data=$this->Notesmodel->notes_delete();			
        echo json_encode($data);	
	}
	
}	
?>