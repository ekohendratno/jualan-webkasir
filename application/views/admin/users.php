<div class="container">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>DATA ANGGOTA</b>
					</div>
					<div class="panel-body">

						
						<div class="row">
									<div class="col-md-4">
										<input class="form-control" type="text" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()"/>
									</div>
									<div class="col-md-4">										
										<a href="#form3" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-filter"></span> Filter</a>
										<a href="<?php echo base_url(). "index.php/admin/users/index"; ?>" class="btn btn-primary">Show All</a>
									</div>
									<div class="col-md-4 text-right">
										<a href="#form0" onClick="submit('tambah')"  data-toggle="modal" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah Anggota
										</a>
										<a href="#form1" data-toggle="modal" class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-print"></span> Buat Kartu</a>
									</div>
						</div>
						<br/>
						<table id='postList' class="table table-striped table-hover table-bordered">
									<thead>				
										<tr>
											<th class="text-center" width="15">NO</th>
											<th class="text-center">FOTO</th>
											<th>NAMA</th>
											<th class="text-center">JK</th>
											<th class="text-center" width="100"><span class="glyphicon glyphicon-cog"></span></th>
										</tr>
									</thead>
									<tbody></tbody>		
						</table>
						<div id='pagination'></div>

						<div class="modal fade" id="form0" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div class="row">
										<div class="col-md-12">
											
											<label>Nama</label><br/>
											<input type="hidden" class="form-control" name="id">
											<input type="text" class="form-control" name="user_nama">
											
										</div>
										<div class="col-md-12">
											
											<label>Alamat</label><br/>
											<input type="text" class="form-control" name="user_alamat">
											
										</div>
										<div class="col-md-3">
											
											<label>Level</label><br/>
											<select class="form-control"  name="user_level">
											<option value="siswa">Siswa</option>
											<option value="guru">Guru</option>
											</select>
											
										</div>
										<div class="col-md-3">
											
											<label>Jenis Kelamin</label><br/>
											<select class="form-control"  name="user_jk">
											<option value="P">P</option>
											<option value="L">L</option>
											</select>
											
										</div>
										<div class="col-md-6">
											
											<label>NPS (Nomor Perpus Siswa)</label><br/>
											<input disabled type="text" class="form-control" name="user_nps">
											<input type="hidden" class="form-control" name="user_nps_tahun">
											<input type="hidden" class="form-control" name="user_nps_urutan">
											
										</div>
										<div class="col-md-2">
											
											<label>Kelas</label><br/>
											<select class="form-control"  name="kelas">
											<option value="x" selected>X</option>
											<option value="xi">XI</option>
											<option value="xii">XII</option>
											</select>
											
										</div>
										<div class="col-md-8">
											
											<label>Jurusan</label><br/>
											<select class="form-control"  name="jurusan_id">
												<option value="0">Semua Jurusan</option>
												<?php foreach($jurusan as $item ){?>
												<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
												<?php }?>
											</select>
											
										</div>
										<div class="col-md-2">
											
											<label>Ruang</label><br/>
											<select class="form-control"  name="ruang">		
											<option value="1" selected>1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											</select>
											
										</div>
										<div class="col-md-3">
											
											<label>Status Anggota</label><br/>
											<select class="form-control"  name="panding">
											<option value="0">Aktif</option>		
											<option value="1">Nonaktif</option>
											</select>
											
										</div>
										</div>
										
										<div class="clear"></div>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  <button onclick="tambahdata()" type="button" id="btn-tambah" class="btn btn-primary">Tambah</button> <button onclick="simpandata()" type="button" id="btn-ubah" class="btn btn-primary">Ubah</button> 
									</div>
								</div>
							</div>	
						</div>
						
						
						<div class="modal fade" id="form1" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div class="row">
										<div class="col-md-2">
											
											<label>Level</label><br/>
											<select class="form-control"  id="datalevel">
											<option value="siswa">Siswa</option>
											<option value="guru">Guru</option>
											</select>
											
										</div>
										<div class="col-md-2">
											
											<label>Kelas</label><br/>
											<select class="form-control"  id="datakelas">
											<option value="x">X</option>
											<option value="xi">XI</option>
											<option value="xii">XII</option>
											</select>
											
										</div>
										<div class="col-md-6">
											
											<label>Jurusan</label><br/>
											<select class="form-control"  id="datajurusan">		
												<?php foreach($jurusan as $item ){?>
												<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
												<?php }?>
											</select>
											
										</div>
										<div class="col-md-2">
											
											<label>Ruang</label><br/>
											<select class="form-control"  id="dataruang">		
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											</select>
											
										</div>
										</div>
										
										<div class="clear"></div>
									</div>
									<div class="modal-footer">
									  <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									  <a href="#" onclick="cetak()" class="btn btn-danger">Cetak</a> 
									</div>
								</div>
							</div>	
						</div>
					
						
						<div class="modal fade" id="form3" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-body">
										<div class="row">
											
											
										<div class="col-md-2">
											<label for="sortBy">Urutkan</label><br/>
											<select class="form-control"  id="sortBy" onchange="searchFilter()">
												<option value="">Sort By</option>
												<option value="asc">Ascending</option>
												<option value="desc">Descending</option>
											</select>
										</div>
										<div class="col-md-1">
											<label for="limitBy">Limit</label><br/>
											<select class="form-control"  id="limitBy" onchange="searchFilter()">
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="200">200</option>
											</select>
										</div>
										<div class="col-md-2">
											<label for="levelBy">Level</label><br/>
											<select class="form-control"  id="levelBy" onchange="searchFilter()">
												<option value="siswa">Siswa</option>
												<option value="guru">Guru</option>
												<option value="admin">Admin</option>
											</select>
										</div>
										<div class="col-md-1">
											<label for="kelasBy">Kelas</label><br/>
											<select class="form-control"  id="kelasBy" onchange="searchFilter()">
												<option value="">Semua Kelas</option>
												<option value="x">X</option>
												<option value="xi">XI</option>
												<option value="xii">XII</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="jurusanBy">Jurusan</label><br/>
											<select class="form-control"  id="jurusanBy" onchange="searchFilter()">
												<option value="0">Semua Jurusan</option>
												<?php foreach($this->m->getdata('jurusan') as $item ){?>
												<option value="<?php echo $item->jurusan_id?>"><?php echo $item->jurusan_title?></option>
												<?php }?>
											</select>
										</div>
											
										<div class="clear"></div>
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
		$(document).ready(function(){
			$(".selector").keyup(function(){ // Ketika user menekan tombol di keyboard
				if(event.keyCode == 13){ // Jika user menekan tombol ENTER
				   // Panggil function search
					$('#loading_ajax').show();
				}
			  });
			$(".selector").autocomplete({
				source: "<?php echo base_url()?>index.php/admin/users/autocompleteData",
				minLength: 1,
				select: function(event, ui) {
					$(".selector").val(ui.item.value);
					$("#siswa_id").val(ui.item.id);
				}
			}).data("ui-autocomplete")._renderItem = function( ul, item ) {
			return $( "<li class='ui-autocomplete-row'></li>" )
				.data( "item.autocomplete", item )
				.append( item.label )
				.appendTo( ul );
			};
		});
		
		searchFilter(0);
		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var limitBy = $('#limitBy').val();
			var levelBy = $('#levelBy').val();
			var jurusanBy = $('#jurusanBy').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/admin/users/ajaxPaginationData/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&levelBy='+levelBy+'&jurusanBy='+jurusanBy,
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax').show();
				},
				success: function (responseData) {
					//console.log(responseData);
					$('#pagination').html(responseData.pagination);
					paginationData(responseData.empData);
					$('#loading_ajax').fadeOut("slow");
				}
			});
		}
		
		function paginationData(data) {
			$('#postList tbody').empty();
			var nomor = 1;
			for(emp in data){
								
				var kelas = data[emp].kelas;
				var level  = data[emp].user_level;
				
				
				
				var sex = '';
					
				if(data[emp].user_jk == 'L'){
					sex = '<span class="label label-success">L</span>';				   
				}else if(data[emp].user_jk == 'P'){
					sex = '<span class="label label-warning">P</span>';				   
				}
				
				
				var empRow = '<tr>'+
							'<td class="text-center">'+nomor+'</td>'+
							'<td><center><img src="'+data[emp].user_foto+'" style="width: 80px;"/><br/><br/><img src="<?php echo base_url('admin/buku/barcode?code=');?>'+data[emp].user_nps+'" /></center></td>'+
							'<td>'+data[emp].user_nama+'<br/><span class="label label-default">'+kelas.toUpperCase()+'</span> <span class="label label-default">'+data[emp].jurusan_title+'</span> <span class="label label-default">'+data[emp].ruang+'</span><br/><span class="label label-success">'+data[emp].user_nps+'</span><br/>'+data[emp].user_alamat+'</td>'+
							'<td class="text-center">'+sex+'</td>'+
							'<td class="text-center"><div class="btn-group" role="group"><a href="#form0" data-toggle="modal" onclick="submit('+data[emp].user_id+')" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span></a> <a onclick="hapus('+data[emp].user_id+')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></div></td>'+
							+'</tr>';
				nomor++;
				$('#postList tbody').append(empRow);					
			}
		}
		
		function tambahdata(){
			
			var user_level =  $("[name='user_level']").val();	
			var user_nps =  $("[name='user_nps']").val();	
			var user_nps_tahun =  $("[name='user_nps_tahun']").val();				
			var user_nps_urutan =  $("[name='user_nps_urutan']").val();
			var user_nama =  $("[name='user_nama']").val();
			var user_jk =  $("[name='user_jk']").val();
			var user_alamat =  $("[name='user_alamat']").val();
			var kelas =  $("[name='kelas']").val();
			var jurusan_id =  $("[name='jurusan_id']").val();
			var ruang =  $("[name='ruang']").val();
			var panding =  $("[name='panding']").val();
			
			$.ajax({
				type:'POST',
				data: 'user_level='+user_level+'&user_nps='+user_nps+'&user_nps_tahun='+user_nps_tahun+'&user_nps_urutan='+user_nps_urutan+'&user_nama='+user_nama+'&user_jk='+user_jk+'&user_alamat='+user_alamat+'&kelas='+kelas+'&jurusan_id='+jurusan_id+'&ruang='+ruang+'&panding='+panding,
				url:'<?php echo base_url('index.php/admin/users/tambahdata') ;?>',
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax').show();
				},
				success: function(hasil){
					$('#loading_ajax').fadeOut("slow");
					
					$('.modal-status').show();
					$('.modal-status').html('<p class="bg-warning">'+hasil.pesan+'</p>');
					
					if(hasil.pesan == ''){
						$('#form0').modal('hide');
						searchFilter(0);

						//bersihkan form
						$("[name='user_level']").val('');
						$("[name='user_nps']").val('');
						$("[name='user_nps_tahun']").val('');
						$("[name='user_nps_urutan']").val('');
						$("[name='user_nama']").val('');
						$("[name='user_jk']").val('');
						$("[name='user_alamat']").val('');
						$("[name='kelas']").val('');
						$("[name='jurusan_id']").val('');
						$("[name='ruang']").val('');
						$("[name='panding']").val(0);
					}
				}
			});
		}
		
		function submit(x){
			//bersihkan form
			$("[name='user_level']").val('');
			$("[name='user_nps']").val('');	
			$("[name='user_nps_tahun']").val('');				
			$("[name='user_nps_urutan']").val('');
			$("[name='user_nama']").val('');
			$("[name='user_jk']").val('');
			$("[name='user_alamat']").val('');
			$("[name='kelas']").val('');
			$("[name='jurusan_id']").val('');
			$("[name='ruang']").val('');
			$("[name='panding']").val(0);
			
			$('.modal-status').hide();
			if(x == 'tambah'){
				$('#btn-tambah').show();
				$('#btn-ubah').hide();
				
				$.ajax({
					type:'POST',
					url:'<?php echo base_url('index.php/admin/users/generateNomorPerpus') ;?>',
					dataType:'json',
					success: function(hasil){
						console.log(hasil);
						$('#loading_ajax').fadeOut("slow");
						
						$("[name='user_nps']").val(hasil.user_nps);				
						$("[name='user_nps_tahun']").val(hasil.user_nps_tahun);				
						$("[name='user_nps_urutan']").val(hasil.user_nps_urutan);
					}
				});
			}else{
				$('#loading_ajax').show();	
				$('#btn-tambah').hide();
				$('#btn-ubah').show();
				
				
				$.ajax({
					type:'POST',
					data: 'id='+x,
					url:'<?php echo base_url('index.php/admin/users/ambildatabyid') ;?>',
					dataType:'json',
					success: function(hasil){
						console.log(hasil);
						$('#loading_ajax').fadeOut("slow");
						
						$("[name='id']").val(hasil.user_id);
						$("[name='user_level']").val(hasil.user_level);
						$("[name='user_nps']").val(hasil.user_nps);
						$("[name='user_nps_tahun']").val(hasil.user_nps_tahun);				
						$("[name='user_nps_urutan']").val(hasil.user_nps_urutan);
						$("[name='user_nama']").val(hasil.user_nama);
						$("[name='user_jk']").val(hasil.user_jk);
						$("[name='user_alamat']").val(hasil.user_alamat);
						$("[name='kelas']").val(hasil.kelas);
						$("[name='jurusan_id']").val(hasil.jurusan_id);
						$("[name='ruang']").val(hasil.ruang);
						$("[name='panding']").val(hasil.panding);
						
						if(hasil.user_foto != ''){
							$("#avatar").show();
							$("#avatar").append('<img src="'+hasil.user_foto+'" style="border:1px solid #ddd; width: 120px;"/>');
						}
					}
				});
			}
		}
		
		function simpandata(){
			$('#loading_ajax').show();	
			var id =  $("[name='id']").val();	
			
			var user_level =  $("[name='user_level']").val();	
			var user_nama =  $("[name='user_nama']").val();
			var user_jk =  $("[name='user_jk']").val();
			var user_alamat =  $("[name='user_alamat']").val();
			var kelas =  $("[name='kelas']").val();
			var jurusan_id =  $("[name='jurusan_id']").val();
			var ruang =  $("[name='ruang']").val();
			var panding =  $("[name='panding']").val();
			
			
			$.ajax({
				type:'POST',
				data: 'id='+id+'&user_level='+user_level+'&user_nama='+user_nama+'&user_jk='+user_jk+'&user_alamat='+user_alamat+'&kelas='+kelas+'&jurusan_id='+jurusan_id+'&ruang='+ruang+'&panding='+panding,
				url:'<?php echo base_url('index.php/admin/users/simpandatabyid') ;?>',
				dataType:'json',
				success: function(hasil){
					console.log(hasil);
					
					$('#loading_ajax').fadeOut("slow");
					$('.modal-status').show();
					$('.modal-status').html('<p class="bg-warning">'+hasil.pesan+'</p>');
					
					if(hasil.pesan == ''){
						$('#form0').modal('hide');
						searchFilter();
					}
				}
			});
		}
	
		
		function cetak(){
			
			var kelas_sekarang = $('#datakelas').val();		
			var jurusan_id = $('#datajurusan').val();		
			var ruang = $('#dataruang').val();	
			
			window.open("<?php echo base_url();?>index.php/admin/users/cetak?kelas="+kelas_sekarang+"&jurusan_id="+jurusan_id+"&ruang="+ruang,'_blank'); 
			
		}
		
		function hapus(x){
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
				type:'POST',
				data: 'id='+x,
				url:'<?php echo base_url('index.php/admin/users/hapusdatabyid') ;?>',
				success: function(){					
					searchFilter(0);
				}
			});
			}else{				
				$('#loading_ajax').fadeOut("slow");	
			}
		}
	
	</script>