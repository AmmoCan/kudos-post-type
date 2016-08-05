=== Kudos Post Type ===
Contributors: AmmoCan
Tags: kudos, testimonial, testimonials, custom post type, clients, business
Requires at least: 4.0
Tested up to: 4.5.3
Stable tag: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0-standalone.html

WordPress.org plugin solution to adding a testimonials custom post type, that "just works".

== Description ==

Kudos Post Type is a plugin for adding a new custom post type of 'testimonials' to be used in most WordPress.org themes. It adds a menu item labeled "Testimonials" to the admin menu within the dashboard, where you can add and access testimonials. In the testimonial editor view you will find a new section labeled "Testimonial Details", which has three new meta fields. There you can input the client's name, their company and a link. Kudos Post Type uses the text editor section, which is above the Testimonial Details section, for the testimonial and uses the Featured Image section located on the right hand side of the editor screen for the client's photo. The testimonials will be displayed on their own page named "testimonials", which can be added to your menu using the 'Custom Links' section in the menu editor.

= Requirements: =
  * A need to place a testimonials page on your site.
  * A sense of humor.

== Installation ==

You will need to install this manually:

1. Unzip the archive and put the 'kudos-post-type' folder into your plugins folder (/wp-content/plugins/).
2. Activate the plugin from the Plugins menu.
3. Go to Testimonials->Add New and you can now create a testimonial using the new 'Testimonials' custom post type.

== Advanced Installation (*not required) ==

The following instructions are for advanced users:

1. Go to kudos-post-type folder->kudos-styles.css and open file in a code editor, copy the css and paste it at the bottom of your theme's, preferably your child theme's, style.css file.

2. Go to kudos-post-type folder->kudos-post-type.php and open file in a code editor, scroll down to line 163 and comment out lines 163 to 173 using a double forward slash (//) on each line, then save file.

== Frequently Asked Questions ==

= Will this work with my theme? =
Yes, the functionality of this plugin will work with any WordPress.org theme. Since 2014 it has been successfully tested against the default themes included in WordPress. However, depending on your theme you may need to adjust the styling a bit. 
= Where are my testimonials located on the front-end? =
The testimonials you have created will be found at the 'testimonials' sub-directory. For example: http://your-site-name/testimonials. In your menu editor you can add a link to this page to your menu by using the 'Custom Links' section.
= Do I really need a sense of humor? =
No, not really, but it couldn't hurt.

== Screenshots ==

1. What it looks like selecting the 'Testimonials' menu in the admin menu.
2. What it looks like after selecting the 'Add New' sub-menu.
3. What it looks like once you have entered all the information for a testimonial in the editor.
4. What it looks like on the front-end of your site on the Testimonials page after publishing your testimonial.

== Changelog ==

= 1.0 =
* Start version.
