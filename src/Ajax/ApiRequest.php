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

class ApiRequest 
{
 /**
 * Make a request to the API using wp_remote_post.
 *
 * @param string $url
 * @param array  $data
 * @param array  $headers
 *
 * @return string|WP_Error The API response or a WP_Error object on failure.
 */
public static function makeGetRequest(string $url, array $data = [], array $headers = []): string|WP_Error {
    $args = array(
        'body'        => $data,
        'headers'     => $headers,
        'timeout'     => 15,
        'redirection' => 5,
        'blocking'    => true,
        'httpversion' => '1.1',
        'sslverify'   => false, // You may want to set this to true in a production environment
    );
 
    $response = wp_remote_get($url, $args);
 
    if (is_wp_error($response)) {
        return $response;
    }
 
    return wp_remote_retrieve_body($response);
 }
}
