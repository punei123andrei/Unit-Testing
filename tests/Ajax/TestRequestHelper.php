<?php

declare(strict_types=1);

namespace Inpsyde\Ajax;
use Inpsyde\Ajax\RequestHelper;
use PHPUnit\Framework\TestCase;
use WP_Error;

class TestRequestHelper extends TestCase
{
    public function testMakeGetRequestSuccess()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Mock the wp_remote_get function to return a successful response
        $this->mockWpRemoteGet('https://example.com', [], [], 'data');

        // Call the makeGetRequest method
        $result = $requestHelper->makeGetRequest('https://example.com');

        // Assert that the result is a string
        $this->assertIsString($result);
        $this->assertEquals('data', $result);
    }

    public function testMakeGetRequestFailure()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Call the makeGetRequest method
        $result = $requestHelper->makeGetRequest('https://example.com');
    }

    public function testVerifyNonceSuccess()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Set up $_POST data with a valid nonce
        $_POST['token'] = 'valid_nonce';

        // Call the verifyNonce method
        $result = $requestHelper->verifyNonce('test_action');

        // Assert that the result is true
        $this->assertTrue($result);
    }

    public function testVerifyNonceFailure()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Set up $_POST data with an invalid nonce
        $_POST['token'] = 'invalid_nonce';

        // Call the verifyNonce method
        $result = $requestHelper->verifyNonce('test_action');

        // Assert that the result is false
        $this->assertFalse($result);
    }

    public function testReturnPostDataSuccess()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Set up $_POST data with a valid nonce and keys
        $_POST['token'] = 'valid_nonce';
        $_POST['key'] = 'value';

        // Call the returnPostData method
        $result = $requestHelper->returnPostData(['key']);

        // Assert that the result is an array
        $this->assertIsArray($result);
        $this->assertEquals(['key' => 'value'], $result);
    }

    public function testReturnPostDataInvalidNonce()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Set up $_POST data with an invalid nonce
        $_POST['token'] = 'invalid_nonce';

        // Call the returnPostData method
        $result = $requestHelper->returnPostData(['key']);

        // Assert that the result is false
        $this->assertFalse($result);
    }

    public function testReturnPostDataMissingKeys()
    {
        // Create an instance of the RequestHelper class
        $requestHelper = new RequestHelper();

        // Set up empty $_POST data
        $_POST = [];

        // Call the returnPostData method
        $result = $requestHelper->returnPostData(['key']);

        // Assert that the result is false
        $this->assertFalse($result);
    }
}
