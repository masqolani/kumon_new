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
                <h1 class="page-header">Help</h1>
            </div>         
        </div>
        <!-- Graph -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul>
                          <li><b>Usename</b> - akses untuk setiap user yang ingin login ke web.</li>
                          <li><b>Password</b> - kode untuk melangkapi username agar bisa mengakses web.</li>
                          <li><b>Login</b> - tombol untuk masuk ke form home dan form utama.</li>
                          <li><b>Tombol orang</b> - untuk log out dari web.</li>
                          <li><b>Tombol tiket open pada dashboard</b> - untuk melihat tiket-tiket yang masih open.</li>
                          <li><b>Tombol tiket pending pada dashboard</b> - untuk melihat tiket-tiket yang masih pending.</li>
                          <li><b>Tombol tiket technical-close pada dashboard</b> - untuk melihat tiket-tiket yang masih technical-close.</li>
                          <li><b>Add new ticket</b> - untuk membuat tiket.</li>
                          <li><b>Kolom CID</b> - untuk menginput CID.</li>
                          <li><b>Kolom service</b> - input layanan.</li>
                          <li><b>Description</b> - kolom mengenai keluhan apa saja yang akan disampaika customer (corporate).</li>
                          <li><b>Submit</b> - eksekusi untuk membuat tiket.</li>
                          <li><b>Reset</b> - untuk mereset data yang yang telah di input.</li>
                          <li><b>Update</b> - untuk melakukan update terhadap tiket.</li>
                          <li><b>Detail</b> - untuk melihat isi detail dari tiket.</li>
                          <li><b>Delete</b> - untuk menghapus tiket.</li>
                          <li><b>Kolom ACK</b> - agar status tiket bisa menjadi close.</li>
                          <li><b>Grafik</b> - untuk mellihat grafik dari seluruh status tiket yang ada.</li>
                          <li><b>Help</b> - tombol bantuan untuk mengetahui keterangan menu yang ada pada web.</li>
                          <li><b>About</b> - isi riwayat atau identitas pemilik web.</li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
        <!-- End Graph -->
    </div>
</div>
<!-- /#page-wrapper -->
            

<?php $this->load->view('_footer'); ?>