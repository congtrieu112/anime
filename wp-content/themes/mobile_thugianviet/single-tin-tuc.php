<style>#tintuc img {
    border: 1px solid #CCC;
    padding: 2px;
    max-width: 600px;
    margin: 0px auto;
    display: block;
}</style>
<?php get_header();?>

<div class="container play-video" id="fnBody">
                <div class="content" id="fnBodyContent">
<div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px"> 
<div id="tintuc"> 
<?php if(have_posts())	:?>
	<?php while (have_posts()) : the_post(); ?>	                       
<a class="read-more fn-expand" style="border-bottom: 1px solid #e5e5e5;"><?php the_title();?></a>
<div class="timepost">Cập nhật <?php the_date(); ?></div>
<b><?php echo get_post_meta($post->ID,'tt_gioithieu',true);?></b>

			<?php the_content();?>						<?php endwhile;wp_reset_query();?><?php endif;?>	

                        </div></div>
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