<?php
if( !empty($master['nota_pelanggan']) && $master['nota_pelanggan'] != "umum")
{
    echo "
		<table class='info_pelanggan'>
			<tr>
				<td>Nama Pelanggan</td>
				<td>:</td>
				<td>".$master['pelanggan_namalengkap']."</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>".preg_replace("/\r\n|\r|\n/",'<br />', $master['pelanggan_alamat'])."</td>
			</tr>
			<tr>
				<td>Telp. / HP</td>
				<td>:</td>
				<td>".$master['pelanggan_notelp']."</td>
			</tr>
			<tr>
				<td>Informasi Tambahan</td>
				<td>:</td>
				<td>".preg_replace("/\r\n|\r|\n/",'<br />', $master['pelanggan_lainnya'])."</td>
			</tr>	
		</table>
		<hr />
	";
}
else
{
    echo "Pelanggan : Umum";
}
?>

<input type="hidden" id="nota_nomor" value="<?php echo html_escape($master['nota_nomor']); ?>">

<table id="my-grid" class="table tabel-transaksi" style='margin-bottom: 0px; margin-top: 10px;'>
    <thead>
    <tr>
        <th class='text-center'>#</th>
        <th class='text-center'>Kode Barang</th>
        <th>Nama Barang</th>
        <th class='text-right'>Harga Satuan</th>
        <th class='text-center'>Jumlah Beli</th>
        <th class='text-right'>Sub Total</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $no 			= 1;
    foreach($detail as $d){
        echo "
			<tr>
				<td class='text-center'>".$no."</td>
				<td class='text-center'>".$d['penjualan_barang']."</td>
				<td>".$d['barang_nama']."</td>
				<td class='text-right'>Rp. ".str_replace(',', '.', number_format($d['penjualan_harga']))." </td>
				<td class='text-center'>".$d['penjualan_jumlah']."</td>
				<td class='text-right'>Rp. ".str_replace(',', '.', number_format($d['subtotal']))." </td>
			</tr>
		";

        $no++;
    }

    echo "
		<tr style='background:#deeffc;'>
			<td colspan='5' style='text-align:right;'><b>Grand Total</b></td>
			<td style='text-align:right; border:0px;'><b>Rp. ".str_replace(',', '.', number_format($master['nota_bayar_total']))."</b></td>
		</tr>
		<tr>
			<td colspan='5' style='text-align:right; border:0px;'>Bayar</td>
			<td style='text-align:right; border:0px;'>Rp. ".str_replace(',', '.', number_format($master['nota_bayar']))."</td>
		</tr>
		<tr>
			<td colspan='5' style='text-align:right; border:0px;'>Kembali</td>
			<td style='text-align:right; border:0px;'>Rp. ".str_replace(',', '.', number_format($master['nota_bayar_kembalian']))."</td>
		</tr>
	";
    ?>
    </tbody>
</table>


<script>
    $(document).ready(function(){
        var Tombol = "<button type='button' class='btn btn-primary' id='Cetaks'><i class='fa fa-print'></i> Cetak</button>";
        Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
        $('#ModalFooter').html(Tombol);

        $('button#Cetaks').click(function(){
            var FormData = "nomor="+encodeURI($('#nota_nomor').val());

            window.open("<?php echo site_url('admin/penjualan/transaksi_cetak/?'); ?>" + FormData,'_blank');
        });
    });
</script>