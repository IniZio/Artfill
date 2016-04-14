<base href="<?php echo base_url(); ?>" />
<link rel="stylesheet" type="text/css" href="css/default/community.css"/>
<link type="text/css" href="css/default/blog-jquery-search.css" />
<link rel="stylesheet" href="css/default/site/my-account.css" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/form1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="js/markerclusterer/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/jquery.ptTimeSelect.css"/>
<script src="js/jquery.dataTables.js"></script>
<script src="js/CustomSearchJquery.js"></script>
<script src="js/jquery.validate.js"></script>  
<script src="js/markerclusterer/datepicker.js"></script> 
<script>$(document).ready(function(){$("#addevent_form").validate(); });</script>
<script src="js/site/jquery.ptTimeSelect.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"</script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
 $(function() {
	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "addPostTiny",
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
		content_css : "css/default/example.css",
		 
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
<style>
.error{color:#FF0000!important;}
</style>