<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_store extends CI_Model{
	public function Liststore(){		
		$sql="SELECT id, storename as namastore FROM ".STORE." WHERE status='no'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getstore($id){
	    $sql="SELECT id, storename as namastore FROM " . STORE . " WHERE id=? AND status='no'";
	    $query=$this->db->query($sql,$id);
		if ($query){
			return (array)$query->row();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
        if ($this->db->insert(STORE, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$id){
		$this->db->where("id",$id);
		if ($this->db->update(STORE,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$id){
		$this->db->where("id",$id);
        if ($this->db->update(STORE,$data)){
		    return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>