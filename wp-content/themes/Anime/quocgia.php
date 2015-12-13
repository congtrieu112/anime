<?php
/*
Template Name: Quốc gia
*/
?>
<?php


$qg=get_the_title();

?>
<div id="nav2"><div class="container"><h1 class="title"><?php echo get_cat_name($cat);?></h1></div></div>
<div id="body-wrap" class="container"><div id="content"><div class="block" id="page-list">
<div class="blocktitle breadcrumbs"><?php the_breadcrumb();?></div>
<div class="blockbody">
<ul class="list-film">
<?php 

$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts('post_type=post&showposts=40&meta_key=phim_qg&meta_value='.$qg.'&paged='.$page.'&order=desc');
	while (have_posts()) : the_post();
?>
<li><div class="inner"><a data-tooltip="
<span class='title'><?php echo get_the_title() ?></span><br />

Tên Khác : <?php echo get_post_meta($post->ID, "phim_en", true);?><br />

Thời Lượng :<?php echo get_post_meta($post->ID, "phim_tl", true);?><br />
Năm Sản Xuất: <?php echo get_post_meta($post->ID, "phim_nsx", true);?><br /> <br /><hr /><br />
<?php echo get_excerpt_content(40,'',0,$post->post_content);?>
" href="<?php the_permalink();?>" title="<?php the_title();?>"><img src="<?php echo img3(146,195);?>" alt="<?php the_title();?>"/></a><div class="info"><div class="name"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a> </div><div class="name2"><?php echo get_post_meta($post->ID, "phim_en", true);?></div>

<div class="stats"><span class="votes count"><?php if(function_exists('the_views')) { the_views(); } ?></span></div>
<!--<div class="status"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>-->
<div class="f_tag">
	                    <div class="f_t_f"></div>
	                    <div class="f_t_c"><?php echo get_post_meta($post->ID, "phim_hd", true); ?></div>
	                    <div class="f_t_e"></div>
	                    <div class="clr"></div>
	                </div>

	                <div class="f_tag g-year">
                        <div class="f_t_f"></div>
                        <div class="f_t_c"><?php echo get_post_meta($post->ID, "phim_nsx", true); ?></div>
                        <div class="f_t_e"></div>
                        <div class="clr"></div>
                    </div>
</div></li>

<?php endwhile;?>	


</ul><div>
<?php wp_pagenavi(); ?></div></div></div></div>
<?php get_sidebar();?>
<?php get_footer();?>