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

class ApiUsers
{

   /**
    * @var string The api base url
    */
    const API_BASE = 'https://jsonplaceholder.typicode.com';
 
    /**
     * The version of API used
     *
     * @return string
     */
    public static function version() {
       return 'v1';
    }
    /**
     * Get the base url for API
     *
     * @param string $endpoint
     * @param bool $use_service
     * @param bool $is_use_version
     * @return string
     */
    public static function baseUrl(string $endpoint, bool $use_service = true) {
 
       return trailingslashit(self::API_BASE) . ltrim($endpoint, '/');
 
    }
    /**
     * Get the headers with the authorization token
     *
     * @param array $items
     * @return string[]
     */
    public static function headers(array $items = []) {
          $items = array_merge([
              'Accept' => 'application/json'
          ], $items);
       
          return $items;
      }


}