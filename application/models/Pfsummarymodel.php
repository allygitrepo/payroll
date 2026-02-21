<?php
class Pfsummarymodel extends CI_Model{
	
	    function show_pfsummary(){
			
		$month_year = $this->input->post('month_year');
//		$month_year = '06/2018';
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
			
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
		}
		$n = count($list);
		$month_day = $n;

			
			
		}
		else{
		$list=array();
		
		$date11 = explode("/",$month_year);	
		$month = $date11[0];
		$year = $date11[1];
		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month)       
				$list[]=date('Y-m-d', $time);
		}
		$n = count($list);
		$month_day = $n;

		$lmfd = $list[0];		
		$lmld = $list[$n-1];		

			
		}


		$result = array();
		$row = "";
			$bidi_total_employee = 0;
			$bidi_total_unit = 0;
			$bidi_total_unit12 = 0;
			$bidi_total_wages = 0;
			$bidi_total_bonus = 0;
			$bidi_total_total = 0;
			$bidi_total_pf = 0;
			$bidi_total_eps_wages = 0;
			$bidi_total_epf_wages = 0;
			$bidi_total_net_wages = 0;

		$query = $this->db->query('select cm.contractor_id,cm.contractor_name from contractor_master cm   order by cm.contractor_name ASC');			
		foreach($query->result() as $contractor)
		{
		   $contractor_id = $contractor->contractor_id;			
		   $contractor_name = $contractor->contractor_name;			
			$total_employee = 0;
			$total_unit = 0;
			$total_unit12 = 0;
			$total_wages = 0;
			$total_bonus = 0;
			$total_total = 0;
			$total_pf = 0;
			$total_eps_wages = 0;
			$total_epf_wages = 0;
			$total_net_wages = 0;
			$query1 = $this->db->query('select be.leave_with_pay,em.gender,be.net_wages,be.no_of_days,be.unit_1_days,be.unit_2_days,be.bidiroller_wages_id,be.gross_wages,be.epf_wages,be.eps_wages from employee_master em inner join bidi_roller_entry be on be.employee_id=em.emp_id where em.employee_type="BIDI MAKER" and em.status="1" and  em.contractor="'.$contractor_id.'" and be.month_year="'.$month_year.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');			
			foreach($query1->result() as $bidiroller)
			{
				$total_employee = $total_employee+1;
				$bidi_id = $bidiroller->bidiroller_wages_id;			
				$unit_1_days = $bidiroller->unit_1_days;			
				$unit_2_days = $bidiroller->unit_2_days;	
				$no_of_days = $bidiroller->no_of_days;	
				$leave_with_pay = $bidiroller->leave_with_pay;	
				
				$net_wages = $bidiroller->net_wages;		
				$total_net_wages = $total_net_wages+$net_wages;
				
				$unit = $unit_1_days+$unit_2_days;		




				
				$gender = $bidiroller->gender;		
				
						$query2 = $this->db->query('select bonus1,bonus2,rate1,rate2 from bidiroller_wages where id="'.$bidi_id.'" ');
						foreach($query2->result() as $bidiroller1)
						{
						$bonus1 = $bidiroller1->bonus1;
						$bonus2 = $bidiroller1->bonus2;		   				
						$rate1 = $bidiroller1->rate1;
						$rate2 = $bidiroller1->rate2;		   				
						}
						
						
//										$wages1 = ($unit_days1*$rate1)+($unit_days2*$rate2);
//				$wages2 = round(($wages1/$no_of_days)*$leave_with_pay);
//				$wages = $wages1+$wages2;
				

		if($gender=="MALE"){
		$query5 = $this->db->query('select employer_share,ac1eemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eemale;		   			
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}
		else{
		$query5 = $this->db->query('select employer_share,ac1eemale,ac1eefemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eefemale;		   						
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}	
	
				if(isset($bonus1)){
				    	$bonus = ($unit_1_days*$bonus1)+($unit_2_days*$bonus2);
				}else{
				    $bonus = 0;
				}
				
					$total_bonus = $total_bonus+$bonus;

					$wages = $bidiroller->gross_wages;					
					$total_wages = $total_wages+$wages; 

					
					$total = $wages+$bonus;
					$total_total = $total_total+$total;

					$pf = (($wages)*($ac1eemf))/100;
					$total_pf = $total_pf+round($pf);	

					if($wages > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $wages;
					}
					
					$eps_wages = ($eps_total*$ac10)/100;
					$total_eps_wages = $total_eps_wages+round($eps_wages);
	
					$a= ($wages * $employer_share)/100;
					$epf_wages = $a-$eps_wages;
					$total_epf_wages = $total_epf_wages+round($epf_wages);

					
					



					
				
				$total_unit = $total_unit + $unit;
				
//				$total_unit12 = $total_unit12+$total_unit;
		   

			}
			
		$row = $contractor_name;	   
		$row .= '####'.$total_employee;	   
		$row .= '####'.$total_unit;	   
		$row .= '####'.$total_wages;	   
		$row .= '####'.$total_bonus;	   
		$row .= '####'.$total_total;	   
		$row .= '####'.$total_pf;	   
		$row .= '####'.$total_epf_wages;	   
		$row .= '####'.$total_eps_wages;	   
		$row .= '####'.$total_net_wages;	   
		$row .= '####'.$month_year;	   
		
		
	array_push($result,$row);
	
				$bidi_total_employee 	=$bidi_total_employee + 	$total_employee;	
			$bidi_total_unit12 		=$bidi_total_unit12 +		$total_unit;	
			$bidi_total_wages 		=$bidi_total_wages 	+	$total_wages;	
			$bidi_total_bonus 		=$bidi_total_bonus 	+	$total_bonus;	
			$bidi_total_total 		=$bidi_total_total 	+	$total_total;	
			$bidi_total_pf 			=$bidi_total_pf 	+		$total_pf;	   
			$bidi_total_eps_wages 	=$bidi_total_eps_wages +	$total_epf_wages;
			$bidi_total_epf_wages 	=$bidi_total_epf_wages +	$total_eps_wages;
			$bidi_total_net_wages	=$bidi_total_net_wages+	$total_net_wages;	   

		
		}
		$row = '####';	   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';
		$row .= '####';	   
		$row .= '####';	   
		$row .= '####'.$month_year;	   
	array_push($result,$row);
		
		$row = 'BIDI ROLLER TOTAL';	   
		$row .= '####'.$bidi_total_employee;   
		$row .= '####'.$bidi_total_unit12;   
		$row .= '####'.$bidi_total_wages;   
		$row .= '####'.$bidi_total_bonus;   
		$row .= '####'.$bidi_total_total;   
		$row .= '####'.$bidi_total_pf;
		$row .= '####'.$bidi_total_eps_wages;	   
		$row .= '####'.$bidi_total_epf_wages;	   
		$row .= '####'.$bidi_total_net_wages;
		$row .= '####'.$month_year;
		
	array_push($result,$row);
	
	
	

			$total_employee = 0;
			$total_wages = 0;
			$total_bonus = 0;
			$total_total = 0;
			$total_pf = 0;
			$total_eps_wages = 0;
			$total_epf_wages = 0;
			$total_net_wages = 0;
		
			$query2 = $this->db->query('select em.gender,oe.net_wages,oe.office_staff_salary_id,oe.gross_wages,oe.epf_wages,oe.eps_wages from employee_master em inner join office_staff_entry oe on oe.employee_id=em.emp_id where em.employee_type="OFFICE STAFF"  and oe.month_year="'.$month_year.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');			
			foreach($query2->result() as $officestaff)
			{
				$total_employee = $total_employee+1;
				$office_id = $officestaff->office_staff_salary_id;			
				
				$net_wages = $officestaff->net_wages;		
				$total_net_wages = $total_net_wages+$net_wages;
				

				$wages = $officestaff->gross_wages;	
				$total_wages = $total_wages+$wages;


					
				

			
				
				$gender = $officestaff->gender;		
				
						$query2 = $this->db->query('select additional_bonus from office_staff_salary where id="'.$office_id.'" ');
						foreach($query2->result() as $officestaffsalary)
						{
						$bonus = $officestaffsalary->additional_bonus;
						}

				
				
					$total_bonus = $total_bonus+$bonus;

					$total = $wages;
					$total_total = $total_total+$total;

					$pf = (($wages)*(10))/100;
					$total_pf = $total_pf+round($pf);	
					
		if($gender=="MALE"){
		$query5 = $this->db->query('select employer_share,ac1eemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eemale;		   			
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}
		else{
		$query5 = $this->db->query('select employer_share,ac1eemale,ac1eefemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eefemale;		   						
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}	
			if($total > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $total;
					}
					
		$eps_wages = ($eps_total*$ac10)/100;
					$total_eps_wages = $total_eps_wages+round($eps_wages);
	
					$a= ($total * $employer_share)/100;
					$epf_wages = $a-$eps_wages;
					$total_epf_wages = $total_epf_wages+round($epf_wages);

   

			}
			$row = '####';	   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';
		$row .= '####';	   
		$row .= '####';	   
				$row .= '####'.$month_year;	   
	array_push($result,$row);

	$row = 'OFFICE STAFF TOTAL';	   
		$row .= '####'.$total_employee;	   
		$row .= '####';	   
		$row .= '####'.$total_wages;	   
		$row .= '####0';	   
		$row .= '####'.$total_total;	   
		$row .= '####'.$total_pf;	   
		$row .= '####'.$total_epf_wages;	   
		$row .= '####'.$total_eps_wages;	   
		$row .= '####'.$total_net_wages;	   
		$row .= '####'.$month_year;	   
	array_push($result,$row);
	
	
		
			$total_employee = 0;
			$total_wages = 0;
			$total_bonus = 0;
			$total_total = 0;
			$total_pf = 0;
			$total_eps_wages = 0;
			$total_epf_wages = 0;
			$total_net_wages = 0;

		$total_unit = 0;
	
			$query2 = $this->db->query('select pe.unit_1,pe.unit_2,pe.unit_3,pe.unit_4,em.gender,pe.net_wages,pe.packing_wages_id,pe.gross_wages,pe.epf_wages,pe.eps_wages from employee_master em inner join packers_entry pe on pe.employee_id=em.emp_id where em.employee_type="BIDI PACKER"  and pe.month_year="'.$month_year.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');			
			foreach($query2->result() as $packers)
			{
				$total_employee = $total_employee+1;
				$packer_id = $packers->packing_wages_id;			
				
				$unit_1 = $packers->unit_1;		
				$unit_2 = $packers->unit_2;		
				$unit_3 = $packers->unit_3;		
				$unit_4 = $packers->unit_4;		
				$total_unit = $total_unit+($unit_1+$unit_2+$unit_3+$unit_4);
				
				
	 $query3 = $this->db->query('select id,rate1,rate2,rate3,rate4,bonus from packing_wages where id="'.$packer_id.'"  ');
		foreach($query3->result() as $packers1)
		{
		   $bonus = $packers1->bonus;
		   $rate1 = $packers1->rate1;
		   $rate2 = $packers1->rate2;
		   $rate3 = $packers1->rate3;
		   $rate4 = $packers1->rate4;		   
		}
		
				
				$net_wages = $packers->net_wages;		
				$total_net_wages = $total_net_wages+$net_wages;
				

				$wages = ($unit_1*$rate1)+($unit_2*$rate2)+($unit_3*$rate3)+($unit_4*$rate4);
				$total_wages = $total_wages+$wages;

				
				$total = $packers->gross_wages;	
				$total_total = $total_total+$total;

	
				
				
				
				$gender = $packers->gender;		
				

				
				
					$total_bonus = $total_bonus+$bonus;

/*					$total = $wages;
					$total_total = $total_total+$total;
*/
					$pf = (($total)*(10))/100;
					$total_pf = $total_pf+round($pf);	
					
					if($gender=="MALE"){
		$query5 = $this->db->query('select employer_share,ac1eemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eemale;		   			
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}
		else{
		$query5 = $this->db->query('select employer_share,ac1eemale,ac1eefemale,ac10,salarylimit from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date  DESC LIMIT 1 ');
		$ac10 = $query5->row()->ac10;		   			
		$ac1eemf = $query5->row()->ac1eefemale;		   						
		$salarylimit = $query5->row()->salarylimit;		   			
		$employer_share = $query5->row()->employer_share;		   			
		}	
			if($total > $salarylimit){
						$eps_total = $salarylimit;
					}
					else{
						$eps_total = $total;
					}
					
			$eps_wages = ($eps_total*$ac10)/100;
					$total_eps_wages = $total_eps_wages+round($eps_wages);
					$a= ($total * $employer_share)/100;
					$epf_wages = $a-$eps_wages;
					$total_epf_wages = $total_epf_wages+round($epf_wages);

   

			}
			$row = '####';	   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';
		$row .= '####';	   
		$row .= '####';	   
		$row .= '####'.$month_year;	   
	array_push($result,$row);

	$row = 'PACKING STAFF TOTAL';	   
		$row .= '####'.$total_employee;	   
		$row .= '####'.$total_unit;	   
		$row .= '####'.$total_wages;	   
		$row .= '####0';	   
		$row .= '####'.$total_total;	   
		$row .= '####'.$total_pf;	   
		$row .= '####'.$total_epf_wages;	   
		$row .= '####'.$total_eps_wages;	   
		$row .= '####'.$total_net_wages;	   
		$row .= '####'.$month_year;	   
	array_push($result,$row);
	
			$row = '####';	   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';
		$row .= '####';	   
		$row .= '####';	   
		$row .= '####'.$month_year;
	array_push($result,$row);

			$row = '####';	   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';   
		$row .= '####';
		$row .= '####';	   
		$row .= '####';	   
		$row .= '####'.$month_year;
	array_push($result,$row);

	
				return $result;	

    }

			

}
?>
