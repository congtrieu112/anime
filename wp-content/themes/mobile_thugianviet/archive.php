<?php get_header();?>
	<div id="body-wrap" class="container">
		<div id="content">
			<div class="block" id="page-list">
				<div class="blocktitle breadcrumbs">
					<div class="item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
						<a href="/" title="Xem Phim Nhanh, Xem Phim Online hay nhất" itemprop="url"><span itemprop="title">Xem Phim</span></a>
					</div>
					<h2 itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" class="item last-child"><span itemprop="title"><?php echo get_cat_name($cat);?></span></h2>
				</div>
				
				<div class="blockbody">
					<ul class="list-film">
						<?php while(have_posts()) : the_post();?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
						<?php endwhile;?>
					</ul>
					<div>
						<?php wp_pagenavi();wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar();?>
	</div>
	<div class="container ad_location below_of_content">
	</div>
<?php get_footer();?>