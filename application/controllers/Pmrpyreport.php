<?php
	
class Pmrpyreport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Pmrpyreportmodel');
    }
	
	function pmrpyreport_show(){
	    $data=$this->Pmrpyreportmodel->show_pmrpyreport();			
        echo json_encode($data);	
	}
	
}	
?>