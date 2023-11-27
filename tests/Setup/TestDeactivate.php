<?php

declare(strict_types=1);

use Inpsyde\Setup\Deactivate;
use PHPUnit\Framework\TestCase;

class TestDeactivate extends TestCase {

    public function testRemoveTestPage() {
        // Mock necessary functions for the test
        $this->method('get_page_by_title')->willReturn((object)['ID' => 1]);
        $this->method('wp_delete_post');

        // Call the removeTestPage method
        $result = self::invokePrivateMethod(Deactivate::class, 'removeTestPage');

        // You can add additional assertions based on the expected behavior of removeTestPage

        // Example: Assert that the result is null
        $this->assertNull($result);
    }

    // Helper method to invoke private methods for testing
    private static function invokePrivateMethod($className, $methodName, ...$args) {
        $class = new ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs(null, $args);
    }
}
