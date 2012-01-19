<?php
class Home_model extends CI_Model {
	var $sql=''; 
    var $orderby='';
    var $where='';
	var $groupby='';
	var $having='';
	var $limit='';
	
	function __construct()
    {
        parent::__construct();
    }
		
	function Set_sql($sql=''){
		if($sql!='')
		$this->sql = $sql;
		else
		$this->sql = '';
	}
	
	function Set_orderby($orderby=''){
		if($orderby!='')
		$this->orderby = ' order by '.$orderby;
		else
		$this->orderby = '';
	}
	
	function Set_where($where=''){
		if($where!='')
		{
			if($this->where!=''){
				$this->where = ' WHERE '.str_replace(" WHERE ","",$this->where)." AND ".$where;
			}else{
				$this->where = ' WHERE '.$where;
			}
		}
		else
		{
			$this->where = '';
		}
	}
	
	function Set_free_where(){
		$this->where = '';
	}
	
	function Set_groupby($groupby=''){
		if($groupby!='')
		$this->groupby = ' GROUP BY '.$groupby;
		else
		$this->groupby = '';
	}
	
	function Set_having($having=''){
		if($having!='')
		$this->having = '  HAVING  '.$having;
		else
		$this->having = '';
	}
	
	function Set_limit($limit=''){
		if($limit!='')
		$this->limit = ' limit '.$limit;
		else
		$this->limit = '';
	}
	
	function latest_post()
	{
		$row=array();
		$query=$this->db->query("SELECT SQL_CALC_FOUND_ROWS ".$this->sql.$this->where.$this->groupby.$this->having.$this->orderby.$this->limit);
		if($query->num_rows()>0){
			$row=$query->result_array();
		}
		return $row;
	}
	
	function watch_post()
	{
		$row='';
		$query=$this->db->query("SELECT ".$this->sql.$this->where.$this->orderby.$this->limit);
		if($query->num_rows()>0){
			$row=$query->row();
		}
		return $row;
	}
	
	function count_posts()
	{
		$result=$this->db->query("SELECT FOUND_ROWS() AS posts");
		$result=$result->row_array();
		return $result['posts'];
	}
	
	function sql_query($sql='')
	{
		if($this->db->query($sql))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		
		}
	}
	
	function retrieve_user_id($email)
	{
		$array=array('email'=>$email);
		$this->db->where($array);
		$query=$this->db->get('gf_user');
		if($query->num_rows()>0){
			$row=$query->row();
			return $row->user_id;		
		}else{
			return FALSE;
		}
	}
}