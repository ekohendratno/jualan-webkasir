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



}
?>