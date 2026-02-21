<?php
class Employeemodel extends CI_Model{
	
 	    function employee_show(){
		$this->db->select('*');    
					$this->db->from('employee_master');
					$this->db->join('address_master', 'employee_master.address_id = address_master.id');
					$this->db->where('status','1');
					$this->db->where('substr(`employee_master.member_id_org`,1,15)',$_SESSION['company_id']);
					$getdata=$this->db->get();
        return $getdata->result();
    }
	
 	    function employee_export_show(){
//		$this->db->select('*');    
				$getdata= $this->db->query('SELECT * FROM `employee_master` where status="1" and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" order by member_id desc ');
			$row1 =	$getdata->result();
				
				
			$result = array();	
			
   foreach($getdata->result() as $rows1)
   {
       $emp_id = $rows1->emp_id;
				$getkyc= $this->db->query('SELECT * FROM kyc_master where emp_id="'.$emp_id.'" and doc_type = ("PAN" or "BANK") ');
				$kyc =	$getkyc->result();
				
	$acc_no = ""; 			
	$ifsc = ""; 			
	$name_banck = ""; 			
	$pan = ""; 			
	$name_pan = "";
	
   foreach($getkyc->result() as $kyc)
   {
       $doc_type = $kyc->doc_type;
	   if($doc_type == "BANK"){
       $acc_no = $kyc->doc_num;
       $name_banck = $kyc->doc_name;
       $ifsc = $kyc->ifsc;		   
		   }
	   if($doc_type == "PAN"){
       $pan = $kyc->doc_num;
       $name_pan = $kyc->doc_name;
		   }
   
   }		
//   $uae = "";
	   $row = $rows1->emp_id.'####'.$rows1->UAN.'####'.$rows1->previus_member_id.'####'.$rows1->dob.'####'.$rows1->doj.'####'.$rows1->gender.'####'.$rows1->father_husband.'####'.$rows1->relation.'####'.$rows1->mobile.'####'.$rows1->email.'####'.$rows1->nationality.'####'.$rows1->wages_join.'####'.$rows1->qualification.'####'.$rows1->marital_status.'####'.$rows1->international_worker.'####'.$rows1->contry_origin.'####'.$rows1->passport_no.'####'.$rows1->passport_from_date.'####'.$rows1->passport_till_date.'####'.$rows1->physical_handicap.'####'.$rows1->locomotive.'####'.$rows1->hearing.'####'.$rows1->visual.'####'.$rows1->employee_type.'####'.$acc_no.'####'.$ifsc.'####'.$name_banck.'####'.$pan.'####'.$name_pan.'####'.$rows1->aadhaar_no.'####'.$rows1->name_as_aadhaar.'####'.$rows1->member_id.'####'.$rows1->pmrpy.'####'.$rows1->ABRY;

				array_push($result,$row);
   }	

			
//			$n = count($getdata);
//			for($i=0;$i<$n;$i++)
//			{
	//	$id = $getdata[$i]['emp_id'];
		
//		        $this->db->where('emp_id',$id);
//        $getdata=$this->db->get('kyc_master');
//        $getkyc->result();
		
//			}
			
       return $result;
 			
							
					
//					=$this->db->get('employee_master');
    }
 	    function employee_detail_show(){
		$id = $this->input->post('id');
		

		$query = $this->db->query('select count(*) as cn from address_master where id =( SELECT address_id from employee_master where emp_id="'.$id.'" )'); 
		$count = $query->row()->cn;
		
		if($count>0){
		$this->db->select('*');    
					$this->db->from('employee_master');
					$this->db->join('address_master', 'employee_master.address_id = address_master.id');
					$this->db->where('emp_id',$id);
					$getdata=$this->db->get();
			
		}
		else{
		$this->db->select('*');    
					$this->db->from('employee_master');
	//				$this->db->join('address_master', 'employee_master.address_id = address_master.id');
					$this->db->where('emp_id',$id);
					$getdata=$this->db->get();			
		}
        return $getdata->result();
    }
 	    function kyc_detail_view(){
		$id = $this->input->post('id');
		        $this->db->where('emp_id',$id);
        $getdata=$this->db->get('kyc_master');
        return $getdata->result();
    }
 	    function kyc_detail_export_view(){
	//	$id = $this->input->post('id');
		//        $this->db->where('emp_id',$id);
        $getdata= $this->db->query('SELECT * FROM kyc_master WHERE emp_id="'.$id.'" and doc_type=("PAN" or "BANK")');
        return $getdata->result();
    }
 	    function nominee_detail_view(){
		$id = $this->input->post('id');
		
					$this->db->select('*');    
					$this->db->from('nominee_master');
					$this->db->join('address_master', 'nominee_master.address_id = address_master.id');
					$this->db->where('nominee_master.emp_id',$id);
					$getdata=$this->db->get();
        return $getdata->result();
   
	}
 	    function family_detail_view(){
		$id = $this->input->post('id');
		        $this->db->where('emp_id',$id);
        $getdata=$this->db->get('family_master');
        return $getdata->result();
    }

