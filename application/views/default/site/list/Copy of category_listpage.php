<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
$allSub_Cat=array_merge($subCategories->result_array()); //echo '<pre>'; print_r($allSub_Cat); die;
?>

<link href="css/default/front/art.css" rel="stylesheet">
<!--<link rel="shortcut icon" type="image/ico" href="images/front/logo.ico"/>-->

<script type="text/javascript" src="js/front/freewall.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
.freewall {
	width:980px;
	margin:0px auto;
}
html, body {
	margin: 0;
	padding: 0;
}
/*	.freewall .brick {
				display: block;
		        border:1px solid #333;
		    }*/
			.freewall img {
	width: 100%;
}
.freewall .medium {
	width: 125px;
	height: 125px;
}
.freewall .large {
	width: 220px;
	height: 260px;
}
.freewall.x-large {
	width: 400px;
	height: 400px;
}
</style>
<!-- css -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />
    

<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>

			<div class="add_steps shop-menu-list">

			<div class="main">
				
				<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
			
						 <?php foreach($subCategories->result_array() as $subCat) {
					  if ($subCat['cat_name'] != ''){ $commentData = $this->category_model->get_all_counts($subCat['id'],''); if($commentData[0]['disp']>0){
					  ?>
					<li>
						<a href="browse/<?php echo $this->uri->segment(2).'/'; echo $subCat['id'].'-'.$subCat['seourl'];?>"><?php echo ucfirst($subCat['cat_name']);?></a>
					 </li>
					 <?php } }}?> 
					</ul>
				</nav>
				
				<nav id="nav-mobile"></nav>
				
			</div>
			
			</div>


<section class="browse-head">
  <div class="container">
    <div class="col-md-4" id="feed-breadcrumb">
      <h1> <span id="feed-header"><?php echo ucfirst($currentMainCategory->cat_name);?> </span> </h1>
    </div>

  </div>
</section>


<section class="content-wrap-inner content-wrap container" style="max-width:1020px;">
  <div class="art-brick-block" role="main"> 
    <div id="container" class="clearfix">
    
     <?php if(sizeof($allSub_Cat) != 0) {?>
	 <ul class="first_look_page">
        <?php $s=1; $s1=0; foreach($allSub_Cat as $subCatList) {
		
		if ($subCatList['cat_name'] != ''){ $commentData = $this->category_model->get_all_counts($subCatList['id'],''); if($commentData[0]['disp']>0){ $s1=1;
		
		?>

     <li class="box row<?php echo $s; ?>">
		<div class="banner-out">
            <div class="banner-in">
				 <a href="browse/<?php echo $this->uri->segment(2).'/'; echo $subCatList['id'].'-'.$subCatList['seourl']; ?>" >
					<img src="images/<?php if($subCatList['image'] != '') { echo 'category/'.$subCatList['image'];} else { echo 'dummyProductImage.jpg';} ?>" title="<?php echo $subCatList['cat_name'];?>" alt="<?php echo $subCatList['cat_name'];?>" />
					<div class="banner-title"> 
						<?php echo $subCatList['cat_name']; ?> 
						<span class="rsquo"></span> 	
					</div>
					
				 </a>		 
			</div>
        </div>
	
</li>	  
	
	  <?php $s++; if($s>3){ $s=1;}}  }}
			if($s1==0){ ?>
				<div style="margin:20px 0" class="search-error">
		  <h3 class="crumbs"> <?php if($this->lang->line('list_selections') != '') { echo stripslashes($this->lang->line('list_selections')); } else echo 'Darn. No items match your selections'; ?>. </h3>
		  <p class="newline"> <?php if($this->lang->line('list_try') != '') { echo stripslashes($this->lang->line('list_try')); } else echo 'Try'; ?> <a href="category"><?php if($this->lang->line('list_showing_categories') != '') { echo stripslashes($this->lang->line('list_showing_categories')); } else echo 'showing all Categories'; ?></a>  </p>
		</div>
					<?php/* <h2 style="text-align:center; width:100%;"><?php if($this->lang->line('seller_noprod') != '') { echo stripslashes($this->lang->line('seller_noprod')); } else echo "No Product Found"; ?></h2> */?>
			<?php } ?>
			
			</ul>
			
			</div>
	  
	     <?php }else {?>
          <h2><?php if($this->lang->line('list_subcate') != '') { echo stripslashes($this->lang->line('list_subcate')); } else echo 'No SubCategories Found'; ?>!</h2>
		  <?php }?>
	  
    </div>
</section>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!--<script type="text/javascript">
			var wall = new freewall('.freewall');
			var start = new Date().getTime();
			wall.reset({
	            selector: '.brick',
	            animate: true,
	            gutterX: 30,
	            gutterY: 30,
	            cellW: 220,
	            cellH: 'auto',
	            onResize: function() {
	                wall.fitWidth();
	            },
	            onComplete: function() {
					console.log("Showup", new Date().getTime() - start);
				}
		    });

			wall.addCustomEvent("onGridReady", function(container, setting) {
				start = new Date().getTime();
			});

			wall.addCustomEvent("onGridArrange", function(container, setting) {
				console.log("Arrange", new Date().getTime() - start);
				start = new Date().getTime();
			});


			$(function() {
				
				var images = wall.container.find('.brick');
				images.find('img').load(function() {
					wall.fitWidth();
				});

			});

		</script> -->
		
	<script src="js/site/jquery.masonry.min.js"></script>
<script>
$( document ).ready(function() {
    $('#container').masonry({
      itemSelector: '.box', 
      columnWidth: 49
    });
	/*if($("#chekit").val() == 'cat'){ 
	 window.location.href=baseURL+"category-list/<?php //echo $this->uri->segment(2);?>?ref=cats";
	}*/ 
});  
</script>


<?php $this->load->view('site/templates/footer'); ?>