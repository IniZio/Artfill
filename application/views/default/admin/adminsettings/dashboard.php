<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
//echo "<pre>"; print_r($days_orders[0]); die;

//echo '<pre>';print_r($this->data); die;
?>
<style>
.jqplot-table-legend{
	left:395px !important; top:-22px !important;
}
</style>
<script>
	$(function () {
    $.jqplot._noToImageButton = true;
    var d = new Date();
	var ye = <?php echo $year;?>;
	var m = d.getMonth();
	
	var mon = <?php echo $month;?>;
	//alert(mon);
 	//var prevYear = [[""+n+"-01-01",398],[""+n+"-02-01",398],[""+n+"-03-01",398],[""+n+"-04-01",398],[""+n+"-05-01",398],[""+n+"-06-01",398],[""+n+"-07-01",398],[""+n+"-08-01",398],[""+n+"-09-01",398],[""+n+"-10-01",900],[""+n+"-11-01",900],[""+n+"-12-01",900]];

 	//var names = $( "[name^='month']" );
 	var month=document.getElementsByName('month[]');
 	var year=document.getElementsByName('year[]');
	var loop_count=<?php echo $loop_count; ?>;
	var mtot=new Array();
	for(var i=0;i<loop_count;i++){
	
		 mtot[i]=document.getElementById('mtot['+i+']').value;
		 
	}
	
 	//var mtot=document.getElementById('mtot[1]').value;
	//alert(mtot);
	//alert(mtot[2].value);
	//alert(mtot['1']);
	var count=<?php echo $loop_count; ?>;
 	var prevYear = new Array();
	/*  for(i=1;i<=12;i++){
		var prevYearCnt = new Array();

		if(i<=9){
			var mo="0"+i;
		}
		else{
			var mo=i;
		}
		//alert(mon)
		if(i<= mon){
			var y=ye;
		}else{
			var y=ye-1;
		}
		 
		 
		/*  for(i=1;i<=count;i++){
			
		 } */
		/* prevYearCnt['0']= ""+y+"-"+mo+"-01";// = n+"-0"+i+"-01";
		alert(prevYearCnt['0']);
		prevYearCnt['1']=  0.1; // = n+"-0"+i+"-01";

		for(key=0; key < month.length; key++)  {
			if(month[key].value == i){
				prevYearCnt['1'] = parseInt(mtot[key].value);
			}
		}	
		prevYear.push(prevYearCnt);
		//alert(prevYear[i-1]);
	} */
		var start_date=01;
		var end_date= start_date+04;
		
		//alert(loop_count);
		var days=<?php echo $days;?>;
			
		for(var i=0;i<loop_count;i++){
		var prevYearCnt = new Array();
			if(i>=1)
			{
				var temp= end_date+01;
				start_date= temp;
				end_date= start_date+04;
				if(start_date==29 || start_date==31 )
				{
					end_date=days;
				}
		}
			//prevYearCnt['0']="2015-07-"+start_date;
			prevYearCnt['0']= ""+ye+"-"+mon+"-"+start_date;
			prevYearCnt['1']=  0.1;
		if(!isNaN(parseInt(mtot[i])) || mtot[i]!=0 ||mtot[i]!=""){
			prevYearCnt['1'] = parseInt(mtot[i]);
		}
		prevYear.push(prevYearCnt);
	}
		
	var month=document.getElementsByName('dismonth[]');
 	var year=document.getElementsByName('disyear[]');
 	var mtot=document.getElementsByName('distot[]');
 	var mtot=new Array();
	for(var i=0;i<loop_count;i++){
		 mtot[i]=document.getElementById('distot['+i+']').value;
	}
	//alert(mtot[1]);
	//var y = year[0].value;
	var currYear = new Array();
	/* for(i=1;i<=12;i++){
		var prevYearCnt = new Array();

		if(i<=9){
			var mo="0"+i;
		}
		else{
			var mo=i;
		}

		if(i<= mon){
			var y=ye;
		}else{
			var y=ye-1;
		} */
		
		var start_date=01;
		var end_date= start_date+04;
		var loop_count=<?php echo $loop_count; ?>;
		var days=<?php echo $days;?>;
		for(var i=0;i<loop_count;i++){
		var prevYearCnt = new Array();
			if(i>=1)
			{
				var temp= end_date+01;
				start_date= temp;
				end_date= start_date+04;
				if(start_date==29 || start_date==31 )
				{
					end_date=days;
				}
		}
	//	prevYearCnt['0']="2015-07-"+start_date;
		prevYearCnt['0']= ""+ye+"-"+mon+"-"+start_date;
		//alert(prevYearCnt['0']);
	//	prevYearCnt['0']= ""+y+"-"+mo+"-01";// = n+"-0"+i+"-01";
		prevYearCnt['1']=  0.1; // = n+"-0"+i+"-01";
		if(!isNaN(parseInt(mtot[i]))|| mtot[i]!=0 || mtot[i]!=""){
				prevYearCnt['1'] = parseInt(mtot[i]);
		}
		currYear.push(prevYearCnt);
		} //alert(prevYear[i-1]);
	
	
	console.log(prevYear);
	console.log(currYear);
	//var currYear = [prevYearCnt];
	//var currYear = prevYear;
	//[[""+n+"-01-01",398],[""+n+"-02-01",398],[""+n+"-03-01",398],[""+n+"-04-01",398],[""+n+"-05-01",398],[""+n+"-06-01",398],[""+n+"-07-01",398],[""+n+"-08-01",398],[""+n+"-09-01",398],[""+n+"-10-01",900],[""+n+"-11-01",900],[""+n+"-12-01",900]];
	//	var currYear = prevYear;[[""+n+"-01-01",398],[""+n+"-02-01",398],[""+n+"-03-01",398],[""+n+"-04-01",398],[""+n+"-05-01",398],[""+n+"-06-01",398],[""+n+"-07-01",398],[""+n+"-08-01",398],[""+n+"-09-01",398],[""+n+"-10-01",900],[""+n+"-11-01",900],[""+n+"-12-01",900]];
    var plot1 = $.jqplot("chart1", [prevYear,currYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Monthly Revenue',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: 'Order'
            },
            {
                label: 'Dispute'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: ""+ye+"-"+(mon)+"-01",
                max: ""+ye+"-"+(mon)+"-31",
                tickInterval: "5 days",
                drawMajorGridlines: true
            },	
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                   	formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
});
</script>
    <!--<div class="switch_bar">
		<ul>
			<!--<li>
			<a href="#"><span class="stats_icon current_work_sl"></span><span class="label">Analytics</span></a>
			</li>-->
            <?php extract($privileges); ?>
			<?php if ((isset($user) && is_array($user)) && in_array('0', $user) || $allPrev == '1'){ 	?>
			<!--<li class="list_user"><a href="admin/users/display_user_list" ><span class="stats_icon user_sl"></span><span class="alert_notify orange"><?php echo $totalUserCounts;?></span><span class="label"> Users</span></a>
            
			<!--<div class="notification_list dropdown-menu blue_d">
				<div class="white_lin nlist_block">
					<ul>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
						</div>
						</li>
					</ul>
					<span class="btn_24_blue"><a href="#">View All</a></span>
				</div>
			</div>-->
			<!--</li>
            <?php } if ($allPrev == '1'){ ?>			
			<li class="list_settings"><a href="admin/adminlogin/admin_global_settings_form"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
            <?php } if ((isset($seller) && is_array($seller)) && in_array('0', $seller) || $allPrev == '1'){ 	?>
            <li class="list_sellers"><a href="admin/seller/display_seller_list"><span class="stats_icon user_seller"></span><span class="alert_notify orange"><?php echo $getTotalSellerCount;?></span><span class="label"> Sellers</span></a></li>
            
            <?php } if ((isset($category) && is_array($category)) && in_array('0', $category) || $allPrev == '1'){ 	?>
			<li class="list_category"><a href="admin/category/display_category_list"><span class="stats_icon cate_dash"></span><span class="label">Category</span></a></li>
			
            
             <?php } if ((isset($product) && is_array($product)) && in_array('0', $product) || $allPrev == '1'){ 	?>            
            <li class="list_product"><a href="admin/product/display_product_list"><span class="stats_icon folder_sl"></span><span class="alert_notify orange"><?php echo $getTotalProductCount;?></span><span class="label">Product</span></a></li>
            
    		<?php  } if ((isset($couponcards) && is_array($couponcards)) && in_array('0', $couponcards) || $allPrev == '1'){ ?>        
			<!--<li><a href="admin/fancyybox/display_fancyybox"><span class="stats_icon category_sl"></span><span class="label">Fancy Box</span></a></li>
			<li><a href="admin/attribute/display_attribute_list"><span class="stats_icon list_dash"></span><span class="label">List</span></a></li>-->
			<!--<li class="list_coupons"><a href="admin/couponcards/display_couponcards"><span class="stats_icon coupon_dash"></span><span class="label">Coupons</span></a></li>
			<!--<li><a href="admin/giftcards/display_giftcards"><span class="stats_icon bank_sl"><span class="alert_notify blue"><?php echo $getTotalGiftCardCount;?></span></span><span class="label">Gift Cards</span></a></li>-->
            
            <?php } if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrev == '1'){  ?>
          <!--  <li class="list_news"><a href="admin/newsletter/display_subscribers_list"><span class="stats_icon newsletter_dash"></span><span class="label">Newsletter</span></a></li>			
            
            <?php } if ((isset($cms) && is_array($cms)) && in_array('0', $cms) || $allPrev == '1'){ ?>
            <li class="list_pages"><a href="admin/cms/display_cms"><span class="stats_icon administrative_docs_sl"></span><span class="label">Pages</span></a></li>
            
            <?php }if ((isset($paygateway) && is_array($paygateway)) && in_array('0', $paygateway) || $allPrev == '1'){ ?>
			<li class="list_payment"><a href="admin/paygateway/display_gateway"><span class="stats_icon payment_dash"></span><span class="label">Payment</span></a></li>
            
            <?php }if ((isset($multilang) && is_array($multilang)) && in_array('0', $multilang) || $allPrev == '1'){ ?>
			<li class="list_location"><a href="admin/multilanguage"><span class="stats_icon location_dash"></span><!--<span class="alert_notify orange">30</span>--><!--<span class="label">Languages</span></a></li>
            <?php } ?>
			
            
		</ul>
	</div>-->
	<div id="content">
	<input type="hidden" value="999" id="testv"/>
		<div class="grid_container">
			
			<?php //echo "<pre>"; print_r($monthly_orders);?>
			<?php /* foreach($monthly_orders as $order){ //echo "------<br>";echo $order['month'];?>
			<input type="hidden" class="chart_details" name="month[]" value="<?php echo $order['month'];?>"/>
			<input type="hidden" class="chart_details" name="year[]" value="<?php echo $order['year'];?>"/>
			<input type="hidden" class="chart_details" name="mtot[]" value="<?php echo $order['mtot'];?>"/>
			<input type="hidden" class="chart_details" name="morder[]" value="<?php echo $order['morder'];?>"/>
			<?php } */?>
			
			
			
			<?php  for($i=0;$i<$loop_count;$i++) { ?>
			
			<?php 
			foreach($days_orders[$i] as $order){ 
			
			//echo "------<br>";echo $order['month'];?>
			<input type="hidden" class="chart_details" id="month[<?php echo $i; ?>]" value="<?php echo $order['month'];?>"/>
			<input type="hidden" class="chart_details" id="year[<?php echo $i; ?>]" value="<?php echo $order['year'];?>"/>
			<input type="hidden" class="chart_details" id="mtot[<?php echo $i; ?>]" value="<?php echo $order['mtot'];?>"/>
			<input type="hidden" class="chart_details" id="morder[<?php echo $i; ?>]" value="<?php echo $order['morder'];?>"/>
			<?php }
			}
			?>
			
			
			
			<?php /* foreach($monthly_disputes as $dispute){ //echo "------<br>";echo $order['month'];?>
			<input type="hidden" class="chart_details" name="dismonth[]" value="<?php echo $dispute['dismonth'];?>"/>
			<input type="hidden" class="chart_details" name="disyear[]" value="<?php echo $dispute['disyear'];?>"/>
			<input type="hidden" class="chart_details" name="distot[]" value="<?php echo $dispute['distot'];?>"/>
			<input type="hidden" class="chart_details" name="disorder[]" value="<?php echo $dispute['disorder'];?>"/>
			<?php } */?>
			
			<?php 
			 for($i=0;$i<$loop_count;$i++) {
			foreach($month_disputes[$i] as $dispute){ //echo "------<br>";echo $order['month'];?>
			<input type="hidden" class="chart_details" id="dismonth[<?php echo $i;?>]" value="<?php echo $dispute['dismonth'];?>"/>
			<input type="hidden" class="chart_details" id="disyear[<?php echo $i;?>]" value="<?php echo $dispute['disyear'];?>"/>
			<input type="hidden" class="chart_details" id="distot[<?php echo $i;?>]" value="<?php echo $dispute['distot'];?>"/>
			<input type="hidden" class="chart_details" id="disorder[<?php echo $i;?>]" value="<?php echo $dispute['disorder'];?>"/>
			<?php }
			
			}?>
			
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Order Statistics</h6>
					</div>
					<div class="widget_content">
						<div class="data_widget black_g chart_wrap">
							<div id="chart1">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6" style="height: 485px;">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Order Statistics</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<div class="social_activities">
								
								<a class="activities_s" href="admin/users/display_user_list?status=active">
									<div class="block_label">
										<span class="user_icon"></span><div class="clear"></div>
										Total Users<span><?php echo $totalUserCounts;?></span>
									</div>
								</a>
								
								<a class="activities_s" href="admin/product/display_product_list">
									<div class="block_label">
										<span class="store_icon"></span><div class="clear"></div>
										Total Products<span><?php echo $getTotalProductCount;?></span>
									</div>
								</a>
								
								<a class="activities_s" href="admin/seller/display_seller_list">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Total Sellers<span><?php echo $getTotalSellerCount;?></span>
									</div>	
								</a>
								
								<a class="activities_s" href="admin/shop/display_shop">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Total Shops<span><?php echo $getTotalShopCount;?></span>
									</div>	
								</a>
								
								<a class="activities_s" href="admin/shop/display_shop?status=waiting">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Shops for Approval<span><?php echo $getTotalShopWaiting;?></span>
									</div>	
								</a>
								
								<a class="activities_s" href="admin/order/display_order_paid">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Paid Orders<span><?php echo $getTotalorderCount;?></span>
									</div>	
								</a>
								
								<a class="activities_s" href="admin/claim/display_claim_list">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Dispute Orders<span><?php echo $getTotalorderdispCount;?></span>
									</div>	
								</a>
								
								<a class="activities_s" href="admin/order/display_cancelRequested">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Cancel Orders<span><?php echo $getTotalordercancelCount;?></span>
									</div>
								</a>
								
								<a class="activities_s" href="admin/category/display_category_list">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Categories<span><?php echo $getTotalcategoryCount;?></span>
									</div>	
								</a>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Shops</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4>Shops Count <?php echo $getTotalShopCount;?></h4>
							<table>
							<tbody>
							<tr>
								<td>
									Today
								</td>
								<td>
									<?php echo $TodayshopCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="bar">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Month
								</td>
								<td>
									<?php echo $getThisMonthShopCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Year
								</td>
								<td>
									<?php echo $getLastYearShopCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							</tbody>
							</table>
							<!--<div class="stat_chart">
								<div class="pie_chart">
									<span class="inner_circle">1/1.5</span>
									<span class="pie">1/1.5</span>
								</div>
								<div class="chart_label">
									<ul>
										<li><span class="new_visits"></span>New Visitors: 7000</li>
										<li><span class="unique_visits"></span>Unique Visitors: 3000</li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Users</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4>Users Count <?php echo $totalUserCounts;?></h4>
							<table>
							<tbody>
							<tr>
								<td>
									Today
								</td>
								<td>
									<?php echo $todayUserCounts;?>
								</td>
								<!-- <td class="min_chart">
									<span class="bar">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Month
								</td>
								<td>
									<?php echo $getThisMonthCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Year
								</td>
								<td>
									<?php echo $getLastYearCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							</tbody>
							</table>
							<!--<div class="stat_chart">
								<div class="pie_chart">
									<span class="inner_circle">1/1.5</span>
									<span class="pie">1/1.5</span>
								</div>
								<div class="chart_label">
									<ul>
										<li><span class="new_visits"></span>New Visitors: 7000</li>
										<li><span class="unique_visits"></span>Unique Visitors: 3000</li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			
			
			            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Orders</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4>Order Count <?php echo $getTotorderCount;?></h4>
							<table><tbody>
							<tr>
								<td>Paid Orders</td>
								<td><?php echo $getPaidorderCount;?></td>
							</tr>
							<tr>
								<td>Pending Orders</td>
								<td><?php echo $getPendorderCount;?></td>
							</tr>
							<tr>
								<td>Dispute Orders</td>
								<td><?php echo $getTotalorderdispCount;?></td>
							</tr>
							</tbody></table>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon shopping_cart_3"></span>
						<h6>Recent Order</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 Order ID
							</th>
							<th>
								 Titile
							</th>
							<th>
								 Status
							</th>
							<th>
								 Amount
							</th>
						</tr>
						</thead>
						<tbody> 
                         <?php 
						 $orderIndex = 0;
						 foreach($getOrderDetails as $orderdetails) { ?>
						<tr class="<?php if($orderIndex == 0 || $orderIndex==2) echo 'tr_even';else echo 'tr_odd'; ?>">
							<td class="noborder_b round_l">
								 #<?php echo $orderdetails['dealCodeNumber']; ?>
							</td>
							<td class="noborder_b">
								<span><?php echo $orderdetails['product_name']; ?></span>
							</td>
							<td class="noborder_b">
								<span class="badge_style <?php if($orderdetails['paymentStatus'] =='Pending')echo 'b_pending'; else echo 'b_confirmed'; ?>"><?php echo $orderdetails['paymentStatus']; ?></span>
							</td>
							<td class="noborder_b round_r">
								 <?php echo $orderdetails['paymentPrice']; ?>
							</td>
						</tr>
                        
                        <?php $orderIndex++;
						} ?>
                        
						</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="grid_6">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon h_icon users"></span>
						<h6>Recent Shops List</h6>
					</div>
					<div class="widget_content">
						
						<div id="tab1">
                        
                        <div class="user_list">
								
					 <?php foreach($getRecentShopList as $shopList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($shopList['seller_store_image'] != '') {?>
                                   		 <img src="images/store-banner/<?php echo $shopList['seller_store_image'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $shopList['id'];?>"><?php echo stripslashes($shopList['seller_businessname']); ?></a></i></span></li>
										<li><span>CreatedAt: <?php echo date("d-m-Y",strtotime($shopList['created']));?> Owner Name: <?php echo $shopList['seller_firstname'];?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
                                <?php if($allPrev == '1' || in_array('2',$shop)){ ?>
									<li><a class="p_edit" href="admin/shop/view_shop/<?php echo $shopList['id'].'-'.$shopList['seller_id'];?>";>View</a></li>
                                <?php }?>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
                                <?php if($allPrev == '1' || in_array('2',$shop) ){ ?>
								<?php $mode = ($shopList['status'] == 'active')?'0':'1';
								$modeView = ($shopList['status'] == 'active')?'inactive':'active';
								$modeViewDisplay = ($shopList['status'] == 'active')?'Active':'Inactive';
								if ($mode == '0'){ ?>
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/shop/change_shop_status/0/<?php echo $shopList['id'];?>');"><?php echo $modeViewDisplay;?></a></li>
									<?php }else { ?>
                                    <li class="right"><a class="p_approve" href="javascript:void(0)"><?php echo $modeViewDisplay;?></a></li>
									<?php } }else {
									if($shopList['status']=='active'){ ?>
										<span class="badge_style b_done"><?php echo $shopList['status'];?></span>
										<?php }elseif($shopList['status']=='inactive'){ ?>
										<span class="badge_style"><?php echo $shopList['status'];?></span>
									<?php } }?>
								</ul>
							</div>
                            <?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon users"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
							
                            <?php foreach($getRecentUsersList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['user_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
                                <?php if(in_array('2',$users) || $allPrev == '1'){ ?>
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
                                <?php }if(in_array('3',$users) || $allPrev == '1'){ ?>                                    
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
                               <?php }if(in_array('2',$users) || $allPrev == '1'){ ?>    
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/users/change_user_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
                                   <?php }else{ ?> 
                                   		<li class="right"><a class="p_approve" href="javascript:void(0);"><?php echo $userList['status']; ?></a></li>

                                   <?php } ?>
								</ul>
							</div>
                            <?php } ?>
                            
                            
						</div>
					</div>
				</div>
			</div>

			<div class="grid_6">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon h_icon users"></span>
						<h6>Recent Seller List</h6>
						<div id="widget_tab">
							<ul>
								
								<li><a href="<?php echo base_url(); ?>admin/seller/display_seller_list">Sellers<span class="alert_notify blue"><?php echo $getTotalSellerCount;?></span></a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
						
						<div id="tab1">
                        
                        <div class="user_list">
								
								 <?php foreach($getRecentSellerList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['user_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
								
                                <?php if($allPrev == '1' || in_array('2',$seller)){ ?>
									<li><a class="p_edit" href="admin/seller/edit_seller_form/<?php echo $userList['id'];?>";>Edit</a></li>
                                <?php }?>
                                <?php if($allPrev == '1' || in_array('3',$seller) ){ ?>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
                                <?php } ?>
                                
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
                                <?php if($allPrev == '1' || in_array('2',$seller)){ ?>
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/seller/change_user_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
                                    <?php }else{ ?>
                                    <li class="right"><a class="p_approve" href="javascript:void(0)"><?php echo $userList['status']; ?></a></li>
                                    <?php } ?>
								</ul>
							</div>
                            <?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>

			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>