<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_pengayah extends CI_Model
{
	public function Listpengayah()
	{
		$sql = "SELECT id,username, nama,whatsapp FROM " . PENGAYAH . " WHERE status='no'";
		$query = $this->db->query($sql);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getUser($username)
	{
		$sql = "SELECT id, nama,whatsapp FROM " . PENGAYAH . " WHERE id=? AND status='no'";
		$query = $this->db->query($sql, $username);
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

		$pengguna = $this->db->insert_string(PENGGUNA, $datapengguna) . " ON DUPLICATE KEY UPDATE passwd=?, nama=?, role=?,passcode=?, status='0'";
		if ($this->db->query($pengguna, array($datapengguna["passwd"], $datapengguna["nama"], $datapengguna["role"], $datapengguna["passcode"]))) {
			//insert ke tabel Pengayah
			$this->db->insert(PENGAYAH, $data);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return array("code" => 511, "message" => $this->db->error());
			} else {
				$this->db->trans_commit();
				return array("code" => 0, "message" => "");
			}
		} else {
			$this->db->trans_complete();
			$this->db->trans_rollback();
			return array("code" => 511, "message" => $this->db->error());
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
