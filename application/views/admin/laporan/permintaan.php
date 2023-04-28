<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content ====== -->
			<div class="row ">
                <!-- ======= Start Brand Permintaan ====== -->
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
                                    <select id="store" class="form-control" name="store">
                                        <?php foreach ($store as $dt){?>
                                                <option value="<?=$dt["storeid"]?>"><?=$dt["store"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select id="jenis" name="jenis" class="form-control">
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="col-sm-1"><button id="lihat" class="btn btn-primary">Lihat</button></div>
                            </div>
                            <hr>
                            <table id="table_data" class="mt-3 table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Barcode</th>
                                    <th>Nama Produk</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Asal/Tujuan</th>
                                    <th>Status</th>
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
                <!-- ======= End Brand Permintaan ====== -->
			</div>
			<!-- ======= End Row Content ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->