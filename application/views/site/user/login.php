<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php

$this->load->view('site/template/header');
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<form action="login_user" method="POST">
	<div class="form-group">
		<label for="username" class="col-sm-1 control-label">Username:</label>
		<div class="col-sm-2">
			<input type="text" name="username" id="username" class="form-control" value="" title="">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-1 control-label">Email:</label>
		<div class="col-sm-2">
			<input type="email" class="form-control" id="email" placeholder="Input field">
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-1 control-label">Password:</label>
		<div class="col-sm-2">
			<input type="password" name="password" id="password" class="form-control" title="">
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<h1><?php echo $this->session->userdata['artfill_session_user_name'] ?></h1>