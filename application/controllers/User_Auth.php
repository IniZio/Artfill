<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

session_start();

/**
 * try user authentication for google
 */
class User_Auth extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // set_include_path(get_include_path() . PATH_SEPARATOR . '/path/to/google-api-php-client/src');
    }

    public function index()
    {
        session_start();

        $client = new Google_Client();
        $client->setAuthConfigFile('client_secrets.json');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $drive_service = new Google_Service_Drive($client);
            $files_list    = $drive_service->files->listFiles(array())->getItems();
            echo json_encode($files_list);
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/oauth2callback';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

    }

    public function oauth2callback()
    {
        session_start();

        $client = new Google_Client();
        $client->setAuthConfigFile('client_secrets.json');
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/index.php/oauth2callback');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            $redirect_uri             = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

// Unset session and logout
    public function logout()
    {
        unset($_SESSION['access_token']);
        redirect(base_url());
    }

}
