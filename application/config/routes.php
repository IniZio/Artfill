<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|

| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['ajaxsearch'] = "site/ajaxsearch";
$route['default_controller'] = "site/landing";
$route['404_override'] = '';

$route['admin'] = "admin/adminlogin";
$route['test'] = "admin/adminlogin/test";

$route['reflection'] = "site/user/reflection_form";
$route['signup'] = "site/user/signup_form";
$route['login'] = "site/user/signup_form";
$route['register'] = "site/user/register_form";
$route['logout'] = "site/user/logout_user";
$route['forgot-password'] = "site/user/forgot_password_form";
$route['reopen-account'] = "site/user/reopen_account";
$route['settings-password'] = "site/user_settings/password_settings";
$route['friends'] = "site/user/find_friends";
$route['twitter-update'] = "site/user/twitter_update";
$route['lang/(:any)'] = "site/user/language_change/$1";
$route['resetPassword/(:any)'] = "site/user/resetPassword/$1";


/****************Cart and Checkout routes start**********************/
$route['cart'] = "site/cart";
$route['checkout/(:any)'] = "site/checkout";
$route['order/(:any)'] = "site/order";
$route['gift-cards'] = "site/giftcard";
$route['gift-cards/print-at-home'] = "site/giftcard/print_at_home";
$route['gift-cards/(:any)'] = "site/giftcard/edit/$1";
$route['enable-javascript'] = "site/user/enable_javascript/";
/*****************Cart and Checkout routes end*******************/

/***************** Order View Routes Start *******************/
$route['view-purchase/(:any)'] = "site/user/view_purchase"; 
$route['view-seller-purchase/(:any)'] = "site/user/view_seller_purchase"; 
$route['view-order/(:any)'] = "site/user/view_order";
$route['view-order-pre/(:any)'] = "site/user/view_order_pre";

$route['view-seller-order/(:any)'] = "site/user/view_seller_order";
$route['order-review/(:num)/(:num)/(:any)'] = "site/user/order_review"; 
$route['order-seller-review/(:num)/(:num)/(:any)'] = "site/user/order_seller_review"; 
$route['order-review/(:num)'] = "admin/order/order_review";
/***************** Order View Routes Start *******************/

/****************** Community Routes Start*************************/

$route['community'] = "site/community/community_home";

$route['pages/(:any)'] = "site/cms";
$route['help'] = "site/cms/help";   
$route['events'] = "site/community/events_list";
$route['add-event'] = "site/community/useraddEvent";
$route['edit-event/(:any)'] = "site/community/useraddEvent";
$route['manage-events'] ="site/community/eventmanageview";

$route['teams/(:any)'] = "site/community/teams_list";  
$route['teams'] = "site/community/teams_list";  
$route['team-members/(:any)'] = "site/community/team_members"; 
$route['teams-search/(:any)'] = "site/community/teams_searchlist"; 
$route['team/(:any)'] = "site/community/team_detail"; 
$route['add-team'] = "site/community/add_team_form";
$route['edit-team/(:any)'] = "site/community/add_team_form";
$route['discuss/(:any)'] = "site/community/discussionDetails";
$route['create-thread/(:any)'] = "site/community/teamaddnewthread";
$route['join-team/(:any)'] = "site/community/joinTeam";
$route['leave-team/(:any)'] = "site/community/leaveTeam";
$route['manage-teams'] ="site/community/teammanageview";
$route['manage-discussions'] ="site/community/teamdiscussionview";
$route['manage-discussions-thread/(:any)'] ="site/community/teamdiscussionThreadview";
$route['discussions/(:any)'] = "site/community/team_discussions"; 

$route['manage-community'] ="site/community/blogpostview";
$route['community-new-post'] ="site/community/blogaddpost";
$route['community-post-comments'] ="site/community/blogcommentsview";
$route['community-newslist'] ="site/community/userBlogPage";
$route['community-newslist/(:any)'] ="site/community/userBlogPage";
$route['(:any)/news-details'] ="site/community/userPostComments";
$route['(:any)/news-details/(:any)'] ="site/community/userPostComments";

