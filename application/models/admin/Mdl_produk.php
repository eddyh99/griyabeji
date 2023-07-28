<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_produk extends CI_Model
{
	public function Listproduk()
	{
		$sql = "SELECT id,id_produk, namaproduk, x.lokal,x.domestik, x.internasional 
		FROM " . PRODUK . " a INNER JOIN 
		( 
			SELECT a.lokal, a.internasional, a.domestik, a.id_produk 
			FROM " . PRODUK_HARGA . " a INNER JOIN 
			(
				SELECT MAX(tanggal) as tanggal,id_produk 
				FROM " . PRODUK_HARGA . " GROUP BY id_produk
			) x 
			ON a.id_produk=x.id_produk AND a.tanggal=x.tanggal
		) x ON a.id=x.id_produk
		WHERE a.status='no'
		";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function ListProdukByReservasi($id)
	{
		$sql = "
		SELECT
			a.id_produk,
			b.namaproduk,
			a.lokal,
			a.domestik,
			a.internasional
		FROM
			produk_harga a
		INNER JOIN produk b ON a.id_produk = b.id
		JOIN(
			SELECT MAX(tanggal) AS max_date
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
		WHERE b.status='no';
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function itemproduk($id)
	{
		$sql2 = "SELECT id_items, namaitem
        FROM " . PRODUK_DETAIL . " a INNER JOIN " . ITEMS . " b ON a.id_items=b.id 
        WHERE id_produk=?";
		$query2 = $this->db->query($sql2, $id);
		return $query2->result_array();
	}

	public function getProduk($id)
	{
		$sql = "
		SELECT 
		id, 
		namaproduk, 
		x.is_double, 
		x.lokal,
		x.domestik,
		x.internasional,
		x.komisi_guide_domestik, 
		x.komisi_guide_internasional, 
		x.komisi_pengayah_domestik, 
		x.komisi_pengayah_internasional
		FROM " . PRODUK . " a 
		INNER JOIN (
			SELECT 
			a.is_double, 
			a.lokal, 
			a.internasional, 
			a.domestik, 
			a.id_produk,
			a.komisi_guide_domestik, 
			a.komisi_guide_internasional, 
			a.komisi_pengayah_domestik, 
			a.komisi_pengayah_internasional
			FROM " . PRODUK_HARGA . " a 
			INNER JOIN (
				SELECT 
				MAX(tanggal) as tanggal,
				id_produk
				FROM " . PRODUK_HARGA . " 
				GROUP BY id_produk
			) x ON a.id_produk=x.id_produk AND a.tanggal=x.tanggal
		) x ON a.id=x.id_produk
		WHERE a.status='no' AND id=?
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data, $harga, $items)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->insert(PRODUK, $data);
		$id = $this->db->insert_id();

		$harga["id_produk"] = $id;

		//insert ke tabel harga
		$this->db->insert(PRODUK_HARGA, $harga);

		$detail = array();
		if (count($items)>0){
			foreach ($items as $dt) {
				$temp["id_produk"]  = $id;
				$temp["id_items"]   = $dt;
				array_push($detail, $temp);
			}

			$this->db->insert_batch(PRODUK_DETAIL, $detail);
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

	public function updateData($data, $harga, $items, $id)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->where("id", $id);
		$this->db->update(PRODUK, $data);

		$this->db->where("id_produk", $id);
		$this->db->delete(PRODUK_DETAIL);

		//insert ke tabel harga
		$this->db->insert(PRODUK_HARGA, $harga);

		$detail = array();
		if (count($items)>0){
			foreach ($items as $dt) {
				$temp["id_produk"]  = $id;
				$temp["id_items"]   = $dt;
				array_push($detail, $temp);
			}

			$this->db->insert_batch(PRODUK_DETAIL, $detail);
		}
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
		if ($this->db->update(PRODUK, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	/********* Promotional produk *******/
	public function promoproduk()
	{
		$now = date("Y-m-d");
		$sql = "SELECT DATE_FORMAT(a.awal,'%d %b %Y') as awal,DATE_FORMAT(a.akhir,'%d %b %Y') as akhir, b.namaproduk, a.lokal, a.domestik, a.internasional 
			FROM " . PRODUK_PROMO . " a INNER JOIN " . PRODUK . " b ON a.id_produk=b.id 
			WHERE b.status='no' AND ? < akhir";
		$query = $this->db->query($sql, $now);
		return $query->result_array();
	}

	public function insertPromo($data)
	{
		if ($this->db->insert(PRODUK_PROMO, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}
}
