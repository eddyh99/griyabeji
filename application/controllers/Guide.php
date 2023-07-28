<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guide extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_guide', 'guide');
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . ' - Data Pengguna',
			'content'	 => 'guide/index',
			'extra'		 => 'guide/js/js_index',
			'colmas'	 => 'hover show',
			'side2'		 => 'active',
			'breadcrumb' => 'Master / Guide'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->guide->listguide();
		// $result = array (
		// 	array(
		//         "id"            => "1",
		// 		"nama"		    => "I Gusti Made Bagus Adi Wicaksono Wijaya",
		// 		"whatsapp"		=> "11111111",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"nama"		    => "Guide 2",
		// 		"whatsapp"		=> "22222222",
		// 	),
		// 	array(
		//         "id"            => "3",
		// 		"nama"		    => "Guide 3",
		// 		"whatsapp"		=> "333333333",
		// 	),
		// 	array(
		//         "id"            => "4",
		// 		"nama"		    => "Guide 4",
		// 		"whatsapp"		=> "44444444",
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambah()
	{

		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Guide',
			'content'	 => 'guide/tambah',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side2'		 => 'active',
			'breadcrumb' => 'Master / Guide / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('idpartner', 'ID Partner', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "guide/tambah");
			return;
		}

		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));
		$idpartner	= $this->security->xss_clean($this->input->post('idpartner'));
		$noktp		= $this->security->xss_clean($this->input->post('noktp'));


		$data		= array(
			"idpartner" => $idpartner,
			"nama"      => $nama,
			"whatsapp"  => $whatsapp,
			"noktp"  	=> $noktp,
			"userid"	=> $_SESSION["logged_status"]["username"]
		);

		// Checking Success and Error AddData
		$result		= $this->guide->insertData($data);
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "guide");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "guide/tambah");
			return;
		}
	}

	public function ubah($id)
	{

		// Menampilkan Hasil Single Data ketika di click id tertentu sebagai parameter
		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->guide->getUser($id);

		// $result = array (
		// 	"nama"		    => "Guide1",
		// 	"whatsapp"	    => "085123123123",
		// );

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Pengguna',
			'content'    => 'guide/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side2'		 => 'active',
			'breadcrumb' => 'Master / Guide / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('idpartner', 'ID Partner', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "guide/ubah/" . base64_encode($id));
			return;
		}

		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$idpartner	= $this->security->xss_clean($this->input->post('idpartner'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));
		$noktp		= $this->security->xss_clean($this->input->post('noktp'));
		$id			= $this->security->xss_clean($this->input->post('id'));


		$data	= array(
			"nama"      => $nama,
			"whatsapp"  => $whatsapp,
			"noktp"  	=> $noktp,
			"idpartner" => $idpartner,
		);

		// print_r(json_encode($data));
		// die;


		$result		= $this->guide->updateData($data, $id);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message',  $this->message->success_msg());
			redirect(base_url() . "guide");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "guide/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->guide->hapusData($data, $id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->delete_msg());
			redirect(base_url() . "guide");
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "guide");
		}
	}
}
