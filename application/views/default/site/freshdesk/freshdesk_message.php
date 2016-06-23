<?php 
$this->load->view('site/templates/commonheader');  
 $this->load->view('site/templates/header');  
 $this->load->view('site/freshdesk/menu_bar');  
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div id="shop_page_seller" >
   <section class="container">
<div class="main">  

<div class="community_right">
	<div class="profile_field1" >
				<label style="color: black;font-size: 25px;margin: 0 0 15px 0;"><?php  echo $heading; ?> </label>
			</div>
			<div class="desk-table">
	<table class="table table-striped" id="data-tables" style="margin: 0 0 0 0;">
		<?php $count=count($freshdesk_messages);?>
                  				<?php if($ticketCount > 0){ ?>
		<thead> 
			<tr style="background: rgb(99, 181, 207);color: #fff;">
			
           <th><?php echo af_lg('lg_ticketID','Ticket ID');?></th>
             <th><?php echo af_lg('lg_subject','Subject');?></th> 
            <th><?php echo af_lg('lg_created_date','Created Date');?></th> 
			<th><?php echo af_lg('lg_priority','Priority');?></th>
             <th><?php echo af_lg('lg_status','Status');?></th> 
             </tr>                               
             </thead>
                            <tbody> 
								<?php 
									$sno=1;
									$count=count($freshdesk_messages);
									 for($i=0;$i<$ticketCount;$i++){ ?>
									<tr style="color: black;">
										
										<td> <?php echo $freshdesk_messages[$i]->display_id;?></td> 	
										<td> <a href="view-ticket/<?php echo $freshdesk_messages[$i]->display_id;?>"><?php echo $freshdesk_messages[$i]->subject;?></a></td>		
										<td> 
										<?php  $createdOn= date('Y-m-d H:i:s',strtotime($freshdesk_messages[$i]->created_at));
													
													$datediff = time()-strtotime($createdOn); 
													$diffdate=floor($datediff/(60*60*24));
													if($diffdate!=0){
														if($diffdate<4){
															$msgtime= $diffdate.addslashes(af_lg('lg_days_ago',' days ago'));
														}else{
															$msgtime= date('m/d/Y',strtotime($createdOn));
														}
													}else{
														if(floor($datediff/(60*60))<1){
															if(floor($datediff/(60))>0){
																$msgtime= floor($datediff/(60)).addslashes(af_lg('lg_mins_ago',' mins ago'));
															}else{
																$msgtime= addslashes(af_lg('lg_justnow',' Just now'));
															}
														}else{
															$msgtime= floor($datediff/(60*60)).addslashes(af_lg('lg_hrs_ago',' hours ago'));
														}
													}
													echo $msgtime;
												?>
										
										
										</td>
										<td><?php echo $freshdesk_messages[$i]->priority_name;?></td>
										<td><?php echo $freshdesk_messages[$i]->status_name; ?></td>
									</tr>							   
								<?php $sno++;}?>							
							</tbody>						
								
			<?php } else { ?> 	
				<span style="color:black;font-size:15px;padding: 20%;"><strong><?php echo af_lg('lg_no_ticket','You Have No Tickets ..');?></strong></span>
		<?php } ?>		
	</table>
	
	<?php  
		$globalshop_url = $this->uri->segment(2);
	if(($ticketCount >= 30 || $pageNo != 1) && ($ticketCount != 0 || $pageNo != 1 )) { ?> 
		<ul class="pagination">
			<?php if($prevBtn == 'Yes'){ ?>
			<li>
			<a href="<?php echo base_url().'view-ticket-list/'.$globalshop_url.'/'.($pageNo-1); ?>" id="prevBtn" >
			<span style="float: right; margin-left: 6px;"> <?php echo af_lg('lg_previous','Previous');?></span> <i class="icon icon-previous"></i>
			</a>
			</li>
			<?php } ?>
			<li>
			<a><?php echo $pageNo; ?></a>
			</li>
			<?php if($nextBtn == 'Yes'){ ?>
			<li>
			<a href="<?php echo base_url().'view-ticket-list/'.$globalshop_url.'/'.($pageNo+1); ?>" id="nextBtn">
				<span style="margin-right: 6px;"> <?php echo af_lg('lg_next','Next');?></span> <i class="icon icon-next"></i>
			</a>
			</li>
			<?php } ?>
		</ul>
		
	<?php } ?>	
	
	</div>
</div>
</div>
</section>
</div>
<?php 
$this->load->view('site/templates/footer');
?>