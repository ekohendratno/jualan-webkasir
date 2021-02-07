<?php $this->load->view('header');?>
<link href="<?php echo base_url('css/teamof-elegant-modal-form.css') ?>" rel="stylesheet">
    <script type="text/javascript">
        function signin() {

            $('.status').empty();
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/auth/signin',
                data:'username='+username+'&password='+password,
                dataType:'json',
                beforeSend: function () {
                    $("input").attr('disabled','disabled');
                    $("button").attr('disabled','disabled');

                    $('.status').html('<div class="alert alert-warning" role="alert">Loading ...</div>');
                    $('#loading_ajax').show();
                },
                success: function (hasil) {
                    console.log(hasil);

                    $('#loading_ajax').fadeOut("slow");
                    $('.status').html(hasil.pesan);
                    if(hasil.pesan == ''){
                        window.location.assign("<?php echo base_url();?>index.php/"+hasil.redirect);
                    }else{
                        $("input").removeAttr('disabled');
                        $("button").removeAttr('disabled');
                    }
                }
            });
        }
    </script>
    <div class="container" style="padding-top:60px;">
			<div class="row">
                <div id="loginbox" class="mainbox col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6  col-xs-8 col-xs-offset-2">
                <div class="panel panel-default" >


                    <div class="of-elegant-modal show">
                        <div class="container-fluid">
                            <div class="row2">
                                <div class="col-lg-12 px-0">
                                    <div class="py-4 of-login-container of-show">
                                        <h3 class="pt-2">Selamat Datang</h3>
                                        <p class="of-form-description">Silakan masuk dengan akun kamu</p>

                                        <div class="status"></div>

                                        <div class="form-group">
                                            <div class="of-input-container">
                                                <div class="of-input-icon"><img src="img/mail.svg"></div>
                                                <input type="input" class="form-control" id="username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="of-input-container">
                                                <div class="of-input-icon"><img src="img/lock.svg"></div>
                                                <input type="password" class="form-control" id="password" placeholder="Password">
                                                <div class="of-input-validation lpassword-toggle-btn show-password"></div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button onclick="signin()" type="button" id="btn-tambah" class="btn btn-block btn-success">MASUK</button>
                                        </div>

                                        <br class="clear"/>
                                        <!--<a class="of-signup-link of-toggle-link pb-2" href="#">Don't have an account yet? Sign Up!</a>-->
                                    </div>
                                </div> <!--End .col-lg-6 -->
                            </div> <!--End .row -->
                        </div> <!--End .container-fluid -->
                    </div>


				</div>  
			</div>
			</div>
    	</div>
<?php $this->load->view('footer');?>