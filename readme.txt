===Estatik===
Contributors: Estatik
Donate link: http://estatik.net/
Tags: wordpress real estate, property, properties, estate, real estate, listing, listings, property listing, realtor, agent, house, wordpress real estate plugin, broker, mls, idx, property import, real estate agent, real estate website, property management
Requires at least: 3.9
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Beautifully designed, simple in use, customizable. WordPress real estate plugin Estatik is a worthy choice for single agents and real estate portals

== Description ==

Estatik Simple plugin helps you create easy-to-use WordPress real estate website. Main features of Estatik Simple: clean design, customizable fields (unlimited number of new fields), responsive layout, comprehensive interface,
photo gallery,  search widget, Google map, unlimited categories/types/statuses, labels, language files. Check out http://estatik.net/ for more information.
Visit [demo](http://demo.estatik.net/) of Estatik plugin on one of deafult WordPress themes or [demo](http://themes.estatik.net/) on Estatik custom theme.

 
Estatik Pro features:

* listing manager (unlimited categories/types/statuses, sorting)
* frontend property management (submitting properties after admin approval)
* responsive layouts (table/list/2 columns view - for list view; image right, left, center - single property view)
* agents support (agent profile, ratings, contact information)
* map view via shortcode and widget
* meta information fields 
* CSV import
* customizable fields (features, appliances, addresses, currenies, dimensions, neighbourhood)
* social sharing feature (Twitter, Facebook, Google +)
* PDF file generation
* image gallery and video tour
* extra layout options for single property page and list (table/2 columns/list views)
* slideshow widget (vertical/horizontal layouts, select show category, type, per id, etc.)
* request information widget
* search widget with 10 yes/no fields
* language files

Shortcodes:

* [es_my_listing] = All listings list
* [es_agents] = All agents list
* [es_featured_props] = Featured properties list
* [es_latest_props] = Latest properties list
* [es_cheapest_props] = Cheapest properties list
* [es_profile] = Profile of agent page
* [es_prop_management] = Properties management
* [es_register] = Agents registration
* [es_login] = Log in page
* [es_property_map] = All properties
* [es_property_map type="for-rent"] = Properties for rent
* [es_property_map type="for-sale"] = Properties for sale
* [es_property_map prop_id="12, 24, 26"] = Specific properties
* [es_latest_props layout="table"] = Table listings layout
* [es_latest_props layout="list"] = List listing layout
* [es_latest_props layout="2columns"] = 2 columns listing layout

Visit official [Estatik Pro page](http://estatik.net/product/estatik-professional/) to get full information.

Related services:

* [MLS/IDX integration](http://estatik.net/mls-integration-service/)
* [Customization](http://estatik.net/estatik-customization/)
* [Installation and configuration](http://estatik.net/installation-setup/)

Support:

* [Step-by-step guide](http://estatik.net/estatik-plugin-documentation/)
* [Video tutorial](https://www.youtube.com/channel/UCHhq46H033xh7XLsV8GqY3Q)
* [Frequently Asked Questions](http://estatik.net/faq/)


== Installation ==


1. Upload files of Estatik plugin to the `/wp-content/plugins/` 
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add your properties via Estatik >> Add property and add them to menus. 

Please visit our detailed Step-by-Step guide here >> http://estatik.net/estatik-plugin-documentation/
 

== Frequently Asked Questions ==


= Does Estatik work with any Wordpress theme? =

Yes, it does. Beside Estatik themes, you can use it with any Wordpress theme.

= What is difference between simple and pro versions? =

Please check out this information and choose your version here >> http://estatik.net/choose-your-version/.

= Can I have free support? =

Sure, you get free support for any of Estatik version. Please contact us >> http://estatik.net/contact-us/ and we will help you with any issues.

= Where I can read documentation? =

Please check these pages >> http://estatik.net/estatik-plugin-documentation/. 

= When I click on details page it says 404 Error: page not found. =

Please go to Settings >> Permalinks and click Save button there. After go to site and view result.

= PDF button is not working. What am I doing wrong? = 

If you click on PDF button and it says that file is corrupted or opens nothing, please make sure that you have pdf lib installed at your host provider and php version is 5.3.x and higher.

= I created a page of category/status/type but listings are not displayed correctly. How to fix that? = 

If you assigned to menu a categoty of properties but when clicking on it, it doesn’t look like My listing page, just add shortcode – [es_category_property_listing] into archive.php file of your current theme in while loop:

while ( have_posts() ) { the_post();

echo do_shortcode(‘[es_category_property_listing]’);

}

Please [contact us](http://estatik.net/contact-us/) if you do not know how to do that. Our team will check and do it for you.



== Screenshots ==


1. List view
2. 2 columns view
3. Table view
4. Single property page
5. Agents list
6. Front-end management page
7. Map view
8. Add new property
9. Add new property - address
10. Admin - Media
11. Agents
12. Admin - features
13. Map view settings


== Changelog ==


= 1.0.0 =
* Data manager is added.
* Property listings shortcodes are added.
* Search widget is added.

= 1.0.1 =
* jQuery conflicts fixed
* language files added

= 1.1.1 =
* Issue with Google Map API fixed
* Translation into Russian added

= 2.0 = 
* Safari responsive layout issue fixed
* Google Map icons issue fixed 
* PRO - HTML editor added
* PRO - Lightbox on single property page added
* PRO - Tabs issue fixed
* PRO - Map view shortcodes added
* PRO - Map view widget added
* PRO - Option to use different layouts added

Please read full description of new release [here](http://estatik.net/estatik-2-0-terrific-released-map-view-lots-of-major-fixes-done/)