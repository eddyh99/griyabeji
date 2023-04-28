<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukModel extends CI_Model{
    private $produk = 'produk';
    private $harga	= 'harga';

	public function Listproduk(){
		$sql="SELECT * FROM ".$this->produk." WHERE status='0'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getProduk($barcode){
		$sql="SELECT a.*,x.harga,x.diskon FROM produk a INNER JOIN ( SELECT a.harga, a.diskon, a.barcode FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) x ON a.barcode=x.barcode WHERE a.barcode=?";
		$query=$this->db->query($sql,$barcode);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
	}

    public function allposts_count()
    {
        $sql="SELECT * FROM ".$this->produk."";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }


    public function allposts($limit,$start,$col,$dir){
        $sql="SELECT a.*,x.harga,x.diskon FROM produk a INNER JOIN ( SELECT a.harga, a.barcode,a.diskon FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) x ON a.barcode=x.barcode ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search($limit,$start,$search,$col,$dir){
        $sql="SELECT a.*,x.harga,x.diskon FROM produk a INNER JOIN ( SELECT a.harga, a.barcode,a.diskon FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) x ON a.barcode=x.barcode WHERE  (a.barcode like '%".$search."%' OR namaproduk like '%".$search."%' OR namabrand like '%".$search."%' OR namakategori like '%".$search."%' OR harga like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search_count($search){
        $sql="SELECT a.*,x.harga,x.diskon FROM produk a INNER JOIN ( SELECT a.harga, a.barcode,a.diskon FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) x ON a.barcode=x.barcode WHERE  (a.barcode like '%".$search."%' OR namaproduk like '%".$search."%' OR namabrand like '%".$search."%' OR namakategori like '%".$search."%' OR harga like '%".$search."%')";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }

	public function insertData($data){
		$produk=array(
			'barcode'		=> $data["barcode"],
			'namaproduk'	=> $data["namaproduk"],
			'namabrand'		=> $data["namabrand"],
			'namakategori'	=> $data["namakategori"],
			'userid'		=> $data["userid"]
		);

		$price=array(
			'barcode' => $data["barcode"],
			'tanggal' => date("Y-m-d H:i:s"),
			'harga'	  => $data["harga"],
			'userid'  => $data["userid"]
		);
		
		$this->db->trans_start(); 
		
		//insert ke tabel produk
		$this->db->insert($this->produk,$produk);

		//insert ke tabel harga
		$this->db->insert($this->harga, $price);

		$this->db->trans_complete();
        
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
            return array("code"=>511, "message"=>"Data sudah pernah digunakan");
		} 
		else {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
		}
	}

	public function insertbatchData($data){
    	$this->db->trans_start(); 
	    
	    foreach ($data as $dt){
    		$produk=array(
    			'barcode'		=> $dt["barcode"],
    			'namaproduk'	=> $dt["namaproduk"],
    			'namabrand'		=> $dt["namabrand"],
    			'namakategori'	=> $dt["namakategori"],
    			'userid'		=> $dt["userid"]
    		);
    
    		$price=array(
    			'barcode' => $dt["barcode"],
    			'tanggal' => date("Y-m-d H:i:s"),
    			'harga'	  => $dt["harga"],
    			'diskon'  => $dt["diskon"],
    			'userid'  => $dt["userid"]
    		);
    		
    		
	    	//insert ke tabel produk
    		$this->db->insert($this->produk,$produk);
    // 		//insert ke tabel produk
    // 		$sql=$this->db->insert_string($this->produk,$produk)." ON DUPLICATE KEY UPDATE namaproduk=?, namabrand=?, namakategori=?";
    // 		$query=$this->db->query($sql,array($produk["namaproduk"],$produk["namabrand"],$produk["namakategori"]));
    		
    		//insert ke tabel harga
    		$this->db->insert($this->harga, $price);
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

	public function setData($data,$barcode){
		$produk=array(
			'namaproduk'	=> $data["namaproduk"],
			'namabrand'		=> $data["namabrand"],
			'namakategori'	=> $data["namakategori"],
			'userid'		=> $data["userid"]
		);
		$this->db->where("barcode",$barcode);
		$this->db->update($this->produk,$produk);
		
		//cek last harga
		$lastharga=$this->getProduk($barcode);

		if (($data["harga"]!=$lastharga->harga) || ($data["diskon"]!=$lastharga->diskon)){
			$price=array(
				'barcode' => $barcode,
				'tanggal' => date("Y-m-d H:i:s"),
				'harga'	  => $data["harga"],
				'diskon'  => $data["diskon"],
				'userid'  => $data["userid"]
			);
			//insert ke tabel harga
			$this->db->insert($this->harga, $price);
		}

        return array("code"=>0, "message"=>"");
	}

	public function hapusData($data,$barcode){
		$this->db->where("barcode",$barcode);
		if ($this->db->update($this->produk,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}


}
?>