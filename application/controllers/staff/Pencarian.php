<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	public function __construct() {
	    parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }

	public function index(){
        $data = array(
            'title'		=> 'Pencarian',
            'content'	=> 'staff/cashier/cari',
			'extra'		=> 'staff/cashier/js/js_cash',
			'collap'	 => 'collapse',
			'mn_cari'	 => 'active',
			'breadcrumb' => '/ Pencarian'
		);
		$this->load->view('layout/wrapper', $data);
	}

}
