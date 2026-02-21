<?php
	
class Exportpdf extends CI_Controller{
	
    function __construct(){
        parent::__construct();
		$this->load->library('excel');
		$this->load->helper('form');
		$this->load->helper("file");	
		$this->load->library("upload");
		$this->load->library('pdf');

       $this->load->model('Exportpdfmodel');
    }
		public function export_employee_pdf(){
	set_time_limit(0);
	
	    $data['result']=$this->Exportpdfmodel->formeleven_view();			
	
		$this->load->view('example',$data);			
					
	}
	
		public function print_attendance_sheet_pdf(){
			
				$month1 = $this->input->post('month_year');
				$contractor1 = $this->input->post('contractor1');
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
		
			
		$data = array('days' => $n ,'month_year' => $month1 );
        $this->load->model('Attandanceprintingmodel');
		$data['result']=$this->Attandanceprintingmodel->attendance_sheet_print();
		$row=$this->Attandanceprintingmodel->attendance_sheet_print();
	    $this->load->view('attendanceprintingpdf',$data);
	}
	public function pfclaimform()
	{
    $data['result']=$this->Exportpdfmodel->data_pfclaimform();			
	$this->load->view('pfclaimform',$data);
	}
	public function form2()
	{
    $data['result']=$this->Exportpdfmodel->data_form2();			
    $data['result1']=$this->Exportpdfmodel->data_nominee();	
    $data['result2']=$this->Exportpdfmodel->data_family();			
    $data['result3']=$this->Exportpdfmodel->data_son();			
	$this->load->view('form_2',$data);
	}
	public function form3a()
	{
	set_time_limit(0);
    $data['result']=$this->Exportpdfmodel->data_form3a();	
//print_r($data);	
	$this->load->view('form_3a',$data);
	}
	public function form5()
	{
    $data['result']=$this->Exportpdfmodel->data_form5();	
	$this->load->view('form_5',$data);
	}
	public function form10()
	{
    $data['result']=$this->Exportpdfmodel->data_form10();	
	$this->load->view('form_10',$data);
	}


}	
?>