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
					"url": "<?=base_url()?>pengguna/Listdata",
					"type": "POST",
					"dataSrc":function (data){
						console.log(data);
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [3],
				"mData": "username",
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>pengguna/ubah/'+encodeURI(btoa(full.username))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
					button=button+'<a href="<?=base_url()?>pengguna/DelData/'+encodeURI(btoa(full.username))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
					return button;
				    // if (full.role!="Admin"){
				    //     button='<a href="<?=base_url()?>pengguna/ubah/'+encodeURI(btoa(full.username))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
				    //     button=button+'<a href="<?=base_url()?>pengguna/DelData/'+encodeURI(btoa(full.username))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
    			    //     return button;
				    // }else{
				    //     button='<a href="<?=base_url()?>admin/pengguna/ubah/'+encodeURI(btoa(full.username))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons">update</i></a>';
				    //     return button;
				    // }
				}
			}],
            "columns": [
				  { "data": "username"},
                  { "data": "nama" },
                  { "data": "role" },
			]
	});
})
</script>