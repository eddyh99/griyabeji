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
                        <form action="<?= base_url() ?>kas/komisipengayah/" method="get">
                            <div class="row form-group">
                                <label class="col-form-label col">Tanggal</label>
                                <div class="col">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-20" id="printarea">
                            <div class="col text-start mb-5">
                                <h3>Laporan Penjualan</h3>
                            </div>

                            <hr>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?= $tglShow ?></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <table id="penjualan" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <th class="text-end pe-10">Komisi</th>
                                                    <th class="text-end pe-10">Cost</th>
                                                    <th class="text-end pe-10">Laba</th>
                                                    <th class="text-end pe-10">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalPenjualan = 0;
                                                foreach ($penjualan as $pj) {
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

                                                    foreach ($data as $dt) {
                                                        $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                        if ($dt['id'] == $pj['id']) {

                                                            if ($dt['jenis'] == 'items') {
                                                                $cost += ($dt['hpp'] * $jmlBarang);
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $penjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $penjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $penjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                            }

                                                            if ($dt['jenis'] == 'produk') {
                                                                foreach ($listItemsbyProduk as $produk) {
                                                                    if ($dt['id'] == $produk['id'] && $dt['id_reservasi'] == $produk['id_reservasi'] && $dt['id_barang'] == $produk['id_barang']) {
                                                                        foreach ($produk['items'] as $item) {
                                                                            $cost += ($item['hpp'] * $jmlBarang);
                                                                        }
                                                                        if ($dt['jns'] == 'LOKAL') {
                                                                            $penjualan += ($dt['lokal'] * $jmlBarang);
                                                                        } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                            $penjualan += ($dt['domestik'] * $jmlBarang);
                                                                        } else {
                                                                            $penjualan += ($dt['internasional'] * $jmlBarang);
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
                                                                                if ($dt['jns'] == 'LOKAL') {
                                                                                    $penjualan += ($item['lokal'] * $jmlBarang);
                                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                                    $penjualan += ($item['domestik'] * $jmlBarang);
                                                                                } else {
                                                                                    $penjualan += ($item['internasional'] * $jmlBarang);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $laba = $penjualan - $cost - $komisi;
                                                    $totalPenjualan += $laba;
                                                ?>
                                                    <tr>
                                                        <td class="col-6"><?= $idTransaksi ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($komisi) ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($cost) ?></td>
                                                        <td class="col-2 text-end pe-10"><?= ($laba < 0) ? '<span class="text-danger">' . number_format($laba) . '</span>' : '<span>' . number_format($laba) . '</span>'; ?></td>
                                                        <td class="col-2 text-end pe-10"><a href="<?= base_url() ?>laporan/detailpenjualan/<?= base64_encode($pj['id']) ?>" class="btn btn-sm btn-info">Detail</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tanggal : <?= $tglShow ?></th>
                                                    <th>Total : <?= number_format($totalPenjualan) ?></th>
                                                </tr>
                                            </tfoot>
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