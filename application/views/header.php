<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Toko</title>
    <script src="<?php echo base_url('js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
    <script src="<?php echo base_url(); ?>js/sweetalert/sweetalert.min.js"></script>
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/custom-home.css') ?>" rel="stylesheet">
    <script type="text/javascript">$('#loading_ajax').show();</script>
    <style type="text/css">
        #loading_ajax{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: 50% 50% no-repeat rgba(0,0,0,0.80);
        }
        .panel-title-button a.btn {
            color: #fff;
        }
    </style>
</head>

<body class="text-center" style="padding-top: 10px;">

<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></center></div></div>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>" title="PPDB 2020/2021">
                <img alt="Brand" src="<?php echo base_url();?>img/ppdb.png" style="float: left; margin-top: -5px; padding: 0; height: 30px">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>">Beranda</a></li>
                <li><a href="<?php echo base_url();?>#tentang">Tentang</a></li>
                <?php if($this->session->userdata('user_level') == 'admin'){?>
                    <li><a href="<?php echo base_url().'auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
                    <li><a href="<?php echo base_url().'admin/dashboard'; ?>"><span class="glyphicon glyphicon-dashboard"></span></li></a>
                    <li><a href="<?php echo base_url().'auth/logout'; ?>" target="_blank"><span class="glyphicon glyphicon-log-in"></span></li></a>
                <?php }?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>