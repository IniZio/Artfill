<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MY custom base model class, contains all common db related functions
 */
class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    /**
     * This function inserts one record
     * @param  string $table
     * @param  array $dataArr
     * @return void
     */
    public function single_insert($table = '', $dataArr = '')
    {
        $this->db->insert($table, $dataArr);
    }

    /**
     * This function checks existance of record based on condition
     *
     * @param string $table
     * @param Array $condition
     *
     * @return bool
     */
    public function check_exist($table = '', $condition = '')
    {
        if ($this->db->get_where($table, $condition, 1)->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     *
     * This function returns the table contents based on data
     *
     * @param string $table
     * @param array $condition
     * @param array $sortArr
     * @param array $limitArr
     *
     * @return array
     */
    public function get_all_details($table = '', $condition = '', $sortArr = '', $limitArr = '')
    {
        if ($sortArr != '' && is_array($sortArr)) {
            #echo "<pre>";print_r($sortArr);die;
            foreach ($sortArr as $sortRow) {
                if (is_array($sortRow)) {
                    $this->db->order_by($sortRow['field'], $sortRow['type']);
                }
            }
        }

        if ($limitArr != '') {
            return $this->db->get_where($table, $condition, $limitArr['l1'], $limitArr['l2']);
        } else {
            return $this->db->get_where($table, $condition);
        }
    }

    /**
    * This function sends all emails from server
    * @return void
    */
    public function common_send_email()
    {
        $this->config->load('email');
        $config=array_merge($config, $this->config->item('email'));
        // Set SMTP Configuration
        
        if ($config ['smtp_user'] != '' && $config ['smtp_pass'] != '') {
            $emailConfig = array (
                    'protocol' => 'smtp',
                    'smtp_host' => $config ['smtp_host'],
                    'smtp_port' => $config ['smtp_port'],
                    'smtp_user' => $config ['smtp_user'],
                    'smtp_pass' => $config ['smtp_pass'],
                    'auth' => true 
            );
        }

        $this->email->from('your@artfill.com', 'Your Name');
        $this->email->to('chowkachun1@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    }
}
