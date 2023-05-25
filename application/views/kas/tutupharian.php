<div class="d-flex flex-column flex-column-fluid">
    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10 justify-content-center">
                <!-- ====== Start Tambah Brand ====== -->
                <?php if (isset($_SESSION["message"])) { ?>
                    <div class="alert alert-success"><?= $_SESSION["message"] ?></div>
                <?php } ?>
                <?php if (isset($_SESSION["gagal"])) { ?>
                    <div class="alert alert-danger"><?= $_SESSION["gagal"] ?></div>
                <?php } ?>

                <div class="col-md-8 card">
                    <div class="card-body">
                        <form action="<?= base_url() ?>kas/tutupharian/" method="get">
                            <div class="row form-group">
                                <label class="col-form-label col">Tanggal</label>
                                <div class="col">
                                    <input type="text" id="tgl" name="tgl" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-20" id="printarea">
                            <div class="col text-start mb-5">
                                <h3>Laporan Penjualan Harian</h3>
                            </div>

                            <hr>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?= $tgl ?></label>
                                    </div>
                                </div>
                                <div class="form-group my-5">
                                    <div class="d-flex justify-content-between align-items-center px-2">
                                        <label class="col-form-label col-5"><b>CASH</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?= number_format($cash) ?></b></label>
                                    </div>
                                </div>
                                <div class="form-group my-5">
                                    <div class="d-flex justify-content-between align-items-center px-2">
                                        <label class="col-form-label col-5"><b>CARD</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?= number_format($card) ?></b></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN SOUVENIR</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $total_PJ_items = 0;
                                        foreach ($items as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            $hrgBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }

                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $hrgBarang = $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $hrgBarang = $dt['domestik'];
                                                    } else {
                                                        $hrgBarang = $dt['internasional'];
                                                    }
                                                }
                                            }

                                            $total_PJ_items += $totalHargaBarang;
                                            if ($byBarang['id_reservasi'] == NULL) {
                                        ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?> <i>(Reservasi)</i></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN SOUVENIR</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_items) ?></b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN PRODUK</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $total_PJ_Produk = 0;
                                        foreach ($produk as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            $hrgBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }

                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $hrgBarang = $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $hrgBarang = $dt['domestik'];
                                                    } else {
                                                        $hrgBarang = $dt['internasional'];
                                                    }
                                                }
                                            }
                                            $total_PJ_Produk += $totalHargaBarang;
                                            if ($byBarang['id_reservasi'] == NULL) {
                                        ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?> <i>(Reservasi)</i></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN PRODUK</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_Produk) ?></b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN PAKET</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $total_PJ_Paket = 0;
                                        foreach ($paket as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            $hrgBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_barang'] == $byBarang['id_barang'] && $dt['jenis'] == $byBarang['jenis'] && $dt['id_reservasi'] == $byBarang['id_reservasi']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }

                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $hrgBarang = $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $hrgBarang = $dt['domestik'];
                                                    } else {
                                                        $hrgBarang = $dt['internasional'];
                                                    }
                                                }
                                            }

                                            $total_PJ_Paket += $totalHargaBarang;
                                            if ($byBarang['id_reservasi'] == NULL) {
                                        ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?> <i>(Reservasi)</i></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5"> - <?= $byBarang['namabarang'] ?></label>
                                                    <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN PAKET</b></label>
                                            <?php if (!empty($paket)) { ?>
                                                <label class="col-form-label col"><b>Satuan</b></label>
                                            <?php } ?>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_Paket) ?></b></label>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($storeUniq)) { ?>
                                    <div class="col-sm-12 my-5">
                                        <div class="d-flex flex-column">
                                            <?php
                                            foreach ($storeUniq as $showStore) {
                                                $totalKasStore = 0;
                                                foreach ($store as $dtKas) {
                                                    if ($dtKas['store_id'] == $showStore['store_id']) {
                                                        if ($dtKas['jenis'] == 'Kas Awal' || $dtKas['jenis'] == 'Masuk') {
                                                            $totalKasStore += $dtKas['nominal'];
                                                        } elseif ($dtKas['jenis'] == 'Keluar') {
                                                            $totalKasStore -= $dtKas['nominal'];
                                                        }
                                                    }
                                                }
                                            ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5 text-uppercase"><b><?= $showStore['store'] ?></b></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($totalKasStore) ?></label>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($guide)) { ?>
                                    <div class="col-sm-12 my-5">
                                        <div class="d-flex flex-column">
                                            <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                <label class="col-form-label col-5"><b>KOMISI GUIDE</b></label>
                                            </div>
                                            <?php
                                            $total_komisi_guide = 0;
                                            foreach ($guide as $dtguide) {
                                                $komisi = 0;
                                                foreach ($penjualan as $dt) {
                                                    $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                    if ($dtguide['guide_id'] == $dt['guide_id']) {
                                                        if ($dt['jns'] == 'LOKAL') {
                                                            $komisi += ($dt['komisi_guide_lokal'] * $jmlBarang);
                                                        } elseif ($dt['jns'] == 'DOMESTIK') {
                                                            $komisi += ($dt['komisi_guide_domestik'] * $jmlBarang);
                                                        } else {
                                                            if ($dt['jenis'] == 'produk' || $dt['jenis'] == 'paket') {
                                                                if ($dt['pengayah_id'] == NULL) {
                                                                    if ($dt['is_double'] == 'yes') {
                                                                        $komisi += (($dt['komisi_guide_internasional'] * 2) * $jmlBarang);
                                                                    } else {
                                                                        $komisi += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                    }
                                                                } else {
                                                                    $komisi += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                }
                                                            } else {
                                                                $komisi += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($komisi != 0) {
                                            ?>
                                                    <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                                        <label class="col-form-label col-5">- <?= $dtguide['nama_guide'] ?></label>
                                                        <label class="col-form-label pe-2 text-right"><?= number_format($komisi) ?></label>
                                                    </div>
                                            <?php
                                                }
                                                $total_komisi_guide += $komisi;
                                            }
                                            ?>
                                            <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                <label class="col-form-label col-5"><b>TOTAL KOMISI GUIDE</b></label>
                                                <label class="col-form-label pe-2 text-right"><b><?= number_format($total_komisi_guide) ?></b></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($pengayah)) { ?>
                                    <div class="col-sm-12 my-5">
                                        <div class="d-flex flex-column">
                                            <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                <label class="col-form-label col-5"><b>KOMISI PENGAYAH</b></label>
                                            </div>
                                            <?php
                                            $total_komisi_pengayah = 0;
                                            foreach ($pengayah as $dtpengayah) {
                                                $komisi = 0;
                                                foreach ($penjualan as $dt) {
                                                    $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                    if ($dtpengayah['pengayah_id'] == $dt['pengayah_id']) {
                                                        if ($dt['jns'] == 'LOKAL') {
                                                            $komisi += ($dt['komisi_pengayah_lokal'] * $jmlBarang);
                                                        } elseif ($dt['jns'] == 'DOMESTIK') {
                                                            $komisi += ($dt['komisi_pengayah_domestik'] * $jmlBarang);
                                                        } else {
                                                            $komisi += ($dt['komisi_pengayah_internasional'] * $jmlBarang);
                                                        }
                                                    }
                                                }
                                                if ($komisi != 0) {
                                            ?>
                                                    <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                                        <label class="col-form-label col-5">- <?= $dtpengayah['nama_pengayah'] ?></label>
                                                        <label class="col-form-label pe-2 text-right"><?= number_format($komisi) ?></label>
                                                    </div>
                                            <?php
                                                }
                                                $total_komisi_pengayah += $komisi;
                                            }
                                            ?>

                                            <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                <label class="col-form-label col-5"><b>TOTALKOMISI PENGAYAH</b></label>
                                                <label class="col-form-label pe-2 text-right"><b><?= number_format($total_komisi_pengayah) ?></b></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== End Tambah Brand ====== -->

            </div>
            <!-- ======= End Row Content Canva JS ====== -->
        </div>
        <!-- ======= End Content container ======== -->
    </div>
    <!-- ====== End Content ====== -->
</div>