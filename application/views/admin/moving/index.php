<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row ">
                <!-- ======= Start Brand ====== -->
                <div class="col-md-12 my-10 text-right">
                        <a class="btn btn-primary" href="<?=base_url()?>admin/moving/tambah">Tambah</a>
                    </div>
                <div class="card">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content">
                            <table id="table_data" class="table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No. Permintaan</th>
                                    <th>Tanggal</th>
                                    <th>Minta Ke</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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