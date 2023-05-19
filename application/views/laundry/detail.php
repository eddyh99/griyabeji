<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row mt-10">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="col card">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group my-3">
                                    <label class="col-sm-3 col-form-label">No. Catatan :</label>
                                    <div class="col">
                                        <?= $master['id'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="form-group my-3">
                                    <label class="col-sm-3 col-form-label">Tanggal : </label>
                                    <div class="col">
                                        <?= $master['tanggal'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="form-group my-3">
                                    <label class="col-sm-3 col-form-label">Status : </label>
                                    <div class="col">
                                        <span class="badge text-bg-<?= ($master['status'] == 'no') ? 'primary' : 'success'; ?> text-white rounded-pill">
                                            <?= ($master['status'] == 'no') ? 'Proses' : 'Kembali'; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <table id="detail_items" class="table table-striped nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Items</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $dt) { ?>
                                            <tr>
                                                <td><?= $dt['namaitem'] ?></td>
                                                <td><?= $dt['jml'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="col-lg-6 text-right">
                                    <a name="btnBack" href="<?= base_url() ?>laundry" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
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