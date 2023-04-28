<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/sizeModel');
    }
    
    public function index() {
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $data		= array(
            'title'		 => 'Data Size',
            'content'	 => 'admin/size/index',
            'extra'		 => 'admin/size/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side5'		 => 'active',
			'breadcrumb' => '/ Setup / Size'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result		= $this->sizeModel->Listsize();
		$result = array(
			array(
				"nama"	=> "M"
			), 	
			array(
				"nama"	=> "L"
			), 	
			array(
				"nama"	=> "N"
			), 	
			array(
				"nama"	=> "XXL"
			), 	
		);
		echo json_encode($result);
	}

    public function tambah(){
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $data		= array(
            'title'		 => 'Tambah Data Size',
            'content'	 => 'admin/size/tambah',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side5'		 => 'active',
			'breadcrumb' => '/ Setup / Size / Tambah Size'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('size', 'Size', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/size/tambah");
            return;
		}
		
		$size		= $this->security->xss_clean($this->input->post('size'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "nama"          => $size,
            "userid"        => $userid
        );
		
		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->sizeModel->insertData($data);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/size");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/size/tambah");
            return;
		}
	}

    public function ubah($size){
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
        
		$size		= base64_decode($this->security->xss_clean($size));

		// $result		= $this->sizeModel->getSize($size);
		$result		= array(
			"nama"		=> "M",
			"userid"	=> "admin",
			"oldsize"	=> "oldsize"	
        );

		// print_r(json_encode($result));
		// die;

        $data		= array(
            'title'      => 'Ubah Data Size',
            'content'    => 'admin/size/ubah',
            'detail'     => $result,
			'mn_setting' => 'active',
			'colset'	 => 'collapse-in',
			'side5'		 => 'active',
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('size', 'Size', 'trim|required');
		$oldsize	= $this->security->xss_clean($this->input->post('oldsize'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/size/ubah/".base64_encode($oldsize));
            return;
		}

		$size		= $this->security->xss_clean($this->input->post('size'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "nama"      => $size,
            "userid"    => $userid
        );

		// Checking Success and Error 
		// $result	= $this->sizeModel->updateData($data,$oldsize);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/size");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/size/ubah/".base64_encode($oldsize));
            return;
		}
	}

	public function DelData($size){
        $data		= array(
            "status"  => 1,
        );

		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result = $this->sizeModel->hapusData($data,$size);
		

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		$size	= base64_decode($this->security->xss_clean($size));

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/size");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/size");
		}

	}

}
