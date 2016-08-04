<!-- external stylesheets start -->
<link href="css/dataurl.css" rel="stylesheet" />
<link href="css/default/front/bootstrap.css" rel="stylesheet">
<link href="css/default/front/font-awesome.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<!-- external stylesheets end -->

<link href="css/default/front/main.css" rel="stylesheet">
<link href="css/default/front/deal.css" rel="stylesheet"> <!-- partial: offer tag -->
<link href="css/default/front/browse.css" rel="stylesheet"> <!-- partial: freewall_bricks, button_fav, button_dropdown-->
<link href="css/default/front/home.css" rel="stylesheet"> <!-- general (to be merged) -->
<link href="css/default/front/art.css" rel="stylesheet"> <!-- partial: freewall, share  -->
<link href="css/default/front/seller.css" rel="stylesheet"> <!-- seller role (to be merged) -->
<link href="css/default/front/custom.css" rel="stylesheet"> <!--reviews;  partial: lists -->
<link href="css/default/site/responsive-dev.css" rel="stylesheet"> <!-- breadcumbs, signin/up page  -->
<link href="css/default/site/shopsy_style.css" rel="stylesheet"> <!-- many general shopsy items -->
<link href="css/default/site/account_master.css" rel="stylesheet"> <!-- account parts, shipping -->
<link href="css/default/site/popup.css" rel="stylesheet"> <!-- partial: popup(uses id ._.) -->
<link href="css/default/site/help.css" rel="stylesheet"> <!-- cms help classes -->
<link href="css/default/front/auction.css" rel="stylesheet"> <!-- all bid stuff(do we even need?) -->
<link href="css/default/front/edit-css.css" rel="stylesheet"> <!-- general (to be merged) -->
<link href="css/default/site/shop-add.css" rel="stylesheet"> <!-- mostly shop stuff (to be merged) -->
<link href="css/default/front/menu-horizontal.css" rel="stylesheet"> <!-- vendor: Mega Menu (for header) -->
<link href="css/default/front/zo-cas-style.css" rel="stylesheet"> <!-- general (to be merged) -->
<link href="css/default/front/style-responsive.css" rel="stylesheet"> <!-- all adaptive sizes -->
<link href="css/default/front/responsive-style-sheet.css" rel="stylesheet"> <!-- another adaptive sizes... -->

<?php if (isset($active_theme) && $active_theme->num_rows() != 0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>