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
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Nama Items</label>
                                    <div class="col">
                                        <select id="namaitems" name="namaitems" class="form-control">
                                            <option value="" disabled selected>--Pilih Items--</option>
                                            <?php foreach ($items as $item) { ?>
                                                <option value="<?= $item["id"] ?>"><?= $item["namaitem"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col">
                                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 d-grid mb-3">
                                <button class="btn btn-primary mt-auto mb-3" type="button" id="addItems">+Add Items</button>
                            </div>
                            <div class="col-12">
                                <table id="table_items" class="table table-striped nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Items</th>
                                            <th>Jumlah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="col-lg-6 text-right">
                                    <a name="btnBack" href="<?= base_url() ?>laundry" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <button id="btnSimpan" name="btnSimpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
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