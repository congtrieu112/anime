<?php
define('DATA_POST', $wpdb->posts);
define('DATA_POSTMETA', $wpdb->prefix.'postmeta');
define('DATA_COMMENTS', $wpdb->prefix.'comments');
define('DATA_COMMENTMETA', $wpdb->prefix.'commentmeta');
define('DATA_TERMS', $wpdb->prefix.'terms');
define('DATA_TERM_TAXONOMY', $wpdb->prefix.'term_taxonomy');
define('DATA_TERM_RELATIONSHIPS', $wpdb->prefix.'term_relationships');
define('DATA_TERM_META', $wpdb->prefix.'term_meta');
define('DATA_FILM_EPISODE', $wpdb->prefix.'film_episode');
define('DATA_FILM_META', $wpdb->prefix.'film_meta');
define('DATA_FILM_SERVER', $wpdb->prefix.'film_server');
define('DATA_FILM_EPISODE', $wpdb->prefix.'film_episode');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']."");
define('PATH', $_SERVER['DOCUMENT_ROOT']."phim/cache/");
define('DOCUMENT_TEMP', get_template_directory());
define('TEMP_DIR', get_bloginfo('template_directory')."");
define('SITE_NAME', get_bloginfo('name'));
define('SITE_URL', get_bloginfo('wpurl'));
define('NOW', time());
add_theme_support('menus'); 
register_nav_menus(array(
	'top' => 'Top menu',
        'video' => 'Video',
        'tintuc' => 'Tin Tức',
	'nav' => 'Nav menu',
	'topm' => 'Top Mobile Menu',
	'navm' => 'Nav Mobile Menu',		
	'the-loai' => 'The loai Menu'	,
	'quoc-gia' => 'Quoc gia Menu'	
));

add_theme_support('post-thumbnails');
register_sidebar(array(
 'name'=>'sidebar',
 'id' => 'sidebar',
 'description' => 'Sidebar',
 'before_widget' => '',
 'after_widget'  => '',
 'before_title' => '<div class="bar_title"><span>',
 'after_title' => '</span></div>',
));
register_sidebar(array(
 'name'=>'sidebarbottom',
 'id' => 'sidebarbottom',
 'description' => 'Sidebar bottom',
 'before_widget' => '',
 'after_widget'  => '',
 'before_title' => '<div class="bar_title"><span>',
 'after_title' => '</span></div>',
));
register_sidebar(array(
 'name'=>'ViewDay',
 'id' => 'ViewDay',
 'description' => 'ViewDay',
 'before_widget' => '',
 'after_widget'  => '',
 'before_title' => '<div style="display: none;" ><span>',
 'after_title' => '</span></div>',
));
register_sidebar(array(
 'name'=>'Home Top',
 'id' => 'homecat',
 'description' => 'Home Top',
 'before_widget' => '<div id="%1$s" class="block-cont %2$s">',
 'after_widget'  => '</div>',
 'before_title' => '',
 'after_title' => '',
));
register_sidebar(array(
 'name'=>'Home Top2',
 'id' => 'homecat2',
 'description' => 'Home Top',
 'before_widget' => '<div style="margin:10px 0px;">',
 'after_widget'  => '</div>',
 'before_title' => '',
 'after_title' => '',
));
register_sidebar(array(
 'name'=>'ADS HOME',
 'id' => 'adshome',
 'description' => 'ADS HOME',
 'before_widget' => '<div id="%1$s">',
 'after_widget'  => '</div>',
 'before_title' => '',
 'after_title' => '',
));
register_sidebar(array(
 'name'=>'ADS SINGLE',
 'id' => 'adssingle',
 'description' => 'ADS SINGLE',
 'before_widget' => '<div id="%1$s">',
 'after_widget'  => '</div>',
 'before_title' => '',
 'after_title' => '',
));
register_sidebar(array(
 'name'=>'ADS FOOTER',
 'id' => 'adsf',
 'description' => 'ADS FOOTER',
 'before_widget' => '<div id="%1$s">',
 'after_widget'  => '</div>',
 'before_title' => '',
 'after_title' => '',
));

function img($width,$height) {
	global $post;
	$custom_field_value_2 = get_post_meta($post->ID, 'Image', true);
	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 1) );
	if(has_post_thumbnail()){
		$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID,'full'));
		$thumbnailsrc = $domsxe->attributes()->src;
		$img_url = parse_url($thumbnailsrc,PHP_URL_PATH);
	print get_bloginfo('template_url')."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;q=100";
	}
	elseif ($custom_field_value_2 == true) {
	print $custom_field_value_2;
	} 
	elseif ($attachments == true) {
		foreach($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'full');
		$image = $image[0];
		$img_url = parse_url($img[0], PHP_URL_PATH);
		print get_bloginfo('template_url')."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;q=70";
		}
	}
	else {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		
		if($first_img){ 
			print "$first_img";
		}
        else {
            print "http://thugianviet.net/wp-content/themes/thugianviet_info/images/logo.png";
        }
	}
}

