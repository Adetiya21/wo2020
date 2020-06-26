<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk_gambar extends CI_Model {

	var $table = 'tb_gambar_produk';

	public function json($where='') {
		$this->datatables->select('id,gambar');
		$this->datatables->where($where);
		$this->datatables->from($this->table);
		$this->datatables->add_column('gambar','<div align="center"> <img src="'.base_url('assets/assets/img/produk/').'$1" class="img-thumbnail img-circle" width="100" height="100"></div>', 'gambar');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}	

}

/* End of file M_produk_gambar.php */
/* Location: ./application/models/M_produk_gambar.php */