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
                <h1 class="page-header">User Form</h1>
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
	                        <a href="<?php echo base_url('user'); ?>" class="btn btn-primary btn-sm">
	                            <i class="fa fa-arrow-left"></i>
	                            Back to List User
	                        </a>
	                    </div>
	                </div>
                  <div class="panel-body">
                      <div class="row">
                          <form id="user_form" action="<?php echo $form_action; ?>" method="post" role="form" style="display: block;">
                              <div class="col-lg-12">
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo (!empty($data['user_id'])) ? $data['user_id'] : "" ?>">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" class="form-control" name="username" id="username" value="<?php echo (!empty($data['username'])) ? $data['username'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>First Name</label>
                                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo (!empty($data['first_name'])) ? $data['first_name'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Last Name</label>
                                      <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo (!empty($data['last_name'])) ? $data['last_name'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" class="form-control" name="email" id="email" value="<?php echo (!empty($data['email'])) ? $data['email'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" class="form-control" name="password" id="password" value="<?php echo (!empty($data['password'])) ? $data['password'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Confirm Password</label>
                                      <input type="password" class="form-control" name="retype_password" id="retype_password" value="<?php echo (!empty($data['password'])) ? $data['password'] : "" ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>User Status</label>
                                      <select name="user_status_id" class="form-control">
                                        <option value="">Select User Status</option>
                                        <?php
                                          foreach($user_status as $row) {
                                            $selected='';
                                            if(!empty($data['user_status_id'])){
                                              if($row['user_status_id'] == $data['user_status_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['user_status_id'].'" '.$selected.'>'.$row['user_status_name'].'</option>';
                                          }
                                        ?>
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

<script type="text/javascript" src="<?php echo base_url('assets/scripts/user/user_form.js'); ?>"></script>
