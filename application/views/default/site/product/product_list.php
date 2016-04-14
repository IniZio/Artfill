<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?>
<section>
    	<div class="main">
        
        	<div class="container">
            
            		<div class="left_side">
                
                	<div class="browse">
                    
                    	<h2>Browse</h2>
                        
                        <ul>
                        	
                            <li><a href="#">Art</a></li>
                            
                            <li><a href="#">Home & Living</a></li>
                            
                            <li><a href="#">Jewelry</a></li>
                            
                            <li><a href="#">Women</a></li>
                            
                            <li><a href="#">Men</a></li>
                            
                            <li><a href="#">Kids</a></li>
                            
                            <li><a href="#">Vintage</a></li>
                            
                            <li><a href="#">Weddings</a></li>
                            
                            <li><a href="#">Craft Supplies</a></li>
                            
                            <li><a href="#">Trending Items</a></li>
                            
                            <li><a href="#">Holidays</a></li>
                            
                            <li><a href="#">Gift Ideas</a></li>
                            
                            <li><a href="#">Mobile Accessories</a></li>
                            
                        
                        
                        
                        </ul>
                    	
                    
                    </div>
                    
                    <div class="email_subscribe">
                    
                    	<h2><?php echo $this->config->item('email_title'); ?> Finds</h2>
                        
                        <p>Get gift ideas, editors' picks & fresh trends in your inbox.</p>
                        
                        <input type="submit" value="Subscribe" class="subscribe_btn" />
                        
                        <a class="newsletter_links" href="#">See our other newsletters.</a>
                    
                    </div>
                    
                    <div class="left_shop">
                    
                    	<h2><?php echo $this->config->item('email_title'); ?> Finds</h2>
                        
                        <ul>
                        
                        	<li><a href="#">Categories</a></li>
                            
                            <li><a href="#">Gift Cards</a></li>
                            
                            <li><a href="#">Colors</a></li>
                            
                            <li><a href="#">Treasury</a></li>
                            
                            <li><a href="#">Shop Local</a></li>
                            
                            <li><a href="#">Shop Search</a></li>
                            
                            <li><a href="#">People Search</a></li>
                            
                            <li><a href="#">Prototypes</a></li>
                            
                        </ul>
                    
                    </div>
                
                </div>
                
                <div class="right_side">
                
                	<div class="add_listimg">
                    <a href="#"><img src="../list/images/img_22.jpg" /></a>
                    </div>
                    
                    <div class="product_box">
                    
                    <div class="product_title_box">
                    
                    	<h2>Handpicked Items</h2>
                        
                        <a class="see_more" href="#">See more</a>
                        
                        <a class="see_items" href="#">Picked by Louise De Masi</a>
                        
                     </div>
                        
                        <ul class="product_listing">
                        
                        	<li>
                            
                            	<div class="product_img"><a href="#">
                                
                                	<div class="product_hide">
                                    
                                    	<div class="product_fav">
                                        
                                        	<input type="submit" value="" class="hoverfav_icon" />
                                            
                                            <div class="hoverdrop_icon">
                                            
                                            <a href="javascript:hoverView('1');"> </a>
                                            
                                            
                                            	<div class="hover_lists" id="hoverlist1">
                                                
                                                	<h2>Your Lists</h2>
                                                    
                                                    <div class="lists_check">
                                                    
                                                    	<input type="checkbox" value="" class="check_box" />
                                                        
                                                        <label>John</label>
                                                    
                                                    </div>
                                                    
                                                    <div class="new_list">
                                                    
                                                    	<input type="text" placeholder="New list" class="list_scroll" />
                                                    
                                                    
                                                    </div>
                                                
                                                </div>
                                            
                                            
                                            
                                            </div>
                                        	
                                        </div>
                                    
                                    </div>
                                    
                                <img src="../list/images/product-1.jpg" alt="Product-1" title="Product-1" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-2.jpg" alt="Product-2" title="Product-2" /></a></div>
                                
                                <div class="product_title"><a href="#">Vintage brass deer doe fawn</a></div>
                                
                                <div class="product_maker"><a href="#">thecupcakekid</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$30.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-3.jpg" alt="Product-3" title="Product-3" /></a></div>
                                
                                <div class="product_title"><a href="#">Cowl neck blouse</a></div>
                                
                                <div class="product_maker"><a href="#">ColeHands</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$140.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-4.jpg" alt="Product-4" title="Product-4" /></a></div>
                                
                                <div class="product_title"><a href="#">Leather Bag, Women's Purse, Tribal Clutch</a></div>
                                
                                <div class="product_maker"><a href="#">eclu</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$139.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-5.jpg" alt="Product-5" title="Product-5" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-6.jpg" alt="Product-6" title="Product-6" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-7.jpg" alt="Product-7" title="Product-7" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-8.jpg" alt="Product-8" title="Product-8" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-9.jpg" alt="Product-9" title="Product-9" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-10.jpg" alt="Product-10" title="Product-10" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-11.jpg" alt="Product-11" title="Product-11" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-12.jpg" alt="Product-12" title="Product-12" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                        
                        
                        </ul>
                    	
                    
                    </div>
                    
                    <div class="product_box">
                    
                        <div class="product_title_box">
                        
                            <h2>Featured Shop</h2>
                            
                            <a class="see_more" href="#">See more</a>
                            
                        </div>
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-1.jpg" alt="Featured-1" title="Featured-1" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">TneesTpees</a></h3>
                                
                                <p>"I came up with the teepee designs using nothing more than taped pieces of construction paper and mathematical estimates." – Courtney Gray</p>
                                
                                <a class="read_post" href="#">Read the interview</a>
                            
                            </div>
                        	
                        
                        </div>
                        
                         <ul class="featured_listing">
                        
                        	<li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-1.jpg" alt="Product-1" title="Product-1" /></a></div>
                                
                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>
                                
                                <div class="product_maker"><a href="#">BecaShoots</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$14.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                            <li>
                            
                            	<div class="product_img"><a href="#"><img src="../list/images/product-2.jpg" alt="Product-2" title="Product-2" /></a></div>
                                
                                <div class="product_title"><a href="#">Vintage brass deer doe fawn</a></div>
                                
                                <div class="product_maker"><a href="#">thecupcakekid</a></div>
                            
                            	<div class="product_price">
                                
                                	<span class="currency_value">$30.00</span>
                                    
                                    <span class="currency_code">USD</span>
                                
                                </div>
                            
                            </li>
                            
                          </ul>
                        
                        
                   </div>
                   
                   	<div class="product_box third onethird">
                    
                        <div class="product_title_box">
                        
                            <h2>Recent Blog Posts</h2>
                            
                            <a class="see_more" href="#">See more</a>
                            
                            <ul class="nextprev">
                            
              					<li><a href="#hambone" class="next"> Next </a> <a href="#hambone" class="prev"> Prev </a></li>
                                
            				</ul>
                            
                        </div>
                        
                        <div class="slidewrap">
                        
                        <ol class="slider" id="hambone">
                        
                        	<li class="intro">
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-2.jpg" alt="Featured-2" title="Featured-2" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">Editors' Picks: Our Favorite Holiday Cards</a></h3>
                                
                                <p>Now's the perfect time to order the cards that everyone on your list will treasure for years to come.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-3.jpg" alt="Featured-3" title="Featured-3" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">How-Tuesday: Recycled Appetizer Pick Bowls</a></h3>
                                
                                <p>Make a pair of simple, stylish toothpick holders for your next dinner party in four easy steps.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        </li>
                        
                        <li class="intro">
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-2.jpg" alt="Featured-2" title="Featured-2" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">Editors' Picks: Our Favorite Holiday Cards</a></h3>
                                
                                <p>Now's the perfect time to order the cards that everyone on your list will treasure for years to come.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-3.jpg" alt="Featured-3" title="Featured-3" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">How-Tuesday: Recycled Appetizer Pick Bowls</a></h3>
                                
                                <p>Make a pair of simple, stylish toothpick holders for your next dinner party in four easy steps.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        </li>
                        
                        <li class="intro">
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-2.jpg" alt="Featured-2" title="Featured-2" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">Editors' Picks: Our Favorite Holiday Cards</a></h3>
                                
                                <p>Now's the perfect time to order the cards that everyone on your list will treasure for years to come.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        <div class="featured_shop">
                        
                        	<div class="featured_img"><a href="#"><img src="../list/images/featured-3.jpg" alt="Featured-3" title="Featured-3" /></a></div>
                            
                            <div class="featured_right">
                            
                            	<h3><a href="#">How-Tuesday: Recycled Appetizer Pick Bowls</a></h3>
                                
                                <p>Make a pair of simple, stylish toothpick holders for your next dinner party in four easy steps.</p>
                                
                                <a class="read_post" href="#">Read the post</a>
                            
                            </div>
                        
                        </div>
                        
                        </li>
                        
                        </ol>
                        
                        </div>
                        
                         
                        
                        
                   </div>
                   
                  	<div class="product_box">
                    
                        <div class="product_title_box">
                        
                            <h2>Recently Listed Items</h2>
                            
                            <a class="see_more" href="#">See more</a>
                            
                        </div>
                        
                        <ul class="recent_list">
                        
                        	<li><a href="#"><img src="../list/images/product-1.jpg" alt="Listing-1" title="Listing-1" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-2.jpg" alt="Listing-2" title="Listing-2" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-3.jpg" alt="Listing-3" title="Listing-3" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-4.jpg" alt="Listing-4" title="Listing-4" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-6.jpg" alt="Listing-6" title="Listing-6" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-7.jpg" alt="Listing-7" title="Listing-7" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-8.jpg" alt="Listing-8" title="Listing-8" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-9.jpg" alt="Listing-9" title="Listing-9" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-10.jpg" alt="Listing-10" title="Listing-10" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-11.jpg" alt="Listing-11" title="Listing-11" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-12.jpg" alt="Listing-12" title="Listing-12" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-5.jpg" alt="Listing-5" title="Listing-5" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-2.jpg" alt="Listing-2" title="Listing-2" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-3.jpg" alt="Listing-3" title="Listing-3" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-4.jpg" alt="Listing-4" title="Listing-4" /></a></li>
                            
                            <li><a href="#"><img src="../list/images/product-5.jpg" alt="Listing-5" title="Listing-5" /></a></li>
                        
                        
                        </ul>
                        
                        
                   </div>
                   
                    
                
                </div>
            
            
            </div>
        
        
        </div>
    
    
    </section>
    

<?php 
     $this->load->view('site/templates/footer');
?>