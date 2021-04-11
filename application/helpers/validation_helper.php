<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('isValidYear'))
{
    function isValidYear( $year ) {

        // Convert to timestamp
        $start_year         =   strtotime(date('Y') - 100); //100 Years back
        $end_year           =   strtotime(date('Y')); // Current Year
        $received_year      =   strtotime($year);

        // Check that user date is between start & end
        return (($received_year >= $start_year) && ($received_year <= $end_year));

    }
}