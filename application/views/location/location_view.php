<?php
// echo json_encode($this->session->userdata['logged_in']);die;

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Location</h1>
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
                        <a href="<?php echo base_url('location/create_location'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New Location
                        </a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="location_list">
                        <thead>
                            <tr>
                                <th>Location ID</th>
                                <th>Location Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($location_data) {
                                foreach ($location_data as $key => $value) {
                                    $actions = anchor(base_url('location/update_location/').$value['location_id'], '<i class="fa fa-pencil"></i> Update', array('class' => 'btn btn-xs btn-success'));
                                    $actions .= ' '.anchor(base_url('location/delete_location/').$value['location_id'], '<i class="fa fa-trash-o"></i> Delete', array('class' => 'btn btn-xs btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this location?');"));
                            ?>
                                <tr>
                                    <td><?php echo $value['location_id']; ?></td>
                                    <td><?php echo $value['location_name']; ?></td>
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
    $('#location_list').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]]
    });
});
</script>
