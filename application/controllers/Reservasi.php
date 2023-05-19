<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi extends CI_Controller
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
		$this->load->model('Mdl_reservasi', "reservasi");
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
			'title'		 => 'Reservasi',
			'content'	 => 'reservasi/index',
			'extra'		 => 'reservasi/js/js_index',
			'extracss'	 => 'reservasi/css/css_index',
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
			'title'		 => 'Reservasi',
			'extracss'	 => 'reservasi/css/css_index',
			'content'	 => 'reservasi/bayar',
			'extra'		 => 'reservasi/js/js_bayar',
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
		$data = json_decode($this->security->xss_clean($this->input->get('data')));
		$guide = json_decode($this->security->xss_clean($this->input->get('guide')));
		$pengayah = json_decode($this->security->xss_clean($this->input->get('pengayah')));
		$jumlahpengunjung = json_decode($this->security->xss_clean($this->input->get('jumlahpengunjung')));
		$DP = $this->security->xss_clean($this->input->post('dp'));


		$url = '././assets/Bukti_Pembayaran/';
		$buktiUpload = time() . '.png';
		$image_name =  $url . $buktiUpload;
		// file_put_contents($image_name, $data);

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

		$allowTypes = array('jpg', 'png', 'jpeg');
		// Upload file 
		$uploadedFile = '';
		if (!empty($_FILES["bukti_bayar"]["name"])) {
			// File path config 
			$fileName = basename($_FILES["bukti_bayar"]["name"]);
			$fileType = pathinfo($image_name, PATHINFO_EXTENSION);

			// Allow certain file formats to upload 
			if (in_array($fileType, $allowTypes)) {
				// Upload file to the server 
				if (move_uploaded_file($_FILES["bukti_bayar"]["tmp_name"], $image_name)) {
					$uploadedFile = $fileName;
				} else {
					$uploadStatus = 0;
					$response['message'] = 'Sorry, there was an error uploading your file.';
				}
			} else {
				$uploadStatus = 0;
				$response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
			}
		}

		$mtrans = array(
			"pengayah_id"	=> $pengayah_id,
			"guide_id"		=> $guide_id,
			"tanggal"		=> date("y-m-d H:i:s"),
			"jml_tamu"		=> $jumlahpengunjung->jumlah_pengunjung,
			"DP"			=> $DP,
			"buktibayar"	=> $buktiUpload,
			"is_proses"		=> "yes",
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result = $this->reservasi->add_data($mtrans, $data);
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
