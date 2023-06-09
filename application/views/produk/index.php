<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10">
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-primary" href="<?= base_url() ?>produk/tambah">Tambah</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION["message"])) { ?>
                            <div class="alert alert-success"><?= $_SESSION["message"] ?></div>
                        <?php } ?>
                        <table id="table_data" class="table table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Produk</th>
                                    <th>Local</th>
                                    <th>Domestik</th>
                                    <th>Internasional</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ======= End Row Content Canva JS ====== -->

        </div>
        <!-- ====== End Content container ====== -->
    </div>
    <!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->