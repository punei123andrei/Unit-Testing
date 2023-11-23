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
    public function init(){
        add_action('wp_ajax_inpsyde_get_users', [$this, 'getUsers']);
        add_action('wp_ajax_nopriv_inpsyde_get_users', [$this, 'getUsers']);
    }

    public function getUsers(){
        $url = ApiUsers::baseUrl('/users');
        $headers = ApiUsers::headers();
        $response = ApiRequest::makeGetRequest($url, [], $headers);
        wp_send_json($response);
    }
}