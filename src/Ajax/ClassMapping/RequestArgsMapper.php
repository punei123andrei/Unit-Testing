<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax\ClassMapping;
use Inpsyde\Ajax\ApiBase;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\ClassMapping
 * @since 1.0.1
 */

 class RequestArgsMapper
 {
    private $body;
    private $headers;
    private $timeout;
    private $redirection;
    private $blocking;
    private $httpversion;
    private $sslverify;

    public function __construct() {
        // Set default values
        $this->timeout = 15;
        $this->redirection = 5;
        $this->blocking = true;
        $this->httpversion = '1.1';
        $this->sslverify = false;
    }

    public function setBody(array $body): RequestMapper {
        $this->body = $body;
        return $this;
    }

    public function setTimeOut(int $timeout): RequestMapper {
        $this->timeOut = $timeout;
        return $this;
    }

    public function setRedirection(int $redirection): RequestMapper {
        $this->redirection = $redirection;
        return $this;
    }


    public function setBlocking(bool $blocking): RequestMapper {
        $this->blocking = $blocking;
        return $this;
    }

    public function setHttpVersion(string $httpversion): RequestMapper {
        $this->$httpversion = $httpversion;
        return $this;
    }

    public function setSslVerify(bool $sslverify): RequestMapper {
        $this->sslverify = $sslverify;
        return $this;
    }

    public function asArray(): array {
        return [
            'body' => $this->body,
            'headers' => ApiBase::headers(),
            'timeout' => $this->timeout,
            'redirection' => $this->redirection,
            'blocking' => $this->blocking,
            'httpversion' => $this->httpversion,
            'sslverify' => $this->sslverify,
        ];
    }
 }