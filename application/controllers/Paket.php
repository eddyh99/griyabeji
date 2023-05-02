<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	    $this->load->model('admin/mdl_paket',"paket");
	    $this->load->model('admin/mdl_produk',"produk");
    }
    
    public function index() {

        $data	= array(
            'title'		 => NAMETITLE . ' - Data Paket',
            'content'	 => 'paket/index',
            'extra'		 => 'paket/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side6'		 => 'active',
			'breadcrumb' => 'Master / Paket'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		$result=$this->paket->listpaket();
		$i=0;
		foreach ($result as $dt){
			$result[$i]["namaproduk"]=array();
			$items=$this->paket->itempaket($dt["id"]);
			foreach ($items as $itm){
				array_push($result[$i]["namaproduk"],$itm["namaproduk"]);
			}
			$i++;
		}

		// $result = array (
		// 	array(
        //         "id"            => "1",
		// 		"namapaket"	    => "Middle Spiritual",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
        //         "namaproduk"	=> ["Purification Ceremony", "Healing Therapy"]
		// 	),
		// 	array(
        //         "id"            => "2",
		// 		"namapaket"	    => "Middle Hash",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
        //         "namaproduk"	=> ["Palm Reading", "Healing Therapy"]
		// 	),
		// 	array(
        //         "id"            => "3",
		// 		"namapaket"	    => "Combo Complate",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
        //         "namaproduk"	=> ["Palm Reading", "Healing Therapy", "Purification Ceremony"]
		// 	),
		// );
		echo json_encode($result);
	}

    public function tambah(){

		$items = $this->produk->listproduk();
		//  array (
		// 	array(
        //         "id"            => "1",
		// 		"namaproduk"		=> "Palm Reading",
		// 	),
		// 	array(
        //         "id"            => "2",
		// 		"namaproduk"		=> "Healing Therapy",
		// 	),
		// 	array(
        //         "id"            => "3",
		// 		"namaproduk"		=> "Purification Ceremony",
		// 	),
		// );




        $data = array(
            'title'		 => NAMETITLE . ' - Tambah Data Paket',
            'content'	 => 'paket/tambah',
			'extra'	     => 'paket/js/js_tambah',
            'extracss'	 => 'paket/css/css_tambah',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side6'		 => 'active',
			'breadcrumb' => 'Master / Paket / Tambah Data',
			'produks'	 => $items,
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){		
		$this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_produk[]', 'Nama Produk', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."paket/tambah");
            return;
		}
		
		$namapaket	    = $this->security->xss_clean($this->input->post('namapaket'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_produk	    = $this->security->xss_clean($this->input->post('id_produk'));

        $data		= array(
            "namapaket"    => $namapaket,
			"userid"		=> $_SESSION["logged_status"]["username"]
        );

		$harga		= array(
			"tanggal"		=> date("Y-m-d H:i:s"),
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->paket->insertData($data,$harga,$id_produk);
		print_r($result);
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."paket");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket/tambah");
            return;
		}
	}

    public function ubah($id){
        
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);
		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->paket->getPaket($id);
		$items		= $this->paket->itempaket($id);

		// $produk		= $result;
		$result["id_items"]=array();
		foreach ($items as $itm){
			array_push($result["id_items"],$itm["id_produk"]);
		}
		
		// $result = array (
		// 	"namaproduk"	=> "PURIFICATION CEREMONY",
		// 	"local"			=> "1000000",
		// 	"domestik"		=> "2000000",
		// 	"internasional"	=> "3000000",
		// 	"id_items"		=> ["1", "2", "2"]
		// );

		// $items = array (
		// 	array(
        //         "id"            => "1",
		// 		"namaitem"		=> "Dupa Wangi",
		// 	),
		// 	array(
        //         "id"            => "2",
		// 		"namaitem"		=> "Gelang Tridatu",
		// 	),
		// 	array(
        //         "id"            => "3",
		// 		"namaitem"		=> "Canang Sari",
		// 	),
		// 	array(
        //         "id"            => "4",
		// 		"namaitem"		=> "Toples Tirta",
		// 	),
		// 	array(
        //         "id"            => "5",
		// 		"namaitem"		=> "Dupa Cempaka",
		// 	),
		// );


		// print_r(json_encode($result));
		// die;



        $data		= array(
            'title'		 => NAMETITLE . ' - Ubah Data Paket',
            'content'    => 'paket/ubah',
            'detail'     => $result,
			'items'		 => $items,
			'extra'	     => 'paket/js/js_tambah',
            'extracss'	 => 'paket/css/css_tambah',
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side6'		 => 'active',
			'breadcrumb' => '/ Setup / Paket / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."paket/ubah/".base64_encode($id));
            return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_items	    = $this->security->xss_clean($this->input->post('id_items'));
		$id	    		= $this->security->xss_clean($this->input->post('id'));

        
        $data		= array(
            "namapaket"    	=> $namaproduk,
			"userid"		=> $_SESSION["logged_status"]["username"]
        );

		$harga		= array(
			"id_paket"		=> $id,
			"tanggal"		=> date("Y-m-d H:i:s"),
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"userid"		=> $_SESSION["logged_status"]["username"]
		); 


		$result		= $this->paket->updateData($data,$harga,$id_items,$id);

		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."paket");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket/ubah/".base64_encode($id));
            return;
		}
	}

	public function DelData($id){
        $data		= array(
            "status"  => 'yes',
        );

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->paket->hapusData($data,$id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect(base_url()."paket");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."paket");
		}

	}

}
