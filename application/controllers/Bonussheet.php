<?php
	
class Bonussheet extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Bonussheetmodel');
    }
	
	
	function show_bonussheet(){
	    $data=$this->Bonussheetmodel->bonussheet_show();			
        echo json_encode($data);	
	}
}	
?>