<?php


class AjaxImageUpload extends CI_Controller {


   /**
    * Manage __construct
    *
    * @return Response
   */
   public function __construct() { 
      parent::__construct(); 
      $this->load->helper(array('form','url')); 
   }


   /**
    * Manage index
    *
    * @return Response
   */
   public function index() { 
     $this->load->view('employee', array('error' => '' )); 
   } 


   /**
    * Manage uploadImage
    *
    * @return Response
   */
   public function uploadImage() { 
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
} 


?>