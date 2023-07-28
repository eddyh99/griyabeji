<script>
    var data = JSON.parse(localStorage.getItem('dataSet'));
    var guide = JSON.parse(localStorage.getItem('guide'));
    var pengayah = JSON.parse(localStorage.getItem('pengayah'));
    var kode_reservasi = JSON.parse(localStorage.getItem('kode_reservasi'));
    var dp = JSON.parse(localStorage.getItem('dp'));
    var buktibayar = JSON.parse(localStorage.getItem('buktibayar'));
    console.log(pengayah);
    $("#guide").val(guide.namaguide);
    $("#pengayah").val(pengayah.namapengayah);
    $("#reservasi").val(kode_reservasi.kode_reservasi);

    $("#img_bukti_bayar").attr("src", "<?= base_url() ?>assets/Bukti_pembayaran/" + buktibayar);

    console.log(data.length);
    var total = 0;
    for (var i = 0; i < data.length; i++) {
        console.log(data);
        total = total + data[i].total;
    }

    $("#dp").val(parseInt(dp).toLocaleString('en'));
    if (!dp) {
        $("#hidedp").hide();
        totaltagihan = total;
        dp = 0;
    } else {
        totaltagihan = total - parseInt(dp);
    }

    $("#totalbeli").val(total.toLocaleString('en'));
    $("#totaltagih").val(totaltagihan.toLocaleString('en'));

    $("#approve").on("click", function() {
        var diskon = $("#diskon").val().replace(/,/g, '');
        if ($("#diskon").val().replace(/,/g, '') > 0) {
            var values = "passcode=" + $("#passcode").val();
            $.ajax({
                url: "<?= base_url() ?>transaksi/approval",
                type: "post",
                data: values,
                success: function(response) {
                    if (response == "0") {
                        $('#message_toast').text("Sudah disetujui!");
                        $('#notifToast').toast("show");
                        $("#totaltagih").val((total - diskon - parseInt(dp)).toLocaleString('en'));
                    } else {
                        // Toast
                        $('#notifToast').toast("show");
                        $('#message_toast').text("Gagal! Passcode salah.");
                        // Toast
                    }
                },
            });
        }
    });

    $("#submit").on("click", function() {
        values = "data=" + JSON.stringify(data) + "&guide=" + JSON.stringify(guide) + "&pengayah=" + JSON.stringify(pengayah) + "&diskon=" + $("#diskon").val() + "&payment=" + $("#carabayar").val() + "&reservasi=" + $("#reservasi").val();
        $.ajax({
            url: "<?= base_url() ?>transaksi/simpandata",
            type: "post",
            data: values,
            success: function(response) {
                if (response == 0) {
                    // Toast
                    $('#notifToast').toast("show");
                    $('#message_toast').text("Data berhasil disimpan!");
                    // Toast

                    localStorage.clear();
                    window.location.href = "<?= base_url() ?>transaksi";
                } else {
                    // Toast
                    $('#notifToast').toast("show");
                    $('#message_toast').text("Data gagal disimpan!");
                    // Toast
                }
            },
        });
    })
</script>