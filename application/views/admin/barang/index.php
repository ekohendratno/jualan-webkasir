<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-cube fa-fw'></i> Barang <i class='fa fa-angle-right fa-fw'></i> Semua Barang
            <a href='#formDialog' data-toggle='modal' onClick='formDialog(0)' class='btn btn-success btn-sm pull-right panel-title-button'><i class='fa fa-plus fa-fw'></i> Tambah Barang</a></h5>
            <hr />

            <div class='table-responsive'>
                <table id="my-grid" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Berat (gr)</th>
                        <th>Merek</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th style="width: 10%" class="no-sort text-center"><i class='fa fa-cog fa-fw'></i></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="formDialog" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Barang</h4>
            </div>
            <div class="modal-status"></div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Barang <span style="color: red">*</span> :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="barang_kode" id="barang_kode" placeholder="Masukan Kode" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Nama Barang" id="barang_nama" name="barang_nama" maxlength="30" minlength="3" value="" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span style="color: red">*</span> :</label>
                            <textarea  class="form-control" placeholder="Masukkan Keterangan" id="barang_keterangan" name="barang_keterangan" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kategori <span style="color: red">*</span> :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="barang_kategori" id="barang_kategori" placeholder="Masukan Kategori" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merek <span style="color: red">*</span> :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="barang_merek" id="barang_merek" placeholder="Masukan Merek" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">


                        <div class="form-group">
                            <label>Berat <span style="color: red">*</span> (gr):</label>
                            <input  class="form-control" placeholder="Masukkan Berat" id="barang_berat" name="barang_berat" value="0" type="number" />
                        </div>
                        <div class="form-group">
                            <label>Stok <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Stok" id="barang_stok" name="barang_stok" value="0" type="number" />
                        </div>
                        <div class="form-group">
                            <label>Harga <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Harga" id="barang_harga" name="barang_harga" value="0" type="number" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Barang Masuk <span style="color: red">*</span> :</label>
                            <input class="form-control" id="barang_tanggal_masuk" type="date" name="barang_tanggal_masuk" value="<?php echo date("Y-m-d");?>"  />
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitSimpan()" type="button"  class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" >
    $(document).ready(function() {
        var dataTable = $('#my-grid').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Pencarian : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;Data Per Halaman <?php //echo $tambahan; ?>",
                "sInfo": "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
                "sInfoFiltered": "(difilter dari _MAX_ total data)",
                "sZeroRecords": "Pencarian tidak ditemukan",
                "sEmptyTable": "Data kosong",
                "sLoadingRecords": "Harap Tunggu...",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 0, "desc" ]],
            "columnDefs": [
                {
                    "targets": 'no-sort',
                    "orderable": false,
                }
            ],
            "sPaginationType": "simple_numbers",
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url :"<?php echo site_url('admin/barang/data'); ?>",
                type: "post",
                error: function(){
                    $(".my-grid-error").html("");
                    $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#my-grid_processing").css("display","none");
                }
            }
        } );

        $( "#barang_kategori" ).autocomplete({
            source: "<?php echo site_url('admin/barang/data1/?');?>"
        });
        $( "#barang_merek" ).autocomplete({
            source: "<?php echo site_url('admin/barang/data2/?');?>"
        });
        $( "#barang_kode" ).autocomplete({
            source: "<?php echo site_url('admin/barang/data3/?');?>"
        });
    });

    function formDialog(id) {
        $('#id').val("");
        $('#barang_kode').val("");
        $('#barang_nama').val("");
        $('#barang_berat').val("");
        $('#barang_stok').val("");
        $('#barang_harga').val("");
        $('#barang_kategori').val("");
        $('#barang_merek').val("");
        $('#barang_keterangan').val("");

        if(id > 0){

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/barang/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#id').val(id);
                    $('#barang_kode').val(data.barang_kode);
                    $('#barang_nama').val(data.barang_nama);
                    $('#barang_berat').val(data.barang_berat);
                    $('#barang_stok').val(data.barang_stok);
                    $('#barang_harga').val(data.barang_harga);
                    $('#barang_kategori').val(data.barang_kategori);
                    $('#barang_merek').val(data.barang_merek);
                    $('#barang_keterangan').val(data.barang_keterangan);
                }
            });
        }

    }


    function submitSimpan(){
        var FormData = "id="+$('#id').val();
        FormData += "&barang_kode="+$('#barang_kode').val();
        FormData += "&barang_nama="+$('#barang_nama').val();
        FormData += "&barang_berat="+$('#barang_berat').val();
        FormData += "&barang_stok="+$('#barang_stok').val();
        FormData += "&barang_harga="+$('#barang_harga').val();
        FormData += "&barang_kategori="+$('#barang_kategori').val();
        FormData += "&barang_merek="+$('#barang_merek').val();
        FormData += "&barang_keterangan="+$('#barang_keterangan').val();
        FormData += "&barang_tanggal_masuk="+$('#barang_tanggal_masuk').val();

        $.ajax({
            type:'POST',
            data: FormData,
            url:'<?php echo base_url('index.php/admin/barang/simpan') ;?>',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            },
            success: function(data){
                if(data.status == 1)
                {
                    alert(data.pesan);
                    window.location.href="<?php echo site_url('admin/barang'); ?>";
                }
                else
                {
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('#ModalHeader').html('Oops !');
                    $('#ModalContent').html(data.pesan);
                    $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
                    $('#ModalGue').modal('show');
                }
            }
        });
    }


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+id,
                url:'<?php echo base_url('admin/barang/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#Notifikasi').html(data.pesan);
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    $('#my-grid').DataTable().ajax.reload( null, false );
                }
            });
        }
    }
</script>