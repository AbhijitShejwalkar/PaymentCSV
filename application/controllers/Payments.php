<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
   * Command line utility to get payment date reminder information in form of CSV format.
   * @Developer  Name: Abhijit Shejwalkar
*/

class Payments extends CI_Controller {

    protected $message;
    protected $arr_record = [];
    
    function __construct()
	{
		parent::__construct();
        $this->load->helper( ['validation_helper','dateinfo_helper' ] );
        
	}

    /**
     * Get payment information by passing the year
     * @param : string $year 2020
     * @return : get csv file with payment date information. 
     */

    public function information( $year = '' ) {
          // validate the year input.  
          if( empty( $year ) || !isValidYear( $year ) )  {

              $this->message =  "Please enter valid year to get payment related csv file";

          } //if 

          $this->arr_record [] =   [ "Month", "Payment Date",  "Bonus Date" ];

          for( $intMonth = 01; $intMonth <= 12; $intMonth++ ) { 

                $startMonthDate = $year.'-'.$intMonth.'-01';
                $middleOfMonth =  $year.'-'.$intMonth.'-15';

                $payment_date = getPaymentDate( $startMonthDate );  // get payment date

                $bonus_date = getBonusDate( $middleOfMonth );  // get bonus date 

                $monthName = DateTime::createFromFormat('m', $intMonth)->format('F');

                $this->arr_record [] =   [ $monthName, $payment_date,  $bonus_date ];

          } //end for

         if( true == $this->exportToCsv( $this->arr_record, $year ) ) {

            $this->message = "CSV file get created successfully";

         } else 
         {
            $this->message = "Error While creating the CSV file";
         }

         echo $this->message;

    } // end information

    /**
     * Create CSV report for payment date information
     * @param : array $row  
     * @param : string $year
     * @return : true created csv file. 
     */
    function exportToCsv( $row, $year ) {
           
        $file_name = time().'_Report_for_year_'.$year.'.csv';

        // Open a file in write mode ('w')
        $fp = fopen($file_name, 'w');
          
        // Loop through file pointer and a line
        foreach ($row as $fields) {
            fputcsv($fp, $fields);
        }
          
        fclose($fp);
        return true;
       
    } //end exportToCsv

    
} //end class 
