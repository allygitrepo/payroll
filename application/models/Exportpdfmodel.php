<?php
class Exportpdfmodel extends CI_Model{
	
    function formeleven_view(){
			$month_year	=$this->input->post('month_year');
				//$month_year	= "05/2018";
		$month_year = explode("/",$month_year); 
		
		$result1 = array();
		$result2 = array();



		$member_id	=$this->input->post('member_id');
						
		if(trim($member_id)==""){
        $query1=$this->db->query('select contry_origin,member_id_org,UAN,doj,address_id,name_as_aadhaar,emp_id,relation,father_husband,dob,gender,marital_status,email,mobile,international_worker,passport_no,passport_from_date,passport_till_date from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		}
		else{
			
		$member_id= trim($member_id);	
		$strlen = strlen($member_id);
		if($strlen<7){
				$member = "";
			$zero = 7-$strlen;
			for($i=0;$i<$zero;$i++)
			{
				$member .= "0";
			}
			$member_id = $member.$member_id;
		}

        $query1=$this->db->query('select contry_origin,member_id_org,UAN,doj,address_id,name_as_aadhaar,emp_id,relation,father_husband,dob,gender,marital_status,email,mobile,international_worker,passport_no,passport_from_date,passport_till_date from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" and member_id="'.$member_id.'"  order by member_id asc');
		}
		
		

		foreach($query1->result() as $employee_master)
		{
$emp_id 				=$employee_master->emp_id; 				
$result2['contry_origin']		=$employee_master->contry_origin;		
$result2['member_id_org']		=$employee_master->member_id_org;		
$result2['name_as_aadhaar']		=$employee_master->name_as_aadhaar;		
$result2['relation']               =$employee_master->relation;               
$result2['father_husband']         =$employee_master->father_husband;         
$result2['uan']                    =$employee_master->UAN;                    
$result2['dob']                    =$employee_master->dob;                    
$result2['doj']                    =$employee_master->doj;                    
$doj                    =$employee_master->doj;                    
$result2['gender']                 =$employee_master->gender;                 
$result2['marital_status']         =$employee_master->marital_status;         
$result2['email']                  =$employee_master->email;                  
$result2['mobile']                 =$employee_master->mobile;                 
$result2['international_worker']   =$employee_master->international_worker;   
$result2['passport_no']            =$employee_master->passport_no;            
$result2['passport_from_date']     =$employee_master->passport_from_date;     
$result2['passport_till_date']		=$employee_master->passport_till_date;		
$address_id		=$employee_master->address_id;		
$post_office = "";
        $query2=$this->db->query('select post_office from address_master where id="'.$address_id.'" ');
			if($query2->num_rows()>0){
					$post_office = $query2->row()->post_office;
			}
        $query3=$this->db->query('select doc_type,doc_num,ifsc from kyc_master where emp_id="'.$emp_id.'" ');
		
	$aadhaar_no = "";
	$bank_acc_no = "";
	$ifsc = "";
	$pan_no	= "";
		
		foreach($query3->result() as $kyc_master)
			{
				$doc_type	=	$kyc_master->doc_type;
				
				if($doc_type=="BANK"){					
				$bank_acc_no	=	$kyc_master->doc_num; 
				$ifsc	=	$kyc_master->ifsc; 
				}	

				if($doc_type=="PAN"){					
				$pan_no	=	$kyc_master->doc_num; 
				}	
				if($doc_type=="AADHAAR CARD"){					
				$aadhaar_no	=	$kyc_master->doc_num; 
				}	
			}

	$result2['post_office']	= $post_office;	
	$result2['bank_acc_no']	= $bank_acc_no;		
	$result2['ifsc']	= $ifsc;		
	$result2['pan_no']	= $pan_no;		
	$result2['aadhaar_no']	= $aadhaar_no;		

$date=date_create($doj);
date_add($date,date_interval_create_from_date_string("15 days"));
$result2['next_days'] = date_format($date,"d/m/Y");



					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$compquery = $this->db->get();
								$result2['comp_post_office']	 = "";
							foreach($compquery->result() as $companyaddress)
							{
								$result2['comp_post_office']	 = $companyaddress->post_office;
							}	


	array_push($result1,$result2);	
	
		
}
		
       return $result1;
    }
   function data_pfclaimform(){
	   
	   
	   
	   
		$member_id	=$this->input->post('member_id');
		$strlen = strlen($member_id);
		if($strlen<7){
				$member = "";
			$zero = 7-$strlen;
			for($i=0;$i<$zero;$i++)
			{
				$member .= "0";
			}
			$member_id = $member.$member_id;
		}
		
			   $this->db->select('*');    
					$this->db->from('resignation_master');
					$this->db->join('employee_master', 'resignation_master.member_id = employee_master.member_id');
					$this->db->where('substr(`member_id_org`,1,15)',$_SESSION['company_id']);
					$this->db->where('resignation_master.member_id',$member_id);
					$getdata=$this->db->get();	
	
	$result = array();
					
				if($getdata->num_rows() >0){
					foreach($getdata->result() as $resignation)
					{
						$emp_id = $resignation->emp_id;
						$name = $resignation->name_as_aadhaar;
						$uan = $resignation->UAN;
						$adharno = $resignation->aadhaar_no;
						$doj = $resignation->doj;
						
			$timestamp = strtotime($doj);
			$doj = date('d/M/y', $timestamp); 
						
						$leaving_date = $resignation->leaving_date;
			$timestamp = strtotime($leaving_date);
			$leaving_date = date('d/M/y', $timestamp); 


						$reason1= $resignation->reason;
						
					if($reason1=="R"){$reason = "RETIREMENT";}
					if($reason1=="D"){$reason = "DEATH IN SERVICE";}
					if($reason1=="S"){$reason = "SUPERNNUATION";}
					if($reason1=="P"){$reason = "PERMANENT DISABLEMENT";}
					if($reason1=="C"){$reason = "CESSATION (SHORT SERVICE)";}
					if($reason1=="A"){$reason = "DEATH AWAY FROM SERVICE";}				
						
						
						
						$address_id= $resignation->address_id;
						
						
				$getkyc= $this->db->query('SELECT doc_num FROM kyc_master where emp_id="'.$emp_id.'" and doc_type = "PAN"  ');
				$kyc =	$getkyc->result();
				
					$pan = ""; 			
					
				foreach($getkyc->result() as $kyc)
				{
					$pan = $kyc->doc_num;
				}		

				$getaddress= $this->db->query('SELECT * FROM address_master where id="'.$address_id.'"   ');
			//	$addressdata =	$getaddress->result();
				
					$pan = ""; 			
								$address = "";		
								$post_office = "";		
								$district = "";		
								$pincode = "";	
				foreach($getaddress->result() as $addressdata)
				{
					$address = $addressdata->address;
					$post_office = $addressdata->post_office;
					$district = $addressdata->district;
					$pincode = $addressdata->pincode;
				}		

					array_push($result,$name,$uan,$adharno,$doj,$leaving_date,$pan,$reason,$address,$post_office,$district,$pincode);					
						
					}
				}
				else{
//					array_push($result);					
				}
	
	return	$result;
	
    }
 	
   function data_form2(){
			$month_year	=$this->input->post('month_year');
		$month_year = explode("/",$month_year); 
		
		$result1 = array();
		$result2 = array();
		
		
				$member_id	=$this->input->post('member_id');
						
		if(trim($member_id)==""){
        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		}
		else{
			
		$member_id= trim($member_id);	
		$strlen = strlen($member_id);
		if($strlen<7){
				$member = "";
			$zero = 7-$strlen;
			for($i=0;$i<$zero;$i++)
			{
				$member .= "0";
			}
			$member_id = $member.$member_id;
		}

        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'" and member_id="'.$member_id.'"    order by member_id asc');
		}
		
		
		foreach($query1->result() as $employee_master)
		{
$emp_id 				=$employee_master->emp_id; 		
$result2['emp_id']		= $emp_id;		
		
$result2['member_id']		=$employee_master->member_id;		
$result2['contry_origin']		=$employee_master->contry_origin;		
$result2['member_id_org']		=$employee_master->member_id_org;		
$result2['name_as_aadhaar']		=$employee_master->name_as_aadhaar;		
$result2['relation']               =$employee_master->relation;               
$result2['father_husband']         =$employee_master->father_husband;         
$result2['uan']                    =$employee_master->UAN;                    
$result2['dob']                    =$employee_master->dob;                    
$result2['doj']                    =$employee_master->doj;                    
$result2['gender']                 =$employee_master->gender;                 
$result2['marital_status']         =$employee_master->marital_status;         
$result2['email']                  =$employee_master->email;                  
$result2['mobile']                 =$employee_master->mobile;                 
$result2['international_worker']   =$employee_master->international_worker;   
$result2['passport_no']            =$employee_master->passport_no;            
$result2['passport_from_date']     =$employee_master->passport_from_date;     
$result2['passport_till_date']		=$employee_master->passport_till_date;		
$address_id		=$employee_master->address_id;		
$post_office = "";
        $query2=$this->db->query('select post_office from address_master where id="'.$address_id.'" ');
			if($query2->num_rows()>0){
					$post_office = $query2->row()->post_office;
			}
        $query3=$this->db->query('select doc_type,doc_num,ifsc from kyc_master where emp_id="'.$emp_id.'" ');
		
	$aadhaar_no = "";
	$bank_acc_no = "";
	$ifsc = "";
	$pan_no	= "";
		
		foreach($query3->result() as $kyc_master)
			{
				$doc_type	=	$kyc_master->doc_type;
				
				if($doc_type=="BANK"){					
				$bank_acc_no	=	$kyc_master->doc_num; 
				$ifsc	=	$kyc_master->ifsc; 
				}	

				if($doc_type=="PAN"){					
				$pan_no	=	$kyc_master->doc_num; 
				}	
				if($doc_type=="AADHAAR CARD"){					
				$aadhaar_no	=	$kyc_master->doc_num; 
				}	
			}

	$result2['post_office']	= $post_office;	
	$result2['bank_acc_no']	= $bank_acc_no;		
	$result2['ifsc']	= $ifsc;		
	$result2['pan_no']	= $pan_no;		
	$result2['aadhaar_no']	= $aadhaar_no;		
	
	
	
	
					$getaddress= $this->db->query('SELECT * FROM address_master where id="'.$address_id.'"   ');
			
			//	$addressdata =	$getaddress->result();
				
					$result2['address']		= "";		
					$result2['post_office']  = "";		
					$result2['district'] 	 = "";		
					$result2['pincode']		 = "";	
				foreach($getaddress->result() as $addressdata)
				{
					$result2['address']		 = $addressdata->address;
					$result2['post_office'] = $addressdata->post_office;
					$result2['district'] 	= $addressdata->district;
					$result2['pincode']		 = $addressdata->pincode;
				}		
		
		
		
					$result2['comp_name']		= "";		
					$result2['comp_address']		= "";		
					$result2['comp_post_office']  = "";		
					$result2['comp_district'] 	 = "";		
					$result2['comp_pincode']		 = "";	

					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$compquery = $this->db->get();
							foreach($compquery->result() as $companyaddress)
							{
								$result2['comp_address']		 = $companyaddress->address;
								$result2['comp_post_office']	 = $companyaddress->post_office;
								$result2['comp_district'] 	    	= $companyaddress->district;
								$result2['comp_pincode']		 = $companyaddress->pincode;
								$result2['comp_name']		 = $companyaddress->name;
							}	



		
		
	array_push($result1,$result2);	
	
		
}
		
        return $result1;
    }
	function data_nominee(){
		
				$result1 = array();
		$result2 = array();

				$month_year	=$this->input->post('month_year');
						$month_year = explode("/",$month_year); 
	        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		foreach($query1->result() as $employee_master)
		{
			$emp_id	= $employee_master->emp_id; 				
		
					$getnominee= $this->db->query('SELECT share,dob,guardian_name,guardian_address,nominee_name,address_id,nomi_relation FROM nominee_master where emp_id="'.$emp_id.'"   ');
				
					$result2['emp_id']		= $emp_id;		
				foreach($getnominee->result() as $nomineedata)
				{
					$result2['nominee_name']		 = $nomineedata->nominee_name;
					$address_id	= $nomineedata->address_id; 				
					$result2['nomi_relation']	= $nomineedata->nomi_relation; 				
					$result2['dob']	= $nomineedata->dob; 				
					$result2['guardian_address']	= $nomineedata->guardian_address; 				
					$result2['guardian_name']	= $nomineedata->guardian_name; 				
					$result2['share']	= $nomineedata->share; 				
					
					
			$getaddress= $this->db->query('SELECT * FROM address_master where id="'.$address_id.'"   ');
			//	$addressdata =	$getaddress->result();
				
					$result2['address']		= "";		
					$result2['post_office']  = "";		
					$result2['district'] 	 = "";		
					$result2['pincode']		 = "";	

							foreach($getaddress->result() as $addressdata)
							{
								$result2['address']		 = $addressdata->address;
								$result2['post_office'] = $addressdata->post_office;
								$result2['district'] 	= $addressdata->district;
								$result2['pincode']		 = $addressdata->pincode;
							}	



							
					
					array_push($result1,$result2);
					
					
				}		
		
		

		
		
	
		
}
        return $result1;
    			
				

	}

	function data_family(){
		
		$result1 = array();
		$result2 = array();

				$month_year	=$this->input->post('month_year');
				$month_year = explode("/",$month_year); 
	        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		foreach($query1->result() as $employee_master)
		{
			$emp_id	= $employee_master->emp_id; 				
		
					$getnominee= $this->db->query('SELECT * FROM family_master where emp_id="'.$emp_id.'"   ');
				
					$result2['emp_id']		= $emp_id;		
				foreach($getnominee->result() as $nomineedata)
				{
					$result2['family_name']		 = $nomineedata->family_name;
					$result2['family_relation']	= $nomineedata->relation; 				
					$result2['dob_as_aadhaar']	= $nomineedata->dob_as_aadhaar; 				
					
					
					array_push($result1,$result2);
					
					
				}		
		
		

		
		
	
		
}
        return $result1;
    			
				

	}

	   function data_form3a(){
//				$month_year = "2018";
			
			$month_year = $this->input->post('month_year');
				$date = $month_year."-01-01";
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $month_year;	   
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-03-01',$timestamp);
			$last = date($next_year.'-02-31',$timestamp);
	

			
		$result1 = array();
		$result2 = array();

	$start    = (new DateTime($first));
	$end      = (new DateTime($last));
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);
	$month_head = '';
			$result2['year'] = $year;
			$result2['next_year'] = $next_year;

				$member_id	=$this->input->post('member_id');
						$month_year = explode("/",$month_year); 
						
		if(trim($member_id)==""){
			$query = $this->db->query('select em.status,em.gender,em.address_id,em.father_husband,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where    substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');			
		}
		else{
			
		$member_id= trim($member_id);	
		$strlen = strlen($member_id);
		if($strlen<7){
				$member = "";
			$zero = 7-$strlen;
			for($i=0;$i<$zero;$i++)
			{
				$member .= "0";
			}
			$member_id = $member.$member_id;
		}

			$query = $this->db->query('select em.status,em.gender,em.address_id,em.father_husband,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em where    substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and member_id="'.$member_id.'"   order by em.member_id ASC');			
		}		
	
			
		foreach($query->result() as $employee)
		{
			
			
			
			$result2['member_id'] = $employee->member_id;			
			$member_id = $employee->member_id;			
		   $emp_id = $employee->emp_id;			
		   $address_id = $employee->address_id;			
		   	$result2['name_as_aadhaar'] = $employee->name_as_aadhaar;			
			$result2['father_husband'] = $employee->father_husband;			
			$result2['uan'] = $employee->UAN;			
		   $employee_type = $employee->employee_type;			
		   $gender = $employee->gender;			
		   $status = $employee->status;	
		   
		   

					$reason_full="";	
					$leaving_date="";	

			if($status==0){
			$query6 = $this->db->query('select leaving_date,reason from resignation_master where member_id="'.$member_id .'"     ');
				if($query6->num_rows() > 0){
				$leaving_date = $query6->row()->leaving_date;		   			
				$reason = $query6->row()->reason;

					if($reason=="R"){$reason_full = "RETIREMENT";}
					if($reason=="D"){$reason_full = "DEATH IN SERVICE";}
					if($reason=="S"){$reason_full = "SUPERNNUATION";}
					if($reason=="P"){$reason_full = "PERMANENT DISABLEMENT";}
					if($reason=="C"){$reason_full = "CESSATION (SHORT SERVICE)";}
					if($reason=="A"){$reason_full = "DEATH AWAY FROM SERVICE";}

				
				}
			}			
					$result2['reason']		 = $reason_full;	
					$result2['leaving_date']		 = $leaving_date;	

		$ac1eemf = 0;
		if($gender=="MALE"){
		$query5 = $this->db->query('select ac1eemale from challan_setup where "'.$first.'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
			if($query5->num_rows()>0){
				$ac1eemf = $query5->row()->ac1eemale;		   				
			}
		}
		else{
		$query5 = $this->db->query('select ac1eefemale from challan_setup where "'.$first.'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
			if($query5->num_rows()>0){
				$ac1eemf = $query5->row()->ac1eefemale;		   				
			}
		}	 
      
			$result2['ac1eemf']=$ac1eemf;
		   
			$getaddress= $this->db->query('SELECT * FROM address_master where id="'.$address_id.'"   ');
			//	$addressdata =	$getaddress->result();
				
					$result2['address']		= "";		
					$result2['post_office']  = "";		
					$result2['district'] 	 = "";		
					$result2['pincode']		 = "";	

							foreach($getaddress->result() as $addressdata)
							{
								$result2['address']		 = $addressdata->address;
								$result2['post_office'] = $addressdata->post_office;
								$result2['district'] 	= $addressdata->district;
								$result2['pincode']		 = $addressdata->pincode;
							}			
					
		   
   					$result2['comp_name']		= "";		
					$result2['comp_address']		= "";		
					$result2['comp_post_office']  = "";		
					$result2['comp_district'] 	 = "";		
					$result2['comp_pincode']		 = "";	

					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$compquery = $this->db->get();
							foreach($compquery->result() as $companyaddress)
							{
								$result2['comp_address']		 = $companyaddress->address;
								$result2['comp_post_office']	 = $companyaddress->post_office;
								$result2['comp_district'] 	    	= $companyaddress->district;
								$result2['comp_pincode']		 = $companyaddress->pincode;
								$result2['comp_name']		 = $companyaddress->name;
							}
		   
		   
		   $i = 0;
//		   echo $i;
		foreach ($period as $dt){
			$i=$i+1;
//				echo $i."<br>";
		
		$month_get = $dt->format("F Y");

$time = strtotime($month_get);				
$final = date("F Y", strtotime("+1 month",$time));
		$result2['month_name'.$i] = $final;

				$entrymonth = $dt->format("m/Y");
				
//				$check_date = $dt->format("Y-m-15");


$query_check = 0;

			$result2['gross_wages'.$i] = 0;		
			$result2['workers_share'.$i]  = 0;		
			$result2['emp_share_epf'.$i]  = 0;		
			$result2['emp_share_eps'.$i]  = 0;		
			$result2['emp_ncp_days'.$i] = 0;

			
		   if($employee_type=="OFFICE STAFF"){
				$query1 = $this->db->query('select * from office_staff_entry where employee_id="'.$emp_id.'" and month_year="'.$entrymonth.'" ');						   
		   }
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select * from packers_entry where employee_id="'.$emp_id.'" and month_year="'.$entrymonth.'" ');			
			}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select * from bidi_roller_entry where employee_id="'.$emp_id.'" and month_year="'.$entrymonth.'" ');			
			}
			if(isset($query1)){
				
			foreach($query1->result() as $officestaff)
				{

					$gross_wages = $officestaff->gross_wages;			

			$result2['gross_wages'.$i] = $gross_wages;
			
					$epf_wages = $officestaff->epf_wages;			
					$eps_wages = $officestaff->eps_wages;			
					$edli_wages = $officestaff->edli_wages;			
					$epf_contri_remitted = $officestaff->epf_contri_remitted;			
			
			$result2['workers_share'.$i] = $epf_contri_remitted;		
			$eps_contri_remitted = $officestaff->eps_contri_remitted;			
					$epf_eps_diff_remitted = $officestaff->epf_eps_diff_remitted;			
					$ncp_days = $officestaff->ncp_days;			
					$refund_of_advances = $officestaff->refund_of_advances;			
			
						$result2['emp_ncp_days'.$i] = $ncp_days;
						$result2['emp_share_epf'.$i] = $epf_eps_diff_remitted;
						$result2['emp_share_eps'.$i] = $eps_contri_remitted;
			
			$query_check = 1;

//		$row = $name_as_aadhaar.'####'.$member_id.'####'.$uan.'####'.$gross_wages."####".$epf_wages."####".$eps_wages."####".$edli_wages."####".$epf_contri_remitted."####".$eps_contri_remitted."####".$epf_eps_diff_remitted."####".$ncp_days.'####'.$refund_of_advances.'####'.$month_year;

				}
		


				
			} 
			

//			echo $result2['workers_share'.$i]."<br>";	
//			echo $i."--<br>";	
		
		   
		   
		
			}
											array_push($result1,$result2);			   
	//	   								if($query_check==1){
		//								}	

			
		}
		
//echo "<pre>";
//					print_r($result1);	
//echo "</pre>";

//					print_r($result1);	
		
				return $result1;	
		}	




