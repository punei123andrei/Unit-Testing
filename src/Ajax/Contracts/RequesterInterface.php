<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax\Contracts;
use Inpsyde\Ajax\ClassMapping\UserCollection;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\Contracts
 * @since 1.0.1
 */

 interface RequesterInterface 
 {
    /**
    * Make a request to the API using wp_remote_post.
    * The url is extracted from the ApiBase
    * @param array  $body
    *
    * @return bool|string The API response or false if the api is not reacheable
    */
    public function makeGetRequest( array $body = [] ): bool|UserCollection;

    /**
     * Check if the API endpoint is reachable.
     *
     * @param string $url
     *
     * @return bool
     */
    private function isApiReachable(string $url):bool;

 }