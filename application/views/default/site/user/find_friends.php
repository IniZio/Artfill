<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>
<section class="container">
<div style=" float:left; width:100%; padding: 0 0 60px;" class="favorite">

    <div class="main">    

        <div class="top_list">

        <h2 class="friend_title"> <?php if($this->lang->line('user_find_ur_fnds') != '') { echo stripslashes($this->lang->line('user_find_ur_fnds')); } else echo 'Find your Friends'; ?> </h2>

        <h2 class="friend_title2"><?php if($this->lang->line('user_choose_service') != '') { echo stripslashes($this->lang->line('user_choose_service')); } else echo 'Choose the service you use to find people you know on'; ?> <?php echo stripslashes($siteTitle);?></h2>

        <ul id="social-icon" class="service clear">

            <li>        

            	<a id="fb" href="javascript:void(0);"><?php if($this->lang->line('user_facebook') != '') { echo stripslashes($this->lang->line('user_facebook')); } else echo 'Facebook'; ?></a>

            </li>

            <li>

            	<a id="gm" href="javascript:void(0);"><?php if($this->lang->line('user_gmail') != '') { echo stripslashes($this->lang->line('user_gmail')); } else echo 'Gmail'; ?></a>

            </li>

            <li>

            	<a id="ya" href="javascript:void(0);"><?php if($this->lang->line('user_yahoo') != '') { echo stripslashes($this->lang->line('user_yahoo')); } else echo 'Yahoo'; ?></a>

            </li>

            <li class="last">

            	<a id="aol" href="javascript:void(0);"><?php if($this->lang->line('user_aol') != '') { echo stripslashes($this->lang->line('user_aol')); } else echo 'AOL'; ?></a>

            </li>

        </ul>

        <p class="bottomtext"><?php if($this->lang->line('user_conn_to_fbook') != '') { echo stripslashes($this->lang->line('user_conn_to_fbook')); } else echo 'Connecting to Facebook will allow your friends to find you on'; ?> <?php echo stripslashes($siteTitle);?>. <?php if($this->lang->line('user_wont_tell') != '') { echo stripslashes($this->lang->line('user_wont_tell')); } else echo "We won't share your contacts with anybody or email anyone without your consent"; ?>.</p>   

        </div> 

    </div> 

</div>
</section>
<?php 

$this->load->view('site/templates/footer');

?>

<script	src="http://connect.facebook.net/en_US/all.js"></script>

<script type="text/javascript">

FB.init({

	    appId:'<?php echo $this->config->item('facebook_app_id');?>',

	    cookie:true,

	    status:true,

	    xfbml:true,

		oauth : true

    });

$('#ya').click(function() {

	var loc = baseURL;

	var param = {'location':loc};

	var popup = window.open(null, '_blank', 'height=400,width=800,left=250,top=100,resizable=yes', true);			

  var $btn = $(this);

  $.post(

		baseURL+'site/user/find_friends_twitter',

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

});

	

$('button.facebook').click(function() {

	FB.ui({

	    method: 'apprequests',

	    message: 'Invites you to join on <?php echo $siteTitle;?> (<?php echo base_url();?>?ref=<?php echo $userDetails->row()->user_name;?>)'

	});

    });

$('#gm').click(function() {

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

});

</script>	