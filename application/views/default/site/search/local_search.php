<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>
<section class="container">

    	<div class="main">

        <ul class="breadcrumb_top">

<li>

<a href="#"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></a>

</li>

<li>></li>

<li><?php if($this->lang->line('seller_local') != '') { echo stripslashes($this->lang->line('seller_local')); } else echo 'Shop Local'; ?></li>

</ul>

        <div class="shop_local">

        	

            <div class="treasury_left">

            <div style="margin:20px 0" class="community_head">

            <h1><?php if($this->lang->line('seller_local') != '') { echo stripslashes($this->lang->line('seller_local')); } else echo 'Shop Local'; ?></h1>

            <span><?php if($this->lang->line('seller_neighborhood') != '') { echo stripslashes($this->lang->line('seller_neighborhood')); } else echo 'Support your neighborhood by buying and selling nearby'; ?>.</span>

        

            </div>

            <div class="treasure_box">

            <div class="container_box">

            <div class="container_box_left">

            	<form method="get" action="search/all">

            		<div style="margin-top:15px;" class="input_tresury">

                        <label class="shoplocal-title"><?php if($this->lang->line('seller_where') != '') { echo stripslashes($this->lang->line('seller_where')); } else echo 'Where do you want to Shop'; ?></label><span class="sub_title"><?php if($this->lang->line('seller_country') != '') { echo stripslashes($this->lang->line('seller_country')); } else echo 'country, city, state, anywhere'; ?> </span>

                        <input id="list-title" type="text" name="location" class="treasure-text">

                    </div>

                    

                  

             		<div style="margin-top:20px;" class="input_tresury">

                        <label class="shoplocal-title"><?php if($this->lang->line('seller_lookingfor') != '') { echo stripslashes($this->lang->line('seller_lookingfor')); } else echo 'What are you looking for'; ?>?</label>

                        <input id="list-title" type="text" name="item" class="treasure-text">

                    </div>       

                    

                  	<div class="button_search">      

                 		<input class="btn-primary small" type="submit" value="<?php if($this->lang->line('seller_searchlocal') != '') { echo stripslashes($this->lang->line('seller_searchlocal')); } else echo 'Search Local'; ?>"> 

                 	</div>

                 </form> 

            </div>

            <div class="container_box_right">

            

            <div class="container_box_right_img">

            <img src="images/shop-local.gif" /><br />

            <p><?php if($this->lang->line('seller_localitems') != '') { echo stripslashes($this->lang->line('seller_localitems')); } else echo 'Use the "Local Items" filter on the search results page'; ?></p>

            </div>

             

                          

            </div>

            

            </div>

            

            </div>

           

           

         

            </div>

            

            

            <div class="treasury_right">

            <div style="background:#E9F6FC" class="treasury_secondary_right">

        <h2><?php if($this->lang->line('seller_owners') != '') { echo stripslashes($this->lang->line('seller_owners')); } else echo 'Shop Owners'; ?></h2>

        <p><?php if($this->lang->line('seller_city') != '') { echo stripslashes($this->lang->line('seller_city')); } else echo 'Set your city in your'; ?> <a href="public-profile"><?php if($this->lang->line('seller_profile') != '') { echo stripslashes($this->lang->line('seller_profile')); } else echo 'public profile'; ?></a><?php if($this->lang->line('seller_localsearches') != '') { echo stripslashes($this->lang->line('seller_localsearches')); } else echo 'to make sure your shop shows up in local searches'; ?>.</p>

    </div>

           

           <div class="treasury_right-bottom">

    <h2><?php if($this->lang->line('seller_join') != '') { echo stripslashes($this->lang->line('seller_join')); } else echo 'Join a Local Team'; ?></h2>

        <p><?php if($this->lang->line('seller_meetpeople') != '') { echo stripslashes($this->lang->line('seller_meetpeople')); } else echo 'Meet people with common interests and collaborate. Search for local teams to join from the'; ?> <a href="teams"> <?php if($this->lang->line('seller_teamspage') != '') { echo stripslashes($this->lang->line('seller_teamspage')); } else echo 'teams page'; ?>.</a></p>

        

    </div>

           

            </div>

            </div>

        </div>

    </section>

<?php 

$this->load->view('site/templates/footer');

?>

