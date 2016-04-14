<?php
class Twocheckout
{
    public static $sid;
    public static $privateKey;
    public static $username;
    public static $password;
    public static $sandbox;
    public static $verifySSL = true;
    public static $baseUrl = 'https://www.2checkout.com';
    public static $error;
    public static $format = 'array';
    const VERSION = '0.3.0';
    public static function sellerId($value = null) {
        self::$sid = $value;
    }
    public static function privateKey($value = null) {
        self::$privateKey = $value;
    }
    public static function username($value = null) {
        self::$username = $value;
    }
    public static function password($value = null) {
        self::$password = $value;
    }
    public static function sandbox($value = null) {
        if ($value == 1 || $value == true) {
            self::$sandbox = true;
            self::$baseUrl = 'https://sandbox.2checkout.com';
        } else {
            self::$sandbox = false;
            self::$baseUrl = 'https://www.2checkout.com';
        }
    }
    public static function verifySSL($value = null) {
        if ($value == 0 || $value == false) {
            self::$verifySSL = false;
        } else {
            self::$verifySSL = true;
        }
    }
    public static function format($value = null) {
        self::$format = $value;
    }

}
	
require_once('./application/third_party/Twocheckout/Api/TwocheckoutAccount.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutPayment.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutApi.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutSale.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutProduct.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutCoupon.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutOption.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutUtil.php');
require_once('./application/third_party/Twocheckout/Api/TwocheckoutError.php');
require_once('./application/third_party/Twocheckout/TwocheckoutReturn.php');
require_once('./application/third_party/Twocheckout/TwocheckoutNotification.php');
require_once('./application/third_party/Twocheckout/TwocheckoutCharge.php');
require_once('./application/third_party/Twocheckout/TwocheckoutMessage.php');