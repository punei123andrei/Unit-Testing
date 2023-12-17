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
            ->with('admin_init', [$optionsHelper, 'updateOption'])
            ->andReturnNull();

        // Act
        $result = $optionsHelper->init();

        // Assert
        $this->assertInstanceOf(OptionsHelper::class, $result);
    }

}
