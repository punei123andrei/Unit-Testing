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
use Inpsyde\Ajax\Caching\CacheResults;
use Inpsyde\Ajax\Utilities\NonceVerify;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\Utilities
 * @since 1.0.1
 */

 class SendData 
 {

        public static function sendAjaxResponse(string $url, array $data = [], $action)
        {

            $nonceField = 'token';
            $nonce = NonceVerify::getNonceFromRequest($nonceField);
            if (!$nonce || NonceVerify::verify($nonce, $action)) {
                wp_send_json_error('Nonce verification failed.');
                return;
            }

            $self = new Self();
            $response = $self->fetchData($url, $data);

            if (is_wp_error($response)) {
                wp_send_json_error($response->get_error_message());
            }

            wp_send_json($response);

        }

        private function fetchData(string $url, array $data = []): string
        {

            $request = new CacheResults();
            
            $response = $request->getCachedResponse($url, $data);
        
           return $response;

        }

 }