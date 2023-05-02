
<script>
var table;
$(function(){
	table = $('#table_data').DataTable({
			"order": [[ 1, "asc" ]],
            "scrollX": true,
			"ajax": {
					"url": "<?=base_url()?>kas/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
            "columns": [
				  { "data": "store"},
				  { "data": "tanggal"},
				  { "data": "nominal"},
				  { "data": "keterangan"},
			]
	});
})
</script>