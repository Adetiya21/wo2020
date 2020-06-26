<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends CI_Controller {

	var $table = 'tb_produk';
	var $tableuser = 'tb_vendor';
	var $tableulasan = 'tb_ulasan';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('vendor_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("vendor/welcome").'")
			</script>';
		}
		$this->load->model('m_ulasan','Model');
	}

	public function json($id) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_vendor($id);
		}
	}

	//ulasan
	public function produk($id)
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
			if ($cek1->num_rows() == 1) {
				$data['pr']=$id;
				$data['produk'] = $cek1->row();
				$data['profil'] = $cek->row();
				$data['title'] = 'Ulasan Produk';
				$data['kat'] =$this->db->order_by('nama', 'asc');
				$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
				$data['ulasan'] =$this->db->order_by('nama', 'asc');
				$data['ulasan'] = $this->DButama->GetDB('tb_ulasan');
				$this->load->view('vendor/temp-header',$data);
				$this->load->view('vendor/v_ulasan',$data);
				$this->load->view('vendor/temp-footer');
			}else{
				redirect('error404','refresh');
			}
		}else{
			redirect('error404','refresh');
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->tableulasan,$where)->row();
			$this->DButama->DeleteDB($this->tableulasan,$where);
			echo json_encode(array("status" => TRUE));
		}
	}



}

/* End of file Ulasan.php */
/* Location: ./application/controllers/vendor/Ulasan.php */