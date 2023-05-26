<div class="d-flex flex-column flex-column-fluid">
    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10 justify-content-center">
                <!-- ====== Start Tambah Brand ====== -->
                <?php if (isset($_SESSION["message"])) { ?>
                    <div class="alert alert-success"><?= $_SESSION["message"] ?></div>
                <?php } ?>
                <?php if (isset($_SESSION["gagal"])) { ?>
                    <div class="alert alert-danger"><?= $_SESSION["gagal"] ?></div>
                <?php } ?>

                <div class="col-lg-10 card">
                    <div class="card-body">
                        <form action="<?= base_url() ?>laporan/produkteratas/" method="get">
                            <div class="row form-group">
                                <label class="col-form-label col">Tanggal</label>
                                <div class="col">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= $tgl ?>" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-20" id="printarea">
                            <div class="col text-start mb-5">
                                <h3>Laporan Produk Terpopuler Berbagai Negara</h3>
                            </div>

                            <hr>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?= $tglShow ?></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-5">
                                    <div class="d-flex flex-column">
                                        <table id="country" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <th class="text-center">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($country as $ct) {
                                                ?>
                                                    <tr>
                                                        <td class="fw-bold"><?= $ct['countryname'] ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                    foreach ($produk as $br) {
                                                        $jumlahBarang = 0;
                                                        if ($br['country_code'] == $ct['country_code']) {
                                                            foreach ($data as $dt) {
                                                                if (
                                                                    $dt['jenis'] == 'produk' &&
                                                                    $dt['id_barang'] == $br['id_barang'] &&
                                                                    $dt['country_code'] == $ct['country_code']
                                                                ) {
                                                                    $jmlBarang = ($dt['jml'] == 0) ? 1 : $dt['jml'];
                                                                    $jumlahBarang += $jmlBarang;
                                                                }
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td class="ps-5">- <?= $br['namabarang'] ?></td>
                                                                <td class="text-center"><?= $jumlahBarang; ?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tanggal : <?= $tglShow ?></th>
                                                    <!-- <th>Total : <?= number_format($totalPenjualan); ?></th> -->
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== End Tambah Brand ====== -->
            </div>
            <!-- ======= End Row Content Canva JS ====== -->
        </div>
        <!-- ======= End Content container ======== -->
    </div>
    <!-- ====== End Content ====== -->
</div>