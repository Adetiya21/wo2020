<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {

	public function index()
	{
		$title['title']='Tentang Kami';
		$this->load->view('utama/temp-header',$title);
		$this->load->view('utama/v_tentang');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Tentang.php */
/* Location: ./application/controllers/Tentang.php */