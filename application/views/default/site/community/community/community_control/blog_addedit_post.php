<?php  $this->load->view('site/templates/header.php'); ?>
    <!--<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script> -->
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>

<script type="text/javascript">
 $(function() {
tinyMCE.init({
				// General options
				mode : "specific_textareas",
				editor_selector : "addPostTiny",
        style_formats : [
                  {title : 'Bold text', inline : 'b'},
                  {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                  {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                  {title : 'Example 1', inline : 'span', classes : 'example1'},
                  {title : 'Example 2', inline : 'span', classes : 'example2'},
                  {title : 'Table styles'},
                  {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
              ],          
				theme : "advanced",
				plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				 
				// Theme options
				theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				file_browser_callback : "ajaxfilemanager",
				relative_urls : false,
				// Example content CSS (should be your site CSS)
				content_css : "<?php echo base_url() ?>css/default/example.css",      
				 
				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "js/template_list.js",
				external_link_list_url : "js/link_list.js",
				external_image_list_url : "js/image_list.js",
				media_external_list_url : "js/media_list.js",
				 
				// Replace values for the template plugin
				template_replace_values : {
				username : "Some User",
				staffid : "991234"
				}
				});
});

function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = '<?php echo base_url() ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: '<?php echo base_url() ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
            return false;			
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;
		}
</script>
 <script src="js/jquery.validate.js"></script>
<script>
 $(document).ready(function(){	
 	 $("#postForm").validate({
    ignore: ""
   });
 });
 </script>
 <style>
 label{float:left; }
 </style>

<section class="container">	
    	<div class="main">
        <div class="wrapper">
        <ul class="bread_crumbs">
        	<li> <a href="index.html" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="a_links"><?php if($this->lang->line('comm_account') != '') { echo stripslashes($this->lang->line('comm_account')); } else echo "Your Account"; ?></a></li>
             <span>&rsaquo;</span>
            <li> <a href="manage-community" class="a_links"><?php if($this->lang->line('com_news') != '') { echo stripslashes($this->lang->line('com_news')); } else echo "News"; ?></a></li>
            <span>&rsaquo;</span>
              <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_addnews') != '') { echo stripslashes($this->lang->line('com_addnews')); } else echo "Add News"; ?></a></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading"> <?php if($this->lang->line('com_news') != '') { echo stripslashes($this->lang->line('com_news')); } else echo "News"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <div class="right_split">
            <form name="postForm" method="post" enctype="multipart/form-data" id="postForm" action="site/community/blogAddEditValues">
            <div class="new_post_content">
            <div>
            <span class="store_heading"><?php if($this->lang->line('user_title') != '') { echo stripslashes($this->lang->line('user_title')); } else echo "Title"; ?><span style="color:#F00;">*</span></span>
            <input name="post_title" id="post_title" class="store_inputuse required" type="text" value="<?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['post_title']); ?>" placeholder="<?php if($this->lang->line('com_title') != '') { echo stripslashes($this->lang->line('com_title')); } else echo "Enter title here"; ?>" class="store_inputuse" />
           </div>
            <div> 
             <span class="store_heading" style="width: 714px;" ><?php if($this->lang->line('user_image') != '') { echo stripslashes($this->lang->line('user_image')); } else echo artfill_lg('lg_image','Image');?> <span style="color:#F00;">*</span>
			 
			  <div class="input-change"><div style="width: 218px;
  margin-left: -4px;"><input type="button" onclick="document.getElementById('post_image').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo "Choose File"; ?> ..."><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo "No File Selected"; ?></b></div></div>
  
            <input name="post_image" id="post_image" class="store_inputuse <?php if(empty($editpostData)) echo 'required'; ?> " accept="jpg|jpeg|png|gif" type="file" class="store_inputuse"  style="display:none" /></span>
            <?php if(!empty($editpostData)){ if( $editpostData[0]['post_image']!=''){?> <div class="clear"></div><div style="float:left; width:75px; margin-left:20px;"><img src="<?php echo base_url().COMMUNITY_NEWS_PATH_THUMB.$editpostData[0]['post_image']; ?>" /> </div><?php } } ?>
            <span class="store_heading"><?php if($this->lang->line('com_postcontent') != '') { echo stripslashes($this->lang->line('com_postcontent')); } else echo "Post Content"; ?>  </span>
            </div>
            <div class="post_view">
           <!-- <img src="images/post.png" />-->
           <textarea class="addPostTiny" name="post_content" placeholder="<?php if($this->lang->line('com_enternews') != '') { echo stripslashes($this->lang->line('com_enternews')); } else echo "Enter news here"; ?>" id="post_content"><?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['post_content']); ?></textarea>
           </div>
          <?php /*?><div class="field_view_use">
          <span>Meta Title</span>
        <input name="seo_title" type="text" id="seo_title" placeholder="Meta Title"  value="<?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['seo_title']); ?>"  />
        </div>
        <div class="field_view_use">
          <span>Meta Keyword</span>
        <input name="seo_keyword" id="seo_keyword" type="text" placeholder="Meta Keyword" value="<?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['seo_keyword']); ?>" />
        </div><?php */?>
        <div class="field_view_use">
         <!-- <span >Meta Description </span>-->
         <?php /*?><textarea class="" name="seo_description" id="seo_description" cols="50"rows="10"><?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['seo_description']); ?></textarea><?php */?>
        </div>
         <input name="post_status" id="post_status" type="hidden" value="<?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['post_status']); ?>" />
        <input name="AddOrEditVal" id="AddOrEditVal" type="hidden" value="<?php if(!empty($editpostData)) echo stripslashes($editpostData[0]['post_id']); ?>" />
        <input name="posted_user_id" id="posted_user_id" type="hidden" value="<?php echo $this->session->userdata('shopsy_session_user_id'); ?>" />
        <input name="post_status" id="post_status" type="hidden" value="<?php if(!empty($editpostData)){ echo stripslashes($editpostData[0]['post_status']); }else { echo 'inactive'; }?>" />
      
      <div class="clear"></div>
       <?php if(empty($editpostData)){?> 
        
         <input type="submit" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "Submit"; ?>  " class="draft_btn" name="publish" id="publish">
        <?php }else { ?>
         <input type="submit" value="<?php if($this->lang->line('form_update') != '') { echo stripslashes($this->lang->line('form_update')); } else echo "Update"; ?>" class="draft_btn" name="publish" id="publish">
        <?php }?>
            	</div>
                </form>	               
              </div>
            </div>
            </div>
        </div>
     </div>
</section>
<script>
 $(document).ready(function(){	
 
 	$('#post_image').on('change',function(){         
 		$('#no_file_selected').text(this.value);                           
 		                            });
     
 });
 </script>
<!--selection-->
<?php $this->load->view('site/templates/footer.php'); ?>