<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Table Constants
|--------------------------------------------------------------------------
|
*/
define('TBL_PREF',						'shopsy_');
define('ADMIN',							TBL_PREF.'admin');
define('ADMIN_SETTINGS',				TBL_PREF.'admin_settings');
define('SUBADMIN',						TBL_PREF.'subadmin');
define('USERS',							TBL_PREF.'users');
define('FEATUREKEYS',							TBL_PREF.'featurekeys');
define('REFLECTION',							TBL_PREF.'reflection');
//define('CATEGORY',						TBL_PREF.'category');
define('CATEGORY_EN',						TBL_PREF.'category');
define('COUPONCARDS',					TBL_PREF.'couponcards');
define('GIFTCARDS',						TBL_PREF.'giftcards');
define('GIFTCARDS_SETTINGS',			TBL_PREF.'giftcards_settings');
define('GIFTCARDS_TEMP',				TBL_PREF.'giftcards_temp');
define('SUBSCRIBERS_LIST',				TBL_PREF.'subscribers_list');
define('NEWSLETTER',					TBL_PREF.'newsletter');
//define('CMS',							TBL_PREF.'cms');
define('CMS_EN',						TBL_PREF.'cms');
define('CMS_HELP',						TBL_PREF.'help');
//define('PRODUCT',						TBL_PREF.'product');
define('PRODUCT_EN',					TBL_PREF.'product');
define('GET_NOTIFIED',					TBL_PREF.'get_notified');
define('PRODUCT_CATEGORY',				TBL_PREF.'product_category');
define('LOCATIONS',						TBL_PREF.'location');
define('PAYMENT_GATEWAY',				TBL_PREF.'payment_gateway');
define('STATE_TAX',						TBL_PREF.'state_tax');
define('ATTRIBUTE',						TBL_PREF.'attribute');
define('FEEDBACK',						TBL_PREF.'feedback');
define('PRODUCT_FEEDBACK',				TBL_PREF.'product_feedback');
define('REPORT_REVIEW',				 	TBL_PREF.'report_review');
define('FEATURE_PRODUCT',				TBL_PREF.'feature_product');
define('PRODUCT_LIKES',					TBL_PREF.'product_likes');
define('FEATURE_PACK',					TBL_PREF.'feature_pack');
define('LANGUAGES',						TBL_PREF.'languages');
define('SHOPPING_CART',					TBL_PREF.'shopping_carts');
define('PAYMENT',						TBL_PREF.'payment');
define('SHIPPING_ADDRESS',				TBL_PREF.'shipping_address');
define('BILLING_ADDRESS',				TBL_PREF.'billing_address');
define('COUNTRY_LIST',		 			TBL_PREF.'country');
define('USER_ACTIVITY',		 			TBL_PREF.'user_activity');
define('LISTS_DETAILS',		 			TBL_PREF.'lists');
define('WANTS_DETAILS',		 			TBL_PREF.'wants');
define('LIST_VALUES',		 			TBL_PREF.'list_values');
define('FANCYYBOX',		 				TBL_PREF.'fancybox');
define('FANCYYBOX_TEMP', 				TBL_PREF.'fancybox_temp');
define('FANCYYBOX_USES', 				TBL_PREF.'fancybox_uses');
define('USER_PRODUCTS', 				TBL_PREF.'user_product');
define('PRODUCT_COMMENTS', 				TBL_PREF.'product_comments');
define('NOTIFICATIONS', 				TBL_PREF.'notifications');
define('VENDOR_PAYMENT', 				TBL_PREF.'vendor_payment_table');
define('REVIEW_COMMENTS', 				TBL_PREF.'review_comments');
define('BANNER_CATEGORY', 				TBL_PREF.'banner_category');
define('PRODUCT_ATTRIBUTE', 			TBL_PREF.'product_attribute');
define('SUBPRODUCT', 					TBL_PREF.'subproducts');
define('TRANSACTIONS',					TBL_PREF.'transaction');
define('CONTACTSELLER',					TBL_PREF.'contact_seller');
define('CONTACTSHOPSELLER',				TBL_PREF.'contact_shop_owner');
define('CONTACTUSER',					TBL_PREF.'contact_user');
define('USER_SHOPPING_CART',			TBL_PREF.'user_shopping_carts');
define('USER_PAYMENT',					TBL_PREF.'user_payment');
define('BANNER',						TBL_PREF.'banner');
define('SELLER',						TBL_PREF.'seller');    
define('SHIPPING',						TBL_PREF.'shipping');
define('FAVORITE',						TBL_PREF.'favorite');
define('SHOP_SECTION_LIST',				TBL_PREF.'shop_section_list');
define('SHOP_SECTION_DETAILS',			TBL_PREF.'shop_section_details');
define('SUB_SHIPPING',					TBL_PREF.'sub_shipping');  
define('CURRENCY',				    	TBL_PREF.'currency');   
define('CREDITCARDS',				    TBL_PREF.'credit_cards');   
define('TESTIMONIALS',				    TBL_PREF.'testimonials');  
define('SPAM_REPORT',				    TBL_PREF.'spam_report');
define('REGISTRY',				    	TBL_PREF.'registry');   
define('CONTACTPEOPLE',				    TBL_PREF.'contact_people'); 
define('REGISTRY_LISTINGS',				TBL_PREF.'registry_listings'); 
define('ORDER_COMMENTS',				TBL_PREF.'order_comments');
define('DIGITAL_FILE_HISTORY',			TBL_PREF.'digital_files_history');   
define('REGISTRY_REQUEST',				TBL_PREF.'registry_requests');      
define('STATE_LIST',					TBL_PREF.'states');
define('SELLER_TAX',					TBL_PREF.'seller_tax');
define('ORDER_CLAIM',					TBL_PREF.'claim');
define('COD_PAYMENT',					TBL_PREF.'cod_payment');
define('MOBILE_PAYMENT',				TBL_PREF.'mobile_payment');
define('SHIPPING_PROFILE',			    TBL_PREF.'shipping_profile');
define('SHIPPING_PROFILE_LIST',			TBL_PREF.'shipping_profile_list');
define('LANDING_BANNER',				TBL_PREF.'landing_banner');
define('BANNER_SETTINGS',				TBL_PREF.'index_banner_settings'); 
define('MEMBER_TRANSACTION',			TBL_PREF.'member_transaction'); 
define('MEMBER_IPN',					TBL_PREF.'ipn'); 
define('ADS',							TBL_PREF.'ads');
define('ADVERTISING',					TBL_PREF.'advertising');
define('THEME_LAYOUT', 					TBL_PREF.'theme_layout');
define('THEME',							TBL_PREF.'theme');
define('AFFILIATE',						TBL_PREF.'affiliate_settings');
define('AFFCOOKIE',						TBL_PREF.'affiliate_cookie');
define('PROOF',							TBL_PREF.'payment_proof');

