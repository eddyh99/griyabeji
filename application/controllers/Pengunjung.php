<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
	   	$this->load->model('admin/mdl_pengunjung',"pengunjung");
    }
    
    public function index() {

        $data	= array(
            'title'		 => NAMETITLE . ' - Data Pengunjung',
            'content'	 => 'pengunjung/index',
            'extra'		 => 'pengunjung/js/js_index',
			'mn_setting' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side15'	 => 'active',
			'breadcrumb' => 'Master / Pengunjung'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
		$result=$this->pengunjung->Listpengunjung();
		// $result = array (
		// 	array(
        //         "id"            => "1",
		// 		"nama"		    => "I Made Farhan Sucipto Nugroho",
		// 		"whatsapp"		=> "11111111",
		// 		"email"			=> "made@gmail.com",
		// 		"ig"			=> "made123",
		// 		"statename"		=> "Indonesia",
		// 		"countryname"	=> "Bali"			

		// 	),
		// 	array(
        //         "id"            => "2",
		// 		"nama"		    => "Pengunjung 2",
		// 		"whatsapp"		=> "22222222",
		// 		"email"			=> "made@gmail.com",
		// 		"ig"			=> "made123",
		// 		"statename"		=> "Indonesia",
		// 		"countryname"	=> "Bali"	
		// 	),

		// );
		echo json_encode($result);
	}

    public function tambah(){

		$countries = $this->pengunjung->getCountry();
		// array(
		// 	array(
		// 		"code"		=> "ID",
		// 		"name"		=> "Indonesia"
		// 	),
		// 	array(
		// 		"code"		=> "AE",
		// 		"name"		=> "United Arab Emirates"
		// 	),
		// 	array(
		// 		"code"		=> "BR",
		// 		"name"		=> "Brazil"
		// 	),
		// );


		// $states = array(
		// 	array(
		// 		"state_code"		=> "AC",
		// 		"country_code"		=> "ID",
		// 		"state_name"		=> "Aceh"
		// 	),
		// 	array(
		// 		"state_code"		=> "BA",
		// 		"country_code"		=> "ID",
		// 		"state_name"		=> "Bali"
		// 	),
		// 	array(
		// 		"state_code"		=> "AJ",
		// 		"country_code"		=> "AE",
		// 		"state_name"		=> "Ajman Emirate"
		// 	),
		// 	array(
		// 		"state_code"		=> "DU",
		// 		"country_code"		=> "AE",
		// 		"state_name"		=> "Dubai"
		// 	),
		// );

        $data = array(
            'title'		 		=> NAMETITLE . ' - Tambah Data Pengunjung',
            'content'	 		=> 'pengunjung/tambah',
            'extra'	 			=> 'pengunjung/js/js_tambah',
			'side15'		 	=> 'active',
			'breadcrumb' 		=> 'Master / Pengunjung / Tambah Data', 
			'countries'			=> $countries,
			// 'states'			=> $states
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function getstate(){
		$country    = $_GET["country"];
        // $url    = URLAPI . "/v1/member/findme/get_statelist?country=".$country;
        // $state  = apitrackless($url)->message;

		$states =  $this->pengunjung->getstate($country);
		// array(
		// 	array(
		// 		"state_code"		=> "AC",
		// 		"country_code"		=> "ID",
		// 		"state_name"		=> "Aceh"
		// 	),
		// 	array(
		// 		"state_code"		=> "BA",
		// 		"country_code"		=> "ID",
		// 		"state_name"		=> "Bali"
		// 	),
		// 	array(
		// 		"state_code"		=> "AJ",
		// 		"country_code"		=> "AE",
		// 		"state_name"		=> "Ajman Emirate"
		// 	),
		// 	array(
		// 		"state_code"		=> "DU",
		// 		"country_code"		=> "AE",
		// 		"state_name"		=> "Dubai"
		// 	),
		// );

        echo json_encode($states);
	}

	public function AddData(){
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('countryname', 'Country', 'trim|required');
		$this->form_validation->set_rules('statename', 'State', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."pengunjung/tambah");
            return;
		}
		
		$nama	    	= $this->security->xss_clean($this->input->post('nama'));
		$whatsapp		= $this->security->xss_clean($this->input->post('whatsapp'));
		$email			= $this->security->xss_clean($this->input->post('email'));
		$ig				= $this->security->xss_clean($this->input->post('ig'));
		$countryname	= $this->security->xss_clean($this->input->post('countryname'));
		$statename		= $this->security->xss_clean($this->input->post('statename'));

        
        $data		= array(
            "nama"      	=> $nama,
            "whatsapp"  	=> $whatsapp,
            "email"		  	=> $email,
            "ig"		  	=> $ig,
			"state_id"  	=> $statename,
			"country_code"	=> $countryname,
			"userid"		=> $_SESSION["logged_status"]["username"]
        );

		// print_r($data);
		// die;

		// Checking Success and Error AddData
		$result		= $this->pengunjung->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

				
		
		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."pengunjung");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengunjung/tambah");
            return;
		}
	}

    public function ubah($id){
        
		$id	= base64_decode($this->security->xss_clean($id));
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$result		= $this->pengunjung->getPengunjung($id);

		// $result = array (
		// 	"id"			=> $id,
		// 	"nama"		    => "Pengunjung 2",
		// 	"whatsapp"	    => "085123123123",
		// 	"email"		    => "pengunjung@gmail.com",
		// 	"ig"		    => "",
		// 	"code"  		=> "ID",
		// 	"countryname"  	=> "Indoensia",
        //     "state_code"  	=> "BA",
        //     "statename"  	=> "Bali",
		// );

		
		$countries = $this->pengunjung->getCountry();
		$states =  $this->pengunjung->getstate($result["code"]);
		
		//@todo
		//cek di view, ketika ganti negara, provinsi dari pertama dari negara sebelum
		//muncul kemudian di lanjut dengan provinsi dari negara yang di pilih

        $data		= array(
            'title'		 => NAMETITLE . ' - Ubah Data Pengunjung',
            'content'    => 'pengunjung/ubah',
			'extra'		 => 'pengunjung/js/js_tambah',
            'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side15'	 => 'active',
			'breadcrumb' => 'Master / Pengunjung / Ubah Data',
			'countries'	 => $countries,
			'states'	 => $states
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function updateData(){
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('countryname', 'Country', 'trim|required');
		$this->form_validation->set_rules('statename', 'State', 'trim|required');

		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
		    redirect(base_url()."pengunjung/ubah/".base64_encode($id));
            return;
		}

		$id			= $this->security->xss_clean($this->input->post('id'));
		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));
		$email			= $this->security->xss_clean($this->input->post('email'));
		$ig				= $this->security->xss_clean($this->input->post('ig'));
		$countryname	= $this->security->xss_clean($this->input->post('countryname'));
		$statename		= $this->security->xss_clean($this->input->post('statename'));
		$id			    = $this->security->xss_clean($this->input->post('id'));


        $data	= array(
            "nama"      	=> $nama,
            "whatsapp"  	=> $whatsapp,
			"email"		  	=> $email,
            "ig"		  	=> $ig,
			"state_id"  	=> $statename,
			"country_code"	=> $countryname,
			"userid"		=> $_SESSION["logged_status"]["username"]
        );

		$result		= $this->pengunjung->updateData($data,$id);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message',  $this->message->success_msg());
		    redirect(base_url()."pengunjung");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengunjung/ubah/".base64_encode($id));
            return;
		}
	}

	public function DelData($id){
        $data		= array(
            "status"  => 'yes',
        );

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->pengunjung->hapusData($data,$id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->delete_msg());
		    redirect(base_url()."pengunjung");
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."pengunjung");
		}

	}

}
