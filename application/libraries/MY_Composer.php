<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Description of MY_Composer
 * @author Artfill
 */
class MY_Composer
{
    public function __construct()
    {
        include "./vendor/autoload.php";
    }
}
