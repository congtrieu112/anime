<?php 
$taxonomy = 'dien-vien';
  $terms = get_the_terms( $post->ID, $taxonomy );
  if ($terms) {
    foreach($terms as $term) {
        $dienvien.= '<span itemprop="actor" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><a href="' . esc_attr(get_term_link($term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" itemprop="url">' . $term->name.'</a></span></span> , ';
    }
  }else $dienvien='N/A';
$daodien = 'dao-dien';
  $terms = get_the_terms( $post->ID, $daodien );
  if ($terms) {
    foreach($terms as $term) {
        $dd.= '<span itemprop="director" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><a href="' . esc_attr(get_term_link($term, $daodien)) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" itemprop="url">' . $term->name.'</a></span></span> , ';
    }
  }  else $dd='N/A';


?>
<?php get_header();?>
<div class="container play-video" id="fnBody">
                <div class="content" id="fnBodyContent">
<?php if(have_posts())	:?>
	<?php while (have_posts()) : the_post(); ?>	
				                    <div class="content-items">
                        <img src="<?php img(120,155);?>" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID,'phim_en',true);?>" class="artist-img" width="120" height="155">
                        <h1><?php the_title();?> - <?php echo get_post_meta($post->ID,'phim_en',true);?></h1>
                        <ul class="info-artist">
                            <li><strong>Thể loại: </strong><?php echo trim($output, $seperator);?></li>
                            <li><strong>Quốc gia: </strong><?php echo get_the_term_list( $post->ID, 'quoc-gia','',', ','');?></li>
                            <li><strong>Đạo diễn: </strong><?php echo $dd;?></li>
                            <li><strong>Diễn viên: </strong><?php echo $dienvien;?></li>
                            <li><strong>Năm sản xuất: </strong><?php echo get_post_meta($post->ID,'phim_nsx',true);?></li>
							<li><strong>Thời lượng: </strong><?php echo get_post_meta($post->ID,'phim_tl',true);?></li>
							<li><strong>Lượt xem: </strong><?php echo get_post_meta($post->ID,'views',true);?></li>
                            <li style="max-height:70px;"><a href="<?php echo xemphim($idphim);?>" class="fnDesktopSwitch button desktop-btn">Xem phim</a>
                            </li>
                        </ul>
<div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px">
<span class="svep">
<?php echo episode_show($idphim);?>
</span>                  </div>
                        <div class="content-items clear_fix img" style="padding: 10px 0;border-top: 1px solid #e5e5e5;border-bottom:none;margin-top:10px">
			<?php the_content();?>
                        </div>
                    </div>
						<?php endwhile;wp_reset_query();?><?php endif;?>	
                    <div class="tab-content">
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
<?php get_sidebar();?>
<?php get_footer();?>