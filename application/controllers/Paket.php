<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	//    $this->load->model('admin/GuideModel');
    }
    
    public function index() {

        $data	= array(
            'title'		 => 'Data Paket',
            'content'	 => 'paket/index',
            'extra'		 => 'paket/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side6'		 => 'active',
			'breadcrumb' => '/ Master / Paket'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"namapaket"	    => "Middle Spiritual",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
                "namaproduk"	=> ["Purification Ceremony", "Healing Therapy"]
			),
			array(
                "id"            => "2",
				"namapaket"	    => "Middle Hash",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
                "namaproduk"	=> ["Palm Reading", "Healing Therapy"]
			),
			array(
                "id"            => "3",
				"namapaket"	    => "Combo Complate",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
                "namaproduk"	=> ["Palm Reading", "Healing Therapy", "Purification Ceremony"]
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

		$items = array (
			array(
                "id"            => "1",
				"namaproduk"		=> "Palm Reading",
			),
			array(
                "id"            => "2",
				"namaproduk"		=> "Healing Therapy",
			),
			array(
                "id"            => "3",
				"namaproduk"		=> "Purification Ceremony",
			),
		);




        $data = array(
            'title'		 => 'Tambah Data Paket',
            'content'	 => 'paket/tambah',
			'extra'	     => 'paket/js/js_tambah',
            'extracss'	 => 'paket/css/css_tambah',
			'side6'		 => 'active',
			'breadcrumb' => '/ Master / Paket / Tambah Data',
			'produks'		 => $items,
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){		
		$this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_produk[]', 'Nama Produk', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."paket/tambah");
            return;
		}
		
		$namapaket	    = $this->security->xss_clean($this->input->post('namapaket'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_produk	    = $this->security->xss_clean($this->input->post('id_produk'));

        
        $data		= array(
            "namapaket"      	=> $namapaket,
            "local"      		=> $local,
            "domestik"      	=> $domestik,
            "internasional"     => $internasional,
            "id_produk"      	=> $id_produk,
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		// $result		= $this->PenggunaModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		$result["code"]=5011;
		$result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."paket");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket/tambah");
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
            'title'		 => 'Ubah Data Paket',
            'content'    => 'paket/ubah',
            'detail'     => $result,
			'items'		 => $items,
			'extra'	     => 'paket/js/js_tambah',
            'extracss'	 => 'paket/css/css_tambah',
			'side6'		 => 'active',
			'breadcrumb' => '/ Setup / Paket / Ubah Data'
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
		    redirect(base_url()."paket/ubah/".base64_encode($id));
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

		print_r(json_encode($data));
		die;


		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."paket");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket/ubah/".base64_encode($id));
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
		    redirect(base_url()."paket");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket");
		}

	}

	// ===== START HARGA PRODUK =====

	public function hargapaket(){
		$data	= array(
			'title'		 => 'Harga Paket',
			'content'	 => 'hargapaket/index',
			'extra'		 => 'hargapaket/js/js_index',
			'side10'	 => 'active',
			'breadcrumb' => '/ Harga Paket'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData(){
		$result = array (
			array(
				"id"            => "1",
				"namaitem"		=> "Paket 1",
				"awal"			=> "44 January 2023",
				"akhir"			=> "12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
				"id"            => "2",
				"namaitem"		=> "Paket 2",
				"awal"			=> "11 January 2023",
				"akhir"			=> "12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
				"id"            => "3",
				"namaitem"		=> "Paket 3",
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

		$pakets = array(
			array(
				"id"			=> "1",
				"namapaket"		=> "Paket 33"
			),
			array(
				"id"			=> "2",
				"namapaket"		=> "Paket 41"
			),
			array(
				"id"			=> "3",
				"namapaket"		=> "Paket 5"
			),
		);

		
		$data	= array(
			'title'		 => 'Harga Produk',
			'content'	 => 'hargapaket/tambah',
			'extra'		 => 'hargapaket/js/js_tambah',
			'mn_setting' => 'active',
			'side10'	 => 'active',
			'pakets'	 => $pakets,
			'breadcrumb' => '/ Harga Paket / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddHargaData(){

		$this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url()."paket/tambahharga");
			return;
		}
		
		$namapaket	    = $this->security->xss_clean($this->input->post('namapaket'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-",$this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]),"Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]),"Y-m-d");



		$data		= array(
			"namapaket"     => $namapaket,
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
			redirect(base_url()."paket/hargapaket");
			return;
		}else{
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url()."paket/tambahharga");
			return;
		}
	}

	// ===== END HARGA PRODUK =====
	
}
