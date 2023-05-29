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
                        <form action="<?= base_url() ?>laporan/penjualan/" method="get">
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
                                                    <th class="text-center">Jenis</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-end pe-10">Harga@</th>
                                                    <th class="text-end pe-10">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalPenjualan = 0;
                                                foreach ($list_items as $br) {
                                                    $jumlahBarang = 0;
                                                    $penjualanBarang = 0;
                                                    foreach ($data as $dt) {
                                                        if (
                                                            $br['id_barang'] == $dt['id_barang']
                                                            && $br['jenis'] == $dt['jenis']
                                                            && $br['id_reservasi'] == $dt['id_reservasi']
                                                            && $br['jns'] == $dt['jns']
                                                        ) {
                                                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                            if (
                                                                $dt['lokal'] != $br['lokal'] &&
                                                                $dt['domestik'] != $br['domestik'] &&
                                                                $dt['internasional'] != $br['internasional']
                                                            ) {
                                                                $penjualanBarang = 0;
                                                                $jumlahBarang = 0;
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                ?>
                                                                <tr>
                                                                    <td class="col-4">
                                                                        <?= $br['namabarang'] ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                                        <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                                    </td>
                                                                    <td class="col-2 text-center text-capitalize">
                                                                        <?= $br['jenis'] ?>
                                                                    </td>
                                                                    <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                                </tr>
                                                    <?php
                                                            } else {
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td class="col-4">
                                                            <?= $br['namabarang'] ?>
                                                            <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                            <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="col-2 text-center text-capitalize">
                                                            <?= $br['jenis'] ?>
                                                        </td>
                                                        <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                foreach ($list_produk as $br) {
                                                    $jumlahBarang = 0;
                                                    $penjualanBarang = 0;
                                                    foreach ($data as $dt) {
                                                        if (
                                                            $br['id_barang'] == $dt['id_barang']
                                                            && $br['jenis'] == $dt['jenis']
                                                            && $br['id_reservasi'] == $dt['id_reservasi']
                                                            && $br['jns'] == $dt['jns']
                                                        ) {
                                                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                            if (
                                                                $dt['lokal'] != $br['lokal'] &&
                                                                $dt['domestik'] != $br['domestik'] &&
                                                                $dt['internasional'] != $br['internasional']
                                                            ) {
                                                                $jumlahBarang = 0;
                                                                $penjualanBarang = 0;
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                ?>
                                                                <tr>
                                                                    <td class="col-4">
                                                                        <?= $br['namabarang'] ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                                        <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                                    </td>
                                                                    <td class="col-2 text-center text-capitalize">
                                                                        <?= $br['jenis'] ?>
                                                                    </td>
                                                                    <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                                </tr>

                                                    <?php
                                                            } else {
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td class="col-4">
                                                            <?= $br['namabarang'] ?>
                                                            <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                            <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="col-2 text-center text-capitalize">
                                                            <?= $br['jenis'] ?>
                                                        </td>
                                                        <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                foreach ($list_paket as $br) {
                                                    $jumlahBarang = 0;
                                                    $penjualanBarang = 0;
                                                    foreach ($data as $dt) {
                                                        if (
                                                            $br['id_barang'] == $dt['id_barang']
                                                            && $br['jenis'] == $dt['jenis']
                                                            && $br['id_reservasi'] == $dt['id_reservasi']
                                                            && $br['jns'] == $dt['jns']
                                                        ) {
                                                            $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];

                                                            if (
                                                                $dt['lokal'] != $br['lokal'] &&
                                                                $dt['domestik'] != $br['domestik'] &&
                                                                $dt['internasional'] != $br['internasional']
                                                            ) {
                                                                $jumlahBarang = 0;
                                                                $penjualanBarang = 0;
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                ?>
                                                                <tr>
                                                                    <td class="col-4">
                                                                        <?= $br['namabarang'] ?>
                                                                        <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                                        <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                                        <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                                    </td>
                                                                    <td class="col-2 text-center text-capitalize">
                                                                        <?= $br['jenis'] ?>
                                                                    </td>
                                                                    <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                                </tr>
                                                    <?php
                                                            } else {
                                                                if ($dt['jns'] == 'LOKAL') {
                                                                    $hargaSatuan = $dt['lokal'];
                                                                    $penjualanBarang += ($dt['lokal'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['lokal'] * $jmlBarang);
                                                                } elseif ($dt['jns'] == 'DOMESTIK') {
                                                                    $hargaSatuan = $dt['domestik'];
                                                                    $penjualanBarang += ($dt['domestik'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['domestik'] * $jmlBarang);
                                                                } else {
                                                                    $hargaSatuan = $dt['internasional'];
                                                                    $penjualanBarang += ($dt['internasional'] * $jmlBarang);
                                                                    $totalPenjualan += ($dt['internasional'] * $jmlBarang);
                                                                }
                                                                $jumlahBarang += $jmlBarang;
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td class="col-4">
                                                            <?= $br['namabarang'] ?>
                                                            <?= ($br['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                            <?= ($br['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                        </td>
                                                        <td class="col-2 text-center text-capitalize">
                                                            <?= $br['jenis'] ?>
                                                        </td>
                                                        <td class="col-2 text-center"><?= $jumlahBarang ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($hargaSatuan) ?></td>
                                                        <td class="col-2 text-end pe-10"><?= number_format($penjualanBarang) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tanggal : <?= $tglShow ?></th>
                                                    <th>Total : <?= number_format($totalPenjualan); ?></th>
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