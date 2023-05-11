<!-- ======= Start Content wrapper ====== -->
<div class="d-flex flex-column flex-column-fluid ">

	<!-- ====== Start Content ====== -->
	<div id="kt_app_content" class="app-content flex-column-fluid overflow-x-hidden">
		<!-- ======= Start Content container ======== -->
		<div id="kt_app_content_container" class="app-container container-fluid ">
			
			<!-- ======= Start Row Content Canva JS ====== -->
			<div class="form-group row mt-10">
				<div class="col-2 mt-5 mt-md-0">
					<a class="btn btn-primary hanaka-back" href="<?=base_url()?>dashboard">
						<i class="fas fa-chevron-left"></i>
						Back
					</a>
				</div>
				</div>
			</div>

			<!-- Start Opsi Transaksi || Add Pengunjung -->
			<div>
				<div class="row mt-10">
					<div class="col-11 mx-auto">
						<div class="container-fluid ">
							<div class="row mt-4 mb-10">
								<div class="col-6">
									<button id="tabtransaksi" class="w-100 p-5">
										Transaksi
									</button>
								</div>
								<!-- <div class="col-1"></div> -->
								<div class="col-6 ">
									<button id="tabtambah" class="w-100 p-5">
										Tambah Pengunjung Baru
									</button>
								</div>
							</div>
						</div>
		
					</div>
				</div>
			</div>
			<!-- End Opsi Transaksi || Add Pengunjung -->

			<!-- START DISPLAY TRANSAKSI -->
			<div id="dtransaksi">
				<!-- Start Top Section -->
				<div class="bg-transaksi pb-20">
					<div class="row">
						<div class="col-6">
							<!-- Start Input Data Guide, Pengayah, Pengunjung -->
							<div class="row mx-auto mt-15">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<h3 class="">Masukkan User</h3>
									</div>
								</div>
							</div>
							<div class="row mx-auto mt-5">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<select id="guide" name="guide" class="form-control">
											<option value="" disabled selected>--Pilih Guide--</option>
											<?php foreach ($guide as $g){?>
												<option value="<?=$g["id"]?>"><?=$g["nama"]?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row mx-auto mt-7">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<select id="pengayah" name="pengayah" class="form-control">
											<option value="" disabled selected>--Pilih Pengayah--</option>
											<?php foreach ($pengayah as $p){?>
												<option  value="<?=$p["id"]?>"><?=$p["nama"]?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<!-- <div class="row mx-auto mt-7">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<form action="" method="post">
											<select id="pengguna" name="pengguna" class="form-control">
												<option value="" disabled selected>--Pilih Manager Untuk Diskon--</option>
												<?php foreach ($pengguna as $peng){?>
													<option value="<?=$peng["username"]?>"><?=$peng["nama"]?></option>
												<?php } ?>
											</select>		
										</form>
									</div>
								</div>
							</div> -->
							<div class="row mx-auto mt-7">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<div class="">
                                        	<input type="text" class="form-control" id="kodereservasi" name="kodereservasi" placeholder="input Kode Reservasi (optional)">
                                        </div>
									</div>
								</div>
							</div>
							<div class="row mx-auto mt-5">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<div class="d-flex  mt-5">
											<button type="submit" class="btn btn-primary text-center">Tambah</button>
										</div>
									</div>
								</div>
							</div>
							<!-- End Input Data Guide, Pengayah -->
						</div>
						<div class="col-6">
							<form action="" method="post">
								<div class="row col-10 mx-auto">
									<div class="accordion mt-10" id="accordionExample">
			
										<!-- Start Items Accordion  -->
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Pilih Items
												</button>
											</h2>
											<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
												<div class="accordion-body">
													<div class="form-group row">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Items</label>
															<select id="namaitems" name="namaitems" class="form-control">
																<option value="" disabled selected>--Pilih Items--</option>
																<?php foreach ($items as $item){?>
																	<option value="<?=$item["id"]?>"><?=$item["namaitem"]?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row my-3">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Jumlah</label>
															<input type="number" class="form-control" id="jumlahitems" name="jumlahitems" >
														</div>
													</div>
												</div>
												<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
													<button type="submit" class="btn btn-primary text-center">Tambah</button>
												</div>
											</div>
										</div>
										<!-- End Items Accordion -->
			
										<!-- Start Produk  Accordion  -->
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
													Pilih Produk 
												</button>
											</h2>
											<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
												<div class="accordion-body">
													<div class="form-group row">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Produk </label>
															<select id="namaproduk" name="namaproduk" class="form-control">
																<option value="" disabled selected>--Pilih Produk--</option>
																<?php foreach ($produks as $produk){?>
																	<option value="<?=$produk["id"]?>"><?=$produk["namaproduk"]?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row my-10">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Pengunjung </label>
															<select id="pengunjung" name="pengunjung" class="form-control pengunjung">
																<option value="" disabled selected>--Pilih Pengunjung--</option>
																<?php foreach ($pengunjung as $p){?>
																	<option value="<?=$p["id"]?>"><?=$p["nama"]?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row my-3">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Jumlah</label>
															<input type="number" class="form-control" id="jumlahproduk" name="jumlahproduk" >
														</div>
													</div>
												</div>
												<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
													<button type="submit" class="btn btn-primary text-center">Tambah</button>
												</div>
											</div>
										</div>
										<!-- End Produk Accordion -->
			
										<!-- Start Paket  Accordion  -->
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
													Pilih Paket 
												</button>
											</h2>
											<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
												<div class="accordion-body">
													<div class="form-group row">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Paket </label>
															<select id="namapaket" name="namapaket" class="form-control">
																<option value="" disabled selected>--Pilih Paket--</option>
																<?php foreach ($pakets as $paket){?>
																	<option value="<?=$paket["id"]?>"><?=$paket["namapaket"]?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row my-10">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Pengunjung </label>
															<select id="pengunjung2" name="pengunjung2" class="form-control pengunjung">
																<option value="" disabled selected>--Pilih Pengunjung--</option>
																<?php foreach ($pengunjung as $p){?>
																	<option value="<?=$p["id"]?>"><?=$p["nama"]?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row my-3">
														<div class="col-7 ">
															<label class="col-3 col-form-label">Jumlah</label>
															<input type="number" class="form-control" id="jumlahpaket" name="jumlahpaket" >
														</div>
													</div>
												</div>
												<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
													<button type="submit" class="btn btn-primary text-center">Tambah</button>
												</div>
											</div>
										</div>
										<!-- End Paket Accordion -->
									
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
				<!-- ENd Top Section -->
				
				<!-- Start Middle Section -->
				<!-- <div class="row mt-10">
					<div class="card">
						<div class="card-content py-6 px-8">
							<span>Nama Guide : Guide 1</span>
							<br>
							<span>Nama Pengayah : Pengayah 1</span>
								<table id="table_data" class="table table-striped" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Whatsapp</th>
											<th>Email</th>
											<th>IG</th>
											<th>Negara</th>
											<th>Provinsi</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
						</div>
					</div>
				</div> -->
				<!-- <div class="bg-success mt-10 pb-20">
					<form action="" method="post">
						<div class="row col-10 mx-auto">
							<div class="accordion mt-10" id="accordionExample">

								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Pilih Items
										</button>
									</h2>
									<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<div class="form-group row">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Items</label>
													<select id="namaitems" name="namaitems" class="form-control">
														<option value="" disabled selected>--Pilih Items--</option>
														<?php foreach ($guide as $g){?>
															<option value="<?=$g["id"]?>"><?=$g["nama"]?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Jumlah</label>
													<input type="number" class="form-control" id="jumlahitems" name="jumlahitems" >
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
											<button type="submit" class="btn btn-primary text-center">Tambah</button>
										</div>
									</div>
								</div>

								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											Pilih Produk 
										</button>
									</h2>
									<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<div class="form-group row">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Produk </label>
													<select id="namaproduk" name="namaproduk" class="form-control">
														<option value="" disabled selected>--Pilih Produk--</option>
														<?php foreach ($guide as $g){?>
															<option value="<?=$g["id"]?>"><?=$g["nama"]?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Jumlah</label>
													<input type="number" class="form-control" id="jumlahproduk" name="jumlahproduk" >
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
											<button type="submit" class="btn btn-primary text-center">Tambah</button>
										</div>
									</div>
								</div>

								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
											Pilih Paket 
										</button>
									</h2>
									<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<div class="form-group row">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Paket </label>
													<select id="namapaket" name="namapaket" class="form-control">
														<option value="" disabled selected>--Pilih Paket--</option>
														<?php foreach ($guide as $g){?>
															<option value="<?=$g["id"]?>"><?=$g["nama"]?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 ">
													<label class="col-3 col-form-label">Jumlah</label>
													<input type="number" class="form-control" id="jumlahpaket" name="jumlahpaket" >
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-start ms-6 mt-2 mb-10">
											<button type="submit" class="btn btn-primary text-center">Tambah</button>
										</div>
									</div>
								</div>

							
							</div>
						</div>
					</form>
				</div> -->
				<!-- Start Middle Section -->
				
				<!-- Start Bottom Section -->
				<div class="row mt-10">
					<div class="card">
						<div class="card-content py-6 px-8">
							<div class="mb-10 ms-10">
								<h5>Guide : <span class="text-decoration-underline text-primary">Ari</span> </h5>
								<h5>Pengayah : <span class="text-decoration-underline text-primary">Wayan</span></h5>
							</div>
								<table id="table_summary" class="table table-striped" width="100%">
									<thead>
										<tr>
											<th>Items</th>
											<th>Produk</th>
											<th>Paket</th>
											<th>Jumlah</th>
											<th>Disc</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
						</div>
					</div>
				</div>
				<div class="bg-transaksi  mt-10 pt-10 pb-20">
					<form action="" method="post">
						<div class="row col-10 mx-auto">
							<div class="row mx-auto">
								<div class="form-group col-12">
									<div class="col-8 mx-auto">
										<select id="pengguna" name="pengguna" class="form-control">
											<option value="" disabled selected>--Pilih Manager Untuk Diskon--</option>
											<?php foreach ($pengguna as $peng){?>
												<option value="<?=$peng["username"]?>"><?=$peng["nama"]?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>

					<form action="" method="post">
						<div class="row mt-10">
							<div class="col-3 mx-auto text-center">
								<button class="btn btn-primary w-50 h-70px fw-bold fs-3">
									Tambah NOTA
								</button>
							</div>
						</div>
					</form>
				</div>
				<!-- End Bottom Section -->
			
			</div>
			<!-- END DISPLAY TRANSAKSI -->

			<!-- START DISPLAY ADD PENGUNJUNG  -->
			<div id="dtambah">

				<!-- Start Add Data Pengunjung -->
				<div class="bg-transaksi mt-10 pt-10 pb-20">
					<div class="row">
						<!-- ====== Start Tambah Pengguna ====== -->
						<div class="mt-10">
							<div class="card-content col-12">
								<form id="form_input" method="post" action="<?=base_url()?>pengunjung/AddData">
									<div class="col-6 mx-auto">
										<div class="card-body">
											<div class="form-group row my-3">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Nama</label>
												<input type="text" class="form-control" id="nama" name="nama" maxlength="35">
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Whatsapp</label>
												<input type="number" class="form-control" id="whatsapp" name="whatsapp" maxlength="14">
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Email</label>
												<input type="text" class="form-control" id="email" name="email" >
												</div>
											</div>
											<div class="form-group row my-3">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Instagram</label>
													<input type="text" class="form-control" id="ig" name="ig">
												</div>
											</div>
											<div class="form-group row my-5">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Negara</label>
													<select id="countryname" name="countryname" class="form-control">
														<option value="" disabled selected>--Pilih Negara--</option>
														<?php foreach ($countries as $country){?>
															<option value="<?=$country["code"]?>"><?=$country["name"]?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group row my-5">
												<div class="col-7 mx-auto">
													<label class="col-sm-3 col-form-label">Provinsi</label>
													<select id="statename" name="statename" class="form-control">
														<option value="" disabled selected>--Pilih Provinsi--</option>
														<?php foreach ($states as $state){?>
															<option value="<?=$state["state_code"]?>"><?=$state["state_name"]?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row my-10">
										<div class="col-6 mx-auto d-flex justify-content-center">
											<button id="btnSimpan" name="btnSimpan"  class="btn btn-primary">Tambah</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- ====== End Tambah Pengguna ====== -->
					</div>
				</div>
				<!-- End Add Data Pengunjung -->
				
				<!-- Start Preview Data Pengunjung -->
				<div class="row mt-10">
					<div class="card">
						<div class="card-content py-6 px-8">
							<div class="col-3 my-4"><button id="simpan" class="btn btn-primary">Simpan</button></div>
								<table id="table_prev_pengunjung" class="table table-striped" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Whatsapp</th>
											<th>Email</th>
											<th>IG</th>
											<th>Provinsi</th>
											<th>Negara</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
						</div>
					</div>
				</div>
				<!-- End Preview Data Pengunjung -->

			</div>
			<!-- END DISPLAY ADD PENGUNJUNG  -->

			<!-- ======= End Row Content Canva JS ====== -->
											
    	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Diskon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  	<div class="form-group row ">
			<div class="col-12 ">
				<label class="col-12 col-form-label">Nominal Diskon</label>
				<input type="number" class="form-control" id="diskon" name="diskon" >
			</div>
		</div>
	  	<div class="form-group row mt-5">
			<div class="col-12 ">
				<label class="col-12 col-form-label">Masukan PIN</label>
				<input type="password" class="form-control" id="pin" name="pin" >
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

