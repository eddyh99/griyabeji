<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_kas extends CI_Model{
	public function Listkas(){		
        $now=date("Y-m-d");

        $sql="SELECT a.id, tanggal, nominal, keterangan, storename as store FROM ".KAS." a INNER JOIN ".STORE." b ON a.store_id=b.id WHERE DATE(tanggal)=?";
		$query=$this->db->query($sql,$now);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}
	
	public function insertData($data){
        if ($this->db->insert(KAS, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}
}
?>