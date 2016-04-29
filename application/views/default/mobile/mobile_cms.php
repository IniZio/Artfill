

<style>
.cms_content_about{float: left;
width: 100%;
margin: 20px 0px;
border: 1px solid #fff;
border-radius: 5px;
padding: 10px 25px;
background:#fff;

}

.shop_title_abt{
    float: left;
    width: 97%;
	font-weight:bold;
	font-size:22px;
	padding:15px 0px;
}
</style>


<?php if($pageDetails->row()->seourl == 'contact-us') {

$this->load->view('site/cms/contact');



 ?>




<?php } else {?>



  <section class="container">
			<div class="main">
            <div class="cms_content_about">

            <div class="shop_title_abt"><?php echo $pageDetails->row()->page_title; ?></div>

            <div class="inner-container-cms">  <?php 

            	if ($pageDetails->num_rows()>0){

            		echo $pageDetails->row()->description;

            	}

            	?>				

            </div>

        </div>

    </section>
<?php }?>


