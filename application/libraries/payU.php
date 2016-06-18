<?php 
class payU
{
// Merchant key here as provided by Payu
private $MERCHANT_KEY;
private $SALT;
private $PAYU_BASE_URL;
private $fields=array();
private $trans;
private $hash;
 function payU($type="secure")
 {
  
   if($type=="test")
   $this->PAYU_BASE_URL="https://test.payu.in";
   else
   $this->PAYU_BASE_URL="https://secure.payu.in";
 }
 function set_secretvalues($key1,$key2)
 {
   $this->MERCHANT_KEY=$key1;
   $this->SALT=$key2;
 }
 function set_transid($trans="")
 {
     if(strlen($trans)==0) 
	 {
        // Generate random transaction id
         $this->trans= substr(hash('sha256', mt_rand() . microtime()), 0, 20);
     } 
	 else 
	 {
          $this->trans = $trans;
      }
 }

 function add_fields($data)
 {    
    
	 $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
       $hashVarsSeq = explode('|', $hashSequence);
       foreach($data as $key=>$value)
	   {
	     if(in_array($key,$hashVarsSeq))
		 {
		   if($value=="")
		     $this->fields[$key] =  "";
		 }
	   	     $this->fields[$key] =  htmlentities($value, ENT_QUOTES);
	    		 
	   }		 
	 
	 
 }
 function create_hash()
 {
       
	   $hashSequence = "amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
       $hashVarsSeq = explode('|', $hashSequence);
       $hash_string=$this->MERCHANT_KEY."|".$this->trans."|";
        foreach($hashVarsSeq as $hash_var) 
		{
             $hash_string .= isset($this->fields[$hash_var]) ? $this->fields[$hash_var]:"";
             $hash_string .= '|';
        }
        $hash_string .= $this->SALT;
		
        $this->hash = strtolower(hash('sha512', $hash_string));
 }
 
 function submit_payuform()
 {
      echo "<html>\n";
      echo "<head><title>Processing Payment...</title></head>\n";
      echo "<body onLoad=\"document.forms['paysU_form'].submit();\">\n";
      echo "<center><h2>Please wait, your order is being processed and you";
      echo " will be redirected to the payU website.</h2></center>\n";
      echo "<form method=\"post\" name=\"payU_form\" ";
      echo "action=\"".$this->PAYU_BASE_URL."/_payment"."\">\n";
      echo     "<input type='hidden' name='key' value='".$this->MERCHANT_KEY."'/>";
      echo     "<input type='hidden' name='hash' value='".$this->hash."'/>";
	 echo     "<input type='hidden' name='txnid' value='".$this->trans."'/>";
     foreach ($this->fields as $name => $value) {
         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
      }
      echo "<center><br/><br/>If you are not automatically redirected to ";
      echo "paypal within 5 seconds...<br/><br/>\n";
      echo "<input type=\"submit\" value=\"Click Here\"></center>\n";
      
      echo "</form>\n";
      echo "</body></html>\n";
 }
 

 
}

?>