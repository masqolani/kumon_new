<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('report_model');
  }

	public function index() {
		$data['title'] = 'Report List';
    $this->load->view('report/report_view', $data);
	}

	public function get_report() {
		$get_report = $this->report_model->get_report();

		if(!empty($get_report)) {
			foreach ($get_report as $key => $value) {
				$get_report[$key]['percentage'] = substr($value['percentage'],0,5).' %';
			}
		} else {
			$get_report = [];
		}

		$data['data'] = $get_report;
		echo json_encode($data);
	}

}
