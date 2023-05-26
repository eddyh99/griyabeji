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
                        <form id="form_input" method="post" action="<?= base_url() ?>pengunjung/updateData">
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
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= @$detail['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Instagram</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="ig" name="ig" value="<?= @$detail['ig'] ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Pilih Negara</label>
                                <div class="col">
                                    <select id="countryname" name="countryname" class="form-control">
                                        <!-- <option value="<?= $detail['code'] ?>" disabled selected><?= $detail['countryname'] ?></option> -->
                                        <?php foreach ($countries as $country) { ?>
                                            <option <?php if ($detail['code'] == $country["code"]) { ?> value="<?= $detail["code"] ?>" selected <?php } else { ?> value="<?= $country["code"] ?>" <?php } ?>>
                                                <?= $country["name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Pilih Provinsi</label>
                                <div class="col">
                                    <select id="statename" name="statename" class="form-control">
                                        <!-- <option value="<?= $detail['state_code'] ?>" disabled selected><?= $detail['statename'] ?></option> -->
                                        <?php foreach ($states as $state) { ?>
                                            <option <?php if ($detail['state_code'] == $state["state_code"]) { ?> value="<?= $state["state_code"] ?>" selected <?php } else { ?> value="<?= $state["state_code"] ?>" <?php } ?>>
                                                <?= $state["state_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-right">
                                    <a name="btnBack" href="<?= base_url() ?>pengunjung" class="btn btn-warning">
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