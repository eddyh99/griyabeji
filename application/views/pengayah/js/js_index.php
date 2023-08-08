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
					"url": "<?=base_url()?>pengayah/Listdata",
					"type": "POST",
					"dataSrc":function (data){
							return data;							
						  }
			},
		    "aoColumnDefs": [{	
				"aTargets": [3],
				"mData": "id",
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>pengayah/ubah/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
					button=button+'<a href="<?=base_url()?>pengayah/DelData/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
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
				  { "data": "nama"},
                  { "data": "whatsapp" },
                  { "data": "tipe" },
			]
	});
})

$(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
				title:"Apakah yakin menghapus data ini?",
				type: "warning",
				position: 'center',
				showCancelButton: true,
				confirmButtonText: "Hapus",
				cancelButtonText: "Batal",
				confirmButtonColor: '#F1416C',
				closeOnConfirm: true,
				showLoaderOnConfirm: true,
			}).then((result) => {
				if (result.isConfirmed) {
					document.location.href = url_href;
				}
			})
    });
</script>