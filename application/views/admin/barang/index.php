<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-cube fa-fw'></i> Barang <i class='fa fa-angle-right fa-fw'></i> Semua Barang
            <a href='#formDialog' data-toggle='modal' onClick='formDialog(0)' class='btn btn-success btn-sm pull-right panel-title-button'><i class='fa fa-plus fa-fw'></i> Tambah Data</a></h5>
            <hr />

            <div class='table-responsive'>
                <table id="my-grid" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Berat</th>
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
                            <textarea  class="form-control" placeholder="Masukkan Keterangan" id="barang_marek" name="barang_marek" ></textarea>
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
                                <input class="form-control" type="text" name="barang_marek" id="barang_marek" placeholder="Masukan Merek" value="" />
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
                            <input class="form-control" id="barang_nama" type="date" name="barang_nama" value="<?php echo date("Y-m-d");?>"  />
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitTambah()" type="button" id="btn-tambah" class="btn btn-primary">Tambah</button> <button onclick="submitEdit()" type="button" id="btn-ubah" class="btn btn-primary">Simpan</button>
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