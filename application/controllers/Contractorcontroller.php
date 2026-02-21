<?php
class Contractorcontroller extends CI_Controller {
	
		function __construct(){
        parent::__construct();
        $this->load->model('Contractormodel');
		
    }

		public function save_contractor(){
	
		$id	=$this->input->post('id');
		
			if($id=="add"){
				$data=$this->Contractormodel->contractor_save();			
				}
			else{
				$data=$this->Contractormodel->contractor_update();			
				}
		
        echo json_encode($data);	
	}
	
		public function view_contractor(){
		  $data=$this->Contractormodel->contractor_view();
        echo json_encode($data);	
	}
		public function view_only_contractor(){
		  $data=$this->Contractormodel->only_contractor_view();
        echo json_encode($data);	
	}
	
	public function delete_contractor(){
		  $data=$this->Contractormodel->contractor_delete();
        echo json_encode($data);	
	}

	public function check_ccode_name(){
		  $data=$this->Contractormodel->ccode_name_check();
        echo json_encode($data);	
	}

	



	
}	
?>