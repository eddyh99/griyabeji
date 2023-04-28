<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moving extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('admin/movingModel');
	   $this->load->model('admin/storeModel');
	   $this->load->model('admin/brandModel');
	   $this->load->model('admin/kategoriModel');
	   $this->load->model('admin/produkModel');
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
    }
    
    public function index() {
        $data = array(
            'title'		=> 'Request Barang',
            'content'	=> 'admin/moving/index',
            'extra'		=> 'admin/moving/js/js_index',
			'mn_req'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'breadcrumb' => '/ Request Barang'
		);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function Listdata(){
        $columns	= array( 
                0	=> 'mutasi_id', 
                1	=> 'tanggal',
                2	=> 'dari',
                3	=> 'tujuan',
            );
		$start		= $this->input->post('start');
		$limit		= $this->input->post('length');
		
        $order		= $columns[$this->input->post('order')[0]['column']];
        $dir		= $this->input->post('order')[0]['dir'];
  
        $totalData	= $this->movingModel->allposts_count();
        $totalFiltered	= $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $result = $this->movingModel->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $result =  $this->movingModel->posts_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->movingModel->posts_search_count($search);
        }
		
        // $data=array(
        //         "recordsTotal"      => $totalData,
        //         "recordsFiltered"   => $totalFiltered,
        //         "produk"			=> $result,
        //     );

		$data = array(
			array(
				"dari"			=> "Hanaka Denpasar",
				"mutasi_id"		=> "1",
				"status"		=> "Belum",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "hello"
			),
			array(
				"dari"			=> "Hanaka Tabanan",
				"mutasi_id"		=> "4",
				"status"		=> "Batal",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "Hanaka Singaraja"
			),
			array(
				"dari"			=> "Hanaka Mengwi",
				"mutasi_id"		=> "5",
				"status"		=> "Diterima",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "Hanaka Singaraja"
			),
		);
	    echo json_encode($data);
	}

	public function Listdatakonfirm(){
        $columns	= array( 
                0	=> 'mutasi_id', 
                1	=> 'tanggal',
                2	=> 'dari',
                3	=> 'tujuan',
            );
		$start		= $this->input->post('start');
		$limit		= $this->input->post('length');
		
        $order		= $columns[$this->input->post('order')[0]['column']];
        $dir		= $this->input->post('order')[0]['dir'];
  
        $totalData	= $this->movingModel->allposts_countkonfirm();
        $totalFiltered	= $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $result = $this->movingModel->allpostskonfirm($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $result =  $this->movingModel->posts_searchkonfirm($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->movingModel->posts_search_countkonfirm($search);
        }
		
        // $data=array(
        //         "recordsTotal"      => $totalData,
        //         "recordsFiltered"   => $totalFiltered,
        //         "produk"			=> $result,
        //     );
		$data = array(
			array(
				"dari"			=> "Hanaka Denpasar",
				"mutasi_id"		=> "1",
				"status"		=> "Belum",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "hello"
			),
			array(
				"dari"			=> "Hanaka Tabanan",
				"mutasi_id"		=> "4",
				"status"		=> "Batal",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "Hanaka Singaraja"
			),
			array(
				"dari"			=> "Hanaka Mengwi",
				"mutasi_id"		=> "5",
				"status"		=> "Diterima",
				"tanggal"		=> "2023-04-17 11:37:48",
				"tujuan"		=> "Hanaka Singaraja"
			),
		);
	    echo json_encode($data);
	}

    public function tambah(){

		// $store	= $this->storeModel->Liststore();
		// $produk     = $this->produkModel->listproduk();
		$store = array(
			array(
				"storeid"		=> "1",
				"store"			=> "Hanaka Denpasar",
				"alamat"		=> "Jln Denpasar",
				"keterangan"	=> "Keterangan Hanaka Denpasar",
				"kontak"		=> "1212121212",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
			array(
				"storeid"		=> "2",
				"store"			=> "Hanaka Mengwi",
				"alamat"		=> "Jln Mengwi",
				"keterangan"	=> "Keterangan Hanaka Mengwi ",
				"kontak"		=> "12313213483",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
			array(
				"storeid"		=> "3",
				"store"			=> "Hanaka Singaraja",
				"alamat"		=> "Jln Singaraja",
				"keterangan"	=> "Keterangan Hanaka Singaraja",
				"kontak"		=> "1298798313",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-11 06:38:30"
			),
		);
		$produk = array(
			array(
				"barcode"	 	=> "0000000000000",
				"namaproduk"	=> "Gelang Sakti",
				"namabrand"	 	=> "Gelang karet",
				"namakategori"	=> "Gelang",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
			array(
				"barcode"	 	=> "1212121212121",
				"namaproduk"	=> "Baju Polos",
				"namabrand"	 	=> "Baju",
				"namakategori"	=> "Baju",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
			array(
				"barcode"	 	=> "1234567901231",
				"namaproduk"	=> "Celana Jeans",
				"namabrand"	 	=> "Celana",
				"namakategori"	=> "Celana",
				"status"		=> "0",
				"userid"		=> "admin",
				"lastupdate"	=> "2023-04-13 18:28:24"
			),
		);
		// print_r(json_encode($store));
		// die;


        $data	= array(
            'title'		=> 'Tambah Data',
            'content'	=> 'admin/moving/tambah',
            'extra'		=> 'admin/moving/js/js_tambah',
            'extracss'	=> 'admin/moving/css/css_tambah',
			'store'		=> $store,
			'produk'     => $produk,
			'mn_req'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'breadcrumb' => '/ Request Barang / Tambah'
		);
		$this->load->view('layout/wrapper', $data);
    }

	public function AddData(){	
		$asal	= $this->security->xss_clean($this->input->post('asal'));
		$tujuan = $this->security->xss_clean($this->input->post('tujuan'));
		$barang = json_decode($this->security->xss_clean($this->input->post('barang')));
        
        
		$pindah	= array(
			"tanggal"	=> date("Y-m-d H:i:s"),
			"dari"		=> $tujuan,
			"tujuan"	=> $asal,
			"userid"	=> $_SESSION["logged_status"]["username"]
		);
		
		$result	= $this->movingModel->insertData($pindah,$barang);
		print_r(json_encode($result));
		die;
		$this->session->set_flashdata('message', "Data berhasil tersimpan");
		echo "0";
	}

	public function batal($mutasi_id){
		$mutasi_id	= base64_decode($this->security->xss_clean($mutasi_id));
		$data		= array(
			"approved"	=> 2,
			"userid"	=> $_SESSION["logged_status"]["username"]			
		);
		
		
		// Checking Success and Error 
		// $result		= $this->movingModel->voidData($data,$mutasi_id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";



		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."/admin/moving");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."/admin/moving");
            return;
		}
	}

	public function terima($mutasi_id){
		$mutasi_id	= base64_decode($this->security->xss_clean($mutasi_id));
		$data		= array(
			"approved"	=> 1,
			"userid"	=> $_SESSION["logged_status"]["username"]			
		);
		
		
		// Checking Success and Error 
		// $result		= $this->movingModel->acceptData($data,$mutasi_id);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Diterima";



		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."/admin/moving");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."/admin/moving");
            return;
		}
	}

    public function konfirm(){

		$data	= array(
            'title'		 => 'Konfirm Permintaan',
            'content'	 => 'admin/moving/konfirm',
            'extra'		 => 'admin/moving/js/js_konfirm',
			'mn_confirm' => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'breadcrumb' => '/ Konfirmasi Permintaan'
		);
		
		$this->load->view('layout/wrapper', $data);
    }

	public function batalkonfirm($mutasi_id){
		$mutasi_id	= base64_decode($this->security->xss_clean($mutasi_id));
		$data		= array(
			"approved"	=> 2,
			"userid"	=> $_SESSION["logged_status"]["username"]			
		);
		$result		= $this->movingModel->voidData($data,$mutasi_id);

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."/admin/moving/konfirm");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."/admin/moving/konfirm");
            return;
		}
	}

	public function terimakonfirm($mutasi_id){
		$mutasi_id	= base64_decode($this->security->xss_clean($mutasi_id));
		$data		= array(
			"approved"	=> 3,
			"userid"	=> $_SESSION["logged_status"]["username"]			
		);
		
		$result		= $this->movingModel->acceptData($data,$mutasi_id);

		if ($result["code"]==0) {
		    $this->session->set_flashdata('message', $this->message->success_msg());
		    redirect(base_url()."/admin/moving/konfirm");
            return;
		}else{
		    $this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
		    redirect(base_url()."/admin/moving/konfirm");
            return;
		}
	}
	
	public function detail($mutasi_id,$stat){
	    if ($stat==0){
	        $req="active";
	        $kon="";
	    }else{
	        $req="";
	        $kon="active";
	    }
	    $mutasi_id=base64_decode($mutasi_id);
	    $permintaan=$this->movingModel->getMoving($mutasi_id);
        $data	= array(
            'title'		=> 'Detail Permintaan',
            'content'	=> 'admin/moving/detail',
            'extra'		=> 'admin/moving/js/js_detail',
			'asal'		=> $permintaan[0]["asal"],
			'tujuan'    => $permintaan[0]["tujuan"],
			'key'       => $mutasi_id,
			'mn_req'	 => $req,
			'mn_confirm' => $kon,
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'collap'	 => 'collapse',
			'breadcrumb' => '/ Request Barang / Detail'
		);
		$this->load->view('layout/wrapper', $data);
	    
	}
    
    public function listdetail(){
		$mutasi_id	= $this->security->xss_clean($this->input->post('mutasi_id'));
        echo json_encode($this->movingModel->getdetail($mutasi_id));        
    }
}
