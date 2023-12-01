<?php

declare(strict_types=1);

use Inpsyde\Ajax\ApiRequest;
use PHPUnit\Framework\TestCase;

class TestApiRequest extends TestCase {

    public function testMakeGetRequestSuccess() {
        // Mock the necessary functions and globals for the test
        $this->mockWordPressFunctions();

        // Mock the wp_remote_get function to return a success response
        $response = ['body' => 'mock_response'];
        $result = ApiRequest::makeGetRequest('https://example.com/api', [], []);

        // Assert that the result is the expected response
        $this->assertEquals('mock_response', $result);
    }

    public function testMakeGetRequestFailure() {
        // Mock the necessary functions and globals for the test
        $this->mockWordPressFunctions();

        // Mock the wp_remote_get function to return a WP_Error
        $result = ApiRequest::makeGetRequest('https://example.com/api', [], []);

        // Assert that the result is a WP_Error
        $this->assertInstanceOf(WP_Error::class, $result);
    }
}
