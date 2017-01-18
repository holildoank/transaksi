<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_base extends CI_Model {

    public function get_data($nama_table, $filter='', $select='', $order_by='')
    {
        if(!empty($filter)){
            $this->db->where($filter);
        }

        if(!empty($select)){
            $this->db->select($select);
        }

        if(!empty($order_by)){
            $this->db->order_by($order_by['nama_kolom'], $order_by['order']);
        }

        return $this->db->get($nama_table);
    }


    public function insert_data($nama_table, $data, $get_id='')
    {
        $this->db->insert($nama_table, $data);
        if($this->db->affected_rows()>0){
            $result['stat'] = true;
            if($get_id){
                $result['last_id'] = $this->db->insert_id();
            }
        }else{
            $result['stat'] = false;
        }
        return $result;
    }

    public function update_data($nama_table, $data, $filter)
    {
        $this->db->where($filter);
        $this->db->update($nama_table, $data);
        $result['stat'] = true;
        return $result;
    }

    public function delete_data($nama_table, $filter)
    {
        $this->db->where($filter);
        $this->db->delete($nama_table);
        if($this->db->affected_rows()>0){
            $result['stat'] = true;
        }else{
            $result['stat'] = false;
        }
        return $result;
    }

    public function upload_pic_contact()
    {
        $config['upload_path'] = './assets/uploads/contact/';
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size']  = '90000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('contact_photo')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }
        else{
            $upload_data = $this->upload->data();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );
        }
        return $result;
    }

}


