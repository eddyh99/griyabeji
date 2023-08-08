<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->
            <div class="row my-10 justify-content-center">
                <!-- ====== Start Tambah Pengguna ====== -->
                <div class="col-lg-8 card">
                    <div class="card-body">
                        <form id="form_input" method="post" action="<?= base_url() ?>pengguna/AddData">
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="username" name="username" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col">
                                    <input type="password" class="form-control" id="password" name="password" maxlength="10">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="nama" name="nama" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Passcode</label>
                                <div class="col">
                                    <input type="password" class="form-control" id="passcode" name="passcode" maxlength="6" minlength="6">
                                    <small class="text-danger">*passcode akan digunakan untuk approval</small>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col">
                                    <select name="role" id="role" class="form-control">
                                        <option value="owner">Owner</option>
                                        <option value="GM">General Manager</option>
                                        <option value="EAM">Executive Assistant Manager</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                        <option value="pengayah">Pengayah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-right">
                                    <a name="btnBack" href="<?= base_url() ?>pengguna" class="btn btn-warning">
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
                <!-- ====== End Tambah Pengguna ====== -->
            </div>
            <!-- ======= End Row Content Canva JS ====== -->

        </div>
        <!-- ====== End Content container ====== -->
    </div>
    <!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->

<!-- Alert Message -->
<?php if (isset($_SESSION["error"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: '<?= $_SESSION['error'] ?>',
                position: 'top-end',
                background: '#FF8888',
                customClass: {
                    title: 'toast-griya-title',
                },
                confirmButtonColor: '#202B46',
            });
        }, 100);
    </script>
<?php } ?>

<?php if (isset($_SESSION["error_validation"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: '<?= trim(str_replace('"', '', json_encode($_SESSION['error_validation']))) ?>',
                position: 'top-end',
                background: '#F1416C',
                confirmButtonColor: '#202B46',
                customClass: {
                    title: 'toast-griya-title'
                }
            });
        }, 100);
    </script>
<?php } ?>