<?php get_header();?>
<div id="nav2"><div class="container"><h1 class="title"><?php the_title();?></h1></div></div>
<div id="body-wrap" class="container">
<div class="ad_location above_of_content container"><img src="http://pagead2.googlesyndication.com/simgad/13079116716950328602" alt="Liên hệ quảng cáo"/></div>
<div id="content"><div class="block" id="page-info" data-film-id="<?php echo $post->ID;?>"><div class="blocktitle breadcrumbs"><?php the_breadcrumb();?></div>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<div class="blockbody">
<div class="detail">
<div class="blocktitle"><h2><?php the_title();?></h2>
</div>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5112753846d6d791"></script>
<!-- AddThis Button END -->
<?php the_content();?>

</div>


</div></div></div>
<?php endwhile;endif;?>
<?php get_sidebar();?>
<?php get_footer();?>