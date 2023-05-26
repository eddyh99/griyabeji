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
                        <div class="col-12 mb-5">
                            <div class="col mb-3">Kode Transaksi : <?= $list['id'] ?></div>
                            <input type="text" value="<?= $list['id'] ?>" id="idTC" hidden>
                            <div class="col mb-3">Guide : <?= ($list['guide'] == NULL) ? '-' : $list['guide']; ?></div>
                            <div class="col mb-3">Pengayah : <?= ($list['pengayah'] == NULL) ? '-' : $list['pengayah'] ?></div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <table id="pesanan" class="display" width="100%">
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right">Total:</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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