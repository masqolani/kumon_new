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
                <h1 class="page-header">Location Form</h1>
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
	                        <a href="<?php echo base_url('location'); ?>" class="btn btn-primary">
	                            <i class="fa fa-arrow-left"></i>
	                            Back to List Location
	                        </a>
	                    </div>
	                </div>
                  <div class="panel-body">
                      <div class="row">
                          <form id="location_form" action="<?php echo $form_action; ?>" method="post" role="form" style="display: block;">
                              <div class="col-lg-12">
                                <input type="hidden" class="form-control" name="location_id" id="location_id" value="<?php echo (!empty($data['location_id'])) ? $data['location_id'] : "" ?>">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Location Name</label>
                                      <input type="text" class="form-control" name="location_name" id="location_name" value="<?php echo (!empty($data['location_name'])) ? $data['location_name'] : "" ?>">
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

<script type="text/javascript" src="<?php echo base_url('assets/scripts/location/location_form.js'); ?>"></script>
