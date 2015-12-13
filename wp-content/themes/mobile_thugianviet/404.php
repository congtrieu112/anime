<?php get_header();?>
<?php
$order=$_GET['sort_id'];
$country=$_GET['country_name'];
$year=$_GET['y'];
$theloai=$_GET['theloai'];
if($order) {
$a=array('order'=>$order);
}else{$a=array('order'=>'date');}
if($year) $b=array('meta_key'=>'phim_nsx','meta_value'=>$year);else $b=array();
if($theloai) $d=array('cat'=>$theloai);else $d=array();
if($country!=''){
$c=array('tax_query' => array(
		array(
			'taxonomy' => 'quoc-gia',
			'field' => 'slug',
			'terms' => $country
		)
	),
	)
	;
}else $c=array();
?>
    <!--/ Header -->
<!-- Filter -->
<!-- Main -->
    	<div class="main">
        	<div class="content">
                <!-- Content main -->
                            	
                                            <h1><center><font face="Times New Roman"><SCRIPT>
    farbbibliothek = new Array();
    farbbibliothek[0] = new Array("#FA0303","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");
    farbbibliothek[1] = new Array("#00FF00","#4D4D4D","#00FF00","#00FF00");
    farbbibliothek[2] = new Array("#00FF00","#FA0303","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00");
    farbbibliothek[3] = new Array("#FA0303","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0505F2","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");
    farbbibliothek[4] = new Array("#FA0303","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#4D4D4D","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");
    farbbibliothek[5] = new Array("#4D4D4D","#4D4D4D","#4D4D4D","#FFFFFF","#FFFFFF","#FFFFFF");
    farbbibliothek[6] = new Array("#0505F2","#FFFF00");
    farben = farbbibliothek[4];
    function farbschrift()
    {
    for(var i=0 ; i<Buchstabe.length; i++)
    {
    document.all["a"+i].style.color=farben[i];
    }
    farbverlauf();
    }
    function string2array(text)
    {
    Buchstabe = new Array();
    while(farben.length<text.length)
    {
    farben = farben.concat(farben);
    }
    k=0;
    while(k<=text.length)
    {
    Buchstabe[k] = text.charAt(k);
    k++;
    }
    }
    function divserzeugen()
    {
    for(var i=0 ; i<Buchstabe.length; i++)
    {
    document.write("<span id='a"+i+"' class='a"+i+"'>"+Buchstabe[i] + "</span>");
    }
    farbschrift();
    }
    var a=1;
    function farbverlauf()
    {
    for(var i=0 ; i<farben.length; i++)
    {
    farben[i-1]=farben[i];
    }
    farben[farben.length-1]=farben[-1];

    setTimeout("farbschrift()",30);
    }
    //
    var farbsatz=1;
    function farbtauscher()
    {
    farben = farbbibliothek[farbsatz];
    while(farben.length<text.length)
    {
    farben = farben.concat(farben);
    }
    farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001));
    }
    setInterval("farbtauscher()",5000);
    text= "Không Tìm Thấy Trang"; //h
    string2array(text);
    divserzeugen();
    //document.write(text);
    </SCRIPT></font></center></h1>

                             
<!-- End Main -->
</div></div></div>
<!-- footer -->
    		<?php get_footer();?>