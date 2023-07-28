<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_pengguna extends CI_Model
{
	public function Listpengguna()
	{
		$sql = "SELECT username,nama,role FROM " . PENGGUNA . " WHERE status='no' AND role!='admin'";
		$query = $this->db->query($sql);
		if ($query) {
			return $query->result_array();
		} else {
			return $this->db->error();
		}
	}

	public function getUser($username)
	{
		$sql = "SELECT username,nama, role,passcode FROM " . PENGGUNA . " WHERE status='no' AND username=?";
		$query = $this->db->query($sql, $username);
		if ($query) {
			return (array)$query->row();
		} else {
			return $this->db->error();
		}
	}

	public function insertData($data, $datapengayah = NULL)
	{
		if ($data["role"] == 'pengayah') {
			$this->db->trans_start();

			$pengguna = $this->db->insert_string(PENGGUNA, $data) . " ON DUPLICATE KEY UPDATE passwd=?, nama=?, role=?,passcode=?, status='0'";
			if ($this->db->query($pengguna, array($data["passwd"], $data["nama"], $data["role"], $data["passcode"]))) {
				//insert ke tabel Pengayah
				$this->db->insert(PENGAYAH, $datapengayah);
				// return $datapengayah;

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
		} else {
			$sql = $this->db->insert_string(PENGGUNA, $data) . " ON DUPLICATE KEY UPDATE passwd=?, nama=?, role=?,passcode=?, status='0'";
			if ($this->db->query($sql, array($data["passwd"], $data["nama"], $data["role"], $data["passcode"]))) {
				return array("code" => 0, "message" => "");
			} else {
				return $this->db->error();
			}
		}
	}

	public function updateData($data, $username)
	{
		$this->db->where("username", $username);
		if ($this->db->update(PENGGUNA, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	public function hapusData($data, $username)
	{
		$this->db->where("username", $username);
		if ($this->db->update(PENGGUNA, $data)) {
			return array("code" => 0, "message" => "");
		} else {
			return $this->db->error();
		}
	}

	public function check_passcode($passcode)
	{
		$sql = "SELECT * FROM " . PENGGUNA . " WHERE passcode=? AND (role='admin' OR role='EAM') AND status='no'";
		$query = $this->db->query($sql, $passcode);
		if ($query->num_rows() > 0) {
			return array("code" => 0);
		} else {
			return array("code" => 5111);
		}
	}

	public function getNonAdmin(){
		$sql="SELECT username,nama,role FROM " . PENGGUNA . " WHERE status='no' AND role='kasir' AND username NOT IN (SELECT username FROM ".ASSIGNSTORE." WHERE status=0)";
	    $query=$this->db->query($sql);
		if ($query){
			return (array)$query->result_array();
		}else{
            return $this->db->error();
		}
	}
}
