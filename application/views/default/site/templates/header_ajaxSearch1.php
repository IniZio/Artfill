<!DOCTYPE html>
<html>
<head>
	<title>ajaxsearch</title>
	<style>

    </style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		function ajaxSearch() {
			var keyword=$('#search_items').val();
			if (keyword.length === 0) {
				$('#suggestions').hide();
			} else {
				var baseURL = "<?php echo base_url(); ?>";
				// $.ajax({
				// 	type: "post",
				// 	url: "<?php echo base_url().'/product/search';?>",
				// 	cache: false,				
				// 	data:'search='+$("#search_items").val(),
				// 	success: function(response){
				// 		$('#item_suggestion').html("");
				// 		var obj = JSON.parse(response);
				// 		if(obj.length>0){
				// 			try{
				// 				var items=[]; 	
				// 				$.each(obj, function(i,val){											
				// 				    items.push($('<li/>').text(val.FIRST_NAME + " " + val.LAST_NAME));
				// 				});	
				// 				$('#finalResult').append.apply($('#finalResult'), items);
				// 			}catch(e) {		
				// 				alert('Exception while request..');
				// 			}		
				// 		}else{
				// 			$('#finalResult').html($('<li/>').text("No Data Found"));		
				// 		}		
						
				// 	},
				// 	error: function(){						
				// 		alert('Error while request..');
				// 	}
				// });
				$.ajax({
					type : 'GET',
					url  : baseURL+'site/searchShop/search_suggestions',
					data : {q:keyword},
					dataType : 'json',
					success  : function(json){
						$('#suggestions').html(json.things).show();
					}
				});
				$('#suggestions').show();
				setTimeout(function() {
    dropdown.find('.search .results li:first-child a').focus();
  }, 10);			}
		}
	</script>
</head>
<body>
<form class="search">
	<input type="text" class="search" name="item" placeholder="<?php if($this->lang->line('temp_srchitems') != '') { echo stripslashes($this->lang->line('temp_srchitems')); } else echo 'Search for items and shops'; ?>" value="<?php if($this->input->get('item') != ''){ echo htmlspecialchars($this->input->get('item'));}?>" id="search_items" onkeyup="ajaxSearch()" autocomplete="off" >
	<ul id="suggestions" class="" ss="results"></ul>
	</form>
</body>

</html>
