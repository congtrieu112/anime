<?php
session_start();
error_reporting(0);

if(!empty($_POST)){
    require_once 'class_get.php';
    $get_proxy = new proxy;
    $link_get = $_POST['link'];
    
    // CURL Link
    $curl = $get_proxy->curl($link_get);
    
    // Get Episode
	$ep = explode('<div class="serverlist">',$curl);
	$ep = explode('<div class="block"',$ep[1]);
	$ep = explode('<a data-type="watch',$ep[0]);
    $total_ep = count($ep)-1;
    if(!empty($_POST['start']) && empty($_SESSION['start'])){
		$_SESSION['start'] = $_POST['start'];
	}
    $current = $_POST['start'];
    $filename = md5('datafilm');
    if($current > $total_ep){
		sleep(3);
        $data['status'] = 0;
		$data['link'] =  $_POST['link'];
		$data['total'] = $total_ep;
		$data['start'] = $_SESSION['start'];
		
        $data['html_result'] = '<table class="table"><a href="data/'.$filename.'.txt">Export</a>'; 
        if(!empty($_SESSION['episode'])){
           $ep = count($_SESSION['episode']);
           
           for($i = 1; $i <= $ep; $i++){
                $datafile = $_SESSION['episode']["ep_{$i}"]['ep_name'] .'|'. $_SESSION['episode']["ep_{$i}"]['proxy_link']."\n";
                @file_put_contents('data/'.$filename.'.txt', $datafile, FILE_APPEND);
                $data['html_result'] .= '<tr><td>'.$_SESSION['episode']["ep_{$i}"]['ep_name'].'</td><td><input style="width: 100%;" type="text" onclick="this.select()" value="'.$_SESSION['episode']["ep_{$i}"]['proxy_link'].'" /></td></tr>';
           }
        }
        $data['html_result'] .= '</table>';
        echo json_encode($data);
        
        die;
    }else{
        @unlink('data/'.$filename.'.txt');
    }
    
    
    $ep_name=explode('">',$ep[$current]);
	$ep_name=explode('<',$ep_name[1]);
	$ep_name=$ep_name[0];
	
	$ep_link=explode('href="',$ep[$current]);
	$ep_link=explode('"',$ep_link[1]);
	$ep_link='http://phim3s.net/'.$ep_link[0];
	
	$curl_ep=$get_proxy->curl($ep_link);
	$proxy=explode('proxy.link=',$curl_ep);
	$proxy=explode('&',$proxy[1]);
	$proxy_link=$proxy[0];

    $start = $_POST['start']+1;
    $data['ep_curent'] = $start;
    
	$data['object_result'] = '<object id="mediaplayer'.$start.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="0" height="0">
		<param name="movie" value="player.swf">
		<param name="allowFullScreen" value="true">
		<param name="allowScriptAccess" value="always">
		<param name="FlashVars" value="plugins='.$current.'/'.$ep_name.'/proxy.swf&proxy.link='.$proxy_link.'&proxy.embedid=mediaplayer&proxy.nocachexml=true&proxy.nocacheswf=true" />
		<embed name="mediaplayer" src="player.swf" FlashVars="plugins='.$current.'/'.$ep_name.'/proxy.swf&proxy.link='.$proxy_link.'&proxy.embedid=mediaplayer&proxy.nocachexml=true&proxy.nocacheswf=true" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="0" height="0" />
	</object>';	
   
    $data['link'] = $link_get;
    $data['total'] = $total_ep;
    $data['status'] = 1;
    $data['start'] = $_POST['start'];
    echo json_encode($data);
    
}

?>