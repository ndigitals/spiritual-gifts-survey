=== Plugin Name ===
Contributors: mynamedia
Donate link: http://gifts.mynamedia.net
Tags: spiritual gifts, survey, s.h.a.p.e., test, church, plugin, page, admin
Requires at least: 3.2
Tested up to: 3.8
Stable tag: 0.9.10

Spiritual Gifts Survey to help church members find their place of service in the local church and other service organizations.

== Description ==

The Spiritual Gifts Survey gives a 128 question test and ranks the gifts based on the test score.  In addition, the optional S.H.A.P.E. portion of the survey uses Saddleback Church's S.H.A.P.E. model of Spiritual Gifts, Heart, Abilities, Personality, and Experience to help reveal how God as already shaped you for serving Him. 

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress
2. Place the [spiritual_gifts] shortcode on the page you wish the survey to appear.
3. Use email="your@email.com" inside the shortcode (for example, [spiritual_gifts email="your@email.com"] ) if you wish to specify the target email address, otherwise the admin email will be used.
4. Use shape="false" inside the shortcode (for example, [spiritual_gifts shape="false"] ) if you wish to disable the S.H.A.P.E. portion of the survey.
5. You can use multiple options inside the shortcode (for example, [spiritual_gifts email="your@email.com" shape="false"] )

== Frequently Asked Questions ==

= How do I specify which email address will receive the surveys? =

Use email="your@email.com" inside the shortcode (for example, [spiritual_gifts email="your@email.com"] ) if you wish to specify the target email address, otherwise the Wordpress admin email will be used.

= How do I disable the S.H.A.P.E. portion of the survey? =

Add shape="false" to your shortcode... [spiritual_gifts shape="false"]

= Can I have multiple options in my shortcode? =

Yes, for example: [spiritual_gifts email="your@email.com" shape="false"]

== Screenshots ==

1. Here is a screenshot from the form
2. Here is a screenshot from the HTML version of the email
3. Here is a screenshot from the plain-text version of the email

== Changelog ==

= 0.9.10 =
*Added a simple "honey pot" spam detection field and tested with WordPress version 3.8

= 0.9.9 =
*Added "Name" field to form
*Fixed sorting issue with <10% scores

= 0.9.8 =
*Fixed a "redeclare" error with my function curPageURL()

= 0.9.6 =
*Fixed sorting issue where a 100% score wasn't showing up in the top three

= 0.9.5 =
*Added option to disable S.H.A.P.E. portion of survey

= 0.9.3 =
*First stable version of plugin

== Upgrade Notice ==

`<?php code(); // goes in backticks ?>`