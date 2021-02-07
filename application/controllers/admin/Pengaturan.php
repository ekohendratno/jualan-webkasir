<?php
defined('BASEPATH') or exit();

class Pengaturan extends CI_Controller{
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
		$data['title'] = "Pangaturan";
        $data['instansi'] = $this->m->getpengaturan('Nama Sekolah');
        $data['welcome_message'] = $this->m->getpengaturan('Pesan Selamat Datang');
        $data['syaratnketentuan'] = $this->m->getpengaturan('SyaratNKetentuan');
        $data['tutup_ppdb'] = $this->m->getpengaturan('Tutup PPDB');
        $data['tampil_peserta'] = $this->m->getpengaturan('Tampil Peserta');
        $data['tanggal1'] = $this->m->getpengaturan('Tanggal1');
        $data['tanggal2'] = $this->m->getpengaturan('Tanggal2');
		
        $this->template->load('template','admin/pengaturan',$data);
	}

	function daftarta(){
		$users_pengaturan = $this->db->select('*')->from('ta')->order_by('ta_tahun','desc');

		//return $siswa->get()->result();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $users_pengaturan->get()->result());
	}

    function daftarjurusan(){
        $x = json_decode($this->m->getpengaturan('Jurusan'));

        //return $siswa->get()->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $x );
    }
	
	function republish(){
		$id = $this->input->post('id');

        $users_pengaturan = $this->db->select('*')->from('ta')->order_by('ta_tahun','desc');

        $updateArray = array();
        foreach ($users_pengaturan->get()->result() as $x){
            $updateArray[] = array('ta_id'=>$x->ta_id,'ta_aktif'=>0);
            //$this->m->simpanbyid(array('ta_aktif'=>0),array('ta_id'=>$x->id),'ta');
        }
        $this->db->update_batch('ta',$updateArray, 'ta_id'); 
		$this->m->simpanbyid(array('ta_aktif'=>1),array('ta_id'=>$id),'ta');

        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
	}
	
	function tambahdata(){				
		$tahun = $this->input->post('tahun');
		
		$data = array(
			'ta_tahun'=>$tahun,
		);

		$ada = $this->db->select('*')->from('ta')->where($data)->get();

		if($ada->num_rows() > 0) $result['pesan'] = "Data sudah ada!";
		else{
			$result['pesan'] = "";
			$this->db->insert('ta',$data);
			$id = $this->db->insert_id();
			$result['id'] = $id;
		}

	}


    function tambahdatajurusan(){
        $kode_jurusan = $this->input->post('kode_jurusan');
        $nama_jurusan = $this->input->post('nama_jurusan');

        $data_ = array();
        $x = json_decode($this->m->getpengaturan('Jurusan'));


        $a = 0;
        foreach ($x as $k => $v){
            $data_[] = $v;
            if($v->jurusan_kode == $kode_jurusan){
                $a = 1;
            }
        }

        if( $a < 1){
            $data_[] = array("jurusan_kode"=>$kode_jurusan,"jurusan_nama"=>$nama_jurusan);
        }

        $data = array(
            'pengaturan_value'=>json_encode($data_),
        );


        $where = array(
            'pengaturan_key'=>'Jurusan',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);

    }



    function simpandatainstansi(){
        $instansi = $this->input->post('instansi');

        $data = array(
            'pengaturan_value'=>$instansi,
        );


        $where = array(
            'pengaturan_key'=>'Nama Sekolah',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function simpandatatutupppdb(){
        $tutupppdb = $this->input->post('tutupppdb');

        $data = array(
            'pengaturan_value'=>$tutupppdb,
        );


        $where = array(
            'pengaturan_key'=>'Tutup PPDB',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function simpandatatampilpeserta(){
        $tampilpeserta = $this->input->post('tampilpeserta');

        $data = array(
            'pengaturan_value'=>$tampilpeserta,
        );


        $where = array(
            'pengaturan_key'=>'Tampil Peserta',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function simpandatalambatppdb(){
        $lambat_ppdb = $this->input->post('lambatppdb');

        $data = array(
            'pengaturan_value'=>$lambat_ppdb,
        );


        $where = array(
            'pengaturan_key'=>'Tanggal1',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }



    function simpandatatanggalppdb(){
        $tanggal_ppdb = $this->input->post('tanggalppdb');

        $data = array(
            'pengaturan_value'=>$tanggal_ppdb,
        );


        $where = array(
            'pengaturan_key'=>'Tanggal2',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function simpandatawelcomepessage(){
        $wm_text = stripcslashes( trim($this->input->post('wm_text', TRUE)) );

        $data = array(
            'pengaturan_value'=>$wm_text,
        );


        $where = array(
            'pengaturan_key'=>'Pesan Selamat Datang',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function resetwelcome(){

        $this->db->where( array(
            'pengaturan_key'=>"Pesan Selamat Datang"
        ));
        $this->db->delete('pengaturan');
    }

    function simpandatasyaratnketentuan(){
        $wm_text = stripcslashes( trim($this->input->post('wm_text', TRUE)) );

        $data = array(
            'pengaturan_value'=>$wm_text,
        );


        $where = array(
            'pengaturan_key'=>'SyaratNKetentuan',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function resetsyaratnketentuan(){

        $this->db->where( array(
            'pengaturan_key'=>"SyaratNKetentuan"
        ));
        $this->db->delete('pengaturan');
    }
	
	function hapusdatabyid(){			
		
		$id = $this->input->post('id');
		
		$this->db->where( array(
			'ta_id'=>$id,
		));
		$this->db->delete('ta');	
	}

    function hapusdatajurusanbyid(){

        $id = $this->input->post('id');

        $data_ = array();
        $x = json_decode($this->m->getpengaturan('Jurusan'));


        foreach ($x as $k => $v){
            if($v->jurusan_kode != $id) {
                $data_[] = $v;
            }
        }

        $data = array(
            'pengaturan_value'=>json_encode($data_ ),
        );


        $where = array(
            'pengaturan_key'=>'Jurusan',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function resetdataall(){

        $this->db->truncate('pengaturan');
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Nama Sekolah',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Pesan Selamat Datang',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Tutup PPDB',
            'pengaturan_value' => 'August 2, 2020 20:00:00'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Tampil Peserta',
            'pengaturan_value' => 'ya'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Jenjang Pendaftar',
            'pengaturan_value' => 'smp'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Tanggal1',
            'pengaturan_value' => '22 juli 2020'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Tanggal2',
            'pengaturan_value' => 'Candipuro, ..... Juni 2020'
        ));

        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Jurusan',
            'pengaturan_value' => '[{"jurusan_kode":"tkj","jurusan_nama":"Teknik Komputer dan Jaringan"},{"jurusan_kode":"tkr","jurusan_nama":"Teknik Kendaraan Ringan"},{"jurusan_kode":"tbsm","jurusan_nama":"Teknik Bisnis Sepeda Motor"},{"jurusan_kode":"otkp","jurusan_nama":"Administrasi Perkantoran"},{"jurusan_kode":"akp","jurusan_nama":"Akuntasi"}]'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'SyaratNKetentuan',
            'pengaturan_value' => '<p>Syarat dan ketentuan melakukkan pendaftaran antara lain:</p>
<ul>
<li>Siapkan kartu keluarga</li>
<li>Siapkan Total Nilai Raport Masing2x pelajaran semester pertama sampai terakhir</li>
<li>Jika telah melakukkan pendaftaran tunggu pengumuman diterima/tidak-nya pada tanggal 22 juni 2020</li>
<li>Jika pendaftaran kamu diterima cetak bukti PPDB</li>
<li>Untuk memeriksa pengumuman buka situs PPDB lalu cari berdasarkan NISN dihalaman depan situs PPDB atau ke sekolah</li>
</ul>
<p>Untuk kontak person bisa hubungi nomor berikut:</p>
<ul>
<li>Ibnu Ridho, S.Kom - WA. 0812 7894 7829</li>
<li>Eko Hendratno,S.Kom - WA. 0857 6964 1780</li>
</ul>
<p> </p>'
        ));



        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}

?>