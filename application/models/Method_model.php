<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Method_model extends CI_Model
{

    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = "akdn_method";
    }

    public function getMethod()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getToolsIn($where = [])
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

/* End of file Method_model.php */
/* Location: ./application/models/Method_model.php */
