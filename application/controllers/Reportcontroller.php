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
	
	function show_gratuitycalculation_default(){
		error_log("=== show_gratuitycalculation_default() called ===");
		try {
			$data=$this->Reportmodel->gratuitycalculation_default();
			error_log("Data retrieved: " . count($data) . " records");
			echo json_encode($data);
			error_log("JSON response sent");
		} catch (Exception $e) {
			error_log("ERROR in show_gratuitycalculation_default: " . $e->getMessage());
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
	
	function show_gratuitycalculation(){
		error_log("=== show_gratuitycalculation() called ===");
		error_log("POST data: " . print_r($this->input->post(), true));
		try {
			$data=$this->Reportmodel->gratuitycalculation_show();
			error_log("Data retrieved: " . count($data) . " records");
			echo json_encode($data);
			error_log("JSON response sent");
		} catch (Exception $e) {
			error_log("ERROR in show_gratuitycalculation: " . $e->getMessage());
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
	
}	
?>