<?php	
ob_start();
$pdf=new exFPDF();

$n = count($result);	

		for($i=0;$i<$n;$i++)
		{
			
		$contry_origin =	$result[$i]['contry_origin'];
		$name =	$result[$i]['name_as_aadhaar'];
		$relation =	$result[$i]['relation'];
		$father_husband =	$result[$i]['father_husband'];
		$UAN =	$result[$i]['uan'];
		$dob =	$result[$i]['dob'];
		$doj =	$result[$i]['doj'];
		$gender =	$result[$i]['gender'];
		$marital_status =	$result[$i]['marital_status'];
		$email =	$result[$i]['email'];
		$mobile =	$result[$i]['mobile'];
		$international_worker =	$result[$i]['international_worker'];
		$passport_no =	$result[$i]['passport_no'];
		$passport_from_date =	$result[$i]['passport_from_date'];
		$passport_till_date =	$result[$i]['passport_till_date'];
		$member_id_org =	$result[$i]['member_id_org'];
		$post_office =	$result[$i]['post_office'];
		$bank_acc_no =	$result[$i]['bank_acc_no'];
		$ifsc =	$result[$i]['ifsc'];
		$pan_no =	$result[$i]['pan_no'];
		$aadhaar_no =	$result[$i]['aadhaar_no'];

$pdf->AddPage(); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);



//########################################################

  $tableB=new easyTable($pdf,32, 'width:100%;height:100%; align:C{C};  border:1; fbgcolor:#ffffff; font-color:#000000;line-height:0.76;');

	$checked = "assets/images/icon/checked.png";
	$unchecked = "assets/images/icon/unchecked.png";

 $tableB->easyCell("",'width:100%;colspan:32;font-size:30;font-style:i;border:TRL;');
 $tableB->printRow();

 $logo_path = "assets/images/icon/logo.png";
 $tableB->easyCell("", 'img:'.$logo_path.',w30,h35; align:L;rowspan:5;border:L; colspan:4; valign:B;width:50%;');

 $tableB->easyCell("New Form No.11 - Declaration Form",'align:R;width:100%;colspan:28;font-size:14;font-style:B;border:R;');
 $tableB->printRow();

 $tableB->easyCell("( To be retained by the Employer for future reference )", 'align:R;width:100%;colspan:28;font-size:9;border:R;');
 $tableB->printRow();


 $tableB->easyCell("EMPLOYEES' PROVIDENT FUND ORGANIZATION",'align:C;width:100%;colspan:24;font-size:14;font-style:B;border:;');
 $tableB->easyCell("", 'border:R;colspan:2;  valign:C; colspan:4;');
 $tableB->printRow();
 
 $tableB->easyCell("Employees' Provident Funds Scheme, 1952 (Paragraph 34 & 57)&",'align:C;width:100%;colspan:24;font-size:10;font-style:;border:;');
 $tableB->easyCell("", 'border:R;colspan:2;  valign:C; colspan:4;');
 $tableB->printRow();

 $tableB->easyCell("The Employees' Pension Scheme, 1995 (Paragraph)",'align:C;width:100%;colspan:24;font-size:10;font-style:;border:;');
 $tableB->easyCell("", 'border:R;colspan:2;  valign:C; colspan:4;');
 $tableB->printRow();
  
 $tableB->easyCell("Declaration by a person taking up employment in an establishment on which EPFS 1952 and/or EPS 1995 is applicable",'align:C;width:100%;colspan:32;font-size:10;font-style:;border:RL;');
 $tableB->printRow();
 
 $tableB->easyCell("1", ' align:L; valign:M;');
 $tableB->easyCell("Name of the Member", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($name, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:L;valign:B;font-size:8;border:LR;');
 $tableB->easyCell("",'align:L; colspan:14;font-size:8; valign:B;border:LR;');
 $tableB->easyCell("",'align:L; colspan:17;font-size:8; valign:B;border:LR;');
 $tableB->printRow();

 $tableB->easyCell("2", 'align:L;valign:M;border:LR;');
 $tableB->easyCell("Father's Name",'align:L; colspan:4;font-size:8; valign:B;border:L;');
 if($relation=='FATHER'){
	$tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:; colspan:1; valign:B;width:50%;');	 
 }
 else{
	$tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;width:50%;');	 
 }
// $tableB->easyCell("",'align:L; colspan:1;font-size:8; valign:B;;border:LRBT;');
 $tableB->easyCell("   Husband's Name",'align:L; colspan:4;font-size:8; valign:B;border:;');
 
if($relation=='HUSBAND'){
	$tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:; colspan:1; valign:B;width:50%;');	 
 }
 else{
	$tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;width:50%;');	 
 }
 
 $tableB->easyCell("",'align:L; colspan:4;font-size:8; valign:B;;border:R;');
 $tableB->easyCell($father_husband,'align:L; colspan:17;font-size:8; valign:B;border:LR;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:L;valign:B;font-size:8;border:LRB;');
 $tableB->easyCell("( Please tick whichever is applicable )",'align:L; colspan:14;font-size:8; valign:B;border:LRB;');
 $tableB->easyCell("",'align:L; colspan:17;font-size:8; valign:B;border:LRB;');
 $tableB->printRow();
$dob = date("d/m/Y", strtotime($dob));
$doj = date("d/m/Y", strtotime($doj));
 $tableB->easyCell("3", ' align:L; valign:M;');
 $tableB->easyCell("Date of Birth (DD/MM/YYYY)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($dob, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();


 $tableB->easyCell("4", ' align:L; valign:M;');
 $tableB->easyCell("Gender (Male/Female/Transgender)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($gender, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();


 $tableB->easyCell("5", ' align:L; valign:M;');
 $tableB->easyCell("Marital Status(Married/Unmarried/Widow/Widower/Divorcee)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($marital_status, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();


 $tableB->easyCell("6", 'rowspan:2; align:L; valign:M;');
 $tableB->easyCell("(a) Email Id", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($email, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();

 if($mobile==0){
	  $mobile = "";
 }
 $tableB->easyCell("(b) Mobile No.", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell($mobile, ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("7", ' align:L; valign:M;font-size:8;');
 $tableB->easyCell("Whether earlier a member of the Employees' Provident \n Fund Scheme, 1952 ?", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("Yes", ' align:R; colspan:2;font-size:8; border:B;valign:B;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:B; colspan:1; valign:B;width:50%;');
 $tableB->easyCell("", ' align:L; colspan:1;font-size:8; valign:B;border:B;');
 $tableB->easyCell("No", ' align:R; colspan:2;font-size:8; valign:B;border:B;');
 $tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:B; colspan:1; valign:B;width:50%;');
 $tableB->easyCell("", ' align:L; colspan:11;font-size:8; valign:B;border:BR;');
 $tableB->printRow();

 $tableB->easyCell("8", ' align:L; valign:M;font-size:8;');
 $tableB->easyCell("Whether earlier a member of the Employees' Pension  Scheme, \n 1952 ?", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("Yes", ' align:R; colspan:2;font-size:8; border:B;valign:B;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:B; colspan:1; valign:B;width:50%;');
 $tableB->easyCell("", ' align:L; colspan:1;font-size:8; valign:B;border:B;');
 $tableB->easyCell("No", ' align:R; colspan:2;font-size:8; valign:B;border:B;');
 $tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:B; colspan:1; valign:B;width:50%;');
 $tableB->easyCell("", ' align:L; colspan:11;font-size:8; valign:B;border:BR;');
 $tableB->printRow();




 $tableB->easyCell("", 'rowspan: align:L; valign:B;font-size:8;border:LR;');
 $tableB->easyCell("Previous employment details [if Yes to 7 &/or 8 above ]", ' align:L; colspan:14;font-size:8; valign:B;border:RL;font-style:B;');
 $tableB->easyCell("", ' align:L; colspan:17;font-size:8; valign:B;border:RL;');
 $tableB->printRow();
 $tableB->easyCell("", 'rowspan: align:L; valign:B;font-size:8;border:LR;');
 $tableB->easyCell("a) Universal Account Number", ' align:L; colspan:14;font-size:8; valign:B;border:RL;');
 $tableB->easyCell("N.A.", ' align:L; colspan:17;font-size:8; valign:B;border:RL;');
 $tableB->printRow();
 $tableB->easyCell("", 'rowspan: align:L; valign:B;font-size:8;border:LR;');
 $tableB->easyCell("b) Previous PF Account Number", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("N.A.", ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();
 $tableB->easyCell("9", 'rowspan:; align:L; valign:M;border:LR;');
 $tableB->easyCell("c) Date of exit From previous employment(DD/MM/YYYY)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("N.A.", ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();
 $tableB->easyCell("", 'rowspan: align:L; valign:B;font-size:8;border:LR;');
 $tableB->easyCell("d) Scheme Certificate No.(if issued)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("N.A.", ' align:L; colspan:17;font-size:8; valign:B;');
 $tableB->printRow();
 $tableB->easyCell("", 'rowspan: align:L; valign:B;font-size:8;border:LR;');
 $tableB->easyCell("e) Pension Payment Order (PPO) No. (if issued)", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("N.A.", ' align:L; colspan:17;font-size:8; valign:B;border:R;');
 $tableB->printRow();
 $tableB->easyCell("10",'colspan:1;rowspan:4; align:L;valign:M;');
 $tableB->easyCell("a) Internation Worker", ' align:L; colspan:14;font-size:8; valign:B;');
 $tableB->easyCell("Yes", ' align:R; colspan:2;font-size:8; border:TB;valign:B;');
	if($international_worker=="Y"){
		
 $tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:TB; colspan:1; valign:B;width:50%;');
 	$passport_from_date = date("d/m/Y", strtotime($passport_from_date));
	$passport_till_date = date("d/m/Y", strtotime($passport_till_date));
$validity = $passport_from_date.' to '.$passport_till_date;

	}
	else{
		$validity = "";
				$passport_no =	"";
		$passport_from_date =	"";
		$passport_till_date =	"";
		$contry_origin	=	"";
		
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:TB; colspan:1; valign:B;width:50%;');
		
	}
 $tableB->easyCell("", ' align:L; colspan:1;font-size:8; valign:B;border:TB;');
 $tableB->easyCell("No", ' align:R; colspan:2;font-size:8; valign:B;border:TB;');
 
 	if($international_worker=="Y"){
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:TB; colspan:1; valign:B;width:50%;');
	
	
	}
	else{
		
		
		
 $tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:TB; colspan:1; valign:B;width:50%;');
		
	}
 $tableB->easyCell("", ' align:L; colspan:11;font-size:8; valign:B;border:BRT;');
 $tableB->printRow();

 $tableB->easyCell("b) If yes, state country of origin", ' colspan:7;  align:L; valign:B;font-size:8;border:L;');
 $tableB->easyCell("(india/Name of other Country)", ' colspan:7;  align:L; valign:B;font-size:8;border:R;');
 $tableB->easyCell($contry_origin, ' colspan:17;  align:R; valign:B;');
$tableB->printRow();

 $tableB->easyCell("c) Passport No.", ' colspan:14;  align:L; valign:B;font-size:8;border:TBL;');
 $tableB->easyCell($passport_no, ' colspan:17;  align:R; valign:B;');
$tableB->printRow();

 $tableB->easyCell("d) Validity of Passport [ (DD/MM/YYYY) to (DD/MM/YYYY) ]", ' colspan:14;  align:L; valign:B;font-size:8;border:TBL;');
 $tableB->easyCell($validity, ' colspan:17;  align:R; valign:B;');
$tableB->printRow();

 $tableB->easyCell("11",'colspan:1;rowspan:5; align:L;valign:M;');
 $tableB->easyCell("KYC Details", ' align:L; colspan:3;font-size:8; valign:B;font-style:B;border:;');
 $tableB->easyCell("(attach self attested copies of following KYCs)", ' align:L; colspan:11;font-size:8; valign:B;border:R;');
 $tableB->easyCell("", ' align:L; colspan:17;font-size:8; valign:B;border:R;');
 $tableB->printRow();

 $tableB->easyCell("a) Bank Account No. ", ' colspan:14;  align:L; valign:B;font-size:8;border:LB;');
 $tableB->easyCell($bank_acc_no, ' colspan:17;  align:L; valign:B;border:RL;');
$tableB->printRow();

 $tableB->easyCell("B) IFS Code", ' colspan:14;  align:L; valign:B;font-size:8;border:L;');
 $tableB->easyCell($ifsc, ' colspan:17;  align:L; valign:B;');
$tableB->printRow();

 $tableB->easyCell("C) AADHAR No.", ' colspan:14;  align:L; valign:B;font-size:8;border:TBL;');
 $tableB->easyCell($aadhaar_no, ' colspan:17;  align:L; valign:B;');
$tableB->printRow();

 $tableB->easyCell("D) Permanent Account No. (PAN),if available", ' colspan:14;  align:L; valign:B;font-size:8;border:TBL;');
 $tableB->easyCell($pan_no, ' colspan:17;  align:L; valign:B;');
$tableB->printRow();


 $tableB->easyCell("", ' align:L; colspan:13;font-size:8; valign:B;border:;');
 $tableB->easyCell("UNDERTAKING", ' align:C; colspan:6;font-size:12;font-style:B; valign:B;border:B;');
 $tableB->easyCell("", ' align:L; colspan:13;font-size:8; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:7; valign:B;border:;');
 $tableB->easyCell("1) Certified that the particulars are true to the best of my knowledge", ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:7; valign:B;border:;');
 $tableB->easyCell("2)  I authorize EPFO to use my Aadhar for verification/authentication/eKYC purpose for service delivery" , ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:8; valign:B;border:;');
 $tableB->easyCell("3) Kindly transfer the funds and service details, if applicable, from the previous PF account as declared above to the present PF account
(The transfer would be possible only if the identified KYC detail approved by previous employer has been verified by present employer using his Digital Signature Certificate)" , ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();



 $tableB->easyCell("", ' align:L; colspan:1;font-size:8; valign:B;border:;');
 $tableB->easyCell("4) In case of changes in above details, the same will be intimated to employer at the earliest.
" , ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();
$date = date('d/m/Y');
 $tableB->easyCell("Date :", ' font-size:8;align:L; valign:M;border:;colspan:2;');
 $tableB->easyCell($result[$i]['next_days'], ' align:L; valign:M;border:B;colspan:4;font-size:8;');
 $tableB->easyCell("", ' align:L; colspan:10;font-size:8; valign:B;border:;');
 $tableB->easyCell("", ' align:L; colspan:17;font-size:8; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("Place :", ' align:L; valign:M;border:;colspan:2;font-size:8;');
 $tableB->easyCell($result[$i]['comp_post_office'], ' align:L; valign:M;border:B;colspan:4;font-size:8;');
 $tableB->easyCell("", ' align:L; colspan:10;font-size:8; valign:B;border:;');
 $tableB->easyCell("", ' align:L; colspan:10;font-size:8; valign:B;border:;');
 $tableB->easyCell("Signature of the Member", ' align:L; valign:M;border:;colspan:6;font-size:8;');
 $tableB->printRow();


 $tableB->easyCell("", ' align:L; colspan:9;font-size:10; valign:B;border:;');
 $tableB->easyCell("DECLARATION BY PRESENT EMPLOYER", ' align:C; colspan:14;font-size:12;font-style:B; valign:B;border:;');
 $tableB->easyCell("", ' align:L; colspan:9;font-size:10; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:6; valign:B;border:;');
 $tableB->easyCell("A. The member Mr./Ms./Mrs.  " , ' align:L; colspan:7;font-size:8; valign:B;border:;');
 $tableB->easyCell($name, ' align:C; colspan:14;font-size:8;font-style:B; valign:B;border:B;');
 $tableB->easyCell("has joined on  " , ' align:R; colspan:5;font-size:8; valign:B;border:;');
 $tableB->easyCell($doj, ' align:C; colspan:4;font-size:8; valign:B;border:B;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:6; valign:B;border:;');
 $tableB->easyCell(" and has been allotted PF Number" , ' align:L; colspan:10;font-size:8; valign:B;border:;');
 $tableB->easyCell($member_id_org,' align:C; colspan:15;font-size:9;font-style:B;valign:B;border:B;');
 $tableB->easyCell("", ' align:C; colspan:4;font-size:6; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:1;font-size:6; valign:B;border:;');
 $tableB->easyCell("B.  In case the person was earlier not a member of EPF Scheme, 1952 and EPS, 1995:" , ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();

 
 $tableB->easyCell("", ' align:L; colspan:2;font-size:6; valign:B;border:;');
 $tableB->easyCell("*   (Post allotment of UAN) The UAN allotted for the member is" , ' align:L; colspan:14;font-size:8; valign:B;border:;');
 $tableB->easyCell("", ' align:L; colspan:2;font-size:6; valign:B;border:;');
 $tableB->easyCell($UAN, ' align:L; colspan:10;font-size:9;font-style:B; valign:B;border:B;');
 $tableB->easyCell("", ' align:L; colspan:4;font-size:9;font-style:B; valign:B;border:;');
 $tableB->printRow();

 
 
 $tableB->easyCell("", ' align:L; colspan:2;font-size:6; valign:B;border:;');
 $tableB->easyCell("*   Please Tick the Appropriate Option:" , ' align:L; colspan:30;font-size:8;font-style:B; valign:B;border:;');
 $tableB->printRow();
 
 $tableB->easyCell("", ' align:L; colspan:4;font-size:6; valign:B;border:;');
 $tableB->easyCell("The KYC details of the above member in the UAN database" , ' align:L; colspan:28;font-size:8;valign:B;border:;');
 $tableB->printRow();
 
 
 $tableB->easyCell("", ' align:L; colspan:6;font-size:6; valign:B;border:;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;height:50%;width:50%;');
 $tableB->easyCell("Havenot been uploaded" , ' align:L; colspan:25;font-size:8;valign:B;border:;');
 $tableB->printRow();
 
 
 $tableB->easyCell("", ' align:L; colspan:6;font-size:6; valign:B;border:;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;height:50%;width:50%;');
 $tableB->easyCell("Havebeen uploaded but not approved" , ' align:L; colspan:25;font-size:8;valign:B;border:;');
 $tableB->printRow();
 
 
 $tableB->easyCell("", ' align:L; colspan:6;font-size:6; valign:B;border:;');
 $tableB->easyCell("", 'img:'.$checked.',w30,h35; align:L;border:; colspan:1; valign:B;height:50%;width:50%;');
 $tableB->easyCell("Havebeen uploaded and approved with DSC" , ' align:L; colspan:25;font-size:8;valign:B;border:;');
 $tableB->printRow();
 
  $tableB->easyCell("", ' align:L; colspan:1;font-size:6; valign:B;border:;');
 $tableB->easyCell("C.   In case the person was earlier a member of EPF Scheme, 1952 and EPS, 1995:" , ' align:L; colspan:31;font-size:8; valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:2;font-size:6; valign:B;border:;');
 $tableB->easyCell("*    The above PFAccount Number/ UAN of the member as mentioned in (A) above has been tagged with his/her UAN/Previous
Member ID as declared by member." , ' align:L; colspan:30;font-size:8;valign:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:L; colspan:2;font-size:6; valign:B;border:;');
 $tableB->easyCell("*   Please Tick the Appropriate Option:" , ' align:L; colspan:30;font-size:8;font-style:B;valign:B;border:;');
 $tableB->printRow();


 $tableB->easyCell("", ' align:L; colspan:6;font-size:6; valign:B;border:;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;height:50%;width:50%;');
 $tableB->easyCell("The KYC details of the above member in the UAN database have been approved withDSCand transfer request has been generated on portal" , ' align:L; colspan:25;font-size:8;valign:B;border:;');
 $tableB->printRow();


 $tableB->easyCell("", ' align:L; colspan:6;font-size:6; valign:B;border:;');
 $tableB->easyCell("", 'img:'.$unchecked.',w30,h35; align:L;border:; colspan:1; valign:B;height:50%;width:50%;');
 $tableB->easyCell("As theDSCof establishment are not registered with EPFO, the member has been informed to file physical claim (Form 13) for transfer of funds
from his previous establishment.
" , ' align:L; colspan:25;font-size:8;valign:B;border:;');
 $tableB->printRow();


 $tableB->easyCell("Date :", ' font-size:8;align:L; valign:M;border:;colspan:2;');
 $tableB->easyCell("..........................", ' align:L; valign:M;border:;colspan:6;font-size:8;');
 $tableB->easyCell("", ' font-size:8;align:L; valign:M;border:;colspan:13;');
 $tableB->easyCell("Signature of Employer with Seal of Establishment", ' font-size:8;align:R; valign:M;border:;colspan:11;');
 $tableB->printRow();

 
 $tableB->endTable(10);

		}
	 

//###############################################


 $pdf->Output();
ob_end_flush(); 
?>