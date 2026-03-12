<?php
	
class Esicchallanyearly extends CI_Controller{
	
    function __construct(){
        parent::__construct();
    }
	
	function show_esicchallanyearly(){
        $year = $this->input->post('month_year');
        
        // Dummy data for months April -> March
        $months = [
            'April', 'May', 'June', 'July', 'August', 'September', 
            'October', 'November', 'December', 'January', 'February', 'March'
        ];
        
        $data = [];
        foreach ($months as $month) {
            // Using #### as separator like PF Challan Yearly does
            // Format: Month #### Employee Share #### Employer Share #### Challan Number #### Actual Date of Payment
            $data[] = $month . "####0####0########";
        }
        
        echo json_encode($data);	
	}
}	
?>
