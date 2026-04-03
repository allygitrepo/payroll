<?php
// Made By Prashant Sarvaiya

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LatestExcelPHPIntegration
{

    /**
     * Main function to read Excel and return structured data
     * 
     * @param string $filePath
     * @return array
     */
    public function readExcel($filePath)
    {
        log_message('error', '[EXCEL] → Read Excel → Starting extraction for file: ' . $filePath);
        try {
            $spreadsheet = $this->loadExcelFile($filePath);
            $data = $this->getSheetData($spreadsheet);
            log_message('error', '[EXCEL] → Read Excel → Successfully extracted ' . count($data) . ' rows');
            return $data;
        } catch (Exception $e) {
            log_message('error', '[EXCEL] → Read Excel → Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Detect file type and load using PhpSpreadsheet
     * 
     * @param string $filePath
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public function loadExcelFile($filePath)
    {
        log_message('error', '[EXCEL] → Load File → Identifying file type: ' . $filePath);
        $inputFileType = IOFactory::identify($filePath);
        log_message('error', '[EXCEL] → Load File → Detected type: ' . $inputFileType);

        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        log_message('error', '[EXCEL] → Load File → Loading spreadsheet into memory');
        return $reader->load($filePath);
    }

    /**
     * Loop through rows and return clean array
     * 
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public function getSheetData($spreadsheet)
    {
        log_message('error', '[EXCEL] → Get Sheet Data → Processing active worksheet');
        $worksheet = $spreadsheet->getActiveSheet();

        // toArray(null, true, true, false) returns numeric keys, matching expected input for controllers
        $data = $worksheet->toArray(null, true, true, false);

        log_message('error', '[EXCEL] → Get Sheet Data → Total rows extracted: ' . count($data));
        return $data;
    }

    /**
     * Trim, handle null, and convert to string
     * 
     * @param \PhpOffice\PhpSpreadsheet\Cell\Cell $cell
     * @return string
     */
    public function formatCellValue($cell)
    {
        if ($cell === null) {
            return "";
        }

        $value = $cell->getValue();

        // Handle calculated values
        if ($cell->isFormula()) {
            $value = $cell->getOldCalculatedValue();
        }

        // Handle dates specifically if they are formatted as such in Excel
        if (Date::isDateTime($cell)) {
            return $this->convertExcelDate($value);
        }

        return trim((string) $value);
    }

    /**
     * Convert Excel data to PHP date (Y-m-d)
     * Matches legacy PHPExcel behavior
     * 
     * @param mixed $value
     * @return string
     */
    public function convertExcelDate($value)
    {
        if (empty($value)) {
            return "";
        }

        try {
            log_message('error', '[EXCEL] → Date Conversion → Converting serial: ' . $value);
            // ExcelToPHP returns a Unix timestamp
            $timestamp = Date::excelToTimestamp($value);
            $formattedDate = date('Y-m-d', $timestamp);
            log_message('error', '[EXCEL] → Date Conversion → Formatted Result: ' . $formattedDate);
            return $formattedDate;
        } catch (Exception $e) {
            log_message('error', '[EXCEL] → Date Conversion → Failed to convert date: ' . $e->getMessage());
            return (string) $value;
        }
    }
}
