<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax\Utilities;
use Inpsyde\Ajax\Contracts\NonceVerifyInterface;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax
 * @since 1.0.1
 */

 class NonceVerify implements NonceVerifyInterface
 {

    public static function verify(string $nonce, string $action): bool
    {
        return wp_verify_nonce($nonce, $action) !== false;
    }

    public static function getNonceFromRequest(string $field, string $method = 'POST'): ?string
    {
        $request = ($method === 'POST') ? $_POST : $_GET;
        return isset($request[$field]) ? sanitize_text_field(wp_unslash($request[$field])) : null;
    }

 }