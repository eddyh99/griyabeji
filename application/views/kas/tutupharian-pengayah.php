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
                    <div class="card-content">
                        <form action="<?= base_url() ?>kas/tutupharianpengayah/" method="get">
                            <div class="row ms-1 ms-md-10 my-5 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tgl" name="tgl" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-sm-1 mt-5 mt-sm-0">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row ms-1 ms-md-10 my-20" id="printarea">
                            <d iv class="col-sm-12 col-md-6 text-start">
                                <h3>Laporan Komisi Pengayah Harian</h3>
                            </d>
                            <div class="col-8">
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?= $tgl ?></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
                                        <?php
                                        foreach ($pengayah as $dtpengayah) {
                                            $komisi = 0;
                                            $jmlBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_produk'] == $dtpengayah['id_produk'] && $dt['jenis'] == $dtpengayah['jenis']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_produk'] == $dtpengayah['id_produk'] && $dt['jenis'] == $dtpengayah['jenis']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $komisi += $dt['komisi_guide_lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $komisi += $dt['komisi_guide_domestik'];
                                                    } else {
                                                        if ($dtpengayah['jenis'] == 'produk' || $dtpengayah['jenis'] == 'paket') {
                                                            if ($dt['guide_id'] == NULL) {
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
                                        ?>
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                <label class="col-form-label col-5 text-uppercase"><b><?= $dtpengayah['nama_pengayah'] ?></b></label>
                                                <label class="col-form-label pe-2 text-right"><?= number_format($komisi) ?></label>
                                            </div>
                                        <?php
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