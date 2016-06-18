<?php $this->load->view('site/templates/header');?>
<style >
	header{
		margin-bottom: 0px;
	}
</style>
<link href="css/animate.css" rel="stylesheet">
<?php if (isset($active_theme) && $active_theme->num_rows() != 0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>
<script src="js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<div class="list_inner_fields" id="shop_page_seller">
	<div class="sh_content">
		<div class="col-lg-12">
			<form class="form-horizontal" method="post" action="site/user/reflection" enctype="multipart/form-data" name="reflection_form" id="">
				<div class="col-lg-12 sh_border" >
					<h3>意見諮詢</h3>
					<h4>我們需要您的建議！</h4>
					<!-- Reflection type -->
					<div class="form-group">
						<label id="type" for="reflection_type" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('reflection_type') != '') { echo stripslashes($this->lang->line('reflection_type')); } else echo '反映類型'; ?></label>
						<div class="col-md-2 col-sm-3 col-xs-12">
							<select name="reflection_type" id="reflection_type">
								<option value="">選擇一個類型...</option>
								<option value="feature_request">更多特色</option>
								<option value="bug_report">有不正常</option>
								<option value="imperfection">可以更好</option>
							</select>
						</div>
						<!-- <div class="col-sm-7 col-xs-12">
															<input type="text" name="reflection_type" class="form-control" id="maxtextval" maxlength="140" style="width: 50%;" onkeyup="change('maxtextval','goo_item_title')">
															
						</div> -->
						<!-- <div class="col-md-3 col-sm-12 col-xs-12">
														<span class="list_div_note">最多140個字符:</span>
						</div> -->
					</div>
					<!-- Reflection message -->
					<div class="form-group">
						<label id="type" for="reflection_type" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('reflection_message') != '') { echo stripslashes($this->lang->line('reflection_message')); } else echo '反映内容'; ?></label>
						<div class="col-md-6 col-sm-3 col-xs-12">
							<textarea class="form-control" rows="5" id="reflection_message" name="reflection_message"></textarea>
						</div>
					</div>
					<!-- Reflection url -->
					<div class="form-group">
						<label id="type" for="reflection_url" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('reflection_url') != '') { echo stripslashes($this->lang->line('reflection_url')); } else echo '反映網址'; ?></label>
						<div class="col-sm-4" id="reflection_url">
							<input type="text" class="form-control" placeholder="例:https://artfill.co/shop/reflection" value="" id="reflection_url" name="reflection_url">
						</div>
					</div>
					<!-- Reflection screenshot -->
					<div class="form-group">
						<label id="type" for="reflection_img" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('reflection_img') != '') { echo stripslashes($this->lang->line('reflection_img')); } else echo '反映圖片'; ?></label>
						<input type="button" onclick="document.getElementById('reflection_img').click()" value="選擇圖片"><b id="no_file_selected">未選擇圖片</b>
						<input type="file" id="reflection_img" class="shipping_fiel_12" style="margin:10px 0 0 10px; color:#fff; display:none;" name="reflection_img">
						<label id="ErrImage" class="img-size"></label>
					</div>
					<div class="save-changes"><input class="save_btn" type="submit" name="save" value="提交">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
$('#reflection_img').change(function(){
$('#no_file_selected').text($('#reflection_img').val());
});
</script>
<?php $this->load->view('site/templates/footer');?>