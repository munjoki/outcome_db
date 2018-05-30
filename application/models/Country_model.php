<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}

class Country_model extends CI_Model
{

	private $table ;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'akdn_country';
    }

    public function getCountry()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * function to get country name by country id
     * @return string / boolean
     * @author 
     */
    public function getCountryName($id)
    {
        if(is_numeric($id)){
        	$this->db->where('id', $id);
        	$query = $this->db->get($this->table);
        	if($query->num_rows() == 1){
				$row = $query->row();
				return $row->country_name;
        	}
        	else{
        		return  false;
        	}
        }
        else{
        	return false;
        }
    }

    public function getCountryIn($where = []){
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
