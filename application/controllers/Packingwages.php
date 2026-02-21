<?php
	
class Packingwages extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Packingwagesmodel');
    }
	
	function save_packingwages(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Packingwagesmodel->packingwages_save();			
			}
		else{
	  $data=$this->Packingwagesmodel->packingwages_update();			
			}
		
        echo json_encode($data);	
	}
	
	function show_packingwages(){
	    $data=$this->Packingwagesmodel->packingwages_show();			
        echo json_encode($data);	
	}
	function delete_packingwages(){
	    $data=$this->Packingwagesmodel->packingwages_delete();			
        echo json_encode($data);	
	}
	function packers_entry_show(){
	    $data=$this->Packingwagesmodel->show_packers_entry();			
        echo json_encode($data);	
	}
	
	function get_ptax(){
	    $data=$this->Packingwagesmodel->ptax_get_taxrate();			
        echo json_encode($data);	
	}
	
	function packers_entry_save(){

	$save_update = $this->input->post('save_update'); 

		if($save_update=="add")
		{
		    $data=$this->Packingwagesmodel->save_packers_entry();						
		}
		else{
		    $this->Packingwagesmodel->delete_packers_entry();									
		    $data=$this->Packingwagesmodel->save_packers_entry();									
		}
	    echo json_encode($data);	
	}
	
}	
?>