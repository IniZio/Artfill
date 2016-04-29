<?php
	$this->load->view('site/templates/header');
?>
<style>
.nexi {
    background:url("images/top.png") no-repeat scroll -93px 0 rgba(0, 0, 0, 0);
    float: left;
    height: 35px;
    width: 40px;
}
.prei {
    background: url("images/top.png") no-repeat scroll -93px 0 rgba(0, 0, 0, 0);
    float: left;
    height: 35px;
	transform:rotateY(180deg);
	-moz-transform:rotateY(180deg);
	-webkit-transform:rotateY(180deg);
	-ms-transform:rotateY(180deg);
    width: 40px;
}
</style>
<script>
function testlist() {
	document.getElementById('help_list').style.display='none';
	document.getElementById('close_but').style.display='none';
}
</script>
<section class="browse-head">

<div class="help_section">
	<div class="container">		
		<div class="help_box">
			<h2>How can we help you?</h2>
			<div class="subscribe-content-inner">
				<div class="help-input-show">
				<form method="GET" action="site/cms/search_help" name="search">	
					<input type="text" class="text help_box_scroll" placeholder="Search for help by keywords or phrases" style="margin-left: 128px;" name="keyword" id="keyword">
				
				<!--<a class="help-close" href="javascript:showView('3');"></a>-->
				<?php if($_GET['keyword']!='') { ?><a class="help-close" href="javascript:testlist('3');" id="close_but" style="display:block;"></a><?php } ?>
				</div>		
				<!--<button type="submit" class="btn-primary subscribe-link sub-spin" onClick="return subscribe_user(); ">Search help</button>-->
				<!--<a href="javascript:showView('3');">-->
				<input type="submit" class="btn-primary  sub-spin" value="Search help" onsubmit="showView('3');" style="margin-right: 172px;"><!--</a>-->
				</form>	
				<!--<div class="search_box_hidden showlist3">-->
				<?php if($_GET['keyword']!='') { ?>
				<div class="" id="help_list" style="display:block;">
					<?php if($_GET['keyword']!='') { ?>
						<div class="results-count">1 of <?php echo sizeof($search_help_detailsCount); ?> results for <span><?php echo $_GET['keyword']; ?></span></div>		
					<?php } ?>	
					<?php foreach($search_help_details as $row) { ?>
						<div class="article-box">
							<h4><a href="pages/<?php echo $row['seourl']; ?>"><?php echo $row['page_title']; ?></a></h4>
							<p>
								<?php 
									#echo $row['description']; 
									$char_str = $row['description']; 
									$string = word_limiter($char_str, 55);
									echo ucfirst($string);
								?>
							</p>
						</div>
					<?php } ?>
					
					<?php if(!empty($paginationLink)) { ?>     					
						<div class="results-navigation">						
						<!--<span class="results-count1">11 &ndash; 20 of 421 results</span>                    
						<a href="#" class="previous-page">Previous</a>                 
						<a href="#" class="next-page">Next</a>-->						 
							<span class="results-count1">
								<?php if(!empty($paginationLink)) { ?>     
									<div class="page-side">   
										<span>Page </span><label><?php if($_GET['per_page']!=''){ echo ceil((sizeof($search_help_details)+$_GET['per_page'])/$per_page_list); }else{ echo 1; } ?></label><span> of </span><label><?php echo ceil(sizeof($search_help_detailsCount)/$per_page_list); ?></label>
									</div>	 
								<?php } ?>
								
								<div class="pageNavSearch" >
									<?php  
									if(!empty($paginationLink)){ ?>
									  <?php echo $paginationLink;  ?>
									<?php } ?>
								</div>
								
							</span>
						</div>
					<?php } ?>	
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</section>

<section class="container">
<div class="help_section2">

	<div class="main">	
		
		<div class="help_box2">
		
			<?php foreach($help_topic->result_array() as $result) { ?>
			<div class="help-col-1">
				<h2><?php echo $result['title']; ?></h2>				
				<?php 
					$sel_qry = "select * from ".CMS." where help_id='".$result['id']."' and status='".Publish."' order by id desc limit 5";
					$query = $this->db->query($sel_qry);
					$help_pages = $query->result_array();
				?>
				<ul>
					<?php foreach($help_pages as $pages) { ?>
						<li><a href="pages/<?php echo $pages['seourl']; ?>"><?php echo $pages['page_title']; ?></a></li>					
					<?php } ?>	
				</ul>		
			</div>
			<?php } ?>
			
			
			<!--<div class="help-col-1">
				<h2>Building Your Business</h2>				
				<ul>
					<li><a href="">Marketing Your Shop</a></li>
					<li><a href="">Shop Stats</a></li>
					<li><a href="">The Review System</a></li>
					<li><a href="">Getting Items Found in Search</a></li>
					<li><a href="">The About Page in Your Shop</a></li>	
				</ul>		
			</div>									
			<div class="help-col-1">
				<h2>Paying Your Bill</h2>				
				<ul>
					<li><a href="">Paying Your Etsy Bill</a></li>
					<li><a href="">Your Bill on Etsy</a></li>
					<li><a href="">Seller Fees for Direct Checkout</a></li>
					<li><a href="">Etsy Bill Past Due</a></li>
					<li><a href="">Billing Policy</a></li>	
				</ul>		
			</div>-->
		</div>					    
	    
		<?php if($loginCheck=='') { ?>
			<div class="help-bottom">						
				<ul class="help-bottom-middle">			
					<li>
						<a href="pages/contacting-the-seller"><span class="help-icon help-3"></span>
						<h3>Contacting the Seller</h3>
						<p>Got a question about an item? We'll show you how to ask the seller.</p>
						</a>
					</li>					
					<li>
						<a href="register"><span class="help-icon help-4"></span>
						<h3>Sign Up to Sell</h3>
						<p>Turn your passion into a business, open up an <?php echo $this->config->item('email_title'); ?> shop.</p>
						</a>
					</li>			
				</ul>		
			</div>		
		<?php } else { ?>	
			<div class="help-bottom">			
				<ul class="help-bottom-middle">			
					<li>
						<a href="pages/seller-handbook"><span class="help-icon help-1"></span>
						<h3>Seller Handbook</h3>
						<p>Study up with an index of our best info for sellers.</p>
						</a>
					</li>					
					<li>
						<a href="pages/community-resources"><span class="help-icon help-2"></span>
						<h3>Community Resources</h3>
						<p>Check out our online workshops, get help from a team, or attend a local event.</p>
						</a>
					</li>	
				</ul>			
			</div>	
		<?php } ?>	
		
	</div>
</div>
</section>


<?php
	$this->load->view('site/templates/footer');
?>