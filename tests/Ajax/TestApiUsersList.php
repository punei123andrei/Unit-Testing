<?php

declare(strict_types=1);

use Inpsyde\Ajax\ApiUsersList;
use PHPUnit\Framework\TestCase;

class TestApiUsersList extends TestCase {

    protected function tearDown(): void {
        parent::tearDown();
        unset($_POST['token']);
        unset($_POST['userId']);
        unset($GLOBALS['wp_actions']);
        unset($GLOBALS['wp_filter']);
    }

    public function userListDataProvider(): array {
        return [
            ['valid_token', '{"mock_response":"user_list"}'],
            ['invalid_token', '{"error":"Invalid token"}'],
        ];
    }

    /**
     * @dataProvider userListDataProvider
     */
    public function testUserList(string $token, string $expectedJson): void {
        $apiUsersList = new ApiUsersList();
        $this->mockWordPressFunctions($token);

        $_POST['token'] = $token;

        $this->assertJsonStringEqualsJsonString($expectedJson, $this->captureOutput([$apiUsersList, 'userList']));
    }

    public function testSingleUser(): void {
        $apiUsersList = new ApiUsersList();
        $this->mockWordPressFunctions('valid_token');

        $_POST['token'] = 'valid_token';
        $_POST['userId'] = '123';

        $this->assertJsonStringEqualsJsonString('{"mock_response":"single_user"}', $this->captureOutput([$apiUsersList, 'singleUser']));
    }

    private function captureOutput(callable $callable): string {
        ob_start();
        $callable();
        return ob_get_clean();
    }

    private function mockWordPressFunctions(string $token): void {
        // Your existing mock functions go here
    }
}
