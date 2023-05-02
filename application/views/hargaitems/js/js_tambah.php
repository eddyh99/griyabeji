<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
  
  $("#namaitems").select2();


  $(document).ready(function() {
    $('#tanggal').daterangepicker({
      startDate: moment(),
      endDate: moment().add(1, 'days'),
      opens:'right',
      locale: {
        format: 'DD MMM YYYY'
      }
    });

  });

</script>