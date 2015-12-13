<a href="<?php the_permalink();?>"class="content-items" title="<?php the_title();?> - <?php echo get_post_meta($post->ID,'phim_en',true);?>">
	<img src="<?php img(72,100);?>" alt="<?php the_title();?>" class="album-img" width="72" height="100" />
	<h2 class="title"><?php the_title();?></h2>
	<h4><?php echo get_post_meta($post->ID,'phim_en',true);?></h4>
	<ul class="info-des">
		<li>Năm: <?php echo get_post_meta($post->ID, "phim_nsx", true);?></li>
	</ul>
	<p class="btn-registry"><?php echo get_excerpt_content(40,'',0,$post->post_content);?></p>
</a>