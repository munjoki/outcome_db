<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ajaxprocessor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in') || !$this->session->logged_in) {
            $this->session->sess_destroy();
            $message = "You have logged out OR your Session Has Expired. Please Login Again";
            die(json_encode(["message" => $message, "messageCode" => 101]));
        }
    }

    public function saveMessage() {
        if (!$this->input->is_ajax_request()) {
            die(json_encode(["message" => "invalid Request", "messageCode" => 100]));
        }
        else {
            $data            = $this->prepareStudyData();
            $id              = $this->input->post('study_identification', true);
            $saved_dashboard = site_url("ajaxprocessor/dashboard");
            
            if (empty($id)) {
                $result = $this->createStudy($data);
            }
            else {
                $result = $this->updateStudy($id, $data);
            }
            
            if ($result != false) {
                echo json_encode([
                    "message"     => "success",
                    "messageCode" => 102,
                    "url"         => $saved_dashboard]
                );
            }
        }
    }

    public function dashboard() {
        if ($this->session->logged_in) {
            $studies = $this->getDashboardData();
            $this->showDashboard($studies);
        }
    }

    /**
     * Method to get the incomplete studies. If accessed by admin, all the psrtial studies would be retrieved.
     * Else if the user is not an admin then only his/her studies would be retrieved
     * @return array
     */
    private function getDashboardData() {
        if ($this->session->role == '1') {
            $where = [ 'deleted' => '0', 'saved_form' => '0'];
        }
        else {
            $where = ["user_id" => $this->session->id, 'deleted' => '0', 'saved_form' => '0'];
        }

        $this->load->model('Study_model', 'study');
        $studies = $this->study->getDashboardData($where);
        $temp    = [];
        if (!empty($studies)) {
            foreach ($studies as $value) {
                $tempo_arr = [];
                $tempo_arr = $value;
                $cnt_str   = "";
                $cnt_arr   = unserialize($value['country_name']);
                foreach ($cnt_arr as $arr) {
                    $cnt_str .= $arr['country_name'] . ', ';
                }
                $tempo_arr['country_name'] = rtrim($cnt_str, ', ');
                $temp[]                    = $tempo_arr;
                unset($tempo_arr);
            }
        }
        unset($studies);
        return $temp;
    }

    public function showDashboard($studies, $search_error = null) {
        $title = "My Saved Forms";
        $this->load->view('dashboard/dashboard-saved', compact("title", "studies", "search_error"));
    }

    private function createStudy($data = []) {
        if (empty($data)) {
            return false;
        }
        else {
            $this->load->model('Study_model', 'study');
            $id = $this->study->add($data);
            if (is_numeric($id) && $id >= 0) {
                return $id;
            }
            else {
                return false;
            }
        }
    }

    private function updateStudy($id = null, $data = []) {
        if (empty($data) || is_null($id)) {
            return false;
        }
        else {
            $where = [
                'id'      => $id,
//                'user_id' => $this->session->id,
                'deleted' => '0',
            ];
            $this->load->model('Study_model', 'study');
            return $this->study->updateStudy($where, $data);
        }
    }

    private function prepareStudyData() {
        # set up model classes
        $this->load->model('Sector_model', 'sector');
        $this->load->model('Theme_model', 'theme');
        $this->load->model('Method_model', 'method');
        $this->load->model('Agency_model', 'agency');
        $this->load->model('Status_model', 'status');
        $this->load->model('Currency_model', 'currency');
        $this->load->model('Start_model', 'start');
        $this->load->model('End_model', 'end');
        $this->load->model('Country_model', 'country');


        # get the regular data
        $data['title']         = $this->input->post('title', true);
        $data['sub_location']  = $this->input->post('sub_location', true);
        $data['contact_name']  = $this->input->post('contact_name', true);
        $data['contact_email'] = $this->input->post('contact_email', true);
        $data['agency_id']     = $this->session->agency_id;
        $data['agency_name']   = $this->session->agency_name;
        $data['user_id']       = $this->session->id;
        $data['objectives']    = $this->input->post('objectives', true);
        $empty_data            = serialize([]);
        $data['saved_form']    = "0";
        $data['deleted']       = "0";

        # setup the country
        $post_country = $this->input->post('country', true);
        if (empty($post_country)) {
            $data['country_name'] = $empty_data;
            $data['country_id']   = $empty_data;
        }
        else {
            $country_array        = ["id", $post_country];
            $countries            = $this->country->getCountryIn($country_array);
            $data['country_name'] = serialize($countries);
            $data['country_id']   = serialize($post_country);
        }
        $data['other_country'] = $this->input->post('other_country', true);

        # setup the sector related data
        $post_sector = $this->input->post('sector', true);
        if (empty($post_sector)) {
            $data['sector_ids'] = $empty_data;
            $data['sector']     = $empty_data;
        }
        else {
            $sector_array       = ["id", $post_sector];
            $sectors            = $this->sector->getSectorIn($sector_array);
            $data['sector_ids'] = serialize($post_sector);
            $data['sector']     = serialize($sectors);
        }
        $data['other_sector'] = $this->input->post('other_sector', true);

        # setup the theme related data
        $post_theme = $this->input->post('theme', true);
        if (empty($post_theme)) {
            $data['theme_ids'] = $empty_data;
            $data['theme']     = $empty_data;
        }
        else {
            $theme_array       = ['id', $post_theme];
            $themes            = $this->theme->getThemeFromSector($theme_array);
            $data['theme_ids'] = serialize($post_theme);
            $data['theme']     = serialize($themes);
        }
        $data['other_theme'] = $this->input->post('other_theme', true);

        # setup the tools and methods data
        $post_tools = $this->input->post('tools', true);
        if (empty($post_tools)) {
            $data['tools_ids'] = $empty_data;
            $data['tools']     = $empty_data;
        }
        else {
            $tools_array       = ['id', $post_tools];
            $tools             = $this->method->getToolsIn($tools_array);
            $data['tools_ids'] = serialize($post_tools);
            $data['tools']     = serialize($tools);
        }
        $data['other_tools'] = $this->input->post('other_tools', true);

        # setup collaboration data
        $collaboration_radio = $this->input->post('collaboration_radio', true);
        if (isset($collaboration_radio) && in_array("1", $collaboration_radio)) {
            $post_collaborators           = $this->input->post('collaborators', true);
            $collaborators_array          = ['id', $post_collaborators];
            $collaborators                = $this->agency->getAgencyIn($collaborators_array);
            $data['collaborators_ids']    = serialize($collaborators_array);
            $data['collaborators']        = serialize($collaborators);
            $data['collaboration_type'][] = "AKDN Agency"; //
        }

        if (isset($collaboration_radio) && in_array("2", $collaboration_radio)) {
            $data['collaboration_type'][] = "External Agency"; //
            $data['other_collaborators']  = $this->input->post('other_collaborators', true); //
            if (!isset($data['collaborators_ids']) || empty($data['collaborators_ids'])) {
                $data['collaborators_ids'] = null;
            }
            if (!isset($data['collaborators']) || empty($data['collaborators'])) {
                $data['collaborators'] = null;
            }
        }
        if (isset($collaboration_radio) && in_array("0", $collaboration_radio)) {
            $data['collaborators_ids']    = null;
            $data['collaborators']        = null;
            $data['collaboration_type'][] = "None";
        }
        if (isset($data['collaboration_type'])) {
            $data['collaboration_type']    = serialize($data['collaboration_type']);
            $data['collaboration_type_id'] = serialize($collaboration_radio);
        }

        # setup study status
        $post_study_status    = $this->input->post('study_status', true);
        $status_where         = ['id' => $post_study_status];
        $study_status         = $this->status->getStatus($status_where);
        $data['study_id']     = $post_study_status;
        $data['study_status'] = $study_status[0]['status_name'];
        $data['other_status'] = $this->input->post('other_status', true);

        # setup Curreny
        $currency_code = $this->input->post('budget', true);
        $currency      = "";
        if ($currency_code == '6') {
            $currency = $this->input->post('other_currency', true);
        }
        else {
            $currency = $this->currency->getCurrency(['id' => $currency_code]);
            if ($currency_code != false) {
                $currency = $currency[0]['currency_name'];
            }
        }
        $data['currency_id']   = $currency_code;
        $data['currency_code'] = $currency;
        $data['amount']        = $this->input->post('amount', true);

        $rgister_2016 = $this->input->post('amount_2016', true);
        if (!empty($rgister_2016)) {
            $data['amount_2016'] = intval($this->input->post('amount_2016', true));
        }
        else {
            $data['amount_2016'] = 0;
        }

        # setup funding source detail
        $post_fund = $this->input->post('fund_source', true);
        if (empty($post_fund)) {
            $data['fund_source']    = $empty_data;
            $data['fund_source_id'] = $empty_data;
        }
        else if (count($post_fund) == 1) {
            $data['fund_source_id'] = serialize($post_fund);
            if ($post_fund[0] == '1') {
                $data['fund_source'] = serialize(["Internal"]);
            }
            else {
                $data['fund_source'] = serialize(["External"]);
            }
        }
        else {
            $data['fund_source_id'] = serialize($post_fund);
            $data['fund_source']    = serialize(["Internal", "External"]);
        }
        $data['other_fund'] = $this->input->post('other_fund', true);

        # setup human_resource detail
        $post_fund = $this->input->post('human_resource', true);
        if (empty($post_fund)) {
            $data['human_resource_id'] = $empty_data;
            $data['human_resource']    = $empty_data;
        }
        else if (count($post_fund) == 1) {
            $data['human_resource_id'] = serialize($post_fund);
            if ($post_fund[0] == '1') {
                $data['human_resource'] = serialize(["Internal"]);
            }
            else {
                $data['human_resource'] = serialize(["External"]);
            }
        }
        else {
            $data['human_resource_id'] = serialize($post_fund);
            $data['human_resource']    = serialize(["Internal", "External"]);
        }

        # start_date
        $start_date_post = $this->input->post('start_date', true);
        if ($start_date_post == "10") {
            $data['start_date'] = $this->input->post('other_start_date', true);
        }
        else {
            $date               = $this->start->getStart(['id' => $start_date_post]);
            $data['start_date'] = $date[0]['start_name'];
        }
        $data['start_date_id'] = $start_date_post;

        # end date
        $end_date_post = $this->input->post('end_date', true);
        if ($end_date_post == "10") {
            $data['end_date'] = $this->input->post('other_end_date', true);
        }
        else {
            $date             = $this->end->getend(['id' => $end_date_post]);
            $data['end_date'] = $date[0]['end_name'];
        }
        $data['end_date_id'] = $end_date_post;

        return $data;
    }

}

/* End of file Ajaxprocessor.php */
/* Location: ./application/controllers/Ajaxprocessor.php */
