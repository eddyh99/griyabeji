<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_auth extends CI_Model{
    private $table_pengguna = 'pengguna';

	public function VerifyLogin($username,$password){
		$sql="SELECT * FROM pengguna WHERE username=? AND passwd=sha1(?)";
		$query=$this->db->query($sql,array($username,$password));
		return $query->row();
		if ($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}	
}
?>