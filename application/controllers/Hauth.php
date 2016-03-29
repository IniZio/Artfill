<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hauth extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('hauth/home');
    }

    public function login($provider)
    {
        log_message('debug', "controllers.HAuth.login($provider) called");

        try
        {
            log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
            $this->load->library('HybridAuthLib');

            if ($this->hybridauthlib->providerEnabled($provider)) {
                log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
                $service = $this->hybridauthlib->authenticate($provider);

                if ($service->isUserConnected()) {
                    log_message('debug', 'controller.HAuth.login: user authenticated.');

                    $user_profile = $service->getUserProfile();

                    log_message('info', 'controllers.HAuth.login: user profile:' . PHP_EOL . print_r($user_profile, true));

                    // display raw user profile information after login
                    $data['user_profile'] = $user_profile;

                    $this->load->view('hauth/done', $data);

                } else // Cannot authenticate user
                {
                    show_error('Cannot authenticate user');
                }
            } else // This service is not enabled.
            {
                log_message('error', 'controllers.HAuth.login: This provider is not enabled (' . $provider . ')');
                show_404($_SERVER['REQUEST_URI']);
            }
        } catch (Exception $e) {
            $error = 'Unexpected error';
            switch ($e->getCode()) {
                case 0:$error = 'Unspecified error.';
                    break;
                case 1:$error = 'Hybriauth configuration error.';
                    break;
                case 2:$error = 'Provider not properly configured.';
                    break;
                case 3:$error = 'Unknown or disabled provider.';
                    break;
                case 4:$error = 'Missing provider application credentials.';
                    break;
                case 5:log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                    //redirect();
                    if (isset($service)) {
                        log_message('debug', 'controllers.HAuth.login: logging out from service.');
                        $service->logout();
                    }
                    show_error('User has cancelled the authentication or the provider refused the connection.');
                    break;
                case 6:$error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                    break;
                case 7:$error = 'User not connected to the provider.';
                    break;
            }

            if (isset($service)) {
                $service->logout();
            }

            log_message('error', 'controllers.HAuth.login: ' . $error);
            show_error('Error authenticating user.');
        }

        // load_controller('User', 'not_found');
    }

    public function endpoint()
    {

        log_message('debug', 'controllers.HAuth.endpoint called.');
        log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: ' . print_r($_REQUEST, true));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
        }

        log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
        require_once APPPATH . '/third_party/hybridauth/index.php';

    }
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
