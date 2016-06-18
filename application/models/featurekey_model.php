<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* This model contains all db functions of feature keys
*/
class Featurekey_model extends MY_Model
{
	
	public function insert_key($key_id='',$feature_name='', $status='',$displayed='NO'){
		$dataArr = array('key_id'=>$key_id, 'status'=>$status,'feature_name'=>$feature_name, 'displayed'=>$displayed);
		$this->db->insert(FEATUREKEYS, $dataArr);
	}

}