<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
	<div class="grid_container">
		<div class="grid_12">
			<div class="widget_wrap">
				<div class="widget_top">
					<span class="h_icon blocks_images"></span>
					<h6><?php echo $heading?></h6>
					<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php
							if ($featurekeys->num_rows() > 0){
								foreach ($featurekeys->result() as $row){
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('admin/templates/footer.php');
?>