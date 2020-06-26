<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Anda belum login!');";
			echo 'window.location.assign("'.site_url("welcome/cart").'")
			</script>';
		}
		if ($this->cart->total_items() == 0) {
			echo "<script>
			alert('Your cart is empty');";
			echo 'window.location.assign("'.site_url("welcome/cart").'")
			</script>';
		}
		$this->load->model('m_checkout','checkout');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		$title['title']='Checkout';
		$this->load->view('utama/temp-header',$title);
		// $data['alamat']   = $this->DButama->GetDBWhere('alamat', array('email' => $this->session->userdata('email'), ));
		$this->load->view('utama/v_checkout');
		$this->load->view('utama/temp-footer');
	}

	public function payment()
	{
		# code...
		$title['title']='Checkout';
		$this->load->view('utama/temp-header',$title);
		$this->load->view('utama/v_payment');
		$this->load->view('utama/temp-footer');
	}

	public function order_review()
	{
		$title['title']='Checkout';
		$this->load->view('utama/temp-header',$title);
		$this->load->view('utama/v_order-review');
		$this->load->view('utama/temp-footer');
	}

	public function proses_checkout3()
	{
		
		$sess_data['payment'] = $this->input->post('payment');
		$this->session->set_userdata($sess_data);
		redirect('checkout/order_review','refresh');
	}

	public function proses_checkout4()
	{
		if ($this->session->userdata('payment') !='') {
			$cek = $this->DButama->GetDBWhere('tb_member', array('id' => $this->session->userdata('id'), 'email' => $this->session->userdata('email')));
			if ($cek->num_rows() == 0) {
				redirect('checkout','refresh');
			}else{
				$invoice_id =  $this->checkout->find_invoice();
				$invoice 	= array(
					'invoice' => $invoice_id,
					'tgl' => date('Y-m-d H:i:s'),
					'email' => $this->session->userdata('email'),
					'status'  => 'Menunggu Pembayaran',
					'payment' => $this->session->userdata('payment'),
					'total' => $this->cart->total(),
				);
				$add1 = $this->DButama->AddDB('tb_invoice',$invoice);
				foreach ($this->cart->contents() as $items) {
					$slug = url_title($items['name'], 'dash', TRUE);
					$orders = array(
						'code_invoice' => $invoice_id,
						'nama_produk' => $items['name'],
						'qty' => $items['qty'],
						'tgl_booking' => $items['tgl'],
						'harga_produk' => $items['price'],
						'gambar_produk' => $items['image'],
						'nama_vendor' => $items['vendor'],
						'slug' => $slug,
					);
					$add2 = $this->DButama->AddDB('tb_orders',$orders);
				}
				$this->cart->destroy();
				$this->session->unset_userdata(array('payment'));
				redirect('riwayat','refresh');
			}
		}else{
			redirect('checkout','refresh');
		}

	}

}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */