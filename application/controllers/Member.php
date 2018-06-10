<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Member extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('member_model');
		$this->load->model('event_model');
		$this->load->helper('php-excel');
  }

	public function index() {
		$event = $this->event_model->get_event('', 1);
		$get_member = $this->member_model->get_member();

		$data['title'] = 'Member List';
		$data['member_data'] = $get_member;
		$data['event_list'] = $event;

    $this->load->view('member/member_view', $data);
	}

	public function get_member_json($event_id = ''){

		$get_member = $this->member_model->get_member('', $event_id);

		if(!empty($get_member)) {
			foreach ($get_member as $key => $value) {
				$actions = anchor(base_url('member/update_member/').$value['member_id'],
										'<i class="fa fa-pencil"></i> Update',
										array('class' => 'btn btn-xs btn-success', 'style' => 'margin-top:2px'));
				$actions .= ' '.anchor(base_url('member/#'), '<i class="fa fa-thumbs-up"></i> Attend',
										array('id' => "attend_status", 'class' => 'btn btn-xs btn-info',
										'member_id' => $value['member_id'], 'style' => 'margin-top:2px',
										'onclick' => "return false"));
				$actions .= ' '.anchor(base_url('member/delete_member/').$value['member_id'],
										'<i class="fa fa-trash-o"></i> Delete', array('class' => 'btn btn-xs btn-danger',
										'style' => 'margin-top:2px', 'onclick' =>
										"return confirm('Are you sure you want to delete this member?');"));
				$actions .= ' '.anchor(base_url('member/#'), '<i class="fa fa-thumbs-up"></i> Detail',
										array('id' => "detail_member", 'class' => 'btn btn-xs btn-warning',
										'member_id' => $value['member_id'], 'style' => 'margin-top:2px',
										'onclick' => "return false"));

				if($value['attend_status'] == 1) {
					$attendance = "<a class='btn btn-sm btn-success'>Attend</a>";
				} else {
					$attendance = "<a class='btn btn-sm btn-danger'>Doesn't Attend</a>";
				}

				$get_member[$key]['actions'] = $actions;
				$get_member[$key]['attend_status'] = $attendance;
				// $get_member[$key]['event_name'] = $value['event_name'].' - '.$value['location_name'];
			}
		} else {
			$get_member = [];
		}

		$data['data'] = $get_member;
		echo json_encode($data);
	}

	public function get_detail_member_json_by_id() {
		$member_id = $this->input->post('member_id');
		$get_member = $this->member_model->get_member($member_id);

		if(!empty($get_member)) {
			echo json_encode($get_member[0]);
		} else {
			echo 'false';
		}
	}

	public function import_member() {
		$post = $this->input->post();

		if($post)
		{
			$this->form_validation->set_rules('event_id', 'Event Name', 'trim|required');
			// $this->form_validation->set_rules('file_upload', 'File', 'required');

      if ($this->form_validation->run() === TRUE) {
					$this->do_upload();
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('member/import_member');
      }
		}
		else
		{
 			$data['form_title'] = 'Import Member';
			$data['form_action'] = base_url('member/import_member');
			$data['event'] = $this->event_model->get_event('', 1);

			$this->load->view('member/import_form_view', $data);
		}
	}

	public function do_upload() {

      ini_set('memory_limit', '1024M');
      set_time_limit(300);
      $config['upload_path'] = realpath(APPPATH . '../upload');
      $config['allowed_types'] = 'xls|xlsx';
      $config['max_size']	= '100000';
      $config['max_width']  = '1024';
      $config['max_height']  = '768';

      // $this->load->library('upload', $config);
			$this->upload->initialize($config);
      $exlfile=null;
      if ( ! $this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
        echo "<script>alert('{$error['error']}');"
        . " window.location.replace('" . base_url() . "member/import_member'); </script> ";
      } else {
        $exlfile = array('upload_data' => $this->upload->data());
        $objs = PHPExcel_IOFactory::load($exlfile['upload_data']['full_path']);
        $cells = $objs->getActiveSheet()->getCellCollection();

        foreach($cells as $cell) {

            $column = $objs->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objs->getActiveSheet()->getCell($cell)->getRow();
            $data_value=$objs->getActiveSheet()->getCell($cell)->getValue();

            if($row == 1) {
                $header[$row][$column] = $data_value;
            }
            else {
                $arr_data[$row][$column] = $data_value;
            }

        }

        $data['header'] = $header;
        $data['values'] = $arr_data;
        $content = array();
        for($i=2; $i<count($data['values']) + 2; $i++) {
					$event_id = $this->input->post('event_id');

					$grade_name = $data['values'][$i]['C'];
					$trophy_table = $data['values'][$i]['I'];
					if($trophy_table == 'COMPLETER') {
						$grade_name = '';
					}

					$grade = $this->member_model->get_grade('', $grade_name, $trophy_table);
					$grade_id = $grade[0]['grade_id'];

					$type_code = substr($data['values'][$i]['G'],0,1) == "C" ? "C" : "A";
					$type = $this->member_model->get_type($type_code);
					$type_id = $type[0]['type_id'];

          array_push($content, array(
              'registration_number' => $data['values'][$i]['B'],
              'event_id' 						=> $event_id,
              'member_session' 			=> $data['values'][$i]['D'],
              'grade_id'						=> !empty($grade_id) ? $grade_id : 0,
              'member_name'					=> $data['values'][$i]['F'],
              'type_id'							=> $type_id,
              'seat' 								=> $data['values'][$i]['K'],
              'get_award'						=> $data['values'][$i]['V'],
              'gate_in'							=> $data['values'][$i]['H'],
              'trophy_table' 				=> $data['values'][$i]['I'],
              'center'							=> 'M',
              'instructor'					=> $data['values'][$i]['L'],
              'plakat'							=> $data['values'][$i]['W'],
              'rank'								=> $data['values'][$i]['N'],
              'among_of' 						=> $data['values'][$i]['O'],
              'math'								=> $data['values'][$i]['P'],
              'ee'									=> $data['values'][$i]['Q'],
              'efl'									=> $data['values'][$i]['R'],
              'cm' 									=> $data['values'][$i]['S'],
              'ce' 									=> $data['values'][$i]['T'],
              'cf' 									=> $data['values'][$i]['U'],
              'trophy_at_class' 		=> $data['values'][$i]['X'],
              'ashr_level' 					=> $data['values'][$i]['Y'],
              'meeting_point' 			=> $data['values'][$i]['J'],
              'student_id'					=> $data['values'][$i]['E']
	        ));
        }


				$get_event_id = $this->member_model->get_member('', $content[0]['event_id'], '', '');
				if(!empty($get_event_id)) {
					$get_event_id = $get_event_id[0]['event_id'];
				}

        if($this->member_model->import_member($content, $get_event_id)) {
            if(unlink($exlfile['upload_data']['full_path'])) {
							$this->session->set_flashdata('success', 'File member has been import successfully');
							redirect('member');
            }
        } else {
            echo $this->member_model->import_member($content);
        }
      }
  }

	public function export_member() {
		$post = $this->input->post();

		if($post)
		{
			$this->form_validation->set_rules('event_id', 'Event Name', 'trim|required');
			$this->form_validation->set_rules('type_id', 'Type Name', 'trim|required');

			if ($this->form_validation->run() === TRUE) {
					$this->export();
			}
			else {
					$this->session->set_flashdata('error', validation_errors());
					redirect('member/export_member');
			}
		}
		else
		{
			$data['form_title'] = 'Export Member';
			$data['form_action'] = base_url('member/export_member');
			$data['event'] = $this->event_model->get_event('', 1);
			$data['type'] = $this->member_model->get_type();

			$this->load->view('member/export_form_view', $data);
		}
	}

	public function create_member() {
		$post = $this->input->post();

		if($post)
		{
			$this->form_validation->set_rules('event_id', 'Event Name', 'trim|required');
			$this->form_validation->set_rules('registration_number', 'Registration Number', 'required');
			$this->form_validation->set_rules('member_session', 'Member Session', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade', 'required');
			$this->form_validation->set_rules('type_id', 'type_id', 'required');

      if ($this->form_validation->run() === TRUE) {
					$this->member_model->add_member($post);
					$this->session->set_flashdata('success', 'Member has been add successfully');
					redirect('member');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('member/create_member');
      }
		}
		else
		{
 			$data['form_title'] = 'Add New Member';
			$data['form_action'] = base_url('member/create_member');
			$data['event'] = $this->event_model->get_event('', 1);
			$data['grade'] = $this->member_model->get_grade();
			$data['type'] = $this->member_model->get_type();

			$this->load->view('member/member_form_view', $data);
		}
	}

	public function update_member($member_id='')
	{
		$post = $this->input->post();

		if($post) {
			$this->form_validation->set_rules('member_name', 'Member Name', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
      		$this->member_model->update_member($post);
          $this->session->set_flashdata('success', 'Registration number '.$post['registration_number'].' has been updated successfully');
          redirect('member');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('member/update_member/'.$member_id);
      }
		}
		else {
			$get_member = $this->member_model->get_member($member_id);
			$data['form_title'] = 'Update Member';
			$data['form_action'] = base_url('member/update_member/'.$member_id);
			$data['data'] = $get_member[0];
			$data['event'] = $this->event_model->get_event('', 1);
			$data['grade'] = $this->member_model->get_grade();
			$data['type'] = $this->member_model->get_type();

			$this->load->view('member/member_form_view', $data);
		}
	}

	public function delete_member($id='')
	{
    $delete_member = $this->member_model->delete_member($id);

    if($delete_member) {
      $this->session->set_flashdata('success', 'Member ID '.$id.' has been deleted');
      redirect('member');
    }
    else {
    	$this->session->set_flashdata('error', 'Cannot delete Member ID '.$id);
      redirect('member');
    }
  }

	public function check_member()
	{
		$data['member_id'] = $this->input->post('member_id');
		$data['member_name'] = $this->input->post('member_name');
		$data['registration_number'] = $this->input->post('registration_number');

    $check_duplicated = $this->member_model->check_duplicated($data);

		if($check_duplicated)
        echo 'false';
    else
        echo 'true';
	}

	public function get_member_status()
	{
    $get_member_status = $this->member_model->get_member_status();
    return $get_member_status;
	}

	public function set_attended() {
		$member_id = $this->input->post('member_id');
		$result = $this->member_model->set_seat($member_id);

		if($result) {
			$data['status'] = 'true';
			$data['member_id'] = $member_id;
			$data['seat'] = $result['seat'];
			$data['result'] = $result['member'];
		} else {
			$data['status'] = 'false';
			$data['member_id'] = '';
			$data['seat'] = '';
			$data['result'] = '';
		}
		echo json_encode($data);
	}

	public function export() {
		$event_id = $this->input->post('event_id');
		$type_id = $this->input->post('type_id');

    $field[] = ["REGISTRATION NUMBER", "NAME", "LOCATION", "EVENT", "GRADE", "SEAT", "TYPE"];
    $get_member = $this->member_model->get_member('', $event_id, $type_id, 1);

		if(!empty($get_member)) {
			foreach($get_member as $row) {
					$data[] = [$row['registration_number'], $row['member_name'],
											$row['location_name'], $row['event_name'], $row['grade_name'],
											$row['seat'], $row['type_name']];
			}

			$xls = new Excel_XML;
			$xls->addArray($field);
			$xls->addArray($data);
			$xls->generateXML('Member_Data_'.$get_member[0]['type_name'].'_'.$get_member[0]['location_name']);
			// $xls->generateXML('Member_Data');

			// $this->session->set_flashdata('success', 'Member data has been export successfully');
			// redirect('member/export_member');
		} else {
			$this->session->set_flashdata('error', 'Member data not found');
			redirect('member/export_member');
		}
  }

}
