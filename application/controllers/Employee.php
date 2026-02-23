<?php
	
class Employee extends CI_Controller{
	
    function __construct(){
        parent::__construct();
      $this->load->helper(array('form')); 
       $this->load->model('Employeemodel');
    }
	
	function save_employee(){
	
		$id	=$this->input->post('id');
		
		if($id=="add"){
	    $data=$this->Employeemodel->employee_save();			
			}
		else{
	  $data=$this->Employeemodel->employee_update();			
			}
		
        echo json_encode($data);	
	}
	function save_kyc_detail(){
		$data=$this->Employeemodel->kyc_detail_save();			
        echo json_encode($data);	
	}
	
	function save_nominee_detail(){
		$data=$this->Employeemodel->nominee_detail_save();			
        echo json_encode($data);	
	}
	
	function save_family_detail(){
		$data=$this->Employeemodel->family_detail_save();			
        echo json_encode($data);	
	}
	
	
	function show_employee(){
	    $data=$this->Employeemodel->employee_show();			
        echo json_encode($data);	
	}
	function show_employee_export(){
	    $data=$this->Employeemodel->employee_export_show();			
        echo json_encode($data);	
	}
	
	function show_employee_detail(){
			$data=$this->Employeemodel->employee_detail_show();			
        echo json_encode($data);	
	}

	
	function view_kyc_detail(){
	    $data=$this->Employeemodel->kyc_detail_view();			
        echo json_encode($data);	
	}
	function view_kyc_detail_export(){
	    $data=$this->Employeemodel->kyc_detail_export_view();			
        echo json_encode($data);	
	}
	function view_nominee_detail(){
	    $data=$this->Employeemodel->nominee_detail_view();			
        echo json_encode($data);	
	}
	function view_family_detail(){
	    $data=$this->Employeemodel->family_detail_view();			
        echo json_encode($data);	
	}
	function delete_employee(){
	    $data=$this->Employeemodel->employee_delete();			
        echo json_encode($data);	
	}

	function update_abry_details(){
	    $data=$this->Employeemodel->update_abry_details();			
        echo json_encode($data);	
	}
	 public function uploadImage(){ 
      header('Content-Type: application/json');
      $config['upload_path']   = './uploads/'; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $config['max_size']      = 1024*10;
      $this->load->library('upload', $config);
		
      if ( ! $this->upload->do_upload('image')) {
         $error = array('error' => $this->upload->display_errors()); 
         echo json_encode($error);
      }else { 
         $data = $this->upload->data();
         $success = ['success'=>$data['file_name']];
         echo json_encode($success);
      } 
   }
   	public function employee_image_upload()
	{
		$this->load->helper("file");	
		$this->load->library("upload");
		
		if ($_FILES['uploadFile_emp']['size'] > 0) {
			// Get IP number from POST, use timestamp as fallback
			$ip_number = $this->input->post('ip_number');
			if(empty($ip_number)){
				$ip_number = 'emp_' . time();
			}
			
			// Configure upload with temporary name
			$config = array( 
		       "upload_path" => './assets/images/employee/profile/',
		       "overwrite" => TRUE,
		       "max_filename" => 300,
		       "remove_spaces" => TRUE,
		       "allowed_types" => 'jpg|jpeg|png|gif',
		       "max_size" => 30000,
		       "file_name" => 'temp_' . time()
		    );
			
			$this->upload->initialize($config);

		   if (!$this->upload->do_upload('uploadFile_emp')) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
			return;
		}

		    $upload_data = $this->upload->data();
			$source_path = $upload_data['full_path'];
			$extension = $upload_data['file_ext'];
			
			// New filename with IP number or fallback
			$new_filename = $ip_number . $extension;
			$destination_path = './assets/images/employee/profile/' . $new_filename;
			
			// Compress and resize image
			$this->load->library('image_lib');
			
			$config_resize = array(
				'image_library' => 'gd2',
				'source_image' => $source_path,
				'new_image' => $destination_path,
				'maintain_ratio' => TRUE,
				'width' => 800,
				'height' => 800,
				'quality' => '60%'
			);
			
			$this->image_lib->initialize($config_resize);
			
			if (!$this->image_lib->resize()) {
				// If resize fails, just rename the file
				rename($source_path, $destination_path);
			} else {
				// Delete temporary file if resize succeeded
				if(file_exists($source_path) && $source_path != $destination_path){
					unlink($source_path);
				}
			}
			
			$this->image_lib->clear();
			
			echo json_encode($new_filename);	
		}else{
			echo json_encode(array('error' => 'No file uploaded')); 
		}
		
		
	}
		
	function show_kyc_export(){
	    $data=$this->Employeemodel->kyc_export_show();			
        echo json_encode($data);	
	}
	function get_employee_name(){
	    $data=$this->Employeemodel->employee_name_get();			
        echo json_encode($data);	
	}
	function search_kyc_details(){
	    $data=$this->Employeemodel->kyc_details_search();			
        echo json_encode($data);	
	}
	
	function delete_kyc_detail(){
	    $data=$this->Employeemodel->kyc_detail_delete();			
        echo json_encode($data);	
	}

	function check_mobileno(){
	    $data=$this->Employeemodel->mobileno_check();			
        echo json_encode($data);	
	}
	function search_employee_export(){
	    $data=$this->Employeemodel->employee_export_search();			
        echo json_encode($data);	
	}
	function get_employee_name_from_date(){
	    $data=$this->Employeemodel->employee_name_from_date_get();			
        echo json_encode($data);	
	}
	function search_imssing_details(){
	    $data=$this->Employeemodel->imssing_details_search();			
        echo json_encode($data);	
	}

	function update_email_address(){
	    $data=$this->Employeemodel->email_address_update();			
        echo json_encode($data);	
	}
	
	
	
	function save_kyc_detailkycupdate(){
		$data=$this->Employeemodel->kyc_detail_save_kycupdate();			
        echo json_encode($data);	
	}
	

}	
?>