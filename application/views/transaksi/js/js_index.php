<script src="<?= base_url() ?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>
<script>
    // ==== START INPUT SELECT2 TRANSAKSI ====  
    $("#guide").select2({
        placeholder: "--Pilih Guide--",
        allowClear: true,
    });
    $("#pengayah").select2({
        placeholder: "--Pilih Pengayah--",
        allowClear: true,
    });
    $(".namaitems").select2({
        placeholder: "--Pilih Items--",
        allowClear: true,
    });
    $(".namaproduk").select2({
        placeholder: "--Pilih Produk--",
        allowClear: true,
    });
    $(".namapaket").select2({
        placeholder: "--Pilih Paket--",
        allowClear: true,
    });

    var pengunjung = $('#pengunjung').select2({
        ajax: {
            url: '<?= base_url() ?>pengunjung/Listdata',
            dataType: 'json',
            type: "GET",
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    // ==== END INPUT SELECT2 TRANSAKSI ====  

    $("#addfield").on("click", function(e) {
        $newid = $(this).data("increment");
        $('.repeatDiv:first').find("select[name*=namaitems]").select2("destroy");
        $('.repeatDiv:first').find("select[name*=namaproduk]").select2("destroy");
        $('.repeatDiv:first').find("select[name*=namapaket]").select2("destroy");

        $repeatDiv = $("#repeatDiv").wrap('<div/>').parent().html();
        $('#repeatDiv').unwrap();
        $($repeatDiv).insertAfter($(".repeatDiv").last());
        $(".repeatDiv").last().attr('id', "repeatDiv" + '_' + $newid);
        $(".repeatDiv").find("select[name*=namaitems]").last().attr("id", "namaitems_" + $newid);
        $(".repeatDiv").find("select[name*=namaproduk]").last().attr("id", "namaproduk_" + $newid);
        $(".repeatDiv").find("select[name*=namapaket]").last().attr("id", "namapaket_" + $newid);
        $(".repeatDiv").find("input[name*=jml]").last().attr("id", "jml_" + $newid);

        $(".repeatDiv").find("#hide_add").last().attr('id', "hide_add" + '_' + $newid);

        $(".repeatDiv").find("select[name*=namaitems]").select2({
            placeholder: "--Pilih Items--",
            allowClear: true
        });
        $(".repeatDiv").find("select[name*=namaproduk]").select2({
            placeholder: "--Pilih Produk--",
            allowClear: true
        });
        $(".repeatDiv").find("select[name*=namapaket]").select2({
            placeholder: "--Pilih Paket--",
            allowClear: true
        });
        $("#repeatDiv" + '_' + $newid).append('<div class="col"><button type="button" class="btn btn-danger btn-icon remove rounded-circle mt-7 removeDivBtn" data-id="repeatDiv' + '_' + $newid + '"><i class="fas fa-minus"></i></button></div>');
        $("#hide_add_" + $newid).hide();
        $newid++;
        $(this).data("increment", $newid);
    })

    $(document).on('click', '.removeDivBtn', function() {
        $divId = $(this).data("id");
        $("#" + $divId).remove();
        $inc = $("#repeatDivBtn").data("increment");
        $("#repeatDivBtn").data("increment", $inc - 1);
    });

    var dataSet = [];
    $("#addbuy").on("click", function(e) {
        var nama = $('#pengunjung').find(':selected').text();
        var id_pengunjung = $("#pengunjung").val();
        var state = $("#pengunjung").find(':selected').data("state");
        var country = $("#pengunjung").find(':selected').data("country");

        var i = 0;
        $('select[name*=namaitems]').each(function() {
            if ($(this).val().length > 0) {
                var namabrg = $(this).find(':selected').text();
                var idbrg = $(this).val();
                var lokal = $(this).find(':selected').data("lokal");
                var domestik = $(this).find(':selected').data("domestik");
                var inter = $(this).find(':selected').data("inter");
                if (i == 0) {
                    jml = $("#jml").val();
                    if (state.toLowerCase() == "bali") {
                        harga = jml * lokal;
                    } else if (country.toLowerCase() == "indonesia") {
                        harga = jml * domestik;
                    } else {
                        harga = jml * inter;
                    }
                } else {
                    jml = $("#jml_" + i).val();
                    if (state.toLowerCase() == "bali") {
                        harga = jml * lokal;
                    } else if (country.toLowerCase() == "indonesia") {
                        harga = jml * domestik;
                    } else {
                        harga = jml * inter;
                    }
                }

                var dataItems = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg));
                if (dataItems < 0) {
                    arr = {
                        "id_pengunjung": id_pengunjung,
                        "name": nama,
                        "barang": namabrg,
                        "id_barang": idbrg,
                        "jenis": "items",
                        "jumlah": jml,
                        "total": harga
                    };
                    dataSet.push(arr);
                } else {
                    dataSet[dataItems].jumlah = parseInt(dataSet[dataItems].jumlah) + parseInt(jml)
                    // console.log(dataSet[dataItems].jumlah);
                }
            }
            i++;
        });
        $('select[name*=namaproduk]').each(function() {
            if ($(this).val().length > 0) {
                var namabrg = $(this).find(':selected').text();
                var idbrg = $(this).val();
                var lokal = $(this).find(':selected').data("lokal");
                var domestik = $(this).find(':selected').data("domestik");
                var inter = $(this).find(':selected').data("inter");

                if (state.toLowerCase() == "bali") {
                    harga = lokal;
                } else if (country.toLowerCase() == "indonesia") {
                    harga = domestik;
                } else {
                    harga = inter;
                }

                var dataProduk = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg));
                if (dataProduk < 0) {
                    arr = {
                        "id_pengunjung": id_pengunjung,
                        "name": nama,
                        "barang": namabrg,
                        "id_barang": idbrg,
                        "jenis": "produk",
                        "jumlah": "",
                        "total": harga
                    };
                    dataSet.push(arr);
                } else {
                    console.log('Produk sudah ada!');
                }
            }
        });
        $('select[name*=namapaket]').each(function() {
            if ($(this).val().length > 0) {
                var namabrg = $(this).find(':selected').text();
                var idbrg = $(this).val();
                var lokal = $(this).find(':selected').data("lokal");
                var domestik = $(this).find(':selected').data("domestik");
                var inter = $(this).find(':selected').data("inter");
                if (state.toLowerCase() == "bali") {
                    harga = lokal;
                } else if (country.toLowerCase() == "indonesia") {
                    harga = domestik;
                } else {
                    harga = inter;
                }

                var dataPaket = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg));
                console.log(dataPaket);
                if (dataPaket < 0) {
                    arr = {
                        "id_pengunjung": id_pengunjung,
                        "name": nama,
                        "barang": namabrg,
                        "id_barang": idbrg,
                        "jenis": "paket",
                        "jumlah": "",
                        "total": harga
                    };
                    dataSet.push(arr);
                } else {
                    console.log('Paket sudah ada!');
                }
            }
        });


        for (var removeDiv of document.querySelectorAll(".repeatDiv:not(:first-of-type)")) {
            removeDiv.remove('repeatDiv');
        }

        JSON.stringify(dataSet);
        console.log(dataSet);
        tblpesanan.clear();
        tblpesanan.rows.add(dataSet);
        tblpesanan.draw();
    });

    var groupColumn = 0;
    var tblpesanan = $('#pesanan').DataTable({
        columnDefs: [{
            visible: false,
            targets: groupColumn
        }],
        order: [
            [groupColumn, 'asc']
        ],
        displayLength: 25,
        drawCallback: function(settings) {
            var api = this.api();
            var total = api.column(3).data().sum();
            $(api.column(3).footer()).html(
                total.toLocaleString("en")
            );
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api
                .column(groupColumn, {
                    page: 'current'
                })
                .data()
                .each(function(group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group"><td colspan="3"> Nama : ' + group + '</td></tr>');

                        last = group;
                    }
                });
        },
        data: dataSet,
        columns: [{
                data: 'name',
                title: 'Pengunjung'
            },
            {
                data: 'barang',
                title: 'Barang',
                render: function(data, type, row, meta) {
                    return "&nbsp;&nbsp;&nbsp;" + data
                }
            },
            {
                data: 'jumlah',
                title: 'Jumlah'
            },
            {
                data: 'total',
                title: 'Total',
                className: "dt-body-right",
                render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
                data: null,
                title: 'Action'
            }
        ],
        columnDefs: [{
            targets: -1,
            data: {
                id_pengunjung: "id_pengunjung",
                id_barang: "id_barang",
            },
            mRender: function(data, type, full) {
                return '<button type="button" class="btn btn-danger btn-icon rounded-circle removeBarang" data-idpengunjung="' + data.id_pengunjung + '" data-idbarang="' + data.id_barang + '" style="height: 20px;width: 20px;"><i class="fas fa-minus"></i></button>';
            }
        }],
    });


    $(document).on('click', '.removeBarang', function() {
        $idPengunjung = $(this).data("idpengunjung"); // Mengambil id Pengunjung
        $idBarang = $(this).data("idbarang"); // Mengambil id barang

        // Mencari data dari id_pengunjung & id_barang
        $dataBarang = dataSet.findIndex(x => x.id_pengunjung === $idPengunjung.toString() && x.id_barang === $idBarang.toString());
        // Menghapus (data yang dicari, hapus 1 data itu) jika 1 tidak ditulis maka data selanjutnya akan dihapus juga
        dataSet.splice($dataBarang, 1);

        tblpesanan.clear();
        tblpesanan.rows.add(dataSet);
        tblpesanan.draw();
    });

    $("#btnbayar").on("click", function() {
        var guide = {
            "id_guide": $("#guide").val(),
            "namaguide": $("#guide").find(':selected').text(),
        };
        var pengayah = {
            "id_pengayah": $("#pengayah").val(),
            "namapengayah": $("#pengayah").find(':selected').text(),
        };
        localStorage.setItem('dataSet', JSON.stringify(dataSet));
        localStorage.setItem('guide', JSON.stringify(guide));
        localStorage.setItem('pengayah', JSON.stringify(pengayah));
        window.location.href = "<?= base_url() ?>transaksi/summarybayar"
    })

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
                for (i = select.options.length - 1; i > 0; i--) {
                    select.remove(i);
                }
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("OPTION"),
                        txt = document.createTextNode(data[i].state_name);
                    option.appendChild(txt);
                    option.setAttribute("value", data[i].state_code);
                    select.insertBefore(option, select.lastChild);
                }
            },
            error: function(response) {
                alert(response);
            }
        })
    });
    // ==== END SELECT COUNTRY & STATE  ====  
</script>