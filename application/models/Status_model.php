<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends CI_Model {

	private $table;
	public function __construct()
	{
		parent::__construct();
		$this->table = "akdn_study_status";
	}

	public function getStatus($where = []){
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

/* End of file Status_model.php */
/* Location: ./application/models/Status_model.php */