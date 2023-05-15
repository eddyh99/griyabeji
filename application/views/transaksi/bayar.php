<!-- ======= Start Content wrapper ====== -->
<div class="container mb-10 mt-auto">
    <div class="row my-5">
        <div class="col-md mb-5">
            <label class="form-label">Kode Reservasi (optional)</label>
            <input type="text" class="form-control rounded-pill" name="reservasi" id="reservasi" readonly>
        </div>
        <div class="col-md mb-5">
            <label class="form-label">Guide</label>
            <input type="text" class="form-control rounded-pill" name="guide" id="guide" readonly>
        </div>
        <div class="col-md mb-5">
            <label class="form-label">Pengayah</label>
            <input type="text" class="form-control rounded-pill" name="pengayah" id="pengayah" readonly>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-4">
            <label class="form-label">Total Pembelian</label>
        </div>
        <div class="col">
            <input type="text" class="form-control rounded-pill" name="totalbeli" id="totalbeli" readonly>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-4">
            <label class="form-label">Diskon</label>
        </div>
        <div class="col">
            <input type="text" class="form-control rounded-pill" name="diskon" id="diskon">
        </div>
        <div class="col">
            <input type="password" class="form-control rounded-pill" name="passcode" id="passcode" maxlength="6" minlength="6">
        </div>
        <div class="col-auto">
            <button id="approve" class="btn btn-beji rounded-pill">Approve</button>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-4">
            <label class="form-label">Total Tagihan</label>
        </div>
        <div class="col">
            <input type="text" class="form-control rounded-pill" name="totaltagih" id="totaltagih" readonly>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-4">
            <label class="form-label">Cara Bayar</label>
        </div>
        <div class="col">
            <select id="carabayar" name="carabayar" class="form-control rounded-pill">
                <option value="cash">Cash</option>
                <option value="debit">Debit Card</option>
                <option value="credit">Credit Card</option>
                <option value="qris">Qris</option>
            </select>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12 text-end">
            <button id="submit" class="btn btn-beji rounded-pill">Simpan</button>
        </div>
    </div>
</div>