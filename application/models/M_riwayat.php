<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_riwayat extends CI_Model {

	var $table = 'tb_invoice';

	public function json() {
		$this->datatables->select("tb_invoice.id,tb_invoice.invoice,tb_invoice.tgl,
			IF(tb_invoice.status = 'Menunggu Pembayaran','<span class=\"label label-warning\">Menunggu Pembayaran</span>',
			IF(tb_invoice.status = 'Proses', '<span class=\"label label-primary\">Proses</span>',
			IF(tb_invoice.status = 'Pembayaran Dikonfirmasi','<span class=\"label label-primary\">Pembayaran Dikonfirmasi</span>',
			IF(tb_invoice.status ='Dikirim','<span class=\"label label-success\">Dikirim</span>',
			IF(tb_invoice.status ='Selesai','<span class=\"label label-info\">Selesai</span>',
			IF(tb_invoice.status ='Dibatalkan','<span class=\"label label-default\">Dibatalkan</span>','Error' )))))) as status
			,tb_invoice.total");
		// ,CONCAT('Rp. ',tb_invoice.total) as total");
		$where = array('email' => $this->session->userdata('email'), );
		$this->datatables->where($where);
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '
			<div align="center">
			<a href="'.site_url("riwayat/detail/$1").'" class="btn btn-template-main btn-sm" title="View"><i class="fa fa-eye"></i>View</a>
			</div>', 'invoice');
		$this->datatables->join('tb_orders','tb_orders.code_invoice = tb_invoice.invoice');
		$this->datatables->group_by('tb_invoice.invoice');
		return $this->datatables->generate();
	}

}

/* End of file M_riwayat.php */
/* Location: ./application/models/M_riwayat.php */