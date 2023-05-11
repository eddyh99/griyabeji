<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row mt-10">
                <div class="card">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                    <?php } ?>
                    <div class="card-content py-6 px-8">
                        <form id="frm-approve" action="<?=base_url()?>penyesuaian/simpandata" method="post">
                            <div class="col-sm-3">
                                <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                            <table id="table_data" class="table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th class="check">
                                        <input type="checkbox" id="flowcheckall" value="" />
                                    </th>
                                    <th>Tanggal</th>
                                    <th>Items</th>
                                    <th>Stok System</th>
                                    <th>Stok Riil</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Aprroved</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
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