/****************** Community Routes End*************************/


/****************product routes start**********************/
// $route['productjson_echo'] = "site/product/get_product_details";
$route['productjson'] = "site/product/get_product_details";
$route['products/(:any)'] = "site/product/display_product_detail/$1"; 
$route['product/(:any)/favoriters'] = "site/product/display_product_favoriters/$1";
$route['add-product'] = "site/product/add_shop_product";
$route['edit-product/(:any)'] = "site/product/edit_shop_items/$1"; 

$route['copy-product/(:any)'] = "site/product/copy_shop_items/$1"; 

$route['admin-edit-product/(:any)'] = "site/product/edit_shop_items/$1"; 
$route['admin-copy-product/(:any)'] = "site/product/copy_shop_items/$1"; 

$route['category-list/(:any)'] = "site/product/load_category_Listpage/$1";
$route['browse/(:any)'] = "site/product/load_product_Listpage/$1";
$route['search/(:any)'] = "site/product/search_product/$1";
$route['find/(:any)'] = "site/search/find";
$route['preview/(:any)'] = "site/shop/Preview/$1";   
$route['admin-preview/(:any)'] = "site/shop/Preview/$1";   
$route['currency'] = "site/user_settings/change_currency"; 

$route['dispute-attachment'] = "site/order/closedclaim"; 
$route['post-dispute'] = "site/order/postcomment"; 

//$route['sizeby/(:any)'] = "site/searchShop/search_sizeby/$1";

/*****************product routes end*******************

/*****************people routes start*******************/
$route['settings/giftcards'] = "site/user_settings/user_giftcards";
$route['manage-notification'] = "site/user_settings/manage_notification";
$route['save-notification-changes']="site/user_settings/save_noty_change";
$route['people/(:any)/favorites']="site/user/people_favorite_list";
$route['people/(:any)/favorites/items-i-love']="site/user/people_favorite_list_itemsilove";
$route['people/(:any)/favorites/list/(:any)']="site/user/people_list_items";
$route['people/(:any)/favorites/(:any)']="site/user/people_favorite_shoplist";
$route['people/(:any)/following']="site/user/display_user_following";
$route['people/(:any)/followers']="site/user/display_user_followers";
$route['people/(:any)/conversations']="site/user/display_conversations";
$route['people/(:any)/conversations/(:any)/(:any)']="site/user/view_message";
$route['view-people/(:any)']="site/user/view_people/$1";
$route['activity']="site/user/activity";
$route['activity/shop']="site/user/activity_shop";
$route['activity/interaction']="site/user/activity_interaction";
$route['']="site/user/category";
$route['verify']="site/user/verify_user_email";
/*****************people routes end*******************/

