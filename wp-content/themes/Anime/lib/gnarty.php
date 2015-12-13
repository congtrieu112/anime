<?php
add_action( 'admin_menu', 'register_gnarty_menu_page' );

function register_gnarty_menu_page(){
    add_menu_page( 'Grab link phim', 'Grab link phim', 'manage_options', 'lib/grab-phim.php', 'gnarty_menu_page_cb' );
}

function multi_between($str, $start, $end)
	{
		$ex = explode($start, $str);
		$result = array();
		$count = count($ex) - 1;
		for($i = 1; $i <= $count; $i++)
		{
			$ex2 = explode($end, $ex[$i]);
			$result[] = $ex2[0];
		}
		return $result;
	}

function gnarty_menu_page_cb()
{
	global $wpdb;
	if(isset($_POST['ok']))
	{
		if ($_POST['webgrab'] == 'phimletvn') {
			$info_url_html = xem_web($_POST['urlgrab']);
			$url_play = explode('<a rel="nofollow" href="/xem-', $info_url_html);
			$total_play = count($url_play);
			$total_plays = $total_play-1;

			$info_name = explode('<h1 class="title">', $info_url_html);
			$info_name = explode('</h1>', $info_name[1]);
			$info_name_en = explode('<h2 class="title gray maggin_bottom_10">', $info_url_html);
			$info_name_en = explode('</h2>', $info_name_en[1]);
			$info_dienvien = explode('<div class="grid_2 omega label">Diễn viên:</div><div class="grid_7 alpha">', $info_url_html);
			$info_dienvien = explode('</div>', $info_dienvien[1]);
			$info_nam = explode('Phát hành: <strong>', $info_url_html);
			$info_nam = explode('</strong></li>', $info_nam[1]);
			$info_sx = explode('Sản xuất: <strong>', $info_url_html);
			$info_sx = explode('</strong></li>', $info_sx[1]);
			$info_time = explode('<div class="row bg_2 clearfix"><div class="grid_2 omega label">Tập:</div><div class="grid_7 alpha">', $info_url_html);
			$info_time = explode('</div>', $info_time[1]);
			$info_tt = explode('<div class="grid_2 omega label">Giới thiệu:</div>', $info_url_html);
			$info_tt = explode('</div>', $info_tt[1]);
			$info_tag	=	get_ascii($info_name[0].", ".$info_name_en[0]);
		}
		
		else if ($_POST['webgrab'] == 'tvphimhd') {
			$info_url_html = $html = xem_web($_POST['urlgrab']);
			$vantoan = explode('[id]', $info_url_html);
			$vantoan = explode('|[/id]', $vantoan[1]);
			$vantoan = $vantoan[0];
			$s = explode('|',$vantoan);
			$total_plays = count($s);

			$info_name[0] = explode_by("<title>Xem phim ","-",$html, true);
			$info_name_en = explode('<div class="mota-right"><h2>', $info_url_html);
			$info_name_en = explode('</h2>', $info_name_en[1]);
			$info_img = explode('<img class="poster" src="', $info_url_html);
			$info_img = explode('"', $info_img[1]);
			$info_daodien[0] = explode_by("Thời lượng:","Diễn viên:",$html,true);
			$info_dienvien[0] = explode_by("Diễn viên:","Thời lượng:",$html,true);
			$info_time[0] = explode_by("Thời lượng:","Từ khóa:",$html,true);
			$info_nam[0] = explode_by("Năm phát hành:","Đạo diễn:",$html,true);
			$info_tt[0] = explode_by('<div class="description">',"</div>",$html,true);
		}
else if ($_POST['webgrab'] == 'phim3s') {
	$info_url_html = $html = file_get_contents($_POST['urlgrab']);
	$link_watch = explode_by('</div></div><a href="','" class="btn-watch"',$info_url_html);
	$link_watch = 'http://phim3s.net/'.$link_watch;
	$link_watch = file_get_contents($link_watch);
	$ep_list = explode_by('<div class="serverlist">','</ul></div></div>',$link_watch);
	$url_play = explode('<a', $ep_list);
	$total_play = count($url_play);
	$total_plays = $total_play-1;

	$info_name[0] = explode_by("<title>Xem phim"," | ",$html);
	$info_name_en[0] = explode_by(" | ","full HD</title>",$html);
	$info_img[0] = explode_by('<img class="photo" src="','" alt',$html);
	$info_daodien[0] = explode_by("<dt>Đạo diễn:</dt>","<dt>Diễn viên:</dt>",$html,true);
	$info_dienvien[0] = explode_by("<dt>Diễn viên:</dt>","<dt>Thể loại:</dt>",$html,true);
	$info_time[0] = explode_by("<dt>Thời lượng:</dt>","<dt>Lượt xem:</dt>",$html,true);
	$info_nam[0] = explode_by("<p>Năm phát hành: ","</p",$html,true);
	$info_tt[0] = explode_by('<div class="tabs-content" id="info-film">','<div class="tags">',$html,true);
	$info_tag = get_ascii($info_name[0].", ".$info_name_en[0]);
}
		else if ($_POST['webgrab'] == 'xemphimfullhd') {
			$info_url_html = $html = xem_web($_POST['urlgrab']);
			$link_watch = explode_by('<a class="xem w-bt" href="','"',$html, false);
			$link_watch = xem_web($link_watch);
			$ep_list = explode_by('<div class="list_episodes content">','<br class="clr"/>',$link_watch, false);
			$url_play = explode('<a ', $ep_list);
			$total_play = count($url_play);
			$total_plays = $total_play-1;

			$info_name[0] = explode_by("<title>Phim "," | ",$html, false);
			$info_name_en[0] = explode_by(" | "," | ",$html, false);
			$info_img[0] = explode_by('<link href="','"',$html, false);
			$info_daodien[0] = explode_by("<p>Đạo diễn:","</p",$html,true);
			$info_dienvien[0] = explode_by("<p>Diễn viên:","</p",$html,true);
			$info_time[0] = explode_by("<p>Thời lượng:","</p",$html,true);
			$info_nam[0] = explode_by("<p>Năm phát hành: ","</p",$html,true);
			$info_tt[0] = explode_by('<div id="movie_description" class="tab_click entry">',"</div>",$html,true);
		}
		else if ($_POST['webgrab'] == 'phim1k') 
		{
			$info_url_html = $html = curl_by($_POST['urlgrab']);
			//$link_watch = 'http://phim1k.net'.explode_by('href="http://adf.ly/2397534/','"',$html);
			$link_watch = explode_by('href="http://adf.ly/2397534/','"',$html);
			if(substr($link_watch, 0, 7) != 'http://')
	{
		$link_watch = 'http://phim1k.net' . $link_watch;
	}
			$link_watch = curl_by($link_watch);
			$ep_list = explode_by('<div class="server_content">','<div class="f_i_desc">',$link_watch, false);
			$url_play = explode('<a ', $ep_list);
			$total_play = count($url_play);
			$total_plays = $total_play-1;

			$info_name[0] = explode_by("<h1>","</h1>",$html,true);
			$info_name_en[0] = explode_by("<span class=\"f_i_title_en\">","</span>",$html, false);
			$info_img[0] = explode_by('<meta property="og:image" content="','" />',$html, false);
			$info_daodien[0] = explode_by("<strong>Đạo diễn:</strong>","</span",$html,true);
			$info_dienvien[0] = explode_by("<strong>Diễn viên:</strong>","</span",$html,true);
			//$info_time[0] = explode_by("<p>Thời lượng:","</p",$html,true);
			$info_nam[0] = explode_by("<strong>Năm phát hành:</strong>","</span",$html,true);
			$info_tt[0] = explode_by('<div class="content" style="line-height: 20px;">',"</div>",$html,true);
		}
		else if ($_POST['webgrab'] == 'phim14') 
		{
			$info_url_html = $html = curl_by($_POST['urlgrab']);	
			$link_watch = explode_by('<a class="watch_button now" href="','"',$html, false);
			$link_watch = curl_by($link_watch);
			$ep_list = explode_by('<ul id="server_list">','<div class="blockrow blockinfo">',$link_watch, false);
			$url_play = explode('<a ', $ep_list);
			$total_play = count($url_play);
			$total_plays = $total_play-1;


			$info_name[0] = explode_by("<title>Phim ","(",$html, false);
			$info_name_en[0] = explode_by("(",")",$html, false);
			$info_img[0] = explode_by('<div class="thumbnail"><img src="','"',$html, false);
			$info_daodien[0] = explode_by('div class="alt1">Đạo diễn:',"Diễn viên:",$html,true);
			$info_dienvien[0] = explode_by('Diễn viên:',"Thể loại:",$html,true);
			$info_time[0] = explode_by('<div class="alt1">Thời lượng:',"</div",$html,true);
			$info_nam[0] = explode_by('<div class="alt2">Năm phát hành:',"</div",$html,true);
			$info_tt[0] = explode_by('</a></span></div>','<div class="title hr"><span>',$html,true);
		}
		elseif ($_POST['webgrab'] == 'animefc') { 
	$info_url_html = xem_web($_POST['urlgrab']);

	$url_play_phim = explode('<a href="http://animefc.info/xem-phim', $info_url_html);
	$url_play_phim = explode('"', $url_play_phim[1]);
	$url_play_phim = 'http://animefc.info/xem-phim' . $url_play_phim[0];

	$url_play_phim_html = xem_web($url_play_phim);

	$url_play_phim_html = explode_by('<div id="servers" class="serverlist">', '<!-- / server -->', $url_play_phim_html, false);
	$url_play = explode('data-type="watch" class="" href="', $url_play_phim_html);
	//print_r($url_play);exit();
	$total_play = count($url_play);
	$total_plays = $total_play-1;

	$info_img[0] = explode_by('<meta property="og:image" content="','"',$info_url_html, false);

	$info_name = explode('title="Phim ', $info_url_html);
	$info_name = explode('"', $info_name[1]);

	$info_name_en = explode('<h3>', $info_url_html);
	$info_name_en = explode('</h3>', $info_name_en[1]);
	$info_nam = explode('<p>Năm Sản Xuất: <strong>', $info_url_html);
	$info_nam = explode('</strong></p>', $info_nam[1]);
	$info_time = explode('<p>Thời lượng: <strong>', $info_url_html);
	$info_time = explode('</strong></p>', $info_time[1]);
	$info_tt = explode('<div id="noidung" class="tabs_content">', $info_url_html);
	$info_tt = explode('<div class="f_d_tag">', $info_tt[1]);

	$info_tag = explode('<div class="f_d_tag">', $info_url_html);
	$info_tag = explode('</div>', $info_tag[1]);
	$info_tag = str_replace('Tags:', '', $info_tag);
	$info_tag = multi_between('rel="tag">', '</a>', $info_tag);
	$info_tag = implode(', ', $info_tag);

}
		
		
		else if ($_POST['webgrab'] == 'phimbb') 
		{
			$info_url_html = $html = curl_by($_POST['urlgrab']);	
			
			$link_watch = 'http://phimbb.net/xem-phim/' . explode_by('<a href="xem-phim/','"',$html, true);

			$link_watch = curl_by($link_watch);

			$ep_list = explode_by('<div id="servers">','</div>',$link_watch, false);
			$url_play = explode('<a ', $ep_list);
			$total_play = count($url_play);
			$total_plays = $total_play-1;


			$info_name[0] = explode_by("<h1>»","</h1>",$html, false);
			$info_name_en[0] = explode_by("<p class=\"tt-en\">»","</p>",$html, false);
			$info_img = explode('<div class="cover">', $html);
			$info_img = explode('"></a>', $info_img[1]);
			$info_img = explode('<img src="', $info_img[0]);
			$info_img = explode('"', $info_img[1]);
			$info_img[0] = $info_img[0];

			
			$info_daodien[0] = explode_by('<p class="half">» Đạo diễn:', '</p>',$html,true);
			$info_dienvien[0] = explode_by('<p>» Diễn viên: ', '</p>',$html,true);
			//$info_time[0] = explode_by('<div class="alt1">Thời lượng:',"</div",$html,true);
			//$info_nam[0] = explode_by('<div class="alt2">Năm phát hành:',"</div",$html,true);
			$info_tt[0] = explode_by('id="movie_description">','</div>',$html,false);			
			$info_tt[0] = str_replace('PhimBB.Net', '', $info_tt[0]);

		}
		
		else if ($_POST['webgrab'] == 'phimkk') 
		{
			$info_url_html = $html = curl_by($_POST['urlgrab']);	
			
			$link_watch = 'http://phimkk.com/xem-phim/' . explode_by('<a href="xem-phim/','"',$html, true);

			$link_watch = curl_by($link_watch);

			$ep_list = explode_by('<div id="servers">','</div>',$link_watch, false);
			$url_play = explode('<a ', $ep_list);
			$total_play = count($url_play);
			$total_plays = $total_play-1;


			$info_name[0] = explode_by("<h1>»","</h1>",$html, false);
			$info_name_en[0] = explode_by("<p class=\"tt-en\">»","</p>",$html, false);
			$info_img = explode('<div class="cover">', $html);
			$info_img = explode('"></a>', $info_img[1]);
			$info_img = explode('<img src="', $info_img[0]);
			$info_img = explode('"', $info_img[1]);
			$info_img[0] = $info_img[0];

			
			$info_daodien[0] = explode_by('<p class="half">» Đạo diễn:', '</p>',$html,true);
			$info_dienvien[0] = explode_by('<p>» Diễn viên: ', '</p>',$html,true);
			//$info_time[0] = explode_by('<div class="alt1">Thời lượng:',"</div",$html,true);
			//$info_nam[0] = explode_by('<div class="alt2">Năm phát hành:',"</div",$html,true);
			$info_tt[0] = explode_by('id="movie_description">','</div>',$html,false);			
			$info_tt[0] = str_replace('Phimkk.com', '', $info_tt[0]);

		}
		
		
		elseif ($_POST['webgrab'] == 'phim85') {
	$info_url_html = xem_web($_POST['urlgrab']);
	$url_play_phim = explode('<a href="http://www.phim85.com/xem-phim/', $info_url_html);
	$url_play_phim = explode('" alt="', $url_play_phim[1]);
	$url_play_html_phim = 'http://www.phim85.com/xem-phim/'.$url_play_phim[0];
	$url_play_phim = xem_web($url_play_html_phim);
	$url_play = explode('<li class=""><a href="xem-', $url_play_phim);
	$total_play = count($url_play);
	$total_plays = $total_play-1;

	$info_name = explode('<h1>PHIM', $info_url_html);
	$info_name = explode(' - ', $info_name[1]);
	$info_name_en = explode('<a href="year/', $info_name[1]);
	$info_daodien = explode('<dt>Đạo diễn - Director:</dt>', $info_url_html);
	$info_daodien = explode('</dd>', $info_daodien[1]);
	$info_dienvien = explode('<dt>Diễn viên - Stars:</dt>', $info_url_html);
	$info_dienvien = explode('</dd>', $info_dienvien[1]);
	$info_nam = explode('<dt>Năm phát hành - Year:</dt>', $info_url_html);
	$info_nam = explode('</dd>', $info_nam[1]);
	$info_sx = explode('<p class="m-l">Nhà sản xuất: ', $info_url_html);
	$info_sx = explode('</p>', $info_sx[1]);
	$info_time = explode('<dt>Thời lượng - Runtime:</dt>', $info_url_html);
	$info_time = explode('</dd>', $info_time[1]);
	$info_tt = explode('<div style="margin-top:5px;" class="title hr"><span>Nội dung phim:</span></div>', $info_url_html);
	$info_tt = explode('<div class="blocktitle">Phim cùng thể loại</div>', $info_tt[1]);
	$info_tag	=	get_ascii($info_name[0].", ".$info_name_en[0]);
}
elseif ($_POST['webgrab'] == 'congdongvip') {
	$info_url_html = xem_web($_POST['urlgrab']);
	$url_play_phim = explode('<p class="play"><a href="http://phim.congdongvip.com/', $info_url_html);
	$url_play_phim = explode('" title="', $url_play_phim[1]);
	$url_play_html_phim = 'http://phim.congdongvip.com/'.$url_play_phim[0];
	$url_play_phim = xem_web($url_play_html_phim);
	$url_play = explode('" onclick="setupplayer', $url_play_phim);
	$total_play = count($url_play);
	$total_plays = $total_play-1;

	$info_name = explode('<h1><a property="v:title" rel="v:url" title="Phim ', $info_url_html);
	$info_name = explode('" href="/phim/', $info_name[1]);
	$info_name_en = explode('" href="/phim/', $info_name[0]);
	$info_daodien = explode('<p>Đạo diễn: ', $info_url_html);
	$info_daodien = explode('</a></p>', $info_daodien[1]);
	$info_dienvien = explode('<p>Diễn viên:', $info_url_html);
	$info_dienvien = explode('</a></p>', $info_dienvien[1]);
	$info_nam = explode('<p class="m-l">Năm phát hành: ', $info_url_html);
	$info_nam = explode('</p>', $info_nam[1]);
	$info_sx = explode('<p class="m-l">Nhà sản xuất: ', $info_url_html);
	$info_sx = explode('</p>', $info_sx[1]);
	$info_time = explode('<p class="m-l">Thời lượng: ', $info_url_html);
	$info_time = explode('</span></p>', $info_time[1]);
	$info_tt = explode('<div class="icontents row-content">', $info_url_html);
	$info_tt = explode('<div class="xt"><a href="#" id="show-movie-info">', $info_tt[1]);
	$info_tag	=	get_ascii($info_name[0].", ".$info_name_en[0]);
}
elseif ($_POST['webgrab'] == 'phim8') {
	$info_url_html = xem_web($_POST['urlgrab']);
	$url_play_phim = explode('<a href="http://phim8.info/xem-phim/', $info_url_html);
	$url_play_phim = explode('" alt="Xem phim trực tuyến"', $url_play_phim[1]);
	$url_play_html_phim = 'http://phim8.info/xem-phim/'.$url_play_phim[0];
	$url_play_phim = xem_web($url_play_html_phim);
	$url_play = explode('<a href="xem-', $url_play_phim);
	$total_play = count($url_play);
	$total_plays = $total_play-1;

	$info_name = explode('<dt>Tên Phim:</dt>', $info_url_html);
	$info_name = explode(' - ', $info_name[1]);
	$info_name_en = explode(' 2', $info_name[1]);
	$info_daodien = explode('<dt>Đạo diễn:</dt>', $info_url_html);
	$info_daodien = explode('</a></dd>', $info_daodien[1]);
	$info_dienvien = explode('<dt>Diễn viên:</dt>', $info_url_html);
	$info_dienvien = explode('</a></dd>', $info_dienvien[1]);
	$info_nam = explode('<dt>Năm phát hành:</dt>', $info_url_html);
	$info_nam = explode('</a></dd>', $info_nam[1]);
	$info_sx = explode('<dt>Sản xuất:</dt>', $info_url_html);
	$info_sx = explode('</dd>', $info_sx[1]);
	$info_time = explode('<dt>Thời lượng:</dt>', $info_url_html);
	$info_time = explode('</dd>', $info_time[1]);
	$info_tt = explode('NỘI DUNG PHIM</span></div>', $info_url_html);
	$info_tt = explode('<span>Tags:</span>', $info_tt[1]);
	$info_tag	=	get_ascii($info_name[0].", ".$info_name_en[0]);
}		

		$info_tag	=	get_ascii($info_name[0].", ".$info_name_en[0]).", Phim ".$info_name[0].", Phim ".$info_name_en[0].", ".$info_name[0]." vietsub".", ".$info_name_en[0]." vietsub";
		$phimid	=	$_GET['phimid'];
		if(!$phimid) {
			$phimid	=	0;
		}else {
			?>
		    <script type="text/javascript">$(document).ready(function () {$('#addfilm_new').hide();});</script>
		    <?
		}

		$begin = $_POST['episode_begin'];
		$end = $_POST['episode_end'];

		////BEGIN CHECK EPISODE
		if(!is_numeric($begin) && !is_numeric($end)){
		$episode_begin = 1;
		$episode_end = $total_plays;
		}elseif(!is_numeric($begin) && !is_numeric($end)){
		$episode_begin = 1;
		$episode_end = 10;
		}elseif(!is_numeric($begin)){
		$episode_begin = $episode_end = $end;
		}else{
		$episode_begin = $begin; $episode_end = $end;
		}
		////END CHECK EPISODE
		if (!$_POST['last-submit']) {
			?>
				<form name="themeform" enctype="multipart/form-data" method="post"  class="gnarty-grab">
			                    <!-- thong tin bo phim -->
			                    <h1 style="padding: 16px 0px 16px 0px;">Thêm tập phim vào phim có sắn</h1>
			                    <div class="form_item">
										<label>Chọn phim:</label>
										<?=gnarty_acp_film($phimid);?>
								</div>
			                    
			                    <div id="addfilm_new">
			                        <h1 style="padding: 16px 0px 16px 0px;">Thêm phim mới</h1>
			                    <div class="form_item">
			                                <label>Tên bộ phim:</label>
			                                <input type="text" class="flat" size="30" name="tenphim" value="<?=htmltxt($info_name[0])?>"  maxlength="250">
			                        </div>
			                        <div class="form_item">
                                <label>Tên tiếng anh:</label>
                                <input class="flat" size="30" name="tentienganh" value="<?=htmltxt($info_name_en[0])?>"  maxlength="250">
                        </div>
			                        
			                        <div class="form_item">
			                                <label>Đạo diễn:</label>
			                                <input type="text" class="flat" size="30" name="daodien" value="<?=htmltxt($info_daodien[0])?>" maxlength="250">
			                        </div>
			                        <div class="form_item">
			                                <label>Diễn viên:</label>
			                                <input type="text" class="flat" size="30" name="dienvien" value="<?=htmltxt($info_dienvien[0])?>" maxlength="250">
			                        </div>
			                        
			                        <div class="form_item">
			                                <label>Thời lượng:</label>
			                                <input class="flat" size="30" name="thoiluong" value="<?=htmltxt($info_time[0])?>" maxlength="250">
			                        </div>
			                        <div class="form_item">
			                                <label>Năm sản xuất:</label>
			                                <input class="flat" size="30" name="namsanxuat" value="<?=htmltxt($info_nam[0])?>" maxlength="250">
			                        </div>
			                        <div class="form_item">
			                                <label>Chất lượng:</label>
			                                <input class="flat" size="30" name="chatluong" value="HD" maxlength="250">
			                        </div>
			                       <div class="form_item">
										<label>Ảnh </label>
		                                <input value="<?=$info_img[0]?>" id="phimimg_name" name="phimimg_name" type="text" />
		                                <img width="120" height="180" src="<?=$info_img[0]?>" alt="" />
		                        </div>

			                        <table cellpadding="0" cellspacing="0" width="100%">
			                        	<!--
			                        <tr>
			                            <td class="form_item" width="180">Thể loại:</td>
			                            <td class="form_item"><?php //echo ipos_category($theloai);?></td>
			                        </tr>-->
			                        </table>
			                        <div class="form_item">
			                                <label>Giới thiệu phim:</label>
			                                <textarea name="phimtxt" style="width:630px; height: 130px;"><?=htmltxt($info_tt[0])?></textarea>
			                        </div>
			                        <div class="form_item">
			                                <label>Từ khóa tìm kiếm:</label>
			                                <textarea name="phimtag" style="width:630px; height: 70px;"><?=htmltxt($info_tag)?></textarea>
			                        </div>
			                    </div>
			                    <?php if(isset($url_play)):?>
			                    	<div class="form_item">
			                        	<strong>Link debug (cho dễ xem số tập)</strong>
			                        	<pre><?php print_r($url_play);?></pre>
			                        </div>
			                    <?php endif;?>
			                    <!--
			                   <div class="form_item">
			                                <label>Server chưa phim:</label>
			                               	<?php // echo ipos_set_type();?>
			                    </div>-->
			                    <table cellpadding="0" cellspacing="0" width="100%">
			                    <tr><td colspan="3"><h1 style="padding: 16px 0px 16px 0px;">Danh sách tập phim</h1></td></tr>
								<?php
								if(isset($_POST['webgrab']))
								{
									$from = (int)$_POST['from'];
									$to = (int)$_POST['to'];
									if( ! ($from == -1 && $to == -1))
									{
										$episode_begin = $from;
										$episode_end = $to;
									}
								}
								/*
								var_dump($episode_begin);
								var_dump($episode_end);
								exit();
								*/
			                    for ($i = $episode_begin; $i <= $episode_end; $i++) {

										if ($_POST['webgrab'] == 'phimletvn') {
											$play_url = explode('phim-', $url_play[$i]);
											$play_url = explode('.let" class="button">', $play_url[1]);
											$play_url = 'http://phim.let.vn/xem-phim-'.$play_url[0].'.let';
											$html_link_play = xem_web($play_url);
											
											$link_phim = explode('<div class="maggin_top_5"><a href="', $html_link_play);
											$link_phim = explode('"', $link_phim[1]);
											$link_phim = $link_phim[0];

											$play_embed[$i] = $link_phim;
											$name = explode('class="button"><span>', $url_play[$i]);
											$name = explode('</span></a>', $name[1]);
										}
										else if ($_POST['webgrab'] == 'tvphimhd') {
											$num = $i - 1;
											$play_url = explode(';', $s[$num]);
											$play_embed[$i] = trim($play_url[1]);
											$name[0] = trim($play_url[0]);
										}
										else if ($_POST['webgrab'] == 'xemphimfullhd') {

											$name[0] = explode_by('">','</a>',$url_play[$i], true);
											$link_m = explode_by('href="','"',$url_play[$i], true);
											$link_m = str_replace("http://xemphimfullhd.com/", "http://m.xemphimfullhd.com/", $link_m);
											$html_link = curl_by($link_m);

											$link_m = explode_by('http://xemphimfullhd.com/play.php?url=',"'",$html_link, false);
											if(!$link_m) $link_m = explode_by('?file=',"'",$html_link);
											$play_embed[$i] = $link_m;
									
										}
										else if ($_POST['webgrab'] == 'phim1k') {
											$name[0] = explode_by('class="">','</a>',$url_play[$i],true);
											$link_m = "http://phim1k.net".explode_by('href="','"',$url_play[$i], false);
											$html_link = curl_by($link_m);
											$link_m = explode_by('proxy.link=',"&",$html_link, false);
											if(!$link_m) {
												$idytb = explode_by('allowfullscreen="" src="','&',$html_link, false);
												$idytb = explode_by('embed/','?s',$idytb, false);
												if($idytb) $link_m = "http://www.youtube.com/v/$idytb";
												else $link_m = explode_by('<embed src="','"',$html_link);
											}
											$play_embed[$i] = $link_m;
										}
										elseif ($_POST['webgrab'] == 'phim14') {
											$name[0] = explode_by('">','</a>',$url_play[$i],true);
											$link_m = explode_by('href="','"',$url_play[$i], false);
											$html_link = curl_by(str_replace("phim14.net","m.phim14.net",$link_m));
											$link_m = explode_by('vantoan|||',".mp4",$html_link, false);
											$link_m = base64_decode($link_m);
											$play_embed[$i] = $link_m;
										}
										elseif ($_POST['webgrab'] == 'phim85') {
							$play_url = explode('phim', $url_play[$i]);
							$play_url = explode('">', $play_url[1]);
							$play_url = 'http://www.phim85.com/xem-phim'.$play_url[0];
							$html_link_play = xem_web($play_url);
							$link_phim = explode('proxy.link=', $html_link_play);
							$link_phim = explode('&', $link_phim[1]);
							$link_phim = $link_phim[0];
							$html_link_play_2 = xem_web($url_play_html_phim);
							$link_phim_2 = explode('proxy.link=', $html_link_play_2);
							$link_phim_2 = explode('&', $link_phim_2[1]);
							$link_phim_2 = $link_phim_2[0];
							if ($i == 1) { $play_embed[$i] = $link_phim_2;
							$name = explode('"><font color="#00FF00">[', $url_play[$i]);
							$name = explode(']</font>', $name[1]);
							}else {$play_embed[$i] = $link_phim;
							$name = explode('.html"><b>', $url_play[$i]);
							$name = explode('</b></a>', $name[1]);
							}
						}
						elseif ($_POST['webgrab'] == 'phim8') {
							$play_url = explode('phim/', $url_play[$i]);
							$play_url = explode('">', $play_url[1]);
							$play_url = 'http://phim8.info/xem-phim/'.$play_url[0];
							$html_link_play = xem_web($play_url);
							$link_phim = explode('proxy.link=', $html_link_play);
							$link_phim = explode('&', $link_phim[1]);
							$link_phim = $link_phim[0];
							$html_link_play_2 = xem_web($url_play_html_phim);
							$link_phim_2 = explode('proxy.link=', $html_link_play_2);
							$link_phim_2 = explode('&', $link_phim_2[1]);
							$link_phim_2 = $link_phim_2[0];
							if ($i == 1) { $play_embed[$i] = $link_phim_2;
							$name = explode('<font color="#00FF00">[', $url_play[$i]);
							$name = explode(']</font>', $name[1]);
							}else {$play_embed[$i] = $link_phim;
							$name = explode('.html"><b>', $url_play[$i]);
							$name = explode('</b></a>', $name[1]);
							}
						}
						else if($_POST['webgrab'] == 'animefc') {
							$name[0] = explode_by('">','</a>',$url_play[$i],true);
							$link = explode('"', $url_play[$i]);

							$html_link = xem_web($link[0]);
							$linkphim = explode('"proxy.link":"', $html_link);
							$linkphim = explode('"', $linkphim[1]);
							$play_embed[$i] = $linkphim[0];
						}
			
						
						elseif ($_POST['webgrab'] == 'congdongvip') {
							$play_url = explode('(', $url_play[$i]);
							$play_url = explode(',', $play_url[1]);
							$play_url = 'http://phim.congdongvip.com/xml/'.$play_url[0].'.xml';
							$html_link_play = xem_web($play_url);
							$link_phim = explode('<location>', $html_link_play);
							$link_phim = explode('</location>', $link_phim[1]);
							$link_phim = $link_phim[0];
							$play_embed[$i] = $link_phim;
							$name_play = explode('<title>', $html_link_play);
							$name = explode('</title>', $name_play[1]);
						}
						
						elseif ($_POST['webgrab'] == 'phimkk') 
										{
											$name[0] = explode_by('html">','</a>',$url_play[$i],false);
											//exit('aaaaa' . $url_play[$i]);exit();
											
											$name[0] = strip_tags($name[0]);
											$name[0] = str_replace(array('[', ']'), '', $name[0]);

											$link_m = 'http://phimkk.com/' . str_replace(' ', '%20', explode_by('href="','"',$url_play[$i], false));
											
											$html_link = curl_by($link_m);

											$play_embed[$i] = explode_by('&file=', "&amp;", $html_link, false);
											if(empty($play_embed[$i]))
											{
												$url = explode_by('<div id="mediaplayer"', '</div>', $html_link, false);
												$play_embed[$i] = explode_by('src=\'', '\'', $url, false);
											}

										}
										
										elseif ($_POST['webgrab'] == 'phimbb') 
										{
											$name[0] = explode_by('html">','</a>',$url_play[$i],false);
											//exit('aaaaa' . $url_play[$i]);exit();
											
											$name[0] = strip_tags($name[0]);
											$name[0] = str_replace(array('[', ']'), '', $name[0]);

											$link_m = 'http://phimbb.net/' . str_replace(' ', '%20', explode_by('href="','"',$url_play[$i], false));
											
											$html_link = curl_by($link_m);

											$play_embed[$i] = explode_by('&file=', "&amp;", $html_link, false);
											if(empty($play_embed[$i]))
											{
												$url = explode_by('<div id="mediaplayer"', '</div>', $html_link, false);
												$play_embed[$i] = explode_by('src=\'', '\'', $url, false);
											}

										}
									$sub	= htmlchars(stripslashes(trim(urldecode($sub))));
									$is_sub = (preg_match("#no_sub([^/]+)#",$sub));
									if($is_sub)	$linksub	=	'';
									else	$linksub = $sub;

									$play_embed[$i]	=	htmlchars(stripslashes(trim(urldecode($play_embed[$i]))));

			                    ?>
			                    <tr>
			                    <td class="form_item" width="12%">
			                    TẬP <input onclick="this.select()" type="text" name="name[<?=$i?>]" value="<?=$name[0]?>" size="2" style="text-align:center; width: 40px;">
			                    </td>
			                    <td class="form_item"  width="50%">
			                   
			                    <p class="url"><span>FULL</span><input type="text" name="url[<?=$i?>]" size="50" value="<?=$play_embed[$i]?>"></p>
			                    </td>
			                    <td class="form_item"  width="32%">SUB <input type="text" name="sub[<?=$i?>]" style="width:210px;" value="<?=$linksub?>"></td>
			                    </tr>
			                    <?php
			                    }
			                    ?>
			                    </table>
								<div class="form_item">
										 <input type="hidden" name="episode_begin" value="<?=$episode_begin?>">
			                                <input type="hidden" name="episode_end" value="<?=$episode_end?>">
			                                <input type="hidden" name="from" value="<?=$from?>">
                                			<input type="hidden" name="to" value="<?=$to?>">
			                                <input type="hidden" name="ok" value="SUBMIT">
											<button class="button button-primary" value="Submit" name="last-submit" type="submit">Gửi đi</button>
									</div>
								</form>
			<?php
		}
		//last-submit
		
		{
			$currentUser = wp_get_current_user();
			//Thêm phim mới
			if($_POST['film'] == 'dont_edit')
			{
				$arr = array('post_title'	 =>	$_POST['tenphim'],
							 'post_content'	 =>	$_POST['phimtxt'],
							 'post_status'   => 'draft',
  							 'post_author'   => $currentUser->ID);
				$newPostID = wp_insert_post($arr);
				$linkphim = array();
				$stt = 0;
				foreach($_POST['name'] as $k => $val)
				{
					if(isset($_POST['url'][$k]) && !empty($_POST['url'][$k]))
					{
						$linkphim[$stt] = $val . '#' . $_POST['url'][$k] . '#' . $stt; 
						$stt++;
					}
				}
				update_post_meta( $newPostID, 'phim_en', $_POST['tentienganh']);
				update_post_meta( $newPostID, 'phim_tl', $_POST['thoiluong']);
				update_post_meta( $newPostID, 'phim_nsx', $_POST['namsanxuat']);
				update_post_meta( $newPostID, 'phim_hd', $_POST['chatluong']);
				update_post_meta( $newPostID, 'Image', $_POST['phimimg_name']);
				
				//update tags, dien vien
				wp_set_object_terms( $newPostID, explode(',', $_POST['phimtag']), 'post_tag', true );
				wp_set_object_terms( $newPostID, explode(',', $_POST['dienvien']), 'dien-vien', true );
				//end update tags, dien vien
				if(check_fiml_meta($newPostID)==false) {add_film_meta($newPostID);}
				$meta_value=implode("\n", $linkphim);
				$data=explode('|',$meta_value);	
				if ($meta_value!="") 
				{
					$episode_post = implode("\n", $linkphim);
					$episode_film=$newPostID;			
					$list_episode = explode ( "\n", $episode_post );
					$count_ep = count ( $list_episode );
			
					for($i = 0; $i < $count_ep; $i ++) {
						$tap [$i] = explode ( '#', trim ( $list_episode [$i] ) );
						$ten_tap [$i] = trim ( $tap [$i] [0] );
						$link_tap [$i] = trim ( $tap [$i] [1] );
						$thu_tu [$i] = trim ( $tap [$i] [2] );
						if(FilmEpisodeNewEpisode($ten_tap [$i],$newPostID,0,$link_tap [$i],$thu_tu [$i],time())) 
						{
							//$tb .= $ten_tap [$i] . ' - ';
						}
						else 
						{
							echo '<div id="message" class="error fade" style="background-color: rgb(218, 79, 33);"><br/><b>L?i ! t?p '.$ten_tap [$i].' server '.$_POST['episode_server'].' d� t?n t?i</b><br/><br/></div>';
						}
					}
			
				}
				 
				wp_safe_redirect(admin_url('post.php?post='.$newPostID.'&action=edit', 'Đã thêm xong'));
			}
			//end thêm phim mới
			else //update link phim
			{
				$postID = $_POST['film'];
				$linkphim = array();
				$stt = 0;
				foreach($_POST['name'] as $k => $val)
				{
					if(isset($_POST['url'][$k]) && !empty($_POST['url'][$k]))
					{
						$linkphim[$stt] = $val . '#' . $_POST['url'][$k] . '#' . $stt; 
						$stt++;
					}
				}
				$from = $_POST['from'];
				$to = $_POST['to'];
				//xóa tập phim cũ
				if($from == -1 && $to == -1)
				{
					$wpdb->delete($wpdb->prefix . 'film_episode', array('episode_film'	=>	$postID));
				}
				if(check_fiml_meta($postID)==false) {add_film_meta($postID);}
				$meta_value=implode("\n", $linkphim);
				$data=explode('|',$meta_value);	
				if ($meta_value!="") 
				{
					$episode_post = implode("\n", $linkphim);
					$episode_film=$postID;			
					$list_episode = explode ( "\n", $episode_post );
					$count_ep = count ( $list_episode );
			
					for($i = 0; $i < $count_ep; $i ++) {
						$tap [$i] = explode ( '#', trim ( $list_episode [$i] ) );
						$ten_tap [$i] = trim ( $tap [$i] [0] );
						$link_tap [$i] = trim ( $tap [$i] [1] );
						$thu_tu [$i] = trim ( $tap [$i] [2] );
						if(FilmEpisodeNewEpisode($ten_tap [$i],$postID,0,$link_tap [$i],$thu_tu [$i],time())) 
						{
							//$tb .= $ten_tap [$i] . ' - ';
						}
						else 
						{
							echo '<div id="message" class="error fade" style="background-color: rgb(218, 79, 33);"><br/><b>L?i ! t?p '.$ten_tap [$i].' server '.$_POST['episode_server'].' d� t?n t?i</b><br/><br/></div>';
						}
					}
			
				}
				wp_update_post(array('ID'           => $postID));
				wp_safe_redirect(admin_url('post.php?post='.$postID.'&action=edit', 'Đã thêm xong'));

			}
			//end update link phim
		}
	}
	else
	{
	?>
	<form action="" method="post" class="gnarty-grab">
					<h1 style="padding: 16px 0px 16px 0px;">Grab link</h1>
					<div class="form_item">
							<label>Website:</label>
							<select name="webgrab">
									<option value="phim3s">Phim3s.net</option>
									<option value="phimletvn">Phim.Let.Vn</option>
									<option value="tvphimhd">tvphimhd.Com</option>
									<option value="xemphimfullhd">xemphimfullhd.com</option>
									<option value="phim1k">phim1k.net</option>
									<option value="phim14">phim14.net</option>	
									<option value="phimbb">phimbb.net</option>	
									<option value="phimkk">phimkk.com</option>
									<option value="phim85">phim85.com</option>	
									<option value="phim8">phim8.info</option>
									<option value="congdongvip">phim.congdongvip.com</option>
									<option value="animefc">animefc.info</option>
									
							</select>  
						</div>
					
						<div class="form_item">
							<label>Link:</label>
							<input maxlength="250" onclick="this.select()" value="Điền link vào đây" name="urlgrab" size="30" class="flat" type="text" />
						</div>
						<div class="form_item">
							<label>Get từ tập : </label>
							<input type="text" name="from" value="-1" size="5" style="width:50px;" />
						</div>
						<div class="form_item">
							<label>Đến tập : </label>
							<input type="text" name="to" value="-1" size="5" style="width:50px;" /><br />
							<i>Nếu để cả 2 ô là <strong>-1</strong> thì sẽ lấy tất cả tập phim,sau đó xóa hết các tập phim cũ và thêm mới.</i>
						</div>
 						<div class="form_item">
							<input class="button button-primary button-large" type="submit" name="ok" value="Submit" />
						</div>
	</form>
	<?php
	}
}
// ==================================================================
//
// Add wp_header
//
// ------------------------------------------------------------------
add_action('admin_init', 'gnarty_wp_head' );
function gnarty_wp_head()
{
	?>
	<style type="text/css">
		.gnarty-grab label {
			display: inline-block;
			width: 100px;	
		}
		.gnarty-grab .form_item {
			margin: 0 0 10px 0;
		}
		.gnarty-grab input[type="text"], .gnarty-grab select {
			width: 300px;
		}
	</style>
	<?php
}
// ==================================================================
//
// Support functions
//
// ------------------------------------------------------------------
function xem_web($url)
{
	$html =  file_get_contents($url);
	if(empty($html))
	{
		$html = curl_by($url);
	}
	return $html;
}
function gnarty_acp_film($filmID)
{
	/*
	$html = '';
	$r = new WP_Query(array('post_type'		=>	'post',
							'post_status'	=>	'publish',
							'order_by'		=>	'ID',
							'order'			=>	'DESC',
							'posts_per_page'	=>	-1));
	if($r->have_posts())
	{
		$html .= '<select name="film">';
		$html .= '<option selected="" value="dont_edit" onclick="jQuery(\'#addfilm_new\').slideDown();">Thêm phim mới</option>';
		while($r->have_posts())
		{
			$r->the_post();
			$html .= '<option value="'.get_the_ID().'" onclick="jQuery(\'#addfilm_new\').slideUp();">'.get_the_title().'</option>';
		}
		$html .= '</select>';
	}
	wp_reset_postdata();
	return $html;
	*/
	global $wpdb;
	$sql = mysql_query("SELECT ID, post_title FROM ".$wpdb->prefix."posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_modified DESC") ;
	$html .= '<select name="film">';
	$html .= '<option selected="" value="dont_edit" onclick="jQuery(\'#addfilm_new\').slideDown();">Thêm phim mới</option>';
	while($r = mysql_fetch_assoc($sql))
	{
		$html .= '<option value="'.$r['ID'].'" onclick="jQuery(\'#addfilm_new\').slideUp();">'.$r['post_title'].'</option>';
	}
	$html .= '</select>';
	mysql_free_result($sql);
	return $html;

}
if(!function_exists('htmltxt'))
{
	function htmltxt($document){
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
					   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
					   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
					   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		$text = preg_replace($search, '', $document);
		return $text;
	} 
}
if(!function_exists('explode_by'))
{
	function explode_by($begin,$end,$html,$removehtml) {
		$data = explode($begin,$html);
		$data = explode($end,$data[1]);
		if($removehtml == true) $data[0] = htmltxt($data[0]);
		return $data[0];
	}
}
if(!function_exists('curl_by'))
{
	function curl_by($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 920)');
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
}