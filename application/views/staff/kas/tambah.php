<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->      
			<div class="row">
				<div class="card my-10">
					<?php if (isset($_SESSION["message"])){?>
					<div class="alert alert-warning"><?=$_SESSION["message"]?></div>
					<?php } ?>
					<div class="card-content">
						<form id="form_input" method="post" action="<?=base_url()?>staff/kas/AddData">
							<div class="col-lg-6">
								<div class="card-body">
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Tanggal</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" readonly value="<?=date("d-m-Y")?>">
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Jenis</label>
									<div class="col-sm-7">
										<select name="jenis" class="form-control" required>
											<option value="Kas Awal">Kas Awal</option>
											<option value="Keluar">Kas Keluar</option>
											<?php if ($_SESSION["logged_status"]["role"]=="Store Manager"){?>
											<option value="Masuk">Kas Masuk</option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Nominal</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" id="nominal" name="nominal" maxlength="10" required onkeypress="return isNumber(event)">
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Keterangan</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" id="keterangan" name="keterangan" maxlength="100" required>
									</div>
								</div>
								</div>
							</div>
							<div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>staff/kas" class="btn btn-warning">
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
			</div>    
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->