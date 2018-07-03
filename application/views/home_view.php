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
                <h1 class="page-header" align="center">Welcome to ASF 2018</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row" align="center">
          <!-- ganti gambar -->
          <img style="max-width: 1200px; max-height: 900px;" src="<?php echo base_url("assets/images/logo_asf_2018-min.png")?>"
          class="img-fluid img-thumbnail">
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php $this->load->view('_footer'); ?>
