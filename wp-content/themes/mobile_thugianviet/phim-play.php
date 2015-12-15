<?php get_header();?>

<?php if(have_posts())	:?>

  <script>
//    videojs.options.flash.swf = "http://thugianviet.net/video-js/video-js.swf";
  </script>
<div class="container play-video" id="fnBody">
                <div class="content" id="fnBodyContent">
				                    <div class="content-items">

                    <div class="jp-player-video" id="play-video">
<?php echo getlinkphimmobile($idphim,$idtap,$sv,$image,$title,$description,$idtap);?>
</div>
			<span class="ver-film">	
<?php echo episode_show($idphim);?>
				  </span>
		<?php wp_link_pages() ?>
		<?php endif;?>	
	</div>

  <div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px">
   


   <a class="read-more fn-expand" style="border-bottom: 1px solid #e5e5e5;">Phim liên quan</a>
									
<?php
				$categories = get_the_category($post->ID);
				if ($categories) {
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
				
					$args=array(
						'category__in' => $category_ids,
						'post__not_in' => array($post->ID),
						'orderby' =>'rand',
						'showposts'=>10, // Number of related posts that will be shown.
						'caller_get_posts'=>1
					);
				$my_query = new wp_query($args);$i=1;
				if( $my_query->have_posts() ) {			
					while ($my_query->have_posts()) {
						$my_query->the_post();
						if($i%2==0) $old='class="odd"';else $old='';
					?>
				<?php get_template_part( 'loop', get_post_format() ); ?>
					<?php
					$i++;}			
					wp_reset_query();
				}
			}
			?>		       	                        
                    </div>
                </div>
            </div>
	<!-- End Block Module -->	
<?php get_footer();?>