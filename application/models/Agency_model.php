<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Agency_model extends CI_Model
{

    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = "akdn_agency";
    }

    public function getAgency()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Get Agency name from agency id
     * @return string , boolean
     * @author Prakhar
     */
    public function getAgencyName($id)
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $query = $this->db->get($this->table);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                return $row->agency_name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAgencyIn($where = [])
    {
        if (!empty($where)) {
            $this->db->where_in($where[0], $where[1]);
        }
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}

/* End of file Agency_model.php */
/* Location: ./application/models/Agency_model.php */
