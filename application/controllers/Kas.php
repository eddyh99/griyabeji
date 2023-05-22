<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
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

	public function index()
	{
		/*@todo
		tambah kan combo box untuk filter store nya di list kas
		jadi bisa filter per store nya
		*/

		$stores = $this->store->Liststore();


		$data	= array(
			'title'		 => NAMETITLE . ' - Kas',
			'content'	 => 'kas/index',
			'extra'		 => 'kas/js/js_index',
			'side13'	 => 'active',
			'breadcrumb' => 'Kas'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function Listdata()
	{

		$result = $this->kas->listkas();
		// $result = array (
		// 	array(
		//         "id"            => "1",
		// 		"tanggal"		=> "14 May 2023",
		// 		"nominal"		=> "100000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "Warkop",
		// 	),
		// 	array(
		//         "id"            => "2",
		// 		"tanggal"		=> "15 May 2023",
		// 		"nominal"		=> "200000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "parkir",
		// 	),
		// 	array(
		//         "id"            => "3",
		// 		"tanggal"		=> "16 May 2023",
		// 		"nominal"		=> "300000",
		// 		"keterangan"	=> "ini kas",
		// 		"store"			=> "Warung Herbal",
		// 	),
		// );
		echo json_encode($result);
	}

	public function tambah()
	{

		$stores = $this->store->Liststore();


		$data = array(
			'title'		 => NAMETITLE . ' - Tambah Data KAS',
			'content'	 => 'kas/tambah',
			'extra'		 => 'kas/js/js_tambah',
			'side13'	 => 'active',
			'breadcrumb' => '/ Kas / Tambah Data',
			'stores' 	 => $stores
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function AddData()
	{

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('storename', 'Nama Store', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Kas', 'trim|required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "kas/tambah");
			return;
		}

		$tanggal	    = $this->security->xss_clean($this->input->post('tanggal'));
		$storename	    = $this->security->xss_clean($this->input->post('storename'));
		$jenis	    	= $this->security->xss_clean($this->input->post('jenis'));
		$nominal	    = $this->security->xss_clean($this->input->post('nominal'));
		$keterangan		= $this->security->xss_clean($this->input->post('keterangan'));


		$data		= array(
			"tanggal"     	=> date("Y-m-d H:i:s"),
			"store_id"     	=> $storename,
			"jenis"			=> $jenis,
			"nominal"		=> $nominal,
			"keterangan" 	=> $keterangan,
			"userid"		=> $_SESSION["logged_status"]["username"]
		);

		// print_r(json_encode($data));
		// die;

		// Checking Success and Error AddData
		$result		= $this->kas->insertData($data);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";



		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->success_msg());
			redirect(base_url() . "kas");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "kas/tambah");
			return;
		}
	}

	public function ubah()
	{

		// Menampilkan Hasil Single Data ketika di click username tertentu sebagai parameter
		// $result		= $this->PenggunaModel->getUser($username);

		$result = array(
			"namaitems"	    => "Dupa Wangi",
			"local"			=> "1000000",
			"domestik"		=> "2000000",
			"internasional"	=> "3000000",
		);

		$data		= array(
			'title'		 => 'Ubah Data Pengguna',
			'content'    => 'items/ubah',
			'detail'     => $result,
			'mn_master'	 => 'active',
			'colmas'	 => 'collapse',
			'colset'	 => 'collapse in',
			'collap'	 => 'collapse',
			'side4'		 => 'active',
			'breadcrumb' => '/ Setup / Items / Ubah Data'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function updateData()
	{
		$this->form_validation->set_rules('namaitems', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('local', 'Harga Local', 'trim|required');
		$this->form_validation->set_rules('domestik', 'Harga Domestik', 'trim|required');
		$this->form_validation->set_rules('internasional', 'Harga Internasional', 'trim|required');

		$id	= $this->security->xss_clean($this->input->post('id'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', $this->message->error_msg(validation_errors()));
			redirect(base_url() . "items/ubah/" . base64_encode($id));
			return;
		}

		$namaitems	= $this->security->xss_clean($this->input->post('namaitems'));
		$local	    	= $this->security->xss_clean($this->input->post('local'));
		$domestik	    = $this->security->xss_clean($this->input->post('domestik'));
		$internasional	= $this->security->xss_clean($this->input->post('internasional'));

		$data	= array(
			"namaitems"      	=> $namaitems,
			"local"      		=> $local,
			"domestik"     	 	=> $domestik,
			"internasional"     => $internasional,
		);

		// print_r(json_encode($data));
		// die;


		// $result		= $this->PenggunaModel->updateData($data,$username);
		//untuk cek sukses atau gagal dengan cara menambahkan array result

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di inputkan";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message',  $this->message->success_msg());
			redirect(base_url() . "items");
			return;
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items/ubah/" . base64_encode($id));
			return;
		}
	}

	public function DelData($id)
	{
		$data		= array(
			"status"  => 1,
		);

		$id	= base64_decode($this->security->xss_clean($id));
		// $result		= $this->PenggunaModel->hapusData($data,$username);

		// untuk sukses
		// $result["code"]=0;

		//untuk gagal
		// $result["code"]=5011;
		// $result["message"]="Data gagal di Dihapus";

		if ($result["code"] == 0) {
			$this->session->set_flashdata('message', $this->message->delete_msg());
			redirect(base_url() . "items");
		} else {
			$this->session->set_flashdata('message', $this->message->error_msg($result["message"]));
			redirect(base_url() . "items");
		}
	}

	// ====== END KAS =====


	// ====== START REKAPAN HARIAN =====
	public function tutupharian()
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
			'title'		 => 'Rekapan Harian',
			'content'	 => 'kas/tutupharian',
			'extra'		 => 'kas/js/js_tutupharian',
			'side14'	 => 'active',
			// 'colmas_lp'	 => 'hover show',
			'breadcrumb' => 'Rekapan Harian /',
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
	// ====== END REKAPAN HARIAN =====

	// ====== START REKAPAN HARIAN GUIDE =====
	public function tutupharianguide()
	{
		if (@!isset($_GET["tgl"])) {
			$tgl = date("d M Y");
			$tglcari = date("Y-m-d");
		} else {
			$tgl     = $this->security->xss_clean($_GET["tgl"]);
			$tglcari = date_format(date_create($tgl), "Y-m-d");
		}

		$result = $this->kas->laporanHarian($tglcari);

		$uniqueguide = array();

		foreach ($result as $byMehtod) {
			if ($byMehtod['guide_id'] != NULL) {
				$uniqueguide[$byMehtod['guide_id']] = $byMehtod;
			}
		}

		$guide = array_values($uniqueguide);

		$data	= array(
			'title'		 => 'Rekapan Harian Guide',
			'content'	 => 'kas/tutupharian-guide',
			'extra'		 => 'kas/js/js_tutupharian',
			'side15'	 => 'active',
			'breadcrumb' => 'Rekapan Harian Guide/',
			'penjualan'  => $result,
			'tgl'        => $tgl,
			'guide'        => $guide,
		);
		$this->load->view('layout/wrapper', $data);
	}
	// ====== END REKAPAN HARIAN GUIDE =====

	// ====== START REKAPAN HARIAN PENGAYAH =====
	public function tutupharianpengayah()
	{
		if (@!isset($_GET["tgl"])) {
			$tgl = date("d M Y");
			$tglcari = date("Y-m-d");
		} else {
			$tgl     = $this->security->xss_clean($_GET["tgl"]);
			$tglcari = date_format(date_create($tgl), "Y-m-d");
		}

		$result = $this->kas->laporanHarian($tglcari);

		$uniquepengayah = array();

		foreach ($result as $byMehtod) {
			if ($byMehtod['pengayah_id'] != NULL) {
				$uniquepengayah[$byMehtod['pengayah_id']] = $byMehtod;
			}
		}

		$pengayah = array_values($uniquepengayah);

		$data	= array(
			'title'		 => 'Rekapan Harian Pengayah',
			'content'	 => 'kas/tutupharian-pengayah',
			'extra'		 => 'kas/js/js_tutupharian',
			'side16'	 => 'active',
			'breadcrumb' => 'Rekapan Harian Pengayah/',
			'penjualan'  => $result,
			'tgl'        => $tgl,
			'pengayah'        => $pengayah,
		);
		$this->load->view('layout/wrapper', $data);
	}
	// ====== END REKAPAN HARIAN PENGAYAH =====

	public function testing()
	{
		if (@!isset($_GET["tgl"])) {
			$tgl = date("d M Y");
			$tglcari = date("Y-m-d");
		} else {
			$tgl     = $this->security->xss_clean($_GET["tgl"]);
			$tglcari = date_format(date_create($tgl), "Y-m-d");
		}

		$result = $this->kas->laporanHarian("2023-05-17");

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

		// echo "<br>";
		// echo "Penjualan Items <br>";
		// $total_PJ_items = 0;
		// foreach ($items as $byBarang) {
		//     $jmlBarang = 0;
		//     $totalHargaBarang = 0;
		//     foreach ($result as $dt) {
		//         if ($dt['jml'] == '0') {
		//             $jml = 1;
		//         } else {
		//             $jml = $dt['jml'];
		//         }

		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             $jmlBarang += $jml;
		//         }
		//     }

		//     foreach ($result as $dt) {
		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             if ($dt['jns'] == 'LOKAL') {
		//                 $totalHargaBarang += $dt['lokal'];
		//             } elseif ($dt['jns'] == 'DOMESTIK') {
		//                 $totalHargaBarang += $dt['domestik'];
		//             } else {
		//                 $totalHargaBarang += $dt['internasional'];
		//             }
		//         }
		//     }

		//     echo $byBarang['namaitem'] . " x " . $jmlBarang . " = " . $totalHargaBarang . "<br>";
		//     $total_PJ_items += $totalHargaBarang;
		// }
		// echo "Total Penjualan Items = " . $total_PJ_items . "<br>";

		// echo "<br>";
		// echo "Penjualan Produk <br>";
		// $total_PJ_Produk = 0;
		// foreach ($produk as $byBarang) {
		//     $jmlBarang = 0;
		//     $totalHargaBarang = 0;
		//     foreach ($result as $dt) {
		//         if ($dt['jml'] == '0') {
		//             $jml = 1;
		//         } else {
		//             $jml = $dt['jml'];
		//         }

		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             $jmlBarang += $jml;
		//         }
		//     }

		//     foreach ($result as $dt) {
		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             if ($dt['jns'] == 'LOKAL') {
		//                 $totalHargaBarang += $dt['lokal'];
		//             } elseif ($dt['jns'] == 'DOMESTIK') {
		//                 $totalHargaBarang += $dt['domestik'];
		//             } else {
		//                 $totalHargaBarang += $dt['internasional'];
		//             }
		//         }
		//     }

		//     echo $byBarang['namaitem'] . " x " . $jmlBarang . " = " . $totalHargaBarang . "<br>";
		//     $total_PJ_Produk += $totalHargaBarang;
		// }
		// echo "Total Penjualan Produk = " . $total_PJ_Produk . "<br>";

		// echo "<br>";
		// echo "Penjualan Paket <br>";
		// $total_PJ_Paket = 0;
		// foreach ($paket as $byBarang) {
		//     $jmlBarang = 0;
		//     $totalHargaBarang = 0;
		//     foreach ($result as $dt) {
		//         if ($dt['jml'] == '0') {
		//             $jml = 1;
		//         } else {
		//             $jml = $dt['jml'];
		//         }

		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             $jmlBarang += $jml;
		//         }
		//     }

		//     foreach ($result as $dt) {
		//         if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
		//             if ($dt['jns'] == 'LOKAL') {
		//                 $totalHargaBarang += $dt['lokal'];
		//             } elseif ($dt['jns'] == 'DOMESTIK') {
		//                 $totalHargaBarang += $dt['domestik'];
		//             } else {
		//                 $totalHargaBarang += $dt['internasional'];
		//             }
		//         }
		//     }

		//     echo $byBarang['namaitem'] . " x " . $jmlBarang . " = " . $totalHargaBarang . "<br>";
		//     $total_PJ_Paket += $totalHargaBarang;
		// }
		// echo "Total Penjualan Paket = " . $total_PJ_Paket . "<br>";
	}
}
