<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggunaModel extends CI_Model{
    private $pengguna = 'pengguna';
    private $assignstore = 'assignstore';

	public function Listpengguna(){
		$sql="SELECT username,nama,role FROM ".$this->pengguna." WHERE status='0' AND role!='admin'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getNonAdmin(){
		$sql="SELECT username,nama,role FROM ".$this->pengguna." 
		WHERE status='0' and (role!='Admin' and role!='Owner') 
		AND username NOT IN (select username FROM ".$this->assignstore." WHERE status='0')";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getUser($username){
	    $sql="SELECT username,nama, role FROM ".$this->pengguna." WHERE status='0' AND username=?";
	    $query=$this->db->query($sql,$username);
		if ($query){
			return $query->result();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
	    $sql=$this->db->insert_string($this->pengguna, $data)." ON DUPLICATE KEY UPDATE passwd=?, nama=?, role=?, status='0'";
		if ($this->db->query($sql,array($data["passwd"],$data["nama"],$data["role"]))){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$username){
		$this->db->where("username",$username);
		if ($this->db->update($this->pengguna,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$username){
	    $this->db->trans_start();

		$this->db->where("username",$username);
        $this->db->update($this->pengguna,$data);

		$this->db->where("username",$username);
        $this->db->update($this->assignstore,$data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->error();
        }else{
		    return array("code"=>0, "message"=>"");
		}
	}

}
?>