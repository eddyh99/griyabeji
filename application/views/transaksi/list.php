<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() ?>transaksi/listTransaksi" method="get">
                            <div class="row my-5 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" autocomplete="off" value="<?= @$tgl; ?>">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>
                        <table id="table_data" class="table table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Guide</th>
                                    <th>Pengayah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $dt) { ?>
                                    <tr>
                                        <td><?= $dt['id'] ?></td>
                                        <td><?= $dt['tanggal'] ?></td>
                                        <td><?= ($dt['guide'] == NULL) ? '-' : $dt['guide']; ?></td>
                                        <td><?= ($dt['pengayah'] == NULL) ? '-' : $dt['pengayah'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>transaksi/detail/<?= base64_encode($dt['id']) ?>" class="badge text-bg-primary text-white rounded-pill mx-1">Info</a>
                                        </td>
                                    </tr>
                                <?php } ?>
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