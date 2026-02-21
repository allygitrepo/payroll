<?php
	
class Monthabsentlist extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Monthabsentlistmodel');
    }
	
	
	function show_monthabsentlist(){
	    $data=$this->Monthabsentlistmodel->monthabsentlist_show();			
        echo json_encode($data);	
	}
}	
?>