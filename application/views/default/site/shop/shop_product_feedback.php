<?php

$this->load->view('site/templates/header');

?>

<script src="js/jquery/jRating.jquery.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/default/jRating.jquery.css" type="text/css" />	

    <div class="clear"></div>

<!--header-->

<!--selection-->

<section class="container">

	

    	<div class="main">

        <div class="wrapper">

        <ul class="vertical_link">

        	<li> <a href="<?php base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></li>

            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('user_feedback') != '') { echo stripslashes($this->lang->line('user_feedback')); } else echo 'Feedback'; ?></a></li>

        </ul>

        <div class="blog_setup">

        <div class="heading" style="font-size:16px;"><?php if($this->lang->line('user_feedback') != '') { echo stripslashes($this->lang->line('user_feedback')); } else echo 'Feedback'; ?></div>

        

        <div class=" clear"></div>

<!--

  <div id='inline_reg' style='background:#fff;'>  

	

    <div class="popup_tab_content" style="min-height:380px;">-->

    	

        <div class="clear"></div>

<form id="form2" method="post"  action="site/user/feedback" onsubmit="return AddFeedback();" enctype="multipart/form-data">

        <div class="popup_login" style=" margin-left:20px; margin-top:20px; width:67%;">

        	<label style="font-size:14px;"><?php if($this->lang->line('feedback_title') != '') { echo stripslashes($this->lang->line('feedback_title')); } else echo "Title"; ?><span style="color:#F00; ">*</span><span style="color:#F00;" class="redFont" id="title_Err"></span></label>

            <input type="text" name ="title" id= "title" class="search" style="margin:5px 0 8px 0px; width:61%;" />

            <label style="font-size:14px;"><?php if($this->lang->line('feedback_description') != '') { echo stripslashes($this->lang->line('feedback_description')); } else echo "Description"; ?></label>

            <textarea class="search" id="description" name = "description" style="height:60px; margin:5px 0 8px 0px; width:61%;"></textarea>

            <label style="font-size:14px;"><?php if($this->lang->line('feedback_star_rating') != '') { echo stripslashes($this->lang->line('feedback_star_rating')); } else echo "Star Rating"; ?></label>

            <div class="feedback_rating">

                 <div class="rating-text">

					<input type="hidden" name="store_name" id="store_name" value="<?php echo $userVal[0]['seller_businessname'];?>" />	



                         <input type="hidden" name="rate" id="rate" value="<?php echo $loginCheck; ?>" />	

                    <input type="hidden" name="path" id="path" value="<?php echo base_url(); ?>" />	



                           <div class="exemple">

                    <?php if($loginCheck!=''){  ?>

                    

						<div class="star_rating">    

							<div class="exemple5" data="10_5"  style="width:60%;"></div>

                        </div>    

                         <?php }else{ ?>   

						<div class="star_rating" style="height:35px;">    	                         

                         	<div style="cursor:pointer;"><img src="images/10stars.png" alt="stars" onclick="javascript:sivarating();" /></div>

                            <div id="PetVoteRate"></div>

						</div>	                            

                         <?php } ?>

						</div>

                                <div class="clear"></div>

<br />

                     						<input type="hidden" name="rating_value" id="rating_value"  />	



                   </div>  

            	<img src="images/rating.png" />



            </div>



        </div>

        

        <div class="popup_login" style=" margin-left:10px;width:30%; ">

           		<div class="avatar_store" style="padding: 0 46px 0 30px; width:auto;">

           		<h2><?php if($this->lang->line('user_shop_owner') != '') { echo stripslashes($this->lang->line('user_shop_owner')); } else echo 'Shop Owner'; ?></h2> 

                <a href="#"><img src="<?php echo USERIMAGEPATH.$userpersonalVal[0]['thumbnail']; ?>" width="80px" height="110px"/></a>

                <div class="clear"></div>

                <span><a href="store/<?php echo $userVal[0]['seller_id']; ?>-<?php echo strtolower(url_title($userVal[0]['seourl'],true)); ?>"><?php echo $userpersonalVal[0]['full_name']; ?></a> </span>

                <p><?php echo $userpersonalVal[0]['city']; ?></p>

            

          	  </div>

          <!--  </div>

        </div>-->

        

        

        <div class="clear"></div>

        

			<button class="pass_word" type="submit"><span><?php if($this->lang->line('feedback_add') != '') { echo stripslashes($this->lang->line('feedback_add')); } else echo "Add Feedback"; ?></span></button>	

        

             

        

          

          	

  			  </div>  

    

 		 </div>

  

   </div>

      

 </div>

</div>

        

    

 

	

</section>

<script type="text/javascript">

		$(document).ready(function(){

			$('.exemple5').jRating({

				length:4.6,

				decimalLength:1,

				onSuccess : function(){

					alert('Success : your rate has been saved :)');

				},

				onError : function(){

					alert('Error : please retry');

				}

			});

		});

	</script>

<!--selection-->

<?php

$this->load->view('site/templates/footer');

?>

