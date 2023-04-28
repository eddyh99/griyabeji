<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Produksize extends CI_Controller {

	public function __construct() {
	   parent::__construct();

        $this->load->model('admin/produksizeModel');
        $this->load->model('admin/sizeModel');
        $this->load->model('admin/produkModel');
        require 'vendor/autoload.php';

        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {

		// $result		= $this->produksizeModel->ListSize();
		// print_r(json_encode($result));
		// die;

        $data		= array(
            'title'		 => 'Data Produk - Size',
            'content'	 => 'admin/produksize/index',
            'extra'		 => 'admin/produksize/js/js_index',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side8'		 => 'active',
			'breadcrumb' => '/ Master Data / Produk Size '
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result		= $this->produksizeModel->ListSize();
		$result = array(
			array(
				"barcode" 		=> "1234567901231",
				"size"			=> "M",
				"namaproduk"	=> "Baju Polo",
				"namabrand"		=> "Baju"
			),
			array(
				"barcode" 		=> "0000000000000",
				"size"			=> "Z",
				"namaproduk"	=> "Celana",
				"namabrand"		=> "celana"
			),
			array(
				"barcode" 		=> "12121212221212",
				"size"			=> "XXL",
				"namaproduk"	=> "Tas",
				"namabrand"		=> "Tas"
			),
		);
		echo json_encode($result);
	}

    public function getprodukname (){
		$barcode	= $this->security->xss_clean($this->input->post('barcode'));
		$result     = $this->produkModel->getProduk($barcode)->namaproduk;
		echo $result;
    }
    
    public function tambah(){

		$size = array(
			array(
				"nama"	=> "L",
			),
			array(
				"nama"	=> "XXXXL",
			)
		);
		// print_r(json_encode($size));
		// die;
		// $size		= $this->sizeModel->Listsize();
		
		$produk = array(
			array(
				"barcode"		=> '1234567901231',
				"namaproduk"	=> 'Baju Polo',
				"namabrand"		=> 'Baju',
				"namakategori"	=> 'Baju',
				"status"		=> '0',
				"userid"		=> "admin",
				"lastupdate"	=> '2023-04-13 22:28:34',
			),
			array(
				"barcode"		=> '00000000000000',
				"namaproduk"	=> 'Gelang Sakti',
				"namabrand"		=> 'Gelang',
				"namakategori"	=> 'Gelang Karet',
				"status"		=> '0',
				"userid"		=> "admin",
				"lastupdate"	=> '2023-04-13 22:28:34',
			),
			array(
				"barcode"		=> '22222222222222',
				"namaproduk"	=> 'celana',
				"namabrand"		=> 'celana',
				"namakategori"	=> 'celana',
				"status"		=> '0',
				"userid"		=> "admin",
				"lastupdate"	=> '2023-04-13 22:28:34',
			),
		);
		// $produk     = $this->produkModel->listproduk();
		// print_r(json_encode($produk));
		// die;

        $data		= array(
            'title'      => 'Tambah Data Produk - Size',
            'content'    => 'admin/produksize/tambah',
            'extra'      => 'admin/produksize/js/js_tambah',
			'size'	     => $size,
			'produk'     => $produk,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side8'		 => 'active',
			'breadcrumb' => '/ Master Data / Produk Size / Tambah Data '
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    function myFilter($var){
        return ($var !== NULL && $var !== FALSE && $var !== "");
    }

    public function import(){
        $userid		= $_SESSION["logged_status"]["username"];

        $file_mimes = array('application/vnd.ms-excel', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['produksize']['name']) && in_array($_FILES['produksize']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['produksize']['name']);
            $extension = end($arr_file);
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['produksize']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $array = array_map('array_filter', $sheetData);
        $array = array_filter($array);
        $input = array_map("unserialize", array_unique(array_map("serialize", $array)));

        $data		= array();
        foreach ($input as $dt){
            $temp["barcode"]=$dt[0];
            $temp["size"]=$dt[1];
            $temp["userid"]=$userid;
            array_push($data,$temp);
        }
        
		$result		= $this->produksizeModel->insertbatchData($data);
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/produksize");
            return;
		}else{
		    $this->session->set_flashdata('message', "Ada barcode yang tidak terdaftar");
		    redirect("/admin/produksize/tambah");
            return;
		}
    }
    
	public function AddData(){
		$this->form_validation->set_rules('size', 'Size', 'trim|required');
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/produksize/tambah");
            return;
		}
		
		$barcode	= $this->security->xss_clean($this->input->post('barcode'));
		$size		= $this->security->xss_clean($this->input->post('size'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "barcode"		=> $barcode,
            "size"			=> $size,
            "userid"        => $userid
        );
		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->produksizeModel->insertData($data);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/produksize");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produksize/tambah");
            return;
		}
	}
	
	public function DelData($barcode,$size)
	{
        $userid		= $_SESSION["logged_status"]["username"];
		$barcode	= base64_decode($this->security->xss_clean($barcode));
		$size		= base64_decode($this->security->xss_clean($size));

        $data		= array(
            "status"  => 1,
            "userid"  => $userid
        );

		$where		= array(
			"barcode"	=> $barcode,
			"size"		=> $size
		);

		
		// Checking Success and Error 
		// $result		= $this->produksizeModel->hapusData($data,$where);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di dihapus";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/produksize");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produksize");
		}

	}

}
