<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 *
 */

class Locationsearch extends MY_Controller {
	function __construct(){
        parent::__construct();
			$this->load->helper(array('cookie','date','form','email'));
			$this->load->library(array('encrypt','form_validation'));		
			$this->load->model(array('product_model','seller_model','user_model','locationsearch_model'));
			$this->data['loginCheck'] = $this->checkLogin('U');
			$this->data['AdminloginCheck'] = $this->checkLogin('A');
			$this->data['likedProducts'] = array();
			if ($this->data['loginCheck'] != ''){
			$SSeller_details=$this->locationsearch_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));	
			$this->data['ip'] = $this->input->ip_address();			
		}
	}
	
	public function searchshop(){
		$this->data['heading'] = 'Shop by Location';
		$this->load->view('site/locationsearch/searchshop',$this->data);
	}
	
	public function ShopLists(){
	
		$goeurl = 'http://www.geoplugin.net/php.gp?ip='.$this->data['ip'];
		$location = unserialize($this->curlget_data($goeurl));
		$country = $location['geoplugin_countryName'];
		$city = $location['geoplugin_city'];
		if($city!=''){
			$address = $city;
		}elseif($country!=''){
			$address = $country;
		}else{
			$address = "United States";
		}	
		$LatLng = $this->curlget_LatLng($address);
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lng;
		$minlng = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		
		$shopdetails = $this->locationsearch_model->getShop($minlat, $maxlat, $minlng, $maxlng);
		$returnArr['shopdetails'] = $shopdetails->result_array();
		
		if($shopdetails->num_rows() >0){
			foreach($shopdetails->result() as $_shopdetails){
				$product = $this->locationsearch_model->get_all_details(PRODUCT, array('user_id'=>$_shopdetails->id));
				$returnArr['productCount'][$_shopdetails->id] = $product->result_array();
			} 
		}
		$returnArr['address'] = $address;
		echo json_encode($returnArr);
	}
	
	public function searchlocations(){
		
		$LatLng = $this->curlget_LatLng($this->input->post('address'));
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lat;
		$minlng = $response->results[0]->geometry->bounds->southwest->lng;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		$cLat = $response->results[0]->geometry->bounds->center->lng;
		$cLong = $response->results[0]->geometry->bounds->center->lng;
		$shopdetails = $this->locationsearch_model->getShop($minlat, $maxlat, $minlng, $maxlng);
		if($shopdetails->num_rows() >0){
			foreach($shopdetails->result() as $_shopdetails){
				$product = $this->locationsearch_model->get_all_details(PRODUCT, array('user_id'=>$_shopdetails->id));
				$returnArr['productCount'][$_shopdetails->id] = $product->result_array();
			} 
		}
		$returnArr['shopdetails'] = $shopdetails->result_array();
		$returnArr['address'] = $this->input->post('address');
		$returnArr['zoomValue'] = 4;
		$returnArr['cLat'] = $cLat;
		$returnArr['cLong'] = $cLong;
		echo json_encode($returnArr);
	}
	public function ZoomChangedshops(){
		$minLat = $this->input->post('minLat');
		$maxLat = $this->input->post('maxLat');
		$minLong = $this->input->post('minLong');
		$maxLong = $this->input->post('maxLong');
		if($this->input->post('address')!=''){
			$address = $this->input->post('address');
		}else{
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat1).','.trim($lng1).'&sensor=false';
			$json = @file_get_contents($url);
			$output= json_decode($json);
			for($j=0;$j<count($output->results[0]->address_components);$j++){
				$cn=array($output->results[0]->address_components[$j]->types[0]);
				if(in_array("country", $cn)){
					$country= $output->results[0]->address_components[$j]->long_name;
				}
			}
			$address = $country;
		}
		$shopdetails = $this->locationsearch_model->getShop($minLat, $maxLat, $minLong, $maxLong);
		if($shopdetails->num_rows() >0){
			foreach($shopdetails->result() as $_shopdetails){
				$product = $this->locationsearch_model->get_all_details(PRODUCT, array('user_id'=>$_shopdetails->id));
				$returnArr['productCount'][$_shopdetails->id] = $product->result_array();
			} 
		}
		$returnArr['shopdetails'] = $shopdetails->result_array();
		$returnArr['address'] = $address;
		$returnArr['zoomValue'] = $this->input->post('zoom');
		$returnArr['cLat'] = $this->input->post('cLat');
		$returnArr['cLong'] = $this->input->post('cLong');
		echo json_encode($returnArr);
	}
	
	public function searchevents(){
		$this->data['heading'] = 'View Local Events';
		$this->load->view('site/locationsearch/searchevents',$this->data);
	}
	public function getevents(){
		
		$goeurl = 'http://www.geoplugin.net/php.gp?ip='.$this->data['ip'];
		$location = unserialize($this->curlget_data($goeurl));
		$country = $location['geoplugin_countryName'];
		$city = $location['geoplugin_city'];
		if($city!=''){
			$address = $city;
		}elseif($country!=''){
			$address = $country;
		}else{
			$address = "United States";
		}	
		$LatLng = $this->curlget_LatLng($address);
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lat;
		$minlng = $response->results[0]->geometry->bounds->southwest->lng;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		$filter ='';
		$events = $this->locationsearch_model->getEvents($filter, $minlat, $maxlat, $minlng, $maxlng);
		$returnArr['events'] = $events->result_array();
		$returnArr['address'] = $address;
		echo json_encode($returnArr);
	}
	public function ZoomChangedevents(){
		$minLat = $this->input->post('minLat');
		$maxLat = $this->input->post('maxLat');
		$minLong = $this->input->post('minLong');
		$maxLong = $this->input->post('maxLong');
		$filter = $this->input->post('filter');
		if($this->input->post('address')!=''){
			$address = $this->input->post('address');
		}else{
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($minLat).','.trim($minLong).'&sensor=false';
			$json = @file_get_contents($url);
			$output= json_decode($json);
			for($j=0;$j<count($output->results[0]->address_components);$j++){
				$cn=array($output->results[0]->address_components[$j]->types[0]);
				if(in_array("country", $cn)){
					$country= $output->results[0]->address_components[$j]->long_name;
				}
			}
			$address = $country;
		}
		$events = $this->locationsearch_model->getEvents($filter, $minLat, $maxLat, $minLong, $maxLong);
		$returnArr['events'] = $events->result_array();
		$returnArr['address'] = $address;
		$returnArr['zoomValue'] = $this->input->post('zoom');
		$returnArr['cLat'] = $this->input->post('cLat');
		$returnArr['cLong'] = $this->input->post('cLong');
		echo json_encode($returnArr);
	}
	public function filterevents(){
		$filter = $this->input->post('filter');
		if($this->input->post('address')!=''){
			$address = $this->input->post('address');
		}else{
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($minLat).','.trim($minLong).'&sensor=false';
			$json = @file_get_contents($url);
			$output= json_decode($json);
			for($j=0;$j<count($output->results[0]->address_components);$j++){
				$cn=array($output->results[0]->address_components[$j]->types[0]);
				if(in_array("country", $cn)){
					$country= $output->results[0]->address_components[$j]->long_name;
				}
			}
			$address = $country;
		}
		$LatLng = $this->curlget_LatLng($address);
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lat;
		$minlng = $response->results[0]->geometry->bounds->southwest->lng;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		
		$events = $this->locationsearch_model->getEvents($filter, $minlat, $maxlat, $minlng, $maxlng);
		$returnArr['events'] = $events->result_array();
		$returnArr['address'] = $address;
		if($this->input->post('address')==''){
			$returnArr['zoomValue'] = $this->input->post('zoom');
			$returnArr['cLat'] = $this->input->post('cLat');
			$returnArr['cLong'] = $this->input->post('cLong');
		}
		echo json_encode($returnArr);
	}
	public function searchitems(){
		$this->data['heading'] = 'Shop by Items';
		$this->data['categories'] = $this->locationsearch_model->get_all_details(CATEGORY,array('rootID'=>0));
		$this->load->view('site/locationsearch/searchitems',$this->data);
	}
	public function getitems(){
		$goeurl = 'http://www.geoplugin.net/php.gp?ip='.$this->data['ip'];
		$location = unserialize($this->curlget_data($goeurl));
		$country = $location['geoplugin_countryName'];
		$city = $location['geoplugin_city'];
		if($city!=''){
			$address = $city;
		}elseif($country!=''){
			$address = $country;
		}else{
			$address = "United States";
		}	
		$LatLng = $this->curlget_LatLng($address);
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lat;
		$minlng = $response->results[0]->geometry->bounds->southwest->lng;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		$filter ='';
		$product = $this->locationsearch_model->getItems($filter, $minlat, $maxlat, $minlng, $maxlng);
		$returnArr['product'] = $product->result_array();
		$returnArr['address'] = $address;
		echo json_encode($returnArr);
	}
	
	public function filteritems(){
		$filter = $this->input->post('filter');
		if($this->input->post('address')!=''){
			$address = $this->input->post('address');
		}else{
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($minLat).','.trim($minLong).'&sensor=false';
			$json = @file_get_contents($url);
			$output= json_decode($json);
			for($j=0;$j<count($output->results[0]->address_components);$j++){
				$cn=array($output->results[0]->address_components[$j]->types[0]);
				if(in_array("country", $cn)){
					$country= $output->results[0]->address_components[$j]->long_name;
				}
			}
			$address = $country;
		}
		$LatLng = $this->curlget_LatLng($address);
		$response = json_decode($LatLng);
		$minlat = $response->results[0]->geometry->bounds->southwest->lat;
		$maxlat = $response->results[0]->geometry->bounds->northeast->lat;
		$minlng = $response->results[0]->geometry->bounds->southwest->lng;
		$maxlng = $response->results[0]->geometry->bounds->northeast->lng;
		
		$product = $this->locationsearch_model->getItems($filter, $minlat, $maxlat, $minlng, $maxlng);
		$returnArr['product'] = $product->result_array();
		$returnArr['address'] = $address;
		if($this->input->post('address')==''){
			$returnArr['zoomValue'] = $this->input->post('zoom');
			$returnArr['cLat'] = $this->input->post('cLat');
			$returnArr['cLong'] = $this->input->post('cLong');
		}
		echo json_encode($returnArr);
	}
	
	public function ZoomChangeditems(){
		$minLat = $this->input->post('minLat');
		$maxLat = $this->input->post('maxLat');
		$minLong = $this->input->post('minLong');
		$maxLong = $this->input->post('maxLong');
		$filter = $this->input->post('filter');
		if($this->input->post('address')!=''){
			$address = $this->input->post('address');
		}else{
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($minLat).','.trim($minLong).'&sensor=false';
			$json = @file_get_contents($url);
			$output= json_decode($json);
			for($j=0;$j<count($output->results[0]->address_components);$j++){
				$cn=array($output->results[0]->address_components[$j]->types[0]);
				if(in_array("country", $cn)){
					$country= $output->results[0]->address_components[$j]->long_name;
				}
			}
			$address = $country;
		}
		$product = $this->locationsearch_model->getItems($filter, $minLat, $maxLat, $minLong, $maxLong);
		$returnArr['product'] = $product->result_array();
		$returnArr['address'] = $address;
		$returnArr['zoomValue'] = $this->input->post('zoom');
		$returnArr['cLat'] = $this->input->post('cLat');
		$returnArr['cLong'] = $this->input->post('cLong');
		echo json_encode($returnArr);
	}
	
	public function getSubCat(){
		$id = $this->input->post('cid');
		if($id!=''){
			$subcat = $this->locationsearch_model->get_all_details(CATEGORY,array('rootID'=>$id));
			if($subcat->num_rows()>0){
				$returnArr['subCat'] .="<select onchange='changesubFilter(this)' style='height:30px;'><option value=''>Filter by Subcategory</option>";
				foreach($subcat->result() as $_subcat){
					$returnArr['subCat'] .="<option value='".$_subcat->id."'>".$_subcat->cat_name."</option>";
				}
				$returnArr['subCat'] .= "</select>";
			}else{
				$returnArr['subCat'] = 0;
			}
		}else{
			$returnArr['subCat'] = 0;
		}
		echo json_encode($returnArr);
	}
	
	
	function curlget_data($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	function curlget_LatLng($add){
		$address = str_replace(' ','+',$add);
		$url = "http://maps.google.com/maps/api/geocode/json?address=".$address;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
} 

// Class ends
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */