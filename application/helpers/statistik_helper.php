<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('buatStatistik')) {
    function buatStatistik()
    {
        $CI =& get_instance();

        $ip = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
        $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
        $waktu = time(); //

        $s = $CI->db->get_where('statistik', array('statistik_ip' => $ip, 'statistik_tanggal' => $tanggal));

        if ($s->num_rows() > 0) {
            $r = $s->result_array();


            $data = array(
                'statistik_hit' => $r[0]['statistik_hit'] + 1,
            );
            $CI->db->where(array(
                    'statistik_online' => $waktu,
                    'statistik_ip' => $ip,
                    'statistik_tanggal' => $tanggal
                )
            );
            $CI->db->update('statistik',$data);
        } else {
            $data = array(
                'statistik_hit' => 1,
                'statistik_online' => $waktu,
                'statistik_ip' => $ip,
                'statistik_tanggal' => $tanggal
            );
            $CI->db->insert('statistik', $data);
        }
    }
}