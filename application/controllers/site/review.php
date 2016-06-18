<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/ 

class Review extends MY_Controller { 

	function __construct(){
	
        parent::__construct();
		#$this->load->helper(array('cookie','date','form','email'));
		#$this->load->library(array('encrypt','form_validation'));		
		#$this->load->library('session');
		#$this->load->model(array('user_model','product_model','seller_model','product_attribute_model'));
	 
	}
  public function dealend()
   {

#echo "select * from ".PRODUCT." where concat(deal_date_to,' ',deal_time_to) < NOW() and action='DOD'";

$data1=$this->db->query("select now()")->result_array();

#echo date('Y-m-d H:i');

$currenttime=date('Y-m-d H:i');

$data=$this->db->query("select * from ".PRODUCT." where concat(deal_date_to,' ',deal_time_to) <'".$currenttime."' and action='DOD'")->result_array();

echo count($data);
echo "<pre>";
print_r($data1);
exit;
$sender_email=$this->data['siteContactMail'];
$sender_name=$this->data['siteTitle'];

$message='';
if(!empty($data))
  {
foreach($data as $row)
{

$productimage=explode(',',$row['image']);
$this->db->query("update ".PRODUCT." set action='' where id=".$row['id']."");
$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			
$message = '<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"640\" bgcolor=\"#CCCCCC\">
<tbody>
<tr>
<td style=\"padding: 40px;\">
<table style=\"border: #1d4567 1px solid; font-family: Arial, Helvetica, sans-serif;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"610\">
<tbody>
<tr>
<td><a href=\"'.base_url().'\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"'.base_url().'images/logo/'.$this->data['logo'].'\" alt=\"'.$this->config->item('email_title').'\" /></a></td>

</tr>
<tr>
<td valign=\"top\">
<table style=\"width: 100%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">
<tbody>
<tr>

</tr>

<tr>
</tr>
</tbody>
</table>

<table style=\"width: 100%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">
<tbody>
<tr><td colspan="3" align="center"><h4>Deal Has been Expired</h4><hr></td></tr>

<tr>
<td>Product Name<hr></td>
<td>Product Image<hr></td>
<td>Discount Amount<hr></td>
</tr>
<tr>
<td><a href=\"'.base_url().'products/'.$row['seourl'].'\">'.$row['product_name'].'</a></td>
<td><img src=\"'.base_url().'/images/product/thumb/'.$productimage[0].'\" alt=\"'.$row['product_name'].'\" width=\"100\" /></td>


<td>'.$row['discount'].'</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"font-size: 12px; padding: 10px 15px;\" valign=\"top\">
<p>&nbsp;</p>
<p><strong>-'.$this->config->item('email_title').' Team</strong></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';

		$message .= '</body>
			</html>';
#echo stripslashes($message);exit;

$user=$this->db->query("select * from ".USERS." WHERE id=".$row['user_id']."")->result_array();
#echo $user[0]['email'];
$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$user[0]['email'],
							'subject_message'=>"Deals Expired",
							'body_messages'=>$message
							);
		#echo "<pre>"; print_r($email_values);exit;;				
		$email_send_to_common = $this->user_model->common_email_send($email_values);
}
}

 }
}