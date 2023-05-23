<div class="d-flex flex-column flex-column-fluid">
    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10">
                <!-- ====== Start Tambah Brand ====== -->
                <?php if (isset($_SESSION["message"])) { ?>
                    <div class="alert alert-success"><?= $_SESSION["message"] ?></div>
                <?php } ?>
                <?php if (isset($_SESSION["gagal"])) { ?>
                    <div class="alert alert-danger"><?= $_SESSION["gagal"] ?></div>
                <?php } ?>

                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() ?>kas/komisipengayah/" method="get">
                            <div class="row my-5 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-sm-1 mt-5 mt-sm-0">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-20" id="printarea">
                            <d iv class="col-sm-12 col-md-6 text-start">
                                <h3>Laporan Komisi Pengayah</h3>
                            </d>
                            <div class="col-8">
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?= $tglShow ?></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
                                        <?php
                                        foreach ($pengayah as $dtpengayah) {
                                            $komisi = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dtpengayah['pengayah_id'] == $dt['pengayah_id']) {
                                                    if ($dt['id_produk'] == $dtpengayah['id_produk'] && $dt['jenis'] == $dtpengayah['jenis']) {
                                                        if ($dt['jns'] == 'LOKAL') {
                                                            $komisi += $dt['komisi_pengayah_lokal'];
                                                        } elseif ($dt['jns'] == 'DOMESTIK') {
                                                            $komisi += $dt['komisi_pengayah_domestik'];
                                                        } else {
                                                            $komisi += $dt['komisi_pengayah_internasional'];
                                                        }
                                                    }
                                                }
                                            }
                                            if ($komisi != 0) {
                                        ?>
                                                <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                    <label class="col-form-label col-5 text-uppercase"><b><?= $dtpengayah['nama_pengayah'] ?></b></label>
                                                    <label class="col-form-label pe-2 text-right"><?= number_format($komisi) ?></label>
                                                </div>

                                                <?php
                                                foreach ($barang as $dtBarang) {
                                                    $jmlBarang = 0;
                                                    $hrgBarang = 0;
                                                    foreach ($penjualan as $dt) {
                                                        if ($dt['pengayah_id'] == $dtpengayah['pengayah_id']) {
                                                            if ($dt['jml'] == 0) {
                                                                $jml = 1;
                                                            } elseif ($dt['jml'] > 0) {
                                                                $jml = $dt['jml'];
                                                            }

                                                            if ($dt['id_produk'] == $dtBarang['id_produk'] && $dt['jenis'] == $dtBarang['jenis'] && $dt['id_reservasi'] == $dtBarang['id_reservasi']) {
                                                                $jmlBarang += $jml;
                                                            }
                                                        }
                                                    }

                                                    if ($dtBarang['pengayah_id'] == $dtpengayah['pengayah_id']) {
                                                        if ($dtBarang['jns'] == 'LOKAL') {
                                                            $hrgBarang = $dtBarang['komisi_pengayah_lokal'];
                                                        } elseif ($dtBarang['jns'] == 'DOMESTIK') {
                                                            $hrgBarang = $dtBarang['komisi_pengayah_domestik'];
                                                        } else {
                                                            $hrgBarang = $dtBarang['komisi_pengayah_internasional'];
                                                        }
                                                    }

                                                    $totalkomisiperproduk = $hrgBarang * $jmlBarang;

                                                    if ($totalkomisiperproduk != 0) {
                                                        if ($dtBarang['id_reservasi'] == NULL) {
                                                ?>
                                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                                <label class="col-form-label col-5">- <?= $dtBarang['namaitem'] ?></label>
                                                                <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?>
                                                                    <?= ($dtBarang['is_double'] == 'yes') ? 'x 2<i>(*Bonus)</i>' : '' ?></label>
                                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalkomisiperproduk) ?></label>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                                <label class="col-form-label col-5">- <?= $dtBarang['namaitem'] ?></label>
                                                                <label class="col-form-label col"> <?= $jmlBarang ?> x <?= number_format($hrgBarang) ?></label>
                                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalkomisiperproduk) ?></label>
                                                            </div>
                                        <?php
                                                        }
                                                    }
                                                }
                                            }
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