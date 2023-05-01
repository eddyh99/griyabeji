<!-- Select2 -->
<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>


<script>

    // Select2 
    $(document).ready(function() {

        $('.namaitems-select').select2({
            placeholder: "--Pilih Items--",
            allowClear: true,
        });
    });

    // Formater Rupiah
    // $(document).ready(function(){
    //     $('.rupiah').mask('000.000.000.000', {reverse: true});
    // })



</script>