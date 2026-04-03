<?php
	
class Employeeimport extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        // error_reporting(0);
		$this->load->library('excel');
		$this->load->helper('form');
		$this->load->helper("file");	
		$this->load->library("upload");
		$this->load->library('zip');
		

       $this->load->model('Employeeimportmodel');
	set_time_limit(0);

    }
	
	
	
	
    public function convert_excel_to_text() {
        $file_info = pathinfo($_FILES["file"]["name"]);
        $file_directory = "uploads/";
        $new_file_name = $_FILES["file"]["name"];
        $result = array();

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name)) {
            if (!class_exists('ZipArchive')) {
                echo "Error: PHP ZipArchive extension is not enabled on this server. Please enable it to process Excel files.";
                return;
            }

            // --- Modern Excel Integration ---
            $useNewExcelLogic = true;
            $data1 = "";

            if ($useNewExcelLogic) {
                log_message('error', '[IMPORT] → Logic Switch → Using New Excel Logic (PhpSpreadsheet)');
                $this->load->library('latestExcelPHPIntegration');
                $excelPath = $file_directory . $new_file_name;
                log_message('error', '[IMPORT] → Processing Started → Extracting data from ' . $new_file_name);
                $sheetData = $this->latestexcelphpintegration->readExcel($excelPath);

                if (!empty($sheetData)) {
                    log_message('error', '[IMPORT] → Data Parsed → Total rows found: ' . count($sheetData));
                    // Skip first row if it was header? 
                    // Skip first row if it was header? 
                    // Legacy code starts from $row = 2, so it skips the first row (index 0).
                    $rowCount = count($sheetData);
                    for ($i = 1; $i < $rowCount; $i++) {
                        $row = $sheetData[$i];
                        $data1 .= implode("#~#", $row);
                        if ($i < $rowCount - 1) {
                            $data1 .= "\n";
                        }
                    }
                }
            } else {
                // --- Old PHPExcel Logic ---
                $file_type = PHPExcel_IOFactory::identify($file_directory . $new_file_name);
                $objReader = PHPExcel_IOFactory::createReader($file_type);
                $objPHPExcel = $objReader->load($file_directory . $new_file_name);
                $sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                ini_set('precision', 20);

                $highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                $data1 = "";

                $column = 'A';
                $row = 3;
                $count = $highestColumm;
                $count++;
                for ($row = 2; $row <= $highestRow; $row++) {
                    for ($column = 'A'; $column != $count; $column++) {
                        $cell = $objPHPExcel->setActiveSheetIndex(0)->getCell($column . $row);
                        if ($column == ($highestColumm)) {
                            $data1 .= $cell;
                        } else {
                            $data1 .= $cell . "#~#";
                        }
                    }
                    if ($row <= $highestRow - 1) {
                        $data1 .= "\n";
                    }
                }
            }

            $text_file_name = explode(".", $new_file_name);
            $text_file_name1 = $text_file_name[0];

            $todate = date('d-m-Y');
            $file = $text_file_name1 . '.txt';
            header('Content-type: text/plain');
            header('Content-Disposition: attachment; filename=' . $file);
            header("Content-Type: application/force-download");
            write_file(FCPATH . $file, $data1);
            readfile($file);
            unlink($file_directory . $new_file_name);
        }
    }
	
	
	public function import_employee_file(){
		header('Content-Type: application/json');
		try {
			if (!class_exists('ZipArchive')) {
				echo json_encode(array(
					"status" => false,
					"type" => "zip_error",
					"message" => "ZipArchive extension is not enabled on server"
				));
				return;
			}

			if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != 0) {
				echo json_encode(array(
					'status' => false,
					'type' => 'upload_error',
					'message' => 'No file uploaded or upload error'
				));
				return;
			}

			$file_info = pathinfo($_FILES["file"]["name"]);
			$file_directory = "uploads/";
			$new_file_name = $_FILES["file"]["name"];
			
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_directory . $new_file_name))
			{   
				$file_path = $file_directory . $new_file_name;
				log_message('error', '[IMPORT] → File Upload → Received file: ' . $new_file_name);

				$useNewExcelLogic = true;
				$data2 = "";

				if ($useNewExcelLogic) {
					log_message('error', '[IMPORT] → Logic Switch → Using New Excel Logic (PhpSpreadsheet)');
					$this->load->library('latestExcelPHPIntegration');
					log_message('error', '[IMPORT] → Processing Started → Extracting employee data');
					$sheetData = $this->latestexcelphpintegration->readExcel($file_path);

					if (!empty($sheetData)) {
						$totalRows = count($sheetData);
						log_message('error', '[IMPORT] → Data Parsed → Total rows: ' . $totalRows);
						// Skip header (index 0), legacy code starts from $row = 2
						for ($i = 1; $i < $totalRows; $i++) {
							// Ping DB every 10 rows to keep connection alive
							if ($i % 10 == 0) {
								$this->db->reconnect();
							}
							
							$row = $sheetData[$i];
							$result = array_slice($row, 0, 20);
							
							log_message('error', '[DB] → Operation → Importing row ' . ($i + 1));
							$data11 = $this->Employeeimportmodel->employee_import_file($result);
							$data2 .= "----".$data11;
						}
						log_message('error', '[IMPORT] → Completed → Employee import finished');
					}
				} else {
					// --- Old PHPExcel Logic ---
					$file_type	= PHPExcel_IOFactory::identify($file_path);
					$objReader	= PHPExcel_IOFactory::createReader($file_type);
					$objPHPExcel = $objReader->load($file_path);
					
					$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
					$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
					$objReader->setReadDataOnly(false);

					$column = 'A';
					
					for ($row = 2; $row <= $highestRow; $row++) {
						$result = array();
						for ($column = 'A'; $column !='U'; $column++) {
							if(($column=='H')||($column=='I')){
								$column_id = ($column=='H') ? 7 : 8;
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
				}
				unlink($file_path);
				echo json_encode(array(
					'status' => true,
					'message' => 'Import completed',
					'details' => $data2
				));
			} else {
				echo json_encode(array(
					'status' => false,
					'type' => 'upload_error',
					'message' => 'Failed to move uploaded file'
				));
			}
		} catch (Throwable $e) {
			echo json_encode(array(
				"status" => false,
				"type" => "exception",
				"message" => $e->getMessage(),
				"file" => $e->getFile(),
				"line" => $e->getLine()
			));
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


		$backup = $this->dbutil->backup($prefs,true); 

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
			if (!class_exists('ZipArchive')) {
				echo json_encode(array('status' => 'error', 'message' => 'PHP ZipArchive extension is not enabled on this server. Please enable it to import Excel files.'));
				return;
			}

			// --- Modern Excel Integration ---
			$useNewExcelLogic = true;
			$data1 = array();
			$file_path = $file_directory . $new_file_name;
			log_message('error', '[IMPORT] → File Upload → Received gratuity file: ' . $new_file_name);

			if ($useNewExcelLogic) {
				log_message('error', '[IMPORT] → Logic Switch → Using New Excel Logic (PhpSpreadsheet)');
				$this->load->library('latestExcelPHPIntegration');
				log_message('error', '[IMPORT] → Processing Started → Extracting gratuity data');
				$sheetData = $this->latestexcelphpintegration->readExcel($file_path);

				if (!empty($sheetData)) {
					$totalRows = count($sheetData);
					log_message('error', '[IMPORT] → Data Parsed → Total records: ' . $totalRows);
					// Legacy code starts from $row = 2 (index 1)
					for ($i = 1; $i < $totalRows; $i++) {
						$row = $sheetData[$i];
						// Legacy code: for ($column = 'A'; $column !='E'; $column++)
						// A to D (4 columns)
						$result = array_slice($row, 0, 4);
						
						log_message('error', '[DB] → Operation → Importing gratuity row ' . ($i + 1));
						$data11 = $this->Employeeimportmodel->gratuity_import_file($result);
						$data2 .= "----".$data11;
					}
					log_message('error', '[IMPORT] → Completed → Gratuity import finished');
				}
			} else {
				// --- Old PHPExcel Logic ---
				$file_type	= PHPExcel_IOFactory::identify($file_path);
				$objReader	= PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_path);
				$sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				
				$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
				$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				$objReader->setReadDataOnly(false);

				$column = 'A';
				$row = 2;
				for ($row = 2; $row <= $highestRow; $row++) {
					$result = array();
					for ($column = 'A'; $column !='E'; $column++) {
						$cell = $objPHPExcel->setActiveSheetIndex(0)->getCell($column.$row);					
						array_push($result,$cell);
					}
					$data11 =$this->Employeeimportmodel->gratuity_import_file($result);
					$data2 .= "----".$data11;	
				}
			}
			unlink($file_path);
			echo json_encode($data2);	
		}
	}
	
		public function excel_download(){
	
$file_directory = "assets/download/";
$new_file_name = FCPATH . "assets/download/ActiveMember_NEW.xlsx";
																	
		$this->load->helper('download');

$pth    =   file_get_contents($new_file_name);

$nme    =   "ActiveMember_NEW.xlsx";
force_download($nme, $pth);     


	
	
		
		
		}
	
	
}	
?>
