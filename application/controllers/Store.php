<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_store', 'store');
	}

	public function index()
	{

		$data	= array(
			'title'		 => NAMETITLE . '- Data Store',
			'content'	 => 'store/index',
			'extra'		 => 'store/js/js_index',
			'colmas'	 => 'hover show',
			'side7'		 => 'active',
			'breadcrumb' => 'Master / Store'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{
		$result = $this->store->liststore();
		// $result = array (
		// 	array(
		//         "id"            => "1",
		// 		"namastore"		=> "Waterfall Store",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"namastore"		=> "Pool Store",
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambah()
	{

		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data Store',
			'content'	 => 'store/tambah',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => 'Master / Store / Tambah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{
		$this->form_validation->set_rules('namastore', 'Nama Store', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "store/tambah");
			return;
		}

		$namastore	    = $this->security->xss_clean($this->input->post('namastore'));


		$data		= array(
			"storename"      => $namastore
		);

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->store->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "store");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "store/tambah");
			return;
		}
	}

	public function ubah($id)
	{
		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		$id			= base64_decode($this->security->xss_clean($id));
		$result		= $this->store->getStore($id);
		// $result = array (
		// 	"namastore"		    => "Waterfall Beji",
		// );

		$data		= array(
			'title'		 => NAMETITLE . ' - Ubah Data Store',
			'content'    => 'store/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'hover show',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side7'		 => 'active',
			'breadcrumb' => 'Master / Store / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('namastore', 'Nama Store', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "store/ubah/" . base64_encode($id));
			return;
		}

		$namastore	    = $this->security->xss_clean($this->input->post('namastore'));
		$id	    		= $this->security->xss_clean($this->input->post('id'));


		$data	= array(
			"storename"      => $namastore
		);

		// print_r(json_encode($data));
		// die;


		$result		= $this->store->updateData($data, $id);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		//$result["code"]=5011;
		//$result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message',  $this->message->success_msg());
			redirect(base_url() . "store");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "store/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 'yes',
		);

		$id	= base64_decode($this->security->xss_clean($id));
		$result		= $this->store->hapusData($data, $id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->delete_msg());
			redirect(base_url() . "store");
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "store");
		}
	}
}
