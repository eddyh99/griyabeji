<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model{
    private $table_pengguna = 'pengguna';

	public function VerifyLogin($username,$password){
		$pass=sha1($password);

		$condition = "username='".$username."' AND passwd='".$pass."'";
		$this->db->where($condition);
		
		$query=$this->db->get($this->table_pengguna);

		if ($query->num_rows()>0){
			return $query->row();
		}else{
			return "failed";
		}
	}	
}
?>