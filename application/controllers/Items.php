<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	//    $this->load->model('admin/GuideModel');
    }
    
    public function index() {

        $data	= array(
            'title'		 => 'Data Pengguna',
            'content'	 => 'items/index',
            'extra'		 => 'items/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Master / Items'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"namaitem"		=> "Dupa Wangi",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "2",
				"namaitem"		=> "Gelang Tridatu",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Canang Sari",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "4",
				"namaitem"		=> "Toples Tirta",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "5",
				"namaitem"		=> "Dupa Cempaka",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

        $data = array(
            'title'		 => 'Tambah Data Pengayah',
            'content'	 => 'items/tambah',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Master / Items / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){

		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."items/tambah");
            return;
		}
		
		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));

        
        $data		= array(
            "namaitems"     => $namaitems,
			"local"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional
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
		    redirect(base_url()."items");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."items/tambah");
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
			'side4'		 => 'active',
			'breadcrumb' => '/ Harga Items'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaData(){
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
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "3",
				"namaitem"		=> "Canang Sari",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "4",
				"namaitem"		=> "Toples Tirta",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
			array(
                "id"            => "5",
				"namaitem"		=> "Dupa Cempaka",
				"local"			=> "1000000",
				"domestik"		=> "2000000",
				"internasional"	=> "3000000",
			),
		);
		echo json_encode($result);
	}

}
