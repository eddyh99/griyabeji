<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stok extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        $this->load->model('admin/stokModel');
        $this->load->model('admin/storeModel');
        $this->load->model('admin/produkModel');
        $this->load->model('admin/brandModel');
        $this->load->model('admin/kategoriModel');
        $this->load->model('admin/sizeModel');
        require 'vendor/autoload.php';
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {

        $data		= array(
            'title'		 => 'Data Stok',
            'content'	 => 'admin/stok/index',
            'extra'		 => 'admin/stok/js/js_index',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side9'		 => 'active',
			'breadcrumb' => '/ Master Data / Stok '
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata(){
        // $columns	= array( 
        //         0	=> 'barcode', 
        //         1	=> 'namaproduk',
        //         2	=> 'namabrand',
        //         3	=> 'size',
        //         4	=> 'stok',
        //         5	=> 'store',
        //     );

		// $start	= $this->input->post('start');
		// $limit	= $this->input->post('length');		
        // $order	= $columns[$this->input->post('order')[0]['column']];
        // $dir	= $this->input->post('order')[0]['dir'];
  
        // $totalData		= $this->stokModel->allposts_count();
        // $totalFiltered	= $totalData; 
            
        // if(empty($this->input->post('search')['value']))
        // {            
        //     $result		= $this->stokModel->allposts($limit,$start,$order,$dir);
        // }
        // else {
        //     $search		= $this->input->post('search')['value']; 
        //     $result		=  $this->stokModel->posts_search($limit,$start,$search,$order,$dir);
        //     $totalFiltered = $this->stokModel->posts_search_count($search);
        // }
		
        // $data=array(
        //         "recordsTotal"      => $totalData,
        //         "recordsFiltered"   => $totalFiltered,
        //         "produk"			=> $result,
        //     );


		$data = array(
			array(
				"barcode"		=> "1234567901231",
				"namaproduk"	=> "TAS SLEMPANG",
				"namabrand"		=> "GUCCI",
				"size"			=> "M",
				"stok"			=> "88",
				"harga"			=> "99000",
				"store"			=> "Hanaka Denpasar",
			),
			array(
				"barcode"		=> "2222222222",
				"namaproduk"	=> "Baju Polos",
				"namabrand"		=> "69Slam",
				"size"			=> "XL",
				"stok"			=> "10",
				"harga"			=> "110000",
				"store"			=> "Hanaka Mengwi",
			)	
		);
			
	    echo json_encode($data);
	}

    public function tambah(){
		$size	= $this->sizeModel->Listsize();
		$store	= $this->storeModel->Liststore();
		$produk     = $this->produkModel->listproduk();



        $data	= array(
            'title'		=> 'Tambah Data Stok',
            'content'	=> 'admin/stok/tambah',
            'extra'		=> 'admin/stok/js/js_tambah',
			'extracss'	=> 'admin/stok/css/css_tambah',
			'size'		=> $size,
			'store'		=> $store,
			'produk'     => $produk,
			'restock'    => 0,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side9'		 => 'active',
			'breadcrumb' => '/ Master Data / Stok / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function restok() {
		$size	= $this->sizeModel->Listsize();
		$store	= $this->storeModel->Liststore();
		$produk     = $this->produkModel->listproduk();


        $data	= array(
            'title'		=> 'Tambah Data Stok',
            'content'	=> 'admin/stok/tambah',
            'extra'		=> 'admin/stok/js/js_tambah',
			'extracss'	=> 'admin/stok/css/css_tambah',
			'size'		=> $size,
			'store'		=> $store,
			'produk'     => $produk,
			'restock'    => 1,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'side16'	 => 'active',
			'breadcrumb' => '/ Master Data / Restock',
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function getDetail($barcode){
		$barcode	= $this->security->xss_clean($barcode);
		$result		= $this->produkModel->getProduk($barcode);
		echo json_encode($result);
	}

    public function import(){
        $userid		= $_SESSION["logged_status"]["username"];

        $file_mimes = array('application/vnd.ms-excel', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['stok']['name']) && in_array($_FILES['stok']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['stok']['name']);
            $extension = end($arr_file);
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['stok']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $array = array_map('array_filter', $sheetData);
        $array = array_filter($array);
        $input = array_map("unserialize", array_unique(array_map("serialize", $array)));

        $data		= array();
        foreach ($input as $dt){
            $temp["barcode"]=$dt[0];
            $temp["storeid"]=6;
            $temp["size"]=$dt[1];
            $temp["tanggal"]=date("Y-m-d");
            $temp["jumlah"]=$dt[2];
            $temp["keterangan"]="Stok Awal";
            $temp["userid"]=$userid;
            array_push($data,$temp);
        }
        
		// Checking Success and Error 
		// $result		= $this->stokModel->insertbatchData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"]==0) {
		    $this->session->set_flashdata("idstore",$storeid);
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/stok/tambah");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/stok/tambah");
            return;
		}
    }


	public function AddData(){
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('size', 'Size', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');
		$this->form_validation->set_rules('store', 'Store', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/stok/tambah");
            return;
		}
		
		$barcode	= $this->security->xss_clean($this->input->post('barcode'));
		$size		= $this->security->xss_clean($this->input->post('size'));
		$stok		= $this->security->xss_clean($this->input->post('stok'));
		$storeid	= $this->security->xss_clean($this->input->post('store'));
		$restock	= $this->security->xss_clean($this->input->post('restock'));
        $userid		= $_SESSION["logged_status"]["username"];
		
		//$oldstok	= $this->stokModel->getStok($barcode,$size);
        if (@$restock==0){
            $data		= array(
    				"barcode"	=> $barcode,
    				"storeid"	=> $storeid,
    				"size"		=> $size,
    				"tanggal"	=> date("Y-m-d"),
    				"jumlah"	=> $stok,
    				"keterangan"=> "Stok Awal",
    				"approved"	=> 1,
    				"userid"    => $userid
            );
        }else{
            $data		= array(
    				"barcode"	=> $barcode,
    				"storeid"	=> $storeid,
    				"size"		=> $size,
    				"tanggal"	=> date("Y-m-d"),
    				"jumlah"	=> $stok,
    				"keterangan"=> "Restock",
    				"approved"	=> 1,
    				"userid"    => $userid
            );
        }

		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->stokModel->insertData($data);

		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		$

		if ($result["code"]==0) {
		    $this->session->set_flashdata("idstore",$storeid);
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    $this->session->set_flashdata('alertcolor', 'success');
		    redirect("/admin/stok/tambah");
            return;
		}else{
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    $this->session->set_flashdata('alertcolor', 'danger');
		    redirect("/admin/stok/tambah");
            return;
		}
	}

}
