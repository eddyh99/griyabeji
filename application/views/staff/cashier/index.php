<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid ">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<input type="hidden" id="tujuan" value="<?=$_SESSION["logged_status"]["storeid"];?>">
			<div class="form-group row mx-auto d-flex flex-column-reverse flex-md-row align-items-center justify-content-center">
				<div class="col-2 col-4 mt-5 mt-md-0">
					<a class="btn btn-primary hanaka-back" href="<?=base_url()?>staff/dashboard">
						<i class="fas fa-chevron-left"></i>
						Back
					</a>
				</div>
				<div class="col-10 col-md-4 mx-auto">
					<img class="img-fluid" src="<?=base_url()?>/assets/img/logo.png"  />
				</div>
				<div class="col-4 d-none d-md-block">
				</div>
			</div>

			<div class="row pt-10">
				<div class="col-sm-12">
					<div class="card ">
						<div class="form-group row p-10">
						<label class="col-form-label">Store : <span class="text-decoration-underline"><?=$_SESSION["logged_status"]["store"]?></span></label>
						</div>
						<div class="form-group row px-10">
							<label class="col-form-label col-sm-2">Nama Member :</label>
							<div class="col-sm-5">
								<span class="membername"></span>
							</div>
						</div>
						<div class="card-body ">
							<div class="row d-flex align-items-center">
								<div class="col-12 col-xl-4 px-5">
									<label class="col-form-label">Barcode</label>
									<input type="text" id="barcode" name="barcode" class="form-control input-lg" maxlength="13" required  onkeypress="return isNumber(event)">
								</div>
								<div class="col-12 col-xl-4 px-5">
									<div class="col-xl-12">
										<label class="col-form-label">Nama Produk</label>
									</div>
									<div class="col-xl-12">
										<select id="namaproduk" name="namaproduk" class="form-control">
											<option value="" disabled selected>Pilih Produk</option>
											<?php foreach($produk as $dt){?>
												<option value="<?=$dt["barcode"]?>"><?=$dt["namaproduk"]?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="col-12 col-xl-4 row">
									<div class="col-6 col-md-3 mt-5">
										<button class="hanaka-button btn btn-success" id="btnnew">Nota Baru</button>
									</div>
									<div class="col-6 col-md-3 mt-5">
										<button class="hanaka-button btn btn-success" id="btnmember">Member</button>
									</div>
									<div class="col-6 col-md-3 mt-5">
										<button class="hanaka-button btn btn-success" id="btncari">Cari Barang</button>
									</div>
									<div class="col-6 col-md-3 mt-5">
										<button class="hanaka-button btn btn-success" id="btnpayment">Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>        

			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<table id="table_data" class="table table-striped nowrap" width="100%">
								<thead>
								<tr>
									<th width="150px">Barcode</th>
									<th width="200px">Produk</th>
									<th width="100px">Size</th>
									<th width="100px">Qty</th>
									<th width="150px">Harga</th>
									<th>Diskon</th>
									<th>Diskon (%)</th>
									<th>Total</th>
									<th>Aksi</th>
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
									<th></th>
									<th style="text-align:right">Total</th>
									<th></th>
									<th></th>
								</tr>
								</tfoot>
							</table>
						</div>
					</div>				
				</div>
			</div>
			<!-- ======= End Row Content Canva JS ====== -->
											
    	</div>
	</div>
</div>

<!-- Input size -->
<div class="modal fade" id="modalsize">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Size & Discount</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-12">
					<input type="hidden" id="produk">
					<input type="hidden" id="harga">
					<div class="row form-group">
						<div class="col-sm-4">
							<label class="col-form-label">Size</label>
						</div>
						<div class="col-sm-4">
							<select id="size" class="form-control" name="size" id="size"></select>
						</div>
					</div>
					<div class="row form-group mt-3">
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan1" value="persen"> Persen
						</div>
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan2" value="fixed"> Fixed
						</div>
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan3" value="sale"> Sale
						</div>
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan4" value="nodisk" checked> No Diskon
						</div>
					</div>
					<div id="diskonsale" class="row form-group mt-3">
						<div class="col-sm-4">
							<label class="col-form-label">Potongan</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="diskon" id="diskon" onkeypress="return isNumber(event)" disabled>
						</div>
					</div>
					<div id="ketsale" class="row form-group mt-3">
						<div class="col-sm-4">
							<label class="col-form-label">Keterangan</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="keterangan" id="keterangan" maxlength="50" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" id="btlbeli" data-bs-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Input Member -->
<div class="modal fade" id="modalmember">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Member ID</h4>
			</div>
			<div class="modal-body" style="height:150px">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="memberid" id="memberid">
					Nama: <span class="membername"></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" id="batalmember" data-bs-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="simpanmember">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Pencarian Produk-->
<div class="modal fade" id="cariproduk">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Pencarian Produk</h4>
			</div>
			<div class="modal-body" style="height:auto">
				<div class="row form-group">

					<div class="col-sm-12">
                    	<table id="table_cari" class="table table-striped nowrap" width="100%">
                    	    <thead>
                    		<tr>
                    			<th>Barcode</th>
                    			<th>Produk</th>
                    			<th>Brand</th>
                    			<th>Harga</th>
                    			<th>Size</th>
                    			<th>Qty</th>
                    			<th>Lokasi</th>
                    		</tr>
                    	    </thead>
                    	    <tbody>
                    	    </tbody>
                    	</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-bs-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<!-- Payment Page -->
<div class="modal fade" id="modalpayment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Payment Page</h4>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<label class="col-form-label col-sm-3">Total</label>
					<div class="col-sm-4">
						<span id="totalbelanja"></span>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-form-label col-sm-3">Cara Bayar</label>
					<div class="col-sm-4">
						<select id="carabayar" name="carabayar" class="form-control">
							<option value="cash">Cash</option>
							<option value="debit">Debit Card</option>
							<option value="credit">Credit Card</option>
						</select>
					</div>
				</div>
				<div class="row form-group" id="chargecard">
					<label class="col-form-label col-sm-3">Charge Fee</label>
					<div class="col-sm-4">
						<input type="text" name="chargefee" id="chargefee" class="form-control"  onkeypress="return isNumber(event)">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-form-label col-sm-3">Grand Total</label>
					<div class="col-sm-4">
						<span id="grandtotal"></span>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-form-label col-sm-3">Pembayaran</label>
					<div class="col-sm-4">
						<input type="text" name="amountpay" id="amountpay" class="form-control" required  onkeypress="return isNumber(event)">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-form-label col-sm-3">Kembalian</label>
					<div class="col-sm-4">
						<span id="exchange"></span>						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="simpaninvoice">Simpan</button>
			</div>
		</div>
	</div>
</div>
