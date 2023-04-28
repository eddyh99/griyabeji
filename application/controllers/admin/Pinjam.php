<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    $this->load->model("admin/storeModel");
	    $this->load->model("admin/produkModel");
	    $this->load->model("admin/pinjamModel");
	    $this->load->model("admin/opnameModel");
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }

	public function index(){
	    $store=$this->storeModel->liststore();
		
        $data = array(
            'title'		=> 'Stok Out',
            'content'	=> 'admin/pinjam/index',
            'extra'	    => 'admin/pinjam/js/js_index',
            'store'     => $store,
			'mn_pinjam' => 'active',
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'breadcrumb' => '/ Stock Out'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata(){
		// $store	    = $this->security->xss_clean($this->input->post('store'));
		// $result		= $this->pinjamModel->listnota($store);
		$result = array(
			array(
				"id"			=> "1",
				"tanggal"		=> "2023-04-13",
				"storeid"		=> "1",
				"nama"			=> "Boy William",
				"keterangan"	=> "Ini Keterangan",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
			array(
				"id"			=> "2",
				"tanggal"		=> "2023-04-05",
				"storeid"		=> "2",
				"nama"			=> "Kevin Anggar ",
				"keterangan"	=> "Ini Keterangan Kevin",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
			array(
				"id"			=> "3",
				"tanggal"		=> "2023-04-03",
				"storeid"		=> "1",
				"nama"			=> "yanyiik",
				"keterangan"	=> "Ini Keterangan yanyiik",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
		);
		echo json_encode($result);
	}
    
    public function tutup($id){
		$id	    = $this->security->xss_clean($id);
	    $result  = $this->pinjamModel->setTutup($id);
		$this->session->set_flashdata('message', "Data berhasil tersimpan");
		redirect(base_url()."admin/pinjam");

    }
    
	public function detailpinjam($key){
		// $produk     = $this->produkModel->listproduk();
		// print_r(json_encode($produk));
		// die;
		$produk = array(
			array(
				"barcode"		=> "0000000000000",
				"namaproduk"	=> "Gelang Sakti",
				"namabrand"		=> "Gelang karet",
				"namakategori"	=> "Gelang",
				"status"		=> "1",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
			array(
				"barcode"		=> "0000000000000",
				"namaproduk"	=> "Gelang Sakti",
				"namabrand"		=> "Gelang karet",
				"namakategori"	=> "Gelang",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
		);
		// print_r(json_encode($produk));
		// die;

        $data = array(
            'title'		=> 'Detail Stok Out',
            'content'	=> 'admin/pinjam/detail',
            'extra'	    => 'admin/pinjam/js/js_detail',
			'mn_pinjam' => 'active',
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'produk'    => $produk,
			'key'       => $key,
			'breadcrumb' => '/ Stok Out / Detail'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function listpinjam(){
		// $key	 = $this->security->xss_clean($this->input->post('key'));
	    // $result  = $this->pinjamModel->getDetail($key);
		$result = array(
			array(
				"barcode"		=> "0000000000000",
				"namaproduk"	=> "Baju",
				"namabrand"		=> "Gelang karet",
				"namakategori"	=> "Gelang",
				"status"		=> "1",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24",
				"size"			=> "M", 
				"jumlah"		=> "100",
				"key"			=> "key"
			),
			array(
				"barcode"		=> "0000000000000",
				"namaproduk"	=> "Gelang Sakti",
				"namabrand"		=> "Gelang karet",
				"namakategori"	=> "Gelang",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24",
				"size"			=> "L", 
				"jumlah"		=> "200",
				"key"			=> "key"
			),
		);
	    echo json_encode($result);
	}
	
    public function tambah(){
		$produk     = $this->produkModel->listproduk();
        $data = array(
            'title'		 => 'Tambah Data Peminjaman',
            'content'	 => 'admin/pinjam/tambah',
            'extra'	     => 'admin/pinjam/js/js_tambah',
            'extracss'	 => 'admin/pinjam/css/css_tambah',
			'mn_pinjam'  => 'active',
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'produk'     => $produk,
		);
		$this->load->view('layout/wrapper', $data);
    }
	public function AddData(){
		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
		$barang     = json_decode($this->security->xss_clean($this->input->post('barang')));
        $userid		= $_SESSION["logged_status"]["username"];
        $storeid    = $_SESSION["logged_status"]["storeid"];
        
        $data		= array(
            "nama"          => $nama,
            "storeid"       => $storeid,
            "keterangan"    => $keterangan,
            "userid"        => $userid
        );

		$result		= $this->pinjamModel->insertData($data,$barang);
		if ($result){
    		$this->session->set_flashdata('message', "Data berhasil tersimpan");
		}else{
    		$this->session->set_flashdata('message', "Data gagal tersimpan");
		}
	}


    public function simpandata(){
		$id = $this->security->xss_clean($this->input->post('id'));
		$barang = json_decode($this->security->xss_clean($this->input->post('barang')));
		$result=$this->pinjamModel->setKembali($id,$barang);
		echo "0";
	}

}
