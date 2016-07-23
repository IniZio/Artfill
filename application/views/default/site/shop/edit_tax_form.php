<?php 
$this->load->view('site/templates/shop_header');
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">
<div class="main">
<div class="shop_details">
    			<span class="shop_title"><?php if($this->lang->line('shop_tax_edit') != '') { echo stripslashes($this->lang->line('shop_tax_edit')); } else echo 'Edit Tax'; ?></span>                
				
    			
    <form id="taxeditForm" method="post" action="site/tax/insertEditTax">    	
		<div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0">
        	<span id="overall_err" class="errors_msg"></span>
            <div class="payment_check">
                <div class="payment_hide">
                <table class="coupon-code-table">
                	<tr>
                    	<td><label><?php if($this->lang->line('shop_countryname') != '') { echo stripslashes($this->lang->line('shop_countryname')); } else echo 'Country Name'; ?></label></td>
                        <td>
						<select class="payment_txt required" id="country_name" name="country_name" >
							<option value=""><?php if($this->lang->line('shop_country') != '') { echo stripslashes($this->lang->line('shop_country')); } else echo 'Select Country'; ?></option>
							<?php foreach($country as $countryVal) { if($countryVal->id!=232){ ?> 
							<option value="<?php echo $countryVal->id; ?>" <?php if($taxDetails->row()->country_id == $countryVal->id){ echo 'selected="selected"';} ?>><?php echo $countryVal->name; ?></option> 
							<?php } }?>
						</select>
						</td>
                        <td><span id="countryErr" class="errors_msg"></span></td>
                    </tr>
                    <tr class= "tax_state">
                    	<td><label><?php if($this->lang->line('shop_tax_state_name') != '') { echo stripslashes($this->lang->line('shop_tax_state_name')); } else echo 'State Name'; ?></label></td>
                        <td>
						<select  class="payment_txt required" id="state_name" name="state_name" >
							<option value=""><?php if($this->lang->line('shop_tax_select_state') != '') { echo stripslashes($this->lang->line('shop_tax_select_state')); } else echo 'Select State'; ?></option>
							<?php foreach($state as $stateVal) { ?> 
							<option value="<?php echo $stateVal->id; ?>" <?php if($taxDetails->row()->state_code == $stateVal->state_code){ echo 'selected="selected"';} ?>><?php echo $stateVal->name; ?></option> 
							<?php } ?>
						</select>
						</td>
                        <td><span id="stateErr" class="errors_msg"></span></td>
                    </tr>  
                    <!--<tr>
                    	<td><label>CITY NAME </label></td>
                        <td><input type="text" class="payment_txt" id="city_name" name="city_name" value="" /></td>
                        <td><span id="datefromErr" class="errors_msg"></span></td>
                    </tr>-->  
                    <tr>
                    	<td><label><?php if($this->lang->line('shop_tax_amount') != '') { echo stripslashes($this->lang->line('shop_tax_amount')); } else echo 'Tax'; ?> (%)</label></td>
                        <td><input type="text" class="payment_txt required" id="tax" name="tax" value="<?php echo $taxDetails->row()->tax_amount; ?>" /></td>
                        <td><span id="taxErr" class="errors_msg"></span></td>
                    </tr>                      
                       
                </table>
                
               
                </div>
            </div>
           
                               
        </div>            
        <div class="payment_btn">
			<input type="hidden" name="tax_edit_id" id="tax_edit_id" value="<?php echo $taxDetails->row()->id; ?>">
        	<input type="button" class="btn_save_bill" value="<?php if($this->lang->line('form_update') != '') { echo stripslashes($this->lang->line('form_update')); } else echo 'Update'; ?>" onclick="return taxCaluAdd();"/>
			
        </div>
	</form>
</div>
</div>
</section>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#country_name").change(function() {
		$('.tax_state').css('display','block')
		var country_name=document.getElementById('country_name').value; 
		$.get('site/tax/state_list_ajax/' + country_name, function(data) {
			if(data != ""){
				$("#state_name").html(data);
			}else{				
				$('.tax_state').css('display','none')
			}
		});	
    }); 
});
</script>
<?php 
$this->load->view('site/templates/footer');
?>
