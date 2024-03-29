<!-- ======= Start Content wrapper ====== -->
<div class="container-fluid container-md mb-10 mt-auto">
	<div class="row my-5">
		<div class="col-4">
			<label>Kode Reservasi (optional)</label><br>
			<div class="row">
				<div class="col">
					<input type="text" class="form-control rounded-pill" name="kode_reservasi" id="kode_reservasi" placeholder="ALT+F1 utk pencarian">
					<input type="hidden" class="form-control rounded-pill" name="reservasi" id="reservasi">
					<small class="ms-5" id="notif_reservasi"></small>
				</div>
				<div class="col-auto">
					<button class="btn btn-beji rounded-pill" id="searchReservasi">Cari</button>
				</div>
			</div>
		</div>
		<div class="col-4">
			<label>Guide</label>
			<select name="guide" id="guide" class="form-control rounded-pill">
				<option></option>
				<?php foreach ($guide as $dt) { ?>
					<option value="<?= $dt["id"] ?>"><?= $dt["nama"] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-4">
			<label>Pengayah</label>
			<select name="pengayah" id="pengayah" class="form-control rounded-pill">
				<option></option>
				<?php foreach ($pengayah as $dt) { ?>
					<option value="<?= $dt["id"] ?>"><?= $dt["nama"] ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col">
			<label>Pengunjung</label>
			<div class="row">
				<div class="col">
					<select name="pengunjung" id="pengunjung" class="form-control rounded-pill">
						<option></option>
						<?php foreach ($pengunjung as $dt) { ?>
							<option data-state="<?= $dt["statename"] ?>" data-country="<?= $dt["countryname"] ?>" value="<?= $dt["id"] ?>"><?= $dt["nama"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col">
					<button class="btn btn-beji rounded-pill" id="add" data-bs-toggle="modal" data-bs-target="#newvisitor">Pengunjung Baru</button>
				</div>
				<input type="text" name="jumlah_pengunjung" id="jumlah_pengunjung" hidden>
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-12">
			<div class="row g-3 repeatDiv" id="repeatDiv">
				<div class="col-3">
					<label>Items</label>
					<select name="namaitems[]" id="namaitem" class="form-control namaitems rounded-pill" id="selectItems">
						<option></option>
						<?php foreach ($items as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namaitem"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-3">
					<label>Produk</label>
					<select name="namaproduk[]" id="namaproduk" class="form-control namaproduk rounded-pill" id="selectProduk">
						<option></option>
						<?php foreach ($produks as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namaproduk"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-3">
					<label>Paket</label>
					<select name="namapaket[]" id="namapaket" class="form-control namapaket rounded-pill" id="selectPaket">
						<option></option>
						<?php foreach ($pakets as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namapaket"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-1">
					<label>Jumlah</label>
					<input type="text" name="jml[]" id="jml" class="form-control rounded-pill" value="1">
				</div>
				
				<!--<div class="col" id="hide_add">
					<button class="btn btn-beji btn-icon remove rounded-circle mt-7" id="addfield" data-increment="1">
						<i class="fas fa-plus"></i>
					</button>
					<button id="check">check</button>
				</div>-->
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-12 d-grid gap-2">
			<button id="addbuy" class="btn btn-beji rounded-pill">Tambah</button>
		</div>
	</div>
	<div class="row mb-5">
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
	<div class="row mb-5">
		<div class="col-12 text-end">
			<button id="btnbayar" class="btn btn-beji rounded-pill">Pembayaran</button>
		</div>
	</div>
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
				<!-- ====== Start Tambah Pengguna ====== -->
				<form id="form_pengguna">
					<div class="form-group row my-3">
						<label class="col-sm-3 col-form-label">Nama</label>
						<div class="col-sm">
							<input type="text" class="form-control rounded-pill" id="nama" name="nama" maxlength="35">
						</div>
					</div>
					<div class="form-group row my-3">
						<label class="col-sm-3 col-form-label">Whatsapp</label>
						<div class="col-sm">
							<input type="number" class="form-control rounded-pill" id="whatsapp" name="whatsapp" maxlength="14">
						</div>
					</div>
					<div class="form-group row my-3">
						<label class="col-sm-3 col-form-label">Email</label>
						<div class="col-sm">
							<input type="text" class="form-control rounded-pill" id="email" name="email">
						</div>
					</div>
					<div class="form-group row my-3">
						<label class="col-sm-3 col-form-label">Instagram</label>
						<div class="col-sm">
							<input type="text" class="form-control rounded-pill" id="ig" name="ig">
						</div>
					</div>
					<div class="form-group row my-5">
						<label class="col-sm-3 col-form-label">Pilih Negara</label>
						<div class="col-sm">
							<select id="countryname" name="countryname" class="form-control rounded-pill">
								<option value="" disabled selected>--Pilih Negara--</option>
								<?php foreach ($countries as $country) { ?>
									<option value="<?= $country["code"] ?>"><?= $country["name"] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group row my-5">
						<label class="col-sm-3 col-form-label">Pilih Provinsi</label>
						<div class="col-sm">
							<select id="statename" name="statename" class="form-control rounded-pill">
								<option value="" disabled selected>--Pilih Provinsi--</option>
							</select>
						</div>
					</div>
				</form>
				<!-- ====== End Tambah Pengguna ====== -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
				<button type="button" id="simpandata" class="btn btn-beji rounded-pill">Save changes</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="carireservasi" tabindex="-1" aria-labelledby="newvisitorLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Data Reservasi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<select id="listreservasi" class="form-control">
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
				<button type="button" id="pilihreservasi" class="btn btn-beji rounded-pill">Pilih</button>
			</div>
		</div>
	</div>
</div>