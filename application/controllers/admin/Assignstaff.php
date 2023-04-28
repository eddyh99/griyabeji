<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignstaff extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	$this->load->model('admin/assignModel');
    	$this->load->model('admin/storeModel');
    	$this->load->model('admin/penggunaModel');
	   
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {
		// $result	= $this->assignModel->ListStaff();
		// print_r(json_encode($result));
		// die;

        $data = array(
            'title' 		=> 'Data Assign Staff',
            'content' 		=> 'admin/assignstaff/index',
            'extra' 		=> 'admin/assignstaff/js/js_index',
			'mn_master'	 	=> 'active',
			'colmas'	 	=> 'collapse in',
			'colset'	 	=> 'collapse',
			'collap'	 	=> 'collapse',
			'side6'			=> 'active',
			'breadcrumb' 	=> '/ Master Data / Assign Staff '
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result	= $this->assignModel->ListStaff();
		
		$result = array (
			array(
				"username" 		=> "yanyiik",
				"nama"			=> "Ari Pramana",
				"store"			=> "Hanaka Dalung",
				"alamat"		=> "jln padang luwih",
				"storeid"		=> "1",
			),
			array(
				"username" 		=> "boy",
				"nama"			=> "Boy William",
				"store"			=> "Hanaka Mengwi",
				"alamat"		=> "jln mengwi",
				"storeid"		=> "2",
			),
			array(
				"username" 		=> "reza_arap",
				"nama"			=> "Reza Mahardika",
				"store"			=> "Hanaka Singaraja",
				"alamat"		=> "jln singaraja",
				"storeid"		=> "3",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

		// Hanya get data yang non ADMIN !!
		// $staff	= $this->penggunaModel->getNonAdmin();
		$staff = array (
			array(
				"username"		=> "yanyiik99",
				"nama"			=> "yanyiik",
				"role"			=> "Store Manager"
			),
			array(
				"username"		=> "boy",
				"nama"			=> "boy william",
				"role"			=> "Office Manager"
			),
			array(
				"username"		=> "reza12",
				"nama"			=> "Reza Rahardian",
				"role"			=> "Staff"
			),
			array(
				"username"		=> "Ajes",
				"nama"			=> "Dewa Ajess",
				"role"			=> "Staff"
			),
		);

		// $store	= $this->storeModel->Liststore();
		$store = array(
			array(
				"storeid" 		=> "1",
				"store" 		=> "hanaka dalung",
				"alamat"		=> "jln padang luwing",
				"keterangan"	=> "ini hanaka dalung",
				"kontak"		=> "0909090909",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
			array(
				"storeid" 		=> "2",
				"store" 		=> "hanaka mengwi",
				"alamat"		=> "jln mengwi",
				"keterangan"	=> "keterangan hanaka mengwi",
				"kontak"		=> "1011111111",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
			array(
				"storeid" 		=> "3",
				"store" 		=> "hanaka singaraja",
				"alamat"		=> "jln singaraja",
				"keterangan"	=> "keterangan hanaka singaraja",
				"kontak"		=> "12313",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
		);

		// print_r(json_encode($staff));
		// die;


        $data	= array(
            'title'		 => 'Tambah Data Staff',
            'content'	 => 'admin/assignstaff/tambah',
            'extra'		 => 'admin/assignstaff/js/js_tambah',
			'store'		 => $store,
			'staff'		 => $staff,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse in',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'side6'		 => 'active',
			'breadcrumb' => '/ Master Data / Assign Staff / Tambah Data Staff'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('username', 'Staff', 'trim|required');
		$this->form_validation->set_rules('storeid', 'Store', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("/admin/assignstaff/tambah");
            return;
		}
		
		$username	= $this->security->xss_clean($this->input->post('username'));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));
        $userid		= $_SESSION["logged_status"]["username"];

        $data		= array(
            "username"		=> $username,
            "storeid"		=> $storeid,
            "userid"        => $userid
        );

		// print_r(json_encode($data));
		// die;
		
		// Checking Success and Error 
		// $result		= $this->assignModel->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("/admin/assignstaff");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/assignstaff/tambah");
            return;
		}
	}
	
	public function DelData($uname,$storeid){
        $userid		= $_SESSION["logged_status"]["username"];
		$uname		= base64_decode($this->security->xss_clean($uname));
		$storeid	= base64_decode($this->security->xss_clean($storeid));

        $data		= array(
            "status"  => 1,
            "userid"  => $userid
        );

		$where		= array(
			"username"	=> $uname,
			"storeid"	=> $storeid
		);

		// Ceck Suskes & Gagal
		// $result		= $this->assignModel->hapusData($data,$where);
		
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("/admin/assignstaff");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("/admin/assignstaff");
		}

	}

}
