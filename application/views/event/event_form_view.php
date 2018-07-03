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
                <h1 class="page-header">Event Form</h1>
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
	                        <a href="<?php echo base_url('event'); ?>" class="btn btn-primary btn-sm">
	                            <i class="fa fa-arrow-left"></i>
	                            Back to List Event
	                        </a>
	                    </div>
	                </div>
                  <div class="panel-body">
                      <div class="row">
                          <form id="event_form" action="<?php echo $form_action; ?>" method="post" role="form" style="display: block;">
                              <div class="col-lg-12">
                                <input type="hidden" class="form-control" name="event_id" id="event_id" value="<?php echo (!empty($data['event_id'])) ? $data['event_id'] : "" ?>">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Event Name</label>
                                      <input type="text" class="form-control" name="event_name" id="event_name" value="<?php echo (!empty($data['event_name'])) ? $data['event_name'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Start Date</label>
                                      <input class="form-control" name="start_date" id="start_date" value="<?php echo (!empty($data['start_date'])) ? $data['start_date'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>End Date</label>
                                      <input class="form-control" name="end_date" id="end_date" value="<?php echo (!empty($data['end_date'])) ? $data['end_date'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Event Location</label>
                                      <select id="location_id" name="location_id" class="form-control">
                                        <option value="">Select Location</option>
                                        <?php
                                          foreach($location as $row) {
                                            $selected='';
                                            if(!empty($data['location_id'])){
                                              if($row['location_id'] == $data['location_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['location_id'].'" '.$selected.'>'.$row['location_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <?php if(!empty($data['event_id'])) { ?>
                                    <div class="form-group">
                                        <label>Event Status</label>
                                        <select id="event_status" name="event_status" class="form-control">
                                          <option value="">Select status</option>

                                          <?php
                                              $selected = '';
                                              if(!empty($data['event_status'])){
                                                if($data['event_status'] == 1){
                                                   $selected = 'selected="selected"';
                                                }
                                              }

                                              echo '<option value="0" '.$selected.'>IN_ACTIVE</option>';
                                              echo '<option value="1" '.$selected.'>ACTIVE</option>';
                                          ?>
                                        </select>
                                    </div>
                                  <?php } ?>
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

<script type="text/javascript" src="<?php echo base_url('assets/scripts/event/event_form.js'); ?>"></script>
