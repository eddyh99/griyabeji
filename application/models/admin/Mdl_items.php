<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_items extends CI_Model
{
	public function Listitems()
	{
		$sql = "SELECT id, namaitem,x.hpp, x.lokal,x.domestik, x.internasional 
		FROM " . ITEMS . " a INNER JOIN 
		( 
			SELECT a.lokal, a.internasional, a.domestik, a.hpp, a.id_items 
			FROM " . ITEMS_HARGA . " a INNER JOIN 
			(
				SELECT MAX(tanggal) as tanggal,id_items 
				FROM " . ITEMS_HARGA . " GROUP BY id_items
			) x 
			ON a.id_items=x.id_items AND a.tanggal=x.tanggal
		) x ON a.id=x.id_items
		WHERE a.status='no'
		";
		$query = $this->db->query($sql);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getItems($id)
	{
		$sql = "
		SELECT 
		id, 
		namaitem,
		x.hpp, 
		x.lokal,
		x.domestik, 
		x.internasional,
		x.komisi_guide_domestik, 
		x.komisi_guide_internasional, 
		x.komisi_pengayah_domestik, 
		x.komisi_pengayah_internasional
		FROM " . ITEMS . " a 
		INNER JOIN ( 
			SELECT 
			a.lokal, 
			a.internasional, 
			a.domestik, 
			a.hpp, 
			a.id_items, 
			a.komisi_guide_domestik, 
			a.komisi_guide_internasional, 
			a.komisi_pengayah_domestik, 
			a.komisi_pengayah_internasional
			FROM " . ITEMS_HARGA . " a 
			INNER JOIN (
				SELECT 
				MAX(tanggal) as tanggal,id_items 
				FROM " . ITEMS_HARGA . " GROUP BY id_items
			) x ON a.id_items=x.id_items AND a.tanggal=x.tanggal
		) x ON a.id=x.id_items
		WHERE a.status='no' AND id=?
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data, $harga)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->insert(ITEMS, $data);
		$id = $this->db->insert_id();

		$harga["id_items"] = $id;

		//insert ke tabel harga
		$this->db->insert(ITEMS_HARGA, $harga);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data sudah pernah digunakan");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function updateData($data, $harga, $id)
	{
		$this->db->trans_start();

		//insert ke tabel produk
		$this->db->where("id", $id);
		$this->db->update(ITEMS, $data);
		//insert ke tabel harga
		$this->db->insert(ITEMS_HARGA, $harga);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data sudah pernah digunakan");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function hapusData($data, $id)
	{
		$this->db->where("id", $id);
		if ($this->db->update(ITEMS, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	/********* Promotional Items *******/
	public function promoitems()
	{
		$now = date("Y-m-d");
		$sql = "SELECT DATE_FORMAT(a.awal,'%d %b %Y') as awal,DATE_FORMAT(a.akhir,'%d %b %Y') as akhir, b.namaitem, a.lokal, a.domestik, a.internasional 
			FROM " . ITEMS_PROMO . " a INNER JOIN " . ITEMS . " b ON a.id_items=b.id 
			WHERE b.status='no' AND ? < akhir";
		$query = $this->db->query($sql, $now);
		return $query->result_array();
	}

	public function insertPromo($data)
	{
		if ($this->db->insert(ITEMS_PROMO, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}
}
