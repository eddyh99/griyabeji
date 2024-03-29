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
		$this->load->model('Mdl_reservasi', "reservasi");
	}

	public function index()
	{

		$guide = $this->guide->listguide();
		$pengayah = $this->pengayah->Listpengayah();
		$pengunjung = $this->pengunjung->Listpengunjung();

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
			'title'		 => 'Transaksi',
			'content'	 => 'transaksi/index',
			'extra'		 => 'transaksi/js/js_index',
			'extracss'	 => 'transaksi/css/css_index',
			'h_tc'		 => 'collapse',
			'sidetc'	 => 'active',
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

	public function listTransaksi()
	{
		if (@!isset($_GET["tanggal"])) {
			$tanggal_awal       = date("Y-m-d", strtotime("first day of 0 month"));
			$tanggal_akhir      = date("Y-m-d", strtotime("last day of 0 month"));
		} else {
			$tgl     = $this->security->xss_clean($_GET["tanggal"]);
			$tanggal		= explode("-", $tgl);
			$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
			$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");
		}

		$result = $this->transaksi->listTansaksi($tanggal_awal, $tanggal_akhir);
		$data	= array(
			'title'		 => 'Data Transaksi',
			'content'	 => 'transaksi/list',
			'extra'		 => 'transaksi/js/js_list',
			'extracss'	 => 'transaksi/css/css_index',
			'h_tc'		 => 'collapse',
			'sidetc1'	 => 'active',
			'list'		 => $result,
			'tgl'		 => @$tgl,
			'tanggal_awal'		 => @$tanggal_awal,
			'tanggal_akhir'		 => @$tanggal_akhir,

		);

		$this->load->view('layout/wrapper', $data);
	}

	public function listreservasi(){
		echo json_encode($this->reservasi->list_reservasi());
	}

	public function detail($id)
	{
		$id	= base64_decode($this->security->xss_clean($id));
		$result = $this->transaksi->detail($id);

		$data	= array(
			'title'		 => 'Data Pengguna',
			'content'	 => 'transaksi/detail',
			'extra'		 => 'transaksi/js/js_list',
			'extracss'	 => 'transaksi/css/css_index',
			'h_tc'		 => 'collapse',
			'list'		 => $result,

		);

		$this->load->view('layout/wrapper', $data);
	}

	public function detailBarang()
	{
		$id    = $_GET["id"];
		$barang = $this->transaksi->detailBarang($id);
		echo json_encode($barang);
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

	public function getreservasi()
	{
		$id = $this->security->xss_clean($this->input->get('id'));
		$master = $this->reservasi->getDataMaster($id);
		$barang = $this->reservasi->getDataBarang($id);

		if ($master) {
			$result = array(
				"master" => $master,
				"barang" => $barang,
			);
		} else {
			$result = array(
				"code" => "404",
				"messages" => "Data tidak ditemukan"
			);
		}


		echo json_encode($result);
	}

	public function simpandata()
	{
		$data = json_decode($this->security->xss_clean($this->input->post('data')));
		$guide = json_decode($this->security->xss_clean($this->input->post('guide')));
		$pengayah = json_decode($this->security->xss_clean($this->input->post('pengayah')));
		$diskon = str_replace(",","",$this->security->xss_clean($this->input->post('diskon')));
		$payment = $this->security->xss_clean($this->input->post('payment'));
		$reservasi = $this->security->xss_clean($this->input->post('reservasi'));

		if (empty($diskon)) {
			$diskon = 0;
		}

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
			if (!empty($reservasi)) {
				$update_reservasi = $this->reservasi->update_proses($reservasi);
				if (@$update_reservasi["code"] == 0) {
					echo '0';
				}
			}
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
