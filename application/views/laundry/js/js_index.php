<style>
	tr {
		height: 50px;
	}

	#table_data tbody tr {
		cursor: pointer;
	}
</style>
<script>
	var dataItems = [];
	$("#namaitems").select2();

	var table;
	$(function() {
		table = $('#table_data').DataTable({
			"order": [
				[1, "asc"]
			],
			"scrollX": true,
			"ajax": {
				"url": "<?= base_url() ?>laundry/Listdata",
				"type": "POST",
				"dataSrc": function(data) {
					return data;
				}
			},
			"aoColumnDefs": [{
				"aTargets": [2],
				"mData": "id",
				"mRender": function(data, type, full, meta) {
					button = '<a href="<?= base_url() ?>laundry/detail/' + encodeURI(btoa(data)) + '" class="badge text-bg-primary text-white rounded-pill mx-1">Info</a>';
					if (full.status == 'no') {
						button = button + '<a href="<?= base_url() ?>laundry/upStatus/kembali/' + encodeURI(btoa(data)) + '" class="badge text-bg-success text-white rounded-pill mx-1">Kembali</a>';
						button = button + '<a href="<?= base_url() ?>laundry/upStatus/delete/' + encodeURI(btoa(data)) + '" class="badge text-bg-danger text-white rounded-pill mx-1">Hapus</a>';
					}
					return button;
				}
			}],
			"columns": [{
					"data": "id"
				},
				{
					"data": "tanggal"
				},
			]
		});
	})

	$("#addItems").on("click", function(e) {
		var namaitems = $('#namaitems').find(':selected').text();
		var iditems = $("#namaitems").val();
		var jml = $("#jumlah").val();

		if (!jml) {
			jml = 1;
		}

		var cekItems = dataItems.findIndex((find => find.id_items === iditems));

		if (cekItems < 0) {
			arr = {
				"id_items": iditems,
				"namaitems": namaitems,
				"jumlah": jml
			};
			dataItems.push(arr);
		} else {
			dataItems[cekItems].jumlah = parseInt(dataItems[cekItems].jumlah) + parseInt(jml)
		}

		JSON.stringify(dataItems);
		console.log(dataItems);
		tblpesanan.clear();
		tblpesanan.rows.add(dataItems);
		tblpesanan.draw();
	});

	var tblpesanan = $('#table_items').DataTable({
		order: [
			[1, 'desc']
		],
		data: dataItems,
		columns: [{
				data: 'namaitems'
			},
			{
				data: 'jumlah',
			},
			{
				data: 'id_items',
				className: "dt-body-right text-center",
				mRender: function(data, type, full) {
					return '<button type="button" class="btn btn-danger btn-icon rounded-circle removeItems" data-id="' + data + '" style="height: 20px;width: 20px;"><i class="fas fa-minus"></i></button>';
				}
			}
		],
	});

	$(document).on('click', '.removeItems', function() {
		$id = $(this).data("id"); // Mengambil id

		// Mencari data dari id_pengunjung & id_barang
		$cekBarang = dataItems.findIndex(x => x.id_items === $id.toString());
		dataItems.splice($cekBarang, 1);

		tblpesanan.clear();
		tblpesanan.rows.add(dataItems);
		tblpesanan.draw();
	});

	$("#btnSimpan").on('click', function(e) {
		values = "data=" + JSON.stringify(dataItems);
		$.ajax({
			url: "<?= base_url() ?>laundry/simpandata",
			type: "post",
			data: values,
			success: function(response) {
				if (response == 0) {
					localStorage.clear();
					window.location.href = "<?= base_url() ?>laundry";
				} else {
					console.log(response);
				}
			},
		});
	})
</script>