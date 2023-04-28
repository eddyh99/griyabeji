<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row ">
                <!-- ======= Start Brand ====== -->
                <div class="card my-10 p-10">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <input type="hidden" id="key" value="<?=$key?>">
                    <div class="card-content">
                        <table id="table_pinjam" class="table table-striped nowrap" width="100%">
                        <div class="col-sm-3"><button id="simpan" class="btn btn-primary">Simpan</button></div>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Barcode</th>
                                    <th>Produk</th>
                                    <th>Brand</th>
                                    <th>Size</th>
                                    <th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
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