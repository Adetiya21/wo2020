<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_produk extends CI_Controller {

	var $table = 'tb_invoice';
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
		$this->load->model('m_pesanan','Model');
		$this->load->helper('rupiah');
	}

	public function saya()
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();	
			$data['title'] = 'Daftar Pesanan Produk Saya';
			$this->load->view('vendor/temp-header',$data);
			$this->load->view('vendor/v_invoice-saya');
			$this->load->view('vendor/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_vendor_saya();
		}
	}

	 //edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));
			$data = array(
				'status' => $this->input->post('status')
			);
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
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

	public function detail($id)
	{
		$cek1 = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek1->num_rows() == 1) {
			$data['profil'] = $cek1->row();	
			$cek = $this->DButama->GetDBWhere('tb_invoice',array('invoice'=> $id));
			if ($cek->num_rows() == 1) {
				$data['title'] = 'Detail Pesanan';
				$invoice = $cek->row();
				$data['invoice'] = $cek->row();
				$data['orders'] 	= $this->DButama->GetDBWhere('tb_orders', array('code_invoice' => $id, ));
				$data['pemesan'] 	= $this->DButama->GetDBWhere('tb_member', array('email' => $invoice->email, ))->result();
				$this->load->view('vendor/temp-header',$data);
				$this->load->view('vendor/v_invoice-detail',$data);
				$this->load->view('vendor/temp-footer');
			} else {
				redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}

}

/* End of file Pesanan_produk.php */
/* Location: ./application/controllers/vendor/Pesanan_produk.php */