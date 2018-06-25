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

	public function get_event_json(){

		$get_event = $this->event_model->get_event();
		$update = $this->event_model->update_event_less_than_today();

		if(!empty($get_event)) {
			foreach ($get_event as $key => $value) {
				$actions = '';
				if($value['event_status'] == 1) {
					$event_status = "<a class='btn btn-sm btn-success default-cursor'>ACTIVE</a>";
					$actions = anchor(base_url('event/update_event/').$value['event_id'], '<i class="fa fa-pencil"></i> Update', array('class' => 'btn btn-xs btn-success'));
				} else {
					$event_status = "<a class='btn btn-sm btn-danger default-cursor'>IN_ACTIVE</a>";
				}

				$actions .= ' '.anchor(base_url('event/delete_event/').$value['event_id'], '<i class="fa fa-trash-o"></i> Delete', array('class' => 'btn btn-xs btn-danger',
				'onclick' => "return confirm('Are you sure you want to delete this event?');"));

				$get_event[$key]['actions'] = $actions;
				$get_event[$key]['event_status'] = $event_status;
			}
		} else {
			$get_event = [];
		}

		$data['data'] = $get_event;
		echo json_encode($data);
	}

	public function create_event() {
		$post = $this->input->post();

		if($post)
		{
			$this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
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
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
			$this->form_validation->set_rules('location_id', 'Location', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
				// print_r($post);die;
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
		$check_event_active = $this->event_model->get_event($id);

		if($check_event_active[0]['event_status'] == 1) {
			$this->session->set_flashdata('error', 'Cannot delete event when status active');
      redirect('event');
		} else {
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
  }

	public function check_event()
	{
		$data['event_id'] = $this->input->post('event_id');
		$data['event_name'] = $this->input->post('event_name');
		$data['location_id'] = $this->input->post('location_id');
		$data['start_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');

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
