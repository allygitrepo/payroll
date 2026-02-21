<?php
	
class Pfchallanyearly extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Pfchallanyearlymodel');
    }
	
	
	function show_pfchallanyearly(){
	    $data=$this->Pfchallanyearlymodel->pfchallanyearly_show();			
        echo json_encode($data);	
	}

	
	function show_challanformat(){
	    $data=$this->Pfchallanyearlymodel->challanformat_show();			
        echo json_encode($data);	
	}

	

}	
?>