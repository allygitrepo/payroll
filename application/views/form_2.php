<?php	
ob_start();
$pdf=new exFPDF();
$n = count($result);	

		for($i=0;$i<$n;$i++){
$n1 = count($result1);	
$n2 = count($result2);	
			
		$contry_origin =	$result[$i]['contry_origin'];
		$name =	$result[$i]['name_as_aadhaar'];
		$relation =	$result[$i]['relation'];
		$father_husband =	$result[$i]['father_husband'];
		$UAN =	$result[$i]['uan'];
		$dob =	$result[$i]['dob'];
		$doj =	$result[$i]['doj'];
		
		
$date=date_create($doj);
date_add($date,date_interval_create_from_date_string("15 days"));
$next_days = date_format($date,"d/m/Y");
		
		
		$gender =	$result[$i]['gender'];
		$marital_status =	$result[$i]['marital_status'];
		$email =	$result[$i]['email'];
		$mobile =	$result[$i]['mobile'];
		$international_worker =	$result[$i]['international_worker'];
		$passport_no =	$result[$i]['passport_no'];
		$passport_from_date =	$result[$i]['passport_from_date'];
		$passport_till_date =	$result[$i]['passport_till_date'];
		$member_id_org =	$result[$i]['member_id_org'];
		$member_id =	$result[$i]['member_id'];
		$post_office =	$result[$i]['post_office'];
		$bank_acc_no =	$result[$i]['bank_acc_no'];
		$ifsc =	$result[$i]['ifsc'];
		$pan_no =	$result[$i]['pan_no'];
		$aadhaar_no =	$result[$i]['aadhaar_no'];
		$address =	$result[$i]['address'];
		$post_office =	$result[$i]['post_office'];
		$district =	$result[$i]['district'];
		$pincode =	$result[$i]['pincode'];
		$emp_id =	$result[$i]['emp_id'];

		$comp_name =	$result[$i]['comp_name'];
		$comp_address =	$result[$i]['comp_address'];
		$comp_post_office =	$result[$i]['comp_post_office'];
		$comp_district =	$result[$i]['comp_district'];
		$comp_pincode =	$result[$i]['comp_pincode'];


		
$pdf->AddPage(); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);


