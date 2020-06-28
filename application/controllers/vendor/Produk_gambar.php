<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_gambar extends CI_Controller {

	var $table = 'tb_gambar_produk';
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
		$this->load->model('M_produk_gambar','Model');
		$this->load->helper('rupiah');
	}


	public function i($id)
	{
		$cek1 = $this->DButama->GetDBWhere($this->tableuser,array('id'=> $this->session->userdata('id')));
		if ($cek1->num_rows() == 1) {
			$data['profil'] = $cek1->row();	
			$cek = $this->DButama->GetDBWhere('tb_produk',array('id'=> $id, 'id_vendor' => $this->session->userdata('id')));
			if ($cek->num_rows() == 1) {
				$data['title'] = ' Tambah Gambar Produk';
				$data['produk'] = $cek->row();
				$data['kategory_produk'] = $this->DButama->GetDBWhere('tb_kategori_produk', array('id' => $cek->row()->id_kategori, ))->row()->nama;
				$this->load->view('vendor/temp-header',$data);
				$this->load->view('vendor/v_produk-gambar',$data);
				$this->load->view('vendor/temp-footer');
			} else {
				redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}

	public function json($id) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			$where = array('id_produk' => $id, );
			echo $this->Model->json($where);
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

	public function proses()
	{
		if ($this->input->method() == "post") {

		$config['upload_path']   = 'assets/assets/img/produk/';
		$config['allowed_types'] = 'jpg|png';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	redirect('vendor/produk_gambar/i/'.$this->input->post('id_produk'),'refresh');
        	exit();
        }
        $gambar = $this->upload->data('file_name');
        $data = array(
        	'id_produk' => $this->input->post('id_produk'),
        	'gambar' => $gambar,
        	 );
        $this->DButama->AddDB($this->table,$data);
        redirect('vendor/produk_gambar/i/'.$this->input->post('id_produk'),'refresh');
    	}

	}

}

/* End of file Produk_gambar.php */
/* Location: ./application/controllers/vendor/Produk_gambar.php */