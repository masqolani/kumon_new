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
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url('event/create_event'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New Event
                        </a>
                    </div>
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
                        <tbody>
                            <?php
                            if($event_data) {
                                foreach ($event_data as $key => $value) {
                                    $actions = anchor(base_url('event/update_event/').$value['event_id'], '<i class="fa fa-pencil"></i> Update', array('class' => 'btn btn-xs btn-success'));
                                    $actions .= ' '.anchor(base_url('event/delete_event/').$value['event_id'], '<i class="fa fa-trash-o"></i> Delete', array('class' => 'btn btn-xs btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this event?');"));
                            ?>
                                <tr>
                                    <td><?php echo $value['event_id']; ?></td>
                                    <td><?php echo $value['event_name']; ?></td>
                                    <td><?php echo $value['start_date']; ?></td>
                                    <td><?php echo $value['end_date']; ?></td>
                                    <td><?php echo $value['location_name']; ?></td>
                                    <td><?php echo $value['event_status'] == 1 ? "<a class='btn btn-sm btn-success'>ACTIVE</a>" : "<a class='btn btn-sm btn-danger'>IN_ACTIVE</a>"; ?></td>
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

<?php $this->load->view('_footer'); ?>

<script type="text/javascript">
    $(document).ready(function() {
    $('#event_list').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]]
    });
});
</script>
