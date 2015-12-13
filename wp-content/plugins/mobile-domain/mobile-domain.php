<?php
/*
Plugin Name: Mobile Domain
Plugin URI: http://www.yusuf.asia/wordpress/mobile-domain/
Description: Redirect Wordpress blog from Desktop Domain to Mobile Subdomain and Create Mobile XML Sitemap for Google. Go to <a href="options-general.php?page=mobile-domain">Settings Page</a> to start your Mobile Domain.
Version: 1.4.4
Author: Yusuf
Author URI: http://www.yusuf.asia
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.*/

global $wpdb;
$ywpmd_wpdb = $wpdb->get_row("SELECT option_value FROM $wpdb->options WHERE option_name = 'home'");
$ywpmd_siteurl = $ywpmd_wpdb->option_value;
define ('WPMD_SITEURL', $ywpmd_siteurl);
$ywpmd_domain = str_replace('http://', '', $ywpmd_siteurl);
define ('WPMD_DOMAIN', $ywpmd_domain);
$ywpmd_domain2 = str_replace('http://www.', '', $ywpmd_siteurl);
$ywpmd_check = strpos($ywpmd_domain, '/');
$ywpmd_check2 = strpos($ywpmd_domain2, '/');
if (!empty($ywpmd_check)) {
		define ('WPMD_DESKTOP', substr($ywpmd_siteurl, 7, $ywpmd_check));
		define ('WPMD_DESKTOP2', substr($ywpmd_siteurl, 11, $ywpmd_check2));
	} else {
		define ('WPMD_DESKTOP', $ywpmd_domain);
		define ('WPMD_DESKTOP2', $ywpmd_domain2);
	}

	$mobiledomain_get = get_option('wpmd_db_options');
	if ($mobiledomain_get) {
		//$new = array ('color','padding','text','font','fontcolor','layout','link','');
		mobiledomain_upgrade($mobiledomain_get['color'], 'color', '');
		mobiledomain_upgrade($mobiledomain_get['padding'], 'padding', '');
		mobiledomain_upgrade($mobiledomain_get['text'], 'text', 'View Desktop Version');
		mobiledomain_upgrade($mobiledomain_get['font'], 'font', '');
		mobiledomain_upgrade($mobiledomain_get['fontcolor'], 'fontcolor', '');
		mobiledomain_upgrade($mobiledomain_get['layout'], 'layout', 'Left');
		mobiledomain_upgrade($mobiledomain_get['link'], 'link', 'yes');
		
		if ($_SERVER['SERVER_NAME'] == $mobiledomain_get['domain']) {
			add_filter('option_template', 'ywpmd_request_template');
			add_filter('option_stylesheet', 'ywpmd_request_template');
			add_filter('option_home', 'ywpmd_request_siteurl',1);
			add_filter('option_siteurl', 'ywpmd_request_siteurl',1);
			add_filter('the_content','ywpmd_content_ad');
			add_action('wp_head','mobiledomain_header');
			add_action('wp_footer', 'ywpmd_redirect');
			define ('MOBILEDOMAIN_THEME', $mobiledomain_get['theme']);
			define ('MOBILEDOMAIN_COLOR', $mobiledomain_get['color']);
			define ('MOBILEDOMAIN_PADDING', $mobiledomain_get['padding']);
			define ('MOBILEDOMAIN_TEXT', $mobiledomain_get['text']);
			define ('MOBILEDOMAIN_FONT', $mobiledomain_get['font']);
			define ('MOBILEDOMAIN_FONTCOLOR', $mobiledomain_get['fontcolor']);
			define ('MOBILEDOMAIN_LAYOUT', $mobiledomain_get['layout']);
			define ('MOBILEDOMAIN_LINK', $mobiledomain_get['link']);
			define ('MOBILEDOMAIN_STATUS', true);
		} else {
			define ('MOBILEDOMAIN_STATUS', false);		
		}
		define ('MOBILEDOMAIN_INSTALLED', true);
		define ('MOBILEDOMAIN_DOMAIN', $mobiledomain_get['domain']);
	} else {
		define ('MOBILEDOMAIN_STATUS', false);
		define ('MOBILEDOMAIN_INSTALLED', false);
	}

