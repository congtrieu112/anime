<?php get_header();?>
        <link href="<?php bloginfo('template_directory');?>/tintuc/style.css" rel="stylesheet">
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
                                            <div id="device">
										<?php while(have_posts()) : the_post();?>
										<?php get_template_part( 'loop-tin-tuc', get_post_format() ); ?>
										<?php endwhile;?>
                                                <!-- Lay phim -->
                                                <!-- End lay phim -->
                                            	<?php wp_pagenavi();wp_reset_query(); ?>
											</div>
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- / Block new -->
<script src="<?php bloginfo('template_directory');?>/tintuc/jquery.js"></script>
        <script src="<?php bloginfo('template_directory');?>/tintuc/jquery.fittext.js"></script>
        <script src="<?php bloginfo('template_directory');?>/tintuc/jquery.grid-a-licious.js"></script>
        <script type="text/javascript">
            var isAbsolute = false;
            var isFixed = true;

            $(document).ready(function () {
                $(window).scroll(function () {
                    //You've scrolled this much:
                    if (($("#device").height() - (($(window).height() / 4) + $("header").height())) <= $(window).scrollTop()) {
                        if (isAbsolute === false) {
                            $("header").css({
                                'position': 'absolute',
                                'top': ($(window).scrollTop() + ($(window).height() / 4))
                            });
                            $("#resize_container").fadeOut(400);
                            // $("header").fadeOut(800);
                            isAbsolute = true;
                            isFixed = false;
                        }
                    } else {
                        if (isFixed === false) {
                            $("header").css({
                                'position': 'fixed',
                                'top': ($(window).height() / 4)
                            });
                            $("#resize_container").fadeIn(400);
                            // $("header").fadeIn(800);
                            isAbsolute = false;
                            isFixed = true;
                        }
                    }
                });
                $("#device").gridalicious({
                    gutter: 10,
                    width: 300,
                    animate: true,
                    animationOptions: {
                            speed: 100,
                            duration: 500,
                            complete: onComplete
                    },
                });

                // function not used. 
                function onComplete(data) {
                    
                }


            });
        </script>
                    </div>
                <!-- / Content main -->
<!-- End Main -->
 <!-- Sidebar -->
                	<?php get_sidebar();?>
                <!-- / Sidebar -->
</div></div></div>
<!-- footer -->
    		<?php get_footer();?>