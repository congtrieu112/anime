<?php
session_start();
require_once("class_get.php");			$get_proxy=new proxy;
header("content-Type: text/html; charset=utf-8");
$link_get=$_POST['link_get'];
$get=$_POST['get'];
$picasa=$_GET['picasa'];
if($_SESSION['link_film'] && $picasa=='yes'){
	$count_ep=$_SESSION['total_ep'];
	echo '<textarea rows="20" cols="100">';
	for($i=1;$i<=$count_ep;$i++){
		echo $_SESSION["ep_{$i}"]['ep_name'].'#'.$_SESSION["ep_{$i}"]['proxy_link'].'
';
	}
	echo '</textarea>';
	
	echo '<textarea rows="20" cols="100">';
	for($i=1;$i<=$count_ep;$i++){
		echo $_SESSION["ep_{$i}"]['proxy_link'].'
';
	}
	echo '</textarea><br/>';
	echo '<a href="index.php">Quay Lại</a>';
	//session_destroy();
}elseif(!$link_get & !$get){
?>
V1VN.Com => http://v1vn.com/xem-phim-online/hanh-thich-nguy-vuong-400517.html <br/>
P/S: Tools Chỉ Lấy Link Picasaweb
<form method="post">
	Lấy Từ Tập: <input type="text" name="stt" value="1" size="1">
	Nhập Link Xem Phim: <input type="text" name="link_get" size="40">
	<input type="submit" name="get" value="Get">
</form>
<?}elseif($link_get & $get){
	$_SESSION['link_film']=$_POST['link_get'];
	
	$curl=$get_proxy->curl($link_get);
	$ep=explode('<span class="r">',$curl);
	$ep=explode('</span>',$ep[1]);
	$ep=explode('<a',$ep[0]);
	$count_ep=count($ep)-1;
	$_SESSION['total_ep']=$count_ep;
	
	echo '<meta http-equiv="refresh" content="20; url=index.php?picasa=yes">Đang lấy link Picasaweb vui lòng đợi 20 giây....';
	$stt=$_POST['stt'];
	$end_stt=$stt+5;
	for($i=$stt;$i<=$end_stt;$i++){
		$ep_name=explode('">',$ep[$i]);
		$ep_name=explode('<',$ep_name[1]);
		$ep_name=$ep_name[0];
		
		$ep_link=explode('href="',$ep[$i]);
		$ep_link=explode('"',$ep_link[1]);
		$ep_link=$ep_link[0];
		
		$curl_ep=$get_proxy->curl($ep_link);
		$proxy=explode('proxy.link=',$curl_ep);
		$proxy=explode('&',$proxy[1]);
		$proxy_link=$proxy[0];
		
		echo '
		<object id="mediaplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="0" height="0">
			<param name="movie" value="player.swf">
			<param name="allowFullScreen" value="true">
			<param name="allowScriptAccess" value="always">
			<param name="FlashVars" value="plugins='.$i.'/'.$ep_name.'/proxy.swf&proxy.link='.$proxy_link.'&proxy.embedid=mediaplayer" />
			<embed name="mediaplayer" src="player.swf" FlashVars="plugins='.$i.'/'.$ep_name.'/proxy.swf&proxy.link='.$proxy_link.'&proxy.embedid=mediaplayer" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="0" height="0" />
		</object>';
		
		$proxy_link1=explode('proxy.link=',$curl);
		$proxy_link1=explode('&',$proxy_link1[1]);
		$proxy_link1=$proxy_link1[0];
		echo '
		<object id="mediaplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="0" height="0">
			<param name="movie" value="player.swf">
			<param name="allowFullScreen" value="true">
			<param name="allowScriptAccess" value="always">
			<param name="FlashVars" value="plugins=1/1/proxy.swf&proxy.link='.$proxy_link1.'&proxy.embedid=mediaplayer" />
			<embed name="mediaplayer" src="player.swf" FlashVars="plugins=1/1/proxy.swf&proxy.link='.$proxy_link1.'&proxy.embedid=mediaplayer" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="0" height="0" />
		</object>';
	}
	
}?>