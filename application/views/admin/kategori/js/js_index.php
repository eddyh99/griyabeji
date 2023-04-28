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
			"order": [[ 0, "asc" ]],
            "scrollX": true,
            "pageLength": 50,
			"ajax": {
					"url": "<?=base_url()?>admin/kategori/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [1],
				"mData": "namakategori",
				"mRender": function (data, type, full, meta){
				    if (full.role!="Admin"){
				        button='<a href="<?=base_url()?>admin/kategori/ubah/'+encodeURI(btoa(full.namakategori))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
				        button=button+'<a href="<?=base_url()?>admin/kategori/DelData/'+encodeURI(btoa(full.namakategori))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
    			        return button;
				    }else{
				        button='<a href="<?=base_url()?>admin/kategori/ubah/'+encodeURI(btoa(full.namakategori))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
				        return button;
				    }
				}
			}],
            "columns": [
                { "data": "namakategori"},
			]
	});
})
</script>