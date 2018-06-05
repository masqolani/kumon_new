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
                                      <label>Registration Number</label>
                                      <input type="text" class="form-control" name="registration_number" id="registration_number" value="<?php echo (!empty($data['registration_number'])) ? $data['registration_number'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Member Name</label>
                                      <input type="text" class="form-control" name="member_name" id="member_name" value="<?php echo (!empty($data['member_name'])) ? $data['member_name'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Member Session</label>
                                      <input type="text" class="form-control" name="member_session" id="member_session" value="<?php echo (!empty($data['member_session'])) ? $data['member_session'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Event Name</label>
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
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Attendance Status</label>
                                      <select id="attend_status" name="attend_status" class="form-control">
                                        <?php $selected='';
                                        if(0 == $data['attend_status']){
                                           $selected='selected="selected"';
                                        }
                                        if(1 == $data['attend_status']){
                                           $selected='selected="selected"';
                                        }
                                        ?>
                                        <option value="1" <?php echo ' '.$selected; ?>>Attend</option>
                                        <option value="0" <?php echo ' '.$selected; ?>>Doesn't Attend</option>
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
