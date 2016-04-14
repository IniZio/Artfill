<?php
/***********  fresh desk routes start here  *******/
$route['freshdesk-tickets'] = "site/seller_support/freshdesk"; 
$route['send-ticket-message'] = "site/seller_support/send_ticket_note"; 
$route['view-ticket/(:any)'] = "site/seller_support/freshdesk_view_message/$1"; 
$route['view-ticket-list/(:any)'] = "site/seller_support/freshdesk_veiw_ticket/$1"; 
/***********  fresh desk routes end here  *******/
?>