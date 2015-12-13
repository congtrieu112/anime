<?php
/*
Template Name: phimle
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
    <!--/ Header -->
<!-- Filter -->
        <div class="filter">
        
            <div class="content">
            	<div class="title_crum">
                    <span class="title_crum_end"><div class="sprites icons16 icon_blog"></div><h2><a title="<?php single_tag_title();?>" href="<?php echo get_permalink($post->ID);?>"><?php single_tag_title();?></a></h2></span>
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
                                            <ul class="l_w_l">
											<?php while(have_posts()) : the_post();?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
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