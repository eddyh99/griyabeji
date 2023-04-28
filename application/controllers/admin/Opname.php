<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opname extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    $this->load->model("admin/produkModel");
	    $this->load->model("admin/opnameModel");
	    $this->load->model("admin/storeModel");
	    $this->load->model("staff/cashierModel");
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }

	public function index(){
		$produk     = $this->produkModel->listproduk();
        $data = array(
            'title'		=> 'Opname',
            'content'	=> 'admin/opname/index',
            'extra'	    => 'admin/opname/js/js_index',
            'extracss'	=> 'admin/opname/css/css_index',
			'mn_opname' => 'active',
			'produk'    => $produk,
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'breadcrumb' => '/ Penyesuaian Stock'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function konfirm(){
		$store     = $this->storeModel->Liststore();
        $data = array(
            'title'		=> 'Konfirm Opname',
            'content'	=> 'admin/opname/konfirm',
            'extra'	    => 'admin/opname/js/js_konfirm',
			'mn_appopname' => 'active',
			'store'     => $store,
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'breadcrumb' => '/ Konfirmasi Opname'
		);
		$this->load->view('layout/wrapper', $data);
	}
    
    public function liststokopname(){
		$storeid    = $this->security->xss_clean($this->input->post('storeid'));
		// $stok       = $this->opnameModel->listopname($storeid);
		$stok = array(
			array(
				"barcode"		=> "0000000000000",
				"produk"		=> "Gelang Sakti",
				"size"			=> "M",
				"old"			=> "100",
				"baru"			=> "55"
			),
			array(
				"barcode"		=> "111111111111",
				"produk"		=> "Baju Polos",
				"size"			=> "XXL",
				"old"			=> "100",
				"baru"			=> "55"
			),
			array(
				"barcode"		=> "222222222222222",
				"produk"		=> "Celana",
				"size"			=> "L",
				"old"			=> "200",
				"baru"			=> "99"
			),
		);

        echo        json_encode($stok);
    }
    
    public function cekstok(){
		$barcode    = $this->security->xss_clean($this->input->post('barcode'));
		$size       = $this->security->xss_clean($this->input->post('size'));
		$storeid    = $this->security->xss_clean($this->input->post('tujuan'));

		$stok       = $this->opnameModel->getStok($barcode,$storeid,$size);
        echo        $stok;
    }
    
    public function simpandata(){
		$barcode    = $this->security->xss_clean($this->input->post('produk'));
		$size       = $this->security->xss_clean($this->input->post('size'));
		$riil       = $this->security->xss_clean($this->input->post('riil'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
		$storeid    = $_SESSION["logged_status"]["storeid"];

		$stok       = $this->opnameModel->getStok($barcode,$storeid,$size);
		$jumlah     = $riil-$stok;

        if ($_SESSION["logged_status"]["role"]!="Office Manager"){
    		$mdata  = array(
    		        "barcode"   => $barcode,
    		        "size"      => $size,
    		        "storeid"   => $storeid,
    		        "tanggal"   => date("Y-m-d"),
    		        "jumlah"    => $jumlah,
    		        "keterangan"=> $keterangan,
    		        "userid"    => $_SESSION["logged_status"]["username"]
    		    );
        }else{
    		$mdata  = array(
    		        "barcode"   => $barcode,
    		        "size"      => $size,
    		        "storeid"   => $storeid,
    		        "tanggal"   => date("Y-m-d"),
    		        "jumlah"    => $jumlah,
    		        "keterangan"=> $keterangan,
    		        "approved"  => 1,
    		        "userid"    => $_SESSION["logged_status"]["username"]
    		    );
        }
		$result=$this->opnameModel->insertData($mdata);
		$this->session->set_flashdata('message', "Stok berhasil di update");
		redirect(base_url()."admin/opname");
	}
    
    public function updatedata(){
		$storeid    = $this->security->xss_clean($this->input->post('store'));
        $this->opnameModel->setapprove($storeid);
        redirect(base_url()."admin/opname/konfirm");
    }
}
