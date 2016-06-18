<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<style>
.jqplot-table-legend{
	left:395px !important; top:-22px !important;
}
</style>
<script>
	$(function () {
    $.jqplot._noToImageButton = true;
    var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24],
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6],
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78],
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33],
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75],
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68],
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62],
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24],
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21],
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72],
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02],
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85],
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
    var currYear = [["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48],
    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19],
    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55],
    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67],
    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5],
    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35],
    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24],
    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38],
    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97],
    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97],
    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82],
    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59],
    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55],
    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
    var plot1 = $.jqplot("chart1", [prevYear, currYear], {
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
                label: '2010'
            },
            {
                label: '2011'
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
                    //formatString: "%b %e ",
                    formatString: "%b %y",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",
                drawMajorGridlines: false
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
		<div class="grid_container">
			
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
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Order Statistics</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<div class="social_activities">
								<div class="activities_s">
									<div class="block_label">
										<span class="user_icon"></span><div class="clear"></div>
										Total Users<span><?php echo $totalUserCounts;?></span>
									</div>
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="store_icon"></span><div class="clear"></div>
										Total Products<span><?php echo $getTotalProductCount;?></span>
									</div>
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Total Sellers<span><?php echo $getTotalSellerCount;?></span>
									</div>	
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Total Shops<span><?php echo $getTotalShopCount;?></span>
									</div>	
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Paid Orders<span><?php echo $getTotalorderCount;?></span>
									</div>	
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Dispute Orders<span><?php echo $getTotalorderdispCount;?></span>
									</div>	
								</div>
								<div class="activities_s">
									<div class="block_label">
										<span class="seller_icon"></span><div class="clear"></div>
										Categories<span><?php echo $getTotalcategoryCount;?></span>
									</div>	
								</div>

							</div>
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
								 #<?php echo $orderdetails['orderId']; ?>
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
						<h6>Recent Seller List</h6>
						<div id="widget_tab">
							<ul>
								
								<li><a href="#tab1">Sellers<span class="alert_notify blue"><?php echo $getTotalSellerCount;?></span></a></li>
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
                                <?php if(in_array('2',$seller) || $allPrev == '1'){ ?>
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
                                <?php }?>
                                <?php if(in_array('3',$seller) || $allPrev == '1'){ ?>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
                                <?php } ?>
                                
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
                                <?php if(in_array('2',$seller) || $allPrev == '1'){ ?>
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/seller/change_seller_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
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
                                <?php if(in_array('2',$shop) || $allPrev == '1'){ ?>
									<li><a class="p_edit" href="admin/shop/view_shop/<?php echo $shopList['id'].'-'.$shopList['seller_id'];?>";>View</a></li>
                                <?php }?>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
                                <?php if(in_array('2',$shop) || $allPrev == '1'){ ?>
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
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>