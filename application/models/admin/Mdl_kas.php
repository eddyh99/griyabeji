<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_kas extends CI_Model
{
	public function Listkas()
	{
		$now = date("Y-m-d");

		$sql = "SELECT a.id, tanggal, nominal, keterangan, storename as store FROM " . KAS . " a INNER JOIN " . STORE . " b ON a.store_id=b.id WHERE DATE(tanggal)=?";
		$query = $this->db->query($sql, $now);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function listKasByDate($date)
	{
		$sql = "SELECT a.id, a.store_id, tanggal,jenis, nominal, keterangan, storename as store FROM " . KAS . " a INNER JOIN " . STORE . " b ON a.store_id=b.id WHERE DATE(tanggal)=?";
		$query = $this->db->query($sql, $date);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data)
	{
		if ($this->db->insert(KAS, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	public function laporanHarian($date)
	{
		$now = date("Y-m-d");

		$sql = "
		-- START ITEMS & NO RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		c.id_reservasi, 
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
		y.lokal as is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
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
			internasional,
			komisi_guide_lokal, 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_lokal, 
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional 
			FROM 
			items_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				items_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?
		-- END ITEMS & NO RESERVASI
		UNION ALL
		-- START ITEMS & ADD RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		c.id_reservasi, 
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
		y.lokal as is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional ,
		y.komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
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
			internasional,
			komisi_guide_lokal, 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_lokal, 
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			items_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				items_harga 
				WHERE 
				tanggal IN(
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?

		-- END ITEMS & ADD RESERVASI
		UNION ALL
		-- START PRODUK & NO RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional ,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			is_double,
			lokal, 
			domestik, 
			internasional , 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			produk_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				produk_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?

		-- END PRODUK & NO RESERVASI
		UNION ALL
		-- START PRODUK & ADD RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			produk_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				produk_harga 
				WHERE 
				tanggal IN (
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?

		-- END PRODUK & ADD RESERVASI
		UNION ALL
		-- START PAKET & NO RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			paket_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				paket_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?
		-- END PAKET & NO RESERVASI
		UNION ALL
		-- START PAKET & ADD RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional 
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional
			FROM 
			paket_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				paket_harga 
				WHERE 
				tanggal IN (
					SELECT 
					a.tanggal 
					FROM 
					reservasi a 
					INNER JOIN penjualan_pengunjung b ON a.id = b.id_reservasi 
					INNER JOIN penjualan_detail c ON b.id_detail = c.id 
					INNER JOIN penjualan d ON d.id = c.id_transaksi 
					WHERE 
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?
		";
		$query = $this->db->query($sql, array($date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function laporanRance($date)
	{
		$date_awal = date("d M Y", strtotime("2023-5-1"));
		$date_akhir = date("d M Y", strtotime("2023-5-30"));

		$sql = "
		-- START ITEMS & NO RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		c.id_reservasi, 
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
		y.lokal as is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
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
			internasional,
			komisi_guide_lokal, 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_lokal, 
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional 
			FROM 
			items_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				items_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?
		-- END ITEMS & NO RESERVASI
		UNION ALL
		-- START ITEMS & ADD RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaitem, 
		c.jml, 
		c.id_reservasi, 
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
		y.lokal as is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional ,
		y.komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
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
			internasional,
			komisi_guide_lokal, 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_lokal, 
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
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
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_items
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_items 
		WHERE 
		b.jenis = 'items' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?

		-- END ITEMS & ADD RESERVASI
		UNION ALL
		-- START PRODUK & NO RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional ,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			is_double,
			lokal, 
			domestik, 
			internasional , 
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			produk_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				produk_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?

		-- END PRODUK & NO RESERVASI
		UNION ALL
		-- START PRODUK & ADD RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namaproduk, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN produk f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_produk, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
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
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_produk
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_produk 
		WHERE 
		b.jenis = 'produk' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?

		-- END PRODUK & ADD RESERVASI
		UNION ALL
		-- START PAKET & NO RESERVASI

		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional  
			FROM 
			paket_harga a 
			JOIN (
				SELECT 
				max(tanggal) as max_date 
				FROM 
				paket_harga 
				WHERE 
				tanggal <= ? 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NULL
		AND date(a.tanggal) = ?
		-- END PAKET & NO RESERVASI
		UNION ALL
		-- START PAKET & ADD RESERVASI
		SELECT 
		a.tanggal, 
        a.pengayah_id,
        a2.nama AS nama_pengayah,
        a.guide_id,
        a1.nama AS nama_guide,
		b.id_produk, 
		f.namapaket, 
		c.jml, 
		c.id_reservasi, 
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
		y.is_double, 
		y.lokal, 
		y.domestik, 
		y.internasional,
		y.komisi_guide_domestik as komisi_guide_lokal,
		y.komisi_guide_domestik,
		y.komisi_guide_internasional,
		y.komisi_pengayah_domestik as komisi_pengayah_lokal,
		y.komisi_pengayah_domestik,
		y.komisi_pengayah_internasional 
		FROM 
		penjualan a 
		LEFT JOIN guide a1 ON a.guide_id = a1.id 
		LEFT JOIN pengayah a2 ON a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON a.id = b.id_transaksi 
		INNER JOIN penjualan_pengunjung c ON b.id = c.id_detail 
		INNER JOIN pengunjung d ON c.id_pengunjung = d.id 
		INNER JOIN tbl_state e ON d.state_id = e.state_code 
		AND d.country_code = e.country_code 
		INNER JOIN paket f ON b.id_produk = f.id 
		INNER JOIN (
			SELECT 
			id_paket, 
			is_double,
			lokal, 
			domestik, 
			internasional,
			komisi_guide_domestik, 
			komisi_guide_internasional,
			komisi_pengayah_domestik, 
			komisi_pengayah_internasional
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
					date(d.tanggal)<= ?
				) 
				GROUP BY 
				id_paket
			) x ON a.tanggal = x.max_date
		) y ON f.id = y.id_paket 
		WHERE 
		b.jenis = 'paket' 
		AND c.id_reservasi IS NOT NULL
		AND date(a.tanggal) = ?
		";
		$query = $this->db->query($sql, array($date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}
}
