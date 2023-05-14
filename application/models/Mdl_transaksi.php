<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_transaksi extends CI_Model{
	private function unik_produk($array, $uniqueKey){
		$unique = array();
	   
		foreach ($array as $value){
			$unique[$value->$uniqueKey] = $value;
		}
	   
		$data = array_values($unique);
	   
		return $data;
	}

	public function add_data($mtrans,$data){
		$this->db->trans_start(); 
		
		//insert ke tabel produk
		$this->db->insert("penjualan",$mtrans);
		$id=$this->db->insert_id();

		$unikproduk=$this->unik_produk($data,'id_barang');
		foreach ($unikproduk as $produk){
			$temp["id_transaksi"]	= $id;
			$temp["jenis"]			= $produk->jenis;
			$temp["id_produk"]		= $produk->id_barang;

			$this->db->insert("penjualan_detail",$temp);
			$id_detail=$this->db->insert_id();

			$pengunjung=array();
			foreach ($data as $dt){				
				if ($temp["id_produk"]==$dt->id_barang){
					$temp2["id_detail"]		= $id_detail;
					$temp2["id_pengunjung"] = $dt->id_pengunjung;
					$temp2["jml"]			= $dt->jumlah;
					array_push($pengunjung,$temp2);
				}
			}

			$this->db->insert_batch("penjualan_pengunjung",$pengunjung);
		}

		$this->db->trans_complete();
        
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
            return array("code"=>511, "message"=>"Data tidak dapat disimpan, periksa ulang");
		} 
		else {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
		}
	}	
}
?>