function img3($width,$height) {
	global $post;
	$custom_field_value_2 = get_post_meta($post->ID, 'Image', true);
	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 1) );
	if(has_post_thumbnail()){
		$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID,'full'));
		$thumbnailsrc = $domsxe->attributes()->src;
		$img_url = parse_url($thumbnailsrc,PHP_URL_PATH);
	$img=get_bloginfo('template_url')."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;q=100";
	}
	elseif ($custom_field_value_2 == true) {
	$img= $custom_field_value_2;
	} 
	elseif ($attachments == true) {
		foreach($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'full');
		$image = $image[0];
		$img_url = parse_url($img[0], PHP_URL_PATH);
		$img= get_bloginfo('template_url')."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;q=70";
		}
	}
	else {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		
		if($first_img){ 
			$img= "$first_img";
		}
        else {
            $img= "http://thugianviet.net/wp-content/themes/thugianviet_net/images/logo.png";
        }
	}
	return $img;
}
function the_breadcrumb() {
		//echo '<div class="blocktitle breadcrumbs">';
	if (!is_home()) {
		echo '<div class="item" typeof="v:Breadcrumb"><a href="'.get_bloginfo("wpurl").'" rel="v:url" property="v:title">Xem phim</a></div>';
		if (is_single()) {
			echo '';
			$categories = get_the_category();
$seperator = '';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<div class="item" typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></div>'.$seperator;
	}
echo trim($output, $seperator);
}

			if (is_single()) {
			
				
				echo new_brek();
				
			}
		} elseif (is_page()) {
			echo '<h2 class="item last-child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span title="'.get_the_title().'">'.get_the_title().'</span></h2>';
		}
echo '';		
	}
	elseif (is_tag()) {echo '<h2 class="item last-child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">';single_tag_title();echo '</span></h2>';}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	//echo '</div>';
}

