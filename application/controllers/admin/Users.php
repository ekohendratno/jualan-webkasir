<?php
defined('BASEPATH') or exit();

class Users extends CI_Controller{
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
		
		
		$data['title'] = "Data Anggota";
		
        $this->template->load('template','admin/users',$data);
	}

    public function data(){
        $requestData	= $_REQUEST;

        $search = $requestData['search']['value'];
        $limit = $requestData['length'];
        $start = $requestData['start'];
        $order_index = $requestData['order'][0]['column'];
        $order_field = $requestData['columns'][$order_index]['data'];
        $order_ascdesc = $requestData['order'][0]['dir'];

        $this->db->select('*')->from('users');
        $this->db->order_by('username','asc');
        $query = $this->db->get();

        $data = array();
        $total = 0;
        foreach($query->result() as $row){
            $nestedData = array();
            $nestedData[]	= $total+1;
            $nestedData[]   = $row->username;
            $nestedData[]   = $row->user_level;
            $nestedData[]   = $row->user_last_active;
            $nestedData[]	= "<div class='text-center'><a class='btn success' href='#formDialog' data-toggle='modal' onClick='formDialog($row->user_id)'><i class='fa fa-pen'></i></a> <a class='btn danger' href='#' onClick='submitHapus($row->user_id)'><i class='fa fa-trash'></i></a></div>";
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


    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('users');
        $this->db->group_by('username');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('username',$q);
        }
        $this->db->order_by('username','asc');

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();


            $data['label'] = $row->username;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }


    public function simpan(){

        $id 	= $this->input->post('id');
        $username 	= $this->input->post('username');
        $password	= $this->input->post('password');
        $user_level		= $this->input->post('user_level');

        if(empty($username))
        {
            $this->query_error("ID Pengguna Kosong");
        }
        else
        {
            //insert nota
            $baris = array();
            $baris['username'] = $username;
            $baris['password'] = $password;
            $baris['user_level'] = $user_level;

            if($id > 0){
                $this->db->where('user_id', $id);
                $master = $this->db->update('users', $baris);
            }else{
                $master = $this->db->insert('users', $baris);
                $id = $this->db->insert_id();
            }

            if($master){
                echo json_encode(array('status' => 1, 'pesan' => "Pengguna baru berhasil ditambahkan !"));
            }
            else
            {
                $this->query_error();
            }
        }

    }


    public function ambildatabyid(){
        $id = $this->input->post('id');
        $users = $this->db->get_where('users', array('user_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['user_id'] = $row['user_id'];
            $baris['username'] = $row['username'];
            $baris['password'] = $row['password'];
            $baris['user_nama'] = $row['user_nama'];
            $baris['user_level'] = $row['user_level'];

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }

    public function hapus()
    {
        $level = $this->session->userdata('user_level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->post('id');
            $this->db->where('username',$id);
            $hapus = $this->db->delete('users');
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
    }

	
}
?>