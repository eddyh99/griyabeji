<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	//    $this->load->model('admin/GuideModel');
    }
    
	// ===== START PRODUK =====

    public function index() {

        $data	= array(
            'title'		 => 'Data Produk',
            'content'	 => 'produk/index',
            'extra'		 => 'produk/js/js_index',
			'side5'		 => 'active',
			'breadcrumb' => '/ Master / Produk'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"namaproduk"	=> "Purification Ceremony",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
				"namaitems"		=> ["Dupa", "Gelang", "Tirta", "Canang Sari", "Air", "Tas"]
			),
			array(
                "id"            => "2",
				"namaproduk"	=> "Healing Therapy",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
				"namaitems"		=> "gelang"
			),
			array(
                "id"            => "3",
				"namaproduk"	=> "Palm Reading",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
				"namaitems"		=> "dupa"
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

		$items = array (
			array(
                "id"            => "1",
				"namaitem"		=> "Dupa Wangi",
			),
			array(
                "id"            => "2",
				"namaitem"		=> "Gelang Tridatu",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Canang Sari",
			),
			array(
                "id"            => "4",
				"namaitem"		=> "Toples Tirta",
			),
			array(
                "id"            => "5",
				"namaitem"		=> "Dupa Cempaka",
			),
		);




        $data = array(
            'title'		 => 'Tambah Data Produk',
            'content'	 => 'produk/tambah',
			'extra'	     => 'produk/js/js_tambah',
            'extracss'	 => 'produk/css/css_tambah',
			'side5'		 => 'active',
			'breadcrumb' => '/ Master / Produk / Tambah Data',
			'items'		 => $items,
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){		
		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."produk/tambah");
            return;
		}
		
		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_items	    = $this->security->xss_clean($this->input->post('id_items'));

        
        $data		= array(
            "namaproduk"      	=> $namaproduk,
            "local"      		=> $local,
            "domestik"      	=> $domestik,
            "internasional"     => $internasional,
            "id_items"      	=> $id_items,
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		// $result		= $this->PenggunaModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."produk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."produk/tambah");
            return;
		}
	}

    public function ubah(){
        
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);

		$result = array (
			"namaproduk"	=> "PURIFICATION CEREMONY",
			"local"			=> "1000000",
			"domestik"		=> "2000000",
			"internasional"	=> "3000000",
			"id_items"		=> ["1", "2", "2"]
		);

		$items = array (
			array(
                "id"            => "1",
				"namaitem"		=> "Dupa Wangi",
			),
			array(
                "id"            => "2",
				"namaitem"		=> "Gelang Tridatu",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Canang Sari",
			),
			array(
                "id"            => "4",
				"namaitem"		=> "Toples Tirta",
			),
			array(
                "id"            => "5",
				"namaitem"		=> "Dupa Cempaka",
			),
		);


		// print_r(json_encode($result));
		// die;



        $data		= array(
            'title'		 => 'Ubah Produk',
            'content'    => 'produk/ubah',
            'detail'     => $result,
			'items'		 => $items,
			'extra'	     => 'produk/js/js_tambah',
            'extracss'	 => 'produk/css/css_tambah',
			'side5'		 => 'active',
			'breadcrumb' => '/ Setup / Produk / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."produk/ubah/".base64_encode($id));
            return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_items	    = $this->security->xss_clean($this->input->post('id_items'));

        
        $data		= array(
            "namaproduk"      	=> $namaproduk,
            "local"      		=> $local,
            "domestik"      	=> $domestik,
            "internasional"     => $internasional,
            "id_items"      	=> $id_items,
        );
 


		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."produk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."produk/ubah/".base64_encode($id));
            return;
		}
	}

	public function DelData($id){
        $data		= array(
            "status"  => 1,
        );

		$id	= base64_decode($this->security->xss_clean($id));
		// $result		= $this->PenggunaModel->hapusData($data,$username);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect(base_url()."produk");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."produk");
		}

	}

	// ===== END PRODUK =====

	
	// ===== START HARGA PRODUK =====

	public function hargaproduk(){
		$data	= array(
            'title'		 => 'Harga Produk',
            'content'	 => 'hargaproduk/index',
            'extra'		 => 'hargaproduk/js/js_index',
			'side9'		 => 'active',
			'breadcrumb' => '/ Harga Produk'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData(){
		$result = array (
			array(
                "id"            => "1",
				"namaitem"		=> "Palm Reading",
				"awal"			=> "44 January 2023",
				"akhir"			=> "12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "2",
				"namaitem"		=> "Puri Cation",
				"awal"			=> "11 January 2023",
				"akhir"			=> "12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Healing",
				"awal"			=> "11 January 2023",
				"akhir"			=> "12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
		);
		echo json_encode($result);
	}

	public function tambahharga(){

		$produks = array(
			array(
				"id"			=> "1",
				"namaproduk"	=> "Purification Ceremony"
			),
			array(
				"id"			=> "2",
				"namaproduk"	=> "Healing Therapy"
			),
			array(
				"id"			=> "3",
				"namaproduk"	=> "Palm Reading"
			),
		);

		
		$data	= array(
            'title'		 => 'Harga Produk',
            'content'	 => 'hargaproduk/tambah',
            'extra'		 => 'hargaproduk/js/js_tambah',
			'mn_setting' => 'active',
			'side9'		 => 'active',
			'produks'	 => $produks,
			'breadcrumb' => '/ Harga Produk / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddHargaData(){

		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."produk/tambahharga");
            return;
		}
		
		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-",$this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]),"Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]),"Y-m-d");



        $data		= array(
            "namaproduk"     => $namaproduk,
			"local"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"tanggal_awal" 	=> $tanggal_awal,
			"tanggal_akhir" => $tanggal_akhir
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		// $result		= $this->PenggunaModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."produk/hargaproduk");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."produk/tambahharga");
            return;
		}
	}

	// ===== END HARGA PRODUK =====

}
