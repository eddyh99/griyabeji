<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_guide', 'guide');
		$this->load->model('admin/mdl_pengayah', "pengayah");
		$this->load->model('admin/mdl_pengunjung', "pengunjung");
		$this->load->model('admin/mdl_items', "items");
		$this->load->model('admin/mdl_produk', 'produk');
		$this->load->model('admin/mdl_paket', "paket");
		$this->load->model('admin/Mdl_pengguna', "pengguna");
		$this->load->model('Mdl_transaksi', "transaksi");
	}

	public function index()
	{

		$guide = $this->guide->listguide();
		// $guide = array (
		// 	array(
		// 		"id"            => "1",
		// 		"nama"		    => "Guide 1",
		// 		"whatsapp"		=> "11111111",
		// 	),
		// 	array(
		// 		"id"            => "2",
		// 		"nama"		    => "Guide 2",
		// 		"whatsapp"		=> "22222222",
		// 	),
		// );

		$pengayah = $this->pengayah->Listpengayah();
		// $pengayah = array (
		// 	array(
		//         "id"            => "1",
		// 		"nama"		    => "Pengayah 1",
		// 		"whatsapp"		=> "11111111",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"nama"		    => "Pengayah 2",
		// 		"whatsapp"		=> "22222222",
		// 	),
		// );

		$pengunjung = $this->pengunjung->Listpengunjung();
		// $pengunjung = array (
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
		// 	array(
		//         "id"            => "3",
		// 		"nama"		    => "Pengunjung 3",
		// 		"whatsapp"		=> "333",
		// 		"email"			=> "made@gmail.com",
		// 		"ig"			=> "made123",
		// 		"statename"		=> "Indonesia",
		// 		"countryname"	=> "Bali"	
		// 	),
		// 	array(
		//         "id"            => "4",
		// 		"nama"		    => "Pengunjung 4",
		// 		"whatsapp"		=> "44444444",
		// 		"email"			=> "made@gmail.com",
		// 		"ig"			=> "made123",
		// 		"statename"		=> "Indonesia",
		// 		"countryname"	=> "Bali"	
		// 	),

		// );

		// For Select Items
		$items = $this->items->listitems();

		// For Select Produk
		$produks = $this->produk->listproduk();

		// For Select Pakets
		$pakets = $this->paket->listpaket();

		// For Select Pengguna / Manager
		$pengguna = $this->pengguna->listpengguna();

		// For Select Country
		$countries = $this->pengunjung->getCountry();
		$data	= array(
			'title'		 => 'Data Pengguna',
			'content'	 => 'transaksi/index',
			'extra'		 => 'transaksi/js/js_index',
			'extracss'	 => 'transaksi/css/css_index',
			'guide'		 => $guide,
			'pengayah'	 => $pengayah,
			'pengunjung' => $pengunjung,
			'items'		 => $items,
			'produks'	 => $produks,
			'pakets'	 => $pakets,
			'pengguna'	 => $pengguna,
			'countries'	 => $countries,

		);

		$this->load->view('layout/wrapper', $data);
	}

	public function summarybayar()
	{
		$data	= array(
			'title'		 => 'Data Pengguna',
			'extracss'	 => 'transaksi/css/css_index',
			'content'	 => 'transaksi/bayar',
			'extra'		 => 'transaksi/js/js_bayar',
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function approval()
	{
		$approval = $this->security->xss_clean($this->input->post('passcode'));
		$result = $this->pengguna->check_passcode($approval);
		if (@$result["code"] == 0) {
			echo "0";
		}
	}

	public function simpandata()
	{
		$data = json_decode($this->security->xss_clean($this->input->post('data')));
		$guide = json_decode($this->security->xss_clean($this->input->post('guide')));
		$pengayah = json_decode($this->security->xss_clean($this->input->post('pengayah')));
		$diskon = $this->security->xss_clean($this->input->post('diskon'));
		$payment = $this->security->xss_clean($this->input->post('payment'));

		if (empty($guide->id_guide)) {
			$guide_id = NULL;
		} else {
			$guide_id = $guide->id_guide;
		}

		if (empty($pengayah->id_pengayah)) {
			$pengayah_id = NULL;
		} else {
			$pengayah_id = $pengayah->id_pengayah;
		}

		$mtrans = array(
			"guide_id"		=> $guide_id,
			"pengayah_id"	=> $pengayah_id,
			"tanggal"		=> date("y-m-d H:i:s"),
			"diskon"		=> $diskon,
			"method"		=> $payment,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result = $this->transaksi->add_data($mtrans, $data);
		if (@$result["code"] == 0) {
			echo "0";
		}
	}



	public function getstate()
	{
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
}
