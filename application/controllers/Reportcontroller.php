<?php
	
class Reportcontroller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Reportmodel');
    }
	
	function show_58yearsold_list(){
	    $data=$this->Reportmodel->yearsold_list_show();			
        echo json_encode($data);	
	}
	
	function show_gratuitycalculation(){
	    $data=$this->Reportmodel->gratuitycalculation_show();			
        echo json_encode($data);	
	}
	
}	
?>