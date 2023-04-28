<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() {
	   parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }
	   $this->load->model("admin/storeModel","store");
	   $this->load->model("admin/brandModel","brand");
	   $this->load->model("admin/kategoriModel","kategori");
	   $this->load->model("admin/laporanModel","laporan");
    }
    
    public function mutasi() {
        $toko   =   $this->store->liststore();
        $brand  =   $this->brand->listbrand();
        $kategori  =   $this->kategori->listkategori();
        $data		= array(
            'title'		 => 'Laporan Mutasi Stok',
            'content'	 => 'admin/laporan/mutasi',
            'extra'		 => 'admin/laporan/js/js_mutasi',
            'store'      => $toko,
            'brand'      => $brand,
            'kategori'   => $kategori,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side10'	 => 'active',
            'breadcrumb' => '/ Laporan / Persediaan Global'
		);
		$this->load->view('layout/wrapper', $data);
	}
    
    public function listmutasi(){
		// $bulan		= $this->security->xss_clean($this->input->post('bulan'));
		// $tahun		= $this->security->xss_clean($this->input->post('tahun'));
		// $brand	    = $this->security->xss_clean($this->input->post('brand'));
		// $kategori	= $this->security->xss_clean($this->input->post('kategori'));
		// $storeid	= $this->security->xss_clean($this->input->post('storeid'));
        // $result     = $this->laporan->getmutasi($bulan,$tahun,$storeid,$brand,$kategori);

        $result = array(
            array(
                "namaproduk"        => "Gelang Sakti",
                "namabrand"         => "69slam",
                "harga"             => "120000",
                "awal"              => "100",
                "masuk"             => "99",
                "keluar"            => "12",
                "jual"              => "88", 
                "sesuai"            => "80",
                "sisa"              => "10"  
            ),
            array(
                "namaproduk"        => "Baju Polo",
                "namabrand"         => "Hanaka Styles",
                "harga"             => "99000",
                "awal"              => "300",
                "masuk"             => "200",
                "keluar"            => "50",
                "jual"              => "250", 
                "sesuai"            => "250",
                "sisa"              => "50"  
            ),
        );
        echo json_encode($result);
    }

    public function mutasidetail() {
        $toko   =   $this->store->liststore();
        $brand  =   $this->brand->listbrand();
        $kategori  =   $this->kategori->listkategori();
        $data		= array(
            'title'		 => 'Laporan Mutasi Stok Detail',
            'content'	 => 'admin/laporan/mutasidetail',
            'extra'		 => 'admin/laporan/js/js_mutasidetail',
            'store'      => $toko,
            'brand'      => $brand,
            'kategori'   => $kategori,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side20'	 => 'active',
            'breadcrumb' => '/ Laporan / Persediaan Detail'
		);
		$this->load->view('layout/wrapper', $data);
	}
    
    public function listmutasidetail(){
		// $bulan		= $this->security->xss_clean($this->input->post('bulan'));
		// $tahun		= $this->security->xss_clean($this->input->post('tahun'));
		// $storeid	= $this->security->xss_clean($this->input->post('storeid'));
		// $kategori	= $this->security->xss_clean($this->input->post('kategori'));
		// $brand	    = $this->security->xss_clean($this->input->post('brand'));
        // $result=$this->laporan->getmutasidetail($bulan,$tahun,$storeid,$brand,$kategori);

        $result = array(
            array(
                "namaproduk"        => "Gelang Sakti",
                "size"              => "M",
                "namabrand"         => "69slam",
                "harga"             => "120000",
                "awal"              => "100",
                "masuk"             => "99",
                "keluar"            => "12",
                "jual"              => "88", 
                "sesuai"            => "80",
                "sisa"              => "10"  
            ),
            array(
                "namaproduk"        => "Baju Polo",
                "size"              => "L",
                "namabrand"         => "Hanaka Styles",
                "harga"             => "99000",
                "awal"              => "300",
                "masuk"             => "200",
                "keluar"            => "50",
                "jual"              => "250", 
                "sesuai"            => "250",
                "sisa"              => "50"  
            ),
        );
        echo json_encode($result);
    }
    
    public function penjualan(){
        $toko   =   $this->store->liststore();
        
        $data		= array(
            'title'		 => 'Laporan Penjualan',
            'content'	 => 'admin/laporan/penjualan',
            'extra'		 => 'admin/laporan/js/js_penjualan',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side11'	 => 'active',
            'breadcrumb' => '/ Laporan / Penjualan Summary'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function listpenjualan(){
		// $tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		// $storeid	= $this->security->xss_clean($this->input->post('storeid'));
		// $awal       = date_format(date_create($tgl[0]),"Y-m-d");
		// $akhir      = date_format(date_create($tgl[1]),"Y-m-d");

        $result = array(
            array(
                "id"                => "1",
                "nonota"            => "111",
                "tanggal"           => "2013-03-15",
                "member"            => "yanyiik",
                "diskonn"            => "50",
                "diskonp"           => "10",
                "total"             => "30",
                "method"            => "cash",
                "kasir"             => "ari", 
            ),
            array(
                "id"                => "2",
                "nonota"            => "222",
                "tanggal"           => "2013-03-15",
                "member"            => "awe",
                "diskonn"            => "20",
                "diskonp"           => "10",
                "total"             => "100",
                "method"            => "debit",
                "kasir"             => "ari", 
            ),
            array(
                "id"                => "3",
                "nonota"            => "333",
                "tanggal"           => "2013-03-15",
                "member"            => "gunawan",
                "diskonn"            => "50",
                "diskonp"           => "5",
                "total"             => "5",
                "method"            => "cash",
                "kasir"             => "ari", 
            ),
        );

        // $result=$this->laporan->getpenjualan($awal,$akhir,$storeid);
        echo json_encode($result);
    }

    public function kaskeluar(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Kas Keluar',
            'content'	 => 'admin/laporan/kaskeluar',
            'extra'		 => 'admin/laporan/js/js_kaskeluar',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side21'	 => 'active',
            'breadcrumb' => '/ Laporan / Kas'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function listkaskeluar(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");

                
        $result = array(
            array(
                "store"             => "Hanaka Mengwi",
                "tanggal"           => "2013-03-15",
                "jenis"             => "Kas Awal",
                "keterangan"        => "kas awal banget",
                "nominal"           => "5000000",
            ),
        );

        // $result=$this->laporan->getkaskeluar($awal,$akhir,$storeid);
        echo json_encode($result);
    }

    public function barang(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Mutasi Barang',
            'content'	 => 'admin/laporan/barang',
            'extra'		 => 'admin/laporan/js/js_barang',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side12'	 => 'active',
            'breadcrumb' => '/ Laporan / Drop In or Drop Out'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function listbarang(){
		// $tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		// $storeid	= $this->security->xss_clean($this->input->post('storeid'));
		// $jenis	    = $this->security->xss_clean($this->input->post('jenis'));
		
		// $awal       = date_format(date_create($tgl[0]),"Y-m-d");
		// $akhir      = date_format(date_create($tgl[1]),"Y-m-d");
        
        $result = array(
            array(
                "mutasi_id"         => "10",
                "tanggal"           => "2013-03-15",
                "barcode"           => "111111111",
                "namaproduk"        => "Gelang Sakti",
                "size"              => "M",
                "jumlah"            => "110",
                "store"             => "Hanaka Tabanan",
            ),
            array(
                "mutasi_id"         => "20",
                "tanggal"           => "2013-03-15",
                "barcode"           => "2222222",
                "namaproduk"        => "Baju Sakti",
                "size"              => "XXL",
                "jumlah"            => "300",
                "store"             => "Hanaka Mengwi",
            ),
        );

        // $result=$this->laporan->getbarang($awal,$akhir,$storeid,$jenis);
        echo json_encode($result);
    }

    public function nontunai(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Transaksi Non Tunai',
            'content'	 => 'admin/laporan/nontunai',
            'extra'		 => 'admin/laporan/js/js_nontunai',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side14'	 => 'active',
            'breadcrumb' => '/ Laporan / Non Tunai'
		);
		$this->load->view('layout/wrapper', $data);
    }

    public function listnontunai(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));

		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");

        $result = array(
            array(
                "nonota"            => "111",
                "tanggal"           => "2013-03-15",
                "method"            => "cash",
                "total"             => "100",
                "persen"            => "20",
                "fee"               => "150000",
                "grandttl"          => "500",
            ),
            array(
                "nonota"            => "222",
                "tanggal"           => "2013-03-15",
                "method"            => "debit",
                "total"             => "78",
                "persen"            => "10",
                "fee"               => "200000",
                "grandttl"          => "230",
            ),
        );

        // $result=$this->laporan->getnontunai($awal,$akhir,$storeid);
        echo json_encode($result);
    }
    
    public function detail($id){

        $data		= array(
            'title'		 => 'Laporan Penjualan',
            'content'	 => 'admin/laporan/detailpenjualan',
            'extra'		 => 'admin/laporan/js/js_detailpenjualan',
			// 'mn_laporan' => 'active',
			'key'        => $id,
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side11'	 => 'active',
            'breadcrumb' => '/ Laporan / Penjualan Summary / Detail'
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    public function listdetail(){
		// $id	    = $this->security->xss_clean($this->input->post('key'));
        // $result=$this->laporan->detailpenjualan($id);


        
        $result = array(
            array(
                "id"                => "1",
                "nonota"            => "222",
                "namaproduk"        => "Baju Sakti",
                "namabrand"         => "Hanaka Style",
                "size"              => "XXL",
                "jumlah"            => "120",
                "harga"             => "99000",
                "diskonn"            => "10",
                "diskonp"           => "5",
                "total"             => "50",
                "alasan"            => "Ini adalah Alasan Baju Sakti"
            ),
            array(
                "id"                => "2",
                "nonota"            => "111",
                "namaproduk"        => "Gelang Sakti",
                "namabrand"         => "Hanaka Style",
                "size"              => "M",
                "jumlah"            => "100",
                "harga"             => "120000",
                "diskonn"            => "50",
                "diskonp"           => "10",
                "total"             => "30",
                "alasan"            => "Ini adalah Alasan"
            ),
            array(
                "id"                => "3",
                "nonota"            => "333",
                "namaproduk"        => "Celana Sakti",
                "namabrand"         => "Hanaka Style",
                "size"              => "S",
                "jumlah"            => "1000",
                "harga"             => "300000",
                "diskonn"            => "30",
                "diskonp"           => "20",
                "total"             => "87",
                "alasan"            => "Ini adalah Alasan"
            ),
        );
        echo json_encode($result);
    }
    
    public function brand(){
        $toko   =   $this->store->liststore();
        $brand  =   $this->brand->listbrand();
        $kategori  =   $this->kategori->listkategori();
        $data		= array(
            'title'		 => 'Laporan Detail Brand',
            'content'	 => 'admin/laporan/brand',
            'extra'		 => 'admin/laporan/js/js_brand',
            'store'      => $toko,
            'brand'      => $brand,
            'kategori'   => $kategori,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side15'	 => 'active',
            'breadcrumb' => '/ Laporan / Penjualan Brand'
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    public function listbrand(){
		// $tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		// $storeid	= $this->security->xss_clean($this->input->post('storeid'));
		// $brand	    = $this->security->xss_clean($this->input->post('brand'));
		// $kategori   = $this->security->xss_clean($this->input->post('kategori'));

		// $awal       = date_format(date_create($tgl[0]),"Y-m-d");
		// $akhir      = date_format(date_create($tgl[1]),"Y-m-d");
        
        $result = array(
            array(
                "id"                => "1",
                "nonota"            => "111",
                "barcode"           => "00000000000000",
                "tanggal"           => "2013-03-15",
                "namabrand"         => "Hanaka Style",
                "namaproduk"        => "Gelang Sakti",
                "size"              => "M",
                "jumlah"            => "30",
                "total"             => "120000",
            ),
            array(
                "id"                => "2",
                "nonota"            => "222",
                "barcode"           => "2222222222222",
                "tanggal"           => "2013-03-15",
                "namabrand"         => "Hanaka Style",
                "namaproduk"        => "Baju Sakti",
                "size"              => "XXL",
                "jumlah"            => "50",
                "total"             => "5000000",
            ),
            array(
                "id"                => "3",
                "nonota"            => "3333",
                "barcode"           => "33333333333",
                "tanggal"           => "2013-03-15",
                "namabrand"         => "69Slam",
                "namaproduk"        => "Celana Boxer",
                "size"              => "S",
                "jumlah"            => "150",
                "total"             => "500000",
            ),
        );

        // $result=$this->laporan->getbrand($awal,$akhir,$storeid,$brand,$kategori);
        echo json_encode($result);
    }

    public function request(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Permintaan',
            'content'	 => 'admin/laporan/permintaan',
            'extra'		 => 'admin/laporan/js/js_permintaan',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side17'     => 'active',
            'breadcrumb' => '/ Laporan / Permintaan'
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    public function listrequest(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));
		$jenis	    = $this->security->xss_clean($this->input->post('jenis'));

		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
        
         
        $result = array(
            array(
                "mutasi_id"         => "1",
                "tanggal"           => "2013-03-15",
                "barcode"           => "00000000000000",
                "namaproduk"        => "Gelang Sakti",
                "size"              => "M",
                "jumlah"            => "30",
                "store"             => "Hanaka Denpasar",
                "status"            => "Diterima",
            ),
            array(
                "mutasi_id"         => "2",
                "tanggal"           => "2013-03-15",
                "barcode"           => "222222222222",
                "namaproduk"        => "Baju Sakti",
                "size"              => "XXL",
                "jumlah"            => "10",
                "store"             => "Hanaka Mengwi",
                "status"            => "Batal",
            ),
        );

        // $result=$this->laporan->getrequest($awal,$akhir,$storeid,$jenis);
        echo json_encode($result);
    }

    public function retur(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Retur',
            'content'	 => 'admin/laporan/retur',
            'extra'		 => 'admin/laporan/js/js_retur',
            'store'      => $toko,
			'side18'    => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side18'	 => 'active',
            'breadcrumb' => '/ Laporan / Retur Konsumen'
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    public function listretur(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));

		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
        
        $result = array(
            array(
                "id"                => "1",
                "tanggal"           => "2013-03-15",
                "jual_id"           => "111",
                "namaproduk"        => "Gelang Sakti",
                "namabrand"         => "Hanaka Styled",
                "jumlah"            => "30",
                "harga"             => "130000",
                "total"             => "99",
            ),
        );

        // $result=$this->laporan->getretur($awal,$akhir,$storeid);
        echo json_encode($result);
    }

    public function stokout(){
        $toko   =   $this->store->liststore();
        $data		= array(
            'title'		 => 'Laporan Stok Out',
            'content'	 => 'admin/laporan/stokout',
            'extra'		 => 'admin/laporan/js/js_stokout',
            'store'      => $toko,
			// 'mn_laporan' => 'active',
			'collap'	 => 'collapse in',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse',
			'side19'	 => 'active',
            'breadcrumb' => '/ Laporan / Stok Out'
		);
		$this->load->view('layout/wrapper', $data);
    }
    
    public function liststokout(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$storeid	= $this->security->xss_clean($this->input->post('storeid'));

		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
        
        $result = array(
            array(
                "id"                => "1",
                "tanggal"           => "2013-03-15",
                "jual_id"           => "111",
                "nama"              => "ari",
                "keterangan"        => "Kembali",
                "namaproduk"        => "Gelang Sakti",
                "size"              => "M",
                "jumlah"            => "30",
                "status"            => "Diterima",
            ),
            array(
                "id"                => "2",
                "tanggal"           => "2013-03-15",
                "jual_id"           => "2222",
                "nama"              => "fahmi",
                "keterangan"        => "Kembali",
                "namaproduk"        => "Baju Sakti",
                "size"              => "XXL",
                "jumlah"            => "10",
                "status"            => "Diterima",
            ),
        );

        // $result=$this->laporan->getstokout($awal,$akhir,$storeid);
        echo json_encode($result);
    }
    
}
