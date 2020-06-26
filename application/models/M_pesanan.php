<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan extends CI_Model {

	var $table = 'tb_invoice';
	var $tablesaya = 'tb_orders';

	public function json() {
		$this->datatables->select("tb_invoice.id,tb_invoice.invoice,tb_invoice.tgl,
			IF(tb_invoice.status = 'Menunggu Pembayaran','<span class=\"label label-warning\">Menunggu Pembayaran</span>',
			IF(tb_invoice.status = 'Proses', '<span class=\"label label-primary\">Proses</span>',
			IF(tb_invoice.status = 'Pembayaran Dikonfirmasi','<span class=\"label label-primary\">Pembayaran Dikonfirmasi</span>',
			IF(tb_invoice.status ='Dikirim','<span class=\"label label-success\">Dikirim</span>',
			IF(tb_invoice.status ='Selesai','<span class=\"label label-info\">Selesai</span>',
			IF(tb_invoice.status ='Dibatalkan','<span class=\"label label-danger\">Dibatalkan</span>','Error' )))))) as status
			,CONCAT('Rp.',tb_invoice.total) as total, tb_invoice.payment,tb_invoice.email");
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '
			<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url("admin/pesanan/detail/$1").'"><span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($2)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($2)" > <span class="fa fa-trash"></span></a>
			</div>', 'invoice,id');
		$this->datatables->join('tb_orders','tb_orders.code_invoice = tb_invoice.invoice');
		$this->datatables->group_by('tb_invoice.invoice');
		return $this->datatables->generate();
	}

	public function json_vendor() {
		$this->datatables->select("tb_invoice.id,tb_invoice.invoice,tb_invoice.tgl,
			IF(tb_invoice.status = 'Menunggu Pembayaran','<span class=\"label label-warning\">Menunggu Pembayaran</span>',
			IF(tb_invoice.status = 'Proses', '<span class=\"label label-primary\">Proses</span>',
			IF(tb_invoice.status = 'Pembayaran Dikonfirmasi','<span class=\"label label-primary\">Pembayaran Dikonfirmasi</span>',
			IF(tb_invoice.status ='Dikirim','<span class=\"label label-success\">Dikirim</span>',
			IF(tb_invoice.status ='Selesai','<span class=\"label label-info\">Selesai</span>',
			IF(tb_invoice.status ='Dibatalkan','<span class=\"label label-danger\">Dibatalkan</span>','Error' )))))) as status
			,CONCAT('Rp.',tb_invoice.total) as total, tb_invoice.payment,tb_invoice.email");
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '
			<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url("vendor/pesanan/detail/$1").'"><span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($2)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($2)" > <span class="fa fa-trash"></span></a>
			</div>', 'invoice,id');
		$this->datatables->join('tb_orders','tb_orders.code_invoice = tb_invoice.invoice');
		$this->datatables->group_by('tb_invoice.invoice');
		return $this->datatables->generate();
	}

	public function json_vendor_saya() {
		$this->datatables->select("tb_orders.id,tb_orders.code_invoice,tb_orders.qty,tb_orders.nama_produk,tb_orders.harga_produk,tb_orders.gambar_produk,tb_orders.tgl_booking,tb_orders.slug,tb_orders.nama_vendor,
			tb_invoice.invoice,tb_invoice.tgl,
			IF(tb_invoice.status = 'Menunggu Pembayaran','<span class=\"label label-warning\">Menunggu Pembayaran</span>',
			IF(tb_invoice.status = 'Proses', '<span class=\"label label-primary\">Proses</span>',
			IF(tb_invoice.status = 'Pembayaran Dikonfirmasi','<span class=\"label label-primary\">Pembayaran Dikonfirmasi</span>',
			IF(tb_invoice.status ='Dikirim','<span class=\"label label-success\">Dikirim</span>',
			IF(tb_invoice.status ='Selesai','<span class=\"label label-info\">Selesai</span>',
			IF(tb_invoice.status ='Dibatalkan','<span class=\"label label-danger\">Dibatalkan</span>','Error' )))))) as status
			,tb_invoice.total, tb_invoice.email");
		$this->datatables->from($this->tablesaya);
		$this->datatables->where('tb_orders.nama_vendor', $this->session->userdata('nama'));
		$this->datatables->add_column('view', '
			<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url("vendor/pesanan/detail/$1").'"><span class="fa fa-eye"></span></a>
			</div>', 'invoice,id');
		$this->datatables->join('tb_invoice','tb_invoice.invoice = tb_orders.code_invoice');
		return $this->datatables->generate();
	}

}

/* End of file M_pesanan.php */
/* Location: ./application/models/M_pesanan.php */