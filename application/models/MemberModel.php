<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model{
    private $member = 'member';

    public function allposts_count()
    {
        $sql="SELECT * FROM ".$this->member." WHERE status='0'";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }
 
    public function allposts($limit,$start,$col,$dir){
        $sql="SELECT * FROM ".$this->member." WHERE status='0' ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search($limit,$start,$search,$col,$dir){
        $sql="SELECT * FROM ".$this->member." WHERE status='0' AND (member_id like '%".$search."%' OR nama like '%".$search."%' OR nope like '%".$search."%' OR email like '%".$search."%') ORDER BY ".$col." ".$dir." LIMIT ".$start.",".$limit;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function posts_search_count($search){
        $sql="SELECT * FROM ".$this->member." WHERE status='0' AND (member_id like '%".$search."%' OR nama like '%".$search."%' OR nope like '%".$search."%' OR email like '%".$search."%')";
        $query=$this->db->query($sql);
        return $query->num_rows();
    }
	
	public function getLastmember(){
		$sql="SELECT RIGHT(RIGHT(member_id,5)+100001,5) as last FROM ".$this->member." ORDER BY member_id DESC";
		$query=$this->db->query($sql);
		if ($query->num_rows()==0){
			$memberid='00001';
		}else{
			$memberid=$query->row()->last;
		}
		return $memberid;
	}

	public function insertData($data){
		if ($this->db->insert($this->member,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function getMember($memberid){
		$sql="SELECT * FROM ".$this->member." WHERE member_id=?";
		$query=$this->db->query($sql,$memberid);
		if ($query->num_rows()>0){
	        return array("code"=>0, "message"=>$query->row());
		}else{
			return array("code"=>4004);
		}
	}

	public function updateData($data,$memberid){
		$this->db->where("member_id",$memberid);
		if ($this->db->update($this->member,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$memberid){
		$this->db->where("member_id",$memberid);
		if ($this->db->update($this->member,$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>