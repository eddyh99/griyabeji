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
                        <form action="<?= base_url() ?>laporan/kas/" method="get">
                            <div class="row form-group mb-3">
                                <label class="col-form-label col">Tanggal</label>
                                <div class="col">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <label class="col-form-label col">Store</label>
                                <div class="col">
                                    <select id="storename" name="storename" class="form-control">
                                        <option value="" disabled selected>--Pilih Store--</option>
                                        <?php foreach ($store as $store) { ?>
                                            <option value="<?= $store["id"] ?>" <?= ($idstore == $store['id']) ? 'selected' : ''; ?>><?= $store["namastore"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-20" id="printarea">
                            <div class="col text-start mb-5">
                                <h3>Laporan Kas</h3>
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
                                                    <th>Tanggal</th>
                                                    <th>Store</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                if (!empty($kas)) {
                                                    $total += $saldo['saldo'];
                                                    foreach ($kas as $dt) {
                                                        if ($dt['jenis'] == 'Kas Awal' || $dt['jenis'] == 'Masuk') {
                                                            $total += $dt['nominal'];
                                                        } elseif ($dt['jenis'] == 'Keluar') {
                                                            $total -= $dt['nominal'];
                                                        }
                                                ?>
                                                        <tr>
                                                            <td class="col-2"><?= $dt['keterangan'] ?></td>
                                                            <td class="col-2"><?= $dt['tanggal'] ?></td>
                                                            <td class="col-2"><?= $dt['store'] ?></td>
                                                            <td class="col-2"><?= ($dt['jenis'] == 'Kas Awal' || $dt['jenis'] == 'Masuk') ? number_format($dt['nominal']) : number_format(0); ?></td>
                                                            <td class="col-2"><?= ($dt['jenis'] == 'Kas Awal' || $dt['jenis'] == 'Masuk') ? number_format(0) : number_format($dt['nominal']); ?></td>
                                                            <td class="col-2"><?= number_format($total); ?></td>
                                                        </tr>
                                                <?php }
                                                } ?>
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