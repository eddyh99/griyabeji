<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyesuaian extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url('/'));
        }
	    $this->load->model('admin/mdl_items','items');
	    $this->load->model('admin/mdl_penyesuaian','penyesuaian');
    }
	
	// ===== START PENYESUAIAN =====

    public function index() {
		$items=$this->items->listitems();
        // $items = array(
		// 	array(
		// 		"id"			=> "1",
		// 		"namaitem"		=> "Dupa Wangi"
		// 	),
		// 	array(
		// 		"id"			=> "2",
		// 		"namaitem"		=> "Canang Sari"
		// 	),
		// 	array(
		// 		"id"			=> "3",
		// 		"namaitem"		=> "Aqua"
		// 	),
		// );

        $data	= array(
            'title'		 => NAMETITLE . ' - Data Penyesuaian',
            'content'	 => 'penyesuaian/index',
            'extra'		 => 'penyesuaian/js/js_index',
			'side11'     => 'active',
			'breadcrumb' => 'Penyesuaian',
            'items'      => $items
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function stokitem(){
		$result=$this->penyesuaian->getstok($_GET["items_id"]);		
		echo $result;
	}

	public function AddData(){		
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('riil', 'Stok Riil', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');


		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."penyesuaian");
            return;
		}
		
		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$riil	        = $this->security->xss_clean($this->input->post('riil'));
		$keterangan	    = $this->security->xss_clean($this->input->post('keterangan'));

        
        $data		= array(			
            "id_items"      	=> $namaitems,
            "tanggal"      		=> date("Y-m-d H:i:s"),
            "jumlah"      	    => $riil-$this->penyesuaian->getstok($namaitems),
            "keterangan"        => $keterangan,
			"userid" 			=> $_SESSION["logged_status"]["username"]
        );

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->penyesuaian->insertData($data);

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

	// ===== END PENYESUAIAN =====


	// ===== START APPROVAL PENYESUAIAN =====

	public function approval(){
        $data	= array(
            'title'		 => NAMETITLE . ' - Approval Penyesuaian',
            'content'	 => 'penyesuaian/approval',
            'extra'		 => 'penyesuaian/js/js_approval',
			'side12'     => 'active',
			'breadcrumb' => 'Approval Penyesuaian',
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata(){
		$result=$this->penyesuaian->getpenyesuaian();
		// $result = array (
		// 	array(
		// 		"id"			=> "1",
		// 		"tanggal"		=> "23 May 2023",
		// 		"namaitems"		=> "Dupa Wangi",
		// 		"stok"			=> "12",
		// 		"riil"			=> "10",
		// 		"keterangan"	=> "Hilang 1",
		// 		// "approved"		=> "belum",
		// 	),
		// 	array(
		// 		"id"			=> "1",
		// 		"tanggal"		=> "23 May 2023",
		// 		"namaitems"		=> "Dupa Wangi",
		// 		"stok"			=> "12",
		// 		"riil"			=> "10",
		// 		"keterangan"	=> "Hilang 1",
		// 		// "approved"		=> "sudah",
		// 	),
		// 	array(
		// 		"id"			=> "1",
		// 		"tanggal"		=> "23 May 2023",
		// 		"namaitems"		=> "Dupa Wangi",
		// 		"stok"			=> "12",
		// 		"riil"			=> "10",
		// 		"keterangan"	=> "Hilang 1",
		// 		// "approved"		=> "belum",
		// 	),
		// );
		echo json_encode($result);
	}

	public function simpandata(){
		$id = $this->security->xss_clean($this->input->post('id'));		
		$mdata=array();
		foreach ($id as $dt){
			$temp["approved"]=1;
			$temp["id"]=$dt;
			array_push($mdata,$temp);
		}

		$result=$this->penyesuaian->setapprove($mdata);
		redirect("penyesuaian/approval");
	}

	// ===== END APPROVAL PENYESUAIAN =====

}
