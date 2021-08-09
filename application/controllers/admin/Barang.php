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
        $data['title'] = 'Semua Barang';

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

    public function simpan(){

        $id 	= $this->input->post('id');
        $barang_kode 	= $this->input->post('barang_kode');
        $barang_nama		= $this->input->post('barang_nama');
        $barang_berat		= $this->input->post('barang_berat');
        $barang_stok	= $this->input->post('barang_stok');
        $barang_harga			= $this->input->post('barang_harga');
        $barang_kategori			= $this->input->post('barang_kategori');
        $barang_merek			= $this->input->post('barang_merek');
        $barang_keterangan			= $this->input->post('barang_keterangan');
        $barang_tanggal_masuk			= $this->input->post('barang_tanggal_masuk');



        if( !empty($barang_kode) ) {
            //insert nota
            $baris = array();
            $baris['barang_kode'] = $barang_kode;
            $baris['barang_nama'] = $barang_nama;
            $baris['barang_berat'] = $barang_berat;
            $baris['barang_stok'] = $barang_stok;
            $baris['barang_harga'] = $barang_harga;
            $baris['barang_kategori'] = $barang_kategori;
            $baris['barang_merek'] = $barang_merek;
            $baris['barang_keterangan'] = $barang_keterangan;
            $baris['barang_tanggal_masuk'] = $barang_tanggal_masuk;

            if($id > 0){
                $this->db->where('barang_id', $id);
                $master = $this->db->update('barang', $baris);
            }else{
                $master = $this->db->insert('barang', $baris);
                $id = $this->db->insert_id();
            }

            if($master){
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
                echo json_encode(array('id' => $id,'status' => 1, 'pesan' => "Data berhasil disimpan!"));
            }
            else
            {
                echo json_encode(array('status' => 0, 'pesan' => "Gagal disimpan!"));
            }

        }else{
            echo json_encode(array('status' => 0, 'pesan' => "Kode barang kosong!"));
        }

    }


    public function ambildatabyid(){
        $id = $this->input->post('id');
        $users = $this->db->get_where('barang', array('barang_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['barang_id'] = $row['barang_id'];
            $baris['barang_kode'] = $row['barang_kode'];
            $baris['barang_nama'] = $row['barang_nama'];
            $baris['barang_berat'] = $row['barang_berat'];
            $baris['barang_stok'] = $row['barang_stok'];
            $baris['barang_harga'] = $row['barang_harga'];
            $baris['barang_kategori'] = $row['barang_kategori'];
            $baris['barang_merek'] = $row['barang_merek'];
            $baris['barang_keterangan'] = $row['barang_keterangan'];
            //$baris['barang_dihapus'] = $row['barang_dihapus'];

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }


    public function hapus()
    {
        $id = $this->input->post('id');
        $this->db->where('barang_id',$id);
        $hapus = $this->db->delete('barang');
        if($hapus)
        {
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
        }
        else
        {
            echo json_encode(array(
                "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
        }
    }


    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('barang');
        $this->db->group_by('barang_kategori');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('barang_kategori',$q);
        }
        $this->db->order_by('barang_kategori','asc');

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();


            $data['label'] = $row->barang_kategori;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('barang');
        $this->db->group_by('barang_merek');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('barang_merek',$q);
        }

        $this->db->order_by('barang_merek','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->barang_merek;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data3(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('barang');
        $this->db->group_by('barang_kode');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('barang_kode',$q);
        }

        $this->db->order_by('barang_kode','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->barang_kode;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    public function merek_data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $this->db->select('*')->from('barang');
        $this->db->group_by('barang_merek');
        $this->db->order_by('barang_merek','asc');
        $query = $this->db->get();

        $data = array();
        $total = 0;
        foreach($query->result() as $row){
            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $row->barang_merek;
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

        $this->db->select('*')->from('barang');
        $this->db->group_by('barang_kategori');
        $this->db->order_by('barang_kategori','asc');
        $query = $this->db->get();

        $data = array();
        $total = 0;
        foreach($query->result() as $row){
            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $row->barang_kategori;
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

    public function stok(){
        $kode = $this->input->post('kode');
        $stok = $this->input->post('stok');

        $query = $this->db->select('*')->from('barang')->where('barang_kode',$kode)->get();

        if($stok > $query->row()->barang_stok){
            echo json_encode(array('status' => 0, 'pesan' => "Stok untuk <b>".$query->row()->barang_nama."</b> saat ini hanya tersisa <b>".$query->row()->barang_stok."</b> !"));
        }
        else
        {
            echo json_encode(array('status' => 1));
        }
    }

    public function kode(){
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