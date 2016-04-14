<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 *
 * This model contains all common db related functions
 * 
 * @author Teamtweaks
 *        
 */
class My_Model extends CI_Model {
	
	/**
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct() {
		parent::__construct ();
		// $this->load->database();
		/* Multilanguage start */
		if ($this->uri->segment ( '1' ) != 'admin') {
			$selectedLanguage = $this->session->userdata ( 'language_code' );
			$defaultLanguage = 'en';
			$filePath = APPPATH . "language/" . $selectedLanguage . "/" . $selectedLanguage . "_lang.php";
			$this->session->set_userdata ( "ipaddr", $this->input->ip_address () );
			if ($selectedLanguage != '') {
				
				if (! (is_file ( $filePath ))) {
					$this->lang->load ( $defaultLanguage, $defaultLanguage );
				} else {
					$this->lang->load ( $selectedLanguage, $selectedLanguage );
				}
			} else {
				$this->lang->load ( $defaultLanguage, $defaultLanguage );
			}
		}
		/* Multilanguage end */
	}
	public function commonUpdate($table = '', $condition = '', $fieldName = '', $updateList = '') {
		$this->db->where ( $fieldName, $updateList );
		$this->db->update ( $table, $condition );
	}
	/**
	 *
	 * This function return the session value based on param
	 * 
	 * @param
	 *        	$type
	 */
	public function checkLogin($type = '') {
		if ($type == 'A') {
			return $this->session->userdata ( 'shopsy_session_admin_id' );
		} else if ($type == 'N') {
			return $this->session->userdata ( 'shopsy_session_admin_name' );
		} else if ($type == 'M') {
			return $this->session->userdata ( 'shopsy_session_admin_email' );
		} else if ($type == 'P') {
			return $this->session->userdata ( 'shopsy_session_admin_privileges' );
		} else if ($type == 'U') {
			return $this->session->userdata ( 'shopsy_session_user_id' );
		} else if ($type == 'T') {
			return $this->session->userdata ( 'shopsy_session_temp_id' );
		}
	}
	
	/**
	 *
	 * This function returns the table contents based on data
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $condition        	
	 * @param Array $sortArr
	 *        	details
	 *        	
	 *        	return Array
	 */
	public function get_all_details($table = '', $condition = '', $sortArr = '',$limitArr='') {
		if ($sortArr != '' && is_array ( $sortArr )) {
			#echo "<pre>";print_r($sortArr);die;
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		
		if($limitArr !=''){
			return $this->db->get_where($table,$condition,$limitArr['l1'], $limitArr['l2']);
		}else{
			return $this->db->get_where($table,$condition);
		}
		#echo $this->
		//return $this->db->get_where ( $table, $condition );
	}
	
	/**
	 *
	 * This function returns the table contents based on data
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $condition        	
	 * @param Array $sortArr
	 *        	details
	 * @param Array $limit        	
	 * @param Array $likeVal
	 *        	condition
	 *        	
	 *        	return Array
	 */
	public function get_limited_details($table = '', $condition = '', $sortArr = '', $limit = '', $likeVal = '') {
		
		// print_r($condition); die;
		if ($sortArr != '' && is_array ( $sortArr )) {
			
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		if ($likeVal != '') {
			$fis = "FIND_IN_SET(`rootID`,'" . $likeVal . "')";
			$condition .= $fis;
		}
		$this->db->limit ( $limit, 0 );
		return $this->db->get_where ( $table, $condition );
	}
	
	/**
	 *
	 * This function returns the table contents based on data
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $limit        	
	 * @param Array $condition
	 *        	return Array
	 */
	public function get_limited_details_FIND($table = '', $limit = '', $condition = '') {
		if ($sortArr != '' && is_array ( $sortArr )) {
			
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		
		if ($limit != '') {
			$this->db->limit ( $limit, 0 );
		}
		return $this->db->get_where ( $table, $condition );
	}
	
	/**
	 *
	 * This function update the table contents based on params
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $data
	 *        	data
	 * @param Array $condition        	
	 */
	public function update_details($table = '', $data = '', $condition = '') {
		#echo "asdf";
		//echo $table;die;
		$this->db->where ( $condition );
		return $this->db->update ( $table, $data );
	}
	
	/**
	 *
	 * Simple function for inserting data into a table
	 * 
	 * @param String $table        	
	 * @param Array $data        	
	 */
	public function simple_insert($table = '', $data = '') {
		$this->db->insert ( $table, $data );
	}
	
	/**
	 *
	 * This function do all insert and edit operations
	 * 
	 * @param String $table
	 *        	name
	 * @param String $mode
	 *        	update
	 * @param Array $excludeArr        	
	 * @param Array $dataArr        	
	 * @param Array $condition        	
	 *
	 */
	public function commonInsertUpdate($table = '', $mode = '', $excludeArr = '', $dataArr = '', $condition = '') {
		$inputArr = array ();
			foreach ( $this->input->post () as $key => $val ) {
				if (! in_array ( $key, $excludeArr )) {
					$inputArr [$key] = $val;
				}
			}
		#echo"<pre>";print_r($inputArr);die;
		$finalArr = array_merge ( $inputArr, $dataArr );
		
		if ($mode == 'insert') {
			return $this->db->insert ( $table, $finalArr );
		} else if ($mode == 'update') {
			$this->db->where ( $condition );
			return $this->db->update ( $table, $finalArr );
		}
	}
	
	/**
	 * For getting last insert id
	 */
	public function get_last_insert_id() {
		return $this->db->insert_id ();
	}
	
	/**
	 *
	 * This function do the delete operation
	 * 
	 * @param String $table        	
	 * @param Array $condition        	
	 */
	public function commonDelete($table = '', $condition = '') {
		$this->db->delete ( $table, $condition );
	}
	
	/**
	 * This function return the admin settings details
	 */
	public function getAdminSettings() {
		$this->db->select ( '*' );
		$this->db->where ( ADMIN . '.id', '1' );
		$this->db->from ( ADMIN_SETTINGS );
		$this->db->join ( ADMIN, ADMIN . '.id = ' . ADMIN_SETTINGS . '.id' );
		
		$result = $this->db->get ();
		unset ( $result->row ()->admin_password );
		return $result;
	}
	
	/**
	 *
	 * This function change the status of records and delete the records
	 * 
	 * @param String $table        	
	 * @param String $column        	
	 *
	 */
	public function activeInactiveCommon($table = '', $column = '') {
		$data = $_POST ['checkbox_id'];
		for($i = 0; $i < count ( $data ); $i ++) {
			if ($data [$i] == 'on') {
				unset ( $data [$i] );
			}
		}
		$mode = $this->input->post ( 'statusMode' );
		$AdmEmail = strtolower ( $this->input->post ( 'SubAdminEmail' ) );
		
		$json_admin_action_value_filrs = file_get_contents ( 'commonsettins/shopsy_admin_action_settings.php' );
		$str1 = str_replace ( "<?php $serialArr='", "", $json_admin_action_value_filrs );
		$json_admin_action_value = str_replace ( "'; ?>", "", $str1 );
		
		if ($json_admin_action_value != '') {
			$json_admin_action_result = unserialize ( $json_admin_action_value );
		}
		
		foreach ( $json_admin_action_result as $valds ) {
			$json_admin_action_result_Arr [] = $valds;
		}
		
		if (sizeof ( $json_admin_action_result ) > 29) {
			unset ( $json_admin_action_result_Arr [1] );
		}
		
		$json_admin_action_result_Arr [] = array (
				$AdmEmail,
				$mode,
				$table,
				$data,
				date ( 'Y-m-d H:i:s' ),
				$_SERVER ['REMOTE_ADDR'] 
		);
		
		$writeStr = "<?php $serialArr='" . serialize ( $json_admin_action_result_Arr ) . "'; ?>";
		$file = 'commonsettins/shopsy_admin_action_settings.php';
		file_put_contents ( $file, $writeStr );
		
		$this->db->where_in ( $column, $data );
		if (strtolower ( $mode ) == 'delete') {
			$this->db->delete ( $table );
		} else {
			$statusArr = array (
					'status' => $mode 
			);
			$this->db->update ( $table, $statusArr );
		}
	}
	
	/**
	 *
	 * This function change the status of records and delete the records
	 * 
	 * @param String $table        	
	 * @param String $column        	
	 *
	 */
	public function activeInactiveCommon_product($table = '', $column = '') {
		$data = $_POST ['checkbox_id'];
		for($i = 0; $i < count ( $data ); $i ++) {
			if ($data [$i] == 'on') {
				unset ( $data [$i] );
			}
		}
		$mode = $this->input->post ( 'statusMode' );
		$AdmEmail = strtolower ( $this->input->post ( 'SubAdminEmail' ) );
		
		$this->db->where_in ( $column, $data );
		if (strtolower ( $mode ) == 'delete') {
			$statusArr = array (
					'status' => 'deleted' 
			);
			$this->db->update ( $table, $statusArr );
		} elseif ($mode == 'Yes' || $mode == 'No') {
			
			$statusArr = array (
					'product_featured' => $mode 
			);
			$this->db->update ( $table, $statusArr );
		} elseif ($mode == 'Promote' || $mode == 'Unpromote') {
			
			$statusArr = array (
					'product_promoted' => $mode 
			);
			$this->db->update ( $table, $statusArr );
		} else {
			$statusArr = array (
					'status' => $mode 
			);
			$this->db->update ( $table, $statusArr );
		}
	}
	
	/**
	 *
	 * Common function for selecting records from table
	 * 
	 * @param String $tableName        	
	 * @param Array $paraArr        	
	 *
	 */
	public function activeInactivePost($table = '', $column = '') {
		$data = $_POST ['checkbox_id'];
		for($i = 0; $i < count ( $data ); $i ++) {
			if ($data [$i] == 'on') {
				unset ( $data [$i] );
			}
		}
		$mode = $this->input->post ( 'statusMode' );
		$AdmEmail = strtolower ( $this->input->post ( 'SubAdminEmail' ) );
		
		$json_admin_action_value_filrs = file_get_contents ( 'commonsettins/shopsy_admin_action_settings.php' );
		$str1 = str_replace ( "<?php $serialArr='", "", $json_admin_action_value_filrs );
		$json_admin_action_value = str_replace ( "'; ?>", "", $str1 );
		
		if ($json_admin_action_value != '') {
			$json_admin_action_result = unserialize ( $json_admin_action_value );
		}
		
		foreach ( $json_admin_action_result as $valds ) {
			$json_admin_action_result_Arr [] = $valds;
		}
		
		if (sizeof ( $json_admin_action_result ) > 29) {
			unset ( $json_admin_action_result_Arr [1] );
		}
		
		$json_admin_action_result_Arr [] = array (
				$AdmEmail,
				$mode,
				$table,
				$data,
				date ( 'Y-m-d H:i:s' ),
				$_SERVER ['REMOTE_ADDR'] 
		);
		
		$writeStr = "<?php $serialArr='" . serialize ( $json_admin_action_result_Arr ) . "'; ?>";
		$file = 'commonsettins/shopsy_admin_action_settings.php';
		file_put_contents ( $file, $writeStr );
		
		$this->db->where_in ( $column, $data );
		if (strtolower ( $mode ) == 'delete') {
			$this->db->delete ( $table );
		} else {
			$statusArr = array (
					'post_status' => $mode 
			);
			$this->db->update ( $table, $statusArr );
			// echo $this->db->last_query(); die;
		}
	}
	
	/**
	 *
	 * Common function for active inactive records from table
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $column
	 *        	return Array
	 *        	
	 */
	public function activeInactiveComment($table = '', $column = '') {
		$data = $_POST ['checkbox_id'];
		for($i = 0; $i < count ( $data ); $i ++) {
			if ($data [$i] == 'on') {
				unset ( $data [$i] );
			}
		}
		$mode = $this->input->post ( 'statusMode' );
		$AdmEmail = strtolower ( $this->input->post ( 'SubAdminEmail' ) );
		
		$json_admin_action_value_filrs = file_get_contents ( 'commonsettins/shopsy_admin_action_settings.php' );
		$str1 = str_replace ( "<?php $serialArr='", "", $json_admin_action_value_filrs );
		$json_admin_action_value = str_replace ( "'; ?>", "", $str1 );
		
		if ($json_admin_action_value != '') {
			$json_admin_action_result = unserialize ( $json_admin_action_value );
		}
		
		foreach ( $json_admin_action_result as $valds ) {
			$json_admin_action_result_Arr [] = $valds;
		}
		
		if (sizeof ( $json_admin_action_result ) > 29) {
			unset ( $json_admin_action_result_Arr [1] );
		}
		
		$json_admin_action_result_Arr [] = array (
				$AdmEmail,
				$mode,
				$table,
				$data,
				date ( 'Y-m-d H:i:s' ),
				$_SERVER ['REMOTE_ADDR'] 
		);
		
		$writeStr = "<?php $serialArr='" . serialize ( $json_admin_action_result_Arr ) . "'; ?>";
		$file = 'commonsettins/shopsy_admin_action_settings.php';
		file_put_contents ( $file, $writeStr );
		
		$this->db->where_in ( $column, $data );
		if (strtolower ( $mode ) == 'delete') {
			$this->db->delete ( $table );
		} else {
			$statusArr = array (
					'comment_status' => $mode 
			);
			$this->db->update ( $table, $statusArr );
			// echo $this->db->last_query(); die;
		}
	}
	
	/**
	 *
	 * This function returns the table contents based on data
	 * 
	 * @param String $table
	 *        	name
	 * @param Array $paraArr
	 *        	return Array
	 *        	
	 */
	public function selectRecordsFromTable($tableName, $paraArr) {
		extract ( $paraArr );
		$this->db->select ( $selectValues );
		$this->db->from ( $tableName );
		
		if (! empty ( $whereCondition )) {
			$this->db->where ( $whereCondition );
		}
		
		if (! empty ( $sortArray )) {
			foreach ( $sortArray as $key => $val ) {
				$this->db->order_by ( $key, $val );
			}
		}
		
		if ($perpage != '') {
			$this->db->limit ( $perpage, $start );
		}
		
		if (! empty ( $likeQuery )) {
			$this->db->like ( $likeQuery );
		}
		$query = $this->db->get ();
		
		return $result = $query->result_array ();
	}
	
	/**
	 *
	 * Common function for executing mysql query
	 * 
	 * @param String $Query
	 *        	Query
	 *        	
	 */
	public function ExecuteQuery($Query) {
		return $this->db->query ( $Query );
	}
	
	/**
	 *
	 * Category -> product count function
	 * 
	 * @param String $res
	 *        	category colum values
	 * @param String $id
	 *        	id
	 *        	
	 */
	public function productPerCategory($res, $id) {
		$option_exp = "";
		
		for($i = 0; $i <= count ( $res->num_rows ); $i ++) {
			$option_exp .= $res [$i] ['category_id'] . ",";
		}
		
		$option_exploded = explode ( ',', $option_exp );
		$valid_option = array_filter ( $option_exploded );
		$occurences = array_count_values ( $valid_option );
		
		if ($occurences [$id] == '') {
			return '0';
		} else {
			return $occurences [$id];
		}
	}
	
	/**
	 *
	 * This function returns the cart count based on user id
	 * 
	 * @param String $userid
	 *        	user id
	 *        	return Array
	 *        	
	 */
	public function mini_cart_view($userid = '') {
		
		/**
		 * ***************************** Get Language Files Start ********************************
		 */
		if ($this->lang->line ( 'giftcard_price' ) != '')
			$giftcard_price = stripslashes ( $this->lang->line ( 'giftcard_price' ) );
		else
			$giftcard_price = "Price";
		
		if ($this->lang->line ( 'product_quantity' ) != '')
			$product_quantity = stripslashes ( $this->lang->line ( 'product_quantity' ) );
		else
			$product_quantity = "Quantity";
		
		if ($this->lang->line ( 'purchases_total' ) != '')
			$purchases_total = stripslashes ( $this->lang->line ( 'purchases_total' ) );
		else
			$purchases_total = "Total";
		
		if ($this->lang->line ( 'checkout_order' ) != '')
			$checkout_order = stripslashes ( $this->lang->line ( 'checkout_order' ) );
		else
			$checkout_order = "Order";
		
		if ($this->lang->line ( 'proceed_to_checkout' ) != '')
			$lang_proceed = stripslashes ( $this->lang->line ( 'proceed_to_checkout' ) );
		else
			$lang_proceed = "Proceed to Checkout";
		
		if ($this->lang->line ( 'items' ) != '')
			$lang_items = stripslashes ( $this->lang->line ( 'items' ) );
		else
			$lang_items = "items";
		
		if ($this->lang->line ( 'header_description' ) != '')
			$lang_description = stripslashes ( $this->lang->line ( 'header_description' ) );
		else
			$lang_description = "Description";
		
		/**
		 * *****************************Get Language Files End***************************
		 */
		
		$minCartVal = '';
		$GiftMiniValue = '';
		$CartMiniValue = '';
		$UserCartMiniValue = '';
		$SubscribMiniValue = '';
		$minCartValLast = '';
		$giftMiniAmt = 0;
		$cartMiniAmt = 0;
		$SubcribMiniAmt = 0;
		$cartMiniQty = 0;
		$UserCartMiniQty = 0;
		$UsercartMiniAmt = 0;
		
		$giftMiniSet = $this->minicart_model->get_all_details ( GIFTCARDS_SETTINGS, array (
				'id' => '1' 
		) );
		$giftMiniRes = $this->minicart_model->get_all_details ( GIFTCARDS_TEMP, array (
				'user_id' => $userid 
		) );
		$shipMiniVal = $this->minicart_model->get_all_details ( SHIPPING_ADDRESS, array (
				'user_id' => $userid 
		) );
		$SubcribeMiniRes = $this->minicart_model->get_all_details ( FANCYYBOX_TEMP, array (
				'user_id' => $userid 
		) );
		
		$this->db->select ( 'a.*,b.product_name,b.seourl,b.image,b.id as prdid,b.price as orgprice' );
		$this->db->from ( SHOPPING_CART . ' as a' );
		$this->db->join ( PRODUCT . ' as b', 'b.id = a.product_id' );
		// $this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = a.attribute_values','left');
		$this->db->where ( 'a.user_id = ' . $userid );
		$cartMiniVal = $this->db->get ();
		
		$this->db->select ( 'sell_id' );
		$this->db->from ( USER_SHOPPING_CART );
		$this->db->where ( 'user_id = ' . $userid );
		$this->db->group_by ( "sell_id" );
		$UsercartMiniSellVal = $this->db->get ();
		// echo $this->db->last_query(); die;
		// echo '<pre>'; print_r($UsercartMiniSellVal->result_array()); die;
		
		if ($cartMiniVal->num_rows () > 0) {
			$s = 0;
			foreach ( $cartMiniVal->result () as $CartRow ) {
				
				$newImg = @explode ( ',', $CartRow->image );
				
				if ($newImg [0] != '') {
					$newImgpath = PRODUCTPATHTHUMB . $newImg [0];
				} else {
					$newImgpath = PRODUCTPATH . 'dummyProductImage.jpg';
				}
				
				$cartMiniAmt = $cartMiniAmt + $CartRow->indtotal;
				
				$CartMiniValue .= '<div id="cartMindivId_' . $s . '"><table><tbody><tr>
	       	<th class="info"><a href="things/' . $CartRow->prdid . '/' . $CartRow->seourl . '"><img src="images/site/blank.gif" style="background-image:url(' . $newImgpath . ')" alt="' . $CartRow->product_name . '"><strong>' . $CartRow->product_name . '</strong><br />';
				if ($CartRow->attr_name != '') {
					$CartMiniValue .= $CartRow->attr_name;
				}
				
				$CartMiniValue .= '</a></th>
			<td class="qty">' . $CartRow->quantity . '</td>
            <td class="price">' . $this->data ['currencySymbol'] . $CartRow->indtotal . '</td>
		</tr></tbody></table></div>';
				$cartMiniQty = $cartMiniQty + $CartRow->quantity;
				$s ++;
			}
		}
		
		if ($SubcribeMiniRes->num_rows () > 0) {
			$s = 0;
			foreach ( $SubcribeMiniRes->result () as $SubCribRow ) {
				
				$SubscribMiniValue .= '<div id="SubcribtMinidivId_' . $s . '"><table><tbody><tr>
        	<th class="info"><a href="fancybox/' . $SubCribRow->fancybox_id . '/' . $SubCribRow->seourl . '"><img src="images/site/blank.gif" style="background-image:url(' . FANCYBOXPATH . $SubCribRow->image . ')" alt="' . $SubCribRow->name . '"><strong>' . $SubCribRow->name . '</strong></a></th>
            <td class="qty">1</td>
            <td class="price">' . $this->data ['currencySymbol'] . number_format ( $SubCribRow->price, 2, '.', '' ) . '</td>
		</tr></tbody></table></div>';
				$SubcribMiniAmt = $SubcribMiniAmt + $SubCribRow->price;
				$s ++;
			}
		}
		
		if ($giftMiniRes->num_rows () > 0) {
			$k = 0;
			foreach ( $giftMiniRes->result () as $giftRow ) {
				
				$GiftMiniValue .= '<div id="GiftMindivId_' . $k . '"><table><tbody><tr>
        	<th class="info"><a href="gift-cards"><img src="images/site/blank.gif" style="background-image:url(' . GIFTPATH . $giftMiniSet->row ()->image . ')" alt="' . $giftMiniSet->row ()->title . '"><strong>' . $giftMiniSet->row ()->title . '</strong><br>' . $giftRow->recipient_name . '</a></th>
            <td class="qty">1</td>
            <td class="price">' . $this->data ['currencySymbol'] . number_format ( $giftRow->price_value, 2, '.', '' ) . '</td>
		</tr></tbody></table></div>';
				$giftMiniAmt = $giftMiniAmt + $giftRow->price_value;
				$k ++;
			}
		}
		
		if ($UsercartMiniSellVal->num_rows () > 0) {
			$g = 0;
			foreach ( $UsercartMiniSellVal->result () as $UserMiniSellRow ) {
				
				$this->db->select ( 'a.*,b.product_name,b.seourl,b.image,b.id as prdid,b.sale_price as orgprice,b.quantity as mqty,b.seller_product_id,c.user_name' );
				$this->db->from ( USER_SHOPPING_CART . ' as a' );
				$this->db->join ( PRODUCT . ' as b', 'b.id = a.product_id' );
				$this->db->join ( USERS . ' as c', 'c.id = a.sell_id' );
				$this->db->where ( 'a.user_id = ' . $userid . ' and c.id=' . $UserMiniSellRow->sell_id );
				$UsercartMiniVal = $this->db->get ();
				
				foreach ( $UsercartMiniVal->result () as $UserCartRow ) {
					
					$newImg = @explode ( ',', $UserCartRow->image );
					
					if ($newImg [0] != '') {
						$newImgpath = PRODUCTPATHTHUMB . $newImg [0];
					} else {
						$newImgpath = PRODUCTPATH . 'dummyProductImage.jpg';
					}
					
					$UsercartMiniAmt = $UsercartMiniAmt + $UserCartRow->indtotal;
					
					$UserCartMiniValue .= '<div id="UsercartMindivId_' . $g . '"><table><tbody><tr>
					<th class="info"><a href="user/' . $UserCartRow->user_name . '/things/' . $UserCartRow->seller_product_id . '/' . $UserCartRow->seourl . '"><img src="images/site/blank.gif" style="background-image:url(' . $newImgpath . ')" alt="' . $UserCartRow->product_name . '"><strong>' . $UserCartRow->product_name . '</strong><br />';
					if ($UserCartRow->attribute_values != '') {
						$UserCartMiniValue .= $UserCartRow->attribute_values;
					}
					
					$UserCartMiniValue .= '</a></th>
					<td class="qty">' . $UserCartRow->quantity . '</td>
					<td class="price">' . $this->data ['currencySymbol'] . $UserCartRow->indtotal . '</td>
				</tr></tbody></table></div>';
					$UserCartMiniQty = $UserCartMiniQty + $UserCartRow->quantity;
					$g ++;
				}
			}
		}
		
		$countMiniVal = $giftMiniRes->num_rows () + $cartMiniQty + $UserCartMiniQty + $SubcribeMiniRes->num_rows ();
		
		if ($countMiniVal == 0) {
			$cartMiniDisp = '<ul class="gnb-wrap"><li class="gnb" id="cart-new"><a href="cart" class="mn-cart"><span class="hide">cart</span> <em class="ic-cart"></em> <span>0 ' . $lang_items . '</span></a></li></ul>';
		} else {
			
			$minCartVal .= '<ul class="gnb-wrap"><li class="gnb" id="cart-new"><a href="cart" class="mn-cart"><span class="hide">cart</span> <em class="ic-cart"></em> <span id="Shop_MiniId_count">' . $countMiniVal . ' ' . $lang_items . '</span></a>
		<div style="display: none;" class="menu-contain-cart after scrollCart" id="cart_popup">
		<table><thead><tr><th>' . $lang_description . '</th><td>' . $product_quantity . '</td><td class="price">' . $giftcard_price . '</td></tr></thead></table>';
			
			$totalMiniCartAmt = $giftMiniAmt + $cartMiniAmt + $SubcribMiniAmt + $UsercartMiniAmt;
			
			$minCartValLast .= '<div class="summary">
			<strong>' . $checkout_order . ' ' . $purchases_total . ': </strong>
			<span>' . $this->data ['currencySymbol'] . number_format ( $totalMiniCartAmt, 2, '.', '' ) . '</span>
		</div>
		<a href="cart/" class="more">' . $lang_proceed . '</a>
		</div></li></ul>';
			
			$cartMiniDisp = $minCartVal . $CartMiniValue . $SubscribMiniValue . $GiftMiniValue . $UserCartMiniValue . $minCartValLast;
		}
		
		// return $cartMiniDisp;
		return $countMiniVal;
	}
	
	/**
	 *
	 * Retrieve records using where_in
	 * 
	 * @param String $table        	
	 * @param Array $fieldsArr        	
	 * @param String $searchName        	
	 * @param Array $searchArr        	
	 * @param Array $joinArr        	
	 * @param Array $sortArr        	
	 * @param Integer $limit        	
	 *
	 * @return Array
	 */
	public function get_fields_from_many($table = '', $fieldsArr = '', $searchName = '', $searchArr = '', $joinArr = '', $sortArr = '', $limit = '', $condition = '') {
		if ($searchArr != '' && count ( $searchArr ) > 0 && $searchName != '') {
			$this->db->where_in ( $searchName, $searchArr );
		}
		if ($condition != '' && count ( $condition ) > 0) {
			$this->db->where ( $condition );
		}
		$this->db->select ( $fieldsArr );
		$this->db->from ( $table );
		if ($joinArr != '' && is_array ( $joinArr )) {
			foreach ( $joinArr as $joinRow ) {
				if (is_array ( $joinRow )) {
					$this->db->join ( $joinRow ['table'], $joinRow ['on'], $joinRow ['type'] );
				}
			}
		}
		if ($sortArr != '' && is_array ( $sortArr )) {
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		if ($limit != '') {
			$this->db->limit ( $limit );
		}
		//$query = $this->db->get ();
		return $this->db->get ();
		/* echo $this->db->last_query();
		print_r($query); die; */
	}
	
	/**
	 *
	 * Retrieve total records using condition
	 * 
	 * @param String $table        	
	 * @param Array $condition        	
	 *
	 * @return Array
	 */
	public function get_total_records($table = '', $condition = '') {
		$Query = 'SELECT COUNT(*) as total FROM ' . $table . ' ' . $condition;
		return $this->ExecuteQuery ( $Query );
	}
	
	/**
	 *
	 * Common Email send funciton
	 * 
	 * @param String $eamil_vaues        	
	 * @return 1
	 *
	 */
	public function common_email_send($eamil_vaues = array()) {
		
		
	/* 
		  echo 'From : '.$eamil_vaues['from_mail_id'].' <'.$eamil_vaues['mail_name'].'><br/>'.
		  'To : '.$eamil_vaues['to_mail_id'].'<br/>'.
		 'Subject : '.$eamil_vaues['subject_message'].'<br/>'.
		'Message : '.trim(stripslashes($eamil_vaues['body_messages'])); die;  
		  
		  */
		// Prevent mail for pleasureriver
		$server_ip = $this->input->ip_address ();
		$mail_id = '';
		if ($demoserverChk) {
			if (isset ( $eamil_vaues ['mail_id'] )) {
				$mail_id = $eamil_vaues ['mail_id'];
			}
		} else {
			$mail_id = 'set';
		}
		
		if ($mail_id != '') {
			if (is_file ( './commonsettings/shopsy_smtp_settings.php' )) {
				include ('commonsettings/shopsy_smtp_settings.php');
			}
			
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
			
			// Set your email information
			$from = array (
					'email' => $eamil_vaues ['from_mail_id'],
					'name' => $eamil_vaues ['mail_name'] 
			);
			$to = $eamil_vaues ['to_mail_id'];
			$subject = $eamil_vaues ['subject_message'];
			$message = stripslashes ( $eamil_vaues ['body_messages'] );
			// Load CodeIgniter Email library
			// echo "<pre>"; echo $message; die;
			if ($config ['smtp_user'] != '' && $config ['smtp_pass'] != '') {
				
				$this->load->library ( 'email', $emailConfig );
			} else {
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				// $headers .= 'To: '.$eamil_vaues['to_mail_id']. "\r\n";
				$headers .= 'From: ' . $eamil_vaues ['mail_name'] . ' <' . $eamil_vaues ['from_mail_id'] . '>' . "\r\n";
				if ($eamil_vaues ['cc_mail_id'] != '') {
					$headers .= 'Cc: ' . $eamil_vaues ['cc_mail_id'] . "\r\n";
				}
				if ($eamil_vaues ['bcc_mail_id'] != '') {
					$headers .= 'Bcc: ' . $eamil_vaues ['bcc_mail_id'] . "\r\n";
				}
				
				// Mail it
				mail ( $eamil_vaues ['to_mail_id'], trim ( stripslashes ( $eamil_vaues ['subject_message'] ) ), trim ( stripslashes ( $eamil_vaues ['body_messages'] ) ), $headers );
				return 1;
			}
			
			// Sometimes you have to set the new line character for better result
			
			$this->email->set_newline ( "\r\n" );
			// Set email preferences
			$this->email->set_mailtype ( $eamil_vaues ['mail_type'] );
			$this->email->from ( $from ['email'], $from ['name'] );
			$this->email->to ( $to );
			if ($eamil_vaues ['cc_mail_id'] != '') {
				$this->email->cc ( $eamil_vaues ['cc_mail_id'] );
			}
			if ($eamil_vaues ['bcc_mail_id'] != '') {
				$this->email->bcc ( $eamil_vaues ['bcc_mail_id'] );
			}
			$this->email->subject ( $subject );
			$this->email->message ( $message );
			// Ready to send email and check whether the email was successfully sent;
			
			if (! $this->email->send ()) {
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				// $headers .= 'To: '.$eamil_vaues['to_mail_id']. "\r\n";
				$headers .= 'From: ' . $eamil_vaues ['mail_name'] . ' <' . $eamil_vaues ['from_mail_id'] . '>' . "\r\n";
				if ($eamil_vaues ['cc_mail_id'] != '') {
					$headers .= 'Cc: ' . $eamil_vaues ['cc_mail_id'] . "\r\n";
				}
				if ($eamil_vaues ['bcc_mail_id'] != '') {
					$headers .= 'Bcc: ' . $eamil_vaues ['bcc_mail_id'] . "\r\n";
				}
				
				// Mail it
				mail ( $eamil_vaues ['to_mail_id'], trim ( stripslashes ( $eamil_vaues ['subject_message'] ) ), trim ( stripslashes ( $eamil_vaues ['body_messages'] ) ), $headers );
				return 1;
			} else {
				// Show success notification or other things here
				// echo 'Success to send email';
				
				return 1;
			}
		} else {
			return 1;
		}
	}
	
	/**
	 *
	 * Retrieve newsletter template
	 * 
	 * @param Int $apiId        	
	 * @return Array
	 *
	 */
	public function get_newsletter_template_details($apiId = '') {
		$twitterQuery = "select * from " . NEWSLETTER . " where id=" . $apiId . " AND status='Active'";
		$twitterQueryDetails = mysql_query ( $twitterQuery );
		return $twitterFetchDetails = mysql_fetch_assoc ( $twitterQueryDetails );
	}
	
	/**
	 *
	 * Add Edit Vales
	 * 
	 * @param Array $addEditVal        	
	 * @param String $table        	
	 * @param String $pref        	
	 * @return Array
	 *
	 */
	function addEditValues($addEditVal = array(), $table = '', $pref = '') {
		$attributeEditVal = $this->input->post ( 'AddOrEditVal' ); // die;
		if ($attributeEditVal == '') {
			$this->db->insert ( $table, $addEditVal );
			return 1;
		} else {
			$this->db->where ( $pref . 'id', $attributeEditVal );
			$this->db->update ( $table, $addEditVal );
			return 1;
		}
	}
	
	/**
	 *
	 * Common function for retrive the records from table
	 * 
	 * @param String $table        	
	 * @param String $selectfield        	
	 * @param String $fieldName        	
	 * @param String $updateList        	
	 * @return Array
	 *
	 */
	public function commonSelect($table = '', $selectfield = '', $fieldName = '', $updateList = '') {
		$this->db->select ( $selectfield );
		$this->db->from ( $table );
		if ($fieldName != '' && $updateList != '') {
			$this->db->where ( $fieldName, $updateList );
		}
		$query = $this->db->get ();
		// echo $this->db->last_query(); die;
		return $result = $query->result_array ();
	}
	
	/**
	 *
	 * This common function change the status of records
	 * 
	 * @param String $table        	
	 * @param String $fieldName        	
	 * @param String $userList        	
	 * @param String $updateValues        	
	 *
	 */
	function commonActiveInactive($tableName, $fieldName, $userList, $updateValues) {
		return $this->doActiveInactive ( $tableName, $fieldName, $userList, $updateValues );
	}
	
	/**
	 *
	 * This common function change the status of records using where_in
	 * 
	 * @param String $table        	
	 * @param String $fieldName        	
	 * @param String $userList        	
	 * @param String $updateValues        	
	 *
	 */
	function doActiveInactive($tableName, $fieldName, $updateList, $updateValues) {
		$this->db->where_in ( $fieldName, $updateList );
		$this->db->update ( $tableName, $updateValues );
	}
	
	/**
	 *
	 * This common function delete the records using whereCondition
	 * 
	 * @param String $table        	
	 * @param String $fieldName        	
	 * @param String $whereCondition        	
	 *
	 */
	function CommonGeneralDelete($tableName, $fieldName = '', $whereCondition = array()) {
		return $this->deleteRecords ( $tableName, $fieldName, $whereCondition );
	}
	
	/**
	 *
	 * This function delete the records using where_in
	 * 
	 * @param String $table        	
	 * @param String $fieldName        	
	 * @param String $deleteList        	
	 *
	 */
	function deleteRecords($tableName, $fieldName, $deleteList) {
		$this->maintain_active_inactive_delete_details ( $tableName, $fieldName, $deleteList, array (
				'status' => 'delete' 
		) );
		$this->db->where_in ( $fieldName, $deleteList );
		$this->db->delete ( $tableName );
	}
	
	/**
	 *
	 * This function tracking the product list who installed
	 * 
	 * @param String $email        	
	 *
	 */
	function urlAdminResponse($email = '') {
		$postUrl = 'ip=' . $_SERVER ['REMOTE_ADDR'] . '&email=' . $email . '&returnPath=' . base_url ();
		$crurl = 'YUhSMGNEb3ZMM0YxYVdOcmFYb3VZMjl0TDIxMmIybGpaUzl6YUc5d2MzbHdZV2RsTHc9PQ==';
		$ncrurl = $this->decrypt_url ( $crurl );
		$URL = $ncrurl . '?' . $postUrl;
		$curl_handle = curl_init ();
		curl_setopt ( $curl_handle, CURLOPT_URL, $URL );
		curl_setopt ( $curl_handle, CURLOPT_CONNECTTIMEOUT, 2 );
		curl_setopt ( $curl_handle, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl_handle, CURLOPT_SSL_VERIFYPEER, false );
		$response = curl_exec ( $curl_handle );
		curl_close ( $curl_handle );
		return $response;
		// echo '<pre>'; print_r($response); die;
	}
	
	/**
	 *
	 * This function encrypt the string
	 * 
	 * @param String $string        	
	 *
	 */
	function encrypt_url($string) {
		$key = "9865848854"; // key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) + ord ( $keychar ) );
			
			$test [$char] = ord ( $char ) + ord ( $keychar );
			$result .= $char;
		}
		return urlencode ( base64_encode ( $result ) );
	}
	
	/**
	 *
	 * This This common function change the status of records and write in file
	 * 
	 * @param String $tableName        	
	 * @param String $fieldName        	
	 * @param String $updateList        	
	 * @param String $updateValues        	
	 *
	 */
	public function maintain_active_inactive_delete_details($tableName = '', $fieldName = '', $updateList = '', $updateValues = '') {
		// extract($updateValues);
		// echo $status;die;
		$updateValues1 = 'Inactive';
		foreach ( $updateValues as $key => $val ) {
			$updateValues1 = $val;
		}
		
		$json_admin_action_value_filrs = file_get_contents ( 'commonsettins/shopsy_admin_maintain_actions.php' );
		$str1 = str_replace ( "<?php $serialArr='", "", $json_admin_action_value_filrs );
		$read_from_file = str_replace ( "'; ?>", "", $str1 );
		
		$ipAddress = $_SERVER ['REMOTE_ADDR'];
		$adminEmailID = stripslashes ( $this->config->item ( 'admin_email' ) );
		$file_write_details = array (
				'admin_email' => $this->session->userdata ( 'adminName' ),
				'Mode' => $updateValues1,
				'tableName' => $tableName,
				'table_id' => implode ( ",", $updateList ),
				'modifying_time' => date ( 'Y-m-d H:i:s' ),
				'loginIp' => $ipAddress 
		);
		/* file write start */
		$vals = unserialize ( $read_from_file );
		// echo "<pre>";print_r($vals);die;
		if (! empty ( $vals )) {
			$final_vals = array_merge_recursive ( $file_write_details, unserialize ( $read_from_file ) );
		} else {
			$final_vals = $file_write_details;
		}
		
		$writeStr = "<?php $serialArr='" . serialize ( $final_vals ) . "'; ?>";
		$file = 'commonsettins/shopsy_admin_maintain_actions.php';
		file_put_contents ( $file, $writeStr );
		
		/* file write end */
	}
	
	/**
	 *
	 * This function decrypt the string
	 * 
	 * @param String $string        	
	 *
	 */
	function decrypt_url($string) {
		$key = "9865848854"; // key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) + ord ( $keychar ) );
			
			$test [$char] = ord ( $char ) + ord ( $keychar );
			$result .= $char;
		}
		return base64_decode ( base64_decode ( $string ) );
	}
	
	/**
	 *
	 * This function update the geo location currency
	 * 
	 * @param String $string        	
	 *
	 */
	public function geoloc_currecy_update() {
		$this->update_details ( CURRENCY, array (
				'currency_value' => GeoCurrencyValue 
		), array (
				'currency_code' => GeoCurrencyCode 
		) );
	}
	
	/**
	 *
	 * This common function send the notification for mobile app
	 * 
	 * @param String $userId        	
	 * @param String $message        	
	 * @param String $type        	
	 * @param String $urlval        	
	 *
	 */
	public function sendPushNotification($userId = '', $message = '', $type = '', $urlval = array()) {
		$userChkKey = $this->product_model->ExecuteQuery ( "SELECT gcm_buyer_id,gcm_seller_id,ios_device_id FROM " . USERS . " WHERE id=" . $userId );
		
		if ($userChkKey->num_rows () > 0) {
			$msg = array ();
			$regIds = array ();
			$msg ['message'] = $message;
			$msg ['type'] = $type;
			$pmusers = array (
					'follow',
					'message' 
			);
			$pmsellers = array (
					'follow',
					'favorite item',
					'favorite shop',
					'order ',
					'contact',
					'review',
					'discussion',
					'message' 
			);
			
			$msg ['app_type'] = '';
			$msg ['url_key1'] = ( string ) $urlval [0];
			$msg ['url_key2'] = ( string ) $urlval [1];
			$userPN = NULL;
			$sellerPN = NULL;
			if (in_array ( $type, $pmusers )) {
				if ($userChkKey->row ()->gcm_buyer_id != NULL) {
					$userPN = 1;
					$regIds [] = $userChkKey->row ()->gcm_buyer_id;
				}
			}
			if (in_array ( $type, $pmsellers )) {
				if ($userChkKey->row ()->gcm_seller_id != NULL) {
					$sellerPN = 1;
					$regIds [] = $userChkKey->row ()->gcm_seller_id;
				}
			}
			if (! empty ( $regIds )) {
				if ($userPN == 1 && $sellerPN == 1) {
					$msg ['app_type'] = 'both';
				} else if ($userPN == 1) {
					$msg ['app_type'] = 'user';
				} else if ($sellerPN == 1) {
					$msg ['app_type'] = 'seller';
				}
				$this->sendPushNotificationToGCMOrg ( $regIds, $msg );
			}
			if ($userChkKey->row ()->ios_device_id != NULL) {
				$this->push_notification ( $userChkKey->row ()->ios_device_id, $msg );
			}
		}
	}
	
	/**
	 *
	 * This function send the notification for Anroid app
	 * 
	 * @param String $registatoin_ids        	
	 * @param String $message        	
	 *
	 */
	public function sendPushNotificationToGCMOrg($registatoin_ids, $message) {
		// Google cloud messaging GCM-API url
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array (
				'registration_ids' => $registatoin_ids,
				'data' => $message 
		);
		// Google Cloud Messaging GCM API Key
		// define("GOOGLE_API_KEY", "AIzaSyD0VJs5nLcm0j34eHCIpP7I8iNI-yRycqo");
		define ( "GOOGLE_API_KEY", "AIzaSyDKdzKRknMspcpGgzTVicpF18yrwbpFU2o" );
		$headers = array (
				'Authorization: key=' . GOOGLE_API_KEY,
				'Content-Type: application/json' 
		);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode ( $fields ) );
		$result = curl_exec ( $ch );
		if ($result === FALSE) {
			die ( 'Curl failed: ' . curl_error ( $ch ) );
		}
		curl_close ( $ch );
		return $result;
	}
	
	/**
	 *
	 * This function send the notification for IOS app
	 * 
	 * @param String $deviceId        	
	 * @param String $message        	
	 *
	 */
	public function push_notification($deviceId, $message) {
		/*
		 * echo $deviceId;
		 * var_dump($message);
		 */
		// $deviceId = "6b1763dfa8393319c851800288f1cd1251793ecd8053012a0818d44c802a1961";
		// $message = "test message for shopsy succeeded";
		$this->load->library ( 'apns' );
		$this->apns->send_push_message ( $deviceId, $message );
	}
        
        
        public function CreateLanguagetables(){
        	$languages = $this->multilanguage_model->get_language_list()->result_array();
        	//echo "<pre>"; print_r($languages);
        	
        	$tablelist = $this->data['mulitiLangTable'];
        	//print_r($tablelist);
        	
        	foreach($languages as $lang){
        		$ln = $lang['lang_code'];
        		
        		$ln = str_replace("-","",$ln);
        		$ln = str_replace("#","",$ln);
        		$ln = str_replace(" ","",$ln);
        		
        		foreach($tablelist as $tablename){
        			$table = $tablename;
        			
        			$ln_table = $table."_".$ln;
        
        			//echo $ln_table."<br>";
        			
        			if ($this->db->table_exists($ln_table)){
        
        			}else{
        				
        				$qry = "CREATE TABLE IF NOT EXISTS ".$ln_table." LIKE ".$table."";
        				$this->ExecuteQuery($qry);
        				//echo $this->db->last_query()."<br>";
        				
        				//die;
        				$qry2 = "INSERT into ".$ln_table." select * from ".$table."";
        				$this->ExecuteQuery($qry2);
        				
        				$qry3 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `delete_".$ln_table."` FOREIGN KEY (`id`) REFERENCES ".$table." (`id`) ON DELETE CASCADE";
        				$this->ExecuteQuery($qry3);
        				
        				
        				$qry4 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `statuschange_".$ln_table."` FOREIGN KEY (status, id) REFERENCES ".$table." (status, id) ON UPDATE CASCADE";
        				$this->ExecuteQuery($qry4);
        				

         				if($table == CMS){
 		       				$qry5 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `CmsHidden_".$ln_table."` FOREIGN KEY (hidden_page, id) REFERENCES ".$table." (hidden_page, id) ON UPDATE CASCADE";
 	        				$this->ExecuteQuery($qry5);
         				}
        			}
        			
        			
        		}
        	}
        	
        	//die;
        }
        
        public function get_languages_list(){
        	$languages = $this->multilanguage_model->get_language_list()->result_array();
        	return $languages;
        }
}