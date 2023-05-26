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
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-6"><b>Keterangan</b></label>
                                            <label class="col-form-label col-2 text-end"><b>Komisi</b></label>
                                            <label class="col-form-label col-2 text-end"><b>Cost</b></label>
                                            <label class="col-form-label col-2 text-end"><b>Laba</b></label>
                                        </div>
                                        <?php
                                        foreach ($penjualan as $pj) {
                                            $idTransaksi = $pj['id'] . date("Ymd", strtotime($pj['tanggal']));
                                        ?>
                                            <div class="w-100 d-flex justify-content-between align-items-center px-2 mt-5">
                                                <label class="col-form-label col-6" data-bs-toggle="collapse" href="#collapse<?= $pj['id'] ?>" role="button" aria-expanded="false" aria-controls="collapse<?= $pj['id'] ?>">
                                                    <b><i class="fas fa-angle-down text-dark"></i> <?= $idTransaksi ?></b>
                                                </label>
                                                <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                            </div>
                                            <div class="collapse" id="collapse<?= $pj['id'] ?>">
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                    <label class="col-form-label col-6"><span class="ms-3 fw-bold">Souvenir</span></label>
                                                </div>
                                                <?php
                                                $no_items = 1;
                                                foreach ($items as $br) {
                                                ?>
                                                    <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                        <label class="col-form-label col-6">
                                                            <span class="ms-3"><?= $no_items ?>. <?= $br['namabarang']; ?></span>
                                                            <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                            <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                        </label>
                                                        <label class="col-form-label col-2 text-end">
                                                            <?= ($br['jns'] == 'LOKAL') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? number_format(0) : ''; ?>
                                                        </label>
                                                        <label class="col-form-label col-2 text-end">
                                                            <?= ($br['jns'] == 'LOKAL') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? number_format(0) : ''; ?>
                                                        </label>
                                                        <label class="col-form-label col-2 text-end">
                                                            <?= ($br['jns'] == 'LOKAL') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? number_format(0) : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? number_format(0) : ''; ?>
                                                        </label>
                                                    </div>
                                                <?php
                                                    $no_items++;
                                                }
                                                ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                    <label class="col-form-label col-6"><span class="ms-3 fw-bold">Produk</span></label>
                                                </div>
                                                <?php
                                                $no_produk = 1;
                                                foreach ($produk as $br) {
                                                ?>
                                                    <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                        <label class="col-form-label col-6">
                                                            <span class="ms-3"><?= $no_produk ?>. <?= $br['namabarang']; ?></span>
                                                            <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                            <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                        </label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                    </div>
                                                <?php
                                                    $no_produk++;
                                                }
                                                ?>
                                                <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                    <label class="col-form-label col-6"><span class="ms-3 fw-bold">Paket</span></label>
                                                </div>
                                                <?php
                                                $no_paket = 1;
                                                foreach ($paket as $br) {
                                                ?>
                                                    <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                        <label class="col-form-label col-6">
                                                            <span class="ms-3"><?= $no_paket ?>. <?= $br['namabarang']; ?></span>
                                                            <?= ($br['jns'] == 'LOKAL') ? ' <i>(Lokal)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'DOMESTIK') ? ' <i>(Domestik)</i> ' : ''; ?>
                                                            <?= ($br['jns'] == 'INTERNASIONAL') ? ' <i>(Internasional)</i> ' : ''; ?>
                                                            <?= ($br['id_reservasi'] == NULL) ? '' : ' <i>(Reservasi)</i> '; ?>
                                                        </label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                        <label class="col-form-label col-2 text-end"><?= number_format(0) ?></label>
                                                    </div>
                                                <?php
                                                    $no_paket++;
                                                }
                                                ?>
                                            </div>
                                            <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                                <label class="col-form-label col-6"><b>Total Penjualan</b></label>
                                                <label class="col-form-label col-2 text-end"><b><?= number_format(0) ?></b></label>
                                            </div>
                                        <?php } ?>
                                        <hr>
                                        <div class="w-100 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-6"><b>TOTAL PENJUALAN</b></label>
                                            <label class="col-form-label text-end"><b><?= number_format(0) ?></b></label>
                                        </div>
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