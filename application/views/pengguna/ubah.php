<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row mt-10 justify-content-center">
                <!-- ====== Start Ubah Pengguna  ====== -->
                <div class="col-lg-8 card">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <form id="form_input" method="post" action="<?= base_url() ?>pengguna/updateData">
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="username" name="username" maxlength="10" value="<?= $detail['username'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col">
                                    <input type="password" class="form-control" id="password" name="password" maxlength="10">
                                    <small class="text-danger">*Kosongkan password jika tidak ingin mengubah</small>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $detail['nama'] ?>" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Passcode</label>
                                <div class="col">
                                    <input type="password" class="form-control" id="passcode" name="passcode" maxlength="6" minlength="6" value="<?= $detail["passcode"] ?>">
                                    <small class="text-danger">*passcode akan digunakan untuk approval</small>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col">
                                    <select name="role" id="role" class="form-control">
                                        <option value="owner" <?php echo ($detail['role'] == "owner") ? "selected" : "" ?>>Owner</option>
                                        <option value="GM" <?php echo ($detail['role'] == "GM") ? "selected" : "" ?>>General Manager</option>
                                        <option value="EAM" <?php echo ($detail['role'] == "EAM") ? "selected" : "" ?>>Executive Assistant Manager</option>
                                        <option value="kasir" <?php echo ($detail['role'] == "kasir") ? "selected" : "" ?>>Kasir</option>
                                        <option value="admin" <?php echo ($detail['role'] == "admin") ? "selected" : "" ?>>Admin</option>
                                        <option value="pengayah" <?php echo ($detail['role'] == "pengayah") ? "selected" : "" ?>>Pengayah</option>

                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="col-lg-6 text-right">
                                    <a name="btnBack" href="<?= base_url() ?>pengguna" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
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