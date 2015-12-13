<?php
/*
Template Name: Xem nhiều
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
<?php $where = "post_type = 'post'";
			
		$most_viewed =  $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_status = 'publish' AND post_type = 'post' AND meta_key = '_count-views_all' AND post_password = '' ORDER  BY views DESC LIMIT 0,20");

	if($most_viewed) { 
		
			 foreach ($most_viewed as $post) { 
				$post_views = number_format_i18n(intval($post->views));
				$post_url = get_permalink($post->ID);
				$post_title = get_the_title();
				$speak=get_post_meta($post->ID, "phim_tm", true);
				if ($speak==1)$speakw='<div class="speaker" title="Phim có thuyết minh"></div>';
				$html .= '<a href="'.get_permalink().'"class="content-items" title="'.get_the_title().' - '.get_post_meta($post->ID, "phim_en", true).'">
	<img src="'.img3(72,100).'" alt="'.get_the_title().'" class="album-img" width="72" height="100" />
	<h2 class="title">'.get_the_title().'</h2>
	<h4>'.get_post_meta($post->ID, "phim_en", true).'</h4>
	<ul class="info-des">
		<li>Năm: '.get_post_meta($post->ID, "phim_nsx", true).'</li>
                <li>Lượt xem: '.get_post_meta($post->ID, "_count-views_all", true).'</li>
	</ul>
</a>';
				$speakw='';
			 } 	
		
		 }
echo $html;	 
	?>	
                 <!-- Lay phim -->

                                                <!-- End lay phim -->
                                          <?php wp_pagenavi(); ?>
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