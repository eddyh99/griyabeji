<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	//    $this->load->model('admin/GuideModel');
    }
    
    public function index() {

		$guide = array (
			array(
				"id"            => "1",
				"nama"		    => "Guide 1",
				"whatsapp"		=> "11111111",
			),
			array(
				"id"            => "2",
				"nama"		    => "Guide 2",
				"whatsapp"		=> "22222222",
			),
		);

		$pengayah = array (
			array(
                "id"            => "1",
				"nama"		    => "Pengayah 1",
				"whatsapp"		=> "11111111",
			),
			array(
                "id"            => "2",
				"nama"		    => "Pengayah 2",
				"whatsapp"		=> "22222222",
			),
		);

		$pengunjung = array (
			array(
                "id"            => "1",
				"nama"		    => "I Made Farhan Sucipto Nugroho",
				"whatsapp"		=> "11111111",
				"email"			=> "made@gmail.com",
				"ig"			=> "made123",
				"statename"		=> "Indonesia",
				"countryname"	=> "Bali"			

			),
			array(
                "id"            => "2",
				"nama"		    => "Pengunjung 2",
				"whatsapp"		=> "22222222",
				"email"			=> "made@gmail.com",
				"ig"			=> "made123",
				"statename"		=> "Indonesia",
				"countryname"	=> "Bali"	
			),
			array(
                "id"            => "3",
				"nama"		    => "Pengunjung 3",
				"whatsapp"		=> "333",
				"email"			=> "made@gmail.com",
				"ig"			=> "made123",
				"statename"		=> "Indonesia",
				"countryname"	=> "Bali"	
			),
			array(
                "id"            => "4",
				"nama"		    => "Pengunjung 4",
				"whatsapp"		=> "44444444",
				"email"			=> "made@gmail.com",
				"ig"			=> "made123",
				"statename"		=> "Indonesia",
				"countryname"	=> "Bali"	
			),

		);


        $data	= array(
            'title'		 => 'Data Pengguna',
            'content'	 => 'transaksi/index',
            'extra'		 => 'transaksi/js/js_index',
            'extracss'	 => 'transaksi/css/css_index',
			'guide'		 => $guide,
			'pengayah'	 => $pengayah,
			'pengunjung' => $pengunjung,

		);

		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		// $result=$this->PenggunaModel->listpengguna();
		$result = array (
			array(
                "id"            => "1",
				"namastore"		=> "Waterfall Store",
			),
			array(
                "id"            => "2",
				"namastore"		=> "Pool Store",
			),
		);
		echo json_encode($result);
	}

    public function tambah(){

        $data = array(
            'title'		 => 'Tambah Data Pengayah',
            'content'	 => 'store/tambah',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => '/ Master / Store / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){
		$this->form_validation->set_rules('namastore', 'Nama Store', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."store/tambah");
            return;
		}
		
		$namastore	    = $this->security->xss_clean($this->input->post('namastore'));

        
        $data		= array(
            "namastore"      => $namastore
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
		    redirect(base_url()."store");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."store/tambah");
            return;
		}
	}

    public function ubah(){
        
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);

		$result = array (
			"namastore"		    => "Waterfall Beji",
		);

        $data		= array(
            'title'		 => 'Ubah Data Pengguna',
            'content'    => 'store/ubah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => '/ Setup / Store / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('namastore', 'Nama Store', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."store/ubah/".base64_encode($id));
            return;
		}

		$namastore	    = $this->security->xss_clean($this->input->post('namastore'));


        $data	= array(
            "namastore"      => $namastore
        );

		// print_r(json_encode($data));
		// die;


		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		$result["code"]=5011;
		$result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."store");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."store/ubah/".base64_encode($id));
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
		    redirect(base_url()."store");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."store");
		}

	}

}
