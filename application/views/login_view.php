<?php
if (isset($this->session->userdata['logged_in']))
    redirect('home');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KUMON</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .background_blur {
              background: url('assets/images/login_wallpaper.jpg');
               position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
              /*-webkit-filter: blur(5px);
              -moz-filter: blur(5px);
              -o-filter: blur(5px);
              -ms-filter: blur(5px);
              filter: blur(5px);*/
        }
    </style>

</head>

<body>

    <div class="background_blur"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-heading">
                    <p class="panel-title" style="text-align:center; margin-top: 30px; font-size: 30px;">KUMON</p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')): ?>
                            <p class='alert alert-success'> <?php echo $this->session->flashdata('success'); ?> </p>
                        <?php endif; ?>

                         <?php if($this->session->flashdata('error')): ?>
                            <p class='alert alert-danger'> <?php echo $this->session->flashdata('error'); ?> </p>
                        <?php endif; ?>


                        <form id="form_login" action="<?php echo $form_action; ?>" method="post" role="form" style="display: block;">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <button type="submit" id="button_login" class="btn btn-lg btn-success btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>

    <!-- validate jquery -->
    <script src="<?php echo base_url('vendor/jquery/jquery.validate.min.js'); ?>"></script>

    <!-- Login -->
    <script src="<?php echo base_url('assets/scripts/login.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('vendor/metisMenu/metisMenu.min.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/js/sb-admin-2.js'); ?>"></script>

</body>

</html>
