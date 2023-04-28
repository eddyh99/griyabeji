<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model{
    private $brand              = 'brand';
    private $harga				= 'harga';
    private $produksize			= 'produksize';
	private $penjualan			= 'penjualan';
	private $penjualan_detail	= 'penjualan_detail';
	private $penyesuaian		= 'penyesuaian';
	private $pindah				= 'pindah';
	private $pindah_detail		= 'pindah_detail';
	private $produk				= 'produk';
	private $store				= 'store';
	private $kas				= 'kas';

	public function getmutasi($bulan,$tahun,$storeid,$brand,$kategori){
	    $awal=$tahun."-".$bulan."-01";
	    $akhir=date("Y-m-t",strtotime($awal));
        
/*    	$sql="SELECT a.barcode,a.namaproduk,a.namabrand, ifnull(sum(x.total),0) as stok
    			FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
    			LEFT JOIN (
    			  SELECT barcode, sum(jumlah)*-1 as total, storeid FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total, storeid FROM ".$this->penyesuaian." WHERE approved='1' AND tanggal<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah)*-1 as total,dari as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',dari,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total,tujuan as storeid FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',tujuan,'All')='".$storeid."' GROUP BY barcode
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total, storeid FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, storeid FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
                ) x ON a.barcode=x.barcode
                WHERE a.status='0'
                AND IF ('".$brand."'!='All',namabrand,'All')='".$brand."'
    			GROUP BY a.barcode";*/

    	$sql="SELECT b.barcode,a.namaproduk,a.namabrand, ifnull(sum(x.total),0) as stok,b.size
    			FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
    			LEFT JOIN (
    			  SELECT barcode, sum(jumlah)*-1 as total, storeid,size FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total, storeid,size FROM ".$this->penyesuaian." WHERE approved='1' AND tanggal<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah)*-1 as total,dari as storeid,size FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',dari,'All')='".$storeid."' GROUP BY barcode
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total,tujuan as storeid,size FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',tujuan,'All')='".$storeid."' GROUP BY barcode
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total, storeid,size FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, storeid,size FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode
                ) x ON b.barcode=x.barcode AND b.size=x.size
                WHERE a.status='0' AND IF ('".$kategori."'!='All',namakategori,'All')='".$kategori."'
                AND IF ('".$brand."'!='All',namabrand,'All')='".$brand."'
    			GROUP BY b.barcode";
    			
		$query=$this->db->query($sql);
		$stokawal=$query->result_array();
        

        $sql2="SELECT x.barcode, sum(x.total) as total FROM
                (

                SELECT barcode, sum(jumlah) as total FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',dari,'All')='".$storeid."' GROUP BY barcode
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode 
                ) x GROUP BY x.barcode";
        $query2=$this->db->query($sql2);
        $keluar=$query2->result_array();

        $sql3="SELECT x.barcode, sum(x.total) as total FROM(

                SELECT barcode, sum(jumlah) as total FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',tujuan,'All')='".$storeid."'  GROUP BY barcode
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode

             ) x GROUP BY x.barcode";
             
        $query3=$this->db->query($sql3);
        $masuk=$query3->result_array();
        
        $sql4="SELECT barcode, sum(jumlah) as total, storeid FROM ".$this->penyesuaian." WHERE approved='1' AND (tanggal BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode";
        $query4=$this->db->query($sql4);
        $sesuai=$query4->result_array();

        $sql5="SELECT barcode, sum(jumlah) as total FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode";
        $query5=$this->db->query($sql5);
        $penjualan=$query5->result_array();

        $mdata=array();
        foreach($stokawal as $dt){
            $temp["namaproduk"]=$dt["namaproduk"];
            $temp["namabrand"]=$dt["namabrand"];

            $sqlharga="SELECT a.harga, a.diskon, a.barcode FROM harga a INNER JOIN (SELECT MAX(tanggal) as tanggal,barcode FROM harga GROUP BY barcode) x ON a.barcode=x.barcode AND a.tanggal=x.tanggal WHERE a.barcode='".$dt["barcode"]."'";
            $qharga=$this->db->query($sqlharga)->row()->harga;
            $temp["harga"]=$qharga;

            $temp["awal"]=$dt["stok"];
            
            $temp["jual"]=0;
            foreach($penjualan as $jl){
                if ($dt["barcode"]==$jl["barcode"]){
                    $temp["jual"]=$jl["total"];
                }
            }
            
            $temp["keluar"]=0;
            foreach($keluar as $klr){
                if ($dt["barcode"]==$klr["barcode"]){
                    $temp["keluar"]=$klr["total"];
                }
            }

            $temp["masuk"]=0;
            foreach($masuk as $msk){
                if ($dt["barcode"]==$msk["barcode"]){
                    $temp["masuk"]=$msk["total"];
                }
            }

            $temp["sesuai"]=0;
            foreach($sesuai as $suai){
                if ($dt["barcode"]==$suai["barcode"]){
                    $temp["sesuai"]=$suai["total"];
                }
            }
            
            $temp["sisa"]=$temp["awal"]+$temp["masuk"]-$temp["keluar"]-$temp["jual"]+$temp["sesuai"];
            array_push($mdata,$temp);
        }
        return $mdata;
	}

	public function getmutasidetail($bulan,$tahun,$storeid,$brand,$kategori){
	    $awal=$tahun."-".$bulan."-01";
	    $akhir=date("Y-m-t",strtotime($awal));
        
    	$sql="SELECT b.barcode,a.namaproduk,a.namabrand, ifnull(sum(x.total),0) as stok,b.size
    			FROM ".$this->produk." a INNER JOIN ".$this->produksize." b ON a.barcode=b.barcode
    			LEFT JOIN (
    			  SELECT barcode, sum(jumlah)*-1 as total, storeid,size FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total, storeid,size FROM ".$this->penyesuaian." WHERE approved='1' AND tanggal<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size
    			  UNION ALL
    			  SELECT barcode, sum(jumlah)*-1 as total,dari as storeid,size FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',dari,'All')='".$storeid."' GROUP BY barcode,size
    			  UNION ALL
    			  SELECT barcode, sum(jumlah) as total,tujuan as storeid,size FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',tujuan,'All')='".$storeid."' GROUP BY barcode,size
                  UNION ALL
                  SELECT barcode, sum(jumlah) as total, storeid,size FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size
                  UNION ALL
                  SELECT barcode, sum(jumlah)*-1 as total, storeid,size FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND DATE(tanggal)<'".$awal."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size
                ) x ON b.barcode=x.barcode AND b.size=x.size
                WHERE a.status='0' AND IF ('".$kategori."'!='All',namakategori,'All')='".$kategori."'
                AND IF ('".$brand."'!='All',namabrand,'All')='".$brand."'
    			GROUP BY b.barcode, b.size";
		$query=$this->db->query($sql);
		$stokawal=$query->result_array();

        $sql2="SELECT x.barcode, sum(x.total) as total,size FROM
                (

                SELECT barcode, sum(jumlah) as total,size FROM ".$this->pindah." e INNER JOIN ".$this->pindah_detail." f ON e.mutasi_id=f.mutasi_id WHERE e.approved='1' AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',dari,'All')='".$storeid."' GROUP BY barcode,size
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total,size FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id WHERE (ISNULL(kembali) OR status='tidak') AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size
                ) x GROUP BY x.barcode, x.size";
        $query2=$this->db->query($sql2);
        $keluar=$query2->result_array();

        $sql3="SELECT x.barcode, sum(x.total) as total,size FROM(

                SELECT barcode, sum(jumlah) as total,size FROM pindah e INNER JOIN pindah_detail f ON e.mutasi_id=f.mutasi_id  WHERE e.approved='1' AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',tujuan,'All')='".$storeid."'  GROUP BY barcode,size
                
                UNION ALL
                
                SELECT barcode, sum(jumlah) as total,size FROM retur a INNER JOIN retur_detail b ON a.id=b.id WHERE (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size

             ) x GROUP BY x.barcode,size";
             
        $query3=$this->db->query($sql3);
        $masuk=$query3->result_array();
        
        $sql4="SELECT barcode, sum(jumlah) as total, storeid,size FROM ".$this->penyesuaian." WHERE approved='1' AND (tanggal BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size";
        $query4=$this->db->query($sql4);
        $sesuai=$query4->result_array();

        $sql5="SELECT barcode, sum(jumlah) as total,size FROM ".$this->penjualan." c INNER JOIN  ".$this->penjualan_detail." d ON c.id=d.id WHERE (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' GROUP BY barcode,size";
        $query5=$this->db->query($sql5);
        $penjualan=$query5->result_array();

        $mdata=array();
        foreach($stokawal as $dt){
            $temp["namaproduk"]=$dt["namaproduk"];
            $temp["namabrand"]=$dt["namabrand"];
            $temp["awal"]=$dt["stok"];
            $temp["size"]=$dt["size"];

            $temp["keluar"]=0;
            foreach($keluar as $klr){
                if (($dt["barcode"]==$klr["barcode"]) && ($dt["size"]==$klr["size"])){
                    $temp["keluar"]=$klr["total"];
                }
            }

            $temp["jual"]=0;
            foreach($penjualan as $jl){
                if (($dt["barcode"]==$jl["barcode"]) && ($dt["size"]==$jl["size"])){
                    $temp["jual"]=$jl["total"];
                }
            }

            $temp["masuk"]=0;
            foreach($masuk as $msk){
                if (($dt["barcode"]==$msk["barcode"]) && ($dt["size"]==$msk["size"])){
                    $temp["masuk"]=$msk["total"];
                }
            }

            $temp["sesuai"]=0;
            foreach($sesuai as $suai){
                if (($dt["barcode"]==$suai["barcode"]) && ($dt["size"]==$suai["size"])){
                    $temp["sesuai"]=$suai["total"];
                }
            }
            
            $temp["sisa"]=$temp["awal"]+$temp["masuk"]-$temp["keluar"]-$temp["jual"]+$temp["sesuai"];
            array_push($mdata,$temp);
        }
        return $mdata;
	}
	
	public function getpenjualan($awal,$akhir,$storeid){
	    $sql="SELECT a.*,c.nama as kasir,d.nama as member FROM penjualan a 
	        INNER JOIN pengguna c ON a.userid=c.username 
	        LEFT JOIN member d ON a.member_id=d.member_id 
	        WHERE DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."'
	        AND a.id NOT IN (SELECT jual_id FROM retur)
	        ";
	    $query=$this->db->query($sql);
	    $penjualan= $query->result_array();

	    $mdata=array();
        foreach ($penjualan as $dt){
            $temp["id"]=$dt["id"];
            $temp["nonota"]=$dt["nonota"];
            $temp["tanggal"]=$dt["tanggal"];
            $temp["member"]=$dt["member"];
            $temp["kasir"]=$dt["kasir"];
            $temp["method"]=$dt["method"];
            
            $dsql="SELECT * FROM penjualan_detail WHERE id=?";
            $detail=$this->db->query($dsql,$dt["id"])->result_array();
            
            $temp["diskonn"]=0;
            $temp["diskonp"]=0;
            $temp["total"]=0;
            foreach ($detail as $det){
                $temp["diskonn"]=$temp["diskonn"]+$det["diskonn"];
                $temp["diskonp"]=$temp["diskonp"]+$det["diskonp"];
                
                $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
                $harga=$this->db->query($sql,array($dt["tanggal"],$det["barcode"]))->row()->harga;
                
                $temp["total"]=$temp["total"]+($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            }
            
            array_push($mdata,$temp);
        }
        
        return $mdata;
	}
    
    public function getbarang($awal,$akhir,$storeid,$jenis){
        if ($jenis=="keluar"){
            $sql="SELECT a.mutasi_id,a.tanggal, b.barcode, b.size, b.jumlah, c.namaproduk, store 
                FROM pindah a INNER JOIN pindah_detail b ON a.mutasi_id=b.mutasi_id
                INNER JOIN produk c ON b.barcode=c.barcode
                INNER JOIN store d ON a.tujuan=d.storeid
                WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND '".$akhir."'
                AND dari='".$storeid."' AND a.approved='1'
                
                UNION ALL
                
                SELECT a.id as mutasi_id,a.tanggal,b.barcode, b.size, b.jumlah, c.namaproduk , a.keterangan as store
                FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id 
                INNER JOIN produk c ON b.barcode=c.barcode
                INNER JOIN store d ON a.storeid=d.storeid
                WHERE (ISNULL(b.kembali) OR b.status='tidak') AND (DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."') 
                AND a.storeid='".$storeid."'
                ";
        }else{
            $sql="SELECT a.mutasi_id,a.tanggal, b.barcode, b.size, b.jumlah, c.namaproduk, store 
                FROM pindah a INNER JOIN pindah_detail b ON a.mutasi_id=b.mutasi_id
                INNER JOIN produk c ON b.barcode=c.barcode
                INNER JOIN store d ON a.dari=d.storeid
                WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND '".$akhir."'
                AND tujuan='".$storeid."' AND a.approved='1'";
        }
        $moving=$this->db->query($sql)->result_array();


        return $moving;
    }
    
    public function getnontunai($awal,$akhir,$storeid){
	    $sql="SELECT * FROM ".$this->penjualan." WHERE DATE(tanggal) BETWEEN '".$awal."' AND '".$akhir."' AND storeid='".$storeid."' AND method!='cash'";
	    $query=$this->db->query($sql);
	    $penjualan=$query->result_array();

	    $mdata=array();
        foreach ($penjualan as $dt){
            $temp["id"]=$dt["id"];
            $temp["nonota"]=$dt["nonota"];
            $temp["tanggal"]=$dt["tanggal"];
            $temp["method"]=$dt["method"];
            $temp["persen"]=$dt["fee"];
            
            $dsql="SELECT * FROM penjualan_detail WHERE id=?";
            $detail=$this->db->query($dsql,$dt["id"])->result_array();
            
            $temp["total"]=0;
            foreach ($detail as $det){
                $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
                $harga=$this->db->query($sql,array($dt["tanggal"],$det["barcode"]))->row()->harga;
                
                $temp["total"]=$temp["total"]+($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            }
            
            $temp["fee"]=$dt["fee"]/100*$temp["total"];
            $temp["grandttl"]=$temp["total"]+$temp["fee"];
            array_push($mdata,$temp);
        }
        
        return $mdata;

    }
    
    public function detailpenjualan($id){
        $dsql="SELECT a.nonota,a.tanggal, b.*,c.namaproduk,c.namabrand FROM penjualan a INNER JOIN penjualan_detail b ON a.id=b.id INNER JOIN produk c ON b.barcode=c.barcode WHERE a.id=?";
        $detail=$this->db->query($dsql,$id)->result_array();
        
        $mdata=array();
        foreach ($detail as $det){
            $temp["nonota"]     = $det["nonota"];
            $temp["barcode"]    = $det["barcode"];
            $temp["namaproduk"] = $det["namaproduk"];
            $temp["namabrand"]  = $det["namabrand"];
            $temp["size"]       = $det["size"];
            $temp["jumlah"]     = $det["jumlah"];
            $temp["diskonn"]    = $det["diskonn"];
            $temp["diskonp"]    = $det["diskonp"];
            $temp["alasan"]     = $det["alasan"];
            
            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($det["tanggal"],$det["barcode"]))->row()->harga;
            
            $temp["harga"]      = $harga;
            $temp["total"]      = ($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            array_push($mdata,$temp);
        }
        return $mdata;
    }

    public function getbrand($awal,$akhir,$storeid,$brand, $kategori){
        $dsql="SELECT a.nonota, a.tanggal, b.*,c.namaproduk,c.namabrand 
        FROM penjualan a INNER JOIN penjualan_detail b ON a.id=b.id 
        INNER JOIN produk c ON b.barcode=c.barcode 
        WHERE a.id NOT IN (SELECT jual_id FROM retur) AND DATE(a.tanggal) BETWEEN '".$awal."' AND  '".$akhir."' AND IF ('".$brand."'!='All',c.namabrand,'All')='".$brand."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."' AND IF ('".$kategori."'!='All',c.namakategori,'All')='".$kategori."'";
        $detail=$this->db->query($dsql)->result_array();

        $mdata=array();
        foreach ($detail as $det){
            $temp["nonota"]     = $det["nonota"];
            $temp["tanggal"]    = $det["tanggal"];
            $temp["barcode"]    = $det["barcode"];
            $temp["namaproduk"] = $det["namaproduk"];
            $temp["namabrand"]  = $det["namabrand"];
            $temp["size"]       = $det["size"];
            $temp["jumlah"]     = $det["jumlah"];

            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($det["tanggal"],$det["barcode"]))->row()->harga;
            
            $temp["harga"]      = $harga;
            $temp["total"]      = ($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            array_push($mdata,$temp);
        }
        return $mdata;
    }

    public function getrequest($awal,$akhir,$storeid,$jenis){
        if ($jenis=="keluar"){
            $sql="SELECT a.mutasi_id,a.tanggal, b.barcode, b.size, b.jumlah, c.namaproduk, store, IF(a.approved=1,'Diterima', IF (a.approved=2, 'Batal', IF (a.approved=3,'Dikirim','Belum Dikirim'))) as status 
                FROM pindah a INNER JOIN pindah_detail b ON a.mutasi_id=b.mutasi_id
                INNER JOIN produk c ON b.barcode=c.barcode
                INNER JOIN store d ON a.tujuan=d.storeid
                WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND '".$akhir."'
                AND dari='".$storeid."'
                ";
        }else{
            $sql="SELECT a.mutasi_id,a.tanggal, b.barcode, b.size, b.jumlah, c.namaproduk, store, IF(a.approved=1,'Diterima', IF (a.approved=2, 'Batal', IF (a.approved=3,'Dikirim','Belum Dikirim'))) as status 
                FROM pindah a INNER JOIN pindah_detail b ON a.mutasi_id=b.mutasi_id
                INNER JOIN produk c ON b.barcode=c.barcode
                INNER JOIN store d ON a.dari=d.storeid
                WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND '".$akhir."'
                AND tujuan='".$storeid."' AND a.approved='1'";
        }
        $moving=$this->db->query($sql)->result_array();


        return $moving;
    }

    public function getretur($awal,$akhir,$storeid){
        $dsql="SELECT a.id, a.tanggal, d.tanggal as tgljual, a.jual_id, b.*,c.namaproduk,c.namabrand 
        FROM retur a INNER JOIN retur_detail b ON a.id=b.id 
        INNER JOIN produk c ON b.barcode=c.barcode 
        INNER JOIN penjualan d ON a.jual_id=d.id
        WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND  '".$akhir."' AND IF ('".$storeid."'!='All',a.storeid,'All')='".$storeid."'";
        $detail=$this->db->query($dsql)->result_array();

        $mdata=array();
        foreach ($detail as $det){
            $temp["id"]         = $det["id"];
            $temp["tanggal"]    = $det["tanggal"];
            $temp["jual_id"]    = $det["jual_id"];
            $temp["namaproduk"] = $det["namaproduk"];
            $temp["namabrand"]  = $det["namabrand"];
            $temp["jumlah"]     = $det["jumlah"];

            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($det["tgljual"],$det["barcode"]))->row()->harga;
            
            $temp["harga"]      = $harga;
            $temp["total"]      = ($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            array_push($mdata,$temp);
        }
        return $mdata;
    }
    
    public function getstokout($awal,$akhir,$storeid){
        $dsql="SELECT a.*, b.size,b.jumlah,IF ((ISNULL(b.kembali) AND b.status='kembali'),'Sedang Dipinjam',IF (b.status='tidak','Tidak Kembali',b.kembali)) as status, c.namaproduk,c.namabrand 
        FROM pinjam a INNER JOIN pinjam_detail b ON a.id=b.id 
        INNER JOIN produk c ON b.barcode=c.barcode 
        WHERE DATE(a.tanggal) BETWEEN '".$awal."' AND  '".$akhir."' AND IF ('".$storeid."'!='All',storeid,'All')='".$storeid."'";
        $detail=$this->db->query($dsql)->result_array();
        
        return $detail;
    }
    
    public function getkaskeluar($awal,$akhir,$storeid){
        $sql="SELECT a.*,b.store FROM ".$this->kas." a 
            INNER JOIN ".$this->store." b ON a.storeid=b.storeid 
            WHERE IF ('".$storeid."'!='All',a.storeid,'All')='".$storeid."' AND (DATE(a.tanggal) BETWEEN '".$awal."' AND '".$akhir."') AND (a.jenis='Keluar' OR a.jenis='Masuk')";
        return $this->db->query($sql, array($storeid,$awal,$akhir))->result_array();
        
    }

}
?>