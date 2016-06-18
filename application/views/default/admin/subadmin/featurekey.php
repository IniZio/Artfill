<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
	<div class="grid_container">
		<div class="grid_12">
			<div class="widget_wrap">
				<div class="widget_top">
					<span class="h_icon list"></span>
					<h6><?php echo $heading?></h6>
					<div class="widget_content">
						<div style="float: center;line-height:40px;padding:0px 10px;height:39px;">
							<a title="Generate 10 new keys" class="tip_top" href="admin/subadmin/generate_featurekey"><span class="badge_style b_done">Generate</span></a>
							<div class="widget_content">
										<table class="display" id="featurekey_tbl">
									<thead>
										<tr>
											<th>
												Key id
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if ($featurekeys->num_rows() > 0){
												foreach ($featurekeys->result() as $row){
										?>
										<tr>
											<td class="center">
												<?php echo $row->key_id;?>
											</td>
											<?php
													}
												}
											?>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th>
												Key id
											</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('admin/templates/footer.php');
?>