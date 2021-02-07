<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>
    <script src="<?php echo base_url('js/jquery.min.js') ?>"></script>	
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>	
	<link rel="icon" type="image/ico" href="<?php echo base_url('img/perpus.ico') ?>"><link rel='dns-prefetch' href='<?php echo base_url();?>' />
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/custom.css') ?>" rel="stylesheet">
	  <style type="text/css">
		  .panel-default>.panel-heading {
			  background-color: #fff;
			  border-bottom: 0px;
		  }
	  </style>
  </head>

  <body class="text-center" style="padding-top: 10px;">
  
	<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></center></div></div>
	  
	<div class="container">
		<div class="row">
        <div id="loginbox" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-default" >
					<div class="panel-heading">
							 <div class="panel-title pull-left">
								<a href="<?php echo base_url();?>"><div class="btn-group" role="group"><div class="btn"><span class="
									glyphicon glyphicon-home"></span></div><div class="btn">Dashboard</div></div></a>
								 
							 </div>
							<div class="panel-title pull-right">
								<a href="<?php echo base_url('auth/logout');?>" title="Logout"><div class="btn"><span class="
glyphicon glyphicon-off" style="color: #FC0004"></span></div></a>
							</div>
							<div class="clearfix"></div>
					</div>
				
                    <div class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form class="form-horizontal" id="submit">
						
						<div class="col-md-5">
									<div class="btn-group btn-group-justified">
									  <a href="#" class="btn btn-default" onClick="$('#img-gravatar').hide(); $('#img-local').show()">Local</a>
									  <a href="#" class="btn btn-default" onClick="$('#img-local').hide(); $('#img-gravatar').show()">Gravatar</a>
									</div>
							<div id="img-local">
								<center>								
									<img src="<?php if( $user_foto != '' && file_exists('uploads/users/'.$user_foto) ){ echo base_url('uploads/users/'.$user_foto); }else{ echo base_url('img/avatar.png');}?>" class="img-circle" alt="Cinque Terre" height="100" width="100" style="margin:20px 0;" >
									<h4><?php echo $this->session->userdata('username');?></h4>								
								</center>
							
								<div class="form-group">
									<div class="col-md-12">
										<input type="file" name="file">
									</div>
								</div>
							</div>
							<div id="img-gravatar" style="display:none">
								<center>
								<a href="http://www.gravatar.com/" title="Clik for Change Gravatar" target="_blank">
									<img class="img-circle"  height="100" width="100" style="margin:20px 0;" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y">
								</a>
								</center>
							</div>
							
                            <div class="form-group">
                                <!-- Button -->                                        
                                <div class="col-md-12">
                                    <button class="btn btn-success" id="btn_upload" type="submit">Update</button>
                                </div>                                           
                                        
                            </div>
						</div>
						<div class="col-md-7" style="border-left:1px solid #f2f2f2;">
                            <div class="form-group">
                                <label for="username" class="col-md-4 control-label">Username</label>
                                <div class="col-md-8">
                                    <input type="username" class="form-control" name="username" placeholder="Username" disabled value="<?php echo $username;?>">
                                </div>
                            </div>
                        </div>
                        </form>   



                    </div>                     
            </div>  
        </div>
		</div>
    </div>

		  <footer class="mastfoot mt-auto">
			<div class="inner">
			  <p class="text-dark">Copyright 2018. Powered by <a href="https://berkarya.kopas.id/">@KopasProjects</a>.</p>
			</div>
		  </footer>
    </div>
	<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#submit').submit(function(e){
				e.preventDefault(); 
					 $.ajax({
						 url:'<?php echo base_url();?>index.php/auth/do_upload',
						 type: "POST",
						 data: new FormData(this),
						 dataType: 'json',
						 processData :false,
						 contentType :false,
						 cache :false,
						 async :false,
						 success: function(data){
							 //console.log(data);
							 alert(data.pesan);	
							 
							 if(data.ok == 1){
								 					
								window.location.assign("<?php echo base_url();?>index.php/auth/profile"); 
								 
							 }
					   }
					 });
				});


		});

	</script>
  </body>
</html>
