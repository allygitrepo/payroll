<?php
	
class Attandanceprinting extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        $this->load->model('Attandanceprintingmodel');
		
    }
	
	public function print_attendance_sheet(){
		  $data=$this->Attandanceprintingmodel->attendance_sheet_print();
		  echo json_encode($data);	
		
	   
	}
	public function get_all_date(){
				$month1 = $this->input->post('month');
				$date1 = explode("-",$month1);
				
		$list=array();
		$month = $date1[0];
		$year = $date1[1];
		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('d', $time);
		}
		$n = count($list);
        echo json_encode($n);	
	}
	
	public function get_calender(){
		  $data=$this->Attandanceprintingmodel->get_calender_data();
        echo json_encode($data);	
	}
	
	
}	
?>