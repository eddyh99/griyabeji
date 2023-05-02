<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row">
                <!-- ====== Start Ubah Pengguna  ====== -->
                <div class="card mt-10">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-warning"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>produk/updateData">
                            <input type="hidden" name="id" value="<?=$detail["id"]?>">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Nama Produk</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="namaproduk" name="namaproduk"  maxlength="35" value="<?= $detail['namaproduk'];?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Lokal</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="local" name="local" maxlength="35" value="<?= $detail['lokal'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Domestik</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="domestik" name="domestik" maxlength="35" value="<?= $detail['domestik'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Harga Internasional</label>
                                        <div class="col-sm-7 d-flex align-items-center">
                                            <span class="me-3">Rp. </span>
                                            <input type="text" class="form-control rupiah" id="internasional" name="internasional" maxlength="35" value="<?= $detail['internasional'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row my-5">
                                        <label class="col-sm-3 col-form-label">Pilih Items</label>
                                        <div class="col-sm-7">
                                            <select multiple id="namaitems" name="id_items[]" class="form-control namaitems-select">
                                                <?php foreach ($items as $item){
                                                ?>                                                
                                                            <option value="<?=$item["id"]?>" selected><?=$item["namaitem"]?></option>
                                                <?php
                                                    } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-10 d-flex justify-content-between">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>produk" class="btn btn-warning">
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
                <!-- ====== End Ubah Pengguna  ===== -->
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->