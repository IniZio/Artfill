<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User Controller
 */
class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'email', 'form', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('user_model'));
    }
    /*
     * Function for basic register information
     */
    public function insert_user()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        if (valid_email($email)) {
            $condition = array('email' => $email);
            if ($this->user_model->check_exist(USERS, $condition)) {
                // require: return message 'email already exists'
            } else {
                // require: add user to database
                // require: return message 'successfully registered'
            }
        } else {
            ;
        }
        // require: return message 'invalid email id'
    }

    public function edit_user($seourl)
    {
    }

    public function send_verify_email()
    {

    }

    /*
	* Form of user login
    */
    public function login_form()
    {	
    	// require: redirect to base url if already loginned
    	{
    		//require: get where to redirect back add to data of form
    		$this->load->view('user/login');
    	}
    }

    /*
     * Function for login user, set user session
     */
    public function login()
    {
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        // check if user exists
        $condition = '(email = \'' . addslashes($email) . '\' OR user_name = \'' . addslashes($username) . '\') AND password=\'' . $password . '\' AND status=\'Active\'';
        if ($this->user_model->check_exist(USER, $condition)) {
            $userrow = $this->user_model->get_all_details(USER, $condition);
            // set session data
            $userdata = array(
                'session_user_id'    => $userrow->row->id,
                'session_user_name'  => $userrow->row->user_name,
                'session_user_email' => $userrow->row->email,
                'session_user_role'  => $userrow->row->role,
            );
            $this->session->set_userdata($userdata);
            // require: set cookie and update last login details
            redirect('/', 302);
        } else {
        	// require: return message 'wrong account details'
        	redirect('login',302);
        }
    }

    public function logout_user()
    {
        //require: reset everything in session including google, facebook
    }
}
