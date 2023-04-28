<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReturModel extends CI_Model{
    private $penjualan  = "penjualan";
    private $detjual    = "penjualan_detail";
    private $tblretur   = "retur";
    private $detretur   = "retur_detail";
    private $produk     = "produk";
    private $member     = "member";
    
	public function listnota(){
	    $now    = date("Y-m-d");
	    $awal   = date('Y-m-d', strtotime('-30 days'));
        $storeid  = $_SESSION["logged_status"]["storeid"];
        
	    $sql="SELECT a.*,sum(b.diskonn+b.diskonp)*-1 as total,c.nama,IF(ISNULL(d.jual_id),1,0) as jual_id 
	        FROM ".$this->penjualan." a 
	        INNER JOIN ".$this->detjual." b ON a.id=b.id 
	        LEFT JOIN ".$this->member." c ON a.member_id=c.member_id 
	        LEFT JOIN ".$this->tblretur." d ON a.id=d.jual_id
	        WHERE DATE(a.tanggal) BETWEEN ? AND ? AND a.storeid=? GROUP BY id";
	    $query=$this->db->query($sql,array($awal,$now,$storeid));
	    $penjualan=$query->result_array();

	    $mdata=array();
	    $i=0;
        foreach ($penjualan as $dt){
            $mdata[$i]=$dt;
            
            $det="SELECT * FROM ".$this->detjual." WHERE id=?";
            $detail=$this->db->query($det,$dt["id"])->result_array();
            
            foreach ($detail as $detjual){
                $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
                $harga=$this->db->query($sql,array($dt["tanggal"],$detjual["barcode"]))->row()->harga;
                $mdata[$i]["total"]=$mdata[$i]["total"]+($detjual["jumlah"]*$harga);
            }
            $i++;
        }
        
        return $mdata;

	}
	
	public function detailnota($key=""){
	    $storeid  = $_SESSION["logged_status"]["storeid"];
	    $sql="SELECT * FROM ".$this->penjualan." WHERE id=? AND storeid=?";
	    return $this->db->query($sql,array($key,$storeid))->row();
	}
	
	public function ganti_bayar($id,$mdata){
	    $this->db->where("id",$id);
	    $this->db->update($this->penjualan,$mdata);
	    return;
	}
	
	public function getDetail($key){
	    $sql="SELECT c.namaproduk, c.namabrand, a.tanggal, b.* FROM ".$this->penjualan." a INNER JOIN ".$this->detjual." b ON a.id=b.id INNER JOIN ".$this->produk." c ON b.barcode=c.barcode WHERE a.id=?";
	    $barang=$this->db->query($sql,$key)->result_array();
        
        $mdata=array();
	    foreach ($barang as $dt){
	        $temp["barcode"]=$dt["barcode"];
	        $temp["namaproduk"]=$dt["namaproduk"];
	        $temp["namabrand"]=$dt["namabrand"];
	        $temp["size"]=$dt["size"];
	        $temp["jumlah"]=$dt["jumlah"];
	        
            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($dt["tanggal"],$dt["barcode"]))->row()->harga;
	        $temp["harga"]=$harga-$dt["diskonn"]-$dt["diskonp"];
            $temp["total"]=($dt["jumlah"]*$temp["harga"]);
            
            array_push($mdata,$temp);
	    }
	    
	    return $mdata;
	}
	
	public function lastsaldo(){
	    $today=date("Y-m-d");
	    $storeid=1;//$_SESSION["logged_status"]["storeid"];
        
        $mdata["saldo"]=0;
	    //cek saldo akhir hari sebelumnya
	    $sql="SELECT nominal FROM kas WHERE storeid=? AND keterangan='Sisa Kas' ORDER BY tanggal DESC";
	    $query=$this->db->query($sql,$storeid);
	    if ($query->num_rows()>0){
    	    $mdata["saldo"]= $query->row()->nominal;
	    }
	        
        //ambil seluruh transaksi hari ini
        $sjual="SELECT a.tanggal, a.method, b.barcode, b.jumlah, b.diskonn, b.diskonp 
                FROM penjualan a INNER JOIN penjualan_detail b ON a.id=b.id WHERE date(tanggal)=? AND a.storeid=?";
        $qjual=$this->db->query($sjual,array($today,$storeid));
        $penjualan=$qjual->result_array();
        
	    //cek total penjualan
        
	    $mdata["jual"]=0;
	    $mdata["tunai"]=0;
        foreach ($penjualan as $dt){
            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($dt["tanggal"],$dt["barcode"]))->row()->harga;
            $mdata["jual"]=$mdata["jual"]+($dt["jumlah"]*$harga)-$dt["diskonn"]-$dt["diskonp"];
            if ($dt["method"]=='cash'){
                $mdata['tunai']=$mdata['tunai']+($dt["jumlah"]*$harga)-$dt["diskonn"]-$dt["diskonp"];
            }
        }
        

        //tarik keluar masuk
        $sql="SELECT * FROM kas WHERE storeid=? AND date(tanggal)=?";
        $qkas=$this->db->query($sql,array($storeid, $today));
        $mdata["kas"]=$qkas->result_array();

        return $mdata;
	}
	
	public function setSisa($data){
	    $today=date("Y-m-d");
	    $sql="SELECT * FROM kas WHERE dateonly=? AND storeid=? AND jenis='Kas Sisa'";
	    $query=$this->db->query($sql,array($today,$data["storeid"]));
	    if ($query->num_rows()>0){
	        return array("code"=>5051);
	    }else{
	        $this->db->insert($this->kas,$data);
	        return array("code"=>0);
	    }
	}

	public function insertData($jual,$barang,$retur, $barangretur){

		$this->db->trans_start(); 
	    
	    $retur=$this->db->insert($this->tblretur,$retur);
	    $returid=$this->db->insert_id();
        
		$detailretur=array();
		foreach ($barangretur as $dt){
			$temp["id"]=$returid;
			$temp["barcode"]=$dt[0];
			$temp["size"]=$dt[1];
			$temp["jumlah"]=$dt[2];
			array_push($detailretur,$temp);
		}
		

		//insert ke tabel detail retur
		$this->db->insert_batch($this->detretur,$detailretur);
	    
		//insert ke tabel penjualan
		$query=$this->db->insert($this->penjualan,$jual);
		$id=$this->db->insert_id();
		
		//break transaction how???
		$detail=array();
		foreach ($barang as $dt){
			$temp["id"]=$id;
			$temp["barcode"]=$dt[0];
			$temp["size"]=$dt[2];
			$temp["jumlah"]=$dt[3];
			$temp["diskonn"]=$dt[5];
			$temp["diskonp"]=$dt[6];
			$temp["alasan"]=$dt[8];
			array_push($detail,$temp);
		}
		//insert ke tabel detail penjualan
		$this->db->insert_batch($this->detjual,$detail);

		$this->db->trans_complete();
		if ($this->db->trans_status() === 10) {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}

	}    
	
	public function bataldata($id,$retur){
		$this->db->trans_start(); 

	    $this->db->insert($this->tblretur,$retur);
	    $returid=$this->db->insert_id();

	    $sql    = "SELECT * FROM ".$this->detjual." WHERE id=?";
	    $barangretur = $this->db->query($sql,$id)->result_array();

		$detailretur=array();
		foreach ($barangretur as $dt){
			$temp["id"]=$returid;
			$temp["barcode"]=$dt["barcode"];
			$temp["size"]=$dt["size"];
			$temp["jumlah"]=$dt["jumlah"];
			array_push($detailretur,$temp);
		}
		//insert ke tabel detail retur
		$this->db->insert_batch($this->detretur,$detailretur);

		$this->db->trans_complete();

		if ($this->db->trans_status() === 10) {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}
	}
}
?>