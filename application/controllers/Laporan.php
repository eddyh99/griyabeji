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
		$this->load->model('admin/mdl_items', "items");
		$this->load->model('admin/mdl_produk', "produk");
		$this->load->model('admin/mdl_paket', "paket");
		$this->load->model('admin/mdl_store', 'store');
	}

	// ====== START KAS =====
	public function kas()
	{
		if (@!isset($_GET["tanggal"])) {
			$tanggal_awal       = date("Y-m-d", strtotime("first day of 0 month"));
			$tanggal_akhir      = date("Y-m-d", strtotime("last day of 0 month"));

			$tglShow = date("d M Y", strtotime("$tanggal_awal")) . ' - ' . date("d M Y", strtotime("$tanggal_akhir"));
		} else {
			$tgl     = $this->security->xss_clean($_GET["tanggal"]);
			$idstore     = $this->security->xss_clean(@$_GET["storename"]);
			$tanggal		= explode("-", $tgl);
			$tanggal_awal       = date_format(date_create($tanggal[0]), "Y-m-d");
			$tanggal_akhir      = date_format(date_create($tanggal[1]), "Y-m-d");

			if ($tanggal_awal == $tanggal_akhir) {
				$tglShow = $tanggal[0];
			} else {
				$tglShow = $tgl;
			}
		}

		if (@isset($_GET["storename"])) {
			$saldo = $this->kas->saldoKas($tanggal_awal, $idstore);
			$kas = $this->kas->ListkasByDateAndStore($tanggal_awal, $tanggal_akhir, $idstore);
		}
		$store = $this->store->Liststore();

		$data	= array(
			'title'		 	=> 'Laporan KAS',
			'content'	 	=> 'laporan/kas',
			'extra'		 	=> 'laporan/js/js_penjualan',
			'side19'	 	=> 'active',
			'colmas_lp'	 	=> 'show hover',
			'breadcrumb' 	=> 'Laporan KAS/',
			'kas'  			=> @$kas,
			'saldo'  		=> @$saldo,
			'store'  		=> $store,
			'idstore'       => @$idstore,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
		);
		$this->load->view('layout/wrapper', $data);
	}

	// ====== START LAPORAN UNTUNG RUGI =====
	public function produkteratas()
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

		$uniqueCountry = array();
		$uniqueproduk = array();

		foreach ($result as $byMehtod) {
			$uniqueCountry[$byMehtod['country_code']] = $byMehtod;

			if ($byMehtod['jenis'] == 'produk') {
				$uniqueproduk[$byMehtod['id_barang'] . $byMehtod['country_code']] = $byMehtod;
			}
		}



		$country = array_values($uniqueCountry);
		$produk = array_values($uniqueproduk);
		// print("<pre>" . print_r($produk, true) . "</pre>");
		// die;

		$data	= array(
			'title'		 	=> 'Laporan Produk Terpopuler',
			'content'	 	=> 'laporan/terpopuler',
			'extra'		 	=> 'laporan/js/js_penjualan',
			'side21'	 	=> 'active',
			'colmas_lp'	 	=> 'show hover',
			'breadcrumb' 	=> 'Laporan Produk Terpopuler/',
			'data'  		=> $result,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
			'country'       => $country,
			'produk'       => $produk,
		);
		$this->load->view('layout/wrapper', $data);
	}


	// ====== START LAPORAN UNTUNG RUGI =====
	public function untungrugi()
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
		$produks = array_values($uniqueproduk);
		$pakets = array_values($uniquepaket);
		$penjualan = array_values($uniquetransaksi);


		// Mencari Items dari Produk
		$listItemsbyProduk = array();
		foreach ($produks as $produk) {
			$itemproduk = $this->produk->itemproduk($produk['id_barang']);
			$itemspd = array();
			foreach ($itemproduk as $list) {
				$temp['id_barang']	= $list['id_items'];
				$temp['namabarang']	= $list['namaitem'];

				if ($produk['id_reservasi'] != NULL) {
					$hargaitem = $this->items->ListitemsByReservasi($produk['id_reservasi']);
					foreach ($hargaitem as $harga_items) {
						if ($harga_items['id_items'] == $list['id_items']) {
							$temp['hpp']	= @$harga_items['hpp'];
							$temp['lokal']	= @$harga_items['lokal'];
							$temp['domestik']	= @$harga_items['domestik'];
							$temp['internasional']	= @$harga_items['internasional'];
						}
					}
				} else {
					$hargaitem = $this->items->getItemsByDate($produk['tanggal'], $list['id_items']);
					foreach ($hargaitem as $harga_items) {
						$temp['hpp']	= @$harga_items['hpp'];
						$temp['lokal']	= @$harga_items['lokal'];
						$temp['domestik']	= @$harga_items['domestik'];
						$temp['internasional']	= @$harga_items['internasional'];
					}
				}

				array_push($itemspd, $temp);
			}

			$pd['id'] = $produk['id'];
			$pd['id_reservasi'] = $produk['id_reservasi'];
			$pd['id_barang'] = $produk['id_barang'];
			$pd['namabarang'] = $produk['namabarang'];
			$pd['items'] = $itemspd;

			array_push($listItemsbyProduk, $pd);
		}

		// Mencari Items dari Paket
		$listItemsbyPaket = array();
		foreach ($pakets as $paket) {
			$produkByPaket = $this->paket->itempaket($paket['id_barang']);
			$list_items_by_produk_in_paket = array();
			foreach ($produkByPaket as $listProduk) {
				$itemproduk = $this->produk->itemproduk($listProduk['id_produk']);
				$itemspd = array();
				foreach ($itemproduk as $list) {
					$temp['id_barang']	= $list['id_items'];
					$temp['namabarang']	= $list['namaitem'];

					if ($paket['id_reservasi'] != NULL) {
						$hargaitem = $this->items->ListitemsByReservasi($paket['id_reservasi']);
						foreach ($hargaitem as $harga_items) {
							if ($harga_items['id_items'] == $list['id_items']) {
								$temp['hpp']	= @$harga_items['hpp'];
								$temp['lokal']	= @$harga_items['lokal'];
								$temp['domestik']	= @$harga_items['domestik'];
								$temp['internasional']	= @$harga_items['internasional'];
							}
						}
					} else {
						$hargaitem = $this->items->getItemsByDate($paket['tanggal'], $list['id_items']);
						foreach ($hargaitem as $harga_items) {
							$temp['hpp']	= @$harga_items['hpp'];
							$temp['lokal']	= @$harga_items['lokal'];
							$temp['domestik']	= @$harga_items['domestik'];
							$temp['internasional']	= @$harga_items['internasional'];
						}
					}
					array_push($itemspd, $temp);
				}
				$pd['id'] = $listProduk['id_produk'];
				$pd['namabarang'] = $listProduk['namaproduk'];
				$pd['items'] = $itemspd;

				array_push($list_items_by_produk_in_paket, $pd);
			}
			$pk['id'] = $paket['id'];
			$pk['id_reservasi'] = $paket['id_reservasi'];
			$pk['id_barang'] = $paket['id_barang'];
			$pk['namabarang'] = $paket['namabarang'];
			$pk['produk'] = $list_items_by_produk_in_paket;

			array_push($listItemsbyPaket, $pk);
		}

		// print("<pre>" . print_r($pakets, true) . "</pre>");
		// die;

		$data	= array(
			'title'		 	=> 'Laporan Untung Rugi',
			'content'	 	=> 'laporan/untungrugi',
			'extra'		 	=> 'laporan/js/js_penjualan',
			'side20'	 	=> 'active',
			'colmas_lp'	 	=> 'show hover',
			'breadcrumb' 	=> 'Laporan Untung Rugi/',
			'data'  		=> $result,
			'penjualan'  	=> $penjualan,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
			'items'       	=> $items,
			'produk'       	=> $produks,
			'paket'       	=> $pakets,
			'listItemsbyProduk' => $listItemsbyProduk,
			'listItemsbyPaket'  => $listItemsbyPaket,
		);
		$this->load->view('layout/wrapper', $data);
	}

	// ====== START LAPORAN PENJUALAN =====
	public function detailuntungrugi($id)
	{
		$id = base64_decode($id);
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
			// if ($byMehtod['id'] == $id) {
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
			// }
		}

		$list_items = array_values($uniqueitems);
		$list_produk = array_values($uniqueproduk);
		$list_paket = array_values($uniquepaket);
		$penjualan = array_values($uniquetransaksi);

		// Mencari Items dari Produk
		$listItemsbyProduk = array();
		foreach ($list_produk as $produk) {
			$itemproduk = $this->produk->itemproduk($produk['id_barang']);
			$itemspd = array();
			foreach ($itemproduk as $list) {
				$temp['id_barang']	= $list['id_items'];
				$temp['namabarang']	= $list['namaitem'];

				if ($produk['id_reservasi'] != NULL) {
					$hargaitem = $this->items->ListitemsByReservasi($produk['id_reservasi']);
					foreach ($hargaitem as $harga_items) {
						if ($harga_items['id_items'] == $list['id_items']) {
							$temp['hpp']	= @$harga_items['hpp'];
							$temp['lokal']	= @$harga_items['lokal'];
							$temp['domestik']	= @$harga_items['domestik'];
							$temp['internasional']	= @$harga_items['internasional'];
						}
					}
				} else {
					$hargaitem = $this->items->getItemsByDate($produk['tanggal'], $list['id_items']);
					foreach ($hargaitem as $harga_items) {
						$temp['hpp']	= @$harga_items['hpp'];
						$temp['lokal']	= @$harga_items['lokal'];
						$temp['domestik']	= @$harga_items['domestik'];
						$temp['internasional']	= @$harga_items['internasional'];
					}
				}

				array_push($itemspd, $temp);
			}

			$pd['id'] = $produk['id'];
			$pd['id_reservasi'] = $produk['id_reservasi'];
			$pd['id_barang'] = $produk['id_barang'];
			$pd['namabarang'] = $produk['namabarang'];
			$pd['items'] = $itemspd;

			array_push($listItemsbyProduk, $pd);
		}

		// Mencari Items dari Paket
		$listItemsbyPaket = array();
		foreach ($list_paket as $paket) {
			$produkByPaket = $this->paket->itempaket($paket['id_barang']);
			$list_items_by_produk_in_paket = array();
			foreach ($produkByPaket as $listProduk) {
				$itemproduk = $this->produk->itemproduk($listProduk['id_produk']);
				$itemspd = array();
				foreach ($itemproduk as $list) {
					$temp['id_barang']	= $list['id_items'];
					$temp['namabarang']	= $list['namaitem'];

					if ($paket['id_reservasi'] != NULL) {
						$hargaitem = $this->items->ListitemsByReservasi($paket['id_reservasi']);
						foreach ($hargaitem as $harga_items) {
							if ($harga_items['id_items'] == $list['id_items']) {
								$temp['hpp']	= @$harga_items['hpp'];
								$temp['lokal']	= @$harga_items['lokal'];
								$temp['domestik']	= @$harga_items['domestik'];
								$temp['internasional']	= @$harga_items['internasional'];
							}
						}
					} else {
						$hargaitem = $this->items->getItemsByDate($paket['tanggal'], $list['id_items']);
						foreach ($hargaitem as $harga_items) {
							$temp['hpp']	= @$harga_items['hpp'];
							$temp['lokal']	= @$harga_items['lokal'];
							$temp['domestik']	= @$harga_items['domestik'];
							$temp['internasional']	= @$harga_items['internasional'];
						}
					}

					array_push($itemspd, $temp);
				}


				$pd['id'] = $listProduk['id_produk'];
				$pd['namabarang'] = $listProduk['namaproduk'];
				$pd['items'] = $itemspd;

				array_push($list_items_by_produk_in_paket, $pd);
			}
			$pk['id'] = $paket['id'];
			$pk['id_reservasi'] = $paket['id_reservasi'];
			$pk['id_barang'] = $paket['id_barang'];
			$pk['namabarang'] = $paket['namabarang'];
			$pk['produk'] = $list_items_by_produk_in_paket;

			array_push($listItemsbyPaket, $pk);
		}

		// print("<pre>" . print_r($penjualan, true) . "</pre>");
		// die;

		$data	= array(
			'title'		 	=> 'Laporan Untung Rugi',
			'content'	 	=> 'laporan/detailuntungrugi',
			'extra'		 	=> 'laporan/js/js_penjualan',
			'side20'	 	=> 'active',
			'colmas_lp'	 	=> 'show hover',
			'breadcrumb' 	=> 'Laporan Untung Rugi/',
			'data'  		=> $result,
			'id'  			=> $id,
			'penjualan'  	=> $penjualan,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
			'list_items'       	=> $list_items,
			'list_produk'       	=> $list_produk,
			'list_paket'       	=> $list_paket,
			'listItemsbyProduk' => $listItemsbyProduk,
			'listItemsbyPaket'  => $listItemsbyPaket,
		);
		$this->load->view('layout/wrapper', $data);
	}

	// ====== START PENJUALAN =====
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

		$uniqueitems = array();
		$uniqueproduk = array();
		$uniquepaket = array();

		foreach ($result as $byMehtod) {
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

		$list_items = array_values($uniqueitems);
		$list_produk = array_values($uniqueproduk);
		$list_paket = array_values($uniquepaket);

		// print("<pre>" . print_r($result, true) . "</pre>");
		// die;

		$data	= array(
			'title'		 => 'Laporan Penjualan',
			'content'	 => 'laporan/penjualan',
			'extra'		 => 'laporan/js/js_penjualan',
			'side18'	 => 'active',
			'colmas_lp'	 => 'hover show',
			'breadcrumb' => 'Laporan Penjualan /',
			'data'		 => $result,
			'tgl'        	=> @$tgl,
			'tglShow'		=> @$tglShow,
			'tanggal_awal'  => @$tanggal_awal,
			'tanggal_akhir'	=> @$tanggal_akhir,
			'list_items'       	=> $list_items,
			'list_produk'       	=> $list_produk,
			'list_paket'       	=> $list_paket,
		);
		$this->load->view('layout/wrapper', $data);
	}
	// ====== END LAPORAN PENJUALAN =====
}
