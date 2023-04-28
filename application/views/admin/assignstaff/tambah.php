<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row">
                <!-- ====== Start Tambah Brand ====== -->
                <div class="card mt-10">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-warning"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>admin/assignstaff/AddData">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="nama" name="nama" list="stafflist">
                                            <datalist name="stafflist" id="stafflist">
                                                <?php
                                                    foreach($staff as $dt) {
                                                        echo "<option data-uname='".$dt["username"]."' value='".$dt["nama"]."' />";
                                                    }
                                                ?>
                                            </datalist>
                                            <input type="hidden" id="username" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Store Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="store" name="store" list="storelist">
                                            <datalist name="storelist" id="storelist">
                                                <?php
                                                    foreach($store as $dt) {
                                                        echo "<option data-storeid='".$dt["storeid"]."' value='".$dt["store"]."' />";
                                                    }
                                                ?>
                                            </datalist>
                                            <input type="hidden" id="storeid" name="storeid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>admin/assignstaff" class="btn btn-warning">
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
                <!-- ====== End Tambah Brand ====== -->
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->