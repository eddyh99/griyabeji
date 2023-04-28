<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KasModel extends CI_Model{
    private $kas = "kas";
    
	public function insertData($data){
	    $today=date("Y-m-d");
	    if ($data["jenis"]=='Kas Awal'){
    	    $sql="SELECT * FROM kas WHERE dateonly=? AND storeid=? AND jenis='Kas Awal'";
    	    $query=$this->db->query($sql,array($today,$data["storeid"]));
    	    if ($query->num_rows()>0){
    	        return array("code"=>5051,"message"=>"Kas awal sudah pernah dimasukkan hari ini");
    	    }else{
                $this->db->insert($this->kas,$data);
    		}
	    }else{
            $this->db->insert($this->kas,$data);
	    }
	}
	
	public function openkas(){
	    $today=date("Y-m-d");
	    $before=date('Y-m-d', strtotime($today . ' -1 day'));

	    $storeid=$_SESSION["logged_status"]["storeid"];
        
        $sql="SELECT * FROM kas WHERE storeid=? AND jenis='Kas Awal'";
        $open=$this->db->query($sql,$storeid)->num_rows();
        if ($open>1){
    	    $sql="SELECT * FROM kas WHERE dateonly=? AND storeid=? AND jenis='Kas Sisa' ORDER BY dateonly DESC LIMIT 0,1";
    	    $query=$this->db->query($sql,array($before,$storeid));
    	    if ($query->num_rows()==0){
                    return "5052";
    	    }else{
        	    $sql="SELECT * FROM kas WHERE dateonly=? AND storeid=? AND jenis='Kas Awal'";
        	    $query=$this->db->query($sql,array($today,$storeid));
        	    if ($query->num_rows()==0){
        	        return "5051";//array("code"=>5051,"message"=>"Kas awal sudah pernah dimasukkan hari ini");
        	    }
    	    }
        }else{
    	    $sql="SELECT * FROM kas WHERE dateonly=? AND storeid=? AND jenis='Kas Awal'";
    	    $query=$this->db->query($sql,array($today,$storeid));
    	    if ($query->num_rows()==0){
    	        return "5051";//array("code"=>5051,"message"=>"Kas awal sudah pernah dimasukkan hari ini");
    	    }
        }
	}
	
	public function listkas(){
	    $now=date("Y-m-d");
	    $storeid=$_SESSION["logged_status"]["storeid"];
	    
	    $sql="SELECT * FROM ".$this->kas." WHERE DATE(tanggal)=? AND storeid=?";
	    $query=$this->db->query($sql,array($now,$storeid));
	    return $query->result_array();
	}
	
	public function lastsaldo($today,$storeid=''){
	    if (empty($storeid)){
    	    $storeid=$_SESSION["logged_status"]["storeid"];
	    }
        
        $mdata["saldo"]=0;
	    //cek saldo akhir hari sebelumnya
	    $sql="SELECT nominal FROM kas WHERE storeid=? AND jenis='Kas Sisa' AND tanggal<? ORDER BY tanggal DESC LIMIT 0,1";
	    $query=$this->db->query($sql,array($storeid,$today));
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

        //ambil seluruh retur hari ini
        $sretur="SELECT c.barcode,c.jumlah, a.jual_id FROM retur a 
                INNER JOIN retur_detail c ON a.id=c.id 
                WHERE date(a.tanggal)=? AND a.storeid=?"
                ;
        $qretur=$this->db->query($sretur,array($today,$storeid));
        $retur=$qretur->result_array();
        
	    //cek total retur
	    $mdata["retur"]["tunai"]=0;
	    $mdata["retur"]["non"]=0;
        foreach ($retur as $dt){
            $sjual="SELECT a.tanggal, a.method, (b.diskonn+b.diskonp) as diskon 
                    FROM penjualan a
                    INNER JOIN penjualan_detail b ON a.id=b.id
                    WHERE a.id=? AND b.barcode=?";
            $qjual=$this->db->query($sjual,array($dt["jual_id"],$dt["barcode"]))->result_array();

            $sql="SELECT harga, barcode,tanggal FROM harga WHERE tanggal<='".$qjual[0]["tanggal"]."' AND barcode='".$dt["barcode"]."' ORDER BY tanggal DESC LIMIT 0,1";
            $harga=$this->db->query($sql,array($qjual["tanggal"],$dt["barcode"]))->row()->harga;
            if ($qjual[0]["method"]=="cash"){
                $mdata["retur"]["tunai"]=$mdata["retur"]["tunai"]+($dt["jumlah"]*($harga-$qjual[0]["diskon"]));
            }else{
                $mdata["retur"]["non"]=$mdata["retur"]["non"]+($dt["jumlah"]*($harga-$qjual[0]["diskon"]));
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

    public function notclosedstore(){
        $now=date("Y-m-d");
        $sql="SELECT storeid FROM store WHERE storeid NOT IN (SELECT storeid FROM kas WHERE jenis='Kas Sisa' AND dateonly=?) AND storeid!=6";
        return $this->db->query($sql,$now)->result_array();
    }
    

}
?>