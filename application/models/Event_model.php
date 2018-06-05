<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

	public function add_event($data) {

		$this->db->insert('event', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function check_duplicated($data)
	{
		$event_id = $data['event_id'];
		$event_name = $data['event_name'];
		$location_id = $data['location_id'];
		$start_date = $data['start_date'];
		$end_date = $data['end_date'];

		$query = "SELECT * FROM event AS ev WHERE event_id <> '$event_id'
							AND event_name = '$event_name' AND location_id = '$location_id'
							AND start_date = '$start_date' AND end_date = '$end_date'";

    $query = $this->db->query($query);
  	$query = $query->result_array();

		if($query)
			return TRUE;
		else
			return FALSE;
	}

	public function get_event($event_id = '', $status = '') {

		$update_status_to_inactive = "UPDATE event SET event_status = 0 WHERE end_date < now()";
		$this->db->query($update_status_to_inactive);

		$query = "SELECT ev.event_id, ev.event_name, ev.start_date, ev.end_date,
											loc.location_id, loc.location_name, ev.event_status
							FROM event as ev
							LEFT JOIN location as loc ON ev.location_id = loc.location_id
							WHERE 1=1 ";

		if(!empty($event_id)) {
			$query .= ' AND event_id = '.$event_id;
		}

		if(!empty($status)) {
			$query .= ' AND event_status = '.$status;
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function update_event($post)
  {
  	$data['event_name'] = $post['event_name'];
		$data['event_id'] = $post['event_id'];
		$data['location_id'] = $post['location_id'];
		$data['start_date'] = $post['start_date'];
		$data['end_date'] = $post['end_date'];

		$this->db->where('event_id', $post['event_id']);
		$query = $this->db->update('event', $data);

		$update_status_to_active = "UPDATE event SET event_status = 1 WHERE end_date > now()";
		$this->db->query($update_status_to_active);

		if($query)
			return TRUE;
		else
			return FALSE;
  }

	public function delete_event($id)
  {
    $this->db->where('event_id', $id);
		$delete_event = $this->db->delete('event');

		if($delete_event)
			return TRUE;
		else
			return FALSE;
  }

	public function get_location() {
  	$query = 'SELECT *
			  			 FROM location';

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	return $query;
  }

}
