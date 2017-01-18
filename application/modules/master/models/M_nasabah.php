<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nasabah extends CI_Model{
    public function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "NIK";
        $dataorder[2] = "NAMA";
        $dataorder[3] = "ALAMAT";
        $dataorder[4] = "EMAIL";
        $dataorder[5] = "TELP";
        $dataorder[6] = "TEMPAT_LAHIR";
        $dataorder[7] = "TGL_LAHIR";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // end hak akses

        $query = "
        select
        *
        from nasabah
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(NIK, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(NAMA, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(ALAMAT, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(EMAIL, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(TEMPAT_LAHIR, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if($order){
            $query .= "order by ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }

        $iTotalRecords  = $this->db->query("SELECT COUNT(*) AS numrows FROM (".$query.") A")->row()->numrows;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        // $iDisplayStart  = intval($_REQUEST['start']);
        $query          .= " LIMIT ". ($start) .",".($iDisplayLength);

        $data = $this->db->query($query)->result();
        $i = 0;
        $result = array();
        foreach ($data as $d) {
            $i++;
            $id = $d->ID_NASABAH;

            $view = '';
            $edit = '';
            $delete = '';

                 $edit='<a  href="'.site_url().'nasabah/update/'.$id.'"  class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
                $delete='<a href="#" onclick="event.preventDefault();btn_delete_nasabah('.$id.')" class="icon-action" title="delete">
                <i class="fa fa-times"></i>
                </a> ';
                $transaksi='  <a class="btn btn blue btn-sm" href="'.site_url().'nasabah/transaksi/'.$id.'" > Transaksi </a>';


            $r = array();
            $r[0] = $i;
            $r[1] = $d->NIK;
            $r[2] = $d->NAMA;
            $r[3] = $d->ALAMAT;
            $r[4] = $d->EMAIL;
            $r[5] = $d->TELP;
            $r[6] = $d->TEMPAT_LAHIR;
            $r[7] = ($d->TGL_LAHIR > 0 ) ? date('d M Y',strtotime($d->TGL_LAHIR)): '';
            $r[8] = $edit.$delete.$transaksi;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

  public function upload_foto(){
        $config['upload_path'] = './assets/custom/uploads/nasabah/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('FOTO')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }
        else{
            // $upload_data = $this->upload->data();
            $upload_data = $this->upload->data();
            $config['image_library']  = 'gd2';
            $config['source_image']   = $config['upload_path']. $upload_data['file_name'];
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 80;
            $config['height']         = 80;
            // $config['max_width']  = '1024';
            //  $config['max_height']  = '768'
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );
        }
        return $result;
    }

 public function ajax_list_transaksi($id) {
        $dataorder    = array();
        $dataorder[1] = "NOMINAL";
        $dataorder[2] = "TGL_TRANSAKSI";
        $dataorder[3] = "TIPE";
       

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");

        // end hak akses

        $query = "
        select
        *
        from tabungan
        where ID_NASABAH =$id
        ";

        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(NOMINAL, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(TIPE, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if($order){
            $query .= "order by ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }

        $iTotalRecords  = $this->db->query("SELECT COUNT(*) AS numrows FROM (".$query.") A")->row()->numrows;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        // $iDisplayStart  = intval($_REQUEST['start']);
        $query          .= " LIMIT ". ($start) .",".($iDisplayLength);

        $data = $this->db->query($query)->result();
        $i = 0;
        $result = array();
        foreach ($data as $d) {
            $i++;
            $id = $d->ID_TABUNGAN;

            $view = '';
            $edit = '';
            $delete = '';

                 $edit='<a  href="'.site_url().'nasabah/update_transaksi/'.$id.'"  class="icon-action" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
               

            $r = array();
            $r[0] = $i;
            $r[1] = '<span style="float:right">'.number_format($d->NOMINAL, 0, ',', '.').'</span>';;
            $r[2] = ($d->TGL_TRANSAKSI > 0 ) ? date('d M Y',strtotime($d->TGL_TRANSAKSI)): '';
            $r[3] = $d->TIPE=='y' ? 'KREDIT' : 'FDEBIT';
            $r[4] = $edit;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

}
