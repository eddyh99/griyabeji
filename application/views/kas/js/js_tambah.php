<script src="<?= base_url() ?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>

<script>
      $("#storename").select2();

      $('#approve_input').hide();
      $("#jenis").on("change", function(e) {
            if ($("#jenis").val() == 'Keluar') {
                  if ($("#nominal").val().replace(/,/g, '') >= 1000000) {
                        $('#approve_input').show();
                        $('#approve').prop('required', true);
                        $('#btnSimpan').prop('disabled', true);
                  } else {
                        $('#approve_input').hide();
                        $('#approve').prop('required', false);
                        $('#btnSimpan').prop('disabled', false);
                  }
            } else {
                  $('#approve_input').hide();
                  $('#approve').prop('required', false);
                  $('#btnSimpan').prop('disabled', false);
            }
      })
      $("#nominal").on("keyup change", function(e) {
            if ($("#jenis").val() == 'Keluar') {
                  if ($("#nominal").val().replace(/,/g, '') >= 1000000) {
                        $('#approve_input').show();
                        $('#approve').prop('required', true);
                        $('#btnSimpan').prop('disabled', true);
                  } else {
                        $('#approve_input').hide();
                        $('#approve').prop('required', false);
                        $('#btnSimpan').prop('disabled', false);
                  }
            } else {
                  $('#approve_input').hide();
                  $('#approve').prop('required', false);
                  $('#btnSimpan').prop('disabled', false);
            }
      })

      $("#approvebtn").on("click", function(e) {
            var values = "passcode=" + $("#approve").val();
            $.ajax({
                  url: "<?= base_url() ?>transaksi/approval",
                  type: "post",
                  data: values,
                  success: function(response) {
                        if (response == "0") {
                              $('#btnSimpan').prop('disabled', false);
                              $('#message_toast').text("Sudah disetujui!");
                              $('#notifToast').toast("show");
                        } else {
                              $('#message_toast').text("Gagal! Passcode salah.");
                              $('#notifToast').toast("show");
                        }
                  },
            });
      })
</script>