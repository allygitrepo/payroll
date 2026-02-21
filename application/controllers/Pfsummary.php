<?php
	
class Pfsummary extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Pfsummarymodel');
    }
	
	function pfsummary_show(){
	    $data=$this->Pfsummarymodel->show_pfsummary();			
        echo json_encode($data);	
	}
	
}	
?>