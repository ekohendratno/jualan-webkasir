<?php

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
		
		$this->load->model('My','m');
        $this->load->library('upload');
		
    }

    function index(){		
		
		$level = $this->session->userdata('user_level');
		if ( $level == 'admin' ) redirect('admin/dashboard');
		else $this->load->view('auth/login');
		
    }
	
	function profile(){		
		
		if(!$this->session->userdata('user_level')){
			redirect('auth');
		}
		
		$users_data = $this->session->userdata();
		$users_data = $this->getUsersDetail($users_data);	
		
		$this->load->view('auth/profile',$users_data);
	}
	
	function sandi(){		
		
		if(!$this->session->userdata('user_level')){
			redirect('auth');
		}
		
		$users_data = $this->session->userdata();
		$users_data = $this->getUsersDetail($users_data);	
		
		$this->load->view('auth/sandi',$users_data);
	}
	
	function signin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
			
		$data = array();
		if(empty($username) || empty($password)){			
			$data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password kosong!</div>';
		}else{		

			$this->db->where(array(
					'username'=> $username,
					'password'=> $password
			));

			$users_data = $this->db->get('users')->row_array();
			$users_data = $this->getUsersDetail($users_data);

			if ( !empty($users_data) && $users_data['user_level'] == 'admin' ) {
				
				$this->session->set_userdata($users_data);
				$data['pesan'] = '';
				$data['redirect'] = 'admin/dashboard';
			}else{
				$data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password tidak sesuai!</div>';
				$data['redirect'] = 'auth';
			}
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
		
	}

    function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
	
	
	function getUsersDetail($users){
		$baris = array();
		$baris['user_id'] = $users['user_id'];	
		$baris['username'] = $users['username'];	
		$baris['password'] = $users['password'];
		$baris['user_foto'] = $users['user_foto'];
        $baris['user_level'] = $users['user_level'];
			
		
		return $baris;
	}


    function do_upload(){
        $config['upload_path'] = './uploads/users/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
        $config['file_name'] = $this->session->userdata('user_id');
        $config['overwrite'] = true;
        $config['max_size'] = 1024; // 1MB

        $hasil['pesan'] = '';
        $this->upload->initialize($config);
        if(!empty($_FILES['file']['name'])){

            if ($this->upload->do_upload('file')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./uploads/users/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 300;
                $config['height']= 300;
                $config['new_image']= './uploads/users/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $this->simpan_upload($gambar);
                $hasil['pesan'] = "Image berhasil diupload";
                $hasil['ok'] = 1;
            }

        }else{
            $hasil['pesan'] = "Image yang diupload kosong";
            $hasil['ok'] = 0;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($hasil);
    }

    function simpan_upload($image){
        $where = array( 'user_id' => $this->session->userdata('user_id') );
        $data = array( 'user_foto' => $image );

        $users = $this->db->get_where('users',$where)->result();

        unlink('uploads/users/' . $users[0]->user_foto);

        $this->db->where($where);
        $result = $this->db->update('users',$data);
        $this->session->set_userdata(array('user_foto' => $image));

        return $result;
    }
}