# VIP Club Plugin

* This plugin is used with wp-members to create a system that requires users to sign up as a member to get exclusive vip club member deals.
* It has a vip club page which explains how it works with a login.
* It also uses the Specials Custom post type from the wp-plugin-cpt.
* If not signed in when viewing the special index it only shows public specials.
* If you are signed in then the special index shows exclusive VIP Club specials as well.
* Has a ```Settings->VIP Club``` settings page for inital setup of integration to WP-Members plugin
* Has a ```Settings->WP-Members``` settings page for WP-Members plugin setup.

## Requires
  * [Piklist Plugin](https://en-ca.wordpress.org/plugins/piklist/)
  * [WP-Members](https://en-ca.wordpress.org/plugins/wp-members/) [docs](https://rocketgeek.com/plugins/wp-members/docs/)
  * [wp-theme-twig](https://github.com/fgms/wp-theme-twig) and child theme
  * [wp-plugin-cpt](https://github.com/sturple/wp-plugin-cpt) (Specials Custom Post Type)


## Setup
* add to composer ``` fgms/wp-plugin-vip ```
* run the command ```composer update```
* Install WP-Members Plugin
* [Setup WP-Members Plugin](docs/wp-members-setup.md)
* [Setup VIP Club Settings](docs/vip-club-setup.md)




## shortcodes

### [vip_specials_active]
