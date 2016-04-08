<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<base href="<?php echo base_url(); ?>" />
		<!-- <title><?php echo $title; ?></title>
		<title><?php echo $heading; ?></title>
		<meta name="Title" content="<?php if ($meta_title == '') {echo $this->config->item('meta_title');} else {echo $meta_title;}?>" />
		<meta name="keywords" content="<?php if ($meta_keyword == '') {echo $this->config->item('meta_keyword');} else {echo $meta_keyword;}?>" />
		<meta name="description" content="<?php if ($meta_description == '') {echo $this->config->item('meta_description');} else {echo $meta_description;}?>" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() . 'images/logo/' . $this->config->item('fevicon_image'); ?>"> -->
		<?php
		$this->load->view('site/template/css_files');//, $this->data);
		// $this->load->view('site/template/script_files');//, $this->data);
		?>
		<link href="./theme/themecss_<?php echo '15'; ?>header.css" rel="stylesheet">
   		<link href="./theme/themecss_<?php echo '15'; ?>footer.css" rel="stylesheet">
   		<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style.css"/>

		<!--[if lt IE 9]>
		<script src="js/html5shiv/dist/html5shiv.js"></script>
		<![endif]-->
		<!--header-->
		<!--Theme settings-->
		<!-- <?php
		$path = './theme/themecss_' . '15' . '.css';
		?> -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

		<!-- <script src="js/assets/jquery-v11.js"></script> -->
		<!-- <script src="js/assets/bootstrap.min.js"></script> -->