<?php 
$taxonomy = 'dien-vien';
  $terms = get_the_terms( $post->ID, $taxonomy );
  if ($terms) {
    foreach($terms as $term) {
        $dienvien.= '<span itemprop="actor" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><a href="' . esc_attr(get_term_link($term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" itemprop="url">' . $term->name.'</a></span></span> , ';
    }
  }else $dienvien='Đang cập nhật';
$daodien = 'dao-dien';
  $terms = get_the_terms( $post->ID, $daodien );
  if ($terms) {
    foreach($terms as $term) {
        $dd.= '<span itemprop="director" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><a href="' . esc_attr(get_term_link($term, $daodien)) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" itemprop="url">' . $term->name.'</a></span></span> , ';
    }
  }  else $dd='Đang cập nhật';
?>
<?php get_header();?>
<div id="body-wrap" class="container">
		<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="block" id="page-info">
				<?php the_breadcrumb();?>
				<div class="blockbody">
				<div itemscope itemtype="http://schema.org/Recipe" style="z-index: -100; width: 1px; height: 1px; left: -1px; top: -1px; visibility: hidden;overflow: hidden; position: absolute;">
<span itemprop="name"><?php the_title();?> - <?php echo get_post_meta($post->ID,'phim_en',true);?></span>
<img itemprop="image" src="<?php echo get_post_meta($post->ID,'Image',true);?>" alt="<?php the_title();?>">
<div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
<span itemprop="ratingValue">9</span>/<span itemprop="bestRating">10</span>
<span itemprop="reviewCount">999</span> bài đánh giá
</div>
</div>
					<div class="info">
						<div class="poster">
							<a href="<?php the_permalink();?>" title="<?php the_title();?>"><img src="<?php echo get_post_meta($post->ID,'Image',true);?>" alt="<?php the_title();?>"></a>
						</div>
						<h2 class="title fr"><?php the_title();?></h2>
						<div class="name2 fr">
							<h3><?php echo get_post_meta($post->ID,'phim_en',true);?></h3>
							<span class="year"><?php echo get_post_meta($post->ID,'nsx',true);?></span>
						</div>
						<div class="dinfo fr">
							<dl class="col1" itemscope itemtype="http://schema.org/Movie">
								<dt>Đạo diễn:</dt>
								<dd><?php echo $dd;?></dd>
								<dt>Diễn viên:</dt>
								<dd><?php echo $dienvien;?></dd>
							</dl>
							<dl class="col2">
								<dt>Thể loại:</dt>
								<dd><?php echo trim($output, $seperator);?></dd>
								<dt>Quốc gia:</dt>
								<dd><?php echo get_the_term_list( $post->ID, 'quoc-gia','',', ','');?></dd>
								<dt>Thời lượng:</dt>
								<dd><?php echo get_post_meta($post->ID,'phim_tl',true);?></dd>
								<dt>Lượt xem:</dt>
								<dd><?php echo get_post_meta($post->ID,'views',true);?></dd>
							</dl>
						</div>

						<div class="btn-groups fr">
							<div class="like-wrap">
								<div class="like-stats">
									<i class="like-icon"></i> Lượt thích: <span class="votes"><?php echo get_total_rating($post->ID,"like");?></span>
								</div>
							</div>
							<a href="<?php echo xemphim($idphim);?>" class="btn-watch" title="<?php the_title();?>"></a>
						</div>
					</div>
					<div class="detail">
						<div class="blocktitle">
							<div class="tabs" data-target="#info-film">
								<div class="tab active" data-name="text">
									Thông tin phim
								</div>
							</div>
						</div>
						<div class="tabs-content" id="info-film">
							<div class="tab text">
								<?php the_content();?>
							</div>
						</div>
						<div class="f_d_tag">
							<?php the_tags('Từ khóa: ',''); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile;endif;wp_reset_query();?>
			<script type="text/javascript">$(document).ready(function(e) {
				if($.browser.msie) {
                	$('a.btn-watch').attr('onclick', "this.style.behavior='url(#default#homepage)';this.setHomePage('http://phimtv.net/?home');");
				}
            });</script>
		</div>
		<?php get_sidebar();?>
	</div>
	<?php get_footer();?>