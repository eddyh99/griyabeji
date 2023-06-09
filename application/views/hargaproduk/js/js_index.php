<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    
	var table;
	$(function(){
		table = $('#table_data').DataTable({
				"order": [[ 0, "asc" ]],
				"scrollX": true,
				"ajax": {
						"url": "<?=base_url()?>produk/ListHargaItemsData",
						"type": "POST",
						"dataSrc":function (data){
								return data;							
							}
				},
				"columns": [
					{ "data": "namaproduk"},
					{ "data": "awal"},
					{ "data": "akhir"},
					{ "data": "lokal",render:$.fn.dataTable.render.number('.', ',', 0, '') },
					{ "data": "domestik",render:$.fn.dataTable.render.number('.', ',', 0, '')},
					{ "data": "internasional",render:$.fn.dataTable.render.number('.', ',', 0, '')},
				]
		});
	})



</script>