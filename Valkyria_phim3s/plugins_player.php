<?php
error_reporting(0);
session_start();
function phim3s_decode($str){//Phim3s Decode
	if(stripos($str, $prefix = "https://picasaweb.google.com/phim3s/lh/photo/") === 0){
		$str = substr($str, strlen($prefix));
		$hash = "exGDKpfjJzdrEkNtmQqbMSXThuZWAcOYICoRawUgVHLBysviPlFn";
		$key = "vfHKQBFyJVUsPtuaXWwxMRbIZclnkDALjOEYGqSNhgmipTzeCrdo";
		return base64_decode(strtr(trim($str), $hash, $key));
	}
	return $str;
}
//decode hêre
$link = phim3s_decode($_POST['url']);

$ep_i=$_GET['ep_i'];
$ep_name=$_GET['ep_name'];
$_SESSION['episode']["ep_{$ep_i}"]=array(
	'ep_name'=>$ep_name,
	'proxy_link'=>$link,
);

$_SESSION['loaded'] = 'ádasd';
?> 