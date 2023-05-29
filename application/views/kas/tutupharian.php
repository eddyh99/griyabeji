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

                <div class="col-lg-10 card">
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

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <table id="harian" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="text-start"></th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold">CASH</td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"><?= number_format($cash) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">CARD</td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"><?= number_format($cash) ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold">PENJUALAN SOUVENIR</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>
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
                                                ?>
                                                    <tr>
                                                        <td class="ps-5">
                                                            - <?= $byBarang['namabarang'] ?>
                                                            <?= ($byBarang['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="text-start"><?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></td>
                                                        <td class="text-end fw-bold"><?= number_format($totalHargaBarang) ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td class="fw-bold">TOTAL PENJUALAN SOUVENIR</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"><?= number_format($total_PJ_items) ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold">PENJUALAN PRODUK</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>
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
                                                ?>
                                                    <tr>
                                                        <td class="ps-5">
                                                            - <?= $byBarang['namabarang'] ?>
                                                            <?= ($byBarang['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="text-start"><?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></td>
                                                        <td class="text-end fw-bold"><?= number_format($totalHargaBarang) ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td class="fw-bold">TOTAL PENJUALAN PRODUK</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"><?= number_format($total_PJ_items) ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold">PENJUALAN PAKET</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>
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
                                                ?>
                                                    <tr>
                                                        <td class="ps-5">
                                                            - <?= $byBarang['namabarang'] ?>
                                                            <?= ($byBarang['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="text-start"><?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></td>
                                                        <td class="text-end fw-bold"><?= number_format($totalHargaBarang) ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td class="fw-bold">TOTAL PENJUALAN PAKET</td>
                                                    <td class="text-start fw-bold"><?= (!empty($paket)) ? 'Satuan' : ''; ?></td>
                                                    <td class="text-end fw-bold"><?= number_format($total_PJ_items) ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <?php if (!empty($storeUniq)) { ?>
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
                                                        <tr>
                                                            <td class="ps-5 fw-bold"><?= $showStore['store'] ?></td>
                                                            <td class="text-start"></td>
                                                            <td class="text-end fw-bold"><?= number_format($totalKasStore) ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                <?php } ?>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <?php if (!empty($guide)) { ?>
                                                    <tr>
                                                        <td class="fw-bold">KOMISI GUIDE</td>
                                                        <td class="text-start fw-bold"></td>
                                                        <td class="text-end fw-bold"></td>
                                                    </tr>
                                                <?php } ?>
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
                                                        <tr>
                                                            <td class="ps-5">
                                                                - <?= $dtguide['nama_guide'] ?>
                                                            </td>
                                                            <td class="text-start"></td>
                                                            <td class="text-end fw-bold"><?= number_format($komisi) ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                    $total_komisi_guide += $komisi;
                                                }
                                                ?>
                                                <?php if (!empty($guide)) { ?>
                                                    <tr>
                                                        <td class="fw-bold">TOTAL KOMISI GUIDE</td>
                                                        <td class="text-start fw-bold"></td>
                                                        <td class="text-end fw-bold"><?= number_format($total_komisi_guide) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td class="fw-bold"></td>
                                                    <td class="text-start"></td>
                                                    <td class="text-end fw-bold"></td>
                                                </tr>

                                                <?php if (!empty($pengayah)) { ?>
                                                    <tr>
                                                        <td class="fw-bold">KOMISI PENGAYAH</td>
                                                        <td class="text-start fw-bold"></td>
                                                        <td class="text-end fw-bold"></td>
                                                    </tr>
                                                <?php } ?>
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
                                                        <tr>
                                                            <td class="ps-5">
                                                                - <?= $dtguide['nama_guide'] ?>
                                                            </td>
                                                            <td class="text-start"></td>
                                                            <td class="text-end fw-bold"><?= number_format($komisi) ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                    $total_komisi_pengayah += $komisi;
                                                }
                                                ?>
                                                <?php if (!empty($pengayah)) { ?>
                                                    <tr>
                                                        <td class="fw-bold">TOTAL KOMISI PENGAYAH</td>
                                                        <td class="text-start fw-bold"></td>
                                                        <td class="text-end fw-bold"><?= number_format($total_komisi_pengayah) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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