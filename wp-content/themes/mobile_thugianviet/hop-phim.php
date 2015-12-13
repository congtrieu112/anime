<?php
/*
Template Name: Hộp Phim
*/
?>
<?php get_header();?>
<?php
$order=$_GET['sort_id'];
$country=$_GET['country_name'];
$year=$_GET['y'];
$theloai=$_GET['theloai'];
if($order) {
$a=array('order'=>$order);
}else{$a=array('order'=>'date');}
if($year) $b=array('meta_key'=>'phim_nsx','meta_value'=>$year);else $b=array();
if($theloai) $d=array('cat'=>$theloai);else $d=array();
if($country!=''){
$c=array('tax_query' => array(
		array(
			'taxonomy' => 'quoc-gia',
			'field' => 'slug',
			'terms' => $country
		)
	),
	)
	;
}else $c=array();
?>
<style>.remove-parent img {
    margin-left: 4px;
    position: absolute;
    top: 0px;
    opacity: 0.8;
    display: block;</style>
    <!--/ Header -->
<!-- Filter -->
        <div class="filter">
        <form method="get" action="/phim-le">
            <div class="content">
            	<div class="title_crum">
                    <span class="title_crum_end"><div class="sprites icons16 icon_blog"></div><h2><?php the_title();?></h2></span>
                </div>
                	<select name="sort_id" id="sort_id" tabindex="1">
                        <option value="">-Mặc định-</option>
			<option value="date" >Mới nhất</option>
			<option value="asc" >Cũ nhất</option>
			<option value="title" >Tiêu đề phim</option>
                    </select>
                  <select name="country_name" id="quocgia_id" tabindex="1">
								<option value="">-- Quốc gia --</option>
                             <?php $qg = get_terms("quoc-gia");
foreach ($qg as $selectqg) {
if ($_GET["country_name"] == $selectqg->slug) { $selected = ' selected="selected"'; } else { $selected = ''; }
echo '<option value="'.$selectqg->slug.'" '.$selected.'>'.$selectqg->name.'</option>';
}
							 ?>
							</select>
							<select name="y" id="namsx_id" tabindex="1">
								<option value="">-Năm-</option>
								<option value="2013">2013</option>
								<option value="2012">2012</option>
								<option value="2011">2011</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
							</select>
  <a href="/top-20-phim/" class="filter_link">Top 20</a>
  <a href="/phim-moi/" class="filter_link">Phim mới</a>
  <a href="/chieu-rap/" class="filter_link">Phim chiếu rạp</a>
						<div class="item">
							<input type="submit" class="filter_submit" value="Duyệt">
						</div>
					</form>
				</div>
				</div>
    <!-- / Filter -->
<!-- Filter -->
<!-- Main -->
    	<div class="main">
        	<div class="content">
                <!-- Content main -->
                	<div class="c_m">
                        <!-- Block new -->
                        	<div class="block_new">
                            	<div class="tabs" id="tabselect-2">
                                    <div id="list-wrap">
<?php wpfp_clear_list_link(); ?>
                                        <div id="tatca" class="tabs_content">
                                            <ul class="l_w_l">
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<?php the_content();?>
<?php endwhile;endif;?>							</ul>
                                            <div class="clr"></div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- / Block new -->
                    </div>
                <!-- / Content main -->
<!-- End Main -->
 <!-- Sidebar -->
                	<?php get_sidebar();?>
                <!-- / Sidebar -->
</div></div></div>
<!-- footer -->
    		<?php get_footer();?>