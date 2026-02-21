<?php
class Employeeimportmodel extends CI_Model{


		public function employee_import_file($result){
			if((trim($result[0])=="")&&(trim($result[1])=="")&&(trim($result[2])=="")&&(trim($result[3])=="")&&(trim($result[4])=="")&&(trim($result[5])=="")&&(trim($result[6])=="")&&(trim($result[7])=="")&&(trim($result[8])=="")&&(trim($result[9])=="")&&(trim($result[10])=="")&&(trim($result[11])=="")&&(trim($result[12])=="")&&(trim($result[13])=="")&&(trim($result[14])=="")&&(trim($result[15])=="")&&(trim($result[16])=="")&&(trim($result[17])=="")&&(trim($result[18])==""))
			{}
			else{	
				
				
			
			$getdata = "";
 			$UAN = 				 	trim($result[0]);
 			$pmid = 	trim($result[1]);
			$previus_member_id = substr($pmid,-7);
			$previus_member_id = trim($previus_member_id);
			$emptype =	strtoupper($result[3]);
			$emptype =	trim($emptype);
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
			$employee_name = trim($employee_name);

			$emp_name1 = explode(".",$employee_name);

			if(isset($emp_name1[1])){
			$emp_name = trim($emp_name1[1]);				
			}
			else{
			$emp_name = trim($employee_name);				
			}
			
			if($result[6]!="")
			{
			$dobtimestamp = strtotime($result[6]);	
			$dob1 = date('Y-m-d',$dobtimestamp);				
			}
			else{
			$dob1 = "";	
			}

			if($result[7]!="")
			{
			$dojtimestamp = strtotime($result[7]);	
			$doj1 = date('Y-m-d',$dojtimestamp);
			}
			else{
			$doj1 = "";	
			}

			

			$gender = 				strtoupper(trim($result[5]));
			$father_husband = 		strtoupper(trim($result[8]));
			$relation = 			strtoupper(trim($result[9]));
			$status = 				strtoupper(trim($result[10]));
			$mobile = 				trim($result[11]);
			$bank_accno = 			trim($result[15]);
			$pan = 					trim($result[14]);
			$aadhaar_no = 			trim($result[13]);
			$nationality = 			strtoupper(trim($result[16]));
			$pmrpy = 			strtoupper(trim($result[17]));
			$ifsc = 			strtoupper(trim($result[18]));
//			$email_id = 

					$this->db->select('website');    
					$this->db->from('company_master');
					$this->db->where('estb_id',$_SESSION['company_id']);
					$query = $this->db->get();
	
        $website = $query->row()->website;
		if(($aadhaar_no!="")&&($aadhaar_no!="NOT AVAILABLE")){
		$email = $aadhaar_no."@".$website;			
		}
		else{
		$email = "";
		}
					

				$a = 0;
				

	if(($UAN=="")||($UAN=="NOT AVAILABLE")){
    $this->db->where('aadhaar_no',$aadhaar_no);
    $query = $this->db->get('employee_master');	
	$a = 1;
	}
	else{
			
	$a = 2;
		$this->db->where('UAN',$UAN);
		$query = $this->db->get('employee_master');
		$uan_count = $query->num_rows();
		if(($uan_count==0)&&($aadhaar_no!="NOT AVAILABLE")&&($aadhaar_no!="")){
		
			$this->db->where('aadhaar_no',$aadhaar_no);
			$query = $this->db->get('employee_master');
			
			$a = 1;
			
		}
	}
	
//		echo $a;
//		echo $query;
echo $query->num_rows();

   if ($query->num_rows() > 0){
//	echo $query->num_rows()."updt";
		if(($UAN !="")&&($UAN!="NOT AVAILABLE")){	$this->db->set('UAN',$UAN); }
    	if(($previus_member_id !="")&&($previus_member_id!="NOT AVAILABLE")){    $this->db->set('member_id',$previus_member_id); }
    	if(($dob1 !="")&&($dob1!="NOT AVAILABLE")){    $this->db->set('dob',$dob1); }
    	if(($doj1 !="")&&($doj1!="NOT AVAILABLE")){    $this->db->set('doj',$doj1); }
    	if(($gender !="")&&($gender!="NOT AVAILABLE")){    $this->db->set('gender',$gender); }
    	if(($father_husband !="")&&($father_husband!="NOT AVAILABLE")){    $this->db->set('father_husband',$father_husband); }
    	if(($relation !="")&&($relation!="NOT AVAILABLE")){    $this->db->set('relation',$relation); }
    	if(($mobile !="")&&($mobile!="NOT AVAILABLE")){    $this->db->set('mobile',$mobile); }
    	if(($aadhaar_no !="")&&($aadhaar_no!="NOT AVAILABLE")){    $this->db->set('email',$email); }
    	if(($status !="")&&($status!="NOT AVAILABLE")){    $this->db->set('marital_status',$status); }
    	if(($aadhaar_no !="")&&($aadhaar_no!="NOT AVAILABLE")){    $this->db->set('aadhaar_no',$aadhaar_no); }
    	if(($emp_name !="")&&($emp_name!="NOT AVAILABLE")){    $this->db->set('name_as_aadhaar',$emp_name); }
    	if(($pmid !="")&&($pmid!="NOT AVAILABLE")){    $this->db->set('member_id_org',$pmid); }
    	if(($contractor_id !="")&&($contractor_id!="NOT AVAILABLE")){    $this->db->set('contractor',$contractor_id); }
    	if(($emptype !="")&&($emptype!="NOT AVAILABLE")){    $this->db->set('employee_type',$emptype); }
    	if(($nationality !="")&&($nationality!="NOT AVAILABLE")){    $this->db->set('nationality',$nationality); }
    	if(($pmrpy !="")&&($pmrpy!="NOT AVAILABLE")){    $this->db->set('pmrpy',$pmrpy); 	}
    	if(($pmid !="")&&($pmid!="NOT AVAILABLE")){    $this->db->set('member_id_org','WBDGP0034083000'.$pmid); 	}

		if($a==1){
				$this->db->where('aadhaar_no',$aadhaar_no);			
		}
		else{
				$this->db->where('UAN',$UAN);
		}

        $getdata=$this->db->update('employee_master');

	if($getdata==true){
		$this->db->select('emp_id');    
		$this->db->from('employee_master');
		if($a==1){
				$this->db->where('aadhaar_no',$aadhaar_no);			
		}
		else{
				$this->db->where('UAN',$UAN);
		}
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
	
if(($pan!="NOT AVAILABLE")&&($pan!="")){
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

if((($bank_accno!="NOT AVAILABLE")&&($bank_accno!=""))||(($ifsc!="NOT AVAILABLE")&&($ifsc!=""))){

    if ($bank_row->num_rows() > 0){

if(($bank_accno!="NOT AVAILABLE")&&($bank_accno!="")){
		$this->db->set('doc_num',$bank_accno);
}		
//		$this->db->set('doc_name',$name_as_bank);
if(($ifsc!="NOT AVAILABLE")&&($ifsc!="")){
		$this->db->set('ifsc',$ifsc);
}
        $this->db->where('emp_id',$emp_id);
		$this->db->where('doc_type','BANK');
        $bankupdate=$this->db->update('kyc_master');
		
	}
	else{
$date = date("Y/m/d");
        $bank_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'BANK', 
//                'doc_num' => $bank_accno, 
//                'doc_name' => $name_as_bank, 
//                'ifsc' => $ifsc, 
                'date' => $date, 
            );
if(($bank_accno!="NOT AVAILABLE")&&($bank_accno!="")){
		$bank_data['doc_num'] = $bank_accno;
}		
if(($ifsc!="NOT AVAILABLE")&&($ifsc!="")){
		$bank_data['ifsc'] = $ifsc;
}
			
			
		$this->db->insert('kyc_master',$bank_data);		
	}

}

if(($aadhaar_no!="NOT AVAILABLE")&&($aadhaar_no!="")){
	
    if ($ac_row->num_rows() > 0){

						$this->db->set('doc_num',$aadhaar_no);
if(($emp_name!="")&&($emp_name!="NOT AVAILABLE")){		$this->db->set('doc_name',$emp_name); }
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
					'member_id_org'=>'WBDGP0034083000'.$pmid,
					'contractor'=>$contractor_id,
					'employee_type'=>$emptype,
					'status'=>'1',
					'nationality'=>$nationality,
					'pmrpy'=>$pmrpy					
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
if((($bank_accno!="NOT AVAILABLE")&&($bank_accno!=""))||(($ifsc!="NOT AVAILABLE")&&($ifsc!=""))){
        $bank_data = array(
                'emp_id'  => $emp_id, 
                'doc_type'  => 'BANK', 
//                'doc_num' => $bank_accno, 
//                'doc_name' => $name_as_bank, 
//               'ifsc' => $ifsc, 
                'date' => $date, 
            );
		if(($bank_accno!="NOT AVAILABLE")&&($bank_accno!="")){
				$bank_data['doc_num'] = $bank_accno;
		}		
		if(($ifsc!="NOT AVAILABLE")&&($ifsc!="")){
				$bank_data['ifsc'] = $ifsc;
		}
		$this->db->insert('kyc_master',$bank_data);		
	}	
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

	
		public function gratuity_import_file($result){
			$getdata = "";
 			$colum1 = 				 	$result[0];
 			$colum2 = 				 	$result[1];
 			$colum3 = 				 	$result[2];
 			$colum4 = 				 	$result[3];
 			
        $gratuity_data = array(
                'member_id'  => $colum1, 
                'name'  => $colum2, 
                'year'  => $colum3, 
                'totaldays'  => $colum4, 
            );
		$this->db->insert('gratuity_master',$gratuity_data);		

	return $getdata;
	}

	
}	
?>