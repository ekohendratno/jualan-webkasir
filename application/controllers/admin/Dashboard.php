<?php
class Dashboard extends CI_Controller{
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
        $data['title'] = 'Dashboard Admin';
        $data['jumlah_penjualan'] = $this->_jumlah_penjualan();
        $data['jumlah_pelanggan'] = $this->_jumlah_pelanggan();

        $this->template->load('template','admin/dashboard',$data);

    }


    function _jumlah_penjualan(){
        $ikut = $this->db->select('*')->from('penjualan');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }


    function _jumlah_pelanggan(){
        $ikut = $this->db->select('*')->from('pelanggan');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }
}
?>