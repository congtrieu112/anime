<?php get_header();?>

<div class="layout ">
<div class="main">
    <div class="cols-group">
        <div class="col col--size--l">
            <div class="video">
 

  <div class="section section--video">
        	
            <div class="video-info tabs">
               <div class="video-info__container tabs__body section__inner">
                    <div class="phai">
	<div class="container">
    <div id="slides">
      <img src="https://lh6.googleusercontent.com/-XX6UZDEsbsE/U5mFIgIKThI/AAAAAAAACXs/o9Qz3w4h3Mc/24hphim.net-8a79f34e13df2946a6b065505c79779f1373690034_full.jpg" height="450px" alt="anime việt">
      <img src="http://2.bp.blogspot.com/-6Mc5qWIVKJk/Vax3UMLonRI/AAAAAAABBhI/1KhG-xcVkuk/s1600/Anime14-Chaos_Dragon_Sekiryuu_Senyaku.jpg" alt="">
      <img src="http://www.entravity.com/wp-content/uploads/2014/10/Inou-Battle-wa-Nichijou-kei-no-Naka-de-anime.jpg" alt="">
      <img src="https://s-media-cache-ak0.pinimg.com/originals/d5/6c/50/d56c50bf0ed74e8070afdffea37c3966.jpg" alt="">
	  <img src="http://statis.ign.vn/images/upload/2015/01/14/2_phim-manga_manga-nu-hon-phu-thuy-se-chuyen-the-thanh-anime-vao-thang-4-toi_100435.jpg?w=680" alt="">
    </div>
  </div>
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 940,
        height: 720,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    });
  </script>
					</div>
                    <div class="trai">
				
					<div class="thumb-grid">
	<?php 
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts('post_type=post&meta_key=phim_tinhtrang&meta_value=tophot&showposts=8&paged='.$page.'&order=desc');
	while (have_posts()) : the_post(); ?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">

                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                
				</a>

    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>


    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>


    </div>
</div>
<?php endwhile;wp_reset_query();?>
</div>
					
					</div>
                </div>
            </div>
    </div>
            </div>
        </div>

    </div>
    <div class="cols-group">
        <div class="col col--size--wide">
   <ul id="tabs">
    <li><a href="#" name="tab1">Anime mới cập nhật</a></li>
    <li><a href="#" name="tab2">Anime phim lẻ</a></li>
    <li><a href="#" name="tab3">Anime phim bộ</a></li>
    <li><a href="#" name="tab4">Anime Xem nhiều</a></li> 	
</ul>

<div id="content"> 
    <div id="tab1">
	<div class="thumb-grid">
	<?php 										
$phimmoicapnhat = (get_query_var('paged')) ? get_query_var('paged') : 1;										
query_posts('post_type=post&showposts=56&paged='.$phimmoicapnhat);					
while (have_posts()) : the_post(); ?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php endwhile;?>
</div>


	</div>
    <div id="tab2">
	<div class="thumb-grid">
<?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1;	query_posts('post_type=post&showposts=56&meta_key=phim_loai&meta_value=phimle&paged='.$page.'&order=desc');	while (have_posts()) : the_post();?>	

	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php endwhile;?>
</div>
	</div>
    <div id="tab3">
	<div class="thumb-grid">
<?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts('post_type=post&showposts=40&meta_key=phim_loai&meta_value=phimbo&paged='.$page.'&order=desc');
	while (have_posts()) : the_post();
?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php endwhile;?>
</div>
	</div>
	 <div id="tab4">
	<div class="thumb-grid">
<?php 
			$where = "post_type = 'post'";
		$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT 0,40");

	if($most_viewed) { 
		
			 foreach ($most_viewed as $post) { 
				$post_views = number_format_i18n(intval($post->views));
				$post_url = get_permalink($post->ID);
				$post_title = get_the_title();
?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php } 
		
		 }
		 
	?>
</div>
	</div>
</div>
    </div>



</div>
            <div class="section"><div class="heading heading--dark"></div>
			<div class="desk-list desk-list--inline">
			<div class="adv_block">
				<div class="heading">
				<div style="padding: 5px;">
					<a href="#"><img src="http://thephoenixspirit.com/wp-content/uploads/2015/07/JulAug2015Banner1250x200.jpg"></a>
				</div>
				</div>
				
      </div></div></div>
	  </div>
</div>

<?php get_footer();?>