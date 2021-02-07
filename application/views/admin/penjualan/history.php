<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> History Penjualan
                <a href='<?php echo base_url();?>admin/penjualan/transaksi' class='btn btn-success btn-sm pull-right panel-title-button'><i class='fa fa-plus fa-fw'></i> Buat Transaksi</a></h5>
            <hr />

            <div class='table-responsive'>
                <table id="my-grid" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nomor Nota</th>
                        <th>Grand Total</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Kasir</th>
                        <th style="width: 10%" class="no-sort text-center"><i class='fa fa-cog fa-fw'></i></th>
                    </tr>
                    </thead>
                </table>
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
                url :"<?php echo site_url('admin/penjualan/data'); ?>",
                type: "post",
                error: function(){
                    $(".my-grid-error").html("");
                    $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#my-grid_processing").css("display","none");
                }
            }
        } );
    });

    $(document).on('click', '#LihatDetailTransaksi', function(e){
        e.preventDefault();
        var CaptionHeader = 'Transaksi Nomor Nota :' + $(this).text();
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg');
        $('#ModalHeader').html(CaptionHeader);
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Tutup</button>");
        $('#ModalGue').modal('show');
    });

    function formDialog(id) {
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
        if(id > 0){
            $('#btn-tambah').hide();
            $('#btn-ubah').show();
        }

    }

    function submitEdit(id) {

    }

    function submitHapus(id) {

    }
</script>