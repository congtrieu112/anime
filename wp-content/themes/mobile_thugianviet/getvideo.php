<?php

function picasa_web($link) {

  $url = urldecode($link);
  $js = "";
  if (stristr($url, '#'))
    list($url, $id) = explode('#', $url);
  $data = file_get_contents($url);
  if ($id)
    $gach = explode($id, $data);
  $gach = explode('{"url":"', ($id) ? $gach[7] : $data);
  $v360p = urldecode(reset(explode('"', $gach[2])));
  $v720p = urldecode(reset(explode('"', $gach[3])));
  $v1080p = urldecode(reset(explode('"', $gach[4])));
  if (strpos($v1080p, 'redirector.googlevideo.com')) {
    $js .= '{file: "' . $v1080p . '",type:"mp4",label: "1080p"},
                {file: "' . $v720p . '",type:"mp4",label: "720p"},
                {file: "' . $v360p . '",type:"mp4",label: "360p",default: "true"}';
  }
  elseif (strpos($v720p, 'redirector.googlevideo.com')) {
    $js .= '{file: "' . $v720p . '",type:"mp4",label: "720p"},
                {file: "' . $v360p . '",type:"mp4",label: "360p",default: "true"}';
  }
  else {
    $js .= '{file: "' . $v360p . '",type:"mp4"}';
  }


  return $js;
}

function drive_direct($linkf) {


  $get = curl($linkf);
  $cat = explode(',["fmt_stream_map","', $get);
  $cat = explode('"]', $cat[1]);
  $cat = explode(',', $cat[0]);
  foreach ($cat as $link) {
    $cat = explode('|', $link);
    $links = str_replace(array('\u003d', '\u0026'), array('=', '&'), $cat[1]);
    if ($cat[0] == 37) {
      $f1080p = $links;
    }
    if ($cat[0] == 22) {
      $f720p = $links;
    }
    if ($cat[0] == 59) {
      $f480p = $links;
    }
    if ($cat[0] == 43) {
      $f360p = $links;
    }
  }
    if (isset($f1080p)) {
    $res = '{file: "' . $f480p . '",type:"mp4",label: "480p"},
        {file: "' . $f360p . '",type:"mp4",label: "360p"},
                   
                    {file: "' . $f720p . '",type:"mp4",label: "720p"},
                    {file: "' . $f1080p . '",type:"mp4",label: "1080p"}';
  }
  elseif (isset($f720p)) {
    $res = '
                    {file: "' . $f480p . '",type:"mp4",label: "480p"},
                      {file: "' . $f360p . '",type:"mp4",label: "360p"},
                    {file: "' . $f720p . '",type:"mp4",label: "720p"}';
  }
  elseif (isset($f480p)) {
    $res = '{file: "' . $f480p . '",type:"mp4",label: "480p"},
        {file: "' . $f360p . '",type:"mp4",label: "360p"}';
  }
  else {
    $res = '{file: "' . $f360p . '",type:"mp4"}';
  }
  return $res;
}

function get_face_video($link) {
  $url = plugins_url('jw-player-plugin-for-wordpress');
  $html = ",skin: '" . $url . "/skins/vBlue.xml',";
  $links = $link;
  if (strpos($link, 'facebook'))
    $link = explode('/', $link);
  $l = 0;
  foreach ($link as $item) {
    if ($item > 0) {
      $l = $item;
    }
  }
  if ($l == 0) {
    preg_match_all('/v=(.*?)&/i', $links, $match);
    $l = $match[1][0];
  }
  if ($l == "") {
    $l = explode('v=', $links);
    $l = $l[1];
  }
  if ($l == "") {
    $l = explode('/', $links);
    $l = end($l);
  }
  $embed = 'https://www.facebook.com/video/embed?video_id=' . $l;
  $get = $this->curl($embed);

  $data = explode('[["params","', $get);
  $data = explode('"],["', $data[1]);
  $data = str_replace(
      array('\u00257B', '\u002522', '\u00253A', '\u00252C', '\u00255B', '\u00255C\u00252F', '\u00252F', '\u00253F', '\u00253D', '\u002526'), array('{', '"', ':', ',', '[', '\/', '/', '?', '=', '&'), $data[0]
  );

  $HD = explode('[{"hd_src":"', $data);
  $HD = explode('","', $HD[1]);
  $HD = str_replace('\/', '/', $HD[0]);
  $SD = explode('"sd_src":"', $data);
  $SD = explode('","', $SD[1]);
  $SD = str_replace('\/', '/', $SD[0]);

  if ($HD) {
    $js .= '{file: "' . $SD . '",type:"mp4",label: "360p",default: "true"},
                {file: "' . $HD . '",type:"mp4",label: "720p"}';
  }
  else {
    $js .= '{file: "' . $SD . '",type:"mp4"}';
  }

  return $js;
//return $l;
}


function get_youtube($link){



    $data = youtube($link);

    $js = array();
    foreach($data as $key=>$item){
        $label = change_label($data[$key][1]);
        $url = $data[$key][2];
        $type = preg_match_all('/.*type=video\/(.*?);.*/i',$url,$marcht);
        $type = $marcht[1][0];
        if($type==""){
            $type = preg_match_all('/.*type=video\/(.*?)&.*/i',$url,$marcht);
            $type = $marcht[1][0];
        }
        if($key==count($data)-1){
            $js[] = "{file: '".$url."',type:'".$type."',label: '".$label."'}";
        }else{
            $js[] = "{file: '".$url."',type:'".$type."',label: '".$label."', default:'true'}";
        }





    }
    // rsort($js);
    $js = implode(',',$js);
    return  $js;
}

function curl($url) {
  $ch = @curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  $head[] = "Connection: keep-alive";
  $head[] = "Keep-Alive: 300";
  $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $head[] = "Accept-Language: en-us,en;q=0.5";
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
  $page = curl_exec($ch);
  curl_close($ch);
  return $page;
}

function youtube($link) {
    if ($get = file_get_contents($link)) {
        if (preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $get, $data)) {
            $jsonData  = json_decode($data[1], true);
            $streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
            $videoUrls = array();

            foreach (explode(',', $streamMap) as $url)
            {
                $url = str_replace('\u0026', '&', $url);
                $url = urldecode($url);

                parse_str($url, $data);
                $dataURL = $data['url'];
                unset($data['url']);

                $videoUrls[] = array($data['itag'],$data['quality'],$dataURL.'&'.urldecode(http_build_query($data)));
            }
            return $videoUrls;
        }
    }
    return array();
}

function change_label($label){
    switch ($label) {
        case 'hd720':
        $label = '720p';
        break;

        case 'medium':
        $label = '480p';
        break;

        case 'small':
        $label = '360p';
        break;
    }
    return $label;
}
function custom_excerpt($string = "", $limitword = "", $kytu = "")
{
    $string = strip_tags($string);
    $string = preg_replace('/\n/', ' ', trim($string));
    $array = explode(' ', $string, $limitword);
    $string = "";
    for ($i = 0; $i <= (count($array) - 2); $i++):
        $string .= $array[$i] . " ";
    endfor;
    return $string . $kytu;
}
