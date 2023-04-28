<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Produk extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        $this->load->model('admin/produkModel');
        $this->load->model('admin/brandModel');
        $this->load->model('admin/kategoriModel');
        require 'vendor/autoload.php';
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {

        $data		= array(
            'title'		 => 'Data Produk',
            'content'	 => 'admin/produk/index',
            'extra'		 => 'admin/produk/js/js_index',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => '/ Master Data / Produk '
		);
		$this->load->view('layout/wrapper', $data);
	}

	

	public function Listdata(){
		// $result=$this->produkModel->listproduk();
		// echo json_encode($result);
        // $columns	= array( 
        //         0	=> 'barcode', 
        //         1	=> 'namaproduk',
        //         2	=> 'namabrand',
        //         3	=> 'namakategori',
        //         4	=> 'harga',
        //     );
		// $start		= $this->input->post('start');
		// $limit		= $this->input->post('length');
		
        // $order		= $columns[$this->input->post('order')[0]['column']];
        // $dir		= $this->input->post('order')[0]['dir'];
  
        // $totalData	= $this->produkModel->allposts_count();
        // $totalFiltered = $totalData; 
            
        // if(empty($this->input->post('search')['value']))
        // {            
        //     $result = $this->produkModel->allposts($limit,$start,$order,$dir);
        // }
        // else {
        //     $search = $this->input->post('search')['value']; 
        //     $result = $this->produkModel->posts_search($limit,$start,$search,$order,$dir);
        //     $totalFiltered = $this->produkModel->posts_search_count($search);
        // }
		
        // $data	=  array(
        //         "recordsTotal"      => $totalData,
        //         "recordsFiltered"   => $totalFiltered,
        //         "produk"			=> $result,
        //     );

		$data = array(
			array(
				"barcode"		=> '1234567901231',
				"diskon"		=> '10',
				"harga"			=> '1000000',
				"lastupdate"	=> '2023-04-13 22:28:34',
				"namabrand"		=> 'Baju',
				"namakategori"	=> 'Baju',
				"namaproduk"	=> 'Baju Polo',
				"status"		=> '0',
				"userid"		=> "admin"
			),
			array(
				"barcode"		=> '00000000000000',
				"diskon"		=> '99',
				"harga"			=> '91000',
				"lastupdate"	=> '2023-04-13 22:28:34',
				"namabrand"		=> 'Gelang',
				"namakategori"	=> 'Gelang Karet',
				"namaproduk"	=> 'Gelang Sakti',
				"status"		=> '0',
				"userid"		=> "admin"
			),
			array(
				"barcode"		=> '22222222222222',
				"diskon"		=> '13',
				"harga"			=> '12000',
				"lastupdate"	=> '2023-04-13 22:28:34',
				"namabrand"		=> 'hanaka',
				"namakategori"	=> 'celana',
				"namaproduk"	=> 'celana',
				"status"		=> '0',
				"userid"		=> "admin"
			),
		);

	    echo json_encode($data);
	}

    public function tambah(){
		$brand		= $this->brandModel->Listbrand();
		$kategori	= $this->kategoriModel->Listkategori();
        $data		= array(
            'title'		 => 'Tambah Data Produk',
            'content'	 => 'admin/produk/tambah',
			'brand'		 => $brand,
			'kategori'	 => $kategori,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => '/ Master Data / Produk / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function import(){
        $userid		= $_SESSION["logged_status"]["username"];

        $file_mimes = array('application/vnd.ms-excel', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['produk']['name']) && in_array($_FILES['produk']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['produk']['name']);
            $extension = end($arr_file);
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['produk']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $array = array_map('array_filter', $sheetData);
        $array = array_filter($array);
        $input = array_map("unserialize", array_unique(array_map("serialize", $array)));

        $data		= array();
        foreach ($input as $dt){
            $temp["barcode"]=$dt[0];
            $temp["namaproduk"]=$dt[1];
            $temp["namabrand"]=$dt[2];
            $temp["namakategori"]=$dt[3];
            $temp["harga"]=$dt[4];
            $temp["userid"]=$userid;
            array_push($data,$temp);
        }
        
		// Checking Success and Error 
		// $result		= $this->produkModel->insertbatchData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/produk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produk/tambah");
            return;
		}
    }

	public function AddData(){
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('produk', 'Produk', 'trim|required');
		$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('diskon', 'Diskon', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/produk/tambah");
            return;
		}
		
		$barcode	= $this->security->xss_clean($this->input->post('barcode'));
		$produk		= $this->security->xss_clean($this->input->post('produk'));
		$brand		= $this->security->xss_clean($this->input->post('brand'));
		$kategori	= $this->security->xss_clean($this->input->post('kategori'));
		$harga		= $this->security->xss_clean($this->input->post('harga'));
		$diskon		= $this->security->xss_clean($this->input->post('diskon'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "barcode"		=> $barcode,
            "namaproduk"	=> $produk,
            "namabrand"		=> $brand,
            "namakategori"	=> $kategori,
            "harga"			=> $harga,
            "diskon"		=> $diskon,
            "userid"        => $userid
        );

		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->produkModel->insertData($data);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/produk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produk/tambah");
            return;
		}
	}

	public function ubah($barcode){
		$barcode	= base64_decode($this->security->xss_clean($barcode));


		$result = array (
			"barcode" => "1234567901231",
			"namaproduk" => "Baju Polo",
			"namabrand" => "Baju",
			"namakategori" => "test",
			"status" => "0",
			"userid" => "admin",
			"lastupdate" => "2023-04-13 22:28:34",
			"harga" => "1000000",
			"diskon" => "10",
		);
		// print_r(json_encode($result));
		// die;

		// $result		= $this->produkModel->getProduk($barcode);


		$brand = array(
			array(
				"namabrand"		=> "69slime",
				"keterangan"	=> "69slime"
			),
			array(
				"namabrand"		=> "Mayhem",
				"keterangan"	=> "mayhem"
			),
			array(
				"namabrand"		=> "Sandal",
				"keterangan"	=> "sandal"
			),
		);
		// $brand		= $this->brandModel->Listbrand();
		// print_r(json_encode($brand));
		// die;

		
		$kategori = array(
			array(
    			"namakategori"	=> "Baju"
			),
			array(
				"namakategori"	=> "Gelang"
			),
			array(
				"namakategori"	=> "Sandal"
			),
		);
		// $kategori	= $this->kategoriModel->Listkategori();
		// print_r(json_encode($kategori));
		// die;

        $data		= array(
            'title'		 => 'Ubah Data Produk',
            'content'	 => 'admin/produk/ubah',
			'brand'		 => $brand,
			'kategori'	 => $kategori,
			'barcode'	 => $barcode,
			'produk'	 => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => '/ Master Data / Produk / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('produk', 'Produk', 'trim|required');
		$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('diskon', 'Diskon', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/produk/tambah");
            return;
		}
		
		$barcode	= $this->security->xss_clean($this->input->post('barcode'));
		$produk		= $this->security->xss_clean($this->input->post('produk'));
		$brand		= $this->security->xss_clean($this->input->post('brand'));
		$kategori	= $this->security->xss_clean($this->input->post('kategori'));
		$harga		= $this->security->xss_clean($this->input->post('harga'));
		$diskon		= $this->security->xss_clean($this->input->post('diskon'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "namaproduk"	=> $produk,
            "namabrand"		=> $brand,
            "namakategori"	=> $kategori,
			"harga"			=> $harga,
			"diskon"		=> $diskon,
            "userid"        => $userid
        );

		// Checking Success and Error 
		// $result		= $this->produkModel->setData($data,$barcode);


		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/produk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produk/ubah/".base64_encode($barcode));
            return;
		}
	}

	public function DelData($barcode){
        $userid		= $_SESSION["logged_status"]["username"];
		$barcode	= base64_decode($this->security->xss_clean($barcode));

        $data		= array(
            "status"  => 1,
            "userid"  => $userid
        );

		$result		= $this->produkModel->hapusData($data,$barcode);

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/produk");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produk");
		}

	}

	public function callData($barcode){
        $userid		= $_SESSION["logged_status"]["username"];
		$barcode	= base64_decode($this->security->xss_clean($barcode));

        $data		= array(
            "status"  => 0,
            "userid"  => $userid
        );

		$result		= $this->produkModel->hapusData($data,$barcode);

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/produk");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/produk");
		}

	}

}
