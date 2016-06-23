<?php 
$this->load->view('site/templates/header'); 
$this->load->model('product_model');
$this->load->model('category_model');
?>
<script src="js/site/custom_validation.js"></script>
<link rel="stylesheet" href="css/default/jquery.ptTimeSelect.css" type="text/css" />
<style>
.nostyle
{
 margin:0px !important;
 padding:0px !important;
 height:auto !important;
}

.bottomdiv
{
background:#f9f9f6;
    float: left;
	border:1px solid #eaebeb;
    position: relative;
    width: 98.7%;
	padding:5px 0 5px 10px;
	border-radius:0 0 4px 4px;
	margin-bottom:25px;
	}
.bottomdiv:hover{background:#E9F6FC}


</style>

<style>
#cboxLoadedContent{background:none;}


.registrycreatebtn{

border-radius: 2px; font-size: 12px;
    height: 25px;
    line-height: 15px;
    margin: 5px 5px 0 0;
    padding: 0;
    text-align: center;
    width: 168px;

}

.input-group{
box-shadow: 0 0 6px 0 #ccc;
    margin: 5px 0 0 8px;

}

</style>

<script type="text/javascript">
    $(document).ready(function(){
	    
		$('#confirmDelete').click(function(e) {  
           $('#sure_btn').css('display','block'); 
        }); 
		$('#cancel_regis-delete').click(function(e) {  
           $('#sure_btn').css('display','none'); 
        });  
    });
</script>
<style>
#cboxLoadedContent{background:none;}
</style>


<div id='registry_edit_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="float: left; border-radius: 17px; padding: 10px; background: none repeat scroll 0px 0px rgba(0, 0, 0, 0.26);">
			  <form action="site/market/updateRegistry" method="post"> 
				<div style="background:#EAF7FD;heigth:400px; margin:0px" class="sign_in_form">
					<div style="border:none; margin:0; padding:0" class="sign_in_form-inner">
						
						<div style="float:left; width:100%; border:none; margin:0; padding:0" class="sign_head5">
							<h2 style="font-size: 20px;"><?php if($this->lang->line('seller_wedding') != '') { echo stripslashes($this->lang->line('seller_wedding')); } else echo 'When is your wedding'; ?>?</h2> 
							<input type="text"  name="registryDate" id="registryDate" class="payment_txt required" placeholder="Select the date" value="<?php echo $registryVals->wedding_date; ?>" />	 

							<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="registryDate" data-link-format="yyyy-mm-dd">			<input class="form-control" size="16" type="hidden" value="<?php echo $registryVals->wedding_date; ?>">														
							</div>		
									
						</div> 			
					    
						
						
						 <div class="sign_head5" style="float: left; background: none repeat scroll 0% 0% rgb(245, 245, 241); padding: 6px 13px; width: 100%;">
						     <a href="javascript: void(0);" style="float:right" id="confirmDelete" class="delete-registry-link"><span></span><?php if($this->lang->line('seller_delete') != '') { echo stripslashes($this->lang->line('seller_delete')); } else echo 'Delete your registry'; ?></a>			   
						   
						    <div class="confirm-detail" id="sure_btn" style="display:none">
								<span><?php if($this->lang->line('seller_areusure') != '') { echo stripslashes($this->lang->line('seller_areusure')); } else echo 'Are you sure'; ?>?</span>
								<a class="confirm-detail-delete" href="site/market/deleteRegistry">
									<span><?php if($this->lang->line('seller_deleteregistry') != '') { echo stripslashes($this->lang->line('seller_deleteregistry')); } else echo 'Yes, delete my registry'; ?></span>
								</a>
								<a class="confirm-detail-cancel" href="javascript:void(0);" id="cancel_regis-delete">
									<span><?php if($this->lang->line('user_no') != '') { echo stripslashes($this->lang->line('user_no')); } else echo 'No'; ?></span>
								</a>
								<span class="arrow-toped"></span>
							</div>					   
						</div>	
					  
					  <div class="modal-footer footer_tab_footer">
							<div class="btn-group">
									 <input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" name="submitRegistry" />
									<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo af_lg('lg_cancel','Cancel');?></a>
							</div>
						</div>	
					  
					 </div>
				</div>
				</form>
			 </div>
		</div>
	</div>	
</div>

<section class="browse-head">
    <div class="">
		<div class="registary_landing_top">
			<div class="main">
				<div class="registary-left1">
					<div id="registary_landing_top-title">
					<a href="category-list/59-weddings"><?php if($this->lang->line('user_weddings') != '') { echo stripslashes($this->lang->line('user_weddings')); } else echo 'Weddings'; ?></a>
					</div>
				<h1>
					<div id="feed-header"><?php if($this->lang->line('seller_registry') != '') { echo stripslashes($this->lang->line('seller_registry')); } else echo 'Your Registry'; ?>
					
					</div>
				</h1>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="registary_top">
			<div class="main">
				<h3 class="headline-top"><?php if($this->lang->line('seller_fun') != '') { echo stripslashes($this->lang->line('seller_fun')); } else echo 'Let the fun begin'; ?>!</h3>
				<h3><?php if($this->lang->line('seller_explore') != '') { echo stripslashes($this->lang->line('seller_explore')); } else echo 'Explore our gift ideas below'; ?>.</h3>
				<span class="downarrow"></span>
			</div>
		</div>
	</div>	
 </section>	
 <section style="background:#fff; border-bottom:1px solid #ccc" class="container">   
    <div class="main">      
        <div class="registery-left">
        <!-- <ul class="registary_list registryhead">
            <li class="list-header">
            <h3><?php 
			$date1 = new DateTime(date("Y-m-d"));
			$date2 = new DateTime($registryVals->wedding_date);
			$interval = $date1->diff($date2);
			//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

			$d2=date("Y-m-d",strtotime($registryVals->wedding_date));
			$d1=date("Y-m-d");
			$time2=strtotime($d2." -1 days"); 
			$time1=strtotime($d1);
			$time=$time2-$time1;
			$tomorrow = date('Y-m-d', strtotime(date("Y-m-d") .'+1 days')); $today=date("Y-m-d");
			if($tomorrow==$d2)
			$time=1;
			else
			if($today == $d2)
			$time=0;
		   	$requestedflag=false;
			$Sql="select count(*) as nos from shopsy_registry_listings where collection_id='".$registryVals->user_id."'";
			$result=$this->category_model->ExecuteQuery($Sql)->row();
			if($time>1){
				if($interval->y > 0){
					if($interval->y == 1){
						echo "<span>".$interval->y. "</span>  ".af_lg('lg_year','Year');
					}else{
						echo "<span>".$interval->y. "</span> ".af_lg('lg_years','Years'); 
					}
				}
				if($interval->m > 0){
					if($interval->m == 1){
						echo "<span>".$interval->m. "</span> ".af_lg('lg_month','Month'); 
					}else{
						echo "<span>".$interval->m. "</span> ".af_lg('lg_months','Months'); 
					}
				}
				
				echo "<span>".$interval->d. "</span> ".af_lg('lg_day_left','days left '). "-<span>".$result->nos."</span> ".af_lg('lg_Items_requested','Items requested');?></h3>
			<?php }else if($time==1){
			 echo "<span> Tomorrow is your Wedding day </span> - "." <span>".$result->nos."</span>".af_lg('lg_Items_requested','Items requested');;?></h3>
       <?php }
	        else if($time==0)
			{
			 echo "<span>" . af_lg('lg_tomorrow_your_wedding','Tomorrow is your Wedding day')." </span> - "." <span>".$result->nos."</span>".af_lg('lg_Items_requested','Items requested');;?></h3>
       <?php
			}  
            else
            { $requestedflag=true;
            echo "<span> ". af_lg('lg_today_your_wedding','Today is your Wedding day')."  : ".date("d-m-Y",strtotime($d2))." </span>";?></h3> 
          <?php   }  ?>
            </li> 
          </ul> -->
		  <ul class="registary_list registryhead">
            <li class="list-header">
            <h3><?php 
			$date1 = new DateTime(date("Y-m-d"));
			$date2 = new DateTime($registryVals->wedding_date);
			$interval = $date1->diff($date2);
			//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

			$d2=date("Y-m-d",strtotime($registryVals->wedding_date));
			$d1=date("Y-m-d");
			$time2=strtotime($d2." -1 days"); 
			$time1=strtotime($d1);
			$time=$time2-$time1;
			$tomorrow = date('Y-m-d', strtotime('tomorrow')); $today=date("Y-m-d");
			if($tomorrow==$d2)
			$time=1;
			else
			if($today==$d2)
			$time=0;
		   	$requestedflag=false;
			$Sql="select count(*) as nos from shopsy_registry_listings where collection_id='".$registryVals->user_id."'";
			$result=$this->category_model->ExecuteQuery($Sql)->row();
			if($time>1){
				if($interval->y > 0){
					if($interval->y == 1){
						echo "<span>".$interval->y. "</span> year "; 
					}else{
						echo "<span>".$interval->y. "</span> years "; 
					}
				}
				if($interval->m > 0){
					if($interval->m == 1){
						echo "<span>".$interval->m. "</span> month "; 
					}else{
						echo "<span>".$interval->m. "</span> months "; 
					}
				}
				
				echo "<span>".$interval->d. "</span> days left - "." <span>".$result->nos."</span> Items requested";?></h3>
			<?php }else if($time==1){
			 echo "<span> Tomorrow is your Wedding day </span> - "." <span>".$result->nos."</span> Items requested";?></h3>
       <?php }
	        else if($time==0)
			{
			 echo "<span> Today is your Wedding day </span> - "." <span>".$result->nos."</span> Items requested";?></h3>
       <?php
			}  
            else
            { $requestedflag=true;
            echo "<span> Your Wedding day is : ".date("d-m-Y",strtotime($d2))." </span>";?></h3> 
          <?php   }  ?>
            </li> 
          </ul> 
           <?php 
		    $registryMainList1=$registryMainList; 
			 $i=-1;
			 $ar=array(); $listsid=array();
			 $result1=$resultrc;
			 $arrays=$result1->result_array();
			 foreach($arrays as $key=>$value)
			 {
			   if($value["cid"])
			    array_push($ar,$value["cid"]);
 			    $listsid[]=$value["id"];
			 }
			 $listsid=array_values(array_unique($listsid));
             $category_id=implode(",",array_unique($ar));
		   
			 $b=0; $arr=array();
			 while($b<count($ar))
			 {
				$registryMainList=$this->product_model->get_all_details(CATEGORY,array('id' => $ar[$b++]));
						
				foreach($registryMainList->result() as $mainList){  
			//  $categories=$this->product_model->get_all_details(CATEGORY,array('id' => $ar[$b++])); 
					if(!in_array($ar[$b-1],$arr))
				{
				  array_push($arr,$ar[$b-1]);
			
				 
				 if ($mainList->cat_name != ''){ $commentData = $this->category_model->get_all_counts($mainList->id,''); if($commentData[0]['disp']>0){
			 ?>
                
                <ul class="registary_list">
                <li class="list-header">
                <h3><?php echo $mainList->cat_name;?></h3>
                </li>
                <?php 
				for($k=0;$k<count($listsid);$k++) { 
		   //	$sqlcount="select * from shopsy_registry_listings where listing_id='".$listsid[$k]."' and collection_id='".$registryVals->user_id."'";
					$result2s=$this->seller_model->get_all_details(REGISTRY_LISTINGS,(array("listing_id"=>$listsid[$k],"collection_id"=>$registryVals->user_id)));
					$count=$result2s->num_rows();		
					$sqlt="select * from shopsy_product where id='".$listsid[$k]."' and find_in_set('".$ar[$b-1]."',category_id)";
					$product_Details=$this->category_model->ExecuteQuery($sqlt);
					$rows=$product_Details->num_rows();
					 if($product_Details->num_rows()>0)
					 {   $i=1;
				  ?> 
                        <li class="restary-footr" style="cursor:auto;">
                        <div class="image-container" style="width:100% !important;"> 
                        <button style="float:right; background:none; border:none; cursor:pointer; margin:5px 0 0 0 !important" type="button" class="confirm-detail-delete" name="deleterecord" id="deleteredord"  onClick="checkrecords('<?php echo $listsid[$k];?>','nil');" ><img src="images/del.png" /></button>
						<?php 
                        $rows=$product_Details->num_rows();
                        if($product_Details->num_rows()>0)
                        { 
                           foreach($product_Details->result() as $key=>$value)
						   {
							  if($value->image!="")
							  { 
						          $stimage=explode(",",$value->image);
						         ?> 
                                      <img style="float:left;width:165px;height:170px;" src="images/product/<?php echo $stimage[0];?>" alt="<?php echo $stimage[0];?>" /> 
                                      <div style="float:left;padding:10px;width:70%;" class="registr_det_txt"> 
                                 <?php 
					  		$selectedSeller_details=$this->seller_model->get_all_details(SELLER,array("seller_id"=>$value->user_id))->result_array();
							$shop=$selectedSeller_details[0]["seller_businessname"];
							echo "<a class='nostyle' href='products/$value->seourl'>".ucwords(strtolower($value->product_name))."</a>";
							echo "<a class='nostyle' href='shop-section/$shop'>".ucwords(strtolower($selectedSeller_details[0]["seller_businessname"]))."</a><br/>";
							$registryProduct1 = $this->user_model->get_all_details(REGISTRY_REQUEST,array('collection_id'=>$registryVals->user_id,'listing_id'=>$listsid[$k]));
							$resultpurchased=$registryProduct1->result_array();
					        ?>
                                          <div style="width:100%;text-align:right; border-top:1px solid #f4f4f0; padding:5px 0 0 0;"> 
                                          <span class="request-num" style="float:left; color:#78c042; "><?php echo $currencySymbol;?><?php echo number_format($currencyValue*$value->price,2); ?><?php echo $currencyType;?>
                                          
                                          
                                          </span>
                                           <?php 
						     if($value->quantity==0){
							  echo "Un Available";
							 } else {
										$title=""; if($value->quantity==1)
										$title="Only one Available";
										
										?>
                                        <div class="request-num" style="float:left; color:#888">
                                        <?php if($requestedflag==false)
										{ ?>
										<select <?php if($title!="") {  ?> title="<?php echo $title;?>" <?php } ?> name="req<?php echo $k;?>" id="req<?php echo $k;?>"onChange="checkrecords('<?php echo $listsid[$k];?>',this.id);">
										<?php 
										for($i=1;$i<=$value->quantity;$i++)
										{
												if($i!=$count)
												echo "<option value={$i}>$i</option>";
												else
												echo "<option selected='selected' value={$i}>$i</option>";
										}
										?>
										</select>  <?php echo af_lg('lg_requested','Requested');?>
                                        <?php }
										else
										{
										echo $count. " Item(s) requested";
										}
										?>
                                        </div>  <span class="request-num" style="color:#888"> <?php  echo $resultpurchased[0]["purchased"]; ?> <?php echo af_lg('lg_purchased','Purchased');?> </span>
										</div>
										<?php 
							 } ?>
                             </div> <?php 
						  }
  
					   ?> 
                       <?php 
					   }
					     $i++;
					   
					  
					 }
				?>
       
            </div>
           
     
        
        <?php  }} }
		?>    <div class="bottomdiv">
           <a class='nostyle' href="browse/62-home-living/<?php echo $mainList->id.'-'.$mainList->seourl;?>">Find more about <?php echo $mainList->cat_name;?></a>
                  <span class="leftarow"></span> 
                  </div>    </li>
        </ul> 
        
        <?php  } }} }		  
	  foreach($registryMainList1->result() as $mainList){  
	     if ($mainList->cat_name != ''){ $commentData = $this->category_model->get_all_counts($mainList->id,''); if($commentData[0]['disp']>0){		 
		 ?>      
          <ul class="registary_list">
            <li class="list-header">
            <h3><?php echo $mainList->cat_name;?></h3>
            </li>
          
                 <?php   $i=1;
				  ?> 
            <li class="restary-footr">
                <div class="image-container">  
                 <a href="browse/62-home-living/<?php echo $mainList->id.'-'.$mainList->seourl;?>">
                <?php
		   if(count($ar)>0)
		   {

			   $sql="select * from shopsy_category where id not in (".implode(",",$ar).") and rootID='". $mainList->id."'";
			} else
			   $sql="select * from shopsy_category where rootID='". $mainList->id."'";
				  $sucCatdetails=$this->category_model->ExecuteQuery($sql); $rows=0;	   
				
				if($sucCatdetails->num_rows() > 0) {
			
			  foreach($sucCatdetails->result() as $subList){

			 if($i < 5){ if($subList->image != ''){?>
                <img src="images/category/<?php echo $subList->image;?>" />
                <?php }} $i++; } ?>
                </div></a>
            <p class="registary-text"><?php  foreach($sucCatdetails->result() as $subList){
			  
			 echo $subList->cat_name.', ';  } echo '...';?>
           </p>  <?php } 
		  
		   ?>
            <span class="leftarow1"></span>
            </li>
        </ul> 
        
        
        <?php  } } } ?>
        <ul class="registary_list">
            <li class="list-header">
				<form action="search/all" method="get" id="sbmtSform">
					  <input class="list-header-text" type="text" placeholder="<?php if($this->lang->line('seller_looking') != '') { echo stripslashes($this->lang->line('seller_looking')); } else echo 'Looking for something else'; ?>?" name="item" value="">
					 <a class="asubscribe_btn asubscribe_btn-1" style="margin-top:0px;margin-left:10px;    padding: 6px 10px; float:none; font-family: Arial,Helvetica,sans-serif; color:#fff" href="javascript:void(0);" onclick="document.getElementById('sbmtSform').submit();"><?php if($this->lang->line('seller_srch') != '') { echo stripslashes($this->lang->line('seller_srch')); } else echo 'Search'; ?></a>
				</form>         
            </li>         
        </ul>
    </div>
       
       
			<div class="registery-right">       
				<ul class="registary_list">			
					 <li class="list-header">		   
						<h3><?php if($this->lang->line('seller_info') != '') { echo stripslashes($this->lang->line('seller_info')); } else echo 'Info'; ?></h3>
						<a class="edit-button" href="#registry_edit_popup" data-toggle="modal"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a> 		   
					</li>
					<li style="padding:10px" class="restary-footr">		   
						<h3 class="content-date"><?php if($this->lang->line('seller_weddate') != '') { echo stripslashes($this->lang->line('seller_weddate')); } else echo 'Wedding Date'; ?></h3>
						<p class="content-time"><?php echo date("d M, Y",strtotime($registryVals->wedding_date)); ?></p>
					</li>
				</ul>
				<ul class="registary_list">
				
					<li class="list-header">
			   
						<p class="plannig"><?php if($this->lang->line('seller_planning') != '') { echo stripslashes($this->lang->line('seller_planning')); } else echo 'Planning a wedding'; ?>?</p>
						<a href="category-list/59-weddings"><?php if($this->lang->line('seller_inspiration') != '') { echo stripslashes($this->lang->line('seller_inspiration')); } else echo 'Get inspiration'; ?></a>		   
					</li>			
				</ul>     
			</div>      
        </div>
        
        </div>
    </section>



<link href="datepicker/css/default/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript">
//this is for Date only	
 	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		 startDate: new Date()
		//minDate: -20,
		//maxDate: "+1M +10D"
    });

</script>

<?php 
$this->load->view('site/templates/footer');
?>	