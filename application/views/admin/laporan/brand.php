<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content ====== -->
			<div class="row ">
                <!-- ======= Start Brand Penjualan ====== -->
                <div class="col-sm-12 mb-3">
                    <div class="card my-10">
                        <div class="card-content px-10 my-10">
                            <div class="row my-3 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tgl" name="tgl" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <div class="col-sm-2">
                                    <?php
                                        if ($_SESSION["logged_status"]["role"]=="Staff"){?>
                                            <input type="hidden" name="store" id="store" value="<?=$_SESSION["logged_status"]["storeid"]?>">
                                        <?php }else{?>

                                            <select id="store" class="form-control" name="store">
                                                <option value="All" selected>--Semua Toko--</option>
                                                <?php foreach ($store as $dt){?>
                                                        <option value="<?=$dt["storeid"]?>"><?=$dt["store"]?></option>
                                                <?php }?>
                                            </select>
                                        <?php }?>
                                </div>
                                <div class="col-sm-3">
                                    <select id="brand" class="form-control" name="brand" width="100%">
                                        <option value="all">--Brand--</option>
                                        <?php foreach ($brand as $dt){?>
                                                <option value="<?=$dt["namabrand"]?>"><?=$dt["namabrand"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select id="kategori" class="form-control" name="kategori" width="100%">
                                        <option value="all">--Kategori--</option>
                                        <?php foreach ($kategori as $dt){?>
                                                <option value="<?=$dt["namakategori"]?>"><?=$dt["namakategori"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-sm-1"><button id="lihat" class="btn btn-primary">Lihat</button></div>
                            </div>
                            <hr>
                            <table id="table_data" class="mt-3 table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>Nota</th>
                                    <th>Tanggal</th>
                                    <th>Barcode</th>
                                    <th>Brand</th>
                                    <th>Nama Produk</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <!-- ======= End Brand Penjualan ====== -->
			</div>
			<!-- ======= End Row Content ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->