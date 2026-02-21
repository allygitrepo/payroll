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
require_once APPPATH . "/third_party/fpdf/easyTable.php";
class Easytablefpdf extends EasyTable {
    public function __construct() {
        parent::__construct();
    }
}
?>