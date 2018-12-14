=== Limit Heartbeat ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: limit, disable, control, heartbeat, api
Requires at least: 4.4
Tested up to: 5.0
Requires PHP: 7.2
Multisite support: No
Stable tag: 1.1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: LMTHRT

Limits the Heartbeat API in WordPress to certain areas of the site (and a longer pulse interval) to reduce AJAX queries and improve resource usage.

== Description ==

Limits the Heartbeat API in WordPress to certain areas of the site (and a longer pulse interval) to reduce AJAX queries and improve resource usage.

* [**Join our FREE Facebook group for support**](https://www.facebook.com/groups/littlebizzy/)
* [**Worth a 5-star review? Thank you!**](https://wordpress.org/support/plugin/limit-heartbeat-littlebizzy/reviews/?rate=5#new-post)
* [Plugin Homepage](https://www.littlebizzy.com/plugins/limit-heartbeat)
* [Plugin GitHub](https://github.com/littlebizzy/limit-heartbeat)

#### Current Features ####

Limits the Heartbeat API in WordPress, which can slow down sites especially on shared web hosting servers (or get you in trouble with resource overage on certain hosting companies).

By default it will disable the Heartbeat on frontend, while gently limiting the Heartbeat in Dashboard and Post Editor areas. We recommend not disabling it complete on these 2 areas whenever possible. If further restriction is needed, consider only disabling the Heartbeat on the Dashboard area before going into more aggressive disabling on the Post Edito area. This is because the Heartbeat API provides important data-saving functionality on the editor screens, making things like Auto-save drafts and post revisions possible, which can truly save you in certain circumstances (e.g. accidentally deleting a post, closing your browser window, power outages, lost or stolen computer, etc).

Developer notes 1.0.0: I have added an inline javascript code to avoid WP changes in the interval via javascript (only on edit page, see last email) and it works well. Ironically, this patch is not necessary for Gutenberg systems (tested on the recently released WP 5.0 version), where the interval set on the server via WP filters is preserved in the client side. This plugin introduces a new helper class "context", that identifies several execution contexts (front, admin, cron, wp-cli, gutenberg page, etc.) and I am going to add to the plugin boilerplate files.

#### Compatibility ####

This plugin has been designed for use on [SlickStack](https://slickstack.io) web servers with PHP 7.2 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and usability reasons, we highly recommend avoiding WordPress Multisite for the vast majority of projects.

Any of our WordPress plugins may also be loaded as "Must-Use" plugins by using our free [Autoloader](https://github.com/littlebizzy/autoloader) script in the `mu-plugins` directory.

#### Defined Constants ####

    /* Plugin Meta */
    define('DISABLE_NAG_NOTICES', true);

    /* Limit Heartbeat Functions */
    define('LIMIT_HEARTBEAT_DISABLE_DASHBOARD', false);
    define('LIMIT_HEARTBEAT_DISABLE_EDITOR', false);
    define('LIMIT_HEARTBEAT_DISABLE_FRONTEND', true);
    define('LIMIT_HEARTBEAT_INTERVAL_DASHBOARD', 600);
    define('LIMIT_HEARTBEAT_INTERVAL_EDITOR', 30);
    define('LIMIT_HEARTBEAT_INTERVAL_FRONTEND', 300);

#### Technical Details ####

* Prefix: LMTHRT
* Parent Plugin: [**Speed Demon**](https://wordpress.org/plugins/speed-demon-littlebizzy/)
* Disable Nag Notices: [Yes](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices#Disable_Nag_Notices)
* Settings Page: No
* PHP Namespaces: Yes
* Object-Oriented Code: Yes
* Includes Media (images, icons, etc): No
* Includes CSS: No
* Database Storage: Yes
  * Transients: No
  * WP Options Table: Yes
  * Other Tables: No
  * Creates New Tables: No
  * Creates New WP Cron Jobs: No
* Database Queries: Backend Only (Options API)
* Must-Use Support: [Yes](https://github.com/littlebizzy/autoloader)
* Multisite Support: No
* Uninstalls Data: Yes

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep these conditions in mind, and refrain from slandering, threatening, or harassing our team members in order to get a feature added, or to otherwise get "free" support. The only place you should be contacting us is in our free [**Facebook group**](https://www.facebook.com/groups/littlebizzy/) which has been setup for this purpose, or via GitHub if you are an experienced developer. Thank you!

== Installation ==

1. Upload to `/wp-content/plugins/limit-heartbeat-littlebizzy`
2. Activate via WP Admin > Plugins
3. Test plugin is working:

By default, the Heartbeat API is disabled on the frontend and slightly limited on Dashboard and Editor contexts. You can adjust these default settings using the provided defined constants.

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is no settings page for better performance, please use the defined constants to adjust settings.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, use our Facebook group.

== Changelog ==

= 1.1.0 =
* PBP boilerplate 1.1.0

= 1.0.0 =
* initial release
* PBP boilerplate 1.0.0
* tested with PHP 7.0
* tested with PHP 7.1
* tested with PHP 7.2
* tested with 5.6 (no fatal errors only)
* uses PHP namespaces
* object-oriented codebase
