<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		var currencySymbol = '<?php echo $currencySymbol;?>';
		var siteTitle = '<?php echo $siteTitle;?>';
		var can_show_signin_overlay = false;
		var currUrls = '<?php echo addslashes($this->uri->segment(4)); ?>';		

</script>
<?php ?>
<!-------------Old script lines--------->
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<!-------------Old script lines--------->

<!---------------New script lines -------->
<script src="js/front/jquery.raty.min.js"></script>
<script src="js/front/jquery-1.9.1.min.js"></script>
<script src="js/front/bootstrap.min-v3.3.4.js"></script>
<!---------------New script lines -------->
<script type="text/javascript" src="js/pace.min.js"></script>
<script type="text/javascript" src="js/jquery.elastislide.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<?php if($this->uri->segment(1) =='gift-cards'){?>
<script type="text/javascript" src="js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="js/gallery.js"></script>
<?php }?>
<script type="text/javascript" src="js/favico.js"></script>
