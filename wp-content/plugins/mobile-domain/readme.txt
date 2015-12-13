=== Mobile Domain ===
Contributors: byoozz
Donate link: http://www.yusuf.asia/wordpress/donate
Tags: mobile domain, mobile, domain, subdomain, browser, redirect, mobile xml sitemap, sitemap
Requires at least: 2.3
Tested up to: 3.4.2
Stable tag: 1.4.4

Redirect Wordpress blog from desktop domain to mobile subdomain and create Mobile XML Sitemap.

== Description ==

<p>Mobile Domain will redirect your desktop version to the mobile version when visitor access your web through mobile browser, but before you use this plugin you need to create subdomain firt, if you create m.domain.com then domain.com will redirect to m.domain.com, to facilitate your visitors back to the desktop version or just to see the desktop version Mobile Domain create a link to it.</p>

<p>The use of this plugin allows more pages to be indexed in search engines and it much more easier to find you on internet specially on mobile search engine.</p>

<p>Mobile domain is now helping you to moneytize your blog through mobile version, is now equipped with a mobile ad, you can put any ads scripts and it will appear on your mobile version.</p>

<p>Mobile Domain has also been equipped with the Mobile XML Sitemap Generator for Google, it will create a mobile xml sitemap. To maximize the mobile version in mobile search engines like google, you must join the Google Webmaster Tool and tell Google about your Mobile XML Sitemap.</p>
<p>Read this <a href="http://www.yusuf.asia/go/p1-tutorial">tutorial</a> to create a new subdomain for Mobile Domain</p>

* <a href="http://www.yusuf.asia/mobile-domain/">Plugin Homepage</a>
* Author : <a href="http://www.yusuf.asia/">yusuf</a>

== Installation ==

1. Upload the mobile-domain folder to the WordPress plugins directory (wp-content/plugins).
2. Create a subdomain from your cpanel, point your subdomain document root into the root of wordpress installation, this plugin will not work if you point it to be different from the directory you installed WordPress.
3. Activate the 'Mobile Domain' plugin and go to the settings page.
4. Submit your subdomain. Done!
5. Need help for creating mobile sitemap, read this <a href="http://www.yusuf.asia/go/p1-tutorial2">tutorial</a>.

* <a href="http://www.yusuf.asia/mobile-domain/">Plugin Homepage</a>
* Author : <a href="http://www.yusuf.asia/">yusuf</a>

== Frequently Asked Questions ==

= Is it working on https connection? =

No, this plugin is not working on https connection.

= I can't access my mobile-domain? =

Have you created your mobile subdomain? if you have not created yet, create subdomain from your domain control panel, point your subdomain document root into the root of wordpress installation or if you don't know what to do, contact your hosting provider.

= I have created a mobile subdomain, but I still can't access my mobile version? =

Did you point a mobile domain document root to the root of wordpress installation? if you did not, login to your cpanel, point the document root into the root of wordpress installation.

= I can't access wp-admin from my mobile device? =

If you want to access wp-admin from mobile device, you have to enable the cookie's setting, then it will redirect you to desktop version.

= Why desktop-view link did not redirect me to the desktop version? =

This plugin requires cookie, so you need to enable the cookie's setting.

= I can't find the desktop-view link in the mobile version? =

You have to upgrade an old mobile theme to a new version, or if you still want to use it, add wp_footer(); function into your footer.php before the end of body tag.

= I Can't create mobile XML Sitemap, why? =

Some hosting providers block Mobile Domain to create a sitemap, create an empty file named mobiledomain.xml upload this file to your servers directory and change file permissions to 0666. If you still have a problem with file permissions please contact your Hosting Provider to create this file and change the file permissions.

* <a href="http://www.yusuf.asia/mobile-domain/">Plugin Homepage</a>
* Author : <a href="http://www.yusuf.asia/">yusuf</a>

== Changelog ==

= 1.4.4 =
* Fixed bugs
* Add auto pinging sitemap google

= 1.4.3 =
* Fixed bugs

= 1.4.2 =
* Fixed bugs

= 1.4.1 =
* Add Mobile XML Sitemap for Google

= 1.3.0 =
* Add Mobile Ads

= 1.2.1 =
* Fixed bugs

= 1.2.0 =
* Fixed bugs in redirection
* Add user agent string database

= 1.1.0 =
* Add option for background color desktop view link.
* Add option for padding desktop view link.
* Mobile browser list now inside the textarea.
* Change layout.

= 1.0.0 =
* New release

* <a href="http://www.yusuf.asia/mobile-domain/">Plugin Homepage</a>
* Author : <a href="http://www.yusuf.asia/">yusuf</a>