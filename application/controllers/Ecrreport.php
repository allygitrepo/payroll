<?php
	
class Ecrreport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Ecrreportmodel');
    }
	
	function ecrreport_show(){
	    $data=$this->Ecrreportmodel->show_ecrreport();			
        echo json_encode($data);	
	}
	
}	
?>