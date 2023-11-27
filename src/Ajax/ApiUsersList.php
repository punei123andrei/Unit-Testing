<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Ajax;

class ApiUsersList
{
    public function init()
    {
        $this->addAjaxAction('inpsyde_users_list', [$this, 'userList']);
        $this->addAjaxAction('inpsyde_single_user', [$this, 'singleUser']);
    }

    private function addAjaxAction($action, $callback)
    {
        add_action("wp_ajax_$action", $callback);
        add_action("wp_ajax_nopriv_$action", $callback);
    }

    private function handleAjaxRequest()
    {
        if (!isset($_POST['token'])) {
            wp_send_json_error(['message' => __('Token is missing', 'inpsyde-users')]);
        }

        $token = sanitize_text_field(wp_unslash($_POST['token']));

        if (!wp_verify_nonce($token, 'inpsyde_token')) {
            wp_send_json_error(['message' => __('Invalid nonce', 'inpsyde-users')]);
        }

        return $token;
    }

    public function userList()
    {
        $token = $this->handleAjaxRequest();

        $url = ApiUsers::baseUrl('/users');
        $headers = ApiUsers::headers();

        $response = ApiRequest::makeGetRequest($url, [], $headers);

        wp_send_json($response);
    }

    public function singleUser()
    {
        $token = $this->handleAjaxRequest();

        $userId = isset($_POST['userId']) ? sanitize_text_field(wp_unslash($_POST['userId'])) : '';
        $userProfile = '/users/' . $userId;

        $url = ApiUsers::baseUrl($userProfile);
        $headers = ApiUsers::headers();

        $response = ApiRequest::makeGetRequest($url, [], $headers);

        if ($response) {
            wp_send_json($response);
        }
    }
}
