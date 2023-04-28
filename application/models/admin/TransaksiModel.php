<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiModel extends CI_Model{
    private $penjualan          = 'penjualan';
    private $penjualan_detail   = 'penjualan_detail';
    private $harga              = 'harga';
    private $produk             = 'produk';
    

	public function listtransaksi($tanggal,$storeid){
		$sql    =   "SELECT y.nonota,y.tanggal,y.member_id,y.method, SUM((x.harga*a.jumlah)-a.diskonn-a.diskonp) as total 
        		      FROM ".$this->penjualan_detail." a INNER JOIN (
        		            SELECT barcode, harga,max(tanggal) 
        		            FROM ".$this->harga." WHERE tanggal<=(
        		                SELECT tanggal 
        		                FROM ".$this->penjualan." WHERE DATE(tanggal)=? 
        		            )
        		            GROUP BY barcode
        		      ) x ON a.barcode=x.barcode 
        		      INNER JOIN penjualan y ON a.id=y.id 
        		      WHERE y.storeid=? AND DATE(y.tanggal)=?
        		      GROUP BY a.id";
		      
		$query  =   $this->db->query($sql,array($tanggal,$storeid,$tanggal));
		return $query->result_array();
	}
    
    public function detailtransaksi($nonota,$tanggal){
        $sql    =   "SELECT b.*,c.namaproduk, x.harga, ((x.harga*b.jumlah)-b.diskonn-b.diskonp) as total FROM ".$this->penjualan." a 
                    INNER JOIN ".$this->penjualan_detail." b ON a.id=b.id
                    INNER JOIN ".$this->produk." c ON b.barcode=c.barcode
                    INNER JOIN (
                        SELECT barcode, harga, max(tanggal)
                        FROM ".$this->harga." WHERE tanggal<='".$tanggal."'
                        GROUP BY barcode
                    ) x ON b.barcode=x.barcode
                    WHERE a.nonota='".$nonota."'";
        $query  =   $this->db->query($sql);
        return $query->result_array();
    }
    
    public function changepayment($nonota,$bayar){
        $sql    =   "UPDATE ".$this->penjualan." SET method=? WHERE nonota=?";
        $query  =   $this->db->query($sql,array($bayar,$nonota));
    }
}
?>