/****************** Seller Start*************************/
//$route['shop/(:any)/(:any)'] = "site/seller/seller_product_view/$1";
$route['your-shop'] = "site/shop/open_new_shop/";
$route['shop/managelistings'] = "site/shop/manageListings";
$route['shop/statistics'] = "site/shop/display_shop_statistics";
$route['shop/(:any)'] = "site/shop/load_shop_open/$1";
$route['feature_success/(:any)/(:any)/(:any)/(:any)']="site/checkout/feature_success";
$route['appearance/(:any)/(:any)']="site/shop/load_info_appearance";
$route['policies/(:any)/(:any)']="site/shop/load_shop_policies";
$route['shops/(:any)/profile']="site/shop/load_shopowner_profile";
$route['shops/(:any)/sections/(:any)']="site/shop/load_shop_sections";
$route['shops/(:any)/Preview/(:any)']="site/shop/load_shop_preview/$1/$2";
$route['shops/(:any)/favoriters']="site/shop/display_shop_favoriters/$1";
$route['promote-shop']="site/shop/promote_shop";
$route['shops/(:any)/coupon-code']="site/shop/display_couponcards";
$route['shops/(:any)/add-coupon-code']="site/shop/add_couponcard";
$route['shops/(:any)/edit-coupon-code/(:any)']="site/shop/edit_couponcard/$2";
$route['shops/(:any)/contact-user']="site/shop/display_contact_user";
$route['shops/(:any)/view-contact-user/(:any)']="site/shop/view_contact_user";
$route['shops/(:any)/replay-contact-user/(:any)']="site/shop/replay_contact_user";
$route['shops/(:any)/delete-contact-user/(:any)']="site/shop/delete_contact_user";
$route['shops/(:any)/shop-transaction']="site/shop/display_shop_transaction";
/*$route['shops/(:any)/view-transaction/(:any)']="site/shop/view_shop_transaction";*/
$route['pesapal_response_feature/(:any)/(:any)/(:any)/(:any)']= 'site/checkout/pesapal_response_feature';
$route['shops/(:any)/view-transaction/(:any)']="site/shop/view_shop_transaction";
$route['shops/(:any)/shop-orders']="site/shop/display_shop_orders";
$route['shops/(:any)/commision-tracking']="site/shop/display_commision_log";
$route['shops/(:any)/shop-cod']="site/shop/display_shop_cod_orders";
$route['shops/(:any)/withdraw-req']="site/shop/send_withdraw_req";
$route['shops/(:any)/tax-list']="site/tax/display_tax_list";
$route['shops/(:any)/add-tax']="site/tax/add_tax_form";
$route['shops/(:any)/edit-tax/(:any)']="site/tax/edit_tax_form/$1";

$route['shops/(:any)/view-orders/(:any)']="site/shop/view_shop_orders";
$route['discussion/(:any)']="site/order/discussion/$1";
$route['shop-index'] = "site/shop/Load_shop_welcome/";
/****************** Seller End*************************/

$route['payment-success'] = "admin/commission/display_payment_success";
$route['payment-failed'] = "admin/commission/display_payment_failed";
$route['display_all_ipwhitelisters']="admin/ipwhitelist/display_all_ipwhitelisters";

/****************** Blog Routes Start******************************************************************************/
$route['view-blog'] ="blog/blog_controller/userCommonBlog";
$route['blog-all-post'] ="blog/blog_controller/blogpostview";
$route['blog-unpublished'] ="blog/blog_controller/blogunpublishview";
$route['blog-published'] ="blog/blog_controller/blogpublishview";
$route['blog-comments'] ="blog/blog_controller/blogcommentsview";
$route['blog-new-post'] ="blog/blog_controller/blogaddpost";
$route['blog-edit-post'] ="blog/blog_controller/blogeditpost";
$route['blog-drafts'] ="blog/blog_controller/blogdraftview";
$route['blog-setup'] ="blog/blog_controller/blogsetup";
$route['store-blog-page'] ="blog/blog_controller/userBlogPage";
$route['store-blog-page/(:any)'] ="blog/blog_controller/userBlogPage";
$route['store-blog-archive/(:any)'] ="blog/blog_controller/userArchivePage";
$route['(:any)/store-post-comments'] ="blog/blog_controller/userPostComments";
$route['(:any)/store-post-comments/(:any)'] ="blog/blog_controller/userPostComments/$1";
$route['send-confirm-mail'] ="site/user/send_register_mail";
$route['settings/my-account/(:any)']="site/user/display_user_profile/$1";
$route['public-profile']="site/user/public_profile";
$route['view-profile/(:any)']="site/user/view_people/$1";
$route['prototypes']="site/user/prototypes";


$route['home']="site/user/after_login";


$route['purchase-review']="site/user/purchase_review";
$route['reviews'] = "site/product/reviews";
$route['disputes'] = "site/shop/disputes";

$route['purchases/(:any)']="site/user/purchase_review/$1";
$route['delete-order/(:any)']='site/user/remove_order/$1';
$route['settings/account-preferences']="site/user_settings/account_preferences";
$route['update-preferences']="site/user_settings/update_preference_settings";
$route['update_privacy']="site/user_settings/update_privacy_settings";
$route['settings/account-privacy']="site/user_settings/account_privacy";
$route['settings/account-security']="site/user/account_security";
$route['settings/account-shipping-address']="site/user/account_shipping_address";
$route['settings/account-creditcard']="site/user/account_creditcard";
$route['settings/account-email']="site/user/account_email";
$route['settings/cart-shipping-address']="site/user/cart_shipping_address";

