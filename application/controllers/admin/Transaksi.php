<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/transaksiModel');
	   $this->load->model('admin/storeModel');
    }
    
    public function index() {
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
        
        $store  = $this->storeModel->Liststore();
        $data = array(
            'title'		 => 'Data Transaksi',
            'content'	 => 'admin/transaksi/index',
            'extra'		 => 'admin/transaksi/js/js_index',
            'extracss'   => 'admin/transaksi/css/css_index',
            'store'      => $store,
			'mn_method'  => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		$tanggal	= date_create($this->security->xss_clean($this->input->post('tanggal')));
		$storeid    = $this->security->xss_clean($this->input->post('storeid'));
        $tanggal    = date_format($tanggal,"Y-m-d");
		$result	    = $this->transaksiModel->listtransaksi($tanggal,$storeid);
		echo json_encode($result);
	}
	
	public function listdetail(){
		$nonota     = $this->security->xss_clean($this->input->post('nonota'));
		$tanggal	= $this->security->xss_clean($this->input->post('tanggal'));
		$result	    = $this->transaksiModel->detailtransaksi($nonota,$tanggal);
		echo json_encode($result);
	}

    public function simpanbayar(){
		$nonota     = $this->security->xss_clean($this->input->post('nonota'));
		$bayar	    = $this->security->xss_clean($this->input->post('bayar'));
		$result	    = $this->transaksiModel->changepayment($nonota,$bayar);
    }
}
