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
                        <div class="row" id="printarea">
                            <div class="col text-start mb-5">
                                <h3>Laporan Penjualan</h3>
                            </div>

                            <hr>

                            <?php
                            $totalPenjualan = 0;
                            foreach ($penjualan as $pj) {
                                if ($pj['id'] == $id) {
                                    $komisi = 0;
                                    $cost = 0;
                                    $laba = 0;
                                    $penjualan = 0;
                                    $idTransaksi = $pj['id'] . date("Ymd", strtotime($pj['tanggal']));

                                    if ($pj['pengayah_id'] != NULL) {
                                        foreach ($data as $dt) {
                                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                            if ($pj['pengayah_id'] == $dt['pengayah_id'] && $pj['id'] == $dt['id']) {
                                                if ($dt['jns'] == 'LOKAL') {
                                                    $komisi += ($dt['komisi_pengayah_lokal'] * $jmlBarang);
                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                    $komisi += ($dt['komisi_pengayah_domestik'] * $jmlBarang);
                                                } else {
                                                    $komisi += ($dt['komisi_pengayah_internasional'] * $jmlBarang);
                                                }
                                            }
                                        }
                                    }

                                    if ($pj['guide_id'] != NULL) {
                                        foreach ($data as $dt) {
                                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                            if ($pj['guide_id'] == $dt['guide_id'] && $pj['id'] == $dt['id']) {
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
                                    }
									
                                    //print("<pre>" . print_r($data, true) . "</pre>");

                                    foreach ($data as $dt) {
                                        if ($dt['id'] == $pj['id']) {
                                            if ($dt['jns'] == 'LOKAL') {
                                                $penjualan += ($dt['lokal'] * $jmlBarang);
                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                $penjualan += ($dt['domestik'] * $jmlBarang);
                                            } else {
                                                $penjualan += ($dt['internasional'] * $jmlBarang);
                                            }

                                            if ($dt['jenis'] == 'items') {
                                                $cost += ($dt['hpp'] * $jmlBarang);
                                            }

                                            if ($dt['jenis'] == 'produk') {
                                                foreach ($listItemsbyProduk as $produk) {
                                                    if ($dt['id'] == $produk['id'] && $dt['id_reservasi'] == $produk['id_reservasi'] && $dt['id_barang'] == $produk['id_barang']) {
                                                        foreach ($produk['items'] as $item) {
                                                            $cost += ($item['hpp'] * $jmlBarang);
                                                        }
                                                    }
                                                }
                                            }
                                            if ($dt['jenis'] == 'paket') {
                                                foreach ($listItemsbyPaket as $paket) {                                                    
                                                    if ($dt['id'] == $paket['id'] && $dt['id_reservasi'] == $paket['id_reservasi'] && $dt['id_barang'] == $paket['id_barang']) {
                                                        foreach ($paket['produk'] as $produk) {
                                                            foreach ($produk['items'] as $item) {
                                                                $cost += ($item['hpp'] * $jmlBarang);                                                                
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                                                       
                                    $laba = $penjualan - $komisi - $cost;
                                    // $laba = $penjualan;
                                    $totalPenjualan += $laba;
                            ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center">
                                                <label class="col-form-label me-5">ID</label>
                                                <label class="col-form-label me-2">: </label>
                                                <label class="col-form-label"><?= $pj['id'] . date("Ymd", strtotime($pj['tanggal'])) ?></label>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <label class="col-form-label me-5">Komisi</label>
                                                <label class="col-form-label me-2">: </label>
                                                <label class="col-form-label"><?= number_format($komisi) ?></label>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <label class="col-form-label me-5">Cost</label>
                                                <label class="col-form-label me-2">: </label>
                                                <label class="col-form-label"><?= number_format($cost) ?></label>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <label class="col-form-label me-5">Laba</label>
                                                <label class="col-form-label me-2">: </label>
                                                <label class="col-form-label"><?= number_format($laba) ?></label>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 my-5">
                                            <div class="d-flex flex-column">
                                                <table id="detail" class="table" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Pesanan</th>
                                                            <th>Jenis</th>
                                                            <th class="text-center">Jumlah</th>
                                                            <th class="text-end">Komisi</th>
                                                            <th class="text-end">Cost</th>
                                                            <th class="text-end">Laba</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($list_items as $br) {
                                                            if ($br['id'] == $id) {
                                                                $komisibarang = 0;
                                                                if ($pj['pengayah_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $br['pengayah_id'] == $dt['pengayah_id']
                                                                            && $br['id'] == $dt['id']
                                                                            && $br['id_barang'] == $dt['id_barang']
                                                                            && $br['jenis'] == $dt['jenis']
                                                                            && $br['id_reservasi'] == $dt['id_reservasi']
                                                                        ) {
                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_pengayah_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_pengayah_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                $komisibarang += ($dt['komisi_pengayah_internasional'] * $jmlBarang);
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                if ($pj['guide_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $br['guide_id'] == $dt['guide_id']
                                                                            && $br['id'] == $dt['id']
                                                                            && $br['id_barang'] == $dt['id_barang']
                                                                            && $br['jenis'] == $dt['jenis']
                                                                            && $br['id_reservasi'] == $dt['id_reservasi']
                                                                        ) {
                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_guide_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_guide_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                if ($dt['jenis'] == 'produk' || $dt['jenis'] == 'paket') {
                                                                                    if ($dt['pengayah_id'] == NULL) {
                                                                                        if ($dt['is_double'] == 'yes') {
                                                                                            $komisibarang += (($dt['komisi_guide_internasional'] * 2) * $jmlBarang);
                                                                                        } else {
                                                                                            $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                        }
                                                                                    } else {
                                                                                        $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                    }
                                                                                } else {
                                                                                    $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                $penjualanBarang = 0;
                                                                $jumlahBarang = 0;
                                                                foreach ($data as $dt) {
                                                                    if (
                                                                        $dt['id'] == $id
                                                                        && $br['id_barang'] == $dt['id_barang']
                                                                        && $br['jenis'] == $dt['jenis']
                                                                        && $br['id_reservasi'] == $dt['id_reservasi']
                                                                        && $br['jns'] == $dt['jns']
                                                                    ) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];

                                                                        if ($dt['jns'] == 'LOKAL') {
                                                                            $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                        } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                            $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                        } else {
                                                                            $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                        }
                                                                        $jumlahBarang += $jmlBarang;
                                                                    }
                                                                }

                                                        ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $br['namabarang']; ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                                        <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                                    </td>
                                                                    <td class="pe-0"><?= ($br['jenis'] == 'items') ? ' <i>Souvenir</i> ' : ''; ?></td>
                                                                    <td class="text-center pe-0"><?= $jumlahBarang; ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($komisibarang); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($br['hpp']); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($penjualanBarang - $br['hpp'] - $komisibarang); ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        foreach ($list_produk as $br) {
                                                            if ($br['id'] == $id) {
                                                                $komisibarang = 0;
                                                                if ($pj['pengayah_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $dt['pengayah_id'] == $br['pengayah_id']
                                                                            && $dt['id'] == $br['id']
                                                                            && $dt['id_barang'] == $br['id_barang']
                                                                            && $dt['jenis'] == $br['jenis']
                                                                            && $dt['id_reservasi'] == $br['id_reservasi']
                                                                        ) {
                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_pengayah_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_pengayah_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                $komisibarang += ($dt['komisi_pengayah_internasional'] * $jmlBarang);
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                if ($pj['guide_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $dt['guide_id'] == $br['guide_id']
                                                                            && $dt['id'] == $br['id']
                                                                            && $dt['id_barang'] == $br['id_barang']
                                                                            && $dt['jenis'] == $br['jenis']
                                                                            && $dt['id_reservasi'] == $br['id_reservasi']
                                                                        ) {

                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_guide_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_guide_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                if ($dt['jenis'] == 'produk' || $dt['jenis'] == 'paket') {
                                                                                    if ($dt['pengayah_id'] == NULL) {
                                                                                        if ($dt['is_double'] == 'yes') {
                                                                                            $komisibarang += (($dt['komisi_guide_internasional'] * 2) * $jmlBarang);
                                                                                        } else {
                                                                                            $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                        }
                                                                                    } else {
                                                                                        $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                    }
                                                                                } else {
                                                                                    $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                $penjualanBarang = 0;
                                                                $jumlahBarang = 0;
                                                                $costBarang = 0;
                                                                foreach ($data as $dt) {
                                                                    if (
                                                                        $dt['id'] == $id
                                                                        && $dt['id_barang'] == $br['id_barang']
                                                                        && $dt['jenis'] == $br['jenis']
                                                                        && $dt['id_reservasi'] == $br['id_reservasi']
                                                                    ) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        $jumlahBarang += $jmlBarang;

                                                                        foreach ($listItemsbyProduk as $produk) {
                                                                            if ($dt['id'] == $produk['id'] && $dt['id_reservasi'] == $produk['id_reservasi'] && $dt['id_barang'] == $produk['id_barang']) {
                                                                                if ($dt['jns'] == 'LOKAL') {
                                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                                } else {
                                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                                }

                                                                                foreach ($produk['items'] as $item) {
                                                                                    $costBarang += ($item['hpp'] * $jmlBarang);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                        ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $br['namabarang']; ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                                        <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                                    </td>
                                                                    <td class="pe-0"><i><?= $br['jenis']; ?></i></td>
                                                                    <td class="text-center pe-0"><?= $jumlahBarang; ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($komisibarang); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($costBarang); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($penjualanBarang - $costBarang - $komisibarang); ?></td>
                                                                </tr>
                                                        <?php }
                                                        }
                                                        ?>

                                                        <?php
                                                        foreach ($list_paket as $br) {
                                                            if ($br['id'] == $id) {
                                                                $komisibarang = 0;
                                                                if ($pj['pengayah_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $dt['pengayah_id'] == $br['pengayah_id']
                                                                            && $dt['id'] == $br['id']
                                                                            && $dt['id_barang'] == $br['id_barang']
                                                                            && $dt['jenis'] == $br['jenis']
                                                                            && $dt['id_reservasi'] == $br['id_reservasi']
                                                                        ) {
                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_pengayah_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_pengayah_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                $komisibarang += ($dt['komisi_pengayah_internasional'] * $jmlBarang);
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                if ($pj['guide_id'] != NULL) {
                                                                    foreach ($data as $dt) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        if (
                                                                            $dt['guide_id'] == $br['guide_id']
                                                                            && $dt['id'] == $br['id']
                                                                            && $dt['id_barang'] == $br['id_barang']
                                                                            && $dt['jenis'] == $br['jenis']
                                                                            && $dt['id_reservasi'] == $br['id_reservasi']
                                                                        ) {
                                                                            if ($dt['jns'] == 'LOKAL') {
                                                                                $komisibarang += ($dt['komisi_guide_lokal'] * $jmlBarang);
                                                                            } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                $komisibarang += ($dt['komisi_guide_domestik'] * $jmlBarang);
                                                                            } else {
                                                                                if ($dt['jenis'] == 'produk' || $dt['jenis'] == 'paket') {
                                                                                    if ($dt['pengayah_id'] == NULL) {
                                                                                        if ($dt['is_double'] == 'yes') {
                                                                                            $komisibarang += (($dt['komisi_guide_internasional'] * 2) * $jmlBarang);
                                                                                        } else {
                                                                                            $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                        }
                                                                                    } else {
                                                                                        $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                    }
                                                                                } else {
                                                                                    $komisibarang += ($dt['komisi_guide_internasional'] * $jmlBarang);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                $penjualanBarang = 0;
                                                                $jumlahBarang = 0;
                                                                $costBarang = 0;
                                                                foreach ($data as $dt) {
                                                                    if (
                                                                        $dt['id'] == $id
                                                                        && $dt['id_barang'] == $br['id_barang']
                                                                        && $dt['jenis'] == $br['jenis']
                                                                        && $dt['id_reservasi'] == $br['id_reservasi']
                                                                    ) {
                                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                        $jumlahBarang += $jmlBarang;

                                                                        foreach ($listItemsbyPaket as $paket) {
                                                                            if ($dt['id'] == $paket['id'] && $dt['id_reservasi'] == $paket['id_reservasi'] && $dt['id_barang'] == $paket['id_barang']) {
                                                                                if ($dt['jns'] == 'LOKAL') {
                                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                                } else {
                                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                                }
                                                                                foreach ($paket['produk'] as $produk) {
                                                                                    foreach ($produk['items'] as $item) {
                                                                                        $costBarang += ($item['hpp'] * $jmlBarang);                                                                                       
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                        ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $br['namabarang']; ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                                        <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                                    </td>
                                                                    <td class="pe-0"><i><?= $br['jenis']; ?></i></td>
                                                                    <td class="text-center pe-0"><?= $jumlahBarang; ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($komisibarang); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($costBarang); ?></td>
                                                                    <td class="text-end pe-0"><?= number_format($penjualanBarang - $costBarang - $komisibarang); ?></td>
                                                                </tr>
                                                        <?php }
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Total : <?= number_format($totalPenjualan) ?></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
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