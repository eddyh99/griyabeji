<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">
<input type="hidden" id="iditems">
    <!-- ====== Start Content ====== -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- ======= Start Content container ======== -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- ======= Start Row Content Canva JS ====== -->

            <div class="row my-10">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label">Nama Items</label>
                            <select id="items" name="items" class="form-control">
                                <option value="" disabled selected>--Pilih Items--</option>
                                <?php foreach ($items as $dt){?>
                                    <option value="<?=$dt["id"]?>"><?=$dt["namaitem"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-2 mt-3">
                            <button class="btn btn-primary" id="btnpayment">Simpan</button>
                        </div>
                        <div class="col-12"><hr></div>
                            <table id="table_data" class="table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>Id Items</th>
                                    <th>Nama Item</th>
                                    <th>Qty</th>
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
                                </tr>
                                </tfoot>
                            </table>
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

<!-- Input size -->
<div class="modal fade" id="modalsize">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Size</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-12">
					<input type="hidden" id="produk">
					<div class="row form-group">
						<div class="col-sm-4">
							Jumlah
						</div>
						<div class="col-sm-6">
							<input type="number" class="form-control" name="jumlah" id="jumlah" required>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btlbeli" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Alert Message -->
<?php if (isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: '<?= $_SESSION['success'] ?>',
                position: 'top-end',
                background: '#50CD89',
                customClass: {
                    title: 'toast-griya-title',
                },
                timer: 3000,
                showConfirmButton: false,
            });
        }, 100);
    </script>
<?php } ?>