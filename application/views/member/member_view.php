<?php
// echo json_encode($this->session->userdata['logged_in']);die;

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Member</h1>
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
                    <div class="btn-group pull-right" style="margin-right:5px;">
                        <a href="<?php echo base_url('member/export_member'); ?>" class="btn btn-primary">
                            <i class="fa fa-download"></i>
                            Export Member
                        </a>
                    </div>
                    <div class="btn-group pull-right" style="margin-right:5px;">
                        <a href="<?php echo base_url('member/import_member'); ?>" class="btn btn-primary">
                            <i class="fa fa-upload"></i>
                            Import Member
                        </a>
                    </div>
                    <div class="btn-group pull-right" style="margin-right:5px;">
                        <a href="<?php echo base_url('member/create_member'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add Member
                        </a>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <select id="eventFilter" style="width:300px; margin-bottom:10px;" class="form-control">
                      <option value="">All Event</option>
                      <?php foreach ($event_list as $key => $value) {
                        echo '<option value="'.$value['event_id'].'">'.$value['event_name'].' - '.$value['location_name'].'</option>';
                      } ?>
                    </select>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="member_list">
                      <thead>
                        <tr>
                          <th>Reg. Number</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th>Type</th>
                          <th>Event</th>
                          <th>Seat</th>
                          <th>Attendance</th>
                          <!-- <th>Session</th>
                          <th>Gate</th> -->
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

<!-- Modal -->
<div class="modal fade" id="print_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Member Ticket</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" id="ticketprint" class="btn btn-info" data-dismiss="modal">Print Ticket</button>
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="detail_member_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Member Detail</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<?php $this->load->view('_footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/member/member.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/printThis.js'); ?>"></script>
<script type="text/javascript">
$('#member_list').DataTable({
    "ajax": getBaseUrl() + "/member/get_member_json",
    "columns": [
        { "data": "registration_number" },
        { "data": "member_name" },
        { "data": "grade_name" },
        { "data": "type_name" },
        { "data": "event_name" },
        { "data": "seat" },
        { "data": "attend_status" },
        { "data": "actions" }
    ],
    "order": [[ 1, "asc" ]]
});
</script>
