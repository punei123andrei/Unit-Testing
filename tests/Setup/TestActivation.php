<?php 
declare(strict_types=1);

use Inpsyde\Setup\Activation;
use PHPUnit\Framework\TestCase;

class TestActivation extends TestCase {

    public function testCreateTestPage() {
        // Mock the necessary functions and globals for the test
        $this->mockWordPressFunctions();

        // Mock get_current_user_id to return a user ID
        $this->method('get_current_user_id')->willReturn(1);

        // Mock get_page_by_title to return null, simulating that the page does not exist
        $this->method('get_page_by_title')->willReturn(null);

        // Mock wp_insert_post to be called once
        $this->method('wp_insert_post');

        // Call the createTestPage method
        Activation::createTestPage();
    }

    private function mockWordPressFunctions() {
        // Check if the function is not already defined before declaring it
        if (!function_exists('get_current_user_id')) {
            // Mock the get_current_user_id function
            function get_current_user_id() {
                return 1; // return a user ID for testing
            }
        }

        // Check if the function is not already defined before declaring it
        if (!function_exists('get_page_by_title')) {
            // Mock the get_page_by_title function
            function get_page_by_title($title, $output, $post_type) {
                return $GLOBALS['__get_page_by_title_result'] ?? null;
            }
        }

        // Check if the function is not already defined before declaring it
        if (!function_exists('wp_insert_post')) {
            // Mock the wp_insert_post function
            function wp_insert_post($post) {
                $GLOBALS['__wp_insert_post_args'] = $post;
            }
        }

        // Check if the function is not already defined before declaring it
        if (!function_exists('flush_rewrite_rules')) {
            // Mock the flush_rewrite_rules function
            function flush_rewrite_rules() {
                // do nothing for testing purposes
            }
        }
    }


    private function expectFunctionCalledOnce($functionName, ...$expectedArgs) {
        $mock = $this->getMockBuilder('stdClass')
            ->setMethods([$functionName])
            ->getMock();

        $mock->expects($this->once())
            ->method($functionName)
            ->with(...$expectedArgs);

        $this->setToContainer($functionName, $mock);

        return $mock;
    }

    private function setToContainer(...$keysAndValues) {
        $container = $this->getContainer();

        foreach (array_chunk($keysAndValues, 2) as [$key, $value]) {
            $container[$key] = $value;
        }
    }

    private function getContainer() {
        if (!isset($GLOBALS['__container'])) {
            $GLOBALS['__container'] = [];
        }

        return $GLOBALS['__container'];
    }
}
