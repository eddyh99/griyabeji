<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content ====== -->
            
			<div class="row">
                <div class="card my-10">
                    <?php if (isset($_SESSION["message"])){?>
                        <div class="alert alert-<?=$_SESSION['alertcolor']?>"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                        <form id="form_input" method="post" action="<?=base_url()?>admin/stok/AddData">
                            <input type="hidden" name="restock" value="<?=$restock?>">
                            <div class="col-lg-7">
                                <div class="card-body">
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Store</label>
                                    <div class="col-sm-6">
                                        <select id="store" class="form-control" name="store">
                                        <?php foreach($store as $dt){ ?>
                                                <option value="<?=$dt["storeid"]?>" <?php echo (@$_SESSION["idstore"]==$dt["storeid"])?"selected":"" ?>><?=$dt["store"]?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Barcode</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="barcode" name="barcode" maxlength="13" onkeypress="return isNumber(event)" required>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Nama Produk</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="produk" name="produk" list="dataproduk">
                                        <datalist id="dataproduk">
                                            <?php foreach ($produk as $dt){?>
                                                <option data-barcode="<?=$dt["barcode"]?>" value="<?=$dt["namaproduk"]?>">
                                            <?php } ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Brand</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="brand" readonly>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Size</label>
                                    <div class="col-sm-3">
                                        <select name="size" class="form-select" id="size">
                                            <?php
                                                foreach($size as $dt) {
                                                    echo "<option value='".$dt["nama"]."' >".$dt["nama"]."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-sm-4 col-form-label">Stok</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="stok" name="stok" required onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between mb-10">
                                <div class="col-lg-6 ps-5 text-right">
                                    <a name="btnBack" href="<?=base_url()?>admin/stok" class="btn btn-warning">
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
                <div class="card my-5">
                    <div class="card-content pb-2 ps-10">
                        <form action="<?=base_url()?>admin/stok/import" method="post" enctype="multipart/form-data">
                            <label class="col-md-3 col-form-label">Input file Excel</label>
                            <div class="col-md-7">
                                <input type="file" name="stok" id="stok" class="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </div>
                            <div class="col-md-12 my-3"><button class="btn btn-primary">Upload</button></div>
                        </form>
                    </div>
                </div>   
			</div>
			<!-- ======= End Row Content ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->