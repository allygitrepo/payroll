<?php
	
class Bidirollewages extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Bidirollewagesmodel');
    }
	
	function save_bidirollewages(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Bidirollewagesmodel->bidirollewages_save();			
			}
		else{
	  $data=$this->Bidirollewagesmodel->bidirollewages_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_bidirollewages(){
	    $data=$this->Bidirollewagesmodel->bidirollewages_show();      
		echo json_encode($data);	
	}
	function delete_bidirollewages(){
	    $data=$this->Bidirollewagesmodel->bidirollewages_delete();		
        echo json_encode($data);	
	}
	
	function show_bidi_roller_entry(){

	    $data=$this->Bidirollewagesmodel->bidi_roller_entry_show();      
		echo json_encode($data);	
	}
	
		function bidiroller_entry_save(){
	
		$id	=$this->input->post('id');
		if($id=="save"){
	
	    $data=$this->Bidirollewagesmodel->save_bidiroller_entry();			
	
		}
		else{
			$this->Bidirollewagesmodel->bidiroller_entry_delete();									
	  $data=$this->Bidirollewagesmodel->save_bidiroller_entry();			
			}

        echo json_encode($data);	
	}

}	
?>