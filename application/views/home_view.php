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
                <h1 class="page-header">Dashboard Member</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <!-- <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-openid fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">1</div>
                                <div>Ticket Open</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('ticket/filter_table/1'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-coffee fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">1</div>
                                <div>Ticket Pending</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('ticket/filter_table/2'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-life-ring fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">1</div>
                                <div>Ticket Technical Close</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('ticket/filter_table/3'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">1</div>
                                <div>Ticket Close</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('ticket/filter_table/4'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div> -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php $this->load->view('_footer'); ?>
