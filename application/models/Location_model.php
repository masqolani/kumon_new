<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {

	public function add_location($data) {

		$this->db->insert('location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function check_duplicated($data)
	{
		$location_id = $data['location_id'];
		$location_name = $data['location_name'];

		$query = "SELECT * FROM location WHERE location_id <> '$location_id' AND";

		if(!empty($location_name)) {
			$query .= " location_name = '$location_name'";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

		if($query)
			return TRUE;
		else
			return FALSE;
	}

	public function get_location($location_id = '') {
  	$query = 'SELECT * FROM location';

		if(!empty($location_id)) {
			$query .= ' WHERE location_id = '.$location_id;
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function update_location($post)
  {
  	$data['location_name'] = $post['location_name'];

		$this->db->where('location_id', $post['location_id']);
		$query = $this->db->update('location', $data);

		if($query)
			return TRUE;
		else
			return FALSE;
  }

	public function delete_location($id)
  {
    $this->db->where('location_id', $id);
		$delete_location = $this->db->delete('location');

		if($delete_location)
			return TRUE;
		else
			return FALSE;
  }

}
