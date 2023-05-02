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
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-warning"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>items/AddData">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Nama Items</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" id="namaitems" name="namaitems" maxlength="35">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">HPP</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="hpp" name="hpp" maxlength="35" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Lokal</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="local" name="local" maxlength="35" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Domestik</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="domestik" name="domestik" maxlength="35" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Internasional</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="internasional" name="internasional" maxlength="35" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>items" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                </div>
                                <div class="col-lg-6 pe-14 d-flex justify-content-end">
                                    <button id="btnSimpan" name="btnSimpan"  class="btn btn-primary">Simpan</button>
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