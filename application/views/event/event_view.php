<?php
// echo json_encode($this->session->userdata['logged_in']);die;

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Event</h1>
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
                    <?php if($this->session->userdata['logged_in']['user_status_id'] == 1) { ?>
                      <div class="btn-group pull-right">
                          <a href="<?php echo base_url('event/create_event'); ?>" class="btn btn-primary btn-sm">
                              <i class="fa fa-plus"></i>
                              Add New Event
                          </a>
                      </div>
                    <?php } ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="event_list">
                        <thead>
                            <tr>
                                <th>Event ID</th>
                                <th>Event Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th>Event Status</th>
                                <th>Action</th>
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

<script type="text/javascript">
  function getBaseUrl() {
      var l = window.location;
      var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
      return base_url;
  }

  $(document).ready(function() {
    $('#event_list').DataTable({
        "ajax": getBaseUrl() + "/event/get_event_json",
        "columns": [
            { "data": "event_id" },
            { "data": "event_name" },
            { "data": "start_date" },
            { "data": "end_date" },
            { "data": "location_name" },
            { "data": "event_status" },
            { "data": "actions" }
        ],
        "order": [[ 0, "desc" ]]
    });

    // setInterval( function () {
    //     $('#event_list').DataTable().ajax.reload(null, false);
    // }, 15000);
});
</script>
