
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> Data Pelanggan</h5>
            <hr />

            <div class='table-responsive'>
                <link rel="stylesheet" href="<?php echo config_item('plugin'); ?>datatables/css/dataTables.bootstrap.css"/>
                <table id="my-grid" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telp. / HP</th>
                        <th>Info Tambahan</th>
                        <th>Waktu Input</th>
                        <th class='no-sort'>Edit</th>
                        <th class='no-sort'>Hapus</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>