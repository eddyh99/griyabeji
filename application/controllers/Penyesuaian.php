<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyesuaian extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url('/'));
        }
	//    $this->load->model('admin/GuideModel');
    }
    
    public function index() {

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
            'content'	 => 'penyesuaian/index',
            'extra'		 => 'penyesuaian/js/js_index',
			'side11'     => 'active',
			'breadcrumb' => '/ Penyesuaian',
            'items'      => $items
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function AddData(){		
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok System', 'trim|required');
		$this->form_validation->set_rules('riil', 'Stok Riil', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');


		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."penyesuaian");
            return;
		}
		
		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$stok	    	= $this->security->xss_clean($this->input->post('stok'));
		$riil	        = $this->security->xss_clean($this->input->post('riil'));
		$keterangan	    = $this->security->xss_clean($this->input->post('keterangan'));

        
        $data		= array(
            "namaitems"      	=> $namaitems,
            "stok"      		=> $stok,
            "riil"      	    => $riil,
            "keterangan"        => $keterangan,
        );

		print_r(json_encode($data));
		die;

		// Checking Success and Error AddData
		// $result		= $this->PenggunaModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."penyesuaian");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."penyesuaian");
            return;
		}
	}


}
