<p class="pull-right">
    <?php
    $from 	= date('Y-m-d', strtotime($from));
    $to		= date('Y-m-d', strtotime($to));
    ?>
    <a href="<?php echo site_url('admin/laporan/pdf/'.$from.'/'.$to); ?>" target='blank' class='btn btn-default'><i class='fa fa-file-export fa-fw'></i> Export ke PDF</a>
    <a href="<?php echo site_url('admin/laporan/excel/'.$from.'/'.$to); ?>" target='blank' class='btn btn-default'><i class='fa fa-file-export fa-fw'></i> Export ke Excel</a>
</p>
<br />

<table class='table table-bordered'>
    <thead>
    <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Total Penjualan</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    $total_penjualan = 0;
    foreach($penjualan->result() as $p)
    {
        echo "
					<tr>
						<td>".$no."</td>
						<td>".date('d F Y', strtotime($p->nota_tanggal))."</td>
						<td>Rp. ".str_replace(",", ".", number_format($p->total_penjualan))."</td>
					</tr>
				";

        $total_penjualan = $total_penjualan + $p->total_penjualan;
        $no++;
    }

    echo "
				<tr>
					<td colspan='2'><b>Total Seluruh Penjualan</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($total_penjualan))."</b></td>
				</tr>
			";
    ?>
    </tbody>
</table>