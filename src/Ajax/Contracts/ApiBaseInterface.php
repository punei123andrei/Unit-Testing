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

/**
 * Defines a base for comunicating with the api
 *
 * @package Inpsyde\Ajax\Contracts
 * @since 1.0.1
 */
interface ApiBaseInterface
{
    /**
     * Get the base url for API
     *
     * @param string $endpoint
     * @param bool $use_service
     * @param bool $is_use_version
     * @return string
     */
    public static function baseUrl(string $endpoint): string;

    /**
     * Get the headers with the authorization token
     *
     * @param array $items
     * @return string[]
     */
    public static function headers(array $items = []): array;

}