	function data_son(){
		
		$result1 = array();
		$result2 = array();

				$month_year	=$this->input->post('month_year');
				$month_year = explode("/",$month_year); 
	        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		foreach($query1->result() as $employee_master)
		{
			$emp_id	= $employee_master->emp_id; 				
		
			$getnominee= $this->db->query('SELECT * FROM family_master where emp_id="'.$emp_id.'" order by dob_as_aadhaar DESC limit 1');
				
					

				foreach($getnominee->result() as $nomineedata)
				{
					$result2['son_emp_id']		= $emp_id;		
					$result2['son_name']		 = $nomineedata->family_name;
					$result2['son_relation']	= $nomineedata->relation; 				
					$result2['son_dob_as_aadhaar']	= $nomineedata->dob_as_aadhaar; 				
					array_push($result1,$result2);					
				}
					
		
}
        return $result1;
	}
	
	
	  function data_form5(){
		$month_year	=$this->input->post('month_year');
		$month_year = explode("/",$month_year); 
		
		$result1 = array();
		$result2 = array();
        $query1=$this->db->query('select * from employee_master where month(doj)="'.$month_year[0].'" and year(doj)="'.$month_year[1].'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		foreach($query1->result() as $employee_master)
		{
		
$result2['member_id']		=$employee_master->member_id;		
$result2['name_as_aadhaar']		=$employee_master->name_as_aadhaar;		
$result2['father_husband']         =$employee_master->father_husband;         
$dob                    =$employee_master->dob;
	$timestamp = strtotime($dob);
	$result2['dob'] = date('d/m/Y', $timestamp); 

	$doj = $employee_master->doj;
	$timestamp = strtotime($doj);
	$result2['doj'] = date('d/m/Y', $timestamp); 


                    
$result2['gender']                 =$employee_master->gender;                 

	
	
	
	
			
		
					$result2['comp_name']		= "";		
					$result2['comp_address']		= "";		
					$result2['comp_post_office']  = "";		
					$result2['comp_district'] 	 = "";		
					$result2['comp_pincode']		 = "";	

					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$compquery = $this->db->get();
							foreach($compquery->result() as $companyaddress)
							{
								$result2['comp_address']		 = $companyaddress->address;
								$result2['comp_post_office']	 = $companyaddress->post_office;
								$result2['comp_district'] 	    	= $companyaddress->district;
								$result2['comp_pincode']		 = $companyaddress->pincode;
								$result2['comp_name']		 = $companyaddress->name;
								$result2['comp_estb_id']		 = $companyaddress->estb_id;
							}	

	$timestamp = strtotime('01-'.$month_year[0].'-'.$month_year[1]);
	$result2['month_year'] = date('M-y', $timestamp); 
	
	
				if($month_year[0]==12){
				$next_month = 01;
				$next_year = $month_year[1]+1;
				}
				else{
				$next_month = $month_year[0]+1;
				$next_year = $month_year[1];
				}
	
	$timestamp = strtotime('15-'.$next_month.'-'.$next_year);
	$result2['next_month'] = date('d/m/Y', $timestamp); 
	
	
	
	
	array_push($result1,$result2);	
	
		
}
		
        return $result1;
    }
	

	  function data_form10(){
		$month_year	=$this->input->post('month_year');
		$month_year = explode("/",$month_year); 
		$month_year1 = $month_year[1].'-'.$month_year[0];	
		$result1 = array();
		$result2 = array();
        $query1=$this->db->query('select em.member_id,em.name_as_aadhaar,em.father_husband,rm.leaving_date,rm.reason from  resignation_master rm inner join employee_master em on em.member_id=rm.member_id where rm.leaving_date LIKE "'.$month_year1.'%"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by member_id asc');
		foreach($query1->result() as $employee_master)
		{
		
$result2['member_id']		=$employee_master->member_id;		
$result2['name_as_aadhaar']		=$employee_master->name_as_aadhaar;		
$result2['father_husband']         =$employee_master->father_husband;         
$dol                    =$employee_master->leaving_date;
	$timestamp = strtotime($dol);
	$result2['dol'] = date('d/m/Y', $timestamp); 

$reason1                    =$employee_master->reason;
$reason = "";
					if($reason1=="R"){ $reason = "RETIREMENT";}
					if($reason1=="D"){ $reason = "DEATH IN SERVICE";}
					if($reason1=="S"){ $reason = "SUPERNNUATION";}
					if($reason1=="P"){ $reason = "PERMANENT DISABLEMENT";}
					if($reason1=="C"){ $reason = "CESSATION (SHORT SERVICE)";}
					if($reason1=="A"){ $reason = "DEATH AWAY FROM SERVICE";}
	$result2['reason'] = $reason; 


                    

	
	
	
	
			
		
					$result2['comp_name']		= "";		
					$result2['comp_address']		= "";		
					$result2['comp_post_office']  = "";		
					$result2['comp_district'] 	 = "";		
					$result2['comp_pincode']		 = "";	

					$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$compquery = $this->db->get();
							foreach($compquery->result() as $companyaddress)
							{
								$result2['comp_address']		 = $companyaddress->address;
								$result2['comp_post_office']	 = $companyaddress->post_office;
								$result2['comp_district'] 	    	= $companyaddress->district;
								$result2['comp_pincode']		 = $companyaddress->pincode;
								$result2['comp_name']		 = $companyaddress->name;
								$result2['comp_estb_id']		 = $companyaddress->estb_id;
							}	

	$timestamp = strtotime('01-'.$month_year[0].'-'.$month_year[1]);
	$result2['month_year'] = date('M-y', $timestamp); 
	
	
				if($month_year[0]==12){
				$next_month = 01;
				$next_year = $month_year[1]+1;
				}
				else{
				$next_month = $month_year[0]+1;
				$next_year = $month_year[1];
				}
	
	$timestamp = strtotime('15-'.$next_month.'-'.$next_year);
	$result2['next_month'] = date('d/m/Y', $timestamp); 
	
	
	
	
	array_push($result1,$result2);	
	
		
}
		
        return $result1;
    }
	

	
	
		}
	
	

		
		
	
		

   

?>