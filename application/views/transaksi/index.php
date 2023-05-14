<!-- ======= Start Content wrapper ====== -->
<div class="d-flex">
	<div class="col-4">
		<label>Kode Reservasi (optional)</label>
		<input type="text" class="form-control" name="reservasi" id="reservasi">
	</div>
	<div class="col-4">
		<label>Guide</label>
		<select name="guide" id="guide" class="form-control">
			<option></option>
			<?php foreach($guide as $dt){?>
				<option value="<?=$dt["id"]?>"><?=$dt["nama"]?></option>
			<?php }?>
		</select>
	</div>
	<div class="col-4">
		<label>Pengayah</label>
		<select name="pengayah" id="pengayah" class="form-control">
			<option></option>
			<?php foreach($pengayah as $dt){?>
				<option value="<?=$dt["id"]?>"><?=$dt["nama"]?></option>
			<?php }?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-4">
		<label>Pengunjung</label>
		<div class="row">
			<div class="col-11">
				<select name="pengunjung" id="pengunjung" class="form-control">
					<?php foreach($pengunjung as $dt){?>
						<option data-state="<?=$dt["statename"]?>" data-country="<?=$dt["countryname"]?>" value="<?=$dt["id"]?>"><?=$dt["nama"]?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-1">
				<button id="add" data-bs-toggle="modal" data-bs-target="#newvisitor">Pengunjung Baru</button>
			</div>
		</div>
	</div>
	<div class="d-flex flex-column">
		<div class="d-flex repeatDiv" id="repeatDiv">
		<div class="col-3">
			<label>Items</label>
			<select name="namaitems[]" class="form-control namaitems">
				<option></option>
				<?php foreach($items as $dt){?>
					<option data-lokal="<?=$dt["lokal"]?>" data-domestik="<?=$dt["domestik"]?>" data-inter="<?=$dt["internasional"]?>" value="<?=$dt["id"]?>"><?=$dt["namaitem"]?></option>
				<?php }?>
			</select>
		</div>
		<div class="col-1">
			<label>Jumlah</label>
			<input type="text" name="jml[]" id="jml" class="form-control" value="1">
		</div>
		<div class="col-3">
			<label>Produk</label>
			<select name="namaproduk[]" class="form-control namaproduk">
				<option></option>
				<?php foreach($produks as $dt){?>
					<option data-lokal="<?=$dt["lokal"]?>" data-domestik="<?=$dt["domestik"]?>" data-inter="<?=$dt["internasional"]?>" value="<?=$dt["id"]?>"><?=$dt["namaproduk"]?></option>
				<?php }?>
			</select>
		</div>
		<div class="col-3">
			<label>Paket</label>
			<select name="namapaket[]" class="form-control namapaket">
				<option></option>
				<?php foreach($pakets as $dt){?>
					<option data-lokal="<?=$dt["lokal"]?>" data-domestik="<?=$dt["domestik"]?>" data-inter="<?=$dt["internasional"]?>" value="<?=$dt["id"]?>"><?=$dt["namapaket"]?></option>
				<?php }?>
			</select>
		</div>
		</div>
		<div class="col-1">
			<button id="addfield" data-increment="1">+</button>
			<button id="check">check</button>
		</div>
	</div>	
	<button id="addbuy" class="col-3 btn btn-primary">Tambah</button>
	<div class="row">
		<div class="col-12">
			<table id="pesanan" class="display" width="100%">
			<tfoot>
				<tr>
					<th colspan="3" style="text-align:right">Total:</th>
					<th></th>
				</tr>
			</tfoot>
			</table>
		</div>
	</div>
	<button id="btnbayar">Pembayaran</button>
</div>

<!-- Modal -->
<div class="modal fade" id="newvisitor" tabindex="-1" aria-labelledby="newvisitorLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pengunjung Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  	<div class="row">
			<!-- ====== Start Tambah Pengguna ====== -->
			<div class="card mt-10">
				<div class="card-content">
					<form id="form_input">
						<div class="col-lg-6">
							<div class="card-body">
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Nama</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" id="nama" name="nama" maxlength="35">
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Whatsapp</label>
									<div class="col-sm-7">
									<input type="number" class="form-control" id="whatsapp" name="whatsapp" maxlength="14">
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Email</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" id="email" name="email" >
									</div>
								</div>
								<div class="form-group row my-3">
									<label class="col-sm-3 col-form-label">Instagram</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="ig" name="ig">
									</div>
								</div>
								<div class="form-group row my-5">
									<label class="col-sm-3 col-form-label">Pilih Negara</label>
									<div class="col-sm-7">
										<select id="countryname" name="countryname" class="form-control">
											<option value="" disabled selected>--Pilih Negara--</option>
											<?php foreach ($countries as $country){?>
												<option value="<?=$country["code"]?>"><?=$country["name"]?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group row my-5">
									<label class="col-sm-3 col-form-label">Pilih Provinsi</label>
									<div class="col-sm-7">
										<select id="statename" name="statename" class="form-control">
											<option value="" disabled selected>--Pilih Provinsi--</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- ====== End Tambah Pengguna ====== -->
		</div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="simpandata" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

