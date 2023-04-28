<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokModel extends CI_Model{
    private $harga				= 'harga';
    private $produksize			= 'produksize';
	private $penjualan			= 'penjualan';
	private $penjualan_detail	= 'penjualan_detail';
	private $penyesuaian		= 'penyesuaian';
	private $pindah				= 'pindah';
	private $pindah_detail		= 'pindah_detail';
	private $produk				= 'produk';
	private $store				= 'store';


	public function getProduk($barcode){
		$sql="SELECT a.*,x.harga FROM ".$this->produk." a INNER JOIN (SELECT harga, barcode, max(tanggal) FROM ".$this->harga." GROUP BY barcode) x ON a.barcode=x.barcode WHERE a.barcode=?";
		$query=$this->db->query($sql,$barcode);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
	}


    public function listproduk_withstok(){
        $storeid=$_SESSION["logged_status"]["storeid"];
    	$sql="SELECT a.barcode,a.namaproduk, a.namabrand,ifnull(sum(x.total),0) as stok
    			FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
    			LEFT JOIN (
                    SELECT barcode, sum(jumlah)*-1 as total, storeid FROM penjualan c INNER JOIN  penjualan_detail d ON c.id=d.id WHERE storeid='".$storeid."' GROUP BY barcode
                    
                    UNION ALL
                    
                    SELECT barcode, sum(jumlah) as total, storeid FROM penyesuaian WHERE approved='1' AND storeid='".$storeid."' GROUP BY barcode
                    
                    UNION ALL

                    SELECT barcode, sum(jumlah)*-1 as total,dari as storeid FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND dari='".$storeid."' GROUP BY barcode

    			    UNION ALL
                    
                    SELECT barcode, sum(jumlah) as total,tujuan as storeid FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND tujuan='".$storeid."' GROUP BY barcode
                    
                    UNION ALL

                    SELECT barcode, sum(jumlah) as total, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE storeid='".$storeid."' GROUP BY barcode

                    UNION ALL
                    
                    SELECT barcode, sum(jumlah)*-1 as total, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND storeid='".$storeid."' GROUP BY barcode
                ) x  ON a.barcode=x.barcode
    			GROUP BY a.barcode";
		$query=$this->db->query($sql,$storeid);
        $hasil=$query->result_array();
        $mdata=array();
        foreach ($hasil as $dt){
            if ($dt["stok"]>0){
                $temp["barcode"]=$dt["barcode"];
                $temp["namaproduk"]=$dt["namaproduk"];
                $temp["namabrand"]=$dt["namabrand"];
                $temp["stok"]=$dt["stok"];
                array_push($mdata,$temp);
            }
        }
        return $mdata;
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
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' GROUP BY barcode, size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id GROUP BY barcode,size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') GROUP BY barcode,size, storeid ) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				WHERE x.storeid IS NOT NULL GROUP BY a.barcode, x.size,x.storeid";
		$query=$this->db->query($sql);
        return $query->num_rows();
    }
 
    public function allposts($limit,$start,$col,$dir){
        $sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store,z.harga
			    FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' GROUP BY barcode, size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id GROUP BY barcode,size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') GROUP BY barcode,size, storeid 
                ) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
                INNER JOIN (SELECT a.harga, a.barcode FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) z ON a.barcode=z.barcode
				WHERE x.storeid IS NOT NULL GROUP BY a.barcode, x.size,x.storeid ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search($limit,$start,$search,$col,$dir){
        $sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store,z.harga
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' GROUP BY barcode, size, storeid
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' GROUP BY barcode, size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id GROUP BY barcode,size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') GROUP BY barcode,size, storeid ) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
                INNER JOIN (SELECT a.harga, a.barcode FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal) z ON a.barcode=z.barcode
				WHERE x.storeid IS NOT NULL AND (a.barcode like '%".$search."%' OR a.namaproduk like '%".$search."%' OR y.store like '%".$search."%') GROUP BY a.barcode, x.size,x.storeid ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
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
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' GROUP BY barcode, size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id GROUP BY barcode,size, storeid
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') GROUP BY barcode,size, storeid ) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				WHERE x.storeid IS NOT NULL  AND (a.barcode like '%".$search."%' OR a.namaproduk like '%".$search."%' OR y.store like '%".$search."%') GROUP BY a.barcode, x.size,x.storeid";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }
	
	public function getStok($barcode,$size){
		$sql="SELECT a.barcode,x.size,ifnull(sum(x.total),0) as stok FROM ".$this->produk." a LEFT JOIN (
				SELECT barcode, sum(jumlah)*-1 as total,size FROM ".$this->penjualan_detail." GROUP BY barcode,size UNION ALL
				SELECT barcode, sum(jumlah) as total, size FROM ".$this->penyesuaian." WHERE approved='1' GROUP BY barcode,size) x ON a.barcode=x.barcode WHERE a.barcode=? AND x.size=? GROUP BY a.barcode, x.size";
		$query=$this->db->query($sql,array($barcode,$size));
		return $query->row();
	}

	public function insertbatchData($data){	
		//insert ke tabel penyesuaian
		if ($this->db->insert_batch($this->penyesuaian, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}

	}


	public function insertData($data){	
		//insert ke tabel penyesuaian
		if ($this->db->insert($this->penyesuaian, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}

	}
}
?>