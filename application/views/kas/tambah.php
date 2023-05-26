<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">

			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row my-10">
				<div class="col card">
					<div class="card-body">
						<?php if (isset($_SESSION["message"])) { ?>
							<div class="alert alert-warning"><?= $_SESSION["message"] ?></div>
						<?php } ?>
						<form class="row" id="form_input" method="post" action="<?= base_url() ?>kas/AddData">
							<div class="col-lg-6">
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Tanggal</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="tanggal" readonly value="<?= date("d-m-Y") ?>">
									</div>
								</div>
								<div class="form-group row my-5">
									<label class="col-sm-3 col-form-label">Pilih Store</label>
									<div class="col-sm-7">
										<select id="storename" name="storename" class="form-control">
											<option value="" disabled selected>--Pilih Store--</option>
											<?php foreach ($stores as $store) { ?>
												<option value="<?= $store["id"] ?>"><?= $store["namastore"] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Jenis</label>
									<div class="col-sm-7">
										<select name="jenis" id="jenis" class="form-control" required>
											<option value="Kas Awal">Kas Awal</option>
											<option value="Kas Sisa">Kas Sisa</option>
											<option value="Masuk">Kas Masuk</option>
											<option value="Keluar">Kas Keluar</option>
										</select>
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Nominal</label>
									<div class="col-sm-7">
										<input type="text" class="form-control typeMoney" id="nominal" name="nominal" required>
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Keterangan</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="keterangan" name="keterangan" maxlength="100" required>
									</div>
								</div>
							</div>
							<div class="col-lg-6" id="approve_input">
								<div class="form-group row my-3">
									<!-- <label class="col-sm-3 col-form-label">Approve</label> -->
									<div class="col-sm-7">
										<input type="password" class="form-control" id="approve" name="approve">
									</div>
									<div class="col-sm-3">
										<button id="approvebtn" class="btn btn-info" type="button">Approve</button>
									</div>
								</div>
							</div>
							<div class="col-lg-12 d-flex justify-content-between">
								<div class="col-lg-6 text-right">
									<a name="btnBack" href="<?= base_url() ?>kas" class="btn btn-warning">
										<i class="material-icons">reply</i>
										Back</a>
								</div>
								<div class="col-lg-6 d-flex justify-content-end">
									<button id="btnSimpan" name="btnSimpan" class="btn btn-primary">Simpan</button>
								</div>
							</div>
						</form>
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