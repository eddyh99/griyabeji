<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	   $this->load->model('admin/PenggunaModel');
    }
    
    public function index() {

        $data	= array(
            'title'		 => 'Data Pengguna',
            'content'	 => 'admin/pengguna/index',
            'extra'		 => 'admin/pengguna/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side1'		 => 'active',
			'breadcrumb' => '/ Setup / Pengguna'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
				"username"		=> "admin",
				"nama"			=> "admin",
				"role"			=> "Owner"
			),
			array(
				"username"		=> "offs",
				"nama"			=> "offs",
				"role"			=> "Office Staff"
			),
			array(
				"username"		=> "offm",
				"nama"			=> "offm",
				"role"			=> "Office Manager"
			),
			array(
				"username"		=> "storeman",
				"nama"			=> "storeman",
				"role"			=> "Store Manager"
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

        $data = array(
            'title'		 => 'Tambah Data Pengguna',
            'content'	 => 'admin/pengguna/tambah',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side1'		 => 'active',
			'breadcrumb' => '/ Setup / Pengguna / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."/admin/pengguna/tambah");
            return;
		}
		
		$username	= $this->security->xss_clean($this->input->post('username'));
		$password	= $this->security->xss_clean($this->input->post('password'));
		$nama		= $this->security->xss_clean($this->input->post('nama'));
		$role		= $this->security->xss_clean($this->input->post('role'));
        
        $data		= array(
            "username"  => $username,
            "passwd"    => sha1($password),
            "nama"      => $nama,
            "role"      => $role,
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
		    redirect(base_url()."admin/pengguna");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/pengguna/tambah");
            return;
		}
	}

    public function ubah($username){
        
		$username	= base64_decode($this->security->xss_clean($username));

		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);
		$result = array (
			"username"		=> "admin",
			"nama"			=> "admin",
			"role"			=> "Owner"
		);



        $data		= array(
            'title'		 => 'Ubah Data Pengguna',
            'content'    => 'admin/pengguna/ubah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side1'		 => 'active',
			'breadcrumb' => '/ Setup / Pengguna / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		$username	= $this->security->xss_clean($this->input->post('username'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."admin/pengguna/ubah/".base64_encode($username));
            return;
		}

		$password	= $this->security->xss_clean($this->input->post('password'));
		$nama		= $this->security->xss_clean($this->input->post('nama'));
		$role		= $this->security->xss_clean($this->input->post('role'));

        if (empty($password)){
            $data	= array(
                "username"  => $username,
                "nama"      => $nama,
                "role"      => $role,
            );
        }else{
            $data	= array(
                "username"  => $username,
                "passwd"    => sha1($password),
                "nama"      => $nama,
                "role"      => $role,
            );
        }

		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', "Data Berhasil Disimpan");
		    if ($_SESSION["logged_status"]["role"]=="Staff"){
    		    redirect(base_url()."staff/dashboard");
		    }
		    redirect(base_url()."admin/pengguna");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."admin/pengguna/ubah/".base64_encode($username));
            return;
		}
	}

	public function DelData($username){
        $data		= array(
            "status"  => 1,
        );

		


		$username	= base64_decode($this->security->xss_clean($username));
		// $result		= $this->PenggunaModel->hapusData($data,$username);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect(base_url()."/admin/pengguna");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."/admin/pengguna");
		}

	}

}
