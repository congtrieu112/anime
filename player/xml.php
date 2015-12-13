<?php
include_once('../wp-config.php');
$film_id=$_GET['film_id'];
$sv_id=$_GET['sv'];
global $wpdb;
header("Cache-Control: private");
header("Pragma: public");
header("Content-Type: application/xml; charset=utf-8");

$xml = '<?xml version="1.0" encoding="UTF-8"?>'.
	'<playlist version="1" xmlns="http://xspf.org/ns/0/">'.
	'<trackList>';
$list=$wpdb->get_results("SELECT episode_id, episode_name, episode_type, episode_url,episode_film,episode_server FROM wp_film_episode WHERE episode_film = '".$film_id."' AND episode_type='".$sv_id."' order by episode_order asc");
foreach ( $list as $value ){
$episode_url=$value->episode_url;
$episode_name=$value->episode_name;
$sub=get_post_meta($film_id, "phim_sub", true);
$xml .= '<track>'.
		'<title><![CDATA['.$episode_name.']]></title>'.
		'<location><![CDATA['.$episode_url.']]></location>'.
		'<captions.file><![CDATA['.$sub.']]></captions.file>'.		
		'</track>';
}
$xml .= '</trackList>'.
	'</playlist>';
echo $xml;


exit();
?>