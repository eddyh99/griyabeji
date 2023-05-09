<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>

<script>
  

    // ==== START INPUT SELECT2 TRANSAKSI ====  
    $("#guide").select2();
    $("#pengayah").select2();
    $("#namaitems").select2();
    $("#namaproduk").select2();
    $("#namapaket").select2();
    $("#pengguna").select2();
    
    $(document).ready(function() {
        $('#pengunjung').select2({
            placeholder: "--Pilih Pengunjung--",
            allowClear: true,
        });
    });

    $(document).ready(function() {
        $('#pengunjung2').select2({
            placeholder: "--Pilih Pengunjung--",
            allowClear: true,
        });
    });

    // ==== END INPUT SELECT2 TRANSAKSI ====  
    
    // ==== START LIST DATATABLES TRANSAKSI ====  
    $(function(){
        table = $('#table_data').DataTable({
                "order": [[ 1, "asc" ]],
                "scrollX": true,
                "responsive": true,
                "ajax": {
                        "url": "<?=base_url()?>pengunjung/Listdata",
                        "type": "POST",
                        "dataSrc":function (data){
                                return data;							
                            }
                },
                "aoColumnDefs": [{	
                    "aTargets": [6],
                    "mData": "id",
                    "mRender": function (data, type, full, meta){
                        // button='<a href="<?=base_url()?>pengunjung/ubah/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-success btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">update</i></a>';
                        button='<a href="<?=base_url()?>pengunjung/DelData/'+encodeURI(btoa(full.id))+'" class="btn btn-simple btn-danger btn-icon remove rounded-circle mx-1"><i class="material-icons fs-3">close</i></a>';
                        return button;
                    }
                }],
                "columns": [
                    { "data": "nama"},
                    { "data": "whatsapp" },
                    { "data": "email" },
                    { "data": "ig" },
                    { "data": "statename" },
                    { "data": "countryname" },
                ]
        });
    })
    // ==== END LIST DATATABLES TRANSAKSI ====  


    // ==== START HIDE||SHOW TABS ====  
    $(document).ready(function(){
        $("#dtambah").hide();
        $("#tabtransaksi").addClass('btn-transaksi-active shadow-sm');
        $("#tabtambah").addClass('btn-transkasi-nonactive ');
        $("#tabtransaksi").click(function(){
            $("#dtransaksi").show();
            $("#tabtransaksi").removeClass('btn-transkasi-nonactive ');
            $("#tabtransaksi").addClass('btn-transaksi-active shadow-sm');
            $("#tabtambah").removeClass('btn-transaksi-active shadow-sm');
            $("#tabtambah").addClass('btn-transkasi-nonactive ');
            $("#dtambah").hide();
        });
        $("#tabtambah").click(function(){
            $("#dtransaksi").hide();
            $("#tabtransaksi").removeClass('btn-transaksi-active shadow-sm');
            $("#tabtransaksi").addClass('btn-transkasi-nonactive ');
            $("#tabtambah").removeClass('btn-transkasi-nonactive ');
            $("#tabtambah").addClass('btn-transaksi-active shadow-sm');
            $("#dtambah").show();
        });
    });
    // ==== END HIDE||SHOW TABS ====  


    // ==== START ADD DISCOUNT FROM MANAGER ====  
    $("#pengguna").on("change", function(){

        $modal = $("#discount"); 
        if($(this).val()){
            $modal.modal('show');
        }

        // $("#discount").modal("show");
        // if(e.which == 13) {
			// $.ajax({
			// 	url: "<?=base_url()?>transaksi/readmanager",
			// 	type: "post",
			// 	// data: "pengguna="+$(this).val() ,
			// 	success: function (data) {
            //         console.log(data);
			// 		data=JSON.parse(data);
			// 		results=$.map(data, function (item) {
			// 					return {
			// 				   id: item.size,
			// 				   text: item.size
			// 					};
			// 				})
			// 		$("#discount").modal("show");
			// 	},
			// 	error: function(jqXHR, textStatus, errorThrown) {
			// 	   console.log(textStatus, errorThrown);
			// 	}
			// });
		// }
	})
    // ==== END ADD DISCOUNT FROM MANAGER ====  



    // ==== START SELECT COUNTRY & STATE  ====  
    $("#countryname").select2();
    $("#statename").select2();

    $("#countryname").on("change", function() {
        var country = $(this).val();
        $.ajax({
            url: "<?= base_url() ?>transaksi/getstate?country=" + country,
            success: function(response) {
                var data = JSON.parse(response);
                var select = document.getElementById("statename");
                for(i = select.options.length - 1; i > 0; i--) {
                    select.remove(i);
                }
                for(var i = 0; i < data.length; i++)
                {
                    var option = document.createElement("OPTION"),
                    txt = document.createTextNode(data[i].state_name);
                    option.appendChild(txt);
                    option.setAttribute("value",data[i].state_code);
                    select.insertBefore(option,select.lastChild);
                }
            },
            error: function(response) {
                alert(response);
            }
        })
    });
    // ==== END SELECT COUNTRY & STATE  ====  

</script>