<a href="<?php the_permalink();?>"class="content-items" title="<?php the_title();?> - <?php echo get_post_meta($post->ID,'phim_en',true);?>">
	<img src="<?php img(120,72);?>" alt="<?php the_title();?>" class="album-img" width="120" height="72" />
	<h2 class="title"><?php the_title();?></h2>
	<ul class="info-des">
                <li>Lượt xem: <?php echo get_post_meta($post->ID, "_count-views_all", true);?></li>
	</ul>
	<p class="btn-registry"><?php echo get_post_meta($post->ID, "tt_gioithieu", true);?></p>
</a>