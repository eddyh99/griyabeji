<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_penyesuaian extends CI_Model
{
  public function getstok($id)
  {
    // $sql="SELECT sum(jumlah) as jumlah FROM(
    //         SELECT IFNULL(sum(jumlah),0) as jumlah FROM ".PENYESUAIAN." WHERE id_items=? AND approved=1 GROUP BY id_items

    //         UNION ALL

    //         SELECT IFNULL(sum(jml)*-1,0) as jumlah FROM ".PENJUALAN_DETAIL." a INNER JOIN ".PENJUALAN_PENGUNJUNG." b ON a.id=b.id_detail WHERE jenis='items' AND id_produk=? GROUP BY id_produk

    //         UNION ALL

    //         SELECT IFNULL((count(1)*b.jumlah*-1),0) as jumlah FROM ".PENJUALAN_DETAIL." a INNER JOIN ".PRODUK_DETAIL." b ON a.id_produk=b.id_produk INNER JOIN ".PENJUALAN_PENGUNJUNG." c ON a.id=c.id_detail WHERE b.id_items=1 AND jenis='produk' GROUP BY b.id_items

    //         UNION ALL

    //         SELECT IFNULL(count(1)*c.jumlah*-1,0) as jumlah FROM ".PENJUALAN_DETAIL." a INNER JOIN ".PAKET_DETAIL." b ON a.id_produk=b.id_paket INNER JOIN ".PRODUK_DETAIL." c ON b.id_produk=c.id_produk INNER JOIN ".PENJUALAN_PENGUNJUNG." d ON a.id=d.id_detail WHERE c.id_items=1 AND jenis='paket' GROUP BY c.id_items
    //         ) x";

    $sql = "
    SELECT
    SUM(jumlah) AS jumlah
    FROM
        (
        SELECT
            IFNULL(SUM(jumlah),
            0) AS jumlah
        FROM
            penyesuaian
        WHERE
            id_items = ? AND approved = 1
        GROUP BY
            id_items
        UNION ALL
        SELECT
            IFNULL(SUM(jml) * -1,
            0) AS jumlah
        FROM
            penjualan_detail a
        INNER JOIN penjualan_pengunjung b ON
            a.id = b.id_detail
        WHERE
            jenis = 'items' AND id_produk = ?
        GROUP BY
            id_produk
        UNION ALL
        SELECT
            IFNULL((COUNT(1) * b.jumlah * -1),
            0) AS jumlah
        FROM
            penjualan_detail a
        INNER JOIN produk_detail b ON
            a.id_produk = b.id_produk
        INNER JOIN penjualan_pengunjung c ON
            a.id = c.id_detail
        WHERE
            b.id_items = ? AND jenis = 'produk'
        GROUP BY
            b.id_items
        UNION ALL
        SELECT
            IFNULL(COUNT(1) * c.jumlah * -1,
            0) AS jumlah
        FROM
            penjualan_detail a
        INNER JOIN paket_detail b ON
            a.id_produk = b.id_paket
        INNER JOIN produk_detail c ON
            b.id_produk = c.id_produk
        INNER JOIN penjualan_pengunjung d ON
            a.id = d.id_detail
        WHERE
            c.id_items = ? AND jenis = 'paket'
        GROUP BY
            c.id_items
    ) X;
    ";
    $query = $this->db->query($sql, array($id, $id, $id, $id));
    return $query->row()->jumlah;
  }

  public function insertData($data)
  {
    if ($this->db->insert(PENYESUAIAN, $data)) {
      return array("code" => 0, "message" => "");
    } else {
      return $this->db->error();
    }
  }

  public function getpenyesuaian()
  {
    $sql = "SELECT m1.id, m1.tanggal,m2.namaitem as namaitems, m3.stok, (m1.jumlah+m3.stok) as riil, m1.keterangan
        FROM penyesuaian m1 
        INNER JOIN items m2 ON m1.id_items=m2.id 
        INNER JOIN (
            SELECT id_items, sum(jumlah) as stok FROM(
              SELECT id_items, IFNULL(sum(jumlah),0) as jumlah FROM penyesuaian WHERE approved=1 GROUP BY id_items
                        
              UNION ALL
        
              SELECT id_produk as id_items, IFNULL(sum(jml)*-1,0) as jumlah FROM penjualan_detail a INNER JOIN penjualan_pengunjung b ON a.id=b.id_detail WHERE jenis='items' GROUP BY id_produk
                        
              UNION ALL
                        
              SELECT b.id_items, IFNULL((count(1)*b.jumlah*-1),0) as jumlah FROM penjualan_detail a INNER JOIN produk_detail b ON a.id_produk=b.id_produk INNER JOIN penjualan_pengunjung c ON a.id=c.id_detail WHERE jenis='produk' GROUP BY b.id_items
                        
              UNION ALL
                        
              SELECT c.id_items, IFNULL(count(1)*c.jumlah*-1,0) as jumlah FROM penjualan_detail a INNER JOIN paket_detail b ON a.id_produk=b.id_paket INNER JOIN produk_detail c ON b.id_produk=c.id_produk INNER JOIN penjualan_pengunjung d ON a.id=d.id_detail WHERE jenis='paket' GROUP BY c.id_items
           ) x GROUP BY id_items
        ) m3 ON m3.id_items=m1.id AND m2.id=m3.id_items
        WHERE  m1.approved=0;";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function setapprove($mdata)
  {
    if ($this->db->update_batch(PENYESUAIAN, $mdata, 'id')) {
      return array("code" => 0, "message" => "");
    } else {
      return $this->db->error();
    }
  }
}
