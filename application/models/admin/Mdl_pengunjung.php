<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_pengunjung extends CI_Model{
	public function Listpengunjung(){		
		$sql="SELECT id, nama, ig, whatsapp, email, b.state_name as statename, c.name as countryname 
        FROM ".PENGUNJUNG." a 
        INNER JOIN tbl_state b ON a.state_id=b.state_code AND a.country_code=b.country_code 
        INNER JOIN tbl_country c ON b.country_code=c.code
        WHERE status='no'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function getCountry(){
        $sql="SELECT * FROM tbl_country";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function getState($state_code){
        $sql="SELECT * FROM tbl_state WHERE country_code=?";
        $query=$this->db->query($sql,$state_code);
        return $query->result_array();
    }

	public function getPengunjung($id){
	    $sql="SELECT id, nama, ig, whatsapp, email, a.country_code as code, state_id as state_code, b.state_name as statename, c.name as countryname 
        FROM ".PENGUNJUNG." a 
        INNER JOIN tbl_state b ON a.state_id=b.state_code AND a.country_code=b.country_code 
        INNER JOIN tbl_country c ON b.country_code=c.code WHERE id=? AND status='no'";
	    $query=$this->db->query($sql,$id);
		if ($query){
			return (array)$query->row();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
        if ($this->db->insert(PENGUNJUNG, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$id){
		$this->db->where("id",$id);
		if ($this->db->update(PENGUNJUNG,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$id){
		$this->db->where("id",$id);
        if ($this->db->update(PENGUNJUNG,$data)){
		    return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>