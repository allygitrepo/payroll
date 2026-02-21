<?php
	
class Contractorsheet extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Contractorsheetmodel');
    }
	
	function contractorsalarysheet_show(){
	    $data=$this->Contractorsheetmodel->show_contractorsalarysheet();			
        echo json_encode($data);	
	}
	
}	
?>