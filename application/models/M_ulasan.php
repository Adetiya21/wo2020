<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ulasan extends CI_Model {

	var $table = 'tb_ulasan';

	public function json_vendor($id) {
		$this->datatables->select('tb_produk.nama as nama_produk, tb_produk.gambar, tb_produk.slug,
			tb_ulasan.id as id_ulasan, tb_ulasan.nama, tb_ulasan.ulasan, tb_ulasan.rating_1, tb_ulasan.rating_2, tb_ulasan.rating_3, tb_ulasan.rating_4, tb_ulasan.rating_5, tb_ulasan.tgl');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_produk', 'tb_ulasan.id_produk=tb_produk.id');
		$this->datatables->where('tb_ulasan.id_produk', $id);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id_ulasan');
		return $this->datatables->generate();
	}

}

/* End of file M_ulasan.php */
/* Location: ./application/models/M_ulasan.php */