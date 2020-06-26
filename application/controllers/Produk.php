<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('rupiah');
	}

	public function i($url='',$page=0)
    {
        $cek = $this->DButama->GetDBWhere('tb_kategori_produk', array('slug' => $url, ));
        if ($cek->num_rows() == 1) {
            $row = $cek->row();
            $title['title']= $row->nama;
            $data['slug']= $row->slug;
            $this->load->view('utama/temp-header',$title);

            $where = array('id_kategori' => $row->id, );
            $query =  $this->db->order_by('nama', 'asc');
            $query = $this->DButama->GetDBWhere('tb_produk', array('id_kategori' => $row->id, ));
            $jml = $query;

            $config['base_url'] = base_url('').'produk/i/'.$url.'/';
            $config['total_rows'] = $jml->num_rows();;
            $config['per_page'] = 9;
            $config['uri_segment'] = 4;

            /*Class bootstrap pagination yang digunakan*/
            $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";

            $this->pagination->initialize($config);

            $data['halaman'] = $this->pagination->create_links();
            $query = $this->db->order_by('tgl', 'desc');
            $query = $this->db->where(array('id_kategori' => $row->id, ));
            $query = $this->db->get('tb_produk', $config['per_page'], abs($page));
            $data['produk'] = $query;
            $data['ven'] = $this->DButama->GetDB('tb_vendor');
            $data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
            $this->load->view('utama/v_produk',$data);
            $this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

    function semua($page=0)
    {
        $title['title']='Semua Produk';
        $query =  $this->db->order_by('nama', 'asc');
        $query = $this->DButama->GetDB('tb_produk');
        $jml = $query;

        $config['base_url'] = base_url('').'produk/semua/';
        $config['total_rows'] = $jml->num_rows();;
        $config['per_page'] = 9;
        $config['uri_segment'] = 3;

        /*Class bootstrap pagination yang digunakan*/
        $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $data['halaman']    = $this->pagination->create_links();
        $query = $this->db->order_by('tgl', 'desc');
        $query = $this->db->get('tb_produk', $config['per_page'], $page);
        $data['produk'] = $query;
        $data['ven'] = $this->DButama->GetDB('tb_vendor');
        $data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
        $this->load->view('utama/temp-header',$title);
        $this->load->view('utama/v_produk',$data);
        $this->load->view('utama/temp-footer');
    }

    function detail($url)
    {
        $cek = $this->DButama->GetDBWhere('tb_produk', array('slug' => $url, ));
        if ($cek->num_rows() == 1) {
            $data_id = $cek->row()->id;
            $nama_data = $cek->row()->nama;
            $title['title']='Detail Product | '.$nama_data;
            $where  = array('tb_produk.id' => $data_id, );
            $query = $this->db->select('tb_produk.id,tb_produk.id_vendor,tb_produk.nama,tb_produk.deskripsi,tb_produk.harga,tb_produk.kuantitas_penjualan,tb_produk.tgl,tb_produk.gambar,tb_kategori_produk.nama as nama_kategory');
            $query = $this->db->where($where);
            $query = $this->db->from('tb_produk');
            $query = $this->db->join('tb_kategori_produk', 'tb_produk.id_kategori = tb_kategori_produk.id', 'left');
            $query = $this->db->get();
            $data['produk'] = $query;

            $query = $this->db->where(array('id_produk' => $data_id, ));
            $query = $this->db->order_by('tgl', 'DESC');
            $query = $this->db->get('tb_ulasan');
            $data['ulasan'] = $query;

            $query = $this->DButama->GetDBWhere('tb_gambar_produk', array('id_produk' => $data_id, ));
            $data['gambar_produk'] = $query;

            $ul=0;$ul1=0;$ul2=0;$ul3=0;$ul4=0;
            $jm=1;$jml=0;

            $ulas=$this->db->from('tb_ulasan');
            $ulas=$this->db->where('id_produk',$data_id );
            $ulas=$this->db->get();
            foreach ($ulas->result() as $key0) {
                $ul=$ul+$key0->rating_1;
                $ul1=$ul1+$key0->rating_2;
                $ul2=$ul2+$key0->rating_3;
                $ul3=$ul3+$key0->rating_4;
                $ul4=$ul4+$key0->rating_5;
            }
            $j5=5*$ul4;
            $j4=4*$ul3;
            $j3=3*$ul2;
            $j2=2*$ul1;
            $j1=1*$ul;
            $jml=$j5+$j4+$j3+$j2+$j1;
            $jm=$ul+$ul1+$ul2+$ul3+$ul4;
            error_reporting(0);
            $jumlah=$jml/$jm;
            $data['r1']=$ul;
            $data['r2']=$ul1;
            $data['r3']=$ul2;
            $data['r4']=$ul3;
            $data['r5']=$ul4;
            $data['jumlah']=$jumlah;

            $data['ven'] = $this->DButama->GetDB('tb_vendor');
            $this->load->view('utama/temp-header',$title);
            $this->load->view('utama/v_detail',$data);
            $this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

    function add_cart()
    {
        if ($this->input->is_ajax_request()) {
            $where  = array('id' => $this->input->post('id'), );
            $produk = $this->DButama->GetDBWhere('tb_produk', $where)->row();
            $data = array(
                'id'	=> $produk->id,
                'qty'	=> 1,
                'harga'	=> $produk->harga,
                'name'	=> $produk->nama,
                'image'	=> $produk->gambar,
                'slug'	=> $produk->slug,
            );
            $this->cart->insert($data);
        $total_items = $this->cart->total_items(); //count total items
        die(json_encode(array('items'=>$total_items))); //output json
        }
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */