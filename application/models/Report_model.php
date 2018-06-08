<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function get_report() {
  	$query = 'SELECT e.event_name, l.location_name, SUM(IF(attend_status = 1, 1, 0)) attended_total,
							SUM(IF(attend_status = 0, 1, 0)) not_attended_total,
							COUNT(m.member_id) AS member_total,
							((SUM(IF(attend_status = 1, 1, 0)) * 100) / COUNT(m.member_id)) AS percentage
							FROM member As m
							LEFT JOIN event AS e ON e.event_id = m.event_id
							LEFT JOIN location AS l ON e.location_id = l.location_id
							GROUP BY m.event_id';

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

}
