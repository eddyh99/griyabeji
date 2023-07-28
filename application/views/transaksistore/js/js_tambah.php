<script src="//cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>
<script>	
	$("#items").select2();

	var dataSet=[];
	//pesanan
	var table=$('#table_data').DataTable({
		"targets": 'no-sort',
		"bSort": false,
		"order": [],
		"pageLength": 50,
		"bPaginate": false,
	    "bInfo": false,
		"lengthChange": false,
        "scrollCollapse": true,
		// "drawCallback": function () {
		// 	  var api = this.api();
		// 	  var total=api.column( 2 ).data().sum();
		// 	  $( api.column( 3 ).footer() ).html(
		// 		total.toLocaleString("en")
		// 	  );
		// },
	});

	$("#btlbeli").on("click",function(){
	    $("#produk").val("").trigger('change');
		$("#modalsize").modal("hide");
	});

	
	
	$("#simpan").on("click",function (e){
		var iditems	= $("#iditems").val();
		var produk	= $('#items').select2('data')[0].text;
		var jumlah	= Number($("#jumlah").val());
        
        if (jumlah==0){
            jumlah=1;
        }
            
		var button	= '<button class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></button>';

		var found=0;
		console.log(dataSet);
		for (i=0;i<dataSet.length;i++)
		{
			if (dataSet[i][0]==iditems)
			{
				dataSet[i][2]=Number(dataSet[i][2])+jumlah;
				break;
			}else{
				found++;
			}
		}
		if (found>=dataSet.length)
		{
			dataSet.push([iditems, produk, jumlah, button]);
		}


		table.clear();
        table.rows.add(dataSet);
        table.draw();

		localStorage.setItem('dataSet', JSON.stringify(dataSet));

		$("#iditems").val("");
		$("#modalsize").modal("hide");
	    $("#items").val("").trigger('change')
	})

	$('#table_data tbody').on( 'click', 'td', function () 
	{
		var tr = $(this).closest("tr");
		var rowindex = tr.index();
		dataSet.splice(rowindex,1);
		localStorage.setItem('dataSet', JSON.stringify(dataSet));

		table.clear();
        table.rows.add(dataSet);
        table.draw();
	});

	$("#btnpayment").on("click",function (){
		var Object = JSON.parse(localStorage.getItem('dataSet'));

		if (!Object){
		   alert("Daftar barang masih kosong"); 
		    return;
		}
		
		for (i=0;i<Object.length ;i++ )
		{
			Object[i].pop();
		}
		var barang=JSON.stringify(Object);

		$.ajax({
			url: "<?=base_url()?>store/addtransaksi",
			type: "post",
			data: "barang="+barang,
			success: function (data) {
                localStorage.clear();
				location.href="<?=base_url()?>store/tambahpenjualan";
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});

	})

 $('#items').on('change', function() {
	$("#jumlah").val(1);
	$("#modalsize").modal("show");
	$("#iditems").val($(this).val());
}) 

</script>