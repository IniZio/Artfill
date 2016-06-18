<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width"/>
<base href="<?php echo base_url(); ?>">
<title><?php echo $heading.' - '.$title;?></title>

        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/microtpl.js"></script>
        <!-- lce itself -->
        <script src="js/jquery.livecsseditor.js"></script>
        <link rel="stylesheet" type="text/css" href="css/livecsseditor.css">
        <script src="js/lce.editors.js"></script>
        <!-- colorpicker -->
        <link rel="stylesheet" media="screen" type="text/css" href="plugins/colorpicker/css/colorpicker-bootstrap.css"/>
        <script type="text/javascript" src="plugins/colorpicker/js/colorpicker-bootstrap.js"></script>
        <!-- twitter bootstrap -->
        <link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css"  media="screen">
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- jquery ui -->
        <link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.9.1/css/smoothness/jquery-ui-1.9.1.custom.min.css"  media="screen">
        <script src="plugins/jquery-ui-1.9.1/js/jquery-ui-1.9.1.custom.min.js"></script>  
		<style>
		
			.page-header{
				border:none;
				margin:0px;
			}
			.main-containder{
				width: 1210px;
				margin:0 auto;
			}
			.back-btn{
				float:right;
				margin-bottom: 25px;
				margin-top: 15px;
				width:100%;
			}
			.back-btn a{
				 background: none repeat scroll 0 0 #01a9db;
				border: 2px solid #01a9db;
				border-radius: 6px;
				color: #ffffff;
				cursor: pointer;
				float: right;
				margin: 0;
				padding: 7px 23px;
				text-align: right;		
		}
		.btn {
				background: none repeat scroll 0 0 #01a9db;
				border: 2px solid #01a9db;
				border-radius: 6px;
				color: #ffffff;
				cursor: pointer;
				margin: 10px 40px;
				padding: 7px 23px;
				text-align: center;
			}
			.accordion-toggle:hover{
				text-decoration: none;
				color:#ffffff;
			}
			.accordion-toggle{
			background:#373737;
			border-bottom: 1px solid #fff;
			border-top: 1px solid #fff;
			color: #fff;
			font-size: 12px;
			}
		
		
		</style>
		
    </head>
    <body>
        <div class="page-header">
		
		<div class="main-containder">
          
		  <div class="back-btn">
				<a href="admin/layout/display_theme_list"><< Back</a>
		</div>
            
			
		</div>
			
        </div>        
        <div class="container-fluid" id="lce"></div>        
        <script>
            $(document).ready(function(){
                $('#lce').livecsseditor({
                    pages: {
                        './homepage.php': {
                            name: 'Home page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div#landing_div, div#landing_div h1':{
									name:'Background',
									props:['background-color','color']
								},
								'span.owner-details em,span.owner-details span':{
									name:'Banner Text Color',
									props:['color']
								},
								'div.get-pro':{
									name:'Subscriber Box',
									props:['color','background-color']
								},
								'span.subcribe-box  form input.search-bt':{
									name:'Subscribe Button',
									props:['color','background','border-color']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './search_page.php': {
                            name: 'Search page',
                            def: {
                               'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div#product_search_div':{
									name:'Product Container',
									props:['background-color']
								},
								'div#secondary':{
									name:'Category list',
									props:['background-color','border-color']
								},
								'ul.search-restrictions':{
									name:'Sreach Result',
									props:['color']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './cart_page.php': {
                            name: 'Cart page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'h2,div.s-cart-bl-header':{
                                    name: 'Shop Name',
                                    props:['color','background-color']
                                } ,
								'div#cart_div':{
									name:'Background',
									props:['background-color','color']
								},
								'div.card_for_temp,div.cart_details,ul.suggestion-list':{
									name:'Cart Product Background',
									props:['background-color','color']
								},
								'a.s-cart-button':{
									name:'Button',
									props:['color','background','border-color']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								}
                            }
							
                        },/* 
                        './empty_cart.php': {
                            name: 'Empty Cart page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'h2,h1':{
                                    name: 'Shop Name',
                                    props:['color','background-color']
                                },								
								'div.card_for_temp':{
									name:'Cart Background',
									props:['background-color']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color','background']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        }, */
                        './product_detail_page.php': {
                            name: 'Product Detail page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},								
								'div#product_detail_div':{
									name:'Background',
									props:['background-color']
								} ,
								'div.middel-detail,div.col-md-12.realated-this-item,div.seller-wrapper,div.content-seller':{
									name:' Product Detail',
									props:['background-color']
								},
								'div.tab-content,div.related-listing-inner,div.favorites-nag,div.listing-page-cart,div.listing-page-cart-inner,div#favoriting-and-sharing':{
									name:'Contents',
									props:['background']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color','background']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './shop_page.php': {
                            name: 'Shop page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div.add_shop,div.add_shop ul.add_steps,div.add_shop ul.add_steps a':{
                                    name: 'Shop Header',
                                    props:['background-color','color']
                                },
								'div#shop_page_seller,div#shop_page_seller p.pay_p':{
									name:'Background',
									props:['background-color','color']
								},
								'div.art,div.listings-title,div.product_box,div.list_wrap,div#shop-info,div.shop-sections-container_left,div.shop-sections-container_right,div.sh_border,div.sh_border1,div#add-photos .list_inner_fields,div#variation_one .list_inner_fields,div#variation_two .list_inner_fields,table.table.table-striped,div.sh_border h4,table#tbNames td ,table#tbNames th,table.tab_form_list_table,table.tab_form_list_table tr th,div.list_div1,div.list_div1  div.list_inner_fields,div.list_div,div.payment_hide p,div.payment_hide  table label,div.payment_btn,div.community_right':{
									name:'Contents Background',
									props:['background-color','color']
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './seller_page.php': {
                            name: 'Seller page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'a#signin-icon ':{
									name:'Sign in button ',
									props:['color','background-color']
								},
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'nav#nav-main a,div.add_steps':{
                                    name: 'Profile Header',
                                    props:['background-color','color','border-color']
                                },
								'div#seller_div':{
									name:'Background',
									props:['background-color']
								},
								'div.community_right':{
									name:'Profile Background',
									props:['background-color']
								},
								'div#bio':{
                                    name: 'About Seller',
                                    props:['background-color','color','border-color']
                                },
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './user_profile.php': {
                            name: 'User Profile page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div.add_steps div.main nav#nav-main a,div.add_steps':{
                                    name: 'Profile Header',
                                    props:['background-color','color','border-color']
                                },
								'div#profile_div':{
									name:'Background',
									props:['background-color']
								},
								'div.community_right,div.split_prefile h2,div.split_prefile p,span#display_first_name,div.pro_check label,div.profile_field span,div.field_account label,div.convers,div.shipping_field label,div.cart-list,div.cart-list div.card-payment div#complete-payment,div.cart-list.chept2 div.card-payment,div.cart-list.chept2  div.hotel-booking-left,div#complete-payment b,div#complete-payment span,div#complete-payment label,div#complete-payment,div.hotel-booking-left  div.hotel-booking-noti,div.cart-list.chept2  div.card-payment  div.card-payment-foot,div#complete-payment big,div.community_right span.order_text,div.community_right span.trans_text,div.community_right span.date-no,div.community_right label.order_text-number,div.community_right div.order_side-right1 p,table#order_table_view':{
									name:'Settings Background',
									props:['background-color','color']
								},
								'div.split_prefile a,input#profile_submit':{
									name:'Button',
									props:['background','color']
								},								
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './favorite.php': {
                            name: 'Favorite page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div#fav_list_tag':{
                                    name: 'Background',
                                    props:['background']
                                },
								'div.favorite_box1':{
									name:'Favorite List Background',
									props:['background']
								},	
								'ul.owner-fav li a,ul.owner-fav li a span':{
									name:'Tabs',
									props:['background','color']									
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './favorit_shop.php': {
                            name: 'Favorite Shop page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div#fav_shop_list':{
                                    name: 'Background',
                                    props:['background']
                                },
								'div.community_div':{
                                    name: 'Favorite Background',
                                    props:['background']
                                },									
								'div.add_steps,div.add_steps ul.add_steps  li,div.add_steps ul.add_steps li a':{
									name:'Page Header',
									props:['background','color']									
								},
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Copy Right',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        },
                        './community.php': {
                            name: 'Community Page',
                            def: {
                                'div.header_top':{
                                    name: 'Header Background',
                                    props:['background-color']
                                },
                                'input#search_items':{
                                    name: 'header searchbox',
                                    props:['border-color']
                                },
                                'input.search-bt':{
                                    name:'Search Button',
                                    props:['color','background','border-color']
                                },
                                'button.browse':{
                                    name:'Browes Button',
                                    props:['color','background-color']
                                },
                                'span.icon-text,div.cart-top a':{
                                    name:'Home page Text',
                                    props:['color']
                                },
								'span#CartCount1':{
									name:'Cart Notification',
									props:['color','background-color']
								},
								'div.add_steps div.main nav#nav-main a,div.add_steps':{
                                    name: 'Community Header',
                                    props:['background-color','color','border-color']
                                },
								'div#community_tag':{
									name:'Background',
									props:['background-color']
								},
								'div.hole_content,div#property_table_info,div#property_table_filter label':{
									name:'Content Background',
									props:['background','color']
								},
								'div#activeInactiveTop a.see_more':{
									name:'Button',
									props:['background','color']
								},
								'table#property_table,table#property_table thead tr,table.property_table td':{
									name:'Table',
									props:['background','color']
								},								
								'section.foot-bg':{
									name:'Footer Background',
									props:['background']
								},
								'div.footer-block ul.footer-list li a':{
									name:'Footer Text',
									props:['color']
								},
								'div.footer-block span':{
									name:'Footer Heading',
									props:['color']
								},
								'ul.locale-settings li a,ul.locale-settings':{
									name:'Language Settings',
									props:['color']
									
								},
								'div.footer-row a div.help-bt':{
									name:'Help Button',
									props:['color','background']									
								},
								'ul.bt-menu li#copy,ul.bt-menu li a':{
									name:'Bottom Text',
									props:['color','background']
								},
								'a div.search-bt':{
									name:'Open Shop',
									props:['color','background','border-color']
								}
                            }
							
                        }
                    }
                });
                //css button
               
            });
        </script>
		<input type="hidden" id="page_name" name="page_name" value="Home-page">
		<input type="hidden" name="theme_id" id="theme_id" value="<?php echo $theme_name;?>">
		<!--<div style="height: 22px; width: 73px;background-color: rgb(197, 223, 193); margin-top: 15px;margin-left: 547px;">
			<a style="padding-left: 17px;float: left; color:rgb(82, 23, 23);" href="admin/layout/display_theme_list">Back</a>
		</div>-->
    </body>
</html>