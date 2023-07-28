<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_reservasi extends CI_Model
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
		$this->db->insert("reservasi", $mtrans);
		$error=$this->db->error();
		$id = $this->db->insert_id();

		$unikproduk = $this->unik_produk($data, 'id_barang');
		foreach ($unikproduk as $produk) {
			$temp["id_transaksi"]	= $id;
			$temp["jenis"]			= $produk->jenis;
			$temp["id_produk"]		= $produk->id_barang;

			$this->db->insert("reservasi_detail", $temp);
			$id_detail = $this->db->insert_id();

			$pengunjung = array();
			foreach ($data as $dt) {
				if ($temp["id_produk"] == $dt->id_barang && $temp["jenis"] == $dt->jenis) {
					$temp2["id_detail"]		= $id_detail;
					$temp2["id_pengunjung"]	= $mtrans["namatamu"];
					$temp2["jml"]			= $dt->jumlah;
					array_push($pengunjung, $temp2);
				}
			}

			$this->db->insert_batch("reservasi_pengunjung", $pengunjung);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => $error["message"]);
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function getDataMaster($id)
	{
		$sql = "
		SELECT 
		* 
		FROM `reservasi`
		WHERE is_proses = 'yes' AND id = ?;
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return $query->row();
		} else {
			return $this->db->error();
		}
	}

	public function getDataBarang($id)
	{
		$sql = "
		SELECT
			a.id_transaksi,
			d.id as id_pengunjung, 
			d.nama,
			b.id as id_barang,
			b.namaitem AS namabarang,
			a.jenis,
			c.jml,
			e.state_name,
			e2.name AS country_name,
			X.lokal,
			X.domestik,
			X.internasional
		FROM
			reservasi_detail a
		INNER JOIN items b ON
			a.id_produk = b.id
		INNER JOIN reservasi_pengunjung c ON
			a.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN tbl_country e2 ON
			d.country_code = e2.code
		INNER JOIN(
			SELECT
				id_items,
				lokal,
				domestik,
				internasional
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
		) X
		ON
			a.id_produk = X.id_items
		INNER JOIN reservasi g ON
			g.id = a.id_transaksi
		WHERE
			a.jenis = 'items' AND a.id_transaksi = ?
		UNION ALL
		SELECT
			a.id_transaksi,
			d.id as id_pengunjung, 
			d.nama,
			b.id as id_barang,
			b.namaproduk AS namabarang,
			a.jenis,
			c.jml,
			e.state_name,
			e2.name AS country_name,
			X.lokal,
			X.domestik,
			X.internasional
		FROM
			reservasi_detail a
		INNER JOIN produk b ON
			a.id_produk = b.id
		INNER JOIN reservasi_pengunjung c ON
			a.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN tbl_country e2 ON
			d.country_code = e2.code
		INNER JOIN(
			SELECT
				id_produk,
				lokal,
				domestik,
				internasional
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
		) X
		ON
			a.id_produk = X.id_produk
		INNER JOIN reservasi g ON
			g.id = a.id_transaksi
		WHERE
			a.jenis = 'produk' AND a.id_transaksi = ?
		UNION ALL
		SELECT
			a.id_transaksi,
			d.id as id_pengunjung, 
			d.nama,
			b.id as id_barang,
			b.namapaket AS namabarang,
			a.jenis,
			c.jml,
			e.state_name,
			e2.name AS country_name,
			X.lokal,
			X.domestik,
			X.internasional
		FROM
			reservasi_detail a
		INNER JOIN paket b ON
			a.id_produk = b.id
		INNER JOIN reservasi_pengunjung c ON
			a.id = c.id_detail
		INNER JOIN pengunjung d ON
			c.id_pengunjung = d.id
		INNER JOIN tbl_state e ON
			d.state_id = e.state_code AND d.country_code = e.country_code
		INNER JOIN tbl_country e2 ON
			d.country_code = e2.code
		INNER JOIN(
			SELECT
				id_paket,
				lokal,
				domestik,
				internasional
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
		) X
		ON
			a.id_produk = X.id_paket
		INNER JOIN reservasi g ON
			g.id = a.id_transaksi
		WHERE
			a.jenis = 'paket' AND a.id_transaksi = ?
		";
		$query = $this->db->query($sql, array($id, $id, $id, $id, $id, $id));
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function update_proses($id)
	{
		$data		= array(
			"is_proses"  => "no",
		);

		$this->db->where("id", $id);
		if ($this->db->update('reservasi', $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	public function list_reservasi(){
		$sql="SELECT a.id, b.nama as namatamu FROM reservasi a INNER JOIN pengunjung b ON a.namatamu=b.id WHERE a.id NOT IN (SELECT id_reservasi FROM penjualan_pengunjung WHERE id_reservasi IS NOT NULL);";
		$query=$this->db->query($sql);
		return $query->result();
	}
}
