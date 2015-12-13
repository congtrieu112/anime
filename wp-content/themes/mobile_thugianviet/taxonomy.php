<?php get_header();?>
<style>.current{color:black;}
.larger{margin-left:5px;}</style>
<div class="container " id="fnBody">
                <div class="content" id="fnBodyContent">
            <?php while(have_posts()) : the_post();?>
<?php get_template_part('loop',get_post_format);?>
<?php endwhile;?>
</div><script type="text/javascript">
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
                </script></div>
<?php get_sidebar();?>
<?php get_footer();?>