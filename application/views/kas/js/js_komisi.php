<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tanggal').daterangepicker({
      startDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_awal . "')" : "moment().startOf('month')" ?>,
      endDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_akhir . "')" : "moment().endOf('month')" ?>,
      opens: 'right',
      locale: {
        format: 'DD MMM YYYY'
      },
      ranges: {
        'Today': [moment(), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    });
  });

  $('#komisi').DataTable({
    ordering: false,
    bFilter: false,
    bInfo: false,
    dom: 'Bfrtip',
    buttons: [{
        extend: 'excelHtml5',
        footer: true,
        exportOptions: {
          columns: [0, 1, 2, 3]
        }
      },
      {
        extend: 'pdfHtml5',
        footer: true,
        exportOptions: {
          columns: [0, 1, 2, 3]
        }
      }
    ]
  });
</script>