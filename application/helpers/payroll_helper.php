<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('calculate_esic')) {
    /**
     * Centralized ESIC calculation logic
     * 
     * @param float $total_salary   The total salary amount
     * @param int|float $divisor    The divisor (typically worked days + paid leaves)
     * @param float $threshold      The daily wage threshold (from challan_setup)
     * @param float $rate_percent   The ESIC rate as a percentage (e.g. 0.75 from challan_setup)
     * @return int                  The calculated ESIC amount (ceiled)
     */
    function calculate_esic($total_salary, $divisor, $threshold, $rate_percent) {
        if ($divisor <= 0) return 0;
        
        $daily_wage = $total_salary / $divisor;
        
        if ($daily_wage > $threshold) {
            return (int) ceil($total_salary * ($rate_percent / 100));
        }
        
        return 0;
    }
}
