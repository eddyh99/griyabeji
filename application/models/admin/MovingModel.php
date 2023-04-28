<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MovingModel extends CI_Model{
    private $produk = 'produk';
    private $pindah = 'pindah';
    private $pindah_detail = 'pindah_detail';
    private $store = 'store';

	public function __construct() {
	    parent::__construct();
	    $this->load->model("admin/opnameModel");
    }

    public function allposts_count()
    {
        $storeid=@$_SESSION["logged_status"]["storeid"];
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    ( SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid WHERE a.tujuan='".$storeid."'
                    ) x INNER JOIN store y ON x.dari=y.storeid";
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
    			FROM 
    			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
    			INNER JOIN ".$this->store." y ON x.dari=y.storeid";
        }
        
        $query	= $this->db->query($sql);
        return $query->num_rows();
    }
 
    public function allposts($limit,$start,$col,$dir){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    ( SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid WHERE a.tujuan='".$storeid."'
                    ) x INNER JOIN store y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid  WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }
        $query	= $this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search($limit,$start,$search,$col,$dir){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    ( SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid WHERE a.tujuan='".$storeid."'
                    ) x INNER JOIN store y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND  (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }
        $query	= $this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search_count($search){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    ( SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid WHERE a.tujuan='".$storeid."'
                    ) x INNER JOIN store y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%')";
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%')";
        }
        $query	= $this->db->query($sql);
        return $query->num_rows();
    }

    public function allposts_countkonfirm()
    {
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    (SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid
                    ) x INNER JOIN store y ON x.dari=y.storeid  WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND x.dari='".$storeid."'";
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
    			FROM 
    			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
    			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."'";
        }
        
        $query	= $this->db->query($sql);
        return $query->num_rows();
    }
 
    public function allpostskonfirm($limit,$start,$col,$dir){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    (SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid
                    ) x INNER JOIN store y ON x.dari=y.storeid  WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND  x.dari='".$storeid."' ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }
        $query	= $this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_searchkonfirm($limit,$start,$search,$col,$dir){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    (SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid
                    ) x INNER JOIN store y ON x.dari=y.storeid  WHERE x.dari='".$storeid."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        }
        $query	= $this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search_countkonfirm($search){
        $storeid=@$_SESSION["logged_status"]["storeid"];
        $month=date("m");
        $year=date("Y");
        if (($_SESSION["logged_status"]["role"]=="Store Manager")||($_SESSION["logged_status"]["role"]=="Staff")) {
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
                    FROM 
                    (SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid
                    ) x INNER JOIN store y ON x.dari=y.storeid  WHERE x.dari='".$storeid."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%')";
        }else{
            $sql	= "SELECT x.mutasi_id, x.tanggal, y.store as dari, x.tujuan, if(x.approved=1, 'Diterima', if (x.approved=2, 'Batal', if (x.approved=3, 'Dikirim', 'Belum'))) as status 
			FROM 
			(SELECT a.mutasi_id, a.tanggal, a.approved, a.dari, b.store as tujuan FROM ".$this->pindah." a INNER JOIN ".$this->store." b ON a.tujuan=b.storeid) x 
			INNER JOIN ".$this->store." y ON x.dari=y.storeid WHERE  MONTH(x.tanggal)='".$month."' AND YEAR(x.tanggal)='".$year."' AND (mutasi_id like '%".$search."%' OR tanggal like '%".$search."%' OR dari like '%".$search."%' OR tujuan like '%".$search."%')";
        }
        $query	= $this->db->query($sql);
        return $query->num_rows();
    }
	
	public function insertData($pindah,$barang){
		$this->db->trans_start(); 
		
		//insert ke tabel penjualan
		$query	= $this->db->insert($this->pindah,$pindah);
		$id		= $this->db->insert_id();
		
		$detail	= array();
		foreach ($barang as $dt){
			$temp["mutasi_id"]	= $id;
			$temp["barcode"]	= $dt[0];
			$temp["size"]		= strtoupper($dt[2]);
			$stok=$this->opnameModel->getStok($dt[0],$pindah["dari"],strtoupper($dt[2]));
			if (($stok-$dt[3])<0){
    			$temp["jumlah"]		= $stok;
			}else{
    			$temp["jumlah"]		= $dt[3];
			}
			
			$query=$this->db->insert($this->pindah_detail,$temp);
			print_r($this->db->error());
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
            return array("code"=>0, "message"=>"");
			return TRUE;
		}
	}

	public function voidData($data,$mutasi_id){
		$this->db->where("mutasi_id",$mutasi_id);
		if ($this->db->update($this->pindah,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}		
	}

	public function acceptData($data,$mutasi_id){
		$this->db->where("mutasi_id",$mutasi_id);
		if ($this->db->update($this->pindah,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}		
	}

    public function getMoving($mutasi_id){
        $sql="SELECT x.store as asal, y.store as tujuan FROM (SELECT store FROM pindah a INNER JOIN store b ON a.dari=b.storeid WHERE a.mutasi_id=?) x, (SELECT store FROM pindah a INNER JOIN store b ON a.tujuan=b.storeid WHERE a.mutasi_id=?) y";
        $query	= $this->db->query($sql,array($mutasi_id,$mutasi_id));
        return $query->result_array();
    }
    
    public function getdetail($mutasi_id){
        $sql="SELECT a.*,b.namaproduk, b.namabrand FROM ".$this->pindah_detail." a INNER JOIN ".$this->produk." b ON a.barcode=b.barcode WHERE a.mutasi_id=?";
        $query=$this->db->query($sql,$mutasi_id);
        return $query->result_array();
    }
}
?>