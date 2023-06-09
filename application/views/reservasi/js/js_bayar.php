<script>
    var data = JSON.parse(localStorage.getItem('dataSet'));
    var guide = JSON.parse(localStorage.getItem('guide'));
    var pengayah = JSON.parse(localStorage.getItem('pengayah'));
    var jumlah_pengunjung = JSON.parse(localStorage.getItem('jumlah_pengunjung'));
    $("#guide").val(guide.namaguide);
    $("#pengayah").val(pengayah.namaguide);

    var total = 0;
    for (var i = 0; i < data.length; i++) {
        console.log(data);
        total = total + data[i].total;
    }

    $("#totalbeli").val(total.toLocaleString('en'));
    $("#totaltagih").val(total.toLocaleString('en'));

    $("#dp").on("change", function() {
        $("#dp").val().toLocaleString('en')
        if ($("#dp").val() > 0 && $("#dp").val() <= total) {
            $("#totaltagih").val((total - $("#dp").val()).toLocaleString('en'))
        }
        // console.log(total - $("#dp").val());
    });

    // File type validation
    $("#bukti_bayar").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
            alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
            $("#bukti_bayar").val('');
            return false;
        }
    });

    $(document).ready(function(e) {
        // Submit form data via Ajax
        $("#reservasiForm").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>reservasi/simpandata?data=' + JSON.stringify(data) + '&guide=' + JSON.stringify(guide) + '&pengayah=' + JSON.stringify(pengayah) + '&jumlahpengunjung=' + JSON.stringify(jumlah_pengunjung),
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response == 0) {
                        // Toast
                        $('#notifToast').toast("show");
                        $('#message_toast').text("Data berhasil disimpan!");
                        // Toast

                        localStorage.clear();
                        window.location.href = "<?= base_url() ?>reservasi";
                    } else {
                        // Toast
                        $('#notifToast').toast("show");
                        $('#message_toast').text("Data gagal disimpan!");
                        // Toast
                    }
                },
            });
        });
    });
</script>