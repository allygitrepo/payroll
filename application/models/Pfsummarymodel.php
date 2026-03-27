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
		$bidi_total_unit12 = 0;
		$bidi_total_wages = 0;
		$bidi_total_bonus = 0;
		$bidi_total_total = 0;
		$bidi_total_pf = 0;
		$bidi_total_eps_wages = 0;
		$bidi_total_epf_wages = 0;
		$bidi_total_net_wages = 0;
		$bidi_total_esic = 0;

		// Optimization 1: Cache Challan Setup once outside all loops
		$query_setup = $this->db->query('select employer_share,ac1eemale,ac1eefemale,ac10,salarylimit,esic_wages,employee_share from challan_setup where "'.$lmfd .'" between `from_date` and `to_date` ORDER BY from_date,to_date DESC LIMIT 1 ');
		$setup = $query_setup->row();
		
		if(!$setup) {
			return array(); 
		}

		$ac10_val = $setup->ac10;		   			
		$salarylimit_val = $setup->salarylimit;		   			
		$employer_share_val = $setup->employer_share;		   			
		$esic_wages_threshold_val = $setup->esic_wages;
		$esic_rate_percent_val = $setup->employee_share;
		$ac1eemf_male = $setup->ac1eemale;
		$ac1eemf_female = $setup->ac1eefemale;

		// Optimization 2: Single JOIN query for all Bidi Rollers
		$bidi_sql = 'SELECT cm.contractor_id, cm.contractor_name, be.leave_with_pay, em.gender, be.net_wages, be.no_of_days, be.unit_1_days, be.unit_2_days, be.bidiroller_wages_id, be.gross_wages, be.epf_wages, be.eps_wages, bw.bonus1, bw.bonus2, bw.rate1, bw.rate2 
					 FROM contractor_master cm 
					 JOIN employee_master em ON em.contractor = cm.contractor_id 
					 JOIN bidi_roller_entry be ON be.employee_id = em.emp_id 
					 LEFT JOIN bidiroller_wages bw ON bw.id = be.bidiroller_wages_id 
					 WHERE em.employee_type = "BIDI MAKER" 
					 AND cm.status = "Active" 
					 AND be.month_year = "'.$month_year.'" 
					 AND substr(em.member_id_org,1,15) = "'.$_SESSION['company_id'].'" 
					 ORDER BY cm.contractor_name ASC, em.member_id ASC';
		
		$query_bidi = $this->db->query($bidi_sql);
		$current_contractor_id = null;
		$contractor_data = null;

		foreach($query_bidi->result() as $bidiroller) {
			if($current_contractor_id !== $bidiroller->contractor_id) {
				if($contractor_data !== null) {
					$row = $contractor_data["name"]."####".$contractor_data["employee"]."####".$contractor_data["unit"]."####".$contractor_data["wages"]."####".$contractor_data["bonus"]."####".$contractor_data["total"]."####".$contractor_data["pf"]."####".$contractor_data["esic"]."####".$contractor_data["epf_wages"]."####".$contractor_data["eps_wages"]."####".$contractor_data["net_wages"]."####".$month_year;
					array_push($result, $row);
				}
				$current_contractor_id = $bidiroller->contractor_id;
				$contractor_data = array("name" => $bidiroller->contractor_name, "employee" => 0, "unit" => 0, "wages" => 0, "bonus" => 0, "total" => 0, "pf" => 0, "eps_wages" => 0, "epf_wages" => 0, "net_wages" => 0, "esic" => 0);
			}

			$contractor_data["employee"]++;
			$u = $bidiroller->unit_1_days + $bidiroller->unit_2_days;
			$contractor_data["unit"] += $u;
			$b = ($bidiroller->unit_1_days * ($bidiroller->bonus1 ?? 0)) + ($bidiroller->unit_2_days * ($bidiroller->bonus2 ?? 0));
			$contractor_data["bonus"] += $b;
			$w = $bidiroller->gross_wages;
			$contractor_data["wages"] += $w;
			$t = $w + $b;
			$contractor_data["total"] += $t;

			$ac = ($bidiroller->gender == "MALE") ? $ac1eemf_male : $ac1eemf_female;
			$pf_val = round(($w * $ac) / 100);
			$contractor_data["pf"] += $pf_val;
			$eps_b = min($w, $salarylimit_val);
			$eps_w = round(($eps_b * $ac10_val) / 100);
			$contractor_data["eps_wages"] += $eps_w;
			$contractor_data["epf_wages"] += ($pf_val - $eps_w);

			$div = $bidiroller->no_of_days + $bidiroller->leave_with_pay;
			$esic_val = calculate_esic($t, $div, $esic_wages_threshold_val, $esic_rate_percent_val);
			$contractor_data["esic"] += $esic_val;
			$contractor_data["net_wages"] += ($w - $pf_val - $esic_val);
		}
		if($contractor_data !== null) {
			$row = $contractor_data["name"]."####".$contractor_data["employee"]."####".$contractor_data["unit"]."####".$contractor_data["wages"]."####".$contractor_data["bonus"]."####".$contractor_data["total"]."####".$contractor_data["pf"]."####".$contractor_data["esic"]."####".$contractor_data["epf_wages"]."####".$contractor_data["eps_wages"]."####".$contractor_data["net_wages"]."####".$month_year;
			array_push($result, $row);
		}

		// Calc Bidi Subtotals
		foreach($result as $r) {
			$d = explode("####", $r);
			$bidi_total_employee += $d[1]; $bidi_total_unit12 += $d[2]; $bidi_total_wages += $d[3]; $bidi_total_bonus += $d[4]; $bidi_total_total += $d[5]; $bidi_total_pf += $d[6]; $bidi_total_esic += $d[7]; $bidi_total_epf_wages += $d[8]; $bidi_total_eps_wages += $d[9]; $bidi_total_net_wages += $d[10];
		}
		array_push($result, "BIDI ROLLER TOTAL####$bidi_total_employee####$bidi_total_unit12####$bidi_total_wages####$bidi_total_bonus####$bidi_total_total####$bidi_total_pf####$bidi_total_esic####$bidi_total_eps_wages####$bidi_total_epf_wages####$bidi_total_net_wages####$month_year");

		// Optimization 3: Office Staff JOIN query
		$off_total = array("employee" => 0, "wages" => 0, "total" => 0, "pf" => 0, "esic" => 0, "epf_wages" => 0, "eps_wages" => 0, "net_wages" => 0);
		$off_sql = 'SELECT em.gender, oe.no_of_days_worked, oe.gross_wages, os.additional_bonus 
					FROM employee_master em 
					JOIN office_staff_entry oe ON oe.employee_id = em.emp_id 
					LEFT JOIN office_staff_salary os ON os.id = oe.office_staff_salary_id 
					WHERE em.employee_type = "OFFICE STAFF" AND oe.month_year = "'.$month_year.'" AND substr(em.member_id_org,1,15) = "'.$_SESSION['company_id'].'"';
		$query_off = $this->db->query($off_sql);
		foreach($query_off->result() as $off) {
			$off_total["employee"]++;
			$w = $off->gross_wages; $off_total["wages"] += $w; $off_total["total"] += $w;
			$ac = ($off->gender == "MALE") ? $ac1eemf_male : $ac1eemf_female;
			$pf_val = round(($w * $ac) / 100); $off_total["pf"] += $pf_val;
			$eps_b = min($w, $salarylimit_val); $eps_w = round(($eps_b * $ac10_val) / 100); $off_total["eps_wages"] += $eps_w;
			$off_total["epf_wages"] += ($pf_val - $eps_w);
			$esic_val = calculate_esic($w, $off->no_of_days_worked, $esic_wages_threshold_val, $esic_rate_percent_val);
			$off_total["esic"] += $esic_val;
			$off_total["net_wages"] += ($w - $pf_val - $esic_val);
		}
		array_push($result, "OFFICE STAFF TOTAL####".$off_total["employee"]."####0####".$off_total["wages"]."####0####".$off_total["total"]."####".$off_total["pf"]."####".$off_total["esic"]."####".$off_total["epf_wages"]."####".$off_total["eps_wages"]."####".$off_total["net_wages"]."####".$month_year);

		// Optimization 4: Packers JOIN query
		$pac_total = array("employee" => 0, "unit" => 0, "wages" => 0, "total" => 0, "pf" => 0, "esic" => 0, "epf_wages" => 0, "eps_wages" => 0, "net_wages" => 0);
		$pac_sql = 'SELECT pe.no_of_worked_days, pe.unit_1, pe.unit_2, pe.unit_3, pe.unit_4, em.gender, pe.gross_wages, pw.rate1, pw.rate2, pw.rate3, pw.rate4 
					FROM employee_master em 
					JOIN packers_entry pe ON pe.employee_id = em.emp_id 
					LEFT JOIN packing_wages pw ON pw.id = pe.packing_wages_id 
					WHERE em.employee_type = "BIDI PACKER" AND pe.month_year = "'.$month_year.'" AND substr(em.member_id_org,1,15) = "'.$_SESSION['company_id'].'"';
		$query_pac = $this->db->query($pac_sql);
		foreach($query_pac->result() as $pac) {
			$pac_total["employee"]++;
			$u = $pac->unit_1 + $pac->unit_2 + $pac->unit_3 + $pac->unit_4; $pac_total["unit"] += $u;
			$w = $pac->gross_wages; $pac_total["wages"] += $w; $pac_total["total"] += $w;
			$ac = ($pac->gender == "MALE") ? $ac1eemf_male : $ac1eemf_female;
			$pf_val = round(($w * $ac) / 100); $pac_total["pf"] += $pf_val;
			$eps_b = min($w, $salarylimit_val); $eps_w = round(($eps_b * $ac10_val) / 100); $pac_total["eps_wages"] += $eps_w;
			$pac_total["epf_wages"] += ($pf_val - $eps_w);
			$esic_val = calculate_esic($w, $pac->no_of_worked_days, $esic_wages_threshold_val, $esic_rate_percent_val);
			$pac_total["esic"] += $esic_val;
			$pac_total["net_wages"] += ($w - $pf_val - $esic_val);
		}
		array_push($result, "PACKING STAFF TOTAL####".$pac_total["employee"]."####".$pac_total["unit"]."####".$pac_total["wages"]."####0####".$pac_total["total"]."####".$pac_total["pf"]."####".$pac_total["esic"]."####".$pac_total["epf_wages"]."####".$pac_total["eps_wages"]."####".$pac_total["net_wages"]."####".$month_year);

		return $result;

    }

}
?>
