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
            "pageLength": 50,
			"ajax": {
					"url": "<?=base_url()?>assignstaff/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [3],
				"mData": "username",
				"mRender": function (data, type, full, meta){
					console.log(full.storeid);
				    if (full.role!="Admin"){
				        button='<a href="<?=base_url()?>assignstaff/DelData/'+encodeURI(btoa(full.username))+'/'+encodeURI(btoa(full.storeid))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
    			        return button;
				    }
				}
			}],
            "columns": [
				  { "data": "username"},
                  { "data": "nama" },
                  { "data": "storename" },
			]
	});
})
</script>