function mobiledomain_upgrade($data, $keys, $values) {
	global $mobiledomain_get;
	if (!isset($data)){
		$new_array = array();
		foreach($mobiledomain_get as $key => $value){
			$new_array[$key] = $value;
		}
		$new_array[$keys] = $values;
		update_option('wpmd_db_options', $new_array);
	}
}

function ywpmd_options() {
	$wp_admin = substr_count($_SERVER['REQUEST_URI'], '/wp-admin/');
	$wp_login = substr_count($_SERVER['REQUEST_URI'], '/wp-login.php');
	if ($wp_login > 0 || $wp_admin > 0) { //Always create a cookie
		ywpmd_create_cookie();
		if (MOBILEDOMAIN_STATUS == true) {
			header ('location:'.WPMD_SITEURL.'/wp-login.php');
			die();
		}
	}
	
	if (MOBILEDOMAIN_INSTALLED == true) {
		if ($_SERVER['SERVER_NAME'] == WPMD_DESKTOP) {
			$browsers = get_option('wpmd_db_browsers');
			foreach($browsers as $browser) { 
				if (preg_match("/".$browser."/i", $_SERVER['HTTP_USER_AGENT'])) {
					if (!isset($_COOKIE['wordpress_mobile_domain_plugin'])) {
						if( ! is_admin() ) {
							header ('location:http://'.MOBILEDOMAIN_DOMAIN.''.$_SERVER['REQUEST_URI']);
							die();
						}
					}
				}
			}			
		}
	}
	if (!empty($_GET['wpmd_action'])) {
		if ($_GET['wpmd_action'] == 'nomobile') {
			ywpmd_create_cookie();
			if (!empty($_SERVER['HTTP_REFERER'])) {
				$go = str_replace(MOBILEDOMAIN_DOMAIN, WPMD_DESKTOP, $_SERVER['HTTP_REFERER']);
				header ('location:'.$go);
				die();
			} else {
				header ('location:'.WPMD_SITEURL);
				die();
			}
		}
	}
}
add_action('init', 'ywpmd_options');

function ywpmd_create_cookie(){
	$get = get_option('wpmd_db_options');
	setcookie('wordpress_mobile_domain_plugin', 1, time()+86400, '/', $get['domain'], false);
	setcookie('wordpress_mobile_domain_plugin', 1, time()+86400, '/', WPMD_DESKTOP, false);
	setcookie('wordpress_mobile_domain_plugin', 1, time()+86400, '/', WPMD_DESKTOP2, false);
}

