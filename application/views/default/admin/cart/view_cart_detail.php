<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>View Cart Info</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
   
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
   
		
    <div style="float:left; width:100%;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		 <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
			<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
			 <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Order Date</span></td>
			<td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
		</tr>
		<?php 
			foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
				$unitPrice = $cartRow->price; 
				$uTot = $unitPrice*$cartRow->quantity;
				if($cartRow->attribute_values != ''){ $atr = '<br>'.$cartRow->attribute_values; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values; }else{ $atr = '';}
		?>
			<tr bgcolor="#f3f3f3">
				
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="<?php echo base_url().PRODUCTPATHTHUMB.$InvImg[0]?>" alt="'<?php echo stripslashes($cartRow->product_name);?>'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo stripslashes($cartRow->product_name).$atr; ?></span></td>
			
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo strtoupper($cartRow->quantity);?></span></td>		
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo date("F j, Y g:i a",strtotime($cartRow->created));?></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $this->data['currencySymbol'].number_format($unitPrice * $this->data['currencyValue'],2) ;?></span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $this->data['currencySymbol'].number_format($uTot * $this->data['currencyValue'],2); ?></span></td>
        </tr>
			
			<?php $cart_amount += $uTot; }?>
		</table>
		<table style="padding-left: 837px;">
		<tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;"><?php echo $this->data['currencySymbol'].number_format($cart_amount * $this->data['currencyValue'],'2');?> </span></td>
              </tr>
            </table>
	</div>
	</div>
</div>
</body>
</html>