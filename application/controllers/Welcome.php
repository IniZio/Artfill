<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        // $username = '85265530162'; // Your number with country code, ie: 34123456789
        // $nickname = ''; // Your nickname, it will appear in push notifications
        // $debug    = true; // Shows debug log, this is set to false if not specified
        // $log      = true; // Enables log file, this is set to false if not specified

        // // Create a instance of WhatsProt class.
        // $w = new WhatsProt($username, $nickname, $debug, $log);
        // $w->connect(); // Connect to WhatsApp network
        // $w->loginWithPassword($password); // logging in with the password we got!
        // // Create an instance of Registration.
        // // $r = new Registration($username, $debug);

        // // $w->codeRequest('voice');

    }

    public function index()
    {
        redirect('/welcome', 302);
        // $this->load->view('welcome_message');
        // redirect('index.php', 302);
    }

    /*
     *    redirects back to wordpress welcome page
     */
    public function welcome()
    {
        $username = "85265530162";
        $nickname = "digit";
        $password = "UupZyRA+lUxnb0AEG5ItXd0fkWs="; // The one we got registering the number
        $debug = true;

        // Create a instance of WhastPort.
        $w = new WhatsProt($username, $nickname, $debug);

        $w->connect(); // Connect to WhatsApp network
        $w->loginWithPassword($password); // logging in with the password we got!
        $target="85297732499";
        $message="Tell me on telegram if u can receive this message";
        $w->sendMessage($target, $message);
    }
}
