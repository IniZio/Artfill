<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!--<![endif]-->
<!-- Specific Page Data -->
<!-- End of Data -->
<?php include('commonsettings/shopsy_admin_settings.php'); ?>
<head>
    <meta charset="utf-8" />
    <base href="<?php echo $config['base_url']; ?>" />
    <title><?php echo $heading; ?></title>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['base_url'].'images/logo/'.$config['fevicon_image']; ?>">
    <!-- CSS -->
    <style type="text/css">
	.vd_content-section {
		background-color: #f0f0f0;
		border-top: 1px solid #f8f8f8;
		padding: 25px 20px 20px;
		margin-right: -15px;
		margin-left: -15px;
	}
	body {
		font-family: 'Open Sans','arial';
		font-size: 13px;
		font-weight: 400;
		line-height: 23px;
		color: #333;
		height:100%;
	}
	* {
		box-sizing: border-box;
	}
	.error-page {
		margin: 0 auto 60px;
		width: 100;
	}
	.logo {
		margin-bottom: 5px;
		text-shadow: 1px -1px 0 #fff;
		text-align: center;
	}
	img {
    	max-width: 100%;
		vertical-align: middle;
		border: 0 none;		
	}
	.error-layout .logo {
		text-shadow: 1px -1px 0 #fff;
	}
	.error-layout .heading {
		text-align: center;
	}
	.clearfix:after {
		content: " ";
		display: table;
	}
	.error-icon{
		background-color: #d5d5d5;
		border: 1px solid #ffffff;
		border-radius: 60px;
		color: #ffffff;
		display: block;
		font-size: 68px;
		height: 120px;
		line-height: 114px;
		margin: 20px auto 30px;
		text-align: center;
		width: 120px;
		background-image:url(images/error_404.png);
	}
	h1, h2, h3, h4, h5, h6 {
		color: inherit;
		font-family: 'Open Sans','arial';
		font-weight: normal;
		margin: 0 0 10px;
		text-rendering: optimizelegibility;
	}
	h4, .h4 {
		font-size: 18px;
	}
	a {
		color: #1fae66;
		text-decoration: none;
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	}
	p {
		margin: 0 0 10px;
	}
	.text-center {
		text-align: center;
	}
	.error-layout .panel {
		-moz-border-bottom-colors: none;
		-moz-border-left-colors: none;
		-moz-border-right-colors: none;
		-moz-border-top-colors: none;
		border-color: -moz-use-text-color -moz-use-text-color #ffffff;
		border-image: none;
		border-radius: 0;
		border-style: none none solid;
		border-width: medium medium 1px;
		box-shadow: none;
	}
	.widget:before, .widget:after {
		content: " ";
		display: table;
	}
	*:before, *:after {
		box-sizing: border-box;
	}
	.widget:after {
		clear: both;
	}
	.widget:before, .widget:after {
		content: " ";
		display: table;
	}
	*:before, *:after {
		box-sizing: border-box;
	}
	.vd_content-wrapper {
		background-color: #f0f0f0;
		margin-left: -15px;
		margin-right: -15px;
		padding-left: 15px;
		padding-right: 15px;
	}
	.nav-left-hide .content .vd_container, .no-nav-left .content .vd_container {
		margin-left: 0;
	}
	.nav-right-hide .content .vd_container, .no-nav-right .content .vd_container {
		margin-right: 0;
	}
	html {
		font-size: 62.5%;
		font-family: sans-serif;background-color: #f0f0f0;
	}
	.vd_body {
		float: left;
		overflow: hidden;
		width: 100%;
	}
	.font-semibold {
		font-weight: 500;
	}
	.panel-body-list:after {
		clear: both;
		content: " ";
	    display: table;
	}
	.error-layout .panel-body {
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
		border-bottom: 1px solid #dddddd;
		padding: 20px 30px;
	}
	.vd_soft-grey {
		color: #b5b5b5 !important;
	}
	.mgl-10 {
		margin-left: 10px !important;
	}
	.mgr-10 {
		margin-right: 10px !important;
	}
	.mgbt-xs-20 {
		margin-bottom: 20px !important;
	}
	.col-md-12 {
		width: 100%;
	}
	.col-md-12, .col-lg-12 {
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		position: relative;
	}

	
	
	
@media screen and (max-width: 414px)
{	
	h4, .h4 {
		font-size: 14px !important;
	}
	h1.font-semibold
	{
		font-size: 30px !important;
	}
	.error-layout .panel-body
	{
		padding: 20px 10px !important;
	}
}



	</style>
</head>    

<body id="pages" class="full-layout no-nav-left no-nav-right nav-top-fixed background-error responsive remove-navbar error-layout clearfix" data-smooth-scrolling="1" data-active="pages "> 
<div class="vd_body">
<!-- Header Start -->
<!-- Header Ends --> 
<div class="content">
  <div class="container">     
    <!-- Middle Content Start -->    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_content-section clearfix">
            <div class="error-page">
              <div class="heading clearfix">
                <div class="logo">
                  <h2 ><img src="<?php echo $config['base_url']; ?>images/logo/<?php echo $config['logo_image']; ?>" alt="<?php echo $config['email_title']; ?>"></h2>
                </div>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="error-icon"> </div>
                  <h1 class="font-semibold text-center" style="font-size:52px">404 ERROR</h1>
                  <form class="form-horizontal" action="#" role="form">
                    <div class="form-group">
                      <div class="col-md-12">
                        <h4 class="text-center mgbt-xs-20">Your requested page could not be found or it is currently unavailable.</h4>
                        <p class="text-center"> Please <a href="<?php echo $config['base_url']; ?>">click here</a> to go back to our home page or use the search form below</p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Panel Widget -->
              <div class="register-panel text-center font-semibold"> 
              <a href="<?php echo $config['base_url']; ?>">Home</a> <span class="mgl-10 mgr-10 vd_soft-grey">|</span> 
              <a href="pages/about-us">About</a> <span class="mgl-10 mgr-10 vd_soft-grey">|</span> 
              <a href="pages/contact-us">Contact</a> </div>
            </div>
            <!-- vd_error-page -->             
          </div>
          <!-- .vd_content-section -->           
        </div>
        <!-- .vd_content --> 
      </div>
      <!-- .vd_container --> 
    </div>
    <!-- .vd_content-wrapper --> 
    <!-- Middle Content End --> 
  </div>
  <!-- .container --> 
</div>
<!-- .content -->
</div>
</body>
</html>