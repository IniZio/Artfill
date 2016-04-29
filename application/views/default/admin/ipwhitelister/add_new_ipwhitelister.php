<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						
						<h6>Add New IP_Whitelist</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'add_ipaddr_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/ipwhitelist/add_ipaddress',$attributes) 
					?>
				
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="name">IP_address<span class="req">*</span></label>
									<div class="form_input">
										<input name="ip_address" id="ip_address" type="text" tabindex="1" class="required large tipTop" title="Please enter the ip_address"/>
									</div>
								</div>
								</li>
							  <li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
										<input type="hidden" name="created_on" id="created_on" value="<?php echo  mdate($datestring, $time); ?>"  />
										<button type="submit" class="btn_small btn_blue" onclick="return ValidateIPaddress()"   tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
								
								</div>
								</div>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>

  <script type="text/javascript">
 function ValidateIPaddress(ipaddress) 
{
 if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(add_ipaddr_form.ip_address.value))
  {
    return (true)
  }
alert("You have entered an Invalid IP address!")
return (false)
}
    </script>
