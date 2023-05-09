<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>

<script>
      
  $("#namaitems").select2();
  $("#namaitems").on("change", function(e){
    $.get("<?=base_url()?>penyesuaian/stokitem?items_id="+$(this).val(),function(data, status){  
      console.log(data);    
      $("#stok").val(data);
    });
  })
  
</script>