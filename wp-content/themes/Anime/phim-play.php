
<script type="text/javascript">
function setActive(){aObj=document.getElementById("servers").getElementsByTagName("a");for(i=0;i<aObj.length;i++)0<=document.location.href.indexOf(aObj[i].href)&&(aObj[i].className="active")}window.onload=setActive;
var _setAdsAccountAd123="567";(function(d,j,o,c){if(d.getElementById(j)!=null) return;var a=d.createElement(o),s=d.getElementsByTagName(o)[0];a.id=j;a.src=c;a.type='text/javascript';s.parentNode.insertBefore(a,s);})(document,'ad1688dotnet-analytics-api','script','http://j.ad1688.net/d.js?v=1386557683');
</script>	
<div class="layout ">
<div class="main">
    <div class="cols-group">
        <div class="col col--size--l">
            <div class="video">

  <div class="section section--video">
        	<div class="loadingStatus"></div>
            <div class="player ">
             <div class="player_spot">
                 <div id="media" >
<div class="default-video">
				<div id="mediaplayer"></div>
				<?php echo getlinkphim($idphim,$idtap,$sv,$image,$title,$description,$idtap);?>
			</div>


</div>
              </div>
            </div>
<div class="action">
<div class="add-bookmark"><i></i>Thêm vào hộp </div><div class="like"><i></i><span><?php echo get_total_rating($post->ID,"like");?> Like</span></div><div title="Chức năng tự động chuyển tập tiếp theo khi xem hết 1 tập" class="auto-next">AutoNext: On</div><div class="resize-player">Phóng to</div><div class="turn-light"><i></i><span>Tắt đèn</span></div>
<div class="like-stats hreview-aggregate"><span class="like-icon"></span>Lượt Xem: <span class="votes count"><?php if(function_exists('the_views')) { the_views(); } ?></span>
</div>
<div class="down">
Download phim 
<?php echo get_post_meta($post->ID, "phim_download", true);?> 
			</div>
<center>
	<span><?php if(function_exists('the_ratings')) { the_ratings(); } ?></span></center>
</div>
            <div class="video-info tabs">
            
				
                <div class="video-info__container tabs__body section__inner">
                    <div class="video-info__item tabs__panel tabs__panel--active" id="video-info-tabs-id-tab-0">
                        <div class="video-info__details">
                            <div class="video-info__title">
                                <h1><?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?></h1>
                            </div>
                            </div>
                        <?php echo episode_show($idphim);?>
                        
                    </div>
                    
                    
                </div>
            </div>
    </div>
            </div>
        </div>
        
    </div>
   

<div class="section">
<div class="phai-singer">

<div class="tabs-content" id="info-film">
<div class="tab text">
<?php the_content();?>
<em>Chúc các bạn <a href="<?php the_permalink();?>">xem phim <strong><span style="color: #ff0000;"><?php the_title();?></span></strong></a> vui vẻ.</em>
</div>
</div>
 <div class="comment"><div class="fb-comments" data-href="<?php the_permalink();?>" data-width="650" data-num-posts="5"></div></div>
</div>
<div class="trai-singer">
<div class="cols-group">
        <div class="col col--size--wide">
   <ul id="tabs">
    <li><a href="#" name="tab1">Anime cùng thể loại</a></li> 
</ul>

<div id="content"> 
    <div id="tab1">
	<div class="thumb-grid">
	<?php
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		
			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
'orderby' =>'rand',
				'showposts'=>6, // Number of related posts that will be shown.
				'caller_get_posts'=>1
			);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<ul id="list-movie-update" class="list-film">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php
			}
			echo '</ul>';
			wp_reset_query();
		}
	}
	?>
</div>
	</div>

</div>
    </div>



</div>
<br>
<div class="cols-group">
        <div class="col col--size--wide">
   <ul id="tabs">
    <li><a href="#" name="tab1">Anime Random</a></li> 
</ul>

<div id="content"> 
    <div id="tab1">
	<div class="thumb-grid">
	<?php
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		
			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
'orderby' =>'rand',
				'showposts'=>6, // Number of related posts that will be shown.
				'caller_get_posts'=>1
			);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<ul id="list-movie-update" class="list-film">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
	<div class="thumb-grid__item">
	<div class="thumb thumb--video js-thumb">

    <div class="thumb__content">
                <a href="<?php the_permalink();?>" class="js-thumb-pagination">
                    <img width="140" height="190" alt="<?php the_title();?> - <?php echo get_post_meta($post->ID, "phim_en", true);?>" src="<?php echo img3(150,190);?>">
                </a>
    <div class="thumb-overlay">
      <div class="thumb-overlay__right">
        <div class="thumb__duration"><?php if(function_exists('the_views')) { the_views(); } ?></div>
      </div>
    </div>
    </div>
      <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="thumb__title thumb__title--left link"><?php the_title();?></a>
    <div class="thumb-info">
        <div class="thumb-info__left">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_hd", true);?></div>
        </div>
        <div class="thumb-info__right">
            <div class="thumb-info__text"><?php echo get_post_meta($post->ID, "phim_tl", true); ?></div>
        </div>
    </div>
    </div>
</div>
<?php
			}
			echo '</ul>';
			wp_reset_query();
		}
	}
	?>
</div>
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

<?php if(get_post_meta($post->ID, "phim_loai", true)=="phimbo"){
echo '<script type="text/javascript">				
Phim3s.Watch.checkAndPlayEpisodeViewing();
</script>';
}?>


<script type="text/javascript">
Phim3s.Watch.init('<?php echo $post->ID;?>');

</script>

      </div>
<?php get_footer();?>