//########################################################

  $tableB=new easyTable($pdf,32, 'width:100%;height:100%; align:C{C};  border:1; fbgcolor:#ffffff; font-color:#000000;');

  
  
	$checked ="assets/images/icon/checked.png";
	$unchecked ="assets/images/icon/unchecked.png";

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();

 $logo_path = "assets/images/icon/logo.png";
 $tableB->easyCell("", 'img:'.$logo_path.',w10,h10; align:C;rowspan:2;border:; colspan:4; valign:B;width:50%;');
 $tableB->easyCell("",'align:C;width:100%;colspan:8;font-size:14;font-style:B;border:;');
 $tableB->easyCell("FORM - 2 (REVISED)",'align:L;width:100%;colspan:9;font-size:14;font-style:B;border:;');
 $tableB->easyCell("",'align:C;width:100%;colspan:11;font-size:14;font-style:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:14;font-size:9;border:;');
 $tableB->easyCell("A/c Gr. No / -", 'align:R;width:100%;colspan:6;font-size:9;border:;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:8;font-size:9;border:B;');
 $tableB->printRow();

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("NOMINATION AND DECLARATION FORM FOR UN-EXEMPTED/EXEMPTED ESTABLISHMENTS", 'align:C;width:100%;colspan:32;font-style:B;font-size:8;border:;');
 $tableB->printRow();

 $tableB->easyCell("Declaration and Nomination Form under the Employee's Provident Funds & Employee's Pension Scheme (Paragraph 33 & 61 (1) of the", 'align:C;width:100%;colspan:32;line-height:0.50;font-size:8;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("Employees 'Provident Fund Scheme, 1952 & Paragraph 18 of the", 'align:C;width:100%;colspan:32;line-height:0.50;font-size:8;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("Employees' Pension Scheme, 1995)", 'align:C;width:100%;colspan:32;line-height:0.50;font-size:8;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();

 $tableB->easyCell("PART -A (EPF)",'width:100%;colspan:32;font-size:14;font-style:B;border:;');
 $tableB->printRow();
			$timestamp = strtotime($doj);
			$doj1 = date('d/m/Y', $timestamp); 

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow(); 
 $tableB->easyCell("1", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Name (In Block letters) : ".$name , 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("8", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Date of Joining in E.P.F.' 52 : ".$doj1, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("2", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Father's / Husband's Name : ".$father_husband, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("9", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Date of Joining in F.P.F. 71 / E.P.S. 95 : ".$doj1, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();
			$timestamp = strtotime($dob);
			$dob1 = date('d/m/Y', $timestamp); 

 $tableB->easyCell("3", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Date of Birth : ".$dob1, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("10", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Address", 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();
	 
 $tableB->easyCell("4", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Sex : " .$gender, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Permanent : ".$address." , ".$post_office." , ".$district." , ".$pincode, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("5", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Marital Status : ".$marital_status, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("6", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Account No : ".$member_id, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("Temporary :", 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("7", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("UAN : ".$UAN, 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->easyCell("", 'align:L;width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:15;font-style:B;font-size:8;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("I here by nominate the person (s) / cancel the nomination made by me previously and nominate the person(s), mentioned below to",'width:100%;align:C;line-height:0.60;colspan:32;font-size:9;font-style:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("receive the amount-standing to my credit in the Employee's Provident Fund, in the event of my death.",'width:100%;colspan:32;align:C;font-size:9;font-style:B;line-height:0.60;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:;font-style:;border:;');
 $tableB->printRow();

 $tableB->easyCell("",'width:100%;colspan:32;font-size:;font-style:;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("Name of the nominee / nominees",'width:100%;colspan:7;align:C;valign:M;font-size:8;font-style:B;border:TRBL;');
 $tableB->easyCell("Address",'width:100%;colspan:8;align:C;valign:M;font-size:8;font-style:B;border:TRB;');
 $tableB->easyCell("Nominee's relationship with the member",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:TRB;');
 $tableB->easyCell("Date of Birth",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:TRB;');
 $tableB->easyCell("Total amt. or share of accumulation in Provident Fund to be paid to eachnominee",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:TRB;');
 $tableB->easyCell("If the Nominee is a minor, Name & Relationship & Address of the guardian who may receive the amount during minority of nominee",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:TRB;');
 $tableB->printRow(); 
 
 $nomi_table = 0;
 for($j=0;$j<$n1;$j++){
		$emp_id1 =	$result1[$j]['emp_id'];
		if($emp_id==$emp_id1){
 $nomi_table++;
			
		$nominee_name =	$result1[$j]['nominee_name'];
		$nomi_relation =	$result1[$j]['nomi_relation'];
		$dob_nomi1 =	$result1[$j]['dob'];
			$timestamp = strtotime($dob_nomi1);
			$dob_nomi = date('d/m/Y', $timestamp); 

		$guardian_address =	$result1[$j]['guardian_address'];
		$guardian_name =	$result1[$j]['guardian_name'];
		$address_nomi =	$result1[$j]['address'];
		$post_office_nomi =	$result1[$j]['post_office'];
		$district_nomi =	$result1[$j]['district'];
		$pincode_nomi =	$result1[$j]['pincode'];
		$share_nomi =	$result1[$j]['share'];

$tableB->easyCell($nominee_name,'width:100%;colspan:7;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->easyCell($address_nomi.",".$post_office_nomi.",\n".$district_nomi.",".$pincode_nomi,'width:100%;colspan:8;align:C;valign:M;font-size:8;font-style:B;border:RB;');
 $tableB->easyCell($nomi_relation,'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:RB;');
 $tableB->easyCell($dob_nomi,'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:RB;');
 $tableB->easyCell($share_nomi,'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:B;border:RB;');
 $tableB->easyCell($guardian_name."\n".$guardian_address,'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:RB;');
 $tableB->printRow();

			
			
			
		}
			
		
		
		
 }
  if($nomi_table==0){

   $tableB->easyCell("-",'width:100%;colspan:7;align:C;valign:M;font-size:8;font-style:;border:RBL;');
 $tableB->easyCell("-",'width:100%;colspan:8;align:C;valign:M;font-size:8;font-style:;border:RB;');
 $tableB->easyCell("-",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:;border:RB;');
 $tableB->easyCell("-",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:;border:RB;');
 $tableB->easyCell("-",'width:100%;colspan:4;align:C;valign:M;font-size:8;font-style:;border:RB;');
 $tableB->easyCell("-",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:;border:RB;');
 $tableB->printRow();  

  
  }
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:;font-style:;border:;');
 $tableB->printRow(); 

 $tableB->easyCell("1",'width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("*Certified that I have no family as defined in para 2(g) of the Employee's Provident Fund Scheme, 1952 and should I acquire a family hereafter the above nomination should be deemed as cancelled.",'width:100%;colspan:31;font-size:8;font-style:;border:;');
 $tableB->printRow();  

 $tableB->easyCell("2",'width:100%;font-size:8;font-style:B;border:;');
 $tableB->easyCell("*Certified that my father/mother is/are dependent upon me.",'width:100%;colspan:31;font-size:8;align:L;font-style:;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 

 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 
 
 $tableB->easyCell("",'width:100%;colspan:10;align:C;font-size:8;border:B;');
 $tableB->easyCell("",'width:100%;colspan:7;align:C;font-size:8;border:;');
 $tableB->easyCell("",'width:100%;colspan:15;align:C;font-size:8;border:B;');
 $tableB->printRow(); 

 
 
 $tableB->easyCell("*Strike out whichever is not applicable",'width:100%;colspan:10;align:C;font-size:8;font-style:B;border:;');
 $tableB->easyCell("",'width:100%;colspan:7;align:C;font-size:8;border:;');
 $tableB->easyCell("Signature or thumb impression of the subscriber",'width:100%;colspan:15;align:C;font-size:8;font-style:B;border:;');
 $tableB->printRow(); 




 
 
$pdf->AddPage(); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);



	$checked =site_url("/assets/images/icon/checked.png");
	$unchecked =site_url("/assets/images/icon/unchecked.png");

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:;');
 $tableB->printRow();

 $logo_path = "assets/images/icon/logo.png";
 $tableB->easyCell("", 'img:'.$logo_path.',w10,h10; align:C;rowspan:2;border:; colspan:4; valign:B;width:50%;');
 $tableB->easyCell("",'align:C;width:100%;colspan:7;font-size:14;font-style:B;border:;');
 $tableB->easyCell("PART B (EPS) (Para 18)",'align:L;width:100%;colspan:11;font-size:14;font-style:B;border:;');
 $tableB->easyCell("",'align:C;width:100%;colspan:10;font-size:14;font-style:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:14;font-size:9;border:;');
 $tableB->easyCell("", 'align:R;width:100%;colspan:6;font-size:9;border:;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:8;font-size:9;border:;');
 $tableB->printRow();

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("I hereby furnish below particulars of the members of my family who would be eligible to receive widow children pension in the event of my death.", 'align:L;width:100%;colspan:32;font-style:B;font-size:9;border:;');
 $tableB->printRow();

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("",'width:100%;align:C;valign:M;font-size:8;font-style:B;border:B;');
 $tableB->easyCell("Name and Address of the Family member(s)",'width:100%;colspan:18;align:C;valign:M;font-size:8;font-style:B;border:TRBL;');
 $tableB->easyCell("",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:B;');
 $tableB->easyCell("",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:B;');
 $tableB->printRow();
  
 $tableB->easyCell("SN",'width:100%;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->easyCell("Name",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("Address",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("Date of Birth",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("Relationship with member",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->printRow();
 $family_count=0;
  for($k=0;$k<$n2;$k++){
	  $sr = $k+1;
		$emp_id1 =	$result2[$k]['emp_id'];
		if($emp_id==$emp_id1)
		{
			$family_count++;
			
		$family_name =	$result2[$k]['family_name'];
		$family_relation =	$result2[$k]['family_relation'];
		$family_dob1 =	$result2[$k]['dob_as_aadhaar'];

			$timestamp = strtotime($family_dob1);
			$family_dob = date('d/m/Y', $timestamp); 
		
 $tableB->easyCell($sr,'width:100%;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->easyCell($family_name,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell($address." , ".$post_office." , ".$district." , ".$pincode,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell($family_dob,'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell($family_relation,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->printRow(); 

			
			
			
		}
			
		
		
		
 }

 if($family_count==0){
 $tableB->easyCell("-",'width:100%;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("-",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:BL;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:RBL;');
 $tableB->printRow(); 
	 
 }
 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("** Certified that I have no family as defined in Para 2 (vii) of Employees’ Pension Sheme, 1995 and should I acquire a family hereafter I shall furnish particulars thereon in the above form.",'width:100%;colspan:32;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("I hereby nominate the following person for receiving the monthly pension (admissible under Para 16 2(a) (i) & (ii) in event of my death without leaving any eligible family member for receiving pension.",'width:100%;colspan:32;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:;border:;');
 $tableB->printRow(); 
 
$n3 = count($result3); 
// echo $n3."<br>";
// echo "<pre>";
// print_r($result3);
// echo "</pre>";

$son_count=0;

  for($s=0;$s<$n3;$s++){
		$emp_id1 =	$result3[$s]['son_emp_id'];
		if($emp_id==$emp_id1)
		{
			$son_count++;
			
		$son_name =	$result3[$s]['son_name'];
		$son_relation =	$result3[$s]['son_relation'];
		$son_dob1 =	$result3[$s]['son_dob_as_aadhaar'];

			$timestamp = strtotime($son_dob1);
			$son_dob = date('d/m/Y', $timestamp); 
		
 $tableB->easyCell("1",'width:100%;align:C;valign:M;font-size:8;font-style:B;border:TRBL;');
 $tableB->easyCell($son_name,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TBL;');
 $tableB->easyCell($address." , ".$post_office." , ".$district." , ".$pincode,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TBL;');
 $tableB->easyCell($son_dob,'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:BLT;');
 $tableB->easyCell($son_relation,'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TRBL;');
 $tableB->printRow(); 

			
			
			
		}
			
		
		
		
 }

 if($son_count==0){
 $tableB->easyCell("-",'width:100%;align:C;valign:M;font-size:8;font-style:B;border:RBLT;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TBL;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TBL;');
 $tableB->easyCell("-",'width:100%;colspan:5;align:C;valign:M;font-size:8;font-style:B;border:TBL;');
 $tableB->easyCell("-",'width:100%;colspan:9;align:C;valign:M;font-size:8;font-style:B;border:TRBL;');
 $tableB->printRow(); 
	 
 }
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
   
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 

 $tableB->easyCell("Date :",'width:100%;colspan:10;align:L;valign:T;font-size:8;font-style:B;border:;');
 $tableB->easyCell("",'width:100%;colspan:7;align:C;font-size:8;border:;');
 $tableB->easyCell("Signature of thumb impression of the subscriber",'width:100%;colspan:15;align:C;font-size:8;font-style:B;border:T;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 

 
 $tableB->easyCell("CERTIFICATE BY EMPLOYER",'width:100%;colspan:32;font-size:12;font-style:B;border:TRBL;');
 $tableB->printRow();
 
 $tableB->easyCell("Certified that the above declaration and nomination has been signed/thumb impressed before me by",'width:100%;colspan:32;align:J;font-size:8;font-style:;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("Shri/Smt./Kum",'width:100%;colspan:4;align:L;font-size:9;font-style:;border:;');
 $tableB->easyCell($name,'width:100%;colspan:12;font-size:9;font-style:;border:B;');
 $tableB->easyCell("employed in my establishment after he/she has read the entries have",'width:100%;colspan:16;font-size:9;font-style:;border:;');
 $tableB->printRow(); 

 $tableB->easyCell("read over to him/her by me and got confirmed by him/",'width:100%;colspan:32;align:L;font-size:9;font-style:;border:;');
 $tableB->printRow(); 

 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 

 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell("",'width:100%;colspan:32;font-size:8;border:;');
 $tableB->printRow(); 
 
 $tableB->easyCell(" ",'width:100%;colspan:15;align:L;valign:T;font-size:8;font-style:;border:;');
 $tableB->easyCell("Signature of the employer or other",'width:100%;colspan:17;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("Place : ".$comp_post_office,'width:100%;colspan:15;align:L;valign:T;font-size:8;font-style:;border:;');
 $tableB->easyCell("Authorized officers of the establishment :-",'width:100%;colspan:9;align:L;font-size:8;font-style:;border:;');
 $tableB->easyCell("",'width:100%;colspan:8;align:C;font-size:8;font-style:;border:B;');
 $tableB->printRow();
 
 $date = date('d/m/Y');

 $tableB->easyCell("",'width:100%;colspan:32;align:L;font-size:8;border:;');
 $tableB->printRow();  

 
 $tableB->easyCell("",'width:100%;colspan:15;align:L;valign:T;font-size:8;font-style:;border:;');
 $tableB->easyCell("Name and address of the factory",'width:100%;colspan:9;align:L;font-size:8;font-style:;border:;');
 $tableB->easyCell($comp_name,'width:100%;colspan:8;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow();  
 
 $tableB->easyCell("Date : ".$next_days,'width:100%;colspan:15;align:L;valign:T;font-size:8;font-style:;border:;');
 $tableB->easyCell("Establishment or rubber stamp there of  :- ",'width:100%;colspan:9;align:L;font-size:8;font-style:;border:;');
 $tableB->easyCell($comp_address." , ".$comp_post_office." , ",'width:100%;colspan:8;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow();

 $tableB->easyCell("",'width:100%;colspan:24;align:L;valign:T;font-size:8;font-style:;border:;');
 $tableB->easyCell($comp_district." , ".$comp_pincode,'width:100%;colspan:8;align:L;font-size:8;font-style:;border:;');
 $tableB->printRow();

 $tableB->endTable(10); 
 
		}

  $pdf->Output();
  ob_end_flush();
?>