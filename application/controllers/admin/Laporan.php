<?php
class Laporan extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('My','m');
        $this->load->helpers('form');
        $this->load->helpers('url');

        if($this->session->userdata('user_level') != 'admin'){
            redirect('auth/profile');
        }

        $this->user_id = $this->session->userdata('user_id');
    }


    function index(){
        $data['title'] = 'Laporan';

        $this->template->load('template','admin/laporan/index',$data);

    }


    public function detail(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        $dt['penjualan'] 	= $this->laporan_penjualan($from, $to);
        $dt['from']			= date('d F Y', strtotime($from));
        $dt['to']			= date('d F Y', strtotime($to));

        $this->load->view('admin/laporan/detail', $dt);
    }

    function laporan_penjualan($from, $to)
    {
        $sql = "
			SELECT 
				DISTINCT(SUBSTR(a.`nota_tanggal`, 1, 10)) AS nota_tanggal,
				(
					SELECT 
						SUM(b.`nota_bayar_total`) 
					FROM 
						`nota` AS b 
					WHERE 
						SUBSTR(b.`nota_tanggal`, 1, 10) = SUBSTR(a.`nota_tanggal`, 1, 10) 
					LIMIT 1
				) AS total_penjualan 
			FROM 
				`nota` AS a 
			WHERE 
				SUBSTR(a.`nota_tanggal`, 1, 10) >= '".$from."' 
				AND SUBSTR(a.`nota_tanggal`, 1, 10) <= '".$to."' 
			ORDER BY 
				a.`nota_tanggal` ASC
		";

        return $this->db->query($sql);
    }



    public function excel($from, $to)
    {
        $penjualan 	= $this->laporan_penjualan($from, $to);
        if($penjualan->num_rows() > 0)
        {
            $filename = 'Laporan_Penjualan_'.$from.'_'.$to;
            header("Content-type: application/x-msdownload");
            header("Content-Disposition: attachment; filename=".$filename.".xls");

            echo "
				<h4>Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to))."</h4>
				<table border='1' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
			";

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
			</tbody>
			</table>
			";
        }
    }

    public function pdf($from, $to)
    {
        $this->load->library('cfpdf');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0, 8, "Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'L');

        $pdf->Cell(15, 7, 'No', 1, 0, 'L');
        $pdf->Cell(85, 7, 'Tanggal', 1, 0, 'L');
        $pdf->Cell(85, 7, 'Total Penjualan', 1, 0, 'L');
        $pdf->Ln();

        $penjualan 	= $this->laporan_penjualan($from, $to);

        $no = 1;
        $total_penjualan = 0;
        foreach($penjualan->result() as $p)
        {
            $pdf->Cell(15, 7, $no, 1, 0, 'L');
            $pdf->Cell(85, 7, date('d F Y', strtotime($p->nota_tanggal)), 1, 0, 'L');
            $pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($p->total_penjualan)), 1, 0, 'L');
            $pdf->Ln();

            $total_penjualan = $total_penjualan + $p->total_penjualan;
            $no++;
        }

        $pdf->Cell(100, 7, 'Total Seluruh Penjualan', 1, 0, 'L');
        $pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($total_penjualan)), 1, 0, 'L');
        $pdf->Ln();

        $pdf->Output();
    }

}
?>