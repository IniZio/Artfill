-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2015 at 01:35 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `artfill_v1_sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0cbc569f12937d7009e91de604490226', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444390276, 'a:12:{s:9:"user_data";s:0:"";s:6:"ipaddr";s:9:"127.0.0.1";s:27:"artfill_session_user_confirm";s:3:"Yes";s:8:"userType";s:6:"Seller";s:23:"artfill_session_admin_id";s:1:"1";s:25:"artfill_session_admin_name";s:5:"admin";s:26:"artfill_session_admin_email";s:19:"vinu@teamtweaks.com";s:25:"artfill_session_admin_mode";s:12:"artfill_admin";s:31:"artfill_session_admin_privileges";a:10:{s:5:"users";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:8:"category";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:11:"subcategory";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:7:"product";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"slider";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"video";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:3:"cms";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"order";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"statistics";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"newsletter";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}}s:15:"Curr_theme_name";s:2:"15";s:22:"artfill_session_temp_id";s:6:"322187";s:13:"currency_data";a:8:{s:2:"id";s:4:"NQ==";s:13:"currency_code";s:4:"VVNE";s:14:"currency_value";s:8:"MS4wMA==";s:15:"currency_symbol";s:4:"JA==";s:13:"currency_name";s:28:"VW5pdGVkIFN0YXRlcyBEb2xsYXI=";s:6:"status";s:8:"QWN0aXZl";s:9:"dateAdded";s:28:"MjAxNS0wOC0yMSAxMjozNzoyNA==";s:16:"default_currency";s:4:"WWVz";}}'),
('759552e873ed749f35defb64b39bf312', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444397560, 'a:9:{s:9:"user_data";s:0:"";s:6:"ipaddr";s:9:"127.0.0.1";s:22:"artfill_session_temp_id";s:6:"315080";s:13:"currency_data";a:8:{s:2:"id";s:4:"NQ==";s:13:"currency_code";s:4:"VVNE";s:14:"currency_value";s:8:"MS4wMA==";s:15:"currency_symbol";s:4:"JA==";s:13:"currency_name";s:28:"VW5pdGVkIFN0YXRlcyBEb2xsYXI=";s:6:"status";s:8:"QWN0aXZl";s:9:"dateAdded";s:28:"MjAxNS0wOC0yMSAxMjozNzoyNA==";s:16:"default_currency";s:4:"WWVz";}s:23:"artfill_session_admin_id";s:1:"1";s:25:"artfill_session_admin_name";s:5:"admin";s:26:"artfill_session_admin_email";s:15:"info@zoplay.com";s:25:"artfill_session_admin_mode";s:12:"artfill_admin";s:31:"artfill_session_admin_privileges";a:10:{s:5:"users";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:8:"category";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:11:"subcategory";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:7:"product";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"slider";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"video";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:3:"cms";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"order";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"statistics";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"newsletter";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}}}');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_admin`
--

CREATE TABLE IF NOT EXISTS `artfill_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_admin`
--

INSERT INTO `artfill_admin` (`id`, `created`, `modified`, `admin_name`, `admin_password`, `email`, `admin_type`, `privileges`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_verified`, `status`) VALUES
(1, '2015-05-05', '2015-10-09', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'info@zoplay.com', 'super', 'a:10:{s:5:"users";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:8:"category";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:11:"subcategory";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:7:"product";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"slider";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"video";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:3:"cms";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"order";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"statistics";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"newsletter";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}}', '2015-10-09 07:02:46', '2015-10-09 04:23:58', '127.0.0.1', 'Yes', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_admin_settings`
--

CREATE TABLE IF NOT EXISTS `artfill_admin_settings` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `google_verification` varchar(255) NOT NULL,
  `google_verification_code` longtext NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `pinterest` varchar(100) NOT NULL,
  `googleplus_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(100) NOT NULL,
  `rss_link` varchar(100) NOT NULL,
  `youtube_link` varchar(100) NOT NULL,
  `mega_menu` enum('Yes','No') NOT NULL,
  `deal_of_day` enum('Yes','No') NOT NULL,
  `footer_content` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `banner_description` varchar(250) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
  `facebook_api` varchar(100) NOT NULL,
  `facebook_secret_key` varchar(100) NOT NULL,
  `paypal_api_name` varchar(100) NOT NULL,
  `paypal_api_pw` varchar(100) NOT NULL,
  `paypal_api_key` varchar(100) NOT NULL,
  `authorize_net_key` varchar(100) NOT NULL,
  `paypal_id` varchar(100) NOT NULL,
  `paypal_live` enum('1','2') NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_uname` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,


  `shop_index_page` blob NOT NULL,
  `cod_payment` enum('Yes','No') NOT NULL DEFAULT 'No',
  `membership` enum('Yes','No') NOT NULL DEFAULT 'No',
  `membership_plan` varchar(50) NOT NULL,
  `membership_option` int(11) NOT NULL,
  `membership_price` decimal(10,2) NOT NULL,
  `featured_prod` enum('active','inactive') NOT NULL,
  `top_seller` enum('active','inactive') NOT NULL,
  `recent_prod` enum('active','inactive') NOT NULL,
  `featured_shop` enum('active','inactive') NOT NULL,
  `app_store_link` text NOT NULL,
  `play_store_link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_admin_settings`
--

INSERT INTO `artfill_admin_settings` (`id`, `site_contact_mail`, `site_contact_number`, `product_cost`, `product_commission`, `email_title`, `google_verification`, `google_verification_code`, `facebook_link`, `twitter_link`, `pinterest`, `googleplus_link`, `linkedin_link`, `rss_link`, `youtube_link`, `mega_menu`, `deal_of_day`, `footer_content`, `logo_image`, `banner_description`, `meta_title`, `meta_keyword`, `meta_description`, `fevicon_image`, `facebook_api`, `facebook_secret_key`, `paypal_api_name`, `paypal_api_pw`, `paypal_api_key`, `authorize_net_key`, `paypal_id`, `paypal_live`, `smtp_port`, `smtp_uname`, `smtp_password`, `consumer_key`, `consumer_secret`, `google_client_secret`, `google_client_id`, `google_redirect_url`, `google_developer_key`, `google_invite_client_id`, `google_invite_client_secret_id`, `google_invite_developer_key`, `google_invite_redirect_url`, `google_invite_application_name`, `facebook_app_id`, `facebook_app_secret`, `facebook_inivte_api_id`, `admin_twitter_Consumer_key`, `admin_twitter_Consumer_Secret`, `like_text`, `unlike_text`, `liked_text`, `publish`, `d_mode`, `allCountry`, `footer_widget1`, `footer_widget2`, `footer_widget3`, `footer_widget4`, `landing_widget1`, `shop_index_page`, `cod_payment`, `membership`, `membership_plan`, `membership_option`, `membership_price`, `zendesk_status`, `zendesk_subdomain_name`, `zendesk_api`, `zendesk_email`, `twilio_account_type`, `twilio_account_sid`, `twilio_auth_token`, `twilio_number`, `twilio_status`, `fresh_desk`, `fresh_desk_link`, `fresh_desk_key`, `fresh_desk_email`, `featured_prod`, `testimonial`, `top_seller`, `recent_prod`, `featured_shop`, `app_store_link`, `play_store_link`) VALUES
(1, 'info@zoplay.com', '', '5.00000', '0.00000', 'artfill ', '', '', 'https://www.facebook.com/zoplay', ' https://twitter.com/ZoplayCom', 'http://www.pinterest.com/zoplay/', 'http://google.com', 'http://www.flickr.com', '', '', 'Yes', 'Yes', '@ 2015 artfill, Inc.', 'logo2.png', 'Shop directly from people around the world.', 0x53686f707379205632, 0x53686f707379205632, 0x53686f707379205632, 'logo4.png', '', '', '', '', '', '', 'sivaprakash@teamtweaks.com', '2', 465, 'admin@teamtweaks.com', '', '', '', 's8jzN0z_wLZnrTOhslKGe9Mg', '659326530893-vphpvf75hpmeie8rhl5bn65k3vqfer7e.apps.googleusercontent.com', 'http://192.168.1.251/artfill-v2/googlelogin/googleRedirect', 'AIzaSyDA2ZffF1lFINJLWMU768aDdk8U6RG147g', '263361743974-bbse1lm1k8m201j8khp6h65rhaacdkkm.apps.googleusercontent.com', '1cx6ZhtfbtXMFTS-Dn8snIVj', 'AIzaSyDoMGyHwX0gVJSOjQQtmk8MMyQJwrptTE0', 'http://tts.in/sivaprakash/b4buyit/settings/google-invites', 'artfill', '1474251899540084', 'ff9bff6056f6677c6b8d2defc29b9030', '1474251899540084', '', '', 'logo3.png', 'artfillimage.png', 'Like''d', 'Production', 'underconstruction', 'Yes', 0x3c64697620636c6173733d22636f6c2d6c672d332020666f6f7465722d626c6f636b223e3c7370616e20636c6173733d22666f6f7465722d68656164206e6f2d756c223e4a6f696e2074686520436f6d6d756e6974793c2f7370616e3e200d0a3c756c20636c6173733d22666f6f7465722d6c697374223e0d0a3c6c693e3c6120687265663d22636f6d6d756e697479223e436f6d6d756e6974793c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d227465616d73223e5465616d733c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d226576656e7473223e5570636f6d696e67204576656e74733c2f613e3c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e, 0x3c64697620636c6173733d22636f6c2d6d642d3220666f6f7465722d626c6f636b223e3c7370616e20636c6173733d22666f6f7465722d68656164223e446973636f76657220616e642053686f703c2f7370616e3e200d0a3c756c20636c6173733d22666f6f7465722d6c697374223e0d0a3c6c693e3c6120687265663d22676966742d6361726473223e476966742043617264733c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d22626c6f67223e426c6f673c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d227265676973747279223e4769667420526567697374726965733c2f613e3c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e, 0x3c64697620636c6173733d22636f6c2d6d642d3220666f6f7465722d626c6f636b223e3c7370616e20636c6173733d22666f6f7465722d68656164223e47657420746f204b6e6f772055733c2f7370616e3e200d0a3c756c20636c6173733d22666f6f7465722d6c697374223e0d0a3c6c693e3c6120687265663d2270616765732f61626f75742d7573223e41626f75743c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d2270616765732f63617265657273223e436172656572733c2f613e3c2f6c693e0d0a3c6c693e3c6120687265663d2270616765732f636f6e746163742d7573223e436f6e746163743c2f613e3c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e, 0x3c64697620636c6173733d22636f6c2d6d642d3220666f6f7465722d626c6f636b223e3c7370616e20636c6173733d22666f6f7465722d68656164223e466f6c6c6f772053686f7073793c2f7370616e3e200d0a3c756c20636c6173733d22666f6f7465722d6c697374223e0d0a3c6c693e203c6120687265663d2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f7a6f706c617922207461726765743d225f626c616e6b223e203c696d67207372633d2275706c6f616465642f66616365626f6f6b2d69636f6e2e706e672220616c743d22222077696474683d22313622206865696768743d22313622202f3e2046616365626f6f6b203c2f613e203c2f6c693e0d0a3c6c693e203c6120687265663d2268747470733a2f2f747769747465722e636f6d2f5a6f706c6179436f6d22207461726765743d225f626c616e6b223e203c696d67207372633d2275706c6f616465642f747769747465722d69636f6e2e706e672220616c743d22222077696474683d22313622206865696768743d22313622202f3e2054776974746572203c2f613e203c2f6c693e0d0a3c6c693e203c6120687265663d22687474703a2f2f7777772e70696e7465726573742e636f6d2f7a6f706c61792f22207461726765743d225f626c616e6b223e203c696d67207372633d2275706c6f616465642f70696e7465726573742d69636f6e2e706e672220616c743d22222077696474683d22313622206865696768743d22313622202f3e2050696e7472657374203c2f613e203c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e, 0x3c64697620636c6173733d22726f772069636f6e2d626c6f636c6b223e0d0a3c64697620636c6173733d22636f6c2d6d642d342069636f6e2d626c223e3c696d67207372633d2275706c6f616465642f69636f6e2d312e706e672220616c743d2222202f3e0d0a3c68313e437573746f6d657220536174696669636174696f6e3c2f68313e0d0a3c703e47657420746f206b6e6f772073686f707320616e64206974656d73207769746820726576696577732066726f6d206f757220636f6d6d756e6974792e3c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6c2d6d642d342069636f6e2d626c223e3c696d67207372633d2275706c6f616465642f69636f6e2d322e706e672220616c743d2222202f3e0d0a3c68313e556e6c696d697465642053656c6c6572732e3c2f68313e0d0a3c703e4275792066726f6d2063726561746976652070656f706c652077686f20636172652061626f7574207175616c69747920616e64206372616674736d616e736869702e3c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6c2d6d642d342069636f6e2d626c223e3c696d67207372633d2275706c6f616465642f69636f6e2d332e706e672220616c743d2222202f3e0d0a3c68313e536563757265205472616e73616374696f6e733c2f68313e0d0a3c703e4665656c20636f6e666964656e74206b6e6f77696e67206f75722054727573742026616d703b20536166657479207465616d206973206865726520746f2070726f7465637420796f752e3c2f703e0d0a3c2f6469763e0d0a3c2f6469763e, 0x3c64697620636c6173733d22726f772d73656c6c2d77726170223e0d0a3c64697620636c6173733d22616c6c6f7765642d6974656d73223e0d0a3c64697620636c6173733d22726f772073656374696f6e20636c656172223e0d0a3c683220636c6173733d2273656374696f6e2d686561646572223e576861742063616e20796f752073656c6c203f3c2f68323e0d0a3c756c3e0d0a3c6c6920636c6173733d22616c6c6f7765642d6974656d223e0d0a3c68333e48616e646d61646520476f6f64733c2f68333e0d0a3c7370616e20636c6173733d22696c6c757374726174696f6e223e266e6273703b3c2f7370616e3e203c7370616e20636c6173733d226974656d2d6578616d706c657322207374796c653d22646973706c61793a206e6f6e653b223e266e6273703b3c2f7370616e3e203c2f6c693e0d0a3c6c692069643d2276696e746167652d6974656d2220636c6173733d22616c6c6f7765642d6974656d223e0d0a3c68333e56696e74616765204974656d733c2f68333e0d0a3c7370616e20636c6173733d22696c6c757374726174696f6e223e266e6273703b3c2f7370616e3e0d0a3c703e3230207965617273206f72206f6c6465723c2f703e0d0a3c2f6c693e0d0a3c6c692069643d22737570706c6965732220636c6173733d22616c6c6f7765642d6974656d223e0d0a3c68333e437261667420537570706c6965733c2f68333e0d0a3c7370616e20636c6173733d22696c6c757374726174696f6e223e266e6273703b3c2f7370616e3e203c6c6162656c20636c6173733d226974656d2d6578616d706c657322207374796c653d22646973706c61793a206e6f6e653b223e266e6273703b3c2f6c6162656c3e203c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c64697620636c6173733d22726f772062656e656669747320636c656172223e3c7370616e20636c6173733d2273656374696f6e2d6865616465722063656e7465725f776f7264223e205768792073656c6c206f6e203c2f7370616e3e3c2f6469763e0d0a3c64697620636c6173733d2266756c6c5f757365223e0d0a3c64697620636c6173733d22636f6e742d622d6c656674223e0d0a3c68323e42652050617274206f66204f757220476c6f62616c204d61726b6574706c6163653c2f68323e0d0a3c756c3e0d0a3c6c693e20697320612076696272616e7420636f6d6d756e697479206f66203330206d696c6c696f6e2062757965727320616e6420637265617469766520627573696e65737365732e3c2f6c693e0d0a3c6c693e2047726f7720796f7572206272616e6420776974682061207765616c7468206f66206e657720637573746f6d65727320616e642070726f6d6f74696f6e616c20746f6f6c732e203c2f6c693e0d0a3c6c693e20456e676167652077697468206b6e6f776c6564676561626c652073656c6c65727320616e64206578706572747320696e205465616d7320616e64204f6e6c696e65204c61622e203c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6e742d622d7269676874223e3c7370616e20636c6173733d2273656c6c2d696d67223e20266e6273703b3c2f7370616e3e3c2f6469763e0d0a3c2f6469763e0d0a3c64697620636c6173733d2266756c6c5f757365223e0d0a3c64697620636c6173733d22636f6e742d622d7269676874223e3c7370616e20636c6173733d2273656c6c2d696d6733223e266e6273703b3c2f7370616e3e3c2f6469763e0d0a3c64697620636c6173733d22636f6e742d622d6c656674223e0d0a3c68323e42652050617274206f66204f757220476c6f62616c204d61726b6574706c6163653c2f68323e0d0a3c756c3e0d0a3c6c693e20697320612076696272616e7420636f6d6d756e697479206f66203330206d696c6c696f6e2062757965727320616e6420637265617469766520627573696e6573736573202e3c2f6c693e0d0a3c6c693e2047726f7720796f7572206272616e6420776974682061207765616c7468206f66206e657720637573746f6d65727320616e642070726f6d6f74696f6e616c20746f6f6c732e203c2f6c693e0d0a3c6c693e20456e676167652077697468206b6e6f776c6564676561626c652073656c6c65727320616e64206578706572747320696e205465616d7320616e64204f6e6c696e65204c6162732e203c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c64697620636c6173733d2266756c6c5f757365223e0d0a3c64697620636c6173733d22636f6e742d622d6c656674223e0d0a3c68323e4578707265737320596f757220437265617469766974793c2f68323e0d0a3c756c3e0d0a3c6c693e205368617265207468652073746f7279206f6620796f757220637261667420696e20796f75722070726f66696c652c206974656d2070686f746f732c20616e642073686f702062616e6e65722e203c2f6c693e0d0a3c6c693e204573636170652074686520392d35206772696e6420616e6420666f637573206f6e20796f75722070617373696f6e2e203c2f6c693e0d0a3c6c693e20436f6e766572736520776974682073686f70706572732c206d616b6572732c20616e642063757261746f72732061626f7574207768617420796f75206c6f76652e203c2f6c693e0d0a3c2f756c3e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6e742d622d7269676874223e3c7370616e20636c6173733d2273656c6c2d696d6732223e266e6273703b3c2f7370616e3e3c2f6469763e0d0a3c2f6469763e0d0a3c64697620636c6173733d2263726561746976652d627573696e657373223e0d0a3c683220636c6173733d2263726561746976652d627573696e6573732d686561646572223e47726f7720596f757220496e646570656e64656e7420437265617469766520427573696e65737320576974683c2f68323e0d0a3c756c20636c6173733d22627573696e6573732d696d616765223e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676531223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676532223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676533223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676534223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676535223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676537223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676538223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d61676539223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653130223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653131223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653132223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653133223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653134223e266e6273703b3c2f6c693e0d0a3c6c6920636c6173733d22627573696e6573732d696d6167653135223e266e6273703b3c2f6c693e0d0a3c2f756c3e0d0a3c703e4a6f696e20746865206d6f76656d656e742072656275696c64696e672068756d616e2d7363616c652065636f6e6f6d6965732061726f756e642074686520776f726c642e3c2f703e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c64697620636c6173733d22726f772d73656c6c2d77726170223e0d0a3c64697620636c6173733d227175657374696f6e73223e0d0a3c68333e48617665204d6f7265205175657374696f6e73203f3c2f68333e0d0a3c64697620636c6173733d227175657374696f6e732d6c656674223e0d0a3c68343e48617665204d6f7265205175657374696f6e73203f3c2f68343e0d0a3c703e4a6f696e696e6720616e642073657474696e6720757020612073686f70206f6e20697320667265652e2045616368206974656d206c697374696e67206f6e20636f7374732024302e323020555344207768656e20746865206c697374696e67206973207075626c69736865642e2041206c697374696e67206c6173747320666f7220666f7572206d6f6e746873206f7220756e74696c20746865206974656d20697320736f6c642e204f6e636520612073616c65206f63637572732c20776520617373657373206120332e3525207472616e73616374696f6e20666565206f6e20746865206974656d26727371756f3b732073616c652070726963652e20596f75206861766520616e206f70706f7274756e69747920746f2072657669657720616e6420616363657074207468652066656573207468617420796f752077696c6c2062652063686172676564207072696f7220746f207075626c697368696e672061206c697374696e672e3c2f703e0d0a3c703e4665657320666f72206c697374696e677320616e64207472616e73616374696f6e73206172652061636372756564206f6e20796f7572206d6f6e74686c792062696c6c2e2041742074686520656e64206f662065616368206d6f6e74682077652061646420757020616c6c20796f757220666565732c20616e6420776520656d61696c20796f7572206d6f6e74686c792073746174656d656e7420746f20796f752e20596f75206d7573742070617920796f75722062696c6c206279207468652031357468206f6620746865206e657874206d6f6e7468207573696e672065697468657220746865206372656469742063617264206f6e2066696c65206f722050617950616c2e3c2f703e0d0a3c68343e446f2049206e656564206120637265646974206361726420746f207369676e207570203f3c2f68343e0d0a3c703e546f206265636f6d6520612073656c6c6572206f6e2c796f75206e65656420746f2070726f7669646520612076616c696420637265646974206361726420666f7220766572696669636174696f6e20707572706f7365732e2053656c6c657220726567697374726174696f6e207468726f7567682050617950616c20697320617661696c61626c6520617320616e20616c7465726e617469766520746f20637265646974206361726420726567697374726174696f6e20666f72206d656d6265727320696e206365727461696e20636f756e74726965732e20596f7520776f6e26727371756f3b7420696e63757220616e79206368617267657320756e74696c20796f75206f70656e20796f75722073686f7020616e64207075626c69736820796f7572206c697374696e677320617420612072617465206f662024302e323020706572206974656d2e3c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d227175657374696f6e732d7269676874223e0d0a3c68343e576861742063616e20492073656c6c206f6e3c2f68343e0d0a3c703e70726f76696465732061206d61726b6574706c61636520666f722063726166746572732c206172746973747320616e6420636f6c6c6563746f727320746f2073656c6c2074686569722068616e646d616465206372656174696f6e732c2076696e7461676520676f6f647320286174206c65617374203230207965617273206f6c64292c20616e6420626f74682068616e646d61646520616e64206e6f6e2d68616e646d616465206372616674696e6720737570706c6965732e20496620796f7527726520776f6e646572696e672077686174207175616c69666965732061732068616e646d616465206f6e2c72656164206d6f7265203c6120687265663d222f68616e646d616465223e686572653c2f613e202e3c2f703e0d0a3c68343e486f7720646f2049207069636b206120757365726e616d6520616e642073686f70206e616d653f3c2f68343e0d0a3c703e4f6e20796f752061726520726570726573656e7465642074776f20646966666572656e7420776179733a20627920796f757220757365726e616d65206f722066756c6c206e616d652028696620796f752063686f6f736520746f2070726f76696465206f6e652920616e6420627920796f75722073686f70206e616d652e20496620796f75207369676e20757020746f2073656c6c206f6e2c20796f75722064656661756c742073686f70206e616d652077696c6c20626520796f757220757365726e616d652e205768696c65206e6f74206e65636573736172792c20616464696e6720612073686f70206e616d652077696c6c20616c6c6f7720796f7520746f2070726f6d6f746520796f75722073686f70207573696e672069747320756e69717565206e616d6520616e6420746f20726564697265637420796f75722062757965727320746f20796f75722073686f702062792074686973206e616d652e205768656e20796f753c6120687265663d2223223e2061646420796f75722073686f70206e616d653c2f613e202c20796f757220757365726e616d652072656d61696e7320756e6368616e6765642e203c6120687265663d2223223e557365726e616d65732063616e6e6f74206265206368616e6765643c2f613e20616e6420617265207374696c6c206e656365737361727920666f72206365727461696e206665617475726573206c696b65207369676e696e6720696e746f20796f7572206163636f756e74206f722073656e64696e67206120436f6e766572736174696f6e2e3c2f703e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c2f6469763e, 'Yes', 'No', 'Y', 1, '120.00', 'Active', 'artfill', 'BrENoX09KJh0Tn4L4O4DEztE8UUED6PauJbg9YWq', 'thomasmiller3592@gmail.com', 'sandbox', 'AC39f57acdf82a31c0416d0fab2755aedb', 'ab2757237398e0ba41ee9785389a6fd9', '+12012575622', 'Active', 'Active', 'http://sureshkumar.freshdesk.com', '0zDpXEHjLiHjBn5tSHC', 'sureshkumar@casperon.in', 'active', 'active', 'active', 'active', 'active', 'www.asdfasdfasdfasdfasdfsadf/hjkfhj.com', 'www.asdfasdfasdfasdfasdfsadf/hjkfhj.com');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_platform_settings`
--

CREATE TABLE IF NOT EXISTS `artfill_platform_settings` (
  `site_contact_mail` varchar(200) NOT NULL,
  `site_contact_number` varchar(50) NOT NULL,
  `product_static_commission` decimal(13,5) NOT NULL DEFAULT '1.00000',
  `product_dynamic_commission` decimal(13,5) NOT NULL DEFAULT '1.00000'
  `email_title` varchar(255) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_platform_settings`
--

INSERT INTO 'artfill_platform_settings'()

-- --------------------------------------------------------

--
-- Table structure for table `artfill_advertise`
--

CREATE TABLE IF NOT EXISTS `artfill_advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `advertising_option` enum('image','script') NOT NULL DEFAULT 'image',
  `advertising_area` varchar(300) NOT NULL,
  `advertising_content` longblob NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'UnPublish',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
i
--
-- Dumping data for table `artfill_advertising`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_affiliate_cookie`
--

CREATE TABLE IF NOT EXISTS `artfill_affiliate_cookie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_id` int(11) NOT NULL,
  `registered` varchar(255) COLLATE utf8_bin NOT NULL,
  `registeredemail` varchar(255) COLLATE utf8_bin NOT NULL,
  `referer_id` int(11) NOT NULL,
  `referer` varchar(255) COLLATE utf8_bin NOT NULL,
  `referer_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` enum('Pending','Approved') COLLATE utf8_bin NOT NULL,
  `credit` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_affiliate_cookie`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_affiliate_settings`
--

CREATE TABLE IF NOT EXISTS `artfill_affiliate_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aff_status` enum('Active','InActive') COLLATE utf8_bin NOT NULL,
  `aff_amount` int(11) NOT NULL,
  `aff_point` int(11) NOT NULL,
  `cookie_duration` int(11) NOT NULL,
  `cookie_period` varchar(11) COLLATE utf8_bin NOT NULL,
  `cookie_expiration` int(11) NOT NULL,
  `fb_discount` enum('Active','InActive') COLLATE utf8_bin NOT NULL,
  `purchase_count` int(11) NOT NULL,
  `fb_discounttype` enum('Flat','Percentage') COLLATE utf8_bin NOT NULL,
  `fb_discountvalue` int(11) NOT NULL,
  `fbrr_discount` enum('Active','InActive') COLLATE utf8_bin NOT NULL,
  `rr_amount` int(11) NOT NULL,
  `mobile_discount` enum('Active','InActive') COLLATE utf8_bin NOT NULL,
  `mob_discounttype` enum('Flat','Percentage') COLLATE utf8_bin NOT NULL,
  `mob_discountvalue` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_affiliate_settings`
--

INSERT INTO `artfill_affiliate_settings` (`id`, `aff_status`, `aff_amount`, `aff_point`, `cookie_duration`, `cookie_period`, `cookie_expiration`, `fb_discount`, `purchase_count`, `fb_discounttype`, `fb_discountvalue`, `fbrr_discount`, `rr_amount`, `mobile_discount`, `mob_discounttype`, `mob_discountvalue`) VALUES
(1, 'InActive', 1, 2, 2, 'hrs', 0, 'InActive', 2, 'Percentage', 100, 'InActive', 0, 'InActive', 'Percentage', 2);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_attribute`
--

CREATE TABLE IF NOT EXISTS `artfill_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_attribute`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_banner`
--

CREATE TABLE IF NOT EXISTS `artfill_banner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `banner_option` enum('image','html') NOT NULL DEFAULT 'image',
  `banner_text` longblob NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Unpublish',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_banner_category`
--

CREATE TABLE IF NOT EXISTS `artfill_banner_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_banner_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_billing_address`
--

CREATE TABLE IF NOT EXISTS `artfill_billing_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_billing_address`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_category`
--

CREATE TABLE IF NOT EXISTS `artfill_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `rootID` int(20) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `cat_position` int(11) NOT NULL,
  `seo_title` longblob NOT NULL,
  `seo_keyword` longblob NOT NULL,
  `seo_description` longblob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_mega_menu` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_category`
--


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `artfill_claim`
--

CREATE TABLE IF NOT EXISTS `artfill_claim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `dealcodenumber` varchar(255) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `sent_claim` varchar(255) NOT NULL COMMENT '1-Buyer,2-Seller',
  `status` enum('Opened','Closed') NOT NULL,
  `claimed_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `zendesk_ticket_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `artfill_claim`
--

INSERT INTO `artfill_claim` (`id`, `seller_id`, `buyer_id`, `dealcodenumber`, `total_amount`, `sent_claim`, `status`, `claimed_time`, `zendesk_ticket_id`) VALUES
(1, 3, 5, '1432376585', '24.00', '1', 'Opened', '2015-05-26 13:47:25', ''),
(2, 2, 5, '1432375121', '105.00', '', 'Opened', '2015-05-26 13:46:27', ''),
(3, 6, 3, '1432562417', '132.00', '', 'Opened', '2015-08-20 19:05:14', ''),
(9, 3, 6, '1436175386', '24.00', '', 'Opened', '2015-07-06 20:09:27', '7'),
(14, 33, 6, '1436421056', '70.00', '', 'Opened', '2015-07-09 18:00:57', '11'),
(15, 1, 33, '1437995109', '0.00', '', 'Opened', '2015-07-27 17:20:55', '46'),
(16, 6, 1, '1438611035', '471.70', '', 'Opened', '2015-08-07 14:54:13', ''),
(17, 6, 1, '1439354277', '10.00', '', 'Opened', '2015-08-12 10:08:56', ''),
(18, 6, 9, '1439812773', '2,459,790.50', '', 'Opened', '2015-08-17 19:58:45', ''),
(19, 9, 6, '1438865141', '10.00', '', 'Opened', '2015-08-19 11:47:32', ''),
(20, 1, 6, '1439537778', '225.00', '', 'Opened', '2015-08-20 15:07:03', ''),
(21, 9, 6, '1438865281', '1212.00', '', 'Opened', '2015-08-20 18:38:01', ''),
(22, 9, 6, '1440077393', '1212.00', '', 'Opened', '2015-08-20 19:03:03', ''),
(23, 9, 6, '1440079577', '1212.00', '', 'Opened', '2015-08-20 20:37:07', ''),
(24, 9, 6, '1440079338', '1212.00', '1', 'Opened', '2015-08-21 19:53:53', ''),
(25, 9, 6, '1440404238', '1212.00', '', 'Opened', '2015-08-24 13:51:46', ''),
(26, 9, 6, '1440422082', '1212.00', '1', 'Closed', '2015-08-24 20:03:00', ''),
(27, 33, 6, '1440494904', '252.00', '', 'Opened', '2015-08-25 15:06:42', ''),
(28, 33, 6, '1440498834', '252.00', '', 'Opened', '2015-08-25 16:06:25', ''),
(29, 9, 12, '1440513222', '36.00', '', 'Opened', '2015-08-25 20:08:47', ''),
(30, 9, 6, '1440589134', '1212.00', '1', 'Closed', '2015-08-26 17:56:12', ''),
(31, 9, 6, '1440592111', '1212.00', '', 'Opened', '2015-08-26 18:05:23', ''),
(32, 1, 9, '1442318735', '100.00', '', 'Closed', '2015-09-30 10:15:42', ''),
(33, 58, 6, '1442222313', '112.00', '', 'Opened', '2015-09-18 16:02:29', ''),
(34, 9, 6, '1442563248', '123.00', '', 'Opened', '2015-09-18 16:32:18', ''),
(38, 9, 6, '1442580060', '138.00', '', 'Opened', '2015-09-18 18:45:11', ''),
(39, 9, 6, '1442581171', '138.00', '', 'Opened', '2015-09-18 18:56:43', ''),
(40, 9, 6, '1442583532', '276.00', '', 'Opened', '2015-09-18 19:12:12', ''),
(41, 42, 1, '1441782441', '71.28', '', 'Opened', '2015-09-18 19:17:13', ''),
(42, 1, 9, '1442820591', '10.65', '', 'Opened', '2015-09-21 13:05:47', ''),
(43, 1, 42, '1441776602', '110.00', '', 'Opened', '2015-09-24 17:11:45', ''),
(44, 1, 42, '1441776304', '110.00', '', 'Opened', '2015-09-24 17:22:16', ''),
(45, 6, 1, '1439355464', '9489.88', '', 'Opened', '2015-09-24 17:49:05', ''),
(46, 9, 6, '1441120290', '100.00', '', 'Opened', '2015-09-25 11:51:27', ''),
(47, 9, 6, '1440415308', '1212.00', '', 'Opened', '2015-09-25 12:20:31', ''),
(48, 58, 55, '1442208393', '110.00', '', 'Opened', '2015-09-25 17:51:36', ''),
(49, 1, 58, '1438944199', '1600.00', '', 'Opened', '2015-09-25 18:09:30', ''),
(50, 6, 58, '1439189487', '9489.88', '', 'Opened', '2015-09-25 18:40:04', ''),
(51, 1, 6, '1437563119', '350.00', '', 'Opened', '2015-09-29 12:10:13', ''),
(52, 1, 6, '1438858456', '200.00', '', 'Opened', '2015-09-29 12:18:20', ''),
(53, 6, 9, '1440415651', '10,484.32', '', 'Opened', '2015-09-30 09:57:33', ''),
(54, 9, 6, '1443594760', '138.00', '', 'Opened', '2015-09-30 12:08:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_cms`
--

CREATE TABLE IF NOT EXISTS `artfill_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `seourl` text NOT NULL,
  `hidden_page` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category` enum('Main','Sub') NOT NULL DEFAULT 'Main',
  `parent` int(11) NOT NULL DEFAULT '0',
  `meta_tag` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` blob NOT NULL,
  `css_descrip` blob NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `hidden_page` (`hidden_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `artfill_cms`
--

INSERT INTO `artfill_cms` (`id`, `page_name`, `page_title`, `seourl`, `hidden_page`, `category`, `parent`, `meta_tag`, `meta_description`, `description`, `css_descrip`, `status`, `meta_title`) VALUES
(1, 'About', 'Who we are', 'about-us', 'Yes', 'Main', 0, 0x506f73742031, 0x506f73742031, 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e, '', 'Publish', 0x506f73742031),
(2, 'Help', 'Help', 'help', 'No', 'Main', 0, 0x48656c70, 0x48656c70, 0x3c6469762069643d226c697073756d223e0a3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204e756e63206e65632073656d202074656d7075732c2068656e647265726974206d692069642c206f726e6172652061756775652e2050726f696e2076656c20696163756c697320616e74652e204e756c6c612020657569736d6f64206a7573746f206e6f6e207475727069732064696374756d20646170696275732e20517569737175652070656c6c656e74657371756520636f6d6d6f646f20206573742c206567657420696163756c69732074656c6c757320696d706572646965742065752e20496e746567657220696e74657264756d206c656f206e656320656c69742020646170696275732070756c76696e61722e204675736365206e69736c206475692c206d6f6c6c69732075742073617069656e20717569732c20666163696c697369732020696d70657264696574206d61676e612e20446f6e6563206575206469616d2073697420616d657420656e696d20656c656d656e74756d20756c6c616d636f727065722e2053656420206e65632067726176696461206e756e632c2061742065676573746173206469616d2e20566976616d75732072686f6e6375732c206d6173736120657520626c616e6469742020666163696c697369732c2074656c6c7573206e6962682074656d706f7220617263752c2065676574206672696e67696c6c6120616e746520646f6c6f7220626c616e646974202061756775652e204e756e6320766976657272612c20616e7465207669746165207361676974746973207665686963756c612c20657374206c6163757320706c616365726174202072697375732c20757420636f6e6775652074656c6c75732076656c697420626962656e64756d2074656c6c75732e20496e206c6163696e6961206c616375732073656420206c65637475732076656e656e61746973206d61747469732e20447569732061206461706962757320657261742e2050726f696e20697073756d206c6f72656d2c20206665726d656e74756d2073697420616d6574206c696265726f20612c206c616f7265657420766f6c75747061742073617069656e2e3c2f703e0a3c703e536564206575206e6973692073697420616d6574206c6f72656d20677261766964612070756c76696e61722e204e756c6c6120666163696c6973692e20437572616269747572202070656c6c656e746573717565206d617373612061206f64696f207072657469756d2070686172657472612e2053757370656e64697373652076656c69742065726f732c2020626962656e64756d2065752076697665727261206e65632c20706c61636572617420736564206d657475732e20496e7465676572207669746165206c656f2061756775652e202053757370656e646973736520736167697474697320706f72746120697073756d207574207072657469756d2e204375726162697475722074696e636964756e742076617269757320206d6f6c6c69732e3c2f703e0a3c703e4d6f7262692072757472756d20666575676961742076756c7075746174652e204e756c6c616d206665756769617420696e206572617420766974616520636f6e76616c6c69732e2020496e7465676572206d6f6c6c6973206c616f7265657420656c69742e20416c697175616d206572617420766f6c75747061742e2041656e65616e2071756973207475727069732020656c656d656e74756d2c2068656e6472657269742072697375732069642c207665686963756c61206e756c6c612e20416c697175616d206f726e617265206c6f626f727469732020636f6e73656374657475722e205175697371756520626c616e646974206469616d2070656c6c656e746573717565206469616d206672696e67696c6c6120636f6e7365717561742e2020447569732068656e64726572697420617563746f72206f64696f2c2071756973207363656c65726973717565207075727573206c6f626f72746973207365642e2053656420657520206e697369206f7263692e3c2f703e0a3c703e467573636520636f6d6d6f646f206e696268207669746165206e6571756520756c6c616d636f727065722076756c7075746174652e205175697371756520706f73756572652020746f72746f722076697461652074656d706f722076756c7075746174652e20457469616d2072757472756d206c6967756c6120756c6c616d636f72706572206c656f20206f726e61726520736f64616c65732e2041656e65616e2061646970697363696e67206e697369207574207363656c6572697371756520756c6c616d636f727065722e2020416c697175616d20636f6e7365637465747572206d6175726973207175697320696e74657264756d20657569736d6f642e20566976616d7573207669746165206c656f2020657261742e204e616d206c6f626f727469732064696374756d2065726f732076656c20636f6e6775652e20446f6e65632074696e636964756e7420616e7465206a7573746f2e20204e616d2073697420616d6574206a7573746f2073697420616d6574206d657475732074696e636964756e7420636f6e73656374657475722e2053757370656e646973736520206567657420706f72746120616e74652c207175697320756c747269636965732073617069656e2e204d616563656e61732073656d7065722070656c6c656e7465737175652020646170696275732e2053757370656e646973736520766573746962756c756d207475727069732065742066656c697320706f727461206c616f726565742e20566976616d7573202070756c76696e6172206d617373612071756973206d6920626c616e646974206c616f726565742e20496e746567657220646170696275732072697375732020636f6e736563746574757220616e746520656c656d656e74756d20656c656d656e74756d2e204e756e63207175697320626c616e646974206d617373612e3c2f703e0a3c703e4d616563656e6173206d617373612076656c69742c2064617069627573207574206c616f72656574207365642c2076656e656e6174697320696e2065726f732e20204d616563656e617320706f7274612071756973206572617420696e2072686f6e6375732e204d61757269732065676574206e756c6c61206672696e67696c6c612c2074656d7075732020746f72746f7220656765742c20626962656e64756d2073656d2e204e756c6c6120736564206e69736c206469676e697373696d2c20736f6c6c696369747564696e206c656f202069642c2070656c6c656e7465737175652065726f732e20496e206d6f6c6573746965206c6f626f72746973206c616375732e204d61757269732061206c6563747573206e6f6e2020656c69742072757472756d206d616c6573756164612e204e756e6320756c747269636573206a7573746f2073697420616d65742076697665727261206d6f6c65737469652e202050726f696e206c6f626f72746973206e756e63207669746165206c6f626f727469732076656e656e617469732e20536564206567657374617320747572706973206d61676e612c2020736564207665686963756c61206c6f72656d20616c697175616d2069642e2041656e65616e20706f72747469746f72206e6f6e2075726e61207365642064696374756d2e202044756973207072657469756d206174206e697369206120766f6c75747061742e204372617320657520756c747269636965732076656c69742c2076656c20736167697474697320206d617373612e20496e7465676572206574207175616d2071756973206c6f72656d206672696e67696c6c6120766573746962756c756d2065676574206163206d692e202050656c6c656e746573717565207365642064617069627573206f64696f2e204e756e632061206172637520636f6e73656374657475722c207363656c65726973717565206475692020636f6e6775652c207072657469756d207475727069732e3c2f703e0a3c2f6469763e, '', 'Publish', 0x48656c70),
(3, 'Privacy', 'Privacy', 'privacy-policy', 'No', 'Main', 0, 0x5072697661637920506f6c696379, 0x5072697661637920506f6c696379, 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e, '', 'Publish', 0x5072697661637920506f6c696379),
(5, 'Contact', 'Contact', 'contact-us', 'No', 'Main', 0, 0x436f6e74616374205573, 0x436f6e74616374205573, 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d2020697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f20206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e697320206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c2020756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d6173736120207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c7075746174652020656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c20206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e20204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e64202074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c2020656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e202050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e2020696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f727065722020756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c757320206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e67202073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c202068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e6563202076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d207369742020616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d6175726973202073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f20656765742020626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e41646472657373203a53686f7073792c2a2a2a2a2a2058585858583c2f703e0d0a3c703e456d61696c266e6273703b266e6273703b266e6273703b203a73616c65734073686f7073792e636f6d3c2f703e0d0a3c703e4d6f62696c65266e6273703b266e6273703b203a23232323232d2323232d232323233c2f703e, '', 'Publish', 0x436f6e74616374205573),
(6, 'Pages', 'Pages', 'pages', 'Yes', 'Main', 0, '', '', 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e, '', 'Publish', ''),
(7, 'Press', 'Press', 'press', 'No', 'Main', 0, '', '', 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e, '', 'Publish', ''),
(8, 'Copyright', 'Copyright', 'copyright', 'No', 'Main', 0, '', '', 0x3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e3c7370616e207374796c653d22636f6c6f723a20233636363636363b20666f6e742d66616d696c793a2056657264616e612c2047656e6576612c2073616e732d73657269663b20666f6e742d73697a653a20313070783b20666f6e742d7374796c653a206e6f726d616c3b20666f6e742d76617269616e743a206e6f726d616c3b20666f6e742d7765696768743a206e6f726d616c3b206c65747465722d73706163696e673a206e6f726d616c3b206c696e652d6865696768743a206e6f726d616c3b206f727068616e733a206175746f3b20746578742d616c69676e3a206c6566743b20746578742d696e64656e743a203070783b20746578742d7472616e73666f726d3a206e6f6e653b2077686974652d73706163653a206e6f726d616c3b207769646f77733a206175746f3b20776f72642d73706163696e673a203070783b206261636b67726f756e642d636f6c6f723a20236666666666663b20646973706c61793a20696e6c696e652021696d706f7274616e743b20666c6f61743a206e6f6e653b223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747565722061646970697363696e6720656c69742e2041656e65616e20636f6d6d6f646f206c6967756c61206567657420646f6c6f722e2041656e65616e206d617373612e2043756d20736f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e74206d6f6e7465732c206e61736365747572207269646963756c7573206d75732e20446f6e6563207175616d2066656c69732c20756c74726963696573206e65632c2070656c6c656e7465737175652065752c207072657469756d20717569732c2073656d2e204e756c6c6120636f6e736571756174206d61737361207175697320656e696d2e20446f6e65632070656465206a7573746f2c206672696e67696c6c612076656c2c20616c6971756574206e65632c2076756c70757461746520656765742c20617263752e20496e20656e696d206a7573746f2c2072686f6e6375732075742c20696d7065726469657420612c2076656e656e617469732076697461652c206a7573746f2e204e756c6c616d2064696374756d2066656c69732065752070656465206d6f6c6c6973207072657469756d2e20496e74656765722074696e636964756e742e204372617320646170696275732e20566976616d757320656c656d656e74756d2073656d706572206e6973692e2041656e65616e2076756c70757461746520656c656966656e642074656c6c75732e2041656e65616e206c656f206c6967756c612c20706f72747469746f722065752c20636f6e7365717561742076697461652c20656c656966656e642061632c20656e696d2e20416c697175616d206c6f72656d20616e74652c206461706962757320696e2c207669766572726120717569732c206665756769617420612c2074656c6c75732e2050686173656c6c75732076697665727261206e756c6c61207574206d6574757320766172697573206c616f726565742e20517569737175652072757472756d2e2041656e65616e20696d706572646965742e20457469616d20756c74726963696573206e6973692076656c2061756775652e2043757261626974757220756c6c616d636f7270657220756c74726963696573206e6973692e204e616d2065676574206475692e20457469616d2072686f6e6375732e204d616563656e61732074656d7075732c2074656c6c7573206567657420636f6e64696d656e74756d2072686f6e6375732c2073656d207175616d2073656d706572206c696265726f2c2073697420616d65742061646970697363696e672073656d206e657175652073656420697073756d2e204e616d207175616d206e756e632c20626c616e6469742076656c2c206c75637475732070756c76696e61722c2068656e6472657269742069642c206c6f72656d2e204d616563656e6173206e6563206f64696f20657420616e74652074696e636964756e742074656d7075732e20446f6e65632076697461652073617069656e207574206c696265726f2076656e656e617469732066617563696275732e204e756c6c616d207175697320616e74652e20457469616d2073697420616d6574206f72636920656765742065726f732066617563696275732074696e636964756e742e2044756973206c656f2e20536564206672696e67696c6c61206d61757269732073697420616d6574206e6962682e20446f6e656320736f64616c6573207361676974746973206d61676e612e2053656420636f6e7365717561742c206c656f206567657420626962656e64756d20736f64616c65732c2061756775652076656c697420637572737573206e756e632c3c2f7370616e3e3c2f7370616e3e3c2f703e, '', 'Publish', ''),
(9, 'report a problem', 'report a problem', 'report-a-problem', 'Yes', 'Main', 0, '', '', 0x3c683120636c6173733d2266662d6d656469756d207469746c65223e486f7720646f2049207265706f727420612070726f626c656d2077697468206d79206f726465723f3c2f68313e0d0a3c703e266e6273703b3c2f703e0d0a3c703e496620796f75277265206c6f6f6b696e6720746f2072657475726e20616e206974656d2c20676574206120726566756e642066726f6d20616e206f72646572206f6e20457473792c206f72206a75737420686176696e672067656e6572616c20697373756573207769746820616e206f726465722c20746865206669727374207468696e6720746f20646f206973266e6273703b3c6120687265663d22687474703a2f2f7777772e657473792e636f6d2f68656c702f61727469636c652f373122207461726765743d225f626c616e6b223e636f6e74616374207468652073656c6c6572206469726563746c793c2f613e2e20456163682073656c6c657220686173207468656972206f776e2073686f7020706f6c696369657320746861742073686f756c64206164647265737320697373756573206c696b652074686573652e20266e6273703b3c2f703e0d0a3c703e486f77657665722c20696620796f7526727371756f3b7265207374696c6c20686176696e672070726f626c656d73207769746820616e206f7264657220796f75277665206d616465206f6e20457473792c20796f752063616e2066696c65207768617426727371756f3b73206b6e6f776e206173206120266c6471756f3b3c6120687265663d2268747470733a2f2f7777772e657473792e636f6d2f68656c702f61727469636c652f3435323122207461726765743d225f626c616e6b223e636173653c2f613e2e26726471756f3b20266e6273703b3c2f703e0d0a3c703e5468697320626567696e7320612070726f6365737320776865726520796f7520616e64207468652073656c6c657220776f726b20746f67657468657220746f207265736f6c7665207468652069737375652e3c2f703e0d0a3c703e4265666f7265206f70656e696e67206120636173652c20636865636b20746865266e6273703b3c6120687265663d2268747470733a2f2f7777772e657473792e636f6d2f68656c702f61727469636c652f3331353322207461726765743d225f626c616e6b223e70726f63657373696e6720616e64207368697070696e672074696d65733c2f613e266e6273703b6f6e20796f7572206f726465722e204120636173652063616e6e6f742062652066696c656420756e74696c20626f7468207468652070726f63657373696e672074696d6520616e64207368697070696e672074696d6520666f7220746865206f726465722068617665207061737365642e2054686573652074696d65732063616e20766172792066726f6d206974656d20746f206974656d206f6e20457473792e266e6273703b3c2f703e0d0a3c703e466f72206d6f726520696e666f726d6174696f6e206f6e206361736520656c69676962696c6974792c20636865636b206f7574266e6273703b3c6120687265663d22687474703a2f2f7777772e657473792e636f6d2f68656c702f61727469636c652f3435323122207461726765743d225f626c616e6b223e746869732048656c702061727469636c653c2f613e2e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e3c656d3e4f6e636520656c696769626c652c206275796572732068617665203630206461797320746f206f70656e206120636173653c2f656d3e2e3c2f7374726f6e673e3c2f703e0d0a3c703e496620796f75207061696420666f7220796f7572206f72646572207573696e672050617950616c2c20636f6e746163742050617950616c20746f2066696c65206120636c61696d20666f72206120726566756e642e2050617950616c26727371756f3b7320636c61696d2070726f636573732069732073657061726174652066726f6d204574737926727371756f3b7320636173652073797374656d2e20266e6273703b3c2f703e0d0a3c703e546f2066696c6520612063617365206f6e20457473792c20706c6561736520646f2074686520666f6c6c6f77696e672066726f6d20796f7572207765622062726f777365722e3c2f703e0d0a3c703e3c7374726f6e673e506c65617365206e6f74653a20596f752063616e6e6f742066696c6520612063617365206f6e204574737926727371756f3b73206d6f62696c65206170707320617420746869732074696d653c2f7374726f6e673e2e3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e31293c2f7374726f6e673e266e6273703b3c2f7370616e3e436c69636b266e6273703b3c6120687265663d2268747470733a2f2f7777772e657473792e636f6d2f796f75722f7075726368617365732f22207461726765743d225f626c616e6b223e3c656d3e596f7572204163636f756e74202667743b205075726368617365732026616d703b20526576696577733c2f656d3e3c2f613e2e3c2f703e0d0a3c756c3e0d0a3c6c693e596f752073686f756c642073656520796f7572206f7264657220756e646572207468653c7374726f6e673e266e6273703b3c656d3e416c6c205075726368617365733c2f656d3e266e6273703b7461623c2f7374726f6e673e2e3c2f6c693e0d0a3c2f756c3e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e3c7370616e3e32293c2f7370616e3e266e6273703b3c2f7374726f6e673e546f2066696c65206120636173652c20636c69636b266e6273703b3c7374726f6e673e3c656d3e5265706f727420616e20697373756520776974682074686973206974656d3c2f656d3e2e3c2f7374726f6e673e3c2f703e0d0a3c756c3e0d0a3c6c693e412064726f70646f776e206d656e752077696c6c206170706561722e3c2f6c693e0d0a3c2f756c3e0d0a3c703e3c696d67207372633d2268747470733a2f2f696d67302e657473797374617469632e636f6d2f3034332f302f302f696b625f66756c6c7866756c6c2e383932343231325f346e61742e6a70672220616c743d22222077696474683d2235373322206865696768743d2231343622202f3e3c2f703e0d0a3c756c3e0d0a3c6c693e53656c65637420656974686572266e6273703b3c656d3e4920686176656e26727371756f3b742072656365697665642074686973206974656d3c2f656d3e266e6273703b6f72266e6273703b3c656d3e4974656d2069736e26727371756f3b74206173206465736372696265643c2f656d3e2e20266e6273703b3c2f6c693e0d0a3c6c693e546865266e6273703b3c656d3e4920686176656e26727371756f3b742072656365697665642074686973206974656d3c2f656d3e266e6273703b6f7074696f6e2069732075736564207768656e20796f7526727371756f3b76652070757263686173656420616e206974656d20616e64206974206861736e26727371756f3b7420617272697665642e20266e6273703b3c2f6c693e0d0a3c6c693e546865266e6273703b3c656d3e4974656d2069736e26727371756f3b74206173206465736372696265643c2f656d3e266e6273703b6f7074696f6e2069732075736564207768656e20616e206974656d20796f752070757263686173656420686173206265656e2064656c69766572656420627574206973206e6f7420617320697420776173207069637475726564206f6e20457473792e3c2f6c693e0d0a3c2f756c3e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e3c7370616e3e33293c2f7370616e3e266e6273703b3c2f7374726f6e673e596f7526727371756f3b6c6c207468656e2062652074616b656e20746f2061207061676520776865726520796f752063616e266e6273703b3c7374726f6e673e636f6e74616374207468652073656c6c65723c2f7374726f6e673e2c206a75737420696e206361736520796f7520686176656e26727371756f3b7420646f6e652074686174207965742e3c2f703e0d0a3c703e3c696d67207372633d2268747470733a2f2f696d67302e657473797374617469632e636f6d2f3032312f302f302f696b625f66756c6c7866756c6c2e383932333539325f673062682e6a70672220616c743d22222077696474683d2235313622206865696768743d2232343822202f3e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e3429266e6273703b3c2f7374726f6e673e3c2f7370616e3e496620796f7526727371756f3b7265207374696c6c20756e61626c6520746f207265616368207468652073656c6c65722c207363726f6c6c20746f2074686520626f74746f6d206f662074686520706167652e20486572652c266e6273703b3c7374726f6e673e636c69636b266e6273703b3c656d3e4f70656e20612063617365207769746820457473793c2f656d3e3c2f7374726f6e673e2e266e6273703b3c2f703e0d0a3c703e3c696d67207372633d2268747470733a2f2f696d67312e657473797374617469632e636f6d2f3032302f302f302f696b625f66756c6c7866756c6c2e383932333635355f71726d742e6a70672220616c743d22222077696474683d2233393922206865696768743d22333422202f3e3c2f703e0d0a3c756c3e0d0a3c6c693e496620796f7526727371756f3b766520707572636861736564206d756c7469706c65206974656d732066726f6d20746869732073656c6c65722c20796f752063616e206569746865722073656c6563742074686520656e74697265206f72646572206f7220696e646976696475616c207472616e73616374696f6e732e266e6273703b3c2f6c693e0d0a3c2f756c3e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e35293c2f7374726f6e673e3c2f7370616e3e266e6273703b4e6578742c2063686f6f736520796f7572266e6273703b3c7374726f6e673e707265666572726564207265736f6c7574696f6e206d6574686f643c2f7374726f6e673e2e205468657365207265736f6c7574696f6e732063616e207661727920646570656e64696e67206f6e20776861742074797065206f66206361736520796f7526727371756f3b72652066696c696e672e20266e6273703b3c2f703e0d0a3c756c3e0d0a3c6c693e496620796f752073656c656374266e6273703b3c656d3e4974656d2069736e26727371756f3b74206173206465736372696265643c2f656d3e2c20796f7526727371756f3b6c6c206e65656420746f2075706c6f61642070686f746f73206f6620796f7572206974656d7320746f2073686f772074686174207768617420796f752072656365697665642077617320646966666572656e742066726f6d207768617420796f7520776572652073686f776e206f6e20457473792e20266e6273703b3c2f6c693e0d0a3c6c693e4265207375726520746f2066696c6c206f757420746865207265706f7274207769746820616e792064657461696c7320796f75207468696e6b206d69676874206265206e656365737361727920666f72204574737920746f20636f6e7369646572207768656e20726576696577696e6720796f757220636173652e3c2f6c693e0d0a3c6c693e4c6173746c792c20636c69636b266e6273703b3c656d3e5375626d69743c2f656d3e266e6273703b61742074686520626f74746f6d206f662074686520706167652e266e6273703b3c2f6c693e0d0a3c2f756c3e0d0a3c703e3c7374726f6e673e596f7526727371756f3b7665206e6f772066696c656420612063617365207769746820457473792e3c2f7374726f6e673e266e6273703b596f7526727371756f3b6c6c2062652062726f7567687420746f2074686520266c6471756f3b63617365206c6f672c26726471756f3b20776865726520796f752063616e206c6561766520636f6d6d656e747320616e6420747261636b207468652070726f6772657373206f6620796f757220636173652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e5570646174696e67206120636173653c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c703e43617365732c20696e20706172746963756c61722c20726571756972652074686520627579657226727371756f3b732070617274696369706174696f6e2c20736f20796f7526727371756f3b6c6c206e65656420746f20636f6e74696e756520746f20757064617465207468652063617365207769746820616e792072656c6576616e7420696e666f726d6174696f6e2c206576656e20616674657220796f7526727371756f3b7665207375626d69747465642069742e20496620796f7520646f6e26727371756f3b742070617274696369706174652c20796f75722063617365206d617920626520636c6f7365642e20266e6273703b3c2f703e0d0a3c703e546f2075706461746520796f757220636173652c20646f2074686520666f6c6c6f77696e67206f6e636520796f7526727371756f3b7265207369676e656420696e3a266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e31293c2f7374726f6e673e266e6273703b3c2f7370616e3e476f20746f266e6273703b3c6120687265663d2268747470733a2f2f7777772e657473792e636f6d2f796f75722f636173657322207461726765743d225f626c616e6b223e3c656d3e596f7572204163636f756e74266e6273703b2667743b266e6273703b43617365733c2f656d3e3c2f613e2e3c2f703e0d0a3c756c3e0d0a3c6c693e486572652c20796f7526727371756f3b6c6c2073656520616c6c2074686520636173657320796f7526727371756f3b7665207265706f7274656420616e642c20696620796f7526727371756f3b726520616c736f20612073656c6c65722c20796f752077696c6c2073656520616e79206361736573207265706f7274656420616761696e737420796f75722073686f702e3c2f6c693e0d0a3c6c693e436c69636b696e67206f6e206120636173652077696c6c2074616b6520796f7520746f2074686174206361736526727371756f3b7320706167652c20776865726520796f752063616e206c65617665206164646974696f6e616c20636f6d6d656e74732e20266e6273703b3c2f6c693e0d0a3c6c693e4f6e636520796f75207375626d697420796f757220636f6d6d656e74732c20746865792077696c6c20626520696e207468652063617365206c6f6720776865726520626f7468207468652073656c6c657220616e6420457473792063616e20736565207768617420796f7526727371756f3b766520706f737465642e266e6273703b3c2f6c693e0d0a3c2f756c3e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e32293c2f7374726f6e673e266e6273703b3c2f7370616e3e4966207468652073656c6c657220646f65736e277420726573706f6e64206f72207265736f6c7665207468652063617365266e6273703b3c7374726f6e673e77697468696e206f6e65207765656b2066726f6d20746865206461746520697420776173206f70656e65643c2f7374726f6e673e2c20746865206f7074696f6e20746f20657363616c61746520746865206361736520666f72204574737926727371756f3b73207265766965772077696c6c2061707065617220696e207468652063617365206c6f672e20266e6273703b3c2f703e0d0a3c756c3e0d0a3c6c693e497426727371756f3b7320696d706f7274616e7420746f206b6e6f77207468617420746865206f7074696f6e20746f20657363616c61746520796f757220636173652077696c6c206e6f742062652076697369626c65266e6273703b3c7374726f6e673e756e74696c206f6e65207765656b20616674657220746865206361736520776173206f70656e65643c2f7374726f6e673e2e3c2f6c693e0d0a3c2f756c3e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e3c7370616e3e33293c2f7370616e3e266e6273703b3c2f7374726f6e673e546f20657363616c61746520796f757220636173652c20676f20746f266e6273703b3c6120687265663d2268747470733a2f2f7777772e657473792e636f6d2f796f75722f636173657322207461726765743d225f626c616e6b223e3c656d3e596f7572204163636f756e74202667743b266e6273703b43617365733c2f656d3e3c2f613e2e2046696e6420796f7572206361736520616e6420636c69636b20746865266e6273703b3c656d3e457363616c6174653c2f656d3e266e6273703b627574746f6e2e266e6273703b3c2f703e0d0a3c703e3c696d67207372633d2268747470733a2f2f6e792d696d616765322e657473792e636f6d2f3030382f302f302f696b625f66756c6c7866756c6c2e383932323831345f363237792e6a70672220616c743d22222077696474683d2234313522206865696768743d2231333722202f3e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7370616e3e3c7374726f6e673e34293c2f7374726f6e673e3c2f7370616e3e266e6273703b4966207468652073656c6c6572207374696c6c20646f65736e26727371756f3b74207265736f6c766520746865206361736520616674657220796f7572206361736520686173206265656e20657363616c617465642c20746861742073656c6c65722077696c6c206c6f7365207468652070726976696c65676520746f2073656c6c206f6e20457473792e204174207468617420706f696e742c207468652073656c6c65722077696c6c266e6273703b3c656d3e3c7374726f6e673e6e6565643c2f7374726f6e673e3c2f656d3e266e6273703b746f207265736f6c766520796f75722063617365206265666f7265206865206f72207368652063616e2073656c6c206f6e204574737920616761696e2e20496620746869732068617070656e732c2045747379206d61792061736b20796f7520666f72206d6f726520696e666f726d6174696f6e2e266e6273703b3c2f703e0d0a3c756c3e0d0a3c6c693e506c65617365206265207375726520746f20726573706f6e6420746f20616e792072657175657374732066726f6d20457473792077697468696e207468652063617365206c6f6720746f2070726576656e7420796f757220636173652066726f6d206265696e6720636c6f7365642e3c2f6c693e0d0a3c2f756c3e0d0a3c703e496620796f75207061696420766961266e6273703b3c7374726f6e673e50617950616c3c2f7374726f6e673e2c266e6273703b3c7374726f6e673e45747379206973206e6f742061626c6520746f20726566756e642050617950616c207061796d656e74733c2f7374726f6e673e2e2050617950616c206861732061206c696d697465642074696d65206672616d6520666f722066696c696e67206120636c61696d2e20506c6561736520636f6e74616374266e6273703b3c6120687265663d2268747470733a2f2f7777772e70617970616c2e636f6d2f75732f6367692d62696e2f68656c707765623f636d643d5f68656c7022207461726765743d225f626c616e6b223e50617950616c277320637573746f6d657220737570706f72743c2f613e266e6273703b666f72206d6f726520696e666f726d6174696f6e2e3c2f703e0d0a3c703e496620796f75722070726f626c656d266e6273703b3c7374726f6e673e686173206265656e207265736f6c7665643c2f7374726f6e673e2c20796f752063616e20636c69636b266e6273703b3c656d3e436c6f736520436173653c2f656d3e266e6273703b617420616e792074696d652e20426f746820796f7520616e64207468652073656c6c65722077696c6c2072656365697665206120636f6e6669726d6174696f6e20656d61696c207768656e20746865206361736520636c6f7365732e266e6273703b3c2f703e0d0a3c703e3c656d3e496620796f752062656c6965766520796f7520726563656976656420616e20696c6c6567616c206f72206861726d66756c2070726f647563742c20706c6561736520636f6e7461637420796f7572206c6f63616c20617574686f7269746965732e3c2f656d3e3c2f703e, '', 'Publish', ''),
(11, 'What are Teams?', 'What are Teams?', 'what-are-teams', 'Yes', 'Main', 0, 0x5768617420617265205465616d733f, 0x5768617420617265205465616d733f, 0x3c703e5768617420617265205465616d733f3c2f703e, '', 'Publish', 0x5768617420617265205465616d733f),
(12, 'Fellowship Program', 'Fellowship Program', 'fellowship-program', 'Yes', 'Main', 0, '', '', 0x3c703e46656c6c6f77736869702050726f6772616d3c2f703e, '', 'Publish', ''),
(13, 'Community Guidelines', 'Community Guidelines', 'community-guidelines', 'Yes', 'Main', 0, '', '', 0x3c703e436f6d6d756e6974792047756964656c696e65733c2f703e, '', 'Publish', '');
INSERT INTO `artfill_cms` (`id`, `page_name`, `page_title`, `seourl`, `hidden_page`, `category`, `parent`, `meta_tag`, `meta_description`, `description`, `css_descrip`, `status`, `meta_title`) VALUES
(14, 'guidelines', 'guidelines', 'guidelines', 'Yes', 'Main', 0, '', '', 0x3c6469763e0d0a3c64697620636c6173733d226c63223e0d0a3c703e3c7374726f6e673e4c6f72656d20497073756d3c2f7374726f6e673e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d2020497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c20207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b6520612020747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f2020746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e202049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c65747261736574207368656574732020636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f7020207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d2020497073756d2e3c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d227263223e0d0a3c703e49742069732061206c6f6e67202065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c652020636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d2020497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c20617320206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b6520207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f727320206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d2020697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f7573202076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d657320206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e0d0a3c2f6469763e0d0a3c2f6469763e0d0a266e6273703b0d0a3c64697620636c6173733d226c63223e0d0a3c703e436f6e74726172792020746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f74732020696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f766572203230303020207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e65792020436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c2020636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f66202074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e20204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e696275732020426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e2020696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c61722020647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d2020646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e0d0a3c703e54686520207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f772020666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e696275732020426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e20746865697220657861637420206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e2020627920482e205261636b68616d2e3c2f703e0d0a3c2f6469763e0d0a3c703e54686572652020617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c206275742074686520206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f72202072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f75206172652020676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e27742020616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d202067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b7320617320206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e20497420757365732020612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c202073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e20546865202067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c2020696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e, '', 'Publish', ''),
(15, 'Prohibited Items', 'Prohibited Items', 'prohibited-items', 'No', 'Main', 0, 0x50726f68696269746564204974656d73, 0x50726f68696269746564204974656d73, 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204d616563656e61732020656c656966656e642073656d207365642076656e656e61746973207665686963756c612e2043757261626974757220636f6e64696d656e74756d2073656d207068617265747261202073617069656e20656c656966656e642c206567657420656c656d656e74756d206a7573746f206d6f6c6c69732e2050686173656c6c75732074726973746971756520207363656c657269737175652073656d206e6f6e206d6f6c6c69732e2050726f696e20706f727461206d61676e61206e6563206f726369206c616f726565742c2061632020706f72747469746f722074656c6c757320706f7274612e20496e74656765722065752066696e69627573206c6967756c612e204e756c6c616d207072657469756d207175616d202069642066696e696275732074656d706f722e204e756e6320697073756d206469616d2c2070756c76696e6172206e656320657261742061742c207472697374697175652020696163756c69732076656c69742e20437572616269747572206475692065726f732c207072657469756d206567657420637572737573206e65632c2076697665727261206e656320206c656f2e20446f6e6563206c6f72656d20746f72746f722c20766f6c757470617420656765742068656e6472657269742065742c2072686f6e63757320766974616520206d61676e612e20566976616d7573207574206d6178696d75732070757275732e205175697371756520616320626962656e64756d2073656d2e20566976616d75732065742020626c616e646974207475727069732e2053757370656e646973736520636f6e76616c6c69732c20656c697420617420657569736d6f6420756c747269636965732c2065737420206d617572697320747269737469717565206c656f2c206964206d6f6c6c6973206f726369206c65637475732073656420697073756d2e3c2f703e0a3c703e50726f696e20647569206d657475732c20657569736d6f64206e6563206c6163696e69612065742c2063757273757320677261766964612065782e205175697371756520206f726e6172652074696e636964756e742073617069656e2c20757420657569736d6f6420697073756d206672696e67696c6c612061632e20496e7465676572206e756e6320206c6f72656d2c207363656c6572697371756520736564207072657469756d20717569732c2074696e636964756e7420657420746f72746f722e205072616573656e7420206c6163696e6961206c6967756c61206d657475732c20617420766573746962756c756d20746f72746f7220636f6e73656374657475722065742e2053757370656e646973736520207574206d6173736120736564206e756e6320636f6e67756520636f6e6775652e204e756e63206c756374757320756c7472696365732073617069656e2e2050686173656c6c7573202076656c20756c74726963657320646f6c6f722e204e756c6c616d206375727375732065666669636974757220696e74657264756d2e204d61757269732066656c6973206e69736c2c2020706f737565726520656765742076656c69742065742c20616363756d73616e20696d70657264696574206e756c6c612e2055742076656e656e61746973206e756e63202076697461652074656d706f72207072657469756d2e20566976616d757320736564206f726369206964206f64696f206672696e67696c6c61206665726d656e74756d2e202051756973717565206f726e6172652074696e636964756e74206f64696f2c207175697320706f727461206e69626820666575676961742074696e636964756e742e20447569732020657420657820717569732073617069656e2074696e636964756e74206d61747469732065742065752065782e3c2f703e, '', 'Publish', 0x50726f68696269746564204974656d73),
(16, 'Intellectual Property Policy', 'Intellectual Property Policy', 'intellectual-property-policy', 'No', 'Main', 0, 0x496e74656c6c65637475616c2050726f706572747920506f6c696379, 0x496e74656c6c65637475616c2050726f706572747920506f6c696379, 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204d616563656e61732020656c656966656e642073656d207365642076656e656e61746973207665686963756c612e2043757261626974757220636f6e64696d656e74756d2073656d207068617265747261202073617069656e20656c656966656e642c206567657420656c656d656e74756d206a7573746f206d6f6c6c69732e2050686173656c6c75732074726973746971756520207363656c657269737175652073656d206e6f6e206d6f6c6c69732e2050726f696e20706f727461206d61676e61206e6563206f726369206c616f726565742c2061632020706f72747469746f722074656c6c757320706f7274612e20496e74656765722065752066696e69627573206c6967756c612e204e756c6c616d207072657469756d207175616d202069642066696e696275732074656d706f722e204e756e6320697073756d206469616d2c2070756c76696e6172206e656320657261742061742c207472697374697175652020696163756c69732076656c69742e20437572616269747572206475692065726f732c207072657469756d206567657420637572737573206e65632c2076697665727261206e656320206c656f2e20446f6e6563206c6f72656d20746f72746f722c20766f6c757470617420656765742068656e6472657269742065742c2072686f6e63757320766974616520206d61676e612e20566976616d7573207574206d6178696d75732070757275732e205175697371756520616320626962656e64756d2073656d2e20566976616d75732065742020626c616e646974207475727069732e2053757370656e646973736520636f6e76616c6c69732c20656c697420617420657569736d6f6420756c747269636965732c2065737420206d617572697320747269737469717565206c656f2c206964206d6f6c6c6973206f726369206c65637475732073656420697073756d2e3c2f703e0a3c703e50726f696e20647569206d657475732c20657569736d6f64206e6563206c6163696e69612065742c2063757273757320677261766964612065782e205175697371756520206f726e6172652074696e636964756e742073617069656e2c20757420657569736d6f6420697073756d206672696e67696c6c612061632e20496e7465676572206e756e6320206c6f72656d2c207363656c6572697371756520736564207072657469756d20717569732c2074696e636964756e7420657420746f72746f722e205072616573656e7420206c6163696e6961206c6967756c61206d657475732c20617420766573746962756c756d20746f72746f7220636f6e73656374657475722065742e2053757370656e646973736520207574206d6173736120736564206e756e6320636f6e67756520636f6e6775652e204e756e63206c756374757320756c7472696365732073617069656e2e2050686173656c6c7573202076656c20756c74726963657320646f6c6f722e204e756c6c616d206375727375732065666669636974757220696e74657264756d2e204d61757269732066656c6973206e69736c2c2020706f737565726520656765742076656c69742065742c20616363756d73616e20696d70657264696574206e756c6c612e2055742076656e656e61746973206e756e63202076697461652074656d706f72207072657469756d2e20566976616d757320736564206f726369206964206f64696f206672696e67696c6c61206665726d656e74756d2e202051756973717565206f726e6172652074696e636964756e74206f64696f2c207175697320706f727461206e69626820666575676961742074696e636964756e742e20447569732020657420657820717569732073617069656e2074696e636964756e74206d61747469732065742065752065782e3c2f703e, '', 'Publish', 0x496e74656c6c65637475616c2050726f706572747920506f6c696379),
(22, 'terms conditions', 'Terms&Conditions', 'terms-conditions', 'No', 'Sub', 6, '', '', 0x3c703e68656c6c6f206e6f20636f6e646974696f6e73206f6e20676966743c2f703e, '', 'Publish', '');

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `artfill_cod_payment`
--

CREATE TABLE IF NOT EXISTS `artfill_cod_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` datetime NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_cod_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_comment`
--

CREATE TABLE IF NOT EXISTS `artfill_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comments_title` varchar(255) NOT NULL,
  `comment_body` longtext NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `comment_month_year` varchar(255) NOT NULL,
  `comment_status` enum('active','inactive','admin_inactive') NOT NULL DEFAULT 'inactive',
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_editdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_events`
--

CREATE TABLE IF NOT EXISTS `artfill_community_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventTitle` varchar(250) NOT NULL,
  `event_seourl` varchar(255) NOT NULL,
  `eventDescription` mediumtext NOT NULL,
  `eventLink` text NOT NULL,
  `eventType` enum('Special','Normal') NOT NULL DEFAULT 'Normal',
  `imagePath` varchar(255) NOT NULL,
  `eventDate` date NOT NULL,
  `eventstartTime` varchar(255) NOT NULL,
  `eventendTime` varchar(255) NOT NULL,
  `eventTime` varchar(200) NOT NULL,
  `eventAddedby` int(11) NOT NULL,
  `eventButtonName` varchar(250) NOT NULL,
  `eventLocation` mediumtext NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  `status` enum('Active','Inactive','Unpublish') NOT NULL,
  `eventAddDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_events`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_news`
--

CREATE TABLE IF NOT EXISTS `artfill_community_news` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_image` varchar(250) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_status` enum('active','inactive','draft','Unpublish') DEFAULT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_keyword` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posted_month_year` varchar(255) NOT NULL,
  `posted_editdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_news`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_newscomments`
--

CREATE TABLE IF NOT EXISTS `artfill_community_newscomments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comments_title` varchar(255) NOT NULL,
  `comment_body` longtext NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `comment_month_year` varchar(255) NOT NULL,
  `comment_status` enum('active','inactive','Unpublish') DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_editdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_newscomments`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_teamdiscussion`
--

CREATE TABLE IF NOT EXISTS `artfill_community_teamdiscussion` (
  `post_title` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `post` text NOT NULL,
  `postType` enum('Original','Responses') NOT NULL,
  `rootId` int(11) NOT NULL,
  `status` enum('Active','Inactive','Closed','Unpublish') DEFAULT NULL,
  `postDate` datetime NOT NULL,
  `discussionView` enum('Public','Private') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_teamdiscussion`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_teammember`
--

CREATE TABLE IF NOT EXISTS `artfill_community_teammember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `captainId` int(11) NOT NULL,
  `teamLeader` int(11) NOT NULL,
  `memberType` enum('Captain','Leader','Member') NOT NULL,
  `joinDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_teammember`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_community_teams`
--

CREATE TABLE IF NOT EXISTS `artfill_community_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(255) NOT NULL,
  `teamSeourl` varchar(255) NOT NULL,
  `teamCaptainId` int(11) NOT NULL,
  `teamShortdescription` text NOT NULL,
  `teamDescription` longtext NOT NULL,
  `teamRules` text NOT NULL,
  `teamApplicationquestions` text NOT NULL,
  `teamImage` varchar(255) NOT NULL,
  `teamTags` text NOT NULL,
  `teamType` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `teamLocation` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Unpublish') NOT NULL,
  `teamAddDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_community_teams`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_contact_people`
--

CREATE TABLE IF NOT EXISTS `artfill_contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `subject` longtext NOT NULL,
  `message` blob NOT NULL,
  `dataAdded` datetime NOT NULL,
  `sender_status` enum('Unread','Read','Trash','Delete') NOT NULL DEFAULT 'Read',
  `receiver_status` enum('Unread','Read','Trash','Delete') NOT NULL DEFAULT 'Unread',
  `sender_starred` enum('Yes','No') NOT NULL,
  `receiver_starred` enum('Yes','No') NOT NULL,
  `mail_type` varchar(100) NOT NULL,
  `delivery_status` enum('Success','Fail') NOT NULL,
  `tid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_contact_people`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_contact_seller`
--

CREATE TABLE IF NOT EXISTS `artfill_contact_seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longblob NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `selleremail` varchar(255) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_contact_seller`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_contact_shop_owner`
--

CREATE TABLE IF NOT EXISTS `artfill_contact_shop_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longblob NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `selleremail` varchar(255) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `dealcode_number` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_contact_shop_owner`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_contact_user`
--

CREATE TABLE IF NOT EXISTS `artfill_contact_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` longblob NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `selleremail` varchar(255) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_contact_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_country`
--

CREATE TABLE IF NOT EXISTS `artfill_country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contid` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seourl` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_type` char(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_symbol` text NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_tax` decimal(10,2) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_default` enum('No','Yes') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=233 ;

--
-- Dumping data for table `artfill_country`
--

INSERT INTO `artfill_country` (`id`, `contid`, `country_code`, `name`, `seourl`, `currency_type`, `currency_symbol`, `shipping_cost`, `shipping_tax`, `meta_title`, `meta_keyword`, `meta_description`, `description`, `status`, `dateAdded`, `currency_default`) VALUES
(1, 'EU', 'AD', 'Andorra', 'andorra', 'EUR', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 16:03:27', 'No'),
(2, 'AS', 'AE', 'United Arab Emirates', 'united-arab-emirates', 'AED', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(3, 'AS', 'AF', 'Afghanistan', 'afghanistan', 'AFN', '₱', '3.00', '0.00', '', '', '', '', 'Active', '2013-09-14 09:08:13', 'No'),
(4, 'NA', 'AG', 'Antigua And Barbuda', 'antigua-and-barbuda', 'XCD', '$', '2.00', '3.00', '', '', '', '', 'Active', '2013-08-22 10:38:52', 'No'),
(5, 'EU', 'AL', 'Albania', 'albania', 'ALL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(6, 'AS', 'AM', 'Armenia', 'armenia', 'AMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(7, 'AF', 'AO', 'Angola', 'angola', 'AOA', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(8, 'AN', 'AQ', 'Antarctica', 'antarctica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(9, 'SA', 'AR', 'Argentina', 'argentina', 'ARS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(10, 'OC', 'AS', 'American Samoa', 'american-samoa', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(11, 'EU', 'AT', 'Austria', 'austria', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(12, 'OC', 'AU', 'Australia', 'australia', 'AUD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 13:10:37', 'No'),
(13, 'NA', 'AW', 'Aruba', 'aruba', 'AWG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(14, '', 'AX', 'Aland Islands', 'aland-islands', 'EUR', '€', '0.00', '0.00', '', '', '', '', 'Active', '2013-11-15 14:21:53', 'No'),
(15, 'AS', 'AZ', 'Azerbaijan', 'azerbaijan', 'AZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(16, '', 'BA', 'Bosnia And Herzegovina', 'bosnia-and-herzegovina', 'BAM', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(17, 'NA', 'BB', 'Barbados', 'barbados', 'BBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(18, 'AS', 'BD', 'Bangladesh', 'bangladesh', 'BDT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(19, 'EU', 'BE', 'Belgium', 'belgium', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(20, 'AF', 'BF', 'Burkina Faso', 'burkina-faso', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(21, 'EU', 'BG', 'Bulgaria', 'bulgaria', 'BGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(22, 'AS', 'BH', 'Bahrain', 'bahrain', 'BHD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(23, 'AF', 'BI', 'Burundi', 'burundi', 'BIF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(24, 'AF', 'BJ', 'Benin', 'benin', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(25, 'NA', 'BM', 'Bermuda', 'bermuda', 'BMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(26, '', 'BN', 'Brunei', 'brunei', 'BND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(27, 'SA', 'BO', 'Bolivia', 'bolivia', 'BOB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(28, '', 'BQ', 'Bonaire, Saint Eustatius And Saba ', 'bonaire,-saint-eustatius-and-saba', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(29, 'SA', 'BR', 'Brazil', 'brazil', 'BRL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(30, 'NA', 'BS', 'Bahamas', 'bahamas', 'BSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(31, 'AS', 'BT', 'Bhutan', 'bhutan', 'BTN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(32, 'AN', 'BV', 'Bouvet Island', 'bouvet-island', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(33, 'AF', 'BW', 'Botswana', 'botswana', 'BWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(34, 'EU', 'BY', 'Belarus', 'belarus', 'BYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(35, 'NA', 'BZ', 'Belize', 'belize', 'BZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(36, 'NA', 'CA', 'Canada', 'canada', 'CAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(37, '', 'CD', 'Democratic Republic Of The Congo', 'democratic-republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(38, 'AF', 'CF', 'Central African Republic', 'central-african-republic', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(39, '', 'CG', 'Republic Of The Congo', 'republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(40, 'EU', 'CH', 'Switzerland', 'switzerland', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(41, '', 'CI', 'Ivory Coast', 'ivory-coast', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(42, 'SA', 'CL', 'Chile', 'chile', 'CLP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(43, 'AF', 'CM', 'Cameroon', 'cameroon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(44, 'AS', 'CN', 'China', 'china', 'CNY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(45, 'SA', 'CO', 'Colombia', 'colombia', 'COP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(46, 'NA', 'CR', 'Costa Rica', 'costa-rica', 'CRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(47, 'NA', 'CU', 'Cuba', 'cuba', 'CUP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(48, 'AF', 'CV', 'Cape Verde', 'cape-verde', 'CVE', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(49, 'EU', 'CY', 'Cyprus', 'cyprus', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(50, 'EU', 'CZ', 'Czech Republic', 'czech-republic', 'CZK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(51, 'EU', 'DE', 'Germany', 'germany', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(52, 'AF', 'DJ', 'Djibouti', 'djibouti', 'DJF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(53, 'EU', 'DK', 'Denmark', 'denmark', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(54, 'NA', 'DM', 'Dominica', 'dominica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(55, 'NA', 'DO', 'Dominican Republic', 'dominican-republic', 'DOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(56, 'AF', 'DZ', 'Algeria', 'algeria', 'DZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(57, 'SA', 'EC', 'Ecuador', 'ecuador', 'ECS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(58, 'EU', 'EE', 'Estonia', 'estonia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(59, 'AF', 'EG', 'Egypt', 'egypt', 'EGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(60, 'AF', 'EH', 'Western Sahara', 'western-sahara', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(61, 'AF', 'ER', 'Eritrea', 'eritrea', 'ERN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(62, 'EU', 'ES', 'Spain', 'spain', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(63, 'AF', 'ET', 'Ethiopia', 'ethiopia', 'ETB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(64, 'EU', 'FI', 'Finland', 'finland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(65, 'OC', 'FJ', 'Fiji', 'fiji', 'FJD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(66, '', 'FM', 'Micronesia', 'micronesia', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(67, 'EU', 'FO', 'Faroe Islands', 'faroe-islands', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(68, 'EU', 'FR', 'France', 'france', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(69, 'AF', 'GA', 'Gabon', 'gabon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(70, 'EU', 'GB', 'United Kingdom', 'united-kingdom', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-09-16 10:34:38', 'No'),
(71, 'NA', 'GD', 'Grenada', 'grenada', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(72, 'AS', 'GE', 'Georgia', 'georgia', 'GEL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(73, 'SA', 'GF', 'French Guiana', 'french-guiana', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(74, '', 'GG', 'Guernsey', 'guernsey', 'GGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(75, 'AF', 'GH', 'Ghana', 'ghana', 'GHS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(76, 'NA', 'GL', 'Greenland', 'greenland', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(77, 'AF', 'GM', 'Gambia', 'gambia', 'GMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(78, 'AF', 'GN', 'Guinea', 'guinea', 'GNF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(79, 'NA', 'GP', 'Guadeloupe', 'guadeloupe', 'EUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(80, 'AF', 'GQ', 'Equatorial Guinea', 'equatorial-guinea', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(81, 'EU', 'GR', 'Greece', 'greece', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(82, 'NA', 'GT', 'Guatemala', 'guatemala', 'QTQ', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(83, 'OC', 'GU', 'Guam', 'guam', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(84, 'AF', 'GW', 'Guinea-Bissau', 'guineabissau', 'GWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(85, 'SA', 'GY', 'Guyana', 'guyana', 'GYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(86, 'AS', 'HK', 'Hong Kong', 'hong-kong', 'HKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(87, 'NA', 'HN', 'Honduras', 'honduras', 'HNL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(88, 'EU', 'HR', 'Croatia', 'croatia', 'HRK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(89, 'NA', 'HT', 'Haiti', 'haiti', 'HTG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(90, 'EU', 'HU', 'Hungary', 'hungary', 'HUF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(91, 'AS', 'ID', 'Indonesia', 'indonesia', 'IDR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(92, 'EU', 'IE', 'Ireland', 'ireland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(93, 'AS', 'IL', 'Israel', 'israel', 'ILS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(94, '', 'IM', 'Isle Of Man', 'isle-of-man', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(95, 'AS', 'IN', 'India', 'india', 'INR', 'Rs', '15.00', '10.00', '', '', '', '', 'Active', '2013-08-22 10:39:55', 'No'),
(96, 'AS', 'IO', 'British Indian Ocean Territory', 'british-indian-ocean-territory', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(97, 'AS', 'IQ', 'Iraq', 'iraq', 'IQD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(98, '', 'IR', 'Iran', 'iran', 'IRR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(99, 'EU', 'IS', 'Iceland', 'iceland', 'ISK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(100, 'EU', 'IT', 'Italy', 'italy', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(101, '', 'JE', 'Jersey', 'jersey', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(102, 'NA', 'JM', 'Jamaica', 'jamaica', 'JMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(103, 'AS', 'JO', 'Jordan', 'jordan', 'JOD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(104, 'AS', 'JP', 'Japan', 'japan', 'JPY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(105, 'AF', 'KE', 'Kenya', 'kenya', 'KES', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(106, 'AS', 'KG', 'Kyrgyzstan', 'kyrgyzstan', 'KGS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(107, 'AS', 'KH', 'Cambodia', 'cambodia', 'KHR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(108, 'OC', 'KI', 'Kiribati', 'kiribati', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(109, 'AF', 'KM', 'Comoros', 'comoros', 'KMF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(110, 'NA', 'KN', 'Saint Kitts And Nevis', 'saint-kitts-and-nevis', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(111, '', 'KP', 'North Korea', 'north-korea', 'KPW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(112, '', 'KR', 'South Korea', 'south-korea', 'KRW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(113, 'AS', 'KW', 'Kuwait', 'kuwait', 'KWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(114, 'AS', 'KZ', 'Kazakhstan', 'kazakhstan', 'KZT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(115, '', 'LA', 'Laos', 'laos', 'LAK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(116, 'AS', 'LB', 'Lebanon', 'lebanon', 'LBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(117, 'NA', 'LC', 'Saint Lucia', 'saint-lucia', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(118, 'EU', 'LI', 'Liechtenstein', 'liechtenstein', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(119, 'AS', 'LK', 'Sri Lanka', 'sri-lanka', 'LKR', 'Rs', '20.00', '12.00', '', '', '', '', 'Active', '2013-08-22 11:05:34', 'No'),
(120, 'AF', 'LR', 'Liberia', 'liberia', 'LRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(121, 'AF', 'LS', 'Lesotho', 'lesotho', 'LSL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(122, 'EU', 'LT', 'Lithuania', 'lithuania', 'LTL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(123, 'EU', 'LU', 'Luxembourg', 'luxembourg', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(124, 'EU', 'LV', 'Latvia', 'latvia', 'LVL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(125, '', 'LY', 'Libya', 'libya', 'LYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(126, 'AF', 'MA', 'Morocco', 'morocco', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(127, 'EU', 'MC', 'Monaco', 'monaco', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(128, '', 'MD', 'Moldova', 'moldova', 'MDL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(129, '', 'ME', 'Montenegro', 'montenegro', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(130, 'AF', 'MG', 'Madagascar', 'madagascar', 'MGF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(131, 'OC', 'MH', 'Marshall Islands', 'marshall-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(132, '', 'MK', 'Macedonia', 'macedonia', 'MKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(133, 'AF', 'ML', 'Mali', 'mali', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(134, 'AS', 'MM', 'Myanmar', 'myanmar', 'MMK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(135, 'AS', 'MN', 'Mongolia', 'mongolia', 'MNT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(136, '', 'MO', 'Macao', 'macao', 'MOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(137, 'OC', 'MP', 'Northern Mariana Islands', 'northern-mariana-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(138, 'NA', 'MQ', 'Martinique', 'martinique', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(139, 'AF', 'MR', 'Mauritania', 'mauritania', 'MRO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(140, 'NA', 'MS', 'Montserrat', 'montserrat', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(141, 'AF', 'MU', 'Mauritius', 'mauritius', 'MUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(142, 'AS', 'MV', 'Maldives', 'maldives', 'MVR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(143, 'AF', 'MW', 'Malawi', 'malawi', 'MWK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(144, 'NA', 'MX', 'Mexico', 'mexico', 'MXN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(145, 'AS', 'MY', 'Malaysia', 'malaysia', 'MYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(146, 'AF', 'MZ', 'Mozambique', 'mozambique', 'MZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(147, 'AF', 'NA', 'Namibia', 'namibia', 'NAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(148, 'OC', 'NC', 'New Caledonia', 'new-caledonia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(149, 'AF', 'NE', 'Niger', 'niger', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(150, 'AF', 'NG', 'Nigeria', 'nigeria', 'NGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(151, 'NA', 'NI', 'Nicaragua', 'nicaragua', 'NIO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(152, 'EU', 'NL', 'Netherlands', 'netherlands', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(153, 'EU', 'NO', 'Norway', 'norway', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(154, 'AS', 'NP', 'Nepal', 'nepal', 'NPR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(155, 'OC', 'NR', 'Nauru', 'nauru', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(156, 'OC', 'NZ', 'New Zealand', 'new-zealand', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(157, 'AS', 'OM', 'Oman', 'oman', 'OMR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(158, 'NA', 'PA', 'Panama', 'panama', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(159, 'SA', 'PE', 'Peru', 'peru', 'PEN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(160, 'OC', 'PF', 'French Polynesia', 'french-polynesia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(161, 'OC', 'PG', 'Papua New Guinea', 'papua-new-guinea', 'PGK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(162, 'AS', 'PH', 'Philippines', 'philippines', 'PHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(163, 'AS', 'PK', 'Pakistan', 'pakistan', 'PKR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(164, 'EU', 'PL', 'Poland', 'poland', 'PLN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(165, '', 'PM', 'Saint Pierre And Miquelon', 'saint-pierre-and-miquelon', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(166, 'NA', 'PR', 'Puerto Rico', 'puerto-rico', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(167, '', 'PS', 'Palestinian Territory', 'palestinian-territory', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(168, 'EU', 'PT', 'Portugal', 'portugal', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(169, 'OC', 'PW', 'Palau', 'palau', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(170, 'SA', 'PY', 'Paraguay', 'paraguay', 'PYG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(171, 'AS', 'QA', 'Qatar', 'qatar', 'QAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(172, 'AF', 'RE', 'Reunion', 'reunion', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(173, 'EU', 'RO', 'Romania', 'romania', 'RON', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(174, '', 'RS', 'Serbia', 'serbia', 'RSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(175, '', 'RU', 'Russia', 'russia', 'RUB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(176, 'AF', 'RW', 'Rwanda', 'rwanda', 'RWF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(177, 'AS', 'SA', 'Saudi Arabia', 'saudi-arabia', 'SAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(178, 'OC', 'SB', 'Solomon Islands', 'solomon-islands', 'SBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(179, 'AF', 'SC', 'Seychelles', 'seychelles', 'SCR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(180, 'AF', 'SD', 'Sudan', 'sudan', 'SDG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(181, 'EU', 'SE', 'Sweden', 'sweden', 'SEK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(182, 'AS', 'SG', 'Singapore', 'singapore', 'SGD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(183, '', 'SH', 'Saint Helena', 'saint-helena', 'SHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(184, 'EU', 'SI', 'Slovenia', 'slovenia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(185, '', 'SJ', 'Svalbard And Jan Mayen', 'svalbard-and-jan-mayen', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(186, '', 'SK', 'Slovakia', 'slovakia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(187, 'AF', 'SL', 'Sierra Leone', 'sierra-leone', 'SLL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(188, 'EU', 'SM', 'San Marino', 'san-marino', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(189, 'AF', 'SN', 'Senegal', 'senegal', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(190, 'AF', 'SO', 'Somalia', 'somalia', 'SOS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(191, 'SA', 'SR', 'Suriname', 'suriname', 'SRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(192, '', 'SS', 'South Sudan', 'south-sudan', 'SSP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(193, 'AF', 'ST', 'Sao Tome And Principe', 'sao-tome-and-principe', 'STD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(194, 'NA', 'SV', 'El Salvador', 'el-salvador', 'SVC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(195, '', 'SY', 'Syria', 'syria', 'SYP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(196, 'AF', 'SZ', 'Swaziland', 'swaziland', 'SZL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(197, 'AF', 'TD', 'Chad', 'chad', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(198, 'AN', 'TF', 'French Southern Territories', 'french-southern-territories', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(199, 'AF', 'TG', 'Togo', 'togo', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(200, 'AS', 'TH', 'Thailand', 'thailand', 'THB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(201, 'AS', 'TJ', 'Tajikistan', 'tajikistan', 'TJS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(202, 'OC', 'TK', 'Tokelau', 'tokelau', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(203, 'OC', 'TL', 'East Timor', 'east-timor', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(204, 'AS', 'TM', 'Turkmenistan', 'turkmenistan', 'TMT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(205, 'AF', 'TN', 'Tunisia', 'tunisia', 'TND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(206, 'OC', 'TO', 'Tonga', 'tonga', 'TOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(207, 'AS', 'TR', 'Turkey', 'turkey', 'TRY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(208, 'NA', 'TT', 'Trinidad And Tobago', 'trinidad-and-tobago', 'TTD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(209, 'OC', 'TV', 'Tuvalu', 'tuvalu', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(210, 'AS', 'TW', 'Taiwan', 'taiwan', 'TWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(211, '', 'TZ', 'Tanzania', 'tanzania', 'TZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(212, 'EU', 'UA', 'Ukraine', 'ukraine', 'UAH', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(213, 'AF', 'UG', 'Uganda', 'uganda', 'UGX', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(214, 'OC', 'UM', 'United States Minor Outlying Islands', 'united-states-minor-outlying-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(215, 'NA', 'US', 'United States', 'united-states', 'USD', '$', '10.00', '1.00', '', '', '', '', 'Active', '2014-01-20 19:00:06', 'Yes'),
(216, 'SA', 'UY', 'Uruguay', 'uruguay', 'UYU', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(217, 'AS', 'UZ', 'Uzbekistan', 'uzbekistan', 'UZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(218, 'NA', 'VC', 'Saint Vincent And The Grenadines', 'saint-vincent-and-the-grenadines', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(219, 'SA', 'VE', 'Venezuela', 'venezuela', 'VEF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(220, '', 'VI', 'U.S. Virgin Islands', 'u.s.-virgin-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(221, '', 'VN', 'Vietnam', 'vietnam', 'VND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(222, 'OC', 'VU', 'Vanuatu', 'vanuatu', 'VUV', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(223, '', 'WF', 'Wallis And Futuna', 'wallis-and-futuna', 'XPF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(224, 'OC', 'WS', 'Samoa', 'samoa', 'WST', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(225, '', 'XK', 'Kosovo', 'kosovo', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(226, 'AS', 'YE', 'Yemen', 'yemen', 'YER', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(227, 'AF', 'YT', 'Mayotte', 'mayotte', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(228, 'AF', 'ZA', 'South Africa', 'south-africa', 'ZAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(229, 'AF', 'ZM', 'Zambia', 'zambia', 'ZMW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(230, 'AF', 'ZW', 'Zimbabwe', 'zimbabwe', 'ZWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 10:27:12', 'No'),
(232, 'EE', 'EV', 'Everywhere Else', 'everywhere-else', 'USD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2014-05-07 13:25:14', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_couponcards`
--

CREATE TABLE IF NOT EXISTS `artfill_couponcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `price_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `sell_id` int(11) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `price_value` float(13,5) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` blob NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `purchase_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_couponcards`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_credit_cards`
--

CREATE TABLE IF NOT EXISTS `artfill_credit_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(25) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `security_code` varchar(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_credit_cards`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_currency`
--

CREATE TABLE IF NOT EXISTS `artfill_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` char(4) NOT NULL,
  `currency_value` decimal(10,2) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `currency_name` varchar(200) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `default_currency` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `artfill_currency`
--

INSERT INTO `artfill_currency` (`id`, `currency_code`, `currency_value`, `currency_symbol`, `currency_name`, `status`, `dateAdded`, `default_currency`) VALUES
(2, 'AUD', '1.00', '$', 'Australian Dollar', 'Active', '2015-08-21 12:37:24', 'No'),
(4, 'INR', '64.89', '₹', 'indian Rupee', 'Active', '2015-10-09 12:17:08', 'No'),
(5, 'USD', '1.00', '$', 'United States Dollar', 'Active', '2015-08-21 12:37:24', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_digital_files_history`
--

CREATE TABLE IF NOT EXISTS `artfill_digital_files_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `file_name` longtext NOT NULL,
  `download_time` datetime NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_digital_files_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_fancybox`
--

CREATE TABLE IF NOT EXISTS `artfill_fancybox` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `excerpt` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `likes` bigint(20) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `shipping_cost` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `price_range` mediumtext NOT NULL,
  `purchased` bigint(20) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_fancybox`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_fancybox_temp`
--

CREATE TABLE IF NOT EXISTS `artfill_fancybox_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_fancybox_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_fancybox_uses`
--

CREATE TABLE IF NOT EXISTS `artfill_fancybox_uses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `status` enum('Pending','Paid','Expired') NOT NULL DEFAULT 'Pending',
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `trans_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_fancybox_uses`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_favorite`
--

CREATE TABLE IF NOT EXISTS `artfill_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `favorite` enum('Yes','No') NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_favorite`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_feature_pack`
--

CREATE TABLE IF NOT EXISTS `artfill_feature_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `days` int(100) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_feature_pack`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_feature_product`
--

CREATE TABLE IF NOT EXISTS `artfill_feature_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expire_date` date NOT NULL,
  `product_seo` varchar(100) COLLATE utf8_bin NOT NULL,
  `start_date` date NOT NULL,
  `page` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_feature_product`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_feedback`
--

CREATE TABLE IF NOT EXISTS `artfill_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longblob NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_get_notified`
--

CREATE TABLE IF NOT EXISTS `artfill_get_notified` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `msg` enum('Yes','No') COLLATE utf8_bin NOT NULL,
  `follow` enum('Yes','No') COLLATE utf8_bin NOT NULL,
  `update_email` enum('Daily','Weekly','No') COLLATE utf8_bin NOT NULL DEFAULT 'No',
  `like` enum('Yes','No') COLLATE utf8_bin NOT NULL,
  `like_of_like` enum('Yes','No') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_get_notified`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_giftcards`
--

CREATE TABLE IF NOT EXISTS `artfill_giftcards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(13,5) NOT NULL,
  `description` blob NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `used_amount` decimal(10,2) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `paypal_transaction_id` varchar(255) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_giftcards`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_giftcards_settings`
--

CREATE TABLE IF NOT EXISTS `artfill_giftcards_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` longblob NOT NULL,
  `amounts` varchar(200) NOT NULL,
  `default_amount` varchar(100) NOT NULL,
  `expiry_days` int(11) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_giftcards_settings`
--

INSERT INTO `artfill_giftcards_settings` (`id`, `title`, `description`, `image`, `amounts`, `default_amount`, `expiry_days`, `status`) VALUES
(1, 'artfill GiftCard', 'artfill GiftCard', 0x383337352e6a70672c36322e6a70672c2c2c467265652d7368697070696e672d626162792d666c6f7765722d6465636f726174696f6e2d6769726c2d666f6e742d622d73756e676c61737365732d622d666f6e742d616e74692d75762d6368696c6472656e2d666f6e742d622e6a70672c, '100,500,1000,5000', '100', 25, 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_giftcards_temp`
--

CREATE TABLE IF NOT EXISTS `artfill_giftcards_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `description` blob NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `artfill_giftcards_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_home_sliders`
--

CREATE TABLE IF NOT EXISTS `artfill_home_sliders` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `image` mediumtext COLLATE utf8_bin NOT NULL,
  `link` text COLLATE utf8_bin NOT NULL,
  `status` enum('Active','Inactive','','') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_home_sliders`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_index_banner_settings`
--

CREATE TABLE IF NOT EXISTS `artfill_index_banner_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_description` longtext NOT NULL,
  `show_banner_text` enum('Yes','No') NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_index_banner_settings`
--

INSERT INTO `artfill_index_banner_settings` (`id`, `banner_description`, `show_banner_text`, `status`, `modified`) VALUES
(1, 'Shop directly from people around the world.', 'No', 'InActive', '2015-02-27 18:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_ipn`
--

CREATE TABLE IF NOT EXISTS `artfill_ipn` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `recurring_payment_id` varchar(750) NOT NULL,
  `payment_status` varchar(750) NOT NULL,
  `receiver_email` varchar(750) NOT NULL,
  `receiver_id` varchar(750) NOT NULL,
  `residence_country` varchar(50) NOT NULL,
  `payer_email` varchar(750) NOT NULL,
  `payer_id` varchar(750) NOT NULL,
  `payer_status` varchar(750) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `address_city` varchar(500) NOT NULL,
  `address_country` varchar(500) NOT NULL,
  `address_country_code` varchar(500) NOT NULL,
  `address_name` varchar(500) NOT NULL,
  `address_state` varchar(500) NOT NULL,
  `address_status` varchar(500) NOT NULL,
  `address_street` varchar(500) NOT NULL,
  `address_zip` varchar(500) NOT NULL,
  `custom` varchar(500) NOT NULL,
  `handling_amount` varchar(500) NOT NULL,
  `item_name` varchar(500) NOT NULL,
  `item_number` varchar(500) NOT NULL,
  `mc_currency` varchar(500) NOT NULL,
  `mc_fee` varchar(500) NOT NULL,
  `mc_gross` varchar(500) NOT NULL,
  `payment_date` varchar(500) NOT NULL,
  `payment_fee` varchar(500) NOT NULL,
  `payment_gross` varchar(500) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `protection_eligibility` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `shipping` varchar(500) NOT NULL,
  `tax` varchar(500) NOT NULL,
  `notify_version` varchar(500) NOT NULL,
  `charset` varchar(500) NOT NULL,
  `verify_sign` varchar(750) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_ipn`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_ipwhitelist`
--

CREATE TABLE IF NOT EXISTS `artfill_ipwhitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_ipwhitelist`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_landing_banner`
--

CREATE TABLE IF NOT EXISTS `artfill_landing_banner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `banner_option` enum('image','html') NOT NULL DEFAULT 'image',
  `banner_text` longblob NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Unpublish',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_landing_banner`
--

INSERT INTO `artfill_landing_banner` (`id`, `name`, `banner_option`, `banner_text`, `image`, `link`, `status`, `dateAdded`) VALUES
(1, 'landBanner1', 'image', '', 'Koala.jpg', '', 'Publish', '2015-02-03 11:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_languages`
--

CREATE TABLE IF NOT EXISTS `artfill_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang_code` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `default_language` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `artfill_languages`
--

INSERT INTO `artfill_languages` (`id`, `name`, `lang_code`, `status`, `default_language`) VALUES
(1, 'English', 'en', 'Active', 'Yes'),
(3, 'Arabic', 'ar', 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_lists`
--

CREATE TABLE IF NOT EXISTS `artfill_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` longtext NOT NULL,
  `followers` longtext NOT NULL,
  `banner` varchar(200) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `contributors` longtext NOT NULL,
  `contributors_invited` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `privacy` enum('Public','Private') NOT NULL DEFAULT 'Public',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_lists`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_list_values`
--

CREATE TABLE IF NOT EXISTS `artfill_list_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `list_value` varchar(200) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_list_values`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_location`
--

CREATE TABLE IF NOT EXISTS `artfill_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `location_code` varchar(255) NOT NULL,
  `iso_code2` varchar(255) NOT NULL,
  `iso_code3` varchar(255) NOT NULL,
  `country_tax` float(10,2) NOT NULL,
  `country_ship` decimal(10,2) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `currency_type` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `artfill_location`
--

INSERT INTO `artfill_location` (`id`, `location_name`, `location_code`, `iso_code2`, `iso_code3`, `country_tax`, `country_ship`, `seourl`, `currency_type`, `currency_symbol`, `status`, `dateAdded`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'IN', '', '', '', 5.00, '15.00', 'india', 'INR', 'Rs', 'InActive', '2013-07-26 04:10:15', '', '', ''),
(3, 'USA', '', 'US', 'USA', 1.00, '0.00', 'usa', 'USD', '$', 'Active', '2013-07-26 12:00:00', 0x555341, 0x555341, 0x555341),
(6, 'Uk', '', '', '', 10.00, '10.00', 'uk', 'USD', '$', 'InActive', '2013-07-29 13:00:00', '', '', ''),
(7, 'Australia', '', 'AU', '', 10.00, '20.00', 'australia', 'AUD', '$', 'InActive', '2013-08-21 11:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_member_transaction`
--

CREATE TABLE IF NOT EXISTS `artfill_member_transaction` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `payment_cycle` varchar(500) NOT NULL,
  `txn_type` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `next_payment_date` varchar(500) NOT NULL,
  `residence_country` varchar(500) NOT NULL,
  `initial_payment_amount` varchar(500) NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL,
  `verify_sign` varchar(750) NOT NULL,
  `period_type` varchar(500) NOT NULL,
  `payer_status` varchar(500) NOT NULL,
  `test_ipn` varchar(500) NOT NULL,
  `tax` varchar(500) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `receiver_email` varchar(500) NOT NULL,
  `payer_id` varchar(500) NOT NULL,
  `product_type` varchar(500) NOT NULL,
  `shipping` varchar(500) NOT NULL,
  `amount_per_cycle` varchar(500) NOT NULL,
  `profile_status` varchar(500) NOT NULL,
  `charset` varchar(500) NOT NULL,
  `notify_version` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL,
  `outstanding_balance` varchar(500) NOT NULL,
  `recurring_payment_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `ipn_track_id` varchar(500) NOT NULL,
  `tran_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_member_transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_mobile_payment`
--

CREATE TABLE IF NOT EXISTS `artfill_mobile_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL COMMENT 'type of the payment',
  `UserrandomNo` varchar(255) NOT NULL COMMENT 'dealCodeNumber',
  `shippingAddress` int(11) NOT NULL COMMENT 'Shipping address id',
  `dateAdded` datetime NOT NULL,
  `note` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_mobile_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_newsletter`
--

CREATE TABLE IF NOT EXISTS `artfill_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_descrip` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_subject` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `news_seourl` varchar(255) NOT NULL,
  `typeVal` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `artfill_newsletter`
--

INSERT INTO `artfill_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(1, 'Notification Mail', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d2270616464696e673a20343070783b223e0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0a3c74626f64793e0a3c74723e0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74642076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0a3c74626f64793e0a3c74723e0a3c746420636f6c7370616e3d2232223e0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e7b2466756c6c5f6e616d657d20636f6d6d656e746564206f6e203c6120687265663d227b2470726f644c696e6b7d223e7b2470726f647563745f6e616d657d3c2f613e2e20546f20736565207b2466756c6c5f6e616d657d5c27732070726f66696c65203c6120687265663d227b626173655f75726c28297d757365722f7b24757365725f6e616d657d223e636c69636b20686572653c2f613e2e3c2f703e0a3c2f74643e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e266e6273703b3c2f703e0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2013-10-02 00:00:00', '', 'Notification Mail', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(2, 'Withdrawal Request', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e48692041646d696e2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24757365725f6e616d657d202077616e74732061207061796d656e74206f66207b2477697468647261775f616d747d20242e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-10-29 00:00:00', '', 'Withdrawal Request', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(3, 'Registration Confirmation', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20626f726465723a2031707820736f6c696420234343434343433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d226261636b67726f756e643a20234431353531313b206865696768743a203570783b20666f6e742d73697a653a20313270783b223e266e6273703b3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22636f6c6f723a20233031393262353b20666f6e742d73697a653a20313270783b2070616464696e673a2033707820307078203070783b223e4a757374204f6e65204d6f726520537465703c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420236363633b2070616464696e673a20313570783b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d226261636b67726f756e643a20236634663466343b2070616464696e673a2031357078203770783b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313570783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e4869207b246e616d657d213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e5765204a757374204e65656420546f20446f204f6e65204d6f7265205468696e673a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2463666d75726c7d223e436f6e6669726d20596f7572204163636f756e743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e2e2e2e416e6420796f752063616e20616365737320616c6c207468696e6720696e207b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e496620596f75204e6565642068656c70207769746820616e797468696e6720696e207b24656d61696c5f7469746c657d2d616e79207468696e6720617420616c6c2d3c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e746163742074686520666f6c6b20617420746865207b24656d61696c5f7469746c657d205465616d2e3c2f613e20546865792061726520616c7761797320656167657220746f206c65616e642068616e64733c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e53656520596f75206f6e207b24656d61696c5f7469746c657d20213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b20666f6e742d66616d696c793a202754696d6573204e657720526f6d616e272c2054696d65732c2073657269663b223e546865207b24656d61696c5f7469746c657d205465616d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d226261636b67726f756e643a20236634663466343b2070616464696e673a2031357078203770783b20636f6c6f723a20233762376237623b20666f6e742d73697a653a20313370783b20746578742d616c69676e3a2063656e7465723b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-10-29 00:00:00', '', 'Registration Confirmation', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(4, 'Password Reset', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e486920746865726520213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e526573657420796f75722070617373776f726420636c69636b20612062656c6f77206c696e6b3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e3c6120687265663d227b247077646c6e6b7d223e20436c69636b204865726521203c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e696620796f7520617265206e6f74207265646972656374656420636f707920616e6420706173746520746869732055524c20746f20796f75722062726f77736572203a207b247077646c6e6b7d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e596f7572206e65772070617373776f7264203a207b247077647d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206469646e2774206368616e676520796f7572207b24656d61696c5f7469746c657d2070617373776f726420726563656e746c792c20706c656173652020202020202020202020202020202020202020202020202020202020202020203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-10-29 00:00:00', '', 'Your artfill password has been changed', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(5, 'Forgot Password', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e486920746865726520213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e526573657420796f75722070617373776f7264207573696e67207468652062656c6f77206c696e6b213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e3c6120687265663d227b247077646c6e6b7d223e20436c69636b204865726521203c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e696620796f7520617265206e6f74207265646972656374656420636f707920616e6420706173746520746869732055524c20746f20796f75722062726f77736572203a207b247077646c6e6b7d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e506c6561736520526573657420796f75722070617373776f7264206265666f7265203120686f7572732021204c696e6b2076616c696420666f72206f6e6c79206f6e652074696d653c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206469646e2774207265717565737420746f20726573657420207b24656d61696c5f7469746c657d2070617373776f726420726563656e746c792c20706c656173652020202020202020202020202020202020202020202020202020202020202020203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-10-02 00:00:00', '', 'Your artfill password has been changed ', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(6, 'send mail subcribers list', 0x3c646976207374796c653d2277696474683a2036303070783b206261636b67726f756e643a20234646464646463b206d617267696e3a2030206175746f3b20626f726465722d7261646975733a20313070783b20626f782d736861646f773a203020302035707820236363633b20626f726465723a2031707820736f6c696420234441374341463b223e0a3c646976207374796c653d226261636b67726f756e643a20236637663766373b2070616464696e673a20313070783b20626f726465722d7261646975733a20313070782031307078203020303b20746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b626173655f75726c28297d22207461726765743d225f626c616e6b223e3c696d67207374796c653d226d617267696e3a20357078203230707820307078203070783b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f5f696d6167657d2220626f726465723d22302220616c743d227b247469746c657d222077696474683d2232303522202f3e203c2f613e3c2f6469763e0a3c646976207374796c653d226261636b67726f756e643a20236666663b2070616464696e673a20313070783b2077696474683a2035383070783b223e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20323470783b20636f6c6f723a20236461376361663b2070616464696e672d626f74746f6d3a20313570783b20666f6e742d7765696768743a20626f6c643b223e7b246e6577735f7375626a6563747d3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313670783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323470783b20746578742d616c69676e3a206a7573746966793b223e7b246e6577735f646573637269707d3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313670783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323470783b20746578742d616c69676e3a206a7573746966793b223e496620796f75206861766520616e79207175657374696f6e7320706c6561736520656d61696c203c61207374796c653d22636f6c6f723a20233565613030383b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d226d61696c746f3a7b24746869732d2667743b636f6e6669672d2667743b6974656d2827656d61696c27297d223e7b24656d61696c7d3c2f613e3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313870783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323870783b223e53696e636572656c79202c203c6272202f3e204d616e6167656d656e743c2f6469763e0a3c2f6469763e0a3c2f6469763e, 'Active', '2013-10-30 00:00:00', '', 'send mail subcribers list', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(7, 'Follow User Details', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e7b2466756c6c5f6e616d657d20666f6c6c6f777320796f75206f6e207b24656d61696c5f7469746c657d2e20546f20736565207b246366756c6c5f6e616d657d5c27732070726f66696c65203c6120687265663d227b626173655f75726c28297d766965772d70726f66696c652f7b24757365725f6e616d657d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-10-29 00:00:00', '', 'Follow User Details', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(12, 'account change', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4869207b24757365724e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e54686520656d61696c206164647265737320666f7220796f7572207b24656d61696c5f7469746c657d206163636f756e74202d207b24757365724e616d657d202d20776173206368616e67656420746f64617920746f207b246e65774d61696c49447d2e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206d6164652074686973206368616e67652c207468656e206974277320616c6c20676f6f6421206a75737420666f6c6c6f772074686520696e737472756374696f6e20696e2074686520656d61696c2077652073656e7420746f20796f7572206e657720656d61696c20616464726573732e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206469646e2774206d616b652074686973206368616e67652c203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e20616e64207765276c6c206c6f6f6b20696e746f20697420666f7220796f752e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '0000-00-00 00:00:00', '', 'The email address for your artfill account has been changed', 'artfill', 'johncena.c88@gmail.com', '', ''),
(8, 'Notification Mail for Comments', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d2270616464696e673a20343070783b223e0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0a3c74626f64793e0a3c74723e0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74642076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0a3c74626f64793e0a3c74723e0a3c746420636f6c7370616e3d2232223e0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e7b2466756c6c5f6e616d657d20636f6d6d656e746564206f6e203c6120687265663d227b2470726f644c696e6b7d223e7b2470726f647563745f6e616d657d3c2f613e2e20546f20736565207b246366756c6c5f6e616d657d5c27732070726f66696c65203c6120687265663d227b626173655f75726c28297d757365722f7b24757365725f6e616d657d223e636c69636b20686572653c2f613e2e3c2f703e0a3c2f74643e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e266e6273703b3c2f703e0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2013-10-29 00:00:00', '', 'Notification Mail for Comments', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(9, 'Follows User Notification Mail', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e7b2466756c6c5f6e616d657d20666f6c6c6f777320796f75206f6e207b24656d61696c5f7469746c657d2e20546f20736565207b246366756c6c5f6e616d657d5c27732070726f66696c65203c6120687265663d227b626173655f75726c28297d766965772d70656f706c652f7b24757365725f6e616d657d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2013-07-25 00:00:00', '', 'Follows User Notification Mail', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(22, 'Dispute Mail', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e0d0a3c703e486920213c2f703e0d0a3c703e7b24646973707574657d3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4469737075746520636f6d6d656e747320686173206265656e20636c6f73656420627920746865207b24706f737465645f62797d207b2473656e6465725f6e616d657d20666f7220746865206f72646572206964203a207b246f7264657269647d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b2473656e6465725f6e616d657d2077726f74653a20227b24706f73745f6d6573736167657d223c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2464697363757373696f6e75726c7d223e5365652044697363757373696f6e733c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-10-27 00:00:00', '', 'Dispute Mail', 'artfill', 'sivaprakash@teamtweaks.com', '', '1'),
(10, 'google invite friends', '', 'Active', '2013-10-02 00:00:00', '', 'invite you', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(11, 'Contact Seller', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d2270616464696e673a20343070783b223e0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0a3c74626f64793e0a3c74723e0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74642076616c69676e3d22746f70223e0a3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0a3c74626f64793e0a3c74723e0a3c746420636f6c7370616e3d2232223e0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e436f6e746163742053656c6c65723c2f68333e0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0a3c703e3c7374726f6e673e436f6e74616374204e616d65203a3c2f7374726f6e673e207b246e616d657d3c2f703e0a3c703e3c7374726f6e673e436f6e7461637420456d61696c203a3c2f7374726f6e673e207b24656d61696c7d3c2f703e0a3c703e3c7374726f6e673e436f6e746163742050686f6e65203a3c2f7374726f6e673e207b2470686f6e657d3c2f703e0a3c703e3c7374726f6e673e436f6e74616374205175657374696f6e203a3c2f7374726f6e673e207b247175657374696f6e7d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0a3c74626f64793e0a3c74723e0a3c74643e50726f64756374204e616d653c2f74643e0a3c74643e50726f6475637420496d6167653c2f74643e0a3c2f74723e0a3c74723e0a3c74643e3c6120687265663d227b626173655f75726c28297d7468696e67732f7b2470726f6475637449647d2f7b2470726f6475637453656f75726c7d223e7b2470726f647563744e616d657d3c2f613e3c2f74643e0a3c74643e3c696d67207372633d22696d616765732f70726f647563742f7b2470726f64756374496d6167657d2220616c743d227b2470726f647563744e616d657d222077696474683d2231303022202f3e3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0a3c703e266e6273703b3c2f703e0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2013-07-26 00:00:00', '', 'User Contact seller', 'artfill', 'sivaprakash@teamtweaks.com', '', '2'),
(16, 'Newsletter Subscription', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c2f74626f64793e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c6272202f3e3c6272202f3e3c2f703e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e436f6e6669726d20796f757220656d61696c206164647265737320666f72206e6577736c657474657220737562736372697074696f6e2e3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e3c6120687265663d227b2463666d75726c7d22207461726765743d225f626c616e6b223e436c69636b206865726520746f20636f6e6669726d20796f757220656d61696c206164647265737320696e207b24656d61696c5f7469746c657d2e3c2f613e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c703e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-04-22 00:00:00', '', 'Newsletter Subscription', 'artfill', 'johncena.c88@gmail.com', '', '1'),
(15, 'Contact Shop Owner', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e7b2475736572726e616d657d20436f6e7461637420666f7220796f753c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e50726f64756374204e616d653a207b2470726f647563744e616d657d3c2f703e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e4d6573736167653a207b246465736372697074696f6e7d3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-04-22 00:00:00', '', 'Contact Shop Owner', 'artfill', 'johncena.c88@gmail.com', '', '1'),
(17, 'Contact Shop Owner', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e436f6e746163742053686f70204f776e65723c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0d0a3c703e3c7374726f6e673e436f6e7461637420456d61696c203a3c2f7374726f6e673e207b24656d61696c7d3c2f703e0d0a7b246465616c636f64655f6e756d6265727d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74643e7b24436c69636b44657461696c737d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e4d6573736167653c2f74643e0d0a3c74643e7b246465736372697074696f6e7d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-04-25 00:00:00', '', 'User Contact Shop', 'artfill', 'johncena.c88@gmail.com', '', '1');
INSERT INTO `artfill_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(14, 'Reopen account', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4869207468657265207b24757365724e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e576520726563656976656420796f7572207265717565737420746f2072656f70656e20796f7572206163636f756e742c20486572652773207768617420796f75206e65656420746f20646f3a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e312e20436c69636b2074686520627574746f6e2062656c6f7720746f20636f6e6669726d20796f7572206964656e746974792e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2463666d75726c7d223e52656f70656e20596f7572204163636f756e743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f7520646964206e6f74207265717565737420746f206861766520796f7572207b24656d61696c5f7469746c657d2072656f70656e206163636f756e7420726563656e746c792c20706c656173652020202020202020202020202020202020202020202020202020202020202020203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '0000-00-00 00:00:00', '', 'Reopen account', 'artfill', 'johncena.c88@gmail.com', '', ''),
(13, 'Confirm Account', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e44656172207b24757365724e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5765206e65656420746f20636f6e6669726d20796f7572207265717565737420746f206368616e67652074686520656d61696c2061646472657373206173736f636961746564207769746820796f7572207b24656d61696c5f7469746c657d206163636f756e742e2e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e436c69636b2074686520627574746f6e2062656c6f7720746f20636f6e6669726d20796f7572206e657720656d61696c20616464726573732e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2463666d75726c7d223e436f6e6669726d20596f7572204163636f756e743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468697320656d61696c20616464726573732077696c6c206e6f74206265206c696e6b656420746f20796f7572207b24656d61696c5f7469746c657d206163636f756e7420756e74696c20697420697320636f6e6669726d65642e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f7520646964206e6f74207265717565737420746f206861766520796f757220656d61696c2061646472657373206368616e6765642c20706c65617365203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e20616e64207765276c6c206c6f6f6b20696e746f20697420666f7220796f752e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '0000-00-00 00:00:00', '', 'Confirm Your Updated Email', 'artfill', 'johncena.c88@gmail.com', '', ''),
(23, 'Dispute Mail From Admin', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e486920213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e596f75206861766520636c6f73656420796f7572206469737075746520636f6d6d656e747320666f722074686520666f6c6c6f77696e67206f72646572206964203a207b246f7264657269647d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e596f752077726f74653a20227b24706f73745f6d6573736167657d223c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2464697363757373696f6e75726c7d223e5365652044697363757373696f6e733c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-10-27 00:00:00', '', 'Dispute Mail', 'artfill', 'sivaprakash@teamtweaks.com', '', '1'),
(24, 'Reopen user account by admin', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4869207468657265207b24757365724e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e576520726563656976656420796f7572207265717565737420746f2072656f70656e20796f7572206163636f756e742c20486572652773207768617420796f75206e65656420746f20646f3a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e596f7572207b24656d61696c5f7469746c657d206163636f756e7420686173206265656e2072656f70656e65642e20416e642077652068617665206368616e67656420796f75722070617373776f726420666f7220736563757269747920707572706f736520706c6561736520757365206e65772070617373776f72642e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e596f7572204e65772050617373776f7264203c7374726f6e673e7b247077647d203c2f7374726f6e673e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f7520646964206e6f74207265717565737420746f206861766520796f7572207b24656d61696c5f7469746c657d2072656f70656e206163636f756e7420726563656e746c792c20706c656173652020202020202020202020202020202020202020202020202020202020202020203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2014-12-23 00:00:00', '', 'You artfill account has been reopened', 'artfill', 'johncena.c88@gmail.com', '', '1'),
(25, 'New Shop Registered', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e446561722041646d696e2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4e65772073686f7020776173207265676973746572656420616e642077616974696e6720666f7220796f757220617070726f76616c2e20436c69636b2074686520627574746f6e2062656c6f7720746f2076696577207468652064657461696c732e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2463666d75726c7d223e266e6273703b566965772044657461696c733c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-06-04 00:00:00', '', 'New Shop Registered', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(26, 'Comments ', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e5369746520436f6d6d656e74733c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0d0a3c703e3c7374726f6e673e436f6e74616374204e616d65203a3c2f7374726f6e673e207b246e616d657d3c2f703e0d0a3c703e3c7374726f6e673e436f6e7461637420456d61696c203a3c2f7374726f6e673e207b24656d61696c7d3c2f703e0d0a3c703e3c7374726f6e673e5375626a6563743a3c2f7374726f6e673e207b247375626a6563747d3c2f703e0d0a3c703e3c7374726f6e673e436f6d6d656e743a3c2f7374726f6e673e207b247175657374696f6e7d3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-06-04 00:00:00', '', 'User Comments', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(27, 'Request For Cancel Bid', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4869207b246d61696c4e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b2475736572726e616d657d2077616e747320746f2072656d6f7665206869732f68657220626964206f6e20796f75722061756374696f6e2e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e557365722049643a207b246d7573657249447d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e436c69636b2062656c6f7720266e6273703b6c696e6b20746f20736565207468652061756374696f6e20696e666f726d6174696f6e732c3c6272202f3e3c6120687265663d227b246d61696c4c696e6b7d223e7b246d61696c4c696e6b7d3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-07-16 00:00:00', '', 'Request For Cancel Bid', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(29, 'Favorite Product Notification Mail', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e7b24757365725f6e616d657d206661766f726974657320796f75722070726f64756374206f6e207b24656d61696c5f7469746c657d2e20546f20736565207468652050726f647563742064657461696c203c6120687265663d227b626173655f75726c28297d70726f64756374732f7b2470726f647563745f73656f7d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-07-20 00:00:00', '', 'Favorite Product Notification Mail', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(30, 'Favorite of Favorite Product Notification Mail', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e7b24757365725f6e616d657d206661766f7269746573207468652070726f6475637420576869636820796f75204661766f726974652e20546f20736565207468652050726f647563742064657461696c203c6120687265663d227b626173655f75726c28297d70726f64756374732f7b2470726f647563745f73656f7d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-07-20 00:00:00', '', 'Favorite of Favorite Product Notification Mail', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(31, 'Favorite Shop Notification Mail', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4869207b2466756c6c5f6e616d657d2c3c2f68333e0d0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e7b246366756c6c5f6e616d657d206661766f7269746520796f75722073686f70206f6e207b24656d61696c5f7469746c657d2e20546f20736565207b246366756c6c5f6e616d657d5c27732070726f66696c65203c6120687265663d227b626173655f75726c28297d766965772d70726f66696c652f7b24757365725f6e616d657d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-07-21 00:00:00', '', 'Favorite Shop Notification Mail', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(32, 'New Products Arrival ', 0x3c703e323031352d30372d32313c2f703e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20343070783b223e0d0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c74642076616c69676e3d22746f70223e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0d0a3c74626f64793e0d0a3c74723e0d0a3c746420636f6c7370616e3d2232223e0d0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e4e657720417272616976616c2046726f6d20596f7572204661766f75726974652053686f70207b2473686f705f4e616d657d3c2f68333e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e546f20736565207468652050726f647563742044657461696c7320203c6120687265663d227b626173655f75726c28297d70726f64756374732f7b2470726f5f73656f7d223e636c69636b20686572653c2f613e2e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-07-21 00:00:00', '', 'New Products Arrival ', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(33, 'New Shop Activated', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e44656172207b2473656c6c65727d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e596f752073686f7020686173206265656e206163746976617465642e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2463666d75726c7d223e266e6273703b566965772044657461696c733c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-08-07 00:00:00', '', 'New Shop Activated', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(34, 'Cancel Order', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e486920213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b2462757965727d206861732072657175657374656420746f2063616e63656c20746865206f7264657220287b246f7264657269647d292066726f6d207468652053656c6c6572207b2473656c6c6572207d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e526561736f6e3a207b24726561736f6e7d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4d657373616765207b24706f73745f6d6573736167657d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-08-19 00:00:00', '', 'Cancel Order', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(35, 'Order status Changed', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e486920213c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e0d0a3c703e596f7572206f726465722773266e6273703b3c7370616e3e287b246f7264657269647d2920266e6273703b3c2f7370616e3e73746174757320686173206265656e206368616e67656420746f207b246f726465727374617475737d3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-08-19 00:00:00', '', 'Order status Changed', 'artfill V2', 'vinu@teamtweaks.com', '', '1');
INSERT INTO `artfill_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(36, 'Post Dispute', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e0d0a3c703e486920213c2f703e0d0a3c703e7b24646973707574657d3c2f703e0d0a3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e41206e657720706f737420686173206265656e20616464646564206279203c7370616e3e7b24706f737465645f62797d207b2473656e6465725f6e616d657d266e6273703b3c2f7370616e3e746f20746865206f72646572206964203a207b246f7264657269647d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b2473656e6465725f6e616d657d2077726f74653a20227b24706f73745f6d6573736167657d223c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d22746578742d616c69676e3a2063656e7465723b2070616464696e673a203230707820303b223e3c61207374796c653d226261636b67726f756e643a20233334613863343b20626f726465722d626f74746f6d3a2033707820736f6c696420233034373839343b20626f726465722d7261646975733a203370783b2070616464696e673a2035707820313070783b20636f6c6f723a20236666663b20666f6e742d7765696768743a20626f6c643b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b2464697363757373696f6e75726c7d223e5365652044697363757373696f6e733c2f613e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-08-20 00:00:00', '', 'Post Dispute', 'artfill V2', 'vinu@teamtweaks.com', '', '1'),
(37, 'notification abandoned cart', 0x3c7461626c65207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236565653b20626f726465723a2031707820736f6c696420234443444344433b20626f782d736861646f773a2030203020317078203020234343434343433b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223130222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c74643e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20357078203770783b20666f6e742d7765696768743a20626f6c643b20636f6c6f723a20236431353531313b20666f6e742d73697a653a20313770783b223e3c6120687265663d227b626173655f75726c28297d223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c65207374796c653d226d617267696e2d746f703a20313070783b20626f726465723a2031707820736f6c696420234443444344433b2070616464696e673a20313570783b206261636b67726f756e643a20236666663b20626f726465722d7261646975733a203370783b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e4869207b24757365724e616d657d2c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a20367078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e3c6272202f3e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206d6164652074686973206368616e67652c207468656e206974277320616c6c20676f6f6421206a75737420666f6c6c6f772074686520696e737472756374696f6e20696e2074686520656d61696c2077652073656e7420746f20796f7572206e657720656d61696c20616464726573732e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e496620796f75206469646e2774206d616b652074686973206368616e67652c203c6120687265663d227b626173655f75726c28297d70616765732f636f6e746163742d7573223e436f6e7461637420537570706f72743c2f613e20616e64207765276c6c206c6f6f6b20696e746f20697420666f7220796f752e3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031307078203020347078203070783b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e5468616e6b732c3c2f74643e0d0a3c2f74723e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2030707820307078203135707820303b20636f6c6f723a20233561356135613b20666f6e742d73697a653a20313570783b223e7b24656d61696c5f7469746c657d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223635302220616c69676e3d2263656e746572223e0d0a3c74626f64793e0d0a3c74723e0d0a3c7464207374796c653d2270616464696e673a2031357078203770783b20636f6c6f723a20233862386238623b20666f6e742d73697a653a20313370783b223e7b24666f6f7465725f636f6e74656e747d3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Active', '2015-09-30 00:00:00', '', 'notification abandoned cart', 'artfill V2', 'vinu@teamtweaks.com', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_notifications`
--

CREATE TABLE IF NOT EXISTS `artfill_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activity` mediumtext COLLATE utf8_bin NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `activity_ip` mediumtext COLLATE utf8_bin NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  `view_mode` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_order_comments`
--

CREATE TABLE IF NOT EXISTS `artfill_order_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `posted_id` int(11) NOT NULL,
  `claim_id` int(10) NOT NULL,
  `post_message` blob NOT NULL,
  `image` longtext NOT NULL,
  `post_time` datetime NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_order_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_payment`
--

CREATE TABLE IF NOT EXISTS `artfill_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` varchar(200) NOT NULL,
  `discountAmount` varchar(255) NOT NULL,
  `couponCode` varchar(255) NOT NULL,
  `coupontype` varchar(255) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `indtotal` varchar(255) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(255) NOT NULL,
  `shippingcountry` varchar(255) NOT NULL,
  `shippingcity` varchar(255) NOT NULL,
  `shippingstate` varchar(255) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(255) NOT NULL,
  `dealCodeNumber` varchar(255) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` text NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(255) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_payment_gateway`
--

CREATE TABLE IF NOT EXISTS `artfill_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(200) NOT NULL,
  `settings` longtext NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `artfill_payment_gateway`
--

INSERT INTO `artfill_payment_gateway` (`id`, `gateway_name`, `settings`, `status`) VALUES
(1, 'Paypal IPN', 'a:3:{s:4:"mode";s:7:"sandbox";s:14:"merchant_email";s:26:"sivaprakash@teamtweaks.com";s:14:"paypal_ipn_url";s:58:"http://192.168.1.253/sivaprakash/etsy/site/order/ipnpaymet";}', 'Enable'),
(2, 'Credit Card (Authorize.net)', 'a:3:{s:4:"mode";s:7:"sandbox";s:8:"Login_ID";s:12:"398jkPxpkLTx";s:15:"Transaction_Key";s:16:"3fuF63tK2Pe3u3nN";}', 'Enable'),
(3, 'Paypal Adaptive', 'a:6:{s:4:"mode";s:7:"sandbox";s:14:"merchant_email";s:35:"vinubusiness1-facilitator@gmail.com";s:27:"merchant_email_for_adaptive";s:40:"vinubusiness1-facilitator_api1.gmail.com";s:8:"password";s:10:"1380197781";s:9:"signature";s:56:"AQU0e5vuZCvSg-XJploSa.sGUDlpAERCJ01cF3SVakQxc3HQqQXQ.e4d";s:5:"appid";s:21:"APP-80W284485P519543T";}', 'Enable'),
(4, 'Stripe', 'a:3:{s:4:"mode";s:7:"sandbox";s:10:"secret_key";s:32:"sk_test_0tTTuvYsRdKGPkZ0McunhY4P";s:15:"publishable_key";s:32:"pk_test_PT3XNxa5eYTVkfGBqmslDEMX";}', 'Enable'),
(5, '2Checkout Payment', 'a:4:{s:4:"mode";s:7:"sandbox";s:14:"publishableKey";s:36:"61DE1ED5-0B9A-4C6E-982F-D865D4ABA72F";s:8:"sellerId";s:9:"901269651";s:10:"privateKey";s:36:"80E33A77-6FC6-470C-BDFB-071D8F668A90";}', 'Enable'),
(8, 'Wire transfer', '', 'Enable'),
(9, 'Western union', '', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_payment_proof`
--

CREATE TABLE IF NOT EXISTS `artfill_payment_proof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) NOT NULL,
  `seller_name` varchar(200) NOT NULL,
  `seller_email` varchar(200) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `buyer_name` varchar(200) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `dealcodenumber` varchar(255) NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `proof` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_payment_proof`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_product`
--

CREATE TABLE IF NOT EXISTS `artfill_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `shippingType_id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `materials` text NOT NULL,
  `price` decimal(13,5) NOT NULL,
  `currency_value` decimal(10,3) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `price_type` enum('Fixed','Auction') NOT NULL,
  `current_auction` int(11) NOT NULL,
  `auction_level` enum('ongoing','completed','') NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `deal_date` date DEFAULT NULL,
  `deal_date_to` date DEFAULT NULL,
  `deal_time_from` time DEFAULT NULL,
  `deal_time_to` time DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `image` longtext NOT NULL,
  `product_featured` enum('No','Yes') NOT NULL DEFAULT 'No',
  `product_promoted` enum('Promote','Unpromote') NOT NULL DEFAULT 'Unpromote',
  `description` blob NOT NULL,
  `shipping` blob NOT NULL,
  `weight` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL DEFAULT '1',
  `purchasedCount` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `status` enum('Publish','UnPublish','Deleted') NOT NULL DEFAULT 'Publish',
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `pay_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `shipping_type` enum('Shippable','Not Shippable') NOT NULL,
  `shipping_cost` decimal(6,2) NOT NULL,
  `taxable_type` enum('Taxable','Not Taxable') NOT NULL,
  `tax_cost` decimal(6,2) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `option` longtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `gift_card` enum('false','true') NOT NULL,
  `made_by` varchar(100) NOT NULL,
  `product_condition` varchar(100) NOT NULL,
  `maked_on` varchar(100) NOT NULL,
  `ship_duration` varchar(150) NOT NULL,
  `ship_from` varchar(100) DEFAULT NULL,
  `ship_details` varchar(255) NOT NULL COMMENT 'ship from:shiping price:ship with another',
  `txn_id` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_date` varchar(255) NOT NULL,
  `pay_amount` decimal(10,2) NOT NULL,
  `feature_expire` date NOT NULL,
  `product_type` enum('digital','physical') NOT NULL,
  `pickup_option` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_product`
--


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `artfill_product_attribute`
--

CREATE TABLE IF NOT EXISTS `artfill_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) NOT NULL,
  `attr_seourl` varchar(255) NOT NULL,
  `attr_options` varchar(255) NOT NULL,
  `scaling_option` varchar(255) NOT NULL,
  `follow_count` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `artfill_product_attribute`
--

INSERT INTO `artfill_product_attribute` (`id`, `attr_name`, `attr_seourl`, `attr_options`, `scaling_option`, `follow_count`, `status`, `dateAdded`) VALUES
(1, 'color', 'color', 'red,blue,yellow,green,black,brown,gray,pink,orange,purple,white,violet', 'No', 0, 'Active', '2015-08-07 20:01:38'),
(7, 'size', 'size', 'alpha,inches,centimeters,ml', 'Yes', 0, 'Active', '2014-03-13 16:57:44'),
(8, 'flavor', 'flavor', '', 'No', 0, 'Inactive', '2015-08-07 19:56:21'),
(9, 'weight', 'weight', 'pounds,ounces,grams,kilograms', 'Yes', 0, 'Active', '2014-03-13 16:40:28'),
(10, 'length', 'length', 'inches,centimeters', 'Yes', 0, 'Active', '2014-03-13 16:40:13'),
(11, 'height', 'height', 'inches,centimeters', 'Yes', 0, 'Inactive', '2015-08-07 20:01:20'),
(12, 'Stone', 'stone', '', 'No', 0, 'Active', '2015-09-21 18:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_product_category`
--

CREATE TABLE IF NOT EXISTS `artfill_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_product_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_product_comments`
--

CREATE TABLE IF NOT EXISTS `artfill_product_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comments` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_product_comments`
--


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `artfill_product_feedback`
--

CREATE TABLE IF NOT EXISTS `artfill_product_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `seller_product_id` int(11) NOT NULL,
  `deal_code` int(11) NOT NULL,
  `description` longblob NOT NULL,
  `rating` decimal(11,2) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'InActive',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_product_feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_product_likes`
--

CREATE TABLE IF NOT EXISTS `artfill_product_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_product_likes`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_registry`
--

CREATE TABLE IF NOT EXISTS `artfill_registry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wedding_date` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_registry`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_registry_listings`
--

CREATE TABLE IF NOT EXISTS `artfill_registry_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL COMMENT 'user_id from artfill_registry',
  `listing_id` int(11) NOT NULL COMMENT 'id from artfill_product',
  `note` varchar(255) NOT NULL,
  `Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_registry_listings`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_registry_requests`
--

CREATE TABLE IF NOT EXISTS `artfill_registry_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL COMMENT 'user_id from artfill_registry',
  `listing_id` int(11) NOT NULL COMMENT 'id from artfill_product',
  `requested` int(3) NOT NULL DEFAULT '1',
  `purchased` int(3) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_registry_requests`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_report_review`
--

CREATE TABLE IF NOT EXISTS `artfill_report_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` int(11) NOT NULL,
  `reporter_email` varchar(250) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `reviewer_email` varchar(250) NOT NULL,
  `review_id` int(11) NOT NULL,
  `description` blob NOT NULL,
  `report_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_report_review`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_review_comments`
--

CREATE TABLE IF NOT EXISTS `artfill_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deal_code` mediumtext NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `commentor_id` bigint(20) NOT NULL,
  `comment` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_from` enum('user','seller','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_review_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_cn_social_icon`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_cn_social_icon` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sortorder` int(11) NOT NULL DEFAULT '0',
  `date_upload` varchar(100) DEFAULT NULL,
  `target` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_cn_social_icon`
--

INSERT INTO `artfill_sb_cn_social_icon` (`id`, `title`, `url`, `image_url`, `sortorder`, `date_upload`, `target`) VALUES
(2, '', 'https://www.pinterest.com/', '1399288804_pinbtest.png', 0, '1399288804', 1),
(3, '', 'http://www.facebook.com/', '1399288830_fb.png', 0, '1399288830', 1),
(4, '', 'https://twitter.com', '1399288862_twiter.png', 0, '1399288862', 1),
(5, '', 'http://instagram.com/', '1399288886_inst.png', 0, '1399288886', 1),
(6, '', 'http://tumblr.com/', '1399288913_tumblipon.png', 0, '1399288913', 1),
(7, '', 'google.com', '1399288964_google.png', 0, '1399288964', 1),
(8, '', 'http://www.youtube.com', '1399288992_new.png', 0, '1399288992', 1);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_commentmeta`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_commentmeta`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_comments`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_layerslider`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_layerslider` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` mediumtext NOT NULL,
  `date_c` int(10) NOT NULL,
  `date_m` int(11) NOT NULL,
  `flag_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `flag_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_layerslider`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_links`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_options`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_options`
--

INSERT INTO `artfill_sb_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(132, '<unique_prefix>_layerslider_activated', '1', 'yes'),
(35, 'active_plugins', 'a:0:{}', 'yes'),
(5, 'admin_email', 'gary@teamtweaks.com', 'yes'),
(39, 'advanced_edit', '0', 'yes'),
(1039, 'agca_admin_bar_comments', '', 'yes'),
(1048, 'agca_admin_bar_frontend', '', 'yes'),
(1049, 'agca_admin_bar_frontend_hide', '', 'yes'),
(1040, 'agca_admin_bar_new_content', '', 'yes'),
(1042, 'agca_admin_bar_new_content_link', '', 'yes'),
(1045, 'agca_admin_bar_new_content_media', '', 'yes'),
(1043, 'agca_admin_bar_new_content_page', '', 'yes'),
(1041, 'agca_admin_bar_new_content_post', '', 'yes'),
(1044, 'agca_admin_bar_new_content_user', '', 'yes'),
(1046, 'agca_admin_bar_update_notifications', '', 'yes'),
(1053, 'agca_admin_capability', 'edit_dashboard', 'yes'),
(1056, 'agca_admin_menu_agca_button_only', '', 'yes'),
(1061, 'agca_admin_menu_arrow', '', 'yes'),
(1066, 'agca_admin_menu_autofold', '', 'yes'),
(1064, 'agca_admin_menu_brand', '', 'yes'),
(1065, 'agca_admin_menu_brand_link', '', 'yes'),
(1060, 'agca_admin_menu_collapse_button', '', 'yes'),
(1059, 'agca_admin_menu_icons', '', 'yes'),
(1057, 'agca_admin_menu_separator_first', '', 'yes'),
(1058, 'agca_admin_menu_separator_second', '', 'yes'),
(1062, 'agca_admin_menu_submenu_round', '', 'yes'),
(1063, 'agca_admin_menu_submenu_round_size', '', 'yes'),
(1055, 'agca_admin_menu_turnonoff', 'on', 'yes'),
(1070, 'agca_colorizer_turnonoff', 'off', 'yes'),
(1072, 'agca_custom_css', '', 'yes'),
(1071, 'agca_custom_js', '', 'yes'),
(1014, 'agca_custom_site_heading', '', 'yes'),
(1002, 'agca_custom_title', '', 'yes'),
(1027, 'agca_dashboard_icon', '', 'yes'),
(1028, 'agca_dashboard_text', '', 'yes'),
(1029, 'agca_dashboard_text_paragraph', '', 'yes'),
(1031, 'agca_dashboard_widget_activity', '', 'yes'),
(1032, 'agca_dashboard_widget_il', '', 'yes'),
(1033, 'agca_dashboard_widget_plugins', '', 'yes'),
(1037, 'agca_dashboard_widget_primary', '', 'yes'),
(1034, 'agca_dashboard_widget_qp', '', 'yes'),
(1036, 'agca_dashboard_widget_rd', '', 'yes'),
(1035, 'agca_dashboard_widget_rn', '', 'yes'),
(1038, 'agca_dashboard_widget_secondary', '', 'yes'),
(1030, 'agca_dashboard_widget_welcome', '', 'yes'),
(1054, 'agca_disablewarning', '', 'yes'),
(1006, 'agca_footer', '', 'yes'),
(1016, 'agca_footer_left', '', 'yes'),
(1017, 'agca_footer_left_hide', '', 'yes'),
(1018, 'agca_footer_right', '', 'yes'),
(1019, 'agca_footer_right_hide', '', 'yes'),
(1004, 'agca_header', '', 'yes'),
(1008, 'agca_header_logo', '', 'yes'),
(1009, 'agca_header_logo_custom', '', 'yes'),
(1005, 'agca_header_show_logout', '', 'yes'),
(997, 'agca_help_menu', '', 'yes'),
(1003, 'agca_howdy', '', 'yes'),
(1020, 'agca_login_banner', '', 'yes'),
(1021, 'agca_login_banner_text', '', 'yes'),
(1052, 'agca_login_lostpassword_remove', '', 'yes'),
(1024, 'agca_login_photo_href', '', 'yes'),
(1022, 'agca_login_photo_remove', '', 'yes'),
(1023, 'agca_login_photo_url', '', 'yes'),
(1051, 'agca_login_register_href', '', 'yes'),
(1050, 'agca_login_register_remove', '', 'yes'),
(1025, 'agca_login_round_box', '', 'yes'),
(1026, 'agca_login_round_box_size', '', 'yes'),
(998, 'agca_logout', '', 'yes'),
(1000, 'agca_logout_only', '', 'yes'),
(1001, 'agca_options_menu', '', 'yes'),
(1007, 'agca_privacy_options', '', 'yes'),
(1011, 'agca_remove_site_link', '', 'yes'),
(1047, 'agca_remove_top_bar_dropdowns', '', 'yes'),
(999, 'agca_remove_your_profile', 'true', 'yes'),
(995, 'agca_role_allbutadmin', '', 'yes'),
(996, 'agca_screen_options_menu', '', 'yes'),
(1013, 'agca_site_heading', '', 'yes'),
(1015, 'agca_update_bar', '', 'yes'),
(1010, 'agca_wp_logo_custom', '', 'yes'),
(1012, 'agca_wp_logo_custom_link', '', 'yes'),
(1068, 'ag_add_adminmenu_json', '', 'yes'),
(1069, 'ag_colorizer_json', '{"color_background" : "", "login_color_background" : "", "color_header" : "", "color_admin_menu_top_button_background" : "", "color_admin_menu_font" : "", "color_admin_menu_top_button_current_background" : "", "color_admin_menu_top_button_hover_background" : "", "color_admin_menu_submenu_border_top" : "", "color_admin_menu_submenu_border_bottom" : "", "color_admin_menu_submenu_background" : "", "color_admin_menu_submenu_background_hover" : "", "color_admin_submenu_font" : "", "color_admin_menu_behind_background" : "", "color_admin_menu_behind_border" : "", "color_font_content" : "", "color_font_header" : "", "color_font_footer" : "", "color_widget_bar" : "", "color_widget_background" : ""}', 'yes'),
(1067, 'ag_edit_adminmenu_json', '{"<-TOP->menu-dashboard" : "undefined", "Home" : "undefined", "Updates" : "undefined", "<-TOP->menu-posts" : "undefined", "All Posts" : "undefined", "Add New" : "undefined", "Categories" : "undefined", "Tags" : "undefined", "<-TOP->menu-posts-testimonial" : "undefined", "Testimonial" : "undefined", "Add New" : "undefined", "Testimonial Category" : "undefined", "Testimonial Categories" : "undefined", "<-TOP->menu-posts-portfolio" : "undefined", "Portfolio" : "undefined", "Add New" : "undefined", "Portfolio Categories" : "undefined", "Portfolio Tag" : "undefined", "<-TOP->menu-posts-price_table" : "undefined", "Price Table" : "undefined", "Add New" : "undefined", "Price Categories" : "undefined", "<-TOP->menu-posts-package" : "undefined", "Package" : "undefined", "Add New Package" : "undefined", "Package Categories" : "undefined", "Package Tag" : "undefined", "<-TOP->menu-media" : "undefined", "Library" : "undefined", "Add New" : "undefined", "<-TOP->menu-posts-gdl-gallery" : "undefined", "Gallery" : "undefined", "Add New" : "undefined", "<-TOP->menu-posts-personnal" : "undefined", "Personnel" : "undefined", "Add New" : "undefined", "Personnel Categories" : "undefined", "<-TOP->menu-pages" : "undefined", "All Pages" : "undefined", "Add New" : "undefined", "<-TOP->menu-comments" : "undefined", "<-TOP->toplevel_page_wpcf7" : "undefined", "Contact Forms" : "undefined", "Add New" : "undefined", "<-TOP->menu-appearance" : "undefined", "Themes" : "undefined", "Customize" : "undefined", "Widgets" : "undefined", "Menus" : "undefined", "Install Plugins" : "undefined", "Editor" : "undefined", "<-TOP->menu-plugins" : "undefined", "Installed Plugins" : "undefined", "Add New" : "undefined", "Editor" : "undefined", "<-TOP->menu-users" : "undefined", "All Users" : "undefined", "Add New" : "undefined", "Your Profile" : "checked", "<-TOP->menu-tools" : "undefined", "Available Tools" : "undefined", "Import" : "undefined", "Export" : "undefined", "AG Custom Admin" : "undefined", "<-TOP->menu-settings" : "undefined", "General" : "undefined", "Writing" : "undefined", "Reading" : "undefined", "Discussion" : "undefined", "Media" : "undefined", "Permalinks" : "undefined", "<-TOP->toplevel_page_cnss_social_icon_page" : "undefined", "Manage Icons" : "undefined", "Add Icons" : "undefined", "Sort Icons" : "undefined", "Options" : "undefined", "<-TOP->toplevel_page_goodlayers_admin_panel" : "undefined", "<-TOP->toplevel_page_layerslider" : "undefined", "All Sliders" : "undefined", "Add New" : "undefined", "Skin Editor" : "undefined", "Transition Builder" : "undefined", "Custom Styles Editor" : "undefined", "<-TOP->toplevel_page_easy-testimonials-include-easy_testimonial_options" : "undefined"}|{"<-TOP->menu-dashboard" : "Dashboard", "Home" : "Home", "Updates" : "Updates ", "<-TOP->menu-posts" : "Posts", "All Posts" : "All Posts", "Add New" : "Add New", "Categories" : "Categories", "Tags" : "Tags", "<-TOP->menu-posts-testimonial" : "Testimonial", "Testimonial" : "Testimonial", "Add New" : "Add New", "Testimonial Category" : "Testimonial Category", "Testimonial Categories" : "Testimonial Categories", "<-TOP->menu-posts-portfolio" : "Portfolio", "Portfolio" : "Portfolio", "Add New" : "Add New", "Portfolio Categories" : "Portfolio Categories", "Portfolio Tag" : "Portfolio Tag", "<-TOP->menu-posts-price_table" : "Price Table", "Price Table" : "Price Table", "Add New" : "Add New", "Price Categories" : "Price Categories", "<-TOP->menu-posts-package" : "Package", "Package" : "Package", "Add New Package" : "Add New Package", "Package Categories" : "Package Categories", "Package Tag" : "Package Tag", "<-TOP->menu-media" : "Media", "Library" : "Library", "Add New" : "Add New", "<-TOP->menu-posts-gdl-gallery" : "Gallery", "Gallery" : "Gallery", "Add New" : "Add New", "<-TOP->menu-posts-personnal" : "Personnel", "Personnel" : "Personnel", "Add New" : "Add New", "Personnel Categories" : "Personnel Categories", "<-TOP->menu-pages" : "Pages", "All Pages" : "All Pages", "Add New" : "Add New", "<-TOP->menu-comments" : "Comments ", "<-TOP->toplevel_page_wpcf7" : "Contact", "Contact Forms" : "Contact Forms", "Add New" : "Add New", "<-TOP->menu-appearance" : "Appearance", "Themes" : "Themes", "Customize" : "Customize", "Widgets" : "Widgets", "Menus" : "Menus", "Install Plugins" : "Install Plugins", "Editor" : "Editor", "<-TOP->menu-plugins" : "Plugins ", "Installed Plugins" : "Installed Plugins", "Add New" : "Add New", "Editor" : "Editor", "<-TOP->menu-users" : "Users", "All Users" : "All Users", "Add New" : "Add New", "Your Profile" : "Your Profile", "<-TOP->menu-tools" : "Tools", "Available Tools" : "Available Tools", "Import" : "Import", "Export" : "Export", "AG Custom Admin" : "AG Custom Admin", "<-TOP->menu-settings" : "Settings", "General" : "General", "Writing" : "Writing", "Reading" : "Reading", "Discussion" : "Discussion", "Media" : "Media", "Permalinks" : "Permalinks", "<-TOP->toplevel_page_cnss_social_icon_page" : "Easy Social Icon", "Manage Icons" : "Manage Icons", "Add Icons" : "Add Icons", "Sort Icons" : "Sort Icons", "Options" : "Options", "<-TOP->toplevel_page_goodlayers_admin_panel" : "ETSY", "<-TOP->toplevel_page_layerslider" : "LayerSlider WP", "All Sliders" : "All Sliders", "Add New" : "Add New", "Skin Editor" : "Skin Editor", "Transition Builder" : "Transition Builder", "Custom Styles Editor" : "Custom Styles Editor", "<-TOP->toplevel_page_easy-testimonials-include-easy_testimonial_options" : "Easy Testimonial Settings"}', 'yes'),
(736, 'auto_core_update_notified', 'a:4:{s:4:"type";s:7:"success";s:5:"email";s:19:"gary@teamtweaks.com";s:7:"version";s:6:"3.8.11";s:9:"timestamp";i:1442381563;}', 'yes'),
(67, 'avatar_default', 'mystery', 'yes'),
(60, 'avatar_rating', 'G', 'yes'),
(47, 'blacklist_keys', '', 'no'),
(3, 'blogdescription', '', 'yes'),
(2, 'blogname', 'The artfill Blog', 'yes'),
(33, 'blog_charset', 'UTF-8', 'yes'),
(55, 'blog_public', '1', 'yes'),
(0, 'can_compress_scripts', '1', 'yes'),
(37, 'category_base', '', 'yes'),
(1326, 'category_children', 'a:0:{}', 'yes'),
(74, 'close_comments_days_old', '14', 'yes'),
(73, 'close_comments_for_old_posts', '', 'yes'),
(496, 'cnss-height', '27', 'yes'),
(497, 'cnss-margin', '4', 'yes'),
(498, 'cnss-row-count', '1', 'yes'),
(499, 'cnss-vertical-horizontal', 'horizontal', 'yes'),
(495, 'cnss-width', '27', 'yes'),
(10, 'comments_notify', '1', 'yes'),
(78, 'comments_per_page', '5', 'yes'),
(40, 'comment_max_links', '2', 'yes'),
(28, 'comment_moderation', '', 'yes'),
(80, 'comment_order', 'asc', 'yes'),
(48, 'comment_registration', '1', 'yes'),
(46, 'comment_whitelist', '', 'yes'),
(99, 'cron', 'a:6:{i:1442388330;a:2:{s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1442388381;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1442389521;a:1:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1442389920;a:1:{s:20:"wp_maybe_auto_update";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1442394764;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(836, 'ct_activated', '1399287837', 'yes'),
(129, 'current_theme', 'artfill Blog', 'yes'),
(22, 'date_format', 'F j, Y', 'yes'),
(745, 'db_upgraded', '', 'yes'),
(52, 'db_version', '26694', 'yes'),
(17, 'default_category', '1', 'yes'),
(79, 'default_comments_page', 'newest', 'yes'),
(18, 'default_comment_status', 'open', 'yes'),
(42, 'default_email_category', '1', 'yes'),
(56, 'default_link_category', '2', 'yes'),
(20, 'default_pingback_flag', '1', 'yes'),
(19, 'default_ping_status', 'open', 'yes'),
(89, 'default_post_format', '0', 'yes'),
(51, 'default_role', 'subscriber', 'yes'),
(863, 'easy-testimonial-category_children', 'a:0:{}', 'yes'),
(850, 'easy_t_apply_content_filter', '', 'yes'),
(848, 'easy_t_custom_css', '', 'yes'),
(849, 'easy_t_disable_cycle2', '', 'yes'),
(852, 'easy_t_image_size', 'easy_testimonial_thumb', 'yes'),
(851, 'easy_t_mystery_man', '', 'yes'),
(855, 'easy_t_registered_key', '', 'yes'),
(853, 'easy_t_registered_name', '', 'yes'),
(854, 'easy_t_registered_url', '', 'yes'),
(41, 'gmt_offset', '0', 'yes'),
(31, 'gzipcompression', '0', 'yes'),
(32, 'hack_file', '0', 'yes'),
(36, 'home', 'http://192.168.1.251:8081/artfill-v2/blog', 'yes'),
(49, 'html_type', 'text/html', 'yes'),
(72, 'image_default_align', '', 'yes'),
(70, 'image_default_link_type', 'file', 'yes'),
(71, 'image_default_size', '', 'yes'),
(91, 'initial_db_version', '26691', 'yes'),
(539, 'installation_step', '16', 'yes'),
(69, 'large_size_h', '1024', 'yes'),
(68, 'large_size_w', '1024', 'yes'),
(133, 'layerslider_last_version', '4.6.0', 'yes'),
(26, 'links_recently_updated_append', '</em>', 'yes'),
(25, 'links_recently_updated_prepend', '<em>', 'yes'),
(27, 'links_recently_updated_time', '120', 'yes'),
(24, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(90, 'link_manager_enabled', '0', 'yes'),
(14, 'mailserver_login', 'login@example.com', 'yes'),
(15, 'mailserver_pass', 'password', 'yes'),
(16, 'mailserver_port', '110', 'yes'),
(13, 'mailserver_url', 'mail.example.com', 'yes'),
(66, 'medium_size_h', '300', 'yes'),
(65, 'medium_size_w', '300', 'yes'),
(846, 'meta_data_position', '1', 'yes'),
(34, 'moderation_keys', '', 'no'),
(29, 'moderation_notify', '1', 'yes'),
(453, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:"auto_add";a:0:{}}', 'yes'),
(77, 'page_comments', '', 'yes'),
(87, 'page_for_posts', '0', 'yes'),
(88, 'page_on_front', '0', 'yes'),
(30, 'permalink_structure', '/%postname%/', 'yes'),
(38, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(412, 'pkt_404_content', 'The page you are looking for doesn''t seem to exist.', 'yes'),
(411, 'pkt_404_title', 'Page Not Found', 'yes'),
(345, 'pkt_accordion_background', '#ffffff', 'yes'),
(346, 'pkt_accordion_border', '#f5f5f5', 'yes'),
(344, 'pkt_accordion_title', '#363636', 'yes'),
(440, 'pkt_anything_slider_animation_speed', '600', 'yes'),
(437, 'pkt_anything_slider_hover_bulltes', 'disable', 'yes'),
(439, 'pkt_anything_slider_hover_navigation', 'enable', 'yes'),
(435, 'pkt_anything_slider_pause_on_hover', 'enable', 'yes'),
(441, 'pkt_anything_slider_pause_time', '12000', 'yes'),
(436, 'pkt_anything_slider_show_bulltes', 'disable', 'yes'),
(438, 'pkt_anything_slider_show_navigation', 'enable', 'yes'),
(353, 'pkt_back_to_top_text_color', '#919191', 'yes'),
(348, 'pkt_blockquote_border', '#cfcfcf', 'yes'),
(347, 'pkt_blockquote_color', '#ababab', 'yes'),
(228, 'pkt_body_background', '#ffffff', 'yes'),
(349, 'pkt_button_background_color', '#3389d7', 'yes'),
(350, 'pkt_button_text_color', '#ffffff', 'yes'),
(191, 'pkt_carousel_icon_type', 'light', 'yes'),
(351, 'pkt_column_service2_title_color', '#111111', 'yes'),
(324, 'pkt_contact_form_background_color', '#ffffff', 'yes'),
(326, 'pkt_contact_form_border_color', '#e3e3e3', 'yes'),
(327, 'pkt_contact_form_frame_color', '#f7f7f7', 'yes'),
(328, 'pkt_contact_form_inner_shadow', '#ececec', 'yes'),
(325, 'pkt_contact_form_text_color', '#888888', 'yes'),
(227, 'pkt_content_color', '#505050', 'yes'),
(179, 'pkt_content_font', '- Droid Sans', 'yes'),
(167, 'pkt_content_size', '13', 'yes'),
(261, 'pkt_copyright_bottom_border', '#494949', 'yes'),
(443, 'pkt_copyright_left_area', '&#169 2015 artfill, Inc', 'yes'),
(263, 'pkt_copyright_scroll_top', '#4b4b4b', 'yes'),
(262, 'pkt_copyright_text', '#999999', 'yes'),
(260, 'pkt_copyright_top_border', '#e4e4e4', 'yes'),
(159, 'pkt_create_sidebar', '<sidebar><name>sidebar</name></sidebar>', 'yes'),
(136, 'pkt_default_date_format', 'd M Y', 'yes'),
(662, 'pkt_default_post_header', 'Blog post', 'yes'),
(459, 'pkt_default_post_left_sidebar', 'sidebar', 'yes'),
(460, 'pkt_default_post_right_sidebar', 'sidebar', 'yes'),
(139, 'pkt_default_post_sidebar', 'post-right-sidebar', 'yes'),
(137, 'pkt_default_widget_date_format', 'd M Y', 'yes'),
(198, 'pkt_digg_share', 'enable', 'yes'),
(442, 'pkt_disable_right_click', 'disable', 'yes'),
(352, 'pkt_divider_line', '#e5e5e5', 'yes'),
(375, 'pkt_enable_admin_translator', 'enable', 'yes'),
(162, 'pkt_enable_analytics', 'disable', 'yes'),
(163, 'pkt_enable_favicon', 'disable', 'yes'),
(422, 'pkt_enable_layer_slider', 'enable', 'yes'),
(423, 'pkt_enable_lightbox_thumbnail', 'enable', 'yes'),
(425, 'pkt_enable_lightbox_thumbnail_height', '45', 'yes'),
(424, 'pkt_enable_lightbox_thumbnail_width', '80', 'yes'),
(134, 'pkt_enable_responsive', 'enable', 'yes'),
(189, 'pkt_enable_sliding_bar', 'enable', 'yes'),
(187, 'pkt_enable_top_bar', 'enable', 'yes'),
(188, 'pkt_enable_top_search', 'enable', 'yes'),
(194, 'pkt_facebook_share', 'enable', 'yes'),
(354, 'pkt_feature_media_title', '#3388d7', 'yes'),
(430, 'pkt_flex_slider_animation_speed', '600', 'yes'),
(426, 'pkt_flex_slider_effect', 'fade', 'yes'),
(432, 'pkt_flex_slider_pause_on_action', 'disable', 'yes'),
(427, 'pkt_flex_slider_pause_on_hover', 'enable', 'yes'),
(431, 'pkt_flex_slider_pause_time', '12000', 'yes'),
(428, 'pkt_flex_slider_show_bullets', 'disable', 'yes'),
(429, 'pkt_flex_slider_show_navigation', 'enable', 'yes'),
(434, 'pkt_flex_thumbnail_height', '50', 'yes'),
(433, 'pkt_flex_thumbnail_width', '75', 'yes'),
(249, 'pkt_footer_background', '#ffffff', 'yes'),
(255, 'pkt_footer_button_color', '#3389d7', 'yes'),
(254, 'pkt_footer_button_text', '#ffffff', 'yes'),
(247, 'pkt_footer_content_color', '#a5a5a5', 'yes'),
(248, 'pkt_footer_content_info_color', '#969696', 'yes'),
(250, 'pkt_footer_divider_color', '#424242', 'yes'),
(193, 'pkt_footer_icon_type', 'light', 'yes'),
(252, 'pkt_footer_input_background', '#3a3a3a', 'yes'),
(253, 'pkt_footer_input_border', '#444444', 'yes'),
(251, 'pkt_footer_input_text', '#9e9e9e', 'yes'),
(244, 'pkt_footer_link_color', '#a5a5a5', 'yes'),
(245, 'pkt_footer_link_hover_color', '#afafaf', 'yes'),
(256, 'pkt_footer_personnal_widget_info', '#e5e5e5', 'yes'),
(259, 'pkt_footer_post_widget_frame_background', '#474747', 'yes'),
(161, 'pkt_footer_style', 'footer-style6', 'yes'),
(258, 'pkt_footer_tagcloud_background', '#3389d7', 'yes'),
(257, 'pkt_footer_tagcloud_text', '#ffffff', 'yes'),
(246, 'pkt_footer_title_color', '#3389d7', 'yes'),
(144, 'pkt_gdl_portfolio_slug', 'portfolio', 'yes'),
(145, 'pkt_gdl_related_portfolio', 'Yes', 'yes'),
(147, 'pkt_gdl_related_portfolio_num_fetch', '2', 'yes'),
(146, 'pkt_gdl_related_portfolio_size', '1/4', 'yes'),
(149, 'pkt_gdl_related_portfolio_tag', 'Yes', 'yes'),
(148, 'pkt_gdl_related_portfolio_title', 'Yes', 'yes'),
(182, 'pkt_google_font_subset', 'latin', 'yes'),
(181, 'pkt_google_font_weight', 'n,i,b,bi', 'yes'),
(201, 'pkt_google_plus_share', 'enable', 'yes'),
(169, 'pkt_h1_size', '30', 'yes'),
(170, 'pkt_h2_size', '25', 'yes'),
(171, 'pkt_h3_size', '20', 'yes'),
(172, 'pkt_h4_size', '18', 'yes'),
(173, 'pkt_h5_size', '16', 'yes'),
(174, 'pkt_h6_size', '15', 'yes'),
(175, 'pkt_header_font', '- Roboto Condensed', 'yes'),
(166, 'pkt_header_title_size', '21', 'yes'),
(190, 'pkt_icon_type', 'dark', 'yes'),
(225, 'pkt_item_header_border', '#3389d7', 'yes'),
(224, 'pkt_item_header_title', '#3d3d3d', 'yes'),
(200, 'pkt_linkedin_share', 'enable', 'yes'),
(229, 'pkt_link_color', '#3389d7', 'yes'),
(230, 'pkt_link_hover_color', '#80acd6', 'yes'),
(3464, 'pkt_logo', '258', 'yes'),
(185, 'pkt_logo_bottom_margin', '18', 'yes'),
(184, 'pkt_logo_top_margin', '22', 'yes'),
(215, 'pkt_main_navigation_background_hover', '#3489d7', 'yes'),
(212, 'pkt_main_navigation_text', '#ffffff', 'yes'),
(214, 'pkt_main_navigation_text_current', '#ffffff', 'yes'),
(213, 'pkt_main_navigation_text_hover', '#ffffff', 'yes'),
(197, 'pkt_my_space_share', 'enable', 'yes'),
(176, 'pkt_navigation_font', '- Open Sans', 'yes'),
(186, 'pkt_navigation_top_margin', '22', 'yes'),
(420, 'pkt_nivo_slider_animation_speed', '500', 'yes'),
(416, 'pkt_nivo_slider_effect', 'sliceDown', 'yes'),
(417, 'pkt_nivo_slider_pause_on_hover', 'enable', 'yes'),
(421, 'pkt_nivo_slider_pause_time', '12000', 'yes'),
(418, 'pkt_nivo_slider_show_bullets', 'disable', 'yes'),
(419, 'pkt_nivo_slider_show_navigation', 'enable', 'yes'),
(308, 'pkt_package_date_color', '#939393', 'yes'),
(307, 'pkt_package_last_minute_price_color', '#e9513c', 'yes'),
(311, 'pkt_package_last_ribbon_background', '#e9513c', 'yes'),
(306, 'pkt_package_price_color', '#3389d7', 'yes'),
(310, 'pkt_package_ribbon_background', '#3389d7', 'yes'),
(312, 'pkt_package_ribbon_shadow', '#000000', 'yes'),
(309, 'pkt_package_ribbon_text', '#ffffff', 'yes'),
(316, 'pkt_package_search_background', '#f5f5f5', 'yes'),
(317, 'pkt_package_search_border', '#f2eaea', 'yes'),
(318, 'pkt_package_search_input_background', '#ffffff', 'yes'),
(320, 'pkt_package_search_input_border', '#e7e7e7', 'yes'),
(319, 'pkt_package_search_input_text', '#a3a3a3', 'yes'),
(322, 'pkt_package_search_submit_background', '#e9513c', 'yes'),
(321, 'pkt_package_search_submit_border', '#ae4030', 'yes'),
(323, 'pkt_package_search_submit_text', '#ffffff', 'yes'),
(305, 'pkt_package_title_color', '#3389d7', 'yes'),
(221, 'pkt_page_header_background', '#3389d7', 'yes'),
(223, 'pkt_page_header_caption', '#ffffff', 'yes'),
(222, 'pkt_page_header_title_color', '#ffffff', 'yes'),
(177, 'pkt_page_title_font', '- Open Sans', 'yes'),
(288, 'pkt_pagination_background', '#f5f5f5', 'yes'),
(292, 'pkt_pagination_current_background', '#3389d7', 'yes'),
(293, 'pkt_pagination_current_text', '#ffffff', 'yes'),
(290, 'pkt_pagination_hover_background', '#3389d7', 'yes'),
(291, 'pkt_pagination_hover_text', '#ffffff', 'yes'),
(289, 'pkt_pagination_text', '#7b7b7b', 'yes'),
(339, 'pkt_personnal_background', '#f9f9f9', 'yes'),
(342, 'pkt_personnal_content', '#838383', 'yes'),
(340, 'pkt_personnal_position_text', '#9d9d9d', 'yes'),
(341, 'pkt_personnal_title', '#353535', 'yes'),
(343, 'pkt_personnal_widget_info', '#4a4a4a', 'yes'),
(202, 'pkt_pinterest_share', 'enable', 'yes'),
(158, 'pkt_portfolio_archive_show_tags', 'No', 'yes'),
(157, 'pkt_portfolio_archive_show_title', 'Yes', 'yes'),
(156, 'pkt_portfolio_archive_size', '1/3', 'yes'),
(304, 'pkt_port_carousel_nav', '#f6f6f6', 'yes'),
(301, 'pkt_port_filter_border_color', '#3389d7', 'yes'),
(300, 'pkt_port_filter_color', '#111111', 'yes'),
(302, 'pkt_port_info_color', '#7a7a7a', 'yes'),
(303, 'pkt_port_info_head_color', '#404040', 'yes'),
(299, 'pkt_port_item_hover_background', '#3389d7', 'yes'),
(296, 'pkt_port_tag_color', '#a6a6a6', 'yes'),
(294, 'pkt_port_thumbnail_hover_color', '#000000', 'yes'),
(297, 'pkt_port_title_border', '#f3f3f3', 'yes'),
(295, 'pkt_port_title_color', '#2d2d2d', 'yes'),
(298, 'pkt_port_title_hover_color', '#ffffff', 'yes'),
(287, 'pkt_post_about_author_color', '#f5f5f5', 'yes'),
(284, 'pkt_post_info_color', '#9b9b9b', 'yes'),
(282, 'pkt_post_title_color', '#424242', 'yes'),
(283, 'pkt_post_title_hover_color', '#9c9c9c', 'yes'),
(238, 'pkt_post_widget_frame_background', '#f1f1f1', 'yes'),
(239, 'pkt_post_widget_frame_border', '#e3e3e3', 'yes'),
(286, 'pkt_post_widget_info_color', '#9b9b9b', 'yes'),
(285, 'pkt_post_widget_title_color', '#3389d7', 'yes'),
(329, 'pkt_price_background', '#f9f9f9', 'yes'),
(337, 'pkt_price_button_background', '#3389d7', 'yes'),
(338, 'pkt_price_button_text', '#ffffff', 'yes'),
(336, 'pkt_price_content_color', '#5e5e5e', 'yes'),
(335, 'pkt_price_tag_active_background', '#3389d7', 'yes'),
(334, 'pkt_price_tag_active_color', '#ffffff', 'yes'),
(333, 'pkt_price_tag_background', '#838383', 'yes'),
(332, 'pkt_price_tag_color', '#ffffff', 'yes'),
(331, 'pkt_price_title_background', '#454545', 'yes'),
(330, 'pkt_price_title_color', '#ffffff', 'yes'),
(356, 'pkt_progress_bar_background', '#f0f0f0', 'yes'),
(355, 'pkt_progress_bar_highlight', '#3389d7', 'yes'),
(357, 'pkt_progress_bar_text', '#ffffff', 'yes'),
(199, 'pkt_reddit_share', 'enable', 'yes'),
(155, 'pkt_search_archive_full_blog_content', 'No', 'yes'),
(154, 'pkt_search_archive_item_size', '1/1 Medium Thumbnail', 'yes'),
(461, 'pkt_search_archive_left_sidebar', 'sidebar', 'yes'),
(153, 'pkt_search_archive_num_excerpt', '160', 'yes'),
(462, 'pkt_search_archive_right_sidebar', 'sidebar', 'yes'),
(152, 'pkt_search_archive_sidebar', 'right-sidebar', 'yes'),
(413, 'pkt_search_header_title', 'Search Results.', 'yes'),
(415, 'pkt_search_not_found', 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'yes'),
(414, 'pkt_search_not_found_title', 'Search Not Found.', 'yes'),
(151, 'pkt_search_package_num_excerpt', '150', 'yes'),
(150, 'pkt_search_package_style', '1/1 Medium Thumbnail', 'yes'),
(232, 'pkt_selection_background', '#4f4f4f', 'yes'),
(231, 'pkt_selection_text_clor', '#ffffff', 'yes'),
(207, 'pkt_show_copyright', 'enable', 'yes'),
(160, 'pkt_show_footer', 'enable', 'yes'),
(142, 'pkt_show_post_author_info', 'Yes', 'yes'),
(141, 'pkt_show_post_comment_info', 'Yes', 'yes'),
(140, 'pkt_show_post_tag', 'Yes', 'yes'),
(203, 'pkt_show_twitter_bar', 'disable', 'yes'),
(204, 'pkt_show_twitter_only_homepage', 'disable', 'yes'),
(237, 'pkt_sidebar_info_color', '#a5a5a5', 'yes'),
(233, 'pkt_sidebar_link_color', '#3389d7', 'yes'),
(234, 'pkt_sidebar_link_hover_color', '#80acd6', 'yes'),
(235, 'pkt_sidebar_list_background', '#f7f7f7', 'yes'),
(236, 'pkt_sidebar_title_color', '#222222', 'yes'),
(313, 'pkt_single_package_info_background', '#f7f7f7', 'yes'),
(314, 'pkt_single_package_info_border', '#ebebeb', 'yes'),
(315, 'pkt_single_package_info_text', '#939393', 'yes'),
(272, 'pkt_slider_bullet_active', '#ffffff', 'yes'),
(270, 'pkt_slider_bullet_background', '#000000', 'yes'),
(271, 'pkt_slider_bullet_color', '#787878', 'yes'),
(269, 'pkt_slider_caption_background', '#000000', 'yes'),
(268, 'pkt_slider_caption_color', '#ffffff', 'yes'),
(265, 'pkt_slider_navigation_background', '#000000', 'yes'),
(273, 'pkt_slider_thumbnail_background', '#000000', 'yes'),
(267, 'pkt_slider_title_background', '#3389d7', 'yes'),
(266, 'pkt_slider_title_color', '#ffffff', 'yes'),
(178, 'pkt_slider_title_font', '- Open Sans', 'yes'),
(135, 'pkt_space_excerpt', 'enable', 'yes'),
(196, 'pkt_stumble_upon_share', 'enable', 'yes'),
(281, 'pkt_stunning_text_caption_color', '#606060', 'yes'),
(180, 'pkt_stunning_text_font', '- Open Sans', 'yes'),
(280, 'pkt_stunning_text_title_color', '#3389d7', 'yes'),
(216, 'pkt_sub_navigation_background', '#232323', 'yes'),
(218, 'pkt_sub_navigation_text', '#c1c1c1', 'yes'),
(220, 'pkt_sub_navigation_text_current', '#f2f2f2', 'yes'),
(219, 'pkt_sub_navigation_text_hover', '#f2f2f2', 'yes'),
(217, 'pkt_sub_navigation_top_border', '#ffffff', 'yes'),
(358, 'pkt_table_border', '#e5e5e5', 'yes'),
(359, 'pkt_table_text_title', '#666666', 'yes'),
(360, 'pkt_table_title_background', '#fdfdfd', 'yes'),
(363, 'pkt_tab_active_text_color', '#575757', 'yes'),
(364, 'pkt_tab_active_title_border', '#3389d7', 'yes'),
(361, 'pkt_tab_background_color', '#ffffff', 'yes'),
(362, 'pkt_tab_text_color', '#707070', 'yes'),
(366, 'pkt_tab_title_background', '#fafafa', 'yes'),
(365, 'pkt_tab_title_text', '#959595', 'yes'),
(241, 'pkt_tagcloud_background', '#3389d7', 'yes'),
(240, 'pkt_tagcloud_text', '#ffffff', 'yes'),
(371, 'pkt_testimonial_slide_background', '#ffffff', 'yes'),
(369, 'pkt_testimonial_slide_bullets', '#e0e0e0', 'yes'),
(370, 'pkt_testimonial_slide_bullet_active', '#c3c3c3', 'yes'),
(367, 'pkt_testimonial_slide_content', '#9d9d9d', 'yes'),
(368, 'pkt_testimonial_slide_info', '#656565', 'yes'),
(373, 'pkt_testimonial_static_border', '#efefef', 'yes'),
(372, 'pkt_testimonial_static_content_color', '#afafaf', 'yes'),
(374, 'pkt_testimonial_static_info', '#848484', 'yes'),
(226, 'pkt_title_color', '#111111', 'yes'),
(208, 'pkt_top_bar_text', '#c2c2c2', 'yes'),
(211, 'pkt_top_search_background', '#424242', 'yes'),
(209, 'pkt_top_search_button_border', '#bababa', 'yes'),
(210, 'pkt_top_search_text', '#a3a3a3', 'yes'),
(264, 'pkt_top_slider_background', '#f2f2f2', 'yes'),
(378, 'pkt_translator_about_author', 'About the Author', 'yes'),
(382, 'pkt_translator_all', 'All', 'yes'),
(398, 'pkt_translator_arrival_package', 'Arrival Date', 'yes'),
(390, 'pkt_translator_book_now_package', 'Book Now!', 'yes'),
(399, 'pkt_translator_budget_package', 'Max Budget (USD)', 'yes'),
(384, 'pkt_translator_client', 'Client: ', 'yes'),
(409, 'pkt_translator_contact_send_complete', 'The e-mail was sent successfully', 'yes'),
(408, 'pkt_translator_contact_send_error', 'Message cannot be sent to destination', 'yes'),
(379, 'pkt_translator_continue_reading', 'Continue Reading', 'yes'),
(397, 'pkt_translator_departure_package', 'Departure Date', 'yes'),
(391, 'pkt_translator_duration_package', 'Duration:', 'yes'),
(403, 'pkt_translator_email_contact_form', 'Email', 'yes'),
(404, 'pkt_translator_email_error_contact_form', 'Please enter a valid email address', 'yes'),
(394, 'pkt_translator_key_words_package', 'Key Words', 'yes'),
(389, 'pkt_translator_last_minute_package', 'Last Minute', 'yes'),
(377, 'pkt_translator_leave_reply', 'Leave a Reply', 'yes'),
(393, 'pkt_translator_location_package', 'Location:', 'yes'),
(405, 'pkt_translator_message_contact_form', 'Message', 'yes'),
(406, 'pkt_translator_message_error_contact_form', 'Please enter message', 'yes'),
(401, 'pkt_translator_name_contact_form', 'Name', 'yes'),
(402, 'pkt_translator_name_error_contact_form', 'Please enter your name', 'yes'),
(392, 'pkt_translator_price_package', 'Price:', 'yes'),
(388, 'pkt_translator_read_more_package', 'Learn More', 'yes'),
(410, 'pkt_translator_read_more_price', 'BUY NOW', 'yes'),
(380, 'pkt_translator_read_the_blog', 'Read The Blog', 'yes'),
(387, 'pkt_translator_related_portfolio', 'Related Portfolio', 'yes'),
(395, 'pkt_translator_search_location_package', 'Location', 'yes'),
(400, 'pkt_translator_search_package', 'Search', 'yes'),
(385, 'pkt_translator_skill', 'Skill: ', 'yes'),
(376, 'pkt_translator_social_shares', 'Social Share', 'yes'),
(407, 'pkt_translator_submit_contact_form', 'Submit', 'yes'),
(383, 'pkt_translator_tag', 'Tags: ', 'yes'),
(396, 'pkt_translator_trip_type', 'Trip Type', 'yes'),
(381, 'pkt_translator_view_all_portfolio', 'View All Portfolio', 'yes'),
(386, 'pkt_translator_visit_website', 'Visit Website: ', 'yes'),
(242, 'pkt_twitter_background', '#3389d7', 'yes'),
(205, 'pkt_twitter_bar_cache_time', '1', 'yes'),
(192, 'pkt_twitter_icon_type', 'light', 'yes'),
(206, 'pkt_twitter_num_fetch', '5', 'yes'),
(195, 'pkt_twitter_share', 'enable', 'yes'),
(243, 'pkt_twitter_text', '#ffffff', 'yes'),
(278, 'pkt_under_slider_background', '#3389d7', 'yes'),
(279, 'pkt_under_slider_border', '#3876ae', 'yes'),
(276, 'pkt_under_slider_button_background', '#4c4c4c', 'yes'),
(277, 'pkt_under_slider_button_text', '#ffffff', 'yes'),
(275, 'pkt_under_slider_caption', '#e1e1e1', 'yes'),
(274, 'pkt_under_slider_title', '#ffffff', 'yes'),
(183, 'pkt_upload_font', '<uploadfont></uploadfont>', 'yes'),
(143, 'pkt_use_portfolio_as', 'blog style', 'yes'),
(168, 'pkt_widget_title_size', '22', 'yes'),
(463, 'pkt_woo_all_product_left_sidebar', 'sidebar', 'yes'),
(464, 'pkt_woo_all_product_right_sidebar', 'sidebar', 'yes'),
(164, 'pkt_woo_all_product_sidebar', 'all-prod-right-sidebar', 'yes'),
(465, 'pkt_woo_single_product_left_sidebar', 'sidebar', 'yes'),
(466, 'pkt_woo_single_product_right_sidebar', 'sidebar', 'yes'),
(165, 'pkt_woo_single_product_sidebar', 'single-prod-right-sidebar', 'yes'),
(21, 'posts_per_page', '10', 'yes'),
(11, 'posts_per_rss', '10', 'yes'),
(467, 'recently_activated', 'a:6:{s:36:"contact-form-7/wp-contact-form-7.php";i:1439279169;s:57:"custom-taxonomy-sidebar-widget/custom-taxonomy-widget.php";i:1439279049;s:39:"easy-social-icons/easy-social-icons.php";i:1439279049;s:39:"easy-testimonials/easy-testimonials.php";i:1439279049;s:38:"featured-images-widget/recent-work.php";i:1439279049;s:26:"ag-custom-admin/plugin.php";i:1439279034;}', 'yes'),
(43, 'recently_edited', 'a:5:{i:0;s:70:"D:\\xampp\\htdocs\\artfill-v2\\blog/wp-content/themes/artfillblog/header.php";i:1;s:69:"D:\\xampp\\htdocs\\artfill-v2\\blog/wp-content/themes/artfillblog/style.css";i:2;s:73:"D:\\xampp\\htdocs\\artfill-v2\\blog/wp-content/themes/artfillblog/functions.php";i:3;s:71:"E:\\wamp\\www\\sivasankar\\etsyblog/wp-content/themes/artfillblog/header.php";i:4;s:70:"E:\\wamp\\www\\sivasankar\\etsyblog/wp-content/themes/artfillblog/style.css";}', 'no'),
(9, 'require_name_email', '1', 'yes');
INSERT INTO `artfill_sb_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(0, 'rewrite_rules', 'a:179:{s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:37:"portfolio/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:47:"portfolio/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:67:"portfolio/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:62:"portfolio/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:62:"portfolio/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:30:"portfolio/([^/]+)/trackback/?$";s:36:"index.php?portfolio=$matches[1]&tb=1";s:38:"portfolio/([^/]+)/page/?([0-9]{1,})/?$";s:49:"index.php?portfolio=$matches[1]&paged=$matches[2]";s:45:"portfolio/([^/]+)/comment-page-([0-9]{1,})/?$";s:49:"index.php?portfolio=$matches[1]&cpage=$matches[2]";s:30:"portfolio/([^/]+)(/[0-9]+)?/?$";s:48:"index.php?portfolio=$matches[1]&page=$matches[2]";s:26:"portfolio/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:36:"portfolio/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:56:"portfolio/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:51:"portfolio/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:51:"portfolio/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:59:"portfolio-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:57:"index.php?portfolio-category=$matches[1]&feed=$matches[2]";s:54:"portfolio-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:57:"index.php?portfolio-category=$matches[1]&feed=$matches[2]";s:47:"portfolio-category/([^/]+)/page/?([0-9]{1,})/?$";s:58:"index.php?portfolio-category=$matches[1]&paged=$matches[2]";s:29:"portfolio-category/([^/]+)/?$";s:40:"index.php?portfolio-category=$matches[1]";s:54:"portfolio-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?portfolio-tag=$matches[1]&feed=$matches[2]";s:49:"portfolio-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?portfolio-tag=$matches[1]&feed=$matches[2]";s:42:"portfolio-tag/([^/]+)/page/?([0-9]{1,})/?$";s:53:"index.php?portfolio-tag=$matches[1]&paged=$matches[2]";s:24:"portfolio-tag/([^/]+)/?$";s:35:"index.php?portfolio-tag=$matches[1]";s:39:"testimonial/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:49:"testimonial/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:69:"testimonial/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"testimonial/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"testimonial/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:32:"testimonial/([^/]+)/trackback/?$";s:38:"index.php?testimonial=$matches[1]&tb=1";s:40:"testimonial/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?testimonial=$matches[1]&paged=$matches[2]";s:47:"testimonial/([^/]+)/comment-page-([0-9]{1,})/?$";s:51:"index.php?testimonial=$matches[1]&cpage=$matches[2]";s:32:"testimonial/([^/]+)(/[0-9]+)?/?$";s:50:"index.php?testimonial=$matches[1]&page=$matches[2]";s:28:"testimonial/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:38:"testimonial/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:58:"testimonial/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"testimonial/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"testimonial/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:61:"testimonial-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?testimonial-category=$matches[1]&feed=$matches[2]";s:56:"testimonial-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?testimonial-category=$matches[1]&feed=$matches[2]";s:49:"testimonial-category/([^/]+)/page/?([0-9]{1,})/?$";s:60:"index.php?testimonial-category=$matches[1]&paged=$matches[2]";s:31:"testimonial-category/([^/]+)/?$";s:42:"index.php?testimonial-category=$matches[1]";s:39:"price_table/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:49:"price_table/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:69:"price_table/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"price_table/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"price_table/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:32:"price_table/([^/]+)/trackback/?$";s:38:"index.php?price_table=$matches[1]&tb=1";s:40:"price_table/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?price_table=$matches[1]&paged=$matches[2]";s:47:"price_table/([^/]+)/comment-page-([0-9]{1,})/?$";s:51:"index.php?price_table=$matches[1]&cpage=$matches[2]";s:32:"price_table/([^/]+)(/[0-9]+)?/?$";s:50:"index.php?price_table=$matches[1]&page=$matches[2]";s:28:"price_table/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:38:"price_table/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:58:"price_table/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"price_table/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"price_table/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:61:"price-table-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?price-table-category=$matches[1]&feed=$matches[2]";s:56:"price-table-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?price-table-category=$matches[1]&feed=$matches[2]";s:49:"price-table-category/([^/]+)/page/?([0-9]{1,})/?$";s:60:"index.php?price-table-category=$matches[1]&paged=$matches[2]";s:31:"price-table-category/([^/]+)/?$";s:42:"index.php?price-table-category=$matches[1]";s:35:"package/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:45:"package/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:65:"package/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:60:"package/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:60:"package/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:28:"package/([^/]+)/trackback/?$";s:34:"index.php?package=$matches[1]&tb=1";s:36:"package/([^/]+)/page/?([0-9]{1,})/?$";s:47:"index.php?package=$matches[1]&paged=$matches[2]";s:43:"package/([^/]+)/comment-page-([0-9]{1,})/?$";s:47:"index.php?package=$matches[1]&cpage=$matches[2]";s:28:"package/([^/]+)(/[0-9]+)?/?$";s:46:"index.php?package=$matches[1]&page=$matches[2]";s:24:"package/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:34:"package/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:54:"package/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:49:"package/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:49:"package/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:57:"package-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:55:"index.php?package-category=$matches[1]&feed=$matches[2]";s:52:"package-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:55:"index.php?package-category=$matches[1]&feed=$matches[2]";s:45:"package-category/([^/]+)/page/?([0-9]{1,})/?$";s:56:"index.php?package-category=$matches[1]&paged=$matches[2]";s:27:"package-category/([^/]+)/?$";s:38:"index.php?package-category=$matches[1]";s:52:"package-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?package-tag=$matches[1]&feed=$matches[2]";s:47:"package-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?package-tag=$matches[1]&feed=$matches[2]";s:40:"package-tag/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?package-tag=$matches[1]&paged=$matches[2]";s:22:"package-tag/([^/]+)/?$";s:33:"index.php?package-tag=$matches[1]";s:39:"gdl-gallery/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:49:"gdl-gallery/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:69:"gdl-gallery/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"gdl-gallery/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"gdl-gallery/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:32:"gdl-gallery/([^/]+)/trackback/?$";s:38:"index.php?gdl-gallery=$matches[1]&tb=1";s:40:"gdl-gallery/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?gdl-gallery=$matches[1]&paged=$matches[2]";s:47:"gdl-gallery/([^/]+)/comment-page-([0-9]{1,})/?$";s:51:"index.php?gdl-gallery=$matches[1]&cpage=$matches[2]";s:32:"gdl-gallery/([^/]+)(/[0-9]+)?/?$";s:50:"index.php?gdl-gallery=$matches[1]&page=$matches[2]";s:28:"gdl-gallery/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:38:"gdl-gallery/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:58:"gdl-gallery/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"gdl-gallery/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"gdl-gallery/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:37:"personnel/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:47:"personnel/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:67:"personnel/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:62:"personnel/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:62:"personnel/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:30:"personnel/([^/]+)/trackback/?$";s:36:"index.php?personnal=$matches[1]&tb=1";s:38:"personnel/([^/]+)/page/?([0-9]{1,})/?$";s:49:"index.php?personnal=$matches[1]&paged=$matches[2]";s:45:"personnel/([^/]+)/comment-page-([0-9]{1,})/?$";s:49:"index.php?personnal=$matches[1]&cpage=$matches[2]";s:30:"personnel/([^/]+)(/[0-9]+)?/?$";s:48:"index.php?personnal=$matches[1]&page=$matches[2]";s:26:"personnel/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:36:"personnel/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:56:"personnel/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:51:"personnel/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:51:"personnel/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:59:"personnal-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:57:"index.php?personnal-category=$matches[1]&feed=$matches[2]";s:54:"personnal-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:57:"index.php?personnal-category=$matches[1]&feed=$matches[2]";s:47:"personnal-category/([^/]+)/page/?([0-9]{1,})/?$";s:58:"index.php?personnal-category=$matches[1]&paged=$matches[2]";s:29:"personnal-category/([^/]+)/?$";s:40:"index.php?personnal-category=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)(/[0-9]+)?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:28:"([^/]+)/page/?([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&paged=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)(/[0-9]+)?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";}', 'yes'),
(12, 'rss_use_excerpt', '0', 'yes'),
(577, 'shiba_widget_custom_types', 'a:2:{s:10:"post_types";a:0:{}s:10:"taxonomies";a:2:{i:0;s:8:"category";i:1;s:8:"post_tag";}}', 'yes'),
(576, 'shiba_widget_options', 'a:12:{s:7:"default";i:0;s:9:"frontpage";i:0;s:9:"not_found";i:0;s:6:"search";i:0;s:6:"single";i:0;s:4:"page";i:0;s:10:"attachment";i:0;s:8:"category";i:0;s:3:"tag";i:0;s:12:"lost_widgets";s:2:"on";s:19:"include_new_widgets";s:2:"on";s:19:"include_exp_widgets";s:2:"on";}', 'yes'),
(92, 'artfill_sb_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:68:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:18:"wysija_newsletters";b:1;s:18:"wysija_subscribers";b:1;s:13:"wysija_config";b:1;s:16:"wysija_theme_tab";b:1;s:16:"wysija_style_tab";b:1;s:22:"wysija_stats_dashboard";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(59, 'show_avatars', '1', 'yes'),
(57, 'show_on_front', 'posts', 'yes'),
(98, 'sidebars_widgets', 'a:10:{s:19:"wp_inactive_widgets";a:3:{i:0;s:8:"search-3";i:1;s:6:"text-3";i:2;s:10:"nav_menu-4";}s:15:"custom-sidebar0";a:1:{i:0;s:10:"nav_menu-3";}s:15:"custom-sidebar1";a:0:{}s:15:"custom-sidebar2";a:0:{}s:15:"custom-sidebar3";a:0:{}s:15:"custom-sidebar4";a:0:{}s:15:"custom-sidebar5";a:0:{}s:15:"custom-sidebar6";a:0:{}s:15:"custom-sidebar7";a:1:{i:0;s:8:"search-2";}s:13:"array_version";i:3;}', 'yes'),
(1, 'siteurl', 'http://192.168.1.251:8081/artfill-v2/blog', 'yes'),
(6, 'start_of_week', '1', 'yes'),
(81, 'sticky_posts', 'a:0:{}', 'yes'),
(45, 'stylesheet', 'artfillblog', 'yes'),
(58, 'tag_base', '', 'yes'),
(44, 'template', 'artfillblog', 'yes'),
(583, 'testimonial-category_children', 'a:0:{}', 'yes'),
(845, 'testimonials_image', '', 'yes'),
(844, 'testimonials_link', 'http://192.168.1.251:8081/artfill-v2/blog/testimonial', 'yes'),
(847, 'testimonials_style', 'default_style', 'yes'),
(0, 'theme_mods_abcrestaurant', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1439280479;s:4:"data";a:9:{s:19:"wp_inactive_widgets";a:3:{i:0;s:8:"search-3";i:1;s:6:"text-3";i:2;s:10:"nav_menu-4";}s:15:"custom-sidebar0";a:1:{i:0;s:10:"nav_menu-3";}s:15:"custom-sidebar1";a:0:{}s:15:"custom-sidebar2";a:0:{}s:15:"custom-sidebar3";a:0:{}s:15:"custom-sidebar4";a:0:{}s:15:"custom-sidebar5";a:0:{}s:15:"custom-sidebar6";a:0:{}s:15:"custom-sidebar7";a:1:{i:0;s:8:"search-2";}}}}', 'yes'),
(130, 'theme_mods_etsyblog', 'a:3:{i:0;b:0;s:18:"nav_menu_locations";a:1:{s:9:"main_menu";i:3;}s:16:"sidebars_widgets";a:2:{s:4:"time";i:1399460286;s:4:"data";a:9:{s:19:"wp_inactive_widgets";a:7:{i:0;s:13:"cnss_widget-2";i:1;s:13:"cnss_widget-4";i:2;s:25:"randomtestimonialwidget-3";i:3;s:8:"search-3";i:4;s:6:"text-3";i:5;s:10:"nav_menu-4";i:6;s:13:"recent_work-3";}s:15:"custom-sidebar0";a:1:{i:0;s:10:"nav_menu-3";}s:15:"custom-sidebar1";a:0:{}s:15:"custom-sidebar2";a:0:{}s:15:"custom-sidebar3";a:0:{}s:15:"custom-sidebar4";a:0:{}s:15:"custom-sidebar5";a:0:{}s:15:"custom-sidebar6";a:0:{}s:15:"custom-sidebar7";a:5:{i:0;s:8:"search-2";i:1;s:25:"randomtestimonialwidget-2";i:2;s:13:"recent_work-2";i:3;s:13:"cnss_widget-3";i:4;s:6:"text-2";}}}}', 'yes'),
(953, 'theme_mods_artfillblog', 'a:1:{i:0;b:0;}', 'yes'),
(0, 'theme_mods_twentyfourteen', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1439280490;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:4:{i:0;s:8:"search-3";i:1;s:6:"text-3";i:2;s:10:"nav_menu-3";i:3;s:10:"nav_menu-4";}s:9:"sidebar-1";a:1:{i:0;s:8:"search-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}}}', 'yes'),
(965, 'theme_mods_twentythirteen', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1399460308;s:4:"data";a:3:{s:19:"wp_inactive_widgets";a:12:{i:0;s:13:"cnss_widget-4";i:1;s:25:"randomtestimonialwidget-3";i:2;s:8:"search-3";i:3;s:6:"text-2";i:4;s:6:"text-3";i:5;s:10:"nav_menu-3";i:6;s:10:"nav_menu-4";i:7;s:13:"cnss_widget-2";i:8;s:13:"cnss_widget-3";i:9;s:25:"randomtestimonialwidget-2";i:10;s:13:"recent_work-2";i:11;s:13:"recent_work-3";}s:9:"sidebar-1";a:1:{i:0;s:8:"search-2";}s:9:"sidebar-2";a:0:{}}}}', 'yes'),
(952, 'theme_mods_twentytwelve', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1399460081;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:12:{i:0;s:13:"cnss_widget-4";i:1;s:25:"randomtestimonialwidget-3";i:2;s:8:"search-3";i:3;s:6:"text-2";i:4;s:6:"text-3";i:5;s:10:"nav_menu-3";i:6;s:10:"nav_menu-4";i:7;s:13:"cnss_widget-2";i:8;s:13:"cnss_widget-3";i:9;s:25:"randomtestimonialwidget-2";i:10;s:13:"recent_work-2";i:11;s:13:"recent_work-3";}s:9:"sidebar-1";a:1:{i:0;s:8:"search-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}}}', 'yes'),
(131, 'theme_switched', '', 'yes'),
(75, 'thread_comments', '1', 'yes'),
(76, 'thread_comments_depth', '5', 'yes'),
(64, 'thumbnail_crop', '1', 'yes'),
(63, 'thumbnail_size_h', '150', 'yes'),
(62, 'thumbnail_size_w', '150', 'yes'),
(86, 'timezone_string', '', 'yes'),
(23, 'time_format', 'g:i a', 'yes'),
(85, 'uninstall_plugins', 'a:2:{s:41:"lumia-testimonials/lumia-testimonials.php";a:2:{i:0;s:17:"lumia_testimonial";i:1;s:15:"lumia_uninstall";}s:27:"wp-pagenavi/wp-pagenavi.php";s:14:"__return_false";}', 'no'),
(53, 'uploads_use_yearmonth_folders', '1', 'yes'),
(54, 'upload_path', '', 'yes'),
(61, 'upload_url_path', '', 'yes'),
(4, 'users_can_register', '1', 'yes'),
(7, 'use_balanceTags', '0', 'yes'),
(8, 'use_smilies', '1', 'yes'),
(50, 'use_trackback', '0', 'yes'),
(96, 'widget_archives', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(82, 'widget_categories', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(529, 'widget_cnss_widget', 'a:4:{i:2;a:1:{s:5:"title";s:9:"New title";}i:3;a:1:{s:5:"title";s:13:"Stay In Touch";}i:4;a:1:{s:5:"title";s:13:"Stay in Touch";}s:12:"_multiwidget";i:1;}', 'yes'),
(531, 'widget_contact-widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(589, 'widget_custom_taxonomy_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(582, 'widget_lc_taxonomy', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'widget_meta', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(454, 'widget_nav_menu', 'a:3:{i:3;a:2:{s:5:"title";s:0:"";s:8:"nav_menu";i:2;}i:4;a:2:{s:5:"title";s:0:"";s:8:"nav_menu";i:2;}s:12:"_multiwidget";i:1;}', 'yes'),
(858, 'widget_randomtestimonialwidget', 'a:3:{i:2;a:5:{s:5:"title";s:18:"What You''re Saying";s:5:"count";s:1:"1";s:10:"show_title";s:1:"1";s:11:"use_excerpt";s:1:"1";s:8:"category";s:0:"";}i:3;a:5:{s:5:"title";s:18:"What You''re Saying";s:5:"count";s:1:"1";s:10:"show_title";s:1:"1";s:11:"use_excerpt";s:1:"1";s:8:"category";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_recent-comments', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_recent-posts', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(474, 'widget_recent_work', 'a:3:{i:2;a:4:{s:5:"title";s:23:"Recently Featured Items";s:4:"show";s:1:"5";s:3:"cat";s:1:"1";s:3:"css";s:1:"0";}i:3;a:4:{s:5:"title";s:23:"Recently Featured Items";s:4:"show";s:1:"5";s:3:"cat";s:1:"1";s:3:"css";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(84, 'widget_rss', 'a:0:{}', 'yes'),
(93, 'widget_search', 'a:3:{i:2;a:1:{s:5:"title";s:15:"search the Blog";}i:3;a:1:{s:5:"title";s:15:"search the Blog";}s:12:"_multiwidget";i:1;}', 'yes'),
(504, 'widget_social-icons-widget', 'a:2:{i:3;a:24:{s:7:"behance";s:7:"http://";s:8:"dribbble";s:7:"http://";s:8:"facebook";s:29:"http://www.facebook.com/Etsy/";s:6:"flickr";s:38:"http://www.flickr.com/photos/etsylabs/";s:6:"forrst";s:7:"http://";s:10:"foursquare";s:7:"http://";s:10:"googleplus";s:7:"http://";s:9:"instagram";s:7:"http://";s:5:"klout";s:7:"http://";s:8:"linkedin";s:7:"http://";s:4:"path";s:7:"http://";s:9:"pinterest";s:30:"http://www.pinterest.com/etsy/";s:3:"rss";s:35:"https://www.etsy.com/blog/en/feeds/";s:11:"stumbleupon";s:7:"http://";s:10:"technorati";s:7:"http://";s:6:"tumblr";s:23:"http://etsy.tumblr.com/";s:7:"twitter";s:25:"https://twitter.com/etsy/";s:5:"vimeo";s:7:"http://";s:4:"yelp";s:7:"http://";s:7:"youtube";s:32:"http://www.youtube.com/user/etsy";s:6:"zerply";s:7:"http://";s:5:"title";s:13:"stay in touch";s:5:"icons";s:5:"small";s:6:"labels";s:4:"show";}s:12:"_multiwidget";i:1;}', 'yes'),
(614, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(838, 'widget_testimonials_widget', 'a:2:{i:2;a:3:{s:14:"testimonial_id";s:2:"94";s:22:"testimonial_word_limit";s:0:"";s:27:"testimonial_random_category";N;}s:12:"_multiwidget";i:1;}', 'yes'),
(83, 'widget_text', 'a:2:{i:3;a:3:{s:5:"title";s:10:"Etsy finds";s:4:"text";s:235:"Get our daily email of hot products and gift ideas.\r\n\r\n<form action="" class="newsletter">\r\n<input type="text" name="email" placeholder="Email">\r\n<input type="submit" value="submit">\r\n\r\n</form>\r\n<a href="#">see our other newsletter</a>";s:6:"filter";b:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(502, 'widget_tipsy-social-icons', 'a:2:{i:2;a:35:{s:5:"500px";s:0:"";s:7:"behance";s:0:"";s:10:"deviantart";s:0:"";s:4:"digg";s:0:"";s:8:"dribbble";s:0:"";s:5:"email";s:0:"";s:8:"evernote";s:0:"";s:8:"facebook";s:29:"http://www.facebook.com/Etsy/";s:6:"flickr";s:0:"";s:6:"forrst";s:0:"";s:10:"foursquare";s:0:"";s:6:"github";s:0:"";s:10:"googleplus";s:0:"";s:9:"instagram";s:0:"";s:6:"lastfm";s:0:"";s:8:"linkedin";s:0:"";s:8:"mixcloud";s:0:"";s:6:"picasa";s:0:"";s:9:"pinterest";s:29:"http://www.pinterest.com/etsy";s:4:"rdio";s:0:"";s:3:"rss";s:0:"";s:5:"skype";s:0:"";s:10:"soundcloud";s:0:"";s:13:"stackoverflow";s:0:"";s:11:"stumbleupon";s:0:"";s:6:"tumblr";s:23:"http://etsy.tumblr.com/";s:7:"twitter";s:25:"https://twitter.com/etsy/";s:5:"vimeo";s:0:"";s:6:"yammer";s:0:"";s:4:"yelp";s:0:"";s:7:"youtube";s:0:"";s:7:"zootool";s:0:"";s:15:"use_large_icons";s:5:"small";s:15:"use_fade_effect";s:7:"disable";s:16:"tooltip_position";s:5:"above";}s:12:"_multiwidget";i:1;}', 'yes'),
(480, 'widget_wiwitness-widget', 'a:2:{i:2;a:1:{s:2:"id";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(545, 'widget_wysija', 'a:2:{i:2;a:2:{s:5:"title";s:13:"Etsy to Finds";s:4:"form";s:1:"1";}s:12:"_multiwidget";i:1;}', 'yes'),
(669, 'wpcf7', 'a:1:{s:7:"version";s:5:"3.7.2";}', 'yes'),
(874, 'wp_paginate_options', 'a:10:{s:5:"title";s:6:"Pages:";s:8:"nextpage";s:7:"&raquo;";s:12:"previouspage";s:7:"&laquo;";s:3:"css";b:1;s:6:"before";s:26:"<div class=\\"navigation\\">";s:5:"after";s:6:"</div>";s:5:"empty";b:1;s:5:"range";i:2;s:6:"anchor";i:1;s:3:"gap";i:2;}', 'yes'),
(540, 'wysija', 'YToxODp7czo5OiJmcm9tX25hbWUiO3M6ODoiZXRzeWJsb2ciO3M6MTI6InJlcGx5dG9fbmFtZSI7czo4OiJldHN5YmxvZyI7czoxNToiZW1haWxzX25vdGlmaWVkIjtzOjIxOiJzYW5rYXJAdGVhbXR3ZWFrcy5jb20iO3M6MTA6ImZyb21fZW1haWwiO3M6MTg6ImluZm9AMTkyLjE2OC4xLjI1MyI7czoxMzoicmVwbHl0b19lbWFpbCI7czoxODoiaW5mb0AxOTIuMTY4LjEuMjUzIjtzOjE1OiJkZWZhdWx0X2xpc3RfaWQiO2k6MTtzOjE3OiJ0b3RhbF9zdWJzY3JpYmVycyI7czoxOiIxIjtzOjE2OiJpbXBvcnR3cF9saXN0X2lkIjtpOjI7czoxODoiY29uZmlybV9lbWFpbF9saW5rIjtpOjkyO3M6MTI6InVwbG9hZGZvbGRlciI7czo1ODoiRTpcd2FtcFx3d3dcc2l2YXNhbmthclxldHN5YmxvZy93cC1jb250ZW50L3VwbG9hZHNcd3lzaWphXCI7czo5OiJ1cGxvYWR1cmwiO3M6Njc6Imh0dHA6Ly8xOTIuMTY4LjEuMjUzL3NpdmFzYW5rYXIvZXRzeWJsb2cvd3AtY29udGVudC91cGxvYWRzL3d5c2lqYS8iO3M6MTY6ImNvbmZpcm1fZW1haWxfaWQiO2k6MjtzOjk6Imluc3RhbGxlZCI7YjoxO3M6MjA6Im1hbmFnZV9zdWJzY3JpcHRpb25zIjtiOjE7czoxNDoiaW5zdGFsbGVkX3RpbWUiO2k6MTM5NTIxMzk3NDtzOjE3OiJ3eXNpamFfZGJfdmVyc2lvbiI7czozOiIyLjYiO3M6MTE6ImRraW1fZG9tYWluIjtzOjEzOiIxOTIuMTY4LjEuMjUzIjtzOjE2OiJ3eXNpamFfd2hhdHNfbmV3IjtzOjM6IjIuNiI7fQ==', 'yes'),
(552, 'wysija_check_pn', '1395218648.0001', 'yes'),
(553, 'wysija_last_php_cron_call', '1395218648', 'yes'),
(554, 'wysija_last_scheduled_check', '1395218648', 'yes'),
(546, 'wysija_msg', '', 'no'),
(538, 'wysija_post_type_created', '1395213965', 'yes'),
(536, 'wysija_post_type_updated', '1395213965', 'yes'),
(547, 'wysija_queries', '', 'no'),
(548, 'wysija_queries_errors', '', 'no'),
(542, 'wysija_reinstall', '0', 'no'),
(543, 'wysija_schedules', 'a:5:{s:5:"queue";a:3:{s:13:"next_schedule";i:1395222248;s:13:"prev_schedule";b:0;s:7:"running";b:0;}s:6:"bounce";a:3:{s:13:"next_schedule";i:1395300382;s:13:"prev_schedule";i:0;s:7:"running";b:0;}s:5:"daily";a:3:{s:13:"next_schedule";i:1395300382;s:13:"prev_schedule";i:0;s:7:"running";b:0;}s:6:"weekly";a:3:{s:13:"next_schedule";i:1395818782;s:13:"prev_schedule";i:0;s:7:"running";b:0;}s:7:"monthly";a:3:{s:13:"next_schedule";i:1397633182;s:13:"prev_schedule";i:0;s:7:"running";b:0;}}', 'yes'),
(657, '_simple_pagination', 'a:23:{s:10:"text_pages";s:6:"Pages:";s:18:"text_previous_page";s:3:"â€¹";s:14:"text_next_page";s:3:"â€º";s:15:"text_first_page";s:2:"Â«";s:14:"text_last_page";s:2:"Â»";s:8:"css_file";s:7:"default";s:3:"css";s:1:"1";s:17:"before_pagination";s:40:"&lt;div class=&quot;pagination&quot;&gt;";s:16:"after_pagination";s:12:"&lt;/div&gt;";s:11:"before_link";s:0:"";s:10:"after_link";s:0:"";s:11:"always_show";s:1:"1";s:8:"show_all";s:1:"1";s:5:"range";i:3;s:6:"anchor";i:0;s:19:"larger_page_to_show";i:0;s:20:"larger_page_multiple";i:0;s:20:"comments_always_show";s:1:"1";s:17:"comments_show_all";s:1:"1";s:14:"comments_range";s:1:"3";s:15:"comments_anchor";s:1:"0";s:28:"comments_larger_page_to_show";s:1:"0";s:29:"comments_larger_page_multiple";s:1:"0";}', 'yes'),
(0, '_site_transient_browser_0a4e6fcdce3668f58205e52074f50ed8', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"44.0.2403.155";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(0, '_site_transient_browser_224bf283a5a924fc3a30d51d5559a4ea', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"44.0.2403.130";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(0, '_site_transient_theme_roots', 'a:2:{s:10:"artfillblog";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";}', 'yes'),
(0, '_site_transient_timeout_browser_0a4e6fcdce3668f58205e52074f50ed8', '1440064284', 'yes'),
(0, '_site_transient_timeout_browser_224bf283a5a924fc3a30d51d5559a4ea', '1439883728', 'yes'),
(0, '_site_transient_timeout_theme_roots', '1442383347', 'yes'),
(0, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:6:{i:0;O:8:"stdClass":10:{s:8:"response";s:7:"upgrade";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.3.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.3.1.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.3.1-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.3.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.3.1";s:7:"version";s:5:"4.3.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:1;O:8:"stdClass":10:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.3.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.3.1.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.3.1-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.3.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.3.1";s:7:"version";s:5:"4.3.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:2;O:8:"stdClass":10:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.2.5.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.2.5.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.2.5-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.2.5-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.2.5";s:7:"version";s:5:"4.2.5";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:3;O:8:"stdClass":10:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.1.8.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.1.8.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.1.8-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.1.8-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.1.8";s:7:"version";s:5:"4.1.8";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:4;O:8:"stdClass":10:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.0.8.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.0.8.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.0.8-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.0.8-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.0.8";s:7:"version";s:5:"4.0.8";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}i:5;O:8:"stdClass":10:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-3.9.9.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-3.9.9.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-3.9.9-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-3.9.9-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"3.9.9";s:7:"version";s:5:"3.9.9";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1442381559;s:15:"version_checked";s:6:"3.8.11";s:12:"translations";a:0:{}}', 'yes'),
(0, '_site_transient_update_plugins', 'O:8:"stdClass":3:{s:12:"last_checked";i:1442381561;s:8:"response";a:3:{s:26:"ag-custom-admin/plugin.php";O:8:"stdClass":7:{s:2:"id";s:5:"22039";s:4:"slug";s:15:"ag-custom-admin";s:6:"plugin";s:26:"ag-custom-admin/plugin.php";s:11:"new_version";s:7:"1.4.8.2";s:3:"url";s:46:"https://wordpress.org/plugins/ag-custom-admin/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/ag-custom-admin.1.4.8.2.zip";s:14:"upgrade_notice";s:198:"Added check for non existing &#039;pagenow&#039; GLOBAL variable\nUsing default WordPress theme when AGCA theme is activated\nFixed unknown font theme issue\nOption to remove AGCA themes from admin bar";}s:39:"easy-social-icons/easy-social-icons.php";O:8:"stdClass":6:{s:2:"id";s:5:"35644";s:4:"slug";s:17:"easy-social-icons";s:6:"plugin";s:39:"easy-social-icons/easy-social-icons.php";s:11:"new_version";s:7:"1.2.4.1";s:3:"url";s:48:"https://wordpress.org/plugins/easy-social-icons/";s:7:"package";s:68:"https://downloads.wordpress.org/plugin/easy-social-icons.1.2.4.1.zip";}s:39:"easy-testimonials/easy-testimonials.php";O:8:"stdClass":6:{s:2:"id";s:5:"41998";s:4:"slug";s:17:"easy-testimonials";s:6:"plugin";s:39:"easy-testimonials/easy-testimonials.php";s:11:"new_version";s:6:"1.31.8";s:3:"url";s:48:"https://wordpress.org/plugins/easy-testimonials/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/easy-testimonials.zip";}}s:12:"translations";a:0:{}}', 'yes'),
(0, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1442381561;s:7:"checked";a:2:{s:10:"artfillblog";s:3:"1.0";s:14:"twentyfourteen";s:3:"1.0";}s:8:"response";a:1:{s:14:"twentyfourteen";a:4:{s:5:"theme";s:14:"twentyfourteen";s:11:"new_version";s:3:"1.5";s:3:"url";s:44:"https://wordpress.org/themes/twentyfourteen/";s:7:"package";s:60:"https://downloads.wordpress.org/theme/twentyfourteen.1.5.zip";}}s:12:"translations";a:0:{}}', 'yes'),
(0, '_transient_doing_cron', '1444397568.2128000259399414062500', 'yes'),
(0, '_transient_plugin_slugs', 'a:6:{i:0;s:26:"ag-custom-admin/plugin.php";i:1;s:36:"contact-form-7/wp-contact-form-7.php";i:2;s:57:"custom-taxonomy-sidebar-widget/custom-taxonomy-widget.php";i:3;s:39:"easy-social-icons/easy-social-icons.php";i:4;s:39:"easy-testimonials/easy-testimonials.php";i:5;s:38:"featured-images-widget/recent-work.php";}', 'no'),
(615, '_transient_random_seed', '0180bbd8d5f8f3bf9e8df98bd8dc39e9', 'yes'),
(3490, '_transient_timeout_feed_867bd5c64f85878d03a060509cd2f92c', '1430356337', 'no'),
(3487, '_transient_timeout_feed_ac0b00fe65abe10e0c5b588f3ed8c7ca', '1430356337', 'no'),
(0, '_transient_timeout_plugin_slugs', '1439366867', 'no'),
(116, '_transient_twentyfourteen_category_count', '1', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_postmeta`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1567 ;

--
-- Dumping data for table `artfill_sb_postmeta`
--

INSERT INTO `artfill_sb_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(381, 48, '_menu_item_type', 'custom'),
(382, 48, '_menu_item_menu_item_parent', '0'),
(383, 48, '_menu_item_object_id', '48'),
(384, 48, '_menu_item_object', 'custom'),
(385, 48, '_menu_item_target', ''),
(386, 48, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(387, 48, '_menu_item_xfn', ''),
(388, 48, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/about'),
(390, 50, '_menu_item_type', 'custom'),
(391, 50, '_menu_item_menu_item_parent', '0'),
(392, 50, '_menu_item_object_id', '50'),
(393, 50, '_menu_item_object', 'custom'),
(394, 50, '_menu_item_target', ''),
(395, 50, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(396, 50, '_menu_item_xfn', ''),
(397, 50, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/contact'),
(416, 53, '_menu_item_type', 'custom'),
(417, 53, '_menu_item_menu_item_parent', '0'),
(418, 53, '_menu_item_object_id', '53'),
(419, 53, '_menu_item_object', 'custom'),
(420, 53, '_menu_item_target', ''),
(421, 53, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(422, 53, '_menu_item_xfn', ''),
(423, 53, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/blog'),
(442, 56, '_menu_item_type', 'custom'),
(443, 56, '_menu_item_menu_item_parent', '0'),
(444, 56, '_menu_item_object_id', '56'),
(445, 56, '_menu_item_object', 'custom'),
(446, 56, '_menu_item_target', ''),
(447, 56, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(448, 56, '_menu_item_xfn', ''),
(449, 56, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/pages'),
(468, 59, '_menu_item_type', 'custom'),
(469, 59, '_menu_item_menu_item_parent', '0'),
(470, 59, '_menu_item_object_id', '59'),
(471, 59, '_menu_item_object', 'custom'),
(472, 59, '_menu_item_target', ''),
(473, 59, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(474, 59, '_menu_item_xfn', ''),
(475, 59, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/press'),
(494, 61, '_menu_item_type', 'custom'),
(495, 61, '_menu_item_menu_item_parent', '0'),
(496, 61, '_menu_item_object_id', '61'),
(497, 61, '_menu_item_object', 'custom'),
(498, 61, '_menu_item_target', ''),
(499, 61, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(500, 61, '_menu_item_xfn', ''),
(501, 61, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/'),
(503, 62, '_menu_item_type', 'custom'),
(504, 62, '_menu_item_menu_item_parent', '0'),
(505, 62, '_menu_item_object_id', '62'),
(506, 62, '_menu_item_object', 'custom'),
(507, 62, '_menu_item_target', ''),
(508, 62, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(509, 62, '_menu_item_xfn', ''),
(510, 62, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/careers'),
(512, 63, '_menu_item_type', 'custom'),
(513, 63, '_menu_item_menu_item_parent', '0'),
(514, 63, '_menu_item_object_id', '63'),
(515, 63, '_menu_item_object', 'custom'),
(516, 63, '_menu_item_target', ''),
(517, 63, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(518, 63, '_menu_item_xfn', ''),
(519, 63, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/terms'),
(521, 64, '_menu_item_type', 'custom'),
(522, 64, '_menu_item_menu_item_parent', '0'),
(523, 64, '_menu_item_object_id', '64'),
(524, 64, '_menu_item_object', 'custom'),
(525, 64, '_menu_item_target', ''),
(526, 64, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(527, 64, '_menu_item_xfn', ''),
(528, 64, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/privacy'),
(530, 65, '_menu_item_type', 'custom'),
(531, 65, '_menu_item_menu_item_parent', '0'),
(532, 65, '_menu_item_object_id', '65'),
(533, 65, '_menu_item_object', 'custom'),
(534, 65, '_menu_item_target', ''),
(535, 65, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(536, 65, '_menu_item_xfn', ''),
(537, 65, '_menu_item_url', 'http://192.168.1.251:8081/artfill-v2/blog/pages/copyright'),
(539, 66, '_menu_item_type', 'post_type'),
(540, 66, '_menu_item_menu_item_parent', '0'),
(541, 66, '_menu_item_object_id', '15'),
(542, 66, '_menu_item_object', 'page'),
(543, 66, '_menu_item_target', ''),
(544, 66, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(545, 66, '_menu_item_xfn', ''),
(546, 66, '_menu_item_url', ''),
(548, 67, '_menu_item_type', 'post_type'),
(549, 67, '_menu_item_menu_item_parent', '0'),
(550, 67, '_menu_item_object_id', '13'),
(551, 67, '_menu_item_object', 'page'),
(552, 67, '_menu_item_target', ''),
(553, 67, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(554, 67, '_menu_item_xfn', ''),
(555, 67, '_menu_item_url', ''),
(557, 68, '_menu_item_type', 'post_type'),
(558, 68, '_menu_item_menu_item_parent', '0'),
(559, 68, '_menu_item_object_id', '11'),
(560, 68, '_menu_item_object', 'page'),
(561, 68, '_menu_item_target', ''),
(562, 68, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(563, 68, '_menu_item_xfn', ''),
(564, 68, '_menu_item_url', ''),
(602, 73, '_menu_item_type', 'post_type'),
(603, 73, '_menu_item_menu_item_parent', '0'),
(604, 73, '_menu_item_object_id', '9'),
(605, 73, '_menu_item_object', 'page'),
(606, 73, '_menu_item_target', ''),
(607, 73, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(608, 73, '_menu_item_xfn', ''),
(609, 73, '_menu_item_url', ''),
(647, 78, '_menu_item_type', 'post_type'),
(648, 78, '_menu_item_menu_item_parent', '0'),
(649, 78, '_menu_item_object_id', '7'),
(650, 78, '_menu_item_object', 'page'),
(651, 78, '_menu_item_target', ''),
(652, 78, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(653, 78, '_menu_item_xfn', ''),
(654, 78, '_menu_item_url', ''),
(656, 79, '_menu_item_type', 'post_type'),
(657, 79, '_menu_item_menu_item_parent', '0'),
(658, 79, '_menu_item_object_id', '5'),
(659, 79, '_menu_item_object', 'page'),
(660, 79, '_menu_item_target', ''),
(661, 79, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(662, 79, '_menu_item_xfn', ''),
(663, 79, '_menu_item_url', ''),
(819, 106, '_menu_item_type', 'post_type'),
(820, 106, '_menu_item_menu_item_parent', '68'),
(821, 106, '_menu_item_object_id', '58'),
(822, 106, '_menu_item_object', 'page'),
(823, 106, '_menu_item_target', ''),
(824, 106, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(825, 106, '_menu_item_xfn', ''),
(826, 106, '_menu_item_url', ''),
(828, 107, '_menu_item_type', 'post_type'),
(829, 107, '_menu_item_menu_item_parent', '68'),
(830, 107, '_menu_item_object_id', '55'),
(831, 107, '_menu_item_object', 'page'),
(832, 107, '_menu_item_target', ''),
(833, 107, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(834, 107, '_menu_item_xfn', ''),
(835, 107, '_menu_item_url', ''),
(837, 108, '_menu_item_type', 'post_type'),
(838, 108, '_menu_item_menu_item_parent', '68'),
(839, 108, '_menu_item_object_id', '52'),
(840, 108, '_menu_item_object', 'page'),
(841, 108, '_menu_item_target', ''),
(842, 108, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(843, 108, '_menu_item_xfn', ''),
(844, 108, '_menu_item_url', ''),
(846, 109, '_menu_item_type', 'post_type'),
(847, 109, '_menu_item_menu_item_parent', '68'),
(848, 109, '_menu_item_object_id', '49'),
(849, 109, '_menu_item_object', 'page'),
(850, 109, '_menu_item_target', ''),
(851, 109, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(852, 109, '_menu_item_xfn', ''),
(853, 109, '_menu_item_url', ''),
(855, 110, '_menu_item_type', 'post_type'),
(856, 110, '_menu_item_menu_item_parent', '73'),
(857, 110, '_menu_item_object_id', '9'),
(858, 110, '_menu_item_object', 'page'),
(859, 110, '_menu_item_target', ''),
(860, 110, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(861, 110, '_menu_item_xfn', ''),
(862, 110, '_menu_item_url', ''),
(864, 111, '_menu_item_type', 'post_type'),
(865, 111, '_menu_item_menu_item_parent', '73'),
(866, 111, '_menu_item_object_id', '23'),
(867, 111, '_menu_item_object', 'page'),
(868, 111, '_menu_item_target', ''),
(869, 111, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(870, 111, '_menu_item_xfn', ''),
(871, 111, '_menu_item_url', ''),
(873, 112, '_menu_item_type', 'post_type'),
(874, 112, '_menu_item_menu_item_parent', '73'),
(875, 112, '_menu_item_object_id', '21'),
(876, 112, '_menu_item_object', 'page'),
(877, 112, '_menu_item_target', ''),
(878, 112, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(879, 112, '_menu_item_xfn', ''),
(880, 112, '_menu_item_url', ''),
(882, 113, '_menu_item_type', 'post_type'),
(883, 113, '_menu_item_menu_item_parent', '73'),
(884, 113, '_menu_item_object_id', '19'),
(885, 113, '_menu_item_object', 'page'),
(886, 113, '_menu_item_target', ''),
(887, 113, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(888, 113, '_menu_item_xfn', ''),
(889, 113, '_menu_item_url', ''),
(891, 114, '_menu_item_type', 'post_type'),
(892, 114, '_menu_item_menu_item_parent', '73'),
(893, 114, '_menu_item_object_id', '17'),
(894, 114, '_menu_item_object', 'page'),
(895, 114, '_menu_item_target', ''),
(896, 114, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(897, 114, '_menu_item_xfn', ''),
(898, 114, '_menu_item_url', ''),
(900, 115, 'widget_theme', 'etsyblog'),
(1241, 173, '_form', '<p>Your Name (required)<br />\n    [text* your-name] </p>\n\n<p>Your Email (required)<br />\n    [email* your-email] </p>\n\n<p>Subject<br />\n    [text your-subject] </p>\n\n<p>Your Message<br />\n    [textarea your-message] </p>\n\n<p>[submit "Send"]</p>'),
(1242, 173, '_mail', 'a:7:{s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:182:"From: [your-name] <[your-email]>\nSubject: [your-subject]\n\nMessage Body:\n[your-message]\n\n--\nThis e-mail was sent from a contact form on Etsy (http://192.168.1.251:8081/artfill-v2/blog)";s:9:"recipient";s:21:"sankar@teamtweaks.com";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";i:0;}'),
(1243, 173, '_mail_2', 'a:8:{s:6:"active";b:0;s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:124:"Message Body:\n[your-message]\n\n--\nThis e-mail was sent from a contact form on Etsy (http://192.168.1.251:8081/artfill-v2/blog)";s:9:"recipient";s:12:"[your-email]";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";i:0;}'),
(1244, 173, '_messages', 'a:6:{s:12:"mail_sent_ok";s:43:"Your message was sent successfully. Thanks.";s:12:"mail_sent_ng";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:16:"validation_error";s:74:"Validation errors occurred. Please confirm the fields and submit it again.";s:4:"spam";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:12:"accept_terms";s:35:"Please accept the terms to proceed.";s:16:"invalid_required";s:31:"Please fill the required field.";}'),
(1245, 173, '_additional_settings', ''),
(1246, 173, '_locale', 'en_US'),
(1445, 227, '_edit_lock', '1439284777:1'),
(1446, 227, '_edit_last', '1'),
(1449, 227, 'post-option-sidebar-template', 'right-sidebar'),
(1450, 227, 'post-option-choose-left-sidebar', 'sidebar'),
(1451, 227, 'post-option-choose-right-sidebar', 'sidebar'),
(1452, 227, 'post-option-blog-header-title', ''),
(1453, 227, 'post-option-blog-header-caption', ''),
(1454, 227, 'post-option-author-info-enabled', 'Yes'),
(1455, 227, 'post-option-social-enabled', 'Yes'),
(1456, 227, 'post-option-thumbnail-types', 'Image'),
(1457, 227, 'post-option-thumbnail-video', ''),
(1458, 227, 'post-option-thumbnail-xml', '<slider-item></slider-item>'),
(1459, 227, 'post-option-thumbnail-html5-video', ''),
(1460, 227, 'post-option-inside-thumbnail-types', 'Image'),
(1461, 227, 'post-option-inside-thumbnial-image', ''),
(1462, 227, 'post-option-inside-thumbnail-video', ''),
(1463, 227, 'post-option-inside-thumbnail-xml', '<slider-item></slider-item>'),
(1464, 227, 'post-option-inside-thumbnail-html5-video', ''),
(1466, 233, '_edit_lock', '1439284777:1'),
(1467, 233, '_edit_last', '1'),
(1471, 233, 'post-option-sidebar-template', 'both-sidebar'),
(1472, 233, 'post-option-choose-left-sidebar', 'sidebar'),
(1473, 233, 'post-option-choose-right-sidebar', 'sidebar'),
(1474, 233, 'post-option-blog-header-title', 'joy-shopping'),
(1475, 233, 'post-option-blog-header-caption', ''),
(1476, 233, 'post-option-author-info-enabled', 'Yes'),
(1477, 233, 'post-option-social-enabled', 'Yes'),
(1478, 233, 'post-option-thumbnail-types', 'Image'),
(1479, 233, 'post-option-thumbnail-video', ''),
(1480, 233, 'post-option-thumbnail-xml', '<slider-item></slider-item>'),
(1481, 233, 'post-option-thumbnail-html5-video', ''),
(1482, 233, 'post-option-inside-thumbnail-types', 'Image'),
(1483, 233, 'post-option-inside-thumbnial-image', '239'),
(1484, 233, 'post-option-inside-thumbnail-video', ''),
(1485, 233, 'post-option-inside-thumbnail-xml', '<slider-item></slider-item>'),
(1486, 233, 'post-option-inside-thumbnail-html5-video', ''),
(1507, 246, '_edit_last', '1'),
(1508, 246, '_edit_lock', '1439286030:1'),
(1511, 246, 'post-option-sidebar-template', 'right-sidebar'),
(1512, 246, 'post-option-choose-left-sidebar', 'sidebar'),
(1513, 246, 'post-option-choose-right-sidebar', 'sidebar'),
(1514, 246, 'post-option-blog-header-title', ''),
(1515, 246, 'post-option-blog-header-caption', ''),
(1516, 246, 'post-option-author-info-enabled', 'Yes'),
(1517, 246, 'post-option-social-enabled', 'Yes'),
(1518, 246, 'post-option-thumbnail-types', 'Image'),
(1519, 246, 'post-option-thumbnail-video', ''),
(1520, 246, 'post-option-thumbnail-xml', '<slider-item></slider-item>'),
(1521, 246, 'post-option-thumbnail-html5-video', ''),
(1522, 246, 'post-option-inside-thumbnail-types', 'Image'),
(1523, 246, 'post-option-inside-thumbnial-image', ''),
(1524, 246, 'post-option-inside-thumbnail-video', ''),
(1525, 246, 'post-option-inside-thumbnail-xml', '<slider-item></slider-item>'),
(1526, 246, 'post-option-inside-thumbnail-html5-video', ''),
(1543, 257, '_wp_attached_file', '2014/05/sh2-620x245.jpg'),
(1544, 257, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:620;s:6:"height";i:245;s:4:"file";s:23:"2014/05/sh2-620x245.jpg";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:23:"sh2-620x245-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:23:"sh2-620x245-300x118.jpg";s:5:"width";i:300;s:6:"height";i:118;s:9:"mime-type";s:10:"image/jpeg";}s:7:"150x150";a:3:{s:4:"file";s:23:"sh2-620x245-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;}s:7:"440x330";a:3:{s:4:"file";s:23:"sh2-620x245-440x330.jpg";s:5:"width";i:440;s:6:"height";i:330;}s:7:"400x400";a:3:{s:4:"file";s:23:"sh2-620x245-400x400.jpg";s:5:"width";i:400;s:6:"height";i:400;}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(1545, 246, '_thumbnail_id', '257'),
(1548, 258, '_wp_attached_file', '2015/08/logo.png'),
(1549, 258, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:95;s:6:"height";i:45;s:4:"file";s:16:"2015/08/logo.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(1550, 259, '_edit_last', '1'),
(1551, 259, '_edit_lock', '1439459827:1'),
(1552, 259, '_wp_page_template', 'default'),
(1553, 259, 'page-option-item-xml', '<item-tag><Blog><size>element1-1</size><icon-class></icon-class><header></header><read-the-blog>None</read-the-blog><item-size>1/4 Blog Widget</item-size><blog-type>Normal</blog-type><category>All</category><show-thumbnail>Yes</show-thumbnail><num-fetch>9</num-fetch><num-excerpt>285</num-excerpt><show-full-blog-post>No</show-full-blog-post><pagination>Yes</pagination><offset></offset><orderby>date</orderby><order>desc</order><item-margin>40</item-margin></Blog></item-tag>'),
(1554, 259, 'page-option-sidebar-template', 'right-sidebar'),
(1555, 259, 'page-option-choose-left-sidebar', 'sidebar'),
(1556, 259, 'page-option-choose-right-sidebar', 'sidebar'),
(1557, 259, 'page-option-caption', ''),
(1558, 259, 'page-option-show-content', 'Yes'),
(1559, 259, 'page-option-top-slider-types', 'Title'),
(1560, 259, 'page-option-layer-slider-id', '1'),
(1561, 259, 'page-option-top-slider-xml', '<slider-item></slider-item>'),
(1562, 259, 'page-option-enable-bottom-slider', 'No'),
(1563, 259, 'page-option-under-slider-title', ''),
(1564, 259, 'page-option-under-slider-caption', ''),
(1565, 259, 'page-option-under-slider-button-text', ''),
(1566, 259, 'page-option-under-slider-button-link', '');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_posts`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=261 ;

--
-- Dumping data for table `artfill_sb_posts`
--

INSERT INTO `artfill_sb_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(48, 1, '2014-03-18 09:36:12', '2014-03-18 09:36:12', '', 'About', '', 'publish', 'closed', 'open', '', 'about', '', '', '2014-03-18 09:36:12', '2014-03-18 09:36:12', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=48', 2, 'nav_menu_item', '', 0),
(50, 1, '2014-03-18 09:36:13', '2014-03-18 09:36:13', '', 'Contact', '', 'publish', 'closed', 'open', '', 'contact', '', '', '2014-03-18 09:36:13', '2014-03-18 09:36:13', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=50', 3, 'nav_menu_item', '', 0),
(53, 1, '2014-03-18 09:36:12', '2014-03-18 09:36:12', '', 'Blog', '', 'publish', 'closed', 'open', '', 'blog', '', '', '2014-03-18 09:36:12', '2014-03-18 09:36:12', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=53', 1, 'nav_menu_item', '', 0),
(56, 1, '2014-03-18 09:36:13', '2014-03-18 09:36:13', '', 'Pages', '', 'publish', 'closed', 'open', '', 'pages', '', '', '2014-03-18 09:36:13', '2014-03-18 09:36:13', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=56', 4, 'nav_menu_item', '', 0),
(59, 1, '2014-03-18 09:36:16', '2014-03-18 09:36:16', '', 'Press', '', 'publish', 'closed', 'open', '', 'press', '', '', '2014-03-18 09:36:16', '2014-03-18 09:36:16', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=59', 5, 'nav_menu_item', '', 0),
(61, 1, '2014-03-18 09:36:17', '2014-03-18 09:36:17', '', 'Developers', '', 'publish', 'closed', 'open', '', 'developers', '', '', '2014-03-18 09:36:17', '2014-03-18 09:36:17', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=61', 6, 'nav_menu_item', '', 0),
(62, 1, '2014-03-18 09:36:17', '2014-03-18 09:36:17', '', 'Careers', '', 'publish', 'closed', 'open', '', 'careers', '', '', '2014-03-18 09:36:17', '2014-03-18 09:36:17', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=62', 7, 'nav_menu_item', '', 0),
(63, 1, '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 'Terms', '', 'publish', 'closed', 'open', '', 'terms', '', '', '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=63', 8, 'nav_menu_item', '', 0),
(64, 1, '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 'Privacy', '', 'publish', 'closed', 'open', '', 'privacy', '', '', '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=64', 9, 'nav_menu_item', '', 0),
(65, 1, '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 'Copyright', '', 'publish', 'closed', 'open', '', 'copyright', '', '', '2014-03-18 09:36:18', '2014-03-18 09:36:18', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=65', 10, 'nav_menu_item', '', 0),
(66, 1, '2014-03-18 09:42:47', '2014-03-18 09:42:47', ' ', '', '', 'publish', 'closed', 'open', '', '66', '', '', '2014-03-19 11:14:29', '2014-03-19 11:14:29', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=66', 15, 'nav_menu_item', '', 0),
(67, 1, '2014-03-18 09:42:45', '2014-03-18 09:42:45', ' ', '', '', 'publish', 'closed', 'open', '', '67', '', '', '2014-03-19 11:14:29', '2014-03-19 11:14:29', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=67', 14, 'nav_menu_item', '', 0),
(68, 1, '2014-03-18 09:42:38', '2014-03-18 09:42:38', ' ', '', '', 'publish', 'closed', 'open', '', '68', '', '', '2014-03-19 11:14:24', '2014-03-19 11:14:24', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=68', 9, 'nav_menu_item', '', 0),
(73, 1, '2014-03-18 09:42:33', '2014-03-18 09:42:33', ' ', '', '', 'publish', 'closed', 'open', '', '73', '', '', '2014-03-19 11:14:21', '2014-03-19 11:14:21', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=73', 3, 'nav_menu_item', '', 0),
(78, 1, '2014-03-18 09:42:32', '2014-03-18 09:42:32', ' ', '', '', 'publish', 'closed', 'open', '', '78', '', '', '2014-03-19 11:14:21', '2014-03-19 11:14:21', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=78', 2, 'nav_menu_item', '', 0),
(79, 1, '2014-03-18 09:42:30', '2014-03-18 09:42:30', ' ', '', '', 'publish', 'closed', 'open', '', '79', '', '', '2014-03-19 11:14:21', '2014-03-19 11:14:21', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=79', 1, 'nav_menu_item', '', 0),
(92, 1, '2014-03-19 07:26:11', '2014-03-19 07:26:11', '[wysija_page]', 'Subscription confirmation', '', 'publish', 'closed', 'open', '', 'subscriptions', '', '', '2014-03-19 07:26:11', '2014-03-19 07:26:11', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?wysijap=subscriptions', 0, 'wysijap', '', 0),
(106, 1, '2014-03-19 11:12:55', '2014-03-19 11:12:55', ' ', '', '', 'publish', 'closed', 'open', '', '106', '', '', '2014-03-19 11:14:25', '2014-03-19 11:14:25', '', 11, 'http://192.168.1.251:8081/artfill-v2/blog/?p=106', 10, 'nav_menu_item', '', 0),
(107, 1, '2014-03-19 11:14:25', '2014-03-19 11:14:25', ' ', '', '', 'publish', 'closed', 'open', '', '107', '', '', '2014-03-19 11:14:25', '2014-03-19 11:14:25', '', 11, 'http://192.168.1.251:8081/artfill-v2/blog/?p=107', 11, 'nav_menu_item', '', 0),
(108, 1, '2014-03-19 11:14:26', '2014-03-19 11:14:26', ' ', '', '', 'publish', 'closed', 'open', '', '108', '', '', '2014-03-19 11:14:26', '2014-03-19 11:14:26', '', 11, 'http://192.168.1.251:8081/artfill-v2/blog/?p=108', 12, 'nav_menu_item', '', 0),
(109, 1, '2014-03-19 11:14:27', '2014-03-19 11:14:27', ' ', '', '', 'publish', 'closed', 'open', '', '109', '', '', '2014-03-19 11:14:27', '2014-03-19 11:14:27', '', 11, 'http://192.168.1.251:8081/artfill-v2/blog/?p=109', 13, 'nav_menu_item', '', 0),
(110, 1, '2014-03-19 11:14:22', '2014-03-19 11:14:22', ' ', '', '', 'publish', 'closed', 'open', '', '110', '', '', '2014-03-19 11:14:22', '2014-03-19 11:14:22', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=110', 4, 'nav_menu_item', '', 0),
(111, 1, '2014-03-19 11:14:22', '2014-03-19 11:14:22', ' ', '', '', 'publish', 'closed', 'open', '', '111', '', '', '2014-03-19 11:14:22', '2014-03-19 11:14:22', '', 9, 'http://192.168.1.251:8081/artfill-v2/blog/?p=111', 5, 'nav_menu_item', '', 0),
(112, 1, '2014-03-19 11:14:23', '2014-03-19 11:14:23', ' ', '', '', 'publish', 'closed', 'open', '', '112', '', '', '2014-03-19 11:14:23', '2014-03-19 11:14:23', '', 9, 'http://192.168.1.251:8081/artfill-v2/blog/?p=112', 6, 'nav_menu_item', '', 0),
(113, 1, '2014-03-19 11:14:23', '2014-03-19 11:14:23', ' ', '', '', 'publish', 'closed', 'open', '', '113', '', '', '2014-03-19 11:14:23', '2014-03-19 11:14:23', '', 9, 'http://192.168.1.251:8081/artfill-v2/blog/?p=113', 7, 'nav_menu_item', '', 0),
(114, 1, '2014-03-19 11:14:24', '2014-03-19 11:14:24', ' ', '', '', 'publish', 'closed', 'open', '', '114', '', '', '2014-03-19 11:14:24', '2014-03-19 11:14:24', '', 9, 'http://192.168.1.251:8081/artfill-v2/blog/?p=114', 8, 'nav_menu_item', '', 0),
(115, 1, '2014-03-19 11:26:25', '2014-03-19 11:26:25', 'a:9:{s:19:"wp_inactive_widgets";a:0:{}s:15:"custom-sidebar0";a:0:{}s:15:"custom-sidebar1";a:1:{i:0;s:10:"nav_menu-4";}s:15:"custom-sidebar2";a:0:{}s:15:"custom-sidebar3";a:0:{}s:15:"custom-sidebar4";a:0:{}s:15:"custom-sidebar5";a:0:{}s:15:"custom-sidebar6";a:0:{}s:15:"custom-sidebar7";a:4:{i:0;s:8:"search-3";i:1;s:13:"recent_work-3";i:2;s:21:"social-icons-widget-3";i:3;s:6:"text-3";}}', 'Default', '', 'publish', 'closed', 'open', '', 'default', '', '', '2014-03-19 11:26:25', '2014-03-19 11:26:25', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/default/', 0, 'widget_set', '', 0),
(173, 1, '2014-03-20 13:21:20', '2014-03-20 13:21:20', '<p>Your Name (required)<br />\n    [text* your-name] </p>\n\n<p>Your Email (required)<br />\n    [email* your-email] </p>\n\n<p>Subject<br />\n    [text your-subject] </p>\n\n<p>Your Message<br />\n    [textarea your-message] </p>\n\n<p>[submit "Send"]</p>\n[your-subject]\n[your-name] <[your-email]>\nFrom: [your-name] <[your-email]>\nSubject: [your-subject]\n\nMessage Body:\n[your-message]\n\n--\nThis e-mail was sent from a contact form on Etsy (http://192.168.1.251:8081/artfill-v2/blog)\nsankar@teamtweaks.com\n\n\n0\n\n[your-subject]\n[your-name] <[your-email]>\nMessage Body:\n[your-message]\n\n--\nThis e-mail was sent from a contact form on Etsy (http://192.168.1.251:8081/artfill-v2/blog)\n[your-email]\n\n\n0\nYour message was sent successfully. Thanks.\nFailed to send your message. Please try later or contact the administrator by another method.\nValidation errors occurred. Please confirm the fields and submit it again.\nFailed to send your message. Please try later or contact the administrator by another method.\nPlease accept the terms to proceed.\nPlease fill the required field.', 'Contact form 1', '', 'publish', 'open', 'open', '', 'contact-form-1', '', '', '2014-03-20 13:21:20', '2014-03-20 13:21:20', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?post_type=wpcf7_contact_form&p=173', 0, 'wpcf7_contact_form', '', 0),
(227, 6, '2014-05-16 14:42:37', '2014-05-16 14:42:37', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\n&nbsp;\r\n\r\n&nbsp;', 'Test post for featured', '', 'publish', 'open', 'open', '', 'test-post-for-featured', '', '', '2015-08-11 09:20:29', '2015-08-11 09:20:29', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=227', 0, 'post', '', 0),
(228, 6, '2014-05-16 14:42:37', '2014-05-16 14:42:37', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, nisl sed pretium laoreet, felis eros aliquam urna Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\n&nbsp;\r\n\r\n&nbsp;', 'Test post for featured', '', 'inherit', 'open', 'open', '', '227-revision-v1', '', '', '2014-05-16 14:42:37', '2014-05-16 14:42:37', '', 227, 'http://192.168.1.251:8081/artfill-v2/blog/227-revision-v1/', 0, 'revision', '', 0),
(233, 8, '2014-05-20 12:15:41', '2014-05-20 12:15:41', 'Every week I bring in a new bunch of flowers for my desk. Pausing throughout the day to admire the color, form and texture of nature''s artistry makes me feel uplifted, refreshed and alive.', 'week end post.', '', 'publish', 'open', 'open', '', 'post-from-joy-shopping', '', '', '2015-08-11 09:20:15', '2015-08-11 09:20:15', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=233', 0, 'post', '', 0),
(235, 8, '2014-05-20 12:13:08', '2014-05-20 12:13:08', '<strong>Lorem Ipsum</strong>Â is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'post from joy-shopping', '', 'inherit', 'open', 'open', '', '233-revision-v1', '', '', '2014-05-20 12:13:08', '2014-05-20 12:13:08', '', 233, 'http://192.168.1.251:8081/artfill-v2/blog/233-revision-v1/', 0, 'revision', '', 0),
(244, 8, '2014-05-20 14:04:59', '2014-05-20 14:04:59', 'Every week I bring in a new bunch of flowers for my desk. Pausing throughout the day to admire the color, form and texture of nature''s artistry makes me feel uplifted, refreshed and alive.', 'post from joy-shopping', '', 'inherit', 'open', 'open', '', '233-revision-v1', '', '', '2014-05-20 14:04:59', '2014-05-20 14:04:59', '', 233, 'http://192.168.1.251:8081/artfill-v2/blog/233-revision-v1/', 0, 'revision', '', 0),
(245, 8, '2014-05-20 14:06:03', '2014-05-20 14:06:03', 'Every week I bring in a new bunch of flowers for my desk. Pausing throughout the day to admire the color, form and texture of nature''s artistry makes me feel uplifted, refreshed and alive.', 'joy-shopping', '', 'inherit', 'open', 'open', '', '233-autosave-v1', '', '', '2014-05-20 14:06:03', '2014-05-20 14:06:03', '', 233, 'http://192.168.1.251:8081/artfill-v2/blog/233-autosave-v1/', 0, 'revision', '', 0),
(246, 9, '2014-05-20 14:16:34', '2014-05-20 14:16:34', 'I am very fortunate to have discovered exactly how I want to spend my days.', 'Toujours', '', 'publish', 'open', 'open', '', 'toujours', '', '', '2015-08-11 09:37:46', '2015-08-11 09:37:46', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?p=246', 0, 'post', '', 0),
(247, 8, '2014-05-20 14:09:24', '2014-05-20 14:09:24', 'Every week I bring in a new bunch of flowers for my desk. Pausing throughout the day to admire the color, form and texture of nature''s artistry makes me feel uplifted, refreshed and alive.', 'week end post.', '', 'inherit', 'open', 'open', '', '233-revision-v1', '', '', '2014-05-20 14:09:24', '2014-05-20 14:09:24', '', 233, 'http://192.168.1.251:8081/artfill-v2/blog/233-revision-v1/', 0, 'revision', '', 0),
(248, 9, '2014-05-20 14:16:34', '2014-05-20 14:16:34', 'I am very fortunate to have discovered exactly how I want to spend my days.', 'Toujours', '', 'inherit', 'open', 'open', '', '246-revision-v1', '', '', '2014-05-20 14:16:34', '2014-05-20 14:16:34', '', 246, 'http://192.168.1.251:8081/artfill-v2/blog/246-revision-v1/', 0, 'revision', '', 0),
(257, 1, '2015-08-11 09:37:32', '2015-08-11 09:37:32', '', 'sh2-620x245', '', 'inherit', 'open', 'open', '', 'sh2-620x245', '', '', '2015-08-11 09:37:32', '2015-08-11 09:37:32', '', 246, 'http://192.168.1.251:8081/artfill-v2/blog/wp-content/uploads/2014/05/sh2-620x245.jpg', 0, 'attachment', 'image/jpeg', 0),
(258, 1, '2015-08-11 09:42:50', '2015-08-11 09:42:50', '', 'logo', '', 'inherit', 'open', 'open', '', 'logo', '', '', '2015-08-11 09:42:50', '2015-08-11 09:42:50', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/wp-content/uploads/2015/08/logo.png', 0, 'attachment', 'image/png', 0),
(259, 1, '2015-08-13 09:54:56', '2015-08-13 09:54:56', '', 'Home', '', 'publish', 'open', 'open', '', 'home', '', '', '2015-08-13 09:55:42', '2015-08-13 09:55:42', '', 0, 'http://192.168.1.251:8081/artfill-v2/blog/?page_id=259', 0, 'page', '', 0),
(260, 1, '2015-08-13 09:54:56', '2015-08-13 09:54:56', '', 'Home', '', 'inherit', 'open', 'open', '', '259-revision-v1', '', '', '2015-08-13 09:54:56', '2015-08-13 09:54:56', '', 259, 'http://192.168.1.251:8081/artfill-v2/blog/259-revision-v1/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_shiba_termmeta`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_shiba_termmeta` (
  `meta_id` bigint(20) NOT NULL,
  `shiba_term_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_shiba_termmeta`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_swp_testimonial`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_swp_testimonial` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  `company` varchar(255) NOT NULL,
  `website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_swp_testimonial`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_terms`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  `term_order` int(4) DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_terms`
--

INSERT INTO `artfill_sb_terms` (`term_id`, `name`, `slug`, `term_group`, `term_order`) VALUES
(1, 'Uncategorized', 'uncategorized', 0, 0),
(2, 'footer menu', 'footer-menu', 0, 0),
(3, 'blogmenu', 'blogmenu', 0, 0),
(4, 'Featured Shop', 'featured-shop', 0, 0),
(5, 'Editor''s Picks', 'editors-picks', 0, 0),
(6, 'DIY Projects', 'diy-projects', 0, 0),
(7, 'Guest Curator', 'guest-curator', 0, 0),
(8, 'Editions', 'editions', 0, 0),
(9, 't1', 't1', 0, 0),
(10, 'Fea', 'fea', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_term_relationships`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_term_relationships`
--

INSERT INTO `artfill_sb_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(48, 2, 0),
(50, 2, 0),
(53, 2, 0),
(56, 2, 0),
(59, 2, 0),
(61, 2, 0),
(62, 2, 0),
(63, 2, 0),
(64, 2, 0),
(65, 2, 0),
(66, 3, 0),
(67, 3, 0),
(68, 3, 0),
(73, 3, 0),
(78, 3, 0),
(79, 3, 0),
(106, 3, 0),
(107, 3, 0),
(108, 3, 0),
(109, 3, 0),
(110, 3, 0),
(111, 3, 0),
(112, 3, 0),
(113, 3, 0),
(114, 3, 0),
(227, 4, 0),
(227, 10, 0),
(233, 8, 0),
(233, 10, 0),
(246, 6, 0),
(246, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artfill_sb_term_taxonomy`
--

INSERT INTO `artfill_sb_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 0),
(2, 2, 'nav_menu', '', 0, 10),
(3, 3, 'nav_menu', '', 0, 15),
(4, 4, 'post_tag', '', 0, 1),
(5, 5, 'post_tag', '', 0, 0),
(6, 6, 'post_tag', '', 0, 1),
(7, 7, 'post_tag', '', 0, 0),
(8, 8, 'post_tag', '', 0, 1),
(9, 9, 'testimonial-category', '', 0, 0),
(10, 10, 'category', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_usermeta`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=324 ;

--
-- Dumping data for table `artfill_sb_usermeta`
--

INSERT INTO `artfill_sb_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'etsyblog'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'artfill_sb_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'artfill_sb_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media,wp360_revisions,wp360_locks'),
(13, 1, 'show_welcome_panel', '0'),
(14, 1, 'artfill_sb_dashboard_quick_press_last_post_id', '253'),
(15, 1, 'managenav-menuscolumnshidden', 'a:4:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";}'),
(16, 1, 'metaboxhidden_nav-menus', 'a:10:{i:0;s:8:"add-post";i:1;s:13:"add-portfolio";i:2;s:11:"add-package";i:3;s:13:"add-personnal";i:4;s:12:"add-post_tag";i:5;s:22:"add-portfolio-category";i:6;s:17:"add-portfolio-tag";i:7;s:20:"add-package-category";i:8;s:15:"add-package-tag";i:9;s:22:"add-personnal-category";}'),
(17, 1, 'nav_menu_recently_edited', '2'),
(18, 1, 'artfill_sb_user-settings', 'libraryContent=browse&editor=html&mfold=o'),
(19, 1, 'artfill_sb_user-settings-time', '1400047172'),
(20, 1, 'wysija_pref', 'YTowOnt9'),
(21, 1, 'closedpostboxes_post', 'a:0:{}'),
(22, 1, 'metaboxhidden_post', 'a:1:{i:0;s:7:"slugdiv";}'),
(23, 1, 'meta-box-order_post', 'a:3:{s:4:"side";s:51:"submitdiv,categorydiv,tagsdiv-post_tag,postimagediv";s:6:"normal";s:95:"post-option,postexcerpt,trackbacksdiv,postcustom,commentstatusdiv,commentsdiv,slugdiv,authordiv";s:8:"advanced";s:0:"";}'),
(24, 1, 'screen_layout_post', '2'),
(25, 1, 'closedpostboxes_dashboard', 'a:3:{i:0;s:19:"dashboard_right_now";i:1;s:21:"dashboard_quick_press";i:2;s:17:"dashboard_primary";}'),
(26, 1, 'metaboxhidden_dashboard', 'a:0:{}'),
(27, 3, 'first_name', ''),
(28, 1, 'layerslider_help_wp_pointer', '1'),
(29, 18, 'first_name', ''),
(30, 18, 'last_name', ''),
(31, 18, 'nickname', 'usha'),
(32, 18, 'description', ''),
(33, 18, 'rich_editing', 'true'),
(34, 18, 'comment_shortcuts', 'false'),
(35, 18, 'admin_color', 'fresh'),
(36, 18, 'use_ssl', '0'),
(37, 18, 'show_admin_bar_front', 'true'),
(38, 18, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(39, 18, 'artfill_sb_user_level', '0'),
(40, 19, 'first_name', ''),
(41, 19, 'last_name', ''),
(42, 19, 'nickname', 'ganesh1986'),
(43, 19, 'description', ''),
(44, 19, 'rich_editing', 'true'),
(45, 19, 'comment_shortcuts', 'false'),
(46, 19, 'admin_color', 'fresh'),
(47, 19, 'use_ssl', '0'),
(48, 19, 'show_admin_bar_front', 'true'),
(49, 19, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(50, 19, 'artfill_sb_user_level', '0'),
(51, 20, 'first_name', ''),
(52, 20, 'last_name', ''),
(53, 20, 'nickname', 'kumar2015'),
(54, 20, 'description', ''),
(55, 20, 'rich_editing', 'true'),
(56, 20, 'comment_shortcuts', 'false'),
(57, 20, 'admin_color', 'fresh'),
(58, 20, 'use_ssl', '0'),
(59, 20, 'show_admin_bar_front', 'true'),
(60, 20, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(61, 20, 'artfill_sb_user_level', '0'),
(62, 21, 'first_name', ''),
(63, 21, 'last_name', ''),
(64, 21, 'nickname', 'jimmy'),
(65, 21, 'description', ''),
(66, 21, 'rich_editing', 'true'),
(67, 21, 'comment_shortcuts', 'false'),
(68, 21, 'admin_color', 'fresh'),
(69, 21, 'use_ssl', '0'),
(70, 21, 'show_admin_bar_front', 'true'),
(71, 21, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(72, 21, 'artfill_sb_user_level', '0'),
(73, 22, 'first_name', ''),
(74, 22, 'last_name', ''),
(75, 22, 'nickname', 'ashley'),
(76, 22, 'description', ''),
(77, 22, 'rich_editing', 'true'),
(78, 22, 'comment_shortcuts', 'false'),
(79, 22, 'admin_color', 'fresh'),
(80, 22, 'use_ssl', '0'),
(81, 22, 'show_admin_bar_front', 'true'),
(82, 22, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(83, 22, 'artfill_sb_user_level', '0'),
(84, 23, 'first_name', ''),
(85, 23, 'last_name', ''),
(86, 23, 'nickname', 'asdfasd'),
(87, 23, 'description', ''),
(88, 23, 'rich_editing', 'true'),
(89, 23, 'comment_shortcuts', 'false'),
(90, 23, 'admin_color', 'fresh'),
(91, 23, 'use_ssl', '0'),
(92, 23, 'show_admin_bar_front', 'true'),
(93, 23, 'artfill_sb_capabilities', 'a:1:{s:6:"editor";b:1;}'),
(94, 23, 'artfill_sb_user_level', '7'),
(95, 24, 'first_name', ''),
(96, 24, 'last_name', ''),
(97, 24, 'nickname', 'KumarTallyro'),
(98, 24, 'description', ''),
(99, 24, 'rich_editing', 'true'),
(100, 24, 'comment_shortcuts', 'false'),
(101, 24, 'admin_color', 'fresh'),
(102, 24, 'use_ssl', '0'),
(103, 24, 'show_admin_bar_front', 'true'),
(104, 24, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(105, 24, 'artfill_sb_user_level', '0'),
(106, 25, 'first_name', ''),
(107, 25, 'last_name', ''),
(108, 25, 'nickname', 'sofia1990'),
(109, 25, 'description', ''),
(110, 25, 'rich_editing', 'true'),
(111, 25, 'comment_shortcuts', 'false'),
(112, 25, 'admin_color', 'fresh'),
(113, 25, 'use_ssl', '0'),
(114, 25, 'show_admin_bar_front', 'true'),
(115, 25, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(116, 25, 'artfill_sb_user_level', '0'),
(117, 26, 'first_name', ''),
(118, 26, 'last_name', ''),
(119, 26, 'nickname', 'varathan'),
(120, 26, 'description', ''),
(121, 26, 'rich_editing', 'true'),
(122, 26, 'comment_shortcuts', 'false'),
(123, 26, 'admin_color', 'fresh'),
(124, 26, 'use_ssl', '0'),
(125, 26, 'show_admin_bar_front', 'true'),
(126, 26, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(127, 26, 'artfill_sb_user_level', '0'),
(128, 27, 'first_name', ''),
(129, 27, 'last_name', ''),
(130, 27, 'nickname', 'varthan1234'),
(131, 27, 'description', ''),
(132, 27, 'rich_editing', 'true'),
(133, 27, 'comment_shortcuts', 'false'),
(134, 27, 'admin_color', 'fresh'),
(135, 27, 'use_ssl', '0'),
(136, 27, 'show_admin_bar_front', 'true'),
(137, 27, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(138, 27, 'artfill_sb_user_level', '0'),
(139, 28, 'first_name', ''),
(140, 28, 'last_name', ''),
(141, 28, 'nickname', 'testing2'),
(142, 28, 'description', ''),
(143, 28, 'rich_editing', 'true'),
(144, 28, 'comment_shortcuts', 'false'),
(145, 28, 'admin_color', 'fresh'),
(146, 28, 'use_ssl', '0'),
(147, 28, 'show_admin_bar_front', 'true'),
(148, 28, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(149, 28, 'artfill_sb_user_level', '0'),
(150, 29, 'first_name', ''),
(151, 29, 'last_name', ''),
(152, 29, 'nickname', 'normchk'),
(153, 29, 'description', ''),
(154, 29, 'rich_editing', 'true'),
(155, 29, 'comment_shortcuts', 'false'),
(156, 29, 'admin_color', 'fresh'),
(157, 29, 'use_ssl', '0'),
(158, 29, 'show_admin_bar_front', 'true'),
(159, 29, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(160, 29, 'artfill_sb_user_level', '0'),
(161, 30, 'first_name', ''),
(162, 30, 'last_name', ''),
(163, 30, 'nickname', 'sadkfjhgasdddd'),
(164, 30, 'description', ''),
(165, 30, 'rich_editing', 'true'),
(166, 30, 'comment_shortcuts', 'false'),
(167, 30, 'admin_color', 'fresh'),
(168, 30, 'use_ssl', '0'),
(169, 30, 'show_admin_bar_front', 'true'),
(170, 30, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(171, 30, 'artfill_sb_user_level', '0'),
(172, 31, 'first_name', ''),
(173, 31, 'last_name', ''),
(174, 31, 'nickname', 'rgertsrtdrhthhete'),
(175, 31, 'description', ''),
(176, 31, 'rich_editing', 'true'),
(177, 31, 'comment_shortcuts', 'false'),
(178, 31, 'admin_color', 'fresh'),
(179, 31, 'use_ssl', '0'),
(180, 31, 'show_admin_bar_front', 'true'),
(181, 31, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(182, 31, 'artfill_sb_user_level', '0'),
(183, 32, 'first_name', ''),
(184, 32, 'last_name', ''),
(185, 32, 'nickname', 'lopi'),
(186, 32, 'description', ''),
(187, 32, 'rich_editing', 'true'),
(188, 32, 'comment_shortcuts', 'false'),
(189, 32, 'admin_color', 'fresh'),
(190, 32, 'use_ssl', '0'),
(191, 32, 'show_admin_bar_front', 'true'),
(192, 32, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(193, 32, 'artfill_sb_user_level', '0'),
(194, 33, 'first_name', ''),
(195, 33, 'last_name', ''),
(196, 33, 'nickname', 'saran'),
(197, 33, 'description', ''),
(198, 33, 'rich_editing', 'true'),
(199, 33, 'comment_shortcuts', 'false'),
(200, 33, 'admin_color', 'fresh'),
(201, 33, 'use_ssl', '0'),
(202, 33, 'show_admin_bar_front', 'true'),
(203, 33, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(204, 33, 'artfill_sb_user_level', '0'),
(205, 34, 'first_name', ''),
(206, 34, 'last_name', ''),
(207, 34, 'nickname', 'testaff'),
(208, 34, 'description', ''),
(209, 34, 'rich_editing', 'true'),
(210, 34, 'comment_shortcuts', 'false'),
(211, 34, 'admin_color', 'fresh'),
(212, 34, 'use_ssl', '0'),
(213, 34, 'show_admin_bar_front', 'true'),
(214, 34, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(215, 34, 'artfill_sb_user_level', '0'),
(216, 35, 'first_name', ''),
(217, 35, 'last_name', ''),
(218, 35, 'nickname', 'testaccount'),
(219, 35, 'description', ''),
(220, 35, 'rich_editing', 'true'),
(221, 35, 'comment_shortcuts', 'false'),
(222, 35, 'admin_color', 'fresh'),
(223, 35, 'use_ssl', '0'),
(224, 35, 'show_admin_bar_front', 'true'),
(225, 35, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(226, 35, 'artfill_sb_user_level', '0'),
(227, 36, 'first_name', ''),
(228, 36, 'last_name', ''),
(229, 36, 'nickname', 'naran'),
(230, 36, 'description', ''),
(231, 36, 'rich_editing', 'true'),
(232, 36, 'comment_shortcuts', 'false'),
(233, 36, 'admin_color', 'fresh'),
(234, 36, 'use_ssl', '0'),
(235, 36, 'show_admin_bar_front', 'true'),
(236, 36, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(237, 36, 'artfill_sb_user_level', '0'),
(238, 37, 'first_name', ''),
(239, 37, 'last_name', ''),
(240, 37, 'nickname', 'vinu'),
(241, 37, 'description', ''),
(242, 37, 'rich_editing', 'true'),
(243, 37, 'comment_shortcuts', 'false'),
(244, 37, 'admin_color', 'fresh'),
(245, 37, 'use_ssl', '0'),
(246, 37, 'show_admin_bar_front', 'true'),
(247, 37, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(248, 37, 'artfill_sb_user_level', '0'),
(249, 38, 'first_name', ''),
(250, 38, 'last_name', ''),
(251, 38, 'nickname', 'vijay'),
(252, 38, 'description', ''),
(253, 38, 'rich_editing', 'true'),
(254, 38, 'comment_shortcuts', 'false'),
(255, 38, 'admin_color', 'fresh'),
(256, 38, 'use_ssl', '0'),
(257, 38, 'show_admin_bar_front', 'true'),
(258, 38, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(259, 38, 'artfill_sb_user_level', '0'),
(260, 39, 'first_name', ''),
(261, 39, 'last_name', ''),
(262, 39, 'nickname', 'zzzz'),
(263, 39, 'description', ''),
(264, 39, 'rich_editing', 'true'),
(265, 39, 'comment_shortcuts', 'false'),
(266, 39, 'admin_color', 'fresh'),
(267, 39, 'use_ssl', '0'),
(268, 39, 'show_admin_bar_front', 'true'),
(269, 39, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(270, 39, 'artfill_sb_user_level', '0'),
(271, 40, 'first_name', ''),
(272, 40, 'last_name', ''),
(273, 40, 'nickname', 'j'),
(274, 40, 'description', ''),
(275, 40, 'rich_editing', 'true'),
(276, 40, 'comment_shortcuts', 'false'),
(277, 40, 'admin_color', 'fresh'),
(278, 40, 'use_ssl', '0'),
(279, 40, 'show_admin_bar_front', 'true'),
(280, 40, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(281, 40, 'artfill_sb_user_level', '0'),
(282, 41, 'first_name', ''),
(283, 41, 'last_name', ''),
(284, 41, 'nickname', 'lll'),
(285, 41, 'description', ''),
(286, 41, 'rich_editing', 'true'),
(287, 41, 'comment_shortcuts', 'false'),
(288, 41, 'admin_color', 'fresh'),
(289, 41, 'use_ssl', '0'),
(290, 41, 'show_admin_bar_front', 'true'),
(291, 41, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(292, 41, 'artfill_sb_user_level', '0'),
(293, 42, 'first_name', ''),
(294, 42, 'last_name', ''),
(295, 42, 'nickname', 'ethan'),
(296, 42, 'description', ''),
(297, 42, 'rich_editing', 'true'),
(298, 42, 'comment_shortcuts', 'false'),
(299, 42, 'admin_color', 'fresh'),
(300, 42, 'use_ssl', '0'),
(301, 42, 'show_admin_bar_front', 'true'),
(302, 42, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(303, 42, 'artfill_sb_user_level', '0'),
(304, 2, 'first_name', ''),
(305, 2, 'last_name', ''),
(306, 2, 'nickname', 'gary'),
(307, 2, 'description', ''),
(308, 2, 'rich_editing', 'true'),
(309, 2, 'comment_shortcuts', 'false'),
(310, 2, 'admin_color', 'fresh'),
(311, 2, 'use_ssl', '0'),
(312, 2, 'show_admin_bar_front', 'true'),
(313, 43, 'first_name', ''),
(314, 43, 'last_name', ''),
(315, 43, 'nickname', 'ipsi'),
(316, 43, 'description', ''),
(317, 43, 'rich_editing', 'true'),
(318, 43, 'comment_shortcuts', 'false'),
(319, 43, 'admin_color', 'fresh'),
(320, 43, 'use_ssl', '0'),
(321, 43, 'show_admin_bar_front', 'true'),
(322, 43, 'artfill_sb_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(323, 43, 'artfill_sb_user_level', '0');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_sb_users`
--

CREATE TABLE IF NOT EXISTS `artfill_sb_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `artfill_sb_users`
--

INSERT INTO `artfill_sb_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BHQB9VH/QXo/UL3TO/Wol4ooNFX.uA1', 'artfilladmin', 'johncena.c88@gmail.com', '', '2014-03-18 07:25:21', '', 0, 'artfilladmin'),
(2, 'gary', '$P$Bqt3Jb98DBygGJg.BFdi1gZJ/BULMG0', 'gary', 'gary@teamtweaks.com', '', '2015-05-05 07:41:15', '', 0, 'gary'),
(3, 'selvarajsdfdsg', '$P$B.5.9WLwyM9bBZXAPj4IqtUm8rh8dJ.', 'selvarajsdfdsg', 'selvaraj123gsdgsdgsdg4@casperon.in', '', '2015-07-16 13:14:36', '', 0, 'selvarajsdfdsg'),
(4, 'rko', '$P$BALukXNLaFoVFJPvgrTu4FZ67s2ZVN0', 'rko', 'rko@gmail.com', '', '2015-07-22 06:43:06', '', 0, 'rko'),
(5, 'samy', '$P$BcC1NGRljx.R6X8FrdVjFOeFdB8aE60', 'samy', 'arockiasamy1990@gmail.com', '', '2015-07-25 09:27:12', '', 0, 'samy'),
(6, 'aaaa', '$P$BRHSiEXkR1jrCZjeE5mmMH8LWgvvVW.', 'aaaa', 'aaaa@gmail.com', '', '2015-07-29 05:21:49', '', 0, 'aaaa'),
(7, 'abcd', '$P$BFSP34dL3JRWUAee.kuoWeX4lkCwJV.', 'abcd', 'santha@casperon.in', '', '2015-07-31 05:46:20', '', 0, 'abcd'),
(8, 'dagt436', '$P$BG8.iP/QblxmU9ukq9/4kfcF9R0Qi2/', 'dagt436', 'ghg@gmail.com', '', '2015-07-31 05:53:05', '', 0, 'dagt436'),
(9, 'santha', '$P$BlGvnX9CKsxOsQ03BH.iMUsH7QqmNM/', 'santha', 'santhaece144@gmail.com', '', '2015-07-31 10:46:14', '', 0, 'santha'),
(10, 'santhajhghg', '$P$BA23OkAvmovFe7qMdqoFuceYTs1UF61', 'santhajhghg', 'sachin@gmail.com', '', '2015-07-31 11:09:31', '', 0, 'santhajhghg'),
(11, 'aaa', '$P$B0AZaWSohIxDK.ktMd559UBCw/A/SD1', 'aaa', 'yuy@gmail.com', '', '2015-07-31 11:17:03', '', 0, 'aaa'),
(12, 'abc', '$P$BnwQ0WFSj52JTJY1L2eZAtXZTRT9lY.', 'abc', 'gfhf@gmail.com', '', '2015-07-31 11:19:47', '', 0, 'abc'),
(13, 'aas', '$P$BvPAzoxbR3TQWaOFYJecCEEU.iHVWg/', 'aas', 'aas@gmail.com', '', '2015-07-31 11:21:46', '', 0, 'aas'),
(14, 'Shantha', '$P$Bb01ly46ENhqzUTdacrf5qxmjHgKQJ0', 'shantha', 'santha@yahoo.com', '', '2015-07-31 11:35:54', '', 0, 'Shantha'),
(15, 'rkooo', '$P$BnEvUIUrETdMRUjdQ6mpBzckGSq0sI.', 'rkooo', 'rkoo@gmail.com', '', '2015-07-31 14:33:36', '', 0, 'rkooo'),
(16, 'kpkarupu', '$P$Br8R9kC2GmYMYGnywT8h2HbdOhiVVx.', 'kpkarupu', 'kpkarupu@casperon.in', '', '2015-08-04 13:48:13', '', 0, 'kpkarupu'),
(17, 'shanthi', '$P$BCdwfCZDMsIjevGpZtbmA/QlyYjJ.i.', 'shanthi', 'santha144_r@yahoo.com', '', '2015-08-06 09:27:19', '', 0, 'shanthi'),
(18, 'usha', '$P$BzhjMezZ/OIMncM5Vv5bC/hwZLdqtA0', 'usha', 'santharamachandran144@gmail.com', '', '2015-08-11 12:32:21', '', 0, 'usha'),
(19, 'ganesh1986', '$P$BaoFX.bauxv9R0T02GVWp1DPz63OzG.', 'ganesh1986', 'ganesh@teamtweaks.com', '', '2015-08-12 06:59:09', '', 0, 'ganesh1986'),
(20, 'kumar2015', '$P$Bt0dMuq/PWS1LQMS38bCnWifkFCprk.', 'kumar2015', 'kumar@casperon.in', '', '2015-08-12 10:22:49', '', 0, 'kumar2015'),
(21, 'jimmy', '$P$BMQk.MqMXWFDSPttiVc0O4x/zu8UPF1', 'jimmy', 'jimmy@jimmy.com', '', '2015-08-13 10:04:18', '', 0, 'jimmy'),
(22, 'ashley', '$P$BY/HT0Z4MU6DZ97eYDifXWDy/P1e4L0', 'ashley', 'ashley@teamtweaks.com', '', '2015-08-14 10:33:27', '', 0, 'ashley'),
(23, 'asdfasd', '$P$BYU9S3amYtMQnhMWLsCDGpU2s/bmux/', 'asdfasd', 'sophia@casperon.in', '', '2015-08-14 12:45:15', '', 0, 'asdfasd'),
(24, 'KumarTallyro', '$P$BNqyEetqSm5nAMtxWTK1rJm7yeBtt41', 'kumartallyro', 'tallyrokumar@gmail.cpm', '', '2015-08-17 12:41:15', '', 0, 'KumarTallyro'),
(25, 'sofia1990', '$P$BL03bYuH50YT7tcL3XjmEnOn/jLe3R0', 'sofia1990', 'sofia@casperon.in', '', '2015-08-18 04:48:01', '', 0, 'sofia1990'),
(26, 'varathan', '$P$B6TaoJBO8oxmdjtjWXYJTVNFVpfx1Q0', 'varathan', 'varathan@casperon.in', '', '2015-08-20 05:44:41', '', 0, 'varathan'),
(27, 'varthan1234', '$P$B5km2KyY7nnlmgbcugWceOfL6I50p8.', 'varthan1234', 'varthan1234@teamtweaks.com', '', '2015-08-24 10:54:46', '', 0, 'varthan1234'),
(28, 'testing2', '$P$B3YIW5arCF8.6TICjLKVRas.iTfSss1', 'testing2', 'testing2@gmail.com', '', '2015-08-24 14:46:15', '', 0, 'testing2'),
(29, 'normchk', '$P$B5ibNY0ugOhl0NP/zIxYWRMGP.b5Zt/', 'normchk', 'normchk@gmail.com', '', '2015-08-25 10:48:25', '', 0, 'normchk'),
(30, 'sadkfjhgasdddd', '$P$BPw7NjpX3xETc9MUOfNiAcvKJ6cYay/', 'sadkfjhgasdddd', 'd@dddd.com', '', '2015-08-25 11:24:22', '', 0, 'sadkfjhgasdddd'),
(31, 'rgertsrtdrhthhete', '$P$BVN97aUmOSOGns0hO8YRIPozB4ykBI1', 'rgertsrtdrhthhete', 'yerywerysophia@gmail.com', '', '2015-08-25 11:29:38', '', 0, 'rgertsrtdrhthhete'),
(32, 'lopi', '$P$BXAURG2Nj4fP/Qk9ne7n3MQOjFaAb91', 'lopi', 'fgh@fgh.com', '', '2015-08-25 12:33:47', '', 0, 'lopi'),
(33, 'saran', '$P$BvPtYzXG/o4dDoS/ABrIudmSGxpy.e0', 'saran', 'priya@gmail.com', '', '2015-08-26 04:40:21', '', 0, 'saran'),
(34, 'testaff', '$P$By/X8o5.eH.ghq9PRCJttMBbMCrs3O.', 'testaff', 'testaff@casperon.in', '', '2015-08-26 07:12:27', '', 0, 'testaff'),
(35, 'testaccount', '$P$BV36K6T7u/iv.cSzxklVdgilc36PQF0', 'testaccount', 'testaccount@gmail.com', '', '2015-08-27 07:04:01', '', 0, 'testaccount'),
(36, 'naran', '$P$BvCS9I6JDV0ygvmapjdXmvXNdEmG0V1', 'naran', 'narankumar@gmail.com', '', '2015-08-31 10:22:04', '', 0, 'naran'),
(37, 'vinu', '$P$B4Tbi/IrmVuFkzozI6P/5FHwJ/B/Mx/', 'vinu', 'vinu@gmail.com', '', '2015-09-01 05:35:45', '', 0, 'vinu'),
(38, 'vijay', '$P$BNnCOSGNoZtCJU8DOaA9Ksj.0946v60', 'vijay', 'vijay@casperon.in', '', '2015-09-03 05:36:21', '', 0, 'vijay'),
(39, 'zzzz', '$P$BT6o7a7MwOlrJURAL7O5.WDzQJszQi.', 'zzzz', 'zzzz@casperon.in', '', '2015-09-03 09:34:55', '', 0, 'zzzz'),
(40, 'j', '$P$B3EP48TEeRoDTm7abRBTf8oUIZWo070', 'j', 'j@casperon.in', '', '2015-09-03 09:46:57', '', 0, 'j'),
(41, 'lll', '$P$BtOC1Cq5pVQ89drzyp/R0eMK.bdPYU1', 'lll', 'lll@casperon.in', '', '2015-09-03 09:57:20', '', 0, 'lll'),
(42, 'ethan', '$P$B1mKjwYHrQJIAFSPsdgI9KjO5Fk6QU.', 'ethan', 'etthan@gmail.com', '', '2015-09-08 09:24:07', '', 0, 'ethan'),
(43, 'ipsi', '$P$B75UEIggUSHD8rN68hB3jxZiHVzld7.', 'ipsi', 'ipsitakart@gmail.com', '', '2015-09-16 05:32:25', '', 0, 'ipsi'),
(44, 'qwertysd', '$P$Bbqi9Py5mjeLVEkjCIiyXvJHPGjd1/1', 'qwertysd', 'vijay@teamtweaks.com', '', '2015-09-16 06:39:06', '', 0, 'qwertysd'),
(45, 'santhahhjfh', '$P$BcDlcWLfepPMNTMJC0xXVNDgadqERt.', 'santhahhjfh', 'santhahhjfh@casperon.in', '', '2015-09-16 06:40:48', '', 0, 'santhahhjfh'),
(46, 'ganesh456', '$P$BrQDuY5R46C9WKpTw74qu1gBpUhPU/0', 'ganesh456', 'ganesh123@teamtweaks.com', '', '2015-09-16 06:46:33', '', 0, 'ganesh456'),
(47, 'aravindvijay', '$P$BVKxJbc33Glv3/HZp2oJVfTLCC9z9c/', 'aravindvijay', 'aravindvijay@teamtweaks.com', '', '2015-09-16 06:55:25', '', 0, 'aravindvijay'),
(48, 'praveen', '$P$BZjVga7yiDM3vm6TQ0Dy0p7.Orqel81', 'praveen', 'praveen@teamtweaks.com', '', '2015-09-16 06:57:09', '', 0, 'praveen');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_seller`
--

CREATE TABLE IF NOT EXISTS `artfill_seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `zendesk_id` int(11) NOT NULL,
  `freshdesk_id` varchar(100) NOT NULL,
  `seller_businessname` varchar(255) NOT NULL,
  `shop_location` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `shop_ratting` decimal(10,2) NOT NULL,
  `review_count` int(11) NOT NULL,
  `gift_card` enum('Yes','No') NOT NULL DEFAULT 'No',
  `seller_store_image` longtext NOT NULL,
  `seller_banner` longtext NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `seller_email` varchar(255) NOT NULL,
  `seller_username` varchar(225) NOT NULL,
  `seller_firstname` varchar(255) NOT NULL,
  `seller_lastname` varchar(255) NOT NULL,
  `seller_description` blob NOT NULL,
  `seller_crafting` varchar(255) NOT NULL,
  `seller_medium` varchar(255) NOT NULL,
  `seller_make` longblob NOT NULL,
  `seller_product` longblob NOT NULL,
  `seller_site` varchar(255) NOT NULL,
  `seller_nda` enum('yes','no') NOT NULL DEFAULT 'no',
  `seller_agreement` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` enum('active','inactive','deleted','waiting') NOT NULL,
  `featured_shop` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created` varchar(255) NOT NULL,
  `lastupdated` varchar(250) NOT NULL,
  `product_template` enum('left','bottom','full') NOT NULL DEFAULT 'left',
  `shop_template` enum('four','three') NOT NULL DEFAULT 'three',
  `blog_template` enum('template1','template2','template3','template4') NOT NULL DEFAULT 'template1',
  `seller_bg_color` varchar(100) NOT NULL DEFAULT '#FFFFFF',
  `seller_font` varchar(100) NOT NULL DEFAULT 'Arial, Helvetica, sans-serif',
  `seller_font_color` varchar(100) NOT NULL DEFAULT '#000000',
  `seller_icon_color` varchar(100) NOT NULL DEFAULT '#04AB1D',
  `seller_setup` text NOT NULL,
  `seller_social_icons` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `PayPal_email` varchar(50) NOT NULL,
  `wiretransfer_details` varchar(500) NOT NULL,
  `westernunion_details` varchar(500) NOT NULL,
  `paypal_username` varchar(255) NOT NULL,
  `paypal_password` varchar(255) NOT NULL,
  `paypal_signature` varchar(255) NOT NULL,
  `PayPal_mode` enum('Live','Sandbox') NOT NULL DEFAULT 'Sandbox',
  `authorize_mode` enum('Live','Sandbox') NOT NULL DEFAULT 'Sandbox',
  `authorize_id` varchar(30) NOT NULL,
  `authorize_key` varchar(50) NOT NULL,
  `Paypal_merchant_email` varchar(100) NOT NULL,
  `stripe_mode` enum('Live','Sandbox') NOT NULL DEFAULT 'Sandbox',
  `stripe_secret_key` varchar(100) NOT NULL,
  `stripe_publish_key` varchar(100) NOT NULL,
  `payu_mode` enum('Live','Sandbox') NOT NULL DEFAULT 'Sandbox',
  `payu_merchant_id` varchar(100) NOT NULL,
  `payu_salt` varchar(100) NOT NULL,
  `payu_email` varchar(100) NOT NULL,
  `Pay_country` varchar(50) NOT NULL,
  `Pay_fullname` varchar(50) NOT NULL,
  `Pay_street` varchar(30) NOT NULL,
  `Pay_aso` varchar(30) NOT NULL,
  `Pay_city` varchar(30) NOT NULL,
  `Pay_state` varchar(30) NOT NULL,
  `Pay_zippostalcode` varchar(10) NOT NULL,
  `shop_title` varchar(250) NOT NULL,
  `local_markets` enum('Yes','No') NOT NULL,
  `shop_announcement` blob NOT NULL,
  `msg_to_buyers` blob NOT NULL,
  `msg_to_buyers_for_digiitem` blob NOT NULL,
  `welcome_message` blob NOT NULL,
  `payment_policy` blob NOT NULL,
  `shipping_policy` blob NOT NULL,
  `refund_policy` blob NOT NULL,
  `additional_information` blob NOT NULL,
  `seller_information` blob NOT NULL,
  `facebook_link` text,
  `twitter_link` text,
  `dealCodeNumber` varchar(100) NOT NULL,
  `membership_expiry` datetime NOT NULL,
  `membership_status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `seller_promote` enum('Promote','Unpromote') NOT NULL DEFAULT 'Unpromote',
  `wallet_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `artfill_seller`
--

INSERT INTO `artfill_seller` (`id`, `seller_id`, `zendesk_id`, `freshdesk_id`, `seller_businessname`, `shop_location`, `latitude`, `longitude`, `shop_ratting`, `review_count`, `gift_card`, `seller_store_image`, `seller_banner`, `seourl`, `seller_email`, `seller_username`, `seller_firstname`, `seller_lastname`, `seller_description`, `seller_crafting`, `seller_medium`, `seller_make`, `seller_product`, `seller_site`, `seller_nda`, `seller_agreement`, `status`, `featured_shop`, `created`, `lastupdated`, `product_template`, `shop_template`, `blog_template`, `seller_bg_color`, `seller_font`, `seller_font_color`, `seller_icon_color`, `seller_setup`, `seller_social_icons`, `payment_mode`, `PayPal_email`, `wiretransfer_details`, `westernunion_details`, `paypal_username`, `paypal_password`, `paypal_signature`, `PayPal_mode`, `authorize_mode`, `authorize_id`, `authorize_key`, `Paypal_merchant_email`, `stripe_mode`, `stripe_secret_key`, `stripe_publish_key`, `payu_mode`, `payu_merchant_id`, `payu_salt`, `payu_email`, `Pay_country`, `Pay_fullname`, `Pay_street`, `Pay_aso`, `Pay_city`, `Pay_state`, `Pay_zippostalcode`, `shop_title`, `local_markets`, `shop_announcement`, `msg_to_buyers`, `msg_to_buyers_for_digiitem`, `welcome_message`, `payment_policy`, `shipping_policy`, `refund_policy`, `additional_information`, `seller_information`, `facebook_link`, `twitter_link`, `dealCodeNumber`, `membership_expiry`, `membership_status`, `seller_promote`, `wallet_amount`) VALUES
(1, 1, 0, '', 'Admin Shop', 'Frances S. DeMasi Middle School, Evesboro Medford Road, Evesham Township, NJ, United States', '33.94158890', '-118.4085300', '0', 0, 'Yes', 'Hydrangeas.jpg', 'banner-admin.jpg', 'adminshop', 'vinu@teamtweaks.com', 'Admin', 'Admin', 'Admin', '', '', '', '', '', '', 'no', 'no', 'active', 'Yes', '', '', 'left', 'three', 'template1', '#FFFFFF', 'Arial, Helvetica, sans-serif', '#000000', '#04AB1D', '', '', 'PayPal,COD', 'vinubuyer2@gmail.com', '', '0', '0', '0', '0', 'Sandbox', 'Sandbox', '3Vf82YuX', '47UfHXH638bbH26m', '', 'Sandbox', '', '', 'Sandbox', 'C0Dr8m', '3sf0jURk', 'udhayavanan@casperon.in', '', '', '', '', '', '', '', 'artfill Admin Shopy', 'No', 0x68692074686973206d792073686f702c636f6d6520746f207468652073686f7070696e6720776f726c6421212121, 0x7361646164617364, 0x616461736461, '', '', '', '', '', '', '0', '0', '', '0000-00-00 00:00:00', '0', 'Promote', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_seller_tax`
--

CREATE TABLE IF NOT EXISTS `artfill_seller_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `tax_amount` float(10,2) NOT NULL,
  `country_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_seller_tax`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_shipping`
--

CREATE TABLE IF NOT EXISTS `artfill_shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rangefrom` float(10,2) NOT NULL,
  `rangeto` float(10,2) NOT NULL,
  `delay` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `tax` float(10,2) NOT NULL,
  `weightfrom` varchar(255) NOT NULL,
  `weightto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `artfill_shipping`
--

INSERT INTO `artfill_shipping` (`id`, `name`, `rangefrom`, `rangeto`, `delay`, `status`, `tax`, `weightfrom`, `weightto`) VALUES
(1, 'UPS', 0.00, 5.00, '3 to 5 days', 'Active', 0.00, '', ''),
(2, 'USPS', 0.00, 7.00, '2 to 3 days', 'Active', 0.00, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_shipping_address`
--

CREATE TABLE IF NOT EXISTS `artfill_shipping_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_shipping_address`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_shipping_methods`
--

CREATE TABLE IF NOT EXISTS `artfill_shipping_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `proceed` enum('Install','Uninstall') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `sandbox` varchar(255) NOT NULL,
  `settings` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `artfill_shipping_methods`
--

INSERT INTO `artfill_shipping_methods` (`id`, `name`, `proceed`, `status`, `sandbox`, `settings`) VALUES
(16, 'Fedex', 'Install', 'Inactive', 'Yes', 'a:9:{s:14:"account_number";s:0:"";s:3:"key";s:0:"";s:8:"password";s:0:"";s:5:"meter";s:0:"";s:8:"pakaging";s:0:"";s:7:"dropoff";s:0:"";s:15:"allowed_methods";s:0:"";s:14:"package_detail";s:0:"";s:12:"weight_units";s:0:"";}'),
(17, 'USPS', 'Install', 'Inactive', 'Yes', 'a:7:{s:14:"account_number";s:0:"";s:13:"access_number";s:0:"";s:9:"user_name";s:12:"909ZIMPE2238";s:8:"password";s:0:"";s:8:"pakaging";s:19:"SERVICE_FIRST_CLASS";s:15:"allowed_methods";s:16:"MAIL_TYPE_LETTER";s:12:"weight_units";s:18:"CONTAINER_VARIABLE";}'),
(18, 'UPS', 'Install', 'Inactive', 'Yes', 'a:7:{s:14:"account_number";s:11:"12345678910";s:13:"access_number";s:11:"12345678910";s:9:"user_name";s:10:"kprabu2015";s:8:"password";s:9:"37SQ6wF89";s:8:"pakaging";s:7:"UPS_PAK";s:15:"allowed_methods";s:22:"UPS_NEXT_DAY_AIR_SAVER";s:12:"weight_units";s:2:"LB";}');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_shopping_carts`
--

CREATE TABLE IF NOT EXISTS `artfill_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(200) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_shopping_carts`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_shop_payment`
--

CREATE TABLE IF NOT EXISTS `artfill_shop_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(255) NOT NULL,
  `dealCodeNumber` varchar(255) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_shop_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_shop_section_list`
--

CREATE TABLE IF NOT EXISTS `artfill_shop_section_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` varchar(250) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_id` int(11) NOT NULL COMMENT 'unique id crete while insert values into this table',
  `product_id` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop_prod_count` int(11) NOT NULL COMMENT 'Its a count of shop product count. Increase/Decrese count while add/delete product from shop section',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_shop_section_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_slider`
--

CREATE TABLE IF NOT EXISTS `artfill_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` mediumtext NOT NULL,
  `slider_text` text NOT NULL,
  `slider_link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_slider`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_spam_report`
--

CREATE TABLE IF NOT EXISTS `artfill_spam_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `spam_title` longtext NOT NULL,
  `complaint` blob NOT NULL,
  `complaint_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_spam_report`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_states`
--

CREATE TABLE IF NOT EXISTS `artfill_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `tax_amt` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=904 ;

--
-- Dumping data for table `artfill_states`
--

INSERT INTO `artfill_states` (`id`, `countryid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `tax_amt`) VALUES
(1, 215, 'AL', 'Alabama', 'NA', 'alabama', 'Active', '', '', '20'),
(2, 215, 'AK', 'Alaska', 'NA', 'alaska', 'Active', '', '', '12'),
(3, 215, 'AS', 'American Samoa', 'NA', 'american-samoa', 'Active', '', '', '10'),
(4, 215, 'AZ', 'Arizona', 'NA', 'arizona', 'Active', '', '', ''),
(5, 215, 'AR', 'Arkansas', 'NA', 'arkansas', 'Active', '', '', ''),
(6, 215, 'AF', 'Armed Forces Africa', 'NA', 'armed-forces-africa', 'Active', '', '', ''),
(7, 215, 'AA', 'Armed Forces Americas', 'NA', 'armed-forces-americas', 'Active', '', '', ''),
(8, 215, 'AC', 'Armed Forces Canada', 'NA', 'armed-forces-canada', 'Active', '', '', ''),
(9, 215, 'AE', 'Armed Forces Europe', 'NA', 'armed-forces-europe', 'Active', '', '', ''),
(10, 215, 'AM', 'Armed Forces Middle East', 'NA', 'armed-forces-middle-east', 'Active', '', '', ''),
(11, 215, 'AP', 'Armed Forces Pacific', 'NA', 'armed-forces-pacific', 'Active', '', '', ''),
(12, 215, 'CA', 'California', 'NA', 'california', 'Active', '', '', ''),
(13, 215, 'CO', 'Colorado', 'NA', 'colorado', 'Active', '', '', ''),
(14, 215, 'CT', 'Connecticut', 'NA', 'connecticut', 'Active', '', '', ''),
(15, 215, 'DE', 'Delaware', 'NA', 'delaware', 'Active', '', '', ''),
(16, 215, 'DC', 'District of Columbia', 'NA', 'district-of-columbia', 'Active', '', '', ''),
(17, 215, 'FM', 'Federated States Of Micronesia', 'NA', 'federated-states-of-micronesia', 'Active', '', '', ''),
(18, 215, 'FL', 'Florida', 'NA', 'florida', 'Active', '1', '', ''),
(19, 215, 'GA', 'Georgia', 'NA', 'georgia', 'Active', '', '', ''),
(20, 215, 'GU', 'Guam', 'NA', 'guam', 'Active', '', '', ''),
(21, 215, 'HI', 'Hawaii', 'NA', 'hawaii', 'Active', '', '', ''),
(22, 215, 'ID', 'Idaho', 'NA', 'idaho', 'Active', '', '', ''),
(23, 215, 'IL', 'Illinois', 'NA', 'illinois', 'Active', '', '', ''),
(24, 215, 'IN', 'Indiana', 'NA', 'indiana', 'Active', '', '', ''),
(25, 215, 'IA', 'Iowa', 'NA', 'iowa', 'Active', '', '', ''),
(26, 215, 'KS', 'Kansas', 'NA', 'kansas', 'Active', '', '', ''),
(27, 215, 'KY', 'Kentucky', 'NA', 'kentucky', 'Active', '', '', ''),
(28, 215, 'LA', 'Louisiana', 'NA', 'louisiana', 'Active', '', '', ''),
(29, 215, 'ME', 'Maine', 'NA', 'maine', 'Active', '', '', ''),
(30, 215, 'MH', 'Marshall Islands', 'NA', 'marshall-islands', 'Active', '', '', ''),
(31, 215, 'MD', 'Maryland', 'NA', 'maryland', 'Active', '', '', ''),
(32, 215, 'MA', 'Massachusetts', 'NA', 'massachusetts', 'Active', '', '', ''),
(33, 215, 'MI', 'Michigan', 'NA', 'michigan', 'Active', '', '', ''),
(34, 215, 'MN', 'Minnesota', 'NA', 'minnesota', 'Active', '', '', ''),
(35, 215, 'MS', 'Mississippi', 'NA', 'mississippi', 'Active', '', '', ''),
(36, 215, 'MO', 'Missouri', 'NA', 'missouri', 'Active', '', '', ''),
(37, 215, 'MT', 'Montana', 'NA', 'montana', 'Active', '', '', ''),
(38, 215, 'NE', 'Nebraska', 'NA', 'nebraska', 'Active', '', '', ''),
(39, 215, 'NV', 'Nevada', 'NA', 'nevada', 'Active', '', '', ''),
(40, 215, 'NH', 'New Hampshire', 'NA', 'new-hampshire', 'Active', '', '', ''),
(41, 215, 'NJ', 'New Jersey', 'NA', 'new-jersey', 'Active', '', '', ''),
(42, 215, 'NM', 'New Mexico', 'NA', 'new-mexico', 'Active', '', '', ''),
(43, 215, 'NY', 'New York', 'NA', 'new-york', 'Active', '', '', ''),
(44, 215, 'NC', 'North Carolina', 'NA', 'north-carolina', 'Active', '', '', ''),
(45, 215, 'ND', 'North Dakota', 'NA', 'north-dakota', 'Active', '', '', ''),
(46, 215, 'MP', 'Northern Mariana Islands', 'NA', 'northern-mariana-islands', 'Active', '', '', ''),
(47, 215, 'OH', 'Ohio', 'NA', 'ohio', 'Active', '', '', ''),
(48, 215, 'OK', 'Oklahoma', 'NA', 'oklahoma', 'Active', '', '', ''),
(49, 215, 'OR', 'Oregon', 'NA', 'oregon', 'Active', '', '', ''),
(50, 215, 'PW', 'Palau', 'NA', 'palau', 'Active', '', '', ''),
(51, 215, 'PA', 'Pennsylvania', 'NA', 'pennsylvania', 'Active', '', '', ''),
(52, 215, 'PR', 'Puerto Rico', 'NA', 'puerto-rico', 'Active', '', '', ''),
(53, 215, 'RI', 'Rhode Island', 'NA', 'rhode-island', 'Active', '', '', ''),
(54, 215, 'SC', 'South Carolina', 'NA', 'south-carolina', 'Active', '', '', ''),
(55, 215, 'SD', 'South Dakota', 'NA', 'south-dakota', 'Active', '', '', ''),
(56, 215, 'TN', 'Tennessee', 'NA', 'tennessee', 'Active', '', '', ''),
(57, 215, 'TX', 'Texas', 'NA', 'texas', 'Active', '1', '', ''),
(58, 215, 'UT', 'Utah', 'NA', 'utah', 'Active', '', '', ''),
(59, 215, 'VT', 'Vermont', 'NA', 'vermont', 'Active', '', '', ''),
(60, 215, 'VI', 'Virgin Islands', 'NA', 'virgin-islands', 'Active', '', '', ''),
(61, 215, 'VA', 'Virginia', 'NA', 'virginia', 'Active', '', '', ''),
(62, 215, 'WA', 'Washington', 'NA', 'washington', 'Active', '', '', ''),
(63, 215, 'WV', 'West Virginia', 'NA', 'west-virginia', 'Active', '', '', ''),
(64, 215, 'WI', 'Wisconsin', 'NA', 'wisconsin', 'Active', '', '', ''),
(65, 215, 'WY', 'Wyoming', 'NA', 'wyoming', 'Active', '', '', ''),
(858, 95, 'DL', 'Delhi', 'AS', 'delhi', 'Active', '', '', ''),
(859, 95, 'MH', 'Maharashtra', 'AS', 'maharashtra', 'Active', '', '', ''),
(860, 95, 'TN', 'Tamil Nadu', 'AS', 'tamil-nadu', 'Active', '', '', ''),
(861, 95, 'KL', 'Kerala', 'AS', 'kerala', 'Active', '', '', ''),
(862, 95, 'AP', 'Andhra Pradesh', 'AS', 'andhra-pradesh', 'Active', '', '', ''),
(863, 95, 'KA', 'Karnataka', 'AS', 'karnataka', 'Active', '', '', ''),
(864, 95, 'GA', 'Goa', 'AS', 'goa', 'Active', '', '', ''),
(865, 95, 'MP', 'Madhya Pradesh', 'AS', 'madhya-pradesh', 'Active', '', '', ''),
(866, 95, 'PY', 'Pondicherry', 'AS', 'pondicherry', 'Active', '', '', ''),
(867, 95, 'GJ', 'Gujarat', 'AS', 'gujarat', 'Active', '', '', ''),
(868, 95, 'OR', 'Orrisa', 'AS', 'orrisa', 'Active', '', '', ''),
(869, 95, 'CA', 'Chhatisgarh', 'AS', 'chhatisgarh', 'Active', '', '', ''),
(870, 95, 'JH', 'Jhardmand', 'AS', 'jhardmand', 'Active', '', '', ''),
(871, 95, 'BR', 'Bihar', 'AS', 'bihar', 'Active', '', '', ''),
(872, 95, 'WB', 'West Bengal', 'AS', 'west-bengal', 'Active', '', '', ''),
(873, 95, 'UP', 'Uttar Pradesh', 'AS', 'uttar-pradesh', 'Active', '', '', ''),
(874, 95, 'RJ', 'Rajasthan', 'AS', 'rajasthan', 'Active', '', '', ''),
(875, 95, 'PB', 'Punjab', 'AS', 'punjab', 'Active', '', '', ''),
(876, 95, 'HR', 'Haryana', 'AS', 'haryana', 'Active', '', '', ''),
(877, 95, 'CH', 'Chandigarh', 'AS', 'chandigarh', 'Active', '', '', ''),
(878, 95, 'JK', 'Jammu & Kashmir', 'AS', 'jammu-kashmir', 'Active', '', '', ''),
(879, 95, 'HP', 'Himachal Pradesh', 'AS', 'himachal-pradesh', 'Active', '', '', ''),
(880, 95, 'UA', 'Uttaranchal', 'AS', 'uttaranchal', 'Active', '', '', ''),
(881, 95, 'LK', 'Lakshadweep', 'AS', 'lakshadweep', 'Active', '', '', ''),
(882, 95, 'AN', 'Andaman & Nicobar', 'AS', 'andaman-nicobar', 'Active', '', '', ''),
(883, 95, 'MG', 'Meghalaya', 'AS', 'meghalaya', 'Active', '', '', ''),
(884, 95, 'AS', 'Assam', 'AS', 'assam', 'Active', '', '', ''),
(885, 95, 'DR', 'Dadra & Nagar Haveli', 'AS', 'dadra-nagar-haveli', 'Active', '', '', ''),
(886, 95, 'DN', 'Daman & Diu', 'AS', 'daman-diu', 'Active', '', '', ''),
(887, 95, 'SK', 'Sikkim', 'AS', 'sikkim', 'Active', '', '', ''),
(888, 95, 'TR', 'Tripura', 'AS', 'tripura', 'Active', '', '', ''),
(889, 95, 'MZ', 'Mizoram', 'AS', 'mizoram', 'Active', '', '', ''),
(890, 95, 'MN', 'Manipur', 'AS', 'manipur', 'Active', '', '', ''),
(891, 95, 'NL', 'Nagaland', 'AS', 'nagaland', 'Active', '', '', ''),
(892, 95, 'AR', 'Arunachal Pradesh', 'AS', 'arunachal-pradesh', 'Active', '', '', ''),
(893, 95, 'dmI', 'Karachi', 'AS', 'karachi', 'Active', '', '', ''),
(894, 95, 'LH', 'Lahore', 'AS', 'lahore', 'Active', '', '', ''),
(895, 95, 'ISB', 'Islamabad', 'AS', 'islamabad', 'Active', '', '', ''),
(896, 95, 'QUE', 'Quetta', 'AS', 'quetta', 'Active', '', '', ''),
(897, 95, 'PSH', 'Peshawar', 'AS', 'peshawar', 'Active', '', '', ''),
(898, 95, 'GUJ', 'Gujrat', 'AS', 'gujrat', 'Active', '', '', ''),
(899, 95, 'SAH', 'Sahiwal', 'AS', 'sahiwal', 'Active', '', '', ''),
(900, 95, 'FSB', 'Faisalabad', 'AS', 'faisalabad', 'Active', '', '', ''),
(901, 95, 'RIP', 'Rawal Pindi', 'AS', 'rawal-pindi', 'Active', '', '', ''),
(902, 95, 'JHK', 'Jharkand', 'AS', 'jharkand', 'Active', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_state_tax`
--

CREATE TABLE IF NOT EXISTS `artfill_state_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `state_tax` float(10,2) NOT NULL,
  `country_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_state_tax`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_subadmin`
--

CREATE TABLE IF NOT EXISTS `artfill_subadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_subadmin`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_subproducts`
--

CREATE TABLE IF NOT EXISTS `artfill_subproducts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_name` varchar(255) NOT NULL,
  `attr_value` varchar(200) DEFAULT NULL,
  `attr_seourl` varchar(255) NOT NULL,
  `pricing` decimal(13,5) DEFAULT NULL,
  `stock_status` varchar(255) NOT NULL,
  `digital_item` varchar(255) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attr_scale` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_subproducts`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_subscribers_list`
--

CREATE TABLE IF NOT EXISTS `artfill_subscribers_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscrip_mail` varchar(255) NOT NULL,
  `active` int(11) NOT NULL COMMENT '0-inactive, 1-active',
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` varchar(100) NOT NULL,
  `verification_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_subscribers_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_sub_shipping`
--

CREATE TABLE IF NOT EXISTS `artfill_sub_shipping` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_cost` decimal(10,5) DEFAULT NULL,
  `ship_seourl` varchar(255) NOT NULL,
  `ship_other_cost` decimal(10,5) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_sub_shipping`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_testimonials`
--

CREATE TABLE IF NOT EXISTS `artfill_testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `message` longblob NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_testimonials`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_theme`
--

CREATE TABLE IF NOT EXISTS `artfill_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `artfill_theme`
--

INSERT INTO `artfill_theme` (`id`, `theme_name`, `status`, `date`) VALUES
(15, 'Sample', 'Inactive', '2015-10-09 18:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_theme_layout`
--

CREATE TABLE IF NOT EXISTS `artfill_theme_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=215 ;

--
-- Dumping data for table `artfill_theme_layout`
--

INSERT INTO `artfill_theme_layout` (`id`, `name`, `value`, `created`) VALUES
(1, 'header_bg', '', '2014-01-28 16:38:51'),
(2, 'header_searchbox_placeholder', '', '2014-01-28 16:38:51'),
(3, 'header_searchbox_border_color', '', '2014-01-28 16:39:51'),
(4, 'header_search_button_bgcolor', '', '2014-01-28 16:39:51'),
(5, 'header_search_button_color', '', '2014-01-28 16:47:08'),
(6, 'header_search_button_radius_color', '', '2014-01-28 16:47:08'),
(7, 'browse_button_color', '', '2014-01-28 17:14:34'),
(8, 'browse_button_bgcolor', '', '2014-01-28 17:14:34'),
(9, 'browse_button_hoever_bgcolor', '', '2014-01-28 18:58:56'),
(10, 'browse_button_hoever_color', '', '2014-01-29 11:03:35'),
(11, 'header_text_color', '', '2014-01-29 11:03:35'),
(12, 'signin_button_bgcolor', '', '2014-01-29 11:14:35'),
(13, 'signin_button_color', '', '2014-01-29 11:14:35'),
(14, 'cart_notification_bgcolor', '', '2014-01-29 11:31:21'),
(15, 'cart_notification_color', '', '2014-01-29 11:31:21'),
(16, 'subcriber_head_color', '', '2014-01-29 11:31:32'),
(17, 'subscriber_place_holder_color', '', '2014-01-29 11:31:32'),
(18, 'subscriber_button_color', '', '2014-01-29 11:39:00'),
(19, 'subscriber_font_color', '', '2014-01-29 11:39:00'),
(20, 'subscriber_radius_color', '', '2014-01-29 11:45:46'),
(21, 'footer_bg_color', '', '2014-01-29 11:45:46'),
(22, 'footer_head_color', '', '2014-01-29 11:48:06'),
(23, 'footer-list_color', '', '2014-01-29 11:48:06'),
(24, 'language_color', '', '2014-01-29 11:51:19'),
(25, 'help_color', '', '2014-01-29 11:51:19'),
(26, 'help_bg_color', '', '2014-01-29 11:59:55'),
(27, 'copy_right_color', '', '2014-01-29 11:59:55'),
(28, 'open_shop_color', '', '2014-01-29 12:01:29'),
(29, 'open_shop_bgcolor', '', '2014-01-29 12:01:29'),
(30, 'recent_favourite_banner_bgcolor', '', '2014-01-29 12:02:03'),
(31, 'recent_favourite_color', '', '2014-01-29 12:03:04'),
(32, 'banner_text_color', '', '2014-01-29 12:11:18'),
(33, 'recent_fav_head_color', '', '2014-01-29 12:12:28'),
(34, 'recent_fav_subhead_color', '', '2014-01-29 12:12:28'),
(35, 'recent_fav_area_bgcolor', '', '2014-01-29 12:14:50'),
(36, 'cat_name', '', '2014-01-29 12:16:08'),
(37, 'price_color', '', '2014-01-29 12:16:08'),
(38, 'shop_name_color', '', '2014-01-29 12:19:56'),
(39, 'reviews_count_color', '', '2015-05-05 10:35:03'),
(40, 'recent_div_inner_bgcolor', '', '2015-05-05 10:35:34'),
(41, 'community_head_color', '', '2015-05-05 10:37:02'),
(42, 'community_subhead_color', '', '2015-05-05 10:37:20'),
(43, 'community_user_name_color', '', '2015-05-05 10:56:35'),
(44, 'community_count_color', '', '2015-05-05 10:56:35'),
(45, 'community_div_bgcolor', '', '2015-05-05 11:22:11'),
(46, 'community_div_innerbgcolor', '', '2015-05-05 11:22:11'),
(47, 'subscriber_div', '', '2015-05-05 11:27:04'),
(48, 'regional-setting-bgcolor', '', '2015-05-05 11:44:45'),
(49, 'regional-setting-color', '', '2015-05-05 11:44:45'),
(50, 'prod_detail_shop_name', '', '2015-05-05 12:08:02'),
(51, 'favorite_shop_bgcolor', '', '2015-05-05 12:08:02'),
(52, 'favorite_shop_color', '', '2015-05-05 12:08:40'),
(53, 'shop_item_count_color', '', '2015-05-05 12:08:40'),
(54, 'product_favouritehead_bgcolor', '', '2015-05-05 12:27:08'),
(55, 'product_favouritehead_color', '', '2015-05-05 12:27:08'),
(56, 'product_name_color', '', '2015-05-05 12:32:02'),
(57, 'product_cost_color', '', '2015-05-05 12:32:02'),
(58, 'Quantity_color', '', '2015-05-05 12:39:28'),
(59, 'Overview_color', '', '2015-05-05 12:39:28'),
(60, 'overview_properties_color', '', '2015-05-05 12:43:30'),
(61, 'add_to_cart_bgcolor', '', '2015-05-05 12:43:30'),
(62, 'inner_cart_bgcolor', '', '2015-05-05 12:48:37'),
(63, 'add_to_cart_color', '', '2015-05-05 12:51:37'),
(64, 'add_to_cart_border_color', '', '2015-05-05 12:51:37'),
(65, 'favoutite_box_bgcolor', '', '2015-05-05 12:55:26'),
(66, 'related_listing_bgcolor', '', '2015-05-05 12:59:15'),
(67, 'related_listing_locationcolor', '', '2015-05-05 12:59:15'),
(68, 'related_product_name_color', '', '2015-05-05 13:03:12'),
(69, 'releated_cost_color', '', '2015-05-05 13:03:12'),
(70, 'active_tab_bgcolor', '', '2015-05-05 13:14:34'),
(71, 'active_tab_color', '', '2015-05-05 13:14:34'),
(72, 'inactive_tab_bgcolor', '', '2015-05-05 13:30:19'),
(73, 'inactive_tab_color', '', '2015-05-05 13:30:19'),
(74, 'tab_hover_bgcolor', '', '2015-05-05 13:47:02'),
(75, 'itemdetail_color', '', '2015-05-05 14:48:15'),
(76, 'payment_head_color', '', '2015-05-05 14:48:15'),
(77, 'shipping_cost_policy_header_color', '', '2015-05-05 14:52:24'),
(78, 'shipping_cost_table_header_color', '', '2015-05-05 14:52:24'),
(79, 'table_border_color_ship_policy', '', '2015-05-05 14:59:24'),
(80, 'tabs_border_color', '', '2015-05-05 15:04:56'),
(81, 'ship_table_td_Color', '', '2015-05-05 15:04:56'),
(82, 'policy_color', '', '2015-05-05 15:15:12'),
(83, 'listed_on_report_color', '', '2015-05-05 15:20:47'),
(84, 'favourite_tot_color', '', '2015-05-05 15:20:47'),
(85, 'product_div_area', '', '2015-05-05 15:27:22'),
(86, 'search_title_color', '', '2015-05-05 15:42:35'),
(87, 'catgory_filter_color', '', '2015-05-05 15:42:35'),
(88, 'search_product_title_color', '', '2015-05-05 15:54:39'),
(89, 'search_shop_title_color', '', '2015-05-05 15:54:39'),
(90, 'search_cost_color', '', '2015-05-05 15:56:27'),
(91, 'search_item_count_color', '', '2015-05-05 16:12:22'),
(92, 'search_by_color', '', '2015-05-05 16:12:22'),
(93, 'price_input_box_bordercolor', '', '2015-05-05 16:30:39'),
(94, 'price_input_box_color', '', '2015-05-05 16:30:39'),
(95, 'price_range_button_color', '', '2015-05-05 16:38:57'),
(96, 'price_button_bgcolor', '', '2015-05-05 16:39:29'),
(97, 'price_button_bordercolor', '', '2015-05-05 16:39:29'),
(98, 'cart_title_color', '', '2015-05-05 17:03:27'),
(99, 'cart_head_color', '', '2015-05-05 17:03:27'),
(100, 'cart_head_shop_color', '', '2015-05-05 17:36:51'),
(101, 'cart_head_bg_color', '', '2015-05-05 17:36:51'),
(102, 'cart_keep_shopping_bgcolor', '', '2015-05-05 17:51:23'),
(103, 'cart_keep_shopping_color', '', '2015-05-05 17:51:23'),
(104, 'proceed_to_checkout_color', '', '2015-05-05 17:58:59'),
(105, 'proceed_to_checkout_bgcolor', '', '2015-05-05 17:58:59'),
(106, 'cart_product_name_color', '', '2015-05-05 18:09:11'),
(107, 'cart_product_quantity_color', '', '2015-05-05 18:09:11'),
(108, 'cart_ship_howto_pay_order_tot_color', '', '2015-05-05 18:18:13'),
(109, 'cart_item_detail_color', '', '2015-05-05 18:18:13'),
(110, 'after_home_your_feed_color', '', '2015-05-05 18:49:08'),
(111, 'after_login_bgcolor', '', '2015-05-05 18:49:08'),
(112, 'after_login_title_color', '', '2015-05-05 19:11:46'),
(113, 'after_login_product_shop', '', '2015-05-05 19:20:01'),
(114, 'after_login_cost_color', '', '2015-05-05 19:26:19'),
(115, 'after_login_category_readmore_color', '', '2015-05-05 19:26:19'),
(116, 'after_subscribe_buttonbg', '', '2015-05-06 10:13:23'),
(117, 'after_subscribe_color', '', '2015-05-06 10:13:23'),
(118, 'one_of_most_bgcolor', '', '2015-05-06 10:17:07'),
(119, 'one_of_most_color', '', '2015-05-06 10:17:07'),
(120, 'favorites_title_color', '', '2015-05-06 10:26:10'),
(121, 'favorites_subtitle_color', '', '2015-05-06 10:26:10'),
(122, 'favorites_follower_bgcolor', '', '2015-05-06 10:26:10'),
(123, 'favorites_follower_color', '', '2015-05-06 10:26:10'),
(124, 'favorites_page_selected_color', '', '2015-05-06 10:26:10'),
(125, 'favorites_page_selected_bgcolor', '', '2015-05-06 10:26:10'),
(126, 'favorite_page_unselected_tab_color', '', '2015-05-06 10:26:10'),
(127, 'favorite_page_unselected_tab_bgcolor', '', '2015-05-06 10:26:10'),
(128, 'shop_sell_welcome_text_color', '', '2015-05-06 10:26:10'),
(129, 'shop_sell_heading_side_link_color', '', '2015-05-06 10:26:10'),
(130, 'shop_sell_sub_text', '', '2015-05-06 11:51:59'),
(131, 'shop_sell_product_color', '', '2015-05-06 11:51:59'),
(132, 'shop_sell_cost_color', '', '2015-05-06 12:01:57'),
(133, 'shop_sell_head_color ', '', '2015-05-06 12:01:57'),
(134, 'shop_sell_head_bgcolor', '', '2015-05-06 12:02:32'),
(135, 'shop_sell_shopinfo_bgcolor', '', '2015-05-06 12:02:32'),
(136, 'shop_name_head_Color', '', '2015-05-06 12:20:04'),
(137, 'shop_name_head_subtext', '', '2015-05-06 12:20:04'),
(138, 'shop_name_button_bgcolor', '', '2015-05-06 12:24:34'),
(139, 'shop_name__button_color', '', '2015-05-06 12:24:34'),
(140, 'shop_list_head_Color\r\n', '', '2015-05-06 12:35:35'),
(141, 'shop_list_sub_color', '', '2015-05-06 12:35:35'),
(142, 'shop_list_description_color', '', '2015-05-06 12:43:38'),
(143, 'shop_manage_list_head_color', '', '2015-05-06 12:58:14'),
(144, 'shop_manage_list_subtext_color', '', '2015-05-06 12:58:14'),
(145, 'shop_manage_list_product_color', '', '2015-05-06 12:58:54'),
(146, 'shop_manage_list_table_bgcolor', '', '2015-05-06 12:58:54'),
(147, 'shop_manage_list_table_color', '', '2015-05-06 12:59:28'),
(148, 'shop_payment_subtext_color', '', '2015-05-06 13:30:08'),
(149, 'shop_payment_subtitle_color', '', '2015-05-06 13:30:08'),
(151, 'view_profile_home_head_color', '', '2015-05-06 14:43:10'),
(152, 'view_profile_home_sidebar_bgcolor', '', '2015-05-06 14:48:19'),
(153, 'view_profile_home_page_detail', '', '2015-05-06 14:48:19'),
(154, 'view_profile_home_page_edit_button_color', '', '2015-05-06 14:56:07'),
(155, 'view_profile_home_page_edit_button_bgcolor', '', '2015-05-06 14:56:07'),
(156, 'follower_page_tab_selected_color', '', '2015-05-06 15:08:28'),
(157, 'follower_page_tab_selected_bgcolor', '', '2015-05-06 15:08:28'),
(158, 'activity_page_product_color', '', '2015-05-06 15:20:40'),
(159, 'community_page_head_color', '', '2015-05-06 15:28:19'),
(160, 'community_page_head_active_bgcolor', '', '2015-05-06 15:28:19'),
(161, 'community_page_inactive_color', '', '2015-05-06 15:44:40'),
(162, 'community_page_inactive_bgcolor', '', '2015-05-06 15:44:40'),
(163, 'community_page_tabletitle_color', '', '2015-05-06 15:49:55'),
(164, 'community_page_tablehead_bgcolor', '', '2015-05-06 15:49:55'),
(165, 'community_page_button_bgcolor', '', '2015-05-06 16:00:49'),
(166, 'public_profile_page_sub_text', '', '2015-05-06 16:00:49'),
(167, 'public_profile_page_side_head', '', '2015-05-06 16:26:07'),
(168, 'account_setting_page_title_color', '', '2015-05-06 16:26:07'),
(169, 'account_setting_page_head_bgcolor', '', '2015-05-06 16:37:13'),
(170, 'setting_page_field_label_color', '', '2015-05-06 16:46:46'),
(171, 'setting_page_button_bgcolor', '', '2015-05-06 16:46:46'),
(172, 'settings_button_color', '', '2015-05-06 16:51:05'),
(173, 'community_page_banner_title_color', '', '2015-05-06 17:42:42'),
(174, 'community_page_link_color', '', '2015-05-06 17:42:42'),
(175, 'community_page_description_color', '', '2015-05-06 17:42:42'),
(176, 'community_page_stories_color', '', '2015-05-06 17:43:11'),
(177, 'event_page_title_color', '', '2015-05-06 18:00:03'),
(178, 'event_page_subtitle_color', '', '2015-05-06 18:00:03'),
(179, 'event_page_decription_color', '', '2015-05-06 18:00:03'),
(180, 'event_page_button_color', '', '2015-05-06 18:00:03'),
(181, 'event_page_button_bgcolor', '', '2015-05-06 18:00:03'),
(182, 'event_page_year_month_color', '', '2015-05-06 18:09:34'),
(183, 'event_page_info_color', '', '2015-05-06 18:09:34'),
(184, 'team_page_title_color', '', '2015-05-06 18:29:42'),
(185, 'team_page_subtitle_color', '', '2015-05-06 18:29:42'),
(186, 'teampage_description_color', '', '2015-05-06 18:29:42'),
(187, 'teampage_member_count', '', '2015-05-06 18:29:42'),
(188, 'browse_page_title_color', '', '2015-05-06 18:42:48'),
(189, 'browse_page_link_color', '', '2015-05-06 18:42:48'),
(190, 'browse_page_shop_owner_color', '', '2015-05-06 18:42:48'),
(191, 'browse_page_shop_count_color', '', '2015-05-06 18:42:48'),
(192, 'gift_title_color', '', '2015-05-06 19:03:01'),
(193, 'gift_field_color', '', '2015-05-06 19:03:01'),
(194, 'gift_button_color', '', '2015-05-06 19:03:01'),
(195, 'gift_buttonbg_color', '', '2015-05-06 19:03:01'),
(196, 'gift_description_color', '', '2015-05-06 19:03:01'),
(197, 'resgistry_page_title_color', '', '2015-05-07 10:09:37'),
(198, 'resgistry_page_sub_title_color', '', '2015-05-07 10:09:37'),
(199, 'resgitry_head_bgcolor', '', '2015-05-07 10:16:22'),
(200, 'resgitry_head_color', '', '2015-05-07 10:16:22'),
(201, 'registry_subhead_bgcolor', '', '2015-05-07 10:20:01'),
(202, 'registry_weddinginfo_bgcolor', '', '2015-05-07 10:20:01'),
(203, 'registry_cost_color', '', '2015-05-07 10:37:27'),
(204, 'registry_sub_text_color', '', '2015-05-07 10:37:27'),
(205, 'shop_section_heading_color', '', '2015-05-07 10:48:30'),
(206, 'shop_section_link_color', '', '2015-05-07 10:48:30'),
(207, 'shop_section_title_color', '', '2015-05-07 10:48:30'),
(208, 'shop_section_info_text', '', '2015-05-07 10:48:30'),
(209, 'shop_section_head_bgcolor', '', '2015-05-07 10:48:30'),
(210, 'shop_section_product_color', '', '2015-05-07 10:48:30'),
(211, 'shop_section_shop_color', '', '2015-05-07 10:48:30'),
(212, 'shop_section_price_color', '', '2015-05-07 10:48:30'),
(213, 'shop_section_button_bgcolor', '', '2015-05-07 10:48:30'),
(214, 'shop_section_button_color', '', '2015-05-07 10:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `artfill_transaction`
--

CREATE TABLE IF NOT EXISTS `artfill_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_cycle` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `next_payment_date` varchar(255) NOT NULL,
  `residence_country` varchar(255) NOT NULL,
  `initial_payment_amount` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `time_created` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `period_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `test_ipn` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `amount_per_cycle` varchar(255) NOT NULL,
  `profile_status` varchar(255) NOT NULL,
  `charset` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `outstanding_balance` varchar(255) NOT NULL,
  `recurring_payment_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `custom_values` varchar(255) NOT NULL,
  `ipn_track_id` varchar(255) NOT NULL,
  `tran_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_users`
--

CREATE TABLE IF NOT EXISTS `artfill_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_req` enum('Yes','No') NOT NULL DEFAULT 'No',
  `withdraw_amt` decimal(10,2) NOT NULL,
  `loginUserType` enum('normal','twitter','facebook','google','mobile') NOT NULL,
  `gcm_buyer_id` varchar(250) DEFAULT NULL,
  `gcm_seller_id` varchar(250) DEFAULT NULL,
  `ios_device_id` varchar(250) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `about_us` text NOT NULL,
  `group` enum('User','Seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `is_verified` enum('Yes','No') NOT NULL,
  `is_brand` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `last_activity_visit` varchar(200) NOT NULL,
  `thumbnail` text NOT NULL,
  `address` varchar(50) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_district` varchar(50) NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_country` varchar(20) NOT NULL,
  `s_postal_code` int(11) NOT NULL,
  `s_phone_no` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_description` text NOT NULL,
  `commision` decimal(10,2) NOT NULL,
  `cod_available` enum('Yes','No') NOT NULL DEFAULT 'No',
  `web_url` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_no` varchar(100) NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `request_status` enum('Not Requested','Pending','Approved','Rejected') NOT NULL DEFAULT 'Not Requested',
  `verify_code` varchar(10) NOT NULL,
  `feature_product` int(100) NOT NULL,
  `followers_count` int(11) NOT NULL,
  `following_count` int(11) NOT NULL,
  `followers` varchar(200) NOT NULL,
  `following` varchar(200) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `pinterest` varchar(100) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `about` varchar(200) NOT NULL,
  `age` enum('','13 to 17','18 to 24','25 to 34','35 to 44','45 to 54','55+') NOT NULL,
  `gender` enum('Male','Female','') NOT NULL DEFAULT '',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `visibility` enum('Everyone','Only you') NOT NULL,
  `favorites_visibility` enum('Public','Private') NOT NULL DEFAULT 'Public',
  `shop_visibility` enum('Public','Private') NOT NULL DEFAULT 'Public',
  `display_lists` enum('Yes','No') NOT NULL,
  `email_notifications` longtext NOT NULL,
  `notifications` longtext NOT NULL,
  `updates` enum('1','0') NOT NULL,
  `products` int(11) NOT NULL,
  `lists` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `following_user_lists` longtext NOT NULL,
  `following_giftguide_lists` longtext NOT NULL,
  `api_id` bigint(20) NOT NULL,
  `own_products` longtext NOT NULL,
  `own_count` bigint(20) NOT NULL,
  `referId` int(11) NOT NULL,
  `want_count` bigint(20) NOT NULL,
  `refund_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paypal_email` varchar(255) NOT NULL,
  `product_template` enum('left','bottom','full') NOT NULL DEFAULT 'left',
  `shop_template` enum('four','three') NOT NULL DEFAULT 'three',
  `blog_template` enum('template1','template2','template3','template4') NOT NULL DEFAULT 'template1',
  `seller_shop` text NOT NULL,
  `favorite_materials` varchar(255) NOT NULL,
  `include_profile` varchar(255) NOT NULL DEFAULT 'All',
  `currency` varchar(150) NOT NULL DEFAULT 'USD',
  `region` varchar(200) NOT NULL DEFAULT 'EV',
  `languages` varchar(200) NOT NULL DEFAULT 'en',
  `privacy` enum('Yes','No') NOT NULL DEFAULT 'No',
  `twitter_id` varchar(50) NOT NULL,
  `mobile_verification` enum('No','Yes') NOT NULL DEFAULT 'No',
  `mobile_otp_code` varchar(50) NOT NULL,
  `credits` int(11) NOT NULL,
  `HttpReferer` int(11) NOT NULL,
  `fb_purchase_count` int(11) NOT NULL,
  `fb_discounttype` enum('Flat','Percentage') NOT NULL,
  `fb_discountvalue` int(11) NOT NULL,
  `affiliateId` varchar(50) NOT NULL,
  `freshdesk_status` enum('No','Yes') NOT NULL,
  `update_email` enum('Yes','No') NOT NULL DEFAULT 'No',
  `notification_email` longtext NOT NULL,
  `resetcode` varchar(20) NOT NULL,
  `resettime` datetime NOT NULL,
  `resetstatus` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `artfill_users`
--

INSERT INTO `artfill_users` (`id`, `send_req`, `withdraw_amt`, `loginUserType`, `gcm_buyer_id`, `gcm_seller_id`, `ios_device_id`, `full_name`, `user_name`, `last_name`, `about_us`, `group`, `email`, `password`, `status`, `is_verified`, `is_brand`, `created`, `modified`, `last_login_date`, `last_logout_date`, `last_login_ip`, `last_activity_visit`, `thumbnail`, `address`, `address2`, `city`, `district`, `state`, `country`, `postal_code`, `phone_no`, `s_address`, `s_city`, `s_district`, `s_state`, `s_country`, `s_postal_code`, `s_phone_no`, `brand_name`, `brand_description`, `commision`, `cod_available`, `web_url`, `bank_name`, `bank_no`, `bank_code`, `request_status`, `verify_code`, `feature_product`, `followers_count`, `following_count`, `followers`, `following`, `twitter`, `facebook`, `google`, `pinterest`, `birthday`, `about`, `age`, `gender`, `language`, `visibility`, `favorites_visibility`, `shop_visibility`, `display_lists`, `email_notifications`, `notifications`, `updates`, `products`, `lists`, `likes`, `location`, `following_user_lists`, `following_giftguide_lists`, `api_id`, `own_products`, `own_count`, `referId`, `want_count`, `refund_amount`, `paypal_email`, `product_template`, `shop_template`, `blog_template`, `seller_shop`, `favorite_materials`, `include_profile`, `currency`, `region`, `languages`, `privacy`, `twitter_id`, `mobile_verification`, `mobile_otp_code`, `credits`, `HttpReferer`, `fb_purchase_count`, `fb_discounttype`, `fb_discountvalue`, `affiliateId`, `freshdesk_status`, `update_email`, `notification_email`, `resetcode`, `resettime`, `resetstatus`) VALUES
(1, 'No', '0.00', 'normal', NULL, NULL, NULL, 'admin', 'admin', '', 'admin of the site', 'Seller', 'info@zoplay.com', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Yes', 'no', '2015-05-05 13:05:30', '2015-07-15 00:00:00', '2015-10-09 11:10:32', '2015-10-09 06:50:03', '192.168.1.72', '1444394920', '9002.jpg', 'ssssssssssssssssssss', 'ffffffffffffffffff', 'fhhhhhhhhhhhhhhhhhhhhhh', '', 'hhhjjjjjjjjjjjjjjjjjjjjjj', 'India', 56666666, '1236549870', '', '', '', '', '', 0, '', '', '', '3.80', 'Yes', '', '', '', '', 'Approved', 'QtBxP0RbXM', 0, 0, 0, '', '', '', '', '', '', 'Month-Day', '', '', 'Male', 'en', '', 'Public', 'Public', '', '', '', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, '0.00', 'vinubuyer1@gmail.com', 'left', 'three', 'template1', '', '', 'Shop,Favorite_items,Favorite_shops,Teams', 'USD', 'EV', 'en', 'No', '', 'Yes', '87665', 6, 0, 0, 'Flat', 0, 'admin123', 'No', 'No', 'follow,msg,like,lik_of_like,fav_shop_pro,fav_shop,', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artfill_user_activity`
--

CREATE TABLE IF NOT EXISTS `artfill_user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(200) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_time` varchar(200) NOT NULL,
  `activity_ip` varchar(100) NOT NULL,
  `show` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `view_action` enum('Not Yet','Seen') NOT NULL DEFAULT 'Not Yet',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_user_activity`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_user_payment`
--

CREATE TABLE IF NOT EXISTS `artfill_user_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `giftdiscountAmount` decimal(10,2) NOT NULL,
  `couponCode` varchar(255) NOT NULL,
  `coupontype` varchar(255) NOT NULL,
  `gift_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `giftcouponID` int(11) NOT NULL,
  `giftcouponcode` varchar(255) NOT NULL,
  `giftcoupontype` varchar(255) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `billingid` int(16) NOT NULL,
  `indtotal` varchar(255) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(255) NOT NULL,
  `shippingcountry` varchar(255) NOT NULL,
  `shippingcity` varchar(255) NOT NULL,
  `shippingstate` varchar(255) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(255) NOT NULL,
  `payu_transcation_id` varchar(100) NOT NULL,
  `dealCodeNumber` varchar(255) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `estDate` date NOT NULL,
  `reshipmentDate` date NOT NULL,
  `reshipId` varchar(200) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` varchar(255) NOT NULL,
  `digital_files` longtext NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(255) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund','Need reshipment','Product returned','Cancel refund','Cancel reshipment','ReShipped','Requested Cancel') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  `claim_amount` varchar(50) NOT NULL,
  `device` enum('Web','Mobile') NOT NULL DEFAULT 'Web',
  `seller_amount` varchar(100) NOT NULL,
  `admin_amount` varchar(100) NOT NULL,
  `admin_comm_percent` varchar(100) NOT NULL,
  `pay_key_id` varchar(100) NOT NULL,
  `correlation_id` varchar(100) NOT NULL,
  `shopTotal` decimal(10,2) NOT NULL,
  `twocheckout_transcation_id` varchar(100) NOT NULL,
  `admin_commission` decimal(10,2) NOT NULL,
  `cancelReason` varchar(200) NOT NULL,
  `cancelMessage` varchar(200) NOT NULL,
  `cancelledMessage` varchar(200) NOT NULL,
  `statusMessage` varchar(200) NOT NULL,
  `trackingId` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_user_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_user_product`
--

CREATE TABLE IF NOT EXISTS `artfill_user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` longtext NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `product_shipping` decimal(10,2) NOT NULL,
  `product_attribute` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseCount` int(11) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `web_link` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_user_product`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_user_shopping_carts`
--

CREATE TABLE IF NOT EXISTS `artfill_user_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_type` enum('Normal','Auction') NOT NULL DEFAULT 'Normal',
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `giftdiscountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(11) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `gift_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `giftcouponID` int(11) NOT NULL,
  `giftcouponcode` varchar(255) NOT NULL,
  `giftcoupontype` varchar(255) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping` enum('Yes','No') NOT NULL DEFAULT 'No',
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` varchar(255) NOT NULL,
  `digital_files` longtext NOT NULL,
  `pickup_option` varchar(255) NOT NULL,
  `prod_collection` varchar(255) NOT NULL,
  `ship_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_user_shopping_carts`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_vendor_payment_table`
--

CREATE TABLE IF NOT EXISTS `artfill_vendor_payment_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` mediumtext COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` mediumtext COLLATE utf8_bin NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8_bin NOT NULL DEFAULT 'pending',
  `vendor_id` bigint(20) NOT NULL,
  `country` varchar(150) COLLATE utf8_bin NOT NULL,
  `address1` longtext COLLATE utf8_bin NOT NULL,
  `address2` longtext COLLATE utf8_bin NOT NULL,
  `state` varchar(150) COLLATE utf8_bin NOT NULL,
  `city` varchar(150) COLLATE utf8_bin NOT NULL,
  `postal_code` varchar(50) COLLATE utf8_bin NOT NULL,
  `pay_status_csv` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_vendor_payment_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_wants`
--

CREATE TABLE IF NOT EXISTS `artfill_wants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artfill_wants`
--


-- --------------------------------------------------------

--
-- Table structure for table `artfill_zendesk_domain`
--

CREATE TABLE IF NOT EXISTS `artfill_zendesk_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `domain_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `zendesk_users` blob NOT NULL COMMENT 'user_id:zendesk_id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This table maintains zendesk domains and users list' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `artfill_zendesk_domain`
--

INSERT INTO `artfill_zendesk_domain` (`id`, `domain_name`, `domain_email`, `zendesk_users`, `created`) VALUES
(1, 'artfill', 'thomasmiller3592@gmail.com', 0x363a313133333631303937312c33333a313038303333383137312c34343a313132333038363137322c393a313132383531383137312c34353a313136333939313138322c35373a313234303232333438322c31323a313037373238363738322c, '2015-07-22 15:45:29');
