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
                        <form id="form_input" method="post" action="<?=base_url()?>pengunjung/AddData">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" id="nama" name="nama" maxlength="35">
                                        </div>
                                    </div>
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Whatsapp</label>
                                        <div class="col-sm-7">
                                        <input type="number" class="form-control" id="whatsapp" name="whatsapp" maxlength="14">
                                        </div>
                                    </div>
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" id="email" name="email" >
                                        </div>
                                    </div>
                                    <div class="form-group row my-3">
                                        <label class="col-sm-3 col-form-label">Instagram</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="ig" name="ig">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Pilih Negara</label>
                                        <div class="col-sm-7">
                                            <select id="countryname" name="countryname" class="form-control">
                                                <option value="" disabled selected>--Pilih Negara--</option>
                                                <?php foreach ($countries as $country){?>
                                                    <option value="<?=$country["code"]?>"><?=$country["name"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Pilih Provinsi</label>
                                        <div class="col-sm-7">
                                            <select id="statename" name="statename" class="form-control">
                                                <option value="" disabled selected>--Pilih Provinsi--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>pengunjung" class="btn btn-warning">
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