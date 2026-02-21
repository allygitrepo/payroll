<?php
class Pfchallanyearlymodel extends CI_Model{
	
	
	    function pfchallanyearly_show(){
//				$month_year = "";
			$month_year = $this->input->post('month_year');
		if($month_year=="")
		{
				$date = date('Y-m-d');
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $date1[0];
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
			
		}
		else{
				$date = $month_year."-01-01";
						$date1 = explode("-",$date);		
						$month = $date1[1];	   
						$year = $month_year;	   
						$next_year = $year+1;			
			$timestamp = strtotime($date);
			$first = date('Y-04-01',$timestamp);
			$last = date($next_year.'-03-31',$timestamp);
		}
		
		$result = array();
		$i = 4;
		for($i=4;$i<=15;$i++)
		{
//			$j= $i-2;
			if($i==4  ){$month_name="April-".$year;}			
		elseif($i==5  ){$month_name="May-".$year;}
		elseif($i==6  ){$month_name="June-".$year;}
		elseif($i==7 ){$month_name="July-".$year;}
		elseif($i==8 ){$month_name="August-".$year;}
		elseif($i==9 ){$month_name="September-".$year;}
		elseif($i==10){$month_name="October-".$year;}
		elseif($i==11){$month_name="November-".$year;}
		elseif($i==12){$month_name="December-".$year;}
		elseif($i==13 ){$month_name="January-".$next_year;}
		elseif($i==14 ){$month_name="February-".$next_year;}
		elseif($i==15 ){$month_name="March-".$next_year;}
		
		if($i>12){
			$j = $i-12; 
		}
		else{
			$j = $i; 			
		}
		
			if($i>9){
				$wage_month = $j.'/'.$year;
			}
			else{
				$wage_month = '0'.$j.'/'.$year;
				}
		$ac1ee = "";	
		$total = "";	
		$due_date = "";	
		$challan_date = "";	
	$query = $this->db->query('select ac1ee,ac1er,ac2,ac10,ac21,ac22,due_date,challan_date from challan_date_entry where wage_month="'.$wage_month.'" ');
		foreach($query->result() as $challan_date)
		{
		   $ac1ee = $challan_date->ac1ee;
		   $ac1er = $challan_date->ac1er;
		   $ac2  = $challan_date->ac2;
		   $ac10 = $challan_date->ac10;
		   $ac21 = $challan_date->ac21;
		   $ac22 = $challan_date->ac22;
		   $due_date = $challan_date->due_date;
		   $challan_date = $challan_date->challan_date;
		   
		   $total = $ac1er+$ac2+$ac10+$ac21+$ac22;
			
		}	
		$row = $month_name."####".$ac1ee."####".$total."####".$due_date."####".$challan_date;
		array_push($result,$row);					
	
		}

			
			return $result;	
   }	

  
	    function challanformat_show(){
			
		$month_year = $this->input->post('month_year');
	//		$month_year = "05/2018";
			if($month_year=="")
						{
							$datestring='first day of last month';
							$dt=date_create($datestring);
							$lmfd =  $dt->format('Y-m-d'); 
							
							$datestring='last day of last month';
							$dt=date_create($datestring);
							$lmld =  $dt->format('Y-m-d'); 
							
							$date1 = explode("-",$lmfd);		
				
							$month = $date1[1];	   
							$year = $date1[0];	   
							$month_year = $month."/".$year;
						}
						else{
							$date1 = explode("/",$month_year);		
				
							$month = $date1[0];	   
							$year = $date1[1];	   
						
						}

		$result = array();
		$row = "";
		$uan_count=0;
		$uan_count1=0;
		$total_gross_wages 	= 0;
		$total_epf_wages	 = 0;
		$total_eps_wages 	= 0;
		$total_edli_wages 	= 0;
		$total_ncp_days			 = 0;
		$total_epf_contri_remitted 			 = 0;
		$total_eps_contri_remitted = 0;
		$total_epf_eps_diff_remitted  =0;
		$total_refund  =0;
		$pmrpy_eps  =0;
		$pmrpy_epf_diff  =0;




		$query = $this->db->query('select em.pmrpy,em.member_id,em.UAN,em.name_as_aadhaar,em.emp_id,em.employee_type from employee_master em   where substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"   order by em.member_id ASC');			
		foreach($query->result() as $employee)
		{
		   $pmrpy = $employee->pmrpy;			
		   $member_id = $employee->member_id;			
		   $emp_id = $employee->emp_id;			
		   $name_as_aadhaar = $employee->name_as_aadhaar;			
		   $uan = $employee->UAN;			
		   $employee_type = $employee->employee_type;			
		   
		   if($employee_type=="OFFICE STAFF"){
				$query1 = $this->db->query('select * from office_staff_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');						   
		   }
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select * from packers_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');			
			}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select * from bidi_roller_entry where employee_id="'.$emp_id.'" and month_year="'.$month_year.'" ');			
			}
				foreach($query1->result() as $officestaff)
				{

					$gross_wages = $officestaff->gross_wages;			
					$epf_wages = $officestaff->epf_wages;			
					$eps_wages = $officestaff->eps_wages;			
					$edli_wages = $officestaff->edli_wages;			
					$epf_contri_remitted = $officestaff->epf_contri_remitted;			
					$eps_contri_remitted = $officestaff->eps_contri_remitted;			
					$epf_eps_diff_remitted = $officestaff->epf_eps_diff_remitted;			
					$ncp_days = $officestaff->ncp_days;			
					$refund_of_advances = $officestaff->refund_of_advances;			
	

				$total_gross_wages = $gross_wages+$total_gross_wages;
				$total_epf_wages	=$total_epf_wages 	+	$epf_wages;	 
				$total_eps_wages 	=$total_eps_wages 	 + $eps_wages;
				$total_edli_wages 	=$total_edli_wages 	 + $edli_wages;
				$total_ncp_days		=$total_ncp_days 	+ $ncp_days;		 
				$total_epf_contri_remitted = $total_epf_contri_remitted + $epf_contri_remitted;
				$total_eps_contri_remitted = $total_eps_contri_remitted + $eps_contri_remitted;
				$total_epf_eps_diff_remitted  =$total_epf_eps_diff_remitted + $epf_eps_diff_remitted;
				$total_refund  =		$total_refund  + $refund_of_advances;

				
				if($pmrpy=="YES"){
					
				$pmrpy_eps = $pmrpy_eps + $eps_contri_remitted;
				$pmrpy_epf_diff  =$pmrpy_epf_diff + $epf_eps_diff_remitted;
					
					
				}
				
				$uan_count++;
				if($gross_wages!=0){
				$uan_count1++;					
				}
	
	
				}

				
				
