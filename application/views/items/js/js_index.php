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
					"url": "<?=base_url()?>items/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [4],
				"mData": "id",
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>items/ubah/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
					button=button+'<a href="<?=base_url()?>items/DelData/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
					return button;
				}
			}],
            "columns": [
				  { "data": "namaitem"},
				  { "data": "local"},
				  { "data": "domestik"},
				  { "data": "internasional"},
			]
	});
})
</script>