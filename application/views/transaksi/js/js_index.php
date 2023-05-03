<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>

<script>
  

    // ==== START INPUT SELECT2 TRANSAKSI ====  
    $("#guide").select2();
    $("#pengayah").select2();
    $("#namaitems").select2();
    $("#namaproduk").select2();
    $("#namapaket").select2();
    
    $(document).ready(function() {
        $('#pengunjung').select2({
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
        $("#tabtransaksi").click(function(){
            $("#dtransaksi").show();
            $("#dtambah").hide();
        });
        $("#tabtambah").click(function(){
            $("#dtransaksi").hide();
            $("#dtambah").show();
        });
    });
    // ==== END HIDE||SHOW TABS ====  

</script>