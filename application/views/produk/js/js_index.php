<style>
    tr { height: 50px; }
    #table_data tbody tr{
      cursor:pointer;
    }
	
	div.slider {
    	display: none;
	}
	tr.shown td.details-control i {
		transition: 0.5s ease;
		-webkit-transform: rotate(180deg);
		-moz-transform: rotate(180deg);
		-ms-transform: rotate(180deg);
		-o-transform: rotate(180deg);
		transform: rotate(180deg);
	}

</style>
<script>
	function format (d) {
    // `d` is the original data object for the row
		return '<div class="slider">'+
			'<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
				'<tr>'+
					'<td>Nama Items :</td>'+
				'</tr>'+
				'<tr>'+
					'<td>'+d.namaitems+'</td>'+
				'</tr>'+
			'</table>'+
		'</div>';
	}
 

	$(document).ready(function(){
		var table = $('#table_data').DataTable({
				"order": [[ 1, "asc" ]],
				"scrollX": true,
				"ajax": {
						"url": "<?=base_url()?>produk/Listdata",
						"type": "POST",
						"dataSrc":function (data){
								return data;							
							}
				},
				"aoColumnDefs": [{	
					"aTargets": [5],
					"mData": "id",
					"mRender": function (data, type, full, meta){
						button='<a href="<?=base_url()?>produk/ubah/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
						button=button+'<a href="<?=base_url()?>produk/DelData/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
						return button;
					}
				}],
				"columns": [
					{
						"class":          'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": '<i class="fas fa-chevron-down text-primary"></i>'
					},
					{ "data": "namaproduk"},
					{ "data": "local",render:$.fn.dataTable.render.number('.', ',', 0, '')},
					{ "data": "domestik",render:$.fn.dataTable.render.number('.', ',', 0, '')},
					{ "data": "internasional",render:$.fn.dataTable.render.number('.', ',', 0, '')},
					
				]
		});

		// Add event listener for opening and closing details
		$('#table_data tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );
	 
			if ( row.child.isShown() ) {
				// This row is already open - close it
				$('div.slider', row.child()).slideUp( function () {
					row.child.hide();
					tr.removeClass('shown');
				} );
			}
			else {
				// Open this row
				row.child( format(row.data()), 'no-padding' ).show();
				tr.addClass('shown');
	 
				$('div.slider', row.child()).slideDown();
			}
		} );
	});

</script>