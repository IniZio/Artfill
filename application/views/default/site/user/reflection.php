<?php $this->load->view('site/templates/header'); ?>
<style >
	header{
		margin-bottom: 0px;
	}
</style>
<link href="css/animate.css" rel="stylesheet">
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<script src="js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<section class = "container">
	<div class = "main">
		<div class="sign_in_container">
			<div class="sign_in_form">
				<div class="sign_in_form-inner">
					<div class="register_container">
						<div style="float:left; width:100%;" class="sign_head5">
							<h2 style="font-size: 20px;"><?php if($this->lang->line('reflection_title') != '') { echo stripslashes($this->lang->line('reflection_title')); } else echo '我們需要你的反映!'; ?></h2>
						</div>
						<form action="site/user/reflection" method="post" enctype="multipart/form-data" id="reflection_form" name="reflection_form">
							<label><?php if($this->lang->line('reflection_type') != '') { echo stripslashes($this->lang->line('reflection_type')); } else echo '反映類型'; ?></label>
							
							<div class="pass-right">
								<select class="preview_pro" name="reflection_type" id="reflection_type" style="cursor:pointer !important; width: 278px;">
									<option value="">Select</option>
									<option value="feature_request">更多特色</option>
									<option value="bug_report">有不正常</option>
									<option value="imperfection">可以更好</option>
								</select>
							</div>
							<!-- Reflection message -->
							<label><?php if($this->lang->line('reflection_message') != '') { echo stripslashes($this->lang->line('reflection_message')); } else echo '反映内容'; ?></label>
							<div class="pass-right">
								<textarea name="reflection_message" value="Your reflection" style=" width:38%;"></textarea>
								<div class="clear">
								</div>
							</div>
							<!-- Reflection screenshot -->
							<div class="clear"></div>
							<label><?php if($this->lang->line('reflection_photo') != '') { echo stripslashes($this->lang->line('reflection_photo')); } else echo '反映圖片'; ?></label>
<div class="pass-right"><!--<div class="picture_edit">
								<img src="http://localhost/images/users/Screenshot from 2016-02-27 09:41:56.png">
							</div>-->
							<div class="upload_profile_12">
								<div>
									<input type="button" onclick="document.getElementById('reflection_img').click()" value="選擇圖片"><b id="no_file_selected">未選擇圖片</b>
									<input type="file" id="reflection_img" class="shipping_fiel_12" style="margin:10px 0 0 10px; color:#fff; display:none;" name="reflection_img">
									<label id="ErrImage" class="img-size"></label>
								</div>
							</div>
							<!--<input type="file" name="reflection_img" id="reflection_img">-->
						</div>
						<!-- submit button -->
						<div class="clear"></div>
						<div class="save-changes"><input class="password_btn" type="submit" name="save" value="提交">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</section>
<script>
$('#reflection_img').change(function(){
$('#no_file_selected').text($('#reflection_img').val());
});
</script>
<?php $this->load->view('site/templates/footer'); ?>