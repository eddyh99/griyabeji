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
                        <form action="<?= base_url() ?>kas/komisiguide/" method="get">
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
                                <h3>Laporan Komisi Guide</h3>
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
                                    <div class="d-flex col flex-column">
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 mt-5">
                                            <label class="col-form-label col-5"><b>Nama</b></label>
                                            <label class="col-form-label col"><b>Satuan</b></label>
                                            <label class="col-form-label pe-2 text-right"><b>Total</b></label>
                                        </div>

                                        <?php if (empty($guide)) { ?>
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 mt-5">
                                                <label class="col-form-label col-12 text-center"><i>Tidak ada.</i></label>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        $no = 1;
                                        foreach ($guide as $dtguide) {
                                            $komisi = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dtguide['guide_id'] == $dt['guide_id']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $komisi += $dt['komisi_guide_lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $komisi += $dt['komisi_guide_domestik'];
                                                    } else {
                                                        if ($dtguide['jenis'] == 'produk' || $dtguide['jenis'] == 'paket') {
                                                            if ($dt['pengayah_id'] == NULL) {
                                                                if ($dt['is_double'] == 'yes') {
                                                                    $komisi += ($dt['komisi_guide_internasional'] * 2);
                                                                } else {
                                                                    $komisi += $dt['komisi_guide_internasional'];
                                                                }
                                                            } else {
                                                                $komisi += $dt['komisi_guide_internasional'];
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($komisi != 0) {
                                        ?>
                                                <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 mt-5">
                                                    <label class="col-form-label col-5"><b><?= $no . '. ' . $dtguide['nama_guide'] ?></b></label>
                                                    <label class="col-form-label pe-2 text-right"><b><?= number_format($komisi) ?></b></label>
                                                </div>

                                                <?php
                                                foreach ($barang as $dtBarang) {
                                                    $jmlBarang = 0;
                                                    $hrgBarang = 0;
                                                    foreach ($penjualan as $dt) {
                                                        if ($dt['guide_id'] == $dtguide['guide_id']) {
                                                            if ($dt['jml'] == 0) {
                                                                $jml = 1;
                                                            } elseif ($dt['jml'] > 0) {
                                                                $jml = $dt['jml'];
                                                            }

                                                            if ($dt['id_barang'] == $dtBarang['id_barang'] && $dt['jenis'] == $dtBarang['jenis'] && $dt['id_reservasi'] == $dtBarang['id_reservasi'] && $dt['jns'] == $dtBarang['jns']) {
                                                                $jmlBarang += $jml;
                                                            }
                                                        }
                                                    }

                                                    if ($dtBarang['guide_id'] == $dtguide['guide_id']) {
                                                        if ($dtBarang['jns'] == 'LOKAL') {
                                                            $hrgBarang = $dtBarang['komisi_guide_lokal'];
                                                        } elseif ($dtBarang['jns'] == 'DOMESTIK') {
                                                            $hrgBarang = $dtBarang['komisi_guide_domestik'];
                                                        } else {
                                                            if ($dtBarang['is_double'] == 'yes') {
                                                                $hrgBarang = $dtBarang['komisi_guide_internasional'] * 2;
                                                            } else {
                                                                $hrgBarang = $dtBarang['komisi_guide_internasional'];
                                                            }
                                                        }
                                                    }

                                                    $totalkomisiperproduk = $hrgBarang * $jmlBarang;

                                                    if ($totalkomisiperproduk != 0) {
                                                        if ($dtBarang['id_reservasi'] == NULL) {
                                                ?>
                                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                                <label class="col-form-label col-5">- <?= $dtBarang['namabarang'] ?></label>
                                                                <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?>
                                                                    <?= ($dtBarang['jns'] == 'INTERNASIONAL' && $dtBarang['is_double'] == 'yes') ? 'x 2<i>(*Bonus)</i>' : '' ?></label>
                                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalkomisiperproduk) ?></label>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                                <label class="col-form-label col-5">- <?= $dtBarang['namabarang'] ?> <i>(Reservasi)</i></label>
                                                                <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?>
                                                                    <?= ($dtBarang['jns'] == 'INTERNASIONAL' && $dtBarang['is_double'] == 'yes') ? 'x 2<i>(*Bonus)</i>' : '' ?></label>
                                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalkomisiperproduk) ?></label>
                                                            </div>
                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                            $no++;
                                        }
                                        ?>
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