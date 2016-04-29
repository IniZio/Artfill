<?php #echo "<pre>";print_r($shopproductfeed_details); ?>
<div class="cms_page">

    <div class="cms_heading">

        <h1>

            <span class="cms_text"><?php if($this->lang->line('shopsec_review') != '') { echo stripslashes($this->lang->line('shopsec_review')); } else echo 'Item Reviews'; ?></span>

        </h1>

    </div>

    <div class="review-averages">

        <h4><?php if($this->lang->line('shopsec_average') != '') { echo stripslashes($this->lang->line('shopsec_average')); } else echo 'Average Item Review'; ?></h4>

        <span class="reviews">

        	<div class="stars small" style="width: <?php echo $get_shop_owner_info['shop_ratting']*17.2 ?>px !important;"> </div>

        </span>        

        <span class="reviews-numbers">

        	<span class="review-num">(<?php echo $get_shop_owner_info['review_count']; ?>)</span>

        </span>

    </div>

    <div class="clear"></div>

    <ul class="shop-reviews">

    	<?php foreach($shopproductfeed_details as $review){  ?>        

    	<li>

        	<div class="receipt-review">

            	<div class="reviewer-info">

                <?php if($review->thumbnail!=''){ $profile_pic='users/thumb/'.$review->thumbnail; } else { $profile_pic='default_avat.png';}?>

                	<a href="view-profile/<?php echo $review->userName; ?>"><img width="25" height="25"  src="images/<?php echo $profile_pic; ?>"/></a>

                    <span<?php if($this->lang->line('shop_reviewedby') != '') { echo stripslashes($this->lang->line('shop_reviewedby')); } else echo 'Reviewed by'; ?> <a href="view-profile/<?php echo $review->userName; ?>"><?php echo $review->fullname; ?></a></span>

                    <span><?php if($this->lang->line('user_on') != '') { echo stripslashes($this->lang->line('user_on')); } else echo 'On'; ?> <?php echo date("d M, Y",strtotime($review->dateAdded)); ?></span>

                </div>

                <div class="reviewer-detail">

                	<div class="reviews-wrap">

                    	<?php $imgArr=@explode(',',$review->image); ?>

                    	<a href="products/<?php echo $review->seo_url; ?>" class="image">

                        	<img width="100" height="100" src="images/product/<?php echo $imgArr[0]; ?>" alt="<?php echo $review->product_name; ?>" />

                        </a>

                        <div class="right review-container">

                        	<h2 class="transaction-title"><a href="products/<?php echo $review->seo_url; ?>"><?php echo $review->product_name; ?></a></h2>

                            <span class="reviews">

                            	<div class="stars small" style="width: <?php echo $review->rating*17.2 ?>px !important;"> </div>

                            </span>

                            <p class="review"><?php echo $review->description; ?></p>

                    	</div>

                    </div>

                </div>

        	</div>

		</li>

        <?php } ?>

    </ul>

    

</div>