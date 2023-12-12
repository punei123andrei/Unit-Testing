<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax;

class RequestHelper
{
    /**
     * Cache the API response using Transients API.
     *
     * @param string $url The API endpoint URL.
     * @param array $data The data to be sent in the API request.
     * @param array $headers The headers for the API request.
     * @param string $action The action of the ajax request.
     * @param string $cache_key The unique cache key for the API response.
     * @param int $expiration The duration for which the cache should be valid, in seconds.
     *
     * @return string|WP_Error The API response or a WP_Error object on failure.
     */
    public static function cachedResults(
        string $url,
        array $data = [],
        array $headers = [],
        string $cache_key,
        int $expiration = 3600
        ): string|WP_Error
    {
        // Attempt to get cached data
        $cached_data = get_transient($cache_key);

        if ($cached_data !== false) {
            return $cached_data;
        }

        // If not cached, make API request
        $api_response = self::makeGetRequest($url, $data, $headers);

        if (!is_wp_error($api_response)) {
            // Cache the API response for a specified time (e.g., 1 hour)
            set_transient($cache_key, $api_response, $expiration);
        }

        return $api_response;
    }

    /**
    * Make a request to the API using wp_remote_post.
    *
    * @param string $url
    * @param array  $data
    * @param array  $headers
    *
    * @return string|WP_Error The API response or a WP_Error object on failure.
    */
    public static function makeGetRequest(
        string $url,
        array $data = [],
        array $headers = []
        ): string|WP_Error
    {
        $args = [
        'body' => $data,
        'headers' => $headers,
        'timeout' => 15,
        'redirection' => 5,
        'blocking' => true,
        'httpversion' => '1.1',
        'sslverify' => false,
        ];

        $response = wp_remote_get($url, $args);

        if (is_wp_error($response)) {
            return $response;
        }

        return wp_remote_retrieve_body($response);
    }

    /**
    * Verify the nonce token for a specified action..
    *
    * @param string $action The specific action for which the nonce is generated.
    *
    * @return string|bool Returns the sanitized nonce token if verification is successful,
    *                     or false if the verification fails.
    */
    public static function verifyNonce(string $action): string|bool
    {
        $token = isset($_POST['token']) ? sanitize_text_field(wp_unslash($_POST['token'])) : '';

        if (!wp_verify_nonce($token, $action)) {
            return false;
        }

        return true;
    }

    /**
    * Append a parameter to a given route.
    *
    * @param string $route The base route to which the parameter will be appended.
    * @param string $data  The parameter to append to the route.
    *
    * @return string The updated URL with the appended parameter.
    */
    public static function appendParam(string $route, string $data): string
    {
        $url = $route . '/' . $data;
        return $url;
    }

    /**
     * Get sanitized data from the global $_POST.
     *
     * @param array $keys Keys to retrieve from $_POST.
     * @return array Sanitized data.
     */
    public static function returnPostData(
        array $keys,
        string $nonceAction = 'inpsyde_token'
    ): array|bool {

        $token = isset($_POST['token']) ? sanitize_text_field(wp_unslash($_POST['token'])) : '';

        if (!wp_verify_nonce($token, $nonceAction)) {
            return false;
        }

        $sanitizedData = [];

        if (empty($_POST)) {
            return false;
        }

        foreach ($keys as $key) {
            if (isset($_POST[$key])) {
                $sanitizedData[] = sanitize_text_field(wp_unslash($_POST[$key]));
            }
        }

        return $sanitizedData;
    }
}
