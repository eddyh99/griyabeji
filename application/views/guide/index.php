<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10">
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-primary" href="<?= base_url() ?>guide/tambah">Tambah</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="table_data" class="table table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>ID Partner</th>
                                    <th>Nama</th>
                                    <th>Whatsapp</th>
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

<!-- Alert Message -->
<?php if (isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: '<?= $_SESSION['success'] ?>',
                position: 'top-end',
                background: '#50CD89',
                customClass: {
                    title: 'toast-griya-title',
                },
                timer: 3000,
                showConfirmButton: false,
            });
        }, 100);
    </script>
<?php } ?>


<?php if (isset($_SESSION["error"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: '<?= $_SESSION['error'] ?>',
                position: 'top-end',
                background: '#F1416C',
                customClass: {
                    title: 'toast-griya-title',
                },
                timer: 3000,
                showConfirmButton: false,
            });
        }, 100);
    </script>
<?php } ?>