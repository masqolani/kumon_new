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
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url('member/create_member'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Import Member
                        </a>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="member_list">
                        <thead>
                            <tr>
                                <th>Reg. Number</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Type</th>
                                <th>Event</th>
                                <th>Location</th>
                                <th>Seat</th>
                                <th>Attendance</th>
                                <!-- <th>Session</th>
                                <th>Gate</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($member_data) {
                                foreach ($member_data as $key => $value) {
                                    $actions = anchor(base_url('member/update_member/').$value['member_id'], '<i class="fa fa-pencil"></i> Update', array('class' => 'btn btn-xs btn-success', 'style' => 'margin-top:2px'));
                                    // if($value['attend_status'] == 0) {
                                        $actions .= ' '.anchor(base_url('member/#'), '<i class="fa fa-thumbs-up"></i> Attend', array('class' => 'btn btn-xs btn-info attend_status', 'member_id' => $value['member_id'], 'style' => 'margin-top:2px'));
                                    // } else {
                                    //     $actions .= ' '.anchor(base_url('member/attend_member/').$value['member_id'], '<i class="fa fa-print"></i> Print', array('class' => 'btn btn-xs btn-info'));
                                    // }

                                    $actions .= ' '.anchor(base_url('member/delete_member/').$value['member_id'], '<i class="fa fa-trash-o"></i> Delete', array('class' => 'btn btn-xs btn-danger', 'style' => 'margin-top:2px', 'onclick' => "return confirm('Are you sure you want to delete this member?');"));
                            ?>
                                <tr>
                                    <td><?php echo $value['registration_number']; ?></td>
                                    <td><?php echo $value['member_name']; ?></td>
                                    <td><?php echo $value['grade_name']; ?></td>
                                    <td><?php echo $value['type_name']; ?></td>
                                    <td><?php echo $value['event_name']; ?></td>
                                    <td><?php echo $value['location_name']; ?></td>
                                    <td class="update_seat_<?php echo $value['member_id']; ?>"><?php echo $value['seat']; ?></td>
                                    <?php
                                      $value['attend_status'] == 1 ? $style = 'style="background-color:#2ecc71"' : $style = 'style="background-color:#e74c3c"';
                                      $value['attend_status'] == 1 ? $attendance = 'Attend' : $attendance = "Doesn't Attend";
                                    ?>
                                    <td class="update_status_attend_<?php echo $value['member_id']; ?>" <?php echo $style; ?>><h4 align="center"><?php echo $attendance; ?></h4></td>
                                    <!-- <td><?php echo $value['member_session']; ?></td>
                                    <td><?php echo $value['gate_in']; ?></td> -->
                                    <td><?php echo $actions; ?></td>
                                </tr>
                            <?php }
                          } else { ?>
                              <tr><td colspan="7" align="center">No Data Exist</td></tr>
                          <?php } ?>
                        </tbody>
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
<div class="modal fade" id="empModal" role="dialog">
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
          <button type="button" id="ticketprint" class="btn btn-info" data-dismiss="modal">Print</button>
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<?php $this->load->view('_footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/member/member.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/printThis.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#member_list').DataTable({
        responsive: true,
        order: [[ 1, "asc" ]]
    });

//     setInterval( function () {
//       $('#member_list').DataTable().ajax.reload();
// }, 2000 );
});
</script>
