<?php get_header();?>

    <!--/ Header -->
<!-- Filter -->
        <div class="filter">
        
            <div class="content">
            	<div class="title_crum">
                    <span class="title_crum_end"><div class="sprites icons16 icon_blog"></div><h2><?php single_tag_title();?></h2></span>
                </div>
				</div>
				</div>
    <!-- / Filter -->
<!-- Filter -->
<!-- Main -->
    	<div class="main">
        	<div class="content">
                <!-- Content main -->
                	<div class="c_m">
                        <!-- Block new -->
                        	<div class="block_new">
                            	<div class="tabs" id="tabselect-2">
                                    <div id="list-wrap">
                                        <div id="tatca" class="tabs_content">
                                            <ul class="video">
										<?php while(have_posts()) : the_post();?>
										<?php get_template_part( 'loop-video', get_post_format() ); ?>
										<?php endwhile;?>
                                                <!-- Lay phim -->
                                                <!-- End lay phim -->
                                            	<?php wp_pagenavi();wp_reset_query(); ?>
											</ul>
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- / Block new -->
                    </div>
                <!-- / Content main -->
<!-- End Main -->
 <!-- Sidebar -->
                	<?php get_sidebar();?>
                <!-- / Sidebar -->
</div></div></div>
<!-- footer -->
    		<?php get_footer();?>