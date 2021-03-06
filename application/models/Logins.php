<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logins
 *
 * @author DRX
 */
class Logins extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all the logins
     * @return type
     */
    function getAllLogins() {
        return $this->db->count_all('logins');
    }

    /**
     * Get the admin panel login chart details
     * @return type
     */
    function getLoginChartDetails() {
        // Get most recent 7 days
        $time = time();
        $formattedDate = date("Y-m-d", $time);

        $date = new DateTime($formattedDate);
        $date->sub(new DateInterval('P7D'));
        $aWeekBack = $date->format('Y-m-d');

        $query = $this->db->query("SELECT loginDate, count(name) AS value FROM logins WHERE loginDate BETWEEN '" . $aWeekBack . "'" .
                " AND '" . $formattedDate . "' GROUP BY loginDate");

        return $query->result();
    }

}

?>
