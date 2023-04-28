<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opname extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    $this->load->model("staff/opnameModel");
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }

	public function index(){
        $data = array(
            'title'		=> 'Hanaka - Point Of Sales',
            'content'	=> 'staff/opname/index',
            'extra'	    => 'staff/opname/js/js_index',
			'mn_cash'    => 'active',
			'collap'	 => 'collapse',
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata(){
		$result		= $this->opnameModel->listOpname();
		echo json_encode($result);
	}
}
