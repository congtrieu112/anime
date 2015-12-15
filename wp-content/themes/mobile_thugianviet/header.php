<?php include('bbit-compress.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	if(!is_singular()) bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?>
tren mobile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<meta name="robots" content="all,follow,Noodp,noarchive" />
<meta name="syndication-source" content="http://m.24hphim.net" />
<meta name="standout" content="http://m.24hphim.net" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<meta name="google-site-verification" content="QvPaXS5xP-prgflaWurkaQM0r1iPZZtuzdtdF7Ld1XQ" />
<link href="http://vjs.zencdn.net/4.1/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.1/video.js"></script>
    <!--Theme mobile by Victor Lee-->
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/style-vtl.css" type="text/css" />
		<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/reset.css" type="text/css" />
		<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/style-1.4.css" type="text/css" />
    <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/zepto.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/event.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/ajax.js"></script>
    <!--<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/check_mobile.js"></script>-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jwplayer_theme.css"> 
            <script type="text/javascript" src="http://content.jwplatform.com/libraries/PSq4YSgZ.js"></script>
            <script type="text/javascript">jwplayer.key = '83tV+S0kCYI/D2CIhRollTeLZBbTOcFO3ta94A=='</script>

</head>
<body>
<body class="mobile">
    <div id="fnWrapper" class="division">
        <div id="fnNav" class="sidebar none">
            <ul class="navigator">
                <li><a class="icon-home" href="<?php bloginfo('wpurl');?>">Trang Chủ</a></li>
                <li><a class="icon-video" href="<?php bloginfo('wpurl');?>/phim-moi">Phim Mới</a></li>
                
                
            </ul>
            <div class="glist">
                <h3 class="stitle">Thể loại</h3>
				<ul class="slist"><?php

$defaults = array(
	'theme_location'  => 'the-loai',
	'menu'            => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '<h3>',
	'after'           => '</h3>',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul>%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

?>
</ul>
                
            </div>
            <div class="glist">
                <h3 class="stitle">Quốc gia</h3>
                <ul class="slist"><?php

$defaults = array(
	'theme_location'  => 'quoc-gia',
	'menu'            => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '<h3>',
	'after'           => '</h3>',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul>%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

?>
</ul>
            </div>
            <div class="glist">
                <h3 class="stitle">Phim Theo Năm</h3>
                <ul class="slist"><?php

$defaults = array(
	'theme_location'  => 'nav',
	'menu'            => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '<h3>',
	'after'           => '</h3>',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul>%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

?>
</ul>
            </div>
            <div class="s-footer">
                <span>&copy; 2014 - m.24hphim.net</span>
                <a href="http://24hphim.net" class="fnDesktopSwitch button desktop-btn">Desktop</a>
            </div>
        </div>
<div class="home" id="fnPage">
            <header>
                <div class="top-head">
                    <a href="#" class="main-menu-link icon-menu fn-nav-show"></a>
                    <form method="get" action="<?php bloginfo('wpurl');?>/search/" id="frmSearch" class="frm-search">
                        <p class="text-box">
                            <input autocomplete="off" type="text" id="q" name="s" placeholder="Tìm kiếm" class="search-text-box" value="" />
                            <a href="#" class="delete-btn icon-delete none" id="fnSearchReset"></a>
                            <a href="#" class="search-btn icon-search" id="fnSearchSubmit"></a>
                        </p>
                    </form>
                </div>
            </header>