	function employee_save(){

		$dob = $this->input->post('dob');
//		$dob = date("Y-m-d", strtotime($dob));

		$doj = $this->input->post('doj');
//		$doj = date("Y-m-d", strtotime($doj));

		$member_id = $this->input->post('member_id');

		$member_id_org = $_SESSION['company_id'].$member_id;



        $data = array(
				'dob' => 		strtoupper($dob),
				'doj'  => 		strtoupper($doj), 
				'UAN'  =>	strtoupper($this->input->post('uan_id')), 
                'gender'  =>	strtoupper($this->input->post('gender')), 
           'father_husband'  => strtoupper($this->input->post('fhName')), 
				  'relation' => strtoupper($this->input->post('relation')), 
                    'mobile' => strtoupper($this->input->post('mobile')), 
                     'email' => strtoupper($this->input->post('emailid')), 
               'nationality' => strtoupper($this->input->post('nationality')), 
            'qualification'  => strtoupper($this->input->post('qualification')), 
           'marital_status'  => strtoupper($this->input->post('status')), 
     'international_worker'  => strtoupper($this->input->post('international_worker')), 
			'contry_origin'  => strtoupper($this->input->post('contry')), 
              'passport_no'  => strtoupper($this->input->post('passportno')), 
       'passport_from_date'  => strtoupper($this->input->post('validefrom')), 
       'passport_till_date'  => strtoupper($this->input->post('validetill')), 
        'physical_handicap'  => strtoupper($this->input->post('physical_handicap')), 
               'locomotive'  => strtoupper($this->input->post('locomotive')), 
			    	'visual'  =>strtoupper($this->input->post('visual')), 
                   'hearing'  =>strtoupper($this->input->post('hearing')), 
                'aadhaar_no'  =>strtoupper($this->input->post('adharno')), 
           'name_as_aadhaar'  =>strtoupper($this->input->post('empName')), 
              'employee_type' =>strtoupper($this->input->post('typeEmp')), 
                 'contractor' =>strtoupper($this->input->post('contractor1')), 
                 'address_id' =>strtoupper($this->input->post('address_list')), 
                  'emp_image' =>strtoupper($this->input->post('emp_image')), 
                  'member_id' =>$member_id, 
                  'member_id_org' =>$member_id_org, 
                'status' =>'1', 
                  'pmrpy' =>	$this->input->post('pmrpy'), 
            );
		$this->db->insert('employee_master',$data);
		 $result = $this->db->insert_id();
	
//	echo "<script>alert('$empname');</script>";
	
	return  $result;
	}

