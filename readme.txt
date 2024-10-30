=== ChillThemes Widgets ===
Contributors: chillthemes
Donate link: http://chillthemes.com/donate
Tags: chillthemes, authors, dribbble, feedburner, mailchimp, recent-comments, recent-posts, widgets
Requires at least: 3.4
Tested up to: 3.6
Stable tag: 2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Enables custom widgets for use in any WordPress theme, this plugin was made specifically for any of our Chill Themes.

== Installation ==

= Using The WordPress Plugin Upload =

1. Log in and navigate to Plugins &rarr; Add New.
2. Type **ChillThemes Widgets** into the Search input and click the **Search Plugin** button.
3. Locate the **ChillThemes Widgets** in the list of search results and click the **Install Now** button.
4. Click the **Activate Plugin** link at the bottom of the install screen.
5. You're done! You'll see a few new widgets in Appearance -> Widgets.

= Using FTP =

1. Download the **ChillThemes Widgets** plugin from WordPress.org.
2. Unzip the package and move it to your plugins directory.
3. Log into WordPress and navigate to the **Plugins** screen.
4. Locate **ChillThemes Widgets** in the list of available plugins and click the **Activate** link.
5. You're done! You'll see a few new widgets in Appearance -> Widgets.

== Changelog ==

= 2.5 =
* Fixed Flickr widget error.
* Changed default username in the Dribbble widget.
* Updated font awesome to the latest version.

= 2.4 =
* Fixed class initiation error.

= 2.3 =
* Changed the way the Flickr widget retrieves images.

= 2.2 =
* Added filters to various widgets to override the default settings on a theme-by-theme basis.
* Filters Added:
	= apply_filters( 'chillthemes_dribbble_limit', '' )
	= apply_filters( 'chillthemes_feedburner_description', '' )
	= apply_filters( 'chillthemes_feedburner_placeholder', '' )
	= apply_filters( 'chillthemes_feedburner_input', '' )
	= apply_filters( 'chillthemes_flickr_limit', '' )
	= apply_filters( 'chillthemes_list_authors_limit', '' )
	= apply_filters( 'chillthemes_mailchimp_description', '' )
	= apply_filters( 'chillthemes_mailchimp_placeholder', '' )
	= apply_filters( 'chillthemes_mailchimp_input', '' )
	= apply_filters( 'chillthemes_portfolio_limit', '' )
	= apply_filters( 'chillthemes_recent_comments_limit', '' )
	= apply_filters( 'chillthemes_recent_images_limit', '' )
	= apply_filters( 'chillthemes_recent_posts_limit', '' )

= 2.1 =
* Rewrote the way the Flickr widget retrieves photos.
* Modified the markup that the List Authors, Portfolio & Recent Comments outputs.

= 2.0 =
* Modified the styling for the Social Profiles widget.

= 1.9 =
* Added wp_reset_query(); to the portfolio widget.

= 1.8 =
* Fixed issue that caused the Recent Comments widget to return the incorrect date.

= 1.7 =
* Fixed placeholder issue with the MailChimp widget.

= 1.6 =
* Added wp_reset_query(); to the Recent Images widget.

= 1.5 =
* Added Flickr widget.

= 1.4 =
* Added shot title and date below the image for the Dribbble widget.
* Added image title and date below the image for the Recent Images widget.
* Added a Portfolio widget that is only enabled if our Portfolio plugin is installed.

= 1.3 =
* Change input field type from *text* to *number* if that particular field must contain an integer.

= 1.2 =
* Added an Advertisement, and Social Profiles widget.

= 1.1 =
* Added Dribbble, Feedburner, and Recent Images widget.

= 1.0 =
* Fresh out of the oven, careful it's hot!