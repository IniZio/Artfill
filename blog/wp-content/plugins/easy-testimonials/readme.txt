=== Plugin Name ===
Contributors: richardgabriel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V7HR8DP4EJSYN
Tags: testimonials, testimonial widget, testimonial feed, random testimonials
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.7.3
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Easy Testimonials is a simple-to-use plugin for adding Testimonials to your WordPress Theme, using a shortcode or a widget.

== Description ==

Easy Testimonials is an easy-to-use plugin that allows users to add Testimonials to the sidebar, as a widget, or to embed them into a Page or Post using the shortcode.  The Easy Testimonials plugin also allows you to insert a list of all Testimonials or output a Random Testimonial. Easy Testimonials allows you to include an image with each testimonial - this is a great feature for adding a photo of the testimonial author.

= Easy Testimonials is a great plugin for: =
* Adding a Random Testimonial to Your Sidebar
* Adding a Random Testimonial to Your Page
* Outputting a List of Testimonials
* Outputting a Fading or Sliding Testimonial Widget
* Displaying an Image with a Testimonial
* Custom Options Allow You to Link Your Testimonials to a Custom Page, Such As a Product Page
* Testimonial Categories Allow You To Organize Testimonials in Many Ways!
* Its easy to use interface allows you to manage, edit, create, and delete Testimonials with no new knowledge

Easy Testimonials includes options to set the URL of the Read More Link, whether or not to display the Testimonial Image, and more!  You can set the URL of the Testimonials read more links for many purposes - such as directing visitors to the product info page that the testimonial is about.  Showing an Image next to a Testimonial is a great tool!

= Why Do I Need Testimonials on My Website? =

Testimonials are a great thing to add to your website, for many reasons.

* Testimonials help potential customers get to know that you are a credible business.
* Testimonials give you the opportunity to point out specific features or compelling reasons why a customer should buy from you.
* Testimonials, when used effectively, are a great tool to increase conversions rates on your website!

The Easy Testimonials plugin is the easiest way to start adding your customer testimonials, right now!  Click the Download button now to get started.  The Easy Testimonials plugin will inherit the styling from your Theme - just install and get to work adding your testimonials!

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the contents of `/easy_testimonials/` to the `/wp-content/plugins/` directory
2. Activate Easy Testimonials through the 'Plugins' menu in WordPress
3. Visit this address for information on how to configure the plugin: http://goldplugins.com/documentation/easy-testimonials-documentation/

= Adding a New Testimonial =

Adding a New Testimonial is easy!  There are 3 ways to start adding a new testimonial

**How to Add a New Testimonial**

1. Click on "+ New" -> Testimonial, from the Admin Bar _or_
2. Click on "Add New Testimonial" from the Menu Bar in the WordPress Admin _or_
3. Click on "Add New Testimonial" from the top of the list of Testimonials, if you're viewing them all.

**New Testimonial Content**

You have a few things to pay attention to:

* **Testimonial Title:** this content can be displayed above your Testimonial.
* **Testimonial Body:** this is the content of your Testimonial.  This will be output and displayed about the Testimonial Information fields.
* **Client Name:** This field is displayed first, below the Testimonial Body. The field title is just an example use - of course you don't have to put the client name here.
* **Position / Location / Other:** This field is displayed second, below the Client Name.  The field title is just an example use - you can put whatever you want here.
* **Featured Image:** This image is shown to the left of the testimonial, as a 50px by 50px thumbnail.

= Editing a Testimonial =

 **This is as easy as adding a New Testimonial!**

1. Click on "Testimonials" in the Admin Menu.
2. Hover over the Testimonial you want to Edit and click "Edit".
3. Change the fields to the desired content and click "Update".

= Deleting a Testimonial =

 **This is as easy as adding a New Testimonial!**

1. Click on "Testimonials" in the Admin Menu.
2. Hover over the Testimonial you want to Delete and click "Delete".
  
  **You can also change the Status of a Testimonial, if you want to keep it on file.**

= Outputting Testimonials =
* To output a Random Testimonial, place the shortcode [random_testimonial] in the desired area of the Page or Post Content. To display more than one random testimonial, use the shortcode [random_testimonial count='3'], where count is the number of testimonials you want displayed.  To display the title above the testimonial, use the shortcode [random_testimonial show_title="1"].  To use the Excerpt of a testimonial, add the attribute "use_excerpt=1" to your shortcode.  To output Testimonials in a specific Category, use the attribute "category='the_category_slug'".  To show or hide the images next to Testimonials, use the attribute "show_thumbs=0" for hiding the images, and "show_thumbs=1" for displaying the images.
* To output a list of All Testimonials, place the shortcode [testimonials] in the desired area of the Page or Post Content.  To display more than one testimonial, use the shortcode [testimonials count='3'], where count is the number of testimonials you want displayed.  To display the title above the testimonial, use the shortcode [testimonials show_title="1"].  To use the Excerpt of a testimonial, add the attribute "use_excerpt=1" to your shortcode.  To output Testimonials in a specific Category, use the attribute "category='the_category_slug'".  To show or hide the images next to Testimonials, use the attribute "show_thumbs=0" for hiding the images, and "show_thumbs=1" for displaying the images.
* To output a Testimonial in the Sidebar, use the Widgets section of your WordPress Theme, Accessible on the Appearance Menu in the WordPress Admin.  You can show more than one random testimonial by placing a number in the Count field.  You can show the Testimonial Title above the Testimonial by checking Show Testimonial Title Note: The Title Field on the Widget is displayed above the Widget, if your theme supports Widget Titles - this is different than the Testimonial Title.

