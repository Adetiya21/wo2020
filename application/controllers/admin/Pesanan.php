<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	var $table = 'tb_invoice';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('You Must Login!');";
			echo 'window.location.assign("'.site_url("admin").'")
			</script>';
		}
		$this->load->model('m_pesanan','Model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		$title = array('title' => ' Daftar Pesanan', );
		$this->load->view('admin/temp-header',$title);
		$this->load->view('admin/v_invoice');
		$this->load->view('admin/temp-footer');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
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
		$cek = $this->DButama->GetDBWhere('tb_invoice',array('invoice'=> $id));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Detail Pesanan', );
			$invoice = $cek->row();
			$data['invoice'] = $cek->row();
			$data['orders'] 	= $this->DButama->GetDBWhere('tb_orders', array('code_invoice' => $id, ));
			$data['pemesan'] 	= $this->DButama->GetDBWhere('tb_member', array('email' => $invoice->email, ))->result();
			$this->load->view('admin/temp-header',$title);
			$this->load->view('admin/v_invoice-detail',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

}

/* End of file Pesanan.php */
/* Location: ./application/controllers/admin/Pesanan.php */