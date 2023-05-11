<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	    $this->load->model('admin/mdl_kas',"kas");
		$this->load->model('admin/mdl_store','store');
    }

	// ====== START KAS =====
    
    public function index() {
		/*@todo
		tambah kan combo box untuk filter store nya di list kas
		jadi bisa filter per store nya
		*/

		$stores=$this->store->Liststore();
		

        $data	= array(
            'title'		 => NAMETITLE . ' - Kas',
            'content'	 => 'kas/index',
            'extra'		 => 'kas/js/js_index',
			'side13'	 => 'active',
			'breadcrumb' => 'Kas'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){

		$result=$this->kas->listkas();
		// $result = array (
		// 	array(
        //         "id"            => "1",
		// 		"tanggal"		=> "14 May 2023",
		// 		"nominal"		=> "100000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "Warkop",
		// 	),
		// 	array(
        //         "id"            => "2",
		// 		"tanggal"		=> "15 May 2023",
		// 		"nominal"		=> "200000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "parkir",
		// 	),
		// 	array(
        //         "id"            => "3",
		// 		"tanggal"		=> "16 May 2023",
		// 		"nominal"		=> "300000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "Warung Herbal",
		// 	),
		// );
		echo json_encode($result);
	}

    public function tambah(){

		$stores = $this->store->Liststore();


        $data = array(
            'title'		 => NAMETITLE . ' - Tambah Data KAS',
            'content'	 => 'kas/tambah',
            'extra'		 => 'kas/js/js_tambah',
			'side13'	 => 'active',
			'breadcrumb' => '/ Kas / Tambah Data',
			'stores' 	 => $stores
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('storename', 'Nama Store', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Kas', 'trim|required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."kas/tambah");
            return;
		}
		
		$tanggal	    = $this->security->xss_clean($this->input->post('tanggal'));
		$storename	    = $this->security->xss_clean($this->input->post('storename'));
		$jenis	    	= $this->security->xss_clean($this->input->post('jenis'));
		$nominal	    = $this->security->xss_clean($this->input->post('nominal'));
		$keterangan		= $this->security->xss_clean($this->input->post('keterangan'));

        
        $data		= array(
            "tanggal"     	=> date("Y-m-d H:i:s"),
            "store_id"     	=> $storename,
			"jenis"			=> $jenis,
			"nominal"		=> $nominal,
			"keterangan" 	=> $keterangan,
			"userid"		=> $_SESSION["logged_status"]["username"]
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->kas->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."kas");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."kas/tambah");
            return;
		}
	}

    public function ubah(){
        
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);

		$result = array (
			"namaitems"	    => "Dupa Wangi",
			"local"			=> "1000000",
			"domestik"		=> "2000000",
			"internasional"	=> "3000000",
		);

        $data		= array(
            'title'		 => 'Ubah Data Pengguna',
            'content'    => 'items/ubah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Setup / Items / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."items/ubah/".base64_encode($id));
            return;
		}

		$namaitems	= $this->security->xss_clean($this->input->post('namaitems'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));

        $data	= array(
            "namaitems"      	=> $namaitems,
            "local"      		=> $local,
            "domestik"     	 	=> $domestik,
            "internasional"     => $internasional,
        );

		// print_r(json_encode($data));
		// die;


		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."items");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."items/ubah/".base64_encode($id));
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
		    redirect(base_url()."items");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."items");
		}

	}

	// ====== END KAS =====
	
	
	// ====== START REKAPAN HARIAN =====

	public function tutupharian(){

		if (@!isset($_GET["tgl"])){
	        $tgl=date("d M Y");
	        $tglcari=date("Y-m-d");
	    }else{
	        $tgl     = $this->security->xss_clean($_GET["tgl"]);
	        $tglcari = date_format(date_create($tgl),"Y-m-d");
	    }

		// $result=$this->kasModel->lastSaldo($tglcari);
		$result = array (
			"saldo"		=> 12000,
			"jual"		=> 12000,
			"tunai"		=> 100000,
			"retur"		=> array(
				"tunai"	=> 500000,
				"non"	=> 3000
			),
			"kas"	=> []
		);
		// print_r(json_encode($result));
		// die;


		$data	= array(
            'title'		 => 'Rekapan Harian',
            'content'	 => 'kas/tutupharian',
            'extra'		 => 'kas/js/js_tutupharian',
			'side14'	 => 'active',
			'breadcrumb' => '/ Rekapan Harian',
			'penjualan'  => $result,
			'tgl'        => $tgl,
		);
		$this->load->view('layout/wrapper', $data);
	}
	// ====== END REKAPAN HARIAN =====



}
