<?php
class Bonussheetmodel extends CI_Model{
	
    function bonussheet_show(){
	$month_year1 = $this->input->post('month_year1');
	$month_year2 = $this->input->post('month_year2');
	$employee_type = $this->input->post('employee_type');
//	$employee_type = "OFFICE STAFF";
//	$employee_type = "BIDI PACKER";
//	$month_year1 = "04/2018";
//	$month_year2 = "07/2018";	
	$month1 = explode("/",$month_year1);
	$month2 = explode("/",$month_year2);	
//	echo $month_year1;
//	echo $month_year2;
		$result = array();
		
						$this->db->select('*');    
					$this->db->from('company_master');
					$this->db->join('address_master', 'company_master.address_id = address_master.id');
					$this->db->where('company_master.estb_id',$_SESSION['company_id']);
					$query = $this->db->get();

					if($query->num_rows()>0){
					$company_name = $query->row()->name;	
					$address = $query->row()->address;	
					$post_office = $query->row()->post_office;	
					$district = $query->row()->district;	
					$pincode = $query->row()->pincode;	
						
					}
					else{
						$company_name = "";
						$address = "";
						$post_office = "";
						$district = "";
						$pincode = "";	
					}
		
		$date1 = $month1[1].'-'.$month1[0].'-01';
		$date2 = $month2[1].'-'.$month2[0].'-15';
		$date3 = $month2[1].'-'.$month2[0].'-31';
	$start    = (new DateTime($date1));
	$end      = (new DateTime($date2));
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);

	$month_head = '';
		foreach ($period as $dt) {
			$head = $dt->format("M/Y");
			$head1 = $dt->format("M");
			$head2 = $dt->format("Y");
			
			$month_head .= $head1.' '.$head2.'####';
			
			$lastmonth = $dt->format("m/Y");
		}
		   if($employee_type=="OFFICE STAFF"){
			$row = $month_head.'Total####Bonus####Additional Bonus####Total Payment';
		   }
		   else{
			$row = $month_head.'Total####Bonus####Total Payment';			   
		   }
			array_push($result,$row);
	
