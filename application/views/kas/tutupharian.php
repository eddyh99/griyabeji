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
                        <form action="<?= base_url() ?>kas/tutupharian/" method="get">
                            <?php /*?>
                            <?php if (($_SESSION["logged_status"]["role"]=="Office Manager")||($_SESSION["logged_status"]["role"]=="Office Staff")||($_SESSION["logged_status"]["role"]=="Owner")){?>
                            <div class="row ms-1 ms-md-10 my-5 mt-10 form-group">
                                <label class="col-form-label col-sm-1">Store</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="store" id="store">
                                        <?php foreach($store as $dt){?>
                                                <option value="<?=$dt["storeid"]?>" <?php echo ($dt["storeid"]==$storeid) ? "selected":"" ?>><?=$dt["store"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <?php */ ?>

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
                                <h3>Laporan Penjualan Harian</h3>
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
                                <div class="form-group my-5">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2">
                                        <label class="col-form-label col-5"><b>CASH</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?= number_format($cash) ?></b></label>
                                    </div>
                                </div>
                                <div class="form-group my-5">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2">
                                        <label class="col-form-label col-5"><b>CARD</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?= number_format($card) ?></b></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN SOUVENIR</b></label>
                                        </div>
                                        <?php
                                        $total_PJ_items = 0;
                                        foreach ($items as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }
                                                }
                                            }
                                            $total_PJ_items += $totalHargaBarang;
                                        ?>
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                <label class="col-form-label col-5"> - <?= $byBarang['namaitem'] ?> x <?= $jmlBarang ?></label>
                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN SOUVENIR</b></label>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_items) ?></b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN PRODUK</b></label>
                                        </div>
                                        <?php
                                        $total_PJ_Produk = 0;
                                        foreach ($produk as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }
                                                }
                                            }
                                            $total_PJ_Produk += $totalHargaBarang;
                                        ?>
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                <label class="col-form-label col-5"> - <?= $byBarang['namaitem'] ?> x <?= $jmlBarang ?></label>
                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN PRODUK</b></label>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_Produk) ?></b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex col-6 flex-column">
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>PENJUALAN PAKET</b></label>
                                        </div>
                                        <?php
                                        $total_PJ_Paket = 0;
                                        foreach ($paket as $byBarang) {
                                            $jmlBarang = 0;
                                            $totalHargaBarang = 0;
                                            foreach ($penjualan as $dt) {
                                                if ($dt['jml'] == '0') {
                                                    $jml = 1;
                                                } else {
                                                    $jml = $dt['jml'];
                                                }

                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    $jmlBarang += $jml;
                                                }
                                            }

                                            foreach ($penjualan as $dt) {
                                                if ($dt['id_produk'] == $byBarang['id_produk'] && $dt['jenis'] == $byBarang['jenis']) {
                                                    if ($dt['jns'] == 'LOKAL') {
                                                        $totalHargaBarang += $dt['lokal'];
                                                    } elseif ($dt['jns'] == 'DOMESTIK') {
                                                        $totalHargaBarang += $dt['domestik'];
                                                    } else {
                                                        $totalHargaBarang += $dt['internasional'];
                                                    }
                                                }
                                            }

                                            $total_PJ_Paket += $totalHargaBarang;
                                        ?>
                                            <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                                <label class="col-form-label col-5"> - <?= $byBarang['namaitem'] ?> x <?= $jmlBarang ?></label>
                                                <label class="col-form-label pe-2 text-right"><?= number_format($totalHargaBarang) ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TOTAL PENJUALAN PAKET</b></label>
                                            <label class="col-form-label pe-2 text-right"><b><?= number_format($total_PJ_Paket) ?></b></label>
                                        </div>
                                    </div>
                                </div>

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