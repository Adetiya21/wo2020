<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_video extends CI_Controller {

	var $table = 'tb_video_produk';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('M_produk_video','Model');
		$this->load->helper('rupiah');
	}


	public function i($id)
	{
		$cek = $this->DButama->GetDBWhere('tb_produk',array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$data['title'] = ' Tambah Video Produk';
			$data['produk'] = $cek->row();
			$data['kategory_produk'] = $this->DButama->GetDBWhere('tb_kategori_produk', array('id' => $cek->row()->id_kategori, ))->row()->nama;
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_produk-video',$data);
			$this->load->view('admin/temp-footer');
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

		$config['upload_path']   = 'assets/assets/video/produk/';
		$config['allowed_types'] = 'video/x-msvideo|video/mpeg|MP4|mp4|avi|3gp|flv';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
		$config['max_size']  = '200000';
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('video')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	redirect('admin/produk_video/i/'.$this->input->post('id_produk'),'refresh');
        	exit();
        }
        $video = $this->upload->data('file_name');
        $data = array(
        	'id_produk' => $this->input->post('id_produk'),
        	'video' => $video,
        	 );
        $this->DButama->AddDB($this->table,$data);
        redirect('admin/produk_video/i/'.$this->input->post('id_produk'),'refresh');
    	}

	}

}

/* End of file Produk_video.php */
/* Location: ./application/controllers/admin/Produk_video.php */