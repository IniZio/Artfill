<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="paid_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								#
							</th>
							<th class="tip_top" title="Click to sort">
								 Date
							</th>
							<th class="tip_top" title="Click to sort">
								Amount
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($codDetails->num_rows() > 0){
						$i=0;
							foreach ($codDetails->result() as $row){
							$i++;
						?>
						<tr>
							<td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo $row->dateAdded;?>
							</td>
							<td class="center">
								<?php echo $row->amount;?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>
								#
							</th>
							<th>
								  Date
							</th>
							<th>
								Amount
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>