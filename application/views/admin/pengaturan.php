

<div class="wrapper" style="height: auto; min-height: 100%;">
<div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">DATA PENGATURAN</h4>
                        <div class="panel-title-button pull-right">
                            <button onclick="resetDataAll()" class="btn btn-danger"><i class="icon-left glyphicon glyphicon-cog"></i> Reset Semua Data</button>
                        </div>
                    </div>
					<div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                            <table id='postListPengaturanTA' class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">TAHUN</th>
                                    <th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div id='pagination'></div>
                                <div class="text-right">
                                    <a href="#form1" data-toggle="modal" onClick="submit('tambah')" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-plus"></span> Tahun Ajaran</a>
                                </div>
                             </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-12">

                                <table id='postListPengaturanJurusan' class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Kode Jurusan</th>
                                        <th>Nama Jurusan</th>
                                        <th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div id='pagination'></div>
                                <div class="text-right">
                                    <a href="#form2" data-toggle="modal" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-plus"></span> Jurusan</a>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <label>Nama Instansi</label>
                                <div class="input-group">
                                    <input class="form-control" name="instansi" id="instansi" value="<?php echo $instansi;?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitInstansi()">Simpan</button>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Tutup PPDB</label>
                                <div class="input-group">
                                    <input class="form-control" name="tutup_ppdb" id="tutup_ppdb" value="<?php echo $tutup_ppdb;?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitTutupPPDB()">Simpan</button>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Tampil Peserta Pendaftar</label>
                                <div class="input-group">

                                    <select class="form-control" name="tampil_peserta" id="tampil_peserta" minlength="3" maxlength="20">
                                        <option value="">Pilih</option>
                                        <option value="ya"<?php if($tampil_peserta == "ya") echo " selected";?>>Ya</option>
                                        <option value="tidak"<?php if($tampil_peserta == "tidak") echo " selected";?>>Tidak</option>
                                    </select>

                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitTampilPeserta()">Simpan</button>
                                </span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <label>Formulir Tanggal Berkas Kumpul Paling Lambat</label>
                                <div class="input-group">
                                    <input class="form-control" name="lambat_ppdb" id="lambat_ppdb" value="<?php echo $tanggal1;?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitLambatKumpul()">Simpan</button>
                                </span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <label>Formulir Tanggal PPDB</label>
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_ppdb" id="tanggal_ppdb" value="<?php echo $tanggal2;?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitTanggalPPDB()">Simpan</button>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Pesan Selamat Datang</label><br/>
                                <textarea class="form-control" style="height:100px;" name="wm_text" id="wm_text" autofocus><?php echo $welcome_message;?></textarea><br/>
                                <div class="text-right">
                                    <button onclick="submitWelcome()" class="btn btn-primary">Simpan</button>
                                    <button onclick="hapusWelcome()" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <label>Pesan Syarat dan Ketentuan</label><br/>
                                <textarea class="form-control" style="height:100px;" name="wm_text_syaratnketentuan" id="wm_text_syaratnketentuan" autofocus><?php echo $syaratnketentuan;?></textarea><br/>
                                <div class="text-right">
                                    <button onclick="submitSyaratNKetentuan()" class="btn btn-primary">Simpan</button>
                                    <button onclick="hapusSyaratNKetentuan()" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="form1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-status"></div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Tahun</label><br/>
                                                <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo date('Y');?>" min="<?php echo date('Y')-10;?>" max="<?php echo date('Y')+10;?>">

                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button onclick="tambahdata()" id="btn-tambah" class="btn btn-primary">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="form2" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-status-jurusan"></div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Kode Jurusan</label><br/>
                                                <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan" value="" >

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Nama Jurusan</label><br/>
                                                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">

                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button onclick="tambahdatajurusan()" id="btn-tambahjurusan" class="btn btn-primary">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					</div>
				</div>
			</div>
		</div>
</div>
</div>
<script type="text/javascript">
    $(function () {
        $('#tutup_ppdb').datetimepicker({
            // dateFormat: 'dd-mm-yy',
            //format:'MMMM DD, YYYY HH:mm:ss'
            dateFormat:'MM dd, yy'
        });

    });
