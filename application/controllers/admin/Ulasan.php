<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends CI_Controller {

	var $table = 'tb_produk';
	var $tableulasan = 'tb_ulasan';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
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
		$cek1 = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek1->num_rows() == 1) {
			$data['pr']=$id;
			$data['produk'] = $cek1->row();
			$data['title'] = 'Ulasan Produk';
			$data['kat'] =$this->db->order_by('nama', 'asc');
			$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
			$data['ulasan'] =$this->db->order_by('nama', 'asc');
			$data['ulasan'] = $this->DButama->GetDB('tb_ulasan');
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_ulasan',$data);
			$this->load->view('admin/temp-footer');
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
/* Location: ./application/controllers/admin/Ulasan.php */