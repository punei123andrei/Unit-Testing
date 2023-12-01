<?php

declare(strict_types=1);

namespace Inpsyde\Ajax;
use Inpsyde\Ajax\ApiBase;
use PHPUnit\Framework\TestCase;

class TestApiBase extends TestCase
{
    public function testVersion()
    {
        // Call the version method
        $result = ApiBase::version();

        // Assert that the result is a string
        $this->assertIsString($result);

        // Assert that the result is 'v1'
        $this->assertEquals('v1', $result);
    }

    public function testBaseUrl()
    {
        // Call the baseUrl method with a sample endpoint
        $result = ApiBase::baseUrl('/sample-endpoint');

        // Assert that the result is a string
        $this->assertIsString($result);

        // Assert that the result is the correct base URL
        $this->assertEquals('https://jsonplaceholder.typicode.com/sample-endpoint', $result);
    }

    public function testBaseUrlWithUseService()
    {
        // Call the baseUrl method with a sample endpoint and useService set to false
        $result = ApiBase::baseUrl('/sample-endpoint', false);

        // Assert that the result is a string
        $this->assertIsString($result);

        // Assert that the result is the correct base URL without using the service
        $this->assertEquals('https://jsonplaceholder.typicode.com/sample-endpoint', $result);
    }

    public function testHeaders()
    {
        // Call the headers method with additional items
        $result = ApiBase::headers(['Content-Type' => 'application/json']);

        // Assert that the result is an array
        $this->assertIsArray($result);

        // Assert that the result contains the default 'Accept' header
        $this->assertArrayHasKey('Accept', $result);

        // Assert that the result contains the additional 'Content-Type' header
        $this->assertArrayHasKey('Content-Type', $result);
        $this->assertEquals('application/json', $result['Content-Type']);
    }
}
