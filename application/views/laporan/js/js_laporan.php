<script>
  $(document).ready(function() {
    $('#tanggal').daterangepicker({
      startDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_awal . "')" : "moment().startOf('month')" ?>,
      endDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_akhir . "')" : "moment().endOf('month')" ?>,
      opens: 'right',
      locale: {
        format: 'DD MMM YYYY'
      }
    });
  });
</script>