	function update_abry_details(){
		$id = $this->input->post('id');
		$abry = $this->input->post('abry');

		$this->db->set('ABRY', $abry);
		$this->db->where('emp_id', $id);
        $result=$this->db->update('employee_master');
		return $result;
	}
		function employee_update(){
		

		$id = $this->input->post('id');

        $this->db->where('emp_id', $id);
        $this->db->delete('kyc_master');
		
        $this->db->where('emp_id', $id);
        $this->db->delete('nominee_master');
		
        $this->db->where('emp_id', $id);
        $this->db->delete('family_master');
	


		$dob = $this->input->post('dob');
//		$dob = date("Y-m-d", strtotime($dob));

		$doj = $this->input->post('doj');
//		$doj = date("Y-m-d", strtotime($doj));
		$uan=strtoupper($this->input->post('uan_id'));
                $gender  = strtoupper($this->input->post('gender')); 
        $father_husband  = strtoupper($this->input->post('fhName')); 
               $relation = strtoupper($this->input->post('relation')); 
                 $mobile = strtoupper($this->input->post('mobile')); 
                  $email = strtoupper($this->input->post('emailid')); 
         $qualification  = strtoupper($this->input->post('qualification')); 
        $marital_status  = strtoupper($this->input->post('status')); 
            $aadhaar_no  = strtoupper($this->input->post('adharno')); 
       $name_as_aadhaar  = strtoupper($this->input->post('empName')); 
          $employee_type = strtoupper($this->input->post('typeEmp')); 
             $contractor = strtoupper($this->input->post('contractor1')); 
             $address_id = strtoupper($this->input->post('address_list')); 
              $emp_image = strtoupper($this->input->post('emp_image'));
				
  $international_worker  = strtoupper($this->input->post('international_worker')); 
         $contry_origin  = strtoupper($this->input->post('contry'));
           $passport_no  = strtoupper($this->input->post('passportno')); 
    $passport_from_date  = strtoupper($this->input->post('validefrom')); 
    $passport_till_date  = strtoupper($this->input->post('validetill')); 
     $physical_handicap  = strtoupper($this->input->post('physical_handicap')); 
            $locomotive  = strtoupper($this->input->post('locomotive')); 
                $visual  = strtoupper($this->input->post('visual')); 
               $hearing  = strtoupper($this->input->post('hearing')); 
	    	$nationality = strtoupper($this->input->post('nationality')); 
	          $member_id = strtoupper($this->input->post('member_id')); 
                  $pmrpy =	$this->input->post('pmrpy'); 
        			
		$this->db->set('UAN', $uan);   
        $this->db->set('dob', $dob);
        $this->db->set('doj', $doj);
        $this->db->set('gender', $gender);
        $this->db->set('father_husband', $father_husband);
        $this->db->set('relation', $relation);
        $this->db->set('mobile', $mobile);
        $this->db->set('email', $email);
        $this->db->set('qualification', $qualification);
        $this->db->set('marital_status', $marital_status);
        $this->db->set('aadhaar_no', $aadhaar_no);
        $this->db->set('name_as_aadhaar', $name_as_aadhaar);
        $this->db->set('employee_type', $employee_type);
        $this->db->set('contractor', $contractor);
        $this->db->set('address_id', $address_id);
        $this->db->set('emp_image', $emp_image);
        $this->db->set('international_worker', $international_worker);
        $this->db->set('contry_origin', $contry_origin);
        $this->db->set('passport_no', $passport_no);
        $this->db->set('passport_from_date', $passport_from_date);
        $this->db->set('passport_till_date', $passport_till_date);
        $this->db->set('physical_handicap', $physical_handicap);
        $this->db->set('locomotive', $locomotive);
        $this->db->set('visual', $visual);
        $this->db->set('hearing', $hearing);
        $this->db->set('nationality', $nationality);
       $this->db->set('member_id', $member_id);
       $this->db->set('pmrpy', $pmrpy);
		
        $this->db->where('emp_id', $id);
        $result=$this->db->update('employee_master');
	return $result;
	
	}
	

function kyc_detail_save(){
$date = date("Y/m/d");


$doc_type =$this->input->post('doc_type');
$doc_no =$this->input->post('doc_no');
$id = $this->input->post('employee_id');
$name_as_aadhaar = $this->input->post('doc_name');

        $data = array(
                'emp_id'  => strtoupper($this->input->post('employee_id')), 
              'doc_type'  => strtoupper($this->input->post('doc_type')), 
                'doc_num' => strtoupper($this->input->post('doc_no')), 
               'doc_name' => strtoupper($this->input->post('doc_name')), 
                   'ifsc' => strtoupper($this->input->post('ifsc')), 
              'kyc_image' => strtoupper($this->input->post('doc_img')), 
                   'date' => strtoupper($this->input->post('kyc_date')), 
            );
			
			
			
			
			
		$result = $this->db->insert('kyc_master',$data);
		
		
		if($doc_type=="AADHAAR CARD"){ 

        $this->db->set('aadhaar_no', $doc_no);
        $this->db->set('name_as_aadhaar', strtoupper($name_as_aadhaar));
        $this->db->where('emp_id', $id);
        $result1=$this->db->update('employee_master');
		
		}
		

	return  $result;
	}
	
function kyc_detail_save_kycupdate(){
//$date = date("Y/m/d");

$doc_type =$this->input->post('doc_type');
$doc_no =$this->input->post('doc_no');
$id = $this->input->post('employee_id');
$name_as_aadhaar = $this->input->post('doc_name');





        $data = array(
                'emp_id'  => strtoupper($this->input->post('employee_id')), 
              'doc_type'  => strtoupper($this->input->post('doc_type')), 
                'doc_num' => strtoupper($this->input->post('doc_no')), 
               'doc_name' => strtoupper($this->input->post('doc_name')), 
                   'ifsc' => strtoupper($this->input->post('ifsc')), 
              'kyc_image' => strtoupper($this->input->post('doc_img')), 
                   'date' => strtoupper($this->input->post('kyc_date')), 
            );
		$result = $this->db->insert('kyc_master',$data);

				
		if($doc_type=="AADHAAR CARD"){ 

        $this->db->set('aadhaar_no', $doc_no);
        $this->db->set('name_as_aadhaar', $name_as_aadhaar);
        $this->db->where('emp_id', $id);
        $result1=$this->db->update('employee_master');
		
		}

		
		
	return  $result;
	}
	
function nominee_detail_save(){
		$dob = $this->input->post('dob');
		
		
//		$dob = date("Y-m-d", strtotime($dob));
$date = date("Y/m/d");
        $data = array(
                'emp_id'  => strtoupper($this->input->post('employee_id')), 
          'nominee_name'  => strtoupper($this->input->post('name')), 
             'address_id' => strtoupper($this->input->post('address')), 
                    'dob' => strtoupper($dob), 
                  'share' => strtoupper($this->input->post('share')), 
                   'date' => strtoupper($date), 
            'nomi_aadhar' => strtoupper($this->input->post('nomi_adhar_no')), 
          'nomi_relation' => strtoupper($this->input->post('nomi_relation')), 
          'guardian_name' => strtoupper($this->input->post('g_name')), 
       'guardian_address' => strtoupper($this->input->post('g_address')), 
            );
		$result = $this->db->insert('nominee_master',$data);

	return  $result;
	}
function family_detail_save(){
	$date = date("Y/m/d");
		$dob = $this->input->post('dob');
//		$dob = date("Y-m-d", strtotime($dob));

        $data = array(
                     'emp_id'  => strtoupper($this->input->post('employee_id')), 
                'family_name'  => strtoupper($this->input->post('name')), 
              'dob_as_aadhaar' => strtoupper($dob), 
                    'relation' => strtoupper($this->input->post('relation')), 
                        'date' => strtoupper($date), 
              'family_aadhaar' => strtoupper($this->input->post('family_aadhaar')), 
            );
		$result = $this->db->insert('family_master',$data);
	return  $result;
	}
	    function employee_delete(){
        $id =$this->input->post('id');

/*        $this->db->set('status','0');
        $this->db->where('emp_id', $id);
		$result= $this->db->update('employee_master');
        return $result;
*/
		
		$this->db->where('emp_id', $id);
        $result1=$this->db->delete('kyc_master');

		$this->db->where('emp_id', $id);
        $result2=$this->db->delete('nominee_master');

		$this->db->where('emp_id', $id);
        $result3=$this->db->delete('family_master');

        $this->db->where('emp_id', $id);
        $result=$this->db->delete('employee_master');
        return $result;
		
    }

	
	/*-----------kyc export----------*/
	 function kyc_export_show(){	
		$from_date = $this->input->post('startdate');

		$to_date = $this->input->post('enddate');
					
	$getdata = $this->db->query("SELECT km.*,em.name_as_aadhaar,em.UAN FROM kyc_master km inner join employee_master em on em.emp_id=km.emp_id WHERE date between '".$from_date."' and '".$to_date."'");
	// $getdata=$this->db->get();
        return $getdata->result();		
    }
	/*-----------kyc export----------*/
	
