<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/kategoriModel');
    }
    
    public function index() {
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $data = array(
            'title' 		=> 'Data Kategori',
            'content' 		=> 'admin/kategori/index',
            'extra'	 		=> 'admin/kategori/js/js_index',
			'mn_setting' 	=> 'active',
			'colmas'	 	=> 'collapse',
			'colset'	 	=> 'collapse in',
			'collap'	 	=> 'collapse',
			'side4'		 	=> 'active',
			'breadcrumb' 	=> '/ Setup / Kategori'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result		= $this->kategoriModel->Listkategori();
		$result = array(
			array(
				"namakategori"	=> 'Baju Koko',
				"userid"        => 'admin'
			),
			array(
				"namakategori"	=> 'Sepatu',
				"userid"        => 'admin'
			),
			array(
				"namakategori"	=> 'Test',
				"userid"        => 'admin'
			),
			array(
				"namakategori"	=> 'Celana',
				"userid"        => 'admin'
			),
        );
		echo json_encode($result);
	}

    public function tambah(){
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $data		= array(
            'title'		 => 'Tambah Data Kategori',
            'content'	 => 'admin/kategori/tambah',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Setup / Kategori / Tambah Kategori'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('kategori', 'Nama Kategori', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/kategori/tambah");
            return;
		}
		
		$kategori	= $this->security->xss_clean($this->input->post('kategori'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "namakategori"	=> 'Baju Koko',
            "userid"        => 'admin'
        );

		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->kategoriModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/kategori");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/kategori/tambah");
            return;
		}
	}

    public function ubah($kategori){
        // if (!isset($this->session->userdata['logged_status'])) {
        //     redirect("/");
        // }
        
		$kategori	= base64_decode($this->security->xss_clean($kategori));

		// $result		= $this->kategoriModel->getKategori($kategori);
		$result		= array(
            "namakategori"  		=> ucfirst('Baju Koko'),
            "userid"     			=> 'admin',
			"oldkategori"			=> 'oldkategori'
        );
		// print_r($result);
		// die;

		
        $data		= array(
            'title'      => 'Ubah Data Kategori',
            'content'    => 'admin/kategori/ubah',
            'detail'     => $result,
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Setup / Brand / Ubah Kategori'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('kategori', 'Nama Kategori', 'trim|required');
		$oldkategori = $this->security->xss_clean($this->input->post('oldkategori'));

		// ERRO FORM 
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."admin/ketegori/ubah/".base64_encode($oldkategori));
            return;
		}

		$kategori	 = $this->security->xss_clean($this->input->post('kategori'));
        $userid		 = $_SESSION["logged_status"]["username"];

        $data		 = array(
            "namakategori"  => ucfirst($kategori),
            "userid"		=> $userid,
			"oldkategori"	=> $oldkategori
        );
		
		// Checking Success and Error 
		// $result		 = $this->kategoriModel->updateData($data,$oldkategori);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."admin/kategori");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/kategori/ubah/".base64_encode($oldkategori));
            return;
		}
	}

	public function DelData($kategori){
        $data		= array(
            "status"	=> 1,
        );

		// untuk sukses
		$result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		$kategori	= base64_decode($this->security->xss_clean($kategori));
		// $result		= $this->kategoriModel->hapusData($data,$kategori);

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/kategori");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/kategori");
		}

	}

}
