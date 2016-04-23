<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->helper(array('cookie', 'date', 'form', 'email'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('order_model');
        $this->load->model('product_model');

        $this->data['loginCheck'] = $this->checkLogin('U');

    }

    /**
     *
     * Loading Order Page
     */

    public function index()
    {
        if ($this->data['loginCheck'] != '') {
            $this->data['meta_title'] = $this->data['heading'] = 'Order Confirmation';
            if ($this->uri->segment(2) == 'giftsuccess') {
                if ($this->uri->segment(4) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(4);
                    $Pray_Email = '';
                }

                $GiftSuccessCheck = $this->order_model->get_all_details(GIFTCARDS_TEMP, array('user_id' => $this->uri->segment(3)));
                if ($GiftSuccessCheck->num_rows() > 0) {
                    $this->data['Confirmation'] = $this->order_model->PaymentGiftSuccess($this->uri->segment(3), $transId, $Pray_Email);
                }

                redirect("order/confirmation/gift");
            } elseif ($this->uri->segment(2) == 'subscribesuccess') {
                $transId    = $this->uri->segment(4);
                $Pray_Email = '';

                $this->data['Confirmation'] = $this->order_model->PaymentSubscribeSuccess($this->uri->segment(3), $transId);
                redirect("order/confirmation/subscribe");

            } elseif ($this->uri->segment(2) == 'success') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $PaymentSuccessCheck = $this->order_model->get_all_details(PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($PaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->PaymentSuccess($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }
                redirect("order/confirmation/cart");
                //$this->load->view('site/order/order.php',$this->data);

            } elseif ($this->uri->segment(2) == 'sellersuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $UserPaymentSuccessCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($UserPaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentSuccess($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }

                redirect("order/confirmation/cart");
                //$this->load->view('site/order/order.php',$this->data);
            } elseif ($this->uri->segment(2) == 'payusuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txnid'];
                    $Pray_Email = $_REQUEST['email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $UserPaymentSuccessCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($UserPaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentPayuSuccess($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }

                redirect("order/confirmation/cart");
                //$this->load->view('site/order/order.php',$this->data);
            }
            /// ****** Cash on delivery success url *****/////
            elseif ($this->uri->segment(2) == 'codsuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $UserPaymentSuccessCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($UserPaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentCOD($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }

                redirect("order/cod/cart");

            } elseif ($this->uri->segment(2) == 'wiretransfersuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $UserPaymentSuccessCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($UserPaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentCOD($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }

                redirect("order/wiretransfer/cart");

            } elseif ($this->uri->segment(2) == 'westernunionsuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }
                $UserPaymentSuccessCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($UserPaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentCOD($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                }

                redirect("order/westernunion/cart");

            } elseif ($this->uri->segment(2) == 'twocheckoutsuccess') {

                $tranid = $_REQUEST['invoice_id'];
                $email  = $_REQUEST['email'];
                $order  = explode("_", $_REQUEST['merchant_order_id']);

                $user_id  = $order[0];
                $order_id = $order[1];

                $this->data['Confirmation'] = $this->order_model->UserPaymenttwocheckoutSuccess($user_id, $tranid, $email, $order_id);

                redirect("order/confirmation/cart");
                //$this->load->view('site/order/order.php',$this->data);
            } elseif ($this->uri->segment(2) == 'pesapalsuccess') {

                $tranid                     = $this->uri->segment(5);
                $email                      = $_REQUEST['email'];
                $orderid                    = $this->uri->segment(4);
                $this->data['Confirmation'] = $this->order_model->UserPaymentPesapal($this->uri->segment(3), $tranid, $email, $orderid);
                redirect("order/confirmation/cart");
            }

            // Cod success Ends
            elseif ($this->uri->segment(2) == 'productsuccess') {
                $totAmt = $this->uri->segment(3);
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }

                $this->data['Confirmation'] = $this->order_model->UserPaymentProductSuccess($this->uri->segment(4), $totAmt, $transId, $Pray_Email);

                redirect("order/confirmation/product");
                //$this->load->view('site/order/order.php',$this->data);

            } elseif ($this->uri->segment(2) == 'wallet_payment') {
                $totAmt        = $this->uri->segment(3);
                $user_idd      = $this->uri->segment(4);
                $seller        = $this->order_model->get_all_details(USERS, array("id" => $user_idd))->result_array();
                $wallet_amount = $totAmt / $this->data['currencyValue'];
                $wallet        = $seller[0]['credits'] + $wallet_amount;
                $this->order_model->update_details(USERS, array('credits' => $wallet), array("id" => $user_idd));

                //$this->data['Confirmation'] = $this->order_model->UserPaymentProductSuccess($this->uri->segment(4),$totAmt,$transId,$Pray_Email);
                redirect("order/confirmation/product");
                //$this->load->view('site/order/order.php',$this->data);
            } elseif ($this->uri->segment(2) == 'successgift') {

                $transId                    = 'gift-' . $this->uri->segment(4);
                $Pray_Email                 = '';
                $this->data['Confirmation'] = $this->order_model->UserPaymentSuccess($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email);
                redirect("order/confirmation");

            } elseif ($this->uri->segment(2) == 'productfailure') {
                $this->data['meta_title']  = $this->data['Confirmation']  = 'Failure';
                $this->data['errors']      = $this->uri->segment(3);
                $this->data['productPage'] = 'ProductRedirect';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'failure') {
                $paypalAdaptive = $this->data['paypal_adaptive_settings'];
                if ($paypalAdaptive['status'] == 'Enable') {
                    $lastFeatureInsertId = $this->session->userdata('UserrandomNo');
                    $condition3          = array('dealCodeNumber' => $lastFeatureInsertId);
                    $this->order_model->commonDelete(USER_PAYMENT, $condition3);
                    $paymtdata = array('UserrandomNo' => '');
                    $this->session->set_userdata($paymtdata);
                }

                $this->data['meta_title'] = $this->data['Confirmation'] = 'Failure';
                $this->data['errors']     = $this->uri->segment(3);
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'notify') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'Failure';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'confirmation') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'Success';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'cod') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'Cod';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'wiretransfer') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'wiretransfer';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'westernunion') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'westernunion';
                $this->load->view('site/order/order.php', $this->data);
            } elseif ($this->uri->segment(2) == 'userCreditsuccess') {
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }

                $userCredits = "userCredits";

                $PaymentSuccessCheck = $this->order_model->get_all_details(PAYMENT, array('user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4), 'status' => 'Paid'));
                if ($PaymentSuccessCheck->num_rows() == 0) {
                    $this->data['Confirmation'] = $this->order_model->UserPaymentSuccess($this->uri->segment(3), $this->uri->segment(4), $transId, $Pray_Email, $userCredits);
                }
                redirect("order/confirmation/cart");
                //$this->load->view('site/order/order.php',$this->data);
            } elseif ($this->uri->segment(2) == 'payonsuccess') {
                $totAmt = $this->uri->segment(3);
                if ($this->uri->segment(5) == '') {
                    $transId    = $_REQUEST['txn_id'];
                    $Pray_Email = $_REQUEST['payer_email'];
                } else {
                    $transId    = $this->uri->segment(5);
                    $Pray_Email = '';
                }

                $this->data['Confirmation'] = $this->order_model->UserPaymentProductSuccess($this->uri->segment(4), $totAmt, $transId, $Pray_Email, 'payon');
                redirect("order/confirmation/cart");
            } elseif ($this->uri->segment(2) == 'payonfailiure') {
                $this->data['meta_title'] = $this->data['Confirmation'] = 'Failure';
                $this->data['errors']     = urldecode($this->uri->segment(3));
                $this->load->view('site/order/order.php', $this->data);
            }

        } else {
            redirect('login');
        }
    }

    public function UserWalletPaymentProductSuccess()
    {

        $userid    = $loginUserId    = $this->checkLogin('U');
        $total     = $_POST['total'];
        $paymtdata = array(
            'shopsy_session_user_id' => $userid,
        );
        $this->session->set_userdata($paymtdata);

        //Update Payment Table
        $condition1 = array('user_id' => $userid, 'status' => 'UnPublish', 'pay_status' => 'Pending');

        $dataArr1 = array('pay_status' => 'Paid', 'status' => 'Publish', 'pay_amount' => $total, 'pay_date' => date('Y-m-d H:i:s'), 'pay_type' => 'Wallet');

        $this->order_model->update_details(PRODUCT, $dataArr1, $condition1);

        //echo $this->db->last_query();

        //echo 'Success';

        $seller = $this->order_model->get_all_details(USERS, array("id" => $userid))->result_array();
        $wallet = $seller[0]['credits'] - $total;
        $this->order_model->update_details(USERS, array('credits' => $wallet), array("id" => $userid));

        //echo $this->db->last_query(); die;

    }

    /**
     *
     * Insert the data from paypal ipn
     *
     */
    public function ipnpayment()
    {
        mysql_query('CREATE TABLE IF NOT EXISTS '.TRANSACTIONS.' ( `id` int(11) NOT NULL AUTO_INCREMENT,`payment_cycle` varchar(255) NOT NULL,`txn_type` varchar(255) NOT NULL, `last_name` varchar(255) NOT NULL,`next_payment_date` varchar(255) NOT NULL, `residence_country` varchar(255) NOT NULL, `initial_payment_amount` varchar(255) NOT NULL, `currency_code` varchar(255) NOT NULL, `time_created` varchar(255) NOT NULL, `verify_sign` varchar(750) NOT NULL, `period_type` varchar(255) NOT NULL, `payer_status` varchar(255) NOT NULL, `test_ipn` varchar(255) NOT NULL, `tax` varchar(255) NOT NULL, `payer_email` varchar(255) NOT NULL, `first_name` varchar(255) NOT NULL, `receiver_email` varchar(255) NOT NULL, `payer_id` varchar(255) NOT NULL, `product_type` varchar(255) NOT NULL, `shipping` varchar(255) NOT NULL, `amount_per_cycle` varchar(255) NOT NULL, `profile_status` varchar(255) NOT NULL, `charset` varchar(255) NOT NULL, `notify_version` varchar(255) NOT NULL, `amount` varchar(255) NOT NULL, `outstanding_balance` varchar(255) NOT NULL, `recurring_payment_id` varchar(255) NOT NULL, `product_name` varchar(255) NOT NULL,`custom_values` varchar(255) NOT NULL, `ipn_track_id` varchar(255) NOT NULL, `tran_date` datetime NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;');

        mysql_query("insert into ".TRANSACTIONS." set  payment_cycle='".$_REQUEST['payment_cycle']."', txn_type='".$_REQUEST['txn_type']."', last_name='".$_REQUEST['last_name']."',
        next_payment_date='".$_REQUEST['next_payment_date']."', residence_country='".$_REQUEST['residence_country']."', initial_payment_amount='".$_REQUEST['initial_payment_amount']."',
        currency_code='".$_REQUEST['currency_code']."', time_created='".$_REQUEST['time_created']."', verify_sign='".$_REQUEST['verify_sign']."', period_type= '".$_REQUEST['period_type']."', payer_status='".$_REQUEST['payer_status']."', test_ipn='".$_REQUEST['test_ipn']."', tax='".$_REQUEST['tax']."', payer_email='".$_REQUEST['payer_email']."', first_name='".$_REQUEST['first_name']."', receiver_email='".$_REQUEST['receiver_email']."', payer_id='".$_REQUEST['payer_id']."', product_type='".$_REQUEST['product_type']."', shipping='".$_REQUEST['shipping']."', amount_per_cycle='".$_REQUEST['amount_per_cycle']."', profile_status='".$_REQUEST['profile_status']."', charset='".$_REQUEST['charset']."',
        notify_version='".$_REQUEST['notify_version']."', amount='".$_REQUEST['amount']."', outstanding_balance='".$_REQUEST['payment_status']."', recurring_payment_id='".$_REQUEST['txn_id']."', product_name='".$_REQUEST['product_name']."', custom_values ='".$_REQUEST['custom']."', ipn_track_id='".$_REQUEST['ipn_track_id']."', tran_date=NOW()");

        $this->data['heading'] = 'Order Confirmation';
        if($_REQUEST['payment_status'] == 'Completed'){
                    
        	if (isset($_REQUEST['paytype']) && $_REQUEST['paytype']=='adaptive'){
                    	$newcustom[0] = 'SellerProduct';
                    	$newcustom[1] = $_REQUEST['uid'];
                    	$newcustom[2] = $_REQUEST['dealcode'];
                    } else {
                    	$newcustom = explode('|',$_REQUEST['custom']);
                    }

            if($newcustom[0]=='Product'){
                        $userdata = array('shopsy_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
                        $this->session->set_userdata($userdata);
                        $transId = $_REQUEST['txn_id'];
                        $Pray_Email = $_REQUEST['payer_email'];
                        $this->data['Confirmation'] = $this->order_model->PaymentSuccess($newcustom[1],$newcustom[2],$transId,$Pray_Email);
                        //$userdata = array('shopsy_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
                        $this->session->unset_userdata($userdata);
                    }elseif($newcustom[0]=='Gift'){
                        $userdata = array('shopsy_session_user_id' => $newcustom[1]);
                        $this->session->set_userdata($userdata);
                        $transId = $_REQUEST['txn_id'];
                        $Pray_Email = $_REQUEST['payer_email'];
                        $this->data['Confirmation'] = $this->order_model->PaymentGiftSuccess($newcustom[1],$transId,$Pray_Email);
                        //$userdata = array('shopsy_session_user_id' => $newcustom[1]);
                        $this->session->unset_userdata($userdata);
                    }elseif($newcustom[0]=='SellerProduct'){
                        $userdata = array('shopsy_session_user_id' => $newcustom[1],'UserrandomNo' => $newcustom[2]);
                        $this->session->set_userdata($userdata);
                        $transId = $_REQUEST['txn_id'];
                        $Pray_Email = $_REQUEST['payer_email'];
                        $this->data['Confirmation'] = $this->order_model->UserPaymentSuccess($newcustom[1],$newcustom[2],$transId,$Pray_Email);
                        //$userdata = array('shopsy_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
                        $this->session->unset_userdata($userdata);

            }elseif($newcustom[0]=='SellerProductPayment'){
                        $userdata = array('shopsy_session_user_id' => $newcustom[1]);
                        $this->session->set_userdata($userdata);
                        $transId = $_REQUEST['txn_id'];
                        $Pray_Email = $_REQUEST['payer_email'];
                        $this->data['Confirmation'] = $this->order_model->UserPaymentProductSuccess($newcustom[1],$transId,$Pray_Email);
                        //$userdata = array('shopsy_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
                        $this->session->unset_userdata($userdata);
                    }

        }
}

    /**
     *
     * Insert the product comments
     *
     */
    public function insert_product_comment()
    {
        $uid                      = $this->checkLogin('U');
        $returnStr['status_code'] = 0;
        $comments                 = $this->input->post('comments');
        $product_id               = $this->input->post('cproduct_id');
        $datestring               = "%Y-%m-%d %h:%i:%s";
        $time                     = time();
        $conditionArr             = array('comments' => $comments, 'user_id' => $uid, 'product_id' => $product_id, 'status' => 'InActive', 'dateAdded' => mdate($datestring, $time));
        $this->order_model->simple_insert(PRODUCT_COMMENTS, $conditionArr);
        $cmtID       = $this->order_model->get_last_insert_id();
        $datestring  = "%Y-%m-%d %h:%i:%s";
        $time        = time();
        $createdTime = mdate($datestring, $time);
        $actArr      = array(
            'activity'    => 'own-product-comment',
            'activity_id' => $product_id,
            'user_id'     => $this->checkLogin('U'),
            'activity_ip' => $this->input->ip_address(),
            'created'     => $createdTime,
            'comment_id'  => $cmtID,
        );
        $this->order_model->simple_insert(NOTIFICATIONS, $actArr);
        $this->send_comment_noty_mail($cmtID, $product_id);
        $returnStr['status_code'] = 1;
        echo json_encode($returnStr);
    }

    /**
     *
     * Send the common notify mail to comments
     * param Int $cmtID
     * param Int $pid
     *
     */
    public function send_comment_noty_mail($cmtID = '0', $pid = '0')
    {
        if ($this->checkLogin('U') != '') {
            if ($cmtID != '0' && $pid != '0') {
                $productUserDetails = $this->product_model->get_product_full_details($pid);
                if ($productUserDetails->num_rows() == 1) {
                    $emailNoty = explode(',', $productUserDetails->row()->email_notifications);
                    if (in_array('comments', $emailNoty)) {
                        $commentDetails = $this->product_model->view_product_comments_details('where c.id=' . $cmtID);
                        if ($commentDetails->num_rows() == 1) {
                            if ($productUserDetails->prodmode == 'seller') {
                                $prodLink = base_url() . 'things/' . $productUserDetails->row()->id . '/' . url_title($productUserDetails->row()->product_name, '-');
                            } else {
                                $prodLink = base_url() . 'user/' . $productUserDetails->row()->user_name . '/things/' . $productUserDetails->row()->seller_product_id . '/' . url_title($productUserDetails->row()->product_name, '-');
                            }

                            $newsid               = '1';
                            $template_values      = $this->order_model->get_newsletter_template_details($newsid);
                            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'full_name' => $commentDetails->row()->full_name, 'product_name' => $productUserDetails->row()->product_name, 'user_name' => $commentDetails->row()->user_name);
                            extract($adminnewstemplateArr);
                            $subject = $this->config->item('email_title') . ' - ' . $template_values['news_subject'];

                            $message .= '<!DOCTYPE HTML>
								<html>
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
								<meta name="viewport" content="width=device-width"/>
								<title>' . $template_values['news_subject'] . '</title>
								<body>';
                            include './newsletter/registeration' . $newsid . '.php';

                            $message .= '</body>
								</html>';

                            if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
                                $sender_email = $this->data['siteContactMail'];
                                $sender_name  = $this->data['siteTitle'];
                            } else {
                                $sender_name  = $template_values['sender_name'];
                                $sender_email = $template_values['sender_email'];
                            }

                            $email_values = array('mail_type' => 'html',
                                'from_mail_id'                    => $sender_email,
                                'mail_name'                       => $sender_name,
                                'to_mail_id'                      => $productUserDetails->row()->email,
                                'subject_message'                 => $subject,
                                'body_messages'                   => $message,
                            );
                            $email_send_to_common = $this->product_model->common_email_send($email_values);
                        }
                    }
                }
            }
        }
    }

    /**
     *
     * Display the view discussion
     * param Int $orderID
     *
     */
    public function discussion($orderID = '')
    {
        if ($this->checkLogin('U') != '' || $this->checkLogin('A') != '') {
            if ($this->checkLogin('A') != '' && $this->checkLogin('U') == '') {
                $checkUser = $this->order_model->get_all_details(USERS, array('id' => $this->checkLogin('A')));
                if ($checkUser->num_rows() == 1) {
                    $userdata1 = array('shopsy_session_user_id' => '', 'shopsy_session_user_name' => '', 'shopsy_session_full_name' => '', 'shopsy_session_user_email' => '', 'shopsy_session_temp_id' => '');
                    $this->session->unset_userdata($userdata1);
                    $this->session->unset_userdata('currency_data');
                    $this->session->unset_userdata('region');
                    delete_cookie("Shopsy_NewUser");

                    $userdata = array(
                        'shopsy_session_user_id'    => $checkUser->row()->id,
                        'shopsy_session_user_name'  => $checkUser->row()->user_name,
                        'shopsy_session_full_name'  => $checkUser->row()->full_name,
                        'shopsy_session_user_email' => $checkUser->row()->email,
                        'userType'                  => $checkUser->row()->group,
                    );
                }
                $this->session->set_userdata($userdata);
                $this->data['loginCheck'] = $checkUser->row()->id;
                $this->setErrorMessage('success', 'Welcome, Admin');
            }
            $this->data['heading']  = 'Order Discussion';
            $this->data['ViewList'] = $this->order_model->order_discussion_init($orderID);
            //echo '<pre>'; print_r($this->data['ViewList']->result()); die;

            $this->data['ordercomments'] = $ordercomments = $this->order_model->get_all_details(ORDER_COMMENTS, array('orderid' => $orderID), array(array('field' => 'post_time', 'type' => 'desc')));
            #echo $ordercomments->num_rows();

            #$this->data['segmentidd'] = $segmentidd = $this->order_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderID));
            $this->data['segmentidd']      = $this->order_model->get_all_details(ORDER_CLAIM, array('dealcodenumber' => $orderID));
            $this->data['shipping_status'] = $this->order_model->get_all_details(USER_PAYMENT, array('dealCodeNumber' => $orderID));
            $this->data['claimstatus']     = $claimstatus     = $this->order_model->get_all_details(ORDER_CLAIM, array('dealcodenumber' => $orderID));
            #echo '<pre>'; print_r($this->data['claimstatus']->result()); die;

            if ($this->checkLogin('U') != "") {
                $activity_id = $orderID;
                $this->product_model->ExecuteQuery("UPDATE " . NOTIFICATIONS . " SET `view_mode` = 'No' WHERE activity_id=" . $activity_id . " AND (activity='discussion' OR activity='own-order-discussion')");
            }

            $this->load->view('site/order/discussion', $this->data);
        } else {
            redirect('login');
        }
    }

    /**
     *
     * Insert the dispute or discussion image
     *
     */
    public function ajax_load_Files()
    {
        /* $config['overwrite'] = FALSE;
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['max_size'] = 2000;
        $config['upload_path'] = './images/dispute_images';
        $this->load->library('upload', $config);
        if ( $this->upload->do_upload('file_upload_attach')){
        $logoDetails = $this->upload->data();
        echo $logoDetails['file_name'];
        } */
        //dispute_attachment
        //print_r($_FILES);
        $path = "images/dispute_images/";
        $file = preg_replace('/\s+/', '_', $_FILES["file_upload_attach"]["name"]);
        if ($_FILES["file_upload_attach"]["name"] != '') {
            move_uploaded_file($_FILES["file_upload_attach"]["tmp_name"], $path . $file);
            echo $file;
        }
    }

    /* public function load_ajax_DigiFiles_list($filename) {
    $id=time();
    $path = "dispute_images/";
    echo '<tr>
    <td width="70%">
    &nbsp;
    <a href="'.$path.$filename.'" target="_blank">'.$filename.'</a>
    <input type="hidden" value="'.$filename.'" class="DigiFiles" name="DigiFiles[]">
    </td>
    <td width="26%">
    <a class="close_icon" href="javascript:void(0);" style="margin:7px 0 0 5px" id="'.$id.'"></a>
    </td>
    </tr>';
    } */

    /**
     *
     * Loading the images using ajax for discussion
     *
     */
    public function load_ajax_DigiFiles_list($filename)
    {
        $id   = time();
        $path = "images/dispute_images/";
//             echo '<tr>
        //                 <td width="70%">
        //                     &nbsp;
        //                     <img src="'.$path.trim($filename).'" style="width:100px;">
        //                     <input type="hidden" value="'.trim($filename).'" class="DigiFiles" name="DigiFiles[]">
        //                 </td>
        //                 <td width="26%">
        //                     <a class="close_icon" href="javascript:void(0);" style="margin:7px 0 0 5px" id="'.$id.'"></a>
        //                 </td>
        //             </tr>';

        echo '<td>
					<img src="' . $path . trim($filename) . '" style="width:100px;">
					<input type="hidden" value="' . trim($filename) . '" class="DigiFiles" name="DigiFiles[]">
					<a onclick="removeDigiFiles(this)" class="close_icon" href="javascript:void(0);" style="margin:7px 0 0 5px" id="' . $id . '"></a>
				</td>
			</tr>';

    }

    /**
     *
     * Insert the comments for dispute or discussion
     *
     */
    public function postcomment()
    {
        $orderid      = $this->input->post('orderidd');
        $post_message = $this->input->post('post_message');
        $buyerid      = $this->input->post('buyerid');
        $sellerid     = $this->input->post('sellerid');
        $post_time    = date('Y-m-d H:i:s');

        $orderinformation = $this->order_model->get_order_details($orderid);

        if ($this->checkLogin('U') == $buyerid) {
            $posted_by     = 'buyer';
            $sender_name   = $orderinformation->row()->buyer_name;
            $sender_email  = $orderinformation->row()->buyer_mail;
            $receive_email = $orderinformation->row()->seller_mail;
            $ccmail        = $this->data['siteContactMail'];
        } elseif ($this->checkLogin('U') == $sellerid) {
            $posted_by     = 'seller';
            $sender_name   = $orderinformation->row()->seller_name;
            $sender_email  = $orderinformation->row()->seller_mail;
            $receive_email = $orderinformation->row()->buyer_mail;
            $ccmail        = $this->data['siteContactMail'];
        } else {
            $posted_by     = 'admin';
            $sender_name   = $this->data['siteTitle'] . ' Admin';
            $sender_email  = $this->data['siteContactMail'];
            $receive_email = $orderinformation->row()->buyer_mail . ',' . $orderinformation->row()->seller_mail;
            $ccmail        = '';
        }

        $sellernamee                = $orderinformation->row()->seller_name;
        $this->data['selleremaill'] = $this->order_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));

        $postArr = array(
            'orderid'      => $orderid,
            'posted_by'    => $posted_by,
            'posted_id'    => $this->checkLogin('U'),
            'post_message' => $post_message,
            'post_time'    => $post_time,
            'status'       => 'Publish',
        );
        $this->order_model->simple_insert(ORDER_COMMENTS, $postArr);
        $lastidd = $this->db->insert_id();

        $digitalfile = $this->input->post('DigiFiles');

        #echo $digitalfile; exit;
        for ($i = 1; $i < sizeof($digitalfile); $i++) {
            if ($digitalfile[$i] != '') {
                @copy('./images/dispute_images/' . $digitalfile[$i]);
                $digitalValues .= $digitalfile[$i] . ',';
            }
        }
        $dataArr   = array('image' => $digitalValues);
        $condition = array('id' => $lastidd);
        $this->product_model->edit_dispute_attachment($dataArr, $condition);

        /*mailing process starts here*/
        $newsid = '10';

        $template_values      = $this->order_model->get_newsletter_template_details($newsid);
        $subject              = 'From: ' . $this->config->item('email_title');
        $discussionurl        = base_url() . 'discussion/' . $orderid;
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
        extract($adminnewstemplateArr);
        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid . '.php';
        $message .= '</body>
		</html>';
        $email_values = array('mail_type' => 'html',
            'from_mail_id'                    => $sender_email,
            'mail_name'                       => $sender_name,
            'to_mail_id'                      => $receive_email,
            'cc_mail_id'                      => $ccmail,
            #'subject_message'=>$template_values['news_subject'],
            'subject_message'                 => 'Discussion Mail',
            'body_messages'                   => $message,
        );
        #print_r($email_values); #exit;
        $email_send_to_common = $this->order_model->common_email_send($email_values);

        /*mailing process starts here for buyer*/
        $newsid1              = '21';
        $template_values      = $this->order_model->get_newsletter_template_details($newsid1);
        $subject              = 'From: ' . $this->config->item('email_title');
        $discussionurl        = base_url() . 'discussion/' . $orderid;
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
        extract($adminnewstemplateArr);
        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid1 . '.php';
        $message .= '</body>
		</html>';
        $email_values_buyer = array('mail_type' => 'html',
            'from_mail_id'                          => $this->data['siteContactMail'],
            'mail_name'                             => $this->data['siteTitle'] . ' Admin',
            'to_mail_id'                            => $this->data['selleremaill']->row()->email,
            'cc_mail_id'                            => '',
            'subject_message'                       => 'Discussion Mail',
            'body_messages'                         => $message,
        );
        #'to_mail_id'=>$orderinformation->row()->buyer_mail,
        #'subject_message'=>$template_values['news_subject'],
        #print_r($email_values_buyer); exit;
        /* echo $header;
        echo $message; exit; */
        $email_send_to_common = $this->order_model->common_email_send($email_values_buyer);

        $ordercomments = $this->order_model->get_all_details(ORDER_COMMENTS, array('orderid' => $orderid), array(array('field' => 'post_time', 'type' => 'desc')));
        foreach ($ordercomments->result() as $comments) {
            $posterinfo = $this->order_model->get_all_details(USERS, array('id' => $comments->posted_id));
            if ($posterinfo->row()->thumbnail != '') {
                $post_img = $posterinfo->row()->thumbnail;
            } else {
                $post_img = 'profile_pic.png';
            }
            /*time frame*/
            $datediff = time() - strtotime($comments->post_time);
            $diffdate = floor($datediff / (60 * 60 * 24));
            if ($diffdate != 0) {
                if ($diffdate < 4) {
                    $cmtTime = $diffdate . ' days ago';

                } else {
                    $cmtTime = date('m/d/y', strtotime($comments->post_time));
                }
            } else {
                if (floor($datediff / (60 * 60)) < 1) {
                    if (floor($datediff / (60)) > 0) {
                        $cmtTime = floor($datediff / (60)) . ' mins ago';
                    } else {
                        $cmtTime = 'just now';
                    }
                } else {
                    $cmtTime = floor($datediff / (60 * 60)) . ' hours ago';
                }
            }
            if ($comments->posted_id == $this->checkLogin('U')) {
                $post_by = 'You - ' . $posterinfo->row()->user_name;
            } else {
                $post_by = $comments->posted_by . ' - ' . $posterinfo->row()->user_name;
            }
            $commentsDeatail .= '<tr class="postCMT">
				<td class="post_img">
					<a href="view-people/' . $posterinfo->row()->user_name . '">
						<img src="images/users/thumb/' . $post_img . '" alt="' . $post_img . '" class="post_imgthumb" />
					</a>
				</td>
				<td class="post_msg" width="95%">
					<p class="post_by"><a href="view-people/' . $posterinfo->row()->user_name . '"><strong>' . ucfirst($post_by) . '</strong></a></p>
					<p class="post_message">' . $comments->post_message . '</p>
					<p class="cmtTime">' . $cmtTime . '</p>
				</td>
			</tr>';
        }
        echo $commentsDeatail . '|<^>|' . $ordercomments->num_rows;
        redirect(base_url() . 'discussion/' . $orderid);
    }

    /**
     *
     * Insert the claim for dispute
     *
     */
    public function postclaim()
    {
        $orderid      = $this->input->post('orderid');
        $post_message = $this->input->post('post_message');
        $buyerid      = $this->input->post('buyerid');
        $sellerid     = $this->input->post('sellerid');
        $post_time    = date('Y-m-d H:i:s');
        $grand_total  = $this->input->post('grand_total');

        $dataupdat      = array('claim_amount' => $grand_total);
        $conditionupdat = array('dealCodeNumber' => $orderid);
        $this->order_model->update_details(USER_PAYMENT, $dataupdat, $conditionupdat);

        $claimArr = array(
            'seller_id'      => $sellerid,
            'buyer_id'       => $buyerid,
            'dealcodenumber' => $orderid,
            'total_amount'   => $grand_total,
            'status'         => 'Opened',
        );

        $exists_dealcode = $this->order_model->get_all_details(ORDER_CLAIM, array('dealcodenumber' => $orderid));
        if ($exists_dealcode->num_rows() == 0) {
            $this->order_model->simple_insert(ORDER_CLAIM, $claimArr);
            $last_id = $this->db->insert_id();
        }
        $orderinformation = $this->order_model->get_order_details($orderid);

        if ($this->checkLogin('U') == $buyerid) {
            $posted_by     = 'buyer';
            $sender_name   = $orderinformation->row()->buyer_name;
            $sender_email  = $orderinformation->row()->buyer_mail;
            $receive_email = $orderinformation->row()->seller_mail;
            $ccmail        = $this->data['siteContactMail'];
        } elseif ($this->checkLogin('U') == $sellerid) {
            $posted_by     = 'seller';
            $sender_name   = $orderinformation->row()->seller_name;
            $sender_email  = $orderinformation->row()->seller_mail;
            $receive_email = $orderinformation->row()->buyer_mail;
            $ccmail        = $this->data['siteContactMail'];
        } else {
            $posted_by     = 'admin';
            $sender_name   = $this->data['siteTitle'] . ' Admin';
            $sender_email  = $this->data['siteContactMail'];
            $receive_email = $orderinformation->row()->buyer_mail . ',' . $orderinformation->row()->seller_mail;
            $ccmail        = '';
        }

        $sellernamee                = $orderinformation->row()->seller_name;
        $this->data['selleremaill'] = $this->order_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));

        $postArr = array(
            'orderid'      => $orderid,
            'posted_by'    => $posted_by,
            'posted_id'    => $this->checkLogin('U'),
            'post_message' => $post_message,
            'post_time'    => $post_time,
            'status'       => 'Publish',
            /* 'claim_id'      =>  $last_id */
        );
        $this->order_model->simple_insert(ORDER_COMMENTS, $postArr);

        /*mailing process starts here*/
        $newsid               = '10';
        $template_values      = $this->order_model->get_newsletter_template_details($newsid);
        $subject              = 'From: ' . $this->config->item('email_title');
        $discussionurl        = base_url() . 'discussion/' . $orderid;
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
        extract($adminnewstemplateArr);
        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid . '.php';
        $message .= '</body>
		</html>';
        $email_values = array('mail_type' => 'html',
            'from_mail_id'                    => $sender_email,
            'mail_name'                       => $sender_name,
            'to_mail_id'                      => $receive_email,
            'cc_mail_id'                      => $ccmail,
            #'subject_message'=>$template_values['news_subject'],
            'subject_message'                 => 'Dispute Mail',
            'body_messages'                   => $message,
        );
        /*echo $header;
        echo $message; exit;*/
        #print_r($email_values);
        $email_send_to_common = $this->order_model->common_email_send($email_values);

        /*mailing process starts here for buyers*/
        $newsid1              = '21';
        $message              = "";
        $template_values      = $this->order_model->get_newsletter_template_details($newsid1);
        $subject              = 'From: ' . $this->config->item('email_title');
        $discussionurl        = base_url() . 'discussion/' . $orderid;
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
        extract($adminnewstemplateArr);
        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid1 . '.php';
        $message .= '</body>
		</html>';
        $email_values_buyer = array('mail_type' => 'html',
            'from_mail_id'                          => $this->data['siteContactMail'],
            'mail_name'                             => $this->data['siteTitle'] . ' Admin',
            #'to_mail_id'=>$orderinformation->row()->buyer_mail,
            'to_mail_id'                            => $this->data['selleremaill']->row()->email,
            'cc_mail_id'                            => '',
            #'subject_message'=>$template_values['news_subject'],
            'subject_message'                       => 'Dispute Mail',
            'body_messages'                         => $message,
        );
        #print_r($email_values_buyer); exit;
        /*echo $header;
        echo $message; exit;*/
        //$email_send_to_common = $this->order_model->common_email_send($email_values_buyer);

        $ordercomments = $this->order_model->get_all_details(ORDER_COMMENTS, array('orderid' => $orderid), array(array('field' => 'post_time', 'type' => 'desc')));
        foreach ($ordercomments->result() as $comments) {
            $posterinfo = $this->order_model->get_all_details(USERS, array('id' => $comments->posted_id));
            if ($posterinfo->row()->thumbnail != '') {
                $post_img = $posterinfo->row()->thumbnail;
            } else {
                $post_img = 'profile_pic.png';
            }
            /*time frame*/
            $datediff = time() - strtotime($comments->post_time);
            $diffdate = floor($datediff / (60 * 60 * 24));
            if ($diffdate != 0) {
                if ($diffdate < 4) {
                    $cmtTime = $diffdate . ' days ago';
                } else {
                    $cmtTime = date('m/d/y', strtotime($comments->post_time));
                }
            } else {
                if (floor($datediff / (60 * 60)) < 1) {
                    if (floor($datediff / (60)) > 0) {
                        $cmtTime = floor($datediff / (60)) . ' mins ago';
                    } else {
                        $cmtTime = 'just now';
                    }
                } else {
                    $cmtTime = floor($datediff / (60 * 60)) . ' hours ago';
                }
            }
            if ($comments->posted_id == $this->checkLogin('U')) {
                $post_by = 'You - ' . $posterinfo->row()->user_name;
            } else {
                $post_by = $comments->posted_by . ' - ' . $posterinfo->row()->user_name;
            }
            $commentsDeatail .= '<tr class="postCMT">
				<td class="post_img">
					<a href="view-people/' . $posterinfo->row()->user_name . '">
						<img src="images/users/thumb/' . $post_img . '" alt="' . $post_img . '" class="post_imgthumb" />
					</a>
				</td>
				<td class="post_msg" width="95%">
					<p class="post_by"><a href="view-people/' . $posterinfo->row()->user_name . '"><strong>' . ucfirst($post_by) . '</strong></a></p>
					<p class="post_message">' . $comments->post_message . '</p>
					<p class="cmtTime">' . $cmtTime . '</p>
				</td>
			</tr>';
        }
        echo $commentsDeatail . '|<^>|' . $ordercomments->num_rows;
    }

    /**
     *
     * Update the dispute or discussion and send mail to user,seller and admin
     *
     */
    public function closedclaim()
    {
        #echo '<pre>'; print_r($_POST); die;
        $orderid      = $this->input->post('orderidd');
        $post_message = $this->input->post('postcmt');
        $buyerid      = $this->input->post('buyerid');
        $sellerid     = $this->input->post('sellerid');
        $post_time    = date('Y-m-d H:i:s');
        $grand_total  = $this->input->post('grand_total');

        $post_dispute   = $this->input->post('post_dispute');
        $solved_dispute = $this->input->post('solved_dispute');

        #echo $solved_dispute; exit;

        $orderinformation = $this->order_model->get_order_details($orderid);

        if ($this->checkLogin('U') == $buyerid) {
            $posted_by     = 'buyer';
            $sender_name   = $orderinformation->row()->buyer_name;
            $sender_email  = $orderinformation->row()->buyer_mail;
            $receive_email = $orderinformation->row()->seller_mail;
            $ccmail        = $this->data['siteContactMail'];
        } elseif ($this->checkLogin('U') == $sellerid) {
            $posted_by     = 'seller';
            $sender_name   = $orderinformation->row()->seller_name;
            $sender_email  = $orderinformation->row()->seller_mail;
            $receive_email = $orderinformation->row()->buyer_mail;
            $ccmail        = $this->data['siteContactMail'];
        } else {
            $posted_by     = 'admin';
            $sender_name   = $this->data['siteTitle'] . ' Admin';
            $sender_email  = $this->data['siteContactMail'];
            $receive_email = $orderinformation->row()->buyer_mail . ',' . $orderinformation->row()->seller_mail;
            $ccmail        = '';
        }

        $sellernamee = $orderinformation->row()->seller_name;

        $this->data['selleremaill'] = $this->order_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));

        $postArr = array(
            'orderid'      => $orderid,
            'posted_by'    => $posted_by,
            'posted_id'    => $this->checkLogin('U'),
            'post_message' => $post_message,
            'post_time'    => $post_time,
            'status'       => 'Publish',
            /* 'claim_id'      =>  $last_id */
        ); #echo '<pre>'; print_r($postArr); die;
        $this->order_model->simple_insert(ORDER_COMMENTS, $postArr);
        $lastidd = $this->db->insert_id();
        #echo $lastidd; exit;

        //if($this->input->post('DigiFiles')!=''){
        $digitalfile = $this->input->post('DigiFiles');
        //echo "<pre>"; print_r($digitalfile); die;
        //$timeFile=time();
        for ($i = 1; $i < sizeof($digitalfile); $i++) {
            #@copy('./dispute_images/'.$digitalfile[$i], './digital_files/'.$timeFile.$digitalfile[$i]);
            @copy('./images/dispute_images/' . $digitalfile[$i]);
            //$digitalValues .=$timeFile.$digitalfile[$i].',';
            $digitalValues .= $digitalfile[$i] . ',';
        }
        #$attr_digital = array('image' => $digitalValues,'id' => $lastidd);
        #$this->product_model->add_subproduct_insert($attr_digital);

        $dataArr = array('image' => $digitalValues);
        #print_r($dataArr); exit;
        $condition = array('id' => $lastidd);
        $this->product_model->edit_dispute_attachment($dataArr, $condition);
        //}

        if ($solved_dispute == "Solved Dispute") {
            /*mailing process starts here*/
            $newsid               = '22';
            $template_values      = $this->order_model->get_newsletter_template_details($newsid);
            $subject              = 'From: ' . $this->config->item('email_title');
            $discussionurl        = base_url() . 'discussion/' . $orderid;
            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
            extract($adminnewstemplateArr);
            $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

            $message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
            include './newsletter/registeration' . $newsid . '.php';
            $message .= '</body>
			</html>';
            $email_values = array('mail_type' => 'html',
                'from_mail_id'                    => $sender_email,
                'mail_name'                       => $sender_name,
                'to_mail_id'                      => $receive_email,
                'cc_mail_id'                      => $ccmail,
                #'subject_message'=>$template_values['news_subject'],
                'subject_message'                 => 'Dispute Mail',
                'body_messages'                   => $message,
            );
            /* print_r($email_values);
            echo $header;
            echo $message; exit; */
            $email_send_to_common = $this->order_model->common_email_send($email_values);

            /*mailing process starts here for buyers*/
            $newsid1              = '23';
            $message              = "";
            $template_values      = $this->order_model->get_newsletter_template_details($newsid1);
            $subject              = 'From: ' . $this->config->item('email_title');
            $discussionurl        = base_url() . 'discussion/' . $orderid;
            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
            extract($adminnewstemplateArr);
            $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

            $message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
            include './newsletter/registeration' . $newsid1 . '.php';
            $message .= '</body>
			</html>';
            $email_values_buyer = array('mail_type' => 'html',
                'from_mail_id'                          => $this->data['siteContactMail'],
                'mail_name'                             => $this->data['siteTitle'] . ' Admin',
                #'to_mail_id'=>$orderinformation->row()->buyer_mail,
                'to_mail_id'                            => $this->data['selleremaill']->row()->email,
                #'subject_message'=>$template_values['news_subject'],
                'subject_message'                       => 'Dispute Mail',
                'body_messages'                         => $message,
            );
            /* print_r($email_values);
            echo $header;
            echo $message; exit; */
            $email_send_to_common = $this->order_model->common_email_send($email_values_buyer);
        } else {
            /*mailing process starts here*/
            $newsid               = '10';
            $message              = "";
            $template_values      = $this->order_model->get_newsletter_template_details($newsid);
            $subject              = 'From: ' . $this->config->item('email_title');
            $discussionurl        = base_url() . 'discussion/' . $orderid;
            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
            extract($adminnewstemplateArr);
            $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

            $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
            include './newsletter/registeration' . $newsid . '.php';
            $message .= '</body>
		</html>';
            $email_values = array('mail_type' => 'html',
                'from_mail_id'                    => $sender_email,
                'mail_name'                       => $sender_name,
                'to_mail_id'                      => $receive_email,
                'cc_mail_id'                      => $ccmail,
                #'subject_message'=>$template_values['news_subject'],
                'subject_message'                 => 'Dispute Mail',
                'body_messages'                   => $message,
            );
            #print_r($email_values);
            /* echo $header;
            echo $message; exit; */
            $email_send_to_common = $this->order_model->common_email_send($email_values);

            /*mailing process starts here for buyer*/
            $newsid2              = '21';
            $message              = "";
            $template_values      = $this->order_model->get_newsletter_template_details($newsid2);
            $subject              = 'From: ' . $this->config->item('email_title');
            $discussionurl        = base_url() . 'discussion/' . $orderid;
            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'));
            extract($adminnewstemplateArr);
            $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

            $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
            include './newsletter/registeration' . $newsid2 . '.php';
            $message .= '</body>
		</html>';
            $email_values_buyer = array('mail_type' => 'html',
                'from_mail_id'                          => $this->data['siteContactMail'],
                'mail_name'                             => $this->data['siteTitle'] . ' Admin',
                #'to_mail_id'=>$orderinformation->row()->buyer_mail,
                'to_mail_id'                            => $this->data['selleremaill']->row()->email,
                #'subject_message'=>$template_values['news_subject'],
                'subject_message'                       => 'Dispute Mail',
                'body_messages'                         => $message,
            );
            #print_r($email_values_buyer); exit;
            /* echo $header;
            echo $message; exit; */
            $email_send_to_common = $this->order_model->common_email_send($email_values_buyer);
        }

        $ordercomments = $this->order_model->get_all_details(ORDER_COMMENTS, array('orderid' => $orderid), array(array('field' => 'post_time', 'type' => 'desc')));
        foreach ($ordercomments->result() as $comments) {
            $posterinfo = $this->order_model->get_all_details(USERS, array('id' => $comments->posted_id));
            if ($posterinfo->row()->thumbnail != '') {
                $post_img = $posterinfo->row()->thumbnail;
            } else {
                $post_img = 'profile_pic.png';
            }
            /*time frame*/
            $datediff = time() - strtotime($comments->post_time);
            $diffdate = floor($datediff / (60 * 60 * 24));
            if ($diffdate != 0) {
                if ($diffdate < 4) {
                    $cmtTime = $diffdate . ' days ago';
                } else {
                    $cmtTime = date('m/d/y', strtotime($comments->post_time));
                }
            } else {
                if (floor($datediff / (60 * 60)) < 1) {
                    if (floor($datediff / (60)) > 0) {
                        $cmtTime = floor($datediff / (60)) . ' mins ago';
                    } else {
                        $cmtTime = 'just now';
                    }
                } else {
                    $cmtTime = floor($datediff / (60 * 60)) . ' hours ago';
                }
            }
            if ($comments->posted_id == $this->checkLogin('U')) {
                $post_by = 'You - ' . $posterinfo->row()->user_name;
            } else {
                $post_by = $comments->posted_by . ' - ' . $posterinfo->row()->user_name;
            }
            $commentsDeatail .= '<tr class="postCMT">
				<td class="post_img">
					<a href="view-people/' . $posterinfo->row()->user_name . '">
						<img src="images/users/thumb/' . $post_img . '" alt="' . $post_img . '" class="post_imgthumb" />
					</a>
				</td>
				<td class="post_msg" width="95%">
					<p class="post_by"><a href="view-people/' . $posterinfo->row()->user_name . '"><strong>' . ucfirst($post_by) . '</strong></a></p>
					<p class="post_message">' . $comments->post_message . '</p>
					<p class="cmtTime">' . $cmtTime . '</p>
				</td>
			</tr>';
        }
        echo $commentsDeatail . '|<^>|' . $ordercomments->num_rows;
        redirect(base_url() . 'discussion/' . $orderid);
    }

    /**
     *
     * Display Download the digital files to particular user
     * param Int $user_id
     * param Int $dealcode
     *
     */
    public function digital_files($user_id = '', $dealcode = '')
    {
        $dealcode = $this->encrypt->decode(strtr($dealcode, '-.~', '+/='));
        $user_id  = $this->encrypt->decode(strtr($user_id, '-.~', '+/='));

        $UserCheck = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $user_id, 'dealCodeNumber' => $dealcode, 'status' => 'Paid'));
        if ($UserCheck->num_rows() > 0) {
            $this->data['UserData'] = $checkUser = $this->order_model->get_all_details(USERS, array('id' => $user_id));
            ###$this->data['orderInfo']=$orderInfo= $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $user_id, 'dealCodeNumber' => $dealcode,'status'=>'Paid'));
            $this->data['orderInfo'] = $this->order_model->order_discussion_init($dealcode, $user_id);
            $this->data['heading']   = 'Digital Files Downloading';
            $this->load->view('site/order/digitalfile.php', $this->data);
        } else {
            $this->setErrorMessage('error', 'You are not a valid user');
            redirect(base_url());
        }
    }

    /**
     *
     * Download the digital files to particular user and particular file
     * param String $file_name
     * param Int $dealcode
     * param Int $user_id
     *
     */
    public function donwload($file_name = '', $dealCode = '', $user_id = '')
    {
        $UserCheck  = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $user_id, 'dealCodeNumber' => $dealCode, 'status' => 'Paid'));
        $fileArrr   = @explode(',', rtrim($UserCheck->row()->digital_files, ','));
        $i          = 0;
        $file_exist = 0;
        foreach ($fileArrr as $files) {
            if ($files == $file_name) {
                unset($fileArrr[$i]);
                $file_exist++;

            }
            $i++;
        }
        if (!empty($fileArrr)) {
            $newVal = implode(',', $fileArrr) . ',';
        } else {
            $newVal = '';
        }
        $dataArr      = array('digital_files' => $newVal);
        $conditionArr = array('id' => $UserCheck->row()->id);
        $this->order_model->update_details(USER_PAYMENT, $dataArr, $conditionArr);
        $dataArry = array('user_id' => $UserCheck->row()->user_id, 'order_id' => $UserCheck->row()->dealCodeNumber, 'file_name' => $file_name, 'download_time' => date('Y-m-d H:i:s'), 'p_id' => $UserCheck->row()->product_id);
        $this->order_model->simple_insert(DIGITAL_FILE_HISTORY, $dataArry);

        if ($file_exist > 0) {
            $this->load->helper('download');
            $data = file_get_contents(base_url() . 'digital_files/' . $file_name);
            force_download($file_name, $data);
            #redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     *
     * Download the expiry or not
     *
     */
    public function expire_link()
    {
        $this->setErrorMessage('error', 'This Link has been used already ');
        redirect();
    }

    public function cancelOrder()
    {
        // echo "<pre>"; print_r($_POST);DIE;

        $dataupdat['received_status'] = 'Requested Cancel';
        $dataupdat['cancelReason']    = $_POST['reason'];
        $dataupdat['cancelMessage']   = $_POST['message_text'];

        $orderid = $_POST['dealcode_number'];

        $conditionupdat = array('dealCodeNumber' => $orderid);
        $this->order_model->update_details(USER_PAYMENT, $dataupdat, $conditionupdat);

        //         echo $this->db->last_query();
        //         die;

        $sender_email  = $_POST['useremail'];
        $sender_name   = $_POST['username'];
        $receive_email = $_POST['selleremail'];
        $ccmail        = $this->data['siteContactMail'];
        $reason        = $_POST['reason'];
        $post_message  = $_POST['message_text'];

        $buyer  = $_POST['username'];
        $seller = $_POST['sellername'];
        $newsid = '34';

        $template_values = $this->order_model->get_newsletter_template_details($newsid);
        $subject         = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
        $discussionurl   = base_url() . 'discussion/' . $orderid;

        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'), 'reason' => $reason, 'post_message' => $post_message, 'buyer' => $buyer, 'seller' => $seller);

        extract($adminnewstemplateArr);

        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid . '.php';
        $message .= '</body>
		</html>';
        $email_values = array('mail_type' => 'html',
            'from_mail_id'                    => $sender_email,
            'mail_name'                       => $sender_name,
            'to_mail_id'                      => $receive_email,
            'cc_mail_id'                      => $ccmail,
            'bcc_mail_id'                     => $sender_email,
            'subject_message'                 => $template_values['news_subject'],
            'body_messages'                   => $message,
        );
        /*echo $header;
        echo $message; exit;*/
        //echo '<pre>'; print_r($email_values);    die;
        $email_send_to_common = $this->order_model->common_email_send($email_values);

        redirect('purchase-review');
    }

    /**
     *
     * Common post claim open dispute
     *
     */
    public function dispute_attachment_common()
    {

        # echo "<pre>"; print_r($this->input->post());die;

        $dispute      = '';
        $callmode     = $this->input->post('callmode');
        $orderid      = $this->input->post('orderid');
        $post_message = $this->input->post('postcmt');
        $buyerid      = $this->input->post('buyerid');
        $sellerid     = $this->input->post('sellerid');
        $post_time    = date('Y-m-d H:i:s');
        $grand_total  = $this->input->post('grand_total');
        $postDispute  = $this->input->post('post_dispute');

        $reshipDate = $this->input->post('reshipDate');
        $reshipId   = $this->input->post('reshipId');

        $ref = $this->input->post('post_refund');

//         if($_POST['post_dispute'] == 'Cancel order'){
        //             $dataupdat = array('shipping_status'=>'Cancel Process');
        //             $dataupdat['received_status'] = 'Requested Cancel';
        //             $conditionupdat = array('dealCodeNumber'=>$orderid);
        //             $this->order_model->update_details(USER_PAYMENT,$dataupdat,$conditionupdat);
        //         }
        ///echo $this->db->last_query();
        //die;

        $conditionupdat = array('dealCodeNumber' => $orderid);
        $reshiparray    = array();

        if (isset($reshipDate) && $reshipDate != '') {
            $reshiparray['reshipmentDate'] = $reshipDate;
        }

        if (isset($reshipId) && $reshipId != '') {
            $reshiparray['reshipId'] = $reshipId;
        }

        //print_r($reshiparray);# die;
        //print_r(count($reshiparray));# die;
        if (count($reshiparray) > 0) {
            $this->order_model->update_details(USER_PAYMENT, $reshiparray, $conditionupdat);
        }

        if ($ref != '') {
            //echo "assssd<br>";

            if ($ref == 'ReShipment' || $ref == 'Refund') {
                $dataupdat = array('shipping_status' => $ref);
            }

//             if($ref = 'Reordered'){
            //                 $dataupdat=array('shipping_status'=> 'Reordered');
            //                 //$dataupdat=array('received_status'=> 'Reordered');
            //             }

            $conditionupdat = array('dealCodeNumber' => $orderid);
            $this->order_model->update_details(USER_PAYMENT, $dataupdat, $conditionupdat);
            //echo '<pre>'; print_r($this->db->last_query())."<br>";
        }
        //echo '<pre>'; print_r($this->db->last_query())."<br>";

        //echo $postDispute;//die;

        if ($postDispute == 'Open a Dispute') {

            //echo "Open a Dispute";

            $dataupdat      = array('claim_amount' => $grand_total);
            $conditionupdat = array('dealCodeNumber' => $orderid);
            $this->order_model->update_details(USER_PAYMENT, $dataupdat, $conditionupdat);

            $claimArr = array('seller_id' => $sellerid,
                'buyer_id'                    => $buyerid,
                'dealcodenumber'              => $orderid,
                'total_amount'                => $grand_total,
                'status'                      => 'Opened',
            );

            $exists_dealcode = $this->order_model->get_all_details(ORDER_CLAIM, array('dealcodenumber' => $orderid));

            //echo "<br>$##$#"; print_r($exists_dealcode);

            if ($exists_dealcode->num_rows() == 0) {
                $this->order_model->simple_insert(ORDER_CLAIM, $claimArr);
                $last_id = $this->db->insert_id();
            }

            //echo '<pre>'; print_r($this->db->last_query())."<br>";

            $orderinformation = $this->order_model->get_order_details($orderid);

            /************       Zendesk Create Ticket For Dispute   Open :       ***************
             * Place - Controller/site/order/dispute_attachment_common()
             **/
            if ($this->config->item('zendesk_status') === "Active") {
                $ticket_data['ticket'] = array(
                    "subject"          => 'Dispute for the order #' . $orderid,
                    "description"      => $post_message,
                    "requester"        => $orderinformation->row->buyer_mail,
                    "email"            => $orderinformation->row->buyer_mail,
                    "priority"         => 'urgent',
                    "collaborator_ids" => array($orderinformation->row->zendesk_id),
                    'type'             => 'problem',
                );
                $ticket_data['dispute_id'] = $last_id;
                $ticket_data['url']        = '/tickets';
                $ticket_data['type']       = 'POST';
                $this->load->library('curl');
                $url      = base_url() . 'site/zendesk/create_zendesk_ticket';
                $response = $this->curl->simple_post($url, $ticket_data);
            }

/**************** Zendesk  Create Ticket For Dispute Open End  **************/

        }

        $orderid          = $this->input->post('orderid');
        $orderinformation = $this->order_model->get_order_details($orderid);
        //print_r($orderinformation); die;

        $activity = "discussion";
        if ($this->checkLogin('U') == $buyerid) {
            $posted_by     = 'buyer';
            $sender_name   = $orderinformation->row()->buyer_name;
            $sender_email  = $orderinformation->row()->buyer_mail;
            $receive_email = $orderinformation->row()->seller_mail;
            $ccmail        = $this->data['siteContactMail'];

        } elseif ($this->checkLogin('U') == $sellerid) {
            $posted_by     = 'seller';
            $activity      = "own-order-discussion";
            $sender_name   = $orderinformation->row()->seller_name;
            $sender_email  = $orderinformation->row()->seller_mail;
            $receive_email = $orderinformation->row()->buyer_mail;
            $ccmail        = $this->data['siteContactMail'];
        } else {
            $posted_by     = 'admin';
            $sender_name   = $this->data['siteTitle'] . ' Admin';
            $sender_email  = $this->data['siteContactMail'];
            $receive_email = $orderinformation->row()->buyer_mail . ',' . $orderinformation->row()->seller_mail;
            $ccmail        = '';
        }

        $sellernamee                = $orderinformation->row()->seller_name;
        $this->data['selleremaill'] = $this->order_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));

        $postArr = array(
            'orderid'      => $orderid,
            'posted_by'    => $posted_by,
            'posted_id'    => $this->checkLogin('U'),
            'post_message' => $post_message,
            'post_time'    => $post_time,
            'status'       => 'Publish',
        );
        $this->order_model->simple_insert(ORDER_COMMENTS, $postArr);
        $lastIid = $this->db->insert_id();

        $actArr = array('activity' => $activity,
            'activity_id'              => $orderid,
            'user_id'                  => $this->checkLogin('U'),
            'activity_ip'              => $this->input->ip_address(),
            'created'                  => date("Y-m-d H:i:s"),
            'comment_id'               => $lastIid);
        $this->user_model->simple_insert(NOTIFICATIONS, $actArr);

        if ($posted_by != 'seller') {
            /*Push Message Starts*/
            $message = $sender_name . ' also posted message in your discussion board on ' . $this->config->item('email_title');
            $type    = 'discussion';
            $this->sendPushNotification($sellerid, $message, $type, array($lastIid));
            /*Push Message Ends*/
        }

        $digitalfile = $this->input->post('DigiFiles');

        for ($i = 1; $i < sizeof($digitalfile); $i++) {
            if ($digitalfile[$i] != '') {
                @copy('./images/dispute_images/' . $digitalfile[$i]);
                $digitalValues .= $digitalfile[$i] . ',';
            }
        }

        $dataArr   = array('image' => $digitalValues);
        $condition = array('id' => $lastIid);
        $this->product_model->edit_dispute_attachment($dataArr, $condition);
        #echo $this->db->last_query(); echo '<pre>'; print_r($dataArr);die;

        /*mailing process starts here*/

        if ($postDispute == 'Solved Dispute') {
            $newsid = '22';
            $this->order_model->update_details(ORDER_CLAIM, array('status' => 'Closed'), array('dealcodenumber' => $orderid));
        } else {
            //$newsid='10';
            $newsid = '36';
        }

        if ($postDispute == 'Open a Dispute') {
            $dispute = 'New Dispute (ID:' . $last_id . ') has been opened';
        }
        if ($postDispute == 'Reship a new product') {
            $dispute = 'The Order has been Processed';
        }

        $template_values      = $this->order_model->get_newsletter_template_details($newsid);
        $subject              = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
        $discussionurl        = base_url() . 'discussion/' . $orderid;
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'footer_content' => $this->config->item('footer_content'), 'dispute' => $dispute);
        extract($adminnewstemplateArr);
        $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
        include './newsletter/registeration' . $newsid . '.php';
        $message .= '</body>
		</html>';
        $email_values = array('mail_type' => 'html',
            'from_mail_id'                    => $sender_email,
            'mail_name'                       => $sender_name,
            'to_mail_id'                      => $receive_email,
            'cc_mail_id'                      => $ccmail,
            'bcc_mail_id'                     => $sender_email,
            'subject_message'                 => $template_values['news_subject'],
            'body_messages'                   => $message,
        );
        /*echo $header;
        echo $message; exit;*/
        //echo '<pre>'; print_r($email_values);    die;
        $email_send_to_common = $this->order_model->common_email_send($email_values);

        if ($postDispute == 'Reship a new product') {

            $oldOrder = $this->order_model->get_all_details(USER_PAYMENT, array('user_id' => $buyerid, 'dealCodeNumber' => $orderid, 'sell_id' => $sellerid))->result_Array();

            $oldOrder[0]['shipping_date']   = '';
            $oldOrder[0]['estDate']         = '';
            $oldOrder[0]['reshipmentDate']  = '';
            $oldOrder[0]['reshipId']        = '';
            $oldOrder[0]['tracking_id']     = '';
            $oldOrder[0]['shipping_status'] = 'Processed';

            $oldOrder[0]['received_status'] = 'Not received yet';
            $oldOrder[0]['review_status']   = 'Not open';
            $oldOrder[0]['claim_amount']    = '';

            $oldOrder[0]['cancelReason']     = '';
            $oldOrder[0]['cancelMessage']    = '';
            $oldOrder[0]['cancelledMessage'] = '';
            $oldOrder[0]['statusMessage']    = '';
            $oldOrder[0]['trackingId']       = '';

            $id = $oldOrder[0]['id'];
            unset($oldOrder[0]['id']);
            $this->order_model->update_details(USER_PAYMENT, $oldOrder[0], array('id' => $id));

        }

        $ordercomments = $this->order_model->get_all_details(ORDER_COMMENTS, array('orderid' => $orderid), array(array('field' => 'post_time', 'type' => 'desc')));
        foreach ($ordercomments->result() as $comments) {
            $posterinfo = $this->order_model->get_all_details(USERS, array('id' => $comments->posted_id));
            if ($posterinfo->row()->thumbnail != '') {
                $post_img = $posterinfo->row()->thumbnail;
            } else {
                $post_img = 'profile_pic.png';
            }
            /*time frame*/
            $datediff = time() - strtotime($comments->post_time);
            $diffdate = floor($datediff / (60 * 60 * 24));
            if ($diffdate != 0) {
                if ($diffdate < 4) {
                    $cmtTime = $diffdate . ' days ago';
                } else {
                    $cmtTime = date('m/d/y', strtotime($comments->post_time));
                }
            } else {
                if (floor($datediff / (60 * 60)) < 1) {
                    if (floor($datediff / (60)) > 0) {
                        $cmtTime = floor($datediff / (60)) . ' mins ago';
                    } else {
                        $cmtTime = 'just now';
                    }
                } else {
                    $cmtTime = floor($datediff / (60 * 60)) . ' hours ago';
                }
            }
            if ($comments->posted_id == $this->checkLogin('U')) {
                $post_by = 'You - ' . $posterinfo->row()->user_name;
            } else {
                $post_by = $comments->posted_by . ' - ' . $posterinfo->row()->user_name;
            }
            $commentsDeatail .= '<tr class="postCMT">
				<td class="post_img">
					<a href="view-people/' . $posterinfo->row()->user_name . '">
						<img src="images/users/thumb/' . $post_img . '" alt="' . $post_img . '" class="post_imgthumb" />
					</a>
				</td>
				<td class="post_msg" width="95%">
					<p class="post_by"><a href="view-people/' . $posterinfo->row()->user_name . '"><strong>' . ucfirst($post_by) . '</strong></a></p>
					<p class="post_message">' . $comments->post_message . '</p>
					<p class="cmtTime">' . $cmtTime . '</p>
				</td>
			</tr>';
        }

        //die;

        //echo $commentsDeatail.'|<^>|'.$ordercomments->num_rows;;
        //die;

        if ($callmode == 'php') {
            if ($postDispute == 'Reship a new product') {
                redirect(base_url() . 'shops/' . $this->data['selectSellershop_details'][0]['id'] . '/shop-orders');
            } else {
                redirect(base_url() . 'discussion/' . $orderid);
            }
        } else {
            //forajax
            echo "1";
        }
    }

    /**
     *
     * Payment Success for membership
     *
     */
    public function recurcivePaymentSuccess()
    {
        if ($this->data['loginCheck'] == '') {
            $this->setErrorMessage('error', 'You must login first');
            redirect('login');
        }
        if ($this->uri->segment(2) == 'success') {
            $seller_id     = $this->uri->segment(3);
            $transactionNo = $this->uri->segment(4);

            $sellerPaymentSuccessCheck = $this->order_model->get_all_details(SELLER, array('seller_id' => $seller_id, 'dealCodeNumber' => $transactionNo, 'membership_status' => '1'));

            if ($sellerPaymentSuccessCheck->num_rows() == 0) {
                $seller_details = $this->order_model->get_all_details(SELLER, array('seller_id' => $seller_id));
                if ($seller_details->num_rows() == '') {
                    $this->order_model->update_details(SELLER, array('dealCodeNumber' => $transactionNo, 'membership_status' => '1'), array('seller_id' => $seller_id));
                    $this->setErrorMessage('success', 'Thank you, You Membership Subscription has been activated successfully.');
                    redirect('shop/billing');
                }

            } else {
                $this->setErrorMessage('success', 'Your Membership Subscription has been already activated.');
                redirect('shop/billing');
            }
        } elseif ($this->uri->segment(2) == 'ipnsubscribepayment') {

            if ($_REQUEST['txn_type'] != '') {

                $query   = "insert into " . MEMBER_IPN . " set recurring_payment_id = '" . $_REQUEST['recurring_payment_id'] . "',payment_status = '" . $_REQUEST['payment_status'] . "',payment_cycle='Yearly',txn_type='" . $_REQUEST['txn_type'] . "',payer_email = '" . $_REQUEST['payer_email'] . "',receiver_email = '" . $_REQUEST['receiver_email'] . "',first_name = '" . $_REQUEST['first_name'] . "',last_name = '" . $_REQUEST['last_name'] . "',payer_status = '" . $_REQUEST['payer_status'] . "',payer_id = '" . $_REQUEST['payer_id'] . "',residence_country = '" . $_REQUEST['residence_country'] . "',item_name = '" . $_REQUEST['item_name'] . "',ipn_track_id='" . $_REQUEST['ipn_track_id'] . "',amount = '" . $_REQUEST['mc_amount3'] . "',outstanding_balance='" . $_REQUEST['business'] . "',receiver_id = '" . $_REQUEST['receiver_id'] . "',currency_code='" . $_REQUEST['mc_currency'] . "',custom = '" . $_REQUEST['custom'] . "',time_created='" . $_REQUEST['subscr_date'] . "',charset='" . $_REQUEST['charset'] . "',payment_fee='" . $_REQUEST['payment_fee'] . "', mc_gross='" . $_REQUEST['mc_gross'] . "',mc_fee='" . $_REQUEST['mc_fee'] . "',tax='" . $_REQUEST['txn_id'] . "',protection_eligibility='" . $_REQUEST['protection_eligibility'] . "',payment_type='" . $_REQUEST['payment_type'] . "',notify_version='" . $_REQUEST['notify_version'] . "',recurring_payment_id='" . $_REQUEST['subscr_id'] . "',payment_gross='" . $_REQUEST['payment_gross'] . "',item_number='" . $_REQUEST['transaction_subject'] . "',payment_date='" . $_REQUEST['payment_date'] . "',shipping='" . $_REQUEST['txn_type'] . "',verify_sign = '" . $_REQUEST['verify_sign'] . "'";
                $inserts = $this->order_model->ExecuteQuery($query);
            }

            if ($_REQUEST['txn_type'] == 'subscr_payment' || $_REQUEST['txn_type'] == 'subscr_cancel') {

                $userID    = $_REQUEST['custom'];
                $subscr_id = $_REQUEST['subscr_id'];

                $query  = "insert into " . MEMBER_TRANSACTION . " set payment_cycle='Yearly',txn_type='" . $_REQUEST['txn_type'] . "', last_name='" . $_REQUEST['last_name'] . "',next_payment_date='" . $_REQUEST['next_payment_date'] . "',residence_country='" . $_REQUEST['residence_country'] . "',initial_payment_amount='" . $_REQUEST['initial_payment_amount'] . "',currency_code='" . $_REQUEST['mc_currency'] . "',time_created='" . $_REQUEST['payment_date'] . "',verify_sign='" . $_REQUEST['verify_sign'] . "',period_type= '" . $_REQUEST['period_type'] . "',payer_status='" . $_REQUEST['payer_status'] . "',payer_email='" . $_REQUEST['payer_email'] . "',first_name='" . $_REQUEST['first_name'] . "',receiver_email='" . $_REQUEST['receiver_email'] . "',payer_id='" . $_REQUEST['payer_id'] . "',product_type='" . $_REQUEST['product_type'] . "',shipping='" . $_REQUEST['shipping'] . "',amount_per_cycle='" . $_REQUEST['period3'] . "',profile_status='" . $_REQUEST['profile_status'] . "',charset='" . $_REQUEST['charset'] . "',notify_version='" . $_REQUEST['notify_version'] . "',amount='" . $_REQUEST['amount3'] . "',outstanding_balance='" . $_REQUEST['business'] . "',recurring_payment_id='" . $_REQUEST['subscr_id'] . "',product_name='" . $_REQUEST['item_name'] . "',ipn_track_id='" . $_REQUEST['ipn_track_id'] . "',tran_date=NOW()";
                $insert = $comDAO->ExecuteQuery($query, 'insert');

                if ($_REQUEST['txn_type'] == 'subscr_cancel') {
                    $price = $_REQUEST['amount3'];
                    $dealDAO->InsertOrder_Failed_notify($userID, $subscr_id, $price);

                    $selorder = "select * from " . TBLORDER . " where buyer = " . $userID . "";
                    $resRows  = $this->ExecuteQuery($selorder, 'norows');
                    if ($resRows == '0') {
                        $insert    = "insert into " . TBLORDER . " set buyer = " . $userID . ",amount = '" . $price . "',status='0',subscribe = 'InActive',sdate=CURDATE(),transactionid='" . $TranId . "',pay_time=NOW(),tranID='" . $TranId . "'";
                        $selresult = $this->ExecuteQuery($insert, 'insert');
                    } else {
                        $insert    = "update " . TBLORDER . " set status='0',subscribe = 'InActive',sdate=CURDATE() where buyer = " . $userID . "";
                        $selresult = $this->ExecuteQuery($insert, 'update');

                        $update    = "update " . OWNER . " set subscribe = 'InActive' where id = " . $userID . "";
                        $selresult = $this->ExecuteQuery($update, 'update');
                    }

                }
                if ($_REQUEST['txn_type'] == 'subscr_payment') {
                    $price = $_REQUEST['payment_fee'];
                    $dealDAO->InsertOrder_Success_notify($userID, $subscr_id, $price);
                    $dealDAO->SuccessStatus($userID, $subscr_id);
                }
            }

        } else {
            $this->setErrorMessage('error', 'Your Membership Subscription failed to activate, please try again.');
            redirect('shop/billing');
        }
    }

    /**
     *
     * Membership cancel option
     *
     */
    public function subscribe_cancel()
    {
        $seller_id = $this->uri->segment(2);
        if ($seller_id != '') {
            $seller_check = $this->order_model->get_all_details(SELLER, array('seller_id' => $seller_id));
            if ($seller_check->num_rows() == 1) {
                $this->order_model->update_details(SELLER, array('membership_status' => '3'), array('seller_id' => $seller_id));
                $this->setErrorMessage('success', 'You have Membership Subscription has been cancelled successfully.');
                redirect('shop/billing');
            }
        } else {
            $this->setErrorMessage('error', 'Invalid user information');
            redirect('');
        }
    }

    /**
     *
     * Membership Renewal Option
     *
     */
    public function subscribe_renewal()
    {
        $seller_id = $this->uri->segment(2);
        if ($seller_id != '') {
            $seller_check = $this->order_model->get_all_details(SELLER, array('seller_id' => $seller_id));
            if ($seller_check->num_rows() == 1) {
                $this->order_model->update_details(SELLER, array('membership_status' => '1'), array('seller_id' => $seller_id));
                $this->setErrorMessage('success', 'You have Membership Subscription has been renewed successfully.');
                redirect('shop/billing');
            }
        } else {
            $this->setErrorMessage('error', 'Invalid user information');
            redirect('');
        }
    }

    /**
     *
     * Membership Payment initialize
     *
     */
    public function MembershipPayment()
    {
        $today_due = date('Y-m-d H:i:s', time());
        if ($this->config->item('membership_plan') == 'Y') {
            $nextYearDue = date('Y-m-d H:i:s', strtotime('+' . $this->config->item('membership_option') . ' year'));
        } elseif ($this->config->item('membership_plan') == 'M') {
            $nextYearDue = date('Y-m-d H:i:s', strtotime('+' . $this->config->item('membership_option') . ' month	'));
        } elseif ($this->config->item('membership_plan') == 'W') {
            $nextYearDue = date('Y-m-d H:i:s', strtotime('+' . $this->config->item('membership_option') . ' week'));
        } elseif ($this->config->item('membership_plan') == 'D') {
            $nextYearDue = date('Y-m-d H:i:s', strtotime('+' . $this->config->item('membership_option') . ' day'));
        }
        /********Check and update seller next year due date ******/
        $today_subscribersQry = "SELECT * FROM " . SELLER . " WHERE membership_expiry <= '" . $today_due . " 00:00:00' AND  membership_status='1'";
        $today_subscribers    = $this->currency_model->ExecuteQuery($today_subscribersQry);
        foreach ($today_subscribers->result() as $subscribers) {
            $this->currency_model->ExecuteQuery("update " . SELLER . " set membership_expiry='" . $nextYearDue . "' where seller_id='" . $subscribers->id . "' ");
        }

        /***********change the subscribers status to no*************/
        $this->currency_model->ExecuteQuery("update " . SELLER . " set membership_status='2' where membership_expiry < '" . $today_due . "  00:00:00' ");
    }

    public function submit_proof()
    {
        $data = $this->input->post();
        if ($_FILES['proof']['name'] != "") {
            $config['overwrite']     = false;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path']   = 'images/paymentproof';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('proof')) {
                $logoDetails   = $this->upload->data();
                $data['proof'] = $logoDetails['file_name'];
                $this->order_model->simple_insert(PROOF, $data);
                $this->setErrorMessage('success', "Proof Successfully Submitted");
                redirect('purchases/wiretransfer');
            } else {
                $this->setErrorMessage('error', $this->upload->display_errors());
                redirect('purchases/wiretransfer');
            }
        }
    }
    public function view_proof()
    {
        $dealCodeNo   = $this->uri->segment(2);
        $proofDetails = $this->order_model->get_all_details(PROOF, array('dealcodenumber' => $dealCodeNo));
        if ($proofDetails->num_rows() == 1) {
            $this->data['proof'] = $proofDetails;
            $this->load->view('site/shop/view_proof', $this->data);
        } else {
            show_404();
        }
    }
}
