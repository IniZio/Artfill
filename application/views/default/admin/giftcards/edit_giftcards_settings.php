<?php
$this->load->view('admin/templates/header.php');
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<style>
.form_container ul li {
    background: url("../images/dot.png") repeat-x scroll center bottom rgba(0, 0, 0, 0);
    border-bottom: none !important;
    padding: 15px 15px 15px 10px;
}
</style>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Gift Cards Settings</h6>
             <div id="widget_tab">
                <ul>
                    <li><a href="#tab1" class="active_tab">Content</a></li>
                     <li><a href="#tab2">Images</a></li>
                </ul>
                </div>
          </div>
          <div class="widget_content">
            <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'giftsettings_form', 'enctype' => 'multipart/form-data');
				echo form_open_multipart('admin/giftcards/insertEditGiftcard',$attributes) 
			?>
             <div id="tab1">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">Title <span class="req">*</span></label>
                    <div class="form_input">
                    <input name="title" value="<?php echo $giftcards_settings->row()->title;?>" id="title" type="text" tabindex="1" class="required large tipTop" title="Please enter the title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description <span class="req">*</span></label>
                    <div class="form_input">
                      <textarea name="description" id="description"  tabindex="2" style="width:370px;" class="required small tipTop" title="Please enter the description"><?php echo $giftcards_settings->row()->description;?></textarea>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="amounts">Amount<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="amounts" class="required tags tipTop" style="display:none;" id="tags_Amt" type="text" value="<?php echo $giftcards_settings->row()->amounts;?>" tabindex="7"  title="Please enter the gift amounts"/>
                      <span class=" label_intro">Example : 10,20,30</span>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="default_amount">Default Amount<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="default_amount" id="default_amount" type="text" value="<?php echo $giftcards_settings->row()->default_amount;?>" tabindex="7" class="required large tipTop" title="Please enter the default amount"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="expiry_days">Expiry Days<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="expiry_days" id="expiry_days" type="text" value="<?php echo $giftcards_settings->row()->expiry_days;?>" tabindex="7" class="required large tipTop" title="Please enter the expiry days"/>
                    </div>
                  </div>
                </li>
              </ul>
              </div>
               <div id="tab2">
				    <ul>
					   <li>
						  <div class="form_grid_12">
						  <input type="hidden" name="imggg" value="<?php echo $giftcards_settings->row()->image; ?>" />
							<label class="field_title" for="gift_image" class="req">Image <span class="req">*</span></label>
							<?php $imgArr = @explode(',', $giftcards_settings->row()->image); ?>
							<div class="form_input">
							  <input name="gift_image[]" id="gift_image" type="file" tabindex="5" class="large multi tipTop" title="Please select the giftcard image"/>
							</div>
							<?php 
									if (count($imgArr)>0){ $this->session->set_userdata(array('giftcard_image_'.$giftcards_settings->row()->id => $giftcards_settings->row()->image));?>
						   <div style="width:100%; margin: 46px 0px 20px 30px; float:left; ">	
							
						   
						   <?php 
						   
						  //echo '<pre>'; print_r($imgArr); 
						   $i=0; foreach ($imgArr as $img){ if($img!=''){ ?>
							<div class="form_input" style="width:10%; margin-left:8%; float:left;" id="img_<?php echo $i; ?>">
								<img src="<?php echo base_url().GIFTPATH_THUMB.$img;?>" style="margin-top: 18px;"/>
								<ul class="action_list" style="background:none;border-top:none; float:left;">
								<li style="width:100%; padding:0px;margin-top: 1px;"><!--<a class="p_del tipTop" href="javascript:void(0)" onclick="editgitcardPictures(<?php echo $i; ?>,<?php echo $giftcards_settings->row()->id;?>);" title="Delete this image">Remove</a>--><a class="p_del tipTop" href="javascript:void(0)" onclick="editgitcardPictures(<?php echo $i; ?>,<?php echo $giftcards_settings->row()->id;?>);" title="Delete this image">Remove</a>
								</li>
								</ul>
							</div>
							<?php }$i++;} ?>
							</div>
							<?php } ?>
						  </div>
						</li>	
						
						<div class="form_grid_12">
							<div class="form_input" style="text-align: center;margin-bottom: 30px;">
								<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
							</div>
						</div>
								
				    </ul>
               </div>
           
		   
			</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>

<?php 
	$_SESSION['imggg']=$giftcards_settings->row()->image;
?>

<?php 
$this->load->view('admin/templates/footer.php');
?>
