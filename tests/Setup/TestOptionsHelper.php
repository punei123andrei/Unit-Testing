<?php 

declare(strict_types=1);

use Inpsyde\Setup\OptionsHelper;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Functions;

class TestOptionsHelper extends TestCase {
    public function setUp(): void {
        parent::setUp();
        Monkey\setUp();
    }

    public function tearDown(): void {
        Monkey\tearDown();
        parent::tearDown();
    }

    public function testInit() {
        // Arrange
        $optionsHelper = new OptionsHelper();

        // Mock the add_action function
        Functions\expect('add_action')
            ->zeroOrMoreTimes()
            ->with('admin_init', [$optionsHelper, 'insertOption'])
            ->andReturnNull();

        // Act
        $result = $optionsHelper->init();

        // Assert
        $this->assertInstanceOf(OptionsHelper::class, $result);
    }

    public function testInsertOption() {
    // Arrange
    $optionsHelper = new OptionsHelper();

    // Mock the $_POST array
    $_POST = ['nonce' => 'mocked_nonce', 'test_key' => 'test_value'];

    // Mock the wp_verify_nonce function
    Functions\expect('wp_verify_nonce')
        ->once()
        ->with('mocked_nonce', 'inpsyde_set_api')
        ->andReturn(true);

    // Mock the sanitize_text_field function
    Functions\expect('sanitize_text_field')
        ->once()
        ->with('test_value')
        ->andReturn('sanitized_value');

    // Mock the update_option function
    Functions\expect('update_option')
        ->once()
        ->with('test_key', 'sanitized_value')
        ->andReturn(true);

    // Mock the wp_unslash function
    Functions\expect('wp_unslash')
        ->once()
        ->with('mocked_value')
        ->andReturn('unslashed_value');

    // Act
    $result = $optionsHelper->insertOption('test_key');

    // Assert
    $this->assertTrue($result);
    
    }
}
