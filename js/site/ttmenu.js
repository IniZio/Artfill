/**
* Project: TT Menu - Vertical Horizontal Bootstrap Mega Menu
* Author: Trending Templates Team
* Author URI: www.trendingtemplates.com
* Dependencies: Bootstrap's mega menu plugin
* A professional Bootstrap mega menu plugin with tons of options.
*/

(function($) {
"use strict";

/* ==============================================
HEADER AFFIX -->
=============================================== */
  /* $("#stickymenu.ttmenu").affix({
    offset: {
      top: 100
    }
  }) */

/* ==============================================
FIX VIDEO -->
=============================================== */


/* ==============================================
TABBED HOVER -->
=============================================== */
  
  $('.nav-pills > li ').hover( function(){
    if($(this).hasClass('hoverblock'))
      return;
      else
      $(this).find('a').tab('show');
  });

  /*$('.nav-tabs > li').find('a').click( function(){
    $(this).parent()
      .siblings().addClass('hoverblock');
  });*/

/* ==============================================
MENU HOVER -->
=============================================== */
	$(".hovermenu .dropdown").hover(
		function() { $(this).addClass('open') },
		function() { $(this).removeClass('open') }
	);

/* ==============================================
MENU CLICKABLE for HORIZONTAL -->
=============================================== */

 /* $('.clickablemenu .dropdown').click('show.bs.dropdown', function(e){
    var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt($dropdown.css('margin-top'));
      $dropdown.css({'margin-top': (orig_margin_top + 65) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 420, function(){
        $(this).css({'margin-top':''});
    });
  });*/

/* ==============================================
MENU CLICKABLE for VERTICAL -->
=============================================== */

/*  $('.verticalmenu .dropdown').click('show.bs.dropdown', function(e){
    var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt("1", 10);
      $dropdown.css({'margin-left': (orig_margin_top + 65) + 'px', opacity: 0}).animate({'margin-left': orig_margin_top + 'px', opacity: 1}, 420, function(){
         $(this).css({'margin-left':''});
    });
  });*/

})(jQuery);