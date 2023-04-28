<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model("auth/AuthModel");
	   $this->load->model("admin/assignModel");
    }

	public function index() {
        $data = array(
            'title'     => 'Login',
            'is_login'  => false,
            'content'   => 'login/index',
			'extra'		=> 'login/js/js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function auth_login(){
        $this->form_validation->set_rules('uname', 'Username', 'trim|required');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
		    redirect("/");
            return;
		}

		$uname = $this->security->xss_clean($this->input->post('uname'));
        $pass = $this->security->xss_clean($this->input->post('pass'));

		/*modified login*/
		$result="sukses";
		// print_r($result);
		// die;
		//$result=$this->AuthModel->VerifyLogin($uname,$pass);
		if ($result!="failed"){
			$session_data = array(
				'username'  => $uname,
				'nama'      => "Owner",
				'role'      => "Owner",
				'is_login'  => true
			);
			$this->session->set_userdata('logged_status', $session_data);
			if ($_SESSION["logged_status"]["role"]=="Staff"){
				// $store=$this->assignModel->getStoreID($uname);
				$store=TRUE;
				if (!isset($store)){
				    $this->session->unset_userdata('logged_status');
        		    $this->session->set_flashdata('error', "Staff belum di assign ke toko");
        		    redirect("/");
				    return;
				}
				$_SESSION["logged_status"]["storeid"]=1;
        		$_SESSION["logged_status"]["store"]="Beach Walk";
				redirect (base_url()."staff/dashboard");
			}else{
    			if ($_SESSION["logged_status"]["role"]!="Owner"){
    		        // $store=$this->assignModel->getStoreID($uname);
					$store=TRUE;
    				if (!isset($store)){
    				    $this->session->unset_userdata('logged_status');
            		    $this->session->set_flashdata('error', "Staff belum di assign ke toko");
            		    redirect("/");
    				    return;   
    				}
    				$_SESSION["logged_status"]["storeid"]=1;
    				$_SESSION["logged_status"]["store"]="Beach Walk";
    			}
    			redirect (base_url()."dashboard");
			}
		}else{
		    $this->session->set_flashdata('error', "username atau password salah, mohon periksa ulang");
		    redirect("/");
            return;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
}
