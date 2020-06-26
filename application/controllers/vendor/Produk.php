<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	var $table = 'tb_produk';
	var $tableuser = 'tb_vendor';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('vendor_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("vendor/welcome").'")
			</script>';
		}
		$this->load->model('m_produk','Model');
		$this->load->helper('rupiah');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_vendor();
		}
	}

	public function index()
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();	
			$data['title'] = ' Daftar Produk';
			$this->load->view('vendor/temp-header',$data);
			$this->load->view('vendor/v_produk');
			$this->load->view('vendor/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
	}

	//tambah
	public function tambah()
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();	
			$data['title'] = 'Tambah Produk';
			$data['kat'] =$this->db->order_by('nama', 'asc');
			$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
			$this->load->view('vendor/temp-header',$data);
			$this->load->view('vendor/v_produk-tambah',$data);
			$this->load->view('vendor/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	//proses tambah
	public function proses()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'id_kategori','label' => "Kategori Produk",'rules' => 'required' ),
			array('field' => 'nama','label' => 'Nama Produk','rules' => 'required',),
			array('field' => 'harga','label' => 'Harga Produk','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'deskripsi','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			$this->_Values();
			redirect('vendor/produk/tambah','refresh');
		}else{
			$DataUser  = array('nama' => $this->input->post('nama'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$this->_Values();
				$this->session->set_flashdata('error', 'Nama Produk Sama / Tidak Boleh Duplikat');
				redirect('vendor/produk/tambah','refresh');
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'id_kategori' => $this->input->post('id_kategori'),
					'id_vendor' => $this->session->userdata('id'),
					'nama' => $this->input->post('nama'),
					'tgl' => date("Y-m-d"),
					'harga' => $this->input->post('harga'),
					'kuantitas_penjualan' => $this->input->post('kp'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug
				);
				
				$gambar = $_FILES['gambar']['name'];
				if(!empty($gambar))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				$this->DButama->AddDB($this->table,$data);
				redirect('vendor/produk','refresh');
			}
		}
	}

	//edit
	public function edit($id)
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
			if ($cek1->num_rows() == 1) {
				$data['produk'] = $cek1->row();
				$data['profil'] = $cek->row();
				$data['title'] = 'Edit Produk';
				$data['kat'] =$this->db->order_by('nama', 'asc');
				$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
				$this->load->view('vendor/temp-header',$data);
				$this->load->view('vendor/v_produk-edit',$data);
				$this->load->view('vendor/temp-footer');
			}else{
				redirect('error404','refresh');
			}
		}else{
			redirect('error404','refresh');
		}
	}

	public function proses_edit()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'id_kategori','label' => "Kategori Produk",'rules' => 'required' ),
			array('field' => 'nama','label' => 'Nama Produk','rules' => 'required',),
			array('field' => 'harga','label' => 'Harga Produk','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'deskripsi','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('vendor/produk/edit/'.$this->input->post('id'),'refresh');
		}else{

			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$where_username = array('nama' => $this->input->post('nama'));
			$cari_username = $this->DButama->GetDBWhere($this->table,$where_username);

			 // jika username tidak di ganti
			if ($row->nama == $this->input->post('nama')) {

				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'id_kategori' => $this->input->post('id_kategori'),
					'nama' => $this->input->post('nama'),
					'tgl' => date("Y-m-d"),
					'harga' => $this->input->post('harga'),
					'kuantitas_penjualan' => $this->input->post('kp'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug,
				);

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('vendor/produk','refresh');
        // jika username di ganti ternyata duplikat
			}elseif ($cari_username->num_rows() == 1) {
            # code...
				$this->session->set_flashdata('error', 'Nama Produk Sama / Tidak Boleh Duplikat');
				redirect('vendor/produk/edit/'.$this->input->post('id'),'refresh');
        // jika username di ganti
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'id_kategori' => $this->input->post('id_kategori'),
					'nama' => $this->input->post('nama'),
					'tgl' => date("Y-m-d"),
					'harga' => $this->input->post('harga'),
					'kuantitas_penjualan' => $this->input->post('kp'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug,
				);
				
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('vendor/produk','refresh');
			}
		}
	}

	private function _Values()
	{
		$this->session->set_flashdata('nama', set_value('nama') );
		$this->session->set_flashdata('id_kategori', set_value('id_kategori') );
		$this->session->set_flashdata('harga', set_value('harga') );
		$this->session->set_flashdata('deskripsi', set_value('deskripsi') );
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/produk/';
		$config['allowed_types'] = 'jpg|png';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	$this->_Values();
        	// redirect('vendor/produk/tambah','refresh');
        	echo $this->_Values();
        }
        return $this->upload->data('file_name');
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/vendor/Produk.php */