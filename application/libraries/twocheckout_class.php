<?php


class twocheckout_class {
    
   
  
 
   
   var $fields = array();           // array holds the fields to submit to twocheckout

   
   function twocheckout_class() {
       
     
      
    
      
   }
   
   function add_field($field, $value) {
      
            
      $this->fields["$field"] = $value;
   }

   function submit_twocheckout_post() {
 
     

      echo "<html>\n";
      echo "<head><title>Processing Payment...</title></head>\n";
      echo "<body onLoad=\"document.forms['twocheckout_form'].submit();\">\n";
      echo "<center><h2>Please wait, your order is being processed and you";
      echo " will be redirected to the twocheckout website.</h2></center>\n";
      echo "<form method=\"post\" name=\"paypal_form\" ";
      echo "action=\"".$this->twocheckout_url."\">\n";

      foreach ($this->fields as $name => $value) {
         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
      }
      echo "<center><br/><br/>If you are not automatically redirected to ";
      echo "paypal within 5 seconds...<br/><br/>\n";
      echo "<input type=\"submit\" value=\"Click Here\"></center>\n";
      
      echo "</form>\n";
      echo "</body></html>\n";die;
    
   }
   
   
}         


 
