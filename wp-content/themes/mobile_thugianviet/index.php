               <?php get_header();?>
<div class="container " id="fnBody">
                <div class="filter">
                    <ul class="tab-nav">
                        <li><a href="#" class="fnRTTab" id="fnRTTabSong">Phim lẻ</a>
                        </li>
                        <li><a href="#" class="fnRTTab active" id="fnRTTabAlbum">Phim mới</a>
                        </li>
                        <li><a href="#" class="fnRTTab" id="fnRTTabVideo">Phim bộ</a>
                        </li>
                    </ul>
                </div>
                <div class="content" id="fnBodyContent">
				<!-- PHIM LE-->
				
					<div class="tab-content songs fnRTContent none" id="fnRTSong">
<?php 
		 
$args=array(
'post_type' => 'post',
'post_status' => 'publish',
'meta_key'=>'phim_loai',
'meta_value'=>'phimle',
'showposts' => 20,

);
$my_query = null;
$my_query = new WP_Query($args);
?>		<?php if($my_query->have_posts()) : ?>
			<?php $i=1;while ($my_query->have_posts()) : $my_query->the_post();?>	
											
<?php get_template_part( 'loop', get_post_format() ); ?>
<?php $i++;endwhile;?>		<?php endif;?>	
						
						<a href="/phim-le" class="read-more">Xem thêm <i class="icon-dropdown"></i></a>
					</div>	
				<!-- END PHIM LE-->
                    <div class="tab-content songs fnRTContent" id="fnRTAlbum">
					<!-- PHIM MOI-->
 <?php 
		 
$args=array(
'post_type' => 'post',
'post_status' => 'publish',
'showposts' => 20,

);
$my_query = null;
$my_query = new WP_Query($args);
?>		<?php if($my_query->have_posts()) : ?>
			<?php $i=1;while ($my_query->have_posts()) : $my_query->the_post();?>	
											
<?php get_template_part( 'loop', get_post_format() ); ?>
<?php $i++;endwhile;?>		<?php endif;?>	
					
						<a href="/phim-moi" class="read-more">Xem thêm <i class="icon-dropdown"></i></a>
					<!-- END PHIM MOI-->	
                    </div>
                    <div class="tab-content songs fnRTContent none" id="fnRTVideo">
                        <!-- PHIM BO-->
 <?php 
		 
$args=array(
'post_type' => 'post',
'post_status' => 'publish',
'meta_key'=>'phim_loai',
'meta_value'=>'phimbo',
'showposts' => 20,

);
$my_query = null;
$my_query = new WP_Query($args);
?>		<?php if($my_query->have_posts()) : ?>
			<?php $i=1;while ($my_query->have_posts()) : $my_query->the_post();?>	
											
<?php get_template_part( 'loop', get_post_format() ); ?>
<?php $i++;endwhile;?>		<?php endif;?>	
		
				<!-- END PHIM BO-->
						<a href="/phim-bo" class="read-more">Xem thêm <i class="icon-dropdown"></i></a>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#fnRTTabAlbum').on('click', function () {
                            $('#fnRTAlbum').removeClass('none');
                            $('#fnRTSong').addClass('none');
                            $('#fnRTVideo').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                        $('#fnRTTabSong').on('click', function () {
                            $('#fnRTSong').removeClass('none');
                            $('#fnRTAlbum').addClass('none');
                            $('#fnRTVideo').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                        $('#fnRTTabVideo').on('click', function () {
                            $('#fnRTVideo').removeClass('none');
                            $('#fnRTSong').addClass('none');
                            $('#fnRTAlbum').addClass('none');
                            $('.fnRTTab').removeClass('active');
                            $(this).addClass('active');
                            return false;
                        });
                    });
                </script>
            </div>
<?php get_sidebar();?>
<?php get_footer();?>