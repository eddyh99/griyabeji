<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_pengunjung', "pengunjung");
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . ' - Data Pengunjung',
			'content'	 => 'pengunjung/index',
			'extra'		 => 'pengunjung/js/js_index',
			'colmas'	 => 'hover show',
			'side15'	 => 'active',
			'breadcrumb' => 'Master / Pengunjung'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->pengunjung->Listpengunjung();
		echo json_encode($result);
	}

	public function Listpengunjung()
	{
		$term=$_GET["search"];
		$result = $this->pengunjung->Listpengunjung($term);
		echo json_encode($result);
	}
	public function tambah()
	{

		$countries = $this->pengunjung->getCountry();

		$data = array(
			'title'		 		=> NAMETITLE . ' - Tambah Data Pengunjung',
			'content'	 		=> 'pengunjung/tambah',
			'extra'	 			=> 'pengunjung/js/js_tambah',
			'side15'		 	=> 'active',
			'colmas'	 => 'hover show',
			'breadcrumb' 		=> 'Master / Pengunjung / Tambah Data',
			'countries'			=> $countries,
			// 'states'			=> $states
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function getstate()
	{
		$country    = $_GET["country"];
		$states =  $this->pengunjung->getstate($country);
		echo json_encode($states);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('countryname', 'Country', 'trim|required');
		$this->form_validation->set_rules('statename', 'State', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengunjung/tambah");
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
			"state_id"  	=> empty($statename)?null:$statename,
			"country_code"	=> $countryname,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->pengunjung->insertData($data);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->success_msg());
			redirect(base_url() . "pengunjung");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengunjung/tambah");
			return;
		}
	}

	public function simpanajax()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('countryname', 'Country', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode(validation_errors());
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
			"state_id"  	=> empty($statename)?null:$statename,
			"country_code"	=> $countryname,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->pengunjung->insertData($data);

		if ($result["code"] == 0) {
			$pengunjung = $this->pengunjung->listpengunjung();
			echo json_encode($pengunjung);
		} else {
			echo json_encode("Data tidak bisa disimpan, silahkan tunggu beberapa saat");
		}
	}
	
	public function ubah($id)
	{

		$id	= base64_decode($this->security->xss_clean($id));
		
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$result		= $this->pengunjung->getPengunjung($id);


		$countries = $this->pengunjung->getCountry();
		$states =  $this->pengunjung->getstate($result["code"]);


		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Pengunjung',
			'content'    => 'pengunjung/ubah',
			'extra'		 => 'pengunjung/js/js_tambah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side15'	 => 'active',
			'breadcrumb' => 'Master / Pengunjung / Ubah Data',
			'countries'	 => $countries,
			'states'	 => $states
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('whatsapp', 'Whatsapp', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('countryname', 'Country', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "pengunjung/ubah/" . base64_encode($id));
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
			"state_id"  	=> empty($statename)?null:$statename,
			"country_code"	=> $countryname,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		$result		= $this->pengunjung->updateData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success',  $this->message->success_msg());
			redirect(base_url() . "pengunjung");
			return;
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengunjung/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->pengunjung->hapusData($data, $id);

		if ($result["code"] == 0) {
			$this->session->set_flashdata('success', $this->message->delete_msg());
			redirect(base_url() . "pengunjung");
		} else {
			$this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect(base_url() . "pengunjung");
		}
	}
}
