<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Automatics extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model("staff/kasModel");
    }

    public function autoclose(){
        $now=date("Y-m-d");
        $notclose=$this->kasModel->notclosedstore();
        
        foreach ($notclose as $dt){
	        $result=$this->kasModel->lastSaldo($now,$dt["storeid"]);

            $kaskeluar=0;
            foreach($result["kas"] as $dt){
                if ($dt["jenis"]=="Keluar"){
                    $kaskeluar=$kaskeluar+$dt["nominal"];
                }
            }
            
            $kasmasuk=0;
            foreach($result["kas"] as $dt){
                if ($dt["jenis"]=="Masuk"){
                    $kasmasuk=$kasmasuk+$dt["nominal"];
                }
            }
            
            
            $totaltunai=$result["tunai"]+$result["saldo"]-$kaskeluar+$kasmasuk-$result["retur"]["tunai"];
            $setor=floor($totaltunai / 50000)*50000;
    	    
            $data		= array(
                "nominal"       => $totaltunai-$setor,
                "jenis"         => "Kas Sisa",
                "dateonly"      => $now,
                "tanggal"       => date("Y-m-d H:i:s"),
                "storeid"       => $dt["storeid"],
                "keterangan"    => "Sisa Kas",
                "userid"        => 'admin'
            );
    		$this->kasModel->setSisa($data);
        }        
    }
}
