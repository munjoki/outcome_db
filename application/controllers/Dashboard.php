<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in') || !$this->session->logged_in) {
            $this->session->sess_destroy();
            $message = "You have logged out or your session has expired. Please login again";
            $title   = "Login";
            $this->load->view('auth/authentication_login', compact("title", "message"));
        }
    }

    public function getThemesFromStudies() {
        if ($this->session->logged_in) {
            $study_id = $this->uri->segment(3, null);
            $data     = [];
            if ($study_id == null) {
                echo json_encode([]);
                exit();
            }
            else {
                $where = ['id' => $study_id,];
                $this->load->model('Study_model', 'study');
                $study = $this->study->getStudy($where);
                if ($study !== false) {
                    $study     = $study[0];
                    $theme_ids = unserialize($study['theme_ids']);
                    echo json_encode($theme_ids);
                }
                else {
                    echo json_encode([]);
                }
            }
        }
    }

    public function getThemes() {
        if ($this->session->logged_in) {
            $sectors = $this->input->post("param1");
            $data    = [];
            if (count($sectors) > 0 && !(empty($sectors)) && null != $sectors) {
                // print_r($sectors);
                foreach ($sectors as $sector) {
                    if (!empty($sector)) {
                        $data[] = $sector;
                    }
                }
            }
            if (count($data) > 0) {
                $where_in = ['sector_id', $data];
                $this->load->model('Theme_model', 'theme');
                $themes   = $this->theme->getThemeFromSector($where_in);
                echo json_encode($themes);
            }
            else {
                echo json_encode([]);
            }
        }
    }

    public function index() {
        if ($this->session->logged_in) {
            $studies = $this->getDashboardData();
            $this->showDashboard($studies);
        }
    }

    public function delete() {
        if ($this->session->logged_in) {
            $study_id = $this->uri->segment(3, null);
            if ($study_id == null || empty($study_id)) {
                redirect(site_url("dashboard"));
            }
            else {
                if ($this->session->role == '1') {
                    $where = ["id" => $study_id];
                }
                else {
                    $where = ["user_id" => $this->session->id, "id" => $study_id];
                }
                $data = ["deleted" => "1"];

                $this->load->model('Study_model', 'study');
                $this->study->updateStudy($where, $data);
                redirect(site_url('dashboard'));
            }
        }
    }

    public function view() {
        if ($this->session->logged_in) {
            $study_id = $this->uri->segment(3, null);
            if ($study_id == null || empty($study_id)) {
                redirect(site_url("dashboard"));
            }
            else {
                if ($this->session->role == '1') {
                    $where = ["id" => $study_id, "deleted" => '0'];
                }
                else {
                    $where = ["user_id" => $this->session->id, "id"      => $study_id,
                        "deleted" => '0'];
                }

                $this->load->model('Study_model', 'study');
                $study = $this->study->getStudy($where);

                if ($study != false) {
                    $study        = $study[0];
                    # format country for report
                    $country_name = $study['country_name'];
                    $str          = "";
                    if (!empty($country_name)) {
                        $sector = unserialize($country_name);
                        foreach ($sector as $sec) {
                            $str .= $sec['country_name'] . "<br>";
                        }
                    }
                    $study['country_name'] = $str;
                    unset($study['country_id']);

                    # format sector for report
                    $sector = unserialize($study['sector']);
                    $str    = "";
                    foreach ($sector as $sec) {
                        $str .= $sec['sector_name'] . "<br>";
                    }
                    $study['sector'] = $str;
                    unset($study['sector_ids']);

                    /* # format theme for report
                      $theme = unserialize($study['theme']);
                      $str   = "";
                      foreach ($theme as $sec) {
                      $str .= $sec['theme_name'] . "<br>";
                      }
                      $study['theme'] = $str;
                      unset($study['theme_ids']);
                     */
                    # format tools for report
                    $tools = $study['tools'];
                    $str   = "";
                    if (!empty($tools)) {
                        $tools = unserialize($study['tools']);
                        foreach ($tools as $sec) {
                            $str .= $sec['method_name'] . "<br>";
                        }
                    }
                    $study['tools'] = $str;
                    unset($study['tools_ids']);

                    # format collaborators for report
                    $collaborators = $study['collaborators'];
                    $str           = "";
                    if (!empty($collaborators)) {
                        $collaborators = unserialize($study['collaborators']);
                        foreach ($collaborators as $sec) {
                            $str .= $sec['agency_name'] . "<br>";
                        }
                    }
                    $study['collaborators'] = $str;
                    unset($study['collaborators_ids']);

                    # format fund_source for collaboration type
                    $collaboration_type = $study['collaboration_type'];
                    $str                = "";
                    if (!empty($collaboration_type)) {
                        $collaboration_type = unserialize($study['collaboration_type']);
                        foreach ($collaboration_type as $sec) {
                            $str .= $sec . "<br>";
                        }
                    }
                    $study['collaboration_type'] = $str;
                    // unset($study['collaboration_type']);

                    $currency_code = $study['currency_code'];
                    if ($currency_code == '0') {
                        $study['currency_code'] = "";
                    }

                    # format fund_source for report
                    $fund_source = $study['fund_source'];
                    $str         = "";
                    if (!empty($fund_source)) {
                        $fund_source = unserialize($study['fund_source']);
                        foreach ($fund_source as $sec) {
                            $str .= $sec . "<br>";
                        }
                    }
                    $study['fund_source'] = $str;
                    unset($study['fund_source_id']);

                    # format human_resource for report
                    $human_resource = $study['human_resource'];
                    $str            = "";
                    if (!empty($human_resource)) {
                        $human_resource = unserialize($study['human_resource']);
                        foreach ($human_resource as $sec) {
                            $str .= $sec . "<br>";
                        }
                    }
                    $study['human_resource'] = $str;
                    unset($study['human_resource_id']);

                    $title = "View Study";
                    $this->load->view('dashboard/view', compact("study", "title"));
                }
                else {
                    redirect(site_url("dashboard"));
                }
            }
        }
    }

    public function edit() {
        if ($this->session->logged_in) {
            $study_id = $this->uri->segment(3, null);
            if ($study_id == null || empty($study_id)) {
                redirect(site_url("dashboard"));
            }
            else {
                $this->showEditFormPage($study_id);
            }
        }
    }

    private function showEditFormPage($study_id) {
        if ($this->session->logged_in) {
            $this->unsetOtherData();
            $title = "Edit Study";
            $this->load->helper('form');
            $this->load->model('Sector_model', 'sector');
            $this->load->model('Theme_model', 'theme');
            $this->load->model('Method_model', 'method');
            $this->load->model('Currency_model', 'currency');
            $this->load->model('Start_model', 'start');
            $this->load->model('End_model', 'end');
            $this->load->model('Status_model', 'status');
            $this->load->model('Agency_model', 'agency');
            $this->load->model('Study_model', 'study');
            $this->load->model('Country_model', 'country');

            $agencies   = $this->agency->getAgency();
            $statuses   = $this->status->getStatus();
            $ends       = $this->end->getEnd();
            $starts     = $this->start->getStart();
            $currencies = $this->currency->getCurrency();
            $sectors    = $this->sector->getSector();
            $methods    = $this->method->getMethod();
            $themes     = $this->theme->getTheme();
            $countries  = $this->country->getCountry();

            if ($this->session->role == "1") {
                $where = ["id" => $study_id, "deleted" => '0'];
            }
            else {
                $where = ["user_id" => $this->session->id, "deleted" => '0', "id" => $study_id];
            }

            $study = $this->study->getStudy($where);

            if ($study != false) {
                $study = $study[0];
                if (!empty($study['sector_ids'])) {
                    $study['sector_ids'] = unserialize($study['sector_ids']);
                }

                if (!empty($study['country_id'])) {
                    $study['country_id'] = unserialize($study['country_id']);
                }

                if (!empty($study['tools_ids'])) {
                    $study['tools_ids'] = unserialize($study['tools_ids']);
                }

                if (!empty($study['collaborators_ids'])) {
                    $study['collaborators_ids'] = unserialize($study['collaborators_ids']);
                }

                if (!empty($study['collaboration_type_id'])) {
                    $study['collaboration_type_id'] = unserialize($study['collaboration_type_id']);
                }

                if (!empty($study['fund_source_id'])) {
                    $study['fund_source_id'] = unserialize($study['fund_source_id']);
                }

                if (!empty($study['human_resource_id'])) {
                    $study['human_resource_id'] = unserialize($study['human_resource_id']);
                }
            }

            // print_r($study);
            $this->load->view('dashboard/edit', compact("countries", "study", "title", "agencies", "sectors", "themes", "methods", "currencies", "ends", "starts", "statuses"));
        }
    }

    public function addStudy() {
        # If the user is logged in the perform the following operations
        if ($this->session->logged_in) {
            # check if the post request contains and element named "addStudy"
            $addStudy = $this->input->post('addStudy');

            if (isset($addStudy)) {
                # load the form validation library
                $this->load->library('form_validation');

                # get the validation rules
                # add the country option to the validation rule
                $conf = $conf = $this->getValidationRules();
                # set the validtion in the form
                $this->form_validation->set_rules($conf);
                # if the validation rules fail
                if ($this->form_validation->run() == false) {
                    # set session items
                    $this->setOtherData();
                    # show the errors on the page
                    $this->showAddFormPage();
                    // echo validation_errors();
                }
                else {
                    # unset session items
                    $this->unsetOtherData();
                    # prepare an array to store in the data
                    $study_data = $this->prepareStudyData();

                    // print_r($study_data);
                    // # write the data in the database
                    $response = $this->createStudy($study_data);
                    // # if the data is written in the databasem, then redirect
                    if ($response != false) {
                        redirect(site_url('dashboard'));
                    }
                }
            }
            else {
                # show the add study form
                $this->showAddFormPage();
            }
        }
    }

    private function getValidationRules() {
        return [
            ['field' => 'title', 'label' => 'Study Title', 'rules' => 'required|min_length[3]'],
            ['field' => 'country[]', 'label' => 'Country', 'rules' => 'required'],
            ['field' => 'other_country', 'label' => 'Other Country(ies)', 'rules' => 'min_length[3]'],
            ['field' => 'other_status', 'label' => 'Other Study Status', 'rules' => 'min_length[3]'],
            ['field' => 'sub_location', 'label' => 'Sub National Location', 'rules' => 'min_length[3]'],
            ['field' => 'sector[]', 'label' => 'Sector', 'rules' => 'required'],
            ['field' => 'other_sector', 'label' => 'Other Sector', 'rules' => 'min_length[30]'],
            //['field' => 'theme[]', 'label' => 'Theme', 'rules' => 'required'],
            //['field' => 'other_theme', 'label' => 'Other Theme', 'rules' => 'min_length[3]'],
            ['field' => 'objectives', 'label' => 'Study Objectives', 'rules' => 'required|min_length[3]'],
            ['field' => 'tools[]', 'label' => 'Method And Tools', 'rules' => 'required'],
            ['field' => 'other_tools', 'label' => 'Other Tools', 'rules' => 'min_length[3]'],
            ['field' => 'study_status', 'label' => 'Study Status', 'rules' => 'required'],
            ['field' => 'other_currency', 'label' => 'Other Currency', 'rules' => 'min_length[3]'],
            // ['field' => 'budget', 'label' => 'Currency', 'rules' => 'required'],
            ['field' => 'amount', 'label' => 'Amount', 'rules' => 'numeric'],
            ['field' => 'fund_source[]', 'label' => 'Funding Source', 'rules' => 'required'],
            ['field' => 'other_fund', 'label' => 'External funding source used','rules' => 'min_length[3]'],
            ['field' => 'human_resource[]', 'label' => 'Human Resource', 'rules' => 'required'],
            ['field' => 'collaboration_radio[]', 'label' => 'Other Collaborators used','rules' => 'required'],
            ['field' => 'start_date', 'label' => 'Start Date', 'rules' => 'required'],
            ['field' => 'end_date', 'label' => 'End Date', 'rules' => 'required'],
            ['field' => 'contact_name', 'label' => 'Contact Name', 'rules' => 'required'],
            ['field' => 'contact_email', 'label' => 'Contact Email', 'rules' => 'required|valid_email'],
            ['field' => 'other_collaborators', 'label' => 'Other Collaboration Agencies name','rules' => 'min_length[3]'],
            ['field' => 'amount_2016', 'label' => 'Budget for 2016', 'rules' => 'numeric']
        ];
    }

    public function update() {
        if ($this->session->logged_in) {
            $editStudy = $this->input->post('editStudy');
            if (isset($editStudy)) {
                $this->load->library('form_validation');
                $conf = $this->getValidationRules();
                $this->form_validation->set_rules($conf);
                if ($this->form_validation->run() != false) {
                    $study_data = $this->prepareStudyData();
                    $id         = $this->input->post('study_identification', true);

                    # added logic for admin to be able to submit studies
                    if ($this->session->role == "1") {
                        $where = [
                            'id'      => $id,
                            'deleted' => '0',
                        ];
                    }
                    else {
                        $where = [
                            'id'      => $id,
                            'user_id' => $this->session->id,
                            'deleted' => '0',
                        ];
                    }

                    $this->load->model('Study_model', 'study');
                    $response = $this->study->updateStudy($where, $study_data);
                    if ($response != false) {
                        redirect(site_url('dashboard'));
                    }
                }
                else {
                    $this->showEditFormPage();
                }
            }
        }
    }

    private function createStudy($data = []) {
        if ($this->session->logged_in) {
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
    }

    private function prepareStudyData() {
        if ($this->session->logged_in) {
            # load the models
            $this->load->model('Sector_model', 'sector');
            //$this->load->model('Theme_model', 'theme');
            $this->load->model('Method_model', 'method');
            $this->load->model('Agency_model', 'agency');
            $this->load->model('Status_model', 'status');
            $this->load->model('Currency_model', 'currency');
            $this->load->model('Start_model', 'start');
            $this->load->model('End_model', 'end');
            $this->load->model('Country_model', 'country');
            // $data['description']   = $this->input->post('description', true);
            $data['title']         = $this->input->post('title', true);
            $data['sub_location']  = $this->input->post('sub_location', true);
            $data['contact_name']  = $this->input->post('contact_name', true);
            $data['contact_email'] = $this->input->post('contact_email', true);
            $data['agency_id']     = $this->session->agency_id;
            $data['agency_name']   = $this->session->agency_name;
            $data['user_id']       = $this->session->id;
            $data['saved_form']    = "1";
            # setup the country
            $post_country          = $this->input->post('country', true);
            $country_array         = ["id", $post_country];
            $countries             = $this->country->getCountryIn($country_array);
            $data['country_name']  = serialize($countries);
            $data['country_id']    = serialize($country_array);
            $data['other_country'] = $this->input->post('other_country', true);
            $data['deleted']       = "0";

            # setup the sector related data
            $post_sector          = $this->input->post('sector', true);
            $sector_array         = ["id", $post_sector];
            $sectors              = $this->sector->getSectorIn($sector_array);
            $data['sector_ids']   = serialize($post_sector);
            $data['sector']       = serialize($sectors);
            $data['other_sector'] = $this->input->post('other_sector', true);

            # setup the theme related data
            /* $post_theme          = $this->input->post('theme', true);
              $theme_array         = ['id', $post_theme];
              $themes              = $this->theme->getThemeFromSector($theme_array);
              $data['theme_ids']   = serialize($post_theme);
              $data['theme']       = serialize($themes);
              $data['other_theme'] = $this->input->post('other_theme', true);

             */

            $data['objectives'] = $this->input->post('objectives', true);

            # setup the tools and methods data
            $post_tools          = $this->input->post('tools', true);
            $tools_array         = ['id', $post_tools];
            $tools               = $this->method->getToolsIn($tools_array);
            $data['tools_ids']   = serialize($post_tools);
            $data['tools']       = serialize($tools);
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
                $data['other_collaborators']  = $this->input->post('other_collaborators', TRUE); //
                if (!isset($data['collaborators_ids']) || empty($data['collaborators_ids']))
                    $data['collaborators_ids']    = null;
                if (!isset($data['collaborators']) || empty($data['collaborators']))
                    $data['collaborators']        = null;
            }

            if (isset($collaboration_radio) && in_array("0", $collaboration_radio)) {
                $data['collaborators_ids']    = null;
                $data['collaborators']        = null;
                $data['collaboration_type'][] = "None";
            }
            $data['collaboration_type']    = serialize($data['collaboration_type']);
            $data['collaboration_type_id'] = serialize($collaboration_radio);



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

            $rgister_2016 = $this->input->post('amount_2016', TRUE);
            if (!empty($rgister_2016)) {
                $data['amount_2016'] = intval($this->input->post('amount_2016', TRUE));
            }
            else {
                $data['amount_2016'] = 0;
            }

            # setup funding source detail
            $post_fund              = $this->input->post('fund_source', true);
            $data['fund_source_id'] = serialize($post_fund);
            if (count($post_fund) == 1) {
                if ($post_fund[0] == '1') {
                    $data['fund_source'] = serialize(["Internal"]);
                }
                else {
                    $data['fund_source'] = serialize(["External"]);
                }
            }
            else {
                $data['fund_source'] = serialize(["Internal", "External"]);
            }
            $data['other_fund'] = $this->input->post('other_fund', true);

            # setup human_resource detail
            $post_fund                 = $this->input->post('human_resource', true);
            $data['human_resource_id'] = serialize($post_fund);
            if (count($post_fund) == 1) {
                if ($post_fund[0] == '1') {
                    $data['human_resource'] = serialize(["Internal"]);
                }
                else {
                    $data['human_resource'] = serialize(["External"]);
                }
            }
            else {
                $data['human_resource'] = serialize(["Internal", "External"]);
            }
            // $data['other_hr'] = $this->input->post('other_hr', true);
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
            // print_r($data);
        }
    }

    private function setOtherData() {
        if ($this->session->logged_in) {
            $set_items = [
                "other_sector", "other_theme", "other_tools", "other_status",
                "other_study_status", "other_fund", "other_collaborators",
                "other_country", "other_currency", "other_start_date", "other_end_date",
            ];
            $this->setSessionItems($set_items);
        }
    }

    private function unsetOtherData() {
        if ($this->session->logged_in) {
            $unset_items = [
                "other_sector", "other_theme", "other_tools", "other_status",
                "other_study_status", "other_fund", "other_collaborators",
                "other_country", "other_currency", "other_start_date", "other_end_date",
            ];
            $this->unsetSessionItems($unset_items);
        }
    }

    # unset individual session items

    private function unsetSessionItems($session_item = []) {
        if (count($session_item) > 0) {
            foreach ($session_item as $item) {
                if ($this->session->has_userdata($item)) {
                    $this->session->unset_userdata($item);
                }
            }
        }
    }

    # set individual session items

    private function setSessionItems($session_item = []) {
        if (count($session_item) > 0) {
            foreach ($session_item as $item) {
                if (null != ($this->input->post($item))) {
                    $this->session->set_userdata([$item => $this->input->post($item)]);
                }
            }
        }
    }

    # Updated code
    # Earlier the system assumed that users current country is country for the study.
    # Added a fix where the user can multiselect countries in the form as one study can span over many countries.
    # adding model and data for the add study form

    private function showAddFormPage() {
        if ($this->session->logged_in) {
            $this->unsetOtherData();
            $title = "Add Study";
            $this->load->helper('form');
            $this->load->model('Sector_model', 'sector');
            $this->load->model('Theme_model', 'theme');
            $this->load->model('Method_model', 'method');
            $this->load->model('Currency_model', 'currency');
            $this->load->model('Start_model', 'start');
            $this->load->model('End_model', 'end');
            $this->load->model('Status_model', 'status');
            $this->load->model('Agency_model', 'agency');
            $this->load->model('Country_model', 'country');

            $countries  = $this->country->getCountry();
            $agencies   = $this->agency->getAgency();
            $statuses   = $this->status->getStatus();
            $ends       = $this->end->getEnd();
            $starts     = $this->start->getStart();
            $currencies = $this->currency->getCurrency();
            $sectors    = $this->sector->getSector();
            $methods    = $this->method->getMethod();
            $themes     = $this->theme->getTheme();
            $this->load->view('dashboard/addStudy', compact(
                    "title", "agencies", "sectors", "themes", "methods", "currencies", "ends", "starts", "statuses", "countries")
            );
        }
    }

    /**
     * this method provides the search functionality
     * @return void
     * @author Prakhar
     */
    public function search() {
        if ($this->session->logged_in) {
            $search = $this->input->post('search_item', true);
            if (isset($search) && strlen($search) > 2) {
                $studies = $this->getSearchResults(trim($search));
                $this->showDashboard($studies);
            }
            else {
                $studies = $this->getDashboardData();
                $this->showDashboard($studies, "Please provide at least 3 characters for search");
            }
        }
    }

    private function getSearchResults($search) {
        $this->load->model('Study_model', 'study');
        if ($this->session->role == "0") {
            $where = ["user_id" => $this->session->id, 'deleted' => '0'];
        }
        else {
            $where = ['deleted' => '0'];
        }

        // # full text search option
        // $studies = $this->study->getFreeTextSearchResults($where, $search);
        # dont kill me for this, full text search does not work on godaddy mysql sever
        # mans gonna do what he gotta do
        $words = explode(" ", $search);

        $studies = $this->study->getFakedFullTextResults($where, $words);
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

    private function getDashboardData() {
        if ($this->session->role == "0") {
            $where = ["user_id" => $this->session->id, 'deleted' => '0', 'saved_form' => '1'];
        }
        else {
            $where = ['deleted' => '0', 'saved_form' => '1'];
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
        $title = "Dashboard";
        $this->load->view('dashboard/dashboard', compact("title", "studies", "search_error"));
    }

    public function download() {

        if ($this->session->logged_in) {
            $report_type = $this->uri->segment(3, null);
            $this->load->model('Study_model', 'study');
            $this->load->helper('download');
            if ($report_type == "all") {
                if ($this->session->role == '1') {
                    $where = [];
                }
                else {
                    $where = ["a.user_id" => $this->session->id];
                }
                $data    = $this->study->downloadReport($where);
                $data    = $this->convertRowsToArray($data);
                $name    = 'report' . date("Y-m-d-H-m-i") . '.csv';
                $headers = $fp      = fopen($name, 'w');
                // fputcsv($fp, explode(";", 'id ; title; objectives; country_name; other_country; sub_location; agency_name;  sector; other_sector; theme; other_theme ; contact_name; contact_email;  tools; other_tools; collaborators; study_status; other_status; currency_code; amount; fund_source; other_fund; human_resource; other_hr; start_date; end_date; timestamp' ),";");
                fputcsv($fp, explode(";", 'id ; title; objectives; country_name; other_country; sub_location; agency_name;  sector; other_sector; theme; other_theme ; contact_name; contact_email;  tools; other_tools; collaborators; study_status; other_status; currency_code; amount; fund_source; other_fund; human_resource;  start_date; end_date; timestamp; budget_2016; submitted_by'), ";");

                foreach ($data as $fields) {
                    fputcsv($fp, $fields, ";"); //fputcsv(fp, fields, delimiter, enclosure)
                }
                fclose($fp);

                force_download($name, null);

                // unlink(ciurl$name);
            }
        }
    }

    public function convertRowsToArray($collection) {
        $data = [];
        foreach ($collection as $row) {
            $temp = $row;
            unset($row);

            if (!empty($temp['country_name'])) {
                $country_name         = unserialize($temp['country_name']);
                $temp['country_name'] = "";
                foreach ($country_name as $arr) {
                    $temp['country_name'] .= $arr['country_name'] . ",";
                }
                unset($country_name);
            }
            
            if (!empty($temp['sector'])) {
                $sector         = unserialize($temp['sector']);
                $temp['sector'] = "";
                foreach ($sector as $arr) {
                    $temp['sector'] .= $arr['sector_name'] . ",";
                }
                unset($sector);
            }

            if (!empty($temp['theme'])) {
                $theme         = unserialize($temp['theme']);
                $temp['theme'] = "";
                foreach ($theme as $arr) {
                    $temp['theme'] .= $arr['theme_name'] . ",";
                }
                unset($theme);
            }

            if (!empty($temp['tools'])) {
                $tools         = unserialize($temp['tools']);
                $temp['tools'] = "";
                foreach ($tools as $arr) {
                    $temp['tools'] .= $arr['method_name'] . ",";
                }
                unset($tools);
            }

            if (!empty($temp['collaborators'])) {
                $collaborators         = unserialize($temp['collaborators']);
                $temp['collaborators'] = "";
                foreach ($collaborators as $arr) {
                    $temp['collaborators'] .= $arr['agency_name'] . ",";
                }
                unset($collaborators);
            }

            // logic change to how the funding source was calculated
            if (!empty($temp['fund_source_id'])) {
                $funders             = unserialize($temp['fund_source_id']);
                $temp['fund_source'] = "";
                foreach ($funders as $arr) {
                    if ($arr == 1) {
                        $funder = "Internal to your agency";
                    }
                    else if ($arr == 2) {
                        $funder = "External to your agency";
                    }
                    else {
                        $funder = "Another AKDN agency";
                    }

                    $temp['fund_source'] .= $funder . ",";
                }
                unset($funders, $funder, $arr);
            }

            // fixes in the code for human resource
            if (!empty($temp['human_resource_id'])) {
                $human_resource         = unserialize($temp['human_resource_id']);
                $temp['human_resource'] = "";
                foreach ($human_resource as $arr) {
                    if ($arr == 1) {
                        $hr = "Internal to your agency";
                    }
                    else if ($arr == 2) {
                        $hr = "External to your agency";
                    }
                    else {
                        $hr = "Another AKDN agency";
                    }
                    $temp['human_resource'] .= $hr . ",";
                }
                unset($human_resource,$hr,$arr);
            }
            
            unset($temp['fund_source_id'],$temp['human_resource_id']);
            $data[] = $temp;
        }
        return $data;
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
