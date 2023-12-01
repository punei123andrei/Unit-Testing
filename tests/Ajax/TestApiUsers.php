<?php

declare(strict_types=1);

use Inpsyde\Ajax\ApiUsers;
use PHPUnit\Framework\TestCase;

class TestApiUsers extends TestCase {

    public function testVersion() {
        // Create an instance of the ApiUsers class
        $version = ApiUsers::version();

        // Assert that the result is a string
        $this->assertIsString($version);
    }

    public function testBaseUrl() {
        // Create an instance of the ApiUsers class
        $endpoint = '/users';
        $baseUrl = ApiUsers::baseUrl($endpoint);

        // Assert that the result is a string and contains the correct base URL
        $this->assertIsString($baseUrl);
        $this->assertStringContainsString(ApiUsers::API_BASE, $baseUrl);
        $this->assertStringContainsString($endpoint, $baseUrl);
    }

    public function testHeaders() {
        // Create an instance of the ApiUsers class
        $headers = ApiUsers::headers();

        // Assert that the result is an array and contains the default 'Accept' header
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Accept', $headers);
        $this->assertEquals('application/json', $headers['Accept']);
    }
}