= Outputting a Testimonial Slider =
* NOTE: You can view live examples here: http://goldplugins.com/documentation/easy-testimonials-documentation/easy-testimonials-examples/
* Easy Testimonials Supports Cycle2!  To output a sliding widget, use this shortcode: [testimonials_cycle].
* The same properties as the list of testimonials, such as Showing the Title and controlling the Count, also apply.  To use the Excerpt of a testimonial, add the attribute "use_excerpt=1" to your shortcode.  To output Testimonials in a specific Category, use the attribute "category='the_category_slug'".  To show or hide the images next to Testimonials, use the attribute "show_thumbs=0" for hiding the images, and "show_thumbs=1" for displaying the images.
* To change the timer, use the attribute 'timer', which defaults to 2000 (2 seconds.)  For example: [testimonials_cycle timer="4000"]
* To change the transition to a fade in, fade out, or no transition, use the attributes 'transition="fade"', or 'transition="fadeout"', or 'transition="none"'.  These features are enabled for Pro users - 'fade' is included in the Free version!  For example: [testimonials_cycle transition="fadeout"]
* To output a Testimonial Cycle in the Sidebar, use the Widgets section of your WordPress Theme, Accessible on the Appearance Menu in the WordPress Admin.  You can how many testimonials are shown by placing a number in the Count field - make sure you have at least 2, if you want them to Cycle!  You can show the Testimonial Title above the Testimonial by checking Show Testimonial Title Note: The Title Field on the Widget is displayed above the Widget, if your theme supports Widget Titles - this is different than the Testimonial Title.  You can control the time between transitions using the Timer field - every 1000 equals 1 second.
* Supported transitions in the Pro version are "scrollVert", "scrollHorz", "fadeIn", "fadeOut", "flipHorz", "flipVert", and "tileSlide".

= Front End Testimonial Submission =
* NOTE: This feature requires the Pro version of Easy Testimonials: http://goldplugins.com/our-plugins/easy-testimonials-details/
* Add the shortcode [submit_testimonial] to the area of the page you want your form on.
* Any submissions will be added to your Testimonials list, on the back end.  Only Testimonials that you choose to publish will be displayed publicly.

= Options =
* To control the destination of the "Read More" link, set the path in the Testimonials Read More Link field.
* To display any Featured Images that you have attached to your Testimonials, check the box next to Show Testimonial Image.
* To display any Testimonial Information above the content, check the box next to Show Testimonial Info Above Testimonial.
* To add any Custom CSS, to further modify the output of the plugin, input the CSS in the textarea labeled Custom CSS.  You do not need to include the opening or closing <style> tags, treat it like you're inside a CSS file.

== Frequently Asked Questions ==

= Help!  I need more information! =

OK!  We have a great page with some helpful information here: http://goldplugins.com/documentation/easy-testimonials-documentation/

= I Updated, and my formatting changed! =

Yikes!  Before 1.7.2, we were not respecting the content filter when outputting testimonials.  So, you may have to update the CSS of paragraph tags inside .testimonial_body.  For more information, contact us via our website or support forum.

= Hey!  How do I allow my visitors to submit testimonials? =

Great question!  With the Pro version of the plugin, you can do this with our front end form that is output with a shortcode!  Testimonials will show up as pending on the Dashboard, for admin moderation.  Visit here to purchase the Pro version: http://goldplugins.com/our-plugins/easy-testimonials-details/

= Urk! When I Activate Easy Testimonials, I start having trouble with my Cycle2 powered JavaScript! =

Oh no!  Check the box that is labeled "Disable Cycle2 Output".  This will cease including our JavaScript.

= Yo!  Your plugin is great - I would really like to change the size of the images that are output.  How do I do it? =

Another good question!  With the Pro version of the plugin, you can do this by controlling the Testimonial Image Size drop down menu on the Settings screen.  Depending on your website, using bigger images may require CSS changes to be made.  Visit here to purchase the Pro version: http://goldplugins.com/our-plugins/easy-testimonials-details/

= Eek!  I love everything about this plugin... but, I don't know how to use it inside my Template Files!  What do I do? =

