<script src="<?= base_url() ?>assets/bootstrap/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>
<script>
    $("#listreservasi").select2({
        placeholder: "--Kode Reservasi--",
        allowClear: true,
		dropdownParent: $("#carireservasi")
    });

    $("#kode_reservasi").keydown(function(e){
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 112) {
            if (e.altKey) {
                $.ajax({
                    url: "<?= base_url() ?>transaksi/listreservasi",
                    success: function(response) {
                        var data = JSON.parse(response);
                        var selectProduk = document.getElementById("listreservasi");
                        for (i = selectProduk.options.length - 1; i > 0; i--) {
                            selectProduk.remove(i);
                        }
                        for (var i = 0; i < data.length; i++) {
                            var option = document.createElement("OPTION"),
                                txt = document.createTextNode(data[i].id + " - " + data[i].namatamu);
                            option.appendChild(txt);
                            option.setAttribute("value", data[i].id);
                            selectProduk.insertBefore(option, selectProduk.lastChild);
                        }
                        $("#carireservasi").modal("show");
                    },
                });
            }
        }
    });

    $("#pilihreservasi").on("click",function(){
        $("#kode_reservasi").val($("#listreservasi").val());
        $("#reservasi").val($("#listreservasi").val());
        $("#carireservasi").modal("hide");
    });

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
        placeholder: "--Pilih Pengunjung--",
        allowClear: true,
        ajax: {
            url: '<?= base_url() ?>pengunjung/Listpengunjung',
            dataType: 'json',
            type: "GET",
			data: function (params) {
			  var query = {
				search: params.term,
			  }
			  return query;
			},
            processResults: function(data) {
				console.log(data);
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

    $("#pengunjung").on("change", function() {
        var id = $(this).val();
        var idReservasi = $("#reservasi").val();
        var dataPengunjung = dataSet.findIndex((find => find.id_pengunjung === id && find.id_reservasi === idReservasi));
        var jml_tamu = $("#jumlah_pengunjung").val();

        var urlItems = "items/Listdata";
        var urlProduk = "produk/Listdata";
        var urlPaket = "paket/Listdata";

        let tamu_uniq = [new Set(dataSet.map(item => item.id_pengunjung))];

        console.log("Slot Tamu : " + (parseInt(jml_tamu) - parseInt(tamu_uniq[0].size)));

        if (dataPengunjung >= 0) {
            $.ajax({
                url: "<?= base_url() ?>items/listByReservasi?reservasi=" + idReservasi,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectItems = document.getElementById("selectItems");
                    for (i = selectItems.options.length - 1; i > 0; i--) {
                        selectItems.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namaitem);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_items);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectItems.insertBefore(option, selectItems.lastChild);
                    }
                }
            })
            $.ajax({
                url: "<?= base_url() ?>produk/listByReservasi?reservasi=" + idReservasi,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectProduk = document.getElementById("selectProduk");
                    for (i = selectProduk.options.length - 1; i > 0; i--) {
                        selectProduk.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namaproduk);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_produk);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectProduk.insertBefore(option, selectProduk.lastChild);
                    }
                }
            })
            $.ajax({
                url: "<?= base_url() ?>paket/listByReservasi?reservasi=" + idReservasi,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectPaket = document.getElementById("selectPaket");
                    for (i = selectPaket.options.length - 1; i > 0; i--) {
                        selectPaket.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namapaket);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_paket);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectPaket.insertBefore(option, selectPaket.lastChild);
                    }
                }
            })
        } else {
            if (tamu_uniq[0].size < jml_tamu) {
                urlItems = "items/listByReservasi?reservasi=" + idReservasi;
                urlProduk = "produk/listByReservasi?reservasi=" + idReservasi;
                urlPaket = "paket/listByReservasi?reservasi=" + idReservasi;
            }

            $.ajax({
                url: "<?= base_url() ?>" + urlItems,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectItems = document.getElementById("selectItems");
                    for (i = selectItems.options.length - 1; i > 0; i--) {
                        selectItems.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namaitem);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_items);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectItems.insertBefore(option, selectItems.lastChild);
                    }
                }
            })
            $.ajax({
                url: "<?= base_url() ?>" + urlProduk,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectProduk = document.getElementById("selectProduk");
                    for (i = selectProduk.options.length - 1; i > 0; i--) {
                        selectProduk.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namaproduk);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_produk);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectProduk.insertBefore(option, selectProduk.lastChild);
                    }
                }
            })
            $.ajax({
                url: "<?= base_url() ?>" + urlPaket,
                success: function(response) {
                    var data = JSON.parse(response);
                    var selectPaket = document.getElementById("selectPaket");
                    for (i = selectPaket.options.length - 1; i > 0; i--) {
                        selectPaket.remove(i);
                    }
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].namapaket);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id_paket);
                        option.setAttribute("data-lokal", data[i].lokal);
                        option.setAttribute("data-domestik", data[i].domestik);
                        option.setAttribute("data-inter", data[i].internasional);
                        selectPaket.insertBefore(option, selectPaket.lastChild);
                    }
                }
            })
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
        var reservasi = $("#reservasi").val();
        var jml_tamu = $("#jumlah_pengunjung").val();

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


                var dataItems = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg && find.jenis === "items"));
                var dataPengunjung = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_reservasi === reservasi));
                var kode_reservasi = "";
                let tamu_uniq = [new Set(dataSet.map(item => item.id_pengunjung))];

                if (reservasi) {
                    if (dataPengunjung >= 0) {
                        kode_reservasi = reservasi;
                    } else if (tamu_uniq[0].size < jml_tamu) {
                        kode_reservasi = reservasi;
                    }
                }

                if (dataItems < 0) {
                    arr = {
                        "id_reservasi": kode_reservasi,
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
				jml = $("#jml").val();
                
				if (state.toLowerCase() == "bali") {
                    harga = jml*lokal;
                } else if (country.toLowerCase() == "indonesia") {
                    harga = jml*domestik;
                } else {
                    harga = jml*inter;
                }

                var dataProduk = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg && find.jenis === "produk"));
                var dataPengunjung = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_reservasi === reservasi));
                var kode_reservasi = "";
                let tamu_uniq = [new Set(dataSet.map(item => item.id_pengunjung))];

                if (reservasi) {
                    if (dataPengunjung >= 0) {
                        kode_reservasi = reservasi;
                    } else if (tamu_uniq[0].size < jml_tamu) {
                        kode_reservasi = reservasi;
                    }
                }

                if (dataProduk < 0) {
                    arr = {
                        "id_reservasi": kode_reservasi,
                        "id_pengunjung": id_pengunjung,
                        "name": nama,
                        "barang": namabrg,
                        "id_barang": idbrg,
                        "jenis": "produk",
                        "jumlah": jml,
                        "total": harga
                    };
                    dataSet.push(arr);
                } else {
                    dataSet[dataProduk].total = parseInt(dataSet[dataProduk].jumlah)*harga;               
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
				jml = $("#jml").val();
				
                if (state.toLowerCase() == "bali") {
                    harga = jml*lokal;
                } else if (country.toLowerCase() == "indonesia") {
                    harga = jml*domestik;
                } else {
                    harga = jml*inter;
                }

                var dataPaket = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_barang === idbrg && find.jenis === "paket"));
                var dataPengunjung = dataSet.findIndex((find => find.id_pengunjung === id_pengunjung && find.id_reservasi === reservasi));
                var kode_reservasi = "";
                let tamu_uniq = [new Set(dataSet.map(item => item.id_pengunjung))];

                if (reservasi) {
                    if (dataPengunjung >= 0) {
                        kode_reservasi = reservasi;
                    } else if (tamu_uniq[0].size < jml_tamu) {
                        kode_reservasi = reservasi;
                    }
                }

                if (dataPaket < 0) {
                    arr = {
                        "id_reservasi": kode_reservasi,
                        "id_pengunjung": id_pengunjung,
                        "name": nama,
                        "barang": namabrg,
                        "id_barang": idbrg,
                        "jenis": "paket",
                        "jumlah": jml,
                        "total": harga
                    };
                    dataSet.push(arr);
                }else {
                    dataSet[dataPaket].total = parseInt(dataSet[dataPaket].jumlah)*harga;
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
                className: "dt-body-right text-end",
                render: $.fn.dataTable.render.number(',', '.', 0, ''),
            },
            {
                data: {
                    id_pengunjung: "id_pengunjung",
                    id_barang: "id_barang",
                    jenis: "jenis",
                },
                title: 'Action',
                className: "dt-body-right text-center",
                mRender: function(data, type, full) {
                    return '<button type="button" class="btn btn-danger btn-icon rounded-circle removeBarang" data-idpengunjung="' + data.id_pengunjung + '" data-idbarang="' + data.id_barang + '" data-jenis="' + data.jenis + '" style="height: 20px;width: 20px;"><i class="fas fa-minus"></i></button>';
                }
            }
        ],
        // columnDefs: [{
        //     targets: -1,
        //     data: {
        //         id_pengunjung: "id_pengunjung",
        //         id_barang: "id_barang",
        //     },
        //     mRender: function(data, type, full) {
        //         return '<button type="button" class="btn btn-danger btn-icon rounded-circle removeBarang" data-idpengunjung="' + data.id_pengunjung + '" data-idbarang="' + data.id_barang + '" style="height: 20px;width: 20px;"><i class="fas fa-minus"></i></button>';
        //     }
        // }],
    });


    $(document).on('click', '.removeBarang', function() {
        $idPengunjung = $(this).data("idpengunjung"); // Mengambil id Pengunjung
        $idBarang = $(this).data("idbarang"); // Mengambil id barang
        $jenisBarang = $(this).data("jenis"); // Mengambil Jenis barang

        // Mencari data dari id_pengunjung & id_barang
        $dataBarang = dataSet.findIndex(x => x.id_pengunjung === $idPengunjung.toString() && x.id_barang === $idBarang.toString() && x.jenis === $jenisBarang.toString());
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
        var kode_reservasi = {
            "kode_reservasi": $("#reservasi").val(),
        };
        var pengayah = {
            "id_pengayah": $("#pengayah").val(),
            "namapengayah": $("#pengayah").find(':selected').text(),
        };
        localStorage.setItem('dataSet', JSON.stringify(dataSet));
        localStorage.setItem('guide', JSON.stringify(guide));
        localStorage.setItem('pengayah', JSON.stringify(pengayah));
        localStorage.setItem('kode_reservasi', JSON.stringify(kode_reservasi));
        window.location.href = "<?= base_url() ?>transaksi/summarybayar"
    })

    $("#notif_reservasi").hide();

    $("#searchReservasi").on("click", function() {
        dataSet = [];
        var idreservasi = $("#kode_reservasi").val();
        $.ajax({
            url: "<?= base_url() ?>transaksi/getreservasi?id=" + idreservasi,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.code == '404') {
                    // Toast
                    $('#notifToast').toast("show");
                    $('#message_toast').text(data.messages);
                    // Toast

                    $("#notif_reservasi").show();
                    $("#notif_reservasi").addClass('text-danger');
                    $("#notif_reservasi").text(data.messages);
                    $("#reservasi").val("");

                    tblpesanan.clear();
                    tblpesanan.rows.add(dataSet);
                    tblpesanan.draw();
                } else {
                    localStorage.setItem('dp', JSON.stringify(data.master.DP));
                    localStorage.setItem('buktibayar', JSON.stringify(data.master.buktibayar));

                    $("#guide").val(data.master.guide_id).change();
                    $("#pengayah").val(data.master.pengayah_id).change();
                    $("#jumlah_pengunjung").val(data.master.jml_tamu);
                    $("#reservasi").val(idreservasi);
                    $("#pengunjung").val(1);

                    $.each(data.barang, function(k, v) {
                        // console.log(v.lokal);
                        var state = v.state_name;
                        var country = v.country_name;

                        if (state.toLowerCase() == "bali") {
                            harga = parseInt(v.lokal);
                        } else if (country.toLowerCase() == "indonesia") {
                            harga = parseInt(v.domestik);
                        } else {
                            harga = parseInt(v.internasional);
                        }

                        if (v.jml == "0") {
                            jml = "";
                        } else {
                            jml = v.jml;
                        }

                        var state = $("#pengunjung").find(':selected').data("state");

                        arr = {
                            "id_reservasi": data.master.id,
                            "id_pengunjung": v.id_pengunjung,
                            "name": v.nama,
                            "barang": v.namabarang,
                            "id_barang": v.id_barang,
                            "jenis": v.jenis,
                            "jumlah": jml,
                            "total": harga
                        };
                        dataSet.push(arr);
                    });
                    console.log(dataSet);
                    tblpesanan.clear();
                    tblpesanan.rows.add(dataSet);
                    tblpesanan.draw();
                }
            }
        })
    })

    // ==== START SELECT COUNTRY & STATE  ====  
    $("#countryname").select2({
	    dropdownParent: $("#newvisitor")
	});
    $("#statename").select2({
	    dropdownParent: $("#newvisitor")
	});

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
	
	$("#simpandata").on("click",function(){
		$.ajax({
            url: "<?= base_url() ?>pengunjung/simpanajax",
			type: 'POST',
			data: $('#form_pengguna').serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                var select = document.getElementById("pengunjung");
                for (i = select.options.length - 1; i > 0; i--) {
                    select.remove(i);
                }
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("OPTION"),
                        txt = document.createTextNode(data[i].nama);
                    option.appendChild(txt);
                    option.setAttribute("value", data[i].id);
					option.setAttribute("data-state",data[i].statename);
					option.setAttribute("data-country",data[i].countryname);
                    select.insertBefore(option, select.lastChild);
                }
				$('#newvisitor').modal('hide');
				$("#form_pengguna")[0].reset();
            },
            error: function(response) {
                alert(response);
            }
        })
	})
</script>