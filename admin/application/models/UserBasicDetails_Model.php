<?php
ob_start();
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class UserBasicDetails_Model extends CI_Model
{
	public function __construct()
	{
		parent :: __construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->db->db_debug = false;
	}
	function SelectWhere($select,$where,$params)
	{
		return $this->db->query("SELECT $select FROM user_basic_details WHERE $where",$params)->result();
	}
	function SetWhere($set,$where,$params)
	{
		$this->db->query("UPDATE user_basic_details SET $set WHERE $where",$params);
		return DatabaseError();
	}
	function Insert($set,$params)
	{
		$this->db->query("INSERT user_basic_details SET $set");
		return DatabaseError();
	}
}
?>