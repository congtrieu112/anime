<?php
/*
Template Name: AJAX
*/
?>

<?php
if($_POST['like_film_id']) {
if(!$_SESSION['like']){
$insert = $wpdb->query ( "UPDATE " . DATA_FILM_META . " 
									SET  
										film_like = film_like + 1
										, film_rating_total = film_rating_total + 1 
									WHERE film_id = '" . $_POST['like_film_id'] . "'" );
	if ($insert) {
	$_SESSION['like']=$insert->film_like;
	$like="Thích phim này thành công";
}
else $like="bạn đã đánh giá phim này";
	$member = array(
					'data' => true,'film'=>368,'liked_format'=>'138'
                   );
                   
   //dung ham json_encode de chuyen mang $member thanh chuoi JSON
   echo json_encode($member);
   
   //ket thuc tra ve du lieu va stop khong cho chay tiep
   die;

}
}elseif($_POST['film_id']) {
if (is_user_logged_in()) {
$filmid=$_POST['film_id'];
$user_id = $_POST['userid'];
	$check = $wpdb->get_row("SELECT box_phim FROM wp_boxfilm WHERE box_phim=$filmid");
	if(count($check)>0) { $message="Bạn đã add phim này rồi" ;
	}else {
	$wpdb->query("INSERT INTO wp_boxfilm VALUES (0,$filmid,$user_id)");
	$message="Add vào hộp phim thành công";
	}

}else{
$message="Bạn chưa đăng nhập";
}
	$member = array(
					'message' => $message
                   );
   echo json_encode($member);  
   die;
}elseif($_POST['userid']){
	$member = array(
					'message'=>'Lỗi rồi',
					'json' => array('link'=>'aa','title'='aaa');
                   );
   echo json_encode($member);  
   die;
}

	?>	