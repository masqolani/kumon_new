<?php

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Member Form</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
	             <?php if($this->session->flashdata('error')): ?>
	                <p class='alert alert-danger'> <?php echo $this->session->flashdata('error'); ?> </p>
	            <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
	                    <h4 class="panel-title pull-left" style="padding-top: 7px;"><?php echo $form_title; ?></h4>
	                    <div class="btn-group pull-right">
	                        <a href="<?php echo base_url('member'); ?>" class="btn btn-primary">
	                            <i class="fa fa-arrow-left"></i>
	                            Back to List Member
	                        </a>
	                    </div>
	                </div>
                  <div class="panel-body">
                      <div class="row">
                          <form id="member_form" action="<?php echo $form_action; ?>" enctype="multipart/form-data" method="post" role="form" style="display: block;">
                              <div class="col-lg-12">
                                <input type="hidden" class="form-control" name="member_id" id="member_id" value="<?php echo (!empty($data['member_id'])) ? $data['member_id'] : "" ?>">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Event</label>
                                      <select id="event_id" name="event_id" class="form-control">
                                        <option value="">Select Event</option>
                                        <?php
                                          foreach($event as $row) {
                                            $selected='';
                                            if(!empty($data['event_id'])){
                                              if($row['event_id'] == $data['event_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['event_id'].'" '.$selected.'>'.$row['event_name']. ' ('.$row['location_name'].')'. '</option>';
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Registration Number</label>
                                      <input type="text" class="form-control" name="registration_number" id="registration_number" value="<?php echo (!empty($data['registration_number'])) ? $data['registration_number'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Member Name</label>
                                      <input type="text" class="form-control" name="member_name" id="member_name" value="<?php echo (!empty($data['member_name'])) ? $data['member_name'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Member Session</label>
                                      <input type="text" class="form-control" name="member_session" id="member_session" value="<?php echo (!empty($data['member_session'])) ? $data['member_session'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Grade</label>
                                      <select id="grade_id" name="grade_id" class="form-control">
                                        <option value="">Select Grade</option>
                                        <?php
                                          foreach($grade as $row) {
                                            $selected='';
                                            if(!empty($data['grade_id'])){
                                              if($row['grade_id'] == $data['grade_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['grade_id'].'" '.$selected.'>'.$row['grade_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Type</label>
                                      <select id="type_id" name="type_id" class="form-control">
                                        <option value="">Select Type</option>
                                        <?php
                                          foreach($type as $row) {
                                            $selected='';
                                            if(!empty($data['type_id'])){
                                              if($row['type_id'] == $data['type_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['type_id'].'" '.$selected.'>'.$row['type_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Gate</label>
                                      <input type="text" class="form-control" name="gate_in" id="gate_in" value="<?php echo (!empty($data['gate_in'])) ? $data['gate_in'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Seat</label>
                                      <input type="text" class="form-control" name="seat" id="seat" value="<?php echo (!empty($data['seat'])) ? $data['seat'] : "" ?>" disabled>
                                  </div>
                                  <div class="form-group">
                                      <label>Award</label>
                                      <input type="text" class="form-control" name="get_award" id="get_award" value="<?php echo (!empty($data['get_award'])) ? $data['get_award'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Trophy Table</label>
                                      <input type="text" class="form-control" name="trophy_table" id="trophy_table" value="<?php echo (!empty($data['trophy_table'])) ? $data['trophy_table'] : "5 TINGKAT" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Center</label>
                                      <input type="text" class="form-control" name="center" id="center" value="<?php echo (!empty($data['center'])) ? $data['center'] : "M" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>instructor</label>
                                      <input type="text" class="form-control" name="instructor" id="instructor" value="<?php echo (!empty($data['instructor'])) ? $data['instructor'] : "NOT AVAIL" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Plakat</label>
                                      <input type="text" class="form-control" name="plakat" id="plakat" value="<?php echo (!empty($data['plakat'])) ? $data['plakat'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Rank</label>
                                      <input type="text" class="form-control" name="rank" id="rank" value="<?php echo (!empty($data['rank'])) ? $data['rank'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Among Of</label>
                                      <input type="text" class="form-control" name="among_of" id="among_of" value="<?php echo (!empty($data['among_of'])) ? $data['among_of'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Math</label>
                                      <input type="text" class="form-control" name="math" id="math" value="<?php echo (!empty($data['math'])) ? $data['math'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>EE</label>
                                      <input type="text" class="form-control" name="ee" id="ee" value="<?php echo (!empty($data['ee'])) ? $data['ee'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>EFL</label>
                                      <input type="text" class="form-control" name="efl" id="efl" value="<?php echo (!empty($data['efl'])) ? $data['efl'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>CM</label>
                                      <input type="text" class="form-control" name="cm" id="cm" value="<?php echo (!empty($data['cm'])) ? $data['cm'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>CE</label>
                                      <input type="text" class="form-control" name="ce" id="ce" value="<?php echo (!empty($data['ce'])) ? $data['ce'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>CF</label>
                                      <input type="text" class="form-control" name="cf" id="cf" value="<?php echo (!empty($data['cf'])) ? $data['cf'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Trophy at Class</label>
                                      <input type="text" class="form-control" name="trophy_at_class" id="trophy_at_class" value="<?php echo (!empty($data['trophy_at_class'])) ? $data['trophy_at_class'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>ASHR Level</label>
                                      <input type="text" class="form-control" name="ashr_level" id="ashr_level" value="<?php echo (!empty($data['ashr_level'])) ? $data['ashr_level'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Studend ID</label>
                                      <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo (!empty($data['student_id'])) ? $data['student_id'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Meeting Point</label>
                                      <input type="text" class="form-control" name="meeting_point" id="meeting_point" value="<?php echo (!empty($data['meeting_point'])) ? $data['meeting_point'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Attendance Status</label>
                                      <select id="attend_status" name="attend_status" class="form-control" disabled>
                                        <?php
                                        $selected_attend = '';
                                        $selected_not_attend = '';
                                        if($data['attend_status'] == 1){
                                          $selected_attend = 'selected="selected"';
                                        } else {
                                          $selected_not_attend = 'selected="selected"';
                                        }
                                        ?>
                                        <option value="1" <?php echo $selected_attend; ?>>Attend</option>
                                        <option value="0" <?php echo $selected_not_attend; ?>>Doesn't Attend</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                    <label></label>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php $this->load->view('_footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/member/member_form.js'); ?>"></script>