define('SHIPPIN_METHODS',				TBL_PREF.'shipping_methods');
define('HOME_SLIDERS',                  TBL_PREF.'home_sliders');
define('IPWHITELIST',                   TBL_PREF.'ipwhitelist');            
/* 
|--------------------------------------------------------------------------
| Community :-  Table  Constants
|--------------------------------------------------------------------------
|
*/

define('COMMUNITY_TBL_PREF',	    'community_');
define('EVENTS',					TBL_PREF.COMMUNITY_TBL_PREF.'events');
define('TEAMS',						TBL_PREF.COMMUNITY_TBL_PREF.'teams');
define('TEAMDISCUSSSION',			TBL_PREF.COMMUNITY_TBL_PREF.'teamdiscussion');
define('TEAMMEMBERS',			    TBL_PREF.COMMUNITY_TBL_PREF.'teammember');
define('NEWSCOMMENT',				TBL_PREF.COMMUNITY_TBL_PREF.'newscomments');
define('NEWS',						TBL_PREF.COMMUNITY_TBL_PREF.'news');


/* 
|--------------------------------------------------------------------------
| zendesk  :-  Table  Constants
|--------------------------------------------------------------------------
|
*/

define('ZENDESK_DOMAIN',						TBL_PREF.'zendesk_domain');


/*
|--------------------------------------------------------------------------
| Community :-  Path  Constants
|--------------------------------------------------------------------------
|
*/

define('EVENT_PATH',					'images/community/events/'); 
define('TEAM_PATH',						'images/community/teams/'); 
define('COMMUNITY_NEWS_PATH',			'images/community/news/'); 
define('COMMUNITY_NEWS_PATH_THUMB',			'images/community/news/thumb/'); 
define('COMMUNITY_NEWS_PATH_ALBUM',			'images/community/news/album/'); 
define('BANNERPATH', 					'images/banner/');

define('ADMIN_PATH',						'admin');

/*
|--------------------------------------------------------------------------
| Path Constants
|--------------------------------------------------------------------------
|
*/

define('CATEGORY_PATH',					'images/category/'); 
define('GIFTPATH', 						'images/giftcards/');
define('GIFTPATH_THUMB', 				'images/giftcards/thumb/');
define('GIFTPATH_ALBUM', 				'images/giftcards/album/');
define('PRODUCTPATH', 					'images/product/');
define('PRODUCTPATHTHUMB',				'images/product/thumb/');
define('PRODUCTPATHLIST',				'images/product/list-image/');
define('FANCYBOXPATH', 					'images/fancyybox/');

define('USERIMAGEPATH', 				'images/users/');

/*
|--------------------------------------------------------------------------
| Blog :-  Path  Constants
|--------------------------------------------------------------------------
|
*/
define('USER',	TBL_PREF.'users');
define('COMMENT',	TBL_PREF.'comment');
//define('POSTS',	TBL_PREF.'posts');
define('BLOG_USERS',	TBL_PREF.'sb_users');
define('POSTS',	TBL_PREF.'sb_posts');
define('POSTMETA',	TBL_PREF.'sb_postmeta');

/*
|--------------------------------------------------------------------------
| Blog :-  Path  Constants
|--------------------------------------------------------------------------
|
*/



//define('SITE_COMMON_DEFINE', 'artizanz-');

/* End of file constants.php */
/* Location: ./application/config/constants.php */