<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>
<section class="container">

    <div class="main">

        <div class="headlining">

        <ul class="breadcrumb_top">

<li>

<a href="<?php base_url ?>"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></a>

</li>

<li>></li>

<li><?php if($this->lang->line('shop_categories') != '') { echo stripslashes($this->lang->line('shop_categories')); } else echo "Categories"; ?></li>

</ul>

            <h1><?php if($this->lang->line('shop_categories') != '') { echo stripslashes($this->lang->line('shop_categories')); } else echo "Categories"; ?></h1>

        </div>

        <div class="searching-left">

            <ul class="searching-pagelist">

            	<?php  

				$count= count($MainCategoriesLists->result());

				$middle=round($count/2);

				$left=0;

				foreach($MainCategoriesLists->result() as $row){

					$left++;

					if($left<$middle)

					if ($row->cat_name != ''){ 

                ?>

                <li>

                    <h2><a href="category-list/<?php echo $row->id;?>-<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a></h2>

                    <div class="bottom-links">

                    	<?php $subCat=$this->user_model->get_all_details(CATEGORY,array('rootID'=>$row->id,'status'=>'Active'),array(array('field'=>'cat_name','type'=>'asc'))); ?>

                        <?php 

						foreach($subCat->result() as $row1){

							if ($row1->cat_name != ''){ 

						?>

                        <a href="browse/<?php echo $row->id;?>-<?php echo $row->seourl;?>/<?php echo $row1->id;?>-<?php echo $row1->seourl;?>"><?php echo $row1->cat_name;?></a>

                        <?php $subsubCat=$this->user_model->get_all_details(CATEGORY,array('rootID'=>$row1->id,'status'=>'Active'),array(array('field'=>'cat_name','type'=>'asc'))); ?>

                        <?php 

						foreach($subsubCat->result() as $row2){

							if ($row1->cat_name != ''){ 

						?>

                        <a href="browse/<?php echo $row->id;?>-<?php echo $row->seourl;?>/<?php echo $row1->id;?>-<?php echo $row1->seourl;?>/<?php echo $row2->id;?>-<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>

                        <?php } }?>

                        <?php } }?>

                    </div>

                </li>

                <?php 

					}

                }

                ?>

        	</ul>

            

            <ul class="searching-pagelist-right">

            	<?php $right=$middle; 

				foreach($MainCategoriesLists->result() as $row){

					$right++;

					if($right>$left)

					if ($row->cat_name != ''){ 

                ?>

                <li>

                    <h2><a href="category-list/<?php echo $row->id;?>-<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a></h2>

                    <div class="bottom-links">

                    	<?php $subCat=$this->user_model->get_all_details(CATEGORY,array('rootID'=>$row->id,'status'=>'Active'),array(array('field'=>'cat_name','type'=>'asc'))); ?>

                        <?php 

						foreach($subCat->result() as $row1){

							if ($row1->cat_name != ''){ 

						?>

                        <a href="browse/<?php echo $row->id;?>-<?php echo $row->seourl;?>/<?php echo $row1->id;?>-<?php echo $row1->seourl;?>"><?php echo $row1->cat_name;?></a>

                        <?php $subsubCat=$this->user_model->get_all_details(CATEGORY,array('rootID'=>$row1->id,'status'=>'Active'),array(array('field'=>'cat_name','type'=>'asc'))); ?>

                        <?php 

						foreach($subsubCat->result() as $row2){

							if ($row1->cat_name != ''){ 

						?>

                        <a href="browse/<?php echo $row->id;?>-<?php echo $row->seourl;?>/<?php echo $row1->id;?>-<?php echo $row1->seourl;?>/<?php echo $row2->id;?>-<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>

                        <?php } }?>

                        <?php } }?>

                    </div>

                </li>

                <?php 

					}

                }

                ?>

        	</ul>

       	</div>

       

       	<!--<div class="searching-right">

            <div class="searching-right-section">

                <a  href="#">

                	<img width="158" height="158" alt="Explore the Treasury" src="sivaprakash/shopsy/images/three_column3.jpg">

                </a>

                <p>

                    <a  href="#">Browse galleries</a>

                    curated by Etsy members and create your own.

                </p>

                <p style="float:left" class="buttons">

                	<a class="keep_btn" href="#" style="padding: 6px 21px; margin: 12px 9px 0px;">Explore Treasury</a>

                </p>

            </div>

       	</div>-->

	</div>

</section>

<?php 

$this->load->view('site/templates/footer');

?>

