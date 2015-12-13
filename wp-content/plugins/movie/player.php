<?php
include('_grab.php');
function cut_str($str_cut,$str_c,$val)
{	
	$url=explode($str_cut,$str_c);
	$urlv=$url[$val];
	return $urlv;
}


function players($url,$sub=""){
global $wpdb;$type=acp_type($url);


//$url = get_link_total($url);
if($type==11 or $type==101) $player='<iframe width="100%" height="100%" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
elseif($type==96 ) $player='<iframe width="100%" height="100%" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
else

$player = '<script type="text/javascript">
	jwplayer("mediaplayer").setup({
    "flashplayer": "http://player.xixam.com/player.swf",
    "width": "100%",
    "height": "100%",
    "proxy.link": "'.$url.'",
	"repeat": "list",
    "autostart": "true",
	
	

	
"skin":"http://static.mananhnho.net/theme/player/skin/mananhnho/mananhnho.xml",
"controlbar":"bottom",
    "plugins": "captions,timeslidertooltipplugin-2, fbit-1,http://player.xixam.com/plugins5/proxy.swf",
    "captions.file": "$sub",
    "captions.color": "#FFCC00",
    "captions.fontFamily": "Palatino Linotype",
    "captions.fontSize": "16",
	"logo.file":       "http://24hphim.net/player/logo.png",
	"logo.position":       "top-left",
	"logo.margin":       "18",
	"logo.over":       "1",
	"logo.out":       "1",
	"logo.hide":       "false",
	events: {
            onComplete: function autonext() {
	 Phim3s.Watch.autoNextExecute();
}

        }
	});
	</script>';	
	 

	
//$player=base64_encode($player);
  //return '<script type="text/javascript">document.write(player.decode("'.$player.'"));</script>'; 
  return $player;
}




function players2($url,$sub=""){
global $wpdb;$type=acp_type($url);
$url=get_link_total2($url);
if($type==5 || $type==6 || $type==7 || $type==8 || $type==9 || $type==3)
 $player='<video id="my_video_1" class="video-js vjs-default-skin" controls
 preload="auto" width="100%" height="100%" poster="my_video_poster.png"
 data-setup="{}">
 <source src="'.$url.'" type="video/mp4"> 
</video>';
if($type==16)
{$url=explode('video/',$url);$url=explode('_',$url[1]);$url=$url[0];
 $player='<iframe width="100%" height="100%" src="http://www.dailymotion.com/embed/video/'.$url.'" frameborder="0" allowfullscreen></iframe>';}
else $player='<iframe width="100%" height="100%" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';

//$player=base64_encode($player);
  //return '<script type="text/javascript">document.write(player.decode("'.$player.'"));</script>'; 
  return $player;
}
?>