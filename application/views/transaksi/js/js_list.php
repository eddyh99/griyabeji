<script src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>
<script>
    var dataSet = [];
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            startDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_awal . "')" : "moment().startOf('month')" ?>,
            endDate: <?= (!empty($tgl)) ? "moment('" . $tanggal_akhir . "')" : "moment().endOf('month')" ?>,
            opens: 'right',
            locale: {
                format: 'DD MMM YYYY'
            }
        });

        var idtc = $('#idTC').val();
        $.ajax({
            url: "<?= base_url() ?>transaksi/detailBarang?id=" + idtc,
            success: function(response) {
                var data = JSON.parse(response);
                $.each(data, function(k, v) {
                    if (v.jns.toLowerCase() == "lokal") {
                        harga = parseInt(v.lokal);
                    } else if (v.jns.toLowerCase() == "domestik") {
                        harga = parseInt(v.domestik);
                    } else {
                        harga = parseInt(v.internasional);
                    }

                    if (v.jml == "0") {
                        jml = "";
                    } else {
                        jml = v.jml;
                    }
                    arr = {
                        "id_pengunjung": v.id_pengunjung,
                        "name": v.nama,
                        "barang": v.namaitem,
                        "id_barang": v.id_produk,
                        "jenis": v.jenis,
                        "jumlah": jml,
                        "total": jml*harga
                    };
                    dataSet.push(arr);
                });
                // console.log(dataSet);
                tblpesanan.clear();
                tblpesanan.rows.add(dataSet);
                tblpesanan.draw();
            }
        });

    });


    var table;
    $(function() {
        table = $('#table_data').DataTable({
			order: [[1, 'desc']]
		});
    })

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
			var diskon = parseInt($("#diskon").text().replace(',', ''));
			$("#totalbelanja").text((total-diskon).toLocaleString("id"));
            $(api.column(3).footer()).html(
                total.toLocaleString("id")
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
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
            }
        ]
    });
</script>