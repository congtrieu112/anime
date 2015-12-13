<?php get_header();
$url=get_post_meta($post->ID,'phim_trailer',true);
$sub=get_post_meta($post->ID,'video_sub',true);
$idphim=$post->ID;
?>

<?php if(have_posts())	:?>

  <script>
    videojs.options.flash.swf = "/video-js/video-js.swf";
  </script>
<div class="container play-video" id="fnBody">
                <div class="content" id="fnBodyContent">
				                    <div class="content-items">

                    <div class="jp-player-video">
<?php echo players2($url,$sub);?>
</div>
			
		<?php wp_link_pages() ?>
		<?php endif;?>	
	</div>
<div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px">                        <a class="read-more fn-expand" style="border-bottom: 1px solid #e5e5e5;">Nội dung video</a>

<?php if(have_posts())	:?>
	<?php while (have_posts()) : the_post(); ?>	
			<?php the_content();?>						<?php endwhile;wp_reset_query();?><?php endif;?>	

                        </div>
  <div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px">
                        <a class="read-more fn-expand" style="border-bottom: 1px solid #e5e5e5;">Video khác</a>
									
<?php
                $randPosts = new WP_Query();
                $randPosts->query('post_type=video-clip&showposts=15&orderby=rand');
                while($randPosts->have_posts()) : $randPosts->the_post();?>
                <?php get_template_part( 'loop-video', get_post_format() ); ?>           
            <?php endwhile; ?>       	                        
                    </div>
                </div>
            </div>
	<!-- End Block Module -->	
<?php get_footer();?>