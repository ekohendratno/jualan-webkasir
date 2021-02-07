<?php
class Barang extends CI_Controller{
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
        $data['title'] = 'Barang';

        $this->template->load('template','admin/barang/index',$data);

    }



    function merek(){
        $data['title'] = 'Merek';

        $this->template->load('template','admin/barang/merek',$data);

    }

    function kategori(){
        $data['title'] = 'Kategori';

        $this->template->load('template','admin/barang/kategori',$data);

    }


    public function data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $query = $this->db->select('*')->from('barang')->get();

        $data = array();
        $total = 0;
        foreach ($query->result_array() as $row){

            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $row['barang_kode'];
            $nestedData[]   = $row['barang_nama'];
            $nestedData[]   = $row['barang_kategori'];
            $nestedData[]   = $row['barang_berat'];
            $nestedData[]   = $row['barang_merek'];
            $nestedData[]   = $row['barang_stok'];
            $nestedData[]   = $row['barang_harga'];
            $nestedData[]   = $row['barang_keterangan'];
            $nestedData[]	= "<div class='text-center'><a class='btn success' href='#formDialog' data-toggle='modal' onClick='formDialog(".$row['barang_id'].")'><i class='fa fa-pen'></i></a> <a class='btn danger' href='#' onClick='submitHapus(".$row['barang_id'].")'><i class='fa fa-trash'></i></a></div>";

            $data[] = $nestedData;
            $total++;
        }


        //$search, $limit, $start, $order_field, $order_ascdesc
        $callback = array(
            'draw'=>$requestData['draw'],
            'recordsTotal'=>$total,
            'recordsFiltered'=>$total,
            'data'=>$data
        );
        header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function merek_data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $x = json_decode($this->m->getpengaturan('Merek'));

        $data = array();
        $total = 0;
        foreach ($x as $k){
            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $k;
            $nestedData[]	= "<div class='text-center'><a class='btn success' href='#formDialog' data-toggle='modal' onClick='formDialog(".$k.")'><i class='fa fa-pen'></i></a> <a class='btn danger' href='#' onClick='submitHapus(".$k.")'><i class='fa fa-trash'></i></a></div>";

            $data[] = $nestedData;
            $total++;
        }

        //$search, $limit, $start, $order_field, $order_ascdesc
        $callback = array(
            'draw'=>$requestData['draw'],
            'recordsTotal'=>$total,
            'recordsFiltered'=>$total,
            'data'=>$data
        );
        header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function kategori_data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $x = json_decode($this->m->getpengaturan('Kategori'));

        $data = array();
        $total = 0;
        foreach ($x as $k){
            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $k;
            $nestedData[]	= "<div class='text-center'><a class='btn success' href='#formDialog' data-toggle='modal' onClick='formDialog(".$k.")'><i class='fa fa-pen'></i></a> <a class='btn danger' href='#' onClick='submitHapus(".$k.")'><i class='fa fa-trash'></i></a></div>";

            $data[] = $nestedData;
            $total++;
        }

        //$search, $limit, $start, $order_field, $order_ascdesc
        $callback = array(
            'draw'=>$requestData['draw'],
            'recordsTotal'=>$total,
            'recordsFiltered'=>$total,
            'data'=>$data
        );
        header('Content-Type: application/json');
        echo json_encode($callback);

    }



}
?>