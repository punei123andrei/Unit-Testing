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
use Inpsyde\Ajax\Utilities\Requester;

/**
 * Defines a base for comunicating with the api
 *
 * @package Inpsyde\Ajax\Caching
 * @since 1.0.1
 */
class CacheResults 
{
    /**
     * Cache the API response using WordPress Transients API.
     *
     * @param string $url The API endpoint URL.
     * @param array $data The data to be sent in the API request.
     * @param string $cacheKey The unique cache key for the API response.
     * @param int $expiration The duration for which the cache should be valid, in seconds.
     *
     * @return string|\WP_Error The API response or a WP_Error object on failure.
     */
    public static function getCachedResponse(
        string $url,
        array $data = [],
        string $cacheKey = 'inpsyde',
        int $expiration = 3600
    ): string {

        $cachedData = get_transient($cacheKey);

        if ($cachedData !== false) {
            return $cachedData;
        }

        $request = new Requester();

        $apiResponse = $request->makeGetRequest($url, $data);

        if ($apiResponse) {
            set_transient($cacheKey, $apiResponse, $expiration);
        }

        return $apiResponse;
    }

}
