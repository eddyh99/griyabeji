<!-- ======= Start Content wrapper ====== -->
<div class="container mb-10 mt-auto">
    <form id="reservasiForm" enctype="multipart/form-data">
        <input type="hidden" id="jumlahpengunjung" name="jumlahpengunjung">
        <input type="hidden" id="guide_id" name="guide_id">
        <input type="hidden" id="pengayah_id" name="pengayah_id">
        <input type="hidden" id="namatamu" name="namatamu">
        <div class="row my-5">
            <div class="col-md mb-5">
                <label class="form-label">Arrival Date</label>
                <input type="text" class="form-control rounded-pill" name="arrival" id="arrival" readonly>
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
                <label class="form-label">DP</label>
            </div>
            <div class="col">
                <input type="text" class="form-control rounded-pill typeMoney" name="dp" id="dp">
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
                <label class="form-label">Upload Bukti</label>
            </div>
            <div class="col">
                <input class="form-control rounded-pill" type="file" id="bukti_bayar" name="bukti_bayar">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 text-end">
                <button id="submit" type="submit" class="btn btn-beji rounded-pill">Simpan</button>
            </div>
        </div>
    </form>
</div>