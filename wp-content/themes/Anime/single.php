<?php get_header();?>
<?php
$u = $wpdb->query("UPDATE ".DATA_FILM_META."
							SET
								film_viewed = film_viewed + 1
								, film_viewed_d = film_viewed_d + 1
								, film_viewed_w = film_viewed_w + 1
								, film_viewed_m = film_viewed_m + 1
							WHERE film_id = '".$post->ID."'");
?>
<?php
$categories = get_the_category();
$seperator = ", ";
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
	}

}
$idtap = get_query_var('ep');
$sv = get_query_var('sv');
$idphim=get_the_ID();
$permalink = get_permalink( $idphim );
$image =  get_post_meta($post->ID,'Image',true);
$title = $post->post_title;
$description = custom_excerpt($post->post_content,10,'...');
?>

<?php if (have_posts()) : while (have_posts()) : the_post();?>
<?php if($idtap || $sv!="") { ?>
<?php include('phim-play.php');?>
<?php } ?>
<?php if($idtap=="" && $sv=="") { 
  $idtap = tapphim($idphim);
  ?>
<?php include('phim-thongtin.php');?>
<?php } ?>


<?php endwhile;endif;?>

<?php get_footer();?>
