<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_transaksi extends CI_Model
{
	private function unik_produk($array, $uniqueKey)
	{
		$unique = array();

		foreach ($array as $value) {
			if ($value->jenis == 'items') {
				$unique[$value->$uniqueKey . '1'] = $value;
			}
			if ($value->jenis == 'produk') {
				$unique[$value->$uniqueKey . '2'] = $value;
			}
			if ($value->jenis == 'paket') {
				$unique[$value->$uniqueKey . '3'] = $value;
			}
		}

		$data = array_values($unique);
		return $data;
	}

	public function add_data($mtrans, $data)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->insert("penjualan", $mtrans);
		$id = $this->db->insert_id();

		$unikproduk = $this->unik_produk($data, 'id_barang');
		foreach ($unikproduk as $produk) {
			$temp["id_transaksi"]	= $id;
			$temp["jenis"]			= $produk->jenis;
			$temp["id_produk"]		= $produk->id_barang;

			$this->db->insert("penjualan_detail", $temp);
			$id_detail = $this->db->insert_id();

			$pengunjung = array();
			foreach ($data as $dt) {
				if ($temp["id_produk"] == $dt->id_barang && $temp["jenis"] == $dt->jenis) {

					if (empty($dt->id_reservasi)) {
						$id_reservasi = NULL;
					} else {
						$id_reservasi = $dt->id_reservasi;
					}

					$temp2["id_detail"]		= $id_detail;
					$temp2["id_pengunjung"] = $dt->id_pengunjung;
					$temp2["jml"]			= $dt->jumlah;
					$temp2["id_reservasi"]	= $id_reservasi;
					array_push($pengunjung, $temp2);
				}
			}
			// return $pengunjung;
			// die;
			$this->db->insert_batch("penjualan_pengunjung", $pengunjung);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data tidak dapat disimpan, periksa ulang");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function listTansaksi($start, $end)
	{
		$sql = "
		SELECT 
		a.id,
		a.tanggal,
		b.nama AS pengayah,
		c.nama AS guide
		FROM `penjualan` a
		LEFT JOIN `pengayah` b ON a.pengayah_id = b.id 
		LEFT JOIN `guide` c ON a.guide_id = c.id
		WHERE DATE(a.tanggal) BETWEEN ? AND ? GROUP BY a.id";
		$query = $this->db->query($sql, array($start, $end));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function detail($id)
	{
		$sql = "
		SELECT 
		a.id,
		a.tanggal,
		a.diskon,
		b.nama AS pengayah,
		c.nama AS guide
		FROM `penjualan` a
		LEFT JOIN `pengayah` b ON a.pengayah_id = a.pengayah_id
		LEFT JOIN `pengayah` c ON a.guide_id = a.guide_id
		WHERE a.id = ?";
		$query = $this->db->query($sql, array($id));
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function detailBarang($id)
	{
		$sql = "
		-- START ITEMS & NO RESERVASI
		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN items f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_items, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			items_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				items_harga 
				WHERE 
				tanggal <= 
				(
					SELECT
						tanggal
					FROM
						penjualan
					WHERE
						id = ?
				)
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NULL
		AND a.id = ?
		-- END ITEMS & NO RESERVASI
		UNION ALL
		-- START ITEMS & ADD RESERVASI
		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN items f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_items, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			items_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				items_harga 
				WHERE 
				tanggal <=(
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					b.id_reservasi = a.id
					AND d.id = ?
				) 
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NOT NULL
		AND a.id = ?

		-- END ITEMS & ADD RESERVASI
		UNION ALL
		-- START PRODUK & NO RESERVASI

		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			produk_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				produk_harga 
				WHERE 
				tanggal <= 
				(
					SELECT
						tanggal
					FROM
						penjualan
					WHERE
						id = ?
				)
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NULL
		AND a.id = ?

		-- END PRODUK & NO RESERVASI
		UNION ALL
		-- START PRODUK & ADD RESERVASI

		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			produk_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				produk_harga 
				WHERE 
				tanggal <=(
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					b.id_reservasi = a.id
					AND d.id = ?
				) 
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NOT NULL
		AND a.id = ?

		-- END PRODUK & ADD RESERVASI
		UNION ALL
		-- START PAKET & NO RESERVASI

		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			paket_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				paket_harga 
				WHERE 
				tanggal <= 
				(
					SELECT
						tanggal
					FROM
						penjualan
					WHERE
						id = ?
				) 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NULL
		AND a.id = ?
		-- END PAKET & NO RESERVASI
		UNION ALL
		-- START PAKET & ADD RESERVASI
		SELECT 
		a.tanggal, 
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		d.id AS id_pengunjung,
		d.nama, 
		a.method, 
		b.jenis, 
		IF(
			e.state_name = 'BALI', 
			'LOKAL', 
			IF (
			e.state_name != 'BALI' 
			AND e.country_code = 'ID', 
			'DOMESTIK', 
			'INTERNASIONAL'
			)
		) as jns, 
		y.lokal, 
		y.domestik, 
		y.internasional 
		FROM 
		penjualan a 
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			lokal, 
			domestik, 
			internasional 
			FROM 
			paket_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				paket_harga 
				WHERE 
				tanggal <=(
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					b.id_reservasi = a.id
					AND d.id = ?
				) 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NOT NULL
		AND a.id = ?
		";
		$query = $this->db->query($sql, array($id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}
}
