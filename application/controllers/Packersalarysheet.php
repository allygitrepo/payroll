<?php
	
class Packersalarysheet extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Packersalarysheetmodel');
    }
	
	function packersalarysheet_show(){
	    $data=$this->Packersalarysheetmodel->show_packersalarysheet();			
        echo json_encode($data);	
	}
	
}	
?>