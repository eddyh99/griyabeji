<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_penyesuaian extends CI_Model{
	public function getstok($id){
		$sql="SELECT sum(jumlah) as jumlah FROM(
            SELECT IFNULL(sum(jumlah),0) as jumlah FROM penyesuaian WHERE id_items=? AND approved=1 GROUP BY id_items
            
            UNION ALL

            SELECT IFNULL(sum(jumlah),0)*-1 as jumlah FROM penjualan_detail a WHERE jenis='items' AND id_produk=? GROUP BY id_produk
            
            UNION ALL
            
            SELECT IFNULL(sum(a.jumlah*b.jumlah),0)*-1 as jumlah FROM penjualan_detail a INNER JOIN produk_detail b ON a.id_produk=b.id_produk WHERE b.id_items=? AND jenis='produk' GROUP BY b.id_items
            
            UNION ALL
            
            SELECT IFNULL(sum(a.jumlah*c.jumlah),0)*-1 as jumlah FROM penjualan_detail a INNER JOIN paket_detail b ON a.id_produk=b.id_paket INNER JOIN produk_detail c ON b.id_produk=c.id_produk WHERE c.id_items=? AND jenis='paket' GROUP BY c.id_items
            ) x";
		$query=$this->db->query($sql,array($id,$id,$id,$id));
        return $query->row()->jumlah;
    }

    public function insertData($data){
		if ($this->db->insert(PENYESUAIAN, $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
    }

    public function getpenyesuaian(){
        $sql="SELECT m1.tanggal,m2.namaitem, x.stok, (IFNULL(m1.jumlah,0)+x.stok) as riil FROM penyesuaian m1 INNER JOIN items m2 ON m1.id_items=m2.id INNER JOIN (
            SELECT id_items, sum(jumlah) as stok FROM(
                    SELECT id_items, IFNULL(sum(jumlah),0) as jumlah FROM penyesuaian WHERE id_items=3 AND approved=1 GROUP BY id_items
                    
                    UNION ALL
        
                    SELECT id_produk,IFNULL(sum(jumlah),0)*-1 as jumlah FROM penjualan_detail a WHERE jenis='items' AND id_produk=3 GROUP BY id_produk
                    
                    UNION ALL
                    
                    SELECT id_items,IFNULL(sum(a.jumlah*b.jumlah),0)*-1 as jumlah FROM penjualan_detail a INNER JOIN produk_detail b ON a.id_produk=b.id_produk WHERE b.id_items=3 AND jenis='produk' GROUP BY b.id_items
                    
                    UNION ALL
                    
                    SELECT id_items,IFNULL(sum(a.jumlah*c.jumlah),0)*-1 as jumlah FROM penjualan_detail a INNER JOIN paket_detail b ON a.id_produk=b.id_paket INNER JOIN produk_detail c ON b.id_produk=c.id_produk WHERE c.id_items=3 AND jenis='paket' GROUP BY c.id_items
                    ) x) x ON m1.id_items=x.id_items WHERE m1.approved=0;";
    }
}
?>