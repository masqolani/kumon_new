<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Member_model extends CI_Model {

	public function add_member($data) {
		unset($data['member_id']);
		$this->db->insert('member', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function check_duplicated($data)
	{
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$registration_number = $data['registration_number'];

		$query = "SELECT * FROM member WHERE member_id <> '$member_id' ";

		if(!empty($member_name)) {
			$query .= " AND member_name = '$member_name'";
		}
		if(!empty($registration_number)) {
			$query .= " AND registration_number = '$registration_number'";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

		if($query)
			return TRUE;
		else
			return FALSE;
	}

	public function get_member($member_id = '', $event_id = '', $type_id = '', $attendance_status = '') {
  	$query = 'SELECT
		m.member_id, m.member_name, m.registration_number, m.event_id, m.type_id,
		c.grade_name, t.type_name, e.event_name, l.location_name, m.seat,
		m.attend_status, m.grade_id, m.get_award, m.member_session, m.gate_in, m.trophy_table,
		m.meeting_point, m.gate_in, m.get_award, m.center, m.instructor, m.plakat,
		m.rank, m.among_of, m.math, m.ee, m.efl, m.math, m.cm, m.ce, m.cf, m.trophy_at_class,
		m.ashr_level, m.student_id, m.meeting_point
		FROM member AS m
		LEFT JOIN grade AS c ON m.grade_id = c.grade_id
		LEFT JOIN type AS t ON m.type_id = t.type_id
		LEFT JOIN event AS e ON m.event_id = e.event_id
		LEFT JOIN location AS l ON e.location_id = l.location_id
		WHERE 1=1 ';

		if(!empty($member_id)) {
			$query .= ' AND member_id = '.$member_id;
		}

		if(!empty($event_id)) {
			$query .= ' AND m.event_id = '.$event_id;
		}

		if(!empty($type_id)) {
			$query .= ' AND m.type_id = '.$type_id;
		}

		if(!empty($attendance_status)) {
			$query .= ' AND m.attend_status = '.$attendance_status;
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function update_member($post)
  {
		$this->db->where('member_id', $post['member_id']);
		$query = $this->db->update('member', $post);

		if($query)
			return TRUE;
		else
			return FALSE;
  }

	public function delete_member($id)
  {
    $this->db->where('member_id', $id);
		$delete_member = $this->db->delete('member');

		if($delete_member)
			return TRUE;
		else
			return FALSE;
  }

	// public function get_grade($grade_name = '') {
  // 	$query = 'SELECT * FROM grade';
	//
	// 	if(!empty($grade_name)) {
	// 		$query .= " WHERE grade_name = '$grade_name'";
	// 	}
	//
  //   $query = $this->db->query($query);
  // 	$query = $query->result_array();
	//
  // 	if($query)
  // 		return $query;
  // 	else
  // 		return FALSE;
  // }

	public function get_type($type_code = '', $type_id = '') {
  	$query = 'SELECT * FROM type';

		if(!empty($type_code)) {
			$query .= " WHERE type_code = '$type_code'";
		}

		if(!empty($type_id)) {
			$query .= " WHERE type_id = '$type_id'";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function get_grade($grade_id = '') {
  	$query = 'SELECT * FROM grade';

		if(!empty($grade_id)) {
			$query .= " WHERE grade_id = '$grade_id'";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function import_member($data = []) {
		if(!empty($data)) {
	      $this->db->truncate('member');
	  }

	  if($this->db->insert_batch('member', $data)) {
	      return true;
	  }

		return false;
	}

	public function set_seat($member_id = '') {
		$get_member_by_id = $this->get_member($member_id);
		$seat = $get_member_by_id[0]['seat'];

		if(empty($seat)) {
			$grade = $this->get_grade($get_member_by_id[0]['grade_id']);

			$event_id = $get_member_by_id[0]['event_id'];
			$grade_id = $grade[0]['grade_id'];
			$grade_code = $grade[0]['grade_code'];

	  	$query = "SELECT m.member_id, m.member_name, m.registration_number,
			c.grade_name, t.type_name, e.event_name, l.location_name, m.seat,
			m.attend_status, m.grade_id, m.get_award, m.member_session, m.gate_in, m.trophy_table,
			m.meeting_point
			FROM member AS m
			LEFT JOIN grade AS c ON m.grade_id = c.grade_id
			LEFT JOIN type AS t ON m.type_id = t.type_id
			LEFT JOIN event AS e ON m.event_id = e.event_id
			LEFT JOIN location AS l ON e.location_id = l.location_id
			WHERE m.event_id = '$event_id' AND m.grade_id = '$grade_id' AND m.attend_status = 1";

	    $query = $this->db->query($query);
	  	$query = $query->result_array();
			$seat_number = count($query) + 1;

			$seat = $grade_code.' '.$seat_number;
		}

		$update_query = "UPDATE member SET attend_status = 1, seat = '$seat' WHERE member_id = '$member_id'";
		$update = $this->db->query($update_query);

		$result['member'] = $get_member_by_id;
		$result['seat'] = $seat;

  	if($update)
  		return $result;
  	else
  		return FALSE;
  }

}
