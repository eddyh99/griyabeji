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
		if (@!isset($_GET["tgl"])) {
			$tgl = date("d M Y");
			$tglcari = date("Y-m-d");
		} else {
			$tgl     = $this->security->xss_clean($_GET["tgl"]);
			$tglcari = date_format(date_create($tgl), "Y-m-d");
		}

		$result = $this->kas->laporanHarian($tglcari);
		$store = $this->kas->listKasByDate($tglcari);

		$cash = 0;
		$card = 0;

		$uniqueitems = array();
		$uniqueproduk = array();
		$uniquepaket = array();

		foreach ($result as $byMehtod) {
			if ($byMehtod['jml'] == '0') {
				$jmlBarang = 1;
			} else {
				$jmlBarang = $byMehtod['jml'];
			}

			if ($byMehtod['method'] == 'cash') {
				if ($byMehtod['jns'] == 'LOKAL') {
					$cash += ($byMehtod['lokal'] * $jmlBarang);
				} elseif ($byMehtod['jns'] == 'DOMESTIK') {
					$cash += ($byMehtod['domestik'] * $jmlBarang);
				} else {
					$cash += ($byMehtod['internasional'] * $jmlBarang);
				}
			} else {
				if ($byMehtod['jns'] == 'LOKAL') {
					$card += ($byMehtod['lokal'] * $jmlBarang);
				} elseif ($byMehtod['jns'] == 'DOMESTIK') {
					$card += ($byMehtod['domestik'] * $jmlBarang);
				} else {
					$card += ($byMehtod['internasional'] * $jmlBarang);
				}
			}

			if ($byMehtod['jenis'] == 'items') {
				$uniqueitems[$byMehtod['id_produk']] = $byMehtod;
			}
			if ($byMehtod['jenis'] == 'produk') {
				$uniqueproduk[$byMehtod['id_produk']] = $byMehtod;
			}
			if ($byMehtod['jenis'] == 'paket') {
				$uniquepaket[$byMehtod['id_produk']] = $byMehtod;
			}
		}


		$items = array_values($uniqueitems);
		$produk = array_values($uniqueproduk);
		$paket = array_values($uniquepaket);

		$uniquestore = array();
		foreach ($store as $byStore) {
			$uniquestore[$byStore['store_id']] = $byStore;
		}

		$storeUniq = array_values($uniquestore);

		$data	= array(
			'title'		 => 'Laporan Penjualan',
			'content'	 => 'kas/tutupharian',
			'extra'		 => 'kas/js/js_tutupharian',
			'side14'	 => 'active',
			// 'colmas_lp'	 => 'hover show',
			'breadcrumb' => 'Laporan Penjualan /',
			'penjualan'  => $result,
			'tgl'        => $tgl,
			'store'        => $store,
			'storeUniq'        => $storeUniq,
			'cash'       => $cash,
			'card'       => $card,
			'items'       => $items,
			'produk'       => $produk,
			'paket'       => $paket,
		);
		$this->load->view('layout/wrapper', $data);
	}
	// ====== END LAPORAN PENJUALAN =====
}
