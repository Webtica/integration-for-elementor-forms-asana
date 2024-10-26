=== Integration for Elementor forms - Asana ===
Contributors: webtica
Tags: asana, elementor, forms, integration, tasks
Requires at least: 5.0
Tested up to: 6.6.2
Requires PHP: 7.0
Stable tag: 1.0.8
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

A lightweight but feature packed Asana integration for Elementor forms.
With this integration you can send your form data and tasks to Asana as easily as the standard integrations. 
Keeping performance in mind this integration doesn't add any additional scripts on page load. 
Feel free to post any feature requests and possible issues.

== Installation ==

= Minimum Requirements =

* WordPress 5.0 or greater
* PHP version 7.0 or greater
* MySQL version 5.0 or greater
* [Elementor Pro](https://elementor.com) 3 or greater

= We recommend your host supports: =

* PHP version 7.4 or greater
* MySQL version 5.6 or greater
* WordPress Memory limit of 64 MB or greater (128 MB or higher is preferred)

= Installation =

1. Install using the WordPress built-in Plugin installer, or Extract the zip file and drop the contents in the `wp-content/plugins/` directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Pages > Add New
4. Press the 'Edit with Elementor' button.
5. Drag and drop the form widget of Elementor Pro from the left panel onto the content area, and find the Asana action in the "Actions after submit" dropdown.
6. Fill your Asana data and Key and you are all set. All users will be added after they submit the form.

== Frequently Asked Questions ==

**Why is Elementor Pro required?**

Because this integration works with the Form Widget, which is a Elementor Pro unique feature not available in the free plugin.

**Can I still use other integrations if I install this integration?**

Yes, all the other form widget integrations will be available.

== Changelog ==

= 1.0.8 - 2024-10-26 = 
* COMP - Tested Elementor PRO up to 3.24.4
* COMP - Tested Elementor up to 3.24.7
* COMP - Tested WordPress up to 6.6.2

= 1.0.7 - 2024-03-23 = 
* COMP - Tested WordPress up to 6.5
* COMP - Tested Elementor up to 3.20.2
* COMP - Tested Elementor PRO up to 3.20.1

= 1.0.6 - 2023-07-23 = 
* COMP - Change required PHP version to 7
* COMP - Tested WordPress up to 6.3
* COMP - Tested Elementor up to 3.14.1
* COMP - Tested Elementor PRO up to 3.14.1

= 1.0.5 - 2022-11-05 = 
* Tested Elementor PRO up to 3.8.0
* Tested Elementor up to 3.8.0
* Tested WordPress up to 6.1

= 1.0.4 - 2022-08-12 = 
* New - Allow the assignee to be empty.
* COMP - Tested Elementor up to 3.7.0
* COMP - Tested Elementor PRO up to 3.7.3

= 1.0.3 - 2022-07-15 =
* Fix when due date is empty set it to 30 days from today
* Made the description/notes field optional
* Tested Elementor PRO up to 3.7.2
* Tested Elementor up to 3.6.7
* Tested WordPress up to 6.0.1

= 1.0.2 - 2022-05-08 =
* Fix bug when not setting the notes field ID
* Tested Elementor PRO up to 3.6.5
* Tested Elementor up to 3.6.5
* Tested WordPress up to 6.0.0

= 1.0.1 - 2022-03-13 =
* Tested Elementor PRO up to 3.6.3
* Tested Elementor up to 3.5.6
* Tested WordPress up to 5.9.2

= 1.0.0 - 2022-01-23 =
* Initial Release