<?php

declare(strict_types=1);

use Inpsyde\Ajax\AjaxRequest;
use Inpsyde\Ajax\RequestDefinition;
use Inpsyde\Ajax\RequestHelper;
use PHPUnit\Framework\TestCase;

class TestAjaxRequest extends TestCase
{
    public function testAddRequest()
    {
        // Create an instance of the AjaxRequest class
        $ajaxRequest = new AjaxRequest();

        // Create a mock RequestDefinition
        $mockRequestDefinition = $this->createMock(RequestDefinition::class);

        // Add the mock RequestDefinition to the AjaxRequest instance
        $result = $ajaxRequest->add($mockRequestDefinition);

        // Assert that the result is an instance of AjaxRequest (for method chaining)
        $this->assertInstanceOf(AjaxRequest::class, $result);

        // Access the private property $requests and assert that it contains the mock RequestDefinition
        $requestsProperty = new ReflectionProperty(AjaxRequest::class, 'requests');
        $requestsProperty->setAccessible(true);
        $requests = $requestsProperty->getValue($ajaxRequest);

        $this->assertCount(1, $requests);
        $this->assertSame($mockRequestDefinition, $requests[0]);
    }

    public function testRegisterRequests()
    {
        // Create an instance of the AjaxRequest class
        $ajaxRequest = new AjaxRequest();

        // Create a mock RequestDefinition
        $mockRequestDefinition = $this->createMock(RequestDefinition::class);
        $mockRequestDefinition
            ->expects($this->once())
            ->method('route')
            ->willReturn('/mock-route');
        $mockRequestDefinition
            ->expects($this->once())
            ->method('headers')
            ->willReturn(['Content-Type' => 'application/json']);
        $mockRequestDefinition
            ->expects($this->once())
            ->method('action')
            ->willReturn('mock_action');
        $mockRequestDefinition
            ->expects($this->once())
            ->method('data')
            ->willReturn(['key' => 'value']);

        // Add the mock RequestDefinition to the AjaxRequest instance
        $ajaxRequest->add($mockRequestDefinition);

        // Expect custom filter hook to be triggered
        $this->expectFilter('inpsyde_ajax_callback');

        // Mock the private method addAjaxAction
        $this->setPrivateMethod($ajaxRequest, 'addAjaxAction', 'mock_action', function () {
            // Empty callback for testing
        });

        // Call the registerRequests method
        $ajaxRequest->registerRequests();
    }

    public function testSendData()
    {
        // Create an instance of the AjaxRequest class
        $ajaxRequest = new AjaxRequest();

        // Mock the RequestHelper class
        $mockRequestHelper = $this->getMockBuilder(RequestHelper::class)
            ->setMethods(['returnPostData', 'makeGetRequest'])
            ->getMock();

        // Mock the returnPostData method to return a user ID
        $mockRequestHelper
            ->expects($this->once())
            ->method('returnPostData')
            ->willReturn(['userId' => 123]);

        // Mock the makeGetRequest method to return a response
        $mockRequestHelper
            ->expects($this->once())
            ->method('makeGetRequest')
            ->with('/mock-route/123', [], ['Content-Type' => 'application/json'])
            ->willReturn(['mock_response' => 'data']);

        // Set the mock RequestHelper instance in the AjaxRequest class
        $this->setPrivateProperty($ajaxRequest, 'requestHelper', $mockRequestHelper);

        // Expect custom action hooks to be triggered
        $this->expectAction('inpsyde_before_send_ajax_data', '/mock-route/123', ['Content-Type' => 'application/json'], []);
        $this->expectAction('inpsyde_after_send_ajax_data', ['mock_response' => 'data']);

        // Mock the private method sendData
        $this->setPrivateMethod($ajaxRequest, 'sendData', '/mock-route', ['Content-Type' => 'application/json']);

        // Mock the wp_send_json function
        $this->expectOutputString('{"mock_response":"data"}');

        // Call the sendData method
        $ajaxRequest->sendData('/mock-route', ['Content-Type' => 'application/json']);
    }

    /**
     * Set a private property value for an object.
     *
     * @param object $object
     * @param string $propertyName
     * @param mixed  $value
     */
    private function setPrivateProperty(object $object, string $propertyName, $value)
    {
        $property = new ReflectionProperty(get_class($object), $propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    /**
     * Set a private method for an object.
     *
     * @param object $object
     * @param string $methodName
     * @param mixed  $value
     */
    private function setPrivateMethod(object $object, string $methodName, ...$args)
    {
        $method = new ReflectionMethod(get_class($object), $methodName);
        $method->setAccessible(true);
        $method->invokeArgs($object, $args);
    }
}
