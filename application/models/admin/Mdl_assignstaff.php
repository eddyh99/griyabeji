<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_assignstaff extends CI_Model{
	public function ListStaff(){
		$sql="SELECT a.username,b.nama, c.storename, a.storeid FROM ".ASSIGNSTORE." a INNER JOIN ".PENGGUNA." b ON a.username=b.username INNER JOIN ".STORE." c ON a.storeid=c.id WHERE a.status='0' AND (b.role<>'Admin')";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getStoreID($username){
		$sql="SELECT * FROM ".ASSIGNSTORE." WHERE status='0' AND username=?";
		$query=$this->db->query($sql,$username);
		return $query->row();
	}

	public function insertData($data){
	    $sql=$this->db->insert_string(ASSIGNSTORE,$data)." ON DUPLICATE KEY UPDATE status='0'";
		if ($this->db->query($sql)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$where){
		$this->db->where($where);
		if ($this->db->update(ASSIGNSTORE,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}


}
?>