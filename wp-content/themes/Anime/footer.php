<div id="js-promo-babe" class="promo-babe" style="display: none; top: 5px;"><div class="promo-babe__close"><i class="i i--size--xl"><svg><use xlink="http://www.w3.org/1999/xlink" xlink:href="#i--close"></use></svg></i></div></div>
<div class="footer">
    <div class="layout">
	<div class="footer__inner">
	<div class="footer__section">
	<div class="list list--style--square">
	<span>Tiêu đề footer 1</span>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	</div>
	</div>
	<div class="footer__section">
	<div class="list list--style--square">
	<span>Tiêu đề footer 2</span>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	</div>
	</div>
	
	<div class="footer__section">
	<div class="list list--style--square"><span>Tiêu đề footer 3</span>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	<a class="list__item"  href="#">Tiêu đề footer 1</a>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	<a class="list__item" href="#">Tiêu đề footer 1</a>
	</div>
	</div>
	<div class="footer__section">
	<div class="list list--style--square"><span>Tiêu đề footer 4</span>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	<a class="list__item" target="_blank" href="#">Tiêu đề footer 1</a>
	</div>
	</div>

            <div class="footer__copyright">
                Copyright © . All rights reserved 2015 - 2016 Anime online. 
            </div>
        </div>
    </div>
<div class="back-to-top">
    <button style="display: none;" type="button" id="js-back-to-top" class="btn btn--size--l btn--width--full">
        <div class="i i--arrow--up"></div>
    </button>
</div>

</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<script language="javascript">
/* <![CDATA[ */
var sinhvienit=0;
function SVIT_ADS_GetCookie(Name){
var re=new RegExp(Name+"=[^;]+", "i");
if (document.cookie.match(re))
return decodeURIComponent(document.cookie.match(re)[0].split("=")[1]);
return ""
}

function SVIT_ADS_SetCookie(name, value, days){
if (typeof days!="undefined"){
var expireDate = new Date()
var expstring=expireDate.setDate(expireDate.getDate()+days)
document.cookie = name+"="+decodeURIComponent(value)+"; expires="+expireDate.toGMTString()
}
else document.cookie = name+"="+decodeURIComponent(value);
}

function vtlai_popup()
{
var cookie_popup_ads = SVIT_ADS_GetCookie('sinhvienit_popup_ads');
if (cookie_popup_ads=='') {
if(sinhvienit==0)
{
sinhvienit=1;
var Time_expires = 24 * 3600 * 1000;
SVIT_ADS_SetCookie('sinhvienit_popup_ads','true',Time_expires);
var urllist = [' http://mesothelioma-law-firm-1.com/'];
var url = urllist[Math.floor(Math.random() * urllist.length)];
var params = 'width=' + '300';
params += ', height=' + '300';
params += ', top=0,left=0,scrollbars=yes,status=1,toolbar=1,menubar=1,resizable=1,location=1,directories=1';
var pop_ads_open = window.open(url, 'sinhvienit_ads_pop', params);
}
}
}
/* ]]> */
</script>
</body></html>