<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $table = 'tb_vendor';

	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('vendor/v_login');
	}

	public function login()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('vendor','refresh');
		} else {
			$this->load->library('form_validation');
			$config = array(
				array('field' => 'email','label' => "email",'rules' => 'required' ),
				array('field' => 'password','label' => 'Password','rules' => 'required',)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('email', set_value('email') );
				$this->session->set_flashdata('password', set_value('password') );
				$this->session->set_flashdata('error', validation_errors());
				redirect('vendor','refresh');
			}else{
				$query = $this->DButama->GetDBWhere('tb_vendor', array('email' => $this->input->post('email')));
				if ($query->num_rows() == 0 ) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email / Password Tidak Ada</strong> 
						</div>');
					redirect('vendor','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['vendor_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['email'] = $key->email;
							$sess_data['id'] = $key->id;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('user_logged_in');
							redirect('vendor/home/profil', 'refresh');
						}
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Email / Password Tidak Ada</strong> 
							</div>');
						redirect('vendor','refresh');
					}
				}
			}
		}
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('vendor/welcome','refresh');
	}

	public function form_daftar()
	{
		$this->load->view('vendor/v_daftar');
	}

	function daftar()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama Vendor','rules' => 'required',),
			array('field' => 'email','label' => 'Email','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('vendor/welcome/form_daftar','refresh');
		}else{
			$DataUser  = array('email' => $this->input->post('email'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				// $this->_Values();
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Email sudah terdaftar</strong> 
							</div>');
				redirect('welcome/form_daftar','refresh');
			}else{
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'password' => $hash
				);

				$this->DButama->AddDB($this->table,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah terdaftar, silahkan lakukan login</strong> 
							</div>');
				redirect('vendor/welcome','refresh');
			}
		}
	}

}

/* End of file Welcome.php */
/* Location: ./application/controllers/vendor/Welcome.php */