/****************** Shop Sections routes start************************/
$route['shop/(:any)'] = "site/shop/load_shop_open/$1";
$route['shop-section/(:any)']="site/shop_section/get_shop_section_list/$1";
/****************** Shop Sections routes end************************/

$route['digital-files/(:any)/(:any)'] = "site/order/digital_files/$1/$2";
$route['download-file/(:any)/(:any)/(:any)'] = "site/order/donwload/$1/$2/$3";
$route['link-expire'] = "site/order/expire_link";
/****************** registry  routes start here************************/
$route['registry'] = "site/market/loadRegistry";
$route['upload-products'] = "site/product/upload_product_form";
$route['custom-upload-products'] = "site/product/custom_upload_product_form";
$route['csv-status/(:any)'] = "site/product/custom_upload_csv_status/$1";
/**************** registry routes ends here*****************************/


/****************** market  routes start************************/
$route['market/(:any)'] = "site/market";
$route['spam-report'] = "site/market/spam_report";   
/*$route['admin/spam/spamProductList'] = "admin/market/spam_product_List";
$route['admin/spam/spamShopList'] = "admin/market/spam_shop_List"; 
$route['admin/spam/view_product_spam'] = "admin/market/view_product_spam";
$route['admin/spam/delete_product_spam'] = "admin/spam/delete_product_spam";   //*/

/****************** market  routes end************************/


/****************** Json routes start************************/
$route['android/(:any)'] = "site/mobile/mobilePages";
$route['cms/jsonpages/(:any)'] = "site/mobile/mobilePagesjson";
$route['ios/(:any)'] = "site/mobile/mobilePages";
$route['json/category'] = "site/mobile/category";
$route['json/homepage'] = "site/mobile/homepage";
$route['json/pickspage'] = "site/mobile/pickspage";
#$route['json/product'] = "site/mobile/product";
$route['json/product'] = "site/mobile/product_pagination";
$route['json/product/pagecount'] = "site/mobile/product_pagination";

$route['json/product/ios'] = "site/mobile/product_pagination_ios";
$route['json/product/pagecount/ios'] = "site/mobile/product_pagination_ios";

$route['json/user/login'] = "site/mobile/user_login/$1";
$route['json/facebooklogin'] = "site/mobile/facebook_login";
$route['json/googlelogin'] = "site/mobile/google_login";
$route['json/user/register'] = "site/mobile/user_register/$1";
$route['json/products/detailspage'] = "site/mobile/product_detailspage";
$route['json/review'] = "site/mobile/viewAllreview";
$route['json/searchpage'] = "site/mobile/searchpage";
$route['json/search/pagecount'] = "site/mobile/search_pagination";

$route['json/search/pagecount/ios'] = "site/mobile/search_pagination_ios";

$route['json/favorite/add-remove']="site/mobile/favorite_add_remove";
$route['json/list']="site/mobile/favorite_list_add_remove";
$route['json/filter']="site/mobile/product_filter";

$route['json/filter/ios']="site/mobile/product_filter_ios";

