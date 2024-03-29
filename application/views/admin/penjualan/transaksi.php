
<div class="container-fluid">
    <div class="panel panel-default">
        <a href='<?php echo base_url();?>admin/penjualan' class='btn btn-default btn-sm pull-right panel-title-button'><i class='fa fa-eye fa-fw'></i> Lihat Daftar Transaksi</a>
        <div class="panel-body">

            <div class='row'>
                <div class='col-sm-3'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Informasi Nota</div>
                        <div class="panel-body">

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No. Nota</label>
                                    <div class="col-sm-8">
                                        <input type='text' name='nomor_nota' class='form-control input-sm' id='nomor_nota' value="<?php echo strtoupper(uniqid()).$this->session->userdata('ap_id_user'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input type='text' name='tanggal' class='form-control input-sm' id='tanggal' value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kasir</label>
                                    <div class="col-sm-8">
                                        <select name='id_kasir' id='id_kasir' class='form-control input-sm' <?php echo $disabled; ?>>
                                            <option value=''></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class="panel panel-primary" id='PelangganArea'>
                        <div class="panel-heading">Informasi Pelanggan</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label>Pelanggan</label>
                                <a href="<?php echo site_url('penjualan/tambah-pelanggan'); ?>" class='pull-right' id='TambahPelanggan'>Tambah Baru ?</a>
                                <select name='id_pelanggan' id='id_pelanggan' class='form-control input-sm' style='cursor: pointer;'>
                                    <option value='umum'>-- Umum --</option>
                                </select>
                            </div>

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Telp / HP</label>
                                    <div class="col-sm-8">
                                        <div id='telp_pelanggan'><small><i>Tidak ada</i></small></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <div id='alamat_pelanggan'><small><i>Tidak ada</i></small></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Info Lain</label>
                                    <div class="col-sm-8">
                                        <div id='info_tambahan_pelanggan'><small><i>Tidak ada</i></small></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class='col-sm-9'>
                    <h5><i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> Transaksi</h5>
                    <hr />
                    <table class='table table-bordered' id='TabelTransaksi'>
                        <thead>
                        <tr>
                            <th style='width:35px;'>#</th>
                            <th style='width:210px;'>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th style='width:120px;'>Harga</th>
                            <th style='width:75px;'>Qty</th>
                            <th style='width:125px;'>Sub Total</th>
                            <th style='width:40px;'></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class='alert alert-info TotalBayar'>
                        <button id='BarisBaru' class='btn btn-default pull-left'><i class='fa fa-plus fa-fw'></i> Baris Baru (F7)</button>
                        <h2>Total : <span id='TotalBayar'>Rp. 0</span></h2>
                        <input type="hidden" id='TotalBayarHidden'>
                    </div>

                    <div class='row'>
                        <div class='col-sm-7'>
                            <textarea name='catatan' id='catatan' class='form-control' rows='2' placeholder="Catatan Transaksi (Jika Ada)" style='resize: vertical; width:83%;'></textarea>

                            <br />
                            <p><i class='fa fa-keyboard fa-fw'></i> <b>Shortcut Keyboard : </b></p>
                            <div class='row'>
                                <div class='col-sm-6'>F7 = Tambah baris baru</div>
                                <div class='col-sm-6'>F9 = Cetak Struk</div>
                                <div class='col-sm-6'>F8 = Fokus ke field bayar</div>
                                <div class='col-sm-6'>F10 = Simpan Transaksi</div>
                            </div>
                        </div>
                        <div class='col-sm-5'>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Bayar (F8)</label>
                                    <div class="col-sm-6">
                                        <input onchange="todesimal(this.value)" onkeyup="todesimal(this.value)" type='text' name='cash' id='UangCash' class='form-control'>
                                        <input type='hidden' name='cashhide' id='UangCashHide' onchange='return check_int(event)'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Kembali</label>
                                    <div class="col-sm-6">
                                        <input type='text' id='UangKembali' class='form-control' disabled>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-6' style='padding-right: 0px;'>
                                        <button type='button' class='btn btn-warning btn-block' id='CetakStruk'>
                                            <i class='fa fa-print'></i> Cetak (F9)
                                        </button>
                                    </div>
                                    <div class='col-sm-6'>
                                        <button type='button' class='btn btn-primary btn-block' id='Simpann'>
                                            <i class='fa fa-save'></i> Simpan (F10)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                </div>
            </div>

        </div>
    </div>
</div>

