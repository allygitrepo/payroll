<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Team Tech Arise 
 *  License    : Protected 
 *  Email      : info@techarise.com 
 * 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/fpdf/fpdf.php";
require_once APPPATH . "/third_party/fpdf/exfpdf.php";
require_once APPPATH . "/third_party/fpdf/easyTable.php";

class Pdf extends Fpdf {
    public function __construct() {
        parent::__construct();
//		$pdf=new exFPDF();
//		$pdf->AddPage(); 
		
	//	$CI =& get_instance();
	//	$CI->fpdf = $pdf;
    }

}
?>