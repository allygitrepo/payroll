<?php
	
class Paymentadvicereport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
       $this->load->model('Paymentadvicereportmodel');
    }
	
	function paymentadvicereport_show(){
	    $data=$this->Paymentadvicereportmodel->show_paymentadvicereport();			
        echo json_encode($data);	
	}
	
}	
?>