<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KasModel extends CI_Model{
    private $kas = "kas";
    
	public function insertData($data){
		if ($this->db->insert($this->kas,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}
	
	public function listkas(){
	    $now=date("Y-m-d");
	    $sql="SELECT * FROM ".$this->kas." WHERE DATE(tanggal)=?";
	    $query=$this->db->query($sql,$now);
	    return $query->result_array();
	}
}
?>