<?php
defined('BASEPATH') or exit();

class My extends CI_Model{
	
	
	function getpengaturan($pengaturan_key){
		$pengaturan = $this->db->get_where('pengaturan',array(
			'pengaturan_key'=>$pengaturan_key
		))->result();
		
		return $pengaturan[0]->pengaturan_value;
	}
	
	function getdata($tabel){
		return $this->db->get($tabel)->result();
	}
	
	function tambahdata($data,$tabel){
		$this->db->insert($tabel,$data);
	}
	
	function ambilbyid($where,$tabel){
		return $this->db->get_where($tabel,$where);
	}
	
	function simpanbyid($data,$where,$tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}
	
	function hapusbyid($where,$tabel){
		$this->db->where($where);		
		$this->db->delete($tabel);
	}
	
	function getRows($params = array(),$args = array()){
        $this->db->select('*');
        $this->db->from($args['tabel']);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like($args['sortByTitle'],$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by($args['sortByTitle'],$params['search']['sortBy']);
        }else{
            $this->db->order_by($args['orderby'],'desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }



    function getMerek($jurusan_id){
        $jurusan_text = "";

        $x = json_decode($this->m->getpengaturan('Merek'));
        foreach ($x as $k => $v){
            if($jurusan_id == $v->jurusan_kode){
                $jurusan_text = $v->jurusan_nama;
            }
        }

        return $jurusan_text;
    }



}

?>