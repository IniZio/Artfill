<div class="add_shop">
	<div class="main">
		<ul class="add_steps">
			 
			 <li  class="step_2"> 
				<a title="Choose Your Shop Name" href="view-ticket-list/<?php echo $seller_details->row()->seourl; ?>" class="<?php if($this->uri->segment(1) != 'freshdesk-tickets'){ echo 'support_active';  } ?> ">
					<div class="name-inner"><?php if($this->lang->line('comm_view_freshdesk_tickets') != '') { echo stripslashes($this->lang->line('comm_view_freshdesk_tickets')); } else echo 'Tickets'; ?>
						<span class="complete-indicator"></span>
					</div>
				</a>
			</li>
			 
			 <li  class="step_1"> 
				<a title="Create New Ticket" href="freshdesk-tickets"class="<?php if($this->uri->segment(1)=='freshdesk-tickets'){ echo 'support_active';  } ?>">
					<div class="name-inner">
						<?php if($this->lang->line('submit_new_freshdesk_ticket') != '') { echo stripslashes($this->lang->line('submit_new_freshdesk_ticket')); } else echo 'Submit New Ticket'; ?>
						<span class="complete-indicator"></span>
					</div>
				</a>
			</li>
		</ul>
	</div>
</div>	

<style>
.support_active {
	background-color:#DD6F18 !important; 
}
</style>