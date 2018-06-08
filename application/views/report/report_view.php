<?php
// echo json_encode($this->session->userdata['logged_in']);die;

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Report</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if($this->session->flashdata('success')): ?>
                <p class='alert alert-success'> <?php echo $this->session->flashdata('success'); ?> </p>
            <?php endif; ?>

             <?php if($this->session->flashdata('error')): ?>
                <p class='alert alert-danger'> <?php echo $this->session->flashdata('error'); ?> </p>
            <?php endif; ?>
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7px;"><?php echo $title; ?></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="report_list">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Location</th>
                                <th>Attended</th>
                                <th>Doesn't Attended</th>
                                <th>Total Member</th>
                                <th>Percentage (%)</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

<?php $this->load->view('_footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/report/report.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#report_list').DataTable({
      "ajax": getBaseUrl() + "/report/get_report",
      "columns": [
          { "data": "event_name" },
          { "data": "location_name" },
          { "data": "attended_total" },
          { "data": "not_attended_total" },
          { "data": "member_total" },
          { "data": "percentage" }
      ],
    "order": [[ 0, "asc" ]]
  });
});
</script>
