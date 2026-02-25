<?php
	
class Esicreport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Esicreportmodel');
    }
	
	function esicreport_show(){
	    $data=$this->Esicreportmodel->show_esicreport();			
        echo json_encode($data);	
	}
	
}	
?>
