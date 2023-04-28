<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreModel extends CI_Model{
    private $store = 'store';

	public function Liststore(){
        $storeid=@$_SESSION["logged_status"]["storeid"];
	    $sql="SELECT * FROM ".$this->store." WHERE status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getStore($storeid){
	    $sql="SELECT * FROM ".$this->store." WHERE status='0' AND storeid=?";
	    $query=$this->db->query($sql,$storeid);
		if ($query){
			return $query->result();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string($this->store,$data)." ON DUPLICATE KEY UPDATE alamat=?, keterangan=?, kontak=?, status=0";
		if ($this->db->query($sql,array($data["alamat"],$data["keterangan"],$data["kontak"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$storeid){
		$this->db->where("storeid",$storeid);
		if ($this->db->update($this->store,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$storeid){
		$this->db->where("storeid",$storeid);
		if ($this->db->update($this->store,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>