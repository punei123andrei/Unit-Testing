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

class ApiUsersList extends ApiUsers
{
    public function init(){
        add_action('wp_ajax_nopriv_get_user_list', [$this, 'getUsers']);
        add_action('wp_ajax_increase_get_user_list', [$this, 'getUsers']);
    }

    public function getUsers(){
        wp_send_json('ce mai faci?');
    }
}