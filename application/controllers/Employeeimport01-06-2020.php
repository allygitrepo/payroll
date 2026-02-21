<?php
	
class Employeeimport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
		$this->load->library('excel');
		$this->load->helper('form');
		$this->load->helper("file");	
		$this->load->library("upload");
		$this->load->library('zip');
		

       $this->load->model('Employeeimportmodel');
	set_time_limit(0);

    }
	
	
	
	
		public function convert_excel_to_text(){
	
	$file_info = pathinfo($_FILES["file"]["name"]);
$file_directory = "uploads/";
$new_file_name = $_FILES["file"]["name"];
$result = array();

if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
{   
    $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	ini_set('precision', 20);
	
$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
//$nrColumns = ord($highestColumn) - 1;
	$data1 = "";

$column = 'A';
//$lastRow = $worksheet->getHighestRow();
$row = 2;
//echo $highestColumm;
$count= $highestColumm;
$count++;
//echo $count;
//$highestColumm = $highestColumm++;
//echo $count;
for ($row = 2; $row <= $highestRow; $row++) {
//    $cell = $worksheet->getCell($column.$row);
	//	echo $nrColumns;
	
	for ($column = 'A'; $column != $count; $column++) {
//	echo $count;
		$cell = $objPHPExcel->setActiveSheetIndex(0)->getCell($column.$row);
		if($column ==($highestColumm)){
					$data1 .= $cell;
			
		}
		else{
					$data1 .= $cell."#~#";
		}

	}
	if($row <= $highestRow-1){
		$data1 .= "\n";
	}

}
}	
			$text_file_name = explode(".",$new_file_name);
						$text_file_name1 = $text_file_name[0];				

		$todate= date('d-m-Y');
$file = $text_file_name1.'.txt';
header('Content-type: text/plain');
//header('Content-Length: '.filesize($file));
//header('Content: '.$data1);
header('Content-Disposition: attachment; filename='.$file);
header("Content-Type: application/force-download");
write_file(FCPATH .$file,$data1);
readfile($file);			
	  unlink( $file_directory . $new_file_name);
	}
	
	
	public function import_employee_file(){
		
		$file_info = pathinfo($_FILES["file"]["name"]);
		$file_directory = "uploads/";
		$new_file_name = $_FILES["file"]["name"];
		
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
		{   
			$file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
			$objReader	= PHPExcel_IOFactory::createReader($file_type);
			$objPHPExcel = $objReader->load($file_directory . $new_file_name);
			$sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			ini_set('precision', 20);
			
		$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	//	$highestRow = $sheet_data['totalRows'];
//echo count($sheet_data);
					$objReader->setReadDataOnly(false);
//echo $highestRow;
			$data2 = "";
		
		$column = 'A';
		$row = 2;
		$date = "";
		for ($row = 2; $row <= $highestRow; $row++) {
		$result = array();
			
			for ($column = 'A'; $column !='T'; $column++) {
				if(($column=='G')||($column=='H')){
				if($column=='G'){ $column_id = 6;  }	
				if($column=='H'){ $column_id = 7;  }

				$cell1 = $objPHPExcel->setActiveSheetIndex(0)->getCell($column.$row);					


				if((trim($cell1)!="")&&($cell1!="NOT AVAILABLE"))
				{
					$cell = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->setActiveSheetIndex(0)->getCellByColumnAndRow($column_id,$row)->getValue()));             
				}
				else{
					$cell = "";
				}
				
									
								
	}
				else{
				$cell = $objPHPExcel->setActiveSheetIndex(0)->getCell($column.$row);					
				}
				array_push($result,$cell);
			}
	    $data11 =$this->Employeeimportmodel->employee_import_file($result);
		$data2 .= "----".$data11;	
 			}
		  unlink( $file_directory . $new_file_name);
  echo json_encode($data2);	
