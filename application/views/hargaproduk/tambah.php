<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10 justify-content-center">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="col-lg-8 card">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <form id="form_input" method="post" action="<?= base_url() ?>produk/AddHargaData">
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Pilih Produk</label>
                                <div class="col">
                                    <select id="namaproduk" name="namaproduk" class="form-control">
                                        <option value="" disabled selected>--Pilih Produk--</option>
                                        <?php foreach ($produks as $produk) { ?>
                                            <option value="<?= $produk["id"] ?>"><?= $produk["namaproduk"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Harga Lokal</label>
                                <div class="col d-flex align-items-center">
                                    <span class="me-3">Rp. </span>
                                    <input type="text" class="form-control rupiah typeMoney" id="local" name="local" maxlength="35" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Harga Domestik</label>
                                <div class="col d-flex align-items-center">
                                    <span class="me-3">Rp. </span>
                                    <input type="text" class="form-control rupiah typeMoney" id="domestik" name="domestik" maxlength="35" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Harga Internasional</label>
                                <div class="col d-flex align-items-center">
                                    <span class="me-3">Rp. </span>
                                    <input type="text" class="form-control rupiah typeMoney" id="internasional" name="internasional" maxlength="35" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Pilih tanggal</label>
                                <div class="col">
                                    <input type="text" class="form-control rupiah" id="tanggal" name="tanggal">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-right">
                                    <a name="btnBack" href="<?= base_url() ?>produk/hargaproduk" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                </div>
                                <div class="d-flex justify-content-end">
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