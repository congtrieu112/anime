<!DOCTYPE html>
<html class="js history csscolumns svg inlinesvg uk-notouch" lang="en"><head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?php wp_title( '-', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
    <meta name="description" content="">
   
    <meta name="revisit-after" content="2 days">
    <meta name="RATING" content="RTA-5042-1996-1400-1577-RTA">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Icons -->
<meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  -->
<script src="<?php bloginfo('template_directory');?>/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.slides.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css" media="all">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" media="all">
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dropzone.css">
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jwplayer_theme.css">
<style>
    #slides {
      display: none
    }

    .container {
      margin: 0 auto
    }

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
      .container {
        width: 724px
      }
    }

    /* For larger displays */
    @media (min-width: 100%) {
      .container {
        width: 100%;
		height: 450px;
      }
    }
  </style>

<script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
});
</script>
<script src="<?php bloginfo('template_directory');?>/js/alohot.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/light.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/phim3s-4.0.0.js" type="text/javascript"></script>
<link href="http://vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.11/video.js"></script>
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('ul.list-film li .inner a').hover(function(){
                var str = '<div class="border">' + jQuery(this).attr('data-tooltip') + '</div>';
                jQuery('<div class="tooltip"></div>').html(str).appendTo('body').fadeIn(600);
            }, function(){
                jQuery('.tooltip').remove();
            }).mousemove(function(e){
                var x = e.pageX + 20;
                var y = e.pageY;
                jQuery('.tooltip').css({top : y, left : x});
            });
        });
    </script>
<div id="js-modal-login" class="modal uk-modal js-modal-ajax">
    <div class="modal__inner uk-modal-dialog">
        <a class="modal__close uk-modal-close" type="button">
            <i class="i i--size--xl i--color-brand"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"><use xlink="http://www.w3.org/1999/xlink" xlink:href="#i--close"></use></svg></i>
        </a>
        <div class="modal__content"></div>
    </div> 
</div> 
<div class="wrap">
	<div class="header">
	
	<div class="layout">
	<div class="header-main">
	<div class="header-main__left">
	<div class="header__logo"><a href="<?php bloginfo('siteurl');?>" class="logo"></a></div>
	<div class="header__search control-group">
	<form action="<?php bloginfo('siteurl');?>" class="form">
	<div class="input input--search input--size--l"><input class="input__control" name="s" autocomplete="off" type="text"></div>
	<button class="btn btn--size--l btn--search" type="submit"><span class="btn__text">
	Search</span></button>
	</form>
	</div></div>
	<div class="header-main__right">
<div class="header-action">
<img src="http://tonka3d.com.br/blog/wp-content/uploads/2011/03/tonka3d-banner-450x45.jpg">
</div>
</div>
	
	</div>
	<div class="header-bottom">
	<div class="header-nav">
	<div id="nav">
	<?php wp_nav_menu( $defaults ); ?>
	</div>
	</div>
</div>
</div>
</div>