//	echo $data2;		
		}
		}
	
	
	
		//export database
	function export_db1()
	{
		
		
		$dbName= $this->db->database;
		$this->load->dbutil();

		$prefs = array(     
			'format'      => 'txt',             
			'filename'    => $dbName.'.sql'
			);


		$backup =& $this->dbutil->backup($prefs); 

		$db_name = $dbName.'_backup-on-'. date("Y-m-d-H-i-s") .'.sql';
		$save = 'ally/ci/backup_database/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 


		$this->load->helper('download');
		force_download($db_name, $backup);
			
	}
	
	
		//import database
		function import_db1()
	{
		
//		set_time_limit(0);
		
		$name=base_url().'uploads/';
//			$name = pathinfo($_FILES["file"]["name"]);

		 $file_directory = "uploads/";
        $new_file_name = $_FILES["file"]["name"];
      
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
        {  
				$query='';
			$isi_file = file_get_contents($name.'/'.$new_file_name);
			  $string_query = rtrim( $isi_file, "\n;" );
			  $array_query = explode(";", $string_query);
			  foreach($array_query as $query)
			  {
				$this->db->query($query);
			  }
			  unlink( $file_directory . $new_file_name);
			 echo "Database Imported Successfully";
		  
		}

	}

	
	
	function export_db()
	{
		
		
		$dbName= $this->db->database;
		$this->load->dbutil();

		$prefs = array(     
			'format'      => 'text',             
			'filename'    => 'payroll.sql'
			);


		$backup =& $this->dbutil->backup($prefs); 

		$db_name = $dbName.'_backup-on-'. date("Y-m-d-H-i-s") .'.txt';
//		$save = 'ally/ci/backup_database/'.$db_name;

//		$this->load->helper('file');
//		write_file($save, $backup); 


		$this->load->helper('download');
//		force_download($db_name, $backup);
		force_download($db_name, $backup);
			
	}
	
	function import_db()
	{
		$name=base_url().'uploads/';
		 $file_directory = "uploads/";
        $new_file_name = $_FILES["file"]["name"];
	  $file_name = "payroll.txt";
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
        {  
					
/*			 $zip = new ZipArchive;
 
            if ($zip->open($file_directory . $new_file_name) === TRUE) 
            {
                $zip->extractTo(FCPATH.'/uploads/');
                $zip->close();
            }		
	*/				
				$query='';
     			$isi_file = file_get_contents($name.'/'.$new_file_name);
			  $string_query = rtrim( $isi_file, "\n;" );
			  $array_query = explode(";", $string_query);
			  foreach($array_query as $query)
			  {
				$this->db->query($query);
			  }
			  unlink( $file_directory . $new_file_name);
			 // unlink( $file_directory . $file_name);
			 echo "Database Imported Successfully";
		}
	}

	public function import_gratuity_file(){
	
		$file_info = pathinfo($_FILES["file"]["name"]);
		$file_directory = "uploads/";
		$new_file_name = $_FILES["file"]["name"];
		
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
		{   
			$file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
			$objReader	= PHPExcel_IOFactory::createReader($file_type);
			$objPHPExcel = $objReader->load($file_directory . $new_file_name);
			$sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
		$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
					$objReader->setReadDataOnly(false);

			$data2 = "";
		
		$column = 'A';
		$row = 2;
		$date = "";
		for ($row = 2; $row <= $highestRow; $row++) {
		$result = array();
			
			for ($column = 'A'; $column !='E'; $column++) {
				$cell = $objPHPExcel->setActiveSheetIndex(0)->getCell($column.$row);					
				array_push($result,$cell);
			}
	    $data11 =$this->Employeeimportmodel->gratuity_import_file($result);
		$data2 .= "----".$data11;	
 			}
		  unlink( $file_directory . $new_file_name);
  echo json_encode($data2);	
			
		}
		}
	
		public function excel_download(){
	
$file_directory = "assets/download/";
$new_file_name = base_url()."assets/download/ActiveMember_NEW.xlsx";
																	
		$this->load->helper('download');

$pth    =   file_get_contents($new_file_name);

$nme    =   "ActiveMember_NEW.xlsx";
force_download($nme, $pth);     


	
	
		
		
		}
	
	
}	
?>