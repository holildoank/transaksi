<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tanggal'))
{
    function tanggal($var = '')
    {
        $tgl = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $pecah = explode("-", $var);
        return $pecah[2]." ".$tgl[$pecah[1] - 1]." ".$pecah[0];
    }
}

if ( ! function_exists('get_new_id'))
{
    function get_new_id($table = '', $primary='')
    {
        $ci =& get_instance();
        $ci->db->select_max($primary, 'max_id');
        $sql = $ci->db->get($table);
        $max_id = $sql->row()->max_id;
        if($max_id == null){
            return 1;
        }else{
            $new_id = $max_id + 1;
            return $new_id;
        }
    }
}

if ( ! function_exists('cekData'))
{
    function cekData($table = '', $where='')
    {
        $ci =& get_instance();
        $ci->db->where($where);
        $sql = $ci->db->get($table);
        if($sql->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}


