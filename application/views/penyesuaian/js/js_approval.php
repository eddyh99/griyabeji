<!-- Select2 -->
<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>

	$(document).ready(function(){
		var str = "";
		for (i = 0; i < 25; i++) {
			a = i + 1;
			str += "<tr><td><input type='checkbox' id='checkall' name='mydata' value=" + a + "></td><td>a" + a + "</td><td>name" + a + "</td></tr>";
		}
		
		$('#table_data >tbody').append(str);

		var oTableStaticFlow = $('#table_data').DataTable({
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
				"columnDefs": [ 
						{
							"orderable" : false,
							"targets"   : 0,
							// 'checkboxes': {
							// 	'selectRow': true
							// },
	
							"render"    : function (){
								return "<input type='checkbox'>"
							},
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
		
		
		$("#flowcheckall").click(function () {
			//$('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
			var cols = oTableStaticFlow.column(0).nodes(),
				state = this.checked;
			
			for (var i = 0; i < cols.length; i += 1) {
				cols[i].querySelector("input[type='checkbox']").checked = state;
			}
		});
		
		
	
		$("#simpan").on("click",function(){
			var Object = JSON.parse(localStorage.getItem('returpinjam'));
			var barang = JSON.stringify(Object);
			$.ajax({
				url: "<?=base_url()?>penyesuaian/simpandata",
				type: "post",
				data: "barang="+barang+"&id="+$("#key").val(),
				success: function (data) {
					window.location.href="<?=base_url()?>penyesuaian/approval";
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		});

	});


</script>