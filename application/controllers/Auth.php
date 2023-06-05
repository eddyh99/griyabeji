<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mdl_auth", "auth");
	}

	public function index()
	{
		if (isset($this->session->userdata['logged_status'])) {
			if ($this->session->userdata['logged_status']['role'] == 'pengayah') {
				redirect('reservasi');
			}
			redirect("dashboard");
		}

		$data = array(
			'title'     => NAMETITLE . ' - Login',
			'is_login'  => false,
			'content'   => 'login/index',
			'extra'		=> 'login/js/js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function auth_login()
	{
		$this->form_validation->set_rules('uname', 'Username', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("/");
			return;
		}

		$uname = $this->security->xss_clean($this->input->post('uname'));
		$pass = $this->security->xss_clean($this->input->post('pass'));

		$result = $this->auth->VerifyLogin($uname, $pass);
		if (!empty($result)) {
			$session_data = array(
				'username'  => $uname,
				'nama'      => $result->nama,
				'role'      => $result->role,
				'is_login'  => true
			);
			$this->session->set_userdata('logged_status', $session_data);
			if ($result->role == 'pengayah') {
				redirect('reservasi');
			}
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', "username atau password salah, mohon periksa ulang");
			redirect("/");
			return;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