	/*-----------kyc export----------*/
	 function employee_name_get(){	
	$getdata = $this->db->query("SELECT em.emp_id,em.name_as_aadhaar,em.employee_type FROM employee_master em where em.status='1'  and substr(`member_id_org`,1,15)='".$_SESSION['company_id']."'  ");
        return $getdata->result();
		
    }
	/*-----------kyc export----------*/
	/*-----------kyc export----------*/
	 function kyc_detail_delete(){	
		$id =$this->input->post('employee_id');
		$this->db->where('emp_id', $id);
        $result1=$this->db->delete('kyc_master');
		return $result1;
    }
	/*-----------kyc export----------*/
	

		/*-----------kyc detail search 	for kyc update start----------*/
		function kyc_details_search(){
		$i = 0;				
               $emp_name = $this->input->post('emp_name'); 
               $uan = $this->input->post('uan'); 
               $emp_id = $this->input->post('emp_id'); 
			   $query = "SELECT km.*,em.emp_id,em.name_as_aadhaar,em.member_id,em.UAN FROM employee_master em inner join kyc_master km on em.emp_id=km.emp_id  ";
			   
			   if($emp_id != ""){ 
			   if($i == 0){ $query .= " where "; }
				$query .= " em.member_id ='".$emp_id."' ";
				$i = 1;
				}
			   if($uan != ""){
			   if($i == 0){ $query .= " where "; }
			   if($i == 1){ $query .= " and "; }
				$query .= " em.UAN ='".$uan."' ";
				$i = 2;
				}
			   if($emp_name != ""){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " and "; }
				$query .= " em.emp_id ='".$emp_name."' ";
				}
				
