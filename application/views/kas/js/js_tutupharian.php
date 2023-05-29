<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script>
  $('#tgl').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2021,
    maxYear: parseInt(moment().format('YYYY'), 10),
    locale: {
      format: 'DD MMM YYYY'
    },
    ranges: {
      'Today': [moment()],
      'Yesterday': [moment().subtract(1, 'days')],
    }
  });

  $('#harian').DataTable({
    ordering: false,
    bPaginate: false,
    bFilter: false,
    bInfo: false,
    dom: 'Bfrtip',
    buttons: [{
        extend: 'excelHtml5',
        exportOptions: {
          columns: [0, 1, 2]
        }
      },
      {
        extend: 'pdfHtml5',
        exportOptions: {
          columns: [0, 1, 2]
        }
      }
    ]
  });

  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }

  // function printPDF(divName){
  //     var doc = new jsPDF();
  //     var elementHTML = document.getElementById(divName).innerHTML;
  //     var specialElementHandlers = {
  //         '#elementH': function (element, renderer) {
  //             return true;
  //         }
  //     };
  //     doc.fromHTML(elementHTML, 15, 15, {
  //         'width': 170,
  //         'elementHandlers': specialElementHandlers
  //     });

  //     // Save the PDF
  //     doc.save('rekapharian.pdf');        
  // }
</script>