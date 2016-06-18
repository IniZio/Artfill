<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Locationsearch_model extends My_Model {
	
	public function __construct() {
		parent::__construct();
	}
	public function getShop($minlat='', $maxlat='', $minlng='', $maxlng=''){
		
		$this->db->select('u.*,s.seller_businessname,s.seller_id,s.seourl as shopurl,s.seller_banner,s.latitude,s.longitude,s.shop_location');
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u' , 'u.id = s.seller_id', 'left'); 
		$this->db->where('u.group = "Seller"');
		$this->db->where('s.status = "active"');
		if($minlat!='' && $minlng!='' && $maxlat!='' && $maxlng!=''){
			$whereLat = '(s.latitude BETWEEN '.$minlat.' AND '.$maxlat.' ) AND (s.longitude BETWEEN '.$minlng.' AND '.$maxlng.')';
			
			$this->db->where($whereLat);
		}
		$query = $this->db->get();
		/* echo $this->db->last_query();
		print_r($query); die;  */
		return $query;
	}
	public function getEvents($filter='', $minlat='', $maxlat='', $minlng='', $maxlng=''){
		$this->db->select('e.*');
		$this->db->from(EVENTS.' as e');
		$this->db->join(USERS.' as u' , 'u.id = e.eventAddedby', 'left');
		$this->db->where('u.group = "Seller"');	
		//$this->db->where('u.id != 1');
		$this->db->where('e.status = "Active"');
		if($filter!=''){
			if($filter =='today'){
				$this->db->where('e.eventDate = "'.date('Y-m-d').'"');
			}elseif($filter =='week'){
				$this->db->where('YEARWEEK(e.eventDate, 1) = YEARWEEK(CURDATE(), 1)');
			}elseif($filter =='cmonth'){
				$this->db->where('MONTH(e.eventDate) = MONTH(CURRENT_DATE)');
			}elseif($filter =='year'){
				$this->db->where('YEAR(e.eventDate) = YEAR(CURDATE())');
			}elseif($filter =='nmonth'){
				$this->db->where('MONTH(e.eventDate) = MONTH(CURRENT_DATE + INTERVAL 1 MONTH)');
			}
		}
		if($minlat!='' && $minlng!='' && $maxlat!='' && $maxlng!=''){
		
			$whereLat = '(e.latitude BETWEEN '.$minlat.' AND '.$maxlat.' ) AND (e.longitude BETWEEN '.$minlng.' AND '.$maxlng.')';
			
			$this->db->where($whereLat);
		}
		$query = $this->db->get();
		
		/*echo $this->db->last_query();
		 print_r($query); die; */  
		return $query;
	}
	public function getItems($category='', $minlat='', $maxlat='', $minlng='', $maxlng=''){
		$this->db->select('p.*,u.user_name');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u' , 'u.id = p.user_id', 'left');
		$this->db->where('u.group = "Seller"');	
		$this->db->where('p.status = "Publish"');
		if($minlat!='' && $minlng!='' && $maxlat!='' && $maxlng!=''){
			$whereLat = '(p.latitude BETWEEN '.$minlat.' AND '.$maxlat.' ) AND (p.longitude BETWEEN '.$minlng.' AND '.$maxlng.')';
			$this->db->where($whereLat);
		}
		if($category!=''){
			$find = "FIND_IN_SET('".$category."', p.category_id)";  
			$this->db->where($find);
		}
		$query = $this->db->get();
		/* echo $this->db->last_query();
		print_r($query); die;  */
		return $query;
	}
}

