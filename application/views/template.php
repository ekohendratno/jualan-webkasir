<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php echo $title?></title>

	
    <script src="<?php echo base_url('js/jquery.min.js') ?>"></script>	
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>	
    <script src="<?php echo base_url('js/bootstrap-tagsinput.min.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui-timepicker-addon.min.js') ?>"></script>
    <script defer src="<?php echo base_url(); ?>js/fontawesome/js/all.js"></script>
    	
	<link rel="icon" type="image/ico" href="<?php echo base_url('img/logo.ico') ?>"><link rel='dns-prefetch' href='<?php echo base_url();?>' />
	
	<link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/custom.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/bootstrap-tagsinput.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('js/datatables/css/dataTables.bootstrap.css'); ?>"/>
	<link href="<?php echo base_url('css/jquery-ui-timepicker-addon.min.css') ?>" rel="stylesheet">
    <style type="text/css">
        /*body{
            background: #ddd url("<?php echo base_url('img/bg3.png') ?>") right center repeat;
		}*/
        .navbar-inverse{background-color:  #3c4b59;}

        .inset {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 10px;
            margin-left: 0px;
            margin-right: 0px;
            background-color: transparent !important;
            z-index: 999;
        }

        .inset img {
            border-radius: inherit;
            width: inherit;
            height: inherit;
            display: block;
            position: relative;
            z-index: 998;
        }


        .inset2 {
            display: block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 10px;
            margin-left: -3px;
            margin-right: 0px;
            background-color: transparent !important;
            z-index: 999;
        }
        .inset2 img {
            border-radius: inherit;
            width: inherit;
            height: inherit;
            display: block;
            position: relative;
            z-index: 998;
            padding: 1px;
            border: 2px solid #838383;
        }

        .control-sidebar {
            top: 0;
            right: -300px;
            width: 300px;
        }

        .control-sidebar.fix {
            z-index: 101;
        }

        ul.nav.nav-pills.nav-stacked {
            padding-top: 74px;
        }

        .empty-placeholder {
            padding: 20px;
        }

    </style>
    <style id="jsbin-css">
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
            background: transparent;
            color: #fff;

        }
        @media (min-width:768px) {

            .nav-bg {
                height: 0px;
                width: 100%;
                position: absolute;
                top: 50px;
                background: #fff;
                -webkit-box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
                -moz-box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
                box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
            }

            .menu-open .nav-bg { height: 50px } /* change to your height of the child menu */

        }

        .navbar-nav.nav > li { position: static }

        .navbar-nav.nav .dropdown-menu {
            left: 0 !important;
            right: 0 !important;
            box-shadow: none;
            border: none;
            margin: 0 auto;
            max-width: 1170px;
            background: transparent;
            padding: 0;
        }

        .navbar-nav.nav .dropdown-menu > li { float: left }

        .navbar-nav.nav .dropdown-menu > li > a {
            width: auto !important;
            background: transparent;
            line-height: 49px;
            padding-top: 0;
            padding-bottom: 0;
            margin: 0;
        }
        }



    </style>

	<script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>
</head>
<body id="body">
	
	<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></center></div></div>
	
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">			
					<?php if($this->session->userdata('user_level') == 'admin'){?>
					<li><a href="<?php echo base_url();?>index.php/admin/dashboard"><i class='fa fa-home fa-fw'></i> Dashboard</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class='fa fa-shopping-cart fa-fw'></i> Penjualan <span class="caret"></span></a>
                            <ul class="dropdown-menu container">
                                <li><a href="<?php echo base_url();?>index.php/admin/penjualan">Semua Penjualan</a></li>
                                <li><a href="<?php echo base_url();?>index.php/admin/penjualan/transaksi">Transaksi</a></li>
                                <li><a href="<?php echo base_url();?>index.php/admin/penjualan/pelanggan">Data Pelanggan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class='fa fa-cube fa-fw'></i> Barang <span class="caret"></span></a>
                            <ul class="dropdown-menu container">
                                <li><a href="<?php echo base_url();?>index.php/admin/barang">Semua Barang</a></li>
                                <li><a href="<?php echo base_url();?>index.php/admin/barang/merek">Daftar Merek</a></li>
                                <li><a href="<?php echo base_url();?>index.php/admin/barang/kategori">Daftar Kategori</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url();?>index.php/admin/laporan"><i class='fa fa-file fa-fw'></i> Laporan</a></li>
                        <li><a href="<?php echo base_url();?>index.php/admin/users"><i class='fa fa-user fa-fw'></i> Users</a></li>
					<?php }?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				  	<li>
						<div class="inset">
							<?php $foto = $this->session->userdata('user_foto');?>
					  		<img src="<?php if( $foto != '' && file_exists('uploads/users/'.$foto) ){ echo base_url('uploads/users/'.$foto); }else{ echo base_url('img/avatar.png');}?>">
						</div>
				  	</li>
					<li><a href="<?php echo base_url().'index.php/auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
					<li><a href="<?php echo base_url().'index.php/admin/pengaturan'; ?>" title="Pengaturan"><span class="glyphicon glyphicon-cog"></span></li></a>
					<li><a href="<?php echo base_url().'index.php/auth/logout'; ?>" title="Logout"><span class="glyphicon glyphicon-off"></span></li></a>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

<?php 
echo $contents 
?>


    <footer class="footer container">

        <section class="col-sm-12" style="margin-top: 50px;">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <hr class="medium">
                <p class="text-muted" style="font-size: 12px;">Copyright &copy; 2021. Versi 1.0. Powered by <a href="https://berkarya.kopas.id/">@KopasProjects</a></p>
            </div>
        </section>
    </footer>
<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('js/datatables/js/jquery.dataTables.js') ?>"></script>
<script id="jsbin-javascript">

    $( '.navbar' ).append( '<span class="nav-bg"></span>' );

    $('.dropdown-toggle').click(function () {

      if (!$(this).parent().hasClass('open')) {

         $('html').addClass('menu-open');

      } else {

         $('html').removeClass('menu-open');


      }

    });


    <?php if($this->uri->segment(2) != 'dashboard'){?>
    $('.navbar-right').attr("style", "display:none;");
    $('.panel-title-button').attr("style", "display:block; margin-top:10px;margin-right:15px;");
    $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );
    //$('.panel-heading').remove();
    <?php }?>


    $(document).on('click touchstart', function (a) {
            if ($(a.target).parents().index($('.navbar-nav')) == -1) {
                    $('html').removeClass('menu-open');
            }
    });


</script>



    <div class="modal" id="ModalGue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
                    <h4 class="modal-title" id="ModalHeader"></h4>
                </div>
                <div class="modal-body" id="ModalContent"></div>
                <div class="modal-footer" id="ModalFooter"></div>
            </div>
        </div>
    </div>

</body>
</html>
