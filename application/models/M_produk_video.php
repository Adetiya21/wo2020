<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk_video extends CI_Model {

	var $table = 'tb_video_produk';

	public function json($where='') {
		$this->datatables->select('id,video');
		$this->datatables->where($where);
		$this->datatables->from($this->table);
		$this->datatables->add_column('video','<div align="center"> <video width="500px" controls><source src="'.base_url('assets/assets/video/produk/').'$1"></video></div>', 'video');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_produk_video.php */
/* Location: ./application/models/M_produk_video.php */