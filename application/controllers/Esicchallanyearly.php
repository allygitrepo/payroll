<?php
	
class Esicchallanyearly extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        $this->load->model('Esic_challan_model');
    }

    public function index() {
        $this->load->view('esicchallanyearly');
    }

    public function save_inline() {
        $data = $this->Esic_challan_model->upsert_esic_challan();
        echo json_encode($data);
    }
	
	function show_esicchallanyearly(){
        $year = $this->input->post('month_year');
        if(!$year) $year = date('Y');
        
        $entries = $this->Esic_challan_model->get_yearly_data($year);
        
        // Map entries by wage_month for easy lookup
        $mapping = [];
        foreach($entries as $entry) {
            $mapping[$entry->wage_month] = $entry;
        }

        // Financial Year: April (Year) to March (Year + 1)
        $months = [
            ['name' => 'April', 'month' => '04', 'year' => $year],
            ['name' => 'May', 'month' => '05', 'year' => $year],
            ['name' => 'June', 'month' => '06', 'year' => $year],
            ['name' => 'July', 'month' => '07', 'year' => $year],
            ['name' => 'August', 'month' => '08', 'year' => $year],
            ['name' => 'September', 'month' => '09', 'year' => $year],
            ['name' => 'October', 'month' => '10', 'year' => $year],
            ['name' => 'November', 'month' => '11', 'year' => $year],
            ['name' => 'December', 'month' => '12', 'year' => $year],
            ['name' => 'January', 'month' => '01', 'year' => $year + 1],
            ['name' => 'February', 'month' => '02', 'year' => $year + 1],
            ['name' => 'March', 'month' => '03', 'year' => $year + 1],
        ];
        
        $data = [];
        log_message('debug', "ESIC Yearly - Building report for $year. Found " . count($mapping) . " manual entries.");
        
        foreach ($months as $m) {
            $key = $m['month'] . "/" . $m['year'];
            $month_display = $m['name'] . "-" . substr($m['year'], -2);
            
            if (isset($mapping[$key])) {
                $e = $mapping[$key];
                log_message('debug', "ESIC Yearly - Using manual entry for $key: EE=$e->employee_share, ER=$e->employer_share");
                $data[] = $month_display . "####" . $e->employee_share . "####" . $e->employer_share . "####" . $e->challan_no . "####" . $e->challan_date . "####" . $key;
            } else {
                // Fallback: Calculate from wages
                $calc = $this->Esic_challan_model->get_calculated_shares($key);
                log_message('debug', "ESIC Yearly - No manual entry for $key. Fallback calculation: EE=" . $calc['employee_share'] . ", ER=" . $calc['employer_share']);
                
                // If calculated shares are > 0, show them as fallback
                if ($calc['employee_share'] > 0 || $calc['employer_share'] > 0) {
                     $data[] = $month_display . "####" . $calc['employee_share'] . "####" . $calc['employer_share'] . "####" . "" . "####" . "" . "####" . $key;
                } else {
                     $data[] = $month_display . "####0####0####" . "" . "####" . "" . "####" . $key;
                }
            }
        }
        
        echo json_encode($data);	
	}
}	
?>
