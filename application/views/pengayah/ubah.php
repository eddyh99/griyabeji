<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10 justify-content-center">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="card col-lg-8">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <form id="form_input" method="post" action="<?= base_url() ?>pengayah/updateData">
                            <input type="hidden" name="id" value="<?= $detail["id"] ?>">
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="nama" name="nama" maxlength="35" value="<?= $detail['nama'] ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Whatsapp</label>
                                <div class="col">
                                    <input type="number" class="form-control" id="whatsapp" name="whatsapp" value="<?= $detail['whatsapp'] ?>" maxlength="14">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Jenis</label>
                                <div class="col">
                                    <select name="tipe" class="form-control">
                                        <option value="domestik" <?php echo ($detail["tipe"]=="domestik") ? "selected":""?>>Domestik</option>
                                        <option value="internasional" <?php echo ($detail["tipe"]=="internasional") ? "selected":""?>>internasional</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="d-flex justify-content-between">
                                <div class="text-right">
                                    <a name="btnBack" href="<?= base_url() ?>pengayah" class="btn btn-warning">
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
                <!-- ====== End Ubah Pengguna  ===== -->
            </div>
            <!-- ======= End Row Content Canva JS ====== -->

        </div>
        <!-- ====== End Content container ====== -->
    </div>
    <!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->