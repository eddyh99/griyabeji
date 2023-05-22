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
                        <form action="<?= base_url() ?>laporan/guide/" method="get">
                            <div class="row mb-5 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= @$tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-sm-1 mt-5 mt-sm-0">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row my-20" id="printarea">
                            <d iv class="col-sm-12 col-md-6 text-start">
                                <h3>Laporan Komisi Guide</h3>
                            </d>
                            <div class="col-8">
                                <hr>
                            </div>
                            <!-- <div class="col-sm-12">
                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
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
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                <label class="col-form-label col-5 text-uppercase"><b><?= $showStore['store'] ?></b></label>
                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalKasStore) ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div> -->
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