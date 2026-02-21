<?php	
ob_start();
$pdf=new exFPDF();
 
$n = count($result);	


		for($i=0;$i<$n;$i++){
 
 
$pdf->AddPage(); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);

//		$month_name1 =	$result[$i]['month_name1'];
//########################################################

  $tableB=new easyTable($pdf,32, 'width:100%;height:100%; align:C{C};  border:1; fbgcolor:#ffffff; font-color:#000000;');

	$checked =site_url("/assets/images/icon/checked.png");
	$unchecked =site_url("/assets/images/icon/unchecked.png");

 $tableB->easyCell("FORM - 3A", 'align:C;width:100%;colspan:32;font-style:B;font-size:14;line-height:0.76;border:TRL;');
 $tableB->printRow();
 
 $tableB->easyCell("(Unexempted Establishment Only)",'width:100%;colspan:32;line-height:0.60;font-size:8;font-style:B;border:RL;');
 $tableB->printRow();
 
 $tableB->easyCell("THE EMPLOYEE'S PROVIDENT FUND SCHEME, 1952", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("(Paras 35 and 42) and", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow();
 
 $tableB->easyCell("THE EMPLOYEES PENSION SCHEME, 1995", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 
 
 $tableB->easyCell("Para 20", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 
 
 $tableB->easyCell("Contribution Card for the currency period from April", 'align:R;width:100%;colspan:15;line-height:0.60;font-style:;font-size:9;border:L;');
 $tableB->easyCell($result[$i]['year'], 'align:L;width:100%;colspan:2;line-height:0.60;font-style:B;font-size:9;border:;');
 $tableB->easyCell("to March 31 ".$result[$i]['next_year'], 'align:L;width:100%;colspan:15;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
 $tableB->easyCell("-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow();
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow();  
 
 $tableB->easyCell("1.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Account No :".$result[$i]['member_id'], 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:;');
 $tableB->easyCell("6.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:;');
 $tableB->easyCell("Statutoty Rate of Contribution :", 'align:L;width:100%;colspan:8;font-style:;font-size:9;border:;');
 $tableB->easyCell(round($result[$i]['ac1eemf'])."%", 'align:C;width:100%;colspan:7;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
 $tableB->easyCell("2.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:L;');
 $tableB->easyCell("UAN :".$result[$i]['uan'], 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:;');
 $tableB->easyCell("7.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:;');
 $tableB->easyCell("Voluntary higher rate of Employees ", 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:R;');
 $tableB->printRow();  

 $tableB->easyCell("3.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Name/Surname :".$result[$i]['name_as_aadhaar'], 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:;');
 $tableB->easyCell("contribution, if any :", 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:R;');
 $tableB->printRow();  
 
 $tableB->easyCell("4.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Father/Husband's Name :".$result[$i]['father_husband'], 'align:L;width:100%;colspan:15;font-style:;font-size:9;border:;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:16;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
 
		$comp_name =	$result[$i]['comp_name'];
		$comp_address =	$result[$i]['comp_address'];
		$comp_post_office =	$result[$i]['comp_post_office'];
		$comp_district =	$result[$i]['comp_district'];
		$comp_pincode =	$result[$i]['comp_pincode'];


 
 $tableB->easyCell("5.", 'align:L;width:100%;colspan:;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Name & Address of the Establishment :", 'align:L;width:100%;colspan:31;font-style:;font-size:9;border:R;');
 $tableB->printRow();  
 
 $tableB->easyCell($comp_name." , ", 'align:L;width:100%;colspan:10;line-height:0.80;font-style:;font-size:9;border:TRBL;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:22;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();

 $tableB->easyCell($comp_address." , ".$comp_post_office, 'align:L;width:100%;colspan:10;line-height:0.80;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:22;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();   
 
 $tableB->easyCell($comp_district." - ".$comp_pincode, 'align:L;width:100%;colspan:10;line-height:0.80;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("", 'align:L;width:100%;colspan:22;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();  
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->printRow(); 

 $tableB->easyCell("Month", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:TRL;');
 $tableB->easyCell("Amount of", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("CONTRIBUTIONS", 'align:C;width:100%;colspan:12;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("Refund of ", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("Non cont.", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("Remarks", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->easyCell("Wages", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("Worker's Share", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("Employer Share", 'align:C;width:100%;colspan:9;line-height:0.60;font-style:;font-size:9;border:TRBL;');
 $tableB->easyCell("Advances", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("services", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->easyCell("Rs.", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TR;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("from ---------", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("EPF", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("EPF", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("EPS", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("TOTAL", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("to ---------", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();  
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("a", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("b", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("c", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->printRow();   

 $tableB->easyCell("1", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:TRBL;');
 $tableB->easyCell("2", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("3", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("4", 'align:C;width:100%;colspan:9;line-height:0.60;font-style:;font-size:9;border:TRBL;');
 $tableB->easyCell("5", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("6", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("7", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("a) Date of Leaving", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:7;border:R;');
 $tableB->printRow();    

 $total_month_name=0;
 $total_gross_wages=0;
 $total_workers_share=0;
 $total_emp_share_epf=0;
 $total_emp_share_eps=0;
 $total_emp_share_total=0;
 $total_emp_ncp_days=0;
 
 $col3 = 0;
  $col4c =0;

  for($k=1;$k<=12;$k++)
 {
 $col3	=$col3 + $result[$i]["workers_share".$k];
 $col4c	=$col4c + $result[$i]["emp_share_epf".$k]+$result[$i]["emp_share_eps".$k];
 } 
  $total_amount = $col3 + $col4c;

 
 
 $msg[1] = $result[$i]['leaving_date'];
 $msg[2] = "b) Reason for leaving service";
 $msg[3] = $result[$i]['reason'];
 $msg[4] = "c) Certified that the total amount of";
 $msg[5] = "contribution indicated in this card";
 $msg[6] = "i.e. Rs. $total_amount";
 $msg[7] = "Col 3+Col4 ( c ) has already";
 $msg[8] = "been remitted in full in EPF A/c";
 $msg[9] = "No 1 ( Provident Fund";
 $msg[10] = "contribution A/c) and in A/c no.";
 $msg[11] = "10 ( Pension Fund";
 $msg[12] = "contribution A/c) and ";
 
 for($j=1;$j<=12;$j++)
 {
	 
 $total_gross_wages		=$total_gross_wages	  + $result[$i]["gross_wages".$j];
 $total_workers_share	=$total_workers_share + $result[$i]["workers_share".$j];
 $total_emp_share_epf	=$total_emp_share_epf + $result[$i]["emp_share_epf".$j];
 $total_emp_share_eps	=$total_emp_share_eps + $result[$i]["emp_share_eps".$j];
 
 
$epf = $result[$i]['emp_share_epf'.$j];
//echo $epf.">epf";
$eps = $result[$i]['emp_share_eps'.$j];
//echo $eps.">eps";
 $ncp_days	= $result[$i]["emp_ncp_days".$j];
 $total_emp_ncp_days	=$total_emp_ncp_days + $ncp_days;


 $total = $epf+$eps;
 
//  $total_emp_share_total	=$total_emp_share_total+$total;

//echo $total.">total";

 $total_emp_share_total	=$total_emp_share_total + $total;
//echo "total>".$total."gtotal>".$total_emp_share_total."<br>";	 
 $tableB->easyCell($result[$i]["month_name".$j], 'align:L;width:100%;colspan:4;line-height:0.60;font-style:;font-size:8;border:RBL;');
 $tableB->easyCell($result[$i]["gross_wages".$j], 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell($result[$i]["workers_share".$j], 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell($epf, 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell($eps, 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell($total, 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell($ncp_days, 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
if(($j==1)||($j==3)){
	$bold = "B";
	$font = "8";
}
else{
	$bold = "";
	$font = "7";
}
 $tableB->easyCell($msg[$j], 'align:C;width:100%;colspan:7;line-height:0.60;font-style:'.$bold.';font-size:'.$font.';border:R;');
 $tableB->printRow(); 
	 
 } 
 
 if($total_emp_ncp_days==0){
	 $total_emp_ncp_days = "NIL";
 }
 
// $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
// $tableB->printRow(); 

/* 
 $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
   $tableB->easyCell("September 2009", 'align:C;width:100%;colspan:5;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("7500", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("625", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("275", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("900", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:6;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 */
  $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("",'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("in A/c no.10 ( Pension Fund", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:7;border:R;');
 $tableB->printRow();    

  $tableB->easyCell("", 'align:C;width:100%;colspan:4;line-height:0.60;font-style:;font-size:9;border:RBL;');
 $tableB->easyCell("$total_gross_wages", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("$total_workers_share", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("$total_emp_share_epf", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("$total_emp_share_eps", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("$total_emp_share_total", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:TRB;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("$total_emp_ncp_days", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:RB;');
 $tableB->easyCell("Contribution account vide note below )", 'align:C;width:100%;colspan:7;line-height:0.60;font-style:;font-size:7;border:RB;');
 $tableB->printRow();    

 
 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 

 $tableB->easyCell("Certified That the difference between the total of the contribution shown under the columns (3) & (4) of the above table and that arrived at on the total Wages shown in Column (2) at the Prescribed rate is solely due to the rounding off of the contributions to the nearest rupee under the rule.", 'align:L;width:100%;colspan:25;line-height:1;font-style:;font-size:9;border:L;');
  $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:1;font-style:;font-size:9;border:R;');
 $tableB->printRow();  
 
 $tableB->easyCell("*Contribution for the month of March paid in April", 'align:C;width:100%;colspan:25;line-height:0.70;font-style:B;font-size:10;border:L;');
  $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:1;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:0.60;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 

 $tableB->easyCell("*IN THE CASE OF AN EMPLOYEE WHO HAS LEFT THE SERVICE OF THE COMPANY EARLIER, HIS CONTRIBUTION", 'align:L;width:100%;colspan:29;line-height:0.60;font-style:B;font-size:9;border:L;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:0.60;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 
 
 $tableB->easyCell("HAS BEEN SHOWN IN THE SUBSEQUENT MONTH WHICH HIS FINAL SETTLEMENT OF SALARY HAS BEEN MADE.", 'align:L;width:100%;colspan:29;line-height:0.60;font-style:B;font-size:9;border:L;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:3;line-height:1;font-style:;font-size:9;border:R;');
 $tableB->printRow();
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow(); 
 
 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell(" ", 'align:C;width:100%;colspan:32;line-height:15;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:25;line-height:0.70;font-style:;font-size:9;border:L;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:0.70;font-style:;font-size:9;border:R;');
 $tableB->printRow(); 

 $tableB->easyCell("", 'align:C;width:100%;colspan:25;line-height:0.70;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Signature of Employer", 'align:C;width:100%;colspan:7;line-height:0.70;font-style:;font-size:10;border:R;');
 $tableB->printRow(); 

 $tableB->easyCell("Date :", 'align:L;width:100%;colspan:25;line-height:0.70;font-style:;font-size:9;border:L;');
 $tableB->easyCell("(Office Seal)", 'align:C;width:100%;colspan:7;line-height:0.70;font-style:;font-size:9;border:R;');
 $tableB->printRow();  

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("Note: 1)", 'align:L;width:100%;colspan:3;line-height:1;font-style:;font-size:9;border:L;');
 $tableB->easyCell("In respect of the Form (3A) sent to the Regional office during the course of the currency period for the purpose of final settlement of the accounts of the members who had left service details of date and reasons for leaving service and also certificate as shown in the Remarks Column should be added.", 'align:L;width:100%;colspan:23;line-height:1;font-style:;font-size:9;border:;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:1;font-style:;font-size:9;border:R;');	
 $tableB->printRow();
 
 $tableB->easyCell("Note: 2)", 'align:L;width:100%;colspan:3;line-height:1;font-style:;font-size:9;border:L;');
 $tableB->easyCell("If there is no period of NCS, the word \"NIL\" to be mentioned against the total column.", 'align:L;width:100%;colspan:23;line-height:1;font-style:;font-size:9;border:;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:1;font-style:;font-size:9;border:R;');	
 $tableB->printRow();	  
 
 $tableB->easyCell("Note: 3)", 'align:L;width:100%;colspan:3;line-height:1;font-style:;font-size:9;border:L;');
 $tableB->easyCell("Wherever no wages are shown against any month the period should be shown as NCS Under Col.", 'align:L;width:100%;colspan:23;line-height:1;font-style:;font-size:9;border:;');
 $tableB->easyCell("", 'align:C;width:100%;colspan:7;line-height:1;font-style:;font-size:9;border:R;');	
 $tableB->printRow();	 
 
 //###############################################

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RL;');
 $tableB->printRow();

 $tableB->easyCell("", 'align:C;width:100%;colspan:32;line-height:1;font-style:;font-size:9;border:RBL;');
 $tableB->printRow(); 
 
 $tableB->endTable(10); 
 
		}
 
 
 $pdf->Output(); 
 ob_end_flush();
?>