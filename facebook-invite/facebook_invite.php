 <button name ="facebook" id="facebook" class="facebook">Please login here</button>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
FB.init({
	    appId:'<?php echo '528096587268434';?>',
	    cookie:true,
	    status:true,
	    xfbml:true,
		oauth : true
    });

$('button.facebook').click(function() {
	FB.ui({
	    method: 'apprequests',
	    message: 'Invites you to join on <?php echo 'Shopsy'; ?> (<?php echo 'http://localhost/balaji/facebook';?>?ref=<?php echo 'Balaji Kamalanathan'?>)'
	});
    });

	</script>


           
	
	