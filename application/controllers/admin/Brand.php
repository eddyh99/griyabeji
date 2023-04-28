<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/brandModel');
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {
        $data = array(
            'title'		 => 'Data Brand',
            'content'	 => 'admin/brand/index',
            'extra'		 => 'admin/brand/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Setup / Brand'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result		= $this->brandModel->listbrand();
		$result = array (
			array(
				"namabrand" 	=> "Baju",
				"keterangan"	=> "Keterangan Baju",
			),
			array(
				"namabrand" 	=> "Sepatu",
				"keterangan"	=> "Keterangan Sepatu",
			),
			array(
				"namabrand" 	=> "Celana",
				"keterangan"	=> "Keterangan Celana",
			),
			array(
				"namabrand" 	=> "Topi",
				"keterangan"	=> "Keterangan Topi",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){
        $data = array(
            'title'		 => 'Tambah Data Brand',
            'content'	 => 'admin/brand/tambah',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Setup / Brand / Tambah Brand'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('brand', 'Nama Brand', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/brand/tambah");
            return;
		}
		
		$brand		= $this->security->xss_clean($this->input->post('brand'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "namabrand"     => ucfirst($brand),
            "keterangan"    => $keterangan,
            "userid"        => $userid
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error 
		// $result		= $this->brandModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/brand");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/brand/tambah");
            return;
		}
	}

    public function ubah($brand){
        
		$brand		= base64_decode($this->security->xss_clean($brand));

		// $result		= $this->brandModel->getBrand($brand);
		$result		= array(
            "brand"  		=> ucfirst('Baju'),
            "keterangan" 	=> 'Ini Keterangan Baju',
            "userid"     	=> 'admin',
			"oldbrand"		=> 'oldbrand'
        );
		// print_r(json_encode($result));
		// die;

        $data		= array(
            'title'      => 'Ubah Data Brand',
            'content'    => 'admin/brand/ubah',
            'detail'     => $result,
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Setup / Brand / Ubah Brand'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('brand', 'Nama Brand', 'trim|required');
		$oldbrand	= $this->security->xss_clean($this->input->post('oldbrand'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/brand/ubah/".base64_encode($oldbrand));
            return;
		}

		$brand		= $this->security->xss_clean($this->input->post('brand'));
		$keterangan = $this->security->xss_clean($this->input->post('keterangan'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "namabrand"  	=> ucfirst($brand),
            "keterangan" 	=> $keterangan,
            "userid"     	=> $userid,
			"oldbrand"		=> $oldbrand
        );

		// Checking Success and Error 
		// $result		= $this->brandModel->updateData($data,$oldbrand);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/brand");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/brand/ubah/".base64_encode($oldbrand));
            return;
		}
	}

	public function DelData($brand){
        $userid		= $_SESSION["logged_status"]["username"];
		$brand		= base64_decode($this->security->xss_clean($brand));

        $data		= array(
            "status"  => 1,
            "userid"  => $userid
        );

		// Ceck Suskes & Gagal
		// $result		= $this->brandModel->hapusData($data,$brand);
	
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/brand");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/brand");
		}

	}

}
