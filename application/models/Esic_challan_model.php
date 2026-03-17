<?php
class Esic_challan_model extends CI_Model {
    
    private function get_company_id() {
        $cid = '';
        if (isset($this->session) && method_exists($this->session, 'userdata')) {
            $cid = $this->session->userdata('company_id');
        }
        if (!$cid && isset($_SESSION['company_id'])) {
            $cid = $_SESSION['company_id'];
        }
        if (!$cid) {
            // Fallback for safety during testing or if session is weird
            $cid = 'WBDGP0034083000'; 
        }
        return $cid;
    }

    public function save_esic_challan() {
        $data = array(
            'wage_month'     => $this->input->post('wage_month'),
            'employee_share' => $this->input->post('employee_share'),
            'employer_share' => $this->input->post('employer_share'),
            'challan_no'     => $this->input->post('challan_no'),
            'challan_date'   => $this->input->post('challan_date'),
            'total_amount'   => $this->input->post('total_amount'),
            'company_id'     => $this->get_company_id()
        );
        return $this->db->insert('esic_challan_entry', $data);
    }
    
    public function update_esic_challan() {
        $id = $this->input->post('id');
        $data = array(
            'wage_month'     => $this->input->post('wage_month'),
            'employee_share' => $this->input->post('employee_share'),
            'employer_share' => $this->input->post('employer_share'),
            'challan_no'     => $this->input->post('challan_no'),
            'challan_date'   => $this->input->post('challan_date'),
            'total_amount'   => $this->input->post('total_amount')
        );
        $this->db->where('esic_challan_id', $id);
        return $this->db->update('esic_challan_entry', $data);
    }
    
    public function show_esic_challan() {
        $this->db->where('company_id', $this->get_company_id());
        $this->db->order_by('wage_month', 'DESC');
        return $this->db->get('esic_challan_entry')->result();
    }
    
    public function delete_esic_challan() {
        $id = $this->input->post('id');
        if($id) {
            $this->db->where('esic_challan_id', $id);
            return $this->db->delete('esic_challan_entry');
        }
        return false;
    }

    public function upsert_esic_challan() {
        $wage_month = $this->input->post('wage_month');
        $company_id = $this->get_company_id();
        
        $data = array(
            'wage_month'     => $wage_month,
            'employee_share' => $this->input->post('employee_share'),
            'employer_share' => $this->input->post('employer_share'),
            'challan_no'     => $this->input->post('challan_no'),
            'challan_date'   => $this->input->post('challan_date'),
            'total_amount'   => (float)$this->input->post('employee_share') + (float)$this->input->post('employer_share'),
            'company_id'     => $company_id
        );

        $this->db->where('wage_month', $wage_month);
        $this->db->where('company_id', $company_id);
        $check = $this->db->get('esic_challan_entry')->row();

        if ($check) {
            $this->db->where('esic_challan_id', $check->esic_challan_id);
            return $this->db->update('esic_challan_entry', $data);
        } else {
            return $this->db->insert('esic_challan_entry', $data);
        }
    }

    public function get_yearly_data($year) {
        $this->db->where('company_id', $this->get_company_id());
        return $this->db->get('esic_challan_entry')->result();
    }

    public function get_calculated_shares($month_year) {
        $company_id = $this->get_company_id();
        
        // 1. Get ESIC rates from challan_setup
        $parts = explode('/', $month_year);
        if (count($parts) < 2) {
            return array('employee_share' => 0, 'employer_share' => 0, 'total_amount' => 0);
        }
        $search_date = $parts[1] . '-' . $parts[0] . '-15';
        
        $this->db->where("'$search_date' BETWEEN from_date AND to_date");
        $setup = $this->db->get('challan_setup')->row();
        
        $ee_rate = $setup ? $setup->employee_share : 0.75;
        $er_rate = $setup ? $setup->employer_share : 3.25;

        // 2. Calculate EE Share per employee across all three entry tables
        // Threshold: If (Gross Wages / Days) <= 176, EE Share = 0.
        // Otherwise: EE Share = CEIL(Gross Wages * 0.75%)
        
        $total_ee_share = 0;
        $total_gross_wages = 0;

        $tables = [
            'office_staff_entry' => ['gross' => 'gross_wages', 'days' => 'no_of_days_worked'],
            'packers_entry'      => ['gross' => 'gross_wages', 'days' => 'no_of_worked_days'],
            'bidi_roller_entry'  => ['gross' => 'gross_wages', 'days' => 'no_of_days']
        ];
        
        foreach ($tables as $table => $cols) {
            $gross_col = $cols['gross'];
            $days_col = $cols['days'];

            $this->db->select("SUM(
                CASE 
                    WHEN ($days_col > 0 AND ($gross_col / $days_col) > 176) THEN CEIL($gross_col * ($ee_rate / 100))
                    ELSE 0 
                END
            ) as total_ee, SUM($gross_col) as total_gross");
            $this->db->from($table);
            $this->db->join('employee_master em', "em.emp_id = $table.employee_id");
            $this->db->where("$table.month_year", $month_year);
            $this->db->where("TRIM(SUBSTR(em.member_id_org, 1, 15)) =", trim($company_id));
            $res = $this->db->get()->row();
            
            if ($res) {
                $total_ee_share += (float)$res->total_ee;
                $total_gross_wages += (float)$res->total_gross;
            }
        }
        
        // 3. Calculate Employer Share based on total monthly gross wages (standard rule)
        $er_share = round(($total_gross_wages * $er_rate) / 100);
        
        return array(
            'employee_share' => $total_ee_share,
            'employer_share' => $er_share,
            'total_amount'   => $total_ee_share + $er_share
        );
    }
}
