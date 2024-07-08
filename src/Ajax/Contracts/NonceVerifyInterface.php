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
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\Contracts
 * @since 1.0.1
 */

 interface NonceVerifyInterface
 {

     /**
     * Verify the nonce token for a specified action.
     *
     * @param string $nonce The nonce to verify.
     * @param string $action The specific action for which the nonce is generated.
     *
     * @return bool Returns true if verification is successful, or false if the verification fails.
     */
    public static function verify(string $nonce, string $action): bool;

    /**
     * Sanitize and retrieve a nonce from a request.
     *
     * @param string $field The field in the request containing the nonce.
     * @param string $method The request method ('POST', 'GET', etc.)
     *
     * @return string The sanitized nonce or null if not found.
     */
    public static function getNonceFromRequest(
        string $field,
        string $method = 'POST'
        ): ?string;


 }