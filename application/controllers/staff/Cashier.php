<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    $this->load->model("staff/cashierModel");
	    $this->load->model("staff/kasModel");
	    $this->load->model("admin/produkModel");
	    $this->load->model("admin/storeModel");
	    $this->load->model("admin/stokModel");
	    $this->load->model("memberModel");
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }

	public function index() {
		$cekstatus  = $this->kasModel->openkas();
		// if ($cekstatus==5051){
		//     $this->session->set_flashdata("message","Silahkan masukkan kas awal dulu");
		//     redirect(base_url()."staff/kas");
		//     return;
		// }elseif ($cekstatus==5052){
		//     $this->session->set_flashdata("message","Silahkan tutup kas, dengan menghubungi store manager");
		//     redirect(base_url()."staff/kas/tutupharian");
		//     return;
		// }elseif ($cekstatus==5053){
		//     $this->session->set_flashdata("message","Store sudah di tutup, silahkan buka kembali besok");
		//     redirect(base_url()."staff/dashboard");
		//     return;
		// }
		
		$produk     = $this->stokModel->listproduk_withstok();
        $data = array(
            'title'		=> 'Penjualan',
			'extracss'	=> 'staff/cashier/css/css_cash',
            'content'	=> 'staff/cashier/index',
			'extra'		=> 'staff/cashier/js/js_cash',
			'produk'     => $produk,
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function readbarcode(){
		$barcode = $this->security->xss_clean($this->input->post('barcode'));
		$result=$this->cashierModel->readitem($barcode);
		echo json_encode($result);
	}
	
	public function getharga(){
		$barcode = $this->security->xss_clean($this->input->post('barcode'));
		$result=$this->produkModel->getProduk($barcode);
		echo json_encode($result);
	}

	public function getDetail(){
		$memberid = $this->security->xss_clean($this->input->post('memberid'));
		$result=$this->memberModel->getMember($memberid);
		if ($result["code"]==0){
			echo json_encode($result["message"]);
		}else{
			echo "404";
		}
	}

    public function newnota(){
        //prevent duplicate insert
        $_SESSION["identify"]           = rand(1000,9999);
        $_SESSION["nota_komplit"]   = '';
    }

	public function addData(){
		$memberid = $this->security->xss_clean($this->input->post('memberid'));
		$fee = $this->security->xss_clean($this->input->post('fee'));
		$method = $this->security->xss_clean($this->input->post('method'));	
		$barang = json_decode($this->security->xss_clean($this->input->post('barang')));
        
		if (empty($memberid)){
			$memberid=NULL;
		}
		
		$nota=$this->cashierModel->getLastnota();

		$jual=array(
			"nonota"	=> $nota,
			"storeid"	=> $_SESSION["logged_status"]["storeid"],
			"tanggal"	=> date("Y-m-d H:i:s"),
			"method"	=> $method,
			"fee"		=> $fee,
			"member_id"	=> $memberid,
			"userid"	=> $_SESSION["logged_status"]["username"]
		);
		
		$result=$this->cashierModel->insertData($jual,$barang);
		
		echo $result;
	}
	
	public function cetaknota($id){
	    $store=$this->storeModel->getStore($_SESSION["logged_status"]["storeid"]);
	    $data=$this->cashierModel->getallnota($id);
		$nota=array(
			"store"	=> $store[0],
			"data"  => $data
		);
		
		$this->load->view('staff/cashier/print', $nota);
	}
}
