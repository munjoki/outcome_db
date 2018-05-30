<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Study_model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = "akdn_mer_study";
    }

    public function getStudy($where = []) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($this->table);
        // print_r($this->db);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function getFreeTextSearchResults($where, $search) {
        $this->db->select("id,title , start_date, end_date, objectives, contact_name, contact_email,timestamp");
        $this->db->where($where);
        $this->db->where(['saved_form' => '1']);
        $this->db->where('MATCH (title,objectives,country_name) AGAINST ("' . $search . '")');
        $query = $this->db->get($this->table);
        // print_r($this->db);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function getDashboardData($where = []) {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->select("id,title , agency_name, country_name, start_date, end_date, objectives, contact_name, contact_email");
        $this->db->order_by('timestamp', 'desc');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function add($data = []) {
        if (empty($data)) {
            return false;
        }
        else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }

    public function updateStudy($where, $data) {
        if (empty($where) || empty($data)) {
            return false;
        }
        else {
            return $this->db->update($this->table, $data, $where);
        }
    }

    public function downloadReport($where = []) {
        $this->db->select("a.id , a.title, a.objectives, a.country_name, a.other_country, a.sub_location, a.agency_name,  a.sector, a.other_sector, a.theme, a.other_theme , a.contact_name, a.contact_email,  a.tools, a.other_tools, a.collaborators, a.study_status, a.other_status, a.currency_code, a.amount, a.fund_source,a.fund_source_id, a.other_fund, a.human_resource,a.human_resource_id, a.start_date, a.end_date, a.timestamp,a.amount_2016, concat(b.firstname,' ',b.surname) as submitted_by");
        $this->db->from("akdn_mer_study a");
        $this->db->join('akdn_users b','a.user_id = b.id', 'left');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where(['a.deleted' => '0', 'a.saved_form' => '1']);
        $query = $this->db->get();
//         print_r($this->db);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function getFakedFullTextResults($where, $words) {
        $this->db->select("id , title, objectives, country_name, other_country, sub_location, agency_name,  sector, other_sector, theme, other_theme , contact_name, contact_email,  tools, other_tools, collaborators, study_status, other_status, currency_code, amount, fund_source, other_fund, human_resource, start_date, end_date, timestamp");
        $this->db->where($where);
        $this->db->where(['saved_form' => '1']);
        $count = 0;
        $this->db->group_start();
        foreach ($words as $word) {
            if ($count == 0) {
                $this->db->like('objectives', $word);
            }
            else {
                $this->db->or_like('objectives', $word);
            }
            $count++;

            $this->db->or_like('title', $word);
            $this->db->or_like('country_name', $word);
        }
        $this->db->group_end();
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }

}

/* End of file Study_model.php */
/* Location: ./application/models/Study_model.php */
