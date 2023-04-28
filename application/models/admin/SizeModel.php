<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SizeModel extends CI_Model{
    private $size = 'size';

	public function Listsize(){
		$sql="SELECT nama FROM ".$this->size." WHERE status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getSize($size){
	    $sql="SELECT nama FROM ".$this->size." WHERE status='0' AND nama=?";
	    $query=$this->db->query($sql,$size);
		if ($query){
			return $query->result();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string($this->size,$data)." ON DUPLICATE KEY UPDATE status='0',nama=?";
		if ($this->db->query($sql,array($data["nama"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$oldsize){
		$this->db->where("nama",$oldsize);
		if ($this->db->update($this->size,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$size){
		$this->db->where("nama",$size);
		if ($this->db->update($this->size,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>