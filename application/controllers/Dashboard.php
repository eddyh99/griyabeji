<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect("/");
        }

        $this->load->model('admin/mdl_kas', "kas");
    }

    public function index()
    {
        $data = array(
            'title'         => 'Dashboard Area',
            'content'     => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/js_index',
            'mn_dash'     => 'active',
            'breadcrumb' => '/ Dashboard'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function penjualan()
    {
        $tanggal_awal       = date("Y-m-d", strtotime("first day of 0 month"));
        $tanggal_akhir      = date("Y-m-d", strtotime("last day of 0 month"));

        $result = $this->kas->getpenjualan($tanggal_awal, $tanggal_akhir);

        $uniquetanggal = array();

        foreach ($result as $dt) {
            $uniquetanggal[date("d", strtotime($dt['tanggal']))] = $dt;
        }

        $tanggal = array_values($uniquetanggal);

        $mdata = array();
        foreach ($tanggal as $dtByTanggal) {
            $penjualan = 0;
            foreach ($result as $dt) {
                $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                if (date("d", strtotime($dtByTanggal['tanggal'])) == date("d", strtotime($dt['tanggal']))) {
                    if ($dt['jns'] == 'LOKAL') {
                        $penjualan += ($dt['lokal'] * $jmlBarang);
                    } elseif ($dt['jns'] == 'DOMESTIK') {
                        $penjualan += ($dt['domestik'] * $jmlBarang);
                    } else {
                        $penjualan += ($dt['internasional'] * $jmlBarang);
                    }
                }
            }

            $temp['label'] = date("d", strtotime($dtByTanggal['tanggal']));
            $temp['y'] = $penjualan;

            array_push($mdata, $temp);
        }

        // print("<pre>" . print_r($listCountry, true) . "</pre>");
        // die;

        if (count($mdata) == 0) {
            $data = 0;
        } else {
            $data = $mdata;
        }
        echo json_encode($data);
    }

    public function topCountry()
    {
        $tanggal_awal       = date("Y-m-d", strtotime("first day of 0 month"));
        $tanggal_akhir      = date("Y-m-d", strtotime("last day of 0 month"));

        $result = $this->kas->getpenjualan($tanggal_awal, $tanggal_akhir);

        $uniqueCountry = array();
        $uniqueproduk = array();
        $uniqueproduknCountry = array();

        foreach ($result as $dt) {
            $uniqueCountry[$dt['country_code']] = $dt;

            if ($dt['jenis'] == 'produk') {
                $uniqueproduk[$dt['id_barang'] . $dt['country_code']] = $dt;
            }

            if ($dt['jenis'] == 'produk') {
                $uniqueproduknCountry[$dt['id_barang']] = $dt;
            }
        }

        $country = array_values($uniqueCountry);
        $produk = array_values($uniqueproduk);
        $produknCountry = array_values($uniqueproduknCountry);

        $countryDESC = array();
        foreach ($country as $ct) {
            $tempDESC['countryname'] = $ct['countryname'];
            $tempDESC['country_code'] = $ct['country_code'];
            $jumlahBarang = 0;
            foreach ($produk as $br) {
                if ($br['country_code'] == $ct['country_code']) {
                    foreach ($result as $dt) {
                        if (
                            $dt['jenis'] == 'produk' &&
                            $dt['id_barang'] == $br['id_barang'] &&
                            $dt['country_code'] == $ct['country_code']
                        ) {
                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                            $jumlahBarang += $jmlBarang;
                        }
                    }
                }
            }
            $tempDESC['jumlah'] = $jumlahBarang;
            array_push($countryDESC, $tempDESC);
        }

        $produkDESC = array();
        foreach ($produknCountry as $pd) {
            $tempPdDESC['id_barang'] = $pd['id_barang'];
            $tempPdDESC['namabarang'] = $pd['namabarang'];

            $jumlahBarang = 0;
            foreach ($result as $dt) {
                if ($dt['jenis'] == 'produk' && $dt['id_barang'] == $pd['id_barang']) {
                    $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                    $jumlahBarang += $jmlBarang;
                }
            }
            $tempPdDESC['jumlah'] = $jumlahBarang;
            array_push($produkDESC, $tempPdDESC);
        }

        // Urutkan Terbanyak
        $byJumlahCountry = array_column($countryDESC, 'jumlah');
        array_multisort($byJumlahCountry, SORT_DESC, $countryDESC);

        // Urutkan Terbanyak
        $byJumlahProduk = array_column($produkDESC, 'jumlah');
        array_multisort($byJumlahProduk, SORT_DESC, $produkDESC);

        $listCountry = array();
        $top10 = 1;
        foreach ($countryDESC as $ct) {
            $temp['type'] = "column";
            $temp['name'] = $ct['countryname'];
            $temp['showInLegend'] = true;

            $produkByCountry = array();

            $top10PD = 1;
            foreach ($produkDESC as $brUnq) {
                foreach ($produk as $br) {
                    if ($brUnq['id_barang'] == $br['id_barang']) {
                        $jumlahBarang = 0;
                        if ($br['country_code'] == $ct['country_code']) {
                            foreach ($result as $dt) {
                                if (
                                    $dt['jenis'] == 'produk' &&
                                    $dt['id_barang'] == $br['id_barang'] &&
                                    $dt['country_code'] == $ct['country_code']
                                ) {
                                    $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                    $jumlahBarang += $jmlBarang;
                                }
                            }
                            $temp2['label'] = $br['namabarang'];
                            $temp2['y'] = $jumlahBarang;
                            array_push($produkByCountry, $temp2);
                        }
                    }
                }
                if ($top10PD++ == 10) {
                    break;
                }
            }
            $temp['dataPoints'] = $produkByCountry;

            array_push($listCountry, $temp);

            if ($top10++ == 10) {
                break;
            }
        }

        // print("<pre>" . print_r($listCountry, true) . "</pre>");
        // die;

        if (count($listCountry) == 0) {
            $data = 0;
        } else {
            $data = $listCountry;
        }
        echo json_encode($data);
    }
}
