<?php	


$pdf=new exFPDF();
$pdf->AddPage('L'); 
$pdf->SetXY(0,5);
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('helvetica','',9);


$arraysize = count($result);

 $tableB=new easyTable($pdf,128, 'width:100%;height:100%; align:C{C};  border:1; fbgcolor:#ffffff; font-color:#000000;');
 
$line_breck = 0; 	
$contractor_name_last = "";
$sr = 0;
 for($k=0;$k<$arraysize;$k++){

	 $row = explode('####',$result[$k]);

	 $contractor_name = $row[1]; 
	 $emp_name	 = $row[2]; 
	 $holidayDate = $row[3]; 
	 	 
	$hdate = explode('*',$holidayDate);
    $hdatecount = count($hdate); 	
	
//echo $contractor_name."<br>";	
		
	 $n = $row[4]; 
	 $sr++;
	
	if($k==0){
		
		
		$tableB->easyCell("Contractor : ".$contractor_name, 'align:L;valign:B;font-stylefont-size:10;border:TBL;colspan:64;');	  
		$tableB->easyCell("Month Year :".$month_year, 'align:R;valign:B;font-size:10;border:TBR;colspan:64;');	  
		$tableB->printRow();
		
		$tableB->easyCell("Sr No.", ' align:L; valign:M;colspan:4;');
		$tableB->easyCell("Employee Name", 'align:L;valign:B;font-size:8;border:TBLR;colspan:21;');	 
		for($i=1;$i<=$days;$i++){
			if($i<10){
				$date = "0".$i;
			}
			else{
				$date = $i;		 
			}
		$tableB->easyCell($date, 'align:C;valign:B;font-size:8;border:TBLR;colspan:3;');	 
		}
		if($days==30){
			$colspan1 = 15;
		}
		else{
			$colspan1 = 12; 
		}
		
		$tableB->easyCell("Total Days Of Work", 'align:L;valign:B;font-size:8;border:TBLR;colspan:'.$colspan1.';');	 
		
		$tableB->printRow();
		
				$line_breck = 0; 	
		
		
	}
	elseif($line_breck==30){
		
	if($contractor_name_last == $contractor_name)
	{
		
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();
		$tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
		$tableB->printRow();

		
		
		
		
		
		
				$tableB->easyCell("Contractor : ".$contractor_name, 'align:L;valign:B;font-stylefont-size:10;border:TBL;colspan:64;');	  
		$tableB->easyCell("Month Year :".$month_year, 'align:R;valign:B;font-size:10;border:TBR;colspan:64;');	  
		$tableB->printRow();
		
		$tableB->easyCell("Sr No.", ' align:L; valign:M;colspan:4;');
		$tableB->easyCell("Employee Name", 'align:L;valign:B;font-size:8;border:TBLR;colspan:21;');	 
		for($i=1;$i<=$days;$i++){
			if($i<10){
				$date = "0".$i;
			}
			else{
				$date = $i;		 
			}
		$tableB->easyCell($date, 'align:C;valign:B;font-size:8;border:TBLR;colspan:3;');	 
		}
		if($days==30){
			$colspan1 = 15;
		}
		else{
			$colspan1 = 12; 
		}
		
		$tableB->easyCell("Total Days Of Work", 'align:L;valign:B;font-size:8;border:TBLR;colspan:'.$colspan1.';');	 
		$tableB->printRow();
		
				$line_breck = 0; 
	}

		
		
		
		
		

		
	}


	if(($contractor_name_last != $contractor_name)&&($k!=0))
	{
		
		
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("Signature of Contractor", ' font-size:10;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();

		
		
		$sr = 1;
				
				$pdf->AddPage('L'); 
				$pdf->SetXY(0,5);
				$pdf->SetMargins(5,5,5);
				$pdf->SetAutoPageBreak(false);
				$pdf->SetFont('helvetica','',9);
			
				
		$tableB->easyCell("Contractor : ".$contractor_name, 'align:L;valign:B;font-stylefont-size:10;border:TBL;colspan:64;');	  
		$tableB->easyCell("Month Year :".$month_year, 'align:R;valign:B;font-size:10;border:TBR;colspan:64;');	  
		$tableB->printRow();
		
		$tableB->easyCell("Sr No.", ' align:L; valign:M;colspan:4;');
		$tableB->easyCell("Employee Name", 'align:L;valign:B;font-size:8;border:TBLR;colspan:21;');	 
		for($i=1;$i<=$days;$i++){
			if($i<10){
				$date = "0".$i;
			}
			else{
				$date = $i;		 
			}
		$tableB->easyCell($date, 'align:C;valign:B;font-size:8;border:TBLR;colspan:3;');	 
		}
		if($days==30){
			$colspan1 = 15;
		}
		else{
			$colspan1 = 12; 
		}
		
		$tableB->easyCell("Total Days Of Work", 'align:L;valign:B;font-size:8;border:TBLR;colspan:'.$colspan1.';');	 
		
		$tableB->printRow();
		
					$line_breck = 0; 	

	}

	$contractor_name_last = $contractor_name; 

		$line_breck++;
	
 $tableB->easyCell($sr, ' align:L; valign:M;colspan:4;');
 $tableB->easyCell($emp_name, 'align:L;valign:B;font-size:8;border:TBLR;colspan:21;');	 
 for($i=1;$i<=$days;$i++){
	 if($i<10){
		 $date = "0".$i;
	 }
	 else{
		$date = $i;		 
	 }

	 $bgcolor = "";
	for($r=1;$r<$hdatecount;$r++)
	{
		$h_date = explode('-',$hdate[$r]);
		if($date==$h_date[2]){
			$bgcolor = "#ff0000";
		}
		
	}
	 
 $tableB->easyCell("", 'align:C;valign:B;font-size:8;border:TBLR;colspan:3;bgcolor:'.$bgcolor.';');	 
 
 
 }
 if($days==30){
	$colspan1 = 15;
 }
 else{
	 $colspan1 = 12; 
 }
 
 $tableB->easyCell("", 'align:L;valign:B;font-size:8;border:TBLR;colspan:'.$colspan1.';');	 
 
 $tableB->printRow();

$arrayc = $arraysize-1;
if($arrayc==$k){
	 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("", ' font-size:8;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();
 $tableB->easyCell("Signature of Contractor", ' font-size:10;align:R; valign:M;border:;colspan:128;');
 $tableB->printRow();

}
 }

	 

//###############################################

 $tableB->endTable(10);

 $pdf->Output(); 


?>
