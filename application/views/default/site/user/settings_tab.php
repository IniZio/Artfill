<ul class="secondary-tabs clear">
    <li class="first"><a href="<?php echo 'settings/my-account/'.$this->session->userdata['shopsy_session_user_name'];?>" <?php if($this->uri->segment(2) == 'my-account'){ echo 'class="active"'; } ?>>
		<?php if($this->lang->line('user_account') != '') { echo stripslashes($this->lang->line('user_account')); } else echo 'Account'; ?>
    </a></li>
    <!--<li><a href="settings/account-preferences" <?php if($this->uri->segment(2) == 'account-preferences'){ echo 'class="active"'; } ?>>
		<?php if($this->lang->line('user_preferences') != '') { echo stripslashes($this->lang->line('user_preferences')); } else echo 'Preferences'; ?>
    </a></li>-->
    <li><a href="settings/account-privacy" <?php if($this->uri->segment(2) == 'account-privacy'){ echo 'class="active"'; } ?>>
    	<?php if($this->lang->line('user_privacy') != '') { echo stripslashes($this->lang->line('user_privacy')); } else echo 'Privacy'; ?>
    </a></li>
  <!--  <li><a href="settings/account-security" <?php if($this->uri->segment(2) == 'account-security'){ echo 'class="active"'; } ?>>Security</a></li>-->
    <li><a href="settings/account-shipping-address" <?php if($this->uri->segment(2) == 'account-shipping-address'){ echo 'class="active"'; } ?>>
    	<?php if($this->lang->line('ship_address') != '') { echo stripslashes($this->lang->line('ship_address')); } else echo 'Shipping Addresses'; ?>
    </a></li>
    <li><a href="settings/account-creditcard" <?php if($this->uri->segment(2) == 'account-creditcard'){ echo 'class="active"'; } ?>>
    	<?php if($this->lang->line('user_credt_cards') != '') { echo stripslashes($this->lang->line('user_credt_cards')); } else echo 'Credit Cards'; ?>
    </a></li>
    <!--<li><a href="settings/account-email" <?php if($this->uri->segment(2) == 'account-email'){ echo 'class="active"'; } ?>>Emails</a></li>-->
</ul>