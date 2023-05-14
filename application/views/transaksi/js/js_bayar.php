<script>
    var data = JSON.parse(localStorage.getItem('dataSet'));
    var guide = JSON.parse(localStorage.getItem('guide'));
    var pengayah = JSON.parse(localStorage.getItem('pengayah'));
    $("#guide").val(guide.namaguide);
    $("#pengayah").val(pengayah.namaguide);

    console.log(data.length);
    var total=0;
    for(var i=0;i<data.length;i++){
        console.log(data);
        total=total+data[i].total;
    }

    $("#totalbeli").val(total.toLocaleString('en'));
    $("#totaltagih").val(total.toLocaleString('en'));
    var diskon=$("#diskon").val();
    $("#approve").on("click",function(){
        if ($("#diskon").val()>0){
            var values = "passcode=" + $("#passcode").val();
            $.ajax({
                url: "<?=base_url()?>transaksi/approval",
                type: "post",
                data: values ,
                success: function (response) {
                    if (response=="0"){                        
                        $("#totaltagih").val((total-diskon).toLocaleString('en'))
                    }else{
                        //toast gagal
                    }
                },            
            });
        }
    });

    $("#submit").on("click",function(){
        values="data="+JSON.stringify(data)+"&guide="+JSON.stringify(guide)+"&pengayah="+JSON.stringify(pengayah)+"&diskon="+diskon+"&payment="+$("#carabayar").val();
        $.ajax({
            url: "<?=base_url()?>transaksi/simpandata",
            type: "post",
            data: values ,
            success: function (response) {
                if (response==0){
                    //toast sukses
                    localStorage.clear();
                    window.location.href="<?=base_url()?>transaksi";
                }else{
                    //toast gagal
                }
            },            
        });
    })    
</script>