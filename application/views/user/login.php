<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<form method="post" action="/user/login_user">
	<label>User name</label>
	<input type="text" id="username"></input>
	<label>Email</label>
	<input type="text" id="email"></input>
	<label>Password</label>
	<input type="password" id="password"></input>
	<input type="submit" value="submit"></input>
</form>