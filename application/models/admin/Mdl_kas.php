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
			b.id_produk AS id_barang,
			f.namaitem AS namabarang,
			c.jml,
			c.id_reservasi,
			d.id AS id_pengunjung,
			d.nama,
			a.method,
			b.jenis,
			IF(
				e.state_name = 'BALI',
				'LOKAL',
				IF(
					e.state_name != 'BALI' AND e.country_code = 'ID',
					'DOMESTIK',
					'INTERNASIONAL'
				)
			) AS jns,
			Y.lokal AS is_double,
			Y.lokal,
			Y.domestik,
			Y.internasional,
			Y.komisi_guide_lokal,
			Y.komisi_guide_domestik,
			Y.komisi_guide_internasional,
			Y.komisi_pengayah_lokal,
			Y.komisi_pengayah_domestik,
			Y.komisi_pengayah_internasional
		FROM
			penjualan a
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN items f ON
			b.id_produk = f.id
		INNER JOIN(
			SELECT id_items,
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
			JOIN(
				SELECT MAX(tanggal) AS max_date
				FROM
					items_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_items
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_items
		WHERE
			b.jenis = 'items' AND c.id_reservasi IS NULL AND DATE(a.tanggal) = ?
		-- END ITEMS & NO RESERVASI

		UNION ALL

		-- START ITEMS & ADD RESERVASI
		SELECT
			a.tanggal,
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang,
			f.namaitem AS namabarang,
			c.jml,
			c.id_reservasi,
			d.id AS id_pengunjung,
			d.nama,
			a.method,
			b.jenis,
			IF(
				e.state_name = 'BALI',
				'LOKAL',
				IF(
					e.state_name != 'BALI' AND e.country_code = 'ID',
					'DOMESTIK',
					'INTERNASIONAL'
				)
			) AS jns,
			Y.lokal AS is_double,
			Y.lokal,
			Y.domestik,
			Y.internasional,
			Y.komisi_guide_lokal,
			Y.komisi_guide_domestik,
			Y.komisi_guide_internasional,
			Y.komisi_pengayah_lokal,
			Y.komisi_pengayah_domestik,
			Y.komisi_pengayah_internasional
		FROM
			penjualan a
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN items f ON
			b.id_produk = f.id
		INNER JOIN(
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
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					items_harga
				WHERE
					tanggal <=(
					SELECT
						a.tanggal
					FROM
						reservasi a
					INNER JOIN penjualan_pengunjung b ON
						a.id = b.id_reservasi
					INNER JOIN penjualan_detail c ON
						b.id_detail = c.id
					INNER JOIN penjualan d ON
						d.id = c.id_transaksi
					WHERE
						DATE(d.tanggal) = ?
					GROUP BY
						b.id_reservasi
				)
			GROUP BY
				id_items
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_items
		WHERE
			b.jenis = 'items' AND c.id_reservasi IS NOT NULL AND DATE(a.tanggal) = ?
		-- END ITEMS & NO RESERVASI

		UNION ALL

		-- START PRODUK & NO RESERVASI
		SELECT
			a.tanggal, 
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang, 
			f.namaproduk AS namabarang, 
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
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN produk f ON
			b.id_produk = f.id
		INNER JOIN(
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
			JOIN(
				SELECT MAX(tanggal) AS max_date
				FROM
					produk_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_produk
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_produk
		WHERE
			b.jenis = 'produk' AND c.id_reservasi IS NULL AND DATE(a.tanggal) = ?
		-- END PRODUK & NO RESERVASI

		UNION ALL

		-- START PRODUK & ADD RESERVASI
		SELECT
			a.tanggal, 
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang, 
			f.namaproduk AS namabarang, 
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
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN produk f ON
			b.id_produk = f.id
		INNER JOIN(
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
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					produk_harga
				WHERE
					tanggal <=(
					SELECT
						a.tanggal
					FROM
						reservasi a
					INNER JOIN penjualan_pengunjung b ON
						a.id = b.id_reservasi
					INNER JOIN penjualan_detail c ON
						b.id_detail = c.id
					INNER JOIN penjualan d ON
						d.id = c.id_transaksi
					WHERE
						DATE(d.tanggal) = ?
					GROUP BY
						b.id_reservasi
				)
			GROUP BY
				id_produk
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_produk
		WHERE
			b.jenis = 'produk' AND c.id_reservasi IS NOT NULL AND DATE(a.tanggal) = ?
		-- END PRODUK & ADD RESERVASI

		UNION ALL

		-- START PAKET & NO RESERVASI
		SELECT
			a.tanggal, 
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang, 
			f.namapaket AS namabarang, 
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
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN paket f ON
			b.id_produk = f.id
		INNER JOIN(
			SELECT 
				id_paket, 
				is_double,
				lokal, 
				domestik, 
				internasional , 
				komisi_guide_domestik, 
				komisi_guide_internasional,
				komisi_pengayah_domestik, 
				komisi_pengayah_internasional
			FROM
				paket_harga a
			JOIN(
				SELECT MAX(tanggal) AS max_date
				FROM
					paket_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_paket
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_paket
		WHERE
			b.jenis = 'paket' AND c.id_reservasi IS NULL AND DATE(a.tanggal) = ?
		-- END PAKET & NO RESERVASI

		UNION ALL

		-- START PAKET & ADD RESERVASI
		SELECT
			a.tanggal, 
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang, 
			f.namapaket AS namabarang, 
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
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN paket f ON
			b.id_produk = f.id
		INNER JOIN(
			SELECT
				id_paket,
				is_double,
				lokal, 
				domestik, 
				internasional , 
				komisi_guide_domestik, 
				komisi_guide_internasional,
				komisi_pengayah_domestik, 
				komisi_pengayah_internasional
			FROM
				paket_harga a
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					paket_harga
				WHERE
					tanggal <=(
					SELECT
						a.tanggal
					FROM
						reservasi a
					INNER JOIN penjualan_pengunjung b ON
						a.id = b.id_reservasi
					INNER JOIN penjualan_detail c ON
						b.id_detail = c.id
					INNER JOIN penjualan d ON
						d.id = c.id_transaksi
					WHERE
						DATE(d.tanggal) = ?
					GROUP BY
						b.id_reservasi
				)
			GROUP BY
				id_paket
			) X
		ON
			a.tanggal = X.max_date
		) Y
		ON
			f.id = Y.id_paket
		WHERE
			b.jenis = 'paket' AND c.id_reservasi IS NOT NULL AND DATE(a.tanggal) = ?
		-- END PAKET & ADD RESERVASI
		";
		$query = $this->db->query($sql, array($date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date, $date));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getpenjualan($awal, $akhir)
	{
		$sql = "
		SELECT
			a.id,
			a.tanggal,
			a.pengayah_id,
			a2.nama AS nama_pengayah,
			a.guide_id,
			a1.nama AS nama_guide,
			b.id_produk AS id_barang,
			f.namaitem AS namabarang,
			c.jml,
			c.id_reservasi,
			d.id AS id_pengunjung,
			d.nama AS nama_pengunjung,
			a.method,
			b.jenis,
			IF(
				e.state_name = 'BALI',
				'LOKAL',
				IF(
					e.state_name != 'BALI' AND e.country_code = 'ID',
					'DOMESTIK',
					'INTERNASIONAL'
				)
			) AS jns
		FROM
			penjualan a
		LEFT JOIN guide a1 ON
			a.guide_id = a1.id
		LEFT JOIN pengayah a2 ON
			a.pengayah_id = a2.id
		INNER JOIN penjualan_detail b ON
			a.id = b.id_transaksi
		INNER JOIN penjualan_pengunjung c ON
			b.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN items f ON
			b.id_produk = f.id
		WHERE
			DATE(a.tanggal) BETWEEN ? AND ?
		";
		$query = $this->db->query($sql, array($awal, $akhir));
		$penjualan = $query->result_array();

		$mdata = array();
		foreach ($penjualan as $dt) {
			$temp['id'] 				= $dt['id'];
			$temp['tanggal'] 			= $dt['tanggal'];
			$temp['pengayah_id'] 		= $dt['pengayah_id'];
			$temp['nama_pengayah'] 		= $dt['nama_pengayah'];
			$temp['guide_id'] 			= $dt['guide_id'];
			$temp['nama_guide'] 		= $dt['nama_guide'];
			$temp['id_barang'] 			= $dt['id_barang'];
			$temp['namabarang'] 		= $dt['namabarang'];
			$temp['jml'] 				= $dt['jml'];
			$temp['jenis'] 				= $dt['jenis'];
			$temp['id_reservasi'] 		= $dt['id_reservasi'];
			$temp['id_pengunjung'] 		= $dt['id_pengunjung'];
			$temp['nama_pengunjung'] 	= $dt['nama_pengunjung'];
			$temp['jns'] 				= $dt['jns'];
			$temp['method'] 			= $dt['method'];


			if ($dt['jenis'] == 'items') {
				$query = $this->itemsQuery($dt['id_reservasi']);
				if ($dt['id_reservasi'] == NULL) {
					$detailHarga = (array)$this->db->query($query, array($dt["tanggal"], $dt["id_barang"]))->row();
				} else {
					$detailHarga = (array)$this->db->query($query, array($dt["id_reservasi"], $dt["id_barang"]))->row();
				}
			}
			if ($dt['jenis'] == 'produk') {
				$query = $this->produkQuery($dt['id_reservasi']);
				if ($dt['id_reservasi'] == NULL) {
					$detailHarga = (array)$this->db->query($query, array($dt["tanggal"], $dt["id_barang"]))->row();
				} else {
					$detailHarga = (array)$this->db->query($query, array($dt["id_reservasi"], $dt["id_barang"]))->row();
				}
			}
			if ($dt['jenis'] == 'paket') {
				$query = $this->paketQuery($dt['id_reservasi']);
				if ($dt['id_reservasi'] == NULL) {
					$detailHarga = (array)$this->db->query($query, array($dt["tanggal"], $dt["id_barang"]))->row();
				} else {
					$detailHarga = (array)$this->db->query($query, array($dt["id_reservasi"], $dt["id_barang"]))->row();
				}
			}

			$temp['is_double'] 						= (@$detailHarga['is_double']) ? $detailHarga['is_double'] : 'NULL';
			$temp['hpp'] 							= (@$detailHarga['hpp']) ? $detailHarga['hpp'] : 'NULL';
			$temp['lokal'] 							= $detailHarga['lokal'];
			$temp['domestik'] 						= $detailHarga['domestik'];
			$temp['internasional']					= $detailHarga['internasional'];
			$temp['komisi_guide_lokal'] 			= (@$detailHarga['komisi_guide_lokal']) ? $detailHarga['komisi_guide_lokal'] : $detailHarga['komisi_guide_domestik'];
			$temp['komisi_guide_domestik'] 			= $detailHarga['komisi_guide_domestik'];
			$temp['komisi_guide_internasional'] 	= $detailHarga['komisi_guide_internasional'];
			$temp['komisi_pengayah_lokal'] 			= (@$detailHarga['komisi_pengayah_lokal']) ? $detailHarga['komisi_pengayah_lokal'] : $detailHarga['komisi_pengayah_domestik'];
			$temp['komisi_pengayah_domestik'] 		= $detailHarga['komisi_pengayah_domestik'];
			$temp['komisi_pengayah_internasional'] 	= $detailHarga['komisi_pengayah_internasional'];

			array_push($mdata, $temp);
		}

		return $mdata;
	}

	private function itemsQuery($idReservasi = NULL)
	{
		$noreservasiItems = "
			SELECT
				a.id_items,
				a.hpp,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_lokal,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_lokal,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				items_harga a
			INNER JOIN(
				SELECT
					MAX(tanggal) AS tanggal,
					id_items
				FROM
					items_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_items
			) X
			ON
				a.id_items = X.id_items AND a.tanggal = X.tanggal
			WHERE
				a.id_items = ?;
			";

		$reservasiItems = "
			SELECT
				a.id_items,
				a.hpp,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_lokal,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_lokal,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				items_harga a
			INNER JOIN items b ON
				a.id_items = b.id
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					items_harga
				WHERE
					tanggal <=(
					SELECT
						tanggal
					FROM
						reservasi
					WHERE
						id = ?
				)
			GROUP BY
				id_items
			) X
			ON
				a.tanggal = X.max_date
			WHERE a.id_items = ?;
			";

		if ($idReservasi == NULL) {
			return $noreservasiItems;
		} else {
			return $reservasiItems;
		}
	}

	private function produkQuery($idReservasi = NULL)
	{
		$noreservasiProduk = "
			SELECT
				a.id_produk,
				a.is_double,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				produk_harga a
			INNER JOIN(
				SELECT
					MAX(tanggal) AS tanggal,
					id_produk
				FROM
					produk_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_produk
			) X
			ON
				a.id_produk = X.id_produk AND a.tanggal = X.tanggal
			WHERE
				a.id_produk = ?;
			";

		$reservasiProduk = "
			SELECT
				a.id_produk,
				a.is_double,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				produk_harga a
			INNER JOIN produk b ON
				a.id_produk = b.id
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					produk_harga
				WHERE
					tanggal <=(
					SELECT
						tanggal
					FROM
						reservasi
					WHERE
						id = ?
				)
			GROUP BY
				id_produk
			) X
			ON
				a.tanggal = X.max_date
			WHERE a.id_produk = ?;
			";

		if ($idReservasi == NULL) {
			return $noreservasiProduk;
		} else {
			return $reservasiProduk;
		}
	}

	private function paketQuery($idReservasi = NULL)
	{
		$noreservasiPaket = "
			SELECT
				a.id_paket,
				a.is_double,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				paket_harga a
			INNER JOIN(
				SELECT
					MAX(tanggal) AS tanggal,
					id_paket
				FROM
					paket_harga
				WHERE
					tanggal <= ?
				GROUP BY
					id_paket
			) X
			ON
				a.id_paket = X.id_paket AND a.tanggal = X.tanggal
			WHERE
				a.id_paket = ?;
			";

		$reservasiPaket = "
			SELECT
				a.id_paket,
				a.is_double,
				a.lokal,
				a.domestik,
				a.internasional,
				a.komisi_guide_domestik,
				a.komisi_guide_internasional,
				a.komisi_pengayah_domestik,
				a.komisi_pengayah_internasional
			FROM
				paket_harga a
			INNER JOIN paket b ON
				a.id_paket = b.id
			JOIN(
				SELECT
					MAX(tanggal) AS max_date
				FROM
					paket_harga
				WHERE
					tanggal <=(
					SELECT
						tanggal
					FROM
						reservasi
					WHERE
						id = ?
				)
			GROUP BY
				id_paket
			) X
			ON
				a.tanggal = X.max_date
			WHERE a.id_paket = ?;
			";

		if ($idReservasi == NULL) {
			return $noreservasiPaket;
		} else {
			return $reservasiPaket;
		}
	}
}
