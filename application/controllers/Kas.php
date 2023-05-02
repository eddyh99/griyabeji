<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	//    $this->load->model('admin/GuideModel');
    }
    
    public function index() {

        $data	= array(
            'title'		 => 'Kas',
            'content'	 => 'kas/index',
            'extra'		 => 'kas/js/js_index',
			'side12'	 => 'active',
			'breadcrumb' => '/ Kas'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"tanggal"		=> "14 May 2023",
				"nominal"		=> "100000",
				"keterangan"	=> "ini kas",
				"store"			=> "Warkop",
			),
			array(
                "id"            => "2",
				"tanggal"		=> "15 May 2023",
				"nominal"		=> "200000",
				"keterangan"	=> "ini kas",
				"store"			=> "parkir",
			),
			array(
                "id"            => "3",
				"tanggal"		=> "16 May 2023",
				"nominal"		=> "300000",
				"keterangan"	=> "ini kas",
				"store"			=> "Warung Herbal",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

		$stores = array(
			array(
				"id"			=> "1",
				"storename"		=> "parkir"
			),
			array(
				"id"			=> "2",
				"storename"		=> "Warkop"
			),
			array(
				"id"			=> "3",
				"storename"		=> "Warung Kerohanian"
			),
		);

        $data = array(
            'title'		 => 'Tambah Data Pengayah',
            'content'	 => 'kas/tambah',
            'extra'		 => 'kas/js/js_tambah',
			'side12'	 => 'active',
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
            "tanggal"     	=> $tanggal,
            "storename"     => $storename,
			"jenis"			=> $jenis,
			"nominal"		=> $nominal,
			"keterangan" 	=> $keterangan
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

	public function hargaitems(){
		$data	= array(
            'title'		 => 'Data Pengguna',
            'content'	 => 'hargaitems/index',
            'extra'		 => 'hargaitems/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side8'		 => 'active',
			'breadcrumb' => '/ Harga Items'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData(){
		$result = array (
			array(
                "id"            => "1",
				"namaitem"		=> "Dupa Wangi",
				"periode"		=> "11 January 2023 - 12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "2",
				"namaitem"		=> "Gelang Tridatu",
				"periode"		=> "11 January 2023 - 12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Canang Sari",
				"periode"		=> "11 January 2023 - 12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "4",
				"namaitem"		=> "Toples Tirta",
				"periode"		=> "11 January 2023 - 12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "5",
				"namaitem"		=> "Dupa Cempaka",
				"periode"		=> "11 January 2023 - 12 January 2023",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
		);
		echo json_encode($result);
	}

	public function tambahharga(){

		$items = array(
			array(
				"id"			=> "1",
				"namaitem"		=> "Dupa Wangi"
			),
			array(
				"id"			=> "2",
				"namaitem"		=> "Canang Sari"
			),
			array(
				"id"			=> "3",
				"namaitem"		=> "Aqua"
			),
		);

		
		$data	= array(
            'title'		 => 'Data Pengguna',
            'content'	 => 'hargaitems/tambah',
            'extra'		 => 'hargaitems/js/js_tambah',
			'mn_setting' => 'active',
			'side8'		 => 'active',
			'items'		 => $items,
			'breadcrumb' => '/ Harga Items / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddHargaData(){

		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."items/tambahharga");
            return;
		}
		
		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-",$this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]),"Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]),"Y-m-d");

		// print_r($tanggal_awal);
		// print_r($tanggal_akhir);
		// die;


        $data		= array(
            "namaitems"     => $namaitems,
			"local"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"tanggal" 			=> $tanggal
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
		    redirect(base_url()."items/hargaitems");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."items/tambahharga");
            return;
		}
	}

}
