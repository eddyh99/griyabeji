<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content  ====== -->
			<div class="row ">
                <!-- ======= Start Persediaan Penjualan Detail ====== -->
                <div class="col-md-12 text-right my-10">
                    <a class="btn btn-primary" href="<?=base_url()?>admin/laporan/penjualan">Kembali</a>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-content px-10 my-10">
                            <input type="hidden" id="key" value="<?=$key?>">
                            <table id="table_data" class="mt-3 table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>Nota</th>
                                    <th>Nama Produk</th>
                                    <th>Nama Brand</th>
                                    <th>Size</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Disc</th>
                                    <th>Disc (%)</th>
                                    <th>Total</th>
                                    <?php if ($_SESSION["logged_status"]["role"]!="Staff"){?>
                                    <th>Alasan</th>
                                    <?php }?>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <!-- ======= End Persediaan Penjualan Detail ====== -->
			</div>
			<!-- ======= End Row Content  ====== -->

		</div>
		<!-- ====== End Content container ====== -->
	</div>
	<!--====== End Content ====== -->
</div>
<!--======= End Content wrapper ====== -->