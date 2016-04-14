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
<h1 style="color:#8dbad4;margin-top:300px;text-align:center;"> 關於我們 </h1>

<hr/>

<p>
<b><u>關於我們</u></b><br/>
Artfill 的宗旨為推廣本地原創設計，支持手作文化，希望為本港藝術及設計產業帶來新氣象。買家可以透過Artfill 購買多元化的手作產品，也可以在此度身訂造屬於你獨一無二的手作品。我們歡迎設計師及手作人登記成為賣家，免費於Artfill上營運店鋪，建立屬於你的設計及手作事業。
<br/>
我們建立Artfill, 是希望為香港提供一個尊重創意的社群，凝聚手作人和設計師，令Artfill成為一個創意和藝術的聚居地。

</p>
<br/>
<br/>
<p>
<b><u>About us</u></b><br/>
Artfill is an original online marketplace that was created in Hong Kong. Our mission is to promote and encourage local brands and designed goods to preserve authentic Hong Kong culture, while aspiring to diversify the products available for the market. There are plenty of opportunities to both showcase and discover talents through the handmade products, crafts and own-branded items available here. Products can fall under various categories—we welcome fresh and inventive design in many styles. Artfill is a community where the arts and creative endeavours are breathed into daily life.

</p>
<br/>

</div>

</section>
</div>

<?php 
$this->load->view('site/templates/footer');
?>