<?php
	   $authorid = get_the_author_ID(); 
	   $user_email = get_the_author_meta('user_email');
	   //$dbhandle = mysql_connect("localhost","root","") or die("Unable to connect to MySQL");
      // $selected = mysql_select_db("shopsy",$dbhandle) or die("Could not select examples");
       $result = mysql_query("SELECT image,product_name,seller_businessname,shopsy_product.seourl FROM shopsy_product INNER JOIN shopsy_seller ON shopsy_seller.seller_id=shopsy_product.user_id where shopsy_seller.seller_email ='".$user_email."' Limit 15") or die(mysql_error());

	  //$result = mysql_query("SELECT image,product_name from shopsy_product where user_id=".$authorid."") or die(mysql_error()); 
	 //fetch tha data from the database
while ($row=mysql_fetch_array($result)) {
	   $productimage = array ($row['image']);
	   	   $seourl = array ($row['seourl']);

	    $prodimage = explode(',', $productimage[0]);
	  
	   //print_r($prodimage[0]);
	    $homeurl = home_url();
	    $produrl = explode('/',$homeurl);
		$newprodurl = array_slice($produrl, 0,-1);
		$uprodurl = implode("/", $newprodurl);
	    ?>
        <div class="uproducts">
         <a href='<?php echo $uprodurl;?>/products/<?php echo $row['seourl'];?>'><img  src="<?php echo $uprodurl;?>/images/product/<?php echo $prodimage[0];?>" height="150" width="150" alt="<?php echo $row['product_name'];?>" title="<?php echo $row['product_name'];?>" /></a>
         <div class="productname"><a href='<?php echo $uprodurl;?>/products/<?php echo $row['seourl'];?>'><?php echo $row['product_name'];?></a></div>
         <div class="shpname"><a href="<?php echo $uprodurl;?>/shop-section/<?php echo $row['seourl'];?>"><?php echo $row['seller_businessname'];?></a></div>
         </div>
<?php 	 
}
	   ?>		