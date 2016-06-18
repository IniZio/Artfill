<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Theme Layout</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/layout/EditThemeLayoutProcess',$attributes) 
					?>
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_title"><?php echo $themeDetail->row()->name;?><span class="req">*</span></label>
									<div class="form_input">
                                    <input name="value"  id="value" value="<?php echo $themeDetail->row()->value;?>" type="text" tabindex="1" class="required tipTop" title="Please choose the color"/>
									</div>
								</div>
								</li>
								
                                 
								<input type="hidden" name="theme_id" value="<?php echo $themeDetail->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
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
<style>
#value {
	margin:0;
	padding:0;
	border:0;
	width:70px;
	height:20px;
	border-right:20px solid <?php echo $themeDetail->row()->value;?>;
	line-height:20px;
	background:white;
}
</style>
<script type="text/javascript">

$('#value').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		$(el).css('border-color','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val('#'+hex);
	}
}).keyup(function(){
	$(this).colpickSetColor(this.value);
});
</script>