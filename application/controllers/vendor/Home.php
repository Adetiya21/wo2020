<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_vendor';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('vendor_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("vendor/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();
			$data['title'] = 'Dashboard';
			
			$data['kategori'] = $this->DButama->GetDB('tb_kategori_produk')->num_rows();
			
			$data['produk'] = $this->DButama->GetDB('tb_produk')->num_rows();
			$data['produk_saya'] = $this->DButama->GetDBWhere('tb_produk', array('id_vendor' => $this->session->userdata('id') ))->num_rows();
			
			$data['invoice'] = $this->DButama->GetDB('tb_invoice')->num_rows();
			$data['pesanan'] = $this->DButama->GetDB('tb_orders')->num_rows();
			$data['pesanan_saya'] = $this->DButama->GetDBWhere('tb_orders', array('nama_vendor' => $this->session->userdata('nama') ))->num_rows();
			// $data['guru'] = $this->DButama->GetDBWhere('tb_guru', array('id_mapel' => $this->session->userdata('id_mapel') ))->num_rows();
			// $data['kelas'] = $this->DButama->GetDBWhere('tb_kelas', array('id' => $this->session->userdata('id_kelas') ))->row();
			// $data['mapel'] = $this->DButama->GetDBWhere('tb_mapel', array('id' => $this->session->userdata('id_mapel') ))->row();

			// $where = array('tb_nilaisiswa.id_mapel' => $this->session->userdata('id_mapel'));
			// $where1 = array('tb_nilaisiswa.id_kelas' => $this->session->userdata('id_kelas'));
			// $query = $this->db->where($where);
			// $query = $this->db->where($where1);	
			// $query = $this->db->select('id, sum(h1) as jh1, sum(h2) as jh2, sum(h3) as jh3, sum(uts) as juts, sum(uas) as juas, sum(total) as jtotal, sum(rata) as jrata');	
			// $query = $this->db->from('tb_nilaisiswa');
			// $query = $this->db->get();
			// $data['nilai'] = $query->row();
			
			$this->load->view('vendor/temp-header',$data);
			$this->load->view('vendor/v_index',$data);
			$this->load->view('vendor/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	public function profil()
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $this->session->userdata('id')));
		if ($cek->num_rows() == 1) {
			$data['title'] = 'Profil';
			$data['profil'] = $cek->row();
			$this->load->view('vendor/temp-header',$data);
			$this->load->view('vendor/v_profil',$data);
			$this->load->view('vendor/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'no_telp','label' => 'No.Telp','rules' => 'required|numeric',),
			array('field' => 'email','label' => 'Email','rules' => 'required|valid_email',),
			array('field' => 'password','label' => 'Password','rules' => 'required'),
			array('field' => 'alamat','label' => 'alamat','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('vendor/home/profil/'.$this->session->userdata('id').'','refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$data = array(
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'alamat' => $this->input->post('alamat'),
				'password' => $hash
			);

			if(!empty($_FILES['gambar']['name']))
			{
				$upload = $this->_do_upload();
				$data['gambar'] = $upload;
			}
			$sess_data['nama'] = $this->input->post('nama');
			$this->session->set_userdata($sess_data);
			$this->DButama->UpdateDB($this->table,$where,$data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Akun anda sudah diperbaharui</strong> 
						</div>');
			redirect('vendor/home/profil/','refresh');
		
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/vendor/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	// redirect('/home/profil/'.$this->session->userdata('id').'','refresh');
        }
        return $this->upload->data('file_name');
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/vendor/Home.php */