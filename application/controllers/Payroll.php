<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {
	
	
	
	   function __construct(){
//		$result = array();
		
		parent::__construct();
		
				        $this->load->model('Usermanagementmodel');
//    	$result['access'] = $this->Usermanagementmodel->get_access();			


    }
	
	

	public function index()
	{	
			$this->load->view('login');	
	}
	public function error()
	{	
   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
			$this->load->view('error');	
	}
	public function dashboard()
	{
   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
		$this->load->view('index',$result);
	}
	
	//master-----
	
		public function login()
	{
//		        $this->load->model('Usermanagementmodel');
		 $data=  $this->Usermanagementmodel->check_login();
				$data1 = array('data' => $data);

 			if($data==1){
				redirect(base_url('payroll/dashboard'));
			}
			else{
//				redirect(base_url('payroll/dashboard'),$data);
				$this->load->view('login',$data1);	
			}
	}

    public function logout()  
    {  
	
	
	
        //removing session  
        $this->session->unset_userdata('userid');  
        $this->session->unset_userdata('company_id');
		
				redirect(base_url('payroll/index'));
    }  
	
	public function company()
	{
	   	$result['access'] = $this->Usermanagementmodel->get_access();			

		$this->load->view('header',$result);	
	
	   	$check = $this->Usermanagementmodel->check_access('2','m_0');			
				
		if($check>0){
		$this->load->view('company');		
		}
		else{
			redirect('payroll/error');
		}
	
	}
	
	public function employee()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		
		
	$this->load->helper('form'); 
	   	$check = $this->Usermanagementmodel->check_access('2','m_1');			
				
		if($check>0){
		$this->load->view('employee');		
		}
		else{
			redirect('payroll/error');
		}
	} 
	
	public function kyc_update()
	{
		
		
		
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('2','m_2');			
				
		if($check>0){
			$this->load->view('kycupdate');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	public function contractor()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	
	   	$check = $this->Usermanagementmodel->check_access('2','m_3');			
				
		if($check>0){
		$this->load->view('contractor');
		}
		else{
			redirect('payroll/error');
		}
	
	
	}
		public function address()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('2','m_4');			
				
		if($check>0){
			$this->load->view('address');
		}
		else{
			redirect('payroll/error');
		}
	}

	
	
	
	
	
	
	//setup----	
	public function packing_wages()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	
	
		   	$check = $this->Usermanagementmodel->check_access('3','s_0');			
				
		if($check>0){
			$this->load->view('packingwages');
		}
		else{
			redirect('payroll/error');
		}

	
	
	}
	
	public function bidi_rolle_wages()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('3','s_1');			
				
		if($check>0){
		$this->load->view('bidirollewages');
		}
		else{
			redirect('payroll/error');
		}

	}
	
	public function professional_tax()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('3','s_2');			
				
		if($check>0){
	$this->load->view('professionaltax');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function officestaffsalary()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('3','s_3');			
				
		if($check>0){
	$this->load->view('officestaffsalary');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function challanSetup()
	{

		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('3','s_4');			
				
		if($check>0){
	$this->load->view('challan_setup');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	
	//entry---



	public function officestaff()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	
		   	$check = $this->Usermanagementmodel->check_access('4','e_0');			
				
		if($check>0){
	$this->load->view('officeStaff');
		}
		else{
			redirect('payroll/error');
		}

	
	}
	
	public function packers()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('4','e_1');			
				
		if($check>0){
	$this->load->view('packers');
		}
		else{
			redirect('payroll/error');
		}
	} 
	
	public function bidiroller()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('4','e_2');			
				
		if($check>0){
	$this->load->view('bidiRoller');
		}
		else{
			redirect('payroll/error');
		}
	
	}
	
	public function challandate()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

		   	$check = $this->Usermanagementmodel->check_access('4','e_3');			
				
		if($check>0){
	$this->load->view('challanDate');
		}
		else{
			redirect('payroll/error');
		}
	
	}
	public function resignation()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('4','e_4');			
				
		if($check>0){
	$this->load->view('resignation');
		}
		else{
			redirect('payroll/error');
		}

	}
	
	//---------Report---
		
		
		
	public function office_salary_sheet()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_0');			
				
		if($check>0){
	$this->load->view('officeSalarySheet');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	public function packing_salary()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_0');			
				
		if($check>0){
	$this->load->view('packingsalarysheet');
		}
		else{
			redirect('payroll/error');
		}
	} 
	
	public function contractor_salary()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_0');			
				
		if($check>0){
	$this->load->view('contractorSalarySheet');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	
	public function form_eleven()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('form11');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function form2()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('form2');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function form3a()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('form3a');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function form5()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('form5');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function form10()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('form10');
		}
		else{
			redirect('payroll/error');
		}
	}
		public function pfclaimform()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_1');			
				
		if($check>0){
	$this->load->view('pf_claim_form');
		}
		else{
			redirect('payroll/error');
		}
	}

	
	
	
	
		
	public function ecr_report()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_2');			
				
		if($check>0){
	$this->load->view('ecrreport');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	public function esic_report()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_2');			
				
		if($check>0){
	$this->load->view('esicreport');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	
	
	
	
	public function pmrpy_report()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_3');			
				
		if($check>0){
	$this->load->view('pmrpyreport');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function pf_challan_yearly()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_4');			
				
		if($check>0){
	$this->load->view('pfchallanyearly');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function esic_challan_yearly()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_4');			
				
		if($check>0){
	$this->load->view('esicchallanyearly');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function pf_challan()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_5');			
				
		if($check>0){
	$this->load->view('pfchallan');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function pf_summary()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('5','r_6');			
				
		if($check>0){
	$this->load->view('pfsummary');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function payment_advice()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_7');			
				
		if($check>0){
	$this->load->view('paymentadvice');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function bonus_sheet()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_8');			
				
		if($check>0){
	$this->load->view('bonussheet');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function gratuity_calculation()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_9');			
				
		if($check>0){
	$this->load->view('gratuityreport');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function professionalTax()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('5','r_10');			
				
		if($check>0){
	$this->load->view('monthWiseProfessionalTax');
		}
		else{
			redirect('payroll/error');
		}
	}

	
		

	
	//utility---
	
	public function calender()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_0');			
				
		if($check>0){
	$this->load->view('calender');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	public function user_management()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_1');			
				
		if($check>0){
	$this->load->view('userManagement');
		}
		else{
			redirect('payroll/error');
		}
	} 
	
	public function employee_data_import()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_2');			
				
		if($check>0){
	$this->load->view('employeeDataImport');
		}
		else{
			redirect('payroll/error');
		}
	}
	
	public function employee_data_export()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_3');			
				
		if($check>0){
	$this->load->view('employeeDataExport');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function kyc_export()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_4');			
				
		if($check>0){
	$this->load->view('kycExport');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function attendance_printing()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_5');			
				
		if($check>0){
	$this->load->view('attendanceSheetPrinting');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function employeemissingdata()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
	   	$check = $this->Usermanagementmodel->check_access('6','u_6');			
				
		if($check>0){
	$this->load->view('employeemissingdata');
		}
		else{
			redirect('payroll/error');
		}
	}

	public function delete_month_entry()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_7');			
				
		if($check>0){
	$this->load->view('deleteMonthEntry');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function db_backup()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_8');			
				
		if($check>0){
	$this->load->view('dbbackup');
		}
		else{
			redirect('payroll/error');
		}
	}
	public function db_restore()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	   	$check = $this->Usermanagementmodel->check_access('6','u_9');			
				
		if($check>0){
	$this->load->view('dbrestore');
		}
		else{
			redirect('payroll/error');
		}
	}

	public function uan_ip_mapping()
	{
		$result['access'] = $this->Usermanagementmodel->get_access();
		$this->load->view('header', $result);
		$this->load->view('uan_ip_mapping');
	}

 	public function download_uan_template()
 	{
 		$this->load->library('excel');
 		$objPHPExcel = new PHPExcel();
 		$objPHPExcel->setActiveSheetIndex(0);
 
 		// Set headers
 		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'UAN');
 		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'IP Number');
 
 		// Set column widths
 		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
 
 		$filename = 'UAN_IP_Mapping_Template.xlsx';
 		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 		header('Content-Disposition: attachment;filename="' . $filename . '"');
 		header('Cache-Control: max-age=0');
 
 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 		$objWriter->save('php://output');
 	}

	public function preview_uan_ip_mapping()
	{
		header('Content-Type: application/json');
		try {
			if (!class_exists('ZipArchive')) {
				echo json_encode(array(
					"status" => false, 
					"type" => "zip_error", 
					"message" => "ZipArchive extension is not enabled on server"
				));
				return;
			}

			log_message('debug', 'UAN-IP Mapping: Preview started');
			$this->load->library('excel');
			$this->load->model('Employeemodel');
			
			if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != 0) {
				log_message('error', 'UAN-IP Mapping: File upload error or no file. Error code: ' . ($_FILES["file"]["error"] ?? 'None'));
				echo json_encode(array(
					'status' => false,
					'type' => 'upload_error',
					'message' => 'No file uploaded or upload error'
				));
				return;
			}

			$file_directory = "uploads/";
			if (!is_dir($file_directory)) {
				mkdir($file_directory, 0777, true);
			}
			$new_file_name = $_FILES["file"]["name"];
			log_message('debug', 'UAN-IP Mapping: File name: ' . $new_file_name);
			
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
			{   
				$file_path = $file_directory . $new_file_name;
				log_message('debug', 'UAN-IP Mapping: File moved to ' . $file_path);

				$file_type	= PHPExcel_IOFactory::identify($file_path);
				$objReader	= PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_path);
				
				$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				log_message('debug', 'UAN-IP Mapping: Total rows to process: ' . $highestRow);
				
				$preview_data = array();
				for ($row = 2; $row <= $highestRow; $row++) {
					$uan = $objPHPExcel->setActiveSheetIndex(0)->getCell('A'.$row)->getValue();
					$ip = $objPHPExcel->setActiveSheetIndex(0)->getCell('B'.$row)->getValue();
					
					if(!empty($uan)){
						$emp_name = $this->Employeemodel->get_employee_by_uan($uan);
						$preview_data[] = array(
							'uan' => (string)$uan,
							'name' => $emp_name,
							'ip' => (string)$ip
						);
					}
				}
				unlink($file_path);
				log_message('debug', 'UAN-IP Mapping: Preview data count: ' . count($preview_data));
				echo json_encode(array(
					'status' => true,
					'data' => $preview_data
				));
			} else {
				log_message('error', 'UAN-IP Mapping: Failed to move uploaded file');
				echo json_encode(array(
					'status' => false,
					'type' => 'upload_error',
					'message' => 'Failed to move uploaded file'
				));
			}
		} catch (Throwable $e) {
			log_message('error', 'UAN-IP Mapping Exception: ' . $e->getMessage());
			echo json_encode(array(
				"status" => false,
				"type" => "exception",
				"message" => $e->getMessage(),
				"file" => $e->getFile(),
				"line" => $e->getLine()
			));
		}
	}

	public function update_uan_ip_mapping()
	{
		log_message('debug', 'UAN-IP Mapping: Update started');
		$this->load->model('Employeemodel');
		$data = json_decode($this->input->post('data'), true);
		if (empty($data)) {
			log_message('warning', 'UAN-IP Mapping: No data received for update');
			echo "No data to update";
			return;
		}
		$count = 0;
		foreach($data as $row){
			if(!empty($row['uan']) && $this->Employeemodel->update_ip_by_uan($row['uan'], $row['ip'])){
				$count++;
			}
		}
		log_message('debug', 'UAN-IP Mapping: Update successful. Count: ' . $count);
		echo $count . " Records Updated Successfully";
	}
	
	
	
	
/*	public function excelformat()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	$this->load->view('download');
	}


	public function gratuity_data_import()
	{
				   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	

	$this->load->view('gratuityDataImport');
	}
	
*/	
	//Todo List---
	public function tmonth_absent_list()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
		   	$check = $this->Usermanagementmodel->check_access('7','t_0');			
				
		if($check>0){
	$this->load->view('3monthabsentlist');
		}
		else{
			redirect('payroll/error');
		}

	}
	
	public function yearsofage()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
		   	$check = $this->Usermanagementmodel->check_access('7','t_1');			
				
		if($check>0){
	$this->load->view('58yearsofage');
		}
		else{
			redirect('payroll/error');
		}
	} 
	
	public function notes()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
		   	$check = $this->Usermanagementmodel->check_access('7','t_2');			
				
		if($check>0){
	$this->load->view('notes');
		}
		else{
			redirect('payroll/error');
		}
	}

	
	public function excel_to_text()
	{
		   	$result['access'] = $this->Usermanagementmodel->get_access();			
		$this->load->view('header',$result);	
		   	$check = $this->Usermanagementmodel->check_access('8','c_0');			
				
		if($check>0){
	$this->load->view('ExceltoText');
		}
		else{
			redirect('payroll/error');
		}
	}

	public function kyc_image_upload()
	{
		$this->load->helper("file");	
		$this->load->library("upload");
		
		if ($_FILES['uploadFile']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => './assets/images/employee/',
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "remove_spaces" => TRUE,
		       "allowed_types" => 'jpg|jpeg|png|gif',
		       "max_size" => 30000,
		    ));
			
//		       "encrypt_name" => ,
			

		   if (!$this->upload->do_upload('uploadFile')) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
		}

		    $data = $this->upload->data();
			$path = $data['file_name'];
			
			echo json_encode($path);	
		}else{
			echo "no file"; 
		}
		
		
	}
		
		
	
}
?>