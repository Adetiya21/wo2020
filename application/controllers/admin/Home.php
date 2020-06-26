<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_admin';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
			// redirect('admin/welcome');
		}
	}

	public function index()
	{
		$title = array('title' => 'Dashboard', );
		$data['vendor'] = $this->DButama->GetDB('tb_vendor')->num_rows();
		$data['admin'] = $this->DButama->GetDB('tb_admin')->num_rows();
		$data['member'] = $this->DButama->GetDB('tb_member')->num_rows();
		$data['kategori'] = $this->DButama->GetDB('tb_kategori_produk')->num_rows();
		$data['produk'] = $this->DButama->GetDB('tb_produk')->num_rows();
		$data['invoice'] = $this->DButama->GetDB('tb_invoice')->num_rows();

		$data['ventunggu'] = $this->DButama->GetDBWhere('tb_vendor', array('status' => 'Menunggu'))->num_rows();
		$data['venterima'] = $this->DButama->GetDBWhere('tb_vendor', array('status' => 'Diterima'))->num_rows();

		$data['imp'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Menunggu Pembayaran'))->num_rows();
		$data['ip'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Proses'))->num_rows();
		$data['ipd'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Pembayaran Dikonfirmasi'))->num_rows();
		$data['idk'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Dikirim'))->num_rows();
		$data['isl'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Selesai'))->num_rows();
		$data['idb'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Dibatalkan'))->num_rows();
		
		$data['title'] = 'Dashboard';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_index');
		$this->load->view('admin/temp-footer');
	}

	public function profil($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();
			$data['title'] = 'Profil';
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_profil',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'username','label' => 'Username','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(

					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $hash
				);
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');		
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */