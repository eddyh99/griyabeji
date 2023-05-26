<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <form id="form_input" method="post" action="<?= base_url() ?>paket/updateData">
                            <input type="hidden" name="id" value="<?= $detail["id"] ?>">
                            <div class="row">
                                <div class="col-xl">
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Nama Produk</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="namaproduk" name="namaproduk" maxlength="35" value="<?= $detail['namapaket']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Harga Lokal</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="local" name="local" maxlength="35" value="<?= $detail['lokal']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Harga Domestik</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="domestik" name="domestik" maxlength="35" value="<?= $detail['domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Harga Internasional</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="internasional" name="internasional" maxlength="35" value="<?= $detail['internasional']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Pilih Items</label>
                                        <div class="col-sm-7">
                                            <select multiple id="namaitems" name="id_items[]" class="form-control namaitems-select">
                                                <?php foreach ($items as $item) { ?>
                                                    <option value="<?= $item["id_produk"] ?>" selected><?= $item["namaproduk"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Komisi Guide 2x?</label>
                                        <div class="col-sm">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="yes" id="komisi" name="komisi" <?= ($detail["is_double"] == 'yes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="komisi">
                                                    Komisi Guide x2 untuk Internasional?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Komisi Guide Domestik</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kdguide" name="kdguide" maxlength="35" autocomplete="off" value="<?= $detail['komisi_guide_domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Komisi Guide Internasional</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kiguide" name="kiguide" maxlength="35" autocomplete="off" value="<?= $detail['komisi_guide_internasional']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Komisi Pengayah Domestik</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kdpangayahan" name="kdpangayahan" maxlength="35" autocomplete="off" value="<?= $detail['komisi_pengayah_domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <label class="col-sm-3 col-form-label">Komisi Pengayah Internasional</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kipengayahan" name="kipengayahan" maxlength="35" autocomplete="off" value="<?= $detail['komisi_pengayah_internasional']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col d-flex">
                                    <a name="btnBack" href="<?= base_url() ?>paket" class="btn btn-warning me-auto">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                    <button id="btnSimpan" name="btnSimpan" class="btn btn-primary ms-5">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ====== End Ubah Pengguna  ===== -->
            </div>
            <!-- ======= End Row Content Canva JS ====== -->

        </div>
        <!-- ====== End Content container ====== -->
    </div>
    <!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->