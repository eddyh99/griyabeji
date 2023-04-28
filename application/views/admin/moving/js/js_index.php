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
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 50,

			"order": [[ 1, "desc" ]],
            "scrollX": true,
			"ajax": {
					"url": "<?=base_url()?>admin/moving/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [4],
				"mData": "mutasi_id",
				"mRender": function (data, type, full, meta){
					var button='';
					<?php if($_SESSION["logged_status"]["role"]!="Office Staff"){?>
    					if ((full.status=="Belum") || (full.status=="Dikirim"))
    					{
    						button='<a href="<?=base_url()?>admin/moving/terima/'+encodeURI(btoa(full.mutasi_id))+'" class="btn btn-simple btn-success btn-icon rounded-circle mx-1"><i class="material-icons fs-3">check_circle</i></a>';
    				        button=button+'<a href="<?=base_url()?>admin/moving/batal/'+encodeURI(btoa(full.mutasi_id))+'" class="btn btn-simple btn-danger btn-icon rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
    					}else{
    					    button=""
    					}
				    <?php } ?>
    				button=button+'<a href="<?=base_url()?>admin/moving/detail/'+encodeURI(btoa(full.mutasi_id))+'/0" class="btn btn-info btn-sm btn-icon w-60px"><i class="fas fa-info fs-3 px-1"></i>Detail</a>';
				    return button;			    
				}
			}],
            "columns": [
				  { "data": "mutasi_id"},
				  { "data": "tanggal"},
                  { "data": "dari" },
                  { "data": "status"},
			]
	});
})
</script>