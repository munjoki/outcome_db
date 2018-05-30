<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller {

    function __construct() {
        parent::__construct();

        // check if the user is logged in properly, else redirect to the login page
        if (!$this->session->has_userdata('logged_in') || !$this->session->logged_in) {
            $this->session->sess_destroy();
            $message = "You have logged out or your session has expired. Please login again";
            $title   = "Login";
            $this->load->view('auth/authentication_login', compact("title", "message"));
        }

        // check if the user is an admin, if not then redirect to the dashboard
        if ($this->session->role != "1") {
            redirect(site_url('dashboard'));
        }
    }

    /**
     * function to show the list of users
     */
    public function index() {
        $this->load->model("User_model", "user");
        $users = $this->user->getUser();
        $title = "Users";
        $this->load->view("dashboard/users", compact("title", "users"));
    }

    /**
     * function to show edit password form
     */
    public function show() {
        # load the form helper
        $this->load->helper('form');
        # load the User_model
        $this->load->model("User_model", "user");
        
        $title  = "Change Password";
        $userId = $this->uri->segment(3);
        $user   = $this->user->getUser(["id" => $userId]);
        $user   = $user[0];
        
        # load the view
        $this->load->view("dashboard/show-password-form", compact("title", "userId", "user"));
    }

    /**
     * function to change the password
     */
    public function change_password() {

        # load the form validation library
        $this->load->library('form_validation');

        # set the validation rules
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_rules("confirm_password", "Confirmed Password", "required|matches[password]");

        # run the validation rules
        if ($this->form_validation->run() == false) {

            # if the validation fails then show the change password form with error message
            $title  = "Change Password";
            $userId = $this->input->post("userId");
            $this->load->model("User_model", "user");
            $user   = $this->user->getUser(["id" => $userId]);
            $this->load->helper('form');
            $this->load->view("dashboard/show-password-form", compact("title", "userId", "user"));
        }
        else {
            # get input variables
            $userId   = $this->input->post("userId");
            $password = $this->input->post("password");

            # load the User_model
            $this->load->model("User_model", "user");

            # query data
            $data  = ["password" => password_hash($password, PASSWORD_BCRYPT)];
            $where = ["id" => $userId];

            # update the password
            if ($this->user->updateUser($where, $data)) {
                redirect(site_url("user"));
            }
        }
    }

}
