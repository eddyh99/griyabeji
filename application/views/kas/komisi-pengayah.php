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
                                <h3>Laporan Komisi Pengayah</h3>
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
                                        <table id="komisi" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th>Harga@</th>
                                                    <th class="text-end pe-10">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pengayah as $dtpengayah) {
                                                    $komisi = 0;
                                                    foreach ($penjualan as $dt) {
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
                                                            <td class="col-4 fw-bold"><?= $no . '. ' . $dtguide['nama_guide'] ?></td>
                                                            <td class="col-2 text-center"></td>
                                                            <td class="col-2 text-center"></td>
                                                            <td class="col-2 text-end pe-10"><?= number_format($komisi) ?></td>
                                                        </tr>
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

                                                                    if ($dt['id_barang'] == $dtBarang['id_barang'] && $dt['jenis'] == $dtBarang['jenis'] && $dt['id_reservasi'] == $dtBarang['id_reservasi'] && $dt['jns'] == $dtBarang['jns']) {
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
                                                        ?>
                                                                <tr>
                                                                    <td class="col-4 ps-5 text-start">
                                                                        -
                                                                        <?= $dtBarang['namabarang'] ?>
                                                                        <?= ($dtBarang['jns'] == 'LOKAL') ? '<i>(Lokal)</i>' : ''; ?>
                                                                        <?= ($dtBarang['jns'] == 'DOMESTIK') ? '<i>(Domestik)</i>' : ''; ?>
                                                                        <?= ($dtBarang['jns'] == 'INTERNASIONAL') ? '<i>(Internasional)</i>' : ''; ?>
                                                                        <?= ($dtBarang['id_reservasi'] != NULL) ? '<i>(Reservasi)</i>' : ''; ?>
                                                                    </td>
                                                                    <td class="col-2 text-center"><?= $jmlBarang ?></td>
                                                                    <td class="col-2">
                                                                        <?= number_format($hrgBarang) ?>
                                                                    </td>
                                                                    <td class="col-2 text-end pe-10"><?= number_format($totalkomisiperproduk) ?></td>
                                                                </tr>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                    $no++;
                                                }
                                                ?>
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