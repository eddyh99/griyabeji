<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>
<script>
		var tblnew = $('#table_data').DataTable({
				"scrollX": true,
				"pageLength": 10,
				"order": [[ 1, 'asc' ]],
				"ajax": {
						"url": "<?=base_url()?>penyesuaian/Listdata",
						"type": "POST",
						"data" : {
							key: $("#key").val()
						},
						"dataSrc":function (data){
								console.log($("#key").val());
								return data;							
								}
				},
				'select': {
					'style': 'multi'
				},
				"columnDefs": [ 
						{
							'targets': 0,
							'data':"id",
							'checkboxes': {
							'selectRow': true
							}
						},
						{
							"data"      : "tanggal",
							"targets"   : 1
						},
						{ 
							"data"      : "namaitems",
							"targets"   : 2
						},                    
						{ 
							"data"      : "stok",
							"targets"   : 3
						},
						{ 
							"data"      : "riil",
							"targets"   : 4
						},
						{   
							"data"      : "keterangan",
							"targets"   : 5
						},
						// {   
						//     "data"      : "approved",
						//     "targets"   : 6,
						// }
				],
		});
		
		
		$('#frm-approve').on('submit', function(e){
			var form = this;
			
			var rows_selected = tblnew.column(0).checkboxes.selected();

			// Iterate over all selected checkboxes
			$.each(rows_selected, function(index, rowId){
				// Create a hidden element 
				$(form).append(
					$('<input>')
						.attr('type', 'hidden')
						.attr('name', 'id[]')
						.val(rowId)
				);
			});
		}); 
</script>