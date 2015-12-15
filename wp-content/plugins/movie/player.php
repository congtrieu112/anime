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




function players2($url,$sub="",$image,$title,$description,$postid){
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

$player = '<script type="text/javascript">
      var playerInstance = jwplayer("play-video");
      playerInstance.setup({
        sources: ['.$file.'],
        image: "'.$image.'",
        title: "'.$title.'",
        description: "'.$description.'",
        mediaid: "'.$postid.'"
      });
    </script>';


//$player=base64_encode($player);
  //return '<script type="text/javascript">document.write(player.decode("'.$player.'"));</script>';
  return $player;
}


?>
