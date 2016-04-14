<?php 
$this->load->view('site/templates/shop_header');
?>
 <script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/site/plugin.js"></script>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/site/verticaltabs.pack.js"></script>  
<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>
<link rel="stylesheet" href="css/default/jquery.ptTimeSelect.css" type="text/css" />
<script language="javascript" src="js/jquery.ptTimeSelect.js"></script>

<link href="css/default/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script src="js/1.8.24-jquery-ui.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
	    $("#datefrom").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true,minDate:0 , onClose: function( selectedDate ) {
        $( "#dateto" ).datepicker( "option", "minDate", selectedDate );
      } }).val()
		

		$("#dateto").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true,minDate:0 ,onClose: function( selectedDate ) {
        $( "#datefrom" ).datepicker( "option", "maxDate", selectedDate );
      }  }).val()
		
    });

</script>



<div class="clear"></div>
<section class="container">

<div class="main">

		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li>Coupon cards</li>
        </ul>

<div class="shop_details">

    			<span class="shop_title">Create New Coupon.</span>                

				<div class="list_div1">

                	<div class="list_inner_fields" style="border:none">

                    	<div style="float:left; width:100%; margin:5px 0 5px; color:#999999; font-size:14px; line-height:18px">

                        	<p>

                            	<strong>Important!</strong> 

                            	Once you create a coupon, the code and amount cannot be changed. You can only use a code once,even after a coupon has been deleted.

                            </p>

                            <p>

                            <strong>Percent Discount:</strong> A flat percentage off each purchase in a shopper's entire order (not applied to shipping costs or tax rates).

                            </p>

                        </div>

                    </div>            

                </div>

    			<div class="payment_div">

                	

                    

                </div>

    <form method="post" action="site/shop/insertEditCouponcard">    	

		<div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0">

        	<span id="overall_err" class="errors_msg"></span>

            <div class="payment_check">

                <div class="payment_hide">

                <input type="hidden" name="sell_id" value="<?php echo $loginCheck; ?>" />

                <input type="hidden" name="price_type" value="2" />

                <table class="coupon-code-table">

                	<tr>

                    	<td><label>COUPON CODE</label></td>

                        <td><input type="text" class="payment_txt" id="code" name="code" value="<?php echo $code; ?>" readonly="readonly" /></td>

                        <td><span id="codeErr" class="errors_msg"></span></td>

                    </tr>

                    <tr>

                    	<td><label>MAX NO. OF COUPONS</label></td>

                        <td><input type="text" class="payment_txt" id="quantity" name="quantity" value="" /></td>

                        <td><span id="quantityErr" class="errors_msg"></span></td>

                    </tr>  

                    <tr>

                    	<td><label>Coupon Valid From </label></td>

                        <td><input type="text" class="payment_txt" id="datefrom" name="datefrom" value="" /></td>

                        <td><span id="datefromErr" class="errors_msg"></span></td>

                    </tr>  

                    <tr>

                    	<td><label>Coupon Valid Till</label></td>

                        <td><input type="text" class="payment_txt" id="dateto" name="dateto" value="" /></td>

                        <td><span id="datetoErr" class="errors_msg"></span></td>

                    </tr>  

                    <tr>

                    	<td><label>PRICE VALUE (%)</label></td>

                        <td><input type="text" class="payment_txt" id="price_value" name="price_value" value="" /></td>

                        <td><span id="price_valueErr" class="errors_msg"></span></td>

                    </tr>    

                    <tr>

                    	<td><label>DESCRIPTION </label></td>

                        <td><textarea class="payment_txt" name="description" id="description"></textarea></td>

                        <td><span id="descriptionErr" class="errors_msg"></span></td>

                    </tr> 

                    <tr>

                    <td><label>STATUS </label></td>

                    <td>

                    <input type="radio" id="active" name="status" value="Active" <?php if($selectSeller_details[0]['PayPal_mode']=='Live'){ echo 'checked="checked"'; } ?> checked="checked" />

                    	<label for="active" style="width:auto; margin:2px 0 0 0">Active</label>

                    <input type="radio" id="inactive" name="status" value="Inactive" <?php if($selectSeller_details[0]['PayPal_mode']=='Sandbox'){ echo 'checked="checked"'; } ?>/>

                        <label for="inactive" style="width:auto; margin:2px 0 0 0">Inactive</label>               

                    </td>

                    </tr> 

                    <input type="hidden" name="id" value="" />      

                </table>

                

               

                </div>

            </div>

           

                               

        </div>            

        <div class="payment_btn">

        	<input type="submit" class="btn_save_bill" value="Add Coupon" onclick="return couponcodeValidate();"/>

        </div>

	</form>

</div>

</div>

</section>



<?php 

$this->load->view('site/templates/footer');

?>

