<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduksizeModel extends CI_Model{
    private $produksize = 'produksize';
    private $size = 'size';
    private $produk = 'produk';

	public function ListSize(){
		$sql="SELECT a.barcode, a.size, b.namaproduk, b.namabrand FROM ".$this->produksize." a INNER JOIN ".$this->produk." b ON a.barcode=b.barcode WHERE a.status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function insertbatchData($data){
		if ($this->db->insert_batch($this->produksize,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function insertData($data){
	    $sql=$this->db->insert_string($this->produksize,$data)." ON DUPLICATE KEY UPDATE status='0'";
		if ($this->db->query($sql)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$where){
		$this->db->where($where);
		if ($this->db->update($this->produksize,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}


}
?>