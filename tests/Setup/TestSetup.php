<?php 

declare(strict_types=1);

use Inpsyde\Setup\Setup;
use PHPUnit\Framework\TestCase;

class TestSetup extends TestCase {

    public function testAddStyle() {
        // Create an instance of the Setup class
        $setup = new Setup();
        $result = $setup->addStyle('test_style', 'test.css', ['dependency'], '1.0', 'all');

        // Assert that the result is an instance of Setup (for method chaining)
        $this->assertInstanceOf(Setup::class, $result);
    }

    public function testAddScript() {
        // Create an instance of the Setup class
        $setup = new Setup();
        $result = $setup->addScript('test_script', 'test.js', ['dependency'], '1.0', true);

        // Assert that the result is an instance of Setup (for method chaining)
        $this->assertInstanceOf(Setup::class, $result);
    }

    public function testLocalizeScript() {
        // Create an instance of the Setup class
        $setup = new Setup();
        $result = $setup->localizeScript('test_script', 'test.js', ['dependency'], '1.0', true, 'test_page');

        // Assert that the result is an instance of Setup (for method chaining)
        $this->assertInstanceOf(Setup::class, $result);
    }
}
