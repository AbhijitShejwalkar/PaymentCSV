<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getPaymentDate'))
{

    
    /**
     * Get payment date. check the condition like 
     * Paid on the last day of the month unless that day is a Saturday or a Sunday (weekend).
     * @param : date $strDate 2020-01-01
     * @return : get payment date. 
     */

    function getPaymentDate( $strDate ) {

        $lastdateofthemonth  = date("Y-m-t", strtotime($strDate)); 

        $lastworkingday = date('l', strtotime($lastdateofthemonth));

        if($lastworkingday == "Saturday") { 
        $newdate = strtotime ('-1 day', strtotime($lastdateofthemonth));
        $lastdateofthemonth = date ('Y-m-j', $newdate);
        }
        elseif($lastworkingday == "Sunday") { 
         $newdate = strtotime ('-2 day', strtotime($lastdateofthemonth));
         $lastdateofthemonth = date ( 'Y-m-j' , $newdate );
        } 

        return $lastdateofthemonth;
 
    }

}

if ( ! function_exists('getBonusDate'))
{   
    /**
     * Get bonus date. check the condition like 
     * On the 15th of every month bonuses are paid for the previous month,
     * unless that day is a weekend. In that case, they are paid the first Wednesday after the 15th.
     * @param : date $strDate 2020-01-15
     * @return : get bonus date. 
     */

    function getBonusDate( $strDate ) {

        if( date('l', strtotime($strDate)) == 'Sunday' || date('l', strtotime($strDate)) == 'Saturday')  {

            // Create a new DateTime object
            $date = new DateTime($strDate);
        
            // Modify the date it contains
            $date->modify('next wednesday');
        
            // Output
            return $date->format('Y-m-d');
        
        } else {
            return $strDate;
        }
 
    }

}



