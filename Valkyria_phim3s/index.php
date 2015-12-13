<?php
session_start();
session_destroy();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="" />

	<title>Lấy Link Phim3s</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="jquery.session.js"></script>
    
    <style type="text/css">
        .box_get{border: 1px solid #ccc; margin: 20px auto; width: 700px; padding: 10px; overflow: hidden;}
        .box_get input{margin-bottom: 10px;}
        .progress{display: none;}
    </style>
</head>

<body>

<div class="container">
    <div class="box_get">
        <form id="form_get" method="post">
            <input type="text" name="link" required="true" value="http://phim3s.net/phim-bo/mon-qua-14-ngay-cua-thuong-de_7258/xem-phim/" placeholder="URL" class="form-control" />
            <input type="hidden" name="start" required="true" value="1" class="form-control" placeholder="Start" />
            <input type="hidden" name="end" class="form-control" placeholder="End" />
            <input type="submit" value="Bắt đầu" class="btn btn-primary pull-left" style="margin-right: 10px;" />  <a onClick="window.location.reload()" class="btn btn-default pull-left">Reload</a>
        </form>
		<div class="clearfix"></div>
        <div class="progress progress-striped active">
          <div class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        <div class="html_result">
            
        </div>
    </div>
    <div class="result">
    
    </div>
</div>
<script type="text/javascript">
    $('#form_get').submit(function(){
        var $data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: 'hmget.php',
            data: $data,
            //day la load file decode phai k
            success: function(data){
                var result = $.parseJSON(data);
                if(result.object_result){
                    $('.result').html(result.object_result);
                    proccessBar(result.total, result.start);
                     setTimeout(function(){
						$('.html_result').html('');
                        step2(result.link, result.ep_curent);
                    }, 1000);
                }
            },
            error: function(){
                alert('Co loi xay ra, vui long kiem tra lai');
            }
        });
        return false;
    });
    
    
    function step2(link, start){
        $.ajax({
            type: "POST",
            url: 'hmget.php',
            data: {'link':link, 'start':start},
            success: function(data){
                var result = $.parseJSON(data);
                if(result.status == 1){
                    if(result.object_result){
                        $('.result').append(result.object_result);
                        proccessBar(result.total, result.start);
                        setTimeout(function(){
                            var playerRemove = parseInt(result.ep_curent) - 5;
                            $('#mediaplayer'+playerRemove).remove();
                            step2(result.link, result.ep_curent);
                        }, 500);
                    }
                }else{
                    step3(result.link, result.start);
                }
            },
            error: function(){
                alert('Co loi xay ra, vui long kiem tra lai');
            }
        });
    }
	
	function step3(link, start){
        $.ajax({
            type: "POST",
            url: 'hmget.php',
            data: {'link':link, 'start':start},
            success: function(data){
                var result = $.parseJSON(data);
                if(result.status == 1){
                    if(result.object_result){
                        $('.result').append(result.object_result);
                        proccessBar(result.total, result.start);
                        setTimeout(function(){
                            var playerRemove = parseInt(result.ep_curent) - 5;
                            $('#mediaplayer'+playerRemove).remove();
                            step3(result.link, result.ep_curent);
                        }, 500);
                    }
                }else{
                    $('.html_result').html(result.html_result);
                    $('.progress').fadeOut();
                }
            },
            error: function(){
                alert('Co loi xay ra, vui long kiem tra lai');
            }
        });
    }
    
    function proccessBar(total, curent){
    	$('.progress').fadeIn('slow');
    	var proccess = (curent/total)*100;
    	proccess = parseInt(proccess);
    	if(proccess > 0){
    		$('.progress-bar').css('width', proccess+'%');
    	}
    }
</script>
</body>
</html>