<?php
	
class Officesalarysheet extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Officesalarysheetmodel');
    }
	
	function officesalarysheet_show(){
	    $data=$this->Officesalarysheetmodel->show_officesalarysheet();			
        echo json_encode($data);	
	}
	
}	
?>