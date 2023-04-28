<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row">
                <!-- ====== Start Tambah Store ====== -->
                <div class="card mt-10">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-warning"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>admin/store/updateData">
                            <div class="col-lg-6">
                                <div class="card-body">
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Nama Store</label>
                                    <div class="col-sm-7">
                                    <input type="hidden" name="storeid" value="<?=$detail['storeid']?>">
                                    <input type="text" class="form-control" id="store" name="store" value="<?= $detail['store']?>" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $detail['alamat']?>" maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Kontak</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $detail['kontak']?>" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $detail['keterangan']?>" maxlength="100">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>admin/store" class="btn btn-warning">
                                        <i class="material-icons">reply</i>
                                        Back</a>
                                </div>
                                <div class="col-lg-6 pe-14 d-flex justify-content-end">
                                    <button type="submit" id="btnSimpan" name="btnSimpan"  class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ====== End Tambah Store ====== -->
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->