<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/storeModel');
    }
    
    public function index() {
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }

		$result=$this->storeModel->liststore();	

        $data = array(
            'title'		 => 'Data Store',
            'content'	 => 'admin/store/index',
            'extra'		 => 'admin/store/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side2'		 => 'active',
			'breadcrumb' => '/ Setup / Store'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->storeModel->liststore();
		$result = array (
			array(
				"store_id" 		=> "1",
				"store"			=> "Hanaka Denpasar",
				"alamat"		=> "Panjer",
				"keterangan"	=> "ini keterangan hanaka denpasar",
				"kontak"		=> "088812221222",
				"status"		=> "0",
				"user_id"		=> "admin",
				"lastupdate" 	=> "2023-04-11 06:38:30"
			),
			array(
				"store_id" 		=> "2",
				"store"			=> "Hanaka Badung",
				"alamat"		=> "Mengwi",
				"keterangan"	=> "ini keterangan hanaka mengwi",
				"kontak"		=> "088812221222",
				"status"		=> "0",
				"user_id"		=> "admin",
				"lastupdate" 	=> "2023-04-11 06:38:30"
			),
			array(
				"store_id" 		=> "3",
				"store"			=> "Hanaka Jimbaran",
				"alamat"		=> "Jimbaran",
				"keterangan"	=> "ini keterangan hanaka Jimbaran",
				"kontak"		=> "088812221222",
				"status"		=> "0",
				"user_id"		=> "admin",
				"lastupdate" 	=> "2023-04-11 06:38:30"
			),
			array(
				"store_id" 		=> "4",
				"store"			=> "Hanaka Singaraja",
				"alamat"		=> "Singaraja",
				"keterangan"	=> "ini keterangan hanaka Singaraja",
				"kontak"		=> "088812221222",
				"status"		=> "0",
				"user_id"		=> "admin",
				"lastupdate" 	=> "2023-04-11 06:38:30"
			),
			array(
				"store_id" 		=> "5",
				"store"			=> "Hanaka Karangasem",
				"alamat"		=> "Karangasem",
				"keterangan"	=> "ini keterangan hanaka Karangasem",
				"kontak"		=> "088812221222",
				"status"		=> "0",
				"user_id"		=> "admin",
				"lastupdate" 	=> "2023-04-11 06:38:30"
			),
		);
		echo json_encode($result);
	}

    public function tambah(){
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $data = array(
            'title'		 => 'Tambah Data Store',
            'content'	 => 'admin/store/tambah',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side2'		 => 'active',
			'breadcrumb' => '/ Setup / Store / Tambah Data'
			
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('store', 'Nama Store', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."admin/store/tambah");
            return;
		}
		
		$store		= $this->security->xss_clean($this->input->post('store'));
		$alamat		= $this->security->xss_clean($this->input->post('alamat'));
		$kontak		= $this->security->xss_clean($this->input->post('kontak'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "store"         => $store,
            "alamat"        => $alamat,
            "kontak"        => $kontak,
            "keterangan"    => $keterangan,
            "userid"        => $userid
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		// $result		= $this->storeModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."admin/store");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/store/tambah");
            return;
		}
	}

    public function ubah($storeid){
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
        
		$storeid = base64_decode($this->security->xss_clean($storeid));
		
		// update Store karena single data form
		// $result = $this->storeModel->getStore($storeid);
		$result = array (
			"storeid"		=> '5',
			"store"         => "Hanaka Karangasem",
            "alamat"        => "Karangasem",
            "kontak"        => "088812221222",
            "keterangan"    => "ini keterangan hanaka Karangasem",
            "userid"        => "admin"
		);

		// print_r($result);
		// die;


        $data = array(
            'title'      => 'Ubah Data Store',
            'content'    => 'admin/store/ubah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side2'		 => 'active',
			'breadcrumb' => '/ Setup / Store / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('store', 'Nama Store', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$storeid = $this->security->xss_clean($this->input->post('storeid'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."admin/store/ubah/".base64_encode($storeid));
            return;
		}
		
		$store		= $this->security->xss_clean($this->input->post('store'));
		$alamat		= $this->security->xss_clean($this->input->post('alamat'));
		$kontak		= $this->security->xss_clean($this->input->post('kontak'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
			"storeid"		=> $storeid,
            "store"         => $store,
            "alamat"        => $alamat,
            "kontak"        => $kontak,
            "keterangan"    => $keterangan,
            "userid"        => $userid
        );

		// print_r($data);
		// die;
		
		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->storeModel->updateData($data,$storeid);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."admin/store");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/store/ubah/".base64_encode($storeid));
            return;
		}
	}

	public function DelData($storeid){
		$storeid	= base64_decode($this->security->xss_clean($storeid));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "status"  => 1,
            "userid"  => $userid
        );

		// $result		= $this->storeModel->hapusData($data,$storeid);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect(base_url()."admin/store");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/store");
		}
	}

}
