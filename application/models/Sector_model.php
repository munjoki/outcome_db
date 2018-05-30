<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sector_model extends CI_Model {

	private $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = "akdn_sector";
	}

	public function getSector($where = []){
		if(!empty($where)){
			$this->db->where($where);
		}
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else {
			return false;
		}
	}

	public function getSectorIn($where = []){
		if(!empty($where)){
			$this->db->where_in($where[0],$where[1]);
		}
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else {
			return false;
		}
	}


}

/* End of file Sector_model.php */
/* Location: ./application/models/Sector_model.php */