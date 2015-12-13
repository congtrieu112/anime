<?
function curl($url)
{
    $ch = curl_init(); 
     curl_setopt ($ch, CURLOPT_URL, $url); 
     curl_setopt ($ch, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
     curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
     curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
     $result = curl_exec ($ch);
     curl_close($ch);
return $result;
}
function getStr($source, $start){

		$str = explode($source,$start);
return $str;
}
function auto_post($url,$post_id,$type=''){
$url=curl($url);
$url= explode('<ul class="episodelist">',$url);
$url= explode('</ul>',$url[1]);
$url = str_replace('<blink>','<b>', $url);
$url = str_replace('</a></blink>','</b>', $url);
$url= explode('href="',$url[0]);
$dem=count($url)-1;
?>
<fieldset>

<?
for ($i=1;$i<=$dem;$i++) {

$vip=getStr('"',$url[$i]);
$vip=$vip[0];
$name=getStr('<b>',$url[$i]);
$name=getStr('</b>',$name[1]);
$name=$name[0];
$link = curl($vip);
$link = str_replace('proxy.list','proxy.link', $link);
$url1 = getStr('proxy.link=', $link);
$url1 = getStr('&', $url1[1]);
$url1= $url1[0];
$url2 = curl($url1);
$url2 = getStr('<location><![CDATA[', $url2);
$url2 = getStr(']]></location>', $url2[1]);
$url2= $url2[0];
				if(FilmEpisodeNewEpisode($name,$post_id,$_POST['episode_server'],$url2,$i,time(),$sub)) {
					$tb .= $ten_tap [$j] . ' - ';
					
				}
echo $tb;				
?>
<?

} ?>
</fieldset>
<?php
}
?>