<!-- ======= Start Content wrapper ====== -->
<div class="container-fluid container-md mb-10 mt-auto">
	<div class="row my-5">
		<div class="col">
			<label>Guide (optional)</label>
			<select name="guide" id="guide" class="form-control rounded-pill">
				<option></option>
				<?php foreach ($guide as $dt) { ?>
					<option value="<?= $dt["id"] ?>"><?= $dt["nama"] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col">
			<label>Pengayah (optional)</label>
			<select name="pengayah" id="pengayah" class="form-control rounded-pill" <?= ($_SESSION["logged_status"]["role"] == "pengayah") ? 'disabled' : ''; ?>>
				<option></option>
				<?php foreach ($pengayah as $dt) { ?>
					<option value="<?= $dt["id"] ?>" <?= ($_SESSION["logged_status"]["role"] == "pengayah" && $dt["username"] == $_SESSION["logged_status"]["username"]) ? 'selected' : ''; ?>><?= $dt["nama"] ?></option>
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
						<?php foreach ($pengunjung as $dt) { ?>
							<option data-state="<?= $dt["statename"] ?>" data-country="<?= $dt["countryname"] ?>" value="<?= $dt["id"] ?>"><?= $dt["nama"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-auto">
					<button class="btn btn-beji rounded-pill" id="add" data-bs-toggle="modal" data-bs-target="#newvisitor">Pengunjung Baru</button>
				</div>
			</div>
		</div>
		<div class="col">
			<label>Jumlah Pengunjung</label>
			<div class="col">
				<input type="text" class="form-control rounded-pill typeMoney" name="jumlah_pengunjung" id="jumlah_pengunjung">
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-12">
			<div class="row g-3 repeatDiv" id="repeatDiv">
				<div class="col-3">
					<label>Items</label>
					<select name="namaitems[]" class="form-control namaitems rounded-pill">
						<option></option>
						<?php foreach ($items as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namaitem"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-1">
					<label>Jumlah</label>
					<input type="text" name="jml[]" id="jml" class="form-control rounded-pill" value="1">
				</div>
				<div class="col-3">
					<label>Produk</label>
					<select name="namaproduk[]" class="form-control namaproduk rounded-pill">
						<option></option>
						<?php foreach ($produks as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namaproduk"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-3">
					<label>Paket</label>
					<select name="namapaket[]" class="form-control namapaket rounded-pill">
						<option></option>
						<?php foreach ($pakets as $dt) { ?>
							<option data-lokal="<?= $dt["lokal"] ?>" data-domestik="<?= $dt["domestik"] ?>" data-inter="<?= $dt["internasional"] ?>" value="<?= $dt["id"] ?>"><?= $dt["namapaket"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col" id="hide_add">
					<button class="btn btn-beji btn-icon remove rounded-circle mt-7" id="addfield" data-increment="1">
						<i class="fas fa-plus"></i>
					</button>
					<!-- <button id="check">check</button> -->
				</div>
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
			<button id="btnbayar" class="btn btn-beji rounded-pill">Ringkasan</button>
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
				<form id="form_input">
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