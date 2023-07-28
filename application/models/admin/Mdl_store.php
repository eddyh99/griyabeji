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

	public function insert_transaksi($transaksi,$barang){
		//$this->db->trans_start(); 
		
		//insert ke tabel penjualan
		$query	= $this->db->insert("store_transaksi",$transaksi);
		$id		= $this->db->insert_id();
		
		$detail	= array();
		foreach ($barang as $dt){
			$temp["id_transaksi"]	= $id;
			$temp["id_produk"]		= $dt[0];
			$temp["jumlah"]		= $dt[2];
			array_push($detail,$temp);
		}
		$query=$this->db->insert_batch("store_transaksi_detail",$detail);
		return $this->db->error();
		die;

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
			return TRUE;
		}
	}

	public function get_penjualan($storeid){
		$sql="SELECT * FROM store_transaksi WHERE storeid=?";
		return $this->db->query($sql,$storeid)->result_array();
	}
}
?>