		$row = ""; 
						$gmonth_total =	0;
						$grand_alltotal = 0;	
						$grand_standard_bonus =	0;
						$grand_additional_bonus = 0;
						$grand_total_payment = 0;
				$row1 = "TOTAL : ";
	//$query = $this->db->query('select em.UAN,em.member_id,em.name_as_aadhaar,em.emp_id from employee_master em where em.employee_type="'.$employee_type.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  order by em.member_id ASC');			
	//$query = $this->db->query('select em.UAN,em.member_id,em.name_as_aadhaar,em.emp_id from employee_master em where em.employee_type="'.$employee_type.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj between "'.$date1.'" and "'.$date3.'" and  em.member_id NOT IN(select member_id from resignation_master) order by em.member_id ASC');			
	$query = $this->db->query('select em.UAN,em.member_id,em.name_as_aadhaar,em.emp_id from employee_master em where em.employee_type="'.$employee_type.'"   and substr(`member_id_org`,1,15)="'.$_SESSION['company_id'].'"  and em.doj NOT BETWEEN "'.$date1.'" and "'.$date3.'" and  em.member_id NOT IN(select member_id from resignation_master) order by em.member_id ASC');			
			foreach($query->result() as $employee_msater)
			{
				$name = $employee_msater->name_as_aadhaar;			
				$emp_id = $employee_msater->emp_id;			
				$uan = $employee_msater->UAN;			
				$member_id = $employee_msater->member_id;			

				$row = $name.'####'.$member_id.'####'.$uan;

		$alltotal = 0;	
						$total_payment =	0;
						$standard_bonus =	0;
						$additional_bonus =	0;
						$sb_rate =	0;
		foreach ($period as $dt) {
		$entry_month = $dt->format("m/Y");
		$total = 0;	
		   if($employee_type=="OFFICE STAFF"){
				$query1 = $this->db->query('select os.additional_bonus,os.standard_bonus,oe.gross_wages from office_staff_entry oe inner join office_staff_salary os on os.id=oe.office_staff_salary_id  where oe.employee_id="'.$emp_id.'" and oe.month_year="'.$entry_month.'" ');						   
				foreach($query1->result() as $officestaff)
				{
					$total = $officestaff->gross_wages;
					$sb_rate = $officestaff->standard_bonus;
					$ab_rate = $officestaff->additional_bonus;
					$alltotal = $alltotal+$total; 
//					echo '==lm=>'.$lastmonth.'==em=>'.$entry_month;
//					if($lastmonth==$entry_month)
//					{
						$standard_bonus =	($alltotal*$sb_rate)/100;
						$additional_bonus =	($alltotal*$ab_rate)/100;
//					}
					
				}
		   }
		   elseif($employee_type=="BIDI PACKER"){
				$query1 = $this->db->query('select pe.gross_wages,pw.bonus from packers_entry pe inner join packing_wages pw on pw.id=pe.packing_wages_id where pe.employee_id="'.$emp_id.'" and pe.month_year="'.$entry_month.'" ');			
				foreach($query1->result() as $officestaff)
				{
					$total = $officestaff->gross_wages;
					$sb_rate = $officestaff->bonus;
				
					$alltotal = $alltotal+$total; 
					$standard_bonus =	($alltotal*$sb_rate)/100;
					$additional_bonus =	0;
				}
			}
		   elseif($employee_type=="BIDI MAKER"){
				$query1 = $this->db->query('select be.*,bw.bonus1,bw.bonus2,bw.rate1,bw.rate2 from bidi_roller_entry be inner join bidiroller_wages bw on bw.id=be.bidiroller_wages_id where be.employee_id="'.$emp_id.'" and be.month_year="'.$entry_month.'" ');			
				foreach($query1->result() as $bidimaker)
				{
					$wages1 = ($bidimaker->unit_1_days * $bidimaker->rate1) + ($bidimaker->unit_2_days * $bidimaker->rate2);
					$wages2 = ($bidimaker->no_of_days == 0) ? 0 : (($wages1 / $bidimaker->no_of_days) * $bidimaker->leave_with_pay);
					$total = $wages1 + $wages2;
					
					$alltotal = $alltotal + $total; 
					$m_bonus = ($bidimaker->unit_1_days * $bidimaker->bonus1) + ($bidimaker->unit_2_days * $bidimaker->bonus2);
					$standard_bonus = $standard_bonus + $m_bonus;
					$additional_bonus = 0;
				}
			}
//							$gmonth_total =	$gmonth_total+$total;
		
						$row .= '####'.$total;
//						$row1 .= '####//'.$gmonth_total;

		}

	
		   if($employee_type=="OFFICE STAFF"){
		$total_payment = round($standard_bonus)+round($additional_bonus);
		$row .= '####'.$alltotal.'####'.round($standard_bonus).'####'.round($additional_bonus);
		$row .= '####'.$total_payment;
		   }
		   else{
		$total_payment = round($standard_bonus);
		$row .= '####'.$alltotal.'####'.round($standard_bonus);
		$row .= '####'.$total_payment;
		   }	
		
		
//						$grand_alltotal = $alltotal+$grand_alltotal;	
//						$grand_standard_bonus =	$standard_bonus+$grand_standard_bonus;
//						$grand_additional_bonus =	$additional_bonus+$grand_additional_bonus;
//						$grand_total_payment =	$total_payment+$grand_total_payment;
		
	//		if($query1->num_rows() > 0){
					array_push($result,$row);
		//		}
		
			}
//		$row1 .= '####'.$grand_alltotal.'####'.round($grand_standard_bonus).'####'.round($grand_additional_bonus);
//		$row1 .= '####'.$grand_total_payment;
//					array_push($result,$row1);

	$row = $company_name;
	$row .= '####'.$address;
	$row .= '####'.$post_office;
	$row .= '####'.$district;
	$row .= '####'.$pincode;	
					array_push($result,$row);

return $result;
    }

}
?>