<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_model extends CI_Model {

	private $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = "akdn_currecy";
	}

	public function getCurrency($where = []){
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
}

/* End of file Currency_model.php */
/* Location: ./application/models/Currency_model.php */