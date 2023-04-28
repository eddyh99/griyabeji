<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row ">
                <!-- ======= Start Brand ====== -->
                <div class="card my-10">
					<div class="card-content">
						<div class="col-lg-6">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Toko yang diminta</label>
										<label class="col-sm-7 col-form-label"><?=$asal?></label>
										<label class="col-sm-4 col-form-label">Toko yang meminta</label>
										<label class="col-sm-7 col-form-label"><?=$tujuan?></label>
									</div>
								</div>
							</div>
					</div>
				</div>  
                <!-- ======= End Brand ====== -->
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row ">
                <!-- ======= Start Brand ====== -->
                <div class="card">
					<input type="hidden" id="mutasi" value="<?=$key?>">
					<div class="card-content">
							<table id="table_data" class="table table-striped nowrap" width="100%">
								<thead>
								<tr>
									<th>Barcode</th>
									<th>Nama Produk</th>
									<th>Size</th>
									<th>Brand</th>
									<th>Jumlah</th>
								</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
								</tfoot>
							</table>
					</div>
				</div>
                <!-- ======= End Brand ====== -->
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->