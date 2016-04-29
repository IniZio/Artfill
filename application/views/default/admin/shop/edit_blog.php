<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Edit Posts</h6>
            <div id="widget_tab">
              <ul>
                <li><a href="#tab1" class="active_tab">Content</a></li>
                <li><a href="#tab2">SEO Details</a></li>
              </ul>
            </div>
          </div>
          <div class="widget_content">
            <?php 
			//print_r($cms_details); die;
				$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form');
				echo form_open('admin/blog/insertEditPost',$attributes) 
			?>
            <div id="tab1">
              <ul>

                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="page_name">Post Title <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="post_title" id="post_title" type="text" value="<?php echo $cms_details->row()->post_title;?>" tabindex="2" class="required large tipTop" title="Please enter the page name"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Post Content</label>
                    <div class="form_input">
                      <textarea name="post_content" tabindex="4" class="large tipTop mceEditor" title="Please enter the page content"><?php echo stripslashes($cms_details->row()->post_content);?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
            <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="5"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="seo_title" id="seo_title" type="text" value="<?php echo $cms_details->row()->seo_title;?>" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Tag</label>
                    <div class="form_input">
                      <input name="seo_keyword" id="seo_keyword" type="text" value="<?php echo $cms_details->row()->seo_keyword;?>" tabindex="2" class="large tipTop" title="Please enter the page meta tag"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="seo_description" id="seo_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $cms_details->row()->seo_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
			<input type="hidden" name="cms_id" value="<?php echo $cms_details->row()->post_id;?>"/>
			
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
