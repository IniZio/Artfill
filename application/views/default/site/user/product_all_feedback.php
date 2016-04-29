<?php 

$this->load->view('site/templates/header');



?>



<!--header-->

<!--selection-->

<section class="container">

	

    	<div class="main">

        <div class="wrapper">

        <ul class="vertical_link">

        	<li> <a href="" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></li>

           <!-- <li> <a onclick="window.history.back();" class="a_links">Product Details</a></li>-->

            <li> <a href="#" class="a_links"><?php if($this->lang->line('user_feedback') != '') { echo stripslashes($this->lang->line('user_feedback')); } else echo 'Feedback'; ?></a></li>

        </ul>

        <div class="blog_setup">

        <div class="heading" style="font-size:16px;"><?php if($this->lang->line('user_feed_space_back') != '') { echo stripslashes($this->lang->line('user_feed_space_back')); } else echo 'Feed Back'; ?></div>

        

        <div class=" clear"></div>



<!--  <div id='inline_reg' style='background:#fff;'>  

	

    <div class="popup_tab_content" style="min-height:380px;">-->

    	

        <div class="clear"></div>

        

       <!--feed details page end-->  

         <div class="feed-details">

         <ul class="feed-list">

          <?php 

		  if(!empty($FeedbackDetails)){



		  foreach($FeedbackDetails as $details){?>

              <li>

         <!--Rating star -->                           

        <div class="ratingstar-<?php echo trim(round(stripslashes($details['rating'])));?>" id="rating-pos"> &nbsp;</div>

      <!-- Rating star end--> 

    <h2 class="feed-name"><?php echo ucfirst(stripslashes($details['full_name']));?></h2>              

    <h3  class="feed-tle"><?php echo ucfirst(stripslashes($details['title']));?></h3>              

<p class="feed-cnt1"><?php echo stripslashes($details['description']);?></p>       

         </li>

          <?php } }else {?>

                  <div style="color:#FF0000; text-align:center;"><?php if($this->lang->line('user_no_feedback') != '') { echo stripslashes($this->lang->line('user_no_feedback')); } else echo 'No Feedback Found'; ?> !!!</div>

          <?php } ?>

           <div  class="page-list"> <?php echo $paginationLink; ?> </div>

      </ul>   

        

  

   <!--<ul class="page-list">

   <li><a href="#" id="active">1</a></li>

   <li><a href="#">2</a></li>

   <li><a href="#">3</a></li>

   <li><a href="#">4</a></li>

   </ul>-->

         </div>    

   <!--feed details page end-->     

  <!--  </div>  

  </div>-->

        </div>

            </div>

        </div>



</section>

<!--selection-->



<footer>

<?php 

$this->load->view('site/templates/footer');

?>



</footer>



</body>

</html>

