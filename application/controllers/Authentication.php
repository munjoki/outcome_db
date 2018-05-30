<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Authentication extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *    method to handle login form
     */
    public function index()
    {
        $post = $this->input->post('login');
        if (isset($post)) {
            # load the helpers and the libraries
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('User_model', 'usermodel');
            # set the form validation rules
            $config = array(
                ['field' => 'email', 'label' => 'Email address', 'rules' => 'required|valid_email', 'errors' => ['required' => "You have not provided %s", 'valid_email' => "Invalid Email Format"]],
                ['field' => 'password', 'label' => 'Password', 'rules' => 'required', 'errors' => ['required' => 'You must provide a %s.']],
            );

            # check if the rules are validated
            $this->form_validation->set_rules($config);
            # run the validation rules
            if ($this->form_validation->run() == false) {
                $this->showLoginForm();
            } else {
                # get the active user from the database
                $email    = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $user     = $this->usermodel->getUser(['email' => $email]);

                if ($user != false) {
                    $user = $user[0];
                    if ($user['active'] == "1") {
                        if (password_verify($password, $user['password'])) {
                            # setup the user data to be set n the session
                            $userdata = [
                                "id"           => $user['id'],
                                "email"        => $user['email'],
                                "logged_in"    => true,
                                "active"       => $user['active'],
                                "role"         => $user['role'],
                                "agency_id"    => $user['agency_id'],
                                "agency_name"  => $user['agency_name'],
                                "country_id"   => $user['country_id'],
                                "country_name" => $user['country_name'],
                            ];

                            # set the data in the session
                            $this->session->set_userdata($userdata);
                            redirect('dashboard');
                        } else {
                            $this->showLoginErrorForm("Invalid Username / Password");
                        }
                    } else {
                        $this->showLoginErrorForm("Your account is not active. Please activate you account and try again.");
                    }
                } else {
                    $this->showLoginErrorForm("Invalid user name and password. Please try again.");
                }
            }
        } else {
            $this->showLoginForm();
        }
    }

    /**
     * Logout current session and go to the login page
     * @author Prakhar
     */
    public function logout()
    {
        $unset_items = ["id", "email", "logged_in", "active", "role", "agency_id", "agency_name", "country_id", "country_name"];
        $this->unsetSessionItems($unset_items);
        $this->session->sess_destroy();
        $this->showLoginForm();
    }

    # unset individual session items
    private function unsetSessionItems($session_item = [])
    {
        if (count($session_item) > 0) {
            foreach ($session_item as $item) {
                if ($this->session->has_userdata($item)) {
                    $this->session->unset_userdata($item);
                }
            }
        }
    }

    /**
     *    method to handle the registration form
     */
    public function register()
    {
        $register = $this->input->post('register');
        if (isset($register) && $register === "Register") {
            # load the helpers and libraries
            $this->load->helper('form');
            $this->load->library('form_validation');

            # set the form validation rules
            $is_admin = $this->input->post('is_admin', true);
            $config   = $this->getRegistrationValidations();
            # check if the rules are validated
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == false) {

                if (isset($is_admin) && $is_admin == "iamanadmin") {
                    $this->showRegstrationForm($is_admin);
                } else {
                    $this->showRegstrationForm();
                }

            } else {
                # get the formatted data to be sored in the database
                $user = $this->formatRegistrationInput($is_admin);
                # create user
                $response = $this->createUser($user);
                if ($response != false) {
                    # read the message htm file
                    $this->load->helper('file');
                    $message = read_file('assets/mail/activate_account.html');

                    # set the email message content
                    $email_conf['from_email'] = "titus.karanja@akdn.org";
                    $email_conf['from_name']  = "AKDN MER Studies Administrator";
                    $email_conf['to']         = $user['email'];
                    $email_conf['subject']    = "AKDN MER Studies :: Activate your account";
                    $activation_url           = site_url('authentication/activateUser/') . "/" . $user['activation_token'] . "_" . $response;
                    $message   = str_replace("##activation_url##", $activation_url, $message);
                    $email_conf['message'] = str_replace("##surname##", ucwords($user['surname']),$message);

                    # check if the email id sent ?
                    $email_sent = $this->sendEmail($email_conf);
                    if ($email_sent) {
                        redirect('authentication/userCreated', 'refresh');
                    } else {
                        $this->showGeneralError("There was an error creating your account. Please try again");
                    }
                }
            }
        } else {
            $is_admin = $this->uri->segment(3, null);
            if (!empty($is_admin) && $is_admin == "iamanadmin") {
                $this->showRegstrationForm($is_admin);
            } else {
                $this->showRegstrationForm();
            }
        }
    }

    private function getRegistrationValidations()
    {
        return array(
            ['field' => 'email', 'label' => 'Email address', 'rules' => 'required|valid_email|is_unique[akdn_users.email]', 'errors' => ['required' => "You have not provided %s", 'valid_email' => "Invalid Email Format", 'is_unique' => "This %s already exists"]],
            ['field' => 'surname', 'label' => 'Surname', 'rules' => 'required|min_length[1]', 'errors' => ["required" => "Please provide %s", "min_length" => "Please provide atleast 1 character"]],
            ['field' => 'other_names', 'label' => 'Other Names', 'rules' => 'required|min_length[1]', 'errors' => ["required" => "Please provide %s", "min_length" => "Please provide atleast 1 character"]],
            ['field' => 'country', 'label' => 'Country', 'rules' => 'required', 'errors' => ['required' => 'You must Select a %s.']],
            ['field' => 'agency', 'label' => 'Agency', 'rules' => 'required', 'errors' => ['required' => 'You must Select an %s.']],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[8]', 'errors' => ['required' => 'You must provide a %s.']],
            ['field' => 'confirm_password', 'label' => 'Password Confirmation', 'rules' => 'required|min_length[8]|matches[password]', "errors" => ["matches" => "The Confirmed Password does not match the actual Password"]],
        );
    }
    /**
     * activate the user
     * @author Prakhar
     */
    public function activateUser()
    {
        # get the parameters from the url
        $activation_url = $this->uri->segment(3, null);

        # if there is no url then send an error
        if ($activation_url == null) {
            $this->showActivationError("Please provide a valid activation url");
        } else {

            $activation_url = explode("_", trim($activation_url));
            # if the url has both the token and user id
            if (count($activation_url) == 2) {
                $activation_token = $activation_url[0];
                $user_id          = $activation_url[1];
                # load user model
                $this->load->model('User_model', 'usermodel');
                # prepare the where clause
                $where = [
                    "id"               => $user_id,
                    "activation_token" => $activation_token,
                ];

                # get the user from the database
                $user = $this->usermodel->getUser($where);
                # if the user with that token exists
                if ($user !== false) {
                    $user  = $user[0];
                    $where = ["id" => $user['id']];
                    $data  = [
                        "activation_token" => null,
                        "active"           => '1',
                    ];
                    # further validations
                    if ($user['active'] == '1' || $user['activation_token'] == null) {
                        $this->showActivationError("The user is already activated. Please try to login using the link below");
                    } else {
                        # persist the user in the database and redirect to the success page
                        $result = $this->usermodel->updateUser($where, $data);

                        if ($result !== false) {
                            $this->showActivationSuccess("Please click on the link below to proceed to the login page and access the system.");
                        } else {
                            $this->showActivationError("Your account could not be activated. Please try again.");
                        }
                    }
                } else {
                    $this->showActivationError("Your account is already active.<br/>Please click on the link below to proceed to the login page and access the system.");
                }
            } else {
                $this->showActivationError("You have provided a wrong activation URL.<br/>Please make sure you have entered the correct activation URL");
            }
        }
    }

    /**
     * This method sends emails.
     * This configuration array passed has all information
     * @return boolean
     * @author Prakhar
     */
    private function sendEmail($email_conf = [])
    {
        if (empty($email_conf)) {
            return false;
        } else {
            $this->load->library('email');
            $this->email->from($email_conf['from_email'], $email_conf['from_name']);
            $this->email->to($email_conf['to']);
            $this->email->bcc('them@their-example.com');
            $this->email->subject($email_conf['subject']);
            $this->email->message($email_conf['message']);
            return $this->email->send();
        }
    }

    /**
     * this method creates a new user in the database
     * true on successful creation ; false on failure
     * @return boolean
     * @author Prakhar
     */
    private function createUser($user = [])
    {
        if (empty($user)) {
            return false;
        } else {
            $this->load->model('User_model', 'usermodel');
            $id = $this->usermodel->add($user);
            if (is_numeric($id) && $id >= 0) {
                return $id;
            } else {
                return false;
            }
        }
    }

    /**
     * this method forms the user input to be registered in the database
     * @return array
     * @author Prakhar
     */
    private function formatRegistrationInput($is_admin = null)
    {
        # load the necessary model
        $this->load->model('Country_model', 'country');
        $this->load->model('Agency_model', 'agency');

        #  load the string helper to generate activation_token
        $this->load->helper('string');
        # prepare the input array using the input post parameter
        $user['email']      = $this->input->post('email', true);
        $user['surname']    = $this->input->post('surname', true);
        $user['firstname']  =  $this->input->post('other_names', TRUE);
        $user['country_id'] = $this->input->post('country', true);
        $user['agency_id']  = $this->input->post('agency', true);
        $user['password']   = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $user['active']     = '0';
        if (!empty($is_admin) && $is_admin == "iamanadmin") {
            $user['role'] = '1';
        } else {
            $user['role'] = '0';
        }

        $country_name             = $this->country->getCountryName($user['country_id']);
        $user['country_name']     = $country_name;
        $agency_name              = $this->agency->getAgencyName($user['agency_id']);
        $user['agency_name']      = $agency_name;
        $user['activation_token'] = random_string('alnum', '80');

        return $user;

    }

    # function to register show registration page
    public function showRegstrationForm($is_admin = null)
    {
        $title = "Sign Up";
        $this->load->model('Country_model', 'country');
        $this->load->model('Agency_model', 'agency');
        $this->load->helper('form');
        $countries = $this->country->getCountry();
        $agencies  = $this->agency->getAgency();
        $this->load->view('auth/authentication_register', compact("title", "is_admin", "countries", "agencies"));
    }

    public function reset_password()
    {
        $title = "Reset Password";
        $this->load->helper('form');
        $this->load->view('auth/reset_password', compact("title"));
    }

    public function sendPasswordToken()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->reset_password();
        } else {
            $email = $this->input->post('email', true);
            $this->load->model("User_model", "user");
            $where = ['email' => trim($email)];
            $user  = $this->user->getUser($where);
            if ($user != false) {
                $user = $user[0];
                if ($user['active'] == '0') {
                    $this->showGeneralError("You have not activated your account.<br>Please follow the instructions we sent to your registered email address to activate your account.<br/><br/>You will be able to change your password after activating your account.");
                } 
                else if ($user['active'] == '1' && !empty($user['temp_password'])) {
                    $this->showGeneralMessage("Message", "We have sent a link to reset your password to your registered email address.<br/>Please follow the instructions in the email to reset your password.");
                } 
                else if ($user['active'] == '1' && empty($user['temp_password'])) {

                    # read the message htm file
                    $this->load->helper('file');
                    $this->load->helper('string');
                    $token    = random_string('alnum', '80');
                    $data     = ["temp_password" => $token];
                    $response = $this->user->updateUser($where, $data);
                    if ($response) {

                        $message = read_file('assets/mail/reset_password.html');
                        # set the email message content
                        $email_conf['from_email'] = "titus.karanja@akdn.org";
                        $email_conf['from_name']  = "AKDN MER Studies Administrator";
                        $email_conf['to']         = $user['email'];
                        $email_conf['subject']    = "AKDN MER Studies :: Reset your Password";
                        $reset_url                = site_url('authentication/changePassword/') . "/" . $token . "_" . $user['email'];
                        $reset_url                = str_replace("@", "-", $reset_url);
                        $message    = str_replace("##reset_password_code##", $reset_url, $message);
                        $email_conf['message'] = str_replace("##surname##", ucwords($user['surname']),$message);

                        // echo $reset_url;
                        # check if the email id sent ?
                        $email_sent = $this->sendEmail($email_conf);
                        if ($email_sent) {
                            $this->showGeneralMessage("Message", "We have sent a link to reset your password to your registered email address.<br/>Please follow the instructions in the email to reset your password");
                        } else {
                            $this->showGeneralError("There was an error sending you an email. Please try again");
                        }
                    } else {
                        $this->showGeneralError("There was an error resetting your password. Please try again");
                    }
                }
            } else {
                $this->showGeneralError("This Email address provided does not exist in the system. Please provide the valid email address that was used during registration.");
            }
        }
    }

    public function changePassword()
    {
        $get_data = $this->uri->segment(3, null);
        if (empty($get_data)) {
            $this->showGeneralError("Invalid Password Reset URL.");
        } else {
            $get_data = explode("_", $get_data);
            $token    = $get_data[0];
            $email    = str_replace("-", "@", $get_data[1]);

            if (empty($token) || empty($email)) {
                $this->showGeneralError("Invalid Password Reset URL.");
            } else {
                $this->load->model('User_model', 'user');
                $where = ['temp_password' => $token, 'email' => $email];
                $user  = $this->user->getUser($where);
                if ($user == false) {
                    $this->showGeneralError("Invalid Password Reset URL");
                } else {
                    $user = $user[0];
                    $this->showChangePasswordPage($user);
                }
            }
        }
    }

    public function processPasswordChange()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirmed Password', 'required|matches[password]|min_length[8]');

        $id    = $this->input->post('id', true);
        $email = $this->input->post('email', true);

        if (empty($id) || empty($email)) {
            redirect('authentication/reset_password');
        } else {
            $this->load->model('User_model', 'user');
            $user = $this->user->getuser(["id" => $id, "email" => $email]);

            if ($this->form_validation->run() == false) {
                $user = $user[0];
                $this->showChangePasswordPage($user);
            } else {
                $password = $this->input->post('password', true);
                $data     = [
                    "password"      => password_hash($password, PASSWORD_BCRYPT),
                    "temp_password" => null,
                ];
                $where = [
                    "id"     => $id,
                    "email"  => $email,
                    "active" => '1',
                ];

                $response = $this->user->updateUser($where, $data);
                if ($response != false) {
                    $this->showGeneralMessage("Password Changed", "Your password has been changed successfully. Please proceed to the home page to login.");
                } else {
                    $this->showGeneralError("We are not able to change your password now. Please try again later.");
                }
            }
        }
    }

    private function showChangePasswordPage($user)
    {
        $email = $user['email'];
        $id    = $user['id'];
        $title = "Change Your Password";
        $this->load->helper('form');
        $this->load->view('auth/change_password', compact("title", "email", "id"));
    }

    private function showActivationError($message)
    {
        $title = "Error";
        $this->load->view('auth/authentication_error', compact("title", "message"));
    }

    private function showActivationSuccess($message)
    {
        $title = "User Activation Successful";
        $this->load->view('auth/authentication_success', compact("title", "message"));
    }

    public function userCreated()
    {
        $title = "Account Created";
        $this->load->view('auth/authentication_user_created', compact("title"));
    }

    private function showLoginErrorForm($message)
    {
        $title = "Login";
        $this->load->helper('form');
        $this->load->view('auth/authentication_login', compact("title", "message"));
    }

    private function showLoginForm()
    {
        $title = "Login";
        $this->load->helper('form');
        $this->load->view('auth/authentication_login', compact("title"));
    }

    private function showGeneralError($message)
    {
        $title = "Error";
        $this->load->view('auth/authentication_error', compact("title", "message"));
    }

    private function showGeneralMessage($title, $message)
    {
        $this->load->view('auth/message', compact("title", "message"));
    }
}
