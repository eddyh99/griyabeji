<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengayah extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_pengayah', "pengayah");
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . ' - Data Pengguna',
			'content'	 => 'pengayah/index',
			'extra'		 => 'pengayah/js/js_index',
			'colmas'	 => 'hover show',
			'side3'		 => 'active',
			'breadcrumb' => 'Master / Pengayah'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->pengayah->Listpengayah();
		echo json_encode($result);
	}

	public function tambah()
	{

		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Pengayah',
			'content'	 => 'pengayah/tambah',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => 'Master / Pengayah / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe Pengayah', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengayah/tambah");
			return;
		}

		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));
		$username	= $this->security->xss_clean($this->input->post('username'));
		$password	= $this->security->xss_clean($this->input->post('password'));
		$tipe		= $this->security->xss_clean($this->input->post('tipe'));


		$data		= array(
			"nama"      => $nama,
			"whatsapp"  => $whatsapp,
			"tipe"  	=> $tipe,
			"userid"	=> $_SESSION["logged_status"]["username"]
		);

		$datapengguna		= array(
			"username"  => $username,
			"passwd"    => sha1($password),
			"nama"      => $nama,
			"role"      => 'pengayah',
			"passcode"  => '',
			"status"  => 'no',
		);

		$result		= $this->pengayah->insertData($data, $datapengguna);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->success_msg());
			redirect(base_url() . "pengayah");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengayah/tambah");
			return;
		}
	}

	public function ubah($id)
	{

		$id	= base64_decode($this->security->xss_clean($id));
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$result		= $this->pengayah->getUser($id);

		$data		= array(
			'title'		 => 'Ubah Data Pengguna',
			'content'    => 'pengayah/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side3'		 => 'active',
			'breadcrumb' => 'Master / Pengayah / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe Pengayah', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengayah/ubah/" . base64_encode($id));
			return;
		}

		$nama	    = $this->security->xss_clean($this->input->post('nama'));
		$tipe	    = $this->security->xss_clean($this->input->post('tipe'));
		$whatsapp	= $this->security->xss_clean($this->input->post('whatsapp'));
		$id			= $this->security->xss_clean($this->input->post('id'));


		$data	= array(
			"nama"      => $nama,
			"whatsapp"  => $whatsapp,
			"tipe"      => $tipe,
		);

		$result		= $this->pengayah->updateData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success',  $this->message->success_msg());
			redirect(base_url() . "pengayah");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengayah/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->pengayah->hapusData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->delete_msg());
			redirect(base_url() . "pengayah");
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengayah");
		}
	}
}
