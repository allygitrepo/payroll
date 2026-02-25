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