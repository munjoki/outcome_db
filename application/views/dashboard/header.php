<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">
        <!-- custom styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-grey" style="overflow-x:hidden !important">
        <nav class="navbar navbar-default shadow navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url('dashboard'); ?>">AKDN MER Studies</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= site_url('dashboard'); ?>">HOME<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?= site_url('ajaxprocessor/dashboard'); ?>">PARTIALLY SAVED STUDIES</a></li>
                        <!--only admin can see this link-->
                        <?php if ($this->session->role == '1'): ?>
                            <li><a href="<?= site_url("user"); ?>">USERS</a></li>
                        <?php endif; ?>
                            <li><a><span>Welcome <?= $this->session->email; ?></span></a></li>
                    </ul>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="">
                        <a  href="<?= site_url('authentication/logout'); ?>" class="btn btn-danger navbar-right navbar-btn margin-right-10">Logout</a>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </nav>