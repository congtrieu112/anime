<?php
function code($url)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19 ");
return curl_exec($ch);
}
function grab($link) {
	$link = code($link);
	$link=explode('<source src="',$link);
	$link=explode('"',$link[1]);
	$link=$link[0];
 return $link ;
		}
?>
<?
$link= $_GET["link"];
$link = grab($link);
//header ("Location: $link");
echo $link;

function get_link_total($url) {
	//http://movie.zing.vn/Movie/a34682bc.aspx

if (preg_match('#xvideos.com/video([^/]+)\/([^/]+)#', $url, $id_sr)){
		$id = $id_sr[1];$name=$id_sr[2];
		//$url = "http://thugianviet.net/sex-".$id."/".$name.".mp4";
                $url = "xvideos.php?link=http://www.xvideos.com/video".$id."/".$name;
    }

	return $url;
}

function get_link_total2($url) {
	//http://movie.zing.vn/Movie/a34682bc.aspx

if (preg_match('#xvideos.com/video([^/]+)\/([^/]+)#', $url, $id_sr)){
		$id = $id_sr[1];$name=$id_sr[2];
		$url = "http://flashservice.xvideos.com/embedframe/".$id;
    }	

	elseif(preg_match('#tv.zing.vn\/video\/([^/]+)\/([^/]+).html#', $url, $id_sr)) {
		$id=$id_sr[1]."/".$id_sr[2];
		//$url='http://thugianviet.net/zing/'.$id.'.mp4';
$url='grabzing.php?link=http://tv.zing.vn/video/'.$id.'.html';
	}	
    elseif (preg_match("#dailymotion.com/(.*?)#s",$url,$id_sr)) {
		$linkvideo=explode('/', $url);
		$num=count($linkvideo);
		$link=$linkvideo[$num-1];
		$id=explode('_', $link);
		$id=explode('&', $id[0]);
		$link=$mylink.'/daily/'.$id[0].'.flv';
		$url='http://www.dailymotion.com/video/'.$id[0];
		//$url=$web_link.'/'.'player.swf?file='.$link.'&plugins=http://static.hosting.vcmedia.vn/players/plugins/sharePlugin.swf&plugin.chia_se_link='.$link_seo;
		
    }
	
    elseif (preg_match("#youtube.com/watch([^/]+)#",$url,$id_sr)) {
		$id = cut_str('=',$url,1);
		/*$url = "http://www.youtube.com/watch?v=".$id;*/
		
	$url="http://www.youtube.com/embed/".$id;
		
    }
	elseif (preg_match("#youtube.com/v/([^/]+)#",$url,$id_sr)) {
		$id = cut_str('/',$url,4);
		$link="http://www.youtube.com/v/".$id;
		$link="http://www.youtube.com/v/".$id;
		$url="http://www.youtube.com/v/".$id.'&hl=en&fs=1';
		
		
    }
	elseif (preg_match("#youtube.com/view_play_list([^/]+)#",$url,$id_sr)) {
		$id = cut_str('=',$url,1);
		$link=$mylink.'/youtube/playlist/'.$id.'.html';
		$link2=$mylink.'/youtube/playlist/'.$id.'.xml';
		$url=$web_link.'/'.'player.swf?file='.$mylink.'/youtube/playlist/'.$id.'.xml&playlist=over';
    }
elseif(preg_match("#picasaweb.google.com/(.*?)?authkey#",$url, $docs_id)){
$url='http://thugianviet.net/grabpicasa.php?link='.$url;
return $url;

}	
elseif(preg_match("#docs.google.com/file/(.*?)#",$url, $docs_id)){
$url=explode('docs.google.com/file/',$url);
$url=str_replace("edit","preview",$url[1]);
//$url='http://thugianviet.net/link/'.$url.'.mp4';
$url='https://docs.google.com/file/'.$url;
}
elseif(preg_match("#picasaweb.google.com/(.*?)#",$url, $docs_id)){
$url=explode('picasaweb.google.com/',$url);
$url=str_replace('?feat=directlink','',$url[1]);
$url=str_replace('?sv=1','',$url);
$url=str_replace('?sv=2','',$url);
$url=str_replace('?sv=3','',$url);
$url=str_replace('?sv=4','',$url);
//$url='http://thugianviet.net/sv88/'.$url.'.mp4';
$url='http://thugianviet.net/grabpicasa.php?link=https://picasaweb.google.com/'.$url;
}

return $url;
}

?>