<?php get_header();?>
<div id="ourService" class="getlink">
	<div class="blockModule">	
	<?php while (have_posts()) : the_post(); ?>	
		<h1 style="font-size:13px;"><?php the_title();?> <span class="gg"><g:plusone size="small" href="<?php the_permalink();?>"></g:plusone></span></h1>
		<div class="block-cont">
		<!--<script type="text/javascript" src="http://wap.alohot.net/as/clip_banner.js"></script>-->
			<?php the_content();?>
		</div>
	<?php endwhile;wp_reset_query();?>	
	</div>
 </div>	<!-- End Block Module -->
	<!-- End Block Module -->	
<?php get_footer();?>