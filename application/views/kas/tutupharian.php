<div class="d-flex flex-column flex-column-fluid">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="row my-10">
                <!-- ====== Start Tambah Brand ====== -->
                <?php if (isset($_SESSION["message"])){?>
                <div class="alert alert-success"><?=$_SESSION["message"]?></div>
                <?php } ?>
                <?php if (isset($_SESSION["gagal"])){?>
                <div class="alert alert-danger"><?=$_SESSION["gagal"]?></div>
                <?php } ?>

                <div class="card">
                    <div class="card-content">
                        <form action="<?=base_url()?>kas/tutupharian" method="get">
                            <?php /*?>
                            <?php if (($_SESSION["logged_status"]["role"]=="Office Manager")||($_SESSION["logged_status"]["role"]=="Office Staff")||($_SESSION["logged_status"]["role"]=="Owner")){?>
                            <div class="row ms-1 ms-md-10 my-5 mt-10 form-group">
                                <label class="col-form-label col-sm-1">Store</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="store" id="store">
                                        <?php foreach($store as $dt){?>
                                                <option value="<?=$dt["storeid"]?>" <?php echo ($dt["storeid"]==$storeid) ? "selected":"" ?>><?=$dt["store"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <?php */?>
                            
                            <div class="row ms-1 ms-md-10 my-5 form-group">
                                <label class="col-form-label col-sm-1">Tanggal</label>
                                <div class="col-sm-3">
                                    <input type="text" id="tgl" name="tgl" class="form-control" value="<?=$tgl?>" autocomplete="off">
                                </div>
                                <div class="col-sm-1 mt-5 mt-sm-0">
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                </div>
                            </div>
                        </form>

                        <div class="row ms-1 ms-md-10 my-20" id="printarea">
                            <div class="col-sm-12 col-md-6 text-start">
                                <h3>Laporan Penjualan Harian</h3>
                            </div>
                            <div class="col-8">
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <label class="col-form-label col-5">Tanggal</label>
                                        <label class="col-form-label pe-2 text-right"><?=$tgl?></label>
                                    </div>
                                </div>
                                <div class="form-group my-5">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-5"><b>TOTAL PENJUALAN</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?=number_format($penjualan["jual"])?></b></label>
                                    </div>
                                </div>
                                <div class="form-group my-5">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label"><b>TOTAL RETUR</b></label>
                                        <label class="col-form-label text-right pe-2"><b><?=number_format($penjualan["retur"]["tunai"]+$penjualan["retur"]["non"])?></b></label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <div class="d-flex col-6 flex-column border border-2 border-gray-700">
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-5"><b>TUNAI</b></label>
                                        </div>
                                        <div class="w-100 col-6 d-flex justify-content-between align-items-center px-2 ">
                                            <label class="col-form-label col-5">Sisa Kas Sebelumnya</label>
                                            <label class="col-form-label pe-2 text-right"><?=number_format($penjualan["saldo"])?></label>
                                        </div>
                                    </div>
                                </div>
                                <br>        
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-5"><b>NON TUNAI</b></label>
                                        <label class="col-form-label pe-2 text-right"><b><?=number_format($penjualan["jual"]-$penjualan["tunai"]-$penjualan["retur"]["non"])?></b></label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-sm-12"><b>KAS KELUAR</b></label>
                                        <div class="col-sm-12">
                                            <table border="0">
                                            <?php 
                                                $kaskeluar=0;
                                                foreach($penjualan["kas"] as $dt){
                                                    if ($dt["jenis"]=="Keluar"){
                                                        $kaskeluar=$kaskeluar+$dt["nominal"];
                                            ?>
                                                        <tr>
                                                            <td class="col-sm-10"><label class="col-form-label"><?=$dt["keterangan"]?></label></td>
                                                            <td align="right"><?=number_format($dt["nominal"])?></td>
                                                        </tr>
                                            <?php   }
                                                }
                                            ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-sm-12"><b>KAS MASUK</b></label>
                                        <div class="col-sm-12">
                                            <table border="0">
                                            <?php 
                                                $kasmasuk=0;
                                                foreach($penjualan["kas"] as $dt){
                                                    if ($dt["jenis"]=="Masuk"){
                                                        $kasmasuk=$kasmasuk+$dt["nominal"];
                                            ?>
                                                        <tr>
                                                            <td class="col-sm-10"><label class="col-form-label"><?=$dt["keterangan"]?></label></td>
                                                            <td align="right"><?=number_format($dt["nominal"])?></td>
                                                        </tr>
                                            <?php   }
                                                }
                                            ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-5"><b>TOTAL UANG TUNAI</b></label>
                                        <label class="col-form-label pe-2 text-right"><b>
                                            <?php 
                                                $totaltunai=$penjualan["tunai"]+$penjualan["saldo"]-$kaskeluar+$kasmasuk-$penjualan["retur"]["tunai"];
                                                echo number_format($totaltunai);
                                            ?></b>
                                        </label>
                                    </div>
                                    <label class="col-sm-7">&nbsp;</label>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="col-6 d-flex justify-content-between align-items-center px-2 border border-2 border-gray-700">
                                        <label class="col-form-label col-5"><b>UANG DISETOR</b></label>
                                        <label class="col-form-label pe-2 text-right"><b>
                                            <?php
                                                $setor=floor($totaltunai / 50000)*50000;
                                                echo number_format(floor($totaltunai / 50000)*50000);
                                            ?></b>
                                        </label>
                                    </div>
                                    <label class="col-sm-7">&nbsp;</label>
                                </div>

                                <!-- PUSH REKAPAN HARIAN -->
                                <div class="col-8">
                                    <hr>
                                </div>
                                <form action="<?=base_url()?>kas" method="POST">
                                    <input type="hidden" name="tglback" value="<?=$tgl?>">
                                    <div class="form-group">
                                        <div class="col-6 d-flex justify-content-between align-items-center px-2">
                                            <label class="col-form-label col-sm-3"><b>SISA</b></label>
                                            <label class="col-form-label col-sm-2 text-right">
                                                <input type="hidden" name="sisa" value="<?=($totaltunai-$setor)?>">
                                                <b><?php echo number_format($totaltunai-$setor)?></b>
                                            </label>
                                        </div>
                                        <!-- <label class="col-sm-7">&nbsp;</label> -->
                                    </div>
                                    <div class="form-group row mt-10">
                                        <div class="col-6 d-flex justify-content-between align-items-center px-2">
                                            <div class="col-sm-3">
                                                <input type="button" class="btn btn-danger" onclick="printDiv('printarea')" value="Print">
                                                <!-- <input type="button" class="btn btn-danger" onclick="printPDF('printarea')" value="PDF"> -->
                                            </div>
                                            <?php if (($tgl==date("d M Y")) || ($_SESSION["logged_status"]["role"]=="Store Manager") || ($_SESSION["logged_status"]["role"]=="Office Manager")){?>
                                            <div class="col-sm-2 text-right">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== End Tambah Brand ====== -->

            </div>
            <!-- ======= End Row Content Canva JS ====== -->
        </div>
        <!-- ======= End Content container ======== -->
    </div>
    <!-- ====== End Content ====== -->
</div>