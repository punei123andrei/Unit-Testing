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
use Inpsyde\Ajax\ClassMapping\UserCollection;
use Inpsyde\Ajax\Contracts\RequesterInterface;
use Inpsyde\Ajax\ClassMapping\RequestArgsMapper;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\Utilities
 * @since 1.0.1
 */

 class Requester implements RequesterInterface
 {

    public function makeGetRequest( array $body = [] ): bool|UserCollection {

      if(!isApiREachable(ApiBase::baseUrl())){
         return false;
      }

      $args = $this->mapRequestArgs($body);

      $response = wp_remote_get(ApiBase::baseUrl(), $args);
      $responseBody = wp_remote_retrieve_body($response);

      return $responseBody;

    }

    private function isApiReachable(string $url):bool {

        $response = wp_remote_head($url);

        if (is_wp_error($response)) {
            return false;
        }

        $responseCode = wp_remote_retrieve_response_code($response);
        return $responseCode === 200;

    }

    private function mapRequestArgs(array $body): array{

      $argsMapper = (new RequestArgsMapper())
      ->setBody($body);

      return $argsMapper->asArray();

    }
    

 }