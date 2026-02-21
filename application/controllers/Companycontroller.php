<?php
class Companycontroller extends CI_Controller {
	
		function __construct(){
        parent::__construct();
		
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		
        $this->load->model('Companymodel');
		
    }

		public function save_company(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
		  $data=$this->Companymodel->company_save();			
			}
		else{
		  $data=$this->Companymodel->company_update();			
			}
		
        echo json_encode($data);	
	}
	
		public function view_company(){
		  $data=$this->Companymodel->company_view();
        echo json_encode($data);	
	}
		
	public function delete_company(){
		  $data=$this->Companymodel->company_delete();
        echo json_encode($data);	
	}
	public function login_view_company(){
			$data=$this->Companymodel->company_view_login();
        echo json_encode($data);	
	}


		




	
}	
?>