<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('event_model');
  }

	public function index() {
		$get_event = $this->event_model->get_event();

		$data['title'] = 'Event List';
		$data['event_data'] = $get_event;

    $this->load->view('event/event_view', $data);
	}

	public function create_event() {
		$post = $this->input->post();

		if($post)
		{
			$this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
			$this->form_validation->set_rules('event_date', 'Event Date', 'trim|required');
			$this->form_validation->set_rules('location_id', 'Location', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
          $this->event_model->add_event($post);
          $this->session->set_flashdata('success', 'Event has been created successfully');
          redirect('event');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('event/create_event');
      }
		}
		else
		{
 			$data['form_title'] = 'Add New Event';
			$data['form_action'] = base_url('event/create_event');
			$data['location'] = $this->event_model->get_location();

			$this->load->view('event/event_form_view', $data);
		}
	}

	public function update_event($event_id='')
	{
		$post = $this->input->post();

		if($post) {
			$this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
			$this->form_validation->set_rules('event_date', 'Event Date', 'trim|required');
			$this->form_validation->set_rules('location_id', 'Location', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
      		$this->event_model->update_event($post);
          $this->session->set_flashdata('success', 'Event ID '.$post['event_id'].' has been updated successfully');
          redirect('event');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('event/update_event/'.$event_id);
      }
		}
		else {
			$get_event = $this->event_model->get_event($event_id);
			$data['form_title'] = 'Update Event';
			$data['form_action'] = base_url('event/update_event/'.$event_id);
			$data['data'] = $get_event[0];
			$data['location'] = $this->event_model->get_location();

			$this->load->view('event/event_form_view', $data);
		}
	}

	public function delete_event($id='')
	{
    $delete_event = $this->event_model->delete_event($id);

    if($delete_event) {
      $this->session->set_flashdata('success', 'Event ID '.$id.' has been deleted');
      redirect('event');
    }
    else {
    	$this->session->set_flashdata('error', 'Cannot delete Event ID '.$id);
      redirect('event');
    }
  }

	public function check_event()
	{
		$data['event_id'] = $this->input->post('event_id');
		$data['event_name'] = $this->input->post('event_name');
		$data['location_id'] = $this->input->post('location_id');
		$data['event_date'] = $this->input->post('event_date');

    $check_duplicated = $this->event_model->check_duplicated($data);

		if($check_duplicated)
        echo 'false';
    else
        echo 'true';
	}

	public function get_event_status()
	{
    $get_event_status = $this->event_model->get_event_status();
    return $get_event_status;
	}

}
