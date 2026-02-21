<?php
	
class Addresscontroller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
		
		
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		
		
        $this->load->model('Addressmodel');
		
    }
	
	public function save_address(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
		  $data=$this->Addressmodel->address_save();			
			}
		else{
		  $data=$this->Addressmodel->address_update();			
			}
		
        echo json_encode($data);	
	}
	
	public function view_address(){
		  $data=$this->Addressmodel->address_view();
        echo json_encode($data);	
	}
	
	public function delete_address(){
		  $data=$this->Addressmodel->address_delete();
        echo json_encode($data);	
	}
	
	
	public function get_address_detail(){
		  $data=$this->Addressmodel->address_detail();
        echo json_encode($data);	
	}
	
	
}	
?>