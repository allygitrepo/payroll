<?php
	
class Usermanagement extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        $this->load->model('Usermanagementmodel');
		
    }
	
	public function save_usermanagement(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
		  $data=$this->Usermanagementmodel->usermanagement_save();			
			}
		else{
			
			$this->Usermanagementmodel->rollmanagement_delete();
			
		  $data=$this->Usermanagementmodel->usermanagement_update();			
			}
		
        echo json_encode($data);	
	}
	
	public function view_usermanagement(){
		  $data=$this->Usermanagementmodel->usermanagement_view();
        echo json_encode($data);	
	}
	
	public function delete_usermanagement(){
		
					$this->Usermanagementmodel->rollmanagement_delete();

		  $data=$this->Usermanagementmodel->usermanagement_delete();
        echo json_encode($data);	
	}
	
	
	public function show_usermanagement(){
		  $data=$this->Usermanagementmodel->usermanagement_show();
        echo json_encode($data);	
	}
	

	
//get data for edit	
		public function edit_usermanagement(){
		  $data=$this->Usermanagementmodel->usermanagement_edit();
        echo json_encode($data);	
	}

	
}	
?>