<h3>Pro Registration</h3>			
<?php if(!isValidKey()): ?><p>Fill out the fields below, if you have purchased the pro version of the plugin, to activate additional features such as Front-End Testimonial Submission.</p><?php endif; ?>
<?php if(isValidKey()): ?>	
<p class="easy_t_registered">Your plugin is succesfully registered and activated!</p>
<?php else: ?>
<p class="easy_t_not_registered">Your plugin is not succesfully registered and activated. <a href="http://goldplugins.com/our-plugins/easy-testimonials-details/" target="_blank">Click here</a> to upgrade today!</p>
<?php endif; ?>	
<style type="text/css">
.easy_t_registered {
    background-color: #90EE90;
    font-weight: bold;
    padding: 20px;
    width: 860px;
}
.easy_t_not_registered {
	background-color: #FF8C00;
    font-weight: bold;
    padding: 20px;
    width: 860px;
}
</style>
<?php if(!isValidMSKey()): ?>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="easy_t_registered_name">Email Address</label></th>
		<td><input type="text" name="easy_t_registered_name" id="easy_t_registered_name" value="<?php echo get_option('easy_t_registered_name'); ?>"  style="width: 250px" />
		<p class="description">This is the e-mail address that you used when you registered the plugin.</p>
		</td>
	</tr>
</table>
	
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="easy_t_registered_url">Website Address</label></th>
		<td><input type="text" name="easy_t_registered_url" id="easy_t_registered_url" value="<?php echo get_option('easy_t_registered_url'); ?>"  style="width: 250px" />
		<p class="description">This is the Website Address that you used when you registered the plugin.</p>
		</td>
	</tr>
</table>
	
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="easy_t_registered_key">API Key</label></th>
		<td><input type="text" name="easy_t_registered_key" id="easy_t_registered_key" value="<?php echo get_option('easy_t_registered_key'); ?>"  style="width: 250px" />
		<p class="description">This is the API Key that you received after registering the plugin.</p>
		</td>
	</tr>
</table>
<?php endif; ?>