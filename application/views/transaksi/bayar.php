<div class="d-flex">
	<div class="col-4">
		<label>Kode Reservasi (optional)</label>
		<input type="text" class="form-control" name="reservasi" id="reservasi" readonly>
	</div>
    <div class="col-4">
        <label>Guide</label>
		<input type="text" class="form-control" name="guide" id="guide" readonly>
    </div>
    <div class="col-4">
        <label>Pengayah</label>
		<input type="text" class="form-control" name="pengayah" id="pengayah" readonly>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label>Total Pembelian</label>
    </div>
    <div class="col-8">
        <input type="text" class="form-control" name="totalbeli" id="totalbeli" readonly>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label>Diskon</label>
    </div>
    <div class="col-2">
        <input type="text" class="form-control" name="diskon" id="diskon">
    </div>
    <div class="col-2">
        <input type="password" class="form-control" name="passcode" id="passcode" maxlength="6" minlength="6">
    </div>
    <div class="col-2">
        <button id="approve">Approve</button>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label>Total Tagihan</label>
    </div>
    <div class="col-6">
        <input type="text" class="form-control" name="totaltagih" id="totaltagih" readonly>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label>Cara Bayar</label>
    </div>
    <div class="col-8">
        <select id="carabayar" name="carabayar" class="form-control col-3">
            <option value="cash">Cash</option>
            <option value="debit">Debit Card</option>
            <option value="credit">Credit Card</option>
            <option value="qris">Qris</option>
        </select>
    </div>
    <div class="col-3">
        <button id="submit">Simpan</button>
    </div>
</div>