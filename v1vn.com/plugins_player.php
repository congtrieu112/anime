<?php
session_start();
$link = $_POST['url'];

$ep_i=$_GET['ep_i'];
$ep_name=$_GET['ep_name'];
$_SESSION["ep_{$ep_i}"]=array(
	'ep_name'=>$ep_name,
	'proxy_link'=>$link,
);

$_SESSION['proxy_link']=$link;
$useheader = $_POST['iheader'];
$useragent = $_POST['iagent'];
$referer = $_POST['ireferer'];
$autoreferer = $_POST['iautoreferer'];
$usehttpheader = $_POST['ihttpheader'];
$custheader = $_POST['icustheader'];
$ucookie = $_POST['icookie'];
$encoding = $_POST['iencoding'];
$timeout = $_POST['itimeout'];
$follow = $_POST['ifollow'];
$mpost = $_POST['ipost'];
$mpostfield = $_POST['ipostfield'];
$proxytunnel = $_POST['iproxytunnel'];
$proxytype = $_POST['iproxytype'];
$proxyport = $_POST['iproxyport'];
$proxyip = $_POST['iproxyip'];
$sslverify = $_POST['isslverify'];
$nobody = $_POST['inobody'];

function get_curl($url)
{
	global $useheader,$useragent,$referer,$autoreferer,$usehttpheader,$custheader,$ucookie,$encoding,$timeout,$follow,$mpost,$mpostfield,$proxytunnel,$proxytype,$proxyport,$proxyip,$sslverify,$nobody;
	$curl = curl_init();
	$header[0] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Keep-Alive: 115";
	$header[] = "Connection: keep-alive";
	if($custheader!=""){$header[] = $custheader;}
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	if($useheader=="true"){curl_setopt($curl, CURLOPT_HEADER, 1);}
	if($useragent!=""){curl_setopt($curl, CURLOPT_USERAGENT, $useragent);}
	if($usehttpheader=="true"){curl_setopt($curl, CURLOPT_HTTPHEADER, $header);}
	if($ucookie!=""){curl_setopt($curl, CURLOPT_COOKIE, str_replace('\\"','"',$ucookie));}
	if($referer!=""){curl_setopt($curl, CURLOPT_REFERER, $referer);}
	if($autoreferer=="true"){curl_setopt($curl, CURLOPT_AUTOREFERER, 1);}
	if($encoding!=""){curl_setopt($curl, CURLOPT_ENCODING, $encoding);}
	if($timeout!=""){curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);}
	if($follow=="true"){curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);}
	if($mpost=="true"){curl_setopt($curl, CURLOPT_POST, 1);}
	if($mpostfield!=""){curl_setopt($curl, CURLOPT_POSTFIELDS, $mpostfield);}
	if($proxytunnel=="true"){curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);}
	if($proxytype=="http"){curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);}
	if($proxyip=="socks5"){curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);}
	if($proxyport!=""){curl_setopt($curl, CURLOPT_PROXYPORT, $proxyport);}
	if($proxyip!=""){curl_setopt($curl, CURLOPT_PROXY, $proxyip);}
	if($nobody=="true"){curl_setopt($curl, CURLOPT_NOBODY, 1);}
	if($sslverify=="true"){
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	}

	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}

$fileout = $_GET['f'];
$filelength = $_GET['l'];
$filestream = $_GET['start'];
if($link!=""){
	$text = get_curl($link); 
	if(strpos($link,"picasaweb.google.com/lh/photo")>0){
		$arrc = explode('"media":{"content":[{',$text);
		$arrc = explode('}],"title":"',$arrc[1]);
		$text = 'content":[{'.$arrc[0];
	}
	echo $text;
}

?> 