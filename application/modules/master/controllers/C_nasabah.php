<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nasabah extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_nasabah');

		
	}
	public function index()
	{
		$data['judul'] = 'Data Nasabah';
		$this->template->load('base/template','v_nasabah', $data);
	}

	public function ajax_list(){
		$records = $this->m_nasabah->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode']  = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah Nasabah';
		$this->template->load('base/template','v_nasabah_form', $data);
	}

	public function create_action() {
		$NIK= $this->input->post('NIK');
		$cek_nik= $this->m_base->get_data('nasabah', array('NIK' => $NIK));
		if ($cek_nik->num_rows() > 0) {
            $result['stat'] = false;
            $result['pesan'] = 'Nik tersebut sudah Terdaftar. Silahkan ganti dengan Nik yang lain.';
        }else{
				if(!empty($_FILES['FOTO']['name'])){
					$upload = $this->m_nasabah->upload_foto();
					if($upload['stat']){
						$FOTO = $upload['data']['file_name'];
						$data = array(
		                    'NIK'    =>$this->input->post('NIK'),
							'NAMA' => $this->input->post('NAMA'),
							'ALAMAT'      => $this->input->post('ALAMAT'),
							'EMAIL'    => $this->input->post('EMAIL'),
							'TGL_LAHIR'  => date('Y-m-d', strtotime($this->input->post('TGL_LAHIR'))),
							'TELP'	=>$this->input->post('TELP'),
							'TEMPAT_LAHIR'      => $this->input->post('TEMPAT_LAHIR'),
							'FOTO'       => $FOTO,

			            );
						$result = $this->m_base->insert_data('nasabah', $data);
						$this->session->set_flashdata('notif_type','success');
						$this->session->set_flashdata('notif_pesan','Data Nasabah Barus berhasil ditambahkan.');
					}
					else{
						$result = $upload;
						$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
					}
				}
				else{
					$data = array(
						'NIK'    =>$this->input->post('NIK'),
							'NAMA' => $this->input->post('NAMA'),
							'ALAMAT'      => $this->input->post('ALAMAT'),
							'EMAIL'    => $this->input->post('EMAIL'),
							'TGL_LAHIR'  => date('Y-m-d', strtotime($this->input->post('TGL_LAHIR'))),
							'TELP'	=>$this->input->post('TELP'),
							'TEMPAT_LAHIR'      => $this->input->post('TEMPAT_LAHIR'),
						);
					$result = $this->m_base->insert_data('nasabah', $data);
					$this->session->set_flashdata('notif_type','success');
					$this->session->set_flashdata('notif_pesan','Data nasabah Baru berhasil ditambahkan.');
				}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit Nasabah';
		$data['data_nasabah']   = $this->m_base->get_data('nasabah', array('ID_NASABAH'     => $id));
		$this->template->load('base/template','v_nasabah_form', $data);
	}

	public function update_action() {
		$filter = array(
			'ID_NASABAH' => $this->input->post('id')
		);
		if(!empty($_FILES['FOTO']['name'])){
			$upload = $this->m_nasabah->upload_foto();
			if($upload['stat']){
				$FOTO = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('nasabah', $filter, 'FOTO')->row()->FOTO;
				if ($last_photo!='') {
					if(file_exists('.assets/custom/uploads/nasabah/'.$last_photo)){
						unlink('.assets/custom/uploads/nasabah/'.$last_photo);
					}
				}
				if(!empty($this->input->post('FOTO'))){
					$data = array(
						 'NIK'    =>$this->input->post('NIK'),
							'NAMA' => $this->input->post('NAMA'),
							'ALAMAT'      => $this->input->post('ALAMAT'),
							'EMAIL'    => $this->input->post('EMAIL'),
							'TGL_LAHIR'  => date('Y-m-d', strtotime($this->input->post('TGL_LAHIR'))),
							'TELP'	=>$this->input->post('TELP'),
							'TEMPAT_LAHIR'      => $this->input->post('TEMPAT_LAHIR'),
							'FOTO'       => $FOTO,
					);
				}
				else{
					$data = array(
						 'NIK'    =>$this->input->post('NIK'),
							'NAMA' => $this->input->post('NAMA'),
							'ALAMAT'      => $this->input->post('ALAMAT'),
							'EMAIL'    => $this->input->post('EMAIL'),
							'TGL_LAHIR'  => date('Y-m-d', strtotime($this->input->post('TGL_LAHIR'))),
							'TELP'	=>$this->input->post('TELP'),
							'TEMPAT_LAHIR'      => $this->input->post('TEMPAT_LAHIR'),
							'FOTO'       => $FOTO,
					);
				}
				$result = $this->m_base->update_data('nasabah', $data, $filter);
				$this->session->set_flashdata('notif_type','success');
				$this->session->set_flashdata('notif_pesan','data nasabah berhasil di perbarui.');
			}
			else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}
		else{
			$data = array(
				 'NIK'    =>$this->input->post('NIK'),
							'NAMA' => $this->input->post('NAMA'),
							'ALAMAT'      => $this->input->post('ALAMAT'),
							'EMAIL'    => $this->input->post('EMAIL'),
							'TGL_LAHIR'  => date('Y-m-d', strtotime($this->input->post('TGL_LAHIR'))),
							'TELP'	=>$this->input->post('TELP'),
							'TEMPAT_LAHIR'      => $this->input->post('TEMPAT_LAHIR'),
							'FOTO'       => $FOTO,
			);
			$result = $this->m_base->update_data('nasabah', $data, $filter);
			$this->session->set_flashdata('notif_type','success');
			$this->session->set_flashdata('notif_pesan','data nasabah berhasil di perbarui.');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
    {
        $filter = array(
            'ID_NASABAH'    => $id,
        );
        $result = $this->m_base->delete_data('nasabah', $filter);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function transaksi($id)
	{
		$data['judul']       = '<i class="fa fa-pencil"></i> Data transaksi';
		$data['id'] = $id;
		$data['data_nasabah']   = $this->m_base->get_data('nasabah', array('ID_NASABAH'     => $id));
		$this->template->load('base/template','v_transaksi', $data);
	}
	public function ajax_list_transaksi(){
		$id=$this->input->post('id');
		$records = $this->m_nasabah->ajax_list_transaksi($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}
	public function create_transaksi($id)
	{
		$data['mode']  = 'add';
		$data['ID_NASABAH'] = $id;
		$data['judul'] = '<i class="fa fa-plus"></i> Form Tambah transaksi';
		$this->template->load('base/template','v_form_transaksi', $data);
	}
	public function create_action_transaksi()
	{
		$createat = date('Y-m-d');
        $ID_NASABAH = $this->input->post('ID_NASABAH');
       
            $data = array(
                'ID_NASABAH'    => $ID_NASABAH,
                'NOMINAL'         => $this->input->post('NOMINAL'),
                'TGL_TRANSAKSI' => $createat,
                'TIPE'    =>$this->input->post('TIPE'),
              
            );
            $result = $this->m_base->insert_data('tabungan', $data);
            
            $this->session->set_flashdata('notif_type','success');
			$this->session->set_flashdata('notif_pesan','transaksi Penambahan Saldo.');
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function update_transaksi($id)
	{
		$data['mode']        = 'edit';
		$data['judul']       = '<i class="fa fa-pencil"></i> Edit transaksi';
		$data['data_taransaksi']   = $this->m_base->get_data('tabungan', array('ID_TABUNGAN'     => $id));
		$this->template->load('base/template','v_form_transaksi', $data);
	}
	public function update_action_transaksi()
	{
		$createat = date('Y-m-d');

        $filter = array(
			'ID_TABUNGAN' => $this->input->post('id')
		);
            $data = array(
                'NOMINAL'         => $this->input->post('NOMINAL'),
                'TGL_TRANSAKSI' => $createat,
                'TIPE'    =>$this->input->post('TIPE'),
              
            );
 			$result = $this->m_base->update_data('tabungan', $data,$filter);
            $this->session->set_flashdata('notif_type','success');
			$this->session->set_flashdata('notif_pesan','Perbaruan transaksi Penambahan Saldo.');
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
