<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model{

    private function rekapjual($month,$year,$storeid){
	    $sql="SELECT * FROM penjualan  WHERE MONTH(tanggal) = '".$month."' AND YEAR(tanggal) = '".$year."' AND storeid='".$storeid."'";
	    $penjualan=$this->db->query($sql)->result_array();

        $total=0;
        foreach ($penjualan as $dt){
            $dsql="SELECT * FROM penjualan_detail WHERE id=?";
            $detail=$this->db->query($dsql,$dt["id"])->result_array();
            
            foreach ($detail as $det){
                $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<=? AND barcode=? ORDER BY tanggal DESC LIMIT 0,1";
                $harga=$this->db->query($sql,array($dt["tanggal"],$det["barcode"]))->row()->harga;
                
                $total=$total+($det["jumlah"]*$harga)-$det["diskonn"]-$det["diskonp"];
            }
        }
        
        return $total;
    }
    
    public function getPenjualan($month,$year){
        $sql="SELECT * FROM store WHERE status='0' AND store<>'Hanaka Office'";
        $store=$this->db->query($sql)->result_array();
        
        $data=array();
        foreach ($store as $dt){
            $temp["store"]=$dt["store"];
            $temp["total"]=$this->rekapjual($month,$year,$dt["storeid"]);
            array_push($data,$temp);
        }

        $total=0;
        foreach ($data as $dt){
            $total=$total+$dt["total"];
        }
        
        for ($i=0;$i<count($data);$i++){
            $mdata[$i][0]=$data[$i]["total"]*100/$total;
            $mdata[$i][1]=$data[$i]["store"];
        }

        return $mdata;
    }
    
    public function getBrand($month,$year){
        $sql="SELECT sum(b.jumlah) as total,c.namabrand FROM penjualan a 
            INNER JOIN penjualan_detail b ON a.id=b.id 
            INNER JOIN produk c ON b.barcode=c.barcode 
            WHERE MONTH(a.tanggal)='".$month."' AND YEAR(a.tanggal)='".$year."' GROUP BY c.namabrand";
        $brand=$this->db->query($sql)->result_array();


        for ($i=0;$i<count($brand);$i++){
            $mdata[$i][0]=$brand[$i]["total"]*1;
            $mdata[$i][1]=$brand[$i]["namabrand"];
        }

        return $mdata;
        
    }

    public function getBrandstore($month,$year){
        $sstore="SELECT * FROM store WHERE store<>'Hanaka Office'";
        $store=$this->db->query($sstore)->result_array();

        $sbrand="SELECT * FROM brand";
        $brand=$this->db->query($sbrand)->result_array();
        
        $sql="SELECT a.storeid, sum(b.jumlah) as total,c.namabrand FROM penjualan a 
            INNER JOIN penjualan_detail b ON a.id=b.id 
            INNER JOIN produk c ON b.barcode=c.barcode 
            WHERE MONTH(a.tanggal)='".$month."' AND YEAR(a.tanggal)='".$year."' GROUP BY c.namabrand, a.storeid";
        $jbrand=$this->db->query($sql)->result_array();

        $data=array();
        foreach ($store as $dstore){
            $temp["type"]="bar";
            $temp["showInLegend"]=true;
            $temp["name"]= $dstore["store"];
            $temp["dataPoints"]=array();
            for ($i=0;$i<count($brand);$i++){
                $temp2["y"]=0;
                $temp2["label"]=$brand[$i]["namabrand"];
                for ($j=0;$j<count($jbrand);$j++){
                    if (($dstore["storeid"]==$jbrand[$j]["storeid"]) && ($brand[$i]["namabrand"]==$jbrand[$j]["namabrand"])){
                        $temp2["y"]=$temp2["y"]+$jbrand[$j]["total"]*1; 
                    }
                }
                array_push($temp["dataPoints"],$temp2);
            }
            array_push($data,$temp);
        }
        
        return $data;
        
    }
    
}
?>