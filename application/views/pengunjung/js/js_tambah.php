<script src="<?=base_url()?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>


<script>
  
  $("#countryname").select2();
  $("#statename").select2();

  $("#countryname").on("change", function() {
    var country = $(this).val();
    $.ajax({
        url: "<?= base_url() ?>pengunjung/getstate?country=" + country,
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


</script>