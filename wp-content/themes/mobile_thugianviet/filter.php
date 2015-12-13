<div class="filter">
					<form method="get">
						 <div class="content">
							  <div class="filter_name">Lọc Phim</div>
							<select name="sort_id" id="sort_id" tabindex="1">
								<option value="date">-Mặc định-</option>
								<option value="date">Mới nhất</option>
								<option value="asc">Cũ nhất</option>
								<option value="title">Tiêu đề phim</option>
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
 <select name="theloai" id="theloai" tabindex="1">
		<option value="">-- Thể loai --</option>
        <?php $categories = get_categories('hide_empty=1');
        foreach ($categories as $cat) {
        
        $opt = '<option value="' . $cat->cat_ID . '"' . $selected . '>' . $cat->cat_name . '</option>';
        echo $opt; } ?>
        </select>				
							<select name="y" id="namsx_id" tabindex="1">
								<option value="">-Năm-</option>
								<option value="2013">2013</option>
								<option value="2012">2012</option>
								<option value="2011">2011</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
							</select>
						<div class="item">
							<input type="submit" class="filter_submit" value="Duyệt">
						</div>
					</form>
				</div>
				</div>