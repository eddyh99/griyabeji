<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row">
                <!-- ====== Start Ubah Pengguna  ====== -->
                <div class="card mt-10">
                    <?php if (isset($_SESSION["message"])) { ?>
                        <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                    <?php } ?>
                    <div class="card-body">
                        <form id="form_input" method="post" action="<?= base_url() ?>items/updateData">
                            <input type="hidden" name="id" value="<?= $detail["id"] ?>">
                            <div class="row">
                                <div class="col-xl">
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Nama Items</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="namaitems" name="namaitems" maxlength="35" value="<?= $detail['namaitem'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">HPP</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="hpp" name="hpp" maxlength="35" value="<?= $detail['hpp']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Lokal</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="local" name="local" maxlength="35" value="<?= $detail['lokal']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Domestik</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="domestik" name="domestik" maxlength="35" value="<?= $detail['domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Internasional</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="internasional" name="internasional" maxlength="35" value="<?= $detail['internasional']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Komisi Guide Domestik</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kdguide" name="kdguide" maxlength="35" autocomplete="off" value="<?= $detail['komisi_guide_domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Komisi Guide Internasional</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kiguide" name="kiguide" maxlength="35" autocomplete="off" value="<?= $detail['komisi_guide_internasional']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Komisi Pengayah Domestik</label>
                                        <div class="col-sm d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah typeMoney" id="kdpangayahan" name="kdpangayahan" maxlength="35" autocomplete="off" value="<?= $detail['komisi_pengayah_domestik']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
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
                                    <a name="btnBack" href="<?= base_url() ?>items" class="btn btn-warning me-auto">
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