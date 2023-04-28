<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpnameModel extends CI_Model{
	private $penjualan			= 'penjualan';
	private $penjualan_detail	= 'penjualan_detail';
	private $penyesuaian		= 'penyesuaian';
	private $pindah				= 'pindah';
	private $pindah_detail		= 'pindah_detail';
	private $produk				= 'produk';
	private $produksize			= 'produksize';
	private $store				= 'store';
    
    public function getStok($barcode,$storeid,$size){
        //penjualan
        $where[0]=$barcode;
        $where[1]=$size;
        $where[2]=$storeid;

        //penyesuaian
        $where[3]=$barcode;
        $where[4]=$size;
        $where[5]=$storeid;

        //retur
        $where[6]=$barcode;
        $where[7]=$size;
        $where[8]=$storeid;

        //pindah keluar
        $where[9]=$barcode;
        $where[10]=$size;
        $where[11]=$storeid;

        //pindah masuk
        $where[12]=$barcode;
        $where[13]=$size;
        $where[14]=$storeid;

        //pinjam
        $where[15]=$barcode;
        $where[16]=$size;
        $where[17]=$storeid;

        $sql="SELECT ifnull(sum(x.total),0) as stok 
                FROM ( 
                
                SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM penjualan c INNER JOIN penjualan_detail d ON c.id=d.id WHERE barcode=? AND size=? AND storeid=?
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total, size, storeid FROM penyesuaian WHERE approved='1' AND barcode=? AND size=? AND storeid=?
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE barcode=? AND size=? AND storeid=?
                
                UNION ALL
                
                SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND barcode=? AND size=? AND dari =?
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND barcode=? AND size=? AND tujuan = ?
                
                UNION ALL
                
                SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak')  AND barcode=? AND size=? AND storeid =?
                ) x";
        return $this->db->query($sql,$where)->row()->stok;
    }
    
	public function insertData($data){
		//insert ke tabel penyesuaian
		$query	= $this->db->insert($this->penyesuaian,$data);
		if (!$query){
		    return $this->db->error();
		}
	}
	
	public function listopname($storeid){
		$sql="SELECT a.barcode,a.namaproduk, a.namabrand,b.size,ifnull(sum(x.total),0) as stok,y.store
				FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
				LEFT JOIN (
				  SELECT barcode, sum(jumlah)*-1 as total,size, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE storeid='".$storeid."' GROUP BY barcode,size
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='1' AND storeid='".$storeid."' GROUP BY barcode,size
				  UNION ALL
				  SELECT barcode, sum(jumlah)*-1 as total, size,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND  dari='".$storeid."' GROUP BY barcode, size
				  UNION ALL
				  SELECT barcode, sum(jumlah) as total, size,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND tujuan='".$storeid."' GROUP BY barcode, size
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total,size, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE storeid='".$storeid."' GROUP BY barcode,size
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, size, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND storeid='".$storeid."' GROUP BY barcode,size ) x ON a.barcode=x.barcode AND b.size=x.size 
				INNER JOIN ".$this->store." y ON x.storeid=y.storeid
				GROUP BY a.barcode, x.size";
				
		
		$query=$this->db->query($sql)->result_array();

		$sbaru="SELECT barcode, sum(jumlah) as total, size, storeid FROM ".$this->penyesuaian." WHERE approved='0' AND storeid=? GROUP BY barcode,size, storeid";
        $qbaru=$this->db->query($sbaru,$storeid)->result_array();

        $mdata=array();
        foreach ($query as $dt){
            $temp["barcode"]    = $dt["barcode"];
            $temp["produk"]     = $dt["namaproduk"];
            $temp["size"]       = $dt["size"];
            $temp["old"]        = $dt["stok"];
            $temp["baru"]       = $dt["stok"];
            for ($i=0;$i<count($qbaru);$i++){
                if (($dt["barcode"]==$qbaru[$i]["barcode"]) && ($dt["size"]==$qbaru[$i]["size"])){
                    $temp["baru"]=$dt["stok"]+$qbaru[$i]["total"];
                }
            }
            
            array_push($mdata,$temp);
        }
        return $mdata;
        
	}
	
	public function setapprove($storeid){
	    $sql="UPDATE ".$this->penyesuaian." SET approved='1' WHERE storeid=?";
	    $query=$this->db->query($sql,$storeid);
	}
}
?>