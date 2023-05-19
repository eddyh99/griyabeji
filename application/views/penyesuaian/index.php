<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="card mt-10">
                    <?php if (isset($_SESSION["message"])) { ?>
                        <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                    <?php } ?>
                    <div class="card-content">

                        <form id="form_input" method="post" action="<?= base_url() ?>penyesuaian/AddData">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Pilih Items</label>
                                        <div class="col-sm-7">
                                            <select id="namaitems" name="namaitems" class="form-control">
                                                <option value="" disabled selected>--Pilih Items--</option>
                                                <?php foreach ($items as $item) { ?>
                                                    <option value="<?= $item["id"] ?>"><?= $item["namaitem"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Store</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <select id="store" name="store" class="form-control">
                                                <option value="" disabled selected>--Pilih Store--</option>
                                                <?php foreach ($store as $item) { ?>
                                                    <option value="<?= $item["id"] ?>"><?= $item["namastore"] ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Stok System</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <input type="number" class="form-control" id="stok" name="stok" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Stok Riil</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <input type="number" class="form-control" id="riil" name="riil" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-14 d-flex justify-content-start">
                                    <button id="btnSimpan" name="btnSimpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ====== End Tambah Pengguna ====== -->
            </div>
            <!-- ======= End Row Content Canva JS ====== -->

        </div>
        <!-- ====== End Content container ====== -->
    </div>
    <!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->