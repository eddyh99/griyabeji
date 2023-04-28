<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content  ====== -->
            <input type="hidden" id="tujuan" value="<?=$_SESSION["logged_status"]["storeid"]?>">
            <div class="row">
                <div class="card my-10">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>admin/opname/simpandata">
                            <div class="card-body">
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Produk</label>
                                    <div class="col-sm-3">
                                        <select id="produk" name="produk" class="form-control" required>
                                            <option value="" disabled selected>--Pilih Produk--</option>
                                            <?php foreach ($produk as $dt){?>
                                                <option value="<?=$dt["barcode"]?>"><?=$dt["namaproduk"]?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-3">
                                        <select id="size" name="size" class="form-control" required>
                                            <option value="" disabled selected>--Pilih Ukuran--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Stok System</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="stok" name="stok" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Stok Riil</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="riil" name="riil" required>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" maxlength="100" required>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <div class="col-sm-6 text-right">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<!-- ======= End Row Content  ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->