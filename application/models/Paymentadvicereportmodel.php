<?php
class Paymentadvicereportmodel extends CI_Model{
	
	    function show_paymentadvicereport(){
			
		$month_year = $this->input->post('month_year');
		$emptype = $this->input->post('emptype');

//		$month_year = "05/2018";
//		$emptype = "BIDI PACKER";
//		$emptype = "OFFICE STAFF";
//		$emptype = "BIDI MAKER";
		
		if($emptype == "BIDI MAKER"){		
				$contractor =  $this->input->post('contractor');
		}
//					$contractor =  "all";
		

		$result = array();
		$row = "";
		$net_wages = 0;

		   if($emptype=="OFFICE STAFF"){
			   
				$query = $this->db->query('select oe.id,oe.net_wages,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em inner join office_staff_entry oe on oe.employee_id=em.emp_id inner join kyc_master km on km.emp_id=em.emp_id  where em.employee_type="'.$emptype.'" and oe.month_year="'.$month_year.'"  and km.doc_type="BANK"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by km.ifsc ASC');
		   }
		   elseif($emptype=="BIDI PACKER"){

				$query = $this->db->query('select oe.packers_entry_id as id,oe.net_wages,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em inner join packers_entry oe on oe.employee_id=em.emp_id inner join kyc_master km on km.emp_id=em.emp_id  where em.employee_type="'.$emptype.'" and oe.month_year="'.$month_year.'" and km.doc_type="BANK"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by km.ifsc ASC');
			   
		   }
		   elseif($emptype=="BIDI MAKER"){

		   if($contractor=="all"){
				$query = $this->db->query('select oe.bidi_roller_entry_id as id,oe.net_wages,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em inner join bidi_roller_entry oe on oe.employee_id=em.emp_id inner join kyc_master km on km.emp_id=em.emp_id  where em.employee_type="'.$emptype.'" and oe.month_year="'.$month_year.'" and km.doc_type="BANK"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by km.ifsc ASC');
				
			}
			else{
				$query = $this->db->query('select oe.net_wages,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em inner join bidi_roller_entry oe on oe.employee_id=em.emp_id inner join kyc_master km on km.emp_id=em.emp_id  where em.employee_type="'.$emptype.'" and em.contractor="'.$contractor.'" and oe.month_year="'.$month_year.'" and km.doc_type="BANK"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by km.ifsc ASC');
				
			}
			   
		   }
		   $n = 0;
				foreach($query->result() as $employee)
				{
					$n = $n+1;
//					echo $n."<br>";
					$account_no = "";			
					$ifsc_no = "";			

							   $emp_id = $employee->emp_id;			
$company_name = "";
$address = "";	
		   $query3 = $this->db->query('select cm.name,am.address from company_master cm inner join address_master am on am.id=cm.address_id ');						   
				foreach($query3->result() as $company)
				{
					$company_name = $company->name;			
					$address = $company->address;			
				}	

					
				$query2 = $this->db->query('select doc_num,ifsc from kyc_master where emp_id="'.$emp_id.'" and doc_type="BANK" ');						   
				foreach($query2->result() as $kyc)
				{
					$account_no = $kyc->doc_num;			
					$ifsc_no = $kyc->ifsc;			
				}	
					
		   $id = $employee->id;			
		   $member_id = $employee->member_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $uan = $employee->UAN;			
		   $employee_type = $employee->employee_type;			
			$net_wages = $employee->net_wages;
	if($net_wages!=0){
	$row = $name_as_aadhaar.'####'.$member_id.'####'.$account_no.'####'.$ifsc_no.'####'.round($net_wages).'####'.$company_name.'####'.$address.'####'.$id;
		array_push($result,$row);
	}
					
					
	
					
				}
//				echo "<pre>";
//				print_r($result);
//				echo "</pre>";
				
				return $result;	
				
		   }
		
	
			

}
?>