<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	    $this->load->model("staff/returModel");
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {

        $data		= array(
            'title'		 => 'Ganti Cara Bayar',
            'content'	 => 'admin/bayar/index',
            'extra'		 => 'admin/bayar/js/js_index',
			'mn_bayar'   => 'active',
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'breadcrumb' => '/ Ganti Cara Bayar'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result		= $this->returModel->listnota();
		$result = array(
			array(
				"nonota"		=> "111",
				"tanggal"		=> "17-01-2023",
				"nama"			=> "yanyiik",
				"total"			=> "12000000",
				"method"		=> "cash"
			),
		);
		echo json_encode($result);
	}
	
	public function ganti($id){
        $key=base64_decode($id);
	    $detail=$this->returModel->detailnota($key);
        $data		= array(
            'title'		=> 'Ganti Cara Bayar',
            'content'	=> 'admin/bayar/ganti',
            'extra'		=> 'admin/bayar/js/js_ganti',
			'mn_bayar'  => 'active',
			'detail'    => $detail,
			'colmas'	=> 'collapse',
			'colset'	=> 'collapse',
			'collap'	=> 'collapse',
			'breadcrumb' => '/ Ganti Cara Bayar / Ganti'
		);
		$this->load->view('layout/wrapper', $data);
	}
    
    public function gantibayar(){
		$key	= $this->security->xss_clean($this->input->post('key'));

        $this->form_validation->set_rules('carabayar', 'Cara Pembayaran', 'trim|required');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('gagal', $this->message->error_msg(validation_errors()));
		    redirect("/admin/bayar/ganti/".base64_encode($key));
            return;
		}

		$carabayar	= $this->security->xss_clean($this->input->post('carabayar'));
		$fee        = $this->security->xss_clean($this->input->post('fee'));
		if ($carabayar=="credit"){
		    if ($fee<=0){
    		    $this->session->set_flashdata('gagal', $this->message->error_msg(validation_errors()));
    		    redirect("/admin/bayar/ganti/".base64_encode($key));
                return;
		    }
		}else{
		    $fee=0;
		}
		
		$mdata=array(
		        "method"    => $carabayar,
		        "fee"       => $fee
		    );
		$result	    = $this->returModel->ganti_bayar($key,$mdata);
	    $this->session->set_flashdata('gagal', $this->message->error_msg(validation_errors()));
	    redirect("/admin/bayar");
		
    }
}