	$query .= " and em.status ='1' and substr(`member_id_org`,1,15)='".$_SESSION['company_id']."'   ";
			
		$getdata = $this->db->query($query);
			//		$getdata=$this->db->get();
        return $getdata->result();
    }
		/*-----------kyc detail search for kyc update end----------*/
	/*-----------kyc export----------*/
	 function mobileno_check(){	
	  $mobile =$this->input->post('mobile');
//		  $mobile =  "8181818181";
	  
			$this->db->where('mobile',$mobile);
			$query = $this->db->get('employee_master');
			if ($query->num_rows() > 0){
				return 1;
			}
			else{
				return 0;
			}
	}
	/*-----------kyc export----------*/
		    function employee_export_search(){
  $month_year =$this->input->post('month_year');
  
  
//				
				$getdata= $this->db->query('SELECT * FROM `employee_master` where doj like "'.$month_year.'%"  and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  ');
			$row1 =	$getdata->result();
				
				
			$result = array();	
			
   foreach($getdata->result() as $rows1)
   {
       $emp_id = $rows1->emp_id;
				$getkyc= $this->db->query('SELECT * FROM kyc_master where emp_id="'.$emp_id.'" and doc_type = ("PAN" or "BANK") ');
				$kyc =	$getkyc->result();
				
	$acc_no = ""; 			
	$ifsc = ""; 			
	$name_banck = ""; 			
	$pan = ""; 			
	$name_pan = "";
	
   foreach($getkyc->result() as $kyc)
   {
       $doc_type = $kyc->doc_type;
	   if($doc_type == "BANK"){
       $acc_no = $kyc->doc_num;
       $name_banck = $kyc->doc_name;
       $ifsc = $kyc->ifsc;		   
		   }
	   if($doc_type == "PAN"){
       $pan = $kyc->doc_num;
       $name_pan = $kyc->doc_name;
		   }
   
   }		
//   $uae = "";
	   $row = $rows1->emp_id.'####'.$rows1->UAN.'####'.$rows1->previus_member_id.'####'.$rows1->dob.'####'.$rows1->doj.'####'.$rows1->gender.'####'.$rows1->father_husband.'####'.$rows1->relation.'####'.$rows1->mobile.'####'.$rows1->email.'####'.$rows1->nationality.'####'.$rows1->wages_join.'####'.$rows1->qualification.'####'.$rows1->marital_status.'####'.$rows1->international_worker.'####'.$rows1->contry_origin.'####'.$rows1->passport_no.'####'.$rows1->passport_from_date.'####'.$rows1->passport_till_date.'####'.$rows1->physical_handicap.'####'.$rows1->locomotive.'####'.$rows1->hearing.'####'.$rows1->visual.'####'.$rows1->employee_type.'####'.$acc_no.'####'.$ifsc.'####'.$name_banck.'####'.$pan.'####'.$name_pan.'####'.$rows1->aadhaar_no.'####'.$rows1->name_as_aadhaar.'####'.$rows1->member_id;

				array_push($result,$row);
   }	

			
//			$n = count($getdata);
//			for($i=0;$i<$n;$i++)
//			{
	//	$id = $getdata[$i]['emp_id'];
		
//		        $this->db->where('emp_id',$id);
//        $getdata=$this->db->get('kyc_master');
//        $getkyc->result();
		
//			}
			
       return $result;
 			
							
					
//					=$this->db->get('employee_master');
    }
	
		 function employee_name_from_date_get(){
			$result1 = array();	
			
		$startdate =$this->input->post('startdate');
		$enddate =$this->input->post('enddate');
		
		if(($startdate=="")||($startdate==null)||($enddate=="")||($enddate==null)){
		
			$entry_data = $this->db->query("SELECT em.emp_id,em.name_as_aadhaar,em.employee_type  FROM employee_master em where em.employee_type='OFFICE STAFF' and  em.status='1'   and substr(`member_id_org`,1,15)='".$_SESSION['company_id']."'    ");
			foreach($entry_data->result() as $available)
			{
				$emp_name=$available->name_as_aadhaar;
				$employee_id=$available->emp_id;
				
					$row=$employee_id."####".$emp_name;
							array_push($result1,$row);
			}


		}
		
		
		else{
			$from_date = date("Y-m-d", strtotime($startdate));
			$to_date = date("Y-m-d", strtotime($enddate));
			
		
		$entry_data = $this->db->query("SELECT em.emp_id,em.name_as_aadhaar,em.employee_type  FROM employee_master em where em.employee_type='OFFICE STAFF' and em.status='1' ");
		foreach($entry_data->result() as $available)
		{
			$emp_name=$available->name_as_aadhaar;
			$employee_id=$available->emp_id;
			
			
	$this->db->where('employee_id="'.$employee_id.'" and "'.$from_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  "'.$to_date.'"   BETWEEN from_date and to_date ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  from_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
	$this->db->or_where('employee_id="'.$employee_id.'" and  to_date   BETWEEN "'.$from_date. '" and "'.$to_date.'" ');
		$this->db->from('office_staff_salary');
		$check = $this->db->count_all_results();
		if($check==0){
			$row=$employee_id."####".$emp_name;
					array_push($result1,$row);
		}
		
		}
		
		}
        return $result1;				
		
    }

    function imssing_details_search(){
	$i = 0;
                 $name = $this->input->post('name'); 
                 $dob = $this->input->post('dob'); 
                 $doj = $this->input->post('doj'); 
                 $gender = $this->input->post('gender'); 
                 $relation = $this->input->post('relation'); 
                 $maritalstatus = $this->input->post('maritalstatus'); 
                 $qualification = $this->input->post('qualification'); 
                 $adharkyc = $this->input->post('adharkyc'); 
                 $pankyc = $this->input->post('pankyc'); 
                 $bankkyc = $this->input->post('bankkyc'); 
							 
				 
				 
				 
				 
				 
				 
				 
			   $query = "SELECT em.*,km.* FROM employee_master em inner join kyc_master km on km.emp_id=em.emp_id ";
			   
			   if($name == "Y"){ 
			   if($i == 0){ $query .= " where "; }
				$query .= " em.name_as_aadhaar ='' ";
				$i = 1;
				}
			   if($dob == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " em.dob ='0000-00-00' ";
				$i = 2;
				}
			   if($doj == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " em.doj ='0000-00-00' ";
				$i = 2;
				}
			   if($gender == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " em.gender ='' ";
				$i = 2;
				}
			   if($relation == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " ( em.relation ='' or em.relation='NOT AVAILABLE'  )";
				$i = 2;
				}
			   if($maritalstatus == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " ( em.marital_status ='' or em.marital_status='NOT AVAILABLE' ) ";
				$i = 2;
				}
			   if($qualification == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " em.qualification ='' ";
				$i = 2;
				}
			   if($adharkyc == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " ( em.aadhaar_no='' or  em.aadhaar_no='NOT AVAILABLE'  ) ";
				$i = 2;
				}
			   if($pankyc == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " ( km.doc_type='PAN' and ( km.doc_num='NOT AVAILABLE' or  km.doc_num='' ) )  ";
				$i = 2;
				}
			   if($bankkyc == "Y"){
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " or "; }
				$query .= " ( km.doc_type='BANK' and ( km.doc_num='NOT AVAILABLE' or  km.doc_num='' ) )  ";
				$i = 2;
				}
			   if($i == 0){ $query .= " where "; }
			   if($i != 0){ $query .= " and "; }
				
	$query .= "  em.status ='1'   and substr(`member_id_org`,1,15)='".$_SESSION['company_id']."'  GROUP by km.emp_id ";
  
			$getdata= $this->db->query($query);
			$row1 =	$getdata->result();
				
				
			$result = array();	
			
   foreach($getdata->result() as $rows1)
   {
       $emp_id = $rows1->emp_id;
				$getkyc= $this->db->query('SELECT * FROM kyc_master where emp_id="'.$emp_id.'" and doc_type = ("PAN" or "BANK" or "AADHAAR CARD" ) ');
				$kyc =	$getkyc->result();
				
	$acc_no = ""; 			
	$ifsc = ""; 			
	$name_banck = ""; 			
	$pan = ""; 			
	$name_pan = "";
	
   foreach($getkyc->result() as $kyc)
   {
       $doc_type = $kyc->doc_type;
	   if($doc_type == "BANK"){
       $acc_no = $kyc->doc_num;
       $name_banck = $kyc->doc_name;
       $ifsc = $kyc->ifsc;		   
		   
		   }
		   
	   if($doc_type == "PAN"){
       $pan = $kyc->doc_num;
       $name_pan = $kyc->doc_name;
		   
		   }
   
   }		
	   $row = $rows1->emp_id.'####'.$rows1->UAN.'####'.$rows1->previus_member_id.'####'.$rows1->dob.'####'.$rows1->doj.'####'.$rows1->gender.'####'.$rows1->father_husband.'####'.$rows1->relation.'####'.$rows1->mobile.'####'.$rows1->email.'####'.$rows1->nationality.'####'.$rows1->wages_join.'####'.$rows1->qualification.'####'.$rows1->marital_status.'####'.$rows1->international_worker.'####'.$rows1->contry_origin.'####'.$rows1->passport_no.'####'.$rows1->passport_from_date.'####'.$rows1->passport_till_date.'####'.$rows1->physical_handicap.'####'.$rows1->locomotive.'####'.$rows1->hearing.'####'.$rows1->visual.'####'.$rows1->employee_type.'####'.$acc_no.'####'.$ifsc.'####'.$name_banck.'####'.$pan.'####'.$name_pan.'####'.$rows1->aadhaar_no.'####'.$rows1->name_as_aadhaar.'####'.$rows1->member_id;

				array_push($result,$row);
   }	

			
			
       return $result;
//       return $query;
 			
							
					
//					=$this->db->get('employee_master');
    }
	
    function email_address_update(){
		                 $adharno = $this->input->post('adharno'); 

					$this->db->select('website');    
					$this->db->from('company_master');
					$this->db->where('estb_id',$_SESSION['company_id']);
					$query = $this->db->get();
	
        $website = $query->row()->website;
		
		$email = $adharno."@".$website;
		return $email;
    }
}	
?>