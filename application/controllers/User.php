<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User Controller
 * @author Artfill
 */
class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'email', 'form', 'url'));
        $this->load->library(array('email', 'form_validation', 'session'));
        $this->load->model(array('user_model'));
        // require: check login
    }

    /**
    * Display registration form
    */
    public function register_form()
    {
        $this->load->view('site/user/register');
    }

    /*
     * Function for basic register information
     */
    public function register()
    {
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        if (valid_email($email)) {
            $condition = array('email' => $email);
            if ($this->user_model->check_exist(USERS, $condition)) {
                // require: return message 'email already exists'
            } else {
                $verify_code = $this->get_rand_str('10');
                $this->user_model->insert_user($username, $email. $password, $verify_code);
                // might: save user data to session to login after register?
                $registered_user=$this->user_model->get_all_details(USER, $condition)->row();
                $this->send_verify_email($registered_user);
                // require: return message 'successfully registered'
            }
        } else {
        }
        // require: return message 'invalid email id'
    }

    /**
    * Function for saving user profile modification
    * @param String seourl
    */
    public function edit_user($seourl)
    {
    }

    /**
    * Function for sending verification email
    * @param Model user
    */
    public function send_verify_email($user='')
    {
        // $username=$user->username;
        // $email=$user->email;
        // $verify_code=$user->verify_code;
        // requireL send the email
        $this->email->from('chowkachun1@gmail.com', 'Your Name');
        $this->email->to('digit4free@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        $this->email->send();
        $this->output->append_output($this->email->print_debugger());
        // log_message('info', $this->email->print_debugger());
    }

    /*
     * Display user login form
     */
    public function login_form()
    {
        if ($this->session->userdata('artfill_session_user_name') != '') {
            log_message('info', 'found a session');
        } else {
            log_message('info', 'have not loginned yet');
            // require: redirect to base url if already loginned
            {
                //require: get where to redirect back add to data of form
                $this->load->view('site/user/login');
            }
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
        if ($this->user_model->check_exist(USER, $condition)==true) {
            $userrow = $this->user_model->get_all_details(USER, $condition);
            // set session data
            $userdata = array(
                'artfill_session_user_id'    => $userrow->row()->id,
                'artfill_session_user_name'  => $userrow->row()->user_name,
                'artfill_session_user_email' => $userrow->row()->email,
                'artfill_session_user_role'  => $userrow->row()->role,
            );
            $this->session->set_userdata($userdata);
            // require: set cookie and update last login details
            redirect('/', 302);
        } else {
            // require: return message 'wrong account details'
            redirect('user/login', 302);
        }
    }

    /**
    * Log out from user session
    */
    public function logout()
    {
        $userdata = array(
            'artfill_session_user_id'    => '',
            'artfill_session_user_name'  => '',
            'artfill_session_user_email' => '',
            'artfill_session_user_role'  => '',
        );
        $this->session->unset_userdata($userdata);
        // require: delte cookie
        // require: return message 'successfully logout'
        redirect('/', 302);
    }
}
