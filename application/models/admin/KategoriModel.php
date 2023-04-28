<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model{
    private $kategori = 'kategori';

	public function Listkategori(){
		$sql="SELECT namakategori FROM ".$this->kategori." WHERE status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getKategori($kategori){
	    $sql="SELECT namakategori FROM ".$this->kategori." WHERE status='0' AND namakategori=?";
	    $query=$this->db->query($sql,$kategori);
		if ($query){
			return $query->result();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string($this->kategori,$data)." ON DUPLICATE KEY UPDATE status='0',namakategori=?";
		if ($this->db->query($sql,array($data["namakategori"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$oldkategori){
		$this->db->where("namakategori",$oldkategori);
		if ($this->db->update($this->kategori,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$kategori){
		$this->db->where("namakategori",$kategori);
		if ($this->db->update($this->kategori,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>