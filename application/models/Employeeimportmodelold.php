<?php
class Employeeimportmodel extends CI_Model{


	
		public function employee_import_file($result){
			$getdata = "";
 			$UAN = 				 	$result[0];
 			$pmid = 				 	$result[1];
			$previus_member_id = substr($pmid,-7);
			$emptype =	strtoupper($result[3]);
			if($emptype=="BIDI MAKER"){
		$ccode = $result[2];
		$contractor_id = "";
		$query = $this->db->query('select contractor_id from contractor_master where ccode="'.$ccode.'" '); 
	
	foreach($query->result() as $contractor){
		$contractor_id = $contractor->contractor_id;			
		}
			
			}
			else{
$contractor_id = "";
			}
			
			$employee_name = strtoupper($result[4]);
			$emp_name1 = explode(".",$employee_name);
			if(isset($emp_name1[1])){
			$emp_name = trim($emp_name1[1]);				
			}
			else{
			$emp_name = trim($employee_name);				
			}
			
			

			$dobtimestamp = strtotime($result[6]);	
			$dob1 = date('Y-m-d',$dobtimestamp);


			$dojtimestamp = strtotime($result[7]);	
			$doj1 = date('Y-m-d',$dojtimestamp);
			

			$gender = 				strtoupper($result[5]);
			$father_husband = 		strtoupper($result[8]);
			$relation = 			strtoupper($result[9]);
			$status = 				strtoupper($result[10]);
			$mobile = 				strtoupper($result[11]);
			$bank_accno = 			$result[15];
			$pan = 					$result[14];
			$aadhaar_no = 			$result[13];
//			$email_id = 
			$email = 	$aadhaar_no."@DINESHBIDI.COM";

		
    $this->db->where('aadhaar_no',$aadhaar_no);
    $query = $this->db->get('employee_master');
	
    if ($query->num_rows() > 0){
		
        $this->db->set('UAN',$UAN);
        $this->db->set('member_id',$previus_member_id);
        $this->db->set('dob',$dob1);
        $this->db->set('doj',$doj1);
        $this->db->set('gender',$gender);
        $this->db->set('father_husband',$father_husband);
        $this->db->set('relation',$relation);
        $this->db->set('mobile',$mobile);
        $this->db->set('email',$email);
        $this->db->set('marital_status',$status);
        $this->db->set('aadhaar_no',$aadhaar_no);
        $this->db->set('name_as_aadhaar',$emp_name);
        $this->db->set('member_id_org',$pmid);
        $this->db->set('contractor',$contractor_id);
        $this->db->set('employee_type',$emptype);
        $this->db->where('aadhaar_no',$aadhaar_no);
        $getdata=$this->db->update('employee_master');

	if($getdata==true){
    
		$this->db->select('emp_id');    
		$this->db->from('employee_master');
		$this->db->where('aadhaar_no',$aadhaar_no);
		$employee=$this->db->get()->row()->emp_id;
      
		$emp_id = $employee;
				
			  

	$this->db->where('doc_type','PAN');
	$this->db->where('emp_id',$emp_id);
    $pan_row = $this->db->get('kyc_master');
	
	$this->db->where('doc_type','BANK');
	$this->db->where('emp_id',$emp_id);
    $bank_row = $this->db->get('kyc_master');
	
	$this->db->where('doc_type','AADHAAR CARD');
	$this->db->where('emp_id',$emp_id);
    $ac_row = $this->db->get('kyc_master');
	
if($pan!="NOT AVAILABLE"){
    if ($pan_row->num_rows() > 0){
		$this->db->set('doc_num',$pan);
//		$this->db->set('doc_name',$name_as_pan);
        $this->db->where('emp_id',$emp_id);
		$this->db->where('doc_type','PAN');
        $panupdate=$this->db->update('kyc_master');
		
	}
	else{
		
$date = date("Y/m/d");
        $pan_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'PAN', 
                'doc_num' => $pan, 
//                'doc_name' => $name_as_pan, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$pan_data);		
	}
	
}

    if ($bank_row->num_rows() > 0){

		$this->db->set('doc_num',$bank_accno);
//		$this->db->set('doc_name',$name_as_bank);
//		$this->db->set('ifsc',$ifsc);
        $this->db->where('emp_id',$emp_id);
		$this->db->where('doc_type','BANK');
        $bankupdate=$this->db->update('kyc_master');
		
	}
	else{
$date = date("Y/m/d");
        $bank_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'BANK', 
                'doc_num' => $bank_accno, 
//                'doc_name' => $name_as_bank, 
//                'ifsc' => $ifsc, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$bank_data);		
	}

    if ($ac_row->num_rows() > 0){

		$this->db->set('doc_num',$aadhaar_no);
		$this->db->set('doc_name',$emp_name);
        $this->db->where('emp_id',$emp_id);
		$this->db->where('doc_type','AADHAAR CARD');
        $bankupdate=$this->db->update('kyc_master');
		
	}
	else{
$date = date("Y/m/d");
        $ac_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'AADHAAR CARD', 
                'doc_num' => $aadhaar_no, 
              'doc_name' => $emp_name, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$ac_data);		
	}

	}


		 
		 
					 	 
    }
    else{

			
			$data = array(
					'UAN'=>$UAN,
					'member_id'=>$previus_member_id,
					'dob'=>$dob1,
					'doj'=>$doj1,
					'gender'=>$gender,
					'father_husband'=>$father_husband,
					'relation'=>$relation,
					'mobile'=>$mobile,
					'email'=>$email,
					'marital_status'=>$status,
					'aadhaar_no'=>$aadhaar_no,
					'name_as_aadhaar'=>$emp_name,
					'member_id_org'=>$pmid,
					'contractor'=>$contractor_id,
					'employee_type'=>$emptype,
					'status'=>'1',
					
				);
        $getdata=$this->db->insert('employee_master',$data);
		$emp_id = $this->db->insert_id();
	if($getdata==true){
    
		
$date = date("Y/m/d");
if($pan!="NOT AVAILABLE"){

        $pan_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'PAN', 
                'doc_num' => $pan, 
//                'doc_name' => $name_as_pan, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$pan_data);		
}
        $bank_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'BANK', 
                'doc_num' => $bank_accno, 
//                'doc_name' => $name_as_bank, 
 //               'ifsc' => $ifsc, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$bank_data);		
	
	        $ac_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'AADHAAR CARD', 
                'doc_num' => $aadhaar_no, 
               'doc_name' => $emp_name, 
                'date' => $date, 
            );
		$this->db->insert('kyc_master',$ac_data);		
			}	
		
		
		}
	
		return $getdata;
	}

	
}	
?>