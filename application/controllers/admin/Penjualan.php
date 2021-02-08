<?php
class Penjualan extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('My','my');
        $this->load->helpers('form');
        $this->load->helpers('url');

        if($this->session->userdata('user_level') != 'admin'){
            redirect('auth/profile');
        }

        $this->user_id = $this->session->userdata('user_id');
    }


    function index(){
        $data['title'] = 'Transaksi';

        $this->template->load('template','admin/penjualan/history',$data);

    }



    function transaksi(){
        $data['title'] = 'Transaksi';
        $query1 = $this->db->select('*')->from('users')->order_by('user_nama','asc')->get();
        $data['users'] = array();
        foreach ($query1->result_array() as $row1){
            $items = array();
            $items['username'] = $row1['username'];
            $items['user_nama'] = $row1['user_nama'];
            array_push($data['users'],$items);
        }

        $this->template->load('template','admin/penjualan/transaksi',$data);

    }

    function transaksi_detail($id_penjualan){
        $data['title'] = 'Transaksi Detail';
        $data['detail'] = array();
        $data['master'] = array();


        $nota_tanggal = "";
        $nota_pelanggan = "";
        $nota_keterangan = "";
        $nota_kasir = "";
        $nota_nomor = "";
        $nota_bayar_total = 0;
        $nota_bayar = 0;
        $nota_bayar_kembalian = 0;

        $query1 = $this->db->select('*')->from('nota')->where('nota_nomor', $id_penjualan)->limit(1)->get();
        foreach ($query1->result_array() as $row1){
            $nota_tanggal    = $row1['nota_tanggal'];
            $nota_pelanggan   = $row1['nota_pelanggan'];
            $nota_keterangan    = $row1['nota_keterangan'];
            $nota_kasir    = $row1['nota_kasir'];
            $nota_nomor    = $row1['nota_nomor'];
            $nota_bayar_total = (int) $row1['nota_bayar_total'];
            $nota_bayar = (int) $row1['nota_bayar'];
            $nota_bayar_kembalian = (int) $row1['nota_bayar_kembalian'];

        }



        $pelanggan_namalengkap = "";
        $pelanggan_notelp = "";
        $pelanggan_alamat = "";

        $query2 = $this->db->select('*')->from('pelanggan')->where('pelanggan_nama', $nota_pelanggan)->limit(1)->get();
        foreach ($query2->result_array() as $row2) {
            $pelanggan_namalengkap = $row2['pelanggan_namalengkap'];
            $pelanggan_notelp = $row2['pelanggan_notelp'];
            $pelanggan_alamat = $row2['pelanggan_alamat'];

        }

        $penjualan_total = 0;

        $query3 = $this->db->select('*')->from('penjualan')->where('penjualan_nota', $id_penjualan)->get();
        foreach ($query3->result_array() as $row3){
            $penjualan_harga    = (int)$row3['penjualan_harga'];
            $penjualan_jumlah   = (int)$row3['penjualan_jumlah'];

            $penjualan_total = $penjualan_total + ($penjualan_harga*$penjualan_jumlah);

            $penjualan_barang = $row3['penjualan_barang'];

            $nestedData = array();
            $nestedData['penjualan_barang'] = $penjualan_barang;
            $nestedData['penjualan_jumlah'] = $penjualan_jumlah;
            $nestedData['penjualan_harga'] = $penjualan_harga;
            $nestedData['barang_nama'] = "Unknown";
            $nestedData['subtotal'] = (int)$penjualan_harga*$penjualan_jumlah;

            $query_barang = $this->db->select('*')->from('barang')->where('barang_kode', $penjualan_barang)->limit(1)->get();
            foreach ($query_barang->result_array() as $row3) {
                $nestedData['barang_nama'] = $row3['barang_nama'];
            }

            array_push($data['detail'], $nestedData);
        }



        $data['master'] = array(
            'nota_tanggal' => $nota_tanggal,
            'nota_pelanggan' => $nota_pelanggan,
            'nota_keterangan' => $nota_keterangan,
            'nota_kasir' => $nota_kasir,
            'nota_nomor' => $nota_nomor,
            'nota_bayar_total' => $nota_bayar_total,
            'nota_bayar' => $nota_bayar,
            'nota_bayar_kembalian' => $nota_bayar_kembalian,
            'pelanggan_namalengkap' => $pelanggan_namalengkap,
            'pelanggan_notelp' => $pelanggan_notelp,
            'pelanggan_alamat' => $pelanggan_alamat
        );

        $this->load->view('admin/penjualan/transaksi_detail', $data);
    }

    function pelanggan(){
        $data['title'] = 'History';

        $this->template->load('template','admin/penjualan/pelanggan',$data);

    }


    public function data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $query = $this->db->select('*')->from('penjualan');
        $query = $query->join('nota', 'nota.nota_nomor=penjualan.penjualan_nota');
        $query = $query->order_by('nota_tanggal', 'desc');
        $query = $query->group_by('penjualan_nota')->get();

        $data = array();
        $nomor = 0;
        foreach ($query->result_array() as $row){
            $penjualan_nota = $row['penjualan_nota'];

            $query1 = $this->db->select('*')->from('nota')->where('nota_nomor', $penjualan_nota)->limit(1)->get();

            $nota_tanggal = "";
            $nota_pelanggan = "";
            $nota_keterangan = "";
            $nota_kasir = "";
            foreach ($query1->result_array() as $row1){
                $nota_tanggal    = $row1['nota_tanggal'];
                $nota_pelanggan   = $row1['nota_pelanggan'];
                $nota_keterangan    = $row1['nota_keterangan'];
                $nota_kasir    = $row1['nota_kasir'];

            }

            $query2 = $this->db->select('*')->from('penjualan')->where('penjualan_nota', $penjualan_nota)->get();
            $penjualan_total = 0;
            foreach ($query2->result_array() as $row2){
                $penjualan_harga    = (int)$row2['penjualan_harga'];
                $penjualan_jumlah   = (int)$row2['penjualan_jumlah'];

                $penjualan_total = $penjualan_total + ($penjualan_harga*$penjualan_jumlah);
            }

            $nestedData = array();
            $nestedData[]	= $nomor+1;
            $nestedData[]   = $nota_tanggal;
            $nestedData[]	= "<a href='".site_url('admin/penjualan/transaksi_detail/'.$penjualan_nota)."' id='LihatDetailTransaksi'><i class='fa fa-file fa-fw'></i> ".$penjualan_nota."</a>";
            $nestedData[]   = "Rp. ".str_replace(',', '.', number_format($penjualan_total));
            $nestedData[]   = $nota_pelanggan;
            $nestedData[]   = $nota_keterangan;
            $nestedData[]   = $nota_kasir;
            $nestedData[]	= "<div class='text-center'><a class='btn danger' href='#' onClick='submitHapus(".$penjualan_nota.")'><i class='fa fa-trash'></i></a></div>";

            $data[] = $nestedData;
            $nomor++;
        }


        //$search, $limit, $start, $order_field, $order_ascdesc
        $callback = array(
            'draw'=>$requestData['draw'],
            'recordsTotal'=>$nomor,
            'recordsFiltered'=>$nomor,
            'data'=>$data
        );
        header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function datax(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $query = $this->db->select('*')->from('penjualan')->group_by('penjualan_nota')->get();

        $data = array();
        $nomor = 0;
        foreach ($query->result_array() as $row){
            $penjualan_nota = $row['penjualan_nota'];

            $query1 = $this->db->select('*')->from('nota')->where('nota_nomor', $penjualan_nota)->limit(1)->get();

            $nota_tanggal = "";
            $nota_pelanggan = "";
            $nota_keterangan = "";
            $nota_kasir = "";
            foreach ($query1->result_array() as $row1){
                $nota_tanggal    = $row1['nota_tanggal'];
                $nota_pelanggan   = $row1['nota_pelanggan'];
                $nota_keterangan    = $row1['nota_keterangan'];
                $nota_kasir    = $row1['nota_kasir'];

            }

            $query2 = $this->db->select('*')->from('penjualan')->where('penjualan_nota', $penjualan_nota)->get();
            $penjualan_total = 0;
            foreach ($query2->result_array() as $row2){
                $penjualan_harga    = (int)$row2['penjualan_harga'];
                $penjualan_jumlah   = (int)$row2['penjualan_jumlah'];

                $penjualan_total = $penjualan_total + ($penjualan_harga*$penjualan_jumlah);
            }

            $nestedData = array();
            $nestedData[]	= $nomor+1;
            $nestedData[]   = $nota_tanggal;
            $nestedData[]	= "<a href='".site_url('admin/penjualan/transaksi_detail/'.$penjualan_nota)."' id='LihatDetailTransaksi'><i class='fa fa-file fa-fw'></i> ".$penjualan_nota."</a>";
            $nestedData[]   = "Rp. ".str_replace(',', '.', number_format($penjualan_total));
            $nestedData[]   = $nota_pelanggan;
            $nestedData[]   = $nota_keterangan;
            $nestedData[]   = $nota_kasir;
            $nestedData[]	= "<div class='text-center'><a class='btn danger' href='#' onClick='submitHapus(".$penjualan_nota.")'><i class='fa fa-trash'></i></a></div>";

            $data[] = $nestedData;
            $nomor++;
        }


        //$search, $limit, $start, $order_field, $order_ascdesc
        $callback = array(
            'draw'=>$requestData['draw'],
            'recordsTotal'=>$nomor,
            'recordsFiltered'=>$nomor,
            'data'=>$data
        );
        header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function transaksi_cetak(){
        $nomor 	= $this->input->get('nomor');

        $nota_tanggal = "";
        $nota_pelanggan = "";
        $nota_keterangan = "";
        $nota_kasir = "";
        $nota_nomor = "";
        $nota_bayar_total = 0;
        $nota_bayar = 0;
        $nota_bayar_kembalian = 0;

        $query1 = $this->db->select('*')->from('nota')->where('nota_nomor', $nomor)->limit(1)->get();
        foreach ($query1->result_array() as $row1){
            $nota_tanggal    = $row1['nota_tanggal'];
            $nota_pelanggan   = $row1['nota_pelanggan'];
            $nota_keterangan    = $row1['nota_keterangan'];
            $nota_kasir    = $row1['nota_kasir'];
            $nota_nomor    = $row1['nota_nomor'];
            $nota_bayar_total = (int) $row1['nota_bayar_total'];
            $nota_bayar = (int) $row1['nota_bayar'];
            $nota_bayar_kembalian = (int) $row1['nota_bayar_kembalian'];

        }

        $pelanggan_namalengkap = "";
        $pelanggan_notelp = "";
        $pelanggan_alamat = "";

        $query2 = $this->db->select('*')->from('pelanggan')->where('pelanggan_nama', $nota_pelanggan)->limit(1)->get();
        foreach ($query2->result_array() as $row2) {
            $pelanggan_namalengkap = $row2['pelanggan_namalengkap'];
            $pelanggan_notelp = $row2['pelanggan_notelp'];
            $pelanggan_alamat = $row2['pelanggan_alamat'];

        }

        $penjualan_total = 0;



        $data =  array();
        $data['detail'] =  array();
        $query3 = $this->db->select('*')->from('penjualan')->where('penjualan_nota', $nomor)->get();
        foreach ($query3->result_array() as $row3){
            $penjualan_harga    = (int)$row3['penjualan_harga'];
            $penjualan_jumlah   = (int)$row3['penjualan_jumlah'];

            $penjualan_total = $penjualan_total + ($penjualan_harga*$penjualan_jumlah);

            $penjualan_barang = $row3['penjualan_barang'];

            $nestedData = array();
            $nestedData['penjualan_barang'] = $penjualan_barang;
            $nestedData['penjualan_jumlah'] = $penjualan_jumlah;
            $nestedData['penjualan_harga'] = $penjualan_harga;
            $nestedData['barang_kode'] = "";
            $nestedData['barang_nama'] = "Unknown";
            $nestedData['subtotal'] = (int)$penjualan_harga*$penjualan_jumlah;

            $query_barang = $this->db->select('*')->from('barang')->where('barang_kode', $penjualan_barang)->limit(1)->get();
            foreach ($query_barang->result_array() as $row3) {
                $nestedData['barang_kode'] = $row3['barang_kode'];
                $nestedData['barang_nama'] = $row3['barang_nama'];
            }

            array_push($data['detail'], $nestedData);
        }


        $this->load->library('cfpdf');
        $pdf = new FPDF('P','mm','A5');
        $pdf->AddPage();
        $pdf->SetFont('Arial','',10);


        $pdf->Cell(25, 4, 'Nota', 0, 0, 'L');
        $pdf->Cell(85, 4, $nomor, 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(25, 4, 'Tanggal', 0, 0, 'L');
        $pdf->Cell(85, 4, date('d-M-Y H:i:s', strtotime($nota_tanggal)), 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(25, 4, 'Kasir', 0, 0, 'L');
        $pdf->Cell(85, 4, $nota_kasir, 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(25, 4, 'Pelanggan', 0, 0, 'L');
        $pdf->Cell(85, 4, $nota_pelanggan, 0, 0, 'L');
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(25, 5, 'Kode', 0, 0, 'L');
        $pdf->Cell(40, 5, 'Item', 0, 0, 'L');
        $pdf->Cell(25, 5, 'Harga', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Qty', 0, 0, 'L');
        $pdf->Cell(25, 5, 'Subtotal', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
        $pdf->Ln();

        $this->load->helper('text');

        $no = 0;
        foreach($data['detail'] as $d){
            $nama_barang = $d['barang_nama'];
            $nama_barang = character_limiter($nama_barang, 20, '..');

            $pdf->Cell(25, 5, $d['barang_kode'], 0, 0, 'L');
            $pdf->Cell(40, 5, $nama_barang, 0, 0, 'L');
            $pdf->Cell(25, 5, str_replace(',', '.', "Rp. ".number_format($d['penjualan_harga'])), 0, 0, 'R');
            $pdf->Cell(15, 5, $d['penjualan_jumlah'], 0, 0, 'L');
            $pdf->Cell(25, 5, str_replace(',', '.', "Rp. ".number_format($d['subtotal'])), 0, 0, 'R');
            $pdf->Ln();

            $no++;
        }

        $pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(105, 5, 'Total Bayar', 0, 0, 'R');
        $pdf->Cell(25, 5, str_replace(',', '.', "Rp. ".number_format($nota_bayar_total)), 0, 0, 'R');
        $pdf->Ln();

        $pdf->Cell(105, 5, 'Cash', 0, 0, 'R');
        $pdf->Cell(25, 5, str_replace(',', '.', "Rp. ".number_format($nota_bayar)), 0, 0, 'R');
        $pdf->Ln();

        $pdf->Cell(105, 5, 'Kembali', 0, 0, 'R');
        $pdf->Cell(25, 5, str_replace(',', '.', "Rp. ".number_format(($nota_bayar - $nota_bayar_total))), 0, 0, 'R');
        $pdf->Ln();

        $pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(25, 5, 'Catatan : ', 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(130, 5, (($nota_keterangan == '') ? 'Tidak Ada' : $nota_keterangan), 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(130, 5, "Terimakasih telah berbelanja dengan kami", 0, 0, 'C');

        $pdf->Output();
    }

    function transaksi_simpan(){
        if( !empty($_POST['kode_barang'])){
            $total = 0;
            foreach($_POST['kode_barang'] as $k){
                if( ! empty($k)){ $total++; }
            }

            if($total > 0){

                $nomor_nota 	= $this->input->post('nomor_nota');
                $tanggal		= $this->input->post('tanggal');
                $id_kasir		= $this->input->post('id_kasir');
                $id_pelanggan	= $this->input->post('id_pelanggan');
                $bayar			= $this->input->post('cash');
                $bayar_kebali	= $this->input->post('cashback');
                $grand_total	= $this->input->post('grand_total');
                $catatan		= $this->input->post('catatan');

                if($bayar < $grand_total)
                {
                    $this->query_error("Cash Kurang");
                }
                else
                {
                    //insert nota
                    $baris = array();
                    $baris['nota_nomor'] = $nomor_nota;
                    $baris['nota_keterangan'] = $catatan;
                    $baris['nota_tanggal'] = $tanggal;
                    $baris['nota_pelanggan'] = $id_pelanggan;
                    $baris['nota_kasir'] = $id_kasir;
                    $baris['nota_bayar_total'] = $grand_total;
                    $baris['nota_bayar'] = $bayar;
                    $baris['nota_bayar_total'] = $grand_total;
                    $baris['nota_bayar_kembalian'] = $bayar_kebali;

                    $master = $this->db->insert('nota', $baris);

                    if($master){
                        $inserted	= 0;

                        //insert barang yang dibeli ke penjualan
                        $no_array	= 0;
                        foreach($_POST['kode_barang'] as $k){
                            if( !empty($k) )
                            {
                                $kode_barang 	= $_POST['kode_barang'][$no_array];
                                $jumlah_beli 	= $_POST['jumlah_beli'][$no_array];
                                $harga_satuan 	= $_POST['harga_satuan'][$no_array];
                                $sub_total 		= $_POST['sub_total'][$no_array];

                                //insert penjualan
                                $baris = array();
                                $baris['penjualan_nota'] = $nomor_nota;
                                $baris['penjualan_jumlah'] = $jumlah_beli;
                                $baris['penjualan_harga'] = $harga_satuan;
                                $baris['penjualan_barang'] = $kode_barang;

                                $insert_detail = $this->db->insert('penjualan', $baris);
                                if($insert_detail)
                                {
                                    $barang_stok = 0;
                                    $query_barang = $this->db->select('*')->from('barang')->where('barang_kode', $kode_barang)->limit(1)->get();
                                    foreach ($query_barang->result_array() as $row_barang) {
                                        $barang_stok = (int) $row_barang['barang_stok'];
                                    }

                                    $stok_baru = $barang_stok - $jumlah_beli;

                                    //update stok barang
                                    $this->db->where('kode_barang',$kode_barang);
                                    $this->db->update('barang',array('barang_stok',$stok_baru));

                                    $inserted++;
                                }
                            }

                            $no_array++;
                        }

                        if($inserted > 0)
                        {
                            echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !"));
                        }
                        else
                        {
                            $this->query_error();
                        }
                    }
                    else
                    {
                        $this->query_error();
                    }
                }
            }
            else
            {
                $this->query_error("Harap masukan minimal 1 kode barang !");
            }
        }
        else
        {
            $this->query_error("Harap masukan minimal 1 kode barang !");
        }

    }




    function barang_kode(){
        $keyword 	= $this->input->post('keyword');
        $registered	= $this->input->post('registered');


        $this->db->select('*')->from('barang');
        if(!empty($keyword)){
            $this->db->like("barang_kode",$keyword);
        }

        $query3 = $this->db->get();

        if($query3->num_rows() > 0)
        {
            $json['status'] 	= 1;
            $json['datanya'] 	= "<ul id='daftar-autocomplete'>";
            foreach($query3->result() as $row3){
                $json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>".$row3->barang_kode."</span> <br />
							<span id='barangnya'>".$row3->barang_nama."</span>
							<span id='harganya' style='display:none;'>".$row3->barang_harga."</span>
						</li>
					";
            }
            $json['datanya'] .= "</ul>";
        }
        else
        {
            $json['status'] 	= 0;
        }

        echo json_encode($json);
    }
}
?>