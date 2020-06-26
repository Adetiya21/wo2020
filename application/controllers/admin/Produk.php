<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	var $table = 'tb_produk';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_produk','Model');
		$this->load->helper('rupiah');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_admin();
		}
	}

	public function index()
	{
		$data['title'] = 'Daftar Produk';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_produk');
		$this->load->view('admin/temp-footer');
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
		$data['title'] = 'Tambah Produk';
		$data['kat'] =$this->db->order_by('nama', 'asc');
		$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
		$data['ven'] =$this->db->order_by('nama', 'asc');
		$data['ven'] = $this->DButama->GetDB('tb_vendor');
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_produk-tambah',$data);
		$this->load->view('admin/temp-footer');
	}

	//proses tambah
	public function proses()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'id_kategori','label' => "Kategori Produk",'rules' => 'required' ),
			array('field' => 'id_vendor','label' => "Nama Vendor",'rules' => 'required' ),
			array('field' => 'nama','label' => 'Nama Produk','rules' => 'required',),
			array('field' => 'harga','label' => 'Harga Produk','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'deskripsi','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			$this->_Values();
			redirect('admin/produk/tambah','refresh');
		}else{
			$DataUser  = array('nama' => $this->input->post('nama'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$this->_Values();
				$this->session->set_flashdata('error', 'Nama Produk Sama / Tidak Boleh Duplikat');
				redirect('admin/produk/tambah','refresh');
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'id_kategori' => $this->input->post('id_kategori'),
					'id_vendor' => $this->input->post('id_vendor'),
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
				redirect('admin/produk','refresh');
			}
		}
	}

    //edit
	public function edit($id)
	{
		$cek1 = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek1->num_rows() == 1) {
			$data['produk'] = $cek1->row();
			$data['title'] = 'Edit Produk';
			$data['kat'] =$this->db->order_by('nama', 'asc');
			$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
			$data['ven'] =$this->db->order_by('nama', 'asc');
			$data['ven'] = $this->DButama->GetDB('tb_vendor');
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_produk-edit',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
		
	}
	
	public function proses_edit()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'id_kategori','label' => "Kategori Produk",'rules' => 'required' ),
			array('field' => 'id_vendor','label' => "Nama Vendor",'rules' => 'required' ),
			array('field' => 'nama','label' => 'Nama Produk','rules' => 'required',),
			array('field' => 'harga','label' => 'Harga Produk','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'deskripsi','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/produk/edit/'.$this->input->post('id'),'refresh');
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
					'id_vendor' => $this->input->post('id_vendor'),
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
				redirect('admin/produk','refresh');
        // jika username di ganti ternyata duplikat
			}elseif ($cari_username->num_rows() == 1) {
            # code...
				$this->session->set_flashdata('error', 'Nama Produk Sama / Tidak Boleh Duplikat');
				redirect('admin/produk/edit/'.$this->input->post('id'),'refresh');
        // jika username di ganti
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'id_kategori' => $this->input->post('id_kategori'),
					'id_vendor' => $this->input->post('id_vendor'),
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
				redirect('admin/produk','refresh');
			}
		}
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
        	$data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
    	$data = array();
    	$data['error_string'] = array();
    	$data['inputerror'] = array();
    	$data['status'] = TRUE;

    	if($this->input->post('nama') == '')
    	{
    		$data['inputerror'][] = 'nama';
    		$data['error_string'][] = 'First name is required';
    		$data['status'] = FALSE;
    	} 

    	if($data['status'] === FALSE)
    	{
    		echo json_encode($data);
    		exit();
    	}
    }

    private function _Values()
	{
		$this->session->set_flashdata('nama', set_value('nama') );
		$this->session->set_flashdata('id_kategori', set_value('id_kategori') );
		$this->session->set_flashdata('id_vendor', set_value('id_vendor') );
		$this->session->set_flashdata('harga', set_value('harga') );
		$this->session->set_flashdata('deskripsi', set_value('deskripsi') );
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */