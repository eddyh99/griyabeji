<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_laundry extends CI_Model
{
	public function ListData()
	{
		$sql = "SELECT * FROM `laundry` WHERE is_deleted = 'no'";
		$query = $this->db->query($sql);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getDataByid($id)
	{
		$sql = "SELECT * FROM `laundry` WHERE id = ?";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function getDataListItems($id)
	{
		$sql = "
		SELECT a.laundry_id, a.items_id, b.namaitem, a.jml 
		FROM `laundry_detail` a
		INNER JOIN items b ON a.items_id = b.id
		WHERE a.laundry_id = ?;
		";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($master, $data)
	{
		$this->db->trans_start();

		//insert ke tabel Laundry
		$this->db->insert("laundry", $master);
		$id = $this->db->insert_id();

		$items = array();
		foreach ($data as $dt) {
			$temp["laundry_id"]	= $id;
			$temp["items_id"] = $dt->id_items;
			$temp["jml"] = $dt->jumlah;
			array_push($items, $temp);
		}
		$this->db->insert_batch("laundry_detail", $items);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code" => 511, "message" => "Data tidak dapat disimpan, periksa ulang");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function updateData($data, $id)
	{
		$this->db->where("id", $id);
		if ($this->db->update('laundry', $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}
}
