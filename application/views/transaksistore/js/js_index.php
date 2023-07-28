<style>
    tr { height: 50px; }
    #table_data tbody tr{
      cursor:pointer;
    }
</style>
<script>
var table;
$(function(){
	table = $('#table_data').DataTable({
			"order": [[ 1, "asc" ]],
            "scrollX": true,
			"ajax": {
					"url": "<?=base_url()?>store/getPenjualan",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},		   
            "columns": [
                { "data": "id"},
                { "data": "tanggal"},
                { "data": ""}
			]
	});
})
</script>