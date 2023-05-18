<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_paket extends CI_Model
{
	public function Listpaket()
	{
		$sql = "SELECT id, namapaket, x.lokal,x.domestik, x.internasional 
		FROM " . PAKET . " a INNER JOIN 
		( 
			SELECT a.lokal, a.internasional, a.domestik, a.id_paket 
			FROM " . PAKET_HARGA . " a INNER JOIN 
			(
				SELECT MAX(tanggal) as tanggal,id_paket 
				FROM " . PAKET_HARGA . " GROUP BY id_paket
			) x 
			ON a.id_paket=x.id_paket AND a.tanggal=x.tanggal
		) x ON a.id=x.id_paket
		WHERE a.status='no'
		";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function ListPaketByReservasi($id)
	{
		$sql = "
		SELECT
			a.id_paket,
			b.namapaket,
			a.lokal,
			a.domestik,
			a.internasional
		FROM
			paket_harga a
		INNER JOIN paket b ON a.id_paket = b.id
		JOIN(
			SELECT MAX(tanggal) AS max_date
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
		WHERE b.status='no';
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function itempaket($id)
	{
		$sql2 = "SELECT id_produk, namaproduk
        FROM " . PAKET_DETAIL . " a INNER JOIN " . PRODUK . " b ON a.id_produk=b.id 
        WHERE id_paket=?";
		$query2 = $this->db->query($sql2, $id);
		return $query2->result_array();
	}

	public function getPaket($id)
	{
		$sql = "
		SELECT 
		id,
		namapaket, 
		x.lokal,
		x.domestik,
		x.internasional,
		x.komisi_guide_domestik, 
		x.komisi_guide_internasional, 
		x.komisi_pengayah_domestik, 
		x.komisi_pengayah_internasional
		FROM " . PAKET . " a 
		INNER JOIN (
			SELECT 
			a.lokal, 
			a.internasional, 
			a.domestik, 
			a.id_paket,
			a.komisi_guide_domestik, 
			a.komisi_guide_internasional, 
			a.komisi_pengayah_domestik, 
			a.komisi_pengayah_internasional
			FROM " . PAKET_HARGA . " a 
			INNER JOIN (
				SELECT 
				MAX(tanggal) as tanggal,
				id_paket 
				FROM " . PAKET_HARGA . " 
				GROUP BY id_paket
			) x ON a.id_paket=x.id_paket AND a.tanggal=x.tanggal
		) x ON a.id=x.id_paket
		WHERE a.status='no' AND id=?
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data, $harga, $produk)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->insert(PAKET, $data);
		$id = $this->db->insert_id();

		$harga["id_paket"] = $id;

		//insert ke tabel harga
		$this->db->insert(PAKET_HARGA, $harga);

		$detail = array();
		foreach ($produk as $dt) {
			$temp["id_paket"]   = $id;
			$temp["id_produk"]  = $dt;
			array_push($detail, $temp);
		}

		$this->db->insert_batch(PAKET_DETAIL, $detail);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data tidak dapat disimpan, periksa ulang");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function updateData($data, $harga, $produk, $id)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->where("id", $id);
		$this->db->update(PAKET, $data);

		$this->db->where("id_paket", $id);
		$this->db->delete(PAKET_DETAIL);

		//insert ke tabel harga
		$this->db->insert(PAKET_HARGA, $harga);

		$detail = array();
		foreach ($produk as $dt) {
			$temp["id_paket"]   = $id;
			$temp["id_produk"]  = $dt;
			array_push($detail, $temp);
		}

		$this->db->insert_batch(PAKET_DETAIL, $detail);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data gagal di update");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function hapusData($data, $id)
	{
		$this->db->where("id", $id);
		if ($this->db->update(PAKET, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	/********* Promotional paket *******/
	public function promopaket()
	{
		$now = date("Y-m-d");
		$sql = "SELECT DATE_FORMAT(a.awal,'%d %b %Y') as awal,DATE_FORMAT(a.akhir,'%d %b %Y') as akhir, b.namapaket, a.lokal, a.domestik, a.internasional 
			FROM " . PAKET_PROMO . " a INNER JOIN " . PAKET . " b ON a.id_paket=b.id 
			WHERE b.status='no' AND ? < akhir";
		$query = $this->db->query($sql, $now);
		return $query->result_array();
	}

	public function insertPromo($data)
	{
		if ($this->db->insert(PAKET_PROMO, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}
}
