== Description ==

This plugin creates a custom WordPress page to display an HTML table listing users fetched from the JSONPlaceholder API. The table includes user details such as ID, name, and username. Clicking on any user's details triggers an request to the API's "user details" endpoint, showing the details without reloading the page.

* Contributors: Andrei Punei
* Tags: wordpress, plugin, JSONPlaceholder, API
* Requires at least: 5.0
* Tested up to: 6.4
* Stable tag: trunk

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit an arbitrary URL (custom endpoint) like `https://example.com/inpsyde-users-test/` to see the HTML table.

== Frequently Asked Questions ==

= How does the plugin fetch user data? =

The plugin makes HTTP requests from the server-side (PHP) to the JSONPlaceholder API (/users endpoint) to fetch user data.

= Can I customize the endpoint URL and data retrieval? =

Yes, you can customize the endpoint URL and choose the data to retrieve. Visit the plugin's settings page in the WordPress admin dashboard to set your preferred endpoint URL and configure the number of users to import, along with other custom data.

Note: The default endpoint URL is set as `/inpsyde-users-test/`.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
Upgrade to access the user table on custom endpoints.

== Arbitrary section ==

You may provide additional sections if needed for a more complicated plugin.

* Use an arbitrary URL endpoint.
* Ensure asynchronous requests for user details.
* Apply server-side caching for HTTP requests.
