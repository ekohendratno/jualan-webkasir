<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><i class='fa fa-file fa-fw'></i> Laporan Penjualan</h5>
            <hr />

            <div class="row">
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                            <div class="col-sm-8">
                                <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                            <div class="col-sm-8">
                                <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="button" id="LihatDetailLaporan" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br />
            <div id='result'></div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#LihatDetailLaporan', function(e){
        e.preventDefault();
        var tanggal_dari = $("#tanggal_dari").val();
        var tanggal_sampai = $("#tanggal_sampai").val();

        $('#result').load("<?php echo site_url('admin/laporan/detail'); ?>", {from: tanggal_dari,to:tanggal_sampai});
    });
</script>