			if($query1->num_rows()>0){
					
	//				array_push($result,$row);
						
			}
			
		}
			$query2 = $this->db->query('select name,estb_id from company_master  LIMIT 1 ');						   
			$estb_id = $query2->row()->estb_id;
			$company_name = $query2->row()->name;
			$challan_date="";
			$return_date="";
			$trrn="";
			$crn="";
			$query3 = $this->db->query('select * from challan_date_entry where wage_month="'.$month_year.'" ');						   
				foreach($query3->result() as $challan_Date)
				{
					$challan_date = $challan_Date->challan_date;			
					$return_date = $challan_Date->return_date;			
					$trrn = $challan_Date->ttrn;			
					$crn = $challan_Date->crn_no;		

					$ac_1ee = $challan_Date->ac1ee;		
					$ac_1er = $challan_Date->ac1er;		
					$ac_10  = $challan_Date->ac10;		
					$ac_21  = $challan_Date->ac21;		
					$ac_2  = $challan_Date->ac2;		
					$ac_22 = $challan_Date->ac22;		
			if($challan_date=="0000-00-00"){
				$challan_date ="";
			}
			else{
			$timestamp2 = strtotime($challan_date);
			$challan_date = date('d-m-y', $timestamp2); 				
			}


			if($return_date=="0000-00-00"){
				$return_date ="";
			}
			else{
			$timestamp3 = strtotime($return_date);
			$return_date = date('d-m-y', $timestamp3); 
			}

					
				}	
			
			if($month==12){
				$next_month = 01;
				$next_year = $year+1;
			}
			else{
				$next_month = $month+1;
				$next_year = $year;
			}
			$timestamp = strtotime('01-'.$month.'-'.$year);
			$newDate = date('M-y', $timestamp); 
			
			$timestamp1 = strtotime('01-'.$next_month.'-'.$next_year);
			$nextDate = date('M-y', $timestamp1); 
			

			$timestamp = strtotime('15-'.$month.'-'.$year);
			$searchDate = date('Y-m-d', $timestamp); 
			
			
			$query3 = $this->db->query('select employer_share,ac21,ac2,ac2min,ac22,ac22min from challan_setup where "'.$searchDate.'" between from_date and to_date limit 1 ');						   
				foreach($query3->result() as $challan_setup)
				{
					$employee_share = $challan_setup->employer_share;			
					$ac21 = $challan_setup->ac21;			
					$ac2 = $challan_setup->ac2;			
					$ac2min = $challan_setup->ac2min;			
					$ac22 = $challan_setup->ac22;			
					$ac22min = $challan_setup->ac22min;			
				}	
			
			$edli_contri = ($total_edli_wages*$ac21)/100;
			$total_contri = $total_epf_contri_remitted + $total_eps_contri_remitted + $total_epf_eps_diff_remitted + round($edli_contri) + round($total_refund);


			$epf_charges = ($total_gross_wages*$ac2)/100;
			if($epf_charges<$ac2min){
				$total_epf_charges = $ac2min;
			}
			else{
				$total_epf_charges = $epf_charges;				
			}

			
			$edli_charges = ($total_edli_wages*$ac22)/100;
			if($edli_charges<$ac22min){
				$total_edli_charges = $ac22min;
			}
			else{
				$total_edli_charges = $edli_charges;				
			}

			
			
			array_push($result,$estb_id,$company_name,$newDate,$month_year,$nextDate,$challan_date,$crn,$trrn,round($employee_share),$return_date,$uan_count,$total_gross_wages);
			array_push($result,$total_epf_wages);	
			array_push($result,$total_eps_wages); 	
			array_push($result,$total_edli_wages); 	
			array_push($result,$total_ncp_days);		
			array_push($result,$uan_count1);		
			array_push($result,$total_epf_contri_remitted);		
			array_push($result,$total_epf_eps_diff_remitted);		
			array_push($result,$total_eps_contri_remitted);		
			array_push($result,round($edli_contri));		
			array_push($result,round($total_refund));		
			array_push($result,round($total_contri));		
			array_push($result,round($total_epf_charges));		
			array_push($result,round($total_edli_charges));		
			array_push($result,round($pmrpy_eps));		
			array_push($result,round($pmrpy_epf_diff));		
			
			array_push($result,round($ac_1ee));		
			array_push($result,round($ac_1er));		
			array_push($result,round($ac_10));		
			array_push($result,round($ac_21));		
			array_push($result,round($ac_2));		
			array_push($result,round($ac_22));		

			
			
			return $result;	
    }

	 
   
   
  }	
?>