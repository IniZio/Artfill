<?php
phpinfo();die;
include_once('config-shopsy/databaseValues.php');
$conn = @mysql_pconnect($hostName,$dbUserName,$dbPassword) or die("Database Connection Failed<br>". mysql_error());
mysql_select_db($databaseName, $conn) or die('DB not selected'); 



echo mysql_query("ALTER TABLE `shopsy_user_payment` CHANGE `received_status` `received_status` ENUM('Not received yet','Product received','Need refund','Need reshipment','Product returned','Cancel refund','Cancel reshipment','ReShipped') CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL
");


echo mysql_query("ALTER TABLE  `shopsy_product` ADD  `product_promoted` ENUM(  'Promote',  'Unpromote' ) NOT NULL AFTER  `product_featured`");

echo mysql_query("DROP TABLE shopsy_contact_people");
echo '<br>';

echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `subject` longtext NOT NULL,
  `message` blob NOT NULL,
  `dataAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_status` enum('Unread','Read','Trash','Delete') NOT NULL DEFAULT 'Read',
  `receiver_status` enum('Unread','Read','Trash','Delete') NOT NULL DEFAULT 'Unread',
  `sender_starred` enum('Yes','No') NOT NULL,
  `receiver_starred` enum('Yes','No') NOT NULL,
  `mail_type` varchar(100) NOT NULL,
  `delivery_status` enum('Success','Fail') NOT NULL,
  `tid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
echo '<br>';


echo mysql_query("ALTER TABLE  `shopsy_admin_settings` ADD  `shop_index_page` BLOB NOT NULL AFTER  `landing_widget1`");
echo '<br>'; 



echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_advertising` (
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
										) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
echo '<br>';


echo mysql_query("ALTER TABLE `shopsy_users` ADD `gcm_buyer_id` VARCHAR( 250 ) NULL DEFAULT NULL AFTER `loginUserType` ,ADD `gcm_seller_id` VARCHAR( 250 ) NULL DEFAULT NULL AFTER `gcm_buyer_id` ,ADD `ios_device_id` VARCHAR( 250 ) NULL DEFAULT NULL AFTER `gcm_seller_id` ");
echo '<br>'; 



echo mysql_query("TRUNCATE TABLE `shopsy_notifications`");
echo '<br>';

echo mysql_query("ALTER TABLE `shopsy_notifications` ADD `view_mode` ENUM( 'Yes', 'No' ) NOT NULL DEFAULT 'Yes'");
echo '<br>';


 /* echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_ads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ad_area` varchar(400) NOT NULL,
  `ad_image` longtext NOT NULL,
  `ad_path` longtext NOT NULL,
  `ad_type` enum('Image','Script') NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  PRIMARY KEY (`id`)
) 
");

echo '<br>';

echo mysql_query("INSERT INTO `shopsy_ads` (`id`, `ad_area`, `ad_image`, `ad_path`, `ad_type`, `status`) VALUES
(1, 'Side Bar Image', '', 'http://runnable.com/UhIc93EfFJEMAADX/how-to-upload-file-in-codeigniter', 'Script', 'Publish'),
(4, 'Footer Image', '16367454.png', 'http://www.formget.com/codeigniter-upload-image/', 'Image', 'Publish')");

echo '<br>';



echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_index_banner_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_description` longtext NOT NULL,
  `show_banner_text` enum('Yes','No') NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
echo '<br>';



 echo mysql_query("ALTER TABLE `shopsy_admin_settings` ADD `membership` ENUM( 'Yes', 'No' ) NOT NULL DEFAULT 'No' AFTER `cod_payment` ,
ADD `membership_plan` ENUM( 'Day', 'Month', 'Year' ) NOT NULL DEFAULT 'Year' AFTER `membership` ,
ADD `membership_option` INT( 11 ) NOT NULL AFTER `membership_plan` ");
echo '<br>';

echo mysql_query("ALTER TABLE `shopsy_admin_settings` ADD `membership_price` DECIMAL( 10, 2 ) NOT NULL AFTER `membership_option`");
echo '<br>';

echo mysql_query("ALTER TABLE `shopsy_seller` ADD `membership_expiry` DATETIME NOT NULL AFTER `twitter_link` ");
echo '<br>';

echo mysql_query("ALTER TABLE `shopsy_seller` ADD `membership_status` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `membership_expiry` ");
echo '<br>';


echo mysql_query("ALTER TABLE `shopsy_admin_settings` ADD `admin_twitter_Consumer_key` MEDIUMTEXT NOT NULL AFTER `facebook_inivte_api_id` ,
ADD `admin_twitter_Consumer_Secret` MEDIUMTEXT NOT NULL AFTER `admin_twitter_Consumer_key` ");
echo "<br>";

echo mysql_query("ALTER TABLE `shopsy_admin_settings` CHANGE `membership_plan` `membership_plan` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL  ");
echo "<br>";

echo mysql_query("ALTER TABLE `shopsy_seller` CHANGE `membership_status` `membership_status` ENUM( '0', '1', '2', '3' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0'");
echo "<br>";

echo mysql_query("ALTER TABLE `shopsy_vendor_payment_table` ADD `pay_status_csv` ENUM( '0', '1' ) NOT NULL DEFAULT '1' AFTER `postal_code` ");
echo "<br>";


echo mysql_query("ALTER TABLE `shopsy_seller` ADD `dealCodeNumber` VARCHAR( 100 ) NOT NULL AFTER `twitter_link`  ");
echo "<br>";


echo mysql_query("
CREATE TABLE IF NOT EXISTS `shopsy_landing_banner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `banner_option` enum('image','html') NOT NULL DEFAULT 'image',
  `banner_text` longblob NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Unpublish',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
 ");
echo "<br>"; 


echo mysql_query("ALTER TABLE `shopsy_admin_settings` ADD `landing_widget1` BLOB NOT NULL AFTER `footer_widget4`");
echo '<br>';

echo mysql_query("TRUNCATE TABLE shopsy_ads");
echo '<br>';

echo mysql_query("ALTER TABLE `shopsy_users` ADD `twitter_id` VARCHAR( 50 ) NOT NULL AFTER `privacy` ");
echo '<br>';

echo mysql_query("INSERT INTO `shopsy_ads` (`id`, `ad_area`, `ad_image`, `ad_path`, `ad_type`, `status`) VALUES
(1, 'Side Bar Image', '', 'http://runnable.com/UhIc93EfFJEMAADX/how-to-upload-file-in-codeigniter', 'Script', 'Publish'),
(2, 'Footer Image', '16367454.png', 'http://www.formget.com/codeigniter-upload-image/', 'Image', 'Publish')");

echo '<br>'; */


 
echo mysql_query("ALTER TABLE `shopsy_product` ADD `base_price` DECIMAL( 10, 2 ) NOT NULL AFTER `price` ");
echo "<br>";





 echo mysql_query("ALTER TABLE `shopsy_admin_settings` CHANGE `product_cost` `product_cost` DECIMAL( 10, 2 ) NOT NULL DEFAULT 1.00");
 echo "<br>";
 
 echo mysql_query("ALTER TABLE `shopsy_admin_settings` CHANGE `product_commission` `product_commission` DECIMAL( 10, 2 ) NOT NULL DEFAULT 1");
 echo "<br>";



echo mysql_query("ALTER TABLE `shopsy_admin_settings` ADD `cod_payment` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `footer_widget4`;");

echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_cod_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` datetime NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

/***********************************************/

echo mysql_query("ALTER TABLE `shopsy_contact_people` CHANGE `dataAdded` `dataAdded` DATETIME NOT NULL ");


echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_registry_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL COMMENT 'user_id from shopsy_registry',
  `listing_id` int(11) NOT NULL COMMENT 'id from shopsy_product',
  `requested` int(3) NOT NULL DEFAULT '1',
  `purchased` int(3) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ");
echo '<br>';

/*
echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_cod_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` datetime NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
echo '<br>';


echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_states` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=904 ;");

echo mysql_query("INSERT INTO `shopsy_states` (`id`, `countryid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `tax_amt`) VALUES
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
(18, 215, 'FL', 'Florida', 'NA', 'florida', 'Active', '1', 0x3c703e3c7374726f6e673e54726176656c696e6720746f20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e466c6f72696461207661636174696f6e2072656e74616c7320616e6420466c6f72696461207661636174696f6e20686f6d6573206861766520616c77617973206265656e2065787472656d656c7920706f70756c6172207769746820746f7572697374732066726f6d206163726f73732074686520676c6f62652e205768656e20697420636f6d657320746f207669736974696e67207468652055532c207468697320697320757375616c6c792074686520666972737420706c61636520746861742070656f706c65207468696e6b206f662e20497420697320626f726465726564206279207468652041746c616e746963204f6365616e20616e642069732074686520383c7375703e74683c2f7375703e2062696767657374206369747920696e207465726d73206f662069747320706f70756c6174696f6e2e2054686520636c696d617465207468726f7567686f7574207468652073746174652076617269657320617320697420697320736f206c617267652c20696e636c75646520626f74682073756274726f706963616c20616e642074726f706963616c2c20646570656e64696e672077686572652061626f757420696e207468652073746174652070656f706c65206172652073746179696e672e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5468696e677320746f20646f20696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e416674657220626f6f6b696e6720696e746f20466c6f72696461207661636174696f6e2072656e74616c7320616e6420466c6f72696461207661636174696f6e20686f6d65732c20746865726520617265206365727461696e6c7920706c656e7479206f6620706c6163657320746f20676f20776974682066616d696c6965732c20667269656e64732c206f72206a757374206173206120636f75706c652e20546865204d69616d69205a6f6f206973206365727461696e6c7920746f70206f6e206d616e792070656f706c65732073686f72746c6973742c2073696d706c7920626563617573652069742068617320736f206d75636820746f206f666665722076697369746f72732061742073756368206120726561736f6e61626c652070726963652e20496e20666163742c206d616e792070656f706c6520696e2074686520555320636f6e7369646572207468697320746f206265207468652062657374206f6620616c6c20746865205a6f6f73206f6e2061206e6174696f6e776964652062617369732e20546865206772656174207468696e672074686174206365727461696e6c792063616e20626520736169642061626f75742074686973205a6f6f206973207468617420746865206c6f63616c20636c696d61746520616c6c6f777320746865205a6f6f206b65657065727320746f207265706c69636174652074686520636c696d61746573206f662041667269636120616e64204175737472616c69612c207768696368206d65616e73207468617420746865792063616e206b65657020616e2065787472656d656c7920776964652072616e6765206f6620646966666572656e7420616e696d616c7320686572652c206d616b696e672069742065787472656d656c7920696e746572657374696e6720616e642076617269656420666f722076697369746f72732e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e416674657220636865636b696e6720696e746f2061207661636174696f6e2072656e74616c2070726f706572747920696e20466c6f726964612c20616e6f74686572206f7074696f6e206d6967687420626520746f20766973697420746865205365617175617269756d207768696368206973206c6f636174656420686572652e2054686973206973206c6f6361746564207269676874206e65787420746f2074686520746f7572697374206172656120696e207468652063697479206f66204d69616d6920616e64206f66666572732070656f706c6520616e20696e736967687420696e746f20746865206c6f63616c20736561206c6966652c20686f7720697420686173206368616e67656420616e6420686f772069742077696c6c20636f6e74696e756520746f206368616e67652e20546869732074656e647320746f20626520616e2065787472656d656c7920677265617420646179206f757420666f722066616d696c6965732c2061732074686579206861766520746865206f70706f7274756e69747920666f72207468656972206368696c6472656e20746f2061637475616c6c7920686176652066756e2c20627574206c6561726e2061206c6f7420616c6f6e672074686520776179206174207468652073616d652074696d652c207768696368206973206365727461696e6c7920696465616c2e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e4f6620636f757273652c2061207472697020746f20466c6f7269646120776f756c64206365727461696e6c79206e6f7420626520636f6d706c65746520776974686f75742061207472697020746f207468652062656163682e204d69616d69206973206365727461696e6c79206f6e65206f6620746865206661766f7572697465206c6f636174696f6e73207768656e20697420636f6d657320746f2068697474696e67207468652062656163682c206173206974206f666665727320736f6d65206f66207468652062657374206265616368657320696e2074686520776f726c642e205468657265206973206e6f20646f7562742074686174207468697320697320747275652c2061732074686f7573616e6473206f662070656f706c65207669736974207468656d2065766572792073696e676c65206461792e204f6620636f757273652c20746865792074656e6420746f206765742061206c6f742062757369657220647572696e67207468652073756d6d6572206d6f6e74687320616e6420746865726520697320616c7761797320706c656e747920676f696e67206f6e20696e207465726d73206f662073706f72747320616e64206f7468657220616374697669746965732e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e4163636f6d6d6f646174696f6e7320696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e546865206163636f6d6d6f646174696f6e7320696e20466c6f726964612072616e67652061206772656174206465616c20746f2074727920616e64207375697420646966666572656e742062756467657473207768657265206576657220706f737369626c652e20466f7220696e7374616e63652c2074686572652061726520627564676574206d6f74656c732c2062757420616c736f20746f70207175616c6974792076696c6c617320617265207468652073616d652074696d652e205468652041637175616c696e61205265736f727420616e6420537061206973206f6e65206f662074686f736520746f70207175616c69747920666163696c6974696573207468617420696e636f72706f72617465207468652067726561742076696c6c617320616e6420657863656c6c656e7420666163696c697469657320616e642074656e6420746f20626520666f722074686f73652070656f706c65207468617420686176652061206c6172676572206275646765742e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5765617468657220696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e546865207765617468657220696e20466c6f72696461206973206365727461696e6c792077686174206174747261637473206d616e792070656f706c6520746f20746865206172656120616e6420697320736f6d657468696e672074686174206861732068656c70656420746f206d616b652074686973206120706f70756c617220746f75726973742064657374696e6174696f6e2e20447572696e67207468652073756d6d6572206d6f6e7468732c206578706563742074656d70657261747572657320746f2068697420746865206c696b6573206f6620333820266465673b43206f6e206d616e79206f63636173696f6e732c2077686963682068656c707320746f206d616b652074686973206665656c206c696b65206120736f6d6520776861742074726f706963616c20686f6c696461792e3c2f703e, ''),
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
(902, 95, 'JHK', 'Jharkand', 'AS', 'jharkand', 'Active', '0', '', ''); ");
echo "<br>";
echo mysql_query("CREATE TABLE IF NOT EXISTS `shopsy_seller_tax` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ");
echo "<br>";

echo mysql_query("UPDATE `shopsy_users` SET `last_activity_visit` = '0' ");
echo "<br>";
echo mysql_query("ALTER TABLE `shopsy_users` CHANGE `last_activity_visit` `last_activity_visit` VARCHAR( 200 ) NOT NULL  ");
echo "<br>";

echo mysql_query("ALTER TABLE `shopsy_user_activity` CHANGE `activity_time` `activity_time` VARCHAR( 200 ) NOT NULL ");
echo "<br>";

*/
echo mysql_query("ALTER TABLE  `shopsy_seller` ADD  `facebook_link` TEXT NULL ,
ADD  `twitter_link` TEXT NULL");

echo "<br>";

mysql_close();
?>