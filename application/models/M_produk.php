<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

	var $table = 'tb_produk';

	public function json_vendor() {
		$this->datatables->select('tb_produk.id as id_produk, tb_produk.id_kategori, tb_produk.id_vendor, tb_produk.nama,
			tb_produk.harga, tb_produk.kuantitas_penjualan, tb_produk.deskripsi, tb_produk.gambar, tb_produk.slug, tb_produk.tgl,
			tb_kategori_produk.nama as nama_kategori,
			tb_vendor.id, tb_vendor.nama as nama_vendor');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kategori_produk', 'tb_produk.id_kategori=tb_kategori_produk.id');
		$this->datatables->join('tb_vendor', 'tb_produk.id_vendor=tb_vendor.id');
		$this->datatables->where('tb_produk.id_vendor', $this->session->userdata('id'));
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url('produk/detail/$2').'" target="_blank"><span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="'.site_url('vendor/produk/edit/$1').'" ><span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a><br><br>
			<a class="btn btn-success btn-rounded btn-sm" href="'.site_url('vendor/produk_gambar/i/$1').'" target="_blank"><span class="fa fa-plus"></span> Gambar</a>	
			<a class="btn btn-success btn-rounded btn-sm" href="'.site_url('vendor/produk_video/i/$1').'" target="_blank"><span class="fa fa-plus"></span> Video</a><hr>	
			<a class="btn btn-info btn-rounded btn-sm" href="'.site_url('vendor/ulasan/produk/$1').'" target="_blank"><span class="fa fa-comment"></span> Ulasan</a>
			</div>', 'id_produk,slug');
		return $this->datatables->generate();
	}

	public function json_admin() {
		$this->datatables->select('tb_produk.id as id_produk, tb_produk.id_kategori, tb_produk.id_vendor, tb_produk.nama,
			tb_produk.harga, tb_produk.kuantitas_penjualan, tb_produk.deskripsi, tb_produk.gambar, tb_produk.slug, tb_produk.tgl,
			tb_kategori_produk.nama as nama_kategori,
			tb_vendor.id, tb_vendor.nama as nama_vendor');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kategori_produk', 'tb_produk.id_kategori=tb_kategori_produk.id');
		$this->datatables->join('tb_vendor', 'tb_produk.id_vendor=tb_vendor.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url('produk/detail/$2').'" target="_blank"><span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="'.site_url('admin/produk/edit/$1').'" ><span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a><br><br>
			<a class="btn btn-success btn-rounded btn-sm" href="'.site_url('admin/produk_gambar/i/$1').'" target="_blank"><span class="fa fa-plus"></span> Gambar</a>
			<a class="btn btn-success btn-rounded btn-sm" href="'.site_url('admin/produk_video/i/$1').'" target="_blank"><span class="fa fa-plus"></span> Video</a><hr>
			<a class="btn btn-info btn-rounded btn-sm" href="'.site_url('admin/ulasan/produk/$1').'" target="_blank"><span class="fa fa-comment"></span> Ulasan</a>
			</div>', 'id_produk,slug');
		return $this->datatables->generate();
	}

}

/* End of file M_produk.php */
/* Location: ./application/models/M_produk.php */