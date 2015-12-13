<?php
/*
Template Name: Phim lẻ
*/
?>
<?php get_header();?>
<?php
$order=$_GET['sort_id'];
$country=$_GET['country_name'];
$year=$_GET['y'];
$theloai=$_GET['theloai'];
if($order) {
$a=array('order'=>$order);
}else{$a=array('order'=>'date');}
if($year) $b=array('meta_key'=>'phim_nsx','meta_value'=>$year);else $b=array();
if($theloai) $d=array('cat'=>$theloai);else $d=array();
if($country!=''){
$c=array('tax_query' => array(
		array(
			'taxonomy' => 'quoc-gia',
			'field' => 'slug',
			'terms' => $country
		)
	),
	)
	;
}else $c=array();
?>
<style>.current{color:black;}
.larger{margin-left:5px;}</style>
<div class="container " id="fnBody">
                <div class="content" id="fnBodyContent">
<?php 
						$temp = $my_query;
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args=array(
						'post_type' => 'post',
                                                'meta_key'=>'phim_loai',
						'meta_value'=>'phimle',
						'paged'=>$paged,
						'post_status' => 'publish',
						'showposts' => 20,
						);
						$args=array_merge($args,$a,$b,$c,$d);
						$my_query = null;
						$my_query = new WP_Query($args);
						while($my_query->have_posts()) : $my_query->the_post();?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
						<?php endwhile;?>
                                                <!-- Lay phim -->
                                                <!-- End lay phim -->
                                            <?php wp_pagenavi( array( 'query' => $my_query ) );wp_reset_query(); ?>
   </div><script type="text/javascript">
                    $(document).ready(function () {
                        $('#fnRTTabAlbum').on('click', function () {
                            $('#fnRTAlbum').removeClass('none');
                            $('#fnRTSong').addClass('none');
                            $('#fnRTVideo').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                        $('#fnRTTabSong').on('click', function () {
                            $('#fnRTSong').removeClass('none');
                            $('#fnRTAlbum').addClass('none');
                            $('#fnRTVideo').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                        $('#fnRTTabVideo').on('click', function () {
                            $('#fnRTVideo').removeClass('none');
                            $('#fnRTSong').addClass('none');
                            $('#fnRTAlbum').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                    });
                </script></div>
<?php get_sidebar();?>
<?php get_footer();?>