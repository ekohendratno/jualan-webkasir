<?php
defined('BASEPATH') or exit();

class Users extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->zend->load('Zend/Barcode');	
		$this->load->model('My','m');
		
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		if($this->session->userdata('user_level') != 'admin'){
			redirect('auth/profile');
		}
		
		$this->pengaturan_key = $this->session->userdata('pengaturan_key');
	}
	
	function index(){
		
		
		$data['title'] = "Data Anggota Perpus";
		$data['jurusan'] = $this->jurusan();
		
        $this->template->load('template','admin/users',$data);
	}
	
	public function barcode(){		
		$code = $this->input->get('code');
		
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
	
	function jurusan(){
		
		$jurusan = $this->db->get_where('jurusan',array('pengaturan_key' => $this->pengaturan_key));
		
		$items = array();
		foreach ($jurusan->result_array() as $row1){			
			$data['id'] = $row1['jurusan_id'];
			$data['title'] = $row1['jurusan_title'];
				
			array_push($items, $data);
		}
		
		return $items;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($items);
		
	}
	
	function cetak(){		
		$kelas = $this->input->get('kelas');
		$jurusan_id = $this->input->get('jurusan_id');
		$ruang = $this->input->get('ruang');
		
		$where = array(
			'kelas'=>$kelas,
			'jurusan_id'=>$jurusan_id,
			'ruang'=>$ruang,
			'status_lulus'=>'n',
			'pengaturan_key'=>$this->pengaturan_key
		);
		
		
		$data = array();
		$data['users'] = array();
		
		$siswa = $this->db->get_where('users',$where);
		foreach ($siswa->result_array() as $row){
			$baris['user_id'] = $row['user_id'];	
			$baris['username'] = $row['username'];	
			$baris['password'] = $row['password'];	
			$baris['user_nama'] = $row['user_nama'];
			
			$baris['user_foto'] = base_url('img/user.jpg');
			if( !empty($row['user_foto']) && file_exists('uploads/user/' . $row['user_foto'] ) ){
				$baris['user_foto'] = base_url('uploads/user/' . $row['user_foto']);					
			}
			
			$baris['user_level'] = $row['user_level'];
			$baris['user_jk'] = $row['user_jk'];
			$baris['kelas'] = $row['kelas'];
			$baris['ruang'] = $row['ruang'];
			$baris['panding'] = $row['panding'];
			$baris['user_last_active'] = $row['user_last_active'];
			
			$baris['jurusan_id'] = $row['jurusan_id'];
			$jurusan = $this->db->get_where( 'jurusan', array('jurusan_id'=>$row['jurusan_id']) )->result();
			
			foreach($jurusan as $b){	
				$baris['jurusan_title'] = $b->jurusan_title;		
			}
			
			array_push($data['users'], $baris);
		}
		
        $this->load->view('admin/cetak',$data);
	}
	
	function cobaQuery($params = array()){
		
		$data = array();
		$users = $this->db->select('*')->from('users');
		
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $users = $users->like('user_nama',$params['search']['keywords']);
            $users = $users->or_like('user_nps',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $users = $users->order_by('tanggal_dibuat',$params['search']['sortBy']);
        }else{
            $users = $users->order_by('tanggal_dibuat','desc');
        }
		
        //filter data by searched keywords
        if(!empty($params['search']['levelBy'])){
            $users = $users->where('user_level',$params['search']['levelBy']);
        }
		
		if(!empty($params['search']['jurusanBy'])){
			$this->db->where('jurusan_id',$params['search']['jurusanBy']);
		}
		
		$users->where('pengaturan_key',$this->pengaturan_key);
		
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $users = $users->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $users = $users->limit($params['limit']);
        }
		$users = $users->get();
		
		foreach ($users->result_array() as $row){
			$baris['user_id'] = $row['user_id'];	
			$baris['username'] = $row['username'];	
			$baris['password'] = $row['password'];	
			$baris['user_nama'] = $row['user_nama'];
			
			$baris['user_foto'] = base_url('img/user.jpg');
			if( !empty($row['user_foto']) && file_exists('uploads/user/' . $row['user_foto'] ) ){
				$baris['user_foto'] = base_url('uploads/user/' . $row['user_foto']);					
			}
			
			$baris['user_level'] = $row['user_level'];
			$baris['user_jk'] = $row['user_jk'];
			$baris['user_nps'] = $row['user_nps'];
			$baris['kelas'] = $row['kelas'];
			$baris['ruang'] = $row['ruang'];
			$baris['panding'] = $row['panding'];
			$baris['user_alamat'] = $row['user_alamat'];
			$baris['tanggal_dibuat'] = $row['tanggal_dibuat'];
			$baris['user_last_active'] = $row['user_last_active'];	
			
			
			$baris['jurusan_id'] = $row['jurusan_id'];
			$baris['jurusan_title'] = '';
			
			if(!empty($row['jurusan_id'])){
				$jurusan = $this->db->get_where('jurusan',array('jurusan_id'=>$row['jurusan_id']))->result();
				$baris['jurusan_title'] = $jurusan[0]->jurusan_title;
			}
			
			
			array_push($data, $baris);
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($data);
	}
	function ajaxPaginationData(){
		
        $this->perPage = 10;
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $levelBy = $this->input->post('levelBy');
        $limitBy = $this->input->post('limitBy');
        $jurusanBy = $this->input->post('jurusanBy');
	
		
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($levelBy)){
            $conditions['search']['levelBy'] = $levelBy;
        }
        if(!empty($jurusanBy)){
            $conditions['search']['jurusanBy'] = $jurusanBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'users/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
		
		
		// integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['empData'] = $this->cobaQuery($conditions);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['pagination'] = $this->ajax_pagination->create_links();
        
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
    }
	
	function generateNomorPerpus(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array(
			'user_level'=>'siswa',
			'pengaturan_key'=>$this->pengaturan_key
		));
		
		$this->db->order_by('user_nps_tahun','desc');
		$this->db->order_by('user_nps_urutan','desc');
		$this->db->limit(1);
		$users = $this->db->get();
		
		$baris = array();
		$baris['user_nps_tahun'] = date('y');
		$baris['user_nps_urutan'] = 0;
		
		foreach ($users->result_array() as $row){
			$baris['user_nps_tahun'] = date('y',strtotime($row['user_nps_tahun']));
			$baris['user_nps_urutan'] = $row['user_nps_urutan'];
		}
		
		if($baris['user_nps_tahun'] < date('y') ) $baris['user_nps_tahun'] = date('y');
		
		$baris['user_nps_urutan'] = $baris['user_nps_urutan']+1;
		
		$baris['user_nps'] = $baris['user_nps_tahun'] . '.' . sprintf("%03d", $baris['user_nps_urutan']);
		
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($baris);
	}
	
	function ambildatabyid(){		
		$id = $this->input->post('id');
		$users = $this->m->ambilbyid(array('user_id'=>$id,'pengaturan_key'=>$this->pengaturan_key),'users');
		
		
		$baris = array();
		
		foreach ($users->result_array() as $row){
			$baris['user_id'] = $row['user_id'];	
			$baris['username'] = $row['username'];	
			$baris['password'] = $row['password'];	
			$baris['user_nama'] = $row['user_nama'];
			
			$baris['user_foto'] = base_url('img/user.jpg');
			if( !empty($row['user_foto']) && file_exists('uploads/user/' . $row['user_foto'] ) ){
				$baris['user_foto'] = base_url('uploads/user/' . $row['user_foto']);					
			}
			
			$baris['user_level'] = $row['user_level'];
			$baris['user_alamat'] = $row['user_alamat'];
			$baris['user_jk'] = $row['user_jk'];
			$baris['kelas'] = $row['kelas'];
			$baris['jurusan_id'] = $row['jurusan_id'];
			$baris['ruang'] = $row['ruang'];
			$baris['panding'] = $row['panding'];
			$baris['tanggal_dibuat'] = $row['tanggal_dibuat'];
			$baris['tanggal_diubah'] = $row['tanggal_diubah'];
			$baris['user_last_active'] = $row['user_last_active'];	
			
		}
		
		
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($baris);
	}
	
	
	function tambahdata(){						
		
		$user_level = $this->input->post('user_level');
		$user_nps = $this->input->post('user_nps');
		$user_nps_tahun = $this->input->post('user_nps_tahun');
		$user_nps_urutan = $this->input->post('user_nps_urutan');
		$user_nama = $this->input->post('user_nama');
		$user_jk = $this->input->post('user_jk');
		$user_alamat = $this->input->post('user_alamat');
		$kelas = $this->input->post('kelas');
		$jurusan_id = $this->input->post('jurusan_id');
		$ruang = $this->input->post('ruang');
		$panding = $this->input->post('panding');
		$tanggal_dibuat = date('Y-m-d H:i:s');
		
		if( $user_nama == ""){
			$result['pesan'] = "Nama user Kosong!";
		}else{
			$result['pesan'] = "";
			
			$username = $this->m->generatateuser( $user_nama );
			$password = $username;
			
			$data =  array(
				'user_level' => $user_level,
				'user_nps' => $user_nps,
				'user_nps_tahun' => $user_nps_tahun,
				'user_nps_urutan' => $user_nps_urutan,
				'username' => $username,
				'password' => $password,
				'user_nama' => $user_nama,
				'user_jk' => $user_jk,
				'user_alamat' => $user_alamat,
				'kelas' => $kelas,
				'jurusan_id' => $jurusan_id,
				'ruang' => $ruang,
				'panding' => $panding,
				'tanggal_dibuat' => $tanggal_dibuat,
				'pengaturan_key'=>$this->pengaturan_key
			);
			$this->db->insert('users',$data);
			$id = $this->db->insert_id();
			
		}
		
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	function simpandatabyid(){
		$id = $this->input->post('id');
		
		$user_level = $this->input->post('user_level');
		$user_nama = $this->input->post('user_nama');
		$user_jk = $this->input->post('user_jk');
		$user_alamat = $this->input->post('user_alamat');
		$kelas = $this->input->post('kelas');
		$jurusan_id = $this->input->post('jurusan_id');
		$ruang = $this->input->post('ruang');
		$panding = $this->input->post('panding');
		$tanggal_diubah = date('Y-m-d H:i:s');
		
		if( $user_nama == ""){
			$result['pesan'] = "Nama user Kosong!";
		}else{
			$result['pesan'] = "";
			$data =  array(
				'user_level' => $user_level,
				'user_nama' => $user_nama,
				'user_jk' => $user_jk,
				'user_alamat' => $user_alamat,
				'kelas' => $kelas,
				'jurusan_id' => $jurusan_id,
				'ruang' => $ruang,
				'panding' => $panding,
				'tanggal_diubah' => $tanggal_diubah
			);
			$this->m->simpanbyid($data,array('user_id'=>$id,'pengaturan_key'=>$this->pengaturan_key),'users');
			
		}
		
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	function hapusdatabyid(){
		$id = $this->input->post('id');	
		
		$this->m->hapusbyid(array('user_id'=>$id,'pengaturan_key'=>$this->pengaturan_key),'users');		
		
	}
	
}
?>