$route['json/shops']="site/mobile/display_all_shops";
$route['json/trending']="site/mobile/display_trending";
$route['json/trending/ios']="site/mobile/display_trending_ios";
$route['json/alltrending']="site/mobile/display_all_trending";
$route['json/feed/(:any)']="site/mobile/display_feed/$1";
/***********Cart routes for mobile app starts here***********/
$route['json/cartCount']="site/mobile/cartCount";
$route['json/cartadd']="site/mobile/cart_add";
$route['json/yourcart/(:any)']="site/mobile/display_cart/$1";
$route['json/cart/update']="site/mobile/updateCart";
$route['json/cart/removeProduct']="site/mobile/remove_cartProduct";
$route['json/cart/removeShop']="site/mobile/remove_cartShop";
$route['json/cart/updateaddr']="site/mobile/updateCartAddress";
$route['json/cart/add-coupon']="site/mobile/couponCodeAdd";
$route['json/cart/remove-coupon']="site/mobile/couponCodeRemove";
$route['json/country-list']="site/mobile/country_list";
$route['json/checkCode'] = "site/mobile/checkCode";
$route['json/checkCodeRemove'] = "site/mobile/checkCodeRemove";
/***********Cart routes for mobile app ends here************/
$route['json/user/profile/(:any)']="site/mobile/user_profile/$1";
$route['json/user/profile1/(:any)']="site/mobile/user_profile_image/$1";
$route['json/user/favorite/(:any)']="site/mobile/view_favorite_details/$1";
$route['json/user/purchases']="site/mobile/purchases";
$route['json/view-order']="site/mobile/viewOrder";
$route['json/user/change-image']="site/mobile/thumbnailChange";
$route['json/checkfavorite']="site/mobile/check_favorite";
/***********Currency routes for mobile app starts here************/
$route['json/currency-list']="site/mobile/currency_list";
$route['json/currency-list/(:any)']="site/mobile/currency_setting/$1";

/****************** Seller App routes starts************************/
$route['seller/login'] = "site/sellerapp/seller_login";
$route['seller/forgot-password'] = "site/sellerapp/forgot_password_seller";
$route['seller/stats'] = "site/sellerapp/statistics";
$route['seller/category'] = "site/sellerapp/category";
$route['seller/add-product'] = "site/additems/add_item";
$route['seller/upload-image'] = "site/additems/upload_product_image";
$route['seller/upload-product'] = "site/additems/add_product_item";
$route['seller/edit-product'] = "site/additems/editListings";
$route['seller/copy-product'] = "site/additems/copyproduct";
$route['seller/activity/(:any)']="site/sellerapp/seller_activity";
$route['seller/view-profile']="site/sellerapp/viewuserProfile";
$route['seller/list-items']="site/sellerapp/itemsListing";
$route['seller/order']="site/sellerapp/shopOrders";
$route['seller/manage-order']="site/sellerapp/orderUpdate";
$route['seller/view-order']="site/sellerapp/viewOrder";
$route['seller/follow']="site/sellerapp/followUser";
$route['seller/unfollow']="site/sellerapp/unfollowUser";
$route['seller/list-claims']="site/sellerapp/viewClaims";
$route['seller/view-discussion']="site/sellerapp/viewDiscussion";
$route['seller/post-msg']="site/sellerapp/postComment";
$route['seller/solve-dispute']="site/sellerapp/solvedDispute";
$route['seller/dispute_attachment']="site/sellerapp/dispute_attachment_common";
$route['seller/country-list']="site/sellerapp/country_list";
$route['seller/searchpage'] = "site/sellerapp/searchpage";
$route['seller/products-details'] = "site/sellerapp/productdetails";
$route['seller/edit-item'] = "site/sellerapp/editproduct";
$route['seller/copy-item'] = "site/sellerapp/copyproduct";
/****************** Seller App routes end************************/

/****************** Mobile checkout routes starts************************/
$route['mobile/shipping-address'] = "site/mobilecart/shipping_address";
$route['mobile'] = "site/mobile/proceedPayment";
$route['mobile/add-shipping-address'] = "site/mobilecart/add_shipping";
$route['mobile/add-cart-shipping-address'] = "site/mobilecart/save_shipping";
$route['mobile/change-shipping-address/(:any)'] = "site/mobilecart/updateShipping/$1";
$route['mobile/not-shipping'] = "site/mobilecart/not_shipping";
$route['mobile/payment-form'] = "site/mobilecart/credit_card_form";
$route['mobile/userPaymentCard'] = "site/mobilecart/userPaymentCard";
$route['mobile/UserPaymentCreditStripe'] = "site/mobilecart/UserPaymentCreditStripe";
$route['mobile/PaymentCreditAjax'] = "site/mobilecart/PaymentCreditAjax";
$route['mobile/Paymenttwocheckout'] = "site/mobilecart/Paymenttwocheckout";
$route['mobile/pesapal_response'] = "site/mobilecart/pesapal_response";
$route['mobile/success/(:any)'] = "site/mobilecart/pay_success";
$route['mobile/failed/(:any)'] = "site/mobilecart/pay_failed";
$route['mobile/payment/(:any)'] = "site/mobilecart/payment_return";
/******************Mobile checkout routes end************************/

