<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $table = 'tb_kategori_produk';

	function __construct()
	{
		parent::__construct();
		$this->load->helper('rupiah');
	}

	public function get_tokens($value="") {
		if ($this->session->userdata('hmproject') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

	public function index()
	{
		$data['title'] = 'Selamat Datang';
		$data['kategory_produk'] =  $this->db->order_by('nama', 'asc');
		$data['kategory_produk'] = $this->DButama->GetDB('tb_kategori_produk');
		$data['pr'] = $this->db->order_by('tgl', 'desc');
		$data['pr'] = $this->db->limit('5');
		$data['pr'] = $this->DButama->GetDB('tb_produk');
        $data['ven'] = $this->DButama->GetDB('tb_vendor');
        $this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_index',$data);
		$this->load->view('utama/temp-footer');
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('welcome','refresh');
	}

	function add_cart()
    {
        if ($this->input->is_ajax_request()) {
            $where  = array('id' => $this->input->post('id') );
            $produk = $this->DButama->GetDBWhere('tb_produk', $where)->row();
            $data = array(
                'id'      => $produk->id,
                'qty'     => 1,
                'price'   => $produk->harga,
                'name'    => $produk->nama,
                'vendor'    => $this->input->post('vendor'),
                'image'  => $produk->gambar,
                'slug' => $produk->slug,
                'tgl' => $this->input->post('tgl'),
            );
            
            $this->cart->insert($data);
        $total_items = $this->cart->total_items(); //count total items
        die(json_encode(array('items'=>$total_items))); //output json
        }
    }

    function cart()
	{
		$title['title']='Keranjang';
		$this->load->view('utama/temp-header',$title);
		$this->load->view('utama/v_cart');
		$this->load->view('utama/temp-footer');
	}

	function update_cart()
	{
		$rowid = $this->input->post('rowid');
		$data = array(
			'rowid' => $rowid,
			'qty' => $this->input->post('qty'),
			'tgl' => $this->input->post('tgl'),
		);
		$this->cart->update($data);
		redirect('welcome/cart','refresh');
	}

	function delete_cart($rowid)
	{
		$data = array(
			'rowid'   => $rowid,
			'qty'     => 0
		);
		$this->cart->update($data);
		redirect('welcome/cart','refresh');
	}

	//input
	public function tambah()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('welcome','refresh');
		} else {
			if ($this->input->is_ajax_request()) {
				$DataUser  = array('email' => $this->input->post('email'));
				if ($this->DButama->GetDBWhere('tb_member',$DataUser)->num_rows() == 1) {
					$data = array();
					$data['inputerror'][] = 'email';
					$data['error_string'][] = 'email sudah ada / tidak boleh duplikat';
					$data['status'] = FALSE;
					echo json_encode($data);
					exit();
				}else{
					$slug = url_title($this->input->post('nama'), 'dash', TRUE);
					$pass=$this->input->post('password');
					$hash=password_hash($pass, PASSWORD_DEFAULT);
					$data = array(
						'id' => $this->input->post('id'),
						'nama' => $this->input->post('nama'),
						'email' => $this->input->post('email'),
						'password' => $hash,
						'slug' => $slug
					);
					$this->DButama->AddDB('tb_member',$data);
					echo json_encode(array("status" => TRUE));
				}
			}
		}
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
			redirect('welcome','refresh');
		} else {
			if ($this->input->is_ajax_request()) {
				$query = $this->DButama->GetDBWhere('tb_member', array('email' => $this->input->post('email'), ));
				if ($query->num_rows() == 0 ) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email / Password Tidak Ada</strong> 
						</div>');
					redirect('welcome','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['user_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['slug'] = $key->slug;
							$sess_data['email'] = $key->email;
							$sess_data['id'] = $key->id;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('vendor_logged_in');
							$page = $_SERVER['PHP_SELF'];
							$sec = "1";
							header("Refresh: $sec; url=$page");
							// redirect('akun','refresh');
							echo json_encode(array("status" => TRUE));
						}
					}
				}
			}
		}
	}

}
