<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PinjamModel extends CI_Model{
    private $pinjam     = 'pinjam';
    private $detpinjam  = 'pinjam_detail';
    private $harga	    = 'harga';
    private $produk     = 'produk';

	public function __construct() {
	    parent::__construct();
	    $this->load->model("admin/opnameModel");
    }

	public function Listnota($storeid){
		$sql="SELECT a.* FROM ".$this->pinjam." a INNER JOIN ".$this->detpinjam." b ON a.id=b.id WHERE ISNULL(b.kembali) AND status='kembali' AND a.storeid=?";
		$query=$this->db->query($sql,$storeid);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getDetail($key){
	    $sql="SELECT b.namaproduk, b.namabrand, a.* FROM ".$this->detpinjam." a INNER JOIN ".$this->produk." b ON a.barcode=b.barcode WHERE a.id=? AND ISNULL(a.kembali) AND a.status='kembali'";
	    $barang=$this->db->query($sql,$key)->result_array();
	    return $barang;
	}


	public function insertData($data,$barang){
		$this->db->trans_start(); 
		
		//insert ke tabel penjualan
		$query	= $this->db->insert($this->pinjam,$data);
		$id		= $this->db->insert_id();
		
		foreach ($barang as $dt){
			$temp["id"]	        = $id;
			$temp["barcode"]	= $dt[0];
			$temp["size"]		= strtoupper($dt[2]);
			$stok=$this->opnameModel->getStok($dt[0],$data["storeid"],strtoupper($dt[2]));
			if (($stok-$dt[3])<0){
    			$temp["jumlah"]		= $stok;
			}else{
    			$temp["jumlah"]		= $dt[3];
			}
			
			$query=$this->db->insert($this->detpinjam,$temp);
		}

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
	
	public function setTutup($id){
	    $sql="UPDATE ".$this->detpinjam." SET status='tidak' WHERE id=?";
	    $query=$this->db->query($sql,$id);
	}

	public function setKembali($id,$barang){
		$this->db->trans_start(); 
        $now=array("kembali"=>date("Y-m-d H:i:s"));
	    foreach ($barang as $dt){
	        $this->db->where(array("id"=>$id,"barcode"=>$dt[0]));
	        $this->db->update($this->detpinjam,$now);
	    }
		$this->db->trans_complete();
	}

}
?>