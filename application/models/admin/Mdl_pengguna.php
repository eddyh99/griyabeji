<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_pengguna extends CI_Model{
	public function Listpengguna(){		
		$sql="SELECT username,nama,role FROM ".PENGGUNA." WHERE status='no' AND role!='admin'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getUser($username){
	    $sql="SELECT username,nama, role FROM " . PENGGUNA . " WHERE status='no' AND username=?";
	    $query=$this->db->query($sql,$username);
		if ($query){
			return (array)$query->row();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string(PENGGUNA, $data)." ON DUPLICATE KEY UPDATE passwd=?, nama=?, role=?, status='0'";
		if ($this->db->query($sql,array($data["passwd"],$data["nama"],$data["role"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$username){
		$this->db->where("username",$username);
		if ($this->db->update(PENGGUNA,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$username){
		$this->db->where("username",$username);
        if ($this->db->update(PENGGUNA,$data)){
		    return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>