<style type="text/css">

    #daftar-autocomplete {
        list-style:none;
        margin:0;
        padding:0;
        width:100%;
    }

    #daftar-autocomplete li {
        padding: 5px 10px 5px 10px;
        background:#FAFAFA;
        border-bottom:#ddd 1px solid;
    }

    #daftar-autocomplete li:hover,
    #daftar-autocomplete li.autocomplete_active {
        background:#2a84ae;
        color:#fff;
        cursor: pointer;
    }

    #hasil_pencarian{
        padding: 0px;
        display: none;
        position: absolute;
        max-height: 350px;
        overflow: auto;
        border:1px solid #ddd;
        z-index: 1;
    }


    .TotalBayar {
        text-align: right;
        margin-bottom: 20px;
    }

    .TotalBayar h2 {
        margin-top: 0px;
        margin-bottom: 0px;
    }
</style>

<script>
    $('#tanggal').datetimepicker({
        lang:'en',
        timepicker:true,
        format:'Y-m-d H:i:s'
    });

    $(document).ready(function(){

        for(B=1; B<=1; B++){
            BarisBaru();
        }

        $('#id_pelanggan').change(function(){
            if($(this).val() !== '')
            {
                $.ajax({
                    url: "<?php echo site_url('penjualan/ajax-pelanggan'); ?>",
                    type: "POST",
                    cache: false,
                    data: "id_pelanggan="+$(this).val(),
                    dataType:'json',
                    success: function(json){
                        $('#telp_pelanggan').html(json.telp);
                        $('#alamat_pelanggan').html(json.alamat);
                        $('#info_tambahan_pelanggan').html(json.info_tambahan);
                    }
                });
            }
            else
            {
                $('#telp_pelanggan').html('<small><i>Tidak ada</i></small>');
                $('#alamat_pelanggan').html('<small><i>Tidak ada</i></small>');
                $('#info_tambahan_pelanggan').html('<small><i>Tidak ada</i></small>');
            }
        });

        $('#BarisBaru').click(function(){
            BarisBaru();
        });

        $("#TabelTransaksi tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
    });

    function BarisBaru(){
        var Nomor = $('#TabelTransaksi tbody tr').length + 1;
        var Baris = "<tr>";
        Baris += "<td>"+Nomor+"</td>";
        Baris += "<td>";
        Baris += "<input type='text' class='form-control' name='kode_barang[]' id='pencarian_kode' placeholder='Ketik Kode / Nama Barang'>";
        Baris += "<div id='hasil_pencarian'></div>";
        Baris += "</td>";
        Baris += "<td></td>";
        Baris += "<td>";
        Baris += "<input type='hidden' name='harga_satuan[]'>";
        Baris += "<span></span>";
        Baris += "</td>";
        Baris += "<td><input min='1' type='number' class='form-control' id='jumlah_beli' name='jumlah_beli[]' onkeypress='return check_int(event)' disabled></td>";
        Baris += "<td>";
        Baris += "<input type='hidden' name='sub_total[]'>";
        Baris += "<span></span>";
        Baris += "</td>";
        Baris += "<td><button class='btn btn-default' id='HapusBaris'><i class='fa fa-times' style='color:red;'></i></button></td>";
        Baris += "</tr>";

        $('#TabelTransaksi tbody').append(Baris);

        $('#TabelTransaksi tbody tr').each(function(){
            $(this).find('td:nth-child(2) input').focus();
        });

        HitungTotalBayar();
    }

    $(document).on('click', '#HapusBaris', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();

        var Nomor = 1;
        $('#TabelTransaksi tbody tr').each(function(){
            $(this).find('td:nth-child(1)').html(Nomor);
            Nomor++;
        });

        HitungTotalBayar();
    });

    function AutoCompleteGue(Lebar, KataKunci, Indexnya)
    {
        $('div#hasil_pencarian').hide();
        var Lebar = Lebar + 25;

        var Registered = '';
        $('#TabelTransaksi tbody tr').each(function(){
            if(Indexnya !== $(this).index())
            {
                if($(this).find('td:nth-child(2) input').val() !== '')
                {
                    Registered += $(this).find('td:nth-child(2) input').val() + ',';
                }
            }
        });

        if(Registered !== ''){
            Registered = Registered.replace(/,\s*$/,"");
        }

        $.ajax({
            url: "<?php echo site_url('admin/penjualan/barang_kode'); ?>",
            type: "POST",
            cache: false,
            data:'keyword=' + KataKunci + '&registered=' + Registered,
            dataType:'json',
            success: function(json){
                if(json.status == 1)
                {
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').html(json.datanya);
                }
                if(json.status == 0)
                {
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').prop('disabled', true).val('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(0);
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html('');
                }
            }
        });

        HitungTotalBayar();
    }

    $(document).on('keyup', '#pencarian_kode', function(e){
        if($(this).val() !== '')
        {
            var charCode = e.which || e.keyCode;
            if(charCode == 40)
            {
                if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
                {
                    var Selanjutnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').next();
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');

                    Selanjutnya.addClass('autocomplete_active');
                }
                else
                {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                }
            }
            else if(charCode == 38)
            {
                if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
                {
                    var Sebelumnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').prev();
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');

                    Sebelumnya.addClass('autocomplete_active');
                }
                else
                {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                }
            }
            else if(charCode == 13)
            {
                var Field = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)');
                var Kodenya = Field.find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
                var Barangnya = Field.find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();
                var Harganya = Field.find('div#hasil_pencarian li.autocomplete_active span#harganya').html();

                Field.find('div#hasil_pencarian').hide();
                Field.find('input').val(Kodenya);

                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(3)').html(Barangnya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) input').val(Harganya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) span').html(to_rupiah(Harganya));
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').removeAttr('disabled').val(1);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) input').val(Harganya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) span').html(to_rupiah(Harganya));

                var IndexIni = $(this).parent().parent().index() + 1;
                var TotalIndex = $('#TabelTransaksi tbody tr').length;
                if(IndexIni == TotalIndex){
                    BarisBaru();

                    $('html, body').animate({ scrollTop: $(document).height() }, 0);
                }
                else {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').focus();
                }
            }
            else
            {
                AutoCompleteGue($(this).width(), $(this).val(), $(this).parent().parent().index());
            }
        }
        else
        {
            $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian').hide();
        }

        HitungTotalBayar();
    });

    $(document).on('click', '#daftar-autocomplete li', function(){
        $(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());

        var Indexnya = $(this).parent().parent().parent().parent().index();
        var NamaBarang = $(this).find('span#barangnya').html();
        var Harganya = $(this).find('span#harganya').html();

        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').hide();
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html(NamaBarang);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val(Harganya);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html(to_rupiah(Harganya));
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').removeAttr('disabled').val(1);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(Harganya);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(to_rupiah(Harganya));

        var IndexIni = Indexnya + 1;
        var TotalIndex = $('#TabelTransaksi tbody tr').length;
        if(IndexIni == TotalIndex){
            BarisBaru();
            $('html, body').animate({ scrollTop: $(document).height() }, 0);
        }
        else {
            $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').focus();
        }

        HitungTotalBayar();
    });

    $(document).on('change', '#jumlah_beli', function(){
        var Indexnya = $(this).parent().parent().index();
        var Harga = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val();
        var JumlahBeli = $(this).val();
        var KodeBarang = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2) input').val();

        $.ajax({
            url: "<?php echo site_url('admin/barang/stok'); ?>",
            type: "POST",
            cache: false,
            data: "kode="+encodeURI(KodeBarang)+"&stok="+JumlahBeli,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    var SubTotal = parseInt(Harga) * parseInt(JumlahBeli);
                    if(SubTotal > 0){
                        var SubTotalVal = SubTotal;
                        SubTotal = to_rupiah(SubTotal);
                    } else {
                        SubTotal = '';
                        var SubTotalVal = 0;
                    }

                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(SubTotalVal);
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(SubTotal);
                    HitungTotalBayar();
                }
                if(data.status == 0)
                {
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('#ModalHeader').html('Oops !');
                    $('#ModalContent').html(data.pesan);
                    $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
                    $('#ModalGue').modal('show');

                    var JumlahBeliBalik = JumlahBeli-1;
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val(JumlahBeliBalik);
                }
            }
        });
    });

    $(document).on('keyup', '#jumlah_beli', function(e){
        var charCode = e.which || e.keyCode;
        if(charCode == 9){
            var Indexnya = $(this).parent().parent().index() + 1;
            var TotalIndex = $('#TabelTransaksi tbody tr').length;
            if(Indexnya == TotalIndex){
                BarisBaru();
                return false;
            }
        }

        HitungTotalBayar();
    });


    $(document).on('keyup', '#UangCash', function(){
        this.value = formatRupiah(this.value, 'Rp. ');


        var sharga = this.value;
        var xharga = sharga.replace(/[^0-9]/g, '');
        $("#UangCashHide").val(xharga);

        HitungTotalKembalian();
    });


    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function HitungTotalBayar()
    {
        var Total = 0;
        $('#TabelTransaksi tbody tr').each(function(){
            if($(this).find('td:nth-child(6) input').val() > 0)
            {
                var SubTotal = $(this).find('td:nth-child(6) input').val();
                Total = parseInt(Total) + parseInt(SubTotal);
            }
        });

        $('#TotalBayar').html(to_rupiah(Total));
        $('#TotalBayarHidden').val(Total);

        $('#UangCash').val('');
        $('#UangKembali').val('');
    }

    function HitungTotalKembalian()
    {
        var Cash = $('#UangCashHide').val();
        var TotalBayar = $('#TotalBayarHidden').val();

        if(parseInt(Cash) >= parseInt(TotalBayar)){
            var Selisih = parseInt(Cash) - parseInt(TotalBayar);
            $('#UangKembali').val(to_rupiah(Selisih));
        } else {
            $('#UangKembali').val('');
        }
    }

    function to_rupiah(angka){
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return 'Rp. ' + rev2.split('').reverse().join('');
    }

    function check_int(evt) {
        var charCode = ( evt.which ) ? evt.which : event.keyCode;
        return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    $(document).on('keydown', 'body', function(e){
        var charCode = ( e.which ) ? e.which : event.keyCode;

        if(charCode == 118) //F7
        {
            BarisBaru();
            return false;
        }

        if(charCode == 119) //F8
        {
            $('#UangCash').focus();
            return false;
        }

        if(charCode == 120) //F9
        {
            CetakStruk();
            return false;
        }

        if(charCode == 121) //F10
        {
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-sm');
            $('#ModalHeader').html('Konfirmasi');
            $('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
            $('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
            $('#ModalGue').modal('show');

            setTimeout(function(){
                $('button#SimpanTransaksi').focus();
            }, 500);

            return false;
        }
    });

    $(document).on('click', '#Simpann', function(){
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-sm');
        $('#ModalHeader').html('Konfirmasi');
        $('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
        $('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
        $('#ModalGue').modal('show');

        setTimeout(function(){
            $('button#SimpanTransaksi').focus();
        }, 500);
    });

    $(document).on('click', 'button#SimpanTransaksi', function(){
        SimpanTransaksi();
    });

    $(document).on('click', 'button#CetakStruk', function(){
        CetakStruk();
    });

    function SimpanTransaksi()
    {
        var FormData = "nomor_nota="+encodeURI($('#nomor_nota').val());
        FormData += "&tanggal="+encodeURI($('#tanggal').val());
        FormData += "&id_kasir="+$('#id_kasir').val();
        FormData += "&id_pelanggan="+$('#id_pelanggan').val();
        FormData += "&" + $('#TabelTransaksi tbody input').serialize();
        FormData += "&cash="+$('#UangCash').val();
        FormData += "&catatan="+encodeURI($('#catatan').val());
        FormData += "&grand_total="+$('#TotalBayarHidden').val();

        $.ajax({
            url: "<?php echo site_url('admin/penjualan/transaksi_simpan'); ?>",
            type: "POST",
            cache: false,
            data: FormData,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    alert(data.pesan);
                    window.location.href="<?php echo site_url('admin/penjualan/transaksi'); ?>";
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

    $(document).on('click', '#TambahPelanggan', function(e){
        e.preventDefault();

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('#ModalHeader').html('Tambah Pelanggan');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
    });

    function CetakStruk()
    {
        if($('#TotalBayarHidden').val() > 0)
        {
            if($('#UangCashHide').val() !== '')
            {
                var FormData = "nomor="+encodeURI($('#nomor_nota').val());

                window.open("<?php echo site_url('admin/penjualan/transaksi_cetak/?'); ?>" + FormData,'_blank');
            }
            else
            {
                $('.modal-dialog').removeClass('modal-lg');
                $('.modal-dialog').addClass('modal-sm');
                $('#ModalHeader').html('Oops !');
                $('#ModalContent').html('Harap masukan Total Bayar');
                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
                $('#ModalGue').modal('show');
            }
        }
        else
        {
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-sm');
            $('#ModalHeader').html('Oops !');
            $('#ModalContent').html('Harap pilih barang terlebih dahulu');
            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
            $('#ModalGue').modal('show');

        }
    }
</script>