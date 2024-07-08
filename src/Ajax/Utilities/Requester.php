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

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\Utilities
 * @since 1.0.1
 */

 class Requester
 {

    public function makeGetRequest(string $url, array $body = [] ): bool|string {

      if(!$this->isApiReachable($url)){
         return false;
      }

      $args = $this->mapRequestArgs($body);

      $response = wp_remote_get($url, $args);

      $responseBody = wp_remote_retrieve_body($response);

      return $responseBody;

    }

     public function isApiReachable(string $url) {

        $response = wp_remote_head($url);

        if (is_wp_error($response)) {
            return false;
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        return $responseCode === 200;

    }

    private function mapRequestArgs(array $body = []): array{

      $argsMapper = new RequestArgsMapper();

      if(!empty($body)) {
         $argsMapper->setBody($body);
      }

      return $argsMapper->asArray();

    }
    

 }