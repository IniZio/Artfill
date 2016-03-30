<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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

    public function single_insert($table = '', $dataArr = '')
    {
        $this->db->insert($table, $dataArr);
    }

    /**
     * This function checks existance of record based on condition
     *
     * @param String $table
     * @param Array $condition
     *
     * return bool
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
     * @param String $table
     *            name
     * @param Array $condition
     * @param Array $sortArr
     *            details
     *
     *            return Array
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
}
