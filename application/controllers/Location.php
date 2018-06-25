<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('location_model');
		$this->load->model('event_model');
  }

	public function index() {
		$get_location = $this->location_model->get_location();

		$data['title'] = 'Location List';
		$data['location_data'] = $get_location;

    $this->load->view('location/location_view', $data);
	}

	public function create_location() {
		$post = $this->input->post();

		if($post)
		{
			$location = $this->session->locationdata['logged_in'];

			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
          $this->location_model->add_location($post);
          $this->session->set_flashdata('success', 'Location has been created successfully');
          redirect('location');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('location/create_location');
      }
		}
		else
		{
 			$data['form_title'] = 'Add New Location';
			$data['form_action'] = base_url('location/create_location');

			$this->load->view('location/location_form_view', $data);
		}
	}

	public function update_location($location_id='')
	{
		$post = $this->input->post();

		if($post) {
			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
      		$this->location_model->update_location($post);
          $this->session->set_flashdata('success', 'Location ID '.$post['location_id'].' has been updated successfully');
          redirect('location');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('location/update_location/'.$location_id);
      }
		}
		else {
			$get_location = $this->location_model->get_location($location_id);
			$data['form_title'] = 'Update Location';
			$data['form_action'] = base_url('location/update_location/'.$location_id);
			$data['data'] = $get_location[0];

			$this->load->view('location/location_form_view', $data);
		}
	}

	public function delete_location($id='')
	{
		$check_location_active = $this->event_model->get_event('', '', $id);

		if($check_location_active) {
			$this->session->set_flashdata('error', 'Cannot delete Location when location used in event');
			redirect('location');
		} else {
			$delete_location = $this->location_model->delete_location($id);

			if($delete_location) {
				$this->session->set_flashdata('success', 'Location ID '.$id.' has been deleted');
				redirect('location');
			}
			else {
				$this->session->set_flashdata('error', 'Cannot delete Location ID '.$id);
				redirect('location');
			}
		}
  }

	public function check_location()
	{
		$data['location_id'] = $this->input->post('location_id');
		$data['location_name'] = $this->input->post('location_name');

    $check_duplicated = $this->location_model->check_duplicated($data);

		if($check_duplicated)
        echo 'false';
    else
        echo 'true';
	}

	public function get_location_status()
	{
    $get_location_status = $this->location_model->get_location_status();
    return $get_location_status;
	}

}
