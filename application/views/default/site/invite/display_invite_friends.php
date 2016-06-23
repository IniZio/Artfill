<?php 
$this->load->view('site/templates/header');  
?>
		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div class="add_steps shop-menu-list">
			<div class="main">		
				<?php $this->load->view('site/user/sidebar'); ?>
			</div>
		</div>
<div id="profile_div">
<section>
    <div class="main">
        <div class="container">
            <ul class="breadcrumb_top">
                <li><a href="<?php echo base_url();?>"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
                <li>></li>
                <li><?php echo af_lg('lg_invite_friends','Invite friends');?></li>
            </ul>
            <div class="left_side">   
                <?php //$this->load->view('site/user/sidebar'); ?>
            </div>
            <div class="right_side" >
				<div class="split_prefile">
                        <h2><?php echo af_lg('lg_invite your friends','Invite Your Friends');?></h2>
                        <div class="clear"></div>
                 <div class="close_content">
                 </div>
				</div>
				
				<script src="https://apis.google.com/js/client:platform.js" async defer></script>
				<?php 
								$uname='';
								if ($loginCheck!=''){
									$uname=$userDetails->row()->user_name;
								}
								?>

				<button id="google_invite" name="google_invite" class="submit_btn g-interactivepost gmail"
								data-clientid="<?php echo $this->config->item("google_client_id");?>"
								data-contenturl="<?php echo base_url().'?aff='.$uname;?>"
								data-calltoactionlabel="INVITE"
								data-calltoactionurl="<?php echo base_url().'?aff='.$uname;?>"
								data-cookiepolicy="single_host_origin"
								data-prefilltext="Join me on <?php echo $siteTitle;?> and discover amazing things"
								>
								<?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Google Invite"; ?>
								</button>
				
				<!--<a  id="google_invite" name="google_invite"  class="submit_btn " href="https://accounts.google.com/o/oauth2/auth?client_id=	<?php echo $get_admin_details[0]->google_client_id;?>&redirect_uri=<?php echo $get_admin_details[0]->google_redirect_url; ?>&scope=https://www.google.com/m8/feeds/&response_type=code"><i class="fa fa-google-plus-square"></i><span style="margin-left:10px;"><?php echo af_lg('lg_google invite','Google invite');?></span></a>	-->

					<button class="submit_btn facebook" id="facebook" name="facebook"><i class="fa fa-facebook-square"></i><span style="margin-left:10px;"><?php echo af_lg('lg_FB_invite','Facebook invite');?></span>
					
					<button class="submit_btn twitter" id="twitter" name="twitter" data-url="http://twitter.com/share?text=<?php echo urlencode($siteTitle);?>&url=<?php echo urlencode(base_url());?>%3Faff%3D<?php echo $userDetails->row()->affiliateId;?>"><i class="fa fa-twitter-square"></i><span style="margin-left:10px;"><?php echo af_lg('lg_twitter_invite','Twitter invite');?></span>					
					
			</div>
                </div>
            </div>
        </div>
</section>
</div>
<script src="https://connect.facebook.net/en_US/all.js"></script>


<script type="text/javascript">
/* FB.init({
	    appId:'<?php echo $get_admin_details[0]->facebook_inivte_api_id;  ?>',
	    status:true,
	    xfbml:true,
		version    : 'v2.0'
    });
$('button.facebook').click(function() {
	FB.ui({
			method: 'apprequests',
			message: 'Invites you to join on Ribbonat (http://www.ribbonat.com/devsection/)',
		});
    });	
	 */
	FB.init({
	    appId:'708139989290731',
	    cookie:true,
	    status:true,
	    xfbml:true,
		oauth : true
    });
	
	/* $('button.facebook').click(function() {
	FB.ui({
	    method: 'apprequests',
	    message: 'Invites you to join on <?php echo $siteTitle;?> (<?php echo base_url();?>?aff=<?php echo $userDetails->row()->affiliateId;?>)'
	});
    }); */
	$('button.facebook').click(function(){   
		FB.ui({ 
				method: 'send', link: '<?php echo base_url();?>?aff=<?php echo $userDetails->row()->user_name;?>', 
			},function(response) { });
		});
	$('button.twitter').click(function(){
		/* var loc = "<?php echo base_url()?>";
		var param = {'location':loc};				
		$.post('<?php echo base_url()?>site/invite_friends/twitter_friends',param, 
			function(json){
				if (json.status_code==1) {	
				window.open(json.url, '_blank','width=800,left=250,top=100,resizable=yes,scrollbars=1', true);						
					}
				else if (json.status_code==0) {
					alert(json.message);
				}  
			},
			'json'
		); */
		var share_url = $(this).data('url');
		window.open(share_url, '_blank', 'height=400,width=800,left=250,top=100,resizable=yes', true);
	});
	
	/* 
message: 'Invites you to join on <?php //echo $siteTitle;?> (<?php //echo base_url();?>?ref=<?php //echo $userDetails->row()->user_name;?>)'
	
	
	$('button.gmail').click(function() {
  var loc = location.protocol+'//'+location.host;
 var param = {'location':loc};
	var popup = window.open(null, '_blank', 'height=550,width=900,left=250,top=100,resizable=yes', true);
  var $btn = $(this);
	$.post(
		baseURL+'site/user/find_friends_gmail',
		param, 
		function(json){
			if (json.status_code==1) {
				popup.location.href = json.url;	
			}
			else if (json.status_code==0) {
				alert(json.message);
			}  
		},
		'json'
	);
}); */
	
	
	</script>
<?php 
$this->load->view('site/templates/footer');
?>
<style>
#google_invite{
	float: left;
	display:inline-block;
	vertical-align: middle;
}
#facebook{
	float: left;
	display: inline-block;
}
#twitter{
  float: left;
  display:inline-block;
}
</style>

 