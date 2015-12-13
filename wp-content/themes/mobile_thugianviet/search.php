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
							global $wpdb,$post;
							$key=stripslashes(get_ascii(get_search_query()));
							if($check = $wpdb->get_results("select * from wp_posts where post_title_tv like '%$key%' and post_type='post' and post_status='publish' limit 30")){
								if(count($check)>0) { 
									foreach($check as $post){
									get_template_part( 'loop', get_post_format() );
									}
								}
							}elseif($check = $wpdb->get_results("select * from wp_postmeta where meta_key='phim_en' and meta_value like '%$key%' limit 30")){
							foreach($check as $post){ ?>
											
                                                <!-- Lay phim -->												
									
<a href="<?php the_permalink();?>"class="content-items" title="<?php the_title();?> - <?php echo get_post_meta($post->post_id,'phim_en',true);?>">
	<img src="<?php echo get_post_meta($post->post_id,'Image',true);?>" alt="<?php the_title();?>" class="album-img" width="72" height="100" />
	<h2 class="title"><?php the_title();?></h2>
	<h4><?php echo get_post_meta($post->post_id,'phim_en',true);?></h4>
	<ul class="info-des">
		<li>Năm: <?php echo get_post_meta($post->post_id, "phim_nsx", true);?></li>
	</ul>
</a>
                                                <!-- End lay phim -->
                                       <?php }
							}elseif(have_posts()) { ?>							
								<?php while (have_posts()) : the_post();?>
								
								<?php get_template_part( 'loop', get_post_format() ); ?>
								<?php endwhile;?><?php wp_pagenavi();wp_reset_query(); ?>
								<?php } else { ?>
								<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">google.load('search','1',{language:'en'});google.setOnLoadCallback(function(){var customSearchControl=new google.search.CustomSearchControl('005115167086899718601:xcq5fadpstk');customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);customSearchControl.draw('cse');customSearchControl.execute("<?php echo $key;?>");},true);</script>
<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />
								<?php } ?>  
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