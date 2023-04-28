<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignModel extends CI_Model{
    private $pengguna = 'pengguna';
    private $store = 'store';
    private $assignstore = 'assignstore';

	public function ListStaff(){
		$sql="SELECT a.username,b.nama, c.store, c.alamat,a.storeid FROM ".$this->assignstore." a INNER JOIN ".$this->pengguna." b ON a.username=b.username INNER JOIN ".$this->store." c ON a.storeid=c.storeid WHERE a.status='0' AND (b.role<>'Admin')";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getStoreID($username){
		$sql="SELECT a.*,b.store FROM ".$this->assignstore." a INNER JOIN ".$this->store." b ON a.storeid=b.storeid WHERE a.status='0' AND username=?";
		$query=$this->db->query($sql,$username);
		return $query->row();
	}

	public function insertData($data){
	    $sql=$this->db->insert_string($this->assignstore,$data)." ON DUPLICATE KEY UPDATE status='0'";
		if ($this->db->query($sql)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$where){
		$this->db->where($where);
		if ($this->db->update($this->assignstore,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}


}
?>