<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_status'])) {
			redirect(base_url());
		}
		$this->load->model('admin/mdl_kas', "kas");
		$this->load->model('admin/mdl_store', 'store');
	}

	// ====== START KAS =====

	// public function index()
	// {
	// 	$stores = $this->store->Liststore();

	// 	$data	= array(
	// 		'title'		 => NAMETITLE . ' - Kas',
	// 		'content'	 => 'kas/index',
	// 		'extra'		 => 'kas/js/js_index',
	// 		'side13'	 => 'active',
	// 		'breadcrumb' => 'Kas'
	// 	);
	// 	$this->load->view('layout/wrapper', $data);
	// }


	// ====== START LAPORAN PENJUALAN =====
	public function penjualan()
	{
		if (@!isset($_GET["tanggal"])) {
			$tanggal_awal       = date("Y-m-d", strtotime("first day of 0 month"));
			$tanggal_akhir      = date("Y-m-d", strtotime("last day of 0 month"));

			$tglShow = date("d M Y", strtotime("$tanggal_awal")) . ' - ' . date("d M Y", strtotime("$tanggal_akhir"));
		} else {
			$tgl     = $this->security->xss_clean($_GET["tanggal"]);
			$tanggal		= explode("-", $tgl);
			$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
			$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");

			if ($tanggal_awal == $tanggal_akhir) {
				$tglShow = $tanggal[0];
			} else {
				$tglShow = $tgl;
			}
		}

		$result = $this->kas->getpenjualan($tanggal_awal, $tanggal_akhir);
		// print("<pre>" . print_r($result, true) . "</pre>");
		// die;

		$uniqueitems = array();
		$uniqueproduk = array();
		$uniquepaket = array();
		$uniquetransaksi = array();

		foreach ($result as $byMehtod) {
			$uniquetransaksi[$byMehtod['id']] = $byMehtod;

			if ($byMehtod['id_reservasi'] == NULL && $byMehtod['jenis'] == 'items') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniqueitems[$byMehtod['id_barang'] . '1' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniqueitems[$byMehtod['id_barang'] . '1' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniqueitems[$byMehtod['id_barang'] . '1' . '6'] = $byMehtod;
				}
			}
			if ($byMehtod['id_reservasi'] != NULL && $byMehtod['jenis'] == 'items') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniqueitems[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '1' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniqueitems[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '1' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniqueitems[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '1' . '6'] = $byMehtod;
				}
			}
			if ($byMehtod['id_reservasi'] == NULL && $byMehtod['jenis'] == 'produk') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniqueproduk[$byMehtod['id_barang'] . '2' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniqueproduk[$byMehtod['id_barang'] . '2' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniqueproduk[$byMehtod['id_barang'] . '2' . '6'] = $byMehtod;
				}
			}
			if ($byMehtod['id_reservasi'] != NULL && $byMehtod['jenis'] == 'produk') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniqueproduk[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '2' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniqueproduk[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '2' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniqueproduk[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '2' . '6'] = $byMehtod;
				}
			}
			if ($byMehtod['id_reservasi'] == NULL && $byMehtod['jenis'] == 'paket') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniquepaket[$byMehtod['id_barang'] . '3' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniquepaket[$byMehtod['id_barang'] . '3' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniquepaket[$byMehtod['id_barang'] . '3' . '6'] = $byMehtod;
				}
			}
			if ($byMehtod['id_reservasi'] != NULL && $byMehtod['jenis'] == 'paket') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$uniquepaket[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '3' . '4'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'DOMESTIK') {
					$uniquepaket[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '3' . '5'] = $byMehtod;
				}
				if ($byMehtod['jns'] == 'INTERNASIONAL') {
					$uniquepaket[$byMehtod['id_barang'] . $byMehtod['id_reservasi'] . '3' . '6'] = $byMehtod;
				}
			}
		}


		$items = array_values($uniqueitems);
		$produk = array_values($uniqueproduk);
		$paket = array_values($uniquepaket);
		$penjualan = array_values($uniquetransaksi);

		// print("<pre>" . print_r($result, true) . "</pre>");
		// die;

		$data	= array(
			'title'		 	=> 'Laporan Penjualan',
			'content'	 	=> 'laporan/penjualan',
			'extra'		 	=> 'laporan/js/js_penjualan',
			'side18'	 	=> 'active',
			'colmas_lp'	 	=> 'show hover',
			'breadcrumb' 	=> 'Laporan Penjualan/',
			'data'  		=> $result,
			'penjualan'  	=> $penjualan,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
			'items'       	=> $items,
			'produk'       	=> $produk,
			'paket'       	=> $paket,
		);
		$this->load->view('layout/wrapper', $data);
	}
}