/****************** Json routes end************************/


/****************** Invite friends begin ************************/

$route['people/(:any)/invite']="site/invite_friends/display_invite_friends";
$route['settings/invite-friends'] = "site/invite_friends/display_invite_friends";
$route['settings/google-invites'] = "site/invite_friends/google_invites";
$route['settings/google-invites-return'] = "site/invite_friends/display_return_invite_list";
$route['settings/facebook-invites'] = "site/invite_friends/facebook_invites";

/****************** Invite friends end ************************/

/****************** Notification begin ************************/
$route['(:any)/notifications']="site/market/display_notifications_list";
/****************** Notification end ************************/
/***********  conversation routes starts here  *******/
$route['json/conversation']="site/mobile/display_converstion";
$route['json/view-conversation']="site/mobile/view_converstion";
$route['json/delete-message']="site/mobile/delete_message";
$route['json/delete-conversation']="site/mobile/delete_conversation";
$route['json/send-message']="site/mobile/send_message";
$route['json/make-contact']="site/mobile/make_contact";
$route['json/view-review']="site/mobile/view_feedback";
$route['json/left-review']="site/mobile/left_feedback";
$route['seller/review-list'] = "site/sellerapp/reviewList";
$route['seller/report-review'] = "site/sellerapp/reportReview";
/***********  conversation routes ends here  *******/
$route['layout/write_css']="admin/layout/write_css";
/***********  app v2 routes starts here  *******/
$route['json/viewCoupon']="site/sellerapp/viewCoupon";
$route['json/getCoupon']="site/sellerapp/getCoupon";
$route['json/saveCoupon']="site/sellerapp/saveCoupon";
$route['json/editCoupon']="site/sellerapp/editCoupon";
/***********  app v2 routes ends here  *******/


/********* Membership Subscription ********/
$route['subscribe/(:any)'] = "site/order/recurcivePaymentSuccess"; 
$route['subscribe_cancel/(:any)'] = "site/order/subscribe_cancel";
$route['subscribe_renewal/(:any)'] = "site/order/subscribe_renewal";   
$route['recursive'] = "site/order/yearlyMembershipPayment";

/********************Search Location by Shops,events,Items******************/
$route['shop-by-location'] = "site/locationsearch/searchshop";
$route['shop-by-location/(:any)'] = "site/locationsearch/searchlocation";
$route['shop-by-items'] = "site/locationsearch/searchitems";
$route['shop-by-items/(:any)'] = "site/locationsearch/filteritems";
$route['view-local-events'] = "site/locationsearch/searchevents";
$route['view-local-events/(:any)'] = "site/locationsearch/filterevents";

$route['shops/(:any)/shipping-policy']="site/store/shippingPolicy";
$route['shops/(:any)/return-policy']="site/store/returnPolicy";
$route['product/shoplatlng']="site/product/insertShopLatLng";
$route['product/productlatlng']="site/product/insertProductLatLng";
$route['view-proof/(:num)']="site/order/view_proof/$1";

/********* Unavailable page ********/
$route['coming-soon'] = "site/unavailable/comingSoon"; 

/********* Information page ********/
$route['about'] = "site/info/about"; 
$route['company'] = "site/info/company"; 
$route['joinus'] = "site/info/joinus"; 
$route['terms'] = "site/info/terms"; 
$route['privacy'] = "site/info/privacy"; 
$route['faq'] = "site/info/faq"; 


/*
|-------------------------------------------------------
|Loading Updated  routes files
|-------------------------------------------------------
|
 */
foreach (glob("convey/*.php") as $filename){
	if (is_file($filename)){
	    require_once $filename;
	}
}
/* End of file routes.php */
/* Location: ./application/config/routes.php */