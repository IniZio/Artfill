<?php
$this->load->view('admin/templates/header.php');
$this->load->model('blog_model'); 
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<table>
							<tbody>
							<tr>
								<td>
									Total Posts
								</td>
								<td>
									<?php  $commentData = $this->blog_model->get_all_posts_common('');  
									   echo  count($commentData);//$commentData['0']['disp']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Total Comments
								</td>
								<td>
									<?php  $commentData = $this->blog_model->get_allcomment_counts_dashboard('');     echo $commentData['0']['disp']; ?>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>