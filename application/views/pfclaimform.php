<?php	
ob_start();
$pdf=new exFPDF();
$pdf->AddPage(); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);
$count = count($result);

if($count>0){


//########################################################

  $tableB=new easyTable($pdf,64, 'width:100%;height:100%; align:C{C};  border:1; fbgcolor:#ffffff; font-color:#000000;line-height:1.5;');


  
	$yes ="assets/images/icon/yes.png";
	$checked ="assets/images/icon/checked.png";
	$unchecked ="assets/images/icon/unchecked.png";

 $tableB->easyCell("",'width:100%;colspan:64;font-size:30;font-style:i;border:;');
 $tableB->printRow();

$logo_path = "assets/images/icon/logo.png";
 $tableB->easyCell("", 'img:'.$logo_path.',w15,h12; align:L;rowspan:3;border:; colspan:8; valign:B;width:50%;');
 $tableB->easyCell("", 'align:R;width:100%;colspan:56;font-size:9;border:C;');
 $tableB->printRow();

 
 $tableB->easyCell("EMPLOYEES' PROVIDENT FUNDS ORGANISATION",'align:C;width:100%;colspan:40;font-size:12;font-style:B;border:;');
 $tableB->easyCell("Mobile Number ",'v-align:M;align:L;width:100%;colspan:8;font-size:9;font-style:;border:;');
 $tableB->easyCell("9789575252",'align:L;width:100%;colspan:7;font-size:9;font-style:;border:RLTB;');
 $tableB->easyCell("",'align:L;width:100%;colspan:;font-size:9;font-style:;border:;');
 $tableB->printRow();

 $tableB->easyCell("",'align:R;width:100%;colspan:6;font-size:9;font-style:;border:;');
 $tableB->easyCell("COMPOSITE CLAIM FORM (AADHAR)",'align:C;width:100%;colspan:28;font-size:12;font-style:B;border:B;');
 $tableB->easyCell("",'align:R;width:100%;colspan:22;font-size:9;font-style:;border:;');
 $tableB->printRow();

 $tableB->easyCell("(APPLICABLE IN CASES WHERE EMPLOYEES' COMPLETE DETAILS IN FORM-11 (NEW), AADHAR NUMBER AND BANK ACCOUNT DETAILS ARE AVAIALABLE ON UAN PORTAL AND UAN HAS BEEN ACTIVATED)", 'align:C;width:100%;colspan:64;font-size:7;font-style:B;border:;');
 $tableB->printRow();

 $tableB->easyCell("[FORM NO. - 19 (PF FINAL SETTLEMENT)/10C (PENSION WITHDRAWAL BENEFITS)/ 31 (PF PART WITHDRAWAL)]", 'align:C;width:100%;colspan:64;font-size:9;font-style:B;border:B;');
 $tableB->printRow();

 $tableB->easyCell("1", 'colspan:2;rowspan:2; align:C; valign:M;');
 $tableB->easyCell("Claim applied for", ' align:L;border:; colspan:10;font-size:8;font-style:B; valign:B;');
 $tableB->easyCell("i) Final PF Settlement (  ", ' align:R; colspan:12;border:;font-size:8; valign:B;');
 $tableB->easyCell("", 'img:'.$checked.',w50,h50; align:L;border:; valign:B;width:100%;colspan:2;');
 $tableB->easyCell(") ii) Pension Withdrawal Benefits (", ' align:L;border:; colspan:15;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'img:'.$checked.',w50,h50; align:L;border:;valign:B;width:100%;colspan:2;');
 $tableB->easyCell(") iii) PF PART WITHDRAWAL (", ' align:L;border:; colspan:14;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'img:'.$unchecked.',w50,h50; align:L;border:; valign:B;width:100%;colspan:2;');
 $tableB->easyCell(")", ' align:L;border:R; colspan:5;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 $tableB->easyCell("(Tick whichever is/are applicable)", ' align:L;border:BR; colspan:62;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 
 $tableB->easyCell("2", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("Name of the member (IN CAPITAL LETTERS)", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell($result[0], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 
 $tableB->easyCell("3", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("a) Universal Account Number(UAN)", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("a) ".$result[1], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 
 $tableB->easyCell("4", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("Aadhar Number", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell($result[2], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 $tableB->easyCell("5", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("Date of joining the establishment", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell($result[3], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 
 $tableB->easyCell("6", ' align:C;rowspan:11;colspan:2;font-size:9;font-style:; valign:M;');

 $tableB->easyCell("a) Purpose of PF Part Withdrawal(Tick P whichever applicable)  \n \n \n b) Amount (in Rs.): _________________________________ \n \n \n  c) For purpose of Site/House/Flat or Construction through 'agency' or
Repayment of Housing Loan or LIC, indicate cheque to be drawn '
in favour of' and payees address.", 'rowspan:11;align:L;border:BR; colspan:31;font-size:8;font-style:; valign:T;');
 $tableB->easyCell("", 'align:C;border:R; colspan:31;font-size:8;font-style:; valign:T;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("SN", 'align:C;border:R; colspan:2;font-size:8;font-style:B; valign:B;border:LRTB;');
 $tableB->easyCell("Purpose of PF Part Withdrawal", 'align:C;border:BTLR; colspan:24;font-size:8;font-style:B; valign:B;');
 $tableB->easyCell("", 'img:'.$yes.',w50,h50; align:R;border:LTB; valign:B;width:100%;colspan:2;');
 $tableB->easyCell("", 'align:C;border:RBT; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("i", 'align:C;border:RB; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Housing Loan/Purchase of site/House/Flat or for Construction/Addition, alteration in existing house/Repayment of Housing loan(Para 686/68BB/68BC)", 'align:L;border:BR; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("ii", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Lockout or clousure of factory (para 68H)", 'align:L;border:BR; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("iii", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Illness of member/family (Para 68J)", 'align:L;border:RB; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("iv", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Marriage of self/son/daughter/brother/sister (Para 68K)", 'align:L;border:RB; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("v", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Post Matriculation education of children (Para 68K)", 'align:L;border:BR; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("vi", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Natural calamity (Para 68L)", 'align:L;border:RB; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
  $tableB->easyCell("vii", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Cut in electricity in establishment \n (Para68M)", 'align:L;border:RB; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("viii", 'align:C;border:BR; colspan:2;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Advance for Physically handicapped (Para 68N)", 'align:L;border:RB; colspan:24;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RB; colspan:3;font-size:8;font-style:; valign:B;');
 $tableB->easyCell("", 'align:C;border:RL; colspan:1;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;border:RBL; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();


 
 $tableB->easyCell("7", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("Date of leaving service (not required if applying for PF Part Withdrawal)", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell($result[4], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->printRow();
 
 
 $tableB->easyCell("8", ' align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("a) Permanent Account No.(PAN) (Only in case of service less than 5 years) \n (Please enclose two copies of Form No. 15G/15H, if applicable) \n \n   b) Reason of leaving Service\n  -Service terminated on account of (a) ill health of member \n (b)Contraction /Discontinuation of employer's business or \n 	 (c) Other Cause beyond the control of the member \n - Personal Reasons", ' align:L;border:RB; colspan:31;font-size:8;font-style:; valign:B;');
 $tableB->easyCell($result[5].",  \n \n \n \n  ".$result[6], ' align:C;border:RB; colspan:31;font-size:8;font-style:; valign:M;');
 $tableB->printRow();
 
 
 
 $tableB->easyCell("9", 'rowspan:2; align:C;colspan:2;font-size:9;font-style:; valign:M;');
 $tableB->easyCell("Full Postal address", 'rowspan:2; align:L;border:RB; colspan:31;font-size:8;font-style:;valign:T;');
 $tableB->easyCell($result[7]." , " .$result[8]." , " .$result[9], ' align:C;border:R; colspan:31;font-size:8;font-style:; valign:M;');
 $tableB->printRow();
 
 $tableB->easyCell("", 'align:R;border:B;colspan:25;font-size:8;font-style:; valign:M;');
 $tableB->easyCell("Pin   ".$result[10], 'align:L;border:RB;colspan:6;font-size:8;font-style:; valign:M;');
 $tableB->printRow();
 
 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 
 $tableB->easyCell("-", ' align:C;colspan:;font-size:9;font-style:;border:; valign:M;');
 $tableB->easyCell("", ' align:C;colspan:;font-size:9;font-style:;border:; valign:M;');
 $tableB->easyCell("Certified that the particulars are true to the best of my knowledge. I certify that I have gone through the data seeded in UAN Portal and found all data, including Form No.-11 (New), bank account details and Aadhar number, to be correct. Please make the payment in the bank account mentioned in the
UAN Portal. A cancelled cheque (containing member's name, bank account number and IFS Code) is attached herewith.", ' align:L;border:; colspan:62;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

  $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();




 $tableB->easyCell("-", ' align:C;colspan:;font-size:9;font-style:;border:; valign:M;');
 $tableB->easyCell("", ' align:C;colspan:;font-size:9;font-style:;border:; valign:M;');
 $tableB->easyCell("In case the amount is used for any purpose other than stated in column (6) above, I am liable to return the entire amount with penal interest.", ' align:L;border:; colspan:62;font-size:8;font-style:; valign:B;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();
 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();

 $tableB->easyCell("", ' align:C;colspan:64;font-size:9;font-style:;border:; valign:M;');
 $tableB->printRow();



 $tableB->easyCell("", ' align:C;colspan:50;font-size:9;font-style:;border:; valign:M;');
 $tableB->easyCell("Member's Signature", ' align:R;border:; colspan:14;font-size:8;font-style:; valign:B;');
 $tableB->printRow();


 $tableB->endTable(10);


	 

//###############################################

	
}
 $pdf->Output(); 
 ob_end_flush();
?>