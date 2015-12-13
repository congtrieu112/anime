<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<meta name="description" content=" <?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> hay và mới nhất được tuyển chọn tại 24hphim.net" />	
<meta name="keywords" content="<?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> mới nhất, <?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> hay nhất, <?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> chọn lọc, <?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> 2012,<?php printf( __( '%s', 'phim' ), '' . single_tag_title( '', false ) . '' );?> 2013" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" href="http://24hphim.net/favicon.ico" type="image/x-icon" />
<meta content="INDEX,FOLLOW" name="robots" />
<link href="<?php bloginfo('template_directory');?>/css/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php bloginfo('template_directory');?>/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/jwplayer.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/swfobject.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/alohot.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/light.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/js/phim3s-4.0.0.js?v=21102012055015" type="text/javascript"></script>
<?php wp_head();?>
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
</head><body>
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&amp;appId=106049796202031";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
<div id="header">
	<div class="container">
	<h1 id="logo">
		<a href="<?php bloginfo('siteurl');?>" title="Xem phim, phim moi, phim hay, phim hot">Xem Phim Nhanh, Xem Phim Online,Phim tâm lý</a>
	</h1>
	<div id="search">
		<form method="get" id="cse-search-box" name="search" action="<?php bloginfo('siteurl');?>/tim-kiem-phim">
			<input type="hidden" name="cx" value="017120531741807955792:WMX-1055315542"/>
			<input type="hidden" value="FORID:9" name="cof"/>
			<input type="hidden" value="UTF-8" name="ie"/>
			<input type="hidden" name="search_type" id="search_type" value="all" />
		<input type="text" name="q" placeholder="Từ khóa cần tìm..." class="keyword">
		<button type="submit" class="submit"></button>
		</form>
	</div>
	<div id="sign">
<?php
if (is_user_logged_in()) { ?>
<?php
$userid=get_current_user_id();
$user_info = get_userdata($userid);
$q = $wpdb->get_results("SELECT box_id,box_phim FROM wp_boxfilm WHERE box_user = $userid ");

?>
<div class="logged"><div class="info">Xin chào, <a data-user-id="<?php echo $user_info->ID;?>" class="username"><?php echo $user_info->user_login;?></a></div>
<div class="bookmark">
<span>Cá Nhân</span>
	<ul class="bookmarklist" style="display: none;">
	<?php foreach ($q as $box) { ?>
	<li><strike data-user-id="<?php echo $user_info->ID;?>" data-film-id="<?php echo $box->box_phim;?>">Xóa</strike><a href="<?php echo get_permalink($box->box_phim);?>" title="<?php echo get_the_title($box->box_phim); ?>"><?php echo get_the_title($box->box_phim); ?></a></li>
	<?php } ?>
	</ul>
	</div>
	<div class="logout"><a rel="nofollow" href="http://24hphim.net/wp-login.php?action=logout">Thoát</a></div></div>
<?php } else { ?> 
<div class="login">  
 <a href="<?php bloginfo('siteurl');?>/wp-login.php" class="simplemodal-login">Đăng nhập</a>
</div>
<div class="links"><a href="<?php bloginfo('siteurl');?>/wp-login.php?action=register" class="simplemodal-register">Đăng ký thành viên</a></div>
<?php } ?>
 
</div>
	</div>
</div>
<div id="nav">
<?php $defaults = array(
	'theme_location'  => 'top',
	'menu'            => '', 
	'container'       => '', 
	'container_class' => '', 
	'container_id'    => '',
	'menu_class'      => '', 
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'items_wrap'      => '<ul id="%1$s" class="container menu">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
); ?>

<?php wp_nav_menu( $defaults ); ?>
</div>