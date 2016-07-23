<link href="css/default/front/bootstrap.css" rel="stylesheet">
<link hrefimages/="css/default/front/font-awesome.css" rel="stylesheet">
<link href="css/default/front/main.css" rel="stylesheet">
<link href="css/default/front/deal.css" rel="stylesheet">
<link href="css/default/front/browse.css" rel="stylesheet">
<link href="css/default/front/home.css" rel="stylesheet">
<link href="css/default/front/art.css" rel="stylesheet">
<link href="css/default/front/seller.css" rel="stylesheet">
<link href="css/default/front/custom.css" rel="stylesheet"> 
<link href="css/default/site/responsive-dev.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style_1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/account_master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/popup.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/help.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/front/auction.css"/>
<!---<link rel="stylesheet" type="text/css" media="all" href="css/default/site/my_shop.css"/>
 <link href="css/default/front/new-style.css" rel="stylesheet">  -->
<link href="css/default/front/edit-css.css" rel="stylesheet">
<link href="css/default/site/shop-add.css" rel="stylesheet">
<link href="css/default/front/menu-horizontal.css" rel="stylesheet">
<link href="css/default/front/zo-cas-style.css" rel="stylesheet">
<link href="css/default/front/style-responsive.css" rel="stylesheet">
<link href="css/default/front/responsive-style-sheet.css" rel="stylesheet">
<?php 
$this->load->view('site/templates/header');
?>

<link href="css/animate.css" rel="stylesheet">
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>

<div id="info">
<section class="container">

<div style="min-height:600px;color:#4c4c4c;border:1px;background-color:#ffffff;padding:10px;">
<h1 style="color:#8dbad4;margin-top:300px;text-align:center;"> 公司資料 </h1>

<hr/>

<p>
<b><u>新聞及評論</u></b><br/>
Artfill 團隊很樂意與外界分享我們的故事。 如有任何查詢， 請電郵至press@artfill.co查詢。

</p>

<br/>
<br/>
<p>
<b><u>Artfillers</u></b><br/>
感謝手作界朋友一直以來的支持， 歡迎 Artfiller 或有意加入 Artfill手作買賣平台的買家／賣家電郵至enquiry@artfill.co查詢。

</p>
<br/>

</div>

</section>
</div>




<?php 
$this->load->view('site/templates/footer');
?>