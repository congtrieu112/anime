<?php
include('_grab.php');
function cut_str($str_cut,$str_c,$val)
{
	$url=explode($str_cut,$str_c);
	$urlv=$url[$val];
	return $urlv;
}


function players($url,$sub="",$image,$title,$description,$postid){
global $wpdb;$type=acp_type($url);
if(strpos($url,'picasaweb.google.com')){
    $file =  picasa_web($url);
}elseif(strpos($url,'drive.google.com')||strpos($url,'docs.google.com')){
    $file =  drive_direct($url);
}elseif(strpos($url,'facebook.com')) {
    $file =  get_face_video($_POST['link']);
}elseif(strpos($url,'youtube.com')){
    $file =  get_youtube($url);
}

if($type==11 or $type==101) $player='<iframe width="100%" height="100%" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
elseif($type==96 ) $player='<iframe width="100%" height="100%" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
else


$player = '<script type="text/javascript">
      var playerInstance = jwplayer("mediaplayer");
      playerInstance.setup({
        sources: ['.$file.'],
        image: "'.$image.'",
        width: 670,
        height: 400,
        title: "'.$title.'",
        description: "'.$description.'",
        mediaid: "'.$postid.'"
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
