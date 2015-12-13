<?php get_header();?>
<div class="layout ">
<div class="main">
    <div class="cols-group">
        <div class="col col--size--xs">
            <div id="list_categories2_categories_list_sidebar" class="section side-cats">
			<div id="js-filter-categories-sidebar">
			<div class="side-cats__header">
			<h2 class="side-cats__title">Danh mục phim</h2>
			<div class="side-cats__search">
			<span class="input input--size--m input--width--full">
			<input type="text" placeholder="Type to filter" class="input__control">
			<span class="input__icon"><i class="i i--size--m"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#i--magnify"/></svg></i></span></span></div>
			<div class="side-cats__sort"><span class="select select--size--m select--width--full"><select class="select__control"><option selected="" value="title">Alphabetical</option><option value="avg_videos_popularity">Most popular</option><option value="total_videos">Number of Videos</option></select></span></div>
			<div class="side-cats__reset-filter"><a href="/categories/" class="btn btn--size--m btn--width--full"> <span class="btn__text">Reset filter</span><i class="i i--size--m"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#i--filter-remove"/></svg></i></a></div>
			</div>
			</div></div>
        </div>
        <div class="col col--size--xl">
                            <div id="list_videos2_videos_list" class="section">
    <div class="section__inner">
<div class="section-header">
<div class="section-header__top">
<div class="section-header__left"><div class="section-header__title"><h1><?php echo get_cat_name($cat);?></h1></div></div>
</div></div><div class="thumb-grid">

<?php while (have_posts()) : the_post(); ?>
<div class="thumb-grid__item"><div data-video-id="1238793" class="thumb thumb--video js-thumb">

            <button data-uk-tooltip="{pos:'bottom'}" data-fav-type="1" data-video-id="1238793" data-action="add_to_favourites" title="Watch later" class="thumb__watch-later btn btn--size--m js-action-add-to-watch-later" type="button">
            <i class="i i--size--s"><svg><use xlink:href="#i--clock"/></svg></i>
        </button>
        <button data-uk-tooltip="{pos:'bottom'}" title="Added to Watch Later" class="thumb__watch-later btn btn--size--m js-action-add-to-watch-later is-hidden" type="button">
            <i class="i i--size--s i--color-green"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#i--check"/></svg></i>
        </button>
    
    <div class="thumb__content">
                <a class="js-thumb-pagination" href="<?php the_permalink();?>">
                    <img width="220" height="165" alt="<?php the_title();?>" src="<?php echo img3(168,250);?>">
                <span class="thumb__hd">
                    <?php echo get_post_meta($post->ID, "phim_hd", true);?>
                </span>
                       
   </a>

    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
                <div class="thumb__duration"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
            </div>
            </div>


    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php if(function_exists('the_views')) { the_views(); } ?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo time_ago(); ?></div>
        </div>
    </div>


    </div>

</div>
<?php endwhile;wp_reset_query();?>
</div>
                
<div id="list_videos2_videos_list_pagination" class="pagination">
<div class="control-group">
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div>
</div>
    </div>
</div>
                    </div>
    </div>
</div>
 <div class="section"><div class="heading heading--dark"></div><div class="desk-list desk-list--inline"><div class="adv_block">
				<div class="heading">
					<div style="padding: 5px;">
					<a href="#"><img src="http://thephoenixspirit.com/wp-content/uploads/2015/07/JulAug2015Banner1250x200.jpg"></a>
				</div>
				</div>
      </div></div></div>
	  </div>
<?php get_footer();?>