<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandModel extends CI_Model{
    private $brand = 'brand';

	public function Listbrand(){
		$sql="SELECT namabrand,keterangan FROM ".$this->brand." WHERE status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getBrand($brand){
	    $sql="SELECT namabrand,keterangan FROM ".$this->brand." WHERE status='0' AND namabrand=?";
	    $query=$this->db->query($sql,$brand);
		if ($query){
			return $query->result();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string($this->brand,$data)." ON DUPLICATE KEY UPDATE status='0',namabrand=?";
		if ($this->db->query($sql,array($data["namabrand"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$oldbrand){
		$this->db->where("namabrand",$oldbrand);
		if ($this->db->update($this->brand,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$brand){
		$this->db->where("namabrand",$brand);
		if ($this->db->update($this->brand,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>