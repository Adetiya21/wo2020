<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Anda Harus Login!');";
			echo 'window.location.assign("'.site_url("welcome/keranjang").'")
			</script>';
			// redirect('admin/welcome');
		}
		$this->load->model('m_riwayat','Model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		$title['title']='History';
		$this->load->view('utama/temp-header',$title);
		$this->load->view('utama/v_riwayat');
		$this->load->view('utama/temp-footer');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function detail($uri='')
	{
		$query = $this->DButama->GetDBWhere('tb_invoice', array('invoice' => $uri, 'email' => $this->session->userdata('email') ));
		if ($query->num_rows() == 1) {
			# code...
			$title['title']='Riwayat Pesanan';
			$this->load->view('utama/temp-header',$title);
			$row = $query->row();
			$data['invoice'] 	= $row;
			$data['orders'] 	= $this->DButama->GetDBWhere('tb_orders', array('code_invoice' => $uri, ));
			$this->load->view('utama/v_riwayat-detail',$data);
			$this->load->view('utama/temp-footer');
		}else{
			redirect('riwayat','refresh');
		}
	}

	public function addgbrinv($value='')
	{
		if ($this->input->method() == "post") {
			$query = $this->DButama->GetDBWhere('tb_invoice', array('invoice' => $this->input->post('invoice'), 'email' => $this->session->userdata('email'), 'status' => 'Menunggu Pembayaran',));
			if ($query->num_rows() == 1) {
				if ($this->input->post('submit_cancel')) { 
					$data = array('status' => 'Dibatalkan',);
					$where = array('invoice' => $this->input->post('invoice') , 'email' => $this->session->userdata('email')  );
	      				$this->DButama->UpdateDB('tb_invoice',$where,$data);
			        	redirect('riwayat/detail/'.$this->input->post('invoice'),'refresh');
				}else{
					$config['upload_path']   = 'assets/front_end/inv/';
					$config['allowed_types'] = 'jpg|png';
					$config['remove_spaces'] = TRUE;
					$config['encrypt_name']  = TRUE;
		        	$config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
			        $this->load->library('upload', $config);
			        if(!$this->upload->do_upload('gambar')) //upload and validate
			        {
			        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
			        	redirect('riwayat/detail/'.$this->input->post('invoice'),'refresh');
			        }else{

			        	$gambar = $this->upload->data('file_name');
			        	$data = array(
			        		'gambar' => $gambar,
			        		'status' => 'Proses',
			        	);
			        	$where = array('invoice' => $this->input->post('invoice') , 'email' => $this->session->userdata('email')  );
	      				$this->DButama->UpdateDB('tb_invoice',$where,$data);
	      				echo '<script type="text/javascript">alert("Bukti Pembayaran Berhasil Dikirim");</script>';
			        	redirect('riwayat/detail/'.$this->input->post('invoice'),'refresh');
			        }
		    	}
		    }else{
		    	redirect('history','refresh');
		    }
		}
	}

}

/* End of file Riwayat.php */
/* Location: ./application/controllers/Riwayat.php */