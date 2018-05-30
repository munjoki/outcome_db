<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{

    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'akdn_users';
    }

    /**
     * add an user in the database
     *
     * @return int
     * @author Prakhar
     */
    public function add($user = [])
    {
        if (empty($user)) {
            return false;
        } else {
            $this->db->insert($this->table, $user);
            return $this->db->insert_id();
        }
    }

    /**
     * get User based on criteria
     * @return array / boolen
     * @author Prakhar
     */
    public function getUser($where = null)
    {
        if (!empty($where) && $where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Update the user
     * @return boolean
     * @author Prakhar
     */
    public function updateUser($where, $data)
    {
        if (empty($where) || empty($data)) {
            return false;
        } else {
            return $this->db->update($this->table, $data, $where);
        }
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
