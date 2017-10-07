=== Latest Post in Email ===
Contributors: wpelk
Donate link: https://www.wpelk.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Insert your latest blog post in the emails you sent.

== Description ==

Insert your latest blog post in the emails you sent. This is the latest blog published by date (and not anything else).
A drafted post won't be sent, nor will be a page or a project.

The title shown is the one from the blog. This only works of the functions in wp_mail() so if you have plugins that don't use that function
 the blog post won't be linked in the email.
 
 This works for html and plain text emails.

== Installation ==

You can install Latest Post in Email like every other plugins

1. In your admin dashboard, go to Plugin > Add new
2. Search for "Latest Post in Email"
3. Click on Install
4. Click on Activate
5. Done! There is no need to configure anything

== Frequently Asked Questions ==

= Can I select which blog post is linked? =

No, it is only the latest blog post.

= Will this transform my plain/text emails to HTML? =
No, it will keep the content type.

= Can I select which email has a link? =
No, it's added to all the emails who are sent through wp_mail().

= What are the settings available? =
It's plug and play. Once you activate it the next emails will be sent with a link at the bottom to your latest blog post.

== Changelog ==

= 1.0.1 =
* Now works for plaintext and html emails.

= 1.0.0 =
* First release