<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_guide extends CI_Model{
	public function Listguide(){		
		$sql="SELECT id, nama,whatsapp FROM ".GUIDE." WHERE status='no'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getUser($username){
	    $sql="SELECT id, nama,whatsapp FROM " . GUIDE . " WHERE id=? AND status='no'";
	    $query=$this->db->query($sql,$username);
		if ($query){
			return (array)$query->row();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
        if ($this->db->insert(GUIDE, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$id){
		$this->db->where("id",$id);
		if ($this->db->update(GUIDE,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$id){
		$this->db->where("id",$id);
        if ($this->db->update(GUIDE,$data)){
		    return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>