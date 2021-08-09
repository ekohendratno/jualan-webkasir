
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> Data Pelanggan
                <a href='#formDialog' data-toggle='modal' onClick='formDialog(0)' class='btn btn-success btn-sm pull-right panel-title-button'><i class='fa fa-plus fa-fw'></i> Tambah Pelanggan</a></h5>
            <hr />

            <div class='table-responsive'>
                <table id="my-grid" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telp. / HP</th>
                        <th>Info Tambahan</th>
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
                <h4 class="modal-title">Pelanggan</h4>
            </div>
            <div class="modal-status"></div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID Pelanggan <span style="color: red">*</span> :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="pelanggan_nama" id="pelanggan_nama" placeholder="Masukan ID Pelanggan" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Nama Lengkap" id="pelanggan_namalengkap" name="pelanggan_namalengkap" maxlength="30" minlength="3" value="" />
                        </div>
                        <div class="form-group">
                            <label>Alamat <span style="color: red">*</span> :</label>
                            <textarea  class="form-control" placeholder="Masukkan Alamat" id="pelanggan_alamat" name="pelanggan_alamat" ></textarea>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>No. Telp <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Nomor Telp" id="pelanggan_notelp" name="pelanggan_notelp" type="tel" />
                        </div>
                        <div class="form-group">
                            <label>Info Tambahan <span style="color: red">*</span> :</label>
                            <input  class="form-control" placeholder="Masukkan Info" id="pelanggan_lainnya" name="pelanggan_lainnya" type="text" />
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitSimpan()" type="button" class="btn btn-primary">Simpan</button>
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
                url :"<?php echo site_url('admin/penjualan/pelanggan_data'); ?>",
                type: "post",
                error: function(){
                    $(".my-grid-error").html("");
                    $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#my-grid_processing").css("display","none");
                }
            }
        } );


        $( "#pelanggan_nama" ).autocomplete({
            source: "<?php echo site_url('admin/penjualan/pelanggan_nama/?');?>"
        });
    });

    function formDialog(id) {
        $('#id').val("");
        $('#pelanggan_nama').val("");
        $('#pelanggan_namalengkap').val("");
        $('#pelanggan_notelp').val("");
        $('#pelanggan_alamat').val("");
        $('#pelanggan_lainnya').val("");

        if(id > 0){

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/penjualan/pelanggan_ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#id').val(id);
                    $('#pelanggan_nama').val(data.pelanggan_nama);
                    $('#pelanggan_namalengkap').val(data.pelanggan_namalengkap);
                    $('#pelanggan_notelp').val(data.pelanggan_notelp);
                    $('#pelanggan_alamat').val(data.pelanggan_alamat);
                    $('#pelanggan_lainnya').val(data.pelanggan_lainnya);
                }
            });
        }

    }


    function submitSimpan(){
        var FormData = "id="+$('#id').val();
        FormData += "&pelanggan_nama="+$('#pelanggan_nama').val();
        FormData += "&pelanggan_namalengkap="+$('#pelanggan_namalengkap').val();
        FormData += "&pelanggan_notelp="+$('#pelanggan_notelp').val();
        FormData += "&pelanggan_alamat="+$('#pelanggan_alamat').val();
        FormData += "&pelanggan_lainnya="+$('#pelanggan_lainnya').val();

        $.ajax({
            url: "<?php echo site_url('admin/penjualan/pelanggan_simpan'); ?>",
            type: "POST",
            cache: false,
            data: FormData,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    alert(data.pesan);
                    window.location.href="<?php echo site_url('admin/penjualan/pelanggan'); ?>";
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
                url:'<?php echo base_url('admin/penjualan/pelanggan_hapus') ;?>',
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