<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierModel extends CI_Model{
    private $produksize			= 'produksize';
	private $penjualan			= 'penjualan';
	private $penjualan_detail	= 'penjualan_detail';
	private $penyesuaian		= 'penyesuaian';
	private $pindah				= 'pindah';
	private $pindah_detail		= 'pindah_detail';
	private $produk				= 'produk';
	private $store				= 'store';
    private $pengguna			= 'pengguna';

	public function readitem($barcode){
		$sql="SELECT size FROM ".$this->produksize." WHERE barcode=?";
		$query=$this->db->query($sql,$barcode);
		return $query->result();
		
	}

	public function getLastnota(){
		$sql="SELECT RIGHT(RIGHT(nonota,5)+100001,5) as last FROM ".$this->penjualan." ORDER BY id DESC";
		$query=$this->db->query($sql);
		if ($query->num_rows()==0){
			$nonota='00001';
		}else{
			$nonota=$query->row()->last;
		}
		return $nonota;
	}

    public function allposts_count()
    {
		$sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL 
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid

				) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				WHERE x.storeid IS NOT NULL GROUP BY a.barcode, x.size,x.storeid";
		$query=$this->db->query($sql);
        return $query->num_rows();
    }
 
    public function allposts($limit,$start,$col,$dir){
        $sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL 
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid

				) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				CROSS JOIN (SELECT @cnt := 0) AS dummy WHERE x.storeid IS NOT NULL GROUP BY a.barcode, x.size,x.storeid ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search($limit,$start,$search,$col,$dir){
        $sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL 
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid

				) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				CROSS JOIN (SELECT @cnt := 0) AS dummy WHERE x.storeid IS NOT NULL AND (a.barcode like '%".$search."%' OR a.namaproduk like '%".$search."%' OR y.store like '%".$search."%') GROUP BY a.barcode, x.size,x.storeid ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search_count($search){
        $sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL 
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid

				) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				CROSS JOIN (SELECT @cnt := 0) AS dummy WHERE x.storeid IS NOT NULL AND (a.barcode like '%".$search."%' OR a.namaproduk like '%".$search."%' OR y.store like '%".$search."%') GROUP BY a.barcode, x.size,x.storeid";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }


	public function insertData($jual,$barang){
	    $this->load->model("admin/opnameModel");
        if ($_SESSION["identify"]==$_SESSION["nota_komplit"]){
            return 611;
        }else{
    
    		$this->db->trans_start(); 
    		
    		//insert ke tabel penjualan
    		$query=$this->db->insert($this->penjualan,$jual);
    		$id=$this->db->insert_id();
    		
    		//break transaction how???
    		$detail=array();
    		foreach ($barang as $dt){
    			$temp["id"]=$id;
    			$temp["barcode"]=$dt[0];
    			$temp["size"]=strtoupper($dt[2]);
    			$sisa=$this->opnameModel->getStok($dt[0],$_SESSION["logged_status"]["storeid"],strtoupper($dt[2]));
    			if ($sisa-$dt[3]<0){
    			    $temp["jumlah"]=$sisa;
    			}elseif ($sisa-$dt[3]>=0){
    			    $temp["jumlah"]=$dt[3];
    			}elseif ($sisa==0){
    			    return "511";
    			    break;
    			}
    			$temp["diskonn"]=$dt[5];
    			$temp["diskonp"]=$dt[6];
    			$temp["alasan"]=$dt[8];
    			array_push($detail,$temp);
    		}
    		//insert ke tabel detail penjualan
    		$this->db->insert_batch($this->penjualan_detail,$detail);
    
    		$this->db->trans_complete();
    		$_SESSION["nota_komplit"]=$_SESSION["identify"];
    		return $id;
    		
        }
	}
	
	public function getallnota($id){
	    $sql="SELECT a.*,b.nama FROM ".$this->penjualan." a INNER JOIN ".$this->pengguna." b ON a.userid=b.username WHERE a.id=?";
	    $mdata["header"]=$this->db->query($sql,$id)->row();

	    $sql="SELECT a.*,b.namaproduk FROM ".$this->penjualan_detail." a INNER JOIN ".$this->produk." b ON a.barcode=b.barcode WHERE a.id=?";
	    $detail=$this->db->query($sql,$id)->result_array();
        
        $i=0;
        foreach ($detail as $detjual){
            $mdata["detail"][$i]["barcode"]     = $detjual["barcode"];
            $mdata["detail"][$i]["namaproduk"]  = $detjual["namaproduk"];
            $mdata["detail"][$i]["jumlah"]      = $detjual["jumlah"];
            $mdata["detail"][$i]["size"]        = $detjual["size"];
            $mdata["detail"][$i]["diskonn"]     = $detjual["diskonn"];
            $mdata["detail"][$i]["diskonp"]     = $detjual["diskonp"];
        
            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($mdata["header"]->tanggal,$detjual["barcode"]))->row()->harga;
            $mdata["detail"][$i]["harga"]       = $harga;
            $i++;
        }
	    
	    return $mdata;
	    
	    
	}
}
?>