<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_pengayah extends CI_Model
{
	public function Listpengayah()
	{
		$sql = "SELECT id, nama,whatsapp,tipe FROM " . PENGAYAH . " WHERE status='no'";
		$query = $this->db->query($sql);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getUser($id)
	{
		$sql = "SELECT id, nama,whatsapp,tipe FROM " . PENGAYAH . " WHERE id=? AND status='no'";
		$query = $this->db->query($sql, $id);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data, $datapengguna)
	{
		// if ($this->db->insert(PENGAYAH, $data)){
		//     return array("code"=>0, "message"=>"");
		// }else{
		//     return $this->db->error();
		// }

		$this->db->trans_start();

			$this->db->insert(PENGGUNA, $datapengguna);
			//insert ke tabel Pengayah
			$this->db->insert(PENGAYAH, $data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array("code"=>511, "message"=>"Data gagal disimpan, periksa ulang");
		} else {
			$this->db->trans_commit();
			return array("code" => 0, "message" => "");
		}
	}

	public function updateData($data, $id)
	{
		$this->db->where("id", $id);
		if ($this->db->update(PENGAYAH, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	public function hapusData($data, $id)
	{
		$this->db->where("id", $id);
		if ($this->db->update(PENGAYAH, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}
}