</script>
<script src="<?php echo base_url();?>js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">

        tinyMCE.init({
            selector: "textarea.form-control",
            height: 100,
            max_height: 300,
            min_height: 100,
            menubar: false,
            statusbar:false,
            plugins: 'autoresize print preview searchreplace autolink directionality visualblocks visualchars fullscreen image media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help code',
            toolbar: 'image media alignleft alignright bullist numlist table removeformat  code codesample ',
            image_advtab: true,
            images_upload_url: '<?php echo base_url();?>admin/pengaturan/uploadfile',

            //relative_urls: true,
            relative_urls: false,
            remove_script_host: false,

            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {

                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '<?php echo base_url();?>admin/pengaturan/uploadfile');

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            }

        });


        function submitInstansi() {
            var instansi = $('#instansi').val();
            $.ajax({
                type: 'POST',
                data: 'instansi='+instansi,
                url: '<?php echo base_url(); ?>admin/pengaturan/simpandatainstansi',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function () {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }



        function submitTutupPPDB() {
            var tutupppdb = $('#tutup_ppdb').val();
            $.ajax({
                type: 'POST',
                data: 'tutupppdb='+tutupppdb,
                url: '<?php echo base_url(); ?>admin/pengaturan/simpandatatutupppdb',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function () {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }


        function submitTampilPeserta() {
            var tampilpeserta = $('#tampil_peserta').val();

            $.ajax({
                type: 'POST',
                data: 'tampilpeserta='+tampilpeserta,
                url: '<?php echo base_url(); ?>admin/pengaturan/simpandatatampilpeserta',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function () {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }


        function submitLambatKumpul() {
            var lambat_ppdb = $('#lambat_ppdb').val();

            $.ajax({
                type: 'POST',
                data: 'lambatppdb='+lambat_ppdb,
                url: '<?php echo base_url(); ?>admin/pengaturan/simpandatalambatppdb',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function () {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }


        function submitTanggalPPDB() {
            var tanggal_ppdb = $('#tanggal_ppdb').val();

            $.ajax({
                type: 'POST',
                data: 'tanggalppdb='+tanggal_ppdb,
                url: '<?php echo base_url(); ?>admin/pengaturan/simpandatatanggalppdb',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function () {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

        function submitWelcome(){

            var wm_text =  tinyMCE.get("wm_text").getContent();
            $.ajax({
                type:'POST',
                data: {
                    wm_text:wm_text,
                },
                url:'<?php echo base_url('admin/pengaturan/simpandatawelcomepessage') ;?>',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(hasil){
                    console.log(hasil);
                    $('#loading_ajax').fadeOut("slow");
                    $('.pesan').show();
                    $('.pesan').html('<p class="bg-warning">'+hasil.pesan+'</p>');

                    if(hasil.pesan == ''){
                        window.location.assign("<?php echo base_url();?>admin/pengaturan");
                    }
                }
            });
        }

        function hapusWelcome(){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau reset data?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url('admin/pengaturan/resetwelcome') ;?>',
                    success: function(){
                        $('#loading_ajax').fadeOut("slow");
                    }
                });
            }
        }


        function submitSyaratNKetentuan(){

            var wm_text =  tinyMCE.get("wm_text_syaratnketentuan").getContent();
            $.ajax({
                type:'POST',
                data: {
                    wm_text:wm_text,
                },
                url:'<?php echo base_url('admin/pengaturan/simpandatasyaratnketentuan') ;?>',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(hasil){
                    console.log(hasil);
                    $('#loading_ajax').fadeOut("slow");
                    $('.pesan').show();
                    $('.pesan').html('<p class="bg-warning">'+hasil.pesan+'</p>');

                    if(hasil.pesan == ''){
                        window.location.assign("<?php echo base_url();?>admin/pengaturan");
                    }
                }
            });
        }

        function hapusSyaratNKetentuan(){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau reset data?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url('admin/pengaturan/resetsyaratnketentuan') ;?>',
                    success: function(){
                        $('#loading_ajax').fadeOut("slow");
                    }
                });
            }
        }

		$('.panel-footer').hide();
		ajaxFilter();
		function ajaxFilter(){

			$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>admin/pengaturan/daftarta',
					dataType:'json',
					beforeSend: function () {
						$('#loading_ajax').show();
					},
					success: function (responseData) {
						//console.log(responseData);
						paginationDataDialogEdit(responseData);
						//$('#form1').modal('hide');
						$('#loading_ajax').fadeOut("slow");
						$('.panel-footer').fadeIn("slow");
					}
			});
		}

        ajaxFilterJurusan();
        function ajaxFilterJurusan(){

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/pengaturan/daftarjurusan',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function (responseData) {
                    console.log(responseData);
                    paginationDataDialogEditJurusan(responseData);
                    //$('#form1').modal('hide');
                    $('#loading_ajax').fadeOut("slow");
                    $('.panel-footer').fadeIn("slow");
                }
            });
        }

		function paginationDataDialogEdit(data) {
			$('#postListPengaturanTA tbody').empty();
			for(emp in data){
				var button_enable = '';
				var button_style = ' btn-default';

				if(data[emp].ta_aktif == 1){
				var button_enable = ' disabled';
					button_style = ' btn-success';

				}

				var empRow = '<tr>'+
							'<td class="text-center">'+data[emp].ta_tahun+'</td>'+
							'<td class="text-center"><div class="btn-group" role="group"><a onclick="republish('+data[emp].ta_id+')" class="btn btn-sm'+button_style+'"'+button_enable+'><span class="glyphicon glyphicon-ok"></span></a><a onclick="hapus('+data[emp].ta_id+')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></div></td>'+
							+'</tr>';
				$('#postListPengaturanTA tbody').append(empRow);
			}
		}

        function paginationDataDialogEditJurusan(data) {
            $('#postListPengaturanJurusan tbody').empty();
            for(emp in data){
                var kode_ = data[emp].jurusan_kode;
                var empRow = '<tr>'+
                    '<td class="text-center">'+data[emp].jurusan_kode+'</td>'+
                    '<td>'+data[emp].jurusan_nama+'</td>'+
                    '<td class="text-center"><div class="btn-group" role="group"><a onclick="hapusJurusan(\''+kode_+'\')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></div></td>'+
                    +'</tr>';

                $('#postListPengaturanJurusan tbody').append(empRow);
            }
        }

		function republish(id){
		    console.log(id);

			$.ajax({
					type: 'POST',
					data: 'id='+id,
					url: '<?php echo base_url(); ?>admin/pengaturan/republish',
					beforeSend: function () {
						$('#loading_ajax').show();
					},
					success: function (respon) {
						ajaxFilter();
						$('#loading_ajax').fadeOut("slow");

                        if(respon.pesan == '' ){
                            //window.location.assign("<?php echo base_url();?>auth/logout");
                        }
					}
			});
		}

		function tambahdata(){

			$('#btn-tambah').removeClass('btn-primary');
			$('#btn-tambah').addClass('btn-default');

			var tahun = $("[name='tahun']").val();

			$('#loading_ajax').show();

			$.ajax({
				type:'POST',
				data: {
					'tahun': tahun
				},
				url:'<?php echo base_url('admin/pengaturan/tambahdata') ;?>',
				dataType:'json',
				success: function(hasil){
					//console.log(hasil);

					$('#loading_ajax').fadeOut("slow");

					if(hasil.pesan == ''){
						$('#form1').modal('hide');
						ajaxFilter();
						$('#btn-tambah').removeClass('btn-default');
						$('#btn-tambah').addClass('btn-primary');

						//bersihkan form
					}else{
						$('#btn-tambah').removeClass('btn-default');
						$('#btn-tambah').addClass('btn-primary');

						$('.modal-status').show();
						$('.modal-status').html('<div class="alert alert-danger" role="alert">'+hasil.pesan+'</div>');

					}
				}
			});
		}

		function hapus(x){
			$('#loading_ajax').show();
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
				type:'POST',
				data: 'id='+x,
				url:'<?php echo base_url('admin/pengaturan/hapusdatabyid') ;?>',
				success: function(){					
					ajaxFilter();
				}
			});
			}
		}



        function tambahdatajurusan(){

            $('#btn-tambahjurusan').removeClass('btn-primary');
            $('#btn-tambahjurusan').addClass('btn-default');

            var kode_jurusan = $("[name='kode_jurusan']").val();
            var nama_jurusan = $("[name='nama_jurusan']").val();

            $('#loading_ajax').show();

            $.ajax({
                type:'POST',
                data: {
                    'kode_jurusan': kode_jurusan,
                    'nama_jurusan': nama_jurusan
                },
                url:'<?php echo base_url('admin/pengaturan/tambahdatajurusan') ;?>',
                dataType:'json',
                success: function(hasil){
                    //console.log(hasil);

                    $('#loading_ajax').fadeOut("slow");

                    if(hasil.pesan == ''){
                        $('#form1').modal('hide');
                        ajaxFilterJurusan();
                        $('#btn-tambahjurusan').removeClass('btn-default');
                        $('#btn-tambahjurusan').addClass('btn-primary');

                        //bersihkan form
                    }else{
                        $('#btn-tambahjurusan').removeClass('btn-default');
                        $('#btn-tambahjurusan').addClass('btn-primary');

                        $('.modal-status-jurusan').show();
                        $('.modal-status-jurusan').html('<div class="alert alert-danger" role="alert">'+hasil.pesan+'</div>');

                    }
                }
            });
        }


        function hapusJurusan(x){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau hapus data?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    data: 'id='+x,
                    url:'<?php echo base_url('admin/pengaturan/hapusdatajurusanbyid') ;?>',
                    success: function(){
                        ajaxFilterJurusan();
                    }
                });
            }
        }

        function  resetDataAll() {

            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau hapus semua data?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url('admin/pengaturan/resetdataall') ;?>',
                    beforeSend: function () {
                        $('#loading_ajax').show();
                    },
                    success: function(respon){
                        $('#loading_ajax').fadeOut("slow");

                        if(respon.pesan == '' ){
                            window.location.assign("<?php echo base_url();?>auth/logout");
                        }
                    }
                });
            }


        }
	</script>