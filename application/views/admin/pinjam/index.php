<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row ">
                <!-- ======= Start Brand ====== -->
                <div class="col-md-12 text-right my-10">
                    <a class="btn btn-primary" href="<?=base_url()?>admin/pinjam/tambah">Tambah</a>
                </div>
                <div class="card">
                    <?php if (isset($_SESSION["message"])){?>
                    <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                    <?php } 
                    if (($_SESSION["logged_status"]["role"]=="Office Manager")||($_SESSION["logged_status"]["role"]=="Owner")){?>
                        <div class="row form-group p-10">
                            <label class="col-form-label col-sm-1">Store</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="store" id="store">
                                    <?php foreach($store as $dt){?>
                                            <option value="<?=$dt["storeid"]?>"><?=$dt["store"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    <?php }else{?>
                        <input type="hidden" id="store" name="store" value="<?=$_SESSION["logged_status"]["storeid"]?>">
                    <?php } ?>
                    <div class="card-content">
                            <table id="table_data" class="table table-striped nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
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