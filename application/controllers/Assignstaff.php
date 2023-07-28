<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignstaff extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	$this->load->model('admin/mdl_assignstaff',"assignstaff");
    	$this->load->model('admin/mdl_store', 'store');
    	$this->load->model('admin/mdl_pengguna',"pengguna");
	   
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {
		// $result	= $this->assignModel->ListStaff();
		// print_r(json_encode($result));
		// die;
		$data	= array(
			'title'		 => NAMETITLE . ' - Data Assign Staff',
			'content'	 => 'assignstaff/index',
			'extra'		 => 'assignstaff/js/js_index',
			'colmas'	 => 'hover show',
			'side8'		 => 'active',
			'breadcrumb' => 'Master / Assign Staff'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		$result	= $this->assignstaff->ListStaff();
		
		echo json_encode($result);
	}

    public function tambah(){

		// Hanya get data yang non ADMIN !!
		$staff	= $this->pengguna->getNonAdmin();
		$store	= $this->store->Liststore();
		// print_r(json_encode($staff));
		// die;
		$data	= array(
			'title'		 => NAMETITLE . ' - Tambah Data Staff',
			'content'	 => 'assignstaff/tambah',
			'extra'		 => 'assignstaff/js/js_tambah',
			'colmas'	 => 'hover show',
			'store'		 => $store,
			'staff'		 => $staff,
			'side8'		 => 'active',
			'breadcrumb' => 'Master Data / Assign Staff / Tambah Data Staff'
		);

		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('username', 'Staff', 'trim|required');
		$this->form_validation->set_rules('storeid', 'Store', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect("assignstaff/tambah");
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
		 $result		= $this->assignstaff->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect("assignstaff");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("assignstaff/tambah");
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
		$result		= $this->assignstaff->hapusData($data,$where);
		
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";


		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect("assignstaff");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect("assignstaff");
		}

	}

}