Don't worry!  WordPress has a great function, do_shortcode(), that will allow you to use our shortcodes inside your theme files.  For example, to output a Random Testimonial in a Theme file, you would do this: <?php echo do_shortcode('[random_testimonial count="1"'); ?>

= Arg!  When using the testimonial Cycle widget, I get weird overlapping text.  What gives? =

You need to update your CSS.  Try something like `blockquote.easy_testimonial{ background-color: white; }`

= Ack!  This Testimonials Plugin is too easy to use! Will you make it more complicated? =

Never!  Easy is in our name!  If by complicated you mean new and easy to use features, there are definitely some on the horizon!

== Screenshots ==

1. This is the Add New Testimonial Page.
2. This is the List of Testimonials - from here you can Edit or Delete a Testimonial.
3. This is the Easy Testimonials Settings Page.
4. This is the Random Testimonial Widget.
5. This is the Testimonial Cycle Widget.

== Changelog ==

= 1.7.3 =
* Update: adds option to apply The Content filter to Testimonial output.
* Update: reposition custom CSS output for validation purposes.

= 1.7.2 =
* Fix: address issue with Continue Reading links leading to 404 pages.
* Update: respect wordpress content formatting in testimonials.
* Fix: change position of Testimonials menu item, so that it doesn't dissappear in some situations.

= 1.7.1 =
* Update: adds wrapping class to submission success message.
* Update: updates form output to properly use output buffering.

= 1.7 =
* Feature: adds ability to control the labels, description, and display of certain fields on the submission form.
* Feature: adds the ability to receive notifications at a specified e-mail address on new submissions.
* Update: restructure queries to load a bit faster.

= 1.6.1 =
* Fix: address deprecated function use in widget.
* Fix: fix issue using Fade transition with the Widget.

= 1.6 =
* Feature: Adds more javascript transitions to Pro version.
* Fix: Addresses a PHP notice.

= 1.5.9.1 =
* Update: Adds ability to use the excerpt with Read More functionality via the cycle shortcode.
* Minor Feature: Adds ability to control output of images in the via the cycle shortcode.

= 1.5.9 =
* Feature: Outputs shortcode to list testimonials in a category inside the Category list in the admin area.
* Feature: Adds ability to control image display via the shortcodes.

= 1.5.8 =
* Pro Feature: Adds the ability to control the size of images that are displayed.

= 1.5.7 =
* Feature: Adds ability to create Categories for Testimonials, and to only display Testimonials by Category.

= 1.5.6.1 =
* Fix: Fixes issue with "Fade" transition being locked out.

= 1.5.6 =
* Feature: Adds option to output Mystery Man avatar, if no other image is available.
* Minor Fix: Address CSS issue with sliding testimonials.

= 1.5.5.2 =
* Pro Feature: Adds Support for more Cycle2 Transitions.

= 1.5.5.1 =
* Compatibilty Option Update: Adds option to disable Cycle2 JavaScript that is included with Easy Testimonials.
* Minor Fix: Address bug in single testimonial shortcode output.

= 1.5.5 =
* Feature: Adds ability to display either the Excerpt or the Full Content of the Testimonial.
* Update: Addresses compatibility issues with the slider on several different Themes by moving Javascript to Footer.
* Pro Version Fix: Address bug with front-end testimonial submission.

= 1.5.4.1 =
* Update: set height of sidebar testimonial cycle container to match height of content inside.

= 1.5.4 =
* Feature: Adds Testimonial Cycle Widget to Appearance section.

= 1.5.3 =
* Update: Shortcode examples to help embed single testimonials.
* Feature: Support for Cycle 2 via Shortcode.

= 1.5.1 =
* Minor Fix: address bug in registration.

= 1.5 =
* New Pro Feature: Submit Testimonials from the front end!

= 1.4.5 =
* Fix: only output testimonial titles in the widget if the option is checked.

= 1.4.4 =
* Fix: output correct title with random testimonials.

= 1.4.3 =
* Feature: ability to output title of the testimonial with the shortcode.

= 1.4.2 =
* Fix: address mistargeted CSS in new theme.

= 1.4.1 =
* New Style Available: Clean Style.  With the clean style, you'll get smooth looking avatars and a clean, clear layout for your testimonial text.  Looks great with the TwentyThirteen theme!
* Update: Adds Classes to paragraph tags in the testimonial list, for easier CSS targeting.

= 1.4 =
* Fix: Featured Image should no longer break in your themes.
* Feature: Ability to set a number of random testimonials to output, with the shortcode or the widget.
* Feature: Ability to set a number of testimonials to appear via the standard testimonial shortcode.
* Feature: Ability to set Custom CSS via the Settings panel.

= 1.3.4.1 =
* Minor Fix: address warning message output when no pre-existing featured image support is found.

= 1.3.4 =
* Fix: address issue where Featured Image support was only applied to Testimonials, after activating this plugin.

= 1.3.3 =
* Fix: address some code quirks that were causing activation errors in certain web environments.

= 1.3.2 =
* Fix: no longer display Read More when looking at full list view.

= 1.3.1 =
* Fix: tiny CSS error.

= 1.3 =
* New Feature: Adds support for themes, for easy styling.  Includes a few themes.

= 1.2.1 =
* Minor edits.

= 1.2 =
* New Feature: Option to Display the Custom Fields above or below the Testimonials.  Defaults to Below.
* Update: Compatible with WordPress 3.6.

= 1.1 =
* New Feature: Testimonials Now Support Images!

= 1.0 =
* Released!

== Upgrade Notice ==

* 1.7.3: Update available!