<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_items', "items");
	}

	// ===== START ITEMS =====

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . '- Data Items',
			'content'	 => 'items/index',
			'extra'		 => 'items/js/js_index',
			'colmas'	 => 'hover show',
			'side4'		 => 'active',
			'breadcrumb' => 'Master / Items'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->items->listitems();
		// $result = array (
		// 	array(
		//         "id"            => "1",
		// 		"namaitem"		=> "Dupa Wangi",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"namaitem"		=> "Gelang Tridatu",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "3",
		// 		"namaitem"		=> "Canang Sari",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "4",
		// 		"namaitem"		=> "Toples Tirta",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "5",
		// 		"namaitem"		=> "Dupa Cempaka",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambah()
	{

		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Items',
			'content'	 => 'items/tambah',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => 'Master / Items / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('hpp', 'HPP', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('kdguide', 'Komisi Domestik Guide', 'trim|required');
		$this->form_validation->set_rules('kiguide', 'Komisi Internasional Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "items/tambah");
			return;
		}

		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$hpp	    	= $this->security->xss_clean($this->input->post('hpp'));
		$kdguide	= $this->security->xss_clean($this->input->post('kdguide'));
		$kiguide	= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));


		$data		= array(
			"namaitem"     	=> $namaitems,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$harga		= array(
			"hpp"			=> $hpp,
			"tanggal"		=> date("Y-m-d H:i:s"),
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"komisi_guide_domestik" => $kdguide,
			"komisi_guide_internasional" => $kiguide,
			"komisi_pengayah_domestik" => $kdpangayahan,
			"komisi_pengayah_internasional" => $kipengayahan,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->items->insertData($data, $harga);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "items");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items/tambah");
			return;
		}
	}

	public function ubah($id)
	{
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->items->getItems($id);

		// $result = array (
		// 	"namaitems"	    => "Dupa Wangi",
		// 	"local"			=> "1000000",
		// 	"domestik"		=> "2000000",
		// 	"internasional"	=> "3000000",
		// );

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Items',
			'content'    => 'items/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => 'Master / Items / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('hpp', 'HPP', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('kdguide', 'Komisi Domestik Guide', 'trim|required');
		$this->form_validation->set_rules('kiguide', 'Komisi Internasional Guide', 'trim|required');
		$this->form_validation->set_rules('kdpangayahan', 'Komisi Domestik Pangayahan', 'trim|required');
		$this->form_validation->set_rules('kipengayahan', 'Komisi Internasional Pengayahan', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "items/ubah/" . base64_encode($id));
			return;
		}

		$namaitems	= $this->security->xss_clean($this->input->post('namaitems'));
		$lokal	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$hpp	    	= $this->security->xss_clean($this->input->post('hpp'));
		$kdguide	= $this->security->xss_clean($this->input->post('kdguide'));
		$kiguide	= $this->security->xss_clean($this->input->post('kiguide'));
		$kdpangayahan	= $this->security->xss_clean($this->input->post('kdpangayahan'));
		$kipengayahan	= $this->security->xss_clean($this->input->post('kipengayahan'));
		$id	    		= $this->security->xss_clean($this->input->post('id'));


		$data		= array(
			"namaitem"     	=> $namaitems,
			"userid"		=> $_SESSION["logged_status"]["username"],
			"update_at"		=> date("Y-m-d H:i:s")
		);

		$harga		= array(
			"id_items"		=> $id,
			"tanggal"		=> date("Y-m-d H:i:s"),
			"hpp"			=> $hpp,
			"lokal"			=> $lokal,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"komisi_guide_domestik" => $kdguide,
			"komisi_guide_internasional" => $kiguide,
			"komisi_pengayah_domestik" => $kdpangayahan,
			"komisi_pengayah_internasional" => $kipengayahan,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);


		// print_r(json_encode($data));
		// die;

		$result		= $this->items->updateData($data, $harga, $id);

		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message',  $this->message->success_msg());
			redirect(base_url() . "items");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->items->hapusData($data, $id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->delete_msg());
			redirect(base_url() . "items");
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items");
		}
	}

	// ===== END ITEMS =====

	// ===== START HARGA ITEMS =====

	public function hargaitems()
	{
		$data	= array(
			'title'		 => NAMETITLE . ' - Harga Items',
			'content'	 => 'hargaitems/index',
			'extra'		 => 'hargaitems/js/js_index',
			'side8'		 => 'active',
			'breadcrumb' => 'Harga Items'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function ListHargaItemsData()
	{
		$result	= $this->items->promoitems();
		// $result = array (
		// 	array(
		//         "id"            => "1",
		// 		"namaitem"		=> "Dupa Wangi",
		// 		"awal"			=> "11 January 2023",
		// 		"akhir"			=> "12 January 2023",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"namaitem"		=> "Gelang Tridatu",
		// 		"awal"			=> "11 January 2023",
		// 		"akhir"			=> "12 January 2023",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// 	array(
		//         "id"            => "3",
		// 		"namaitem"		=> "Canang Sari",
		// 		"awal"			=> "11 January 2023",
		// 		"akhir"			=> "12 January 2023",
		// 		"local"			=> "1000000",
		// 		"domestik"		=> "2000000",
		// 		"internasional"	=> "3000000",
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambahharga()
	{
		$items = $this->items->listitems();
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
			'title'		 => NAMETITLE . ' - Harga Items',
			'content'	 => 'hargaitems/tambah',
			'extra'		 => 'hargaitems/js/js_tambah',
			'mn_setting' => 'active',
			'side8'		 => 'active',
			'items'		 => $items,
			'breadcrumb' => 'Harga Items / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddHargaData()
	{
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "items/tambahharga");
			return;
		}

		$namaitems	    = $this->security->xss_clean($this->input->post('namaitems'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));
		$tanggal		= explode("-", $this->security->xss_clean($this->input->post('tanggal')));

		$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
		$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");



		$data		= array(
			"id_items"     	=> $namaitems,
			"lokal"			=> $local,
			"domestik"		=> $domestik,
			"internasional" => $internasional,
			"awal" 			=> $tanggal_awal,
			"akhir" 		=> $tanggal_akhir,
			"userid" 		=> $_SESSION["logged_status"]["username"]
		);

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->items->insertPromo($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "items/hargaitems");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items/tambahharga");
			return;
		}
	}

	// ===== END HARGA ITEMS =====

}
