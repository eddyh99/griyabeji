

<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row mb-3">
				<div class="card my-10">
					<?php if (isset($_SESSION["message"])){?>
					<div class="alert alert-success"><?=$_SESSION["message"]?></div>
					<?php } ?>
					<input type="hidden" id="key" value="<?=$key?>">
					<input type="hidden" id="memberid" value="<?=$memberid?>">
					<div class="card-content px-10 my-10">
						<table id="table_retur" class="table table-striped nowrap" width="100%">
								<thead>
								<tr>
									<th></th>
									<th>Barcode</th>
									<th>Produk</th>
									<th>Brand</th>
									<th>Size</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total</th>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
					</div>
					<label class="col-form-label col-sm-1 p-4">Total</label>
					<input type="hidden" id="ttlretur" value="0">
					<div class="col-sm-3 p-4"><input type="text" id="total" class="form-control mb-3" value="0" readonly></div>
				</div>
			</div>
			<!-- ======= End Row Content Canva JS ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->


<!-- Input size -->
<div class="modal fade" id="modalsize">
	<div class="modal-dialog modal-sm">
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
							<select id="size" class="form-control" name="size"></select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan" value="persen"> Persen
						</div>
						<div class="col-sm-6">
							<input type="radio" name="potongan" id="potongan" value="fixed"> Fixed
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-4">
							<label class="col-form-label">Potongan</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="diskon" id="diskon" onkeypress="return isNumber(event)">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-4">
							<label class="col-form-label">Keterangan</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="keterangan" id="keterangan" maxlength="50">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
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
					<label class="col-form-label col-sm-3">Retur</label>
					<div class="col-sm-4">
						<span id="totalretur"></span>
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
						<input type="text" name="chargefee" id="chargefee" class="form-control">
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
