<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/Mdl_pengguna', "pengguna");
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . '- Data Pengguna',
			'content'	 => 'pengguna/index',
			'extra'		 => 'pengguna/js/js_index',
			'colmas'	 => 'hover show',
			'side1'		 => 'active',
			'breadcrumb' => 'Master / Pengguna'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->pengguna->listpengguna();
		// $result = array (
		// 	array(
		// 		"username"		=> "owner123",
		// 		"nama"			=> "Nama Owner",
		// 		"role"			=> "owner"
		// 	),
		// 	array(
		// 		"username"		=> "general_manager123",
		// 		"nama"			=> "Nama GM",
		// 		"role"			=> "GM"
		// 	),
		// 	array(
		// 		"username"		=> "executive_am123",
		// 		"nama"			=> "Nama EAM",
		// 		"role"			=> "EAM"
		// 	),
		// 	array(
		// 		"username"		=> "kasir123",
		// 		"nama"			=> "Nama Kasir",
		// 		"role"			=> "kasir"
		// 	),
		// 	array(
		// 		"username"		=> "admin123",
		// 		"nama"			=> "Nama Admin",
		// 		"role"			=> "admin"
		// 	),
		// 	array(
		// 		"username"		=> "penhayah123",
		// 		"nama"			=> "Nama Pengayah",
		// 		"role"			=> "pengayah"
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambah()
	{

		$data = array(
			'title'		 => 'Tambah Data Pengguna',
			'content'	 => 'pengguna/tambah',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side1'		 => 'active',
			'breadcrumb' => 'Master / Pengguna / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengguna/tambah");
			return;
		}

		$username	= $this->security->xss_clean($this->input->post('username'));
		$password	= $this->security->xss_clean($this->input->post('password'));
		$nama		= $this->security->xss_clean($this->input->post('nama'));
		$role		= $this->security->xss_clean($this->input->post('role'));
		$passcode	= $this->security->xss_clean($this->input->post('passcode'));

		$data		= array(
			"username"  => $username,
			"passwd"    => sha1($password),
			"nama"      => $nama,
			"passcode"  => $passcode,
			"role"      => $role,
		);

		$datapengayah = NULL;
		if ($role == 'pengayah') {
			$datapengayah		= array(
				"nama"      => $nama,
				"whatsapp"  => '0',
				"username"  => $username,
				"userid"	=> $_SESSION["logged_status"]["username"]
			);
		}

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->pengguna->insertData($data, $datapengayah);
		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->success_msg());
			redirect(base_url() . "pengguna");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengguna/tambah");
			return;
		}
	}

	public function ubah($username)
	{

		$username	= base64_decode($this->security->xss_clean($username));

		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$result		= $this->pengguna->getUser($username);

		// $result = array (
		// 	"username"		=> "admin",
		// 	"nama"			=> "admin",
		// 	"role"			=> "Owner"
		// );

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Pengguna',
			'content'    => 'pengguna/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			// 'side1'		 => 'active',
			'breadcrumb' => 'Master / Pengguna / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		$username	= $this->security->xss_clean($this->input->post('username'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengguna/ubah/" . base64_encode($username));
			return;
		}

		$password	= $this->security->xss_clean($this->input->post('password'));
		$nama		= $this->security->xss_clean($this->input->post('nama'));
		$role		= $this->security->xss_clean($this->input->post('role'));
		$passcode	= $this->security->xss_clean($this->input->post('passcode'));

		if (empty($password)) {
			$data	= array(
				"username"  => $username,
				"nama"      => $nama,
				"role"      => $role,
				"passcode"	=> $passcode
			);
		} else {
			$data	= array(
				"username"  => $username,
				"passwd"    => sha1($password),
				"nama"      => $nama,
				"role"      => $role,
				"passcode"	=> $passcode
			);
		}

		$result		= $this->pengguna->updateData($data, $username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message',  $this->message->success_msg());
			redirect(base_url() . "pengguna");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengguna/ubah/" . base64_encode($username));
			return;
		}
	}

	public function DelData($username)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$username	= base64_decode($this->security->xss_clean($username));
		$result		= $this->pengguna->hapusData($data, $username);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->delete_msg());
			redirect(base_url() . "pengguna");
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengguna");
		}
	}
}
