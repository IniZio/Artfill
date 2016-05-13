Here we list some discovered ways to access database and different site settings, functions

Accessing shopsy_admin_settings:
    read:
        $this->admin_model->getAdminSettings()->row()->buyer_commission
    update:
        $newdata = array('buyer_commission' => $buyer_commission, 'paypal_rate' => $paypal_rate, 'paypal_static' => $paypal_static);
		$condition = array('id' => '1');
		$this->admin_model->update_details($mode,$newdata,$condition);

Accessing shopsy_users(current user)
    update:
		$inputArrval1=array(
		'country' =>$this->input->post("country"),
		'group' => 'Seller'
		);
		$this->db->where(array("id"=> $this->data['UserVal']->id));
		$this->db->update(USER,$inputArrval1);
		
Accessing shopsy_seller
    insert:
        $inputArrval=array(
					'seller_id' => $this->data['UserVal']->id,
				    'seller_businessname' => $this->input->post('seller_businessname'),
					'seourl' => $seourl,
					'seller_email' => $this->data['UserVal']->email,
					'seller_firstname' => $this->data['UserVal']->full_name,
					'seller_lastname' => $this->data['UserVal']->last_name,
					//'status' => 'inactive',
					'status' => 'active',
					'latitude' => $lat,
					'longitude' => $long,
					'shop_location'=> $this->input->post('shop_location'),
					'created' => date('Y-m-d H:i:s')
					);
	    $this->db->insert(SELLER,$inputArrval);
	
		
Check admin login status
    if($mode == ADMIN_SETTINGS){
    }
    
Access current language setting
    $this->_ci_cached_vars["languageCode"] == "zh_HK"
    