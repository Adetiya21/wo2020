<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Anda belum login!');";
			echo 'window.location.assign("'.site_url("welcome/cart").'")
			</script>';
			// redirect('admin/welcome');
		}
	}

	public function index()
	{

		$title['title'] = 'Akun Saya';
		$this->load->view('utama/temp-header',$title);
		$data['users'] = $this->DButama->GetDBWhere('tb_member', array('email' => $this->session->userdata('email'), ))->row();
		$this->load->view('utama/v_akun',$data);
		$this->load->view('utama/temp-footer');
	}

	public function proses_edit($value='')
	{
		$this->load->library('form_validation');
		if ($this->input->method() == "post") {
			$config = array(
				array('field' => 'nama','label' => "Nama",'rules' => 'required' ),
				array('field' => 'alamat','label' => "Alamat",'rules' => 'required' ),
				array('field' => 'no_telp','label' => "No Telp",'rules' => 'required' ),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error', validation_errors());
				redirect('Address/tambah','refresh');
			}else{
				$data = array(
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
				);

				$where = array('email' => $this->session->userdata('email') );
				$this->DButama->UpdateDB('tb_member',$where,$data);

				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('akun','refresh');
			}
		}
	}

	public function cek_password()
	{
		# code...
		if ($this->input->method() == "post") {
			if (!empty($this->input->post('old_password'))) {
				$old_password = $this->input->post('old_password');
				$query = $this->DButama->GetDBWhere('tb_member',array('email' => $this->session->userdata('email'), ));
				$row = $query->row();
				if (password_verify($old_password, $row->password)) {
					echo 'true'; 
				} else {
					echo 'false'; 
				}
			}
		}
	}

	public function add_password()
	{
		if ($this->input->method() == "post") {
			$where = array('email' => $this->session->userdata('email'), );
			$password =  $this->DButama->GetDBWhere('tb_member', $where)->row()->password;
			if ($password == null) {
				if ($this->input->post('password') == $this->input->post('cpassword')) {
					$hash = $hash=password_hash($this->input->post('password'), PASSWORD_DEFAULT);	
					$data = array('password' => $hash, );
					$this->DButama->UpdateDB('tb_member',$where,$data);
					echo "<script>alert('Add Your Password Success');history.go(-1);</script>";
				}else{
					echo "<script>alert('Your password and Re Enter Password not valid');history.go(-1);</script>";
				}
			}else{
				redirect('account','refresh');
			}
		}
	}

	public function proses_ganti_password()
	{
		if ($this->input->method() == "post") {
		# code...
			$old_password = $this->input->post('old_password');
			$pass=$this->input->post('password');
			$where = array('email' => $this->session->userdata('email') );
			$query = $this->DButama->GetDBWhere('tb_member',$where);
			$row = $query->row();
			if (password_verify($old_password, $row->password)) {
				$hash=password_hash($pass, PASSWORD_DEFAULT);	
				$data = array(
					'password' => $hash,
				);
				$this->DButama->UpdateDB('tb_member',$where,$data);
				echo "<script>
				alert('Change Password Success');";
				echo 'window.location.assign("'.site_url("akun").'")
				</script>';	
			} else {
				echo "<script>
				alert('Change Password Failed');";
				echo 'window.location.assign("'.site_url("akun").'")
				</script>';	
			}
		}

	}

}

/* End of file Akun.php */
/* Location: ./application/controllers/Akun.php */