<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
	   $this->load->model('admin/dashboardModel','dashboard');
    }

	public function index() {
        $data = array(
            'title'		=> 'Dashboard Area',
            'content'	=> 'staff/dashboard/index',
            'extra'     => 'staff/dashboard/js/js_index',
			'extracss'	=> 'staff/dashboard/css/dash_css',
			'mn_dash'    => 'active',
			'collap'	 => 'collapse',
            'breadcrumb' => '/ Dashboard'
		);
		$this->load->view('layout/wrapper', $data);
	}
	public function penjualan(){
        $month = date("m");
        
        $result=$this->dashboard->getPenjualan($month);
        
        if (count($result)==0){
            $data=0;
        }else{
            $data=$result;
        }
        echo json_encode($data);
	    
	}
	
	public function jualbrand(){
        $month = date("m");
        
        $result=$this->dashboard->getBrand($month);
        
        if (count($result)==0){
            $data=0;
        }else{
            $data=$result;
        }
        echo json_encode($data);
	}

	public function brandstore(){
        $month = date("m");
        
        $result=$this->dashboard->getBrandstore($month);
        
        if (count($result)==0){
            $data=0;
        }else{
            $data=$result;
        }
        
        echo json_encode($data);
	}
	
}