function ywpmd_admin(){
	if (!empty($_GET['wpmd_action'])) {
		if ($_GET['wpmd_action'] == 'add-domain') {
			if (!empty($_POST['domain'])) {
				$subdomain = strtolower($_POST['domain']);
				if (!isset($_POST['link'])) $link = 'no'; else $link = 'yes';
				$domain = array (
					'domain' => $subdomain,
					'theme' => $_POST['theme'],
					'color' => $_POST['color'],
					'padding' => $_POST['padding'],
					'text' => $_POST['text'],
					'font' => $_POST['font'],
					'fontcolor' => $_POST['fontcolor'],
					'layout' => $_POST['layout'],
					'link' => $link
				);
				update_option('wpmd_db_options', $domain);
				echo '<div class="updated"><p>Mobile Domain Saved</p></div>';
			} else echo '<div class="error settings-error" id="setting-error-invalid_home"><p>Please enter subdomain for your mobile site.</p></div>';
		}
		if ($_GET['wpmd_action'] == 'update-ad') {
			if (!empty($_POST['update-ad'])) {
				$content_ad  = htmlspecialchars(stripslashes($_POST['update-ad']));
				update_option('wpmd_content_ad', $content_ad);
				echo '<div class="updated"><p>Ad saved</p></div>';
			}
		}
		if ($_GET['wpmd_action'] == 'remove-ad') {
				delete_option('wpmd_content_ad');
				echo '<div class="updated"><p>Ad removed</p></div>';
		}
		if ($_GET['wpmd_action'] == 'create-sitemap') {
			if (!empty($_POST['create-sitemap'])) {
				if (get_option('wpmd_db_options')) {
					$cek = mobiledomain_sitemap();
					if ($cek)
						echo '<div class="updated"><p>Mobile XML Sitemap Created</p></div>';
					else 
						echo '<div class="error settings-error" id="setting-error-invalid_home"><p><strong>Oops!</strong> Mobile Domain cannot create the sitemap file automatically, some hostings provider did this for any reason. Please upload a sitemap file named <code>mobiledomain.xml</code> to your wordpress root directory manually, you can use FTP Manager to upload it and change the file permissions of a sitemap file to 0666 and try to generate a sitemap again. Read this <a href="http://www.yusuf.asia/go/p1-tutorial2">tutorial</a>.
						
						</p></div>';
				}	else echo '<div class="error settings-error" id="setting-error-invalid_home"><p>Please enter subdomain for your mobile site.</p></div>';
			}
		}
		if ($_GET['wpmd_action'] == 'update-sitemap') {
			if (!empty($_POST['update-sitemap'])) {
				$cek = mobiledomain_sitemap();
				if ($cek)
					echo '<div class="updated"><p>Mobile XML Sitemap Updated</p></div>';
				else
					echo '<div class="error settings-error" id="setting-error-invalid_home"><p><strong>Oops!</strong> Please ensure that your sitemap file has appropriate write permissions. You can use FTP Manager to change the permission of the sitemap file to 0666 and then try updating the sitemap again. Read this <a href="http://www.yusuf.asia/go/p1-tutorial3">tutorial</a>.</p></div>';
			}
		}
	}
	$get = get_option('wpmd_db_options');
	echo '
	<div class="wrap" id="wpmd_div"><h2>Mobile Domain With XML Sitemap</h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortabless ui-sortable" style="position:relative;">
					<div class="postbox">
						<h3 class="hndle"><span>Mobile Version</span></h3>
							<div class="inside">
								<p>';
									if (!empty($get['domain'])) {
										$get = get_option('wpmd_db_options');			
										$go = str_replace(WPMD_DESKTOP, $get['domain'], WPMD_SITEURL);
										echo '<p><img src="'.WPMD_SITEURL.'/wp-content/plugins/mobile-domain/images/mobile.jpg" alt="Mobile" /> <a href="'.$go.'" target="_blank">'.$go.'</a></p>';
									} else {
										echo '<p style="color:#FF0000"><strong>README FIRST!</strong></p><p>You have to enter your mobile subdomain, select the theme and click save changes.</p>
										<p>If you have not created a mobile subdomain yet, create it by login to your cpanel. The path for the document root is your wordpress installation folder.</p>
										<p>Or read this <a href="http://www.yusuf.asia/go/p1-tutorial">Tutorial</a> to create subdomain for Mobile Domain.</p>';			
									}
								echo '</p>
							</div>
					</div>
					<div class="postbox">
						<h3 class="hndle"><span>About Plugin</span></h3>
							<div class="inside">
								<p><img src="'.WPMD_SITEURL.'/wp-content/plugins/mobile-domain/images/home.jpg" alt="Mobile" /> <a href="http://www.yusuf.asia/go/p1-homepage">Plugin Homepage</a></p>
								<p><img src="'.WPMD_SITEURL.'/wp-content/plugins/mobile-domain/images/tool.jpg" alt="Mobile" /> <a href="http://www.yusuf.asia/go/p1-forum">Support Forum</a></p>
								<p><img src="'.WPMD_SITEURL.'/wp-content/plugins/mobile-domain/images/bugs.jpg" alt="Mobile" /> <a href="http://www.yusuf.asia/go/p1-bugs">Report Bugs</a></p>
							</div>
					</div>';
					if (!empty($get['domain'])) {
						echo '<div class="postbox">
							<h3 class="hndle"><span>Donation</span></h3>
								<div class="inside">
									<p><a href="http://www.yusuf.asia/wordpress/donate"><img src="'.WPMD_SITEURL.'/wp-content/plugins/mobile-domain/images/paypal-donate.gif" alt="" /></a></p>	
								</div>
						</div>';
					}
				echo '</div>
			</div>
			<div class="has-sidebar wpmd-padded" >
				<div id="post-body-content" class="has-sidebar-content">
					<div class="meta-box-sortabless">
						<div id="wpmd_satu" class="postbox">
							<h3 class="hndle"><span>Mobile Domain and Theme</span></h3>
								<div class="inside">
									<ul>
									<li>
										<form method="post" action="options-general.php?page=mobile-domain&wpmd_action=add-domain">
										<table>
											<tr valign="top"><br />
												<td>
													<label for="domain">Mobile Domain</label>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
												<td>
													<input type="text" name="domain" id="domain" value="'.$get['domain'].'" class="regular-text"><span style="color:#FF0000"> *</span><br /><span class="description">Domain for your mobile site (i.e. <strong>m.domain.com</strong>), read this <a href="http://www.yusuf.asia/go/p1-tutorial4">tutorial</a>.</span>
												</td>
											</tr><tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="theme">Mobile Theme</label>
												</td>
												<td>
													<select name="theme" id="theme" class="postform">';
													$themes = get_themes();
													foreach($themes as $theme) {
														if ( $theme["Template"] == $get['theme'] )
															echo '<option value="'.$theme["Template"].'" selected>'.$theme["Name"].'</option>';
														else
															echo '<option value="'.$theme["Template"].'">'.$theme["Name"].'</option>';
													}
													echo '</select><br /><span class="description">Select mobile theme.</span>
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="text">Footer Text</label>
												</td>
												<td>
													<input type="text" name="text" id="text" value="';
													if (!isset($get['text'])) echo 'View Desktop Version'; else echo $get['text'];
													echo '" class="regular-text">
													<br />
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="layout">Footer Text Layout</label>
												</td>
												<td>
													<input type="radio" name="layout" value="left"';
													if (!isset($get['layout'])) echo ' checked';
													if ($get['layout'] == 'left') echo 'checked="checked"';
													echo '>Left</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" name="layout" value="center"';
													if ($get['layout'] == 'center') echo 'checked="checked"';
													echo '>Center</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" name="layout" value="right"';
													if ($get['layout'] == 'right') echo 'checked="checked"';
													echo '>Right</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label for="link">Enable Link</label>
													<input type="checkbox" name="link" value="yes"';
													if (!isset($get['link'])) echo ' checked';
													if ($get['link'] == 'yes') echo ' checked';
													echo'>
													<br /><br />
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="font">Font Size</label>
												</td>
												<td>
													<input type="text" name="font" id="font" value="'.$get['font'].'">
													<br /><span class="description">Font Size for Footer Text (i.e. <strong>10</strong>) or Leave empty to default.</span>
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="fontcolor">Font Color</label>
												</td>
												<td>
													<input type="text" name="fontcolor" id="fontcolor" value="'.$get['fontcolor'].'">
													<br /><span class="description">Font <a href="http://www.yusuf.asia/go/p1-color">Color</a> for Footer Text (i.e. <strong>#FF0000</strong>) or Leave empty to default.</span>
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="color">Background Color</label>
												</td>
												<td>
													<input type="text" name="color" id="color" value="'.$get['color'].'">
													<br /><span class="description">Background <a href="http://www.yusuf.asia/go/p1-color">Color</a> for Footer Text (i.e. <strong>#FFFFFF</strong>) or Leave empty to default.</span>
												</td>
											</tr>
											<tr><td><br /></td></tr>
											<tr valign="top">
												<td>
													<label for="padding">Margin</label>
												</td>
												<td>
													<input type="text" name="padding" id="padding" value="'.$get['padding'].'">
													<br /><span class="description">Margin for Footer Text (i.e. <strong>10</strong>) or Leave empty to default.</span>
												</td>
											</tr>
										
											
										</table><br />
										<input type="submit" name="submit" class="button" value="Save Changes" />
										</form>
									</li>
									</ul><br />
								</div>
						</div>
						<div id="wpmd_dua" class="postbox">
							<h3 class="hndle"><span>Mobile XML Sitemap for Google</span></h3>
								<div class="inside">
									<ul><li>';
										if (file_exists(ABSPATH . 'mobiledomain.xml')) {
											$get = get_option('wpmd_db_options');
											$go = str_replace(WPMD_DESKTOP, $get['domain'], WPMD_SITEURL);
											if ($get) {
												if (is_writable(ABSPATH .'mobiledomain.xml')) {
													$time = get_option('mobiledomain_sitemap_time');
													if ($time) {
														echo '<p>Your sitemap was last built on ' . $time . '</p><p><strong>Tell Google about your sitemap by joining <a target="_blank" href="http://www.google.com/webmasters/tools/">Google Webmaster Tools</a>.</strong></p><p>If you add a new post or remove it, you should update the sitemap manually, and notify Google about your updates by <a href="http://www.google.com/webmasters/tools/ping?sitemap='.$go.'/mobiledomain.xml" target="_blank">pinging it</a></strong></p>';
													} else {
														echo '<p>You need to update Mobile Domain first</p>';
													}
												} else {
													echo '<p style="color:#FF0000"><strong>File Permissions needed, please fix this error, then update your sitemap.</strong></p>
													<p>Ensure that your <a href="'.$go.'/mobiledomain.xml" target=_new>sitemap file</a> has appropriate <a href="http://codex.wordpress.org/Changing_File_Permissions" target="_blank">write permissions</a>.</p><p>You can use FTP Manager to change the permission of the sitemap file to 0666 and then try updating the sitemap again. Read this <a href="http://www.yusuf.asia/go/p1-tutorial3">tutorial</a>.</p>';
												}
												echo '<form method="post" action="options-general.php?page=mobile-domain&wpmd_action=update-sitemap">
															<div class="submit">
																<input type="submit" name="update-sitemap" value="Update Mobile Sitemap" />
															</div>
														</form>';
												echo '<p>Sitemap : <a href="'.$go.'/mobiledomain.xml" target=_new>'.$go.'/mobiledomain.xml</a></p>';
											}	else {
												echo '<p>You need to create Mobile Domain first</p>';
											}
										} else {
												echo '<strong>Create Mobile XML Sitemap</strong>';
												echo '<form method="post" action="options-general.php?page=mobile-domain&wpmd_action=create-sitemap">
													<div class="submit">
														<input type="submit" name="create-sitemap" value="Generate Mobile XML Sitemap" />
													</div>
												</form>';
											}
								echo '</li></ul>
								</div>
						</div>
						<div id="wpmd_tiga" class="postbox">
							<h3 class="hndle"><span>Mobile Ad</span></h3>
								<div class="inside">
									<ul><li>
										<form method="post" action="options-general.php?page=mobile-domain&wpmd_action=update-ad">
											<table>
												<tr valign="top">
												<td>
													<label for="browser">Place Your Mobile Ad Here<br /><span class="description">(This ad will appear bellow your <br />Post Content )</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
												<td>
													<textarea name="update-ad" id="update-ad" rows="11" cols="38">'.get_option('wpmd_content_ad').'</textarea>
												<br />
													<input type="submit" name="submit" class="button" value="Save Changes">
												</td></tr>
											</table>
										</form>
									</li><li>
										<label><span class="description"><a href="options-general.php?page=mobile-domain&wpmd_action=remove-ad" title="Remove Ad">Remove Ad</a>.</span></label>
									</li></ul>
								</div>
						</div>
						<div id="wpmd_empat" class="postbox">
							<h3 class="hndle"><span>Mobile Browser</span></h3>
								<div class="inside"><br />
									<ul>
										<li>
											<form method="post" action="options-general.php?page=mobile-domain&wpmd_action=update-browsers">
											<table>
											<tr valign="top">
												<td>
													<label for="browser">List of Mobile Browsers<br /><span class="description">(Base on user agent string)</span></label>		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
												<td>';
											$browsers = get_option('wpmd_db_browsers');
											if (!empty($_GET['wpmd_action'])) {
												if ($_GET['wpmd_action'] == 'default-browsers') {
													ywpmd_activate();
													echo '<div class="updated"><p>Default browsers loaded</p></div>';
												}
												if ($_GET['wpmd_action'] == 'update-browsers') {
													$browsers = $_POST['browser'];
													$replace = str_replace("\r\n", "*", $browsers);
													$browsers = explode("*", $replace);
													$newbrowsers = array();
													foreach($browsers as $value){
														if(!empty($value)) {
															array_push($newbrowsers, $value);
															update_option('wpmd_db_browsers', $newbrowsers);
														}
													}
													echo '<div class="updated"><p>Browsers Updated</p></div>';
												}
											}
											$browsers = get_option('wpmd_db_browsers');
											echo '<textarea name="browser" id="browser" rows="15" cols="38">';
											asort($browsers);
											foreach ($browsers as $value) {
												echo $value."\n";
											}
											echo '</textarea>';
											echo '<br />
												<input type="submit" name="submit" class="button" value="Update Changes">
											</td></tr>
											</table>
											</form>
										</li><li>
											<label><span class="description"><a href="options-general.php?page=mobile-domain&wpmd_action=default-browsers" title="Reset to default">Reset to default</a>.</span></label>
										</li>
									</ul><br />
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';
}

function ywpmd_admin_menu() {
	add_options_page('Mobile Domain Page','Mobile Domain','manage_options','mobile-domain','ywpmd_admin');
}
add_action('admin_menu', 'ywpmd_admin_menu');

function ywpmd_content_ad($content){
	if (is_single()) {
		$get = get_option('wpmd_content_ad');
		if ($get) {
			$content .= '<p style="text-align:center">' . htmlspecialchars_decode($get) .'</p>';
		}
	}
	return $content;
}

function ywpmd_request_siteurl(){
	$go = str_replace(WPMD_DESKTOP, MOBILEDOMAIN_DOMAIN, WPMD_SITEURL);
	return $go;
}

function ywpmd_request_template($theme) {
	if (is_dir(ABSPATH.'wp-content/themes/'.MOBILEDOMAIN_THEME))
		return MOBILEDOMAIN_THEME;
	else
		return $theme;
}

function mobiledomain_header() {
	echo '<!-- Mobile Domain -->'; echo "\n";
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'. WPMD_SITEURL .'/wp-content/plugins/mobile-domain/style.css" />';
	echo "\n";	echo '<!-- Mobile Domain -->'; echo "\n";
}

/*
* Checks if a file is writable and tries to make it if not.
* @since 3.05b
* @access private
* @author  VJTD3 <http://www.VJTD3.com>
* @return bool true if writable
*/
function mobiledomain_is_writable($filename) {
	if(!is_writable($filename)) {
		if(!@chmod($filename, 0666))
			return false;
	}
	return true;
}

function mobiledomain_dir_is_writable($dirname) {
	if(!is_writable($dirname)) {
		return false;
	}
	return true;
}

/*
*Create xml sitemap loop
*@author: Amit Agarwal <http://www.labnol.org>
*@return bool true if writable
*/
function mobiledomain_sitemap() {
	$file = ABSPATH . 'mobiledomain.xml';
	$get = get_option('wpmd_db_options');
	$go = str_replace(WPMD_DESKTOP, $get['domain'], WPMD_SITEURL);
	global $wpdb;
	$posts = $wpdb->get_results ("SELECT id, post_modified_gmt FROM $wpdb->posts 
						WHERE post_status = 'publish' 
						AND (post_type = 'post' OR post_type = 'page')
						ORDER BY post_date");

	if (!empty ($posts)) {
		$sitemap  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">' . "\n";
		$sitemap .= "<url>\n";
		$sitemap .= " <loc>".$go."/</loc>\n";
        $sitemap .= " <mobile:mobile />\n";
		$sitemap .= "</url>\n";
			
		foreach ($posts as $post) {
			$permalink = get_permalink($post->id);
			$permalink = str_replace(get_option('home'), $go, $permalink);
			$sitemap .= "<url>\n";
			$sitemap .= " <loc>$permalink</loc>\n";
            $sitemap .= " <lastmod>".date (DATE_W3C, strtotime ($post->post_modified_gmt))."</lastmod>\n";
			$sitemap .= " <mobile:mobile />\n";
			$sitemap .= "</url>\n";
		}
		$sitemap .= "\n</urlset>";
	}
	if(mobiledomain_is_writable($file) || mobiledomain_dir_is_writable(ABSPATH)) {
		if (file_put_contents ($file, $sitemap)) {
			update_option('mobiledomain_sitemap_time', current_time($gmt = 0));
			return true;
		}
	}
	return false;
}

function ywpmd_redirect(){
		echo '<div style="background:';

		if (MOBILEDOMAIN_COLOR == '') {
			echo '#EEE';
		}
		else {
			echo MOBILEDOMAIN_COLOR;
		}
			
		echo ';font-size:';
		if (MOBILEDOMAIN_FONT == '') {
			echo '12';
		}
		else {
			echo MOBILEDOMAIN_FONT;
		}
		
		echo 'px;';
	
		echo 'text-align:'.MOBILEDOMAIN_LAYOUT.';';
		
		echo 'padding:';
		
		if (MOBILEDOMAIN_PADDING == '') {
			echo '8';
		}
		else {
			echo MOBILEDOMAIN_PADDING;
		}
		echo 'px;font-weight:bold;">
		
		<p><a style="text-decoration:underline;'; 
	
		if (MOBILEDOMAIN_FONTCOLOR == '') {
			echo '" ';
		}
		else {
			echo 'color:'.MOBILEDOMAIN_FONTCOLOR.';" ';
		}
		
		echo 'href="'.home_url().'/?wpmd_action=nomobile">';

		if (MOBILEDOMAIN_TEXT == '') {
		 	echo 'View Desktop Version';
		}
		else {
			echo MOBILEDOMAIN_TEXT;
		}
			
		echo '</a>';
		
		if (MOBILEDOMAIN_LINK == 'yes' ) {
			echo'<br /><a style="text-decoration:none;'; 
			if (MOBILEDOMAIN_FONTCOLOR == '')
				echo '" ';
			else
				echo 'color:'.MOBILEDOMAIN_FONTCOLOR.';" ';
			echo 'title="Wordpress Mobile Domain" href="http://www.yusuf.asia/" target="_blank">Powered by Mobile Domain</a>';
		}
		echo '</p></div>';
}

function ywpmd_activate() {
$browsers = array (
		'Googlebot-Mobile',
		'Opera Mini',
		'iPhone',
		'BlackBerry',
		'iPod',
		'Android',
		'Bolt',
		'IEMobile',
		'GoBrowser',
		'Skyfire',
		'TeaShark',
		'UC Browser',
		'Opera Mobi',
		'Mobile Safari',
		'SEMC-Browser',
		'Teleca',
		'Series60',
		'Doris',
		'2.0 MMP',
		'240x320',
		'400X240',
		'AvantGo',
		'Blazer',
		'Cellphone',
		'Danger',
		'DoCoMo',
		'Elaine 3.0',
		'EudoraWeb',
		'hiptop',
		'KYOCERA WX310K',
		'LG U990',
		'MIDP-2.',
		'MMEF20',
		'MOT-V',
		'NetFront',
		'Newt',
		'Nintendo Wii',
		'Nitro',
		'Nokia',
		'Palm',
		'PlayStation Portable',
		'ProxiNet',
		'SHARP-TQ-GX10',
		'SHG-i900',
		'Small',
		'SonyEricsson',
		'Fennec',
		'TS21i-10',
		'UP.Browser',
		'UP.Link',
		'Windows CE',
		'WinWAP',
		'LG-TU915 Obigo',
		'LGE VX',
		'Iris',
		'Maemo Browser',
		'MIB',
		'Kindle Basic Web',
		'Myriad Browser',
		'Obigo Browser',
		'Polaris Browser',
		'uZardWeb',
		'WebOS',
		'Deepfish',
		'Dolphin',
		'Firefox Mobile',
		'ibisBrowser',
		'JOCA',
		'Links',
		'Minimo',
		'Pixo',
		'Skweezer',
		'Steel',
		'Tristit',
		'Vision Mobile Browser',
		'Dorothy',
		'Ovi Browser'
	);
	update_option('wpmd_db_browsers',$browsers);
}
register_activation_hook( __FILE__, 'ywpmd_activate' );

function ywpmd_deactivate() {
	delete_option('wpmd_db_options');
	delete_option('wpmd_db_browsers');
	delete_option('wpmd_content_ad');
	delete_option('mobiledomain_sitemap_time');
}
register_deactivation_hook(__FILE__, 'ywpmd_deactivate');

?>