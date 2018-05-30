<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme_model extends CI_Model {

	private $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = "akdn_theme";
	}

	public function getTheme(){
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else {
			return false;
		}
	}

	public function getThemeFromSector($where = []){
		if(!empty($where)){
			$this->db->where_in($where[0],$where[1]);
		}
		// print_r($where);
		$query = $this->db->get($this->table);
		// print_r($this->db);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else {
			return false;
		}
	}

}

/* End of file Theme_model.php */
/* Location: ./application/models/Theme_model.php */