<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengayah extends CI_Controller {

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
            'content'	 => 'pengayah/index',
            'extra'		 => 'pengayah/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Master / Pengayah'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"nama"		    => "I Made Farhan Sucipto Nugroho",
				"whatsapp"		=> "11111111",
			),
			array(
                "id"            => "2",
				"nama"		    => "Pengayah 2",
				"whatsapp"		=> "22222222",
			),
			array(
                "id"            => "3",
				"nama"		    => "Pengayah 3",
				"whatsapp"		=> "333333333",
			),
			array(
                "id"            => "4",
				"nama"		    => "Pengayah 4",
				"whatsapp"		=> "44444444",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

        $data = array(
            'title'		 => 'Tambah Data Pengayah',
            'content'	 => 'pengayah/tambah',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Master / Pengayah / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."pengayah/tambah");
            return;
		}
		
		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));

        
        $data		= array(
            "nama"      => $nama,
            "whatsapp"  => $whatsapp,
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
		    redirect(base_url()."pengayah");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengayah/tambah");
            return;
		}
	}

    public function ubah(){
        
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);

		$result = array (
			"nama"		    => "Pengayah 2",
			"whatsapp"	    => "085123123123",
		);

        $data		= array(
            'title'		 => 'Ubah Data Pengguna',
            'content'    => 'pengayah/ubah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => '/ Setup / Pengayah / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."pengayah/ubah/".base64_encode($id));
            return;
		}

		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));


        $data	= array(
            "nama"      => $nama,
            "whatsapp"  => $whatsapp,
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
		    redirect(base_url()."pengayah");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengayah/ubah/".base64_encode($id));
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
		    redirect(base_url()."pengayah");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengayah");
		}

	}

}
