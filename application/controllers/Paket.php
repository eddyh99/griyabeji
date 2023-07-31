<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_paket', "paket");
		$this->load->model('admin/mdl_produk', "produk");
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . ' - Data Paket',
			'content'	 => 'paket/index',
			'extra'		 => 'paket/js/js_index',
			'colmas'	 => 'hover show',
			'side6'		 => 'active',
			'breadcrumb' => 'Master / Paket'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->paket->listpaket();
		$i = 0;
		foreach ($result as $dt) {
			$result[$i]["namaproduk"] = array();
			$items = $this->paket->itempaket($dt["id"]);
			foreach ($items as $itm) {
				array_push($result[$i]["namaproduk"], $itm["namaproduk"]);
			}
			$i++;
		}

		echo json_encode($result);
	}

	public function ListDataPaket()
	{
		$result = $this->paket->Listpaket();
		echo json_encode($result);
	}

	public function listByReservasi()
	{
		$id = $this->security->xss_clean($this->input->get('reservasi'));
		$result = $this->paket->ListPaketByReservasi($id);

		echo json_encode($result);
	}

	public function tambah()
	{

		$items = $this->produk->listproduk();

		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Paket',
			'content'	 => 'paket/tambah',
			'colmas'	 => 'hover show',
			'extra'	     => 'paket/js/js_tambah',
			'extracss'	 => 'paket/css/css_tambah',
			'side6'		 => 'active',
			'breadcrumb' => 'Master / Paket / Tambah Data',
			'produks'	 => $items,
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$local = $this->input->post("local");
		$new_local = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $local);
		$_POST["local"] = $new_local;
		$domestik = $this->input->post("domestik");
		$new_domestik = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $domestik);
		$_POST["domestik"] = $new_domestik;
		$internasional = $this->input->post("internasional");
		$new_internasional = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $internasional);
		$_POST["internasional"] = $new_internasional;
		$kiguide = $this->input->post("kiguide");
		$new_kiguide = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kiguide);
		$_POST["kiguide"] = $new_kiguide;
		$kdpangayahan = $this->input->post("kdpangayahan");
		$new_kdpangayahan = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kdpangayahan);
		$_POST["kdpangayahan"] = $new_kdpangayahan;
		$kipengayahan = $this->input->post("kipengayahan");
		$new_kipengayahan = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kipengayahan);
		$_POST["kipengayahan"] = $new_kipengayahan;

		$this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_produk[]', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('kiguide', 'Komisi Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');
		$this->form_validation->set_rules('komisi', 'Komisi x2', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "paket/tambah");
			return;
		}

		$namapaket	    = $this->security->xss_clean($this->input->post('namapaket'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_produk	    = $this->security->xss_clean($this->input->post('id_produk'));
		$kiguide		= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));
		$komisi	= $this->security->xss_clean($this->input->post('komisi'));

		if (empty($komisi)) {
			$komisi = 'no';
		}

		$data		= array(
			"namapaket"    => $namapaket,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$harga		= array(
			"tanggal"		=> date("Y-m-d H:i:s"),
			"is_double"		=> $komisi,
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"komisi_guide_domestik" => $kiguide,
			"komisi_guide_internasional" => $kiguide,
			"komisi_pengayah_domestik" => $kdpangayahan,
			"komisi_pengayah_internasional" => $kipengayahan,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->paket->insertData($data, $harga, $id_produk);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->success_msg());
			redirect(base_url() . "paket");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "paket/tambah");
			return;
		}
	}

	public function ubah($id)
	{

		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);
		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->paket->getPaket($id);
		$items=$this->paket->itempaket($id);

		$result["id_items"] = array();
		foreach ($items as $itm) {
			array_push($result["id_items"], $itm["id_produk"]);
		}

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Paket',
			'content'    => 'paket/ubah',
			'colmas'	 => 'hover show',
			'detail'     => $result,
			'items'		 => $this->produk->listproduk(),
			'extra'	     => 'paket/js/js_tambah',
			'extracss'	 => 'paket/css/css_tambah',
			'side6'		 => 'active',
			'breadcrumb' => '/ Setup / Paket / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$local = $this->input->post("local");
		$new_local = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $local);
		$_POST["local"] = $new_local;
		$domestik = $this->input->post("domestik");
		$new_domestik = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $domestik);
		$_POST["domestik"] = $new_domestik;
		$internasional = $this->input->post("internasional");
		$new_internasional = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $internasional);
		$_POST["internasional"] = $new_internasional;
		$kiguide = $this->input->post("kiguide");
		$new_kiguide = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kiguide);
		$_POST["kiguide"] = $new_kiguide;
		$kdpangayahan = $this->input->post("kdpangayahan");
		$new_kdpangayahan = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kdpangayahan);
		$_POST["kdpangayahan"] = $new_kdpangayahan;
		$kipengayahan = $this->input->post("kipengayahan");
		$new_kipengayahan = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $kipengayahan);
		$_POST["kipengayahan"] = $new_kipengayahan;

		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('kiguide', 'Komisi Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');
		$this->form_validation->set_rules('komisi', 'Komisi x2', 'trim');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "paket/ubah/" . base64_encode($id));
			return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_items	    = $this->security->xss_clean($this->input->post('id_items'));
		$id	    		= $this->security->xss_clean($this->input->post('id'));
		$kiguide		= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));
		$komisi	= $this->security->xss_clean($this->input->post('komisi'));

		if (empty($komisi)) {
			$komisi = 'no';
		}

		$data		= array(
			"namapaket"    	=> $namaproduk,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$harga		= array(
			"id_paket"		=> $id,
			"tanggal"		=> date("Y-m-d H:i:s"),
			"is_double"		=> $komisi,
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"komisi_guide_domestik" => $kiguide,
			"komisi_guide_internasional" => $kiguide,
			"komisi_pengayah_domestik" => $kdpangayahan,
			"komisi_pengayah_internasional" => $kipengayahan,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);


		$result		= $this->paket->updateData($data, $harga, $id_items, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success',  $this->message->success_msg());
			redirect(base_url() . "paket");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "paket/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->paket->hapusData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->delete_msg());
			redirect(base_url() . "paket");
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "paket");
		}
	}

	// ===== START HARGA PRODUK =====

	public function hargapaket()
	{
		$data	= array(
			'title'		 => NAMETITLE . ' - Harga Paket',
			'content'	 => 'hargapaket/index',
			'extra'		 => 'hargapaket/js/js_index',
			'side10'	 => 'active',
			'breadcrumb' => 'Harga Paket'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData()
	{
		$result	= $this->paket->promopaket();
		echo json_encode($result);
	}

	public function tambahharga()
	{
		$pakets = $this->paket->listpaket();

		$data	= array(
			'title'		 => NAMETITLE . ' - Harga Paket',
			'content'	 => 'hargapaket/tambah',
			'extra'		 => 'hargapaket/js/js_tambah',
			'mn_setting' => 'active',
			'side10'	 => 'active',
			'pakets'	 => $pakets,
			'breadcrumb' => 'Harga Paket / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddHargaData()
	{
		$local = $this->input->post("local");
		$new_local = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $local);
		$_POST["local"] = $new_local;
		$domestik = $this->input->post("domestik");
		$new_domestik = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $domestik);
		$_POST["domestik"] = $new_domestik;
		$internasional = $this->input->post("internasional");
		$new_internasional = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $internasional);
		$_POST["internasional"] = $new_internasional;

		$this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "paket/tambahharga");
			return;
		}

		$namapaket	    = $this->security->xss_clean($this->input->post('namapaket'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-", $this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");



		$data		= array(
			"id_paket"     	=> $namapaket,
			"lokal"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"awal" 			=> $tanggal_awal,
			"akhir" 		=> $tanggal_akhir,
			"userid" 		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->paket->insertpromo($data);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "paket/hargapaket");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "paket/tambahharga");
			return;
		}
	}

	// ===== END HARGA PRODUK =====

}
