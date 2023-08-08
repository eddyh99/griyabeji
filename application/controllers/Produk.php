<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_produk', 'produk');
		$this->load->model('admin/mdl_items', 'items');
	}

	// ===== START PRODUK =====

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . ' - Data Experience',
			'content'	 => 'produk/index',
			'extra'		 => 'produk/js/js_index',
			'colmas'	 => 'hover show',
			'side5'		 => 'active',
			'breadcrumb' => 'Master / Experience'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->produk->listproduk();
		$produk = $result;
		$i = 0;
		foreach ($result as $dt) {
			$produk[$i]["namaitems"] = array();
			$items = $this->produk->itemproduk($dt["id"]);
			foreach ($items as $itm) {
				array_push($produk[$i]["namaitems"], $itm["namaitem"]);
			}
			$i++;
		}
		
		echo json_encode($produk);
	}

	public function ListDataProduk()
	{
		$result = $this->produk->listproduk();
		echo json_encode($result);
	}

	public function listByReservasi()
	{
		$id = $this->security->xss_clean($this->input->get('reservasi'));
		$result = $this->produk->ListProdukByReservasi($id);

		echo json_encode($result);
	}

	public function tambah()
	{
		$items = $this->items->listitems();
		
		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Experience',
			'colmas'	 => 'hover show',
			'content'	 => 'produk/tambah',
			'extra'	     => 'produk/js/js_tambah',
			'extracss'	 => 'produk/css/css_tambah',
			'side5'		 => 'active',
			'breadcrumb' => 'Master / Experience / Tambah Data',
			'items'		 => $items,
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

		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim');
		$this->form_validation->set_rules('kiguide', 'Komisi Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');
		$this->form_validation->set_rules('komisi', 'Komisi x2', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "produk/tambah");
			return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$items	    	= $this->security->xss_clean($this->input->post('id_items'));
		$kiguide	= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));
		$komisi	= $this->security->xss_clean($this->input->post('komisi'));

		if (empty($komisi)) {
			$komisi = 'no';
		}

		$data		= array(
			"namaproduk"    => $namaproduk,
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

		$result		= $this->produk->insertData($data, $harga, $items);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->success_msg());
			redirect(base_url() . "produk");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "produk/tambah");
			return;
		}
	}

	public function ubah($id)
	{

		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->produk->getProduk($id);
		$items		= $this->produk->itemproduk($id);


		// $produk		= $result;
		$result["id_items"] = array();
		foreach ($items as $itm) {
			array_push($result["id_items"], $itm["id_items"]);
		}

		$items = $this->items->listitems();

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Experience',
			'content'    => 'produk/ubah',
			'detail'     => $result,
			'items'		 => $items,
			'colmas'	 => 'hover show',
			'extra'	     => 'produk/js/js_tambah',
			'extracss'	 => 'produk/css/css_tambah',
			'side5'		 => 'active',
			'breadcrumb' => 'Master / Experience / Ubah Data'
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
		$this->form_validation->set_rules('id_items[]', 'Nama Items', 'trim');
		$this->form_validation->set_rules('kiguide', 'Komisi Internasional Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');
		$this->form_validation->set_rules('komisi', 'Komisi x2', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "produk/ubah/" . base64_encode($id));
			return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$id_items	    = $this->security->xss_clean($this->input->post('id_items'));
		$kiguide	= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));
		$id			    = $this->security->xss_clean($this->input->post('id'));
		$komisi	= $this->security->xss_clean($this->input->post('komisi'));

		if (empty($komisi)) {
			$komisi = 'no';
		}

		$data		= array(
			"namaproduk"    => $namaproduk,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$harga		= array(
			"id_produk"		=> $id,
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


		$result		= $this->produk->updateData($data, $harga, $id_items, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success',  $this->message->success_msg());
			redirect(base_url() . "produk");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "produk/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->produk->hapusData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->delete_msg());
			redirect(base_url() . "produk");
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "produk");
		}
	}

	// ===== END PRODUK =====


	// ===== START HARGA PRODUK =====

	public function hargaproduk()
	{
		$data	= array(
			'title'		 => NAMETITLE . ' - Harga Produk',
			'content'	 => 'hargaproduk/index',
			'extra'		 => 'hargaproduk/js/js_index',
			'side9'		 => 'active',
			'breadcrumb' => 'Harga Produk'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData()
	{
		$result	= $this->produk->promoproduk();
		echo json_encode($result);
	}

	public function tambahharga()
	{
		$produks	= $this->produk->listproduk();

		$data	= array(
			'title'		 => NAMETITLE . ' - Harga Produk',
			'content'	 => 'hargaproduk/tambah',
			'extra'		 => 'hargaproduk/js/js_tambah',
			'mn_setting' => 'active',
			'side9'		 => 'active',
			'produks'	 => $produks,
			'breadcrumb' => 'Harga Produk / Tambah'
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

		$this->form_validation->set_rules('namaproduk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "produk/tambahharga");
			return;
		}

		$namaproduk	    = $this->security->xss_clean($this->input->post('namaproduk'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-", $this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");



		$data		= array(
			"id_produk"     => $namaproduk,
			"lokal"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"awal" 			=> $tanggal_awal,
			"akhir" 		=> $tanggal_akhir,
			"userid" 		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->produk->insertPromo($data);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "produk/hargaproduk");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "produk/tambahharga");
			return;
		}
	}

	// ===== END HARGA PRODUK =====

}