function get_views_last($type,$num=10){
			global $wpdb;
if($type=="day") { $where="AND ".DATA_FILM_META.".film_viewed_d";$order="".DATA_FILM_META.".film_viewed_d";}
elseif($type=="week") { $where="AND ".DATA_FILM_META.".film_viewed_w";$order="".DATA_FILM_META.".film_viewed_w";}
else {$where="AND ".DATA_FILM_META.".film_viewed_m";$order="".DATA_FILM_META.".film_viewed_m";}
$sql=$wpdb->get_results("SELECT 
								".DATA_POST.".post_title
								, ".DATA_POST.".ID
								, ".DATA_POST.".post_name
								,".DATA_POST.".post_content 								
								, ".DATA_FILM_META.".film_viewed_d
								, ".DATA_FILM_META.".film_viewed_w
								, ".DATA_FILM_META.".film_viewed_m 
							FROM ".DATA_POST.", ".DATA_FILM_META." 
							WHERE ".DATA_POST.".post_status = 'publish'
							".$where."
							AND ".DATA_POST.".ID = ".DATA_FILM_META.".film_id  
							ORDER BY ".$order." DESC LIMIT 10");
$i=0;
$html='';
	foreach ($sql as $viewday){
if($type=="day") $views=$viewday->film_viewed_d;
elseif($type=="week") $views=$viewday->film_viewed_w;
else $views=$viewday->film_viewed_m;
	$i++;
if($i==1 || $i==2 || $i==3) {					
					$class='class="st top"';}else $class='class="st"';
$html.='<li><span class="t_c_numb sprites hot">'.$i.'</span><div class="t_c_info"><div class="tc_i_n"><a href="'.get_permalink($viewday->ID).'" title="'.get_the_title($viewday->ID).'">'.get_the_title($viewday->ID).'</a></div><div class="tc_i_v"">'.get_post_meta($viewday->ID,'phim_en',true).' ('.$views.')</div></div></li>';
}
return $html;
}
function get_most_viewed_2($limit = 16,$begin=0,$excerpt_length=40, $show_thumb = true) {
		global $wpdb, $post;
			
		$where = "";
		$output = '';
		$where = "post_type = 'post'";
		$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $begin,$limit");
		if($most_viewed) { 
		$html.='';
			 foreach ($most_viewed as $post) { 
				$post_views = number_format_i18n(intval($post->views));
				$post_url = get_permalink($post->ID);
				$post_title = get_the_title();
					get_template_part( 'loop', get_post_format() ); 
			 } 

}		 
		
	}
function get_excerpt_content($max_char = 55,$more_text = '', $printout = 1,$content = '') {

	if ($content == '')

		$content = get_the_content('');

		

	$content = apply_filters('the_content', $content);

	$content = str_replace(']]>', ']]&gt;', $content);

	$content = strip_tags($content);

	

	$words = explode(' ', $content, $max_char + 1);

	

	if (count($words) > $max_char) {

		array_pop($words);

		$content = implode(' ', $words);

		$content = $content . '...';

	}

	

	if ($more_text != '') $content = $content.' <a class="continuebox" href="'.get_permalink().'" title="Permanent Link to '.get_the_title().'">'.$more_text.'</a>';

	

	if ($printout==1)

		echo $content;

	else

		return $content;

}
function get_film_home($type,$num=16,$excerpt_length=40) {
global $post;
	// tao cache
	$type_alohot	=	$type;
	$file = DOCUMENT_TEMP."/cache/alohot_".$type.".xxx"; // lấy tên file cache theo type để tránh trùng lập
	$expire = 86400; // 24h
	if (file_exists($file) &&
    filemtime($file) > (time() - $expire)) {
    include(DOCUMENT_TEMP."/cache/alohot_".$type_alohot.".xxx");
	} else { 
$q = (get_query_var('paged')) ? get_query_var('paged') : 1;					
query_posts('post_type=post&showposts='.$num.'&meta_key=phim_loai&meta_value='.$type.'&paged='.$q.'&order=desc');
while (have_posts()) : the_post(); 
$html.='<a href="'.the_permalink().'"class="content-items" title="'.the_title().' - '.get_post_meta($post->ID,'phim_en',true).'">
	<img src="'. img(72,100).'" alt="'. the_title().'" class="album-img" width="72" height="100" />
	<h2 class="title">'.the_title().'</h2>
	<h4>'.get_post_meta($post->ID,'phim_en',true).'</h4>
	<ul class="info-des">
		<li>Năm: '.get_post_meta($post->ID, "phim_nsx", true).'</li>
	</ul>
	<p class="btn-registry">'.trim(excerpt(40)).'</p>
</a>							';
endwhile;wp_reset_query();
    $fp = fopen($file,"w");
    fputs($fp, $html);
    fclose($fp);
	include(DOCUMENT_TEMP."/cache/alohot_".$type_alohot.".xxx");
}
}

function get_ascii($st){
		$vietChar 	= 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
		$engChar	= 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
		$arrVietChar 	= explode("|", $vietChar);
		$arrEngChar		= explode("|", $engChar);
		return str_replace($arrVietChar, $arrEngChar, $st);
	}
function get_num_rating($id) {
		global $wpdb, $post;
							$q = "SELECT 
								rating_rating
							FROM  wp_ratings 
							WHERE  wp_ratings.rating_postid =".$id."
							";
$rating_total=$wpdb->get_row($q);
return $rating_total->film_rating_total;
}
function get_total_rating($id,$type) {
		global $wpdb, $post;
							$q = "SELECT 
								".DATA_FILM_META.".film_id
								
								, ".DATA_FILM_META.".film_rating 
								, ".DATA_FILM_META.".film_like 
								, ".DATA_FILM_META.".film_rating_total 
							FROM ".DATA_FILM_META." 
							WHERE ".DATA_FILM_META.".film_id =".$id."
							";
$rating_total=$wpdb->get_row($q);
if($type=="rating"){
return $rating_total->film_rating_total;
}elseif($type=="like") {
return $rating_total->film_like;
}
							
}	
function wpse28145_add_custom_types( $query ) {
    if( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );


        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'wpse28145_add_custom_types' );
function tcb_note_server_side_page_speed() {
  date_default_timezone_set( get_option( 'timezone_string' ) );
  $content  = '[ ' . date( 'Y-m-d H:i:s T' ) . ' ] ';
  $content .= 'Page created in ';
  $content .= timer_stop( $display = 0, $precision = 2 );
  $content .= ' seconds from ';
  $content .= get_num_queries();
  $content .= ' queries';
  if( ! current_user_can( 'administrator' ) ) $content = "<!-- $content -->";
  echo $content;
}
function get_excerpt_by_id($post_id,$excerpt_length=''){
$the_post = get_post($post_id); //Gets post ID
$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
$excerpt_length = 35; //Sets excerpt length by word count
$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
$words = explode(' ', $the_excerpt, $excerpt_length + 1);
if(count($words) > $excerpt_length) :
array_pop($words);
array_push($words, '…');
$the_excerpt = implode(' ', $words);
endif;
$the_excerpt = '<p>' . $the_excerpt . '</p>';
return $the_excerpt;
}
function get_cat_alo(){
$categories = get_the_category();
$seperator = ", ";
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a itemprop="genre" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}

}
return $output;
}


// Thay doi logo admin wordpress

//function login_css() {
//wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' ); // duong dan den file css moi
//}
//add_action('login_head', 'login_css');


require_once('cache.php');
require_once('function_func.php');
require_once('function_custom_type.php');  

define( 'DISALLOW_FILE_EDIT', true );

?>