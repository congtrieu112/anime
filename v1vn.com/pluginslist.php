<?php
session_start();
header("Content-Type: application/xml; charset=utf-8");
$xml.="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml.="<pluginlist loading=\"ABPhim.Com Đang tải phim. Vui lòng đợi giây lát...\">\n";
$xml.="	<plugins url=\"http://v1vn.com/player/plugins/08/gkplugins_license.swf?embedallow=*\"/>\n";
$xml.="	<plugins url=\"http://v1vn.com/player/plugins/08/gkplugins_encode.swf\"/>\n";
$xml.="	<plugins url=\"gkplugins_picasaweb.swf\"/>\n";
$xml.="	<plugins url=\"gkplugins_docsgoogle.swf\"/>\n";
$xml.="	<plugins url=\"gkplugins_plusgoogle.swf\"/>\n";
$xml.="	<plugins url=\"gkplugins_youtube.swf\"/>\n";
$xml.="</pluginlist>";
echo $xml;
?>