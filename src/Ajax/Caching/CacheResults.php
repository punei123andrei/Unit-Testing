<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax\Caching;

/**
 * Defines a base for comunicating with the api
 *
 * @package Inpsyde\Ajax\Caching
 * @since 1.0.1
 */
class CacheResulsts 
{
    /**
     * Cache the API response using WordPress Transients API.
     *
     * @param string $url The API endpoint URL.
     * @param array $data The data to be sent in the API request.
     * @param array $headers The headers for the API request.
     * @param string $cacheKey The unique cache key for the API response.
     * @param int $expiration The duration for which the cache should be valid, in seconds.
     * @param callable $requestFunction The function to fetch the API response.
     *
     * @return string|\WP_Error The API response or a WP_Error object on failure.
     */
    public static function getCachedResponse(
        string $url,
        array $data,
        array $headers,
        string $cacheKey,
        int $expiration,
        callable $requestFunction
    ): UsersCollection {
        $cachedData = get_transient($cacheKey);

        if ($cachedData !== false) {
            return $cachedData;
        }

        $apiResponse = call_user_func($requestFunction, $url, $data, $headers);

        if (!is_wp_error($apiResponse)) {
            set_transient($cacheKey, $apiResponse, $expiration);
        }

        return $